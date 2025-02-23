<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SliderAdminController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SanPhamChiTietController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\TinhTrangController;
use App\Http\Controllers\DonHangController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ChuDeController;
use App\Http\Controllers\BaiVietController;
use App\Http\Controllers\BinhLuanBaiVietController;
use App\Http\Controllers\KhachHangController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\ProductColorController;
use App\Http\Controllers\VaiChamsocController;
use App\Http\Controllers\UserAddressController;

Auth::routes();



// Các trang dành cho khách chưa đăng nhập
Route::name('frontend.')->group(function () {
    // Trang chủ
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Route để hiển thị form liên hệ
    Route::get('/lien-he', [ContactController::class, 'showForm'])->name('contact.form');

    // Route để xử lý dữ liệu từ form liên hệ
    Route::post('/lien-he', [ContactController::class, 'submitForm'])->name('contact.submit');

    Route::get('/baiviet/{tenchude_slug?}', [HomeController::class, 'getBaiViet'])->name('baiviet.chude');
    Route::get('/baiviet/{tenchude_slug}/{tieude_slug}', [HomeController::class, 'getBaiViet_ChiTiet'])->name('baiviet.chitiet');

 

    // Hình ảnh sản phẩm chi tiết
    Route::get('/sanpham/{id}', [SanPhamChiTietController::class, 'show'])->name('sanpham.chitiet');
    Route::get('/sanpham/{id}', [SanPhamChiTietController::class, 'showProduct'])->name('sanpham.chitiet');
    Route::get('/sanpham/{id}/reviews', [ReviewController::class, 'showReviews'])->name('sanpham.chitiet');

    // Các sản phẩm ngẫu nhiên (nếu có API)
    Route::get('/random-products', [AdminProductController::class, 'getRandomProducts']);

    // Shop Nam va nu
    Route::get('/shop-nam', [ShopController::class, 'showTrangPhucChoNam']);
    Route::get('/shop-nu', [ShopController::class, 'showTrangPhucChoNu']);
    Route::get('/shop-phukien', [ShopController::class, 'showPhukien'])->name('Shop.ShopPhukien');
    Route::get('/shop-TreEm', [ShopController::class, 'showTrangPhucChoTre']);

    // Route để lấy danh sách chuyên mục cho dropdown
    Route::get('/chuyen-muc-dropdown', [ChuDeController::class, 'getDanhMucDropdown'])->name('chude.danhmuc.dropdown');
    // Route để lấy bài viết theo chuyên mục
    Route::get('/chuyen-muc/{id}', [ChuDeController::class, 'getBaiVietTheoChuyenMuc'])->name('chude.baiviet');
    // Route hiển thị bài viết chi tiết
    Route::get('/bai-viet/{id}', [BaiVietController::class, 'show'])->name('baiviet.show');

    // tìm kiếm
    Route::get('/categories/{id}', [CategoryController::class, 'showProducts'])->name('categories.showProducts');
    Route::get('/search', [CategoryController::class, 'search'])->name('search');
    Route::get('/trang-phuc-cho-nam/{tagSlug?}', [ShopController::class, 'showTrangPhucChoNam'])->name('shop.trangphucchonam');
    // Định nghĩa route cho việc tìm kiếm sản phẩm theo tag
    Route::get('/tag/{tagId}', [ShopController::class, 'showByTag'])->name('shop.tag');
    Route::get('/shop/tag/{tagId}/women', [ShopController::class, 'showByTagForWomen'])->name('shop.ShopByTagForWomen');
    // Route dành cho Trang Phục Cho Trẻ Em
    Route::get('/shop/kids/tag/{tagId}', [ShopController::class, 'showByTagForKids'])
    ->name('shop.kids.tag');

    // Route dành cho Phụ Kiện
    Route::get('/shop/accessories/tag/{tagId}', [ShopController::class, 'showByTagForAccessories'])
    ->name('shop.accessories.tag');

    // tìm hiểu thêm
    Route::get('/tim-hieu-them', function () {
        return view('frontend.timhieuthem');
    })->name('timhieuthem');

    // bo suu tap
    Route::get('/bosuutap', [SliderAdminController::class, 'index'])->name('Bosuutap.index');
    Route::get('/billboard', [SliderAdminController::class, 'showBillboard'])->name('frontend.billboard-section');

    // Trang giỏ hàng
    Route::get('/gio-hang', [HomeController::class, 'getGioHang'])->name('giohang');
    Route::get('/giohang/them/{id}', [HomeController::class, 'getGioHang_Them'])->name('giohang.them');
    Route::get('/gio-hang/xoa/{row_id}', [HomeController::class, 'getGioHang_Xoa'])->name('giohang.xoa');
    Route::get('/gio-hang/giam/{row_id}', [HomeController::class, 'getGioHang_Giam'])->name('giohang.giam');
    Route::get('/gio-hang/tang/{row_id}', [HomeController::class, 'getGioHang_Tang'])->name('giohang.tang');
    Route::post('/gio-hang/cap-nhat', [HomeController::class, 'postGioHang_CapNhat'])->name('giohang.capnhat');
    Route::get('/gio-hang/get-cart-info', [HomeController::class, 'getCartInfo']);
    Route::post('/giohang/xoa_tat_ca', [HomeController::class, 'clearAll'])->name('giohang.xoa_tat_ca');
});

// Trang khách hàng đăng nhập, đăng ký
Route::get('/khach-hang/dang-ky', [HomeController::class, 'getDangKy'])->name('user.dangky');
Route::get('/khach-hang/dang-nhap', [HomeController::class, 'getDangNhap'])->name('user.dangnhap');
Route::post('/khach-hang/dang-ky-thanh-cong', [HomeController::class, 'postDangKy'])->name('user.postDangKy');
Route::get('/get-colors-sizes/{productId}', [DonHangController::class, 'getColorsAndSizes']);

// Trang tài khoản khách hàng
Route::prefix('khach-hang')->name('user.')->middleware('auth')->group(function () {
    // Trang chủ
    Route::get('/', [KhachHangController::class, 'getHome'])->name('home');
    Route::get('/home', [KhachHangController::class, 'getHome'])->name('home');
    // Đặt hàng
    Route::get('/dat-hang', [KhachHangController::class, 'getDatHang'])->name('dathang');
    Route::post('/dat-hang', [KhachHangController::class, 'postDatHang'])->name('dathang');
    Route::get('/dat-hang-thanh-cong', [KhachHangController::class, 'getDatHangThanhCong'])->name('dathangthanhcong');
    // Xem và cập nhật trạng thái đơn hàng
    Route::get('/don-hang', [KhachHangController::class, 'getDonHang'])->name('donhang');
    Route::get('/don-hang/{id}', [KhachHangController::class, 'getDonHang'])->name('donhang.chitiet');
    Route::post('/don-hang/{id}', [KhachHangController::class, 'postDonHang'])->name('donhang.chitiet');
    // Cập nhật thông tin tài khoản
    Route::get('/ho-so-ca-nhan', [KhachHangController::class, 'getHoSoCaNhan'])->name('hosocanhan');
    Route::post('/ho-so-ca-nhan', [KhachHangController::class, 'postHoSoCaNhan'])->name('hosocanhan');
    // Đăng xuất
    Route::post('/dang-xuat', [KhachHangController::class, 'postDangXuat'])->name('dangxuat');
    //sản phẩm yêu thích
    Route::post('/sanpham/{product}/yeu-thich', [FavoriteController::class, 'toggleFavorite'])->name('sanpham.yeu_thich');
    Route::get('/ho-so-ca-nhan/thich', [KhachHangController::class, 'getSanPhamYeuThich'])->name('thich');
    Route::post('/reviews', [ReviewController::class, 'store']);
    Route::get('/reviews/{productId}', [ReviewController::class, 'index']);
    // xem lại đánh giá
    Route::get('/user/reviews', [ReviewController::class, 'showdanhgia'])->name('danhgia');
    Route::get('/user/danhgia', [ReviewController::class, 'getDanhGia'])->name('danhgia');
    

    Route::post('danh-gia/{productId}', [SanPhamChiTietController::class, 'storeRatingAndComment'])->name('sanpham.danh_gia');

    Route::post('/user/upload-avatar', [AdminUserController::class, 'uploadAvatar'])->name('upload.avatar');
    Route::post('/user/delete-avatar', [AdminUserController::class, 'deleteAvatar'])->name('delete.avatar');
    Route::get('/user/avatar/{userName}', [AdminUserController::class, 'getAvatar'])->name('avatar');


      // Route hiển thị trang địa chỉ người dùng
    Route::get('/address', [UserAddressController::class, 'showAddresses'])->name('address');
    Route::post('/save-address', [UserAddressController::class, 'saveAddress'])->name('saveAddress');
    Route::get('/dia-chi', [UserAddressController::class, 'index'])->name('addresses');
    Route::get('/dia-chi/sua/{id}', [UserAddressController::class, 'editAddress'])->name('editAddress');
    Route::delete('/dia-chi/xoa/{id}', [UserAddressController::class, 'destroy'])->name('deleteAddress');

});

Route::get('/reviews/{productId}', [ReviewController::class, 'showAllReviews'])->name('all_reviews');
Route::post('/reviews/vote/{reviewId}/{voteType}', [ReviewController::class, 'vote'])->name('review.vote');
Route::get('/san-pham/{id}', [SanPhamChiTietController::class, 'vai_chamsoc']);






// Routes Admin
Route::prefix('admin')->middleware('auth')->group(function () {

    // Trang chủ admin
    Route::get('/home', [AdminController::class, 'getHome'])->name('admin.home');

    // Categories Routes
    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'danhsach'])->name('categories.danhsach');
        Route::get('/them', [CategoryController::class, 'them'])->name('categories.them');
        Route::get('/sua/{id}', [CategoryController::class, 'sua'])->name('categories.sua');
        Route::get('/xoa/{id}', [CategoryController::class, 'xoa'])->name('categories.xoa');
        Route::post('/store', [CategoryController::class, 'store'])->name('categories.store');
        Route::put('/sua/{id}', [CategoryController::class, 'update'])->name('categories.update');
    });


    // sản phẩm
    Route::prefix('product')->group(function () {
        Route::get('/', [AdminProductController::class, 'danhsach'])  ->name('product.danhsach');       
        Route::get('/them', [AdminProductController::class, 'them'])->name('product.them');
        Route::get('/sua/{id}', [AdminProductController::class, 'sua']) ->name('product.sua');
        Route::put('/sua/{id}', [AdminProductController::class, 'update'])->name('product.update');
        Route::post('/store', [AdminProductController::class, 'store'])->name('product.store');
        Route::get('/xoa/{id}', [AdminProductController::class, 'xoa'])->name('product.xoa');
    });

    // Slider và bộ sưu tập
    Route::prefix('slider')->group(function () {
        Route::get('/', [SliderAdminController::class, 'danhsach'])->name('slider.danhsach');
        Route::get('/them', [SliderAdminController::class, 'them'])->name('slider.them');
        Route::post('/store', [SliderAdminController::class, 'store'])->name('slider.store');
        Route::get('/sua/{id}', [SliderAdminController::class, 'sua'])->name('slider.sua');
        Route::post('/update/{id}', [SliderAdminController::class, 'update'])->name('slider.update');
        Route::get('/slider/xoa/{id}', [SliderAdminController::class, 'xoa'])->name('slider.xoa');
    });



    // quản lý tài khoản
    Route::prefix('users')->group(function () {
        Route::get('/', [AdminUserController::class, 'danhsach'])->name('users.danhsach');
        Route::get('/them', [AdminUserController::class, 'them'])->name('users.them');
        Route::post('/store', [AdminUserController::class, 'store'])->name('users.store');
        Route::get('/sua/{id}', [AdminUserController::class, 'sua'])->name('users.sua');
        Route::post('/update/{id}', [AdminUserController::class, 'update'])->name('users.update');
        Route::get('/xoa/{id}', [AdminUserController::class, 'xoa'])->name('users.xoa');
    });



    // Quản lý Tình trạng
    Route::prefix('tinhtrang')->group(function () {
        Route::get('/tinhtrang', [TinhTrangController::class, 'getDanhSach'])->name('tinhtrang');
        Route::get('/tinhtrang/them', [TinhTrangController::class, 'getThem'])->name('tinhtrang.them');
        Route::post('/tinhtrang/them', [TinhTrangController::class, 'postThem'])->name('tinhtrang.them');
        Route::get('/tinhtrang/sua/{id}', [TinhTrangController::class, 'getSua'])->name('tinhtrang.sua');
        Route::post('/tinhtrang/sua/{id}', [TinhTrangController::class, 'postSua'])->name('tinhtrang.sua');
        Route::get('/tinhtrang/xoa/{id}', [TinhTrangController::class, 'getXoa'])->name('tinhtrang.xoa');
    });

    // quản lý đơn hàng
    Route::prefix('donhang')->group(function () {
        Route::get('/donhang', [DonHangController::class, 'getDanhSach'])->name('donhang');
        Route::get('/donhang/them', [DonHangController::class, 'getThem'])->name('donhang.them');
        Route::post('/donhang/them', [DonHangController::class, 'postThem'])->name('donhang.them');
        Route::get('/donhang/sua/{id}', [DonHangController::class, 'getSua'])->name('donhang.sua');
        Route::post('/donhang/sua/{id}', [DonHangController::class, 'postSua'])->name('donhang.sua');
        Route::get('/donhang/xoa/{id}', [DonHangController::class, 'getXoa'])->name('donhang.xoa');
    });

    // Quản lý Chủ đề
    Route::get('/chude', [ChuDeController::class, 'getDanhSach'])->name('admin.chude');
    Route::get('/chude/them', [ChuDeController::class, 'getThem'])->name('admin.chude.them');
    Route::post('/chude/them', [ChuDeController::class, 'postThem'])->name('admin.chude.them');
    Route::get('/chude/sua/{id}', [ChuDeController::class, 'getSua'])->name('admin.chude.sua');
    Route::post('/chude/sua/{id}', [ChuDeController::class, 'postSua'])->name('admin.chude.sua');
    Route::get('/chude/xoa/{id}', [ChuDeController::class, 'getXoa'])->name('admin.chude.xoa');

    // Quản lý Bài viết
    Route::get('/baiviet', [BaiVietController::class, 'getDanhSach'])->name('admin.baiviet');
    Route::get('/baiviet/them', [BaiVietController::class, 'getThem'])->name('admin.baiviet.them');
    Route::post('/baiviet/them', [BaiVietController::class, 'postThem'])->name('admin.baiviet.them');
    Route::get('/baiviet/sua/{id}', [BaiVietController::class, 'getSua'])->name('admin.baiviet.sua');
    Route::post('/baiviet/sua/{id}', [BaiVietController::class, 'postSua'])->name('admin.baiviet.sua');
    Route::get('/baiviet/xoa/{id}', [BaiVietController::class, 'getXoa'])->name('admin.baiviet.xoa');
    Route::get('/baiviet/kiemduyet/{id}', [BaiVietController::class, 'getKiemDuyet'])->name('admin.baiviet.kiemduyet');
    Route::get('/baiviet/kichhoat/{id}', [BaiVietController::class, 'getKichHoat'])->name('admin.baiviet.kichhoat');

    // Quản lý Bình luận bài viết
    Route::get('/binhluanbaiviet', [BinhLuanBaiVietController::class, 'getDanhSach'])->name('admin.binhluanbaiviet');
    Route::get('/binhluanbaiviet/them', [BinhLuanBaiVietController::class, 'getThem'])->name('admin.binhluanbaiviet.them');
    Route::post('/binhluanbaiviet/them', [BinhLuanBaiVietController::class, 'postThem'])->name('admin.binhluanbaiviet.them');
    Route::get('/binhluanbaiviet/sua/{id}', [BinhLuanBaiVietController::class, 'getSua'])->name('admin.binhluanbaiviet.sua');
    Route::post('/binhluanbaiviet/sua/{id}', [BinhLuanBaiVietController::class, 'postSua'])->name('admin.binhluanbaiviet.sua');
    Route::get('/binhluanbaiviet/xoa/{id}', [BinhLuanBaiVietController::class, 'getXoa'])->name('admin.binhluanbaiviet.xoa');
    Route::get('/binhluanbaiviet/kiemduyet/{id}', [BinhLuanBaiVietController::class, 'getKiemDuyet'])->name('admin.binhluanbaiviet.kiemduyet');
    Route::get('/binhluanbaiviet/kichhoat/{id}', [BinhLuanBaiVietController::class, 'getKichHoat'])->name('admin.binhluanbaiviet.kichhoat');

    Route::prefix('sizes')->name('sizes.')->group(function() {
        Route::get('/', [SizeController::class, 'index'])->name('index');
        Route::get('/create', [SizeController::class, 'create'])->name('create');
        Route::post('/', [SizeController::class, 'store'])->name('store');
        Route::get('/{sizeId}/edit', [SizeController::class, 'edit'])->name('edit');
        Route::put('/{sizeId}', [SizeController::class, 'update'])->name('update');
        Route::delete('/{sizeId}', [SizeController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('colors')->name('colors.')->group(function() {
        Route::get('/', [ProductColorController::class, 'index'])->name('index');
        Route::get('/create', [ProductColorController::class, 'create'])->name('create');
        Route::post('/store-product-color', [ProductColorController::class, 'store'])->name('store');
        Route::get('/{colorId}/edit', [ProductColorController::class, 'edit'])->name('edit');
        Route::put('/{colorId}', [ProductColorController::class, 'update'])->name('update');
        Route::delete('/{colorId}', [ProductColorController::class, 'destroy'])->name('destroy');
    });
    // Routes cho vai_chamsoc
    Route::prefix('vai_chamsoc')->name('vai_chamsoc.')->group(function() {
        Route::get('/', [VaiChamsocController::class, 'index'])->name('index');
        Route::get('/create', [VaiChamsocController::class, 'create'])->name('create');
        Route::post('/', [VaiChamsocController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [VaiChamsocController::class, 'edit'])->name('edit');
        Route::put('vai-chamsoc/{id}', [VaiChamsocController::class, 'update'])->name('update');
        Route::delete('/{id}', [VaiChamsocController::class, 'destroy'])->name('destroy');
        
  
    });
    // liên hệ
    Route::get('/contacts', [ContactController::class, 'showContacts'])->name('lienhe.danhsach');
    Route::get('/contact/search', [ContactController::class, 'searchContacts']);
    Route::get('admin/user-favorites', [FavoriteController::class, 'index'])->name('sanpham_yeuthich.index');
    Route::get('/yeuthich/sanpham/{productId}/count', [FavoriteController::class, 'getFavoritesCount']);
    
    // bình luận sản phẩm
    Route::get('binhluansanpham', [ReviewController::class, 'indexAdmin'])->name('binhluansanpham.index');




  
     // Route gửi email sau khi đơn hàng được tạo thành công
     Route::post('/gui-email/{donhang_id}', [DonHangController::class, 'guiEmail'])->name('admin.donhang.guiemail');
     
});
Route::get('/get-product-images/{id}', [ProductColorController::class, 'getProductImages']);
