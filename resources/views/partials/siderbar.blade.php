<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
            <div class="image">
                <img src="{{ asset('adminlte/dist/img/hamidkin.jpg') }}" class="img-circle elevation-2" alt="User Image"
                    style="border: 2px solid #00aaff;">
            </div>
            <div class="info">
                <a href="#" class="d-block text-white font-weight-bold"
                    style="font-family: 'Poppins', sans-serif;">
                    {{ Auth::user()->name }}
                </a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Tìm kiếm..."
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Danh mục sản phẩm -->
                @include('layouts.sidebar-item', [
                    'route' => 'categories.danhsach',
                    'iconClass' => 'fas fa-list text-blue',
                    'title' => 'Danh mục sản phẩm',
                ])

                <!-- Sản phẩm -->
                @include('layouts.sidebar-item', [
                    'route' => 'product.danhsach',
                    'iconClass' => 'fas fa-box text-green',
                    'title' => 'Sản phẩm',
                ])

                <!-- Size -->
                @include('layouts.sidebar-item', [
                    'route' => 'sizes.index',
                    'iconClass' => 'fas fa-ruler text-purple',
                    'title' => 'Size',
                ])

                <!-- color -->
                @include('layouts.sidebar-item', [
                    'route' => 'colors.index',
                    'iconClass' => 'fas fa-palette text-indigo',
                    'title' => 'Color',
                ])

                <!-- vải & chăm sóc -->
                @include('layouts.sidebar-item', [
                    'route' => 'vai_chamsoc.index',
                    'iconClass' => 'fas fa-tshirt text-red',
                    'title' => 'Vải & Chăm sóc',
                ])

                <!-- Slider -->
                @include('layouts.sidebar-item', [
                    'route' => 'slider.danhsach',
                    'iconClass' => 'fas fa-images text-orange',
                    'title' => 'Slider',
                ])

                <!-- Users -->
                @include('layouts.sidebar-item', [
                    'route' => 'users.danhsach',
                    'iconClass' => 'fas fa-user-friends text-pink',
                    'title' => 'Danh sách tài khoản',
                ])

                <!-- Tình trạng -->
                @include('layouts.sidebar-item', [
                    'route' => 'tinhtrang',
                    'iconClass' => 'fas fa-clipboard-list text-teal',
                    'title' => 'Tình Trạng',
                ])

                <!-- Đơn hàng -->
                @include('layouts.sidebar-item', [
                    'route' => 'donhang',
                    'iconClass' => 'fas fa-shopping-cart text-yellow',
                    'title' => 'Đơn hàng',
                ])

                <!-- Liên hệ -->
                @include('layouts.sidebar-item', [
                    'route' => 'lienhe.danhsach',
                    'iconClass' => 'fas fa-address-book text-cyan',
                    'title' => 'Danh sách liên hệ',
                ])

                <!-- yêu thích -->
                @include('layouts.sidebar-item', [
                    'route' => 'sanpham_yeuthich.index',
                    'iconClass' => 'fas fa-heart text-red',
                    'title' => 'Yêu thích',
                ])

                   <!-- yêu thích -->
                   @include('layouts.sidebar-item', [
                    'route' => 'binhluansanpham.index',
                    'iconClass' => 'fas fa-comment text-red',
                    'title' => 'Bình luận sản phẩm',
                ])



                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-edit text-info" style="font-size: 18px;"></i>
                        <span class="ms-2">Quản lý bài viết</span>
                    </a>
                    <ul class="dropdown-menu fade" aria-labelledby="dropdownMenuLink"
                        style="transition: opacity 0.5s ease-in-out;">
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.chude') }}">
                                <i class="fas fa-folder text-primary" style="font-size: 16px;"></i>
                                <span class="ms-2">Chủ đề</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.baiviet') }}">
                                <i class="fas fa-file-alt text-success" style="font-size: 16px;"></i>
                                <span class="ms-2">Bài viết</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.binhluanbaiviet') }}">
                                <i class="fas fa-comments text-warning" style="font-size: 16px;"></i>
                                <span class="ms-2">Bình luận bài viết</span>
                            </a>
                        </li>
                    </ul>
                </li>


            </ul>
        </nav>
    </div>
</aside>

<!-- Đảm bảo jQuery được tải đầu tiên -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="{{ asset('admins/Sidebar/sidebar.css') }}">
<script src="{{ asset('admins/Sidebar/sidebar.js') }}"></script>
