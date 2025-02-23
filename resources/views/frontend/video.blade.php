<section class="video py-5 overflow-hidden">
  <div class="container-fluid">
    <div class="row">
      <div class="video-content open-up" data-aos="zoom-out">
        <div class="video-bg">
          <img src="{{ asset('images/video-image.jpg') }}" alt="video" class="video-image img-fluid">
        </div>
        <div class="video-player">
          <img src="{{ asset('images/video-image.jpg') }}" alt="video" class="video-image img-fluid">
          <iframe src="https://www.youtube.com/embed/LKxOxhILovI?si=86Yk_Myudm7FbOxs" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

          <div class="play-button">
            <svg width="50" height="50" viewBox="0 0 24 24">
              <use xlink:href="#play"></use>
            </svg>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>




<style>
.video-player {
  position: relative;
  padding-bottom: 56.25%; /* Tỷ lệ khung hình 16:9 */
  height: 0;
  overflow: hidden;
  width: 100%; /* Đảm bảo video chiếm toàn bộ chiều rộng */
  max-width: 100%; /* Đảm bảo video không vượt quá kích thước container */
  margin: 0 auto; /* Căn giữa video */
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Đổ bóng cho video */
  border-radius: 8px; /* Làm mềm các góc */
}

.video-player iframe {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  border-radius: 8px;
  opacity: 0;
  transition: opacity 0.3s ease-in-out;
}

.video-player img {
  width: 100%;
  height: 100%;
  border-radius: 8px;
  object-fit: cover; /* Đảm bảo ảnh vừa vặn với khung */
}

.video-player .play-button {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 1;
  opacity: 0;
  transition: opacity 0.3s ease-in-out;
  cursor: pointer;
}

.video-player:hover iframe {
  opacity: 1; /* Hiển thị video khi hover */
}






</style>