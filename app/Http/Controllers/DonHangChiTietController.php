<?php

namespace App\Http\Controllers;

use App\Models\DonHang_ChiTiet;
use App\Models\Product;
use App\Models\DonHang;
use Illuminate\Http\Request;
use App\Models\ProductColor;
use App\Models\Size;

class DonHangChiTietController extends Controller
{
    public function getDanhSach()
{
    $donhangchitiet = DonHang_ChiTiet::with(['DonHang', 'products', 'size', 'color'])->get(); 
    return view('donhangchitiet.danhsach', compact('donhangchitiet')); 
}



    public function getThem()
    {
        return view('donhangchitiet.them');
    }

	
    public function store(Request $request)
    {
        // Lấy giỏ hàng hiện tại từ session hoặc khởi tạo mới nếu chưa có
        $cart = session()->get('cart', []);
    
        // Lấy thông tin sản phẩm từ request
        $productId = $request->input('product_id');
        $product = Product::find($productId);
    
        // Kiểm tra nếu sản phẩm tồn tại
        if (!$product) {
            return response()->json(['error' => 'Sản phẩm không tồn tại.']);
        }
    
        // Lấy thông tin color và size từ request
        $colorId = $request->input('color');
        $sizeId = $request->input('size');
    
        // Kiểm tra xem màu và kích thước có hợp lệ không
        $color = ProductColor::find($colorId);
        $size = Size::find($sizeId);
    
        if (!$color) {
            return response()->json(['error' => 'Màu sắc không hợp lệ.']);
        }
    
        if (!$size) {
            return response()->json(['error' => 'Kích thước không hợp lệ.']);
        }
    
        // Nếu sản phẩm đã có trong giỏ hàng, tăng số lượng lên, nếu chưa có, thêm vào giỏ hàng
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += 1;
        } else {
            $cart[$productId] = [
                'product_id' => $productId,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'feature_image_path' => $product->feature_image_path,
                'color_id' => $colorId,
                'size_id' => $sizeId 
            ];
        }
    
        // Lưu giỏ hàng vào session
        session()->put('cart', $cart);
    
        return response()->json(['message' => 'Giỏ hàng đã được cập nhật.']);
    }
    
    
    
  
//...

public function postThem(Request $request)
{
    
    // Xác thực dữ liệu nhập vào
    $request->validate([
        'dienthoaigiaohang' => ['required', 'string', 'max:20'],
        'diachigiaohang' => ['required', 'string', 'max:255'],
    ]);

    // Tạo đơn hàng mới
    $donhang = DonHang::create([
        'user_id' => auth()->id(),
        'tinhtrang_id' => 1,  // Trạng thái đơn hàng mặc định là 'Chờ xử lý'
        'dienthoaigiaohang' => $request->dienthoaigiaohang,
        'diachigiaohang' => $request->diachigiaohang,
    ]);

    // Lấy giỏ hàng từ session
    $cart = session()->get('cart', []);

    // Kiểm tra nếu giỏ hàng trống
    if (empty($cart)) {
        return redirect()->back()->with('error', 'Giỏ hàng của bạn trống.');
    }

    // Lặp qua giỏ hàng và lưu chi tiết vào DonHang_ChiTiet
    foreach ($cart as $item) {
        $product = Product::find($item['product_id']);

        // Kiểm tra nếu sản phẩm tồn tại
        if (!$product) {
            return redirect()->back()->with('error', 'Sản phẩm không tồn tại.');
        }

        // Lấy thông tin size và color (nếu có)
        $size = isset($item['size_id']) ? Size::find($item['size_id']) : null;
        $color = isset($item['color_id']) ? ProductColor::find($item['color_id']) : null;

        // Lưu chi tiết đơn hàng
        DonHang_ChiTiet::create([
            'donhang_id' => $donhang->id,
            'product_id' => $item['product_id'],
            'soluongban' => $item['quantity'],
            'dongiaban' => $product->price,
            'size_id' => $size ? $size->id : null, 
            'color_id' => $color ? $color->id : null,
        ]);
    }

    // Xóa giỏ hàng khỏi session sau khi đặt hàng
    session()->forget('cart');

    return redirect()->route('donhang')->with('success', 'Đặt hàng thành công!');
}







    public function getXoa($id)
    {
        $orm = DonHang_ChiTiet::find($id);
        $orm->delete();

        return redirect()->route('donhangchitiet');
    }
}
