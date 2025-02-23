document.getElementById('image_path').addEventListener('change', function(event) {
    console.log('Ảnh đã được chọn');  // Kiểm tra trong console
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const imagePreview = document.getElementById('imagePreview');
            imagePreview.src = e.target.result;
            imagePreview.style.display = 'block';  // Hiển thị ảnh
        };
        reader.readAsDataURL(file);
    }
});


// Thêm animation khi tải trang
window.addEventListener('load', function() {
    const formCard = document.querySelector('.card');
    if (formCard) {
        formCard.style.animation = 'fadeInUp 0.5s ease-in-out';
    }
});
