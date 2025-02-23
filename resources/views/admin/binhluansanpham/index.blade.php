@extends('layouts.admin')

@section('content')
@include('partials.content-header', ['name' => 'Danh sách', 'key' => 'đánh giá'])

<!-- Form tìm kiếm -->
<div class="mb-4">
    <form method="GET" action="{{ route('binhluansanpham.index') }}">
        <div class="flex items-center space-x-4">
            <input type="text" name="product" value="{{ request()->input('product') }}" class="px-4 py-2 border border-gray-300 rounded-lg" placeholder="Tìm theo tên sản phẩm...">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Tìm kiếm</button>
        </div>
    </form>
</div>

<div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="px-4 py-2 border">#</th>
                <th class="px-4 py-2 border">Sản phẩm</th>
                <th class="px-4 py-2 border">Ảnh sản phẩm</th>            
                <th class="px-4 py-2 border">Người dùng</th>
                <th class="px-4 py-2 border">Rating</th>
                <th class="px-4 py-2 border">Bình luận</th>
                <th class="px-4 py-2 border">Likes</th>
                <th class="px-4 py-2 border">Dislikes</th>
                <th class="px-4 py-2 border">Thời gian đánh giá</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reviews as $review)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-2 border">{{ $review->id }}</td>
                    <td class="px-4 py-2 border">{{ $review->product->name ?? 'N/A' }}</td>
                    <td class="py-3 px-4">
                        @if($review->product && $review->product->feature_image_path)
                            <img class="w-24 h-24 object-cover rounded-lg mx-auto shadow-md" 
                                 src="{{ asset('storage/' . str_replace(['http://localhost:8001/storage/', 'http://127.0.0.1:8001/storage/'], '', $review->product->feature_image_path)) }}" 
                                 alt="{{ $review->product->name }}">
                        @else
                            <img class="w-24 h-24 object-cover rounded-lg mx-auto shadow-md" 
                                 src="{{ asset('storage/default-image.jpg') }}" 
                                 alt="No image">
                        @endif
                    </td>
                    <td class="px-4 py-2 border">{{ $review->user_name }}</td>
                    <td class="px-4 py-2 border">
                        <span class="inline-flex items-center">
                            {{ $review->rating }}
                            <i class="fas fa-star text-yellow-500 ml-1"></i>
                        </span>
                    </td>
                    <td class="px-4 py-2 border">{{ $review->comment }}</td>
                    <td class="px-4 py-2 border">{{ $review->likes }}</td>
                    <td class="px-4 py-2 border">{{ $review->dislikes }}</td>
                    <td class="px-4 py-2 border">{{ $review->created_at->format('d-m-Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center text-gray-500 py-4">Không có đánh giá nào.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $reviews->links('pagination::tailwind') }} <!-- Hiển thị phân trang -->
    </div>
</div>
@endsection
