<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="google-site-verification" content="rl9JD04KBYYNOg7JDiZBzygfodJw_BPAOMY6cyXUK9o" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="{{ config('session.lifetime') * 60 }}">
    <title>Lucky Box</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('/dist/img/logo.png') }}">
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

        #show_eye {
            display: block;
        }

        #hide_eye {
            display: none;
        }

        #show_eye1 {
            display: block;
        }

        #hide_eye1 {
            display: none;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-white">
        <div class="container-lg justify-content-start">
            <a class="navbar-brand text-white col-lg-2 col-md-3 col-5" href="{{ route('home') }}">
                <img src="{{ asset('/dist/img/logo.png') }}" style="width: 100%;" alt="">
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
                    <h5>Đăng ký {{ isset($type) ? ' với số điện thoại' : ' với email' }}</h5>
                    @if (isset($type))
                        <div class="pt-2 pb-2">Đăng ký với email <a href="{{ route('register') }}">Đăng ký</a>
                        </div>
                    @else
                        <div class="pt-2 pb-2">Đăng ký với số điện thoại <a
                                href="{{ route('register', ['type' => 'number_phone']) }}">Đăng ký</a></div>
                    @endif
                    <div class="form-group">
                        <label for="uname"><b class="text-info">*</b> Tên của bạn </label>
                        <input type="text" placeholder="Nhập tên của bạn" name="name" class="form-control"
                            value="{{ old('name') }}">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    @if (isset($type))
                        <div class="form-group">
                            <label for="uname"><b class="text-danger">*</b> Số điện thoại </label>
                            <input type="tel" pattern="((\+84|0)[3|5|7|8|9])+([0-9]{8})"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '');" placeholder="Số điện thoại"
                                name="number_phone" class="form-control" value="{{ old('number_phone') }}">
                            @error('number_phone')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    @else
                        <div class="form-group">
                            <label for="uname"><b class="text-danger">*</b> Email </label>
                            <input type="email" placeholder="Nhập email của bạn" name="email" class="form-control"
                                value="{{ old('email') }}">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="psw"><b class="text-danger">*</b> Mật khẩu </label>
                        <div class="input-group mb-3">
                            <input id="password" type="password" placeholder="Nhập mật khẩu" class="form-control"
                                id="password" name="password" required="true" aria-label="password"
                                aria-describedby="basic-addon1" />
                            <div class="input-group-append">
                                <span class="input-group-text" onclick="password_show_hide();">
                                    <svg xmlns="http://www.w3.org/2000/svg" id="show_eye" width="16" height="16"
                                        fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                        <path
                                            d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" id="hide_eye" width="16" height="16"
                                        fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16">
                                        <path
                                            d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z" />
                                        <path
                                            d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z" />
                                    </svg>
                                </span>
                            </div>
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    {{-- <div class="form-group">
                        <label for="psw"><b class="text-danger">*</b> Mật khẩu </label>
                        <input id="password" type="password" placeholder="Nhập mật khẩu" class="form-control"
                            name="password" required>
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div> --}}
                    <div class="form-group">
                        <label for="psw"><b class="text-danger">*</b> Nhập lại mật khẩu </label>
                        <div class="input-group mb-3">
                            <input type="password" placeholder="Nhập lại mật khẩu" class=" form-control"
                                id="confirm-password" required="true"
                                aria-label="password" aria-describedby="basic-addon1" />
                            <div class="input-group-append">
                                <span class="input-group-text" onclick="confirm_password_show_hide();">
                                    <svg xmlns="http://www.w3.org/2000/svg" id="show_eye1" width="16"
                                        height="16" fill="currentColor" class="bi bi-eye-fill"
                                        viewBox="0 0 16 16">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                        <path
                                            d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" id="hide_eye1" width="16"
                                        height="16" fill="currentColor" class="bi bi-eye-slash-fill"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z" />
                                        <path
                                            d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <span id="password-match"></span>
                    </div>
                    {{-- <div class="form-group">
                        <label for="psw"><b class="text-danger">*</b> Nhập lại mật khẩu </label>
                        <input id="confirm-password" type="password" placeholder="Nhập lại mật khẩu"
                            class="form-control" required>
                        <span id="password-match"></span>
                    </div> --}}
                    <div class="form-group">
                        <label for="uname"><b class="text-info">*</b> Mã người giới thiệu</label>
                        <input type="text" placeholder="Nhập mã của người giới thiệu bạn" name="code"
                            class="form-control" value="{{ old('code') }}">
                        @error('code')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn bg-success text-white w-100 my-1">ĐĂNG KÝ</button>

                    <div class="text-center pt-2">Bạn đã có tài khoản? <a href="{{ route('login') }}">Đăng Nhập</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <span id="siteseal"><script async type="text/javascript" src="https://seal.godaddy.com/getSeal?sealID=SMWRyYlobi3D8PnFfleDXzvWOouFYmzMGUpkje6nmsmbVp5Cmj8pr5VJVptP"></script></span>
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

    function password_show_hide() {
        var x = document.getElementById("password");
        var show_eye = document.getElementById("show_eye");
        var hide_eye = document.getElementById("hide_eye");
        hide_eye.classList.remove("d-none");
        if (x.type === "password") {
            x.type = "text";
            show_eye.style.display = "none";
            hide_eye.style.display = "block";
        } else {
            x.type = "password";
            show_eye.style.display = "block";
            hide_eye.style.display = "none";
        }
    }
    function confirm_password_show_hide() {
        var x = document.getElementById("confirm-password");
        var show_eye = document.getElementById("show_eye1");
        var hide_eye = document.getElementById("hide_eye1");
        hide_eye.classList.remove("d-none");
        if (x.type === "password") {
            x.type = "text";
            show_eye.style.display = "none";
            hide_eye.style.display = "block";
        } else {
            x.type = "password";
            show_eye.style.display = "block";
            hide_eye.style.display = "none";
        }
    }

</script>

</html>
