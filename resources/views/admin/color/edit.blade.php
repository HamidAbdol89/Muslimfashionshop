@extends('layouts.admin')

@section('content')
    @include('partials.content-header', ['name' => 'Màu sắc', 'key' => 'Chỉnh sửa'])

    <div class="container">
        <form action="{{ route('colors.update', $color->id) }}" method="POST">
            @csrf
            @method('PUT')

         <!-- Dropdown chọn sản phẩm với Datalist -->
<div class="form-group">
    <label for="product_id">Sản phẩm</label>
    
    <!-- Input với Datalist -->
    <input list="products" name="product_id" id="product_id" class="form-control" 
           placeholder="Chọn sản phẩm" value="{{ old('product_id', $color->product_id) }}" required>
    
    <!-- Datalist chứa các sản phẩm -->
    <datalist id="products">
        @foreach ($product as $product)
            <option value="{{ $product->id }} - {{ $product->name }}">
        @endforeach
    </datalist>

    @error('product_id')
        <div class="alert alert-danger mt-2">{{ $message }}</div>
    @enderror
</div>


            <!-- Dropdown chọn màu sắc -->
            <div class="form-group">
                <label for="color">Chọn màu sắc</label>
                <select name="color" id="color" class="form-control" required>
                    <option value="">Chọn màu sắc</option>
                     <!-- Thêm các màu sắc phổ biến khác nếu cần -->
                     <option value="other" {{ old('color', $color->color) == 'other' ? 'selected' : '' }}>Khác (Nhập màu
                        sắc)</option>
                    <option value="Đỏ" {{ old('color') == 'Đỏ' ? 'selected' : '' }}>Đỏ</option>
                    <option value="Xanh dương" {{ old('color') == 'Xanh dương' ? 'selected' : '' }}>Xanh dương</option>
                    <option value="Xanh lá" {{ old('color') == 'Xanh lá' ? 'selected' : '' }}>Xanh lá</option>
                    <option value="Đen" {{ old('color') == 'Đen' ? 'selected' : '' }}>Đen</option>
                    <option value="Trắng" {{ old('color') == 'Trắng' ? 'selected' : '' }}>Trắng</option>
                    <option value="Vàng" {{ old('color') == 'Vàng' ? 'selected' : '' }}>Vàng</option>
                    <option value="Tím" {{ old('color') == 'Tím' ? 'selected' : '' }}>Tím</option>
                    <option value="Cam" {{ old('color') == 'Cam' ? 'selected' : '' }}>Cam</option>
                    <option value="Hồng" {{ old('color') == 'Hồng' ? 'selected' : '' }}>Hồng</option>
                    <option value="Nâu" {{ old('color') == 'Nâu' ? 'selected' : '' }}>Nâu</option>
                    <option value="Xám" {{ old('color') == 'Xám' ? 'selected' : '' }}>Xám</option>
                    <option value="Be" {{ old('color') == 'Be' ? 'selected' : '' }}>Be</option>
                    <option value="Lục lam" {{ old('color') == 'Lục lam' ? 'selected' : '' }}>Lục lam</option>
                    <option value="Bạc" {{ old('color') == 'Bạc' ? 'selected' : '' }}>Bạc</option>
                    <option value="Vàng kim" {{ old('color') == 'Vàng kim' ? 'selected' : '' }}>Vàng kim</option>

                   
                </select>
                @error('color')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Trường nhập nếu chọn màu sắc là "Khác" -->
            <div class="form-group" id="other_color"
                style="display: {{ old('color', $color->color) == 'other' ? 'block' : 'none' }};">
                <label for="other_color_input">Nhập màu sắc khác</label>
                <input type="text" name="other_color" id="other_color_input" class="form-control"
                    placeholder="Nhập màu sắc khác"
                    value="{{ old('other_color', $color->color == 'other' ? $color->color : '') }}">
                @error('other_color')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật Màu Sắc</button>
        </form>
    </div>

    <script>
        // JavaScript để hiển thị input nhập màu sắc khi chọn "Khác"
        document.getElementById('color').addEventListener('change', function() {
            var otherColorField = document.getElementById('other_color');
            if (this.value === 'other') {
                otherColorField.style.display = 'block';
            } else {
                otherColorField.style.display = 'none';
            }
        });
    </script>
@endsection
