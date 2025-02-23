document.addEventListener("DOMContentLoaded", function() {
    // Kiểm tra các session thông báo
    if (window.addSuccessMessage) {
        Swal.fire({
            icon: 'success',
            title: 'Thêm thành công!',
            text: window.addSuccessMessage,
            confirmButtonText: 'Đóng'
        });
    }

    if (window.updateSuccessMessage) {
        Swal.fire({
            icon: 'success',
            title: 'Cập nhật thành công!',
            text: window.updateSuccessMessage,
            confirmButtonText: 'Đóng'
        });
    }

    if (window.errorMessage) {
        Swal.fire({
            icon: 'error',
            title: 'Có lỗi xảy ra!',
            text: window.errorMessage,
            confirmButtonText: 'Đóng'
        });
    }

    // Xử lý phân trang
    $('body').on('click', 'ul.pagination a', function(e) {
        e.preventDefault(); // Ngăn việc tải lại trang
        var url = $(this).attr('href'); // Lấy URL từ liên kết phân trang

        // Ẩn phần bảng và phân trang khi chuyển trang
        $('tbody').fadeOut(300); // Mờ phần bảng
        $('.pagination-container').fadeOut(300); // Mờ phần phân trang

        // Gửi yêu cầu AJAX
        $.ajax({
            url: url,
            method: 'GET',
            success: function(response) {
                // Cập nhật phần nội dung bảng với dữ liệu mới
                $('tbody').html(response.data); // Cập nhật bảng dữ liệu
                $('.pagination-container').html(response.pagination); // Cập nhật phân trang

                // Hiển thị lại phần bảng và phân trang với hiệu ứng fade
                $('tbody').fadeIn(300); // Hiển thị lại phần bảng
                $('.pagination-container').fadeIn(300); // Hiển thị lại phân trang
            },
            error: function() {
                alert('Có lỗi xảy ra, vui lòng thử lại!');
            }
        });
    });

    // Xóa danh mục với SweetAlert2
    $(document).on('click', '.action-delete', function () {
        const url = $(this).data('url');
        const row = $(this).closest('tr'); // Lấy dòng chứa phần tử cần xóa
        Swal.fire({
            title: 'Bạn có chắc không?',
            text: "Bạn không thể khôi phục lại hành động này!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Xóa ngay!',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'GET',  // Sử dụng GET
                    url: url,
                    success: function (response) {
                        if (response.code === 200) {
                            Swal.fire(
                                'Đã xóa!',
                                response.message,
                                'success'
                            );
                            // Xóa dòng phần tử trong bảng mà không reload lại trang
                            row.fadeOut(300, function() {
                                row.remove();  // Xóa phần tử khỏi DOM sau khi fadeOut
                            });
                        } else {
                            Swal.fire(
                                'Lỗi!',
                                response.message,
                                'error'
                            );
                        }
                    },
                    error: function (xhr) {
                        Swal.fire(
                            'Lỗi!',
                            'Xóa không thành công!',
                            'error'
                        );
                    }
                });
            }
        });
    });
});
