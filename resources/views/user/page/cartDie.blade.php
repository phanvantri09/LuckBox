@extends('user.layout.index')
@section('css')
@endsection
@section('content')
    <div class="bg-white text-orange title-page">
        <div class="container">
            <p>LuckyBox | Giỏ hàng hết hạn hoặc bị từ chối</p>
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
                                <img src="{{ !empty($cart->link_image) ? \App\Helpers\ConstCommon::getLinkImageToStorage($cart->link_image) : asset('/dist/img/imageBox.jpg') }}"
                                    width="100%" height="auto" />
                            </div>
                            <div class="col-lg-2">
                                <a href="{{ route('boxInfo', ['id' => $cart->id_box]) }}" class="text-decoration-none">
                                    <h4 class="text-dark">{{ $cart->title }}</h4>
                                </a>
                            </div>
                            <div class="col-lg-2">
                                <h5>Đơn giá: <br>{{ number_format($cart->price_cart) }} VNĐ</h5>
                            </div>
                            <div class="col-lg-2 input-group py-2">
                                <h5>Số lượng: {{ $cart->amount }} </h5>
                            </div>
                            <div class="col-lg-2">
                                <h5>Tổng tiền: <br><span
                                        class="font-weight-bold text-danger">{{ number_format($cart->amount * $cart->price_cart) }}
                                        VNĐ</span></h5>
                            </div>
                            <div class="col-lg-2">
                                <h5>Thời gian:<br> <span class="font-weight-bold text-danger">
                                        {{ date('H:i:s d-m-Y', strtotime($cart->updated_at)) }}</span></h5>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- end desltop -->
                <!-- mobile -->
                <div class="d-lg-none">
                    @foreach ($dataCart as $cart)
                        <div class="row bg-orange-white py-2 rounded mb-2 px-2">
                            <div class="col-md-3 col-sm-3 col-4 px-1">
                                <img src="{{ !empty($cart->link_image) ? \App\Helpers\ConstCommon::getLinkImageToStorage($cart->link_image) : asset('/dist/img/imageBox.jpg') }}"
                                    width="100%" height="auto" />
                            </div>
                            <div class="col-md-9 col-sm-9 col-8">
                                <a href="{{ route('boxInfo', ['id' => $cart->id_box]) }}" class="text-decoration-none">
                                    <p class="mb-0 font-weight-bold text-white-space text-dark">{{ $cart->title }}</p>
                                </a>
                                <p class="mb-0">Đơn giá: {{ number_format($cart->price) }} VNĐ</p>
                                <div class="col-md-6 col-sm-7 col-10 input-group py-2 px-0">
                                    Số lượng: {{$cart->amount}}
                                </div>
                                <p class="mb-0">Tổng tiền: <span
                                        class="text-danger">{{ number_format($cart->amount * $cart->price) }} VNĐ</span>
                                </p>
                                <p class="mb-0"><span>{{ date('H:i:s d-m-Y', strtotime($cart->updated_at)) }}</span>
                              </p>
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
            var input = document.getElementById("quantity" + id).value;
            var min = parseInt(document.getElementById("quantity" + id).getAttribute("min"));
            var max = parseInt(document.getElementById("quantity" + id).getAttribute("max"));

            if (input < min || input > max) {
                alert("Bạn đã nhập một số quá lớn. Vui lòng nhập lại.");
                $('#quantity' + id).val($('#quantityOLD' + id).val());
            } else {
                let amount = $('#quantity' + id).val();
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
