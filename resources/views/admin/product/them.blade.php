@extends('layouts.admin')

@section('title')
    <title>Thêm Sản phẩm</title>
@endsection

@section('css')
    <link href="{{ asset('vendors/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admins/product/them.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <!-- Header -->
    <div class="content-header">Thêm Sản phẩm</div>

    <!-- Form -->
    <div class="container">
        <div class="form-container">
            <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- Tên sản phẩm -->
                    <div class="col-md-6 form-group">
                        <label>Tên sản phẩm</label>
                        <input type="text" 
                            class="form-control @error('name') is-invalid @enderror" 
                            name="name" 
                            placeholder="Nhập tên sản phẩm" 
                            value="{{ old('name') }}">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Giá sản phẩm -->
                    <div class="col-md-6 form-group">
                        <label>Giá sản phẩm</label>
                        <input type="text" 
                            class="form-control @error('price') is-invalid @enderror" 
                            name="price" 
                            placeholder="Nhập giá sản phẩm" 
                            value="{{ old('price') }}">
                        @error('price')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Ảnh đại diện -->
                        <div class="col-md-6 form-group">
                            <label>Ảnh đại diện</label>
                            <input type="file" class="form-control-file" name="feature_image_path" id="feature-image-input">
                            <div id="feature-image-preview" class="mt-3" style="display: none;">
                                <img id="feature-image" src="" alt="Image Preview" style="max-width: 100%; max-height: 200px;">
                            </div>
                        </div>

                        <!-- Ảnh chi tiết -->
                        <div class="col-md-6 form-group">
                            <label>Ảnh chi tiết</label>
                            <input type="file" class="form-control-file" name="image_path[]" id="image-input" multiple>
                            <div id="image-preview-container" class="mt-3"></div>
                        </div>


                    <!-- Danh mục -->
                    <div class="col-md-6 form-group">
                        <label>Chọn danh mục</label>
                        <select class="form-control select2_init @error('category_id') is-invalid @enderror" 
                            name="category_id">
                            <option value="0">Chọn danh mục cha</option>
                            {!! $htmlOption !!}
                        </select>
                        @error('category_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Tags -->
                    <div class="col-md-6 form-group">
                        <label>Nhập tags cho sản phẩm</label>
                        <select name="tags[]" 
                            class="form-control tags_select_choose" 
                            multiple="multiple">
                            <!-- Các tag có thể được điền vào từ database nếu có -->
                        </select>
                    </div>

                    <!-- Nội dung -->
                    <div class="col-md-12 form-group">
                        <label>Nhập nội dung</label>
                        <textarea name="contents" 
                            class="form-control @error('contents') is-invalid @enderror" 
                            id="editor">{{ old('contents') }}</textarea>
                        @error('contents')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Nút xác nhận -->
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn-submit">
                            Xác nhận
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('ckeditor5/ckeditor.js') }}"></script>
    <script src="{{ asset('admins/product/them.js') }}"></script>
@endsection

