<section class="blog py-5">
  <div class="container">
    <div class="d-flex flex-wrap justify-content-between align-items-center mt-5 mb-3">
      <h4 class="text-uppercase">Blog thời trang Muslim</h4>
      <a href="blog.html" class="btn-link">Xem tất cả</a>
    </div>
    <div class="row">
      <!-- Bài viết 1: Phong cách Streetwear Muslim -->
      <div class="col-md-4">
        <article class="post-item">
          <div class="post-image">
            <a href="blog-details.html">
              <img src="{{ asset('images/muslim-attire6.jpg') }}" alt="Phong cách streetwear Muslim" class="post-grid-image img-fluid">
            </a>
          </div>
          <div class="post-content d-flex flex-wrap gap-2 my-3">
            <div class="post-meta text-uppercase fs-6 text-secondary">
              <span class="post-category">Phong cách /</span>
              <span class="meta-day">11 tháng 7, 2024</span>
            </div>
            <h5 class="post-title text-uppercase">
              <a href="blog-details.html">Phong cách streetwear Muslim</a>
            </h5>
            <p>Khám phá cách phối đồ với phong cách streetwear dành cho Muslim, nơi thời trang đường phố được kết hợp với sự tinh tế và tôn trọng văn hóa. Tìm hiểu những bộ trang phục năng động nhưng vẫn giữ được vẻ đẹp thanh lịch và phù hợp với các giá trị truyền thống.</p>
          </div>
        </article>
      </div>

      <!-- Bài viết 2: Fashion đỉnh cao cho phụ nữ Muslim hiện đại -->
      <div class="col-md-4">
        <article class="post-item">
          <div class="post-image">
            <a href="blog-details.html">
              <img src="{{ asset('images/muslim-attire5.jpg') }}" alt="Thời trang Muslim nữ hiện đại" class="post-grid-image img-fluid">
            </a>
          </div>
          <div class="post-content d-flex flex-wrap gap-2 my-3">
            <div class="post-meta text-uppercase fs-6 text-secondary">
              <span class="post-category">Thời trang nữ /</span>
              <span class="meta-day">11 tháng 8, 2024</span>
            </div>
            <h5 class="post-title text-uppercase">
              <a href="blog-details.html">Thời trang Muslim nữ hiện đại</a>
            </h5>
            <p>Thời trang Muslim nữ hiện đại không chỉ tôn vinh vẻ đẹp của sự kín đáo mà còn mang đến sự trẻ trung và năng động. Khám phá những xu hướng mới nhất trong trang phục của phụ nữ Muslim với thiết kế độc đáo và đầy sáng tạo.</p>
          </div>
        </article>
      </div>

      <!-- Bài viết 3: Fashion đỉnh cao cho phụ nữ Muslim hiện đại -->
      <div class="col-md-4">
        <article class="post-item">
          <div class="post-image">
            <a href="blog-details.html">
              <img src="{{ asset('images/muslim-attire4.jpg') }}" alt="Phong cách thời trang Muslim hiện đại" class="post-grid-image img-fluid">
            </a>
          </div>
          <div class="post-content d-flex flex-wrap gap-2 my-3">
            <div class="post-meta text-uppercase fs-6 text-secondary">
              <span class="post-category">Thời trang nữ /</span>
              <span class="meta-day">11 tháng 9, 2024</span>
            </div>
            <h5 class="post-title text-uppercase">
              <a href="blog-details.html">Thời trang Muslim hiện đại cho phụ nữ</a>
            </h5>
            <p>Thời trang Muslim hiện đại cho phụ nữ là sự kết hợp giữa tính thời trang và các giá trị văn hóa. Các thiết kế sáng tạo mang lại sự thoải mái và sang trọng, phù hợp với nhịp sống hiện đại và vẫn giữ vững truyền thống.</p>
          </div>
        </article>
      </div>
    </div>
  </div>
</section>

<style>
.post-image {
  position: relative;
  width: 100%;
  height: 0;
  padding-top: 63.48%; /* Tỷ lệ 292/460 * 100 */
  overflow: hidden;
}

.post-image img {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover; /* Đảm bảo ảnh không bị biến dạng */
}

</style>
