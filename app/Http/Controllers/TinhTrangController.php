<?php

namespace App\Http\Controllers;

use App\Models\TinhTrang;
use Illuminate\Http\Request;

class TinhTrangController extends Controller
{
 public function getDanhSach()
{
    $tinhtrang = TinhTrang::all(); // Lấy tất cả các tình trạng
    return view('admin.tinhtrang.danhsach', compact('tinhtrang')); // Truyền biến vào view
}


    public function getThem()
    {
        return view('admin.tinhtrang.them');
    }

public function postThem(Request $request)
{
    // Xác thực dữ liệu
    $validated = $request->validate([
        'tinhtrang' => 'required|string|max:255', // Bắt buộc nhập tình trạng
    ]);

    // Lưu tình trạng mới
    TinhTrang::create([
        'tinhtrang' => $validated['tinhtrang']
    ]);

    return redirect()->route('tinhtrang');
}






    public function getSua($id)
    {
        $tinhtrang = TinhTrang::findOrFail($id); // Tìm tình trạng theo ID
        return view('admin.tinhtrang.sua', compact('tinhtrang')); // Truyền biến vào view
    }

  public function postSua(Request $request, $id)
{
    // Tìm tình trạng theo ID
    $tinhtrang = TinhTrang::findOrFail($id);
    
    // Cập nhật tình trạng với dữ liệu từ request
    $tinhtrang->update($request->all()); // Nếu bạn đã định nghĩa fillable trong model

    // Chuyển hướng về trang danh sách
    return redirect()->route('tinhtrang');
}


    public function getXoa($id)
    {
        $tinhtrang = TinhTrang::findOrFail($id); // Tìm tình trạng theo ID
        $tinhtrang->delete(); // Xóa tình trạng
        return redirect()->route('tinhtrang'); // Chuyển hướng về danh sách
    }
}
