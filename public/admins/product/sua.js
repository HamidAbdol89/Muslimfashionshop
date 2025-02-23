// Khởi tạo Select2 cho Tags
document.addEventListener('DOMContentLoaded', function () {
    $('.tags_select_choose').select2({
        placeholder: "Chọn tags",
        allowClear: true,
        tags: true, // Cho phép thêm tags mới khi người dùng nhập vào
        tokenSeparators: [',', ' '], // Dùng dấu phẩy hoặc khoảng trắng để phân tách tags
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

    // Hiển thị preview ảnh chi tiết (Detail Images)
    document.getElementById('detail-image-input').addEventListener('change', function (event) {
        var files = event.target.files; // Lấy tất cả các file ảnh được chọn
        var previewContainer = document.getElementById('detail-image-preview');
        previewContainer.innerHTML = ''; // Xóa ảnh cũ nếu có

        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            if (file) {
                var reader = new FileReader(); // Khởi tạo FileReader để đọc ảnh
                reader.onload = function (e) {
                    var imgElement = document.createElement('img');
                    imgElement.src = e.target.result; // Gán ảnh mới cho thẻ <img>

                    imgElement.onload = function () {
                        var width = imgElement.width;
                        var height = imgElement.height;

                        // Tính toán tỷ lệ phù hợp để đảm bảo ảnh có kích thước hợp lý
                        var maxWidth = 150;  // Đặt kích thước tối đa
                        var maxHeight = 150; // Đặt chiều cao tối đa
                        var ratio = Math.min(maxWidth / width, maxHeight / height);

                        // Thay đổi kích thước ảnh sao cho tỷ lệ hợp lý
                        imgElement.width = width * ratio;
                        imgElement.height = height * ratio;
                    };

                    imgElement.classList.add('preview-image'); // Thêm lớp CSS cho ảnh preview
                    previewContainer.appendChild(imgElement); // Thêm ảnh vào container
                };
                reader.readAsDataURL(file); // Đọc ảnh dưới dạng base64
            }
        }
    });

    // Hiển thị preview nhiều ảnh
    document.getElementById('image-input').addEventListener('change', function (event) {
        var previewContainer = document.getElementById('image-preview-container');
        previewContainer.innerHTML = ''; // Clear any previous previews
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
