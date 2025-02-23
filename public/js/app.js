// Đoạn mã JavaScript cho chức năng giỏ hàng hoặc các tính năng động khác
const cartCount = document.querySelector('.cart-count');
let cartItems = 0;

// Hàm thêm sản phẩm vào giỏ
document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', () => {
        cartItems++;
        cartCount.textContent = cartItems;
    });
});
