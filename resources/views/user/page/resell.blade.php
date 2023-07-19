@extends('user.layout.index')
@section('css')
@endsection
@section('content')
    <div class="bg-white text-orange title-page">
        <div class="container">
            <p>LuckyBox | Gửi bán box</p>
        </div>
    </div>
    <div class="content-container py-4">
        <div class="container my-lg-2 my-0 d-flex justify-content-center">
            <div class="bg-white py-4 rounded mb-2 px-4 w-md-50">
                <div class="d-flex justify-content-center">
                    <img src="https://vn-live-01.slatic.net/p/dbf45cda7d56f7641227a80a5957efdf.jpg" width="40%"
                        height="auto" />
                </div>
                <div class="text-center">
                    <a href="thongtinbox.html" class="text-decoration-none">
                        <h4 class="text-dark">Title Title Title TitleTi tleTitl  eTitle TitleTitleT itleTitle</h4>
                    </a>
                </div>
                <div class="d-flex justify-content-between w-100 bg-gray px-2 py-2 rounded">
                    <h5>Giá mua: <br><span class="text-danger">2.000.000VNĐ</span></h5>
                    <h5>Giá gửi bán: <br><span class="text-danger">2.200.000VNĐ</span></h5>
                </div>
                <div class="my-2">
                    Phí gửi bán: <span class="text-danger">1.100.000VND</span>
                </div>
                <a href="checkout.html" class="w-100 px-lg-0 d-flex justify-content-center">
                    <button class="btn bg-orange text-white p-2 font-weight-bold">Xác nhận gửi bán</button>
                </a>
            </div>
        </div>
    </div>
    @endsection
@section('scripts')
@endsection