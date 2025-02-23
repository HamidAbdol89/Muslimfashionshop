<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #17a2b8;
            height: 100vh;
        }
        #login .container #login-row #login-column #login-box {
            margin-top: 120px;
            max-width: 600px;
            height: auto;
            border: 1px solid #9C9C9C;
            background-color: #EAEAEA;
            padding: 20px;
        }
        #login .container #login-row #login-column #login-box #login-form {
            padding: 20px;
        }
        #login .container #login-row #login-column #login-box #login-form #register-link {
            margin-top: 10px;
        }
        .text-info {
            color: #17a2b8;
        }
        .btn-info {
            background-color: #17a2b8;
            border-color: #17a2b8;
        }
    </style>
</head>
<body>
    <div id="login">
        <h3 class="text-center text-white pt-5">Fashion Muslim </h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                    <form id="login-form" action="{{ route('admin.postLogin') }}" method="post">
    @csrf
    <h3 class="text-center text-info">Đăng nhập</h3>
    <div class="form-group">
        <label for="username" class="text-info">Username:</label><br>
        <input type="text" name="email" id="username" class="form-control">
    </div>
    <div class="form-group">
        <label for="password" class="text-info">Mật khẩu:</label><br>
        <input type="password" name="password" id="password" class="form-control">
    </div>
    <div class="form-group">
        <label for="remember-me" class="text-info"><span>Ghi nhớ</span>
        <input id="remember-me" name="remember_me" type="checkbox"></label><br>
        <input type="submit" name="submit" class="btn btn-info btn-md" value="Xác nhận">
    </div>
    <div id="register-link" class="text-right">
        <a href="{{ route('register') }}" class="text-info">Đăng ký ngay</a>
    </div>
</form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
