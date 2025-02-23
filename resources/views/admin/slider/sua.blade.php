@extends('layouts.admin')

@section('title')
    <title>Sửa Slider</title>
@endsection

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admins/main/SuaVaThem.css') }}">
@endsection


@section('content')
    @include('partials.content-header', ['name' => '', 'key' => ''])

	<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <h4 class="mb-4"><i class="title-icon fas fa-edit"></i> Sửa Slider</h4>
                    <form action="{{ route('slider.update', ['id' => $slider->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Các trường form -->
                        <div class="form-group">
                            <label>Tên Slider</label>
                            <input type="text" name="name" class="form-control" value="{{ $slider->name }}" placeholder="Nhập tên slider">
                        </div>
                        <div class="form-group">
                            <label>Mô tả</label>
                            <textarea name="description" class="form-control" placeholder="Nhập mô tả slider">{{ $slider->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <input type="file" id="image_path" name="image_path" class="form-control-file">
                            <img id="currentImage" class="image-preview" src="{{ $slider->image_path }}" alt="Current Image">
                            <img id="imagePreview" class="image-preview" style="display:none;" alt="Ảnh đã chọn">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Cập Nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('js')
<script src="{{ asset('admins/slider/anh.js') }}"></script>
@endsection