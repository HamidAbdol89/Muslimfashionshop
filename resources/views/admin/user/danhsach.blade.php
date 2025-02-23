@extends('layouts.admin')

@section('title')
    <title>Danh sách user</title>
@endsection

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admins/phantrang/custom.css') }}">
    
    <style>
        /* Áp dụng các style từ giao diện slider */
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(45deg, #121212, #1c1c28);
            color: #ddd;
            margin: 0;
            padding: 0;
        }

        .table-container {
            margin-top: 5px;
            border-radius: 15px;
            background: linear-gradient(135deg, #2c2c39, #3d3d5e);
            box-shadow: 0px 12px 60px rgba(0, 0, 0, 0.8);
            overflow: hidden;
            transition: transform 0.3s ease-out, box-shadow 0.3s ease;
        }

        .table-container:hover {
            transform: scale(1.05);
            box-shadow: 0px 20px 80px rgba(0, 0, 0, 0.9);
        }

        table {
            overflow-y: auto;
            max-height: 500px;
        }

        .table th, .table td {
            padding: 15px 20px;
            text-align: left;
            font-size: 16px;
            color: #f1f1f1;
            background-color: #2b2b36;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
            transition: all 0.3s ease-out;
        }

        .table tr:hover {
            background-color: #44444e;
            transform: translateY(-5px);
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .table th:hover, .table td:hover {
            transform: scale(1.05);
            background-color: #4d4d5e;
        }

        .header-title {
            color: #00c3ff;
            font-size: 30px;
            font-weight: bold;
            text-shadow: 4px 4px 10px rgba(0, 0, 0, 0.7);
            margin-bottom: 15px;
            transition: transform 0.3s ease, color 0.3s ease;
        }

        .header-title:hover {
            transform: translateY(-5px);
            color: #ff00ff;
        }

        .btn-success {
            background-color: #28a745;
            color: white;
            padding: 10px 25px;
            border-radius: 8px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.4);
            transition: all 0.3s ease;
        }

        .btn-success:hover {
            background-color: #218838;
            transform: scale(1.1);
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.6);
        }

        .btn-danger:hover {
            background-color: #c82333;
            transform: scale(1.1);
        }

        /* Gradient cho button */
.btn-gradient {
    background: linear-gradient(135deg, #4CAF50, #2e8b57); /* Gradient xanh lá */
    border: none;
    transition: all 0.3s ease;
}

.btn-gradient:hover {
    background: linear-gradient(135deg, #388E3C, #2e6e47); /* Gradient màu đậm hơn khi hover */
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    transform: translateY(-2px);
}

/* Hiệu ứng hover cho dropdown-item */
.dropdown-item {
    background-color: #222222;
    transition: background-color 0.3s ease, color 0.3s ease;
    padding: 10px 20px;
    border-radius: 8px;
}

/* Hover item */
.dropdown-item:hover {
    background: linear-gradient(45deg, #007bff, #6a1b9a);
    color: white;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

/* Cải tiến bóng đổ cho dropdown */
.dropdown-menu {
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
}

/* Hover cho menu */
.dropdown-menu-right {
    background-color: #292b2f;
    border-radius: 12px;
    padding: 10px;
}

/* Các item khi hover, đổi nền thành gradient */
.dropdown-item:hover {
    background: linear-gradient(45deg, #007bff, #6a1b9a);
    color: white;
}

/* Cải thiện hiệu ứng khi nhấn vào nút */
.btn-gradient:active {
    background: linear-gradient(135deg, #388E3C, #2e6e47); /* Gradient đậm hơn khi nhấn */
    box-shadow: none;
    transform: translateY(2px);
}

/* Tạo bóng đổ cho menu */
.dropdown-menu {
    box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
    border-radius: 12px;
}

/* Tùy chỉnh transition mượt mà */
.dropdown-menu-right {
    transition: all 0.3s ease-in-out;
}
    
    </style>
@endsection


@section('content')
    @include('partials.content-header', ['name' => '', 'key' => ''])

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="header-title">
                        Danh sách User
                    </div>
                </div>

                <div class="col-md-12 mb-2">
                    <a href="{{ route('users.them') }}" class="btn btn-success float-right m-2">Thêm mới</a>
                </div>

                <div class="col-md-12">
                    <div class="card shadow-lg rounded-lg">
                        <div class="card-body">
                            <div class="table-container">
                                <table class="min-w-full table-auto">
                                    <thead class="bg-gray-700 text-white">
                                        <tr>
                                            <th class="py-3 px-4 text-left">#</th>
                                            <th class="py-3 px-4 text-left">Tên User</th>
                                            <th class="py-3 px-4 text-left">Email</th>
                                            <th class="py-3 px-4 text-center">Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-gray-800 text-white">
                                        @foreach($users as $user)
                                            <tr>
                                                <td class="py-3 px-4">{{ $user->id }}</td>
                                                <td class="py-3 px-4">{{ $user->name }}</td>
                                                <td class="py-3 px-4">{{ $user->email }}</td>
                                                <td class="py-3 px-4 text-center">
                                                    <a href="{{ route('users.sua', ['id' => $user->id]) }}" class="btn btn-primary btn-sm mr-2">
                                                        <i class="fas fa-edit"></i> Sửa
                                                    </a>
                                                    <a href="javascript:void(0)" data-url="{{ route('users.xoa', ['id' => $user->id]) }}" class="btn btn-danger btn-sm action_delete">
                                                        <i class="fas fa-trash"></i> Xóa
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="pagination-container">
                                    {!! $users->links() !!} 
                                </div>
                            </div>
                        </div>                       
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('vendors/sweetAlert2/sweetalert2@11.js') }}"></script>
    
    @if(session('add_success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Thêm thành công!',
                    text: "{{ session('add_success') }}",
                    confirmButtonText: 'Đóng'
                });
            });
        </script>
    @endif
    @if(session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Cập nhật thành công!',
                    text: "{{ session('success') }}",
                    confirmButtonText: 'Đóng'
                });
            });
        </script>
    @endif
    @if(session('error'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Có lỗi xảy ra!',
                    text: "{{ session('error') }}",
                    confirmButtonText: 'Đóng'
                });
            });
        </script>
    @endif

    <script> 
 $(document).ready(function() {
    $('body').on('click', 'ul.pagination a', function(e) {
        e.preventDefault(); // Ngăn việc tải lại trang

        var url = $(this).attr('href'); // Lấy URL từ liên kết phân trang

        // Ẩn phần bảng và phân trang khi chuyển trang
        $('tbody').fadeOut(300); // Mờ phần bảng
        $('.pagination-container').fadeOut(300); // Mờ phần phân trang

        // Gửi yêu cầu AJAX
        $.ajax({
            url: url,
            method: 'GET',
            success: function(response) {
                // Cập nhật phần nội dung bảng với dữ liệu mới
                $('tbody').html(response.data); // Cập nhật bảng dữ liệu
                $('.pagination-container').html(response.pagination); // Cập nhật phân trang

                // Hiển thị lại phần bảng và phân trang với hiệu ứng fade
                $('tbody').fadeIn(300); // Hiển thị lại phần bảng
                $('.pagination-container').fadeIn(300); // Hiển thị lại phân trang
            },
            error: function() {
                alert('Có lỗi xảy ra, vui lòng thử lại!');
            }
        });
    });
});
    </script>

<script>
        $(document).on('click', '.action_delete', function () {
            const url = $(this).data('url');
            const row = $(this).closest('tr');
            Swal.fire({
                title: 'Bạn có chắc không?',
                text: "Bạn không thể khôi phục lại hành động này!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Xóa ngay!',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'GET',
                        url: url,
                        success: function (response) {
                            if (response.code === 200) {
                                Swal.fire(
                                    'Đã xóa!',
                                    response.message,
                                    'success'
                                );
                                row.fadeOut(300, function() {
                                    row.remove();
                                });
                            } else {
                                Swal.fire('Lỗi!', response.message, 'error');
                            }
                        },
                        error: function () {
                            Swal.fire('Lỗi!', 'Xóa không thành công!', 'error');
                        }
                    });
                }
            });
        });
    </script>



@endsection
