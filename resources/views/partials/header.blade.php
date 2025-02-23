
<!-- Navbar -->
 <!-- Đảm bảo jQuery được tải đầu tiên -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="{{ asset('admins/header/header.css') }}">
<script src="{{ asset('admins/header/header.js') }}"></script>
<nav class="main-header navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(180deg, #1c1c28, #2e2e44); box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link text-white" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
        <li class="nav-item d-none d-md-inline-block">
            <a href="index3.html" class="nav-link text-white">Home</a>
        </li>
        

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
            <a class="nav-link text-white" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

   <!-- Messages Dropdown Menu -->
<li class="nav-item dropdown">
    <a class="nav-link text-white" data-toggle="dropdown" href="#">
        <i class="far fa-comments"></i>
        <span class="badge badge-danger navbar-badge">
            {{ isset($contacts) && $contacts->count() > 0 ? $contacts->count() : 0 }}
        </span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-header">
            {{ isset($contacts) && $contacts->count() > 0 ? $contacts->count() : 0 }} Messages
        </span>
        <div class="dropdown-divider"></div>

        @if(isset($contacts) && $contacts->count() > 0)
            @foreach ($contacts as $contact)
                <a href="#" class="dropdown-item">
                    <div class="media">
                        <img src="{{ asset('adminlte/dist/img/user1-128x128.jpg') }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                {{ $contact->name }} <!-- Hiển thị tên người gửi -->
                            </h3>
                            <p class="text-sm">{{ $contact->message }}</p> <!-- Hiển thị tin nhắn -->
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> {{ $contact->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </a>
                <div class="dropdown-divider"></div>
            @endforeach
        @else
            <a href="#" class="dropdown-item">No messages available</a>
        @endif

        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
    </div>
</li>

<!-- Notifications Dropdown Menu -->
<li class="nav-item dropdown">
    <a class="nav-link text-white" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <span class="badge badge-warning navbar-badge">
            {{ isset($contacts) && $contacts->count() > 0 ? $contacts->count() : 0 }}
        </span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-header">
            {{ isset($contacts) && $contacts->count() > 0 ? $contacts->count() : 0 }} Notifications
        </span>
        <div class="dropdown-divider"></div>

        @if(isset($contacts) && $contacts->count() > 0)
            @foreach ($contacts as $contact)
                <a href="#" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> {{ $contact->message }} <!-- Hiển thị nội dung thông báo -->
                    <span class="float-right text-muted text-sm">{{ $contact->created_at->diffForHumans() }}</span>
                </a>
                <div class="dropdown-divider"></div>
            @endforeach
        @else
            <a href="#" class="dropdown-item">No notifications available</a>
        @endif

        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
    </div>
</li>









        <!-- Fullscreen Toggle -->
        <li class="nav-item">
            <a class="nav-link text-white" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>

        <!-- Sidebar Toggle -->
        <li class="nav-item">
            <a class="nav-link text-white" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li>
    </ul>


</nav>
<!-- /.navbar -->
