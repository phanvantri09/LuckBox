@extends('user.layout.index')
@section('css')
    <link rel="stylesheet" href="./css/openboxnew.css">
@endsection
@section('content')
    <div class="bg-white text-orange title-page">
        <div class="container">
            <p>LuckyBox | Mở Box</p>
        </div>
    </div>
    <div class="container bg-warning d-flex flex-column justify-content-center">
        <div class="giftcontainer-content d-flex flex-column justify-content-between align-items-center">
            <h4 class="text-center">Sau khi ấn vào nắp hộp, bạn sẽ nhận được 1 trong 10 sản phẩm phía trên</h4>
            <div class="giftcontainer">
                <div class="gift">
                    <input type="checkbox" id="click">
                    <label id="openBox" for="click" class="click"></label>
                    <a id="showOrder" href="{{ route('listOrder') }}" target="_blank" class="giftopen p-2">
                        <div class="opacity-75 d-flex flex-column align-items-center">
                            <img src="{{\App\Helpers\ConstCommon::getLinkImageToStorage($productChoeseImage->link_image)}}"
                                class="rounded-bottom">
                            <p class="mb-0 product-card-title text-danger font-weight-bold text-center">{{ $productChoese->title }}</p>

                            <div>
                                <span class="fa fa-star checked "></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                            </div>

                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="giftboxs" aria-hidden="true">
            <div class="giftbox">🎁</div>
            <div class="giftbox">🎈</div>
            <div class="giftbox">🎁</div>
            <div class="giftbox">🎉</div>
            <div class="giftbox">🎁</div>
            <div class="giftbox">🎈</div>
            <div class="giftbox">🎁</div>
            <div class="giftbox">🎈</div>
            <div class="giftbox">🎉</div>
            <div class="giftbox">🎁</div>
            <div class="giftbox">🎈</div>
            <div class="giftbox">🎉</div>
        </div>
        <div class="row justify-content-center p-2">
            @foreach ($allProduct as $product)
                <div class="product-card-width py-2">
                    <div class="product-card-box p-2">
                        <div class="bg-white rounded p-2">
                            <div class="opacity-75">
                                <img src="{{\App\Helpers\ConstCommon::getLinkImageToStorage($product->link_image)}}"
                                    class="mt-3 rounded-bottom">
                                <p class="mb-0 product-card-title">{{ $product->title }}</p>
                                <p class="text-danger font-weight-bold mb-0">
                                    {{ number_format($product->price) }} VNĐ</p>
                                <div>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        
    </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('#openBox').click(function(event) {
            var id_cart = '{{ $cart->id }}';
            $.ajax({
                method: 'POST',
                url: '{{ route('openBoxPost', ['id_cart' => $cart->id, 'id_product' => $productChoese->id]) }}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $("#showOrder").attr("href", response.routeShowOrder);
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true
                    }
                    toastr.success("chúc mừng bạn mở box thành công!");
                    // setTimeout(function() {
                    //     window.location.href =
                    //     '{{ route('listOrder') }}'; // Thay đổi URL của trang tới đích mong muốn
                    // }, 5000);
                },
                error: function(response) {
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true
                    }
                    toastr.warning("Mở box không thành công");
                }
            });
        });
    </script>
@endsection
