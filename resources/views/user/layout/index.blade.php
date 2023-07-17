<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lucky Box</title>
    <base href="{{ URL::asset('/') }}" target="_top">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="./css/style.css" />
    <link href="css/app.css" rel="stylesheet">
    @yield('css')

</head>

<body>

    @include('user.layout.header')
    @yield('content')
    @include('user.layout.panel')
    @if (Auth::user() && Auth::user()->type == \App\Helpers\ConstCommon::TypeUser)
    <div class="floating-chat me-4 d-md-block d-none">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center p-3"
                 style="border-top: 4px solid #ffa900;">
                <h5 class="mb-0">Đoạn chat</h5>
            </div>
            <div class="card-body" data-mdb-perfect-scrollbar="true" style="position: relative; height: 400px; width: 350px">

                <div id="messageOutput" >
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
                    <button class="btn btn-warning" type="button submit" id="button-addon2" style="padding-top: .55rem;">
                        Gửi
                    </button>
                </div>
            </form>
        </div>

    </div>
    @endif
</body>

@yield('script')
<script src="./js/quantity.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script> --}}
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
</script>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
</script> --}}
<script>
    let userIdFE = "{{ auth()->user()->id }}";
</script>
<script src="./js/app.js"></script>

</html>
