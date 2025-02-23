// Gọi API lấy sản phẩm ngẫu nhiên
fetch('/random-products') // Đảm bảo URL này trỏ tới controller của bạn
    .then(response => response.json())
    .then(products => {
        const productList = document.getElementById('random-products-list');
        productList.innerHTML = ''; // Xóa dữ liệu cũ nếu có

        // Duyệt qua danh sách sản phẩm và hiển thị
        products.forEach(product => {
            const productItem = `
                <div class="swiper-slide">
                    <div class="product-item image-zoom-effect link-effect" data-product-id="${product.id}">
                        <div class="image-holder">
                            <a href="${product.detail_url}">
                                <img src="${product.feature_image_path}" alt="${product.name}" class="product-image img-fluid">
                            </a>
                            <a href="#" class="btn-icon btn-wishlist" data-product-id="${product.id}">
                                <svg width="24" height="24" viewBox="0 0 24 24">
                                    <use xlink:href="#heart"></use>
                                </svg>
                            </a>
                            <div class="product-content">
                                <h5 class="text-uppercase fs-5 mt-3">
                                    <a href="${product.detail_url}">${product.name}</a>
                                </h5>
                                <a href="${product.detail_url}" class="text-decoration-none" data-after="Thêm vào giỏ hàng">
                                    <span>${product.price}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            productList.innerHTML += productItem; // Thêm sản phẩm vào danh sách
        });

        // Khởi tạo lại Swiper sau khi thay đổi DOM
        const swiper = new Swiper('.product-swiper', {
            slidesPerView: 4,
            spaceBetween: 30,
            navigation: {
                nextEl: '.icon-arrow-right',
                prevEl: '.icon-arrow-left',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
    })
    .catch(error => console.error('Error fetching random products:', error));

// Sự kiện nhấn nút yêu thích
document.querySelectorAll('click', function(event) {
    if (event.target.closest('.btn-wishlist')) {
        event.preventDefault(); // Ngăn cuộn trang
        const button = event.target.closest('.btn-wishlist');
        const productId = button.getAttribute('data-product-id');

        // Gửi yêu cầu AJAX
        fetch('/khach-hang/add-to-favorites', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({ product_id: productId }),
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);

            if (data.message === 'Đã thêm vào danh sách yêu thích!') {
                // Thay đổi màu sắc của nút sau khi thêm sản phẩm yêu thích
                button.classList.add('added-to-favorites');
            }
        })
        .catch(error => {
            console.error('Lỗi:', error);
            alert('Không thể thêm vào danh sách yêu thích!');
        });
    }
});




