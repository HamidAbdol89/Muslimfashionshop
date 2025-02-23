<?php

namespace App\Http\Controllers;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use App\Models\DonHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ReviewController extends Controller
{


    public function store(Request $request)
{
    $validatedData = $request->validate([
        'product_id' => 'required|exists:products,id',
        'user_name' => 'required|string|max:255',
        'rating' => 'required|integer|between:1,5',
        'comment' => 'nullable|string',
    ]);

    Review::create($validatedData);

    return response()->json(['message' => 'Đánh giá đã được lưu thành công.']);
}

public function index($productId)
{
    $reviews = Review::where('product_id', $productId)->get();
    return response()->json($reviews);
}





public function showReviews($id)
{
    $featuredProduct = Product::with('reviewss')->find($id);

    if (!$featuredProduct) {
        abort(404, 'Sản phẩm không tồn tại');
    }

    $categoryId = $featuredProduct->category_id;
    $relatedProducts = Product::where('category_id', $categoryId)
        ->where('id', '!=', $id)  // Loại bỏ sản phẩm hiện tại
        ->inRandomOrder()          // Lấy sản phẩm ngẫu nhiên
        ->limit(5)                 // Giới hạn số lượng sản phẩm liên quan
        ->get();

    // Lấy các đánh giá cho sản phẩm này
    $reviews = $featuredProduct->reviewss; // Lấy tất cả đánh giá liên quan đến sản phẩm

    return view('frontend.SanphamChitiet', compact('featuredProduct', 'relatedProducts', 'reviews'));
}


public function showdanhgia()
    {
        // Lấy tất cả các đánh giá của người dùng hiện tại
        $reviews = Review::where('user_name', Auth::id())
                         ->with('product') // Giả sử mỗi đánh giá liên kết với sản phẩm
                         ->get();

        return view('user.danhgia', compact('reviews'));
    }

    public function getDanhGia()
    {
        if (Auth::check()) {
            $user = Auth::user(); // Lấy thông tin người dùng đã đăng nhập
            $reviewss = $user->reviewss; // Lấy tất cả đánh giá của người dùng
    
            // Kiểm tra nếu không có đánh giá
            if ($reviewss->isEmpty()) {
                return view('user.danhgia', ['message' => 'Bạn chưa đánh giá sản phẩm nào.']);
            }
    
            // Truyền dữ liệu vào view
            return view('user.danhgia', compact('reviewss'));
        }
        return redirect()->route('user.dangnhap'); // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
    }
    
    public function showAllReviews($productId)
    {
        // Lấy tất cả đánh giá cho sản phẩm
        $reviews = Review::where('product_id', $productId)->paginate(5);
    
        // Kiểm tra nếu không có đánh giá nào cho sản phẩm
        if ($reviews->isEmpty()) {
            // Bạn có thể xử lý thêm nếu không có đánh giá, chẳng hạn trả về thông báo lỗi
            return view('user.xemtatcadanhgia')->with('message', 'Không có đánh giá cho sản phẩm này.');
        }
    
        // Trả về view với dữ liệu reviews
        return view('user.xemtatcadanhgia', compact('reviews'));
    }
    
    
    
    
    public function vote($reviewId, $vote)
    {
        $review = Review::find($reviewId);
    
        if (!$review) {
            return response()->json(['success' => false, 'message' => 'Bình luận không tồn tại.']);
        }
    
        $userVotes = session()->get('user_votes', []);
        $previousVote = $userVotes[$reviewId] ?? null;
    
        if ($previousVote !== $vote) {
            if ($previousVote === 'like') {
                $review->likes = max(0, $review->likes - 1);
            } elseif ($previousVote === 'dislike') {
                $review->dislikes = max(0, $review->dislikes - 1);
            }
    
            if ($vote === 'like') {
                $review->likes += 1;
            } elseif ($vote === 'dislike') {
                $review->dislikes += 1;
            }
    
            $userVotes[$reviewId] = $vote;
            session()->put('user_votes', $userVotes);
    
            $review->save();
        }
    
        return response()->json([
            'success' => true,
            'likes' => $review->likes,
            'dislikes' => $review->dislikes
        ]);
    }
    
    
   public function indexAdmin(Request $request)
{
    $productQuery = $request->input('product', ''); // Lấy giá trị tìm kiếm từ yêu cầu

    // Lọc đánh giá theo tên sản phẩm nếu có
    $reviews = Review::with('product') // Nếu có mối quan hệ với sản phẩm
        ->whereHas('product', function ($query) use ($productQuery) {
            if (!empty($productQuery)) {
                $query->where('name', 'like', '%' . $productQuery . '%');
            }
        })
        ->orderBy('created_at', 'desc') // Sắp xếp theo ngày mới nhất
        ->paginate(10); // Phân trang 10 review mỗi trang

    return view('admin.binhluansanpham.index', compact('reviews'));
}

    
    

}
