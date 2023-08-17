@extends('user.layout.index')
@section('css')
@endsection
@section('content')
    <div class="bg-white text-orange title-page">
        <div class="container">
            <p>LuckyBox | Thanh toán</p>
        </div>
    </div>

    <div class="content-container py-md-4 py-3">
        <div class="container my-lg-2 my-0 bg-white py-4">
            <div class="row content-page p-lg-5">
                <div class="col-lg-4 col-md-12 col-sm-12 col-12 p-lg-0">
                    <div class="title">Đơn hàng của bạn</div>
                    <div class="d-flex ">
                        <a href="{{ route('home') }}" class="text-decoration-none text-black-50 pr-3">Home</a>
                        <a href="{{ route('cart') }}" class="text-decoration-none text-black-50">Giỏ hàng</a>
                    </div>
                    <div class="d-flex py-2">
                        <div class="col-lg-4 col-md-3 col-4 px-0">
                            <img src="{{ \App\Helpers\ConstCommon::getLinkImageToStorage($dataCart->link_image) }}"
                                width="100%" height="auto" />
                        </div>
                        <div class="col-lg-8 col-md-9 col-8">
                            <a href="{{ route('boxInfo', ['id' => $dataCart->id]) }}" class="text-decoration-none">
                                <p class="mb-0 text-white-space text-dark">{{ $dataCart->title }}</p>
                            </a>
                            <div>Số lượng: {{ $dataCart->amount }}</div>
                            {{-- {{ (empty($dataCart->id_cart_old)) ? number_format($dataCart->price) : number_format(\App\Helpers\ConstCommon::priceUp( count(explode(",", $dataCart->id_folow)), $dataCart->price)) }} --}}
                            <div>Đơn giá:{{ number_format($dataCart->price_cart) }} VNĐ</div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="title">Tổng đơn:</span>
                        <span class="title">{{ number_format($dataCart->price_cart * $dataCart->amount) }} VND</span>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12 col-12 px-lg-5">
                    <div class="title text-danger pt-sm-2">Thanh toán</div>
                    <form action="{{ route('checkoutPost') }}" class="border p-3 mt-2 rounded" method="post">
                        @csrf
                        <input type="hidden" name="id_cart" value="{{ $dataCart->id }}">
                        <input type="hidden" name="id_box_item" value="{{ $dataCart->id_box_item }}">
                        <input type="hidden" name="id_box_event" value="{{ $dataCart->id_box_event }}">
                        <input type="hidden" name="id_box" value="{{ $dataCart->id_box }}">
                        <input type="hidden" name="price" value="{{ $dataCart->price }}">
                        <input type="hidden" name="amount"
                            value="{{ empty($dataCart->id_cart_old) ? $dataCart->amount : 1 }}">
                        <input type="hidden" name="total" value="{{ $dataCart->price_cart * $dataCart->amount }}">
                        {{-- <input type="" name="amount" value="{{$dataCart->amount}}"> --}}
                        {{-- <div>Bạn vui lòng nhập đầy đủ thông tin trước khi thanh toán</div> --}}
                        <div class="d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-geo-alt" viewBox="0 0 16 16">
                                <path
                                    d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z" />
                                <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                            </svg>&nbsp;
                            <span class="font-weight-bold">Địa chỉ nhận hàng</span>
                        </div>
                        <div class="row">
                            <div class="col-md-10 col-12 py-1">
                                @foreach ($inforUserBills as $inforUserBill)
                                    <p class="mb-0">Họ và tên: {{ $inforUserBill->name }} </p>
                                    <p class="mb-0">Số điện thoại: {{ $inforUserBill->number_phone }}</p>
                                    <p class="mb-0">Địa chỉ: {{ $inforUserBill->address }}</p>
                                @endforeach
                            </div>
                            <div class="col-md-2 col-12 py-1">
                                <button type="button" class="btn bg-info text-white" data-toggle="modal"
                                    data-target="#changeaddress">Thay đổi</button>
                            </div>
                        </div>
                        <div class="modal fade changeaddress" id="changeaddress" tabindex="-1" role="dialog"
                            aria-labelledby="changeaddressLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="changeaddressLabel">Địa chỉ của tôi</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body overflow-auto">
                                        <div class="form-check py-2 border-bottom">
                                            <input class="form-check-input" type="radio" name="gridRadios"
                                                id="gridRadios1" value="option1" checked>
                                            <label class="form-check-label" for="gridRadios1">
                                                First radio
                                            </label>
                                        </div>
                                        @foreach ($inforUserBills as $inforUserBill)
                                            <div class="form-check py-2 border-bottom">
                                                <input class="form-check-input" type="radio" name="gridRadios"
                                                    id="gridRadios2" value="option2">
                                                <label class="form-check-label" for="gridRadios2">
                                                    Họ và tên: {{ $inforUserBill->name }} <br>
                                                    Số điện thoại: {{ $inforUserBill->number_phone }} <br>
                                                    Địa chỉ: {{ $inforUserBill->address }} <br>
                                                </label>
                                            </div>
                                        @endforeach
                                        <div class="form-check py-2 border-bottom">
                                            <input class="form-check-input" type="radio" name="gridRadios"
                                                id="gridRadios3" value="option3">
                                            <label class="form-check-label" for="gridRadios3">
                                                Third disabled radio
                                            </label>
                                        </div>
                                        <div class="form-check py-2 border-bottom">
                                            <input class="form-check-input" type="radio" name="gridRadios"
                                                id="gridRadios3" value="option3">
                                            <label class="form-check-label" for="gridRadios3">
                                                Third disabled radio
                                            </label>
                                        </div>
                                        <div class="form-check py-2 border-bottom">
                                            <input class="form-check-input" type="radio" name="gridRadios"
                                                id="gridRadios3" value="option3">
                                            <label class="form-check-label" for="gridRadios3">
                                                Third disabled radio
                                            </label>
                                        </div>
                                        <a href="" class="text-decoration-none" target="_blank">
                                            <button type="button"
                                                class="btn bg-white text-dark border rounded d-flex align-items-center my-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd"
                                                        d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                                                </svg>
                                                Thêm địa chỉ mới
                                            </button>
                                        </a>
                                    </div>
                                    <div class="p-1 modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Hủy</button>
                                        <button type="button" class="btn bg-orange text-white">Thay đổi</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="form-group">
                            <div class="form-group">
                                <label for="exampleFormControlInput1" class="d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                                        <path
                                            d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z" />
                                        <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                    </svg>
                                    Địa chỉ nhận hàng
                                </label>
                                <select name="id_info_user_bill" class="form-group">
                                    @foreach ($inforUserBills as $inforUserBill)
                                        <option value="{{ $inforUserBill->id }}">
                                            <div>
                                                Họ và tên: {{ $inforUserBill->name }} <br>
                                                Số điện thoại: {{ $inforUserBill->number_phone }} <br>
                                                Địa chỉ: {{ $inforUserBill->address }} <br>
                                            </div>
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlInput1">Họ tên</label>

                                <input type="text" name="name" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Nguyễn Văn A..." value="{{ Auth::user()->name ?? null }}" required />
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput2">Số điện thoại</label>
                                <input type="tel" name="number_phone" class="form-control" id="exampleFormControlInput2"
                                value="{{ $userInfo->number_phone ?? null }}"
                                    pattern="/(84|0[3|5|7|8|9])+([0-9]{8})\b/g"
                                    placeholder="Số điện thoại" required />
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="exampleFormControlInput5">Địa chỉ cụ thể nhận hàng</label>
                                    <textarea name="address" id=""  class="form-control" cols="30" rows="3" required></textarea>
                                </div>
                            </div>
                        </div> --}}
                        <button type="submit" class="btn bg-orange text-white">Xác nhận thanh toán</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script src="./js/address.js"></script>
@endsection
