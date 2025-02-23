<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Models\Tag;
class ShopController extends Controller
{
    public function showTrangPhucChoNam(Request $request)
    {
        // Lấy danh mục "Trang Phục Cho Nam" có parent_id = 0
        $parentCategory = Category::where('name', 'Trang Phục Cho Nam')
                                      ->where('parent_id', 0)
                                      ->first();
    
        if (!$parentCategory) {
            return "Không tìm thấy danh mục Trang Phục Cho Nam!";
        }
    
        // Lấy tất cả các danh mục con (bao gồm các danh mục có parent_id = $parentCategory->id)
        $categoryIds = Category::where('parent_id', $parentCategory->id)
                                   ->pluck('id')
                                   ->toArray();
    
        // Thêm vào danh mục "Trang Phục Cho Nam" vào danh sách danh mục tìm được
        $categoryIds[] = $parentCategory->id;
    
        // Lấy các tag liên quan đến các sản phẩm trong các danh mục này
        $tags = Tag::whereIn('id', function ($query) use ($categoryIds) {
            $query->select('tag_id')
                  ->from('product_tags')
                  ->join('products', 'products.id', '=', 'product_tags.product_id')
                  ->whereIn('products.category_id', $categoryIds);
        })->get();
    
        // Lọc sản phẩm theo danh mục
        $productsQuery = Product::whereIn('category_id', $categoryIds);
    
        // Lấy tất cả sản phẩm với phân trang
        $products = $productsQuery->paginate(12);
    
        // Tính tổng số sản phẩm
        $totalProducts = $products->total();
    
        // Kiểm tra nếu yêu cầu là AJAX
        if ($request->ajax()) {
            return response()->json([
                'html' => view('frontend.timkiem.products', compact('products', 'totalProducts'))->render(),
                'pagination' => $products->links()->render(),
            ]);
        }
    
        // Trả về view mặc định nếu không phải AJAX
        return view('frontend.Shop.ShopNam', compact('products', 'tags', 'totalProducts'));
    }
    
    
    
    
    
    public function showTrangPhucChoNu(Request $request)
    {
        // Lấy danh mục "Trang Phục Cho Nữ" có parent_id = 0
        $parentCategory = Category::where('name', 'Trang Phục Cho Nữ')
                                  ->where('parent_id', 0)
                                  ->first();
    
        if (!$parentCategory) {
            return "Không tìm thấy danh mục Trang Phục Cho Nữ!";
        }
    
        // Lấy tất cả các danh mục con (bao gồm các danh mục có parent_id = $parentCategory->id)
        $categoryIds = Category::where('parent_id', $parentCategory->id)
                               ->pluck('id')
                               ->toArray();
    
        // Thêm vào danh mục "Trang Phục Cho Nữ" vào danh sách danh mục tìm được
        $categoryIds[] = $parentCategory->id;
    
        // Lấy các tag liên quan đến các sản phẩm trong các danh mục này
        $tags = Tag::whereIn('id', function ($query) use ($categoryIds) {
            $query->select('tag_id')
                  ->from('product_tags')
                  ->join('products', 'products.id', '=', 'product_tags.product_id')
                  ->whereIn('products.category_id', $categoryIds);
        })->get();
    
        // Lọc sản phẩm theo danh mục "Trang Phục Cho Nữ"
        $productsQuery = Product::whereIn('category_id', $categoryIds);
    
        // Lấy tất cả sản phẩm với phân trang
        $products = $productsQuery->paginate(12);
    
        // Tính tổng số sản phẩm
        $totalProducts = $products->total();
    
        // Kiểm tra nếu yêu cầu là AJAX
        if ($request->ajax()) {
            return response()->json([
                'html' => view('frontend.timkiem.products', compact('products', 'totalProducts'))->render(),
                'pagination' => $products->links()->render(),
            ]);
        }
    
        // Trả về view mặc định nếu không phải AJAX
        return view('frontend.Shop.ShopNu', compact('products', 'tags', 'totalProducts'));
    }
    
    
    public function showTrangPhucChoTre(Request $request)
    {
        // Lấy danh mục "Trang Phục Cho Trẻ Em" có parent_id = 0
        $parentCategory = Category::where('name', 'Trang Phục Cho Trẻ Em')
                                  ->where('parent_id', 0)
                                  ->first();
    
        if (!$parentCategory) {
            return "Không tìm thấy danh mục Trang Phục Cho Trẻ Em!";
        }
    
        // Lấy tất cả các danh mục con (bao gồm các danh mục có parent_id = $parentCategory->id)
        $categoryIds = Category::where('parent_id', $parentCategory->id)
                               ->pluck('id')
                               ->toArray();
    
        // Thêm danh mục "Trang Phục Cho Trẻ Em" vào danh sách danh mục tìm được
        $categoryIds[] = $parentCategory->id;
    
        // Lấy các tag liên quan đến các sản phẩm trong các danh mục này
        $tags = Tag::whereIn('id', function ($query) use ($categoryIds) {
            $query->select('tag_id')
                  ->from('product_tags')
                  ->join('products', 'products.id', '=', 'product_tags.product_id')
                  ->whereIn('products.category_id', $categoryIds);
        })->get();
    
        // Lọc sản phẩm theo danh mục
        $productsQuery = Product::whereIn('category_id', $categoryIds);
    
        // Lấy tất cả sản phẩm với phân trang
        $products = $productsQuery->paginate(12);
    
        // Tính tổng số sản phẩm
        $totalProducts = $products->total();
    
        // Kiểm tra nếu yêu cầu là AJAX
        if ($request->ajax()) {
            return response()->json([
                'html' => view('frontend.timkiem.products', compact('products', 'totalProducts'))->render(),
                'pagination' => $products->links()->render(),
            ]);
        }
    
        // Trả về view mặc định nếu không phải AJAX
        return view('frontend.Shop.ShopTreEm', compact('products', 'tags', 'totalProducts'));
    }
    

    public function showPhukien(Request $request)
    {
        // Lấy danh mục "Dầu thơm" có parent_id = 0
        $parentCategory = Category::where('name', 'Dầu thơm')
                                  ->where('parent_id', 0)
                                  ->first();
    
        if (!$parentCategory) {
            return "Không tìm thấy danh mục Dầu thơm!";
        }
    
        // Lấy tất cả các danh mục con (bao gồm các danh mục có parent_id = $parentCategory->id)
        $categoryIds = Category::where('parent_id', $parentCategory->id)
                               ->pluck('id')
                               ->toArray();
    
        // Thêm danh mục "Dầu thơm" vào danh sách danh mục tìm được
        $categoryIds[] = $parentCategory->id;
    
        // Lấy các tag liên quan đến các sản phẩm trong các danh mục này
        $tags = Tag::whereIn('id', function ($query) use ($categoryIds) {
            $query->select('tag_id')
                  ->from('product_tags')
                  ->join('products', 'products.id', '=', 'product_tags.product_id')
                  ->whereIn('products.category_id', $categoryIds);
        })->get();
    
        // Lọc sản phẩm theo danh mục
        $productsQuery = Product::whereIn('category_id', $categoryIds);
    
        // Lấy tất cả sản phẩm với phân trang
        $products = $productsQuery->paginate(12);
    
        // Tính tổng số sản phẩm
        $totalProducts = $products->total();
    
        // Kiểm tra nếu yêu cầu là AJAX
        if ($request->ajax()) {
            return response()->json([
                'html' => view('frontend.timkiem.products', compact('products', 'totalProducts'))->render(),
                'pagination' => $products->links()->render(),
            ]);
        }
    
        // Trả về view mặc định nếu không phải AJAX
        return view('frontend.Shop.ShopPhukien', compact('products', 'tags', 'totalProducts'));
    }
    

    public function showByTag(Request $request, $tagId)
    {
        // Lấy tag theo ID
        $tag = Tag::find($tagId);
    
        if (!$tag) {
            return redirect()->route('frontend.shop.index')->with('error', 'Tag không tồn tại!');
        }
    
        // Lấy các sản phẩm có tag tương ứng
        $products = Product::whereHas('tags', function ($query) use ($tagId) {
            $query->where('tag_id', $tagId);
        })->paginate(12);
    
        // Khởi tạo biến tags là một collection rỗng mặc định
        $tags = collect();
    
        // Lấy danh mục "Trang Phục Cho Nam" nếu có
        $categoryNam = Category::where('name', 'Trang Phục Cho Nam')->first();
        if ($categoryNam) {
            $categoryNamId = $categoryNam->id;
    
            // Lấy tất cả các tag của sản phẩm trong danh mục "Trang Phục Cho Nam"
            $tagsOfMenProducts = Tag::whereIn('id', function ($query) use ($categoryNamId) {
                $query->select('tag_id')
                      ->from('product_tags')
                      ->join('products', 'products.id', '=', 'product_tags.product_id')
                      ->where('products.category_id', $categoryNamId);
            })->get();
    
            // Kết hợp các tags vào biến $tags
            $tags = $tags->merge($tagsOfMenProducts);
        }
    
        // Lấy các tag liên quan đến tag hiện tại
        $relatedTags = Tag::whereIn('id', function ($query) use ($tagId) {
            $query->select('tag_id')
                  ->from('product_tags')
                  ->join('products', 'products.id', '=', 'product_tags.product_id')
                  ->whereIn('products.id', function($subquery) use ($tagId) {
                      $subquery->select('product_id')
                               ->from('product_tags')
                               ->where('tag_id', $tagId);
                  });
        })->get();
    
        // Kết hợp các tags vào biến $tags
        $tags = $tags->merge($relatedTags);
    
        // Loại bỏ các tags trùng
        $tags = $tags->unique('id');
    
        // Tính tổng số sản phẩm
        $totalProducts = $products->total();
    
        // Nếu là yêu cầu AJAX
        if ($request->ajax()) {
            return response()->json([
                'html' => view('frontend.timkiem.products', compact('products', 'totalProducts'))->render(),
                'pagination' => $products->links()->render(),
            ]);
        }
    
        // Trả về view mặc định nếu không phải AJAX
        return view('frontend.Shop.ShopNam', [
            'products' => $products,
            'tags' => $tags,  // Truyền biến $tags vào view
            'totalProducts' => $totalProducts
        ]);
    }
    
    

    // tag cho phụ nữ
    public function showByTagForWomen(Request $request, $tagId)
{
    // Lấy tag theo ID
    $tag = Tag::find($tagId);

    if (!$tag) {
        return redirect()->route('frontend.shop.index')->with('error', 'Tag không tồn tại!');
    }

    // Lấy các sản phẩm có tag tương ứng
    $products = Product::whereHas('tags', function ($query) use ($tagId) {
        $query->where('tag_id', $tagId);
    })->paginate(12);

    // Khởi tạo biến tags là một collection rỗng mặc định
    $tags = collect();

    // Lấy danh mục "Trang Phục Cho Nữ" nếu có
    $categoryNu = Category::where('name', 'Trang Phục Cho Nữ')->first();
    if ($categoryNu) {
        $categoryNuId = $categoryNu->id;

        // Lấy tất cả các tag của sản phẩm trong danh mục "Trang Phục Cho Nữ"
        $tagsOfWomenProducts = Tag::whereIn('id', function ($query) use ($categoryNuId) {
            $query->select('tag_id')
                  ->from('product_tags')
                  ->join('products', 'products.id', '=', 'product_tags.product_id')
                  ->where('products.category_id', $categoryNuId);
        })->get();

        // Kết hợp các tags vào biến $tags
        $tags = $tags->merge($tagsOfWomenProducts);
    }

    // Lấy các tag liên quan đến tag hiện tại
    $relatedTags = Tag::whereIn('id', function ($query) use ($tagId) {
        $query->select('tag_id')
              ->from('product_tags')
              ->join('products', 'products.id', '=', 'product_tags.product_id')
              ->whereIn('products.id', function($subquery) use ($tagId) {
                  $subquery->select('product_id')
                           ->from('product_tags')
                           ->where('tag_id', $tagId);
              });
    })->get();

    // Kết hợp các tags vào biến $tags
    $tags = $tags->merge($relatedTags);

    // Loại bỏ các tags trùng
    $tags = $tags->unique('id');

    // Tính tổng số sản phẩm
    $totalProducts = $products->total();

    // Nếu là yêu cầu AJAX
    if ($request->ajax()) {
        return response()->json([
            'html' => view('frontend.timkiem.products', compact('products', 'totalProducts'))->render(),
            'pagination' => $products->links()->render(),
        ]);
    }

    // Trả về view mặc định nếu không phải AJAX
    return view('frontend.Shop.ShopNu', [
        'products' => $products,
        'tags' => $tags,  // Truyền biến $tags vào view
        'totalProducts' => $totalProducts
    ]);
}



public function showByTagForKids(Request $request, $tagId)
{
    // Lấy tag theo ID
    $tag = Tag::find($tagId);

    if (!$tag) {
        return redirect()->route('frontend.shop.index')->with('error', 'Tag không tồn tại!');
    }

    // Lấy các sản phẩm có tag tương ứng
    $products = Product::whereHas('tags', function ($query) use ($tagId) {
        $query->where('tag_id', $tagId);
    })->paginate(12);

    // Khởi tạo biến tags là một collection rỗng mặc định
    $tags = collect();

    // Lấy danh mục "Trang Phục Cho Trẻ Em" nếu có
    $categoryTreEm = Category::where('name', 'Trang Phục Cho Trẻ Em')->first();
    if ($categoryTreEm) {
        $categoryTreEmId = $categoryTreEm->id;

        // Lấy tất cả các tag của sản phẩm trong danh mục "Trang Phục Cho Trẻ Em"
        $tagsOfChildrenProducts = Tag::whereIn('id', function ($query) use ($categoryTreEmId) {
            $query->select('tag_id')
                  ->from('product_tags')
                  ->join('products', 'products.id', '=', 'product_tags.product_id')
                  ->where('products.category_id', $categoryTreEmId);
        })->get();

        // Kết hợp các tags vào biến $tags
        $tags = $tags->merge($tagsOfChildrenProducts);
    }

    // Lấy các tag liên quan đến tag hiện tại
    $relatedTags = Tag::whereIn('id', function ($query) use ($tagId) {
        $query->select('tag_id')
              ->from('product_tags')
              ->join('products', 'products.id', '=', 'product_tags.product_id')
              ->whereIn('products.id', function($subquery) use ($tagId) {
                  $subquery->select('product_id')
                           ->from('product_tags')
                           ->where('tag_id', $tagId);
              });
    })->get();

    // Kết hợp các tags vào biến $tags
    $tags = $tags->merge($relatedTags);

    // Loại bỏ các tags trùng
    $tags = $tags->unique('id');

    // Tính tổng số sản phẩm
    $totalProducts = $products->total();

    // Nếu là yêu cầu AJAX
    if ($request->ajax()) {
        return response()->json([
            'html' => view('frontend.timkiem.products', compact('products', 'totalProducts'))->render(),
            'pagination' => $products->links()->render(),
        ]);
    }

    // Trả về view mặc định nếu không phải AJAX
    return view('frontend.Shop.ShopTreEm', [
        'products' => $products,
        'tags' => $tags,  // Truyền biến $tags vào view
        'totalProducts' => $totalProducts
    ]);
}

public function showByTagForAccessories(Request $request, $tagId)
{
    // Lấy tag theo ID
    $tag = Tag::find($tagId);

    if (!$tag) {
        return redirect()->route('frontend.shop.index')->with('error', 'Tag không tồn tại!');
    }

    // Lấy các sản phẩm có tag tương ứng
    $products = Product::whereHas('tags', function ($query) use ($tagId) {
        $query->where('tag_id', $tagId);
    })->paginate(12);

    // Khởi tạo biến tags là một collection rỗng mặc định
    $tags = collect();

    // Lấy danh mục "Phụ Kiện" nếu có
    $categoryPhuKien = Category::where('name', 'Phụ Kiện')->first();
    if ($categoryPhuKien) {
        $categoryPhuKienId = $categoryPhuKien->id;

        // Lấy tất cả các tag của sản phẩm trong danh mục "Phụ Kiện"
        $tagsOfAccessoryProducts = Tag::whereIn('id', function ($query) use ($categoryPhuKienId) {
            $query->select('tag_id')
                  ->from('product_tags')
                  ->join('products', 'products.id', '=', 'product_tags.product_id')
                  ->where('products.category_id', $categoryPhuKienId);
        })->get();

        // Kết hợp các tags vào biến $tags
        $tags = $tags->merge($tagsOfAccessoryProducts);
    }

    // Lấy các tag liên quan đến tag hiện tại
    $relatedTags = Tag::whereIn('id', function ($query) use ($tagId) {
        $query->select('tag_id')
              ->from('product_tags')
              ->join('products', 'products.id', '=', 'product_tags.product_id')
              ->whereIn('products.id', function($subquery) use ($tagId) {
                  $subquery->select('product_id')
                           ->from('product_tags')
                           ->where('tag_id', $tagId);
              });
    })->get();

    // Kết hợp các tags vào biến $tags
    $tags = $tags->merge($relatedTags);

    // Loại bỏ các tags trùng
    $tags = $tags->unique('id');

    // Tính tổng số sản phẩm
    $totalProducts = $products->total();

    // Nếu là yêu cầu AJAX
    if ($request->ajax()) {
        return response()->json([
            'html' => view('frontend.timkiem.products', compact('products', 'totalProducts'))->render(),
            'pagination' => $products->links()->render(),
        ]);
    }

    // Trả về view mặc định nếu không phải AJAX
    return view('frontend.Shop.ShopPhuKien', [
        'products' => $products,
        'tags' => $tags,  // Truyền biến $tags vào view
        'totalProducts' => $totalProducts
    ]);
}

    
    

    
}
