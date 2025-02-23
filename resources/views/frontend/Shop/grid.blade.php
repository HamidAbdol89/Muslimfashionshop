<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Islamic Fashion Categories</title>
    <link rel="stylesheet" href="{{ asset('frontends/grid/grid.css') }}">
</head>
<body>
    <div class="container">
        <div class="card">
            <img src="{{ asset('images/grid2.jpg') }}" alt="Newborn & Hijab">
            <div class="card-content">
                <h3>Newborn & Hijab</h3>
                <p>Đủ loại hijab cho các nàng, màu sắc và kích thước đa dạng.</p>
                <a href="#" data-id="10" title="Hijab">All Hijab</a>
            </div>
        </div>
        <div class="card">
            <img src="{{ asset('images/grid1.jpg') }}" alt="Mens Jubba">
            <div class="card-content">
                <h3>Mens Jubba</h3>
                <p>Bộ sưu tập Jubba thiết kế dành riêng cho nam giới Hồi giáo.</p>
                <a href="#" data-id="7" title="Jubah">All Mens Jubah</a>
            </div>
        </div>
        <div class="card">
            <img src="{{ asset('images/grid3.jpg') }}" alt="Kids Jubba">
            <div class="card-content">
                <h3>Kids Jubba</h3>
                <p>Kids Jubba & Thobe cho bé trai từ 5 đến 12 tuổi với thiết kế mới.</p>
                <a href="#" data-id="13" title="Jubah trẻ em">Kids Thobe</a>
            </div>
        </div>
        <div class="card">
            <img src="{{ asset('images/grid4.jpg') }}" alt="Abaya / Jilbabs">
            <div class="card-content">
                <h3>Abaya / Jilbabs</h3>
                <p>Quần cạp chun với khóa kéo, được thiết kế để tạo sự thoải mái.</p>
                <a href="#" data-id="9" title="Abaya">Abaya / Jilbabs</a>
            </div>
        </div>
        <div class="card">
            <img src="{{ asset('images/grid5.jpg') }}" >
            <div class="card-content">
                <h3>Dầu thơm</h3>
                <p>Tất cả loại dầu thơm nam nữ, với mùi hương đặc sắc.</p>
                <a href="{{ route('frontend.Shop.ShopPhukien', ['category_id' => 20]) }}" title="Dầu thơm">All Perfume</a>

            </div>
        </div>

        <div class="card">
            <img src="{{ asset('images/grid6.png') }}" alt="Niquab">
            <div class="card-content">
                <h3>Niquab</h3>
                <p>Niqab cao cấp, Chất liệu thoáng mát, thiết kế tinh tế, tôn vinh nét đẹp kín đáo!.</p>
                <a href="#" data-id="11" title="Niquab">All Niquab</a>
            </div>
        </div>

        <div class="card">
            <img src="{{ asset('images/grid7.png') }}" alt="Thobe">
            <div class="card-content">
                <h3>Thobe</h3>
                <p>Thobe cao cấp, Sang trọng, thoải mái, chất liệu mềm mại, lý tưởng cho mọi dịp.</p>
                <a href="#" data-id="5" title="Thobe">All Thobe</a>
            </div>
        </div>

        <div class="card">
            <img src="{{ asset('images/grid8.jpg') }}" alt="Jubah Size">
            <div class="card-content">
                <h3>Jubah Size</h3>
                <p>Hướng dẫn chi tiết để đo kích cỡ Thobe/Jubba của bạn.</p>
                <a href="#" data-id="9" title="Abaya">Size Guide</a>
            </div>
        </div>
    </div>
</body>

<script>
    document.addEventListener('DOMContentLoaded', () => {
      const categoryLinks = document.querySelectorAll('.card-content a');
    
      categoryLinks.forEach(link => {
        link.addEventListener('click', (e) => {
          e.preventDefault(); // Ngăn chặn hành động mặc định của liên kết
          const categoryId = link.getAttribute('data-id'); // Lấy id từ data-id
          const categoryName = link.getAttribute('title'); // Lấy tiêu đề từ title
          window.location.href = `/search?query=${categoryName}&category_id=${categoryId}`; // Điều hướng với query và category_id
        });
      });
    });
</script>
</html>
