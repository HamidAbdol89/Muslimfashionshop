
    // Xử lý khi người dùng chọn một size
    document.querySelectorAll('.size-btn').forEach(button => {
        button.addEventListener('click', function() {
            // Xóa lớp active từ tất cả các nút
            document.querySelectorAll('.size-btn').forEach(btn => btn.classList.remove('active'));

            // Thêm lớp active vào nút được chọn
            this.classList.add('active');

            // Lưu lại size đã chọn
            const selectedSize = this.getAttribute('data-size');
            console.log('Size selected:', selectedSize);

            // Cập nhật thông tin khác nếu cần
            // Ví dụ: Cập nhật giá hoặc hình ảnh sản phẩm nếu size thay đổi
        });
    });

    // Xử lý phóng to ảnh khi rê chuột vào (Zoom Image)
    const magnifierContainer = document.querySelector('.img-magnifier-container');
    const magnifierImage = magnifierContainer.querySelector('img');
    const lens = magnifierContainer.querySelector('.img-lens'); // Lấy lens từ DOM

    let zoomLevel = 2; // Tỷ lệ phóng to
    let zoomFactor = 2; // Mức phóng to khi rê chuột vào

    magnifierContainer.addEventListener('mousemove', function(e) {
        const bounds = magnifierContainer.getBoundingClientRect();
        const xPos = e.clientX - bounds.left;
        const yPos = e.clientY - bounds.top;

        // Vị trí của lens (vùng zoom)
        lens.style.left = `${xPos - lens.offsetWidth / 2}px`;
        lens.style.top = `${yPos - lens.offsetHeight / 2}px`;

        // Tạo hiệu ứng phóng to từ vị trí chuột
        magnifierImage.style.transformOrigin = `${xPos}px ${yPos}px`;

        // Di chuyển ảnh phóng to theo lens
        magnifierImage.style.transform =
            `scale(${zoomLevel}) translate(-${xPos * zoomLevel - lens.offsetWidth / 2}px, -${yPos * zoomLevel - lens.offsetHeight / 2}px)`;
    });

    // Khi chuột rời khỏi ảnh, khôi phục lại ảnh
    magnifierContainer.addEventListener('mouseleave', function() {
        magnifierImage.style.transform = 'scale(1)';
        magnifierImage.style.transformOrigin = 'center center';
    });


    $(document).ready(function() {
        const stars = document.querySelectorAll('.star');
        const ratingValue = document.getElementById('rating-value');
        const userRating = parseInt(ratingValue.value); // Lấy giá trị rating từ input hidden

        // Nếu có rating trước đó, cập nhật sao đã chọn
        if (userRating > 0) {
            stars.forEach(star => {
                if (parseInt(star.getAttribute('data-index')) <= userRating) {
                    star.style.color = '#ffcc00'; // Màu vàng cho sao đã chọn
                } else {
                    star.style.color = '#ddd'; // Màu xám cho sao chưa chọn
                }
            });
        }

        // Xử lý khi người dùng click vào sao để đánh giá
        stars.forEach(star => {
            star.addEventListener('click', function() {
                const rating = this.getAttribute('data-index');
                ratingValue.value = rating; // Cập nhật giá trị rating vào input hidden

                // Cập nhật màu sắc sao đã chọn
                stars.forEach(star => {
                    if (star.getAttribute('data-index') <= rating) {
                        star.style.color = '#ffcc00'; // Màu vàng cho sao đã chọn
                    } else {
                        star.style.color = '#ddd'; // Màu xám cho sao chưa chọn
                    }
                });
            });
        });


        // Gửi form bằng AJAX
        $('#review-form').submit(function(e) {
            e.preventDefault(); // Ngừng gửi form thông thường

            var rating = $('#rating-value').val(); // Lấy giá trị đánh giá sao
            var comment = $('#comment').val(); // Lấy bình luận

            // Kiểm tra nếu chưa có rating
            if (rating == 0 || rating === "") {
                Swal.fire({
                    title: 'Lỗi!',
                    text: 'Vui lòng đánh giá sao trước khi gửi bình luận.',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
                return; // Dừng lại nếu chưa có rating
            }

            // Kiểm tra nếu không có bình luận
            if (comment.trim() === "") {
                Swal.fire({
                    title: 'Lỗi!',
                    text: 'Vui lòng nhập bình luận trước khi gửi.',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
                return; // Dừng lại nếu không có bình luận
            }

            $.ajax({
                url: $(this).attr('action'), // Địa chỉ route
                method: 'POST',
                data: {
                    _token: $('input[name="_token"]').val(),
                    rating: rating,
                    comment: comment
                },
                success: function(response) {
                    // Kiểm tra xem có đánh giá trước đó không
                    var existingReview = $(`#review-${response.review_id}`);
                    if (existingReview.length) {
                        // Cập nhật review đã có
                        existingReview.find('.review-body p').text(response.comment);
                        existingReview.find('.rating').html(response.rating_html);
                    } else {
                        // Thêm mới review
                        $('.review-list').prepend(`
                            <div class="review" id="review-${response.review_id}">
                                <p><strong>${response.user_name}</strong> - 
                                <span class="rating">
                                    ${response.rating_html}
                                </span>
                                </p>
                                <p>${response.comment}</p>
                            </div>
                        `);
                    }
                
                    // Hiển thị thông báo SweetAlert2 khi thành công
                    Swal.fire({
                        title: 'Thành công!',
                        text: 'Đánh giá và bình luận của bạn đã được lưu!',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                
                    // Reset form sau khi gửi thành công
                    $('#comment').val(''); // chỉ reset phần bình luận
                    updateStarRating(response.rating); // Cập nhật lại sao
                
                

                    // Reset form sau khi gửi thành công nhưng không làm mất trạng thái sao đã chọn
                    $('#review-form')[0].reset();
                    $('#comment-form')[0].reset();

                    // Cập nhật lại màu sao đã chọn (nếu có)
                    updateStarRating(response.rating);
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: 'Lỗi!',
                        text: 'Đã có lỗi xảy ra, vui lòng thử lại.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });


    });






            document.addEventListener('DOMContentLoaded', () => {
        const commentForm = document.getElementById('comment-form-container');
        let isFormVisible = false;

        window.addEventListener('scroll', () => {
            const scrollY = window.scrollY;

            if (scrollY > 300 && !isFormVisible) {
                commentForm.classList.add('visible');
                isFormVisible = true;
            } else if (scrollY <= 300 && isFormVisible) {
                commentForm.classList.remove('visible');
                isFormVisible = false;
            }
        });
    });



    function toggleFavorite(event, productId) {
        event.preventDefault(); // Ngừng gửi form khi nhấn
        var heartIcon = document.getElementById('heart-icon-' + productId);

        // Kiểm tra nếu trạng thái hiện tại là "outlined", chuyển thành "filled" và ngược lại
        if (heartIcon.classList.contains('outlined')) {
            heartIcon.classList.remove('outlined');
            heartIcon.classList.add('filled');
        } else {
            heartIcon.classList.remove('filled');
            heartIcon.classList.add('outlined');
        }

        // Gửi form yêu thích sau khi thay đổi trạng thái
        document.getElementById('favorite-form-' + productId).submit();
    }


    function changeMainImage(imageElement) {
        // Cập nhật src của hình ảnh chính
        const mainImage = document.getElementById('main-image');
        mainImage.src = imageElement.getAttribute('data-color-image');
    
        // Lấy tên màu từ thuộc tính 'data-color-name'
        const colorName = imageElement.getAttribute('data-color-name');
        
        // Hiển thị tên màu trong phần tử với id 'selected-color'
        const selectedColorText = document.getElementById('selected-color');
        selectedColorText.textContent = `Màu đã chọn: ${colorName}`;
    
        // Xóa các lớp màu cũ và lớp "selected"
        selectedColorText.classList.remove('red', 'blue', 'green', 'selected'); // Xóa các lớp màu và lớp selected cũ
    
        // Thêm lớp màu và in đậm chữ theo màu đã chọn
        switch (colorName.toLowerCase()) {
            case 'red':
                selectedColorText.classList.add('red', 'selected');
                break;
            case 'blue':
                selectedColorText.classList.add('blue', 'selected');
                break;
            case 'green':
                selectedColorText.classList.add('green', 'selected');
                break;
            default:
                selectedColorText.classList.add('selected'); // Thêm lớp selected mặc định nếu không có màu cụ thể
        }
    }
    document.addEventListener('DOMContentLoaded', function () {
        const toggleDescriptions = document.querySelectorAll('.toggle-description');
    
        toggleDescriptions.forEach(function (toggle) {
            const descriptionTitle = toggle.querySelector('.description-title');
            const defaultTitle = descriptionTitle.textContent; // Lưu tiêu đề mặc định ban đầu
    
            toggle.addEventListener('click', function () {
                const targetId = toggle.getAttribute('data-target');
                const content = document.getElementById(targetId);
                const arrow = toggle.querySelector('.arrow');
    
                // Kiểm tra trạng thái hiện tại và thay đổi trạng thái
                if (content.style.display === 'none' || content.style.display === '') {
                    content.style.display = 'block';
                    arrow.innerHTML = '&#9650;'; // Mũi tên lên
                    descriptionTitle.textContent = 'Đóng';
                } else {
                    content.style.display = 'none';
                    arrow.innerHTML = '&#9660;'; // Mũi tên xuống
                    descriptionTitle.textContent = defaultTitle; // Khôi phục tiêu đề mặc định
                }
            });
        });
    });
    
    document.addEventListener('DOMContentLoaded', function () {
        const toggles = document.querySelectorAll('.toggle-description');
    
        toggles.forEach(toggle => {
            const container = toggle.closest('.description-container');
            const description = container.querySelector('.description');
    
            toggle.addEventListener('click', () => {
                container.classList.toggle('open');
            });
        });
    });
    

    document.addEventListener("DOMContentLoaded", function() {
        const sizeButtons = document.querySelectorAll('.size-btn');
        const colorButtons = document.querySelectorAll('.color-btn');
        const addToCartBtn = document.getElementById('add-to-cart-btn');
        const sizeOptions = document.getElementById('size-options');
        const selectedColorText = document.getElementById('selected-color');
    
        // Hàm để cập nhật trạng thái của nút "Thêm vào giỏ hàng"
        function updateAddToCartButton() {
            let sizeSelected = sizeOptions.querySelector('.selected'); // Kiểm tra size được chọn
            let colorSelected = selectedColorText.textContent !== 'Chưa chọn màu'; // Kiểm tra màu được chọn
    
            // Nếu cả size và màu đều được chọn, hiển thị thông báo và đổi lại màu nút
            if (sizeSelected && colorSelected) {
                addToCartBtn.textContent = 'Thêm vào giỏ hàng';
                addToCartBtn.classList.remove('warning'); // Xóa lớp cảnh báo (màu đỏ)
                addToCartBtn.classList.add('normal'); // Thêm lớp màu bình thường
                addToCartBtn.disabled = false; // Cho phép thêm vào giỏ
    
                // Thêm hiệu ứng rung nếu đã chọn đầy đủ
                addToCartBtn.classList.add('shake');
                setTimeout(() => {
                    addToCartBtn.classList.remove('shake'); // Tắt hiệu ứng rung sau khi hoàn thành
                }, 500); // Thời gian rung (500ms)
            } else {
                // Nếu thiếu thông tin, thay đổi màu sắc nút thành cảnh báo
                addToCartBtn.classList.remove('normal'); // Loại bỏ màu bình thường
                addToCartBtn.classList.add('warning'); // Thêm màu cảnh báo (đỏ)
    
                // Thay đổi thông báo trên nút
                if (!sizeSelected && !colorSelected) {
                    addToCartBtn.textContent = 'Hãy chọn size và màu sắc!';
                } else if (!sizeSelected) {
                    addToCartBtn.textContent = 'Hãy chọn size!';
                } else if (!colorSelected) {
                    addToCartBtn.textContent = 'Hãy chọn màu sắc!';
                }
    
                addToCartBtn.disabled = true; // Ngăn người dùng thêm vào giỏ khi thiếu thông tin
            }
        }
    
        // Xử lý sự kiện click trên size buttons để chọn và bỏ chọn
        sizeButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                // Kiểm tra nếu nút hiện tại đã được chọn
                if (button.classList.contains('selected')) {
                    // Nếu đã chọn, bỏ chọn
                    button.classList.remove('selected');
                } else {
                    // Nếu chưa chọn, loại bỏ lớp 'selected' khỏi các nút khác
                    sizeButtons.forEach(function(btn) {
                        btn.classList.remove('selected');
                    });
                    // Thêm lớp 'selected' vào nút hiện tại
                    button.classList.add('selected');
                }
                // Cập nhật lại trạng thái nút "Thêm vào giỏ"
                updateAddToCartButton();
            });
        });
    
        // Xử lý hover vào màu sắc (hover effect)
        colorButtons.forEach(function(button) {
            button.addEventListener('mouseover', function() {
                // Cập nhật màu sắc đã chọn khi hover
                selectedColorText.textContent = button.getAttribute('data-color'); // Giả sử bạn có data-color để lưu màu sắc
                // Cập nhật lại trạng thái nút "Thêm vào giỏ"
                updateAddToCartButton();
            });
    
            button.addEventListener('mouseout', function() {
                // Nếu không chọn, thay đổi lại thông báo về màu
                if (!sizeOptions.querySelector('.selected')) {
                    selectedColorText.textContent = 'Chưa chọn màu';
                }
                // Cập nhật lại trạng thái nút "Thêm vào giỏ"
                updateAddToCartButton();
            });
    
            button.addEventListener('click', function() {
                // Nếu nhấp chuột vào màu, cập nhật lại thông báo về màu
                selectedColorText.textContent = button.getAttribute('data-color');
                updateAddToCartButton();
            });
        });
    
        // Cập nhật trạng thái nút khi trang được tải lần đầu
        updateAddToCartButton();
    });
    




    