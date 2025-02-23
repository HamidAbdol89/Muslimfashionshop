<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DiaChi;

class UserAddressController extends Controller
{
    /**
     * Lưu địa chỉ vào cơ sở dữ liệu.
     */
    public function saveAddress(Request $request)
{
    // Xác thực dữ liệu
    $validated = $request->validate([
        'name' => 'required|string|max:100',
        'address' => 'required|string|max:255',
        'phone' => 'required|string|max:15',
        'city' => 'required|string|max:100',
    ]);

    // Kiểm tra xem người dùng đã có địa chỉ chưa
    $existingAddress = DiaChi::where('user_id', auth()->id())->first();

    if ($existingAddress) {
        // Nếu đã có, cập nhật địa chỉ
        $existingAddress->update([
            'ten_nguoi_nhan' => $validated['name'],
            'dia_chi' => $validated['address'],
            'so_dien_thoai' => $validated['phone'],
            'thanh_pho' => $validated['city'],
        ]);

        // Thông báo cập nhật thành công
        return redirect()->back()->with('success', 'Địa chỉ đã được cập nhật thành công!');
    } else {
        // Nếu chưa có, thêm mới địa chỉ
        DiaChi::create([
            'user_id' => auth()->id(),
            'ten_nguoi_nhan' => $validated['name'],
            'dia_chi' => $validated['address'],
            'so_dien_thoai' => $validated['phone'],
            'thanh_pho' => $validated['city'],
        ]);

        // Thông báo lưu thành công
        return redirect()->back()->with('success', 'Địa chỉ đã được lưu thành công!');
    }
}
public function editAddress()
{
    // Lấy một địa chỉ duy nhất của người dùng đang đăng nhập
    $address = DiaChi::where('user_id', auth()->id())->first();
    
    // Nếu không có địa chỉ, tạo một đối tượng DiaChi rỗng
    if (!$address) {
        $address = new DiaChi(); 
    }

    return view('user.diachinguoidung', compact('address'));
}




    public function index()
{
    $address = DiaChi::where('user_id', auth()->id())->get();
    return view('user.diachinguoidung', compact('address'));
}



public function destroy($id)
{
    $address = DiaChi::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
    $address->delete();

    return redirect()->route('user.addresses')->with('success', 'Địa chỉ đã được xóa thành công!');
}
public function showAddresses()
{
    $address  = DiaChi::where('user_id', auth()->id())->get();
    return view('user.diachinguoidung', compact('address'));
}



}
