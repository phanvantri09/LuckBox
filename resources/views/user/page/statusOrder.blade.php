@extends('user.layout.index')
@section('css')
@endsection
@section('content')
    <div class="bg-white text-orange title-page">
        <div class="container">
            <p>LuckyBox | Trạng thái đơn hàng</p>
        </div>
    </div>
    <div class="content-container py-4">
        <div class="container my-lg-2 my-0">
            <!-- desktop -->
            <div class="d-lg-block d-none">
                <div class="row bg-white my-lg-2 my-0 py-2 align-items-center">
                    <div class="col-lg-2">Hình ảnh</div>
                    <div class="col-lg-3">Tên hộp box</div>
                    <div class="col-lg-4">Tổng tiền <b>(VND)</b></div>
                    <div class="col-lg-3">Trạng thái</div>
                </div>
                <div class="row align-items-center bg-white py-2 rounded mb-2 px-2">
                    <div class="col-lg-2 px-1">
                        <img src="https://vn-live-01.slatic.net/p/dbf45cda7d56f7641227a80a5957efdf.jpg" width="80%"
                            height="auto" />
                    </div>
                    <div class="col-lg-3">
                        <a href="thongtinbox.html" class="text-decoration-none">
                            <h4 class="text-dark">Title</h4>
                        </a>
                    </div>
                    <div class="col-lg-4">
                        <h5 class="font-weight-bold text-danger">4.000.000</h5>
                    </div>
                    <div class="col-lg-3 text-success">
                        Đang giao hàng
                    </div>
                </div>
            </div>
            <!-- end desltop -->
            <!-- mobile -->
            <div class="d-lg-none">
                <div class="row bg-white py-2 rounded mb-2 px-2">
                    <div class="col-md-3 col-sm-3 col-4 px-1">
                        <img src="https://img4.thuthuatphanmem.vn/uploads/2020/05/14/hinh-anh-hoa-hong-leo-dep_021528729.jpg"
                            width="100%" height="120" />
                    </div>
                    <div class="col-md-9 col-sm-9 col-8">
                        <a href="thongtinbox.html" class="text-decoration-none">
                            <p class="mb-0 font-weight-bold text-white-space text-dark">Title Title Title Title Title Title
                                Title Title Title Title</p>
                        </a>
                        <p class="mb-0">Tổng tiền: <span class="text-danger">4.000.000 VNĐ</span></p>
                        <p>Trang thái: <span class="text-success font-weight-bold"> Đang giao hàng</span></p>
                    </div>
                </div>
            </div>
            <!-- end mobile -->
        </div>
    </div>
    @endsection
    @section('scripts')
    @endsection
