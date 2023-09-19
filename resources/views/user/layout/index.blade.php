<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="google-site-verification" content="rl9JD04KBYYNOg7JDiZBzygfodJw_BPAOMY6cyXUK9o" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="{{ config('session.lifetime') * 60 }}">
    <title>Lucky Box</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('/dist/img/logo.png') }}">
    <base href="{{ URL::asset('/') }}" target="_top">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/style.css" />
    <link href="css/app.css" rel="stylesheet">
    <style>
        .modal-dialog {
            top: 25%;
            transform: translateY(-50%);
            z-index: 1111;
        }
        @media screen and (max-width: 576px) {
            .market-content .modal-body-imgbox {
                width: 70% !important;
            }
        }
        .market-content .modal-body-imgbox {
            width: 100%;
            height: auto;
        }
        .floating-chat {
            z-index: 111 !important;
        }
        .changeaddress .modal-body {
            height: 300px !important;
        }
    </style>
    @yield('css')

</head>

<body>

    @include('user.layout.header')
    <main class="zoomable">
        @yield('content')
    </main>
    @include('user.layout.footer')
    @include('user.layout.panel')
    @if (Auth::user() && Auth::user()->type == \App\Helpers\ConstCommon::TypeUser)
        <div class="floating-chat me-4">
            <div id="openChat" class="p-3 bg-warning rounded-circle">
                <i class="fa fa-commenting-o" aria-hidden="true" style="font-size: 30px; color: white"></i>
            </div>
            <div id="chatContent" class="card">
                <div class="card-header d-flex justify-content-between align-items-center p-3"
                    style="border-top: 4px solid #ffa900;">
                    <h5 class="mb-0">Chat với admin</h5>
                    <i id="minimizeChat" class="fa fa-minus" aria-hidden="true"></i>
                </div>
                <div class="card-body" data-mdb-perfect-scrollbar="true"
                    style="position: relative; height: 400px; width: 350px">

                    <div id="messageOutput">
                        <!-- <div class="d-flex justify-content-between">
                        <p class="small mb-1">Timona Siera</p>
                        <p class="small mb-1 text-muted">23 Jan 2:00 pm</p>
                    </div>
                    <div class="d-flex flex-row justify-content-start">
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava5-bg.webp"
                            alt="avatar 1" style="width: 45px; height: 100%;">
                        <div>
                            <p class="small p-2 ms-3 mb-3 rounded-3" style="background-color: #f5f6f7;">For what reason
                            would it
                            be advisable for me to think about business content?</p>
                        </div>
                    </div> -->
                    </div>

                </div>
                <form id="chatForm" class="card-footer text-muted d-flex justify-content-start align-items-center p-3">
                    <div class="input-group mb-0">
                        <input id="message" type="text" class="form-control" placeholder="Nhập tin nhắn..."
                            aria-label="Recipient's username" aria-describedby="button-addon2" />
                        <button class="btn btn-warning" type="button submit" id="button-addon2"
                            style="padding-top: .55rem; color: white">
                            Gửi
                        </button>
                    </div>
                </form>
            </div>

        </div>
    @endif
    <span id="siteseal">
        <script async type="text/javascript"
            src="https://seal.godaddy.com/getSeal?sealID=SMWRyYlobi3D8PnFfleDXzvWOouFYmzMGUpkje6nmsmbVp5Cmj8pr5VJVptP"></script>
    </span>
</body>

@yield('scripts')

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
</script>
<script>
    let userIdFE = "{{ Auth::user() ? auth()->user()->id : 0 }}";
</script>
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
<script src="./js/app.js"></script>

{{-- <script src="./js/countdown.js"></script> --}}

<script>
    function copyHrefToClipboard(event) {
        event.preventDefault();
        const linkElement = document.getElementById("linkToCopy");
        const hrefValue = linkElement.href;
        const range = document.createRange();
        const tempElement = document.createElement("span");
        tempElement.innerText = hrefValue;
        document.body.appendChild(tempElement);
        range.selectNode(tempElement);
        window.getSelection().removeAllRanges();
        window.getSelection().addRange(range);
        document.execCommand("copy");
        window.getSelection().removeAllRanges();
        document.body.removeChild(tempElement);
        alert("Đã sao chép link!");
    }

    function copyTextttt(idName) {
        var textToCopy = $(idName).val();
        var $tempInput = $("<input>");
        $("body").append($tempInput);
        $tempInput.val(textToCopy).select();
        document.execCommand("copy");
        $tempInput.remove();
        alert('Đã sao chép mã giới thiệu');
    }
</script>
<script>
    var zoomableElement = document.querySelector('.zoomable');
    var lastTouchEnd = 0;

    zoomableElement.addEventListener('touchend', function(event) {
        var currentTime = new Date().getTime();
        var touchEndDiff = currentTime - lastTouchEnd;

        if (touchEndDiff < 300) {
            event.preventDefault(); // Ngăn chặn hành vi mặc định của trình duyệt
        }

        lastTouchEnd = currentTime;
    });
</script>


</html>
