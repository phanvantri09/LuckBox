<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        form {
            border: 3px solid #f1f1f1;
        }

        input[type=email],
        input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        button {
            background-color: #04AA6D;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            opacity: 0.8;
        }

        .cancelbtn {
            width: auto;
            padding: 10px 18px;
            background-color: #f44336;
        }

        .imgcontainer {
            text-align: center;
            margin: 24px 0 12px 0;
        }

        img.avatar {
            width: 40%;
            border-radius: 50%;
        }

        .container {
            padding: 16px;
        }

        span.psw {
            float: right;
            padding-top: 16px;
        }

        .main {
            padding: 100px 100px;
        }

        /* Change styles for span and cancel button on extra small screens */
        @media screen and (max-width: 600px) {
            span.psw {
                display: block;
                float: none;
            }

            .main {
                padding: 0px 0px;
            }

            .cancelbtn {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <div class="main">
        <h1 style="text-align: center">Đăng Nhập</h1>

        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="imgcontainer">
                <img src="img_avatar2.png" alt="Avatar" class="avatar">
            </div>

            <div class="container">
                <label for="uname"><b>Email đăng nhập</b></label>
                <input type="email" placeholder="Enter Username" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <div>{{ $message }}</div>
                @enderror

                <label for="psw"><b>Mật khẩu đăng nhập</b></label>
                <input type="password" placeholder="Enter Password" name="password" required>
                @error('password')
                    <div>{{ $message }}</div>
                @enderror

                <button type="submit">Đăng Nhập</button>
                <label>
                    <input type="checkbox" name="remember"> Lưu tài khoản
                </label>
            </div>

            <div class="container" style="background-color:#f1f1f1">
                <button type="button" class="cancelbtn">Bỏ qua</button>
                <span class="psw">Quên <a href="#">Mật Khẩu?</a> <br> Bạn chưa có tài khoản <a href="{{ route('register') }}">Đăng ký ngay!</a></span>
            </div>
            <a href="#">Mật Khẩu?</a>
        </form>

    </div>
</body>
<script>
    $(document).ready(function() {
        @if (Session::has('message'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("{{ session('message') }}");
        @endif
        @if (Session::has('success'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("{{ session('success') }}");
        @endif
        @if (Session::has('error'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("{{ session('error') }}");
        @endif

        @if (Session::has('info'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.info("{{ session('info') }}");
        @endif

        @if (Session::has('warning'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.warning("{{ session('warning') }}");
        @endif
    });
</script>
</html>
