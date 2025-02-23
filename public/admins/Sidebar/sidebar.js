$(document).ready(function() {
    // Ẩn gợi ý tìm kiếm ban đầu
    $(".ui-menu").hide();

    // Khi người dùng bắt đầu gõ vào ô tìm kiếm
    $(".form-control-sidebar").on('input', function() {
        var query = $(this).val();  // Lấy giá trị người dùng nhập vào

        // Kiểm tra nếu có dữ liệu nhập vào
        if(query.length > 0) {
            // Hiển thị gợi ý
            $(".ui-menu").show();
            // Tạo các gợi ý (thay thế nội dung theo dữ liệu thực tế)
            $(".ui-menu").html(`
                <li class="ui-menu-item">Sản phẩm ${query}</li>
                <li class="ui-menu-item">Danh mục: ${query}</li>
            `);
        } else {
            // Nếu không có dữ liệu thì ẩn gợi ý
            $(".ui-menu").hide();
        }
    });

    // Khi người dùng hover vào một gợi ý, thay đổi màu nền
    $(document).on('mouseenter', '.ui-menu-item', function() {
        $(this).css('background-color', '#34495e');
        $(this).css('color', '#00c3ff');
    });

    // Khi người dùng chọn gợi ý, thêm lớp 'selected'
    $(document).on('click', '.ui-menu-item', function() {
        $(this).addClass('selected').siblings().removeClass('selected');
    });

    // Ẩn gợi ý khi người dùng click ra ngoài
    $(document).click(function(event) {
        if (!$(event.target).closest(".form-inline").length) {
            $(".ui-menu").hide();
        }
    });

    $('.nav-item.dropdown').on('click', function () {
        $(this).children('.dropdown-menu').slideToggle();
    });
});
