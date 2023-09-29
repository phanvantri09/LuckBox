<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="google-site-verification" content="rl9JD04KBYYNOg7JDiZBzygfodJw_BPAOMY6cyXUK9o" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="{{ config('session.lifetime') * 60 }}">
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
        .main-class1 {
            background-color: rgb(255, 235, 226);
        }
        .bg-orange {
            background: linear-gradient(-180deg, #f53d2d, #f63);
        }
        .lines{
            height: 1px;
            background-color: rgb(212, 212, 212);
            width: 40%;
        }
        .text-lines{
            color: rgb(119, 119, 119);
        }
        .toast-container{
            background: #f63 !important;
        }
        #show_eye {
            display: block;
        }

        #hide_eye {
            display: none;
        }

    </style>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-white">
        <div class="container-lg justify-content-start">
            <a class="navbar-brand text-white col-lg-2 col-md-3 col-5" href="{{ route('home') }}">
                <img src="{{asset('/dist/img/logo.png')}}" style="width: 100%;" alt="">
            </a>
            <h4 class="mb-0">Đăng nhập</h4>
        </div>
    </nav>

    <div class="main-class1">
        <div class="container py-md-5 py-4">
            <div class="row px-md-5 px-3 align-items-center">
                <div class="col-lg-8 d-lg-block d-none">
                    <img src="{{asset('/dist/img/gift.png')}}" width="100%" >
                </div>
            <form action="{{ route('login') }}" method="post" class="col-lg-4 col-md-12 col-12 bg-white p-4 shadow rounded">
                @csrf
                <h5>Đăng nhập</h5>
                <div class="form-group">
                    <label for="uname">Email hoặc số điện thoại</label>
                    <input type="text" placeholder="Nhập Email hoặc số điện thoại" class="form-control" name="email"
                        value="{{ old('email') }}" required>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
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
                    </div>
                    @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                </div>
                {{-- <div class="form-group">
                    <label for="psw">Mật khẩu</label>
                    <input type="password" placeholder="Enter Password" class="form-control" name="password" required>
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div> --}}
                <div>
                    <input type="checkbox" name="remember"> Lưu tài khoản
                </div>
                <button type="submit" class="btn bg-orange text-white w-100 my-1">ĐĂNG NHẬP</button>
                <div class="d-flex align-items-center justify-content-between py-1">
                    <div class="lines"></div>
                    <span class="text-lines">Hoặc</span>
                    <div class="lines"></div>
                </div>

                <a href="{{ route('register') }}"  class="btn bg-white border w-100 d-flex align-items-center justify-content-center">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/2008px-Google_%22G%22_Logo.svg.png" width="20" height="20" alt="">
                    &nbsp;Google
                </a>

                <div class="text-right pt-2">Bạn chưa có tài khoản <a
                    href="{{ route('register', ['type'=>'number_phone']) }}">Đăng ký ngay !</a></div>
                <div class="text-right pt-1">Quên <a href="{{ route('password.request') }}">Mật Khẩu ?</a> </div>

            </form>
            </div>
        </div>
    </div>
    <span id="siteseal"><script async type="text/javascript" src="https://seal.godaddy.com/getSeal?sealID=SMWRyYlobi3D8PnFfleDXzvWOouFYmzMGUpkje6nmsmbVp5Cmj8pr5VJVptP"></script></span>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
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
</script>


</html>
