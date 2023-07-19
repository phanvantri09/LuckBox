@extends('user.layout.index')
@section('css')
@endsection
@section('content')
    <div class="bg-white text-orange title-page">
        <div class="container">
            <p>LuckyBox | Thanh toán</p>
        </div>
    </div>

    <div class="content-container py-4">
        <div class="container my-lg-2 my-0 bg-white py-4">
            <div class="row content-page p-lg-5">
                <div class="col-lg-4 col-md-12 col-sm-12 col-12 p-lg-0">
                    <div class="title">Đơn hàng của bạn</div>
                    <div class="d-flex ">
                        <a href="home.html" class="text-decoration-none text-black-50 pr-3">Home</a>
                        <a href="cart.html" class="text-decoration-none text-black-50">Giỏ hàng</a>
                    </div>
                    <div class="d-flex py-2">
                        <div class="col-lg-4 col-md-3 col-4 px-0">
                            <img src="https://vn-live-01.slatic.net/p/dbf45cda7d56f7641227a80a5957efdf.jpg" width="100%"
                                height="auto" />
                        </div>
                        <div class="col-lg-8 col-md-9 col-8">
                            <a href="thongtinbox.html" class="text-decoration-none">
                                <p class="mb-0 text-white-space text-dark">Title Title Title Title Title Title Title
                                    Title Title Title</p>
                            </a>
                            <div>Số lượng: 2</div>
                            <div>Đơn giá: 4.000.000VND</div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="title">Tổng đơn:</span>
                        <span class="title">4.000.000VND</span>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12 col-12 px-lg-5">
                    <div class="title text-danger pt-sm-2">Thanh toán</div>
                    <form action="" class="border p-3 mt-2 rounded">
                        <div>Bạn vui lòng nhập đầy đủ thông tin trước khi thanh toán</div>
                        <div class="form-group">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Họ tên</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Nguyễn Văn A..." required></input>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput2">Số điện thoại</label>
                                <input type="tel" class="form-control" id="exampleFormControlInput2"
                                    placeholder="Số điện thoại" required></input>
                            </div>
                            <div class="row">
                                <input type="hidden" name="country" value="Việt Nam">
                                <div class="form-group col-lg-4 col-md-6">
                                    <label for="city">Tỉnh/Thành phố</label>
                                    <select class="form-control" id="city">
                                        <option value="" selected>Chọn tỉnh thành</option>
                                    </select>
                                </div>
                                <div class="form-group col-lg-4 col-md-6">
                                    <label for="district">Quận/Huyện</label>
                                    <select class="form-control" id="district">
                                        <option value="" selected>Chọn quận huyện</option>
                                    </select>
                                </div>
                                <div class="form-group col-lg-4 col-md-6">
                                    <label for="ward">Phường/Xã</label>
                                    <select class="form-control" id="ward">
                                        <option value="" selected>Chọn phường xã</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="exampleFormControlInput5">Số nhà/đường</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput5"
                                        placeholder="Số nhà..." required></input>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn bg-orange text-white">Thanh toán</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
