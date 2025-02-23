<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Product;
use App\Models\Size;
use App\Models\ProductColor;
use App\Models\VaiChamsoc;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();  
        Schema::defaultStringLength(191);

        // Composer for categories in the navbar
        View::composer('components.navbar', function ($view) {
            $categories = Category::where('parent_id', 0)
                ->with('subCategories')
                ->get();
            $view->with('categories', $categories);
        });


         // View Composer cho các view có 'product_id'
    View::composer(['admin.size.danhsach', 'admin.size.them', 'admin.size.sua'], function ($view) {
        $productId = request()->route('productId');
        if ($productId) {
            $product = Product::find($productId);
            $view->with('product', $product);
        }
    });


    View::composer('frontend.SanphamChitiet', function ($view) {
        // Truy vấn kích thước của sản phẩm theo category_id
        if (isset($view->featuredProduct)) {
            $sizes = Size::where('category_id', $view->featuredProduct->category_id)->get();
            // Share biến sizes với view
            $view->with('sizes', $sizes);
        }
    });

    
    View::composer('frontend.SanphamChitiet', function ($view) {
        // Lấy sản phẩm hiện tại
        $featuredProduct = $view->getData()['featuredProduct'];
    
        // Lấy màu sắc của sản phẩm này
        $colors = $featuredProduct->colors;
    
        // Duyệt qua từng màu sắc
        foreach ($colors as $color) {
            if ($color->image_path) {
                // Nếu có image_path trong bảng product_colors, lấy ảnh chi tiết từ product_images
                $imageDetails = \App\Models\ProductImage::whereIn('id', explode(',', $color->image_path))->pluck('image_path')->toArray();
            } else {
                // Nếu không có image_path trong bảng product_colors, lấy ảnh chi tiết từ bảng product_images
                $imageDetails = $featuredProduct->productImages->pluck('image_path')->toArray(); // Lấy danh sách đường dẫn ảnh của sản phẩm
            }
            // Chuyển danh sách ảnh thành chuỗi
            $color->imageDetail = implode(',', $imageDetails);
        }
    
        // Truyền dữ liệu vào view
        $view->with('colors', $colors);
    });
    
    
    View::composer('frontend.SanphamChitiet', function ($view) {
        // Lấy sản phẩm hiện tại từ view
        $featuredProduct = $view->getData()['featuredProduct'];
    
        // Khởi tạo chuỗi HTML rỗng
        $htmlVaiChamsoc = '';
    
        // Kiểm tra xem sản phẩm có tồn tại không
        if ($featuredProduct) {
            // Lấy thông tin chăm sóc vải từ bảng vai_chamsoc dựa trên product_id của sản phẩm
            $vaiChamsoc = VaiChamsoc::where('product_id', $featuredProduct->id)->get();
    
            // Tạo HTML từ dữ liệu vaiChamsoc
            if ($vaiChamsoc->count() > 0) {
                foreach ($vaiChamsoc as $vai) {
                    $htmlVaiChamsoc .= "<p><strong>Vải:</strong> {$vai->vai}</p>";
                    $htmlVaiChamsoc .= "<p><strong>Chăm sóc vải:</strong> {$vai->cham_soc_vai}</p>";
                    $htmlVaiChamsoc .= "<p><strong>Trọng lượng vải:</strong> {$vai->trong_luong_vai}</p>";
                    $htmlVaiChamsoc .= "<p><strong>Mã vải:</strong> {$vai->ma_vai}</p>";
                    $htmlVaiChamsoc .= "<hr>"; // Dòng phân cách giữa các thông tin
                }
            } else {
                $htmlVaiChamsoc = '<p>Không có thông tin chăm sóc vải</p>';
            }
        }
    
        // Chia sẻ HTML với view
        $view->with('vaiChamsocHTML', $htmlVaiChamsoc);
    });
    
    }
}
