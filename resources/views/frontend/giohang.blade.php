@extends('layouts.master')
@section('title', 'Giỏ hàng')
@section('content')

<link rel="stylesheet" href="{{ asset('frontends/giohang/giohang.css') }}">
<div class="container py-5">
    <div class="text-center mb-4">
        <h1 class="text-3xl font-bold text-blue-600">Giỏ Hàng</h1>
        <p class="text-gray-500">Xem và quản lý các sản phẩm trong giỏ hàng của bạn</p>
    </div>

    <div class="flex justify-end mb-4">
          
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <section class="col-span-2">
            <form action="{{ route('frontend.giohang.capnhat') }}" method="post" class="space-y-6">
                @csrf
                <div class="flex justify-between items-center border-b pb-4">
                    <h2 class="text-lg font-semibold">Sản phẩm trong giỏ</h2>
                    <a href="javascript:window.history.back();" class="text-blue-500 hover:underline">&larr; Tiếp tục mua hàng</a>
                </div>

                <table class="w-full table-auto">
                    <thead>
                        <tr>
                            <th class="text-left">Sản phẩm</th>
                            <th class="text-center">Màu sắc</th>
                            <th class="text-center">Size</th>
                            <th class="text-center">Giá</th>
                            <th class="text-center">Số lượng</th>
                            <th class="text-center">Tổng</th>
                            <th class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (session('cart', []) as $id => $item)
                            <tr>
                                <td class="py-4">
                                    <div class="flex items-center space-x-4">
                                        <img src="{{ isset($item['feature_image_path']) ? asset('storage/' . str_replace(['http://localhost:8001/storage/', 'http://127.0.0.1:8001/storage/'], '', $item['feature_image_path'])) : asset('storage/default-image.jpg') }}" 
                                             alt="{{ $item['name'] }}" class="lazyload w-20 h-20 object-cover rounded img-fluid">
                                        <div>
                                            <h3 class="text-base font-medium">{{ $item['name'] }}</h3>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p id="selected-color" class="selected-color-text">
                                        {{ session('cart.color', 'Chưa chọn màu') }}
                                    </p>
                                    
                                    
                                    
                                </td>
                                
                                <td>
                                    <p id="selected-size" class="selected-size-text">
                                        {{ session('cart.size', 'Chưa chọn kích thước') }}
                                    </p>
                                </td>
                                
                                <td class="text-center py-4">{{ number_format($item['price'], 0, ',', '.') }}<small>đ</small></td>
                                <td class="text-center py-4">
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('frontend.giohang.giam', ['row_id' => $id]) }}" class="text-gray-500 hover:text-blue-500">
                                            <i class="fas fa-minus-circle"></i>
                                        </a>
                                        <input type="number" name="qty[{{ $id }}]" value="{{ $item['quantity'] }}" min="1" class="w-12 text-center border rounded-md">
                                        <a href="{{ route('frontend.giohang.tang', ['row_id' => $id]) }}" class="text-gray-500 hover:text-blue-500">
                                            <i class="fas fa-plus-circle"></i>
                                        </a>
                                    </div>
                                </td>
                                <td class="text-center py-4">{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }} đ</td>
                                <td class="text-center py-4">
                                    <a href="{{ route('frontend.giohang.xoa', ['row_id' => $id]) }}" class="text-red-500 hover:text-red-700">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    
                </table>

                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg shadow hover:bg-blue-700 flex items-center justify-center space-x-2">
                    <i class="fas fa-sync-alt"></i> <!-- Icon đồng bộ -->
                    <span>Cập nhật giỏ hàng</span>
                </button>

                   <!-- Nút xóa tất cả với icon -->
        <form id="clear-cart-form" action="{{ route('frontend.giohang.xoa_tat_ca') }}" method="POST" style="display: inline;">
            @csrf
            <button id="clear-cart-btn" type="submit" class="w-full py-2 rounded-lg shadow bg-red-600 text-white hover:bg-red-700 flex items-center justify-center space-x-2">
                <i class="fas fa-trash-alt"></i> <!-- Icon trash -->
                <span>Xóa tất cả</span>
            </button>
            
        </form>   
                
            </form>
        </section>

        <aside class="col-span-1 bg-white shadow p-6 rounded-lg">
            <h2 class="text-lg font-semibold border-b pb-4">Thông tin đơn hàng</h2>

            <div class="py-4 space-y-4">
                @php
                    $totalPrice = 0;
                @endphp

                @foreach (session('cart', []) as $id => $item)
                    @php
                        $totalPrice += $item['price'] * $item['quantity'];
                    @endphp
                    <div class="flex justify-between text-sm">
                        <span>{{ $item['name'] }} (x{{ $item['quantity'] }})</span>
                        <span>{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }} đ</span>
                    </div>
                @endforeach

                <div class="flex justify-between font-semibold border-t pt-4">
                    <span>Tổng cộng:</span>
                    <span>{{ number_format($totalPrice, 0, ',', '.') }} đ</span>
                </div>
            </div>

            <a href="{{ route('user.dathang') }}" class="block w-full bg-green-600 text-white py-2 text-center rounded-lg shadow hover:bg-green-700 items-center justify-center space-x-2">
                <i class="fas fa-credit-card"></i> <!-- Icon thẻ tín dụng -->
                <span>Thanh toán</span>
            </a>
            
        </aside>
    </div>
</div>

@endsection

<script src="{{ asset('frontends/giohang/giohang.js') }}"></script>
<script>
    $(document).ready(function() {
        // Xử lý xóa tất cả giỏ hàng
        $('#clear-cart-form').on('submit', function(e) {
            e.preventDefault(); // Ngừng hành động mặc định của form

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),  // Lấy dữ liệu từ form
                success: function(response) {
                    // Nếu xóa thành công, làm mới giỏ hàng
                    location.reload();  // Hoặc có thể cập nhật lại phần giỏ hàng mà không reload
                },
                error: function(xhr, status, error) {
                    alert('Có lỗi xảy ra khi xóa giỏ hàng');
                }
            });
        });
    });

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

</script>
