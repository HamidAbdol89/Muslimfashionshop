@extends('layouts.admin')

<!-- Thêm CSS của Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

@section('content')
    @include('partials.content-header', ['name' => 'Màu sắc', 'key' => 'Thêm'])

    <div class="container">
        <form action="{{ route('colors.store') }}" method="POST">
            @csrf

            <!-- Dropdown chọn sản phẩm với ô tìm kiếm bằng datalist -->
            <div class="form-group">
                <label for="product_id">Sản phẩm</label>
                <input list="products" name="product_id" id="product_id" class="form-control" required
                    placeholder="Chọn sản phẩm">
                <datalist id="products">
                    @foreach ($product as $product)
                        <option value="{{ $product->id }} - {{ $product->name }}">
                    @endforeach
                </datalist>
                @error('product_id')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Hiển thị ảnh chi tiết sản phẩm -->
            <div class="form-group" id="product_images" style="display: none;">
                <label for="images">Ảnh chi tiết</label>
                <div id="image_container">
                    <!-- Các ảnh chi tiết sẽ được tải vào đây khi chọn sản phẩm -->
                </div>
            </div>

           <!-- Trường input ẩn để lưu image_path -->
<input type="hidden" name="image_path[]" id="selected_image_path" value="">

<!-- Hiển thị ảnh chi tiết sản phẩm -->
<div class="form-group" id="product_images" style="display: none;">
    <label for="images">Ảnh chi tiết</label>
    <div id="image_container">
        <!-- Các ảnh chi tiết sẽ được tải vào đây khi chọn sản phẩm -->
    </div>
</div>

<script>
   // Hàm để chọn nhiều ảnh và lưu vào input hidden
function selectImage(imgElement, imagePath) {
    // Lấy hoặc tạo danh sách các ảnh đã chọn
    let selectedImages = $('#selected_image_path').val();
    selectedImages = selectedImages ? selectedImages.split(',') : [];
    
    // Kiểm tra nếu ảnh đã được chọn
    if (selectedImages.includes(imagePath)) {
        // Nếu đã chọn, bỏ chọn ảnh (xoá khỏi danh sách)
        selectedImages = selectedImages.filter(function(item) {
            return item !== imagePath;
        });
        $(imgElement).removeClass('selected');
    } else {
        // Nếu chưa chọn, thêm ảnh vào danh sách
        selectedImages.push(imagePath);
        $(imgElement).addClass('selected');
    }

    // Cập nhật giá trị input hidden để gửi danh sách ảnh đã chọn
    $('#selected_image_path').val(selectedImages.join(','));
}

</script>


            <!-- Dropdown chọn màu sắc -->
            <div class="form-group">
                <label for="color">Chọn màu sắc</label>
                <select name="color" id="color" class="form-control" required>
                    <option value="">Chọn màu sắc</option>
                    <option value="other" {{ old('color') == 'other' ? 'selected' : '' }}>Khác (Nhập màu sắc)</option>
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
            <div class="form-group" id="other_color" style="display: none;">
                <label for="other_color_input">Nhập màu sắc khác</label>
                <input type="text" name="other_color" id="other_color_input" class="form-control"
                    placeholder="Nhập màu sắc khác">
                @error('other_color')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Thêm Màu Sắc</button>
        </form>
    </div>

    <!-- Bao gồm jQuery và Select2 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

        // JavaScript để hiển thị ảnh chi tiết sản phẩm khi chọn sản phẩm
        $('#product_id').on('input', function() {
    var selectedProductId = $(this).val().split(' - ')[0]; // Lấy ID sản phẩm từ lựa chọn, chỉ lấy phần trước dấu "-"
    // Đảm bảo chỉ truyền ID số nguyên vào
    if (selectedProductId) {
        // Gửi request Ajax để lấy ảnh chi tiết cho sản phẩm đã chọn
        $.ajax({
            url: '/get-product-images/' + selectedProductId, // URL đến API để lấy ảnh chi tiết
            method: 'GET',
            success: function(data) {
                var imagesHtml = '';
                if (data.images && data.images.length > 0) {
                    data.images.forEach(function(image) {
                        var imageUrl = '{{ asset('storage/') }}' + '/' + image.image_path.replace(/^http:\/\/localhost:8001\/storage\//, '').replace(/^http:\/\/127.0.0.1:8001\/storage\//, '');
                        
                        // Tạo HTML cho ảnh chi tiết và thêm thuộc tính data-image-id
                        imagesHtml += '<img src="' + imageUrl + '" class="img-fluid mb-2" style="max-width: 200px;" onclick="selectImage(this, ' + image.id + ')">';
                    });
                    $('#product_images').show();
                    $('#image_container').html(imagesHtml);
                } else {
                    $('#product_images').hide();
                    $('#image_container').html('Không có ảnh chi tiết cho sản phẩm này.');
                }
            },
            error: function() {
                $('#product_images').hide();
                $('#image_container').html('Không thể tải ảnh chi tiết.');
            }
        });
    } else {
        $('#product_images').hide();
        $('#image_container').html('');
    }
});


        
    </script>

    <style>
        /* CSS cho ảnh được chọn */
        .selected {
            border: 3px solid #00c3ff;  /* Viền màu sáng để hiển thị ảnh được chọn */
            opacity: 0.7;  /* Làm mờ ảnh đã chọn */
        }

        #image_container {
    display: flex; /* Sử dụng flexbox */
    flex-wrap: wrap; /* Bố trí ảnh trên nhiều hàng nếu vượt quá chiều rộng */
    gap: 10px; /* Khoảng cách giữa các ảnh */
}

#image_container img {
    max-width: 150px; /* Chiều rộng tối đa cho ảnh */
    height: auto; /* Giữ tỉ lệ khung hình */
    cursor: pointer; /* Con trỏ hiển thị dạng pointer khi hover */
    transition: transform 0.3s; /* Hiệu ứng thu phóng khi hover */
}

#image_container img:hover {
    transform: scale(1.1); /* Thu phóng ảnh khi hover */
}

    </style>
@endsection
