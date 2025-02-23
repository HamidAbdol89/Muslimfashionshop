<section id="related-products" class="related-products product-carousel py-5 position-relative overflow-hidden">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-between align-items-center mt-5 mb-3">
            <h4 class="text-uppercase">Sản phẩm bạn có thể thích</h4>
            <a href="index.html" class="btn-link">Xem tất cả sản phẩm</a>
        </div>

        <div class="swiper product-swiper open-up" data-aos="zoom-out">
            <div class="swiper-wrapper d-flex" id="random-products-list">
                <!-- Duyệt qua các sản phẩm và hiển thị -->
                @foreach($products as $product)
                    <div class="swiper-slide">
                        <div class="product-item image-zoom-effect link-effect" data-product-id="{{ $product->id }}">
                            <div class="image-holder">
                                <a href="{{ $product->detail_url }}">
                                    <img src="{{ $product->feature_image_path }}" alt="{{ $product->name }}" class="product-image img-fluid">
                                </a>
                                <button class="btn-icon btn-wishlist" data-product-id="{{ $product->id }}">
                                    <svg width="24" height="24" viewBox="0 0 24 24">
                                        <use xlink:href="#heart"></use>
                                    </svg>
                                </button>
                                
                                <div class="product-content">
                                    <h5 class="text-uppercase fs-5 mt-3">
                                        <a href="{{ $product->detail_url }}">{{ $product->name }}</a>
                                    </h5>
                                    <form action="{{ route('frontend.giohang.them', $product->id) }}" method="GET">
                                        @csrf  <!-- Thêm CSRF token -->
                                        <button type="submit" class="btn btn-primary" data-after="nhấn vào xem">
                                            <span>{{ number_format($product->price, 0, ',', '.') }} ₫</span>
                                            Nhấn vào để xem chi tiêt
                                        </button>
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>

<script src="{{ asset('frontends/Cothethich_Sanpham/api.js') }}" defer></script>
<style>
    /* Cố định kích thước ảnh sản phẩm trong phần Hàng Mới */
    #related-products .product-item .image-holder .product-image {
        width: 300px;
        height: 450px;
        object-fit: cover; /* Đảm bảo ảnh không bị biến dạng */
    }

</style>