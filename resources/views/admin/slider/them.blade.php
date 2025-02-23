@extends('layouts.admin')

@section('title')
    <title>Thêm Slider - VIP</title>
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
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form action="{{ route('slider.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="card">
                            <h4 class="text-center">
                                <i class="fas fa-sliders-h title-icon"></i> Thông Tin Slider
                            </h4>
                            <div class="form-group">
                                <label for="name">Tên Slider</label>
                                <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Mô tả</label>
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description">{{ old('description') }}</textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="image_path">Hình Ảnh</label>
                                <input type="file" id="image_path" class="form-control @error('image_path') is-invalid @enderror" name="image_path" accept="image/*">
                                @error('image_path')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <img id="imagePreview" src="" alt="Preview ảnh" style="display: none;">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Thêm Mới</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script src="{{ asset('admins/slider/anh.js') }}"></script>
@endsection