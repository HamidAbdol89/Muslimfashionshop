@extends('layouts.admin')

@section('title')
    <title>Permission</title>
@endsection

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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

        /* Thêm khoảng cách và căn chỉnh */
        .form-container {
            max-width: 900px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .card {
            margin-bottom: 1.5rem;
        }

        .input-field {
            width: 100%;
            padding: 0.75rem;
            font-size: 1rem;
            border-radius: 0.5rem;
            border: 1px solid #333;
            background-color: #2c2f38;
            color: white;
        }

        .checkbox-wrapper {
            margin-right: 10px;
        }

        /* Bố cục cho phần nhập liệu */
        .role-info {
            display: flex;
            justify-content: center;
            gap: 2rem;
        }

        .role-info > div {
            width: 45%;
        }

        .checkbox-group {
            margin-left: 1rem;
        }

        /* Bố cục cho Quyền hạn */
        .permissions-wrapper {
            display: flex;
            justify-content: space-between;
            gap: 1.5rem;
            flex-wrap: wrap;
        }

        .permissions-column {
            width: 48%; /* Chia thành 2 cột */
        }

        .card-header {
            background-color: #4A4A58;
            color: white;
            padding: 1rem;
        }

        .card-body {
            background-color: #333;
            padding: 1rem;
        }


        
    </style>
@endsection


@section('content')

<div class="content dynamic-bg">
    <div class="container mx-auto px-4 py-12">
        <!-- Card -->
        <div class="max-w-4xl mx-auto bg-gray-900 text-white rounded-xl shadow-xl overflow-hidden relative card-hover">
            <!-- Glowing Effect -->
            <div class="absolute inset-0 bg-gradient-to-br from-purple-700 via-black to-blue-900 opacity-30 blur-xl rounded-xl"></div>
            <div class="relative z-10">
                <!-- Header -->
                <div class="bg-gradient-to-r from-purple-700 to-blue-700 p-6 text-center rounded-t-xl fade-in">
                    <i class="fas fa-user-shield text-4xl mb-2 text-purple-300"></i>
                    <h1 class="text-3xl font-bold mb-2">Thêm Quyền Hạn</h1>
                    <p class="text-sm text-gray-300">Nhập thông tin để tạo quyền hạn mới</p>
                </div>

                <!-- Form -->
                <div class="p-6 fade-in">
                    <form action="{{ route('permissions.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div class="role-info">
                            <!-- Chọn Tên Module -->
                            <div class="form-group">
                                <label for="module_parent" class="block text-sm font-medium text-gray-400">Chọn tên module</label>
                                <select name="module_parent" id="module_parent" class="input-field">
                                    <option value="">Chọn tên module</option>
                                    @foreach(config('permissions.table_module') as $moduleItem)
                                        <option value="{{ $moduleItem }}" {{ old('module_parent') == $moduleItem ? 'selected' : '' }}>
                                            {{ $moduleItem }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Chọn Module Con -->
                        <div class="form-group">
                            <div class="flex items-center space-x-2">
                                <input type="checkbox" id="checkall" class="checkall custom-checkbox">
                                <label for="checkall" class="text-gray-400">Chọn tất cả module con</label>
                            </div>

                            <div class="permissions-wrapper grid grid-cols-2 gap-4">
                                @foreach(config('permissions.module_childrent') as $moduleItemChildrent)
                                    <div class="permissions-column">
                                        <div class="card bg-gray-800 rounded-lg shadow-md card-hover hover:shadow-xl transition-shadow duration-300">
                                            <div class="card-body space-y-2">
                                                <div class="flex items-center space-x-2">
                                                    <input type="checkbox" name="module_chilrent[]" value="{{ $moduleItemChildrent }}" id="module_childrent_{{ $moduleItemChildrent }}" class="checkbox-childrent custom-checkbox">
                                                    <label for="module_childrent_{{ $moduleItemChildrent }}" class="text-white">{{ $moduleItemChildrent }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Nút Xác Nhận -->
                        <div class="text-center">
                            <button type="submit"
                                    class="button-ripple bg-purple-500 text-white px-6 py-3 rounded-full mt-4 transition-all hover:bg-purple-600">
                                <i class="fas fa-save mr-2"></i>Lưu Quyền Hạn
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
    <script src="{{ asset('admins/role/add/add.js') }}"></script>
    <script src="{{ asset('vendors/sweetAlert2/sweetalert2@11.js') }}"></script>

    <script>
        // Xử lý sự kiện checkall
        document.querySelector('.checkall').addEventListener('change', function() {
            let isChecked = this.checked;
            document.querySelectorAll('.checkbox-childrent').forEach(checkbox => {
                checkbox.checked = isChecked;
            });

            // Đảm bảo rằng các checkbox "module" được đánh dấu nếu tất cả quyền con được chọn
            document.querySelectorAll('.checkbox-parent').forEach(parentCheckbox => {
                let childCheckboxes = parentCheckbox.closest('.card').querySelectorAll('.checkbox-childrent');
                let allChecked = Array.from(childCheckboxes).every(child => child.checked);
                parentCheckbox.checked = allChecked;
            });
        });

        // Xử lý sự kiện chọn/deselect cho các module
        document.querySelectorAll('.checkbox-parent').forEach(parentCheckbox => {
            parentCheckbox.addEventListener('change', function() {
                let isChecked = this.checked;
                let childCheckboxes = this.closest('.card').querySelectorAll('.checkbox-childrent');
                childCheckboxes.forEach(child => {
                    child.checked = isChecked;
                });

                // Tự động đánh dấu hoặc bỏ chọn "checkall" nếu tất cả checkbox con được chọn
                let allParentCheckboxes = document.querySelectorAll('.checkbox-parent');
                let allChecked = Array.from(allParentCheckboxes).every(checkbox => checkbox.checked);
                document.querySelector('.checkall').checked = allChecked;
            });
        });
    </script>
@endsection