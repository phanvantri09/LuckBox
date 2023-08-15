<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lucky Box</title>
    <link rel="icon" type="image/x-icon" href="{{asset('/dist/img/logo.png')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <style>
        @media (min-width: 1200px) {

            .container,
            .container-lg,
            .container-md,
            .container-sm,
            .container-xl {
                max-width: 1440px;
            }
        }

        .navbar-brand {
            font-size: 1.5rem;
        }

        .main {
            background-color: rgb(255, 235, 226);
        }

        .bg-orange {
            background: linear-gradient(-180deg, #f53d2d, #f63);
        }

        .lines {
            height: 1px;
            background-color: rgb(212, 212, 212);
            width: 40%;
        }

        .text-lines {
            color: rgb(119, 119, 119);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-white">
        <div class="container-lg justify-content-start">
            <a class="navbar-brand text-white col-lg-2 col-md-3 col-5" href="{{ route('home') }}">
                <img src="{{asset('/dist/img/logo.png')}}" style="width: 100%;" alt="">
            </a>
            <h4 class="mb-0">Đăng ký</h4>
        </div>
    </nav>
    <div class="main">
        <div class="container py-md-5 py-4">
            <div class="row px-md-5 px-3 align-items-center">
                <div class="col-lg-8 d-lg-block d-none">
                    <img src="{{ asset('/dist/img/gift.png') }}" width="100%">
                </div>
                <form action="{{ route('register') }}" method="post"
                    class="col-lg-4 col-md-12 col-12 bg-white p-4 shadow rounded">
                    @csrf
                    <h5>Đăng ký</h5>
                    <div class="form-group">
                        <label for="uname"><b class="text-info">*</b> Tên của bạn </label>
                        <input type="text" placeholder="Nhập email của bạn" name="name" class="form-control"
                            value="{{ old('name') }}">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="uname"><b class="text-info">*</b> Email </label>
                        <input type="email" placeholder="Nhập email của bạn" name="email" class="form-control"
                            value="{{ old('email') }}">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="uname"><b class="text-danger">*</b> Số điện thoại </label>
                        <input type="tel" pattern="((\+84|0)[3|5|7|8|9])+([0-9]{8})" oninput="this.value = this.value.replace(/[^0-9]/g, '');" placeholder="Số điện thoại" required name="number_phone" class="form-control"
                            value="{{ old('number_phone') }}">
                        @error('number_phone')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="psw"><b class="text-danger">*</b> Mật khẩu </label>
                        <input id="password" type="password" placeholder="Nhập mật khẩu" class="form-control" name="password"
                            required>
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="psw"><b class="text-danger">*</b> Nhập lại mật khẩu </label>
                        <input id="confirm-password" type="password" placeholder="Nhập lại mật khẩu" class="form-control"
                            required>
                        <span id="password-match"></span>
                    </div>
                    <div class="form-group">
                        <label for="uname"><b class="text-info">*</b> Mã người giới thiệu</label>
                        <input type="tel" placeholder="Nhập số điện thoại của bạn" name="code" class="form-control"
                            value="{{ old('code') }}">
                        @error('code')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn bg-success text-white w-100 my-1">ĐĂNG KÝ</button>
                    <div class="text-center pt-2">Bạn đã có tài khoản? <a href="{{ route('login') }}">Đăng Nhập</a></div>
                </form>
            </div>
        </div>
    </div>

</body>
<script>
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirm-password');
    const passwordMatchMessage = document.getElementById('password-match');

    const checkPasswordMatch = () => {
        const password = passwordInput.value;
        const confirmPassword = confirmPasswordInput.value;
        if (confirmPassword != null) {
            if (password === confirmPassword) {
                passwordMatchMessage.textContent = '';
                // passwordMatchMessage.style.color = 'green';
            } else {
                passwordMatchMessage.textContent = 'Mật khẩu không khớp.';
                passwordMatchMessage.style.color = 'red';
            }
        }

    };

    passwordInput.addEventListener('input', checkPasswordMatch);
    confirmPasswordInput.addEventListener('input', checkPasswordMatch);
</script>

</html>
