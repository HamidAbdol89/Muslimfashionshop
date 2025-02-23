document.addEventListener('DOMContentLoaded', function() {
    const detailImages = document.querySelectorAll('.product-detail-image');
    let timeoutId; // Biến lưu trữ timeout để hủy sau khi thay đổi ảnh chính
    const changeDuration = 9000; // Thời gian tự động quay lại ảnh chính (3 giây)

    detailImages.forEach((detailImage) => {
        const targetId = detailImage.getAttribute('data-target');
        const mainImage = document.querySelector(targetId);

        // Lưu ảnh chính ban đầu để có thể quay lại
        const originalImageSrc = mainImage.src;

        // Khi nhấn vào ảnh chi tiết
        detailImage.addEventListener('click', function() {
            // Thêm hiệu ứng mờ dần cho ảnh chính
            mainImage.classList.add('fade');
            setTimeout(function() {
                // Sau khi ẩn ảnh chính, thay đổi src ảnh chính
                mainImage.src = detailImage.src;

                // Hiệu ứng fade-in cho ảnh chính sau khi thay đổi
                setTimeout(function() {
                    mainImage.classList.remove('fade');
                    mainImage.classList.add('shadow'); // Thêm hiệu ứng bóng cho ảnh
                }, 100);  // Delay nhẹ trước khi bỏ mờ ảnh chính

            }, 500);  // Đảm bảo ảnh chính bị ẩn trước khi thay đổi

            // Hủy timeout nếu ảnh chi tiết được nhấn lại
            clearTimeout(timeoutId);

            // Đặt lại timeout để quay lại ảnh chính sau 3 giây
            timeoutId = setTimeout(function() {
                // Quay lại ảnh chính sau thời gian
                mainImage.classList.add('fade');
                setTimeout(function() {
                    mainImage.src = originalImageSrc;
                    mainImage.classList.remove('fade');
                    mainImage.classList.remove('shadow');
                }, 500); // Đợi hiệu ứng mờ trước khi quay lại ảnh chính
            }, changeDuration);
        });
    });
});
