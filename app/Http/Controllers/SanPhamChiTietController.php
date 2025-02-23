<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\Review;
use App\Models\Size;
use App\Models\DonHang_ChiTiet;
use App\Models\DonHang;
use Illuminate\Http\Request;
use App\Models\ProductColor;


class SanPhamChiTietController extends Controller
{
    public function show($id)
{
    // Lấy sản phẩm theo id
    $featuredProduct = Product::find($id);
    
    // Lấy tất cả sản phẩm và danh mục
    $products = Product::all();
    $categories = Category::all();
    $sizes = Size::all();
    $colors = ProductColor::all();

    // Kiểm tra nếu không tìm thấy sản phẩm
    if (!$featuredProduct) {
        abort(404);
    }

    // Trả về view với dữ liệu sản phẩm, danh mục
    return view('frontend.SanphamChitiet', compact('featuredProduct', 'products', 'categories', 'sizes', 'colors'));
}

		
public function showProduct($id)
{
    // Lấy sản phẩm chi tiết theo ID
    $featuredProduct = Product::with('productImages')->findOrFail($id);

    // Lấy danh mục của sản phẩm hiện tại
    $categoryId = $featuredProduct->category_id;

    // Lấy các sản phẩm trong cùng danh mục (có thể giới hạn số lượng để hiển thị ngẫu nhiên)
    $relatedProducts = Product::where('category_id', $categoryId)
        ->where('id', '!=', $id)  // Loại bỏ sản phẩm hiện tại
        ->inRandomOrder()          // Lấy sản phẩm ngẫu nhiên
        ->limit(5)                 // Giới hạn số lượng sản phẩm liên quan
        ->get();

    // Trả về view với dữ liệu
    return view('frontend.SanphamChitiet', compact('featuredProduct', 'relatedProducts'));
}

public function storeRatingAndComment(Request $request, $productId)
{
    $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'nullable|string|max:500',
    ]);

    // Lấy tên người dùng và user_id
    $user = auth()->user();
    $userName = $user->name;
    $userId = $user->id;  // Dùng user_id để lấy ảnh đại diện

    // Kiểm tra xem đánh giá đã tồn tại chưa dựa vào tên người dùng
    $review = Review::where('product_id', $productId)
                    ->where('user_name', $userName)  // Dựa vào user_name thay vì user_id
                    ->first();

    if ($review) {
        // Nếu đã tồn tại, cập nhật đánh giá
        $review->update([
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);
        $message = 'Đánh giá và bình luận của bạn đã được cập nhật!';
    } else {
        // Nếu chưa tồn tại, tạo mới
        Review::create([
            'product_id' => $productId,
            'user_name' => $userName,  // Lưu tên người dùng thay vì user_id
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);
        $message = 'Đánh giá và bình luận của bạn đã được lưu!';
    }

    // Lấy ảnh đại diện của người dùng dựa trên user_id
    $avatarUrl = asset('uploads/avatars/' . $userId . '.jpg'); // Sử dụng user_id để lấy ảnh đại diện

    return response()->json([
        'success' => $message,
        'avatar_url' => $avatarUrl,  // Trả về URL của ảnh đại diện
    ]);
}



public function showProductPage($productId)
{
    // Lấy thông tin người dùng hiện tại (người dùng đã đăng nhập)
    $user = auth()->user();

    // Lấy thông tin sản phẩm
    $featuredProduct = Product::find($productId);

    // Kiểm tra nếu sản phẩm không tồn tại
    if (!$featuredProduct) {
        abort(404, 'Sản phẩm không tồn tại');
    }

    // Lấy đánh giá của người dùng cho sản phẩm nếu có
    $userRating = Review::where('product_id', $productId)
                        ->where('user_id', $user ? $user->id : null)
                        ->first();

    // Trả về view cùng với thông tin sản phẩm và đánh giá của người dùng
    return view('frontend.SanphamChitiet', compact('featuredProduct', 'userRating'));
}


// hướng dẫn size theo danh mục sản phẩm
public function showProductDetail($id)
{
    // Lấy sản phẩm theo id và eager load category
    $featuredProduct = Product::with('category')->find($id);

    if (!$featuredProduct) {
        abort(404);
    }

    return view('frontend.SanphamChitiet', compact('featuredProduct'));
}


public function color($productId)
{
// Lấy sản phẩm và màu sắc của nó
$product = Product::with('colors.productImage')->findOrFail($productId);
$colors = ProductColor::with('productImage')->get(); // Lấy tất cả màu sắc nếu cần

// Truyền vào view
return view('frontend.SanphamChitiet', compact('product', 'colors'));
}




}
