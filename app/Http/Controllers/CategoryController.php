<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Components\Recusive;
use Illuminate\Support\Str;
use App\Traits\DeleteModelTrait;
use Illuminate\Pagination\Paginator;


class CategoryController extends Controller
{
    use DeleteModelTrait;
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function them()
    {
        $htmlOption = $this->getCategory($parentId = '');
        return view('admin.category.them', compact('htmlOption'));
    }

    public function danhsach(Request $request)
{
    // Xác định số lượng bản ghi mỗi trang
    $perPage = $request->get('perPage', 9);

    try {
        // Lấy danh sách danh mục
        $categories = Category::when($request->has('with_sub'), function ($query) {
            return $query->with('subCategories');
        })->paginate($perPage);

        // Kiểm tra nếu là yêu cầu AJAX
        if ($request->ajax() && $request->expectsJson()) {
            return response()->json([
                'data' => view('admin.category.table_category', compact('categories'))->render(),
                'pagination' => (string) $categories->links()
            ]);
        }

        // Trả về view nếu không phải AJAX
        return view('admin.category.danhsach', compact('categories'));
    } catch (\Exception $e) {
        // Xử lý lỗi
        if ($request->ajax()) {
            return response()->json(['error' => 'Không thể tải danh mục. Vui lòng thử lại.'], 500);
        }

        return back()->with('error', 'Lỗi khi tải danh mục.');
    }
}




    public function store(Request $request)
    {
        $this->category->create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name)
        ]);

        // Gửi thông báo qua session cho JavaScript xử lý
        return redirect()->route('categories.danhsach')->with('success', 'Đã thêm danh mục');
    }

    public function getCategory($parentId)
    {
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->categoryRecustive($parentId);
        return $htmlOption;
    }

    public function sua($id)
    {
        $category = $this->category->find($id);
        $htmlOption = $this->getCategory($category->parent_id);
        return view('admin.category.sua', compact('category', 'htmlOption'));
    }

    public function update($id, Request $request)
    {
        $this->category->find($id)->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name)
        ]);

        // Gửi thông báo qua session
        return redirect()->route('categories.danhsach')->with('success', 'Đã cập nhật danh mục');
    }

    public function xoa($id)
    {
        return $this->deleteModelTrait($id, $this->category);
    }

    // Liên quan đến frontend...

    // show sản phẩm dựa trên tìm kiếm danh mục
    public function showProducts($id)
{
    // Lấy danh mục cha với ID
    $category = Category::findOrFail($id);

    // Lấy tất cả danh mục con của danh mục cha (Dầu thơm)
    $subcategories = Category::where('parent_id', $id)->get();

    // Lấy sản phẩm từ danh mục cha (Dầu thơm) và các danh mục con
    $products = Product::whereIn('category_id', $subcategories->pluck('id')->merge([$category->id]))->get();

    // Trả về view với dữ liệu
    return view('frontend.timkiem.danhmuc', compact('category', 'products'));
}


public function search(Request $request)
{
    $query = $request->input('query');
    $categoryId = $request->input('category_id');

    $productsQuery = Product::where('name', 'LIKE', '%' . $query . '%');
    if ($categoryId) {
        $productsQuery->where('category_id', $categoryId);
    }

    $totalProducts = $productsQuery->count();
    $products = $productsQuery->paginate(12)->appends($request->all());

    if ($request->ajax()) {
        return response()->json([
            'html' => view('frontend.timkiem.products', compact('products'))->render(),
        ]);
    }

    return view('frontend.timkiem.danhmuc', compact('products', 'query', 'totalProducts'));
}






    
}
