<div>
    {{ $products->links() }}
</div>

<div class="row">
    @forelse ($products as $product)
        <div class="col-md-3 mb-4">
            <div class="product-item text-center border rounded p-3 shadow-sm">
                <a href="{{ route('frontend.sanpham.chitiet', ['id' => $product->id]) }}" class="text-decoration-none">
                    <div class="product-image position-relative">
                        @if ($product->is_new)
                            <span class="product-badge badge bg-danger text-white position-absolute">Mới</span>
                        @endif
                        <img src="{{ $product->feature_image_path }}" alt="{{ $product->name }}" class="img-fluid rounded">
                    </div>
                    <h5 class="product-name mt-3 text-truncate">{{ $product->name }}</h5>
                </a>
                
                <p class="product-price text-success">{{ number_format($product->price, 0, ',', '.') }} VND</p>
                <div class="text-warning">
                    @php
                        // Tạo số sao ngẫu nhiên giữa 1 và 5
                        $randomRating = rand(1, 5); 
                    @endphp
                
                    @for ($i = 0; $i < 5; $i++)
                        <i class="fas fa-star {{ $i < $randomRating ? 'text-warning' : 'text-muted' }} small-star"></i>
                    @endfor
                
                    <span>({{ $product->reviews_count }} đánh giá)</span>
                </div>
                
                <div class="social-share">
                    <a href="#" class="social-icon" title="Chia sẻ trên Facebook">
                        <i class="fab fa-facebook-square"></i>
                    </a>
                    <a href="#" class="social-icon" title="Chia sẻ trên Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
                
                <!-- Nút thêm vào giỏ -->
                <form action="{{ route('frontend.giohang.them', $product->id) }}" method="GET">
                    @csrf
                    <div class="product-card">
                        <div class="product-info">
                            <!-- Các thông tin khác về sản phẩm như tên, giá... -->
                        </div>
                        <button class="btn btn-success btn-sm btn-buy">
                            <i class="fas fa-shopping-cart"></i> Thêm vào giỏ
                        </button>
                    </div>
                    
                    
                </form>
            </div>
        </div>
    @empty
        <p class="text-center col-12">Chưa có sản phẩm nào!</p>
    @endforelse
</div>
<div>
    {{ $products->links() }}
</div>
<style>
.small-star {
    font-size: 0.9rem; /* Giảm kích thước sao */
    margin-right: 3px; /* Giảm khoảng cách giữa các sao */
    transition: transform 0.3s ease; /* Thêm hiệu ứng khi hover */
}

.small-star:hover {
    transform: scale(1.1); /* Khi hover, sao sẽ phóng to nhẹ */
}

.text-warning {
    color: #ffcc00; /* Màu vàng cho sao vàng */
}
.text-muted {
    color: #d3d3d3; /* Màu xám cho sao mờ */
}
.social-share {
    display: flex;
    gap: 15px; /* Khoảng cách giữa các icon */
    justify-content: center; /* Căn giữa */
    align-items: center; /* Căn giữa theo chiều dọc */
    margin-bottom: 10px;
}

.social-icon {
    font-size: 1.3rem; /* Kích thước icon */
    color: #555; /* Màu sắc của icon */
    transition: all 0.3s ease; /* Thêm hiệu ứng cho mọi thay đổi */
    display: inline-block;
}

.social-icon:hover {
    color: #007bff; /* Màu thay đổi khi hover (cho facebook) */
    transform: scale(1.1); /* Phóng to icon khi hover */
}

.social-icon i {
    transition: transform 0.3s ease; /* Hiệu ứng khi hover vào icon */
}

.social-icon:hover i {
    transform: translateY(-3px); /* Di chuyển icon lên một chút khi hover */
}

    </style>