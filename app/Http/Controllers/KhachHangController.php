<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\DonHang;
use App\Models\DonHang_ChiTiet;
use App\Models\Slider;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Hash;


class KhachHangController extends Controller
{
    public function getHome()
    {
        if (Auth::check()) {
            $user = User::find(Auth::user()->id);
            $sliders = Slider::all(); // Lấy tất cả slider
            $newArrivalProducts = Product::orderBy('created_at', 'desc')->take(10)->get(); // Sản phẩm mới
            $products = Product::all(); // Lấy tất cả sản phẩm
            return view('frontend.home', compact('user', 'sliders', 'newArrivalProducts', 'products'));
        }
        return redirect()->route('user.dangnhap');
    }



    public function getDatHang()
    {
        if (Auth::check())
            return view('user.dathang');
        else
            return redirect()->route('user.dangnhap');
    }




    public function postDatHang(Request $request) 
    { 
        // Kiểm tra 
        $this->validate($request, [ 
            'diachigiaohang' => ['required', 'string', 'max:255'], 
            'dienthoaigiaohang' => ['required', 'string', 'max:255'], 
        ]); 
         
        // Lưu vào đơn hàng 
        $dh = new DonHang(); 
        $dh->user_id = Auth::user()->id; 
        $dh->tinhtrang_id = 1; // Đơn hàng mới 
        $dh->diachigiaohang = $request->diachigiaohang; 
        $dh->dienthoaigiaohang = $request->dienthoaigiaohang; 
        $dh->save(); 
         
        // Lưu vào đơn hàng chi tiết 
        foreach(Cart::content() as $value) 
        { 
            $ct = new DonHang_ChiTiet(); 
            $ct->donhang_id = $dh->id; 
            $ct->product_id = $value->id; 
            $ct->soluongban = $value->qty; 
            $ct->dongiaban = $value->price; 
            $ct->save(); 
        } 
         
        return redirect()->route('user.dathangthanhcong'); 
    } 
    



    public function getDatHangThanhCong()
    {
        // Xóa giỏ hàng khi hoàn tất đặt hàng?
        session()->forget('cart'); // Xóa giỏ hàng từ session
        return view('user.dathangthanhcong');
    }

    
    public function getDonHang()
    {
        // Lấy tất cả đơn hàng của người dùng hiện tại
        $donHangs = DonHang::where('user_id', Auth::id())
                            ->with('TinhTrang', 'DonHang_ChiTiet.product') // Eager load các quan hệ
                            ->get();
    
        // Trả về view với dữ liệu
        return view('user.donhang', compact('donHangs')); // Đảm bảo đường dẫn đúng
    }
    
    
     // Xem chi tiết đơn hàng
     public function getDonHangChiTiet($id)
     {
         $donHang = DonHang::with('DonHang_ChiTiet.product')->where('id', $id)
                            ->where('user_id', Auth::id()) // Kiểm tra quyền sở hữu
                            ->first();
     
         if (!$donHang) {
             return redirect()->route('user.donhang')->with('error', 'Bạn không có quyền truy cập đơn hàng này!');
         }
     
         return view('donhang.chitiet', compact('donHang'));
     }
     
     public function postDonHang(Request $request, $id)
     {
         $donHang = DonHang::find($id);
 
         if (!$donHang) {
             return redirect()->route('donhang')->with('error', 'Đơn hàng không tồn tại!');
         }
 
         // Cập nhật trạng thái đơn hàng
         $donHang->tinhtrang_id = $request->input('tinhtrang_id');
         $donHang->save();
 
         return redirect()->route('donhang.chitiet', $id)->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
     }


public function getSanPhamYeuThich()
{
    // Kiểm tra xem người dùng đã đăng nhập chưa
    if (Auth::check()) {
        $user = Auth::user(); // Lấy thông tin người dùng
        $favoriteProducts = $user->favoritess; // Lấy danh sách các sản phẩm yêu thích (giả sử đã có quan hệ favorites)

        return view('user.thich', compact('user', 'favoriteProducts'));
    }
    return redirect()->route('user.dangnhap'); // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
}


public function getHoSoCaNhan()
{
    if (Auth::check()) {
        $user = Auth::user(); // Lấy thông tin người dùng đã đăng nhập
        $favoriteCount = $user->favoritess()->count(); // Đếm số lượng sản phẩm yêu thích
        $reviewCount = $user->reviewss()->count(); // Đếm số lượng đánh giá sản phẩm

        // Tạo đường dẫn ảnh đại diện
        $avatarUrl = asset('uploads/avatars/' . $user->id . '.jpg');

        return view('user.hosocanhan', compact('user', 'favoriteCount', 'reviewCount', 'avatarUrl')); // Truyền đường dẫn ảnh vào view
    }
    return redirect()->route('user.dangnhap'); // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
}



public function postHoSoCaNhan(Request $request)
{
    $id = Auth::user()->id;
    $request->validate([
        'name' => ['required', 'string', 'max:100'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
        'password' => ['confirmed'],
    ]);
    $orm = User::find($id);
    $orm->name = $request->name;  // Cập nhật tên người dùng
    $orm->email = $request->email;  // Cập nhật email
    if (!empty($request->password)) {
        $orm->password = Hash::make($request->password);  // Cập nhật mật khẩu nếu có
    }
    $orm->save();
    return redirect()->route('user.home')->with('success', 'Đã cập nhật thông tin thành công.');
}





    public function postDangXuat(Request $request)
    {
        Auth::logout();  // Đăng xuất người dùng
        return redirect()->route('frontend.home');  // Chuyển hướng về trang chủ sau khi đăng xuất
    }
}
