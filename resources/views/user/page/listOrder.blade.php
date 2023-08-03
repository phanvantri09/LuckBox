@extends('user.layout.index')
@section('css')
@endsection
@section('content')
    <div class="bg-white text-orange title-page">
        <div class="container">
            <p>LuckyBox | Đơn hàng sắp nhận</p>
        </div>
    </div>
    <div class="content-container py-4">
        <div class="container my-lg-2 my-0">
            @if (empty($dataCart))
                <h1>Giỏ của bạn không có gì</h1>
            @else
                <!-- desktop -->
                <div class="d-lg-block d-none">
                    @foreach ($dataCart as $cart)
                        <div class="row align-items-center bg-orange-white py-2 rounded mb-2 px-2">
                            <div class="col-lg-2 px-1">
                                <img src="{{ \App\Helpers\ConstCommon::getLinkImageToStorage($cart->link_image) }}"
                                    width="100%" height="auto" />
                            </div>
                            <div class="col-lg-3">
                                <a href="{{ route('boxInfo', ['id'=> $cart->id]) }}" class="text-decoration-none">
                                    <h4 class="text-dark">{{ $cart->title }}</h4>
                                </a>
                            </div>
                            <div class="col-lg-2">
                                <h5>Đơn giá: <br>{{ number_format($cart->price_cart) }} VNĐ</h5>
                                <h5>Số lượng: {{ $cart->amount }} </h5>
                            </div>
                            <div class="col-lg-2 input-group py-2">
                                <h5>Thời gian đặt: <br>{{ date('d-m-Y', strtotime($cart->created_at)) }}</h5>
                            </div>
                            <div class="col-lg-2">
                                <h5>Tổng tiền: <br><span
                                        class="font-weight-bold text-danger">{{ number_format($cart->amount * $cart->price_cart) }}
                                        VNĐ</span></h5>
                            </div>
                            <a href="{{ route('showOrder', ['id_cart' => $cart->id]) }}" class="w-100 col-lg-1 px-lg-0">
                                <button class="btn bg-orange text-white">Xem thông tin</button>
                            </a>
                        </div>
                    @endforeach
                </div>
                <!-- end desltop -->
                <!-- mobile -->
                <div class="d-lg-none">
                    @foreach ($dataCart as $cart)
                        <div class="row bg-orange-white py-2 rounded mb-2 px-2">
                            <div class="col-md-3 col-sm-3 col-4 px-1">
                                <img src="{{ \App\Helpers\ConstCommon::getLinkImageToStorage($cart->link_image) }}"
                                    width="100%" height="auto" />
                            </div>
                            <div class="col-md-9 col-sm-9 col-8">
                                <a href="{{ route('boxInfo', ['id'=> $cart->id]) }}" class="text-decoration-none">
                                    <p class="mb-0 font-weight-bold text-white-space text-dark">{{ $cart->title }}</p>
                                </a>
                                <p class="mb-0">Đơn giá: {{ number_format($cart->price) }} VNĐ</p>
                                <p class="mb-0">Tổng tiền: <span
                                        class="text-danger">{{ number_format($cart->amount * $cart->price) }} VNĐ</span>
                                </p>
                                <p class="mb-0">Thời gian đặt: {{ date('d-m-Y', strtotime($cart->created_at)) }}</p>
                                <a href="{{ route('showOrder', ['id_cart' => $cart->id]) }}" class="w-100 px-lg-0">
                                    <button class="btn bg-orange text-white">Xem thông tin</button>
                                </a>
                            </div>
                        </div>
                    @endforeach


                </div>
                <!-- end mobile -->
            @endif

            {{-- <div class="row bg-white py-4 rounded justify-content-end px-2">
                <a href="{{ route('checkout') }}">
                    <button class="btn bg-orange text-white py-2 font-weight-bold">Thanh toán tất cả</button>
                </a>
            </div> --}}
        </div>
    </div>
@endsection
@section('scripts')
@endsection
