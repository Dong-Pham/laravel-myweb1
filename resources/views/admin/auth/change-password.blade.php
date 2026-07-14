<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Đổi mật khẩu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">


    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', sans-serif;
        }


        .password-card {

            width: 100%;
            max-width: 450px;

            background: white;

            border-radius: 25px;

            padding: 35px;

            box-shadow:
                0 20px 40px rgba(0, 0, 0, .2);

            animation: show .5s ease;

        }


        @keyframes show {

            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: none;
            }

        }


        .logo {

            width: 80px;
            height: 80px;

            border-radius: 50%;

            background: linear-gradient(135deg, #667eea, #764ba2);

            display: flex;
            justify-content: center;
            align-items: center;

            color: white;

            font-size: 38px;

            margin: auto;

        }



        h3 {

            font-weight: 700;

        }



        .user-box {

            background: #f8f9fa;

            padding: 15px;

            border-radius: 15px;

            display: flex;

            align-items: center;

            gap: 15px;

        }


        .avatar {

            width: 50px;
            height: 50px;

            background: #667eea;

            color: white;

            border-radius: 50%;

            display: flex;

            justify-content: center;

            align-items: center;

            font-size: 25px;

        }



        .input-group-text {

            background: #667eea;

            color: white;

            border: none;

        }



        .form-control {

            height: 45px;

        }


        .form-control:focus {

            border-color: #667eea;

            box-shadow: 0 0 0 .2rem rgba(102, 126, 234, .25);

        }



        .btn-update {

            background: linear-gradient(135deg, #667eea, #764ba2);

            border: none;

            color: white;

            height: 45px;

            border-radius: 25px;

            font-weight: 600;

            transition: .3s;

        }


        .btn-update:hover {

            transform: translateY(-2px);

            box-shadow: 0 10px 20px rgba(102, 126, 234, .4);

        }


        .btn-back {

            border-radius: 25px;

            height: 45px;

        }
    </style>

</head>


<body>


    <div class="password-card">


        <div class="text-center mb-4">

            <div class="logo mb-3">

                <i class="bi bi-shield-lock-fill"></i>

            </div>


            <h3>Đổi mật khẩu</h3>

            <p class="text-muted">
                Bảo vệ tài khoản của bạn
            </p>

        </div>



        <x-admin.alert />



        <div class="user-box mb-4">


            <div class="avatar">

                <i class="bi bi-person-fill"></i>

            </div>


            <div>

                <h6 class="mb-1 fw-bold">

                    {{ auth()->user()->fullname ?? auth()->user()->username }}

                </h6>


                <small class="text-muted">

                    {{ auth()->user()->email }}

                </small>

            </div>


        </div>




        <form action="{{ route('admin.change-password.post') }}" method="POST">

            @csrf



            <div class="mb-3">

                <label class="fw-semibold mb-2">
                    Mật khẩu cũ
                </label>


                <div class="input-group">

                    <span class="input-group-text">
                        <i class="bi bi-lock"></i>
                    </span>


                    <input type="password" class="form-control" name="old_password" placeholder="Nhập mật khẩu hiện tại"
                        required>


                </div>

            </div>




            <div class="mb-3">

                <label class="fw-semibold mb-2">
                    Mật khẩu mới
                </label>


                <div class="input-group">

                    <span class="input-group-text">
                        <i class="bi bi-key"></i>
                    </span>


                    <input type="password" class="form-control" name="new_password" placeholder="Nhập mật khẩu mới"
                        required minlength="6">


                </div>

            </div>





            <div class="mb-4">

                <label class="fw-semibold mb-2">
                    Xác nhận mật khẩu
                </label>


                <div class="input-group">


                    <span class="input-group-text">
                        <i class="bi bi-check-circle"></i>
                    </span>



                    <input type="password" class="form-control" name="new_password_confirmation"
                        placeholder="Nhập lại mật khẩu" required minlength="6">


                </div>


            </div>




            <div class="d-flex gap-3">


                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary btn-back flex-fill">

                    <i class="bi bi-arrow-left"></i>
                    Quay lại

                </a>



                <button class="btn btn-update flex-fill">

                    <i class="bi bi-save"></i>
                    Cập nhật

                </button>



            </div>


        </form>


    </div>


</body>

</html>
