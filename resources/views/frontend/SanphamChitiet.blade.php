@extends('layouts.master')

@section('title', 'Sản phẩm chi tiết')
@section('content')
    <link rel="stylesheet" href="{{ asset('frontends/sanpham_chitiet/chitiet.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <body>
        <!-- Chi Tiết Sản Phẩm -->
        <section class="product-detail">
            <!-- Main image -->
            <div class="main-image">
                <div class="img-magnifier-container">
                    <img id="main-image"
                        src="{{ asset('storage/' . str_replace(['http://localhost:8001/storage/', 'http://127.0.0.1:8001/storage/'], '', $featuredProduct->feature_image_path)) }}"
                        alt="{{ $featuredProduct->name }}">
                    <div class="img-lens"></div> <!-- Div cho lens -->
                </div>
            </div>








            <!-- Thông tin sản phẩm -->
            <div class="info">
                <h1>{{ $featuredProduct->name }}</h1>
                <div class="price-container">
                    <p class="price">{{ $featuredProduct->formatted_price }}</p>
                    <!-- Nút yêu thích -->
                    <form action="{{ route('user.sanpham.yeu_thich', $featuredProduct->id) }}" method="POST" class="inline"
                        id="favorite-form-{{ $featuredProduct->id }}">
                        @csrf
                        <button type="submit" class="btn btn-link" style="background: none; border: none; padding: 0;"
                            onclick="toggleFavorite(event, {{ $featuredProduct->id }})">
                            <!-- Trái tim bo góc SVG -->
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="heart-icon {{ $featuredProduct->isFavorite() ? 'filled' : 'outlined' }}"
                                id="heart-icon-{{ $featuredProduct->id }}" viewBox="0 0 24 24" width="24" height="24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path
                                    d="M12 21C12 21 5 14 5 8C5 5 7 3 9 3C10.5 3 12 4 12 4C12 4 13.5 3 15 3C17 3 19 5 19 8C19 14 12 21 12 21Z">
                                </path>
                            </svg>
                            <!-- Số lượt thích -->
                            <p id="likes-count-{{ $featuredProduct->id }}" class="likes-count">
                                {{ $featuredProduct->favoritess ? $featuredProduct->favoritess->count() : 0 }} lượt thích
                            </p>
                        </button>
                    </form>

                </div>
                <div class="thumbnails">
                    @foreach ($colors as $color)
                        @php
                            // Lấy danh sách ảnh từ imageDetail (chuỗi hoặc mảng)
                            $imageDetails = is_string($color->imageDetail)
                                ? explode(',', $color->imageDetail)
                                : (array) $color->imageDetail; // Đảm bảo là mảng
                        @endphp

                        @if (!empty($imageDetails))
                            <!-- Nếu có danh sách ảnh -->
                            @foreach ($imageDetails as $imagePath)
                                <img src="{{ asset('storage/' . str_replace(['http://localhost:8001/storage/', 'http://127.0.0.1:8001/storage/'], '', $imagePath)) }}"
                                    data-color-name="{{ $color->color }}"
                                    data-color-image="{{ asset('storage/' . str_replace(['http://localhost:8001/storage/', 'http://127.0.0.1:8001/storage/'], '', $imagePath)) }}"
                                    onmouseover="changeMainImage(this)">
                            @endforeach
                        @else
                            <!-- Nếu không có ảnh chi tiết -->
                            <img src="{{ asset('path/to/default-image.jpg') }}" alt="No image available">
                        @endif
                    @endforeach
                </div>
                <p id="selected-color" class="selected-color-text">Chưa chọn màu</p>


                <!-- lấy từ composser size -->
                @if ($sizes->isNotEmpty())
                    <p class="size-title">Chọn Size:</p>
                    <div class="size-options" id="size-options">
                        @foreach ($sizes as $size)
                            <button class="size-btn">
                                {{ $size->size }} - {{ $size->description }}
                            </button>
                        @endforeach
                    </div>
                @else
                    <p class="size-title">Chọn Size:</p>
                    <div class="size-options" id="size-options">
                        <!-- Các nút size sẽ được thêm động tại đây -->
                    </div>
                @endif

                <!-- Thêm Lottie animation vào nút -->
                <form action="{{ route('frontend.giohang.them', $featuredProduct->id) }}" method="GET">
                    <button id="add-to-cart-btn" type="submit"
                        class="relative inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-700 to-red-800 text-white text-sm font-medium rounded-lg shadow-md hover:shadow-lg hover:from-red-600 hover:to-red-700 focus:ring-2 focus:ring-red-300 transition duration-300 ease-in-out transform hover:scale-105">
                        <i class="fas fa-shopping-cart mr-2"></i>
                        Thêm Vào Giỏ
                    </button>
                </form>


                <!-- Kiểm tra nếu sản phẩm thuộc danh mục "Kufi" hoặc "Hijab" và hiển thị hướng dẫn tương ứng -->
                @php
                    $categoryName = $featuredProduct->category->name ?? '';
                @endphp

                @includeWhen($categoryName === 'Kufi', 'user.helpSize')
                @includeWhen($categoryName === 'Hijab', 'user.helpSizeHijab')

                <!-- Xem mô tả -->
                <div class="description-container">
                    <div class="toggle-description" data-target="description">
                        <span class="arrow">&#9660;</span> <!-- Mũi tên xuống -->
                        <span class="description-title">Xem mô tả</span>
                    </div>
                    <p class="description" id="description" style="display: none;">
                        {{ strip_tags($featuredProduct->content) }}</p>
                </div>

                <!-- Thông tin chăm sóc vải -->
                <div class="description-container">
                    <div class="toggle-description">
                        <span class="arrow">&#9660;</span>
                        <span class="description-title">Vải & chăm sóc</span>
                    </div>
                    <div class="description">
                        @if (isset($vaiChamsocHTML) && $vaiChamsocHTML)
                            <div class="vai-info">
                                {!! $vaiChamsocHTML !!}
                            </div>
                        @else
                            <p>Không có thông tin chăm sóc vải</p>
                        @endif
                    </div>
                </div>











                <!-- Vận chuyển & Trả lại -->
                <div class="shipping-container">
                    <div class="toggle-description" data-target="shipping-details">
                        <span class="arrow">&#9660;</span> <!-- Mũi tên xuống -->
                        <span class="description-title">Vận chuyển & Trả lại</span>
                    </div>
                    <p class="description" id="shipping-details" style="display: none;">
                        <strong>Miễn phí vận chuyển</strong><br>
                        - Cho đơn hàng trên 3,600,000₫.<br>
                        - 240,000₫ cho đơn hàng từ 1,800,000₫ - 3,600,000₫.<br>
                        - 360,000₫ cho đơn hàng dưới 1,800,000₫.<br><br>
                        <strong>Trả hàng</strong><br>
                        - Phí vận chuyển trả hàng là 240,000₫ cho mặt hàng đầu tiên và 120,000₫ cho mỗi mặt hàng tiếp
                        theo.<br>
                        - Được phép trả hàng trong vòng 30 ngày kể từ ngày mua.<br>
                        <a href="{{ route('frontend.timhieuthem') }}">Tìm hiểu thêm</a>
                    </p>
                </div>






                @php
                    $user = auth()->user(); // Lấy đối tượng người dùng nếu đã đăng nhập
                    $purchasedProducts = false; // Mặc định là chưa mua sản phẩm
                    if ($user) {
                        // Kiểm tra nếu người dùng đã đăng nhập
                        $purchasedProducts = \App\Models\DonHang::where('user_id', $user->id)
                            ->whereHas('DonHang_ChiTiet', function ($query) use ($featuredProduct) {
                                $query->where('product_id', $featuredProduct->id);
                            })
                            ->where('tinhtrang_id', 1)
                            ->exists();
                    }
                @endphp








                <!-- Social Share Buttons -->

                <div class="social-share">
                    <p class="size-title">Chia sẻ:</p>
                    <div class="sharethis-inline-share-buttons"></div>
                </div>

        </section>

    @section('js')
        <script src="{{ asset('frontends/sanpham_chitiet/chitiet.js') }}"></script>
        <script type="text/javascript"
            src="https://platform-api.sharethis.com/js/sharethis.js#property=676287b01bf8f7001aa8a078&product=inline-share-buttons&source=platform"
            async="async"></script>
        <script type="text/javascript"
            src="https://platform-api.sharethis.com/js/sharethis.js#property=676287b01bf8f7001aa8a078&product=inline-share-buttons&source=platform"
            async="async"></script>
    @endsection

    @if ($purchasedProducts)
        <!-- Card chứa cả đánh giá sao và bình luận, vị trí cố định ở góc phải màn hình -->
        <div class="review-card fixed bottom-4 right-4 bg-white shadow-lg p-4 rounded-md w-80 z-50">
            <button class="close-btn absolute top-2 right-2 text-xl text-gray-500 hover:text-gray-700" id="close-btn">
                <i class="fas fa-times-circle"></i> <!-- Biểu tượng đóng kiểu tròn -->
            </button>

            <h3 class="text-lg font-semibold mb-4">Đánh giá về sản phẩm này</h3>

            <!-- Phần đánh giá sao -->
            <div class="rating mb-4">
                <label class="block text-sm font-semibold mb-2">Đánh giá của bạn:</label>
                <div class="stars mb-2">
                    @for ($i = 1; $i <= 5; $i++)
                        <span class="star" data-index="{{ $i }}"
                            style="color: {{ $i <= ($review->rating ?? 0) ? '#ffcc00' : '#ddd' }};">&#9733;</span>
                    @endfor
                </div>
                <input type="hidden" id="rating-value" value="{{ $review->rating ?? 0 }}">
            </div>


            <!-- Phần bình luận -->
            <form id="review-form" action="{{ route('user.sanpham.danh_gia', $featuredProduct->id) }}" method="POST">
                @csrf
                <div class="form-group mb-4">
                    <label for="comment" class="text-sm">Bình luận:</label>
                    <textarea name="comment" id="comment" rows="4"
                        class="form-control w-full border border-gray-300 rounded-md p-2">{{ $review->comment ?? '' }}</textarea>
                </div>
                <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 w-full">Gửi bình luận</button>
            </form>

        </div>
        <!-- Nút "Mở lại" để mở lại phần đánh giá -->

        <button id="open-btn" onclick="openReviewCard()"
            class="open-btn fixed bottom-4 right-4 bg-blue-500 text-white p-4 rounded-full shadow-lg hover:bg-blue-600 focus:outline-none z-50">
            <i class="fas fa-pencil-alt"></i> <!-- Biểu tượng viết đánh giá -->
        </button>
    @else
        <!-- Nếu không có sản phẩm đã mua, bạn có thể hiển thị thông báo hoặc bỏ qua -->
    @endif
    <script>
        // Lấy phần tử card, nút đóng và nút mở lại
        const reviewCard = document.querySelector('.review-card');
        const closeButton = document.getElementById('close-btn');
        const openButton = document.getElementById('open-btn');

        // Hàm đóng card và ẩn nút mở lại
        closeButton.addEventListener('click', () => {
            reviewCard.style.display = 'none'; // Ẩn card
            openButton.style.display = 'block'; // Hiển thị nút mở lại
        });

        // Hàm mở card và ẩn nút mở lại
        function openReviewCard() {
            reviewCard.style.display = 'block'; // Hiển thị lại card
            openButton.style.display = 'none'; // Ẩn nút mở lại
        }
    </script>

    <script>
        const bubble = document.getElementById('thought-bubble');
        const openButton = document.getElementById('open-btn');

        // Hàm hiển thị đám mây suy nghĩ
        function showBubble() {
            bubble.classList.remove('hidden'); // Hiển thị bubble
            setTimeout(() => {
                bubble.classList.add('hidden'); // Ẩn bubble sau 2 giây
            }, 2000); // Bubble hiển thị trong 2 giây
        }

        // Lặp lại hiển thị bubble mỗi 5 giây
        setInterval(() => {
            showBubble();
        }, 5000);
    </script>

</body>

<!-- Phần view con -->



@section('content')


    <section class="reviews bg-gray-50 py-8 px-4 rounded-lg shadow-lg">
        <h3 class="text-2xl font-semibold text-gray-800 mb-6">Đánh giá và bình luận</h3>
        @if ($reviews->isNotEmpty())
            <a href="{{ route('all_reviews', ['productId' => $reviews->first()->product_id]) }}"
                class="see-all-reviews">Xem tất cả đánh giá</a>
        @else
            <p class="text-gray-500">Chưa có đánh giá cho sản phẩm này.</p>
        @endif

        <div class="review-list space-y-6">
            @foreach ($reviews->take(2) as $review)
                <div class="review bg-white p-6 rounded-md shadow-md hover:shadow-lg transition-shadow">
                    <div class="review-header flex items-center mb-3">
                        <div class="user-avatar w-12 h-12 rounded-full flex items-center justify-center overflow-hidden">
                            <img src="{{ route('user.avatar', ['userName' => $review->user_name]) }}"
                                alt="Avatar của {{ $review->user_name }}"
                                class="w-full h-full object-cover object-center">
                        </div>

                        <div class="user-info ml-4 flex flex-col justify-center">
                            <p class="font-semibold text-gray-800 mb-1">{{ $review->user_name }}</p>
                            <p class="text-sm text-gray-500">{{ $review->created_at->format('d/m/Y') }}</p>
                        </div>
                    </div>
                    <div class="review-body">
                        <div class="rating mb-2">
                            @for ($i = 1; $i <= 5; $i++)
                                <span class="star"
                                    style="color: {{ $i <= $review->rating ? '#ffc107' : '#e4e5e9' }};">&#9733;</span>
                            @endfor
                        </div>
                        <p class="text-gray-700">{{ $review->comment }}</p>
                    </div>
                </div>
            @endforeach
        </div>




    </section>






    <!-- Phần grid card điều hướng shop -->
    @include('frontend.Shop.grid')

    <!-- Sản phẩm liên quan -->
    <section class="related-products">
        <h2>Sản phẩm liên quan</h2>
        <div class="product-grid">
            @foreach ($relatedProducts as $product)
                <div class="product-item">
                    <a href="{{ route('frontend.sanpham.chitiet', $product->id) }}">
                        <img src="{{ asset('storage/' . str_replace(['http://localhost:8001/storage/', 'http://127.0.0.1:8001/storage/'], '', $product->feature_image_path)) }}"
                            alt="{{ $product->name }}">
                        <h3>{{ $product->name }}</h3>
                        <p class="price">{{ $product->formatted_price }}</p>
                    </a>
                </div>
            @endforeach
        </div>
    </section>
@endsection
