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
            <div class="row py-3 mb-2 border sort-market">
                <div class="px-2 d-md-block d-none">Sắp xếp theo</div>
                <div class="col-lg-2 col-md-3 col-4 text-center">
                    <a class="text-dark font-weight-bold text-decoration-none {{ isset($_GET['type']) ? ($_GET['type'] == 1 ? 'active-sort' : '') : '' }}"
                        href="{{ route('market', ['type' => 1]) }}">Mới
                        nhất</a>
                </div>
                <div class="col-lg-2 col-md-3 col-4 text-center">
                    <a class="text-dark font-weight-bold text-decoration-none {{ isset($_GET['type']) ? ($_GET['type'] == 2 ? 'active-sort' : '') : '' }}"
                        href="{{ route('market', ['type' => 2]) }}">Giá
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-arrow-down" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z" />
                        </svg></a>
                </div>
                <div class="col-lg-2 col-md-3 col-4 text-center">
                    <a class="text-dark font-weight-bold text-decoration-none {{ isset($_GET['type']) ? ($_GET['type'] == 3 ? 'active-sort' : '') : '' }}"
                        href="{{ route('market', ['type' => 3]) }}">Giá
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-arrow-up" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z" />
                        </svg>
                    </a>
                </div>
            </div>
            <!-- desktop -->
            <div class="d-lg-block d-none">
                @foreach ($dataCarts as $dataCart)
                    <div class="row align-items-center bg-orange-white py-2 rounded mb-2 px-2 market-content">
                        <div class="col-lg-2 px-1">
                            <img src="{{ \App\Helpers\ConstCommon::getLinkImageToStorage($dataCart->link_image) }}"
                                width="100%" height="auto" />
                        </div>
                        <div class="col-lg-3">
                            <a href="{{ route('boxInfo', ['id' => $dataCart->id]) }}" class="text-decoration-none">
                                <h4 class="text-dark">{{ $dataCart->title }}</h4>
                            </a>
                        </div>
                        <div class="col-lg-5">
                            @php
                                $chenhlech = ($dataCart->price_cart * 6) / 100 + $dataCart->price_cart;
                            @endphp
                            <h5>Đơn giá: <span class="font-weight-bold text-danger">{{ number_format($chenhlech) }}
                                </span>VNĐ</h5>
                            <h5 class="text-dark">Còn lại: <span
                                    class="font-weight-bold text-danger">{{ $dataCart->amount }}</span></h5>
                        </div>
                        @auth
                            @if ($dataCart->id_user_create != Auth::user()->id)
                                <a href="{{ route('addToCartOld', ['id_cart_old' => $dataCart->id]) }}"
                                    class="w-100 col-lg-2 px-lg-0">
                                    <button class="btn bg-orange text-white">Mua ngay</button>
                                </a>
                            @else
                                <a href="{{ route('stopMarket', ['id_cart' => $dataCart->id]) }}"
                                    class="w-100 col-lg-2 px-lg-0">
                                    <button class="btn bg-warning">Hủy bán</button>
                                </a>
                            @endif
                        @else
                            <a href="{{ route('addToCartOld', ['id_cart_old' => $dataCart->id]) }}"
                                class="w-100 col-lg-2 px-lg-0">
                                <button class="btn bg-orange text-white">Mua ngay</button>
                            </a>
                        @endauth
                        @php
                            $createdAt = Carbon::parse($dataCart->created_at);
                        @endphp
                        @if($createdAt->gt($threeDaysAgo))
                            <div class="box-new bg-danger text-white px-1 label-status">
                                Mới
                            </div>
                        @endif

                    </div>
                @endforeach
                {!! $dataCarts->links() !!}
            </div>
            <!-- end desltop -->
            <!-- mobile -->
            <div class="d-lg-none">
                @foreach ($dataCarts as $dataCart)
                    <div class="row bg-orange-white py-2 rounded mb-2 px-2 market-content">
                        <div class="col-md-3 col-sm-3 col-4 px-1">
                            <img src="{{ \App\Helpers\ConstCommon::getLinkImageToStorage($dataCart->link_image) }}"
                                width="100%" height="auto" />
                        </div>
                        <div class="col-md-9 col-sm-9 col-8">
                            <a href="{{ route('boxInfo', ['id' => $dataCart->id]) }}" class="text-decoration-none">
                                <p class="mb-0 font-weight-bold text-white-space text-dark">{{ $dataCart->title }}</p>
                            </a>
                            <p class="mb-0">Đơn giá: <span class="text-danger">{{ number_format($chenhlech) }} VNĐ</span>
                            </p>
                            @auth
                                @if ($dataCart->id_user_create != Auth::user()->id)
                                    <a href="{{ route('addToCartOld', ['id_cart_old' => $dataCart->id]) }}"
                                        class="w-100 px-lg-0">
                                        <button class="btn bg-orange text-white">Mua ngay</button>
                                    </a>
                                @else
                                    <a href="{{ route('stopMarket', ['id_cart' => $dataCart->id]) }}" class="w-100 px-lg-0">
                                        <button class="btn bg-warning">Hủy bán</button>
                                    </a>
                                @endif
                            @else
                                <a href="{{ route('addToCartOld', ['id_cart_old' => $dataCart->id]) }}"
                                    class="w-100 col-lg-2 px-lg-0">
                                    <button class="btn bg-orange text-white">Mua ngay</button>
                                </a>
                            @endauth
                        </div>
                        @php
                            $createdAt = Carbon::parse($dataCart->created_at);
                        @endphp
                        @if($createdAt->gt($threeDaysAgo))
                            <div class="box-new bg-danger text-white px-1">
                                Mới
                            </div>
                        @endif
                    </div>
                @endforeach
                {!! $dataCarts->links() !!}
            </div>
            <!-- end mobile -->
        </div>
    </div>
@endsection
@section('scripts')
@endsection
