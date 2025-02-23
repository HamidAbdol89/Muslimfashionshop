<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use App\Models\ProductTag;
use App\Components\Recusive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use App\Traits\StorageImageTrait;

use App\Http\Requests\ProductAddRequest;
use App\Traits\DeleteModelTrait;
use Illuminate\Support\Facades\DB;

class AdminProductController extends Controller
{
    use StorageImageTrait, DeleteModelTrait; 

    private $category;
    private $product;
    private $productImage;

    // Constructor
    public function __construct(Category $category, Product $product, ProductImage $productImage)
    {
        $this->category = $category;
        $this->product = $product;
        $this->productImage = $productImage;
    }

    // Hàm để lấy danh sách sản phẩm (view)
    public function danhsach(Request $request)
{
    // Lấy tất cả sản phẩm cần thiết với các ảnh chi tiết
    $allProducts = Product::with('productImages')->get();

    // Phân loại sản phẩm (cách đúng)
    $newArrivalProducts = Product::whereBetween('id', [1, 10])->with('productImages')->get();
    $bestSellerProducts = Product::whereBetween('id', [11, 16])->with('productImages')->get();

    // Phân trang chỉ cho danh sách sản phẩm chính (nếu cần)
    $paginatedProducts = Product::with('productImages')->paginate(5);

    // Kiểm tra nếu yêu cầu là AJAX
    if ($request->ajax()) {
        return response()->json([
            'data' => view('admin.product.table_product', compact('paginatedProducts'))->render(),
            'pagination' => (string) $paginatedProducts->links()
        ]);
    }

    // Trả về view bình thường với ba danh sách
    return view('admin.product.danhsach', compact('paginatedProducts', 'newArrivalProducts', 'bestSellerProducts'));
}





public function getRandomProducts()
{
    $randomProducts = Product::inRandomOrder()->take(4)->get(); // Lấy 4 sản phẩm ngẫu nhiên
    $randomProducts->each(function ($product) {
        // Tạo URL chi tiết cho mỗi sản phẩm
        $product->detail_url = route('frontend.sanpham.chitiet', ['id' => $product->id]); // Trả về URL chi tiết sản phẩm
    });

    return response()->json($randomProducts); // Trả về danh sách sản phẩm với URL chi tiết
}




    // Hàm để thêm sản phẩm mới (view)
    public function them()
    {
        $htmlOption = $this->getCategory($parentId = '');
        return view('admin.product.them', compact('htmlOption'));
    }

    // Hàm lấy danh sách các danh mục
    public function getCategory($parentId)
    {
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->categoryRecustive($parentId);
        return $htmlOption;
    }

    // Store function to handle product creation
   public function store(ProductAddRequest $request)
{
    // Dữ liệu đã được xác thực
    $data = $request->validated();

    // Dữ liệu tạo sản phẩm
    $dataProductCreate = [
        'name' => $request->name,
        'price' => $request->price,
        'content' => $request->contents ?? 'No content provided',
        'user_id' => auth()->id(),
        'category_id' => $request->category_id,
    ];

    DB::beginTransaction();

    try {
        // Kiểm tra và xử lý ảnh đặc trưng (feature image)
        if ($request->hasFile('feature_image_path')) {
            $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_path', 'product');
            if (!empty($dataUploadFeatureImage)) {
                $firstFile = $dataUploadFeatureImage[0] ?? null;
                if ($firstFile) {
                    $dataProductCreate['feature_image_name'] = $firstFile['file_name'];
                    $dataProductCreate['feature_image_path'] = $firstFile['file_path'];
                }
            }
        }

        // Lưu sản phẩm
        $product = $this->product->create($dataProductCreate);

        // Lưu ảnh chi tiết nếu có
        if ($request->hasFile('image_path')) {
            $dataUploadImages = $this->storageTraitUploadMultiple($request, 'image_path', 'product');
            foreach ($dataUploadImages as $image) {
                $product->images()->create([
                    'image_name' => $image['file_name'],
                    'image_path' => $image['file_path'],
                ]);
            }
        }

        // Thêm tags vào sản phẩm
        if ($request->has('tags') && is_array($request->tags)) {
            $tagIds = [];
            foreach ($request->tags as $tagItem) {
                $tagInstance = Tag::firstOrCreate(['name' => $tagItem]);
                $tagIds[] = $tagInstance->id;
            }

            $product->tags()->sync($tagIds);
        }

        // Commit transaction nếu tất cả thành công
        DB::commit();

        // Chuyển hướng về trang danh sách sản phẩm
        return redirect()->route('product.danhsach')->with('success', 'Sản phẩm đã được tạo thành công!');
    } catch (\Exception $e) {
        // Rollback transaction nếu có lỗi xảy ra
        DB::rollBack();

        return redirect()->route('product.danhsach')->with('error', 'Tạo sản phẩm thất bại.');
    }
}
	
		
		public function sua($id)
		{
			$product = $this->product->find($id);
			$htmlOption = $this->getCategory($product->category_id);
			return view('admin.product.sua', compact('htmlOption', 'product'));
			
		}
		
		public function update(Request $request, $id)
{
    $dataProductUpdate = [
        'name' => $request->name,
        'price' => $request->price,
        'content' => $request->contents ?? 'No content provided',
        'user_id' => auth()->id(),
        'category_id' => $request->category_id,
    ];

    DB::beginTransaction();

    try {
        // Kiểm tra và xử lý ảnh đại diện (feature image)
        if ($request->hasFile('feature_image_path')) {
            $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_path', 'product');
            if (!empty($dataUploadFeatureImage)) {
                $firstFile = $dataUploadFeatureImage[0] ?? null;
                if ($firstFile) {
                    $dataProductUpdate['feature_image_name'] = $firstFile['file_name'];
                    $dataProductUpdate['feature_image_path'] = $firstFile['file_path'];
                }
            }
        }

        // Cập nhật sản phẩm
        $product = $this->product->find($id);
        if (!$product) {
            return redirect()->route('product.danhsach')->with('error', 'Product not found.');
        }

        $product->update($dataProductUpdate);

        // Lưu ảnh chi tiết nếu có
        if ($request->hasFile('image_path')) {
            // Xóa ảnh chi tiết cũ
            $this->productImage->where('product_id', $id)->delete();

            // Tải lên ảnh chi tiết mới
            $dataUploadImages = $this->storageTraitUploadMultiple($request, 'image_path', 'product');
            foreach ($dataUploadImages as $image) {
                $product->images()->create([
                    'image_name' => $image['file_name'],
                    'image_path' => $image['file_path'],
                ]);
            }
        }

        // Thêm hoặc cập nhật tags cho sản phẩm
        if ($request->has('tags') && is_array($request->tags)) {
            $tagIds = [];
            foreach ($request->tags as $tagItem) {
                $tagInstance = Tag::firstOrCreate(['name' => $tagItem]);
                $tagIds[] = $tagInstance->id;
            }

            $product->tags()->sync($tagIds);
        }

        // Commit transaction nếu tất cả thành công
        DB::commit();

        // Chuyển hướng về trang danh sách sản phẩm
        return redirect()->route('product.danhsach')->with('success', 'Cập nhật sản phẩm thành công!');
    } catch (\Exception $e) {
        DB::rollBack();

        return redirect()->route('product.danhsach')->with('error', 'Cập nhật sản phẩm thất bại.');
    }
}

		
		
		public function xoa($id)
{
    return $this->deleteModelTrait($id, $this->product); 
}


	
		
}
