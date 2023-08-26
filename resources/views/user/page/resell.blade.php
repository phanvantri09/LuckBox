@extends('user.layout.index')
@section('css')
@endsection
@section('content')
    <div class="bg-white text-orange title-page">
        <div class="container">
            <p>LuckyBox | Gửi bán box</p>
        </div>
    </div>
    <div class="content-container py-md-4 py-3">
        <div class="container my-lg-2 my-0 d-flex justify-content-center">
            <form action="{{ route('sendToMarketPost') }}" class="bg-white py-4 rounded mb-2 px-4 w-md-50" method="post">
                @csrf
                <div class="d-flex justify-content-center">
                    <img src="{{ \App\Helpers\ConstCommon::getLinkImageToStorage($dataCart->link_image) }}" width="40%"
                        height="auto" />
                </div>
                <div class="text-center">
                    <a href="{{ route('boxInfo', ['id' => $dataCart->id_box]) }}" class="text-decoration-none">
                        <h4 class="text-dark">{{ $dataCart->title }}</h4>
                    </a>
                </div>
                <div class="input-group py-2">
                    <span class="input-group-btn">
                        <button type="button" class="quantity-left-minus btn btn-warning btn-number" data-type="minus"
                            data-field="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-dash" viewBox="0 0 16 16">
                                <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z" />
                            </svg>
                        </button>
                    </span>
                    <input type="number" id="quantity" name="amount" class="form-control input-number text-center"
                    onblur="validateInput()"
                        value="1" min="1" max="{{ $dataCart->amount }}"
                        title="Phải là số nguyên và mọi người chỉ được mua nhiều nhất {{ $dataCart->amount }} Hộp."
                        required />
                    <input type="hidden" name="id_cart" value="{{ $dataCart->id ?? null }}">


                    <span class="input-group-btn">
                        <button type="button" class="quantity-right-plus btn btn-warning btn-number" data-type="plus"
                            data-field="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-plus" viewBox="0 0 16 16">
                                <path
                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                            </svg>
                        </button>
                    </span>
                </div>
                @php
                    // dd($dataCart);
                    $chenhlech = ($dataCart->price_cart * 6) / 100 + $dataCart->price_cart;
                @endphp
                <div class="d-flex justify-content-between w-100 bg-gray px-2 py-2 rounded">
                    <h5>Giá mua: <br><span class="text-danger">{{ number_format($dataCart->price_cart) }}VNĐ</span></h5>
                    <h5>Giá gửi bán: <br><span class="text-danger">{{ number_format($chenhlech) }} VNĐ</span></h5>
                </div>
                <div class="my-2">
                    Phí gửi bán: <span class="text-danger">Không mất phí</span>
                </div>
                <div class="w-100 px-lg-0 d-flex justify-content-center">
                    <button type="submit" class="btn bg-orange text-white p-2 font-weight-bold">Xác nhận gửi bán</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            var quantitiy = 0;
            $(".quantity-right-plus").click(function(e) {
                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var quantity = parseInt($("#quantity").val());

                // If is not undefined

                if (quantity < '{{ $dataCart->amount }}') {
                    $("#quantity").val(quantity + 1);
                } else {
                    alert("Vượt quá số lượng hiện có");
                }

                // Increment
            });

            $(".quantity-left-minus").click(function(e) {
                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var quantity = parseInt($("#quantity").val());

                // If is not undefined

                // Increment
                if (quantity > 1) {
                    $("#quantity").val(quantity - 1);
                }
            });
        });

        function validateInput() {
            var input = document.getElementById("quantity").value;
            var min = parseInt(document.getElementById("quantity").getAttribute("min"));
            var max = parseInt(document.getElementById("quantity").getAttribute("max"));

            if (input < min || input > max) {
                alert("Bạn đã nhập một số quá lớn. Vui lòng nhập lại.");
                $('#quantity').val(1);
            }
        }
    </script>
@endsection
