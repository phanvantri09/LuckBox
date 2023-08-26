@extends('user.layout.index')
@section('css')
@endsection
@section('content')
    <div class="bg-white text-orange title-page">
        <div class="container">
            <p>LuckyBox | Giỏ hàng</p>
        </div>
    </div>
    <div class="content-container py-md-4 py-3">
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
                            <div class="col-lg-2">
                                <a href="{{ route('boxInfo', ['id'=> $cart->id_box]) }}" class="text-decoration-none">
                                    <h4 class="text-dark">{{ $cart->title }}</h4>
                                </a>
                            </div>
                            <div class="col-lg-2">
                                <h5>Đơn giá: <br>{{ number_format($cart->price_cart) }} VNĐ</h5>
                            </div>
                            <div class="col-lg-2 input-group py-2">
                                @if (empty($cart->id_cart_old))
                                <a href="{{ route('cartUpdateAmount', ['id_cart'=>$cart->id, 'type'=>1]) }}" class="input-group-btn">
                                    <button type="button" class=" btn btn-danger btn-number"
                                        data-type="minus" data-field="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">
                                            <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z" />
                                        </svg>
                                    </button>
                                </a>
                                <input type="hidden" id="quantityOLD{{$cart->id}}" value="{{ $cart->amount }}">
                                <input type="number" id="quantity{{$cart->id}}" name="quantity"
                                onblur="validateInput({{$cart->id}})"
                                    class="form-control input-number text-center" value="{{ $cart->amount }}" min="1"
                                    max="{{\App\Helpers\ConstCommon::getAmountBoxItem($cart->id_box_item) < 100 ? \App\Helpers\ConstCommon::getAmountBoxItem($cart->id_box_item): 100}}" />
                                <a class="input-group-btn" href="{{ route('cartUpdateAmount', ['id_cart'=>$cart->id, 'type'=>2]) }}">
                                    <button type="button" class=" btn btn-success btn-number"
                                        data-type="plus" data-field="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                            <path
                                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                        </svg>
                                    </button>
                                </a>
                                @else
                                    <h5>Số lượng: {{ $cart->amount }} </h5>
                                @endif

                            </div>
                            <div class="col-lg-2">
                                <h5>Tổng tiền: <br><span
                                        class="font-weight-bold text-danger">{{ number_format($cart->amount * $cart->price_cart) }}
                                        VNĐ</span></h5>
                            </div>
                            <a href="{{ route('stopcart', ['id_cart'=>$cart->id]) }}" class="w-100 col-lg-1 px-lg-0">
                                <button type="button" class="btn btn-danger d-flex align-items-center"
                                            data-dismiss="modal">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                              </svg>
                                              Xóa
                                            </button>
                            </a>

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
                                <a href="{{ route('boxInfo', ['id'=> $cart->id_box]) }}" class="text-decoration-none">
                                    <p class="mb-0 font-weight-bold text-white-space text-dark">{{ $cart->title }}</p>
                                </a>
                                <p class="mb-0">Đơn giá: {{ number_format($cart->price) }} VNĐ</p>
                                <div class="col-md-6 col-sm-7 col-10 input-group py-2 px-0">
                                    <a href="{{ route('cartUpdateAmount', ['id_cart'=>$cart->id, 'type'=>1]) }}" class="input-group-btn">
                                        <button type="button" class=" btn btn-danger btn-number"
                                            data-type="minus" data-field="">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">
                                                <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z" />
                                            </svg>
                                        </button>
                                    </a>
                                    <input type="hidden" id="quantityOLD{{$cart->id}}" value="{{ $cart->amount }}">
                                    <input type="number" id="quantity{{$cart->id}}" name="quantity" disabled
                                        class="form-control input-number text-center" value="{{ $cart->amount }}"
                                        min="1" max="{{\App\Helpers\ConstCommon::getAmountBoxItem($cart->id_box_item) < 100 ? \App\Helpers\ConstCommon::getAmountBoxItem($cart->id_box_item): 100}}" />
                                    <a href="{{ route('cartUpdateAmount', ['id_cart'=>$cart->id, 'type'=>2]) }}" class="input-group-btn">
                                        <button type="button" class="btn btn-success btn-number"
                                            data-type="plus" data-field="">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                                <path
                                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                            </svg>
                                        </button>
                                    </a>
                                </div>
                                <p class="mb-0">Tổng tiền: <span
                                        class="text-danger">{{ number_format($cart->amount * $cart->price) }} VNĐ</span>
                                </p>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('stopcart', ['id_cart'=>$cart->id]) }}" class="px-lg-0">
                                        <div class="btn btn-danger d-flex align-items-center"
                                                    data-dismiss="modal">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                                      </svg>
                                                      Xóa
                                                    </div>
                                    </a>
                                    <a href="{{ route('checkout', ['id_cart' => $cart->id]) }}" class="px-lg-0">
                                        <button class="btn bg-orange text-white">Thanh toán</button>
                                    </a>
                                </div>

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
<script>
    function validateInput(id) {
            var input = document.getElementById("quantity"+id).value;
            var min = parseInt(document.getElementById("quantity"+id).getAttribute("min"));
            var max = parseInt(document.getElementById("quantity"+id).getAttribute("max"));

            if (input < min || input > max) {
                alert("Bạn đã nhập một số quá lớn. Vui lòng nhập lại.");
                $('#quantity'+id).val($('#quantityOLD'+id).val());
            } else {
                let amount = $('#quantity'+id).val();
                $.ajax({
                    url: "{{ route('updateCartAmount') }}",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id_cart: id,
                        amount: amount,
                    },
                    success: function(response) {

                        toastr.options = {
                            "closeButton": true,
                            "progressBar": true
                        }
                        toastr.success("Cập nhật số lượng Thành công");

                        // Xử lý kết quả trả về từ server (nếu cần)
                        // Load lại trang hoặc cập nhật các phần tử trên trang
                        window.location.reload(); // Ví dụ: Load lại trang
                    },
                    error: function(xhr, status, error) {
                        // Xử lý lỗi (nếu có)
                        toastr.options = {
                            "closeButton": true,
                            "progressBar": true
                        }
                        toastr.error("Cập nhật số lượng Thất bại");
                    }
                });
            }
        }
</script>
@endsection
