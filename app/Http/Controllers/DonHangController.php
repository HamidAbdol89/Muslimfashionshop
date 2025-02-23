<?php
namespace App\Http\Controllers;

use App\Models\DonHang;
use App\Models\DonHang_ChiTiet;
use App\Models\TinhTrang;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product; 
use App\Mail\DatHangThanhCongEmail; 
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Mail; 

class DonHangController extends Controller
{
    public function getDanhSach()
    {
        // Duyệt qua đơn hàng và lấy thông tin sản phẩm, size và color
        $donhang = DonHang::with([
            'user', 
            'TinhTrang', 
            'DonHang_ChiTiet.product', 
            'DonHang_ChiTiet.size', // Eager load size_id
            'DonHang_ChiTiet.color' // Eager load color_id
        ])->orderBy('created_at', 'desc')->get();
        
        // Truyền vào view
        return view('admin.donhang.danhsach', compact('donhang'));
    }
    


public function getThem()
{
    $products = Product::all(); // Lấy tất cả sản phẩm
    $tinhtrang = TinhTrang::all(); // Lấy tất cả tình trạng
    return view('admin.donhang.them', compact('products', 'tinhtrang')); // Truyền biến vào view
}





public function postThem(Request $request)
{
    $request->validate([
        'product_id' => ['required'],
        'tinhtrang_id' => ['required'],
        'dienthoaigiaohang' => ['required', 'string', 'max:20'],
        'diachigiaohang' => ['required', 'string', 'max:255'],
    ]);

    // Tạo đơn hàng mới
    $donhang = DonHang::create([
        'user_id' => auth()->id(),
        'tinhtrang_id' => $request->tinhtrang_id,
        'dienthoaigiaohang' => $request->dienthoaigiaohang,
        'diachigiaohang' => $request->diachigiaohang,
    ]);

    // Tìm sản phẩm và lấy giá bán
    $product = Product::find($request->product_id);

    // Thêm sản phẩm vào chi tiết đơn hàng
    DonHang_ChiTiet::create([
        'donhang_id' => $donhang->id,
        'product_id' => $request->product_id,
        'soluongban' => 1, // Hoặc số lượng được gửi từ form
        'dongiaban' => $product->price, // Lưu giá bán từ sản phẩm
    ]);

    // Gửi email nếu cần
    Mail::to(auth()->user()->email)->send(new DatHangThanhCongEmail($donhang));

    return redirect()->route('donhang')->with('success', 'Đặt hàng thành công!');
}



  // Phương thức gửi email (nếu bạn muốn tách riêng chức năng này)
  public function guiEmail($donhang_id)
  {
      $donhang = DonHang::find($donhang_id);
      
      if ($donhang) {
          Mail::to(auth()->user()->email)->send(new DatHangThanhCongEmail($donhang));
          return response()->json(['message' => 'Email đã được gửi thành công!']);
      }

      return response()->json(['message' => 'Không tìm thấy đơn hàng!'], 404);
  }


    // Gửi email nếu cần
   // Mail::to(auth()->user()->email)->send(new DatHangThanhCongEmail($donhang));

  //  return redirect()->route('admin.donhang')->with('success', 'Đặt hàng thành công!');






 public function getSua($id)
 {
 $donhang = DonHang::find($id);
 $tinhtrang = TinhTrang::all();
 return view('admin.donhang.sua', compact('donhang', 'tinhtrang'));
 }

 public function postSua(Request $request, $id)
 {
 // Kiểm tra
 $request->validate([
 'tinhtrang_id' => ['required'],
 'dienthoaigiaohang' => ['required', 'string', 'max:20'],
 'diachigiaohang' => ['required', 'string', 'max:255'],
 ]);

 $orm = DonHang::find($id);
 $orm->tinhtrang_id = $request->tinhtrang_id;
 $orm->dienthoaigiaohang = $request->dienthoaigiaohang;
 $orm->diachigiaohang = $request->diachigiaohang;
 $orm->save();

 // Sau khi sửa thành công thì tự động chuyển về trang danh sách
 return redirect()->route('donhang');
 }

 public function getXoa($id)
 {
     // Xóa đơn hàng chi tiết
     DonHang_ChiTiet::where('donhang_id', $id)->delete();
 
     $orm = DonHang::find($id); // Tìm đơn hàng với id được truyền vào
 
     if (!$orm) {
         // Nếu không tìm thấy, chuyển hướng với thông báo lỗi
         return redirect()->route('admin.donhang')->with('error', 'Không tìm thấy đơn hàng!');
     }
 
     $orm->delete(); // Nếu tìm thấy, tiến hành xóa
 
     // Sau khi xóa thành công thì tự động chuyển về trang danh sách
     return redirect()->route('donhang')->with('success', 'Xóa đơn hàng thành công!');
 }
 
}