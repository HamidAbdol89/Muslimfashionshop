@extends('layouts.admin')

@section('title')
    <title>Thêm Sản phẩm</title>
@endsection

@section('css')
    <link href="{{ asset('vendors/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admins/product/sua.css') }}" rel="stylesheet" />
@endsection

@section('content')
    @include('partials.content-header', ['name' => 'Sản phẩm', 'key' => 'Sửa'])

    <form action="{{ route('product.update', ['id' => $product->id]) }}" method="post" enctype="multipart/form-data">
        <div class="content">
            <!-- Bên trái -->
            <div class="left">
                <h3>Thông tin sản phẩm</h3>
                @csrf
                @method('PUT')

                <!-- Tên sản phẩm -->
                <input type="text" class="form-control" name="name" placeholder="Nhập tên sản phẩm" value="{{ $product->name }}">

                <!-- Giá sản phẩm -->
                <input type="text" class="form-control" name="price" placeholder="Nhập giá sản phẩm" value="{{ $product->price }}">

                <!-- Ảnh đại diện -->
                <input type="file" class="form-control-file" name="feature_image_path[]" id="feature-image-input">
                <img class="image_avatar_product" id="feature-image" src="{{ $product->feature_image_path }}" alt="Ảnh đại diện">


                <!-- Danh mục -->
                <select class="form-control select2_init" name="category_id">
                    <option value="0">Chọn danh mục cha</option>
                    {!! $htmlOption !!}
                </select>

                <!-- Tags -->
                <select name="tags[]" class="form-control tags_select_choose" multiple="multiple">
                    @foreach($product->tags as $tagItem)
                        <option value="{{ $tagItem->id }}" selected>{{ $tagItem->name }}</option>
                    @endforeach
                </select>

                <button type="submit" class="btn-primary">Cập nhật sản phẩm</button>
            </div>

            <!-- Bên phải -->
            <div class="right">
                <h3>Ảnh chi tiết và nội dung</h3>

                <!-- Ảnh chi tiết -->
                <input type="file" class="form-control-file" name="detail_images[]" id="detail-image-input" multiple>
                <div id="detail-image-preview">
                    @foreach($product->productImages as $productImageItem)
                        <img class="image_detail_product" src="{{ $productImageItem->image_path }}" alt="Ảnh chi tiết">
                    @endforeach
                </div>

                <!-- Nội dung sản phẩm -->
                <textarea class="form-control" name="content" id="editor" rows="4">{{ $product->content }}</textarea>
            </div>
        </div>
    </form>
@endsection

@section('js')
    <script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('ckeditor5/ckeditor.js') }}"></script>
    <script src="{{ asset('admins/product/sua.js') }}"></script>
@endsection
