@extends('layouts.admin')

@section('content')
@include('partials.content-header', ['name' => 'Kích thước', 'key' => 'Danh sách'])
    <div class="container">
        <a href="{{ route('sizes.create') }}" class="btn btn-primary">Thêm kích thước mới</a>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Danh mục</th> <!-- Thay Sản phẩm bằng Danh mục -->
                    <th>Kích thước</th>
                    <th>Miêu tả</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sizes as $size)
                    <tr>
                        <td>{{ $size->id }}</td>
                        <td>{{ $size->category->name }}</td> <!-- Hiển thị tên danh mục -->
                        <td>{{ $size->size }}</td>
                        <td>{{ $size->description }}</td>

                        <td>
                            <a href="{{ route('sizes.edit', $size->id) }}" class="btn btn-warning">Chỉnh sửa</a>
                            <form action="{{ route('sizes.destroy', $size->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
                    <!-- Hiển thị nút phân trang -->
    <div class="d-flex justify-content-center mt-4">
        {{ $sizes->links('pagination::bootstrap-4') }}
    </div>
        </table>
  
    </div>
@endsection
