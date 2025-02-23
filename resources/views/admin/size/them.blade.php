@extends('layouts.admin')

@section('content')
    <div class="container">
        @include('partials.content-header', ['name' => 'Kích thước', 'key' => 'Thêm'])

        <form action="{{ route('sizes.store') }}" method="POST">
            @csrf
        
            <div class="form-group">
                <label for="category_id">Danh mục</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    <option value="">Chọn danh mục</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->id }} - {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
        
            <div class="form-group">
                <label for="size">Kích thước</label>
                <select name="size" id="size" class="form-control" required>
                    <option value="">Chọn kích thước</option>
                    <option value="XS" {{ old('size') == 'XS' ? 'selected' : '' }}>XS</option>
                    <option value="S" {{ old('size') == 'S' ? 'selected' : '' }}>S</option>
                    <option value="M" {{ old('size') == 'M' ? 'selected' : '' }}>M</option>
                    <option value="L" {{ old('size') == 'L' ? 'selected' : '' }}>L</option>
                    <option value="XL" {{ old('size') == 'XL' ? 'selected' : '' }}>XL</option>
                    <option value="2XL" {{ old('size') == '2XL' ? 'selected' : '' }}>2XL</option>
                    <option value="3XL" {{ old('size') == '3XL' ? 'selected' : '' }}>3XL</option>
                    <option value="Tiêu chuẩn" {{ old('size') == 'Tiêu chuẩn' ? 'selected' : '' }}>Tiêu chuẩn</option>
                </select>
                @error('size')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
        
            <div class="form-group">
                <label for="description">Miêu tả</label>
                <input type="text" name="description" id="description" class="form-control" required value="{{ old('description') }}" readonly>
                @error('description')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
        
            <button type="submit" class="btn btn-primary mt-3">Lưu</button>
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
    </script>
@endsection
