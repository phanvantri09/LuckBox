@extends('user.layout.index')
@section('css')
@endsection
@section('content')
    <div class="bg-white text-orange title-page">
        <div class="container">
            <p>LuckyBox | Chợ</p>
        </div>
    </div>
    <div class="content-container py-4">
        <div class="container my-lg-2 my-0">
            <!-- desktop -->
            <div class="d-lg-block d-none">
                @foreach ($dataCarts as $dataCart)
                <div class="row align-items-center bg-orange-white py-2 rounded mb-2 px-2">
                    <div class="col-lg-2 px-1">
                        <img src="{{ \App\Helpers\ConstCommon::getLinkImageToStorage($dataCart->link_image) }}" width="100%"
                            height="auto" />
                    </div>
                    <div class="col-lg-3">
                        <a href="thongtinbox.html" class="text-decoration-none">
                            <h4 class="text-dark">{{$dataCart->title}}</h4>
                        </a>
                    </div>
                    <div class="col-lg-5">
                        <h5>Đơn giá: <span class="font-weight-bold text-danger">{{number_format(\App\Helpers\ConstCommon::priceUp(count(explode(",", $dataCart->id_user_folow)), $dataCart->price))}} VNĐ</span></h5>
                    </div>
                    <a href="{{ route('addToCartOld', ['id_cart_old'=>$dataCart->id]) }}" class="w-100 col-lg-2 px-lg-0">
                        <button class="btn bg-orange text-white">Mua ngay</button>
                    </a>
                </div>
                @endforeach
            </div>
            <!-- end desltop -->
            <!-- mobile -->
            <div class="d-lg-none">
                <div class="row bg-orange-white py-2 rounded mb-2 px-2">
                    <div class="col-md-3 col-sm-3 col-4 px-1">
                        <img src="https://img4.thuthuatphanmem.vn/uploads/2020/05/14/hinh-anh-hoa-hong-leo-dep_021528729.jpg"
                            width="100%" height="auto" />
                    </div>
                    <div class="col-md-9 col-sm-9 col-8">
                        <a href="thongtinbox.html" class="text-decoration-none">
                            <p class="mb-0 font-weight-bold text-white-space text-dark">Title Title Title Title Title Title
                                Title Title Title Title</p>
                        </a>
                        <p class="mb-0">Đơn giá: <span class="text-danger">4.000.000 VNĐ</span></p>
                        <a href="checkout.html" class="w-100 px-lg-0">
                            <button class="btn bg-orange text-white">Mua ngay</button>
                        </a>
                    </div>
                </div>
                <div class="row bg-orange-white py-2 rounded mb-2 px-2">
                    <div class="col-md-3 col-sm-3 col-4 px-1">
                        <img src="https://img4.thuthuatphanmem.vn/uploads/2020/05/14/hinh-anh-hoa-hong-leo-dep_021528729.jpg"
                            width="100%" height="auto" />
                    </div>
                    <div class="col-md-9 col-sm-9 col-8">
                        <a href="thongtinbox.html" class="text-decoration-none">
                            <p class="mb-0 font-weight-bold text-white-space text-dark">Title Title Title Title Title Title
                                Title Title Title Title</p>
                        </a>
                        <p class="mb-0">Đơn giá: <span class="text-danger">4.000.000 VNĐ</span></p>
                        <a href="checkout.html" class="w-100 px-lg-0">
                            <button class="btn bg-orange text-white">Mua ngay</button>
                        </a>
                    </div>
                </div>
                <div class="row bg-orange-white py-2 rounded mb-2 px-2">
                    <div class="col-md-3 col-sm-3 col-4 px-1">
                        <img src="https://img4.thuthuatphanmem.vn/uploads/2020/05/14/hinh-anh-hoa-hong-leo-dep_021528729.jpg"
                            width="100%" height="auto" />
                    </div>
                    <div class="col-md-9 col-sm-9 col-8">
                        <a href="thongtinbox.html" class="text-decoration-none">
                            <p class="mb-0 font-weight-bold text-white-space text-dark">Title Title Title Title Title Title
                                Title Title Title Title</p>
                        </a>
                        <p class="mb-0">Đơn giá: <span class="text-danger">4.000.000 VNĐ</span></p>
                        <a href="checkout.html" class="w-100 px-lg-0">
                            <button class="btn bg-orange text-white">Mua ngay</button>
                        </a>
                    </div>
                </div>
                <div class="row bg-orange-white py-2 rounded mb-2 px-2">
                    <div class="col-md-3 col-sm-3 col-4 px-1">
                        <img src="https://img4.thuthuatphanmem.vn/uploads/2020/05/14/hinh-anh-hoa-hong-leo-dep_021528729.jpg"
                            width="100%" height="auto" />
                    </div>
                    <div class="col-md-9 col-sm-9 col-8">
                        <a href="thongtinbox.html" class="text-decoration-none">
                            <p class="mb-0 font-weight-bold text-white-space text-dark">Title Title Title Title Title Title
                                Title Title Title Title</p>
                        </a>
                        <p class="mb-0">Đơn giá: <span class="text-danger">4.000.000 VNĐ</span></p>
                        <a href="checkout.html" class="w-100 px-lg-0">
                            <button class="btn bg-orange text-white">Mua ngay</button>
                        </a>
                    </div>
                </div>
                <div class="row bg-orange-white py-2 rounded mb-2 px-2">
                    <div class="col-md-3 col-sm-3 col-4 px-1">
                        <img src="https://img4.thuthuatphanmem.vn/uploads/2020/05/14/hinh-anh-hoa-hong-leo-dep_021528729.jpg"
                            width="100%" height="auto" />
                    </div>
                    <div class="col-md-9 col-sm-9 col-8">
                        <a href="thongtinbox.html" class="text-decoration-none">
                            <p class="mb-0 font-weight-bold text-white-space text-dark">Title Title Title Title Title Title
                                Title Title Title Title</p>
                        </a>
                        <p class="mb-0">Đơn giá: <span class="text-danger">4.000.000 VNĐ</span></p>
                        <a href="checkout.html" class="w-100 px-lg-0">
                            <button class="btn bg-orange text-white">Mua ngay</button>
                        </a>
                    </div>
                </div>
            </div>
            <!-- end mobile -->
        </div>
    </div>
@endsection
@section('scripts')
@endsection
