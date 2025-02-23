@extends('layouts.master')

<link rel="stylesheet" href="{{ asset('frontends/shop/main.css') }}">
@section('content')
    <div class="container my-5">
        <img src="{{ asset('images/dauthom.jpg') }}" alt="Banner girl" class="w-full h-auto rounded">

        <body>
            <!-- Hiển thị số lượng sản phẩm -->
            <div class="product-count text-center mb-4">
                @if ($totalProducts > 0)
                    <h4>Tìm thấy {{ $totalProducts }} sản phẩm</h4>
                @else
                    <h4>Không tìm thấy sản phẩm nào phù hợp</h4>
                @endif
            </div>

            <div class="tags-container">
                <h3 class="tags-heading">Tags liên quan</h3>
                <div class="tags-list">
                    @foreach ($tags as $tag)
                        @if (strlen($tag->name) > 1 && !is_numeric($tag->name))
                            <!-- Kiểm tra điều kiện không phải là số -->
                            <a href="{{ route('frontend.shop.accessories.tag', ['tagId' => $tag->id]) }}" class="tag-item"
                                data-id="{{ $tag->id }}">
                                {{ $tag->name }}
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
            <!-- Danh sách sản phẩm -->
            <div id="product-list">
                @include('frontend.timkiem.products', ['products' => $products])
            </div>
         </div>
@endsection
</body>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function() {
                    // Xử lý khi người dùng nhấn vào tag
                    $(document).on('click', '.tag-link', function(event) {
                        event.preventDefault(); // Ngừng hành động mặc định của link (tải lại trang)

                        let tagId = $(this).data('id'); // Lấy ID tag từ thuộc tính data-id
                        let url = '/shop/tag/' + tagId; // URL tương ứng với tag đã chọn

                        // Gửi yêu cầu AJAX để lấy sản phẩm tương ứng với tag
                        $.ajax({
                            url: url, // Sử dụng URL từ href để gửi yêu cầu
                            type: 'GET',
                            success: function(response) {
                                // Cập nhật phần nội dung của sản phẩm
                                $('#product-list').html(response
                                .html); // Giả sử bạn có một phần tử có id "product-list" để chứa danh sách sản phẩm
                                $('body').css('cursor', 'default'); // Trả lại con trỏ bình thường
                            },
                            error: function() {
                                alert('Có lỗi xảy ra, vui lòng thử lại!');
                                $('body').css('cursor', 'default');
                            }
                        });
                    });

                    // Xử lý khi người dùng nhấn vào phân trang
                    $(document).on('click', '.pagination a', function(event) {
                        event.preventDefault(); // Ngừng hành động mặc định của link
                        $('body').css('cursor', 'wait'); // Hiển thị con trỏ loading
                        let url = $(this).attr('href'); // Lấy URL của phân trang

                        $.ajax({
                            url: url,
                            type: 'GET',
                            success: function(response) {
                                $('#product-list').html(response.html); // Cập nhật danh sách sản phẩm
                                $('#pagination').html(response.pagination); // Cập nhật phân trang
                                $('body').css('cursor', 'default'); // Trả lại con trỏ bình thường
                            },
                            error: function() {
                                alert('Có lỗi xảy ra, vui lòng thử lại!');
                                $('body').css('cursor', 'default');
                            }
                        });
                    });
                });
            </script>

            <style>
                /* Đảm bảo ảnh banner chiếm toàn bộ chiều rộng và có tỷ lệ thích hợp */
                .w-full {
                    width: 100%;
                    /* Chiếm toàn bộ chiều rộng */
                }

                .h-auto {
                    height: auto;
                    /* Chiều cao tự động để giữ tỷ lệ của ảnh */
                }

                .rounded {
                    border-radius: 8px;
                    /* Góc bo tròn tùy chọn */
                }

                /* Container chứa các tag */
                .tags-container {
                    margin: 20px 0;
                }

                .tags-heading {
                    font-size: 1.5rem;
                    font-weight: bold;
                    color: #333;
                    margin-bottom: 10px;
                }

                /* Danh sách các tag */
                .tags-list {
                    display: flex;
                    flex-wrap: wrap;
                    gap: 10px;
                }

                /* Mỗi tag */
                .tag-item {
                    display: inline-block;
                    background-color: #f0f0f0;
                    color: #333;
                    padding: 8px 15px;
                    font-size: 14px;
                    border-radius: 20px;
                    transition: all 0.3s ease;
                    text-decoration: none;
                    font-weight: 500;
                }

                /* Hiệu ứng hover */
                .tag-item:hover {
                    background-color: #00c3ff;
                    color: #fff;
                    transform: translateY(-3px);
                    /* Hiệu ứng nâng lên khi hover */
                    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                }

                /* Hiệu ứng khi hover vào các tag */
                .tag-item:hover {
                    background-color: #0099cc;
                    color: white;
                    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
                    transition: transform 0.2s ease-in-out;
                    transform: scale(1.1);
                    /* Phóng to khi hover */
                }

                /* Responsive: Nếu màn hình nhỏ, sắp xếp lại các tag */
                @media (max-width: 767px) {
                    .tags-list {
                        justify-content: center;
                    }

                    .tag-item {
                        font-size: 13px;
                        padding: 6px 12px;
                    }
                }
            </style>
