@extends('layouts.master')

<link rel="stylesheet" href="{{ asset('frontends/danhmuc/danhmuc.css') }}">

<body>
    @section('content')
        <div class="container my-5">
<!-- Tiêu đề và Banner -->
<div class="text-center mb-4">
 
      
            <!-- Hiển thị banner tùy theo từ khóa tìm kiếm hoặc danh mục -->
            @if (str_contains(strtolower($query), 'hijab'))
                <img src="{{ asset('images/bannerhijab.jpg') }}" alt="Banner hijab" class="w-full h-auto rounded">
            @elseif (str_contains(strtolower($query), 'abaya'))
                <img src="{{ asset('images/bannerabaya.jpg') }}" alt="Banner abaya" class="w-full h-auto rounded">
            @elseif (str_contains(strtolower($query), 'jubah'))
                <img src="{{ asset('images/bannerjubba.jpg') }}" alt="Banner jubah" class="w-full h-auto rounded">
            @elseif (str_contains(strtolower($query), 'thobe'))
                <img src="{{ asset('images/bannerthobe.jpg') }}" alt="Banner thobe" class="w-full h-auto rounded">
            @elseif (str_contains(strtolower($query), 'jilbab'))
                <img src="{{ asset('images/bannerjilbab.jpg') }}" alt="Banner jilbab" class="w-full h-auto rounded">
            @elseif (str_contains(strtolower($query), 'kufi'))
                <img src="{{ asset('images/bannerkufi.jpg') }}" alt="Banner kufi" class="w-full h-auto rounded">
        
            @elseif (str_contains(strtolower($query), 'Dầu thơm'))
                <img src="{{ asset('images/dauthom.jpg') }}" alt="Banner dauthom" class="w-full h-auto rounded">
    
            
            @elseif (str_contains(strtolower($query), 'niquab'))
                <img src="{{ asset('images/bannerniqab.jpg') }}" alt="Banner niquab" class="w-full h-auto rounded">
            @elseif (str_contains(strtolower($query), 'niqab'))
                <img src="{{ asset('images/banner-dress.jpg') }}" alt="Banner dress" class="w-full h-auto rounded">
            @else
                <!-- Banner mặc định cho các tìm kiếm không có liên quan đến danh mục cụ thể -->
                <img src="{{ asset('images/default-search-banner.jpg') }}" alt="Banner tìm kiếm" class="w-full h-auto rounded">
            @endif

</div>

<style>
    /* Đảm bảo ảnh banner chiếm toàn bộ chiều rộng và có tỷ lệ thích hợp */
    .w-full {
        width: 100%; /* Chiếm toàn bộ chiều rộng */
    }
    
    .h-auto {
        height: auto; /* Chiều cao tự động để giữ tỷ lệ của ảnh */
    }

    .rounded {
        border-radius: 8px; /* Góc bo tròn tùy chọn */
    }

    /* Đảm bảo banner có chiều cao cố định và không bị biến dạng */
    .banner-image {
        width: 100%; /* Chiếm toàn bộ chiều rộng */
        height: 300px; /* Đặt chiều cao cho banner */
        object-fit: cover; /* Đảm bảo ảnh chiếm hết không gian mà không bị méo */
        object-position: center; /* Căn giữa ảnh */
    }

    /* Media query cho màn hình lớn hơn */
    @media (min-width: 1024px) {
        .banner-image {
            height: 400px; /* Điều chỉnh chiều cao khi ở trên màn hình lớn */
        }
    }
</style>

<!-- Hiển thị số lượng sản phẩm -->
<div class="product-count text-center mb-4">
    @if($totalProducts > 0)
        <h4>Tìm thấy {{ $totalProducts }} sản phẩm</h4>
    @else
        <h4>Không tìm thấy sản phẩm nào phù hợp</h4>
    @endif
   
</div>



            <!-- Danh sách sản phẩm -->
            <div id="product-list">
                @include('frontend.timkiem.products', ['products' => $products])
            </div>
            
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).on('click', '.pagination a', function(event) {
                    event.preventDefault();
                    $('body').css('cursor', 'wait'); // Hiển thị con trỏ loading
                    let url = $(this).attr('href');
            
                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function(response) {
                            $('#product-list').html(response.html);
                            $('body').css('cursor', 'default'); // Trả lại con trỏ bình thường
                        },
                        error: function() {
                            alert('Có lỗi xảy ra, vui lòng thử lại!');
                            $('body').css('cursor', 'default');
                        }
                    });
                });
            </script>
            
        </div>
        
    @endsection

</body>
