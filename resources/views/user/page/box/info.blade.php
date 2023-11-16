@extends('user.layout.index')
@section('css')
@endsection
@section('content')
    <div class="bg-white text-orange title-page">
        <div class="container">
            <p>LuckyBox | Thông tin box</p>
        </div>
    </div>
    <div class="content-container">
        <div class="container-lg bg-warning py-2 my-2">
            <div class="px-2 py-3">
                <div class="row bg-white align-items-center py-2">
                    <div class="col-sm-6 d-flex flex-column align-items-center justify-content-center">
                        <a href="" class="d-flex flex-column align-items-center w-100 text-decoration-none">
                            <img src="{{ \App\Helpers\ConstCommon::getLinkImageToStorage($data->link_image) }}"
                                width="40%" height="auto" />
                            {{-- <h4 class="mt-1 text-dark">Event.....</h4> --}}
                        </a>

                        <div class="pt-2">
                            <h4 class="mb-0 text-danger">{{ number_format($data->price) }}VNĐ</h4>
                        </div>

                    </div>
                    <div class="col-sm-5 border border-right-0 font-weight-bold m-2">
                        <h3 class="text-danger text-center">LƯU Ý</h3>

                        <p>- Mở bán vào khung giờ 12:00 hằng ngày</p>
                        <p>- Số lượng: 15.000 hộp/phiên bán</p>
                        <p>
                            - Với tiêu chí người đến trước bán trước đến khi hết hộp sẽ đóng
                            phiên
                        </p>
                        <p>- Mỗi khách hàng chỉ được mua tối đa 100 hộp/phiên bản</p>
                        <p>
                            - Quý khách có thể mở thưởng hoặc bán lại trên Maket ngay sau khi
                            mua hộp
                        </p>
                    </div>
                </div>
            </div>
            <div class="row py-2 bg-danger-orange text-white d-flex flex-column align-items-center">
                <h4>PHẦN THƯỞNG</h4>
                <span>Gồm có 10 phần thưởng ngẫu nhiên khi mở box</span>
            </div>
            <div class="row justify-content-center py-2">
                <!-- gift -->
                @foreach ($product->boxProducts as $key => $item)
                    <div class="col-lg-3 col-md-4 col-sm-6 col-6 py-2 px-md-1 px-0">
                        <a href="{{ route('productDetails', ['id' => $item->product->id]) }}" class="text-decoration-none text-dark">
                            <div class="mx-1 p-2 bg-white product-card rounded">
                                <img class="rounded-right"
                                    src="{{ \App\Helpers\ConstCommon::getLinkImageToStorage(isset($getAllByIDProductMain->getAllByIDProductMain($item->product->id)['link_image']) ? $getAllByIDProductMain->getAllByIDProductMain($item->product->id)['link_image'] : null) }}" />
                                <div class="p-2">
                                    <p class="mb-0 product-card-title">
                                        {{ $item->product->title }}
                                    </p>
                                    <p class="text-danger font-weight-bold mb-0">
                                        {{ number_format($item->product->price) }}đ</p>
                                    <div>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                    </div>
                                </div>
                                <div class="product-card-detail px-2 py-1 rounded-bottom">Xem thêm</div>
                            </div>
                        </a>
                    </div>
                @endforeach
                <!-- end gift -->
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="./js/countdown.js"></script>
    <script src="./js/quantity.js"></script>
@endsection
