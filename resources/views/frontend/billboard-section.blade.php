
<section id="billboard" class="bg-light py-5">
    <div class="container">
        <div class="row justify-content-center">
            <h1 class="section-title text-center mt-4" data-aos="fade-up">Bộ sưu tập mới</h1>
            <div class="col-md-6 text-center" data-aos="fade-up" data-aos-delay="300">
                <p>Đây là bộ sưu tập mới nhất của chúng tôi, với các sản phẩm thời trang độc đáo và phong cách, hứa hẹn sẽ làm bạn hài lòng. Hãy khám phá ngay để tìm ra những món đồ yêu thích!</p>
            </div>
        </div>
        <div class="row">
            <div class="swiper main-swiper py-4" data-aos="fade-up" data-aos-delay="600">
                <div class="swiper-wrapper d-flex border-animation-left">
                    @foreach($sliders->whereIn('id', [1, 2, 3, 4, 5, 6]) as $slider)
                        <div class="swiper-slide">
                            <div class="banner-item image-zoom-effect">
                                <div class="image-holder">
                                    <a href="{{ route('frontend.Bosuutap.index') }}">
                                        <img src="{{ asset($slider->image_path) }}" alt="{{ $slider->name }}" class="img-fluid">
                                    </a>
                                </div>
                                <div class="banner-content py-4">
                                    <h5 class="element-title text-uppercase">
                                        <a href="#" class="item-anchor">{{ $slider->name }}</a>
                                    </h5>
                                    <p>{{ $slider->description }}</p>
                                    <div class="btn-left">
                                        <a href="{{ route('frontend.Bosuutap.index') }}" class="btn-link fs-6 text-uppercase item-anchor text-decoration-none">Khám phá ngay</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
            <div class="icon-arrow icon-arrow-left">
                <svg width="50" height="50" viewBox="0 0 24 24">
                    <use xlink:href="#arrow-left"></use>
                </svg>
            </div>
            <div class="icon-arrow icon-arrow-right">
                <svg width="50" height="50" viewBox="0 0 24 0">
                    <use xlink:href="#arrow-right"></use>
                </svg>
            </div>
        </div>
    </div>
</section>


