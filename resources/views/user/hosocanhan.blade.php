@extends('layouts.master')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hồ Sơ Khách Hàng</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-RXf+QSDCUQsXr36lzNObYp+HhiRx2yr1f0jLC3V7GKtWJNsbo7M6K7QU5v5TxEYV1+Hgdj4Sk5FjnJX1a/4Pkg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Các hiệu ứng hover cho sidebar */
        .sidebar-link:hover {
            background-color: #4f46e5;
            color: white;
        }

        /* Cải tiến nút */
        .btn-save {
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .btn-save:hover {
            background-color: #3730a3;
            transform: scale(1.05);
        }
    </style>
</head>
<body class="bg-gradient-to-r from-indigo-100 to-blue-50 min-h-screen font-sans">
    <div class="container mx-auto py-10 px-4">
        <!-- Header -->
        <div class="bg-indigo-600 text-white p-6 rounded-xl shadow-md mb-6">
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-semibold">Hồ Sơ Khách Hàng</h1>
                <a href="{{ route('logout') }}" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-full shadow-md" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt mr-2"></i>Đăng xuất
                </a>
                
                <!-- Form đăng xuất ẩn -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                
            </div>
            <nav class="mt-4 text-sm">
                <a href="{{ route('frontend.home') }}" class="text-white hover:underline">Trang chủ</a> >
                <a href="{{ route('user.hosocanhan') }}" class="text-white hover:underline">Khách hàng</a> >
                <span class="text-gray-300">Hồ sơ</span>
            </nav>
        </div>
      
        
<!-- Content -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Sidebar -->
    <aside class="bg-white shadow-lg rounded-xl p-6">
        <div class="relative text-center">
            <!-- Avatar Image -->
            <img src="{{ file_exists(public_path('uploads/avatars/' . Auth::id() . '.jpg')) 
                ? asset('uploads/avatars/' . Auth::id() . '.jpg') . '?t=' . time() 
                : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=random' }}" 
                alt="Avatar" 
                class="rounded-full w-32 h-32 mx-auto mb-6 border-4 border-blue-300">

            <!-- Edit Icon (Cây bút) -->
            <label for="avatar" class="absolute bottom-0 right-0 bg-blue-500 text-white rounded-full p-2 cursor-pointer hover:bg-blue-600 transition duration-200">
                <i class="fas fa-edit"></i>
            </label>

            <!-- Hidden File Input for Avatar Upload -->
            <input type="file" name="avatar" id="avatar" class="hidden" onchange="uploadAvatar()">

        </div>

        <!-- Form delete avatar -->
        <div class="mt-6 text-center">
            <form action="{{ route('user.delete.avatar') }}" method="POST">
                @csrf
                <button type="submit" 
                        class="px-6 py-2 bg-red-500 text-white text-sm font-medium rounded-md hover:bg-red-600 transition duration-200">
                    Xóa ảnh đại diện
                </button>
            </form>
        </div>


        <script>
         // Hàm để gửi form khi người dùng chọn ảnh mới
function uploadAvatar() {
    var formData = new FormData();
    var avatarInput = document.getElementById("avatar");
    formData.append("avatar", avatarInput.files[0]);
    formData.append("_token", "{{ csrf_token() }}");

    // Gửi ảnh bằng AJAX
    fetch("{{ route('user.upload.avatar') }}", {
        method: "POST",
        body: formData,
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Mã lỗi: ' + response.status); // Kiểm tra mã trạng thái HTTP
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            alert("Cập nhật ảnh đại diện thành công!");
            // Cập nhật lại ảnh đại diện nếu cần thiết
            var avatarImg = document.querySelector("img.rounded-full");
            avatarImg.src = data.avatar_url + "?t=" + new Date().getTime(); // Làm mới ảnh
        } else {
            alert("Có lỗi xảy ra khi cập nhật ảnh đại diện!");
        }
    })
    .catch(error => {
        console.error("Error:", error);
        alert("Có lỗi xảy ra, vui lòng thử lại!");
    });
}

        </script>


                <ul class="mt-6 space-y-3">
                    <li>
                        <a href="{{ route('user.donhang') }}" class="sidebar-link flex items-center p-3 rounded-lg">
                            <i class="fas fa-shopping-bag text-indigo-500 w-6"></i>
                            <span class="ml-2">Đơn hàng</span>
                            <span class="ml-auto bg-red-500 text-white px-2 py-1 rounded-full text-xs">{{ $user->DonHang->count() }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.thich') }}" class="sidebar-link flex items-center p-3 rounded-lg">
                            <i class="fas fa-heart text-indigo-500 w-6"></i>
                            <span class="ml-2">Sản phẩm yêu thích</span>
                            <span class="ml-auto bg-red-500 text-white px-2 py-1 rounded-full text-xs">{{ $favoriteCount }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.danhgia') }}" class="sidebar-link flex items-center p-3 rounded-lg">
                            <i class="fas fa-star text-indigo-500 w-6"></i>
                            <span class="ml-2">Đánh giá sản phẩm</span>
                            <span class="ml-auto bg-red-500 text-white px-2 py-1 rounded-full text-xs">{{ $reviewCount }}</span>
                        </a>
                    </li>
                    
                </ul>

                <div class="mt-6 border-t pt-4">
                    <h3 class="text-sm font-semibold text-gray-600">Thiết lập tài khoản</h3>
                    <ul class="mt-3 space-y-3">
                        <li>
                            <a href="{{ route('user.hosocanhan') }}" class="sidebar-link flex items-center p-3 rounded-lg">
                                <i class="fas fa-user text-indigo-500 w-6"></i>
                                <span class="ml-2">Hồ sơ cá nhân</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('user.address') }}" class="sidebar-link flex items-center p-3 rounded-lg">
                                <i class="fas fa-map-marker-alt text-indigo-500 w-6"></i>
                                <span class="ml-2">Sổ địa chỉ</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="sidebar-link flex items-center p-3 rounded-lg">
                                <i class="fas fa-credit-card text-indigo-500 w-6"></i>
                                <span class="ml-2">Phương thức thanh toán</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </aside>

            <!-- Main Section -->
            <section class="lg:col-span-2 bg-white shadow-lg rounded-xl p-6">
                <h2 class="text-xl font-semibold mb-4">Cập nhật thông tin</h2>
                <form action="{{ route('user.hosocanhan') }}" method="post" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="name" class="block text-sm font-medium">Họ và tên</label>
                            <input type="text" id="name" name="name" value="{{ $user->name }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium">Địa chỉ email</label>
                            <input type="email" id="email" name="email" value="{{ $user->email }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium">Mật khẩu mới</label>
                        <input type="password" id="password" name="password" placeholder="Bỏ trống nếu không thay đổi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="password-confirm" class="block text-sm font-medium">Xác nhận mật khẩu</label>
                        <input type="password" id="password-confirm" name="password_confirmation" placeholder="Bỏ trống nếu không thay đổi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="subscribe" name="subscribe" type="checkbox" checked class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                            <label for="subscribe" class="ml-2 block text-sm text-gray-900">Nhận thông báo qua email</label>
                        </div>
                        <button type="submit" class="btn-save bg-indigo-600 text-white px-6 py-2 rounded-lg shadow-md">Cập nhật thông tin</button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</body>
</html>
