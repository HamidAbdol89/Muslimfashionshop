<section class="instagram position-relative">
    <div class="d-flex justify-content-center w-100 position-absolute bottom-0 z-1">
      <a href="https://www.instagram.com/dolab.hamid/" class="btn btn-dark px-5">Follow us on Instagram</a>
    </div>
    <div class="row g-0">
      <div class="col-6 col-sm-4 col-md-2">
        <div class="insta-item">
          <a href="https://www.instagram.com/dolab.hamid/" target="_blank">
            <img src="{{ asset('images/insta-item1.jpg') }}" alt="instagram" class="insta-image img-fluid">
          </a>
        </div>
      </div>
      <div class="col-6 col-sm-4 col-md-2">
        <div class="insta-item">
          <a href="https://www.instagram.com/dolab.hamid/" target="_blank">
            <img src="{{ asset('images/insta-item2.jpg') }}" alt="instagram" class="insta-image img-fluid">
          </a>
        </div>
      </div>
      <div class="col-6 col-sm-4 col-md-2">
        <div class="insta-item">
          <a href="https://www.instagram.com/dolab.hamid/" target="_blank">
            <img src="{{ asset('images/insta-item3.jpg') }}" alt="instagram" class="insta-image img-fluid">
          </a>
        </div>
      </div>
      <div class="col-6 col-sm-4 col-md-2">
        <div class="insta-item">
          <a href="https://www.instagram.com/dolab.hamid/" target="_blank">
            <img src="{{ asset('images/insta-item4.jpg') }}" alt="instagram" class="insta-image img-fluid">
          </a>
        </div>
      </div>
      <div class="col-6 col-sm-4 col-md-2">
        <div class="insta-item">
          <a href="https://www.instagram.com/dolab.hamid/" target="_blank">
            <img src="{{ asset('images/insta-item5.jpg') }}" alt="instagram" class="insta-image img-fluid">
          </a>
        </div>
      </div>
      <div class="col-6 col-sm-4 col-md-2">
        <div class="insta-item">
          <a href="https://www.instagram.com/dolab.hamid/" target="_blank">
            <img src="{{ asset('images/insta-item6.jpg') }}" alt="instagram" class="insta-image img-fluid">
          </a>
        </div>
      </div>
    </div>
  </section>

  <style>
  .insta-item {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 400px; /* Đảm bảo chiều cao của item */
    width: 100%;
    overflow: hidden;
  }

  .insta-image {
    width: 400px !important; /* Đảm bảo chiều rộng cố định */
    height: 400px !important; /* Đảm bảo chiều cao cố định */
    object-fit: contain !important; /* Đảm bảo ảnh không bị cắt xén */
    object-position: center !important; /* Canh giữa ảnh */
    max-width: 100% !important; /* Đảm bảo ảnh không vượt quá 100% chiều rộng */
    max-height: 100% !important; /* Đảm bảo ảnh không vượt quá 100% chiều cao */
  }
</style>
