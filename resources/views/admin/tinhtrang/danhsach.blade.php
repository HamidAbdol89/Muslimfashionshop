@extends('layouts.admin')

@section('content')
@include('partials.content-header', ['name' => '', 'key' => ''])
<h1>Danh sách Tình Trạng</h1>
<a href="{{ route('tinhtrang.them') }}" class="btn btn-primary mb-3"><i class="fa-light fa-plus"></i> Thêm Tình Trạng</a>
<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên Tình Trạng</th>
            <th>Hành Động</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tinhtrang as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->tinhtrang }}</td>
            <td class="text-center">
                <!-- Sửa -->
                <a href="{{ route('tinhtrang.sua', ['id' => $item->id]) }}" class="text-primary mx-2" title="Sửa">
                    <i class="fa fa-edit"></i>
                </a>
                <!-- Xóa -->
                <a href="{{ route('tinhtrang.xoa', ['id' => $item->id]) }}" onclick="return confirm('Bạn có chắc muốn xóa?')" class="text-danger mx-2" title="Xóa">
                    <i class="fa fa-trash-alt"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection