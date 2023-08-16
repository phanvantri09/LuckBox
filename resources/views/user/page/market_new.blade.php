@extends('user.layout.index')
@section('css')
@endsection
@section('content')
    <div class="bg-white text-orange title-page">
        <div class="container">
            <p>LuckyBox | Chợ</p>
        </div>
    </div>
    @php
        use Carbon\Carbon;
    @endphp
    <div class="content-container py-4">
        <div class="container my-lg-2 my-0">
            <div class="d-flex justify-content-between">
                <h5>30 box</h5>
                <div class="form-group col-md-2 col-sm-6 col-7">
                    <select class="form-control" id="exampleFormControlSelect1">
                        <option>Mới nhất</option>
                        <option>Giá thấp đến cao </option>
                        <option>Giá cao đến thấp</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="bg-white p-2 market-content">
                        <a href="" class="text-decoration-none text-dark">
                            <img src="https://hpconnect.vn/wp-content/uploads/2020/02/hinh-anh-hoa-hong-dep-3-1-1068x801.jpg"/>
                            <h4 class="title-box">xdsfs</h4>
                            <h5>Đơn giá: <span class="font-weight-bold text-danger">dsjhsaj</span>VNĐ</h5>
                            <div class="d-flex justify-content-between">
                                <div>F29</div>
                                <div>Tên người bán</div>
                            </div>
                            <div>Còn lại: <span class="font-weight-bold text-danger">10</span></div>
                            <div class="box-new bg-danger text-white px-1 label-status">
                                Mới
                            </div>
                        </a>
                        <div class="d-flex justify-content-between py-2">
                            <button class="btn bg-orange text-white" data-toggle="modal" data-target="#exampleModal">Thanh
                                toán
                                ngay</button>
                            <a href="">
                                <button class="btn bg-warning">Hủy bán</button>
                            </a>
                        </div>
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="p-2 modal-header bg-orange text-white">
                                        <h5 class="modal-title" id="exampleModalLabel">Xác nhận thanh toán</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <span>Bạn có chắc chắn mua?</span>
                                        <div class="col-lg-6 col-10 mx-auto py-2">
                                            <img src="https://hpconnect.vn/wp-content/uploads/2020/02/hinh-anh-hoa-hong-dep-3-1-1068x801.jpg" alt="" style="width: 100%; height: auto;">
                                        </div>
                                        <h6 class="text-center">Title</h6>
                                        <div class="text-center">Đơn giá: <span class="font-weight-bold text-danger">dsjhsaj</span>VNĐ</div>
                                    </div>
                                    <div class="p-1 modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                                        <button type="button" class="btn bg-success text-white">Thanh toán</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
