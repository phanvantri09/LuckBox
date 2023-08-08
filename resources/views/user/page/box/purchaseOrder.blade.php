@extends('user.layout.index')
@section('css')
@endsection
@section('content')
    <div class="bg-white text-orange title-page">
        <div class="container">
            <p>LuckyBox | Box đã mua</p>
        </div>
    </div>
    <div class="content-container py-4">
        <div class="container my-lg-2 my-0">
            <!-- desktop -->
            <div class="d-lg-block d-none">
                @foreach ($carts as $dataCart)
                    <div class="row align-items-center bg-orange-white py-2 rounded mb-2 px-2">
                        <div class="col-lg-2 px-1">
                            <img src="{{ \App\Helpers\ConstCommon::getLinkImageToStorage($dataCart->link_image) }}"
                                width="80%" height="auto" />
                        </div>
                        <div class="col-lg-2">
                            <a href="{{ route('boxInfo', ['id'=> $dataCart->id]) }}" class="text-decoration-none">
                                <h4 class="text-dark">{{ $dataCart->title }}</h4>
                            </a>
                        </div>
                        <div class="col-lg-2">
                            <h6>Giá mua: <br> {{ number_format($dataCart->price_cart) }} VNĐ/hộp</h6>
                            @if (($dataCart->status != 10))
                                <h5>Tổng tiền: <br><span class="font-weight-bold text-danger">
                                {{ number_format($dataCart->amount * $dataCart->price_cart) }} VNĐ</span></h5>
                            @endif
                        </div>
                        <div class="col-lg-2">
                            <span>Số lượng: {{ $dataCart->amount }}</span>
                        </div>
                        @if ($dataCart->status == 10)
                            {{-- <a href="{{ route('openBox', ['id_cart' => $dataCart->id]) }}" class="w-100 col-lg-2 px-lg-0">
                                <button class="btn bg-success text-white">Mở box</button>
                            </a> --}}
                            @if ($dataCart->status != 11)
                                <a href="{{ route('treeData', ['id' => $dataCart->id]) }}" class="w-100 col-lg-2 px-lg-0">
                                    <button class="btn bg-orange text-white">Xem doanh thu box</button>
                                </a>
                            @endif
                        @else
                            <a href="{{ route('openBox', ['id_cart' => $dataCart->id]) }}" class="w-100 col-lg-2 px-lg-0">
                                <button class="btn bg-success text-white">Mở box</button>
                            </a>
                            @if ($dataCart->status != 11)
                                <a href="{{ route('sendToMarket', ['id_cart' => $dataCart->id]) }}"
                                    class="w-100 col-lg-2 px-lg-0">
                                    <button class="btn bg-orange text-white">Gửi bán</button>
                                </a>
                            @endif
                        @endif

                    </div>
                @endforeach

            </div>
            <!-- end desltop -->
            <!-- mobile -->
            <div class="d-lg-none">
                @foreach ($carts as $dataCart)
                    <div class="row bg-orange-white py-2 rounded mb-2 px-2">
                        <div class="col-md-3 col-sm-3 col-4 px-1">
                            <img src="{{ \App\Helpers\ConstCommon::getLinkImageToStorage($dataCart->link_image) }}"
                                width="100%" height="auto" />
                        </div>
                        <div class="col-md-9 col-sm-9 col-8">
                            <a href="{{ route('boxInfo', ['id'=> $dataCart->id]) }}" class="text-decoration-none">
                                <p class="mb-0 font-weight-bold text-white-space text-dark">{{ $dataCart->title }}</p>
                            </a>
                            <p class="mb-0">Số lượng: {{ $dataCart->amount }}</p>
                            <p class="mb-0">Giá mua: {{ number_format($dataCart->price) }} VNĐ</p>
                            <p class="mb-0">Tổng tiền: <span
                                    class="text-danger font-weight-bold">{{ number_format($dataCart->amount * $dataCart->price) }}
                                    VNĐ</span></p>
                            <div class="d-flex justify-content-between pt-1">
                                @if ($dataCart->status == 10)
                                    {{-- <a href="{{ route('openBox', ['id_cart' => $dataCart->id]) }}">
                                        <button class="btn bg-success text-white">Mở box</button>
                                    </a> --}}
                                    @if ($dataCart->status != 11)
                                        <a href="{{ route('treeData', ['id' => $dataCart->id]) }}">
                                            <button class="btn bg-orange text-white">Doanh thu</button>
                                        </a>
                                    @endif
                                @else
                                    <a href="{{ route('openBox', ['id_cart' => $dataCart->id]) }}">
                                        <button class="btn bg-success text-white">Mở box</button>
                                    </a>
                                    @if ($dataCart->status != 11)
                                        <a href="{{ route('sendToMarket', ['id_cart' => $dataCart->id]) }}">
                                            <button class="btn bg-orange text-white">Gửi bán</button>
                                        </a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
                <!-- end mobile -->
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
