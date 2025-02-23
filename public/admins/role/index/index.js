



function actionDelete(event) {
    event.preventDefault();
    let urlRequest = $(this).data('url');
    let that = $(this);

    Swal.fire({
        title: "Bạn có chắc chắn?",
        text: "Dữ liệu sẽ bị xóa!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Đồng ý xóa",
        cancelButtonText: "Hủy",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "GET", // Phương thức GET (hoặc DELETE nếu route hỗ trợ)
                url: urlRequest,
                success: function (data) {
                    if (data.code === 200) {
                        that.parent().parent().remove(); // Xóa dòng hiện tại khỏi bảng
                        Swal.fire({
                            title: "Đã xóa!",
                            text: "Sản phẩm đã được xóa thành công.",
                            icon: "success",
                        });
                    }
                },
                error: function (error) {
                    Swal.fire({
                        title: "Lỗi!",
                        text: "Không thể xóa sản phẩm. Vui lòng thử lại.",
                        icon: "error",
                    });
                },
            });
        }
    });
}

$(function () {
    $(document).on("click", ".action_delete", actionDelete);
});


