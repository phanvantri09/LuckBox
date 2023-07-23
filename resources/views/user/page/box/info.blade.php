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
            <div class="row mx-1 py-2 bg-white align-items-center">
                <div class="col-sm-6 d-flex flex-column align-items-center justify-content-center">
                    <a href="" class="d-flex flex-column align-items-center w-100 text-decoration-none">
                        <img src="https://vn-live-01.slatic.net/p/dbf45cda7d56f7641227a80a5957efdf.jpg" width="40%"
                            height="auto" />
                        {{-- <h4 class="mt-1 text-dark">Event.....</h4> --}}
                    </a>
                    <div id="countdown" class="bg-danger text-white px-1"></div>
                    <div class="input-group py-2 w-50">
                        <span class="input-group-btn">
                            <button type="button" class="quantity-left-minus btn btn-warning btn-number" data-type="minus"
                                data-field="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-dash" viewBox="0 0 16 16">
                                    <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z" />
                                </svg>
                            </button>
                        </span>
                        <input type="number" id="quantity" name="quantity" class="form-control input-number text-center"
                            value="{{number_format($data->amount) }}" min="2" max="100" />
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
                    <div class="py-2">
                        <h4 class="mb-0 text-danger">{{number_format($data->price) }}đ</h4>
                    </div>
                    <a href="cart.html" class="text-decoration-none">
                        <button type="button" class="btn bg-orange font-weight-bold text-white btn-block btn-lg">
                            Mua ngay
                        </button>
                    </a>
                </div>
                <div class="col-sm-5 border border-right-0 font-weight-bold m-2">
                    <h3 class="text-danger text-center">LƯU Ý</h3>
                    <div class="text-right font-weight-normal">Tổng bán: 50.000</div>
                    <div class="rank-bar">
                        <div class="rank-progress" style="width: 70%;"></div>
                    </div>
                    <div class="text-left font-weight-normal">Còn lại: 1.000</div>
                    <p>- Mở bán vào khung giờ 12h00 và 22h00 hằng ngày</p>
                    <p>- Số lượng: 50.000 hộp/phiên bản</p>
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
            <div class="mx-1 py-2 bg-danger-orange text-white text-center">
                <h4>PHẦN THƯỞNG</h4>
                <span>Gồm có 10 phần thưởng ngẫu nhiên khi mở box</span>
            </div>
            <div class="row py-2">
                <!-- gift -->
                @foreach ($product->boxProducts as $key => $item)
                <div class="col-md-6 col-6 py-2">
                    <div class="mx-1 d-md-flex bg-white product-card rounded">
                        <div class="col-md-6 pb-3 px-md-0 px-1 text-center">
                            <p class="font-weight-bold">
                                {{$item->product->title}}
                            </p>
                            <span class="price bg-danger text-white font-weight-bold px-1 py-2 rounded-circle">Giá:
                                {{number_format($item->product->price) }}đ</span>
                        </div>
                        <div class="col-md-6 px-0">
                            <img class="rounded-right"
                                src="{{\App\Helpers\ConstCommon::getLinkImageToStorage( isset($getAllByIDProductMain->getAllByIDProductMain($item->product->id)['link_image']) ? $getAllByIDProductMain->getAllByIDProductMain($item->product->id)['link_image'] : null)}}" />
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- end gift -->
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
