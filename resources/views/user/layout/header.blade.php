<!-- Menu -->
<nav class="navbar navbar-expand-md navbar-dark bg-orange text-white menu-fixed">
    <div class="container-lg">
        <a class="navbar-brand text-white col-lg-2 col-md-3 col-5" href="{{ route('home') }}">
            <img src="{{asset('/dist/img/logo.png')}}" style="width: 100%;" alt="">
        </a>
        <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button> -->
        <div class="collapse navbar-collapse justify-content-center" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('home') }}">Trang chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('market') }}">Chợ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#footter">Liên hệ</a>
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
        <a href="{{ route('walet') }}" class="text-white px-2 d-none d-md-flex flex-column justify-content-center align-items-center ">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-wallet-fill" viewBox="0 0 16 16">
                <path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v2h6a.5.5 0 0 1 .5.5c0 .253.08.644.306.958.207.288.557.542 1.194.542.637 0 .987-.254 1.194-.542.226-.314.306-.705.306-.958a.5.5 0 0 1 .5-.5h6v-2A1.5 1.5 0 0 0 14.5 2h-13z"/>
                <path d="M16 6.5h-5.551a2.678 2.678 0 0 1-.443 1.042C9.613 8.088 8.963 8.5 8 8.5c-.963 0-1.613-.412-2.006-.958A2.679 2.679 0 0 1 5.551 6.5H0v6A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-6z"/>
              </svg>
              <span>Ví</span>
        </a>
		<a href="{{ route('cart') }}" class="text-white px-2 d-none d-md-flex flex-column justify-content-center align-items-center ">

            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                class="bi bi-cart4" viewBox="0 0 16 16">
                <path
                    d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z" />
            </svg>
            <span>Giỏ</span>
        </a>
		@else
		<a href="{{ route('login') }}" class="text-white px-2">Đăng nhập</a>
        <a href="{{ route('register') }}" class="text-white px-2">Đăng ký</a>
		@endauth

		<div class="nav-item dropdown menu-info-user">
			<a class="nav-link dropdown-toggle text-white" href="#" id="navbardrop"
				data-toggle="dropdown">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
					class="bi bi-person-circle" viewBox="0 0 16 16">
					<path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
					<path fill-rule="evenodd"
						d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
				</svg>
			</a>
			<div class="dropdown-menu">
				<a class="dropdown-item text-white" href="{{ route('updateInfo') }}">Thông tin cá nhân</a>
				<a class="dropdown-item text-white" href="{{ route('walet') }}">Ví của bạn</a>
                <a class="dropdown-item text-white" href="{{ route('cart') }}">Giỏ</a>
                <a class="dropdown-item text-white" href="{{ route('purchaseOrder') }}">Họp mù</a>
                <a class="dropdown-item text-white" href="{{ route('boxUserMarket') }}">Họp gửi bán</a>
                <a class="dropdown-item text-white" href="{{ route('listOrder') }}">Đơn sắp nhận</a>
                <a class="dropdown-item text-white" href="{{ route('historyTransaction') }}">Lịch sử giao dịch</a>
                <a class="dropdown-item text-white" href="{{ route('market') }}">Chợ</a>
                <a id="linkToCopy" onclick="copyHrefToClipboard(event)" class="dropdown-item text-white" href="{{ $sharedLink ?? '#' }}">Giới thiệu bạn bè</a>
				<a href="{{ route('logout') }}" class="dropdown-item text-white">Đăng xuất</a>
			</div>
		</div>
    </div>
</nav>
<!-- End Menu -->
