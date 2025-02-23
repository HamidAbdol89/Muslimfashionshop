<?php

// app/Http/Controllers/FavoriteController.php
namespace App\Http\Controllers;

use App\Models\UserFavorite;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FavoriteController extends Controller
{
    public function toggleFavorite($productId)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login'); // Chuyển hướng nếu chưa đăng nhập
        }
    
        // Kiểm tra nếu sản phẩm đã yêu thích
        $favorite = UserFavorite::where('user_id', $user->id)->where('product_id', $productId)->first();
    
        if ($favorite) {
            // Nếu đã yêu thích, xóa khỏi danh sách yêu thích
            $favorite->delete();
        } else {
            // Nếu chưa yêu thích, thêm vào danh sách yêu thích
            UserFavorite::create([
                'user_id' => $user->id,
                'product_id' => $productId,
            ]);
        }
    
        // Quay lại trang sản phẩm hoặc trang trước đó
        return back();
    }
    
    public function index(Request $request)
    {
        $query = UserFavorite::with(['user', 'product']);
        
        // Kiểm tra nếu có từ khóa tìm kiếm
        if ($request->has('search') && $request->search) {
            $query->whereHas('product', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }
        
        $favorites = $query->get();
        
        return view('admin.sanpham_yeuthich.index', compact('favorites'));
    }
    
    
    public function getFavoritesCount($productId)
{
    $count = UserFavorite::where('product_id', $productId)->count();
    return response()->json(['count' => $count]);
}




}
