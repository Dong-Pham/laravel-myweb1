<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng nhập hệ thống</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: "Segoe UI", sans-serif;
        }

        .login-box {
            width: 420px;
            border-radius: 20px;
            background: #fff;
            padding: 35px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        }

        .login-title {
            text-align: center;
            font-weight: 700;
            color: #333;
            margin-bottom: 25px;
        }

        .form-control {
            border-radius: 10px;
            padding: 12px;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, .25);
        }

        .btn-login {
            background: #667eea;
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            transition: .3s;
        }

        .btn-login:hover {
            background: #5563c1;
        }

        .forgot-password {
            display: block;
            text-align: center;
            margin-top: 15px;
            text-decoration: none;
            color: #667eea;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="login-box">

        <form action="{{ route('admin.login.post') }}" method="POST">

            @csrf

            <h2 class="login-title">
                Đăng nhập hệ thống
            </h2>


            {{-- Hiển thị thông báo lỗi --}}
            <x-admin.alert></x-admin.alert>


            <div class="mb-3">
                <label for="f-username" class="form-label">
                    Username
                </label>

                <input type="text" class="form-control" id="f-username" placeholder="Nhập username" name="username"
                    value="{{ old('username') }}">
            </div>


            <div class="mb-3">

                <label for="f-password" class="form-label">
                    Mật khẩu
                </label>

                <input type="password" class="form-control" id="f-password" placeholder="Nhập mật khẩu" name="password"
                    value="{{ old('password') }}">

            </div>


            <div class="form-check mb-4">

                <input class="form-check-input" type="checkbox" name="remember" id="remember">

                <label class="form-check-label" for="remember">
                    Ghi nhớ đăng nhập
                </label>

            </div>


            <button type="submit" class="btn btn-login text-white w-100">
                Đăng nhập
            </button>


            <a href="{{ route('admin.forgotpass') }}" class="forgot-password">
                Quên mật khẩu?
            </a>


        </form>

    </div>


</body>

</html>
