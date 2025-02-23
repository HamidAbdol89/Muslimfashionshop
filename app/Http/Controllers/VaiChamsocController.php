<?php

namespace App\Http\Controllers;

use App\Models\VaiChamsoc;
use App\Models\Product;
use Illuminate\Http\Request;

class VaiChamsocController extends Controller
{
    public function index()
    {
        // Lấy các sản phẩm cùng với thông tin vải và chăm sóc vải, phân trang
        $products = Product::with('vaiChamsoc')->paginate(10); // 10 sản phẩm mỗi trang
        
        // Trả về view với danh sách sản phẩm và phân trang
        return view('admin.vai_chamsoc.index', compact('products'));
    }
    

    // Phương thức tạo mới
    public function create()
    {
        // Lấy danh sách sản phẩm để chọn
        $products = Product::all();
        
        return view('admin.vai_chamsoc.create', compact('products'));
    }

    public function store(Request $request)
    {
        // Validate dữ liệu nhập vào
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'vai' => 'required|string|max:255',
            'cham_soc_vai' => 'required|string|max:255',
            'trong_luong_vai' => 'required|string', // Kiểm tra định dạng "Trung bình (175 gsm)"
            'ma_vai' => 'required|string|max:255',
        ]);
    
        // Tạo mới thông tin vải-chăm sóc vải
        VaiChamsoc::create([
            'product_id' => $request->product_id,
            'vai' => $request->vai,
            'cham_soc_vai' => $request->cham_soc_vai,
            'trong_luong_vai' => $request->trong_luong_vai, // Truyền giá trị vào
            'ma_vai' => $request->ma_vai,
        ]);
    
        // Chuyển hướng về danh sách với thông báo thành công
        return redirect()->route('vai_chamsoc.index')->with('success', 'Thông tin vải-chăm sóc vải đã được thêm thành công!');
    }
    
    
    public function update(Request $request, $id)
    {
        // Validate dữ liệu
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'vai' => 'required|string|max:255',
            'cham_soc_vai' => 'required|string|max:255',
            'trong_luong_vai' => 'required|string', // Kiểm tra định dạng "Trung bình (175 gsm)"
            'ma_vai' => 'required|string|max:255',
        ]);
    
        // Lấy vai_chamsoc theo ID
        $vaiChamsoc = VaiChamsoc::findOrFail($id);
    
        // Cập nhật dữ liệu
        $vaiChamsoc->update([
            'product_id' => $validated['product_id'],
            'vai' => $validated['vai'],
            'cham_soc_vai' => $validated['cham_soc_vai'],
            'trong_luong_vai' => $validated['trong_luong_vai'],
            'ma_vai' => $validated['ma_vai'],
        ]);
    
        // Chuyển hướng về danh sách với thông báo thành công
        return redirect()->route('vai_chamsoc.index')->with('success', 'Cập nhật thông tin vải thành công!');
    }
    

    
    
    public function edit($id)
    {
        // Lấy vai_chamsoc theo ID
        $vaiChamsoc = VaiChamsoc::findOrFail($id);
    
        // Lấy tất cả sản phẩm để hiển thị trong dropdown
        $products = Product::all();
    
        // Trả về view với dữ liệu vai_chamsoc và danh sách sản phẩm
        return view('admin.vai_chamsoc.edit', compact('vaiChamsoc', 'products'));
    }
    
    

  


    // Xóa thông tin vải-chăm sóc vải
    public function destroy($id)
    {
        // Tìm và xóa VaiChamsoc theo ID
        $vaiChamsoc = VaiChamsoc::findOrFail($id);
        $vaiChamsoc->delete();
    
        // Chuyển hướng về danh sách với thông báo thành công
        return redirect()->route('vai_chamsoc.index')->with('success', 'Thông tin vải đã được xóa.');
    }
    
}
