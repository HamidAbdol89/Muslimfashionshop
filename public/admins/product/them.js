// Khởi tạo Select2 cho Tags
document.addEventListener('DOMContentLoaded', function () {
    $('.tags_select_choose').select2({
        placeholder: "Chọn tags",
        allowClear: true,
        tags: true, // Cho phép thêm tags mới khi người dùng nhập vào
        tokenSeparators: [',', ' '] // Dùng dấu phẩy hoặc khoảng trắng để phân tách tags
    });

    

    // Hiển thị preview ảnh đại diện (Feature Image)
    document.getElementById('feature-image-input').addEventListener('change', function (event) {
        var file = event.target.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var img = document.getElementById('feature-image');
                img.src = e.target.result;
                document.getElementById('feature-image-preview').style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });

    // Hiển thị preview cho nhiều ảnh
    document.getElementById('image-input').addEventListener('change', function (event) {
        var previewContainer = document.getElementById('image-preview-container');
        previewContainer.innerHTML = ''; // Xóa preview cũ nếu có
        Array.from(event.target.files).forEach(function (file) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = '100px';
                img.style.marginRight = '10px';
                previewContainer.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
    });
});
