@extends('layouts.master')
@section('title', 'Đăng ký tài khoản')
@section('content')

<div class="container py-5 my-5">
    <div class="row justify-content-center align-items-center">
        <!-- Phần ảnh bên trái -->
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-lg rounded-5 overflow-hidden">
                <div class="card-body p-0">
                    <img src="{{ asset('images/loginPicture.jpg') }}" alt="Login Picture" class="img-fluid w-100 h-100 object-cover">
                </div>
            </div>
        </div>

        <!-- Phần đăng ký bên phải -->
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-lg rounded-5 overflow-hidden" data-aos="fade-up" data-aos-delay="200">
                <div class="card-body p-5">
                    <h3 class="text-center mb-5 text-primary fw-bold">Tạo tài khoản mới!</h3>

                    @if($errors->any())
                    <div class="alert alert-danger mb-4" role="alert">
                        <i class="ci-close-circle me-2"></i>{{ $errors->first() }}
                    </div>
                    @endif

                    <form action="{{ route('user.postDangKy') }}" method="POST">
                        @csrf
                        <div class="form-group mb-4">
                            <label for="name" class="form-label">Họ và tên</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control rounded-pill @error('name') is-invalid @enderror transition-all duration-300 hover:border-blue-500 focus:ring-2 focus:ring-blue-500" placeholder="Nhập họ và tên" required>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="email" class="form-label">Địa chỉ email</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control rounded-pill @error('email') is-invalid @enderror transition-all duration-300 hover:border-blue-500 focus:ring-2 focus:ring-blue-500" placeholder="Nhập email" required>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-4 position-relative">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <div class="input-group">
                                <input type="password" id="password" name="password" class="form-control rounded-pill @error('password') is-invalid @enderror transition-all duration-300 hover:border-blue-500 focus:ring-2 focus:ring-blue-500" placeholder="Nhập mật khẩu" required>
                                <button class="btn btn-outline-secondary bg-transparent border-0 position-absolute top-50 end-0 translate-middle-y hover:bg-transparent" type="button" id="toggle-password">
                                    <i class="ci-eye"></i>
                                </button>
                            </div>
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="password-confirm" class="form-label">Xác nhận mật khẩu</label>
                            <input type="password" id="password-confirm" name="password_confirmation" class="form-control rounded-pill @error('password_confirmation') is-invalid @enderror transition-all duration-300 hover:border-blue-500 focus:ring-2 focus:ring-blue-500" placeholder="Nhập lại mật khẩu" required>
                            @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-center">
                            <button class="btn btn-primary rounded-pill py-2 w-100 shadow-lg transition-all ease-in-out duration-300 transform hover:scale-105 hover:bg-primary-dark hover:shadow-2xl" type="submit">
                                <i class="ci-user me-2"></i>Đăng ký
                            </button>
                        </div>
                    </form>

                    <div class="text-center mt-4">
                        <p class="mb-2 text-muted">Hoặc đăng ký với</p>
                        <div class="d-flex justify-content-center">
                            <a href="#" class="btn-social bs-google me-2 mb-2 rounded-pill shadow-lg transition-all hover:scale-105 hover:bg-google hover:shadow-2xl">
                                <i class="fab fa-google"></i>
                            </a>
                            <a href="#" class="btn-social bs-facebook me-2 mb-2 rounded-pill shadow-lg transition-all hover:scale-105 hover:bg-facebook hover:shadow-2xl">
                                <i class="fab fa-facebook"></i>
                            </a>
                            <a href="#" class="btn-social bs-twitter me-2 mb-2 rounded-pill shadow-lg transition-all hover:scale-105 hover:bg-twitter hover:shadow-2xl">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
    document.getElementById('toggle-password').addEventListener('click', function() {
        var passwordField = document.getElementById('password');
        var icon = this.querySelector('i');
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            icon.classList.replace('ci-eye', 'ci-eye-off');
        } else {
            passwordField.type = 'password';
            icon.classList.replace('ci-eye-off', 'ci-eye');
        }
    });

    AOS.init({
        duration: 1000,
        easing: 'ease-in-out',
        once: true,
    });
</script>
@endpush
