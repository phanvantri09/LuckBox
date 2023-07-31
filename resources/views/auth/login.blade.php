<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lucky Box</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script> --}}

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
        .main-class {
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
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-white">
        <div class="container-lg justify-content-start">
            <a class="navbar-brand text-warning" href="{{ route('home') }}">Navbar</a>
            <h4 class="mb-0">Đăng nhập</h4>
        </div>
    </nav>

    <div class="main-class">
        <div class="container py-md-5 py-4">
            <div class="row px-md-5 px-3 align-items-center">
                <div class="col-lg-8 d-lg-block d-none">
                    <img src="{{asset('/dist/img/gift.png')}}" width="100%" >
                </div>
            <form action="{{ route('login') }}" method="post" class="col-lg-4 col-md-12 col-12 bg-white p-4 shadow rounded">
                @csrf
                <h5>Đăng nhập</h5>
                <div class="form-group">
                    <label for="uname">Email</label>
                    <input type="email" placeholder="Enter Username" class="form-control" name="email"
                        value="{{ old('email') }}" required>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="psw">Mật khẩu</label>
                    <input type="password" placeholder="Enter Password" class="form-control" name="password" required>
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <input type="checkbox" name="remember"> Lưu tài khoản
                </div>
                <button type="submit" class="btn bg-orange text-white w-100 my-1">ĐĂNG NHẬP</button>
                <div class="pt-1">Quên <a href="#">Mật Khẩu?</a> </div>
                <div class="d-flex align-items-center justify-content-between py-1">
                    <div class="lines"></div>
                    <span class="text-lines">Hoặc</span>
                    <div class="lines"></div>
                </div>
                
                <a href="{{ route('loginMail') }}"  class="btn bg-white border w-100 d-flex align-items-center justify-content-center">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/2008px-Google_%22G%22_Logo.svg.png" width="20" height="20" alt="">
                    &nbsp;Google
                </a>
                
                <div class="text-center pt-2">Bạn chưa có tài khoản <a
                    href="{{ route('register') }}">Đăng ký ngay!</a></div>
            </form>
            </div>
        </div>
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
