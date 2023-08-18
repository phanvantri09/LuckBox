@extends('user.layout.index')
@section('css')
    <style>
        .select-wrap {
            white-space: pre-wrap;
        }
    </style>
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
    {{-- <div class="content-container py-4">
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
                        @if ($createdAt->gt($threeDaysAgo))
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
                        @if ($createdAt->gt($threeDaysAgo))
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
    </div> --}}
    <div class="content-container py-4">
        <div class="container my-lg-2 my-0">
            <div class="d-flex justify-content-between">
                <h5>Tổng: {{ $dataCarts->total() }}</h5>
                <form class="form-group col-md-2 col-sm-6 col-7" method="GET">
                    <select class="form-control" id="exampleFormControlSelect1"
                        onchange="window.location.href=this.options[this.selectedIndex].value;">
                        <option value="{{ route('market', ['type' => 1]) }}">Mới nhất</option>
                        <option value="{{ route('market', ['type' => 2]) }}">Giá thấp đến cao </option>
                        <option value="{{ route('market', ['type' => 3]) }}">Giá cao đến thấp</option>
                    </select>
                </form>
            </div>
            <div class="row">
                @foreach ($dataCarts as $dataCart)
                    @php
                        $chenhlech = ($dataCart->price_cart * 6) / 100 + $dataCart->price_cart;
                        $createdAt = Carbon::parse($dataCart->created_at);
                    @endphp
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2 ">
                        <div class="bg-white p-2 market-content">
                            <a href="{{ route('boxInfo', ['id' => $dataCart->id]) }}"
                                class="text-decoration-none text-dark">
                                <img
                                    src="{{ \App\Helpers\ConstCommon::getLinkImageToStorage($dataCart->link_image) ?? '/dist/img/imageBox.jpg' }} " />
                                <div class="d-flex justify-content-between border-bottom p-2">
                                    <b>F{{ $dataCart->order_number + 1 }}</b>
                                    <b>{{ empty($dataCart->name) ? (empty($dataCart->email) ? $dataCart->number_phone : $dataCart->email) : $dataCart->name }}</b>
                                </div>
                                <h4 class="title-box pt-2">{{ $dataCart->title }}</h4>
                                <h5>Đơn giá: <span
                                        class="font-weight-bold text-danger">{{ number_format($chenhlech) }}</span> VNĐ</h5>

                                <div>Còn lại: <span class="font-weight-bold text-danger">{{ $dataCart->amount }}</span>
                                </div>
                                @if ($createdAt->gt($threeDaysAgo))
                                    <div class="box-new bg-danger text-white px-1 label-status">
                                        Mới
                                    </div>
                                @endif
                            </a>
                            <div class="d-flex justify-content-between py-2">
                                @auth
                                    @if ($dataCart->id_user_create != Auth::user()->id)
                                        <button class="btn bg-orange text-white" data-toggle="modal"
                                            data-target="#exampleModal{{ $dataCart->id }}">
                                            Mua ngay
                                        </button>
                                        {{-- <a href="{{ route('addToCartOld', ['id_cart_old' => $dataCart->id]) }}"
                                        class="w-100 px-lg-0">
                                        <button class="btn bg-orange text-white">Mua ngay</button>
                                    </a> --}}
                                    @else
                                        <a href="{{ route('stopMarket', ['id_cart' => $dataCart->id]) }}">
                                            <button class="btn bg-warning">Hủy bán</button>
                                        </a>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}">
                                        <button class="btn bg-orange text-white">Mua ngay</button>
                                    </a>
                                @endauth
                                {{-- <button class="btn bg-orange text-white" data-toggle="modal" data-target="#exampleModal{{$dataCart->id}}">
                                Thanh toán ngay
                            </button>
                            <a href="">
                                <button class="btn bg-warning">Hủy bán</button>
                            </a> --}}
                            </div>
                            <form method="post" action="{{ route('checkoutPost') }}" class="modal fade"
                                id="exampleModal{{ $dataCart->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                @csrf
                                {{-- phải tọa ra bill trước rồi mới thanh toán dc --}}
                                <input type="hidden" name="market_pay" value="true">
                                <input type="hidden" name="id_cart" value="{{ $dataCart->id }}">
                                <input type="hidden" name="id_box_item" value="{{ $dataCart->id_box_item }}">
                                <input type="hidden" name="id_box_event" value="{{ $dataCart->id_box_event }}">
                                <input type="hidden" name="id_box" value="{{ $dataCart->id_box }}">
                                <input type="hidden" name="price" value="{{ $dataCart->price }}">
                                <input type="hidden" name="amount"
                                    value="{{ empty($dataCart->id_cart_old) ? $dataCart->amount : 1 }}">
                                <input type="hidden" name="total"
                                    value="{{ $dataCart->price_cart * $dataCart->amount }}">



                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="p-2 modal-header bg-orange text-white">
                                            <h5 class="modal-title" id="exampleModalLabel">Xác nhận thanh toán</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            {{-- <span>Bạn có chắc chắn mua?</span> --}}
                                            <div class="col-lg-6 col-10 mx-auto py-2">
                                                <img src="{{ \App\Helpers\ConstCommon::getLinkImageToStorage($dataCart->link_image) ?? '/dist/img/imageBox.jpg' }}"
                                                    alt="" style="width: 100%; height: auto;">
                                            </div>
                                            <h6 class="text-center">{{ $dataCart->title }}</h6>
                                            <div class="text-center">Đơn giá: <span
                                                    class="font-weight-bold text-danger">{{ number_format($chenhlech) }}</span>VNĐ
                                            </div>
                                            @auth
                                                <div style="display: none" class="form-group">
                                                    <label for="exampleFormControlInput1">Chọn thông tin nhận hàng</label>
                                                    <select style="width: 100%" id="mySelect" name="id_info_user_bill"
                                                        class="form-select" aria-label="Default select example">
                                                        @foreach ($inforUserBills as $inforUserBill)
                                                            <option value="{{ $inforUserBill->id }}"
                                                                {{ $inforUserBill->status == 1 ? 'selected' : '' }}>
                                                                <div> {{ $inforUserBill->name }} - </div>
                                                                <div> {{ $inforUserBill->number_phone }} - </div>
                                                                <div> {{ $inforUserBill->address }} - </div>
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endauth

                                        </div>

                                        <div class="p-1 modal-footer">
                                            <button type="cancel" class="btn btn-secondary"
                                                data-dismiss="modal">Hủy</button>
                                            <button type="submit" class="btn bg-success text-white">Thanh toán</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        var select = document.getElementById("mySelect");

        for (var i = 0; i < select.options.length; i++) {
            var option = select.options[i];
            var text = option.textContent;

            if (text.includes("-")) {
                var parts = text.split(" - ");
                option.textContent = parts.join('\n');
            }
        }
    </script>
@endsection
