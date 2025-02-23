 // Khởi tạo Swiper chỉ cho phần Best Sellers
 var swiper = new Swiper('#best-sellers .product-swiper', {
    slidesPerView: 5,
    spaceBetween: 30,
    navigation: {
        nextEl: '#best-sellers .icon-arrow-right',
        prevEl: '#best-sellers .icon-arrow-left',
    },
    pagination: {
        el: '#best-sellers .swiper-pagination',
        clickable: true,
    },
    breakpoints: {
        1200: {
            slidesPerView: 5,
        },
        992: {
            slidesPerView: 4,
        },
        768: {
            slidesPerView: 3,
        },
        576: {
            slidesPerView: 2,
        },
        320: {
            slidesPerView: 1,
        },
    },
});