<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Models\Category; // Thay vì Product, sử dụng Category
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index()
    {
        $sizes = Size::with('category')->paginate(10); // Hiển thị 10 mục trên mỗi trang
        return view('admin.size.danhsach', compact('sizes'));
    }
    

    public function create()
    {
        $categories = Category::all(); // Lấy tất cả danh mục thay vì sản phẩm
        return view('admin.size.them', compact('categories'));
    }

    public function store(Request $request)
    {
        // Kiểm tra dữ liệu vào
        $request->validate([
            'category_id' => 'required|exists:categories,id',  // Kiểm tra khóa ngoại
            'size' => 'required|string',
            'description' => 'nullable|string',
        ]);
    
        // Lấy dữ liệu và tạo bản ghi mới
        $size = new Size();
        $size->fill([
            'category_id' => $request->category_id,  // Lưu category_id thay vì product_id
            'size' => $request->size,
            'description' => $request->description,
        ]);
        $size->save();  // Lưu vào cơ sở dữ liệu
    
        return redirect()->route('sizes.index')->with('success', 'Kích thước đã được thêm thành công!');
    }

    public function edit($id)
    {
        $size = Size::findOrFail($id);
        $categories = Category::all(); // Lấy tất cả danh mục thay vì sản phẩm
        return view('admin.size.sua', compact('size', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',  // Kiểm tra khóa ngoại
            'size' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $size = Size::findOrFail($id);
        $size->update([
            'category_id' => $request->category_id,  // Cập nhật category_id thay vì product_id
            'size' => $request->size,
            'description' => $request->description,
        ]);

        return redirect()->route('sizes.index');
    }

    public function destroy($id)
    {
        $size = Size::findOrFail($id);
        $size->delete();

        return redirect()->route('sizes.index');
    }
}
