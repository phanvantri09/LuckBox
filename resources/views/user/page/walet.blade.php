@extends('user.layout.index')
@section('css')
@endsection
@section('content')
    <div class="bg-white text-orange title-page">
        <div class="container">
            <p>LuckyBox | Ví của bạn</p>
        </div>
    </div>
    <div class="content-container py-md-4 py-2">
        <div class="container my-lg-2 my-0 d-flex justify-content-center">
            <div class="bg-white py-2 rounded mb-2 px-4 w-md-50">
                <h5 class="text-center">Thông tin ví</h5>
                <div class="d-sm-flex align-items-center justify-content-between">
                    <p class="mb-0">Số dư: <span class="text-danger font-weight-bold">2.000.000</span></p>
                    <div class="d-flex d-sm-block justify-content-between py-sm-0 py-1">
                        <button class="btn bg-success text-white">Nạp tiền</button>
                        <button class="btn bg-warning text-white">Rút tiền</button>
                    </div>
                </div>
                <h5 class="text-center">Tài khoản thanh toán</h5>
                <p>Tên ngân hàng: Agribank</p>
                <p>Chi nhánh: Đà Nẵng</p>
                <p>Số tài khoản/Số thẻ: Agribank</p>
                <p>Chủ tài khoản: Nguyễn Văn A</p>
                <a href="{{ route('createCard') }}" class="d-flex justify-content-center text-decoration-none">
                    <button class="btn bg-orange text-white">Thêm tài khoản</button>
                </a>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
