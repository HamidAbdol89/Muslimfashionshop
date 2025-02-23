@extends('layouts.admin')

@section('content')
@include('partials.content-header', ['name' => 'Màu sắc', 'key' => 'Danh sách'])

<div class="container">
    <a href="{{ route('colors.create') }}" class="btn btn-primary">Thêm màu sắc mới</a>
       <!-- Hiển thị phân trang -->
       <div class="d-flex justify-content-center mt-4">
        {{ $paginatedColors->links('pagination::bootstrap-4') }}
    </div>
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Sản phẩm</th>
                <th>Màu</th>
                <th>Ảnh chi tiết</th>  <!-- Cột ảnh chi tiết -->
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($paginatedColors as $color)
            <tr>
                <td>{{ $color->id }}</td>
                <td>{{ $color->product->name }}</td>
                <td>{{ $color->color }}</td>
        
                <!-- Hiển thị ảnh chi tiết -->
                <td>
                    @if($color->image_path) <!-- Kiểm tra nếu có ID ảnh -->
                        @php
                            // Tìm ảnh theo ID
                            $image = \App\Models\ProductImage::find($color->image_path);
                        @endphp
                        @if($image && $image->image_path) <!-- Kiểm tra ảnh tồn tại và có đường dẫn ảnh -->
                        <img src="{{ asset('storage/' . str_replace(['http://localhost:8001/storage/', 'http://127.0.0.1:8001/storage/'], '', $image->image_path)) }}" alt="Ảnh chi tiết" width="50" height="50">

                        @else
                            <span>Không có ảnh</span>
                        @endif
                    @else
                        <span>Không có ảnh</span>
                    @endif
                </td>
        
                <td>
                    <a href="{{ route('colors.edit', $color->id) }}" class="btn btn-warning">Chỉnh sửa</a>
                    <form action="{{ route('colors.destroy', $color->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
  
    </table>

</div>
@endsection
