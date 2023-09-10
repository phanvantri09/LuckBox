<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu"   role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <div class="info w-100">
                <a href="{{ route('logout') }}" class="w-100 btn btn-danger"> <i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link d-flex flex-column">
        <img src="dist/img/logo.png" alt="AdminLTE Logo" class="brand-image  elevation-3"
            style="opacity: .8">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="dist/img/avatar.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a   class="d-block">{{ Auth::user()->email }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <li class="nav-item menu-open">

                    <ul class="nav nav-treeview">
                        <li class="nav-item bg-orange ">
                            <a href="{{ route('home') }}" class="nav-link" target="_blank">
                                <i class="fas fa-home"></i>
                                <p>Trang người dùng</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin') }}" class="nav-link active" target="_blank">
                                <i class="fas fa-tachometer-alt"></i>
                                <p>Tổng quang</p>
                            </a>
                        </li>
                        {{-- <li class="nav-item bg-info">
                            <a href="{{ route('docs') }}" class="nav-link " target="_blank">
                                <i class="fas fa-list-ol"></i>
                                <p>Qui trình tạo</p>
                            </a>
                        </li> --}}
                    </ul>
                </li>
                <li class="nav-item">
                    <a   class="nav-link bg-warning">
                        <i class="fas fa-money-bill-alt"></i>
                        <p>
                            Giao dịch
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    {{-- [ 1 => 'Rút tiền', 2 => 'Nạp tiền', 3 => 'Thanh toán box', 4 => "Doanh thu bán box", 5 => 'Hoa hồng bán box', 6 => 'Giới thiệu'] --}}
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('transaction.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tất cả</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('transaction.index',['type' => 1]) }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Rút tiền</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('transaction.index',['type' => 2]) }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Nạp tiền</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('transaction.index',['type' => 3]) }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thanh toán</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('transaction.index',['type' => 4]) }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Doanh thu bán box</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('transaction.index',['type' => 5]) }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Hoa hồng bán box</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('transaction.index',['type' => 6]) }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Giới thiệu người dùng</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a   class="nav-link bg-success">
                        <i class="fas fa-shopping-cart"></i>
                        <p>
                            Đơn Hàng
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a href="{{ route('cart.index', ['type'=>2]) }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Đã thanh toán chưa mở box</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('cart.index', ['type'=>3]) }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Đã mở box chưa xác nhận giao</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('cart.index', ['type'=>7]) }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Đã mở xác nhận giao</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('cart.index', ['type'=>4]) }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Đang giao Hàng</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('cart.index', ['type'=>5]) }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Đã hoàn thành</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('cart.index', ['type'=>6]) }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Đã từ chối hoặc phát sinh lỗi</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item border-bottom">
                    <a href="{{ route('chat.index') }}" class="nav-link">
                        <i class="fas fa-comment-alt"></i>
                        <p>
                            Trò chuyện
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a   class="nav-link">
                        <i class="fas fa-users"></i>
                        <p>
                            Người dùng
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('user.add') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a   class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách</p>
                            </a>
                            <ul>
                                <a href="{{ route('user.list', ['type' => \App\Helpers\ConstCommon::TypeUser]) }}"
                                    class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>User</p>
                                </a>
                            </ul>
                            <ul>
                                <a href="{{ route('user.list', ['type' => 3]) }}"
                                    class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>User được giới thiệu</p>
                                </a>
                            </ul>
                            <ul>
                                <a href="{{ route('user.list', ['type' => \App\Helpers\ConstCommon::TypeAdmin]) }}"
                                    class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Admin</p>
                                </a>
                    </ul>
                    </ul>
                </li>

                <li class="nav-item">
                    <a   class="nav-link">
                        <i class="fas fa-credit-card"></i>
                        <p>
                            Thẻ user
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('card.add') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('card.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item border-bottom">
                    <a   class="nav-link">
                        <i class="fas fa-credit-card"></i>
                        <p>
                            Thẻ admin
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('card.addAdmin') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('card.indexAdmin') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a   class="nav-link">
                        <i class="fas fa-boxes"></i>
                        <p>
                            Loại event, box, product
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('category.add') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('category.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a   class="nav-link">
                        <i class="fas fa-glass-whiskey"></i>
                        <p>
                            Sản phẩm
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('product.add') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('product.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a   class="nav-link">
                        <i class="fas fa-box-open"></i>
                        <p>
                            Box ( Hộp box )
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('box.add') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('box.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a   class="nav-link">
                        <i class="fas fa-calendar-alt"></i>
                        <p>
                            Event ( sự kiện )
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('box.box_event.add') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('box.box_event.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
