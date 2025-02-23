<head>
    <link rel="stylesheet" href="{{ asset('frontends/banchay/banchay.css') }}">
</head>

<body>
    <section id="best-sellers" class="best-sellers product-carousel py-5 position-relative overflow-hidden">
        <div class="container">
            <div class="d-flex flex-wrap justify-content-between align-items-center mt-5 mb-3">
                <h4 class="text-uppercase">Các sản phẩm bán chạy nhất</h4>
                <a href="" class="btn-link">Xem tất cả sản phẩm</a>
            </div>
            <div class="swiper product-swiper open-up" data-aos="zoom-out">
                <div class="swiper-wrapper d-flex">
                    @foreach ($products->where('id', '>=', 11)->take(5) as $product)
                        <div class="swiper-slide">
                            <div class="product-item image-zoom-effect link-effect">
                                <div class="image-holder">
                                    <!-- Ảnh chính -->
                                    <a href="{{ route('frontend.sanpham.chitiet', ['id' => $product->id]) }}"
                                        class="main-image">
                                        <img src="{{ asset('storage/' . str_replace(['http://localhost:8001/storage/', 'http://127.0.0.1:8001/storage/'], '', $product->feature_image_path)) }}"
                                            alt="{{ $product->name }}" class="product-image img-fluid"
                                            id="main-image-{{ $product->id }}" loading="lazy">
                                    </a>
                                </div>


                                <div class="product-content">
                                    <h5 class="text-uppercase fs-5 mt-3">
                                        <a href="{{ $product->detail_url }}">{{ $product->name }}</a>
                                    </h5>
                                    <a href="{{ $product->detail_url }}" class="text-decoration-none"
                                        data-after="Nhấn vào xem">
                                        <span>{{ number_format($product->price, 0, ',', '.') }} ₫</span>
                                    </a>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>


</body>
