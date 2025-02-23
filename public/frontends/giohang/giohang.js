$(document).ready(function () {
    $('#addToCartButton').on('click', function() {
        // Gửi yêu cầu AJAX để thêm sản phẩm vào giỏ hàng
        $.ajax({
            url: $('#addToCartForm').attr('action'), // Lấy URL từ form action
            method: 'POST',
            data: $('#addToCartForm').serialize(), // Lấy dữ liệu từ form (bao gồm CSRF)
            success: function(response) {
                // Cập nhật số lượng giỏ hàng và tổng giá trị
                $('#cart-count').text(response.cartCount);
                $('#cart-total').text(response.totalPrice + 'đ');
                // Hiển thị thông báo thành công
                $('#cart-notification').fadeIn().delay(2000).fadeOut(); // Hiển thị thông báo tạm thời
            },
            error: function() {
                alert('Có lỗi xảy ra, vui lòng thử lại');
            }
        });
    });

    // Tăng số lượng sản phẩm
    $('.increase').on('click', function () {
        var id = $(this).data('id');
        var input = $(this).closest('.flex').find('.quantity-input');
        var qty = parseInt(input.val()) + 1;
        input.val(qty);
        updateCart(id, qty);
    });

    // Giảm số lượng sản phẩm
    $('.decrease').on('click', function () {
        var id = $(this).data('id');
        var input = $(this).closest('.flex').find('.quantity-input');
        var qty = parseInt(input.val()) - 1;
        if (qty < 1) qty = 1; // Đảm bảo số lượng không nhỏ hơn 1
        input.val(qty);
        updateCart(id, qty);
    });

    // Hàm gửi AJAX để cập nhật giỏ hàng
    function updateCart(id, qty) {
        $.ajax({
            url: "/gio-hang/cap-nhat/" + id, // Route cập nhật giỏ hàng
            method: "GET",
            data: { qty: qty },
            success: function(response) {
                if (response.success) {
                    // Cập nhật lại tổng giá trị giỏ hàng trên trang
                    $('#total-price').text(response.totalPrice + 'đ');
                    // Cập nhật lại số lượng giỏ hàng trong navbar
                    $('#cart-count').text(response.cartCount);
                    $('#cart-total').text(response.totalPrice + 'đ');
                } else {
                    alert('Cập nhật giỏ hàng không thành công');
                }
            },
            error: function() {
                alert('Có lỗi xảy ra, vui lòng thử lại');
            }
        });
    }
    
});
