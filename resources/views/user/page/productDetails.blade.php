@extends('user.layout.index')
@section('css')
@endsection
@section('content')
    <div class="bg-white text-orange title-page">
        <div class="container">
            <p>LuckyBox | Chi tiết sản phẩm</p>
        </div>
    </div>
    <div class="content-container py-md-4 py-2">
        <div class="container my-lg-2 my-0 bg-white py-4">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div id="demo-slide" class="carousel">
                        <!-- The slideshow -->
                        <div class="carousel-inner">
                            @if($getAllByIDProductMain)
                            <div class="carousel-item carousel-item-details active">
                                <img src="{{\App\Helpers\ConstCommon::getLinkImageToStorage( $getAllByIDProductMain['link_image'] ?? null)}}">
                            </div>
                            @endif
                            @if($getAllByIDProductSlide)
                            <div class="carousel-item carousel-item-details">
                                <img src="{{\App\Helpers\ConstCommon::getLinkImageToStorage( $getAllByIDProductSlide['link_image'] ?? null)}}">
                            </div>
                            @endif
                            @foreach ($getAllByIDProductItem as $key => $item)
                                <div class="carousel-item carousel-item-details">
                                    <img src="{{\App\Helpers\ConstCommon::getLinkImageToStorage( $item->link_image ?? null)}}">
                                </div>
                            @endforeach
                        </div>

                        <!-- Left and right controls -->
                        <a class="carousel-control-prev" href="#demo-slide" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </a>
                        <a class="carousel-control-next" href="#demo-slide" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <h4>{{old('title', $data->title)}}</h4>
                    <h5 class="text-danger">{{number_format($data->price) }} VNĐ</h5>
                    <div>
                        <h6>Mô tả:</h6>
                        <div>
                            {!! old('description', $data->description) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
    @section('scripts')
    @endsection
