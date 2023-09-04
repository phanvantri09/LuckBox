<!-- Menu -->
<nav class="navbar navbar-expand-md navbar-dark bg-orange text-white menu-fixed">
    <div class="container-lg px-0">
        <a class="navbar-brand text-white pt-md-1 pt-0 px-0 mr-0 col-lg-2 col-md-3 col-5" href="{{ route('home') }}">
            <img src="{{ asset('/dist/img/logo.png') }}" style="width: 100%;" alt="">
        </a>
        <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button> -->
        <div class="collapse navbar-collapse justify-content-center" id="collapsibleNavbar">
            <ul class="navbar-nav" style="font-weight: 500; text-transform: uppercase">
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('home') }}">Trang chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('market') }}">Chợ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('Contact') }}">Liên hệ</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('market') }}">Chợ</a>
                </li> --}}
                {{-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="navbardrop"
                        data-toggle="dropdown">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                            <path fill-rule="evenodd"
                                d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                        </svg>
                        Dropdown link
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item text-white" href="#">Link 1</a>
                        <a class="dropdown-item text-white" href="#">Link 2</a>
                        <a class="dropdown-item text-white" href="#">Link 3</a>
                    </div>
                </li> --}}
            </ul>
        </div>
        @auth
            @php
                $goi = \App\Helpers\ConstCommon::getCartCurent();
                $hopMu = \App\Helpers\ConstCommon::getBoxCurent();
                $ban = \App\Helpers\ConstCommon::getBoxMarket();
            @endphp
            <a href="{{ route('walet') }}"
                class="text-white px-2 d-none d-md-flex flex-column justify-content-center align-items-center ">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                    class="bi bi-wallet-fill" viewBox="0 0 16 16">
                    <path
                        d="M1.5 2A1.5 1.5 0 0 0 0 3.5v2h6a.5.5 0 0 1 .5.5c0 .253.08.644.306.958.207.288.557.542 1.194.542.637 0 .987-.254 1.194-.542.226-.314.306-.705.306-.958a.5.5 0 0 1 .5-.5h6v-2A1.5 1.5 0 0 0 14.5 2h-13z" />
                    <path
                        d="M16 6.5h-5.551a2.678 2.678 0 0 1-.443 1.042C9.613 8.088 8.963 8.5 8 8.5c-.963 0-1.613-.412-2.006-.958A2.679 2.679 0 0 1 5.551 6.5H0v6A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-6z" />
                </svg>
                <span>Ví</span>
            </a>
            <a href="{{ route('cart') }}"
                class="text-white px-2 d-none d-md-flex flex-column justify-content-center align-items-center icon-card">

                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                    class="bi bi-cart4" viewBox="0 0 16 16">
                    <path
                        d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z" />
                </svg>
                @if (!empty($goi))
                    <span class="numbercart">{{ $goi }}</span>
                @endif

                <span>Giỏ</span>
            </a>
            <a href="{{ route('purchaseOrder') }}"
                class="text-white px-2 d-none d-md-flex icon-gif flex-column justify-content-center align-items-center ">

                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-gift"
                    viewBox="0 0 16 16">
                    <path
                        d="M3 2.5a2.5 2.5 0 0 1 5 0 2.5 2.5 0 0 1 5 0v.006c0 .07 0 .27-.038.494H15a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 1 14.5V7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h2.038A2.968 2.968 0 0 1 3 2.506V2.5zm1.068.5H7v-.5a1.5 1.5 0 1 0-3 0c0 .085.002.274.045.43a.522.522 0 0 0 .023.07zM9 3h2.932a.56.56 0 0 0 .023-.07c.043-.156.045-.345.045-.43a1.5 1.5 0 0 0-3 0V3zM1 4v2h6V4H1zm8 0v2h6V4H9zm5 3H9v8h4.5a.5.5 0 0 0 .5-.5V7zm-7 8V7H2v7.5a.5.5 0 0 0 .5.5H7z" />
                </svg>
                @if (!empty($hopMu))
                    <span class="numbergif">{{ $hopMu }}</span>
                @endif
                <span>Hộp mù</span>
            </a>
            <a href="{{ route('boxUserMarket') }}"
                class="text-white px-2 d-none d-md-flex icon-gif flex-column justify-content-center align-items-center ">

                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-shop"
                    viewBox="0 0 16 16">
                    <path
                        d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zM4 15h3v-5H4v5zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3zm3 0h-2v3h2v-3z" />
                </svg>
                @if (!empty($ban))
                    <span class="numbergif">{{ $ban }}</span>
                @endif
                <span>Bán</span>
            </a>
        @else
            <a href="{{ route('login') }}" class="text-white px-2">Đăng nhập</a>
            <a href="{{ route('register') }}" class="text-white px-2">Đăng ký</a>
        @endauth
        @auth
            @php
                $sharedLink = '';
                if (Auth::user()) {
                    $userId = Auth::user()->id;
                    $dataToEncode = [$userId];

                    $hashids = new \Hashids\Hashids('share', 12);
                    $encodedData = $hashids->encode($dataToEncode);
                    $sharedLink = url('shared/' . $encodedData);
                }
            @endphp
            <div class="nav-item dropdown menu-info-user">
                <a class="nav-link dropdown-toggle text-white pr-0 d-md-flex d-none flex-md-column  justify-content-center  align-items-center " href="#" id="navbardrop" data-toggle="dropdown">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                        <path fill-rule="evenodd"
                            d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                    </svg>
                    <span class="d-md-flex d-none">{{number_format(Auth::user()->balance)}} VNĐ</span>
                </a>
                <a class="nav-link dropdown-toggle text-white pr-0 d-flex d-md-none flex-md-column  justify-content-center  align-items-center " href="#" id="navbardrop" data-toggle="dropdown">
                    <span class="d-flex d-md-none">{{number_format(Auth::user()->balance)}} VNĐ</span> &ensp;
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                        <path fill-rule="evenodd"
                            d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                    </svg>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item text-white" href="{{ route('walet') }}">Ví của bạn</a>
                    <a class="dropdown-item text-white" href="{{ route('boxUserMarket') }}">Đang bán</a>
                    <a class="dropdown-item text-white" href="{{ route('listOrder') }}">Đã mở</a>
                    <a class="dropdown-item text-white" href="{{ route('updateInfo') }}">Thông tin cá nhân</a>

                    {{-- <a class="dropdown-item text-white" href="{{ route('cart') }}">Giỏ</a> --}}
                    {{-- <a class="dropdown-item text-white" href="{{ route('purchaseOrder') }}">Hộp đã mua</a> --}}

                    <a class="dropdown-item text-white" href="{{ route('historyTransaction') }}">Lịch sử giao dịch</a>
                    <a class="dropdown-item text-white" href="{{ route('listGT') }}">Danh sách giới thiệu</a>
                    {{-- <a class="dropdown-item text-white" href="{{ route('market') }}">Chợ</a> --}}
                    <input type="hidden" style="display: none" id="ma_gt" value="{{ Auth::user()->code ?? null }}" />
                    <a id="linkToCopy" onclick="copyHrefToClipboard(event)" class="dropdown-item text-white"
                        href="{{ $sharedLink ?? '#' }}">Link giới thiệu</a>
                    <a class="dropdown-item text-white" id="linkToCopy" onclick="copyTextttt('#ma_gt')">Mã giới thiệu</a>
                    <a href="{{ route('logout') }}" class="dropdown-item text-white">Đăng xuất</a>
                </div>
            </div>
        @endauth
    </div>
</nav>
<!-- End Menu -->
