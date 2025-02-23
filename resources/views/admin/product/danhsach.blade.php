@extends('layouts.admin')

@section('title')
    <title>Danh Sách Sản Phẩm</title>
@endsection

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('admins/phantrang/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('admins/slider/danhsach.css') }}">

@endsection
@section('content')
    @include('partials.content-header', ['name' => 'Sản Phẩm', 'key' => 'Danh sách'])

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Button Thêm Mới -->
                <div class="col-md-12 mb-2">
                    <a href="{{ route('product.them') }}" class="btn btn-success float-right m-2">Thêm mới</a>
                </div>


                <!-- Table Danh sách chính -->
                <div class="col-md-12">
                    <div class="card shadow-lg rounded-lg">
                        <div class="card-body">
                            <div class="table-container">
                                <table class="min-w-full table-auto">
                                    <thead class="bg-gray-700 text-white">
                                        <tr>
                                            <th class="py-3 px-4 text-left">#</th>
                                            <th class="py-3 px-4 text-left">Tên sản phẩm</th>
                                            <th class="py-3 px-4 text-left">Giá</th>
                                            <th class="py-3 px-4 text-left">Hình ảnh</th>
                                            <th class="py-3 px-4 text-left">Danh mục</th>
                                            <th class="py-3 px-4 text-center">Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-gray-800 text-white">
                                        @foreach($paginatedProducts as $productItem)
                                            <tr>
                                                <td class="py-3 px-4">{{ $productItem->id }}</td>
                                                <td class="py-3 px-4">{{ $productItem->name }}</td>
                                                <td class="py-3 px-4">{{ number_format($productItem->price) }}</td>
                                                <td class="py-3 px-4">
                                                    <img class="product_image_150_100" src="{{ asset($productItem->feature_image_path) }}" alt="">
                                                </td>
                                                <td class="py-3 px-4">{{ optional($productItem->category)->name ?? 'Chưa có danh mục' }}</td>
                                                <td class="py-3 px-4 text-center">
                                                    <a href="{{ route('product.sua', ['id' => $productItem->id]) }}" class="btn btn-primary btn-sm mr-2">
                                                        <i class="fas fa-edit"></i> Sửa
                                                    </a>
                                                    <a href="javascript:void(0)" data-url="{{ route('product.xoa', ['id' => $productItem->id]) }}" class="btn btn-danger btn-sm action-delete">
                                                        <i class="fas fa-trash"></i> Xóa
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- Phân trang -->
                                <div class="pagination-container">
                                    {!! $paginatedProducts->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="{{ asset('vendors/sweetAlert2/sweetalert2@11.js') }}"></script>
@if(session('add_success'))
    <script>
        window.addSuccessMessage = "{{ session('add_success') }}";
    </script>
@endif

@if(session('success'))
    <script>
        window.updateSuccessMessage = "{{ session('success') }}";
    </script>
@endif

@if(session('error'))
    <script>
        window.errorMessage = "{{ session('error') }}";
    </script>
@endif

<!-- Chèn file JS -->
<script src="{{ asset('admins/main/XoaVaThongbao.js') }}"></script>
@section('js')
<script src="{{ asset('admins/product/danhsach.js') }}"></script>
@endsection
