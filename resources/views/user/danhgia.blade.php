@extends('layouts.master')

@section('title', 'Đánh giá của bạn')
<script src="https://cdn.tailwindcss.com"></script>

@section('content')
    <section class="user-reviews bg-gray-50 py-12">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-8" data-aos="fade-up">Các đánh giá của tôi</h2>

            @if(Auth::check())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($reviewss as $review)
                        <div class="review-item bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl transform transition-all duration-300 ease-in-out hover:scale-105" data-aos="fade-up" data-aos-delay="200">
                            <!-- Hiển thị hình ảnh sản phẩm -->
                            <div class="product-image mb-6">
                                <img src="{{ isset($review->product->feature_image_path) ? asset('storage/' . str_replace(['http://localhost:8001/storage/', 'http://127.0.0.1:8001/storage/'], '', $review->product->feature_image_path)) : asset('storage/default-image.jpg') }}" 
                                     alt="{{ $review->product->name }}" 
                                     class="w-full h-64 object-contain rounded-t-lg mb-4 transition-transform duration-300 ease-in-out hover:scale-105"> <!-- Đảm bảo hình ảnh không bị cắt xén -->
                            </div>

                            <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $review->product->name }}</h3>

                            <!-- Hiển thị số lượng đánh giá -->
                            <div class="text-sm text-gray-500 mb-2">
                                <strong>Số lượng đánh giá: </strong>{{ $review->product->reviewss()->count() }} đánh giá
                            </div>
                            

                            <!-- Đánh giá sao -->
                            <div class="rating mb-4">
                                <strong class="text-gray-700">Đánh giá:</strong>
                                <div class="stars flex">
                                    @for($i = 1; $i <= 5; $i++)
                                        <span class="star text-xl" style="color: {{ $i <= $review->rating ? '#ffcc00' : '#ddd' }};">&#9733;</span>
                                    @endfor
                                </div>
                            </div>

                            <!-- Bình luận -->
                            <div class="comment text-gray-600 mb-4">
                                <strong class="text-gray-700">Bình luận:</strong>
                                <p class="text-sm">{{ $review->comment ?? 'Không có bình luận.' }}</p>
                            </div>

                            <!-- Thời gian đánh giá -->
                            <div class="text-xs text-gray-500">
                                <strong>Ngày đánh giá: </strong>{{ $review->created_at->format('d-m-Y H:i') }}
                            </div>
                            <a href="{{ route('frontend.sanpham.chitiet', $review->product->id) }}" class="flex items-center text-indigo-700 hover:text-indigo-900 mt-4 text-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5 mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 19.5L15.75 12l-6-7.5"></path>
                                </svg>
                                Xem chi tiết
                            </a>
                            
                        </div>
                        
                    @empty
                        <p class="col-span-3 text-center text-gray-600">Bạn chưa đánh giá sản phẩm nào.</p>
                    @endforelse
                </div>
                
               
            @else
                <p class="text-center text-gray-600">Vui lòng <a href="{{ route('login') }}" class="text-blue-500 font-semibold">đăng nhập</a> để xem các đánh giá của bạn.</p>
            @endif
        </div>
    </section>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            easing: 'ease-in-out',
            once: true,
        });
    </script>
@endsection
