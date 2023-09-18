@extends('user.layout.index')
@section('css')
    <style>
        .select-wrap {
            white-space: pre-wrap;
        }

        .page-link {
            color: #000000;
        }

        .page-item.active .page-link {
            z-index: 3;
            color: #ffffff;
            background: linear-gradient(-180deg, #f53d2d, #f63);
            border-color: linear-gradient(-180deg, #f53d2d, rgb(10, 2, 0));
        }
        .zoomable{
            display: none;
        }
        @media(max-width: 768px){
        .title-box{
            font-size: 20px !important;
        }
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
    <div class="content-container py-4">
        <div class="container my-lg-2 my-0">
            <div class="d-flex justify-content-between">
                <h5>Tổng:
                    @if (!empty($dataCarts))
                        {{ $dataCarts->total() }}
                    @endif
                </h5>
                <form class="form-group col-md-2 col-sm-6 col-7" method="GET">
                    <select class="form-control" id="exampleFormControlSelect1"
                        onchange="window.location.href=this.options[this.selectedIndex].value;">
                        @if (isset($_GET['type']))
                            <option {{ $_GET['type'] == 1 ? 'selected' : '' }} value="{{ route('market', ['type' => 1]) }}">
                                Mới nhất</option>
                            <option {{ $_GET['type'] == 2 ? 'selected' : '' }} value="{{ route('market', ['type' => 2]) }}">
                                Giá thấp đến cao </option>
                            <option {{ $_GET['type'] == 3 ? 'selected' : '' }} value="{{ route('market', ['type' => 3]) }}">
                                Giá cao đến thấp</option>
                        @else
                            <option value="{{ route('market', ['type' => 1]) }}">Mới nhất</option>
                            <option value="{{ route('market', ['type' => 2]) }}">Giá thấp đến cao </option>
                            <option value="{{ route('market', ['type' => 3]) }}">Giá cao đến thấp</option>
                        @endif

                    </select>
                </form>
            </div>
            <div class="row">
                @if (!empty($dataCarts))
                    @foreach ($dataCarts as $dataCart)
                        @php
                            $chenhlech = ($dataCart->price_cart * 6) / 100 + $dataCart->price_cart;
                            $createdAt = Carbon::parse($dataCart->created_at);
                        @endphp
                        <div class="col-lg-3 col-md-4 col-sm-6 col-6 px-md-2 px-1 py-2">
                            <div class="bg-white p-2 market-content">
                                <a href="{{ route('boxInfo', ['id' => $dataCart->id_box]) }}"
                                    class="text-decoration-none text-dark">
                                    <img
                                        src="{{ !empty($dataCart->link_image) ? \App\Helpers\ConstCommon::getLinkImageToStorage($dataCart->link_image) : asset('/dist/img/imageBox.jpg') }} " />
                                    <div class="d-flex justify-content-between border-bottom p-2">
                                        <b>F{{ $dataCart->order_number + 1 }}</b>
                                        <b>
                                            {{-- {{ empty($dataCart->name) ? (empty($dataCart->email) ? $dataCart->number_phone : $dataCart->email) : $dataCart->name }} --}}
                                        </b>
                                    </div>
                                    <h4 class="title-box pt-2">{{ $dataCart->title }}</h4>
                                    <h5>Đơn giá: <span
                                            class="font-weight-bold text-danger">{{ number_format($chenhlech) }}</span> VNĐ
                                    </h5>

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
                                    <input type="hidden" name="total"
                                        value="{{ $dataCart->price_cart * $dataCart->amount }}">



                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="p-2 modal-header bg-orange text-white">
                                                <h5 class="modal-title" id="exampleModalLabel">Xác nhận thanh toán</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                {{-- <span>Bạn có chắc chắn mua?</span> --}}
                                                <div class="col-lg-6 col-10 mx-auto py-2 d-flex justify-content-center">
                                                    <img src="{{ !empty($dataCart->link_image) ? \App\Helpers\ConstCommon::getLinkImageToStorage($dataCart->link_image) : asset('/dist/img/imageBox.jpg') }}"
                                                        alt="" class="modal-body-imgbox">
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
                                                <div>
                                                    <h6 class="text-center pt-2">Số lượng</h6>
                                                    <div class="input-group py-2">
                                                        <button type="button"
                                                            class="quantity-left-minus btn btn-warning btn-number"
                                                            onclick="CheckAmount(1, {{ $dataCart->id }}, {{ $dataCart->amount }})"
                                                            data-type="minus" data-field="">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor" class="bi bi-dash"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z" />
                                                            </svg>
                                                        </button>
                                                        <input type="hidden" id="quantityOLD{{ $dataCart->id }}"
                                                            value="{{ $dataCart->amount }}">
                                                        <input type="number" id="quantity{{ $dataCart->id }}"
                                                            onblur="validateInput({{ $dataCart->id }})" name="amount"
                                                            class="form-control input-number text-center" value="1"
                                                            min="1" max="{{ $dataCart->amount }}"
                                                            title="Phải là số nguyên và mọi người chỉ được mua nhiều nhất 100 Hộp." />
                                                        <button type="button"
                                                            class="quantity-right-plus btn btn-warning btn-number"
                                                            onclick="CheckAmount(2, {{ $dataCart->id }}, {{ $dataCart->amount }})"
                                                            data-type="plus" data-field="">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor" class="bi bi-plus"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                    <span class="text-danger" id="message"></span>
                                                </div>
                                            </div>

                                            <div class="p-1 modal-footer d-flex justify-content-center">
                                                <button type="cancel" class="btn btn-secondary"
                                                    onclick="cancelCheckout({{ $dataCart->id }})"
                                                    data-dismiss="modal">Hủy</button>
                                                <button type="submit" class="btn bg-success text-white">Thanh
                                                    toán</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
            <div class="row">
                <div class=" w-100 d-flex justify-content-center">
                    @if (!empty($dataCarts))
                        {{ $dataCarts->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
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

        function CheckAmount(type, id, amountID) {
            var quantity = parseInt($("#quantity" + id).val());
            if (type == 1) {
                // -
                if (quantity > 1) {
                    $("#quantity" + id).val(quantity - 1);
                }
            }
            if (type == 2) {
                // +
                if (quantity < amountID) {
                    $("#quantity" + id).val(quantity + 1);
                } else {
                    alert("Vượt quá số lượng hiện có");
                }
            }
        }

        function cancelCheckout(id_cart) {
            $("#quantity" + id_cart).val(1);
        }

        function validateInput(id) {
            var input = document.getElementById("quantity" + id).value;
            var min = parseInt(document.getElementById("quantity" + id).getAttribute("min"));
            var max = parseInt(document.getElementById("quantity" + id).getAttribute("max"));

            if (input < min || input > max) {
                alert("Bạn đã nhập một số quá lớn. Vui lòng nhập lại.");
                // $('#quantityOLD' + id).val()
                $('#quantity' + id).val(1);
            }
        }
    </script>
@endsection
