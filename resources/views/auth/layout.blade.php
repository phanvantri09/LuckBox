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
    </style>
    @yield('style')
</head>
<body>
     <nav class="navbar navbar-expand-md navbar-dark bg-white">
         <div class="container-lg justify-content-start">
             <a class="navbar-brand text-white col-lg-2 col-md-3 col-5" href="{{ route('home') }}">
                 <img src="{{asset('/dist/img/logo.png')}}" style="width: 100%;" alt="">
             </a>
         </div>
     </nav>
 
     <div class="main-class1">
         <div class="container py-md-5 py-4">
                 @yield('content')
         </div>
     </div>
     {{-- <span id="siteseal"><script async type="text/javascript" src="https://seal.godaddy.com/getSeal?sealID=SMWRyYlobi3D8PnFfleDXzvWOouFYmzMGUpkje6nmsmbVp5Cmj8pr5VJVptP"></script></span> --}}
 </body>
@yield('script')
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
