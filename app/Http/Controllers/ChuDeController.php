<?php
namespace App\Http\Controllers;
use App\Models\ChuDe;
use App\Models\BaiViet;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class ChuDeController extends Controller
{
 public function getDanhSach()
 {
 $chude = ChuDe::all();
 return view('admin.chude.danhsach', compact('chude'));
 }
 

// Phương thức mới lấy dữ liệu chuyên mục cho dropdown
public function getDanhMucDropdown()
{
    $chudes = ChuDe::all(); // Lấy tất cả chuyên mục từ cơ sở dữ liệu
    return response()->json($chudes); // Trả về dữ liệu dưới dạng JSON để dễ dàng xử lý
}


 // Phương thức để lấy danh sách bài viết theo chuyên mục
 public function getBaiVietTheoChuyenMuc($id)
 {
     // Lấy chuyên mục theo ID
     $chude = ChuDe::findOrFail($id);

     // Lấy tất cả bài viết thuộc chuyên mục đó
     $baiviet = BaiViet::where('chude_id', $chude->id)->get(); // Giả sử bạn có cột 'chude_id' trong bảng BaiViet

     // Trả về view với bài viết tương ứng
     return view('frontend.chude.baiviet', compact('baiviet', 'chude'));
 }

 public function getThem()
 {
 return view('admin.chude.them');
 }
 
 public function postThem(Request $request)
 {
 // Kiểm tra
 $request->validate([
 'tenchude' => ['required', 'string', 'max:255', 'unique:chude'],
 ]);
 
 $orm = new ChuDe();
 $orm->tenchude = $request->tenchude;
 $orm->tenchude_slug = Str::slug($request->tenchude, '-');
 $orm->save();
 
 // Sau khi thêm thành công thì tự động chuyển về trang danh sách
 return redirect()->route('admin.chude');
 }
 
 public function getSua($id)
 {
 $chude = ChuDe::find($id);
 return view('admin.chude.sua', compact('chude'));
 }
 
 public function postSua(Request $request, $id)
 {
 // Kiểm tra
 $request->validate([
 'tenchude' => ['required', 'string', 'max:255', 'unique:chude,tenchude,' . $id],
 ]);
 
 $orm = ChuDe::find($id);
 $orm->tenchude = $request->tenchude;
 $orm->tenchude_slug = Str::slug($request->tenchude, '-');
 $orm->save();
 
 // Sau khi sửa thành công thì tự động chuyển về trang danh sách
 return redirect()->route('admin.chude');
 }
 
 public function getXoa($id)
 {
 $orm = ChuDe::find($id);
 $orm->delete();
 
 // Sau khi xóa thành công thì tự động chuyển về trang danh sách
 return redirect()->route('admin.chude');
 }
}