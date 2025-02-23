@extends('layouts.admin')

@section('content')
    <div class="container">
        @include('partials.content-header', ['name' => 'Kích thước', 'key' => 'Sửa'])

        <form action="{{ route('sizes.update', $size->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="category_id">Danh mục</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    <option value="">Chọn danh mục</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $size->category_id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="size">Kích thước</label>
                <select name="size" id="size" class="form-control" required>
                    <option value="">Chọn kích thước</option>
                    <option value="XS" {{ $size->size == 'XS' ? 'selected' : '' }}>XS</option>
                    <option value="S" {{ $size->size == 'S' ? 'selected' : '' }}>S</option>
                    <option value="M" {{ $size->size == 'M' ? 'selected' : '' }}>M</option>
                    <option value="L" {{ $size->size == 'L' ? 'selected' : '' }}>L</option>
                    <option value="XL" {{ $size->size == 'XL' ? 'selected' : '' }}>XL</option>
                    <option value="2XL" {{ $size->size == '2XL' ? 'selected' : '' }}>2XL</option>
                    <option value="3XL" {{ $size->size == '3XL' ? 'selected' : '' }}>3XL</option>
                    <option value="Tiêu chuẩn" {{ old('size') == 'Tiêu chuẩn' ? 'selected' : '' }}>Tiêu chuẩn</option>
                </select>
            </div>

            <div class="form-group">
                <label for="description">Miêu tả</label>
                <input type="text" name="description" id="description" class="form-control" value="{{ $size->description }}" readonly>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Cập nhật</button>
        </form>
    </div>

    <script>
        // JavaScript để tự động điền miêu tả khi thay đổi kích thước
        document.getElementById('size').addEventListener('change', function() {
            var size = this.value;
            var descriptionInput = document.getElementById('description');
            
            // Tự động điền miêu tả dựa trên kích thước
            if (size === 'XS') {
                descriptionInput.value = 'Rất Nhỏ';
            } else if (size === 'S') {
                descriptionInput.value = 'Nhỏ';
            } else if (size === 'M') {
                descriptionInput.value = 'Vừa';
            } else if (size === 'L') {
                descriptionInput.value = 'Lớn';
            } else if (size === 'XL') {
                descriptionInput.value = 'Rộng';
            } else if (size === '2XL') {
                descriptionInput.value = 'Cực lớn';
            } else if (size === '3XL') {
                descriptionInput.value = 'Siêu lớn';
            } else if (size === 'Tiêu chuẩn') {
                descriptionInput.value = 'Tiêu chuẩn';
            } else {
                descriptionInput.value = ''; // Nếu không chọn kích thước, miêu tả sẽ trống
            }
        });

        // Giữ nguyên miêu tả ban đầu khi page load
        window.onload = function() {
            var size = document.getElementById('size').value;
            var descriptionInput = document.getElementById('description');
            
            if (size === 'XS') {
                descriptionInput.value = 'Rất Nhỏ';
            } else if (size === 'S') {
                descriptionInput.value = 'Nhỏ';
            } else if (size === 'M') {
                descriptionInput.value = 'Vừa';
            } else if (size === 'L') {
                descriptionInput.value = 'Lớn';
            } else if (size === 'XL') {
                descriptionInput.value = 'Rộng';
            } else if (size === '2XL') {
                descriptionInput.value = 'Cực lớn';
            } else if (size === '3XL') {
                descriptionInput.value = 'Siêu lớn';
            } else if (size === 'Tiêu chuẩn') {
                descriptionInput.value = 'Tiêu chuẩn';
            } 

            
            
        };
    </script>
@endsection
