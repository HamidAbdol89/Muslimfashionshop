<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\DeleteModelTrait;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AdminUserController extends Controller
{
    use DeleteModelTrait;

    private $user;

    // Constructor chỉ còn lại $user
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function danhsach(Request $request)
    {
        // Lấy danh sách người dùng và phân trang
        $users = User::paginate(5);
    
        // Kiểm tra nếu yêu cầu là AJAX
        if ($request->ajax()) {
            // Trả về dữ liệu bảng và phân trang
            return response()->json([
                'data' => view('admin.user.table_user', compact('users'))->render(),
                'pagination' => (string) $users->links()
            ]);
        }
    
        // Nếu không phải AJAX, trả về view bình thường
        return view('admin.user.danhsach', compact('users'));
    }

    public function them()
    {
        // Không cần gắn vai trò ở đây nữa, xóa phần này đi
        return view('admin.user.them');
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            // Tạo người dùng mới
            $user = $this->user->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            
            DB::commit();
            
            // Thêm thông báo thành công
            return redirect()->route('users.danhsach')->with('add_success', 'Thêm người dùng thành công!');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message :' . $exception->getMessage() . '--- Line: ' . $exception->getLine());

            // Thêm thông báo lỗi
            return redirect()->route('users.danhsach')->with('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
    }

    public function sua($id)
    {
        // Lấy thông tin người dùng để sửa
        $user = $this->user->find($id);
        return view('admin.user.sua', compact('user'));
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            // Cập nhật thông tin người dùng
            $this->user->find($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            DB::commit();
            
            // Thêm thông báo thành công
            return redirect()->route('users.danhsach')->with('success', 'Cập nhật người dùng thành công!');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message :' . $exception->getMessage() . '--- Line: ' . $exception->getLine());

            // Thêm thông báo lỗi
            return redirect()->route('users.danhsach')->with('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
    }

    public function xoa($id)
    {
        return $this->deleteModelTrait($id, $this->user);
    }
    

    public function uploadAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $userId = Auth::id();  // Lấy ID người dùng
        $file = $request->file('avatar');  // Lấy file tải lên
        $filename = $userId . '.jpg';  // Tạo tên file cho avatar
        $path = public_path('uploads/avatars');  // Đường dẫn đến thư mục lưu trữ
        
        if (!file_exists($path)) {
            mkdir($path, 0755, true);  // Tạo thư mục nếu chưa tồn tại
        }
    
        try {
            // Lưu ảnh vào thư mục
            $file->move($path, $filename);
            
            // Trả về phản hồi JSON với URL ảnh mới
            return response()->json([
                'success' => true,
                'avatar_url' => asset('uploads/avatars/' . $filename),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi tải ảnh lên. Vui lòng thử lại.',
            ], 500);  // Mã lỗi 500 nếu có lỗi
        }
    }
    

    public function deleteAvatar()
{
    $userId = Auth::id();
    $avatarPath = public_path('uploads/avatars/' . $userId . '.jpg');

    if (file_exists($avatarPath)) {
        unlink($avatarPath); // Xóa file avatar
    }

    return redirect()->back()->with('success', 'Ảnh đại diện đã được xóa!');
}

public function getAvatar($userName)
{
    // Tìm người dùng dựa vào user_name
    $user = User::where('name', $userName)->first();

    if ($user) {
        // Sử dụng user_id để lấy ảnh avatar
        $avatarPath = public_path('uploads/avatars/' . $user->id . '.jpg');
        
        if (file_exists($avatarPath)) {
            return response()->file($avatarPath);  // Trả về ảnh nếu tồn tại
        }
    }

    // Trả về ảnh mặc định nếu không có ảnh avatar cho người dùng
    return response()->file(public_path('images/default-avatar.jpg'));
}





}
