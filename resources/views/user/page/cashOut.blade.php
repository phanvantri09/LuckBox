@extends('user.layout.index')
@section('css')
@endsection
@section('content')
    <div class="bg-white text-orange title-page">
        <div class="container">
            <p>LuckyBox | Yêu cầu rút tiền</p>
        </div>
    </div>
    <div class="content-container py-md-4 py-2">
        <div class="container my-lg-2 my-0 d-flex justify-content-center">
            <div class="bg-white py-2 rounded mb-2 px-4 w-md-50">
                <h5 class="text-center">Yêu cầu rút tiền</h5>
                <form action="">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Tên chủ tài khoản</label>
                        <input type="text" name="name" class="form-control" id="exampleFormControlInput1"
                            placeholder="Đà Nẵng">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput2">Tên ngân hàng</label>
                        <input type="text" name="name" class="form-control" id="exampleFormControlInput2"
                            placeholder="Đà Nẵng">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput3">Số tài khoản</label>
                        <input type="text" name="name" class="form-control" id="exampleFormControlInput3"
                            placeholder="Đà Nẵng">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput4">Số tiền</label>
                        <input type="text" name="name" class="form-control" id="exampleFormControlInput4"
                            placeholder="2.000.000">
                    </div>
                    <button class="btn bg-orange text-white d-flex mx-auto">Gửi yêu cầu</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection