@extends('layouts.admin')

@section('content')
@include('partials.content-header', ['name' => '', 'key' => ''])
<h1>Thêm Đơn Hàng</h1>
<form action="{{ route('donhang.them') }}" method="post">
    @csrf

    <div class="mb-3">
        <label for="product_id">Chọn Sản Phẩm</label>
        <select class="form-select" name="product_id" required>
            <option value="">-- Chọn sản phẩm --</option>
            @foreach($products as $sp)
                <option value="{{ $sp->id }}">{{ $sp->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="tinhtrang_id">Chọn Tình Trạng</label>
        <select class="form-select" name="tinhtrang_id" required>
            <option value="">-- Chọn tình trạng --</option>
            @foreach($tinhtrang as $tt)
                <option value="{{ $tt->id }}">{{ $tt->tinhtrang }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="dienthoaigiaohang">Điện thoại giao hàng</label>
        <input type="text" class="form-control" id="dienthoaigiaohang" name="dienthoaigiaohang" required>
    </div>

    <div class="mb-3">
        <label for="diachigiaohang">Địa chỉ giao hàng</label>
        <input type="text" class="form-control" id="diachigiaohang" name="diachigiaohang" required>
    </div>

    <button type="submit" class="btn btn-primary">Đặt Hàng</button>
</form>
@endsection
