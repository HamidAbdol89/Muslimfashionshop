@extends('layouts.admin')

@section('title')
    <title>Sửa User</title>
@endsection

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('vendors/select2/select2.min.css') }}" rel="stylesheet" />
    <style>
        /* Hiệu ứng fade-in */
        .fade-in {
            animation: fadeIn 1.5s ease-out forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Hiệu ứng hover cho card */
        .card-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.6);
            transition: all 0.4s ease-in-out;
        }

        /* Ripple Effect */
        .button-ripple {
            position: relative;
            overflow: hidden;
        }

        .button-ripple:after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            opacity: 0;
            transition: all 0.5s ease-out;
        }

        .button-ripple:active:after {
            width: 200px;
            height: 200px;
            opacity: 1;
        }

        /* Nền gradient động */
        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .dynamic-bg {
            background: linear-gradient(270deg, #1c1c28, #2e2e44, #00c3ff, #7b2cbf);
            background-size: 400% 400%;
            animation: gradientMove 15s ease infinite;
        }

        /* Cải thiện màu sắc của select2 */
        .select2-container--default .select2-selection--multiple {
            background-color: #2d2d44 !important;
            border: 1px solid #3b3b58 !important;
            border-radius: 8px;
            padding: 5px;
            color: white;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #00c3ff !important;
            border: none !important;
            color: white !important;
            border-radius: 6px;
            padding: 2px 6px;
            font-size: 14px;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #fff;
            font-weight: bold;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
            color: #ff4c4c;
        }

        /* Cải thiện thẻ Tag đã chọn */
.select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #8c6cf2 !important; /* Màu nền cho tags */
    border: none !important;
    color: white !important;
    border-radius: 15px;
    font-size: 14px;
    padding: 6px 12px 6px 12px; /* Cải thiện padding */
    margin-right: 8px; /* Khoảng cách giữa các tag */
    margin-bottom: 8px; /* Khoảng cách giữa các tag */
    transition: all 0.2s ease;
}

/* Hover hiệu ứng cho tags */
.select2-container--default .select2-selection--multiple .select2-selection__choice:hover {
    background-color: #7b56c3 !important;
    cursor: pointer;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
}

/* Xóa tag */
.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    color: #fff;
    font-weight: bold;
    background-color: transparent;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-left: 10px; /* Tăng khoảng cách giữa chữ tag và nút xóa */
    margin-right: -8px; /* Thêm margin-right để không có khoảng cách thừa */
    font-size: 16px; /* Cải thiện kích thước của nút xóa */
    position: relative;
    top: -2px; /* Đưa nút xóa lên cao một chút */
}

/* Hover hiệu ứng khi xóa tag */
.select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
    color: #ff4c4c;
    transform: scale(1.2);
}

/* Cải thiện dropdown cho Select2 */
.select2-container--default .select2-results__option {
    background-color: #1c1c28;
    color: #fff;
    border-radius: 8px;
    padding: 8px 12px;
    transition: all 0.2s ease;
}

/* Hover hiệu ứng cho dropdown item */
.select2-container--default .select2-results__option:hover {
    background-color: #00c3ff;
    color: white;
    cursor: pointer;
}

/* Hover hiệu ứng khi chọn trong dropdown */
.select2-container--default .select2-results__option[aria-selected="true"] {
    background-color: #009acd;
    color: white;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
}

/* Khi trình duyệt điền tự động, thay đổi nền để phù hợp */
input:-webkit-autofill {
    background-color: #1c1c28 !important; /* Nền tối khi autofill */
    color: white !important; /* Màu chữ trắng */
    box-shadow: 0 0 0 30px #1c1c28 inset !important; /* Đảm bảo không có viền màu trắng */
}

input:-webkit-autofill:focus {
    background-color: #1c1c28 !important; /* Nền tối khi autofill và focus */
    color: white !important;
    box-shadow: 0 0 0 30px #1c1c28 inset !important;
}

    </style>
@endsection


@section('content')


    <div class="content dynamic-bg">
        <div class="container mx-auto px-4 py-12">
            <div class="max-w-lg mx-auto bg-gray-900 text-white rounded-xl shadow-xl overflow-hidden relative card-hover">
                <div class="absolute inset-0 bg-gradient-to-br from-purple-700 via-black to-blue-900 opacity-30 blur-xl rounded-xl"></div>
                <div class="relative z-10">
                    <div class="bg-gradient-to-r from-purple-700 to-blue-700 p-6 text-center rounded-t-xl fade-in">
                        <i class="fas fa-user-edit text-4xl mb-2 text-purple-300"></i>
                        <h1 class="text-3xl font-bold mb-2">Sửa User</h1>
                        <p class="text-sm text-gray-300">Chỉnh sửa thông tin user</p>
                    </div>

                    <div class="p-6 fade-in">
                        <form action="{{ route('users.update', ['id' => $user->id]) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                            @csrf

                            <!-- Tên -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-400">Tên</label>
                                <input type="text" class="w-full mt-1 px-4 py-3 bg-gray-800 text-white rounded-lg border border-gray-700 focus:ring-2 focus:ring-purple-500 focus:outline-none" name="name" value="{{ $user->name }}" placeholder="Nhập tên" required>
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-400">Email</label>
                                <input type="email" class="w-full mt-1 px-4 py-3 bg-gray-800 text-white rounded-lg border border-gray-700 focus:ring-2 focus:ring-blue-500 focus:outline-none" name="email" value="{{ $user->email }}" placeholder="Nhập email" required autocomplete="off">
                            </div>

                            <!-- Password -->
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-400">Password</label>
                                <input type="password" class="w-full mt-1 px-4 py-3 bg-gray-800 text-white rounded-lg border border-gray-700 focus:ring-2 focus:ring-purple-500 focus:outline-none" name="password" placeholder="Nhập password">
                            </div>

                          


                            <!-- Nút xác nhận -->
                            <div class="text-center mt-6">
                                <button type="submit" class="bg-gradient-to-r from-blue-500 to-purple-500 text-white font-semibold py-3 px-8 rounded-lg shadow-lg hover:from-blue-600 hover:to-purple-600 transform hover:scale-110 transition duration-300 button-ripple">
                                    Cập nhật User
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('admins/user/add/add.js') }}"></script>
    <script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
    <script>
    $(document).ready(function() {
        // Khởi tạo Select2 chỉ cho phép chọn vai trò từ danh sách, không cho phép nhập tag mới
        $('.select2_init').select2({
            placeholder: "Chọn vai trò",
            allowClear: true,
            tags: false, // Tắt tính năng tạo tag mới
            tokenSeparators: [',', ' '], // Cho phép phân tách bằng dấu phẩy hoặc dấu cách nhưng không tạo tag mới
        });
    });
</script>


    
@endsection
