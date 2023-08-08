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
                        <a href="{{ route('home') }}" class="text-decoration-none text-black-50 pr-3">Home</a>
                        <a href="{{ route('cart') }}" class="text-decoration-none text-black-50">Giỏ hàng</a>
                    </div>
                    <div class="d-flex py-2">
                        <div class="col-lg-4 col-md-3 col-4 px-0">
                            <img src="{{ \App\Helpers\ConstCommon::getLinkImageToStorage($dataCart->link_image) }}" width="100%"
                                height="auto" />
                        </div>
                        <div class="col-lg-8 col-md-9 col-8">
                            <a href="{{ route('boxInfo', ['id'=> $dataCart->id]) }}" class="text-decoration-none">
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
                        <input type="hidden" name="id_cart" value="{{$dataCart->id}}">
                        <input type="hidden" name="id_box_item" value="{{$dataCart->id_box_item}}">
                        <input type="hidden" name="id_box_event" value="{{$dataCart->id_box_event}}">
                        <input type="hidden" name="id_box" value="{{$dataCart->id_box}}">
                        <input type="hidden" name="price" value="{{$dataCart->price}}">
                        <input type="hidden" name="amount" value="{{(empty($dataCart->id_cart_old)) ? $dataCart->amount : 1 }}">
                        <input type="hidden" name="total" value="{{ $dataCart->price_cart * $dataCart->amount }}">
                        {{-- <input type="" name="amount" value="{{$dataCart->amount}}"> --}}
                        <div>Bạn vui lòng nhập đầy đủ thông tin trước khi thanh toán</div>
                        <div class="form-group">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Họ tên</label>

                                <input type="text"  name="name" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Nguyễn Văn A..." value="{{ $userInfo->name ?? null }}" required />
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput2">Số điện thoại</label>
                                <input type="tel" name="number_phone" class="form-control" id="exampleFormControlInput2"
                                value="{{ $userInfo->number_phone ?? null }}"
                                    pattern="/(84|0[3|5|7|8|9])+([0-9]{8})\b/g"
                                    placeholder="Số điện thoại" required />
                            </div>
                            {{-- <div class="row">
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
                            </div> --}}
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="exampleFormControlInput5">Địa chỉ cụ thể nhận hàng</label>
                                    <textarea name="address" id=""  class="form-control" cols="30" rows="3" required></textarea>
                                    {{-- <input type="text" name="address" class="form-control" id="exampleFormControlInput5"
                                        placeholder="Địa chỉ cụ thể nhận hàng..." required /> --}}
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script src="./js/address.js"></script>
@endsection
