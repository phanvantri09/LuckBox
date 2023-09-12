@extends('user.layout.index')
@section('css')
    <link rel="stylesheet" href="./css/openboxnew.css">
    <style>
        .showBox {}

        .hideBox {
            display: none !important;
        }
    </style>
@endsection
@section('content')
    <div class="bg-white text-orange title-page">
        <div class="container">
            <p>LuckyBox | Mở Box</p>
        </div>
    </div>
    <div class="content-container">
        <div class="container d-flex flex-column justify-content-center py-2">

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

            <div class="py-2">
                <div class="giftcontainer-content d-flex flex-column justify-content-between align-items-center"
                    id="boxStart">
                    <h4 class="text-center">Sau khi nhấn mở hộp, bạn sẽ nhận được 1 trong 10 sản phẩm phía dưới</h4>
                    <div class="giftcontainer">
                        <div class="gift">
                            <input type="checkbox" id="click">
                            <label id="openBox" for="click" class="click"></label>
                            {{-- <a id="showOrder" href="#" target="_blank" class="giftopen p-2">
                                <div class="opacity-75 d-flex flex-column align-items-center">
                                    <img src="{{\App\Helpers\ConstCommon::getLinkImageToStorage($productChoeseImage->link_image)}}" class="rounded-bottom">
                                    <p class="mb-0 product-card-title text-danger font-weight-bold text-center"> {{ $productChoese->title }}</p>

                                    <div>
                                        <span class="fa fa-star checked "></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                    </div>

                                </div>
                            </a> --}}
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="button" class="btn btn-success" id="openbox" data-toggle="modal"
                        data-target="#exampleModal">
                        Mở hộp
                    </button>
                </div>
            </div>
            <div class="py-2">
                <div class="row justify-content-center hideBox" id="productOpen">
                    <h3 class="col-12 text-center">Chúc mừng bạn đã nhận được</h3>
                    <div class="bg-card-open">
                        <img class="bg-card-open-img" src="{{ asset('/dist/img/bg-sun.png') }}" alt="">
                        <a href="{{ route('productDetails', ['id'=>$productChoese->id]) }}" target="_blank" class="text-decoration-none text-dark product-card-gif">
                            <div class="mx-1 p-2 bg-white product-card-box rounded product-card-box-open">
                                <img class="rounded-right"
                                    src="{{ \App\Helpers\ConstCommon::getLinkImageToStorage($productChoeseImage->link_image) }}" />
                                <div class="p-2 text-center">
                                    <p class="mb-0 product-card-title">
                                        {{ $productChoese->title }}
                                    </p>
                                    <p class="text-danger font-weight-bold mb-0">
                                        {{ number_format($productChoese->price) }} VNĐ</p>
                                    <div>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="hideBox text-center py-3" id="contentOpenAgain">
                    @if ($cart->amount > 1)
                        <a type="button" href="{{ route('openBox', ['id_cart' => $cart->id]) }}"
                            class="btn btn-success text-white" data-target="#exampleModal">
                            Mở tiếp
                        </a>
                    @endif

                    <a href="#" target="_blank" id="showProductBox" class="btn bg-orange text-white">
                        Xem sản phẩm nhận được
                    </a>
                </div>
            </div>
            <div class="py-2">
                <h4 class="text-center">Danh sách sản phẩm</h4>
                <div class="row justify-content-center">
                    @foreach ($allProduct as $product)
                        <div class="product-card-width py-1">
                            <div class="product-card-box px-md-2 px-1">
                                <div class="bg-white rounded p-2">
                                    <div class="opacity-75">
                                        <a href="{{ route('productDetails', ['id'=>$product->id]) }}" target="_blank" class="text-decoration-none text-dark">
                                            <img src="{{ \App\Helpers\ConstCommon::getLinkImageToStorage($product->link_image) }}"
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
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>


            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Bạn có muốn mở hộp ?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                            <button type="button" class="btn btn-primary" id="acceptOpenBox" data-dismiss="modal">Xác
                                nhận
                                mở</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    {{-- <script>
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
    </script> --}}
    <script>
        $('#acceptOpenBox').click(function(event) {
            $('.modal').removeClass('show');
            $('#boxStart').addClass('hideBox');

            setTimeout(function() {


                var id_cart = '{{ $cart->id }}';
                $.ajax({
                    method: 'POST',
                    url: '{{ route('openBoxPost', ['id_cart' => $cart->id, 'id_product' => $productChoese->id]) }}',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // console.log(response.routeShowOrder);
                        $('#openbox').addClass('hideBox');
                        $('#productOpen').removeClass('hideBox');
                        $('#contentOpenAgain').removeClass('hideBox');

                        $("#showProductBox").attr("href", response.routeShowOrder);
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
                        toastr.warning("Mở box không thành công vui lòng thực hiện lại");
                        setTimeout(function() {
                            location.reload();
                        }, 3000);
                    }
                });

            }, 500);
        });
    </script>
@endsection
