<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lucky Box</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
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
            <form action="{{ route('registerShare',['id'=>$userId]) }}" method="post"
                  class="col-lg-4 col-md-12 col-12 bg-white p-4 shadow rounded">
                @csrf
                <h5>Đăng ký</h5>
                <div class="form-group">
                    <label for="uname">Email</label>
                    <input type="email" placeholder="Enter Username" name="email" class="form-control"
                           value="{{ old('email') }}" required>
                    @error('email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="psw">Mật khẩu</label>
                    <input type="password" placeholder="Enter Password" class="form-control" name="password"
                           required>
                    @error('password')
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

</html>
