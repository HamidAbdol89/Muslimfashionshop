@extends('layouts.master')

@section('title', 'Sản phẩm chi tiết')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')

    <link rel="stylesheet" href="{{ asset('frontends/sanpham_chitiet/chitiet.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <section class="reviews bg-gray-50 py-8 px-4 rounded-lg shadow-lg max-w-4xl mx-auto">
        <h3 class="text-3xl font-semibold text-gray-800 mb-8 text-center">Tất cả đánh giá về sản phẩm này</h3>
    
        <div class="review-list space-y-6">
            @foreach ($reviews as $review)
                <div class="review bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-all">
                    <div class="review-header flex items-center mb-4">
                        <!-- Avatar kiểu vòng tròn -->
                        <div class="user-avatar w-12 h-12 rounded-full flex items-center justify-center overflow-hidden">
                            <img src="{{ route('user.avatar', ['userName' => $review->user_name]) }}" 
                                 alt="Avatar của {{ $review->user_name }}" 
                                 class="w-full h-full object-cover object-center">
                        </div>
                        
                        <div class="user-info ml-4">
                            <p class="font-semibold text-gray-800 text-lg">{{ $review->user_name }}</p>
                            <p class="text-sm text-gray-500">{{ $review->created_at->format('d/m/Y') }}</p>
                        </div>
                    </div>
    
                    <div class="review-body">
                        <!-- Hiển thị sao đánh giá -->
                        <div class="rating mb-3">
                            @for ($i = 1; $i <= 5; $i++)
                                <span class="star text-xl" style="color: {{ $i <= $review->rating ? '#ffc107' : '#e4e5e9' }};">&#9733;</span>
                            @endfor
                        </div>
                        <p class="text-gray-700 leading-relaxed">{{ $review->comment }}</p>
                    </div>
    
                    <div class="review-footer mt-4 flex items-center justify-start space-x-4">
                        @if (Auth::check())
                            <!-- Nút Like và Dislike -->
                            <form class="vote-form flex items-center space-x-2">
                                @csrf
                                <button 
                                    type="button"
                                    class="flex items-center text-green-500 hover:text-green-700 vote-button transition-all duration-300 ease-in-out transform hover:scale-105" 
                                    data-review-id="{{ $review->id }}" 
                                    data-vote="like">
                                    <i class="fas fa-thumbs-up"></i> Hữu ích (<span class="like-count">{{ $review->likes }}</span>)
                                </button>
                            </form>
                            <form class="vote-form flex items-center space-x-2">
                                @csrf
                                <button 
                                    type="button"
                                    class="flex items-center text-red-500 hover:text-red-700 vote-button transition-all duration-300 ease-in-out transform hover:scale-105" 
                                    data-review-id="{{ $review->id }}" 
                                    data-vote="dislike">
                                    <i class="fas fa-thumbs-down"></i> Không hữu ích (<span class="dislike-count">{{ $review->dislikes }}</span>)
                                </button>
                            </form>
                        @else
                            <p class="text-gray-500 text-sm">Vui lòng đăng nhập để đánh giá.</p>
                        @endif
                    </div>
                    
                    
                </div>
            @endforeach
        </div>
    
        <!-- Phân trang -->
        <div class="pagination mt-8 text-center">
            {{ $reviews->links('pagination::tailwind') }}
        </div>
    </section>
   
    
@section('js')
    <script>
   document.addEventListener('DOMContentLoaded', function () {
    const voteButtons = document.querySelectorAll('.vote-button');

    voteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const reviewId = this.dataset.reviewId;
            const voteType = this.dataset.vote; // 'like' hoặc 'dislike'
            const url = `/reviews/vote/${reviewId}/${voteType}`;

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Cập nhật số Like/Dislike trong giao diện
                    const likeCount = this.closest('.review-footer').querySelector('.like-count');
                    const dislikeCount = this.closest('.review-footer').querySelector('.dislike-count');
                    likeCount.textContent = data.likes;
                    dislikeCount.textContent = data.dislikes;
                } else {
                    console.error('Có lỗi xảy ra:', data.message);
                }
            })
            .catch(error => console.error('Lỗi mạng:', error));
        });
    });
});



    </script>

@endsection
@endsection
<style>
/* Hiệu ứng hover cho nút, không có màu nền */
.vote-button {
    position: relative;
    font-size: 16px;
    padding: 8px 12px;
    border-radius: 5px;
    background-color: transparent;
    border: 2px solid transparent;
    transition: all 0.3s ease;
}

/* Chỉ thay đổi màu chữ khi hover */
.vote-button:hover {
    border-color: currentColor;
    text-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
}

/* Hiệu ứng cho icon và con số */
.vote-button i {
    transition: transform 0.3s ease;
}

.vote-button:hover i {
    transform: translateX(4px);
}

.vote-button span {
    transition: color 0.3s ease, transform 0.3s ease;
}

.vote-button:hover span {
    color: #4CAF50; /* Màu khi hover trên nút Like */
}

.vote-button[data-vote="dislike"]:hover span {
    color: #F44336; /* Màu khi hover trên nút Dislike */
}

/* Hiệu ứng nhấn */
.vote-button:active {
    transform: scale(0.98);
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}


    </style>