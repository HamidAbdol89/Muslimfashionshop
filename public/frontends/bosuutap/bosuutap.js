var swiper = new Swiper('.main-swiper', {
    loop: true,  // Cho phép vòng lặp (có thể bỏ qua nếu không cần)
    autoplay: {
        delay: 3000,  // Thời gian giữa mỗi slide (3 giây)
        disableOnInteraction: false, // Giữ autoplay ngay cả khi người dùng tương tác
    },
    pagination: {
        el: '.swiper-pagination',
        clickable: true,  // Cho phép click vào pagination để chuyển slide
    },
    navigation: {
        nextEl: '.icon-arrow-right',
        prevEl: '.icon-arrow-left',
    },
    slidesPerView: 3, // Hiển thị 1 slide mỗi lần
});
