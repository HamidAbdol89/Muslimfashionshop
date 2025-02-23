<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="TemplatesJungle">
    <meta name="keywords" content="ecommerce,fashion,store">
    <meta name="description" content="Bootstrap 5 Fashion Store HTML CSS Template">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Trang chủ')</title>

    <!-- Preconnect to external resources to optimize connection -->
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&family=Marcellus&display=swap" rel="stylesheet">
    
    <!-- CSS -->
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/vendor.css') }}">
    <link rel="stylesheet" href="{{ asset('frontends/navbar/navbar.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('home/home.css') }}">
    
    @yield('css')
</head>

<body>

 <!-- Navbar -->
 <nav class="navbar navbar-expand-lg bg-light text-uppercase fs-6 p-3 border-bottom align-items-center">
    <div class="container-fluid">
        <div class="row justify-content-between align-items-center w-100">
            <!-- Logo -->
            <div class="col-auto">
                <a class="navbar-brand text-white" href="/">
                    <svg width="200" height="100" viewBox="0 0 200 100" xmlns="http://www.w3.org/2000/svg" fill="#111">
                        <text x="10" y="60" font-family="Arial, sans-serif" font-size="30" fill="#111">HakimShop</text>
                    </svg>
                </a>
            </div>

            <!-- Toggler & Offcanvas -->
            <div class="col-auto">
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 gap-1 gap-md-5 pe-3">
                            <button id="toggleDarkMode">
                                <i class="fas fa-sun"></i>  <!-- Mặt trời, dùng cho chế độ sáng -->
                            </button>
                            

                            <!-- Trang chủ -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle active" href="#" id="dropdownHome" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Trang chủ</a>
                                <ul class="dropdown-menu list-unstyled" aria-labelledby="dropdownHome">
                                    <li><a href="{{ route('frontend.Bosuutap.index') }}" class="dropdown-item item-anchor">Bộ sưu tập mới</a></li>
                                    <li><a href="#" class="dropdown-item item-anchor" onclick="scrollToNewArrivals()">Hàng mới</a></li>
                                    <li><a href="#" class="dropdown-item item-anchor" onclick="scrollToBestSellers()">Sản phẩm bán chạy</a></li>
                                    <li><a href="#" class="dropdown-item item-anchor" onclick="scrollToRelatedProducts()">Sản phẩm có thể thích</a></li>
                                </ul>
                            </li>

                            <!-- Shop -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="dropdownShop" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Shop</a>
                                <ul class="dropdown-menu list-unstyled" aria-labelledby="dropdownShop">
                                    <li><a href="{{ asset('/shop-nam') }}" class="dropdown-item item-anchor">Trang Phục Nam</a></li>
                                    <li><a href="{{ asset('/shop-nu') }}" class="dropdown-item item-anchor">Trang Phục Nữ</a></li>
                                    <li><a href="{{ asset('/shop-TreEm') }}" class="dropdown-item item-anchor">Trang Phục Trẻ Em</a></li>
                                    <li><a href="{{ asset('/shop-phukien') }}" class="dropdown-item item-anchor">Phụ Kiện</a></li>
                                    <li><a href="{{ asset('/shop-phukien') }}" class="dropdown-item item-anchor">Dầu thơm</a></li>
                                </ul>
                            </li>

                            <!-- Blog -->
                            <li class="nav-item"><a class="nav-link" href="{{ route('frontend.baiviet.chude') }}">Blog</a></li>

                            <!-- Liên hệ -->
                            <li class="nav-item"><a class="nav-link" href="{{ route('frontend.contact.form') }}" onclick="loadContactForm()">Liên hệ</a></li>

                            <!-- Search -->
                            <li class="search-box mx-2">
                                <form action="{{ route('frontend.search') }}" method="GET" class="d-flex">                               
                                    <button type="button" class="search-button">
                                        <i class="fas fa-search"></i> 
                                    </button>
                                </form>
                            </li>

                            @guest
                            <a class="navbar-tool ms-1 ms-lg-0 me-n1 me-lg-2" href="{{ route('user.dangnhap') }}">
                                <div class="greeting">
                                    <i class="navbar-tool-icon ci-user"></i>
                                </div>
                                <div class="greeting">
                                    <small>Xin chào</small>&nbsp;<span>Khách hàng</span>
                                </div>
                            </a>
                        @else
                            <a class="navbar-tool ms-1 ms-lg-0 me-n1 me-lg-2" href="{{ route('user.hosocanhan') }}">
                                <div class="greeting">
                                    <i class="navbar-tool-icon ci-user"></i>
                                </div>
                                <div class="greeting">
                                    <small>Xin chào</small>&nbsp;<span>{{ Auth::user()->name }}</span>
                                </div>
                            </a>
                        @endguest
                        

                            <div class="navbar-tool ms-3">
                                <!-- Biểu tượng giỏ hàng với số lượng -->
                                <a class="navbar-tool-icon-box" href="{{ route('frontend.giohang') }}">
                                    <i class="fas fa-shopping-cart text-xl text-black"></i> <!-- Icon giỏ hàng với màu đen -->
                                    <span id="cart-count" class="text-xs text-black font-bold ml-2">
                                        {{ session('cart') ? array_sum(array_column(session('cart'), 'quantity')) : 0 }}
                                    </span>
                                </a>
                                <a class="navbar-tool-text text-black ml-2" href="{{ route('frontend.giohang') }}">
                                    <small class="text-sm">Giỏ hàng</small>
                                    <span id="cart-total" class="font-semibold text-lg">
                                        @if(session('cart') && count(session('cart')) > 0)
                                            {{ number_format(Cart::priceTotal(), 0, ',', '.') }} đ
                                        @else
                                            Chưa có sản phẩm
                                        @endif
                                    </span>
                                    <span id="cart-count" class="cart-count-animate">
                                        @if(session('cart') && count(session('cart')) > 0)
                                            {{ count(session('cart')) }}
                                        @else
                                            0
                                        @endif
                                    </span>
                                </a>
                                
                                
                            </div>
                            
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

    <!-- Overlay -->
    <div id="overlay" class="overlay" style="display: none;"></div>

    <!-- Content -->
    @include('frontend.search-popup')
    @yield('content')
    @include('frontend.footer')

    <!-- Scripts -->
    <script src="{{ asset('js/jquery.min.js') }}" defer></script>
    <script src="{{ asset('js/plugins.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js" defer></script>
    <script src="{{ asset('js/script.min.js') }}" defer></script>
    <script src="{{ asset('frontends/navbar/navbar.js') }}" defer></script>
    <script src="{{ asset('home/home.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@lottiefiles/lottie-player@1.4.0/dist/lottie-player.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0-alpha1/js/bootstrap.bundle.min.js" defer></script>  
    <script src="{{ asset('frontends/giohang/giohang.js') }}" defer></script>
   

    @yield('js')
</body>

</html>
