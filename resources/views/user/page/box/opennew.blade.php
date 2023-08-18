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
    <div class="container bg-warning d-flex flex-column justify-content-center">
        {{-- <div class="giftcontainer-content d-flex flex-column justify-content-between align-items-center">
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

        </div> --}}
        <div class="giftcontainer-content d-flex flex-column justify-content-between align-items-center" id="boxStart">
            <h4 class="text-center">Sau khi ấn vào nắp hộp, bạn sẽ nhận được 1 trong 10 sản phẩm phía trên</h4>
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
        <div class="row justify-content-center hideBox" id="productOpen">
            <div class="col-lg-3 col-md-4 col-sm-6 col-9 py-5 px-2">
                <a href="#" class="text-decoration-none text-dark">
                    <div class="mx-1 p-2 bg-white product-card rounded">
                        <img class="rounded-right" src="{{\App\Helpers\ConstCommon::getLinkImageToStorage($productChoeseImage->link_image)}}" />
                        <div class="p-2">
                            <p class="mb-0 product-card-title">
                                {{ $productChoese->title }}
                            </p>
                            <p class="text-danger font-weight-bold mb-0">
                                {{ $cart->price_cart }} VNĐ</p>
                            <div>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                            </div>
                        </div>
                        <div class="product-card-detail px-2 py-1 rounded-bottom">Xem thêm</div>
                    </div>
                </a>
            </div>
        </div>

        <button type="button" class="btn btn-primary" id="openbox" data-toggle="modal" data-target="#exampleModal">
            Mở hộp
        </button>
        <div class="hideBox" id="contentOpenAgain">
            @if ($cart->amount > 1)
                <a type="button" href="{{ route('openBox', ['id_cart'=>$cart->id]) }}" class="btn btn-primary"
                    data-target="#exampleModal">
                    Mở tiếp
                </a>
            @endif
            
            <a href="#" target="_blank" id="showProductBox" class="btn btn-primary" >
                Xem sản phẩm nhận được
            </a>
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
                        <button type="button" class="btn btn-primary" id="acceptOpenBox" data-dismiss="modal">Xác nhận
                            mở</button>
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
        $('#acceptOpenBox, #openBox').click(function(event) {
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
