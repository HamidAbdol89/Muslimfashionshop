// Hàm xóa cookie
function deleteCookie(name) {
    document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
}

// Hàm kiểm tra và áp dụng chế độ sáng
function applyLightMode() {
    // Xóa trạng thái dark mode trong localStorage
    localStorage.removeItem('darkMode');
    
    // Xóa cookie darkMode nếu có
    deleteCookie('darkMode');
    
    // Đảm bảo không có lớp 'dark' trên body (tạo giao diện sáng)
    document.body.classList.remove('dark');
    
    // Cập nhật các thuộc tính CSS cho chế độ sáng (nếu cần)
    document.body.style.backgroundColor = '#fff'; // Màu nền sáng
    document.body.style.color = '#333'; // Màu chữ tối
}

// Hàm kiểm tra trạng thái dark mode
function checkAndApplyMode() {
    // Kiểm tra trong localStorage nếu darkMode đã được lưu
    const darkMode = localStorage.getItem('darkMode') || getCookie('darkMode');
    
    // Nếu có giá trị darkMode và là 'true', áp dụng chế độ dark
    if (darkMode === 'true') {
        document.body.classList.add('dark');
        document.body.style.backgroundColor = '#333'; // Nền tối
        document.body.style.color = '#fff'; // Màu chữ sáng
    } else {
        // Nếu không có hoặc giá trị là false, áp dụng chế độ sáng
        applyLightMode();
    }
}

// Hàm lấy giá trị từ cookie
function getCookie(name) {
    const nameEQ = name + "=";
    const ca = document.cookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i].trim();
        if (c.indexOf(nameEQ) === 0) {
            return c.substring(nameEQ.length, c.length);
        }
    }
    return null;
}

// Gọi hàm kiểm tra và áp dụng chế độ khi trang được tải
checkAndApplyMode();

// Nếu bạn muốn thay đổi chế độ khi người dùng tương tác, ví dụ như click vào nút
document.getElementById('toggleDarkMode').addEventListener('click', function() {
    // Kiểm tra nếu darkMode đang bật
    const isDarkMode = localStorage.getItem('darkMode') === 'true';

    if (isDarkMode) {
        // Nếu darkMode đang bật, chuyển sang chế độ sáng
        applyLightMode();
    } else {
        // Nếu chế độ sáng, bật dark mode
        document.body.classList.add('dark');
        document.body.style.backgroundColor = '#333'; // Nền tối
        document.body.style.color = '#fff'; // Màu chữ sáng

        // Lưu lại trạng thái dark mode
        localStorage.setItem('darkMode', 'true');
        document.cookie = "darkMode=true; path=/;"; // Lưu vào cookie
    }
});
