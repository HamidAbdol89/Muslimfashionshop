@extends('layouts.master')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý địa chỉ giao hàng</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <style>
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
        <div class="bg-indigo-600 text-white p-6 rounded-xl shadow-md mb-6">
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-semibold">Quản lý địa chỉ giao hàng</h1>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Sidebar -->
<aside class="bg-white shadow-lg rounded-xl p-6">
    <h3 class="text-lg font-semibold mb-4">Danh sách địa chỉ</h3>
    <ul class="space-y-4">
        @foreach ($addresses ?? [] as $address)
        <li class="bg-gray-50 p-4 rounded-lg shadow-md">
            <p class="text-sm font-medium">Tên: {{ $address->ten_nguoi_nhan }}</p>
            <p class="text-sm text-gray-600">Địa chỉ: {{ $address->dia_chi }}</p>
            <p class="text-sm text-gray-600">Số điện thoại: {{ $address->so_dien_thoai }}</p>
            <p class="text-sm text-gray-600">Thành phố: {{ $address->thanh_pho }}</p>
            <div class="mt-2 flex space-x-2">
                <a href="{{ route('user.editAddress', $address->id) }}" class="text-indigo-600 hover:text-indigo-800 text-sm">
                    <i class="fas fa-edit"></i> Sửa
                </a>
                <form action="{{ route('user.deleteAddress', $address->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa địa chỉ này?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm">
                        <i class="fas fa-trash-alt"></i> Xóa
                    </button>
                </form>
            </div>
        </li>
    @endforeach
    
    </ul>
</aside>

<!-- Main Section -->
<section class="lg:col-span-2 bg-white shadow-lg rounded-xl p-6">
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
        </div>
    @endif

    <h2 class="text-xl font-semibold mb-4">Cập nhật địa chỉ giao hàng</h2>
    <form action="{{ route('user.saveAddress') }}" method="post" class="space-y-4">
        @csrf
        <div>
            <label for="name" class="block text-sm font-medium">Tên người nhận</label>
            <input type="text" id="name" name="name" value="{{ old('name', $address->ten_nguoi_nhan ?? '') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <div>
            <label for="address" class="block text-sm font-medium">Địa chỉ</label>
            <input type="text" id="address" name="address" value="{{ old('address', $address->dia_chi ?? '') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <div>
            <label for="phone" class="block text-sm font-medium">Số điện thoại</label>
            <input type="text" id="phone" name="phone" value="{{ old('phone', $address->so_dien_thoai ?? '') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <div>
            <label for="city" class="block text-sm font-medium">Thành phố</label>
            <input type="text" id="city" name="city" value="{{ old('city', $address->thanh_pho ?? '') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <div class="flex items-center justify-between">
            <button type="submit" class="btn-save bg-indigo-600 text-white px-6 py-2 rounded-lg shadow-md">Lưu địa chỉ</button>
        </div>
    </form>
</section>



    </div>
</body>
</html>
