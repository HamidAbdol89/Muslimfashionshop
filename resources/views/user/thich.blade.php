@extends('layouts.master')
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản phẩm yêu thích</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 font-sans">

    <!-- Header -->
    <header class="p-6 text-center">
        <h1 class="text-5xl font-semibold text-gray-800">Sản phẩm yêu thích của tôi</h1>
    </header>

    <!-- Favorite Products -->
    <main class="container mx-auto p-8">
        <div class="bg-white p-8 rounded-xl shadow-2xl">
            @if($favoriteProducts->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach($favoriteProducts as $favorite)
                <article class="bg-white rounded-lg shadow-lg overflow-hidden transition-all duration-300 ease-in-out transform hover:scale-105 hover:shadow-2xl">
                    <!-- Product Image -->
                    <img src="{{ isset($favorite->feature_image_path) ? asset('storage/' . str_replace(['http://localhost:8001/storage/', 'http://127.0.0.1:8001/storage/'], '', $favorite->feature_image_path)) : asset('storage/default-image.jpg') }}"
                        alt="{{ $favorite->name }}" class="w-full h-96 object-cover rounded-t-lg lazyload">

                    <!-- Product Info -->
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-800 hover:text-indigo-600 transition-colors duration-200">{{ $favorite->name }}</h3>
                        <p class="text-gray-500 mt-2">{{ $favorite->description }}</p>
                        <p class="text-indigo-600 mt-4 font-semibold">{{ number_format($favorite->price, 0, ',', '.') }} VND</p>
                        <p class="text-gray-400 text-sm mt-1">Yêu thích từ {{ $favorite->pivot->created_at->format('d-m-Y') }}</p>
                        <a href="{{ route('frontend.sanpham.chitiet', $favorite->id) }}" class="flex items-center text-indigo-700 hover:text-indigo-900 mt-4 text-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 19.5L15.75 12l-6-7.5"></path>
                            </svg>
                            Xem chi tiết
                        </a>
                    </div>
                </article>
                @endforeach
            </div>
            @else
            <p class="text-center text-gray-600">Chưa có sản phẩm yêu thích nào.</p>
            @endif
        </div>
    </main>

   

</body>

</html>
