@extends('layouts.master')
@section('title', 'Giỏ hàng rỗng')
@section('content')
    <div class="container py-5 mb-lg-3">
        <div class="row justify-content-center pt-lg-4 text-center">
            <div class="col-lg-7 col-md-8 col-sm-9">
                <img class="d-block mx-auto mb-5" src="{{ asset('images/giohangrong.jfif') }}" width="340" />
                <h1 class="h3">Giỏ hàng rỗng</h1>
                <h3 class="h5 fw-normal mb-4">Xin vui lòng ghé thăm cửa hàng và tiến hành chọn sản phẩm.</h3>
                <p class="fs-md mb-4">
                    <u>Dưới đây là một số liên kết gợi ý:</u>
                </p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-10">
                <div class="row">
                    <div class="col-sm-4 mb-3">
                        <a class="card h-100 border-0 shadow-sm" href="{{ route('frontend.home') }}">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <i class="ci-home text-primary h4 mb-0"></i>
                                    <div class="ps-3">
                                        <h5 class="fs-sm mb-0">Trang chủ</h5>
                                        <span class="text-muted fs-ms">Quay lại trang chủ</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <a class="card h-100 border-0 shadow-sm" href="#">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <i class="ci-search text-success h4 mb-0"></i>
                                    <div class="ps-3">
                                        <h5 class="fs-sm mb-0">Tìm kiếm</h5>
                                        <span class="text-muted fs-ms">Tìm trong cửa hàng</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <a class="card h-100 border-0 shadow-sm" href="#">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <i class="ci-help text-info h4 mb-0"></i>
                                    <div class="ps-3">
                                        <h5 class="fs-sm mb-0">Tin tức & Trợ giúp</h5>
                                        <span class="text-muted fs-ms">Truy cập trung tâm trợ giúp</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
