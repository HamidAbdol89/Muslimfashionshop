@extends('layouts.admin')

@section('title')
    <title>Thêm danh mục</title>
@endsection

@section('content')
@include('partials.content-header', ['name' => '', 'key' => ''])
<div class="container mt-4">
    <!-- Card -->
    <div class="card shadow-sm">
        <div class="card-header text-center bg-success text-white">
            <h1 class="h4">Thêm danh mục</h1>
            <p class="small">Tạo mới danh mục của bạn</p>
        </div>

        <!-- Form -->
        <div class="card-body p-3">
            <form action="{{ route('categories.store') }}" method="post">
                @csrf

                <!-- Tên danh mục -->
                <div class="mb-3">
                    <label for="name" class="form-label">Tên danh mục</label>
                    <input type="text"
                           id="name"
                           name="name"
                           class="form-control"
                           placeholder="Nhập tên danh mục"
                           required>
                </div>

                <!-- Danh mục cha -->
                <div class="mb-3">
                    <label for="parent_id" class="form-label">Chọn danh mục cha</label>
                    <select id="parent_id"
                            name="parent_id"
                            class="form-select">
                        <option value="0">Chọn danh mục cha</option>
                        {!! $htmlOption !!}
                    </select>
                </div>

                <!-- Nút xác nhận -->
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success w-100">Xác nhận</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
