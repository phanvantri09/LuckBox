@extends('user.layout.index')
@section('css')
@endsection
@section('content')
    <div class="bg-white text-orange title-page">
        <div class="container">
            <p>LuckyBox | Giỏ hàng</p>
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
                                <a href="thongtinbox.html" class="text-decoration-none">
                                    <h4 class="text-dark">{{ $cart->title }}</h4>
                                </a>
                            </div>
                            <div class="col-lg-2">
                                <h5>Đơn giá: <br>{{ number_format($cart->price) }} VNĐ</h5>
                            </div>
                            <div class="col-lg-2 input-group py-2">
                                @if (empty($cart->id_cart_old))
                                <span class="input-group-btn">
                                    <button type="button" class="quantity-left-minus btn btn-danger btn-number"
                                        data-type="minus" data-field="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">
                                            <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z" />
                                        </svg>
                                    </button>
                                </span>
                                <input type="number" id="quantity" name="quantity"
                                    class="form-control input-number text-center" disabled value="{{ $cart->amount }}" min="1"
                                    max="100" />
                                <span class="input-group-btn">
                                    <button type="button" class="quantity-right-plus btn btn-success btn-number"
                                        data-type="plus" data-field="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                            <path
                                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                        </svg>
                                    </button>
                                </span>
                                @else
                                    <h5>Số lượng: {{ $cart->amount }} </h5>
                                @endif

                            </div>
                            <div class="col-lg-2">
                                <h5>Tổng tiền: <br><span
                                        class="font-weight-bold text-danger">{{ number_format($cart->amount * $cart->price) }}
                                        VNĐ</span></h5>
                            </div>
                            <a href="{{ route('checkout', ['id_cart' => $cart->id]) }}" class="w-100 col-lg-1 px-lg-0">
                                <button class="btn bg-orange text-white">Thanh toán</button>
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
                                <a href="thongtinbox.html" class="text-decoration-none">
                                    <p class="mb-0 font-weight-bold text-white-space text-dark">{{ $cart->title }}</p>
                                </a>
                                <p class="mb-0">Đơn giá: {{ number_format($cart->price) }} VNĐ</p>
                                <div class="col-md-6 col-sm-7 col-10 input-group py-2 px-0">
                                    <span class="input-group-btn">
                                        <button type="button" class="quantity-left-minus btn btn-danger btn-number"
                                            data-type="minus" data-field="">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">
                                                <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z" />
                                            </svg>
                                        </button>
                                    </span>
                                    <input type="number" id="quantity" name="quantity"
                                        class="form-control input-number text-center" value="{{ $cart->amount }}"
                                        min="1" max="100" />
                                    <span class="input-group-btn">
                                        <button type="button" class="quantity-right-plus btn btn-success btn-number"
                                            data-type="plus" data-field="">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                                <path
                                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                            </svg>
                                        </button>
                                    </span>
                                </div>
                                <p class="mb-0">Tổng tiền: <span
                                        class="text-danger">{{ number_format($cart->amount * $cart->price) }} VNĐ</span>
                                </p>
                                <a href="{{ route('checkout', ['id_cart' => $cart->id]) }}" class="w-100 px-lg-0">
                                    <button class="btn bg-orange text-white">Thanh toán</button>
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
