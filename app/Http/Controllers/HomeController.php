<?php

namespace App\Http\Controllers;

use App\Models\ChuDe;
use App\Models\BaiViet;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
{
    $cart = session('cart', []);
    $cartCount = count($cart);
    view()->share('cartCount', $cartCount);
}

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

     public function getDangNhap()
    {
        return view('user.dangnhap');  // Đảm bảo rằng view 'user.dangnhap' tồn tại
    }

    public function getDangKy()
    {
        return view('user.dangky'); 
    }
    public function postDangKy(Request $request)
{
    // Xử lý đăng ký (kiểm tra, lưu người dùng...)
    
    // Sau khi đăng ký thành công, điều hướng đến trang đăng nhập
    return redirect()->route('user.dangnhap')->with('success', 'Đăng ký thành công! Hãy đăng nhập!');
}


     public function getHome()
    {
        $categories = Category::all();
        return view('frontend.home', compact('categories'));
      
    }

    public function getGioHang()
    {
        if (session()->has('cart') && count(session('cart')) > 0) {
            return view('frontend.giohang');
        } else {
            return view('frontend.giohangrong');
        }
    }
    

   public function getGioHang_Them($id)
{
    // Lấy sản phẩm từ cơ sở dữ liệu
    $product = Product::find($id);
    if (!$product) {
        return redirect()->route('frontend.sanpham.index')->with('error', 'Sản phẩm không tồn tại');
    }

    // Kiểm tra giỏ hàng trong session
    $cart = session()->get('cart', []);

    // Nếu sản phẩm đã có trong giỏ, tăng số lượng
    if (isset($cart[$product->id])) {
        $cart[$product->id]['quantity']++;
    } else {
        // Thêm sản phẩm vào giỏ
        $cart[$product->id] = [
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'feature_image_path' => $product->feature_image_path
        ];
    }

    // Cập nhật giỏ hàng vào session
    session()->put('cart', $cart);

    // Chuyển hướng lại trang sản phẩm và thông báo
    return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng');
}

    
    
    

    public function getCartInfo()
{
    $cart = session('cart', []);
    
    // Tính tổng số lượng sản phẩm và tổng giá trị giỏ hàng
    $cartCount = count($cart);
    $totalPrice = 0;
    foreach ($cart as $item) {
        $totalPrice += $item['price'] * $item['quantity'];
    }

    // Trả về dữ liệu giỏ hàng
    return response()->json([
        'cartCount' => $cartCount,
        'totalPrice' => number_format($totalPrice, 0, ',', '.') // Trả về tổng tiền giỏ hàng đã định dạng
    ]);
}

    

public function showCart()
{
    // Lấy tất cả sản phẩm trong giỏ hàng từ session
    $cart = session('cart', []);

    // Truyền giỏ hàng vào view
    return view('frontend.cart', compact('cart'));
}
 


        
    
public function getGioHang_Giam($row_id)
{
    $cart = session()->get('cart', []);

    if (isset($cart[$row_id])) {
        if ($cart[$row_id]['quantity'] > 1) {
            $cart[$row_id]['quantity']--;
        } else {
            unset($cart[$row_id]);
        }

        session()->put('cart', $cart);
    }

    return redirect()->route('frontend.giohang');
}

public function getGioHang_Tang($row_id)
{
    $cart = session()->get('cart', []);
    
    if (isset($cart[$row_id])) {
        $cart[$row_id]['quantity']++;
        session()->put('cart', $cart);
    }

    return redirect()->route('frontend.giohang');
}

public function getGioHang_Xoa($row_id)
{
    $cart = session()->get('cart', []);

    if (isset($cart[$row_id])) {
        unset($cart[$row_id]);
        session()->put('cart', $cart);
    }

    return redirect()->route('frontend.giohang');
}

public function postGioHang_CapNhat(Request $request)
{
    $cart = session()->get('cart', []);
    
    // Cập nhật số lượng cho từng sản phẩm trong giỏ
    foreach ($request->qty as $rowId => $qty) {
        if ($qty < 1) {
            continue;
        }
        $cart[$rowId]['quantity'] = $qty;
    }

    // Tính tổng tiền giỏ hàng
    $totalPrice = 0;
    foreach ($cart as $item) {
        $totalPrice += $item['price'] * $item['quantity'];
    }

    // Lưu giỏ hàng và tổng tiền vào session
    session()->put('cart', $cart);
    session()->put('totalPrice', $totalPrice); // Lưu tổng tiền vào session

    // Quay lại trang giỏ hàng và thông báo thành công
    return redirect()->route('frontend.giohang')->with('success', 'Giỏ hàng đã được cập nhật');
}

public function showPaymentPage()
{
    // Lấy tổng tiền sản phẩm từ giỏ hàng trong session
    $totalPrice = session('totalPrice', 0);  // Lấy tổng tiền từ session

    // Lấy tỷ lệ thuế từ cấu hình
    $taxRate = config('shoppingcart.tax'); // Ví dụ: 10%

    // Tính thuế
    $tax = ($totalPrice * $taxRate) / 100;

    // Tính tổng tiền sau thuế
    $totalPriceWithTax = $totalPrice + $tax;

    // Truyền các giá trị vào view
    return view('frontend.payment', compact('totalPrice', 'tax', 'totalPriceWithTax'));
}




    public function index()
    {
        // Lấy dữ liệu từ các model
        $sliders = Slider::all();
        $categories = Category::where('parent_id', 0)->with('subCategories')->get();
        $products = Product::latest()->take(5)->get();
        $newArrivalProducts = Product::whereBetween('id', [1, 10])->with('productImages')->get();
        $bestSellerProducts = Product::whereBetween('id', [11, 16])->with('productImages')->get();

        // Truyền dữ liệu qua view
        return view('frontend.home', compact('sliders', 'categories', 'products', 'newArrivalProducts', 'bestSellerProducts'));
    }


    public function getBaiViet($tenchude_slug = '')
    {
        if (empty($tenchude_slug)) {
            $title = 'Tin tức';
            $baiviet = BaiViet::where('kichhoat', 1)
                ->where('kiemduyet', 1)
                ->orderBy('created_at', 'desc')
                ->paginate(20);
        } else {
            $chude = ChuDe::where('tenchude_slug', $tenchude_slug)
                ->firstOrFail();
            $title = $chude->tenchude;
            $baiviet = BaiViet::where('kichhoat', 1)
                ->where('kiemduyet', 1)
                ->where('chude_id', $chude->id)
                ->orderBy('created_at', 'desc')
                ->paginate(20);
        }

        return view('frontend.baiviet', compact('title', 'baiviet'));
    }

    public function getBaiViet_ChiTiet($tenchude_slug = '', $tieude_slug = '')
    {
        $tieude_id = explode('.', $tieude_slug);
        $tieude = explode('-', $tieude_id[0]);
        $baiviet_id = $tieude[count($tieude) - 1];

        $baiviet = BaiViet::where('kichhoat', 1)
            ->where('kiemduyet', 1)
            ->where('id', $baiviet_id)
            ->firstOrFail();

        if (!$baiviet) abort(404);

        // Cập nhật lượt xem
        $daxem = 'BV' . $baiviet_id;
        if (!session()->has($daxem)) {
            $orm = BaiViet::find($baiviet_id);
            $orm->luotxem = $baiviet->luotxem + 1;
            $orm->save();
            session()->put($daxem, 1);
        }

        $baivietcungchuyemuc = BaiViet::where('kichhoat', 1)
            ->where('kiemduyet', 1)
            ->where('chude_id', $baiviet->chude_id)
            ->where('id', '!=', $baiviet_id)
            ->orderBy('created_at', 'desc')
            ->take(4)->get();

        return view('frontend.baiviet_chitiet', compact('baiviet', 'baivietcungchuyemuc'));
    }



    public function clearAll(Request $request)
    {
        // Xóa toàn bộ giỏ hàng
        session()->forget('cart');

        // Trả về thông báo thành công
        return redirect()->route('frontend.giohang')->with('success', 'Giỏ hàng đã được xóa');
    }
}
