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
                    <img src="{{ \App\Helpers\ConstCommon::getLinkImageToStorage($dataCart->link_image) }}" width="40%"
                        height="auto" />
                </div>
                <div class="text-center">
                    <a href="{{ route('boxInfo', ['id' => $dataCart->id]) }}" class="text-decoration-none">
                        <h4 class="text-dark">{{ $dataCart->title }}</h4>
                    </a>
                </div>

                <div class="d-flex flex-column justify-content-between w-100 bg-gray px-2 py-2 rounded">
                    <h4 class="text-center">Thông tin mua hàng</h4>
                    <h5>Giá mua: <span class="text-danger">{{ number_format($dataCart->price_cart) }} VNĐ</span></h5>
                    <h5>Số lượng: <span class="text-danger">{{ $dataCart->amount }}</span></h5>
                    <h5>Tổng tiền : <span class="text-danger">{{ number_format($dataCart->amount * $dataCart->price_cart) }}
                            VNĐ</span></h5>
                </div>
                <div class=" my-2 d-flex flex-column  align-items-center  justify-content-between w-100 bg-gray px-2 py-2 rounded">
                    <h4 class="text-center">Thông tin sản phẩm</h4>
                    <h5><span class="text-danger">{{$dataCart->title}}</span></h5>
                    <img src="{{ \App\Helpers\ConstCommon::getLinkImageToStorage($dataCart->product_link_image) }}" width="40%"
                    height="auto" alt="">
                </div>

                <div class="my-2 bg-gray px-2 py-2 rounded">
                    <h4 class="text-center">Thông tin nhận hàng</h4>
                    <p>Số điện thoại: <span class="text-danger">{{ $dataCart->number_phone }}</span></p>
                    <p>Email: <span class="text-danger">{{ $dataCart->email }}</span></p>
                    <p>Địa chỉ: <span class="text-danger">{{ $dataCart->address }}</span></p>
                </div>
               
                <div class="w-100 px-lg-0 d-flex flex-column justify-content-center">
                    <h4 class="text-center">Trạng thái đơn hàng</h4>
                    <button type="submit"
                        class="btn bg-orange text-white p-2 font-weight-bold">{{ $dataCart->status == 3 ? "Đợi admin duyệt giao hàng" : ($dataCart->status == 4 ? "Đang giao hàng" : ($dataCart->status == 5 ? "Đã nhận Hàng" : "Bị từ chối"))  }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
