<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductColor;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
class ProductColorController extends Controller
{
    public function index()
    {
        // Lấy tất cả dữ liệu từ ProductColor
        $colors = ProductColor::with(['product', 'product.images:id,image_path'])->get();
    
        // Phân trang thủ công
        $perPage = 10; // Số mục trên mỗi trang
        $currentPage = request()->input('page', 1); // Lấy trang hiện tại từ request
        $currentItems = $colors->slice(($currentPage - 1) * $perPage, $perPage)->values();
    
        $paginatedColors = new LengthAwarePaginator(
            $currentItems, // Dữ liệu của trang hiện tại
            $colors->count(), // Tổng số mục
            $perPage, // Số mục trên mỗi trang
            $currentPage, // Trang hiện tại
            ['path' => request()->url(), 'query' => request()->query()] // Đường dẫn hiện tại và các tham số truy vấn
        );
    
        return view('admin.color.index', compact('paginatedColors'));
    }
    
    
    
    

    // Tạo mới màu sắc cho sản phẩm
  // Tạo mới màu sắc cho sản phẩm
public function create()
{
    // Lấy danh sách sản phẩm
    $product = Product::all();
    $color = ProductColor::all();
    // Trả về view với danh sách sản phẩm
    return view('admin.color.create', compact('product'));
}

public function getProductImages($productId)
{
    $product = Product::find($productId);
    $images = $product->images()->select('id', 'image_path')->get(); // Chỉ lấy id và image_path
    
    return response()->json(['images' => $images]);
}





public function store(Request $request)
{
    // Kiểm tra và xác thực dữ liệu đầu vào
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'color' => 'required|string',
        'image_path' => 'nullable|array', // Thay đổi thành array để lưu nhiều ảnh
        'image_path.*' => 'nullable|string', // Kiểm tra từng phần tử trong mảng
        'other_color' => 'nullable|string', // Trường nhập màu nếu chọn "Khác"
    ]);

    // Nếu người dùng chọn "Khác", sử dụng giá trị từ trường 'other_color'
    $color = $request->color == 'other' ? $request->other_color : $request->color;

    // Lấy ID sản phẩm từ chuỗi
    $productId = (int) explode(' - ', $request->product_id)[0];

    // Lặp qua các ảnh đã chọn và lưu từng ảnh vào cơ sở dữ liệu
    if ($request->has('image_path') && is_array($request->image_path)) {
        foreach ($request->image_path as $imagePath) {
            // Tạo mới bản ghi màu sắc cho mỗi ảnh chi tiết
            $productColor = new ProductColor();
            $productColor->product_id = $productId;
            $productColor->color = $color; // Sử dụng màu sắc được chọn
            $productColor->image_path = $imagePath; // Lưu đường dẫn ảnh cho từng ảnh
            $productColor->save();
        }

        return redirect()->route('colors.index')->with('success', 'Màu sắc đã được thêm thành công cho tất cả ảnh.');
    }

    return back()->withErrors(['msg' => 'Lỗi khi thêm màu sắc.']);
}




    


    // Hiển thị form sửa màu sắc
    public function edit($id)
    {
        $product = Product::all(); // Lấy danh sách sản phẩm
        $color = ProductColor::findOrFail($id); // Tìm màu sắc theo ID
    
        return view('admin.color.edit', compact('product', 'color'));
    }
    
    // Cập nhật màu sắc
    public function update(Request $request, $id)
    {
        // Validate dữ liệu
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'color' => 'required|string',
            'other_color' => 'nullable|string',  // Đảm bảo rằng nếu chọn "Khác", màu sắc nhập vào là chuỗi
        ]);
    
        // Tìm màu sắc cần cập nhật
        $color = ProductColor::findOrFail($id);
    
        // Kiểm tra nếu người dùng chọn "Khác", sử dụng giá trị nhập vào từ trường "other_color"
        $colorValue = $request->color == 'other' ? $request->other_color : $request->color;
    
        // Cập nhật màu sắc và sản phẩm liên kết
        $color->update([
            'product_id' => $request->product_id,
            'color' => $colorValue,
        ]);
    
        // Chuyển hướng về trang danh sách với thông báo thành công
        return redirect()->route('colors.index', ['productId' => $request->product_id])
                         ->with('success', 'Màu sắc đã được cập nhật thành công!');
    }
    

    // Xóa màu sắc
    public function destroy($productId, $colorId)
    {
        $product = Product::findOrFail($productId);
        $color = ProductColor::findOrFail($colorId);

        // Xóa màu sắc
        $color->delete();

        return redirect()->route('product.colors.index', $productId)
                         ->with('success', 'Màu sắc đã được xóa thành công!');
    }

}
