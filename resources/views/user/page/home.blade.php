@extends('user.layout.index')
@section('css')
@endsection
@section('content')
    <div class="content-container">
        <!-- SlideShow -->
        <div id="demo" class="carousel slide container-lg px-0 my-3" data-ride="carousel">
            <!-- Indicators -->
            @if (empty($imageSlide))
            <marquee><h1>Hiện tại chưa có sự kiện nào mở</h1></marquee>
            @else
            <ul class="carousel-indicators">
                
                @foreach ($imageSlide as $key => $slide)
                    <li data-target="#demo" data-slide-to="{{$key}}" class="{{$key == 0 ? "active" : ''}}"></li>
                @endforeach
            </ul>
            <!-- The slideshow -->
            <div class="carousel-inner carousel-inner-img">
                @foreach ($imageSlide as $key => $slide)
                    <div class="carousel-item {{ $key == 0 ? "active" : '' }}">
                        <img src="{{\App\Helpers\ConstCommon::getLinkImageToStorage($slide) }}" />
                    </div>
                @endforeach
            </div>

            <!-- Left and right controls -->
            <a class="carousel-control-prev" href="#demo" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#demo" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
            @endif
            
        </div>
        <!-- End SlideShow -->
        <div class="container-lg bg-warning py-2">
            <div class="row mx-1 py-2 bg-white align-items-center">
                {{-- <div class="col-12"> <h3 class="text-danger text-center">{{$datas[0]->title}}</h3></div> --}}
                <div class="col-md-7 py-2">
                    <div class="row">
                        <form action="{{ route('addToCart') }}" method="post" enctype="multipart/form-data"
                            class="col-sm-6 d-flex flex-column align-items-center justify-content-center">
                            @csrf
                            <a href="thongtinbox.html"
                                class="d-flex flex-column align-items-center w-100 text-decoration-none">
                                <img src="https://vn-live-01.slatic.net/p/dbf45cda7d56f7641227a80a5957efdf.jpg"
                                    width="60%" height="auto" />
                                <h4 class="mt-1 text-danger">{{ $event->title }}</h4>
                            </a>
                            <div id="countdown" class="bg-danger text-white px-1"></div>
                            <div class="input-group py-2">
                                <span class="input-group-btn">
                                    <button type="button" class="quantity-left-minus btn btn-warning btn-number"
                                        data-type="minus" data-field="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">
                                            <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z" />
                                        </svg>
                                    </button>
                                </span>

                                <input type="hidden" name="id_box_event" value="{{ $event->id ?? null }}">
                                <input type="hidden" name="id_box_item" value="{{ $cacheBoxItem->id ?? null }}">
                                <input type="hidden" name="id_box" value="{{ $cachebox->id ?? null }}">

                                <input type="number" id="quantity" name="amount"
                                    class="form-control input-number text-center" value="1" min="1"
                                    max="100" title="Phải là số nguyên và mọi người chỉ được mua nhiều nhất 100 họp."
                                    required />
                                <span class="input-group-btn">
                                    <button type="button" class="quantity-right-plus btn btn-warning btn-number"
                                        data-type="plus" data-field="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                            <path
                                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                        </svg>
                                    </button>
                                </span>
                            </div>
                            <div class="py-2">
                                <h4 class="mb-0 text-danger">
                                    {{ isset($cachebox->price) ? number_format($cachebox->price) : null }} VNĐ</h4>
                            </div>
                            @if (!empty($timeEventNotInCase))
                                <div class="text-decoration-none">
                                    <div type="submit" class="btn bg-orange font-weight-bold text-white btn-block btn-lg"
                                        disabled>
                                        Sắp mở bán
                                    </div>
                                </div>
                            @elseIf($timeEventNotInCase == 1000)
                                <div class="text-decoration-none">
                                    <div 
                                        class="btn bg-orange font-weight-bold text-white btn-block btn-lg ">
                                        Chưa có sự kiện
                                    </div>
                                </div>
                            @else 
                            <div class="text-decoration-none">
                                <button type="submit"
                                    class="btn bg-orange font-weight-bold text-white btn-block btn-lg ">
                                    Mua ngay
                                </button>
                            </div>
                            @endif

                        </form>
                        <div class="col-sm-5 border border-right-0 font-weight-bold m-2">
                            <h3 class="text-danger text-center">LƯU Ý</h3>
                            <div class="text-right font-weight-normal">Tổng bán:
                                {{ isset($cacheBoxItem->amount) ? number_format($cacheBoxItem->amount) : null }}</div>
                            <div class="rank-bar">
                                <div class="rank-progress" style="width: 70%;"></div>
                            </div>
                            <div class="text-left font-weight-normal">Còn lại: 130</div>
                            <p>- Mở bán vào khung giờ 12h00 và 22h00 hằng ngày</p>
                            <p>- Số lượng: 50.000 hộp/phiên bản</p>
                            <p>
                                - Với tiêu chí người đến trước bán trước đến khi hết hộp sẽ đóng
                                phiên
                            </p>
                            <p>- Mỗi khách hàng chỉ được mua tối đa 100 hộp/phiên bản</p>
                            <p>
                                - Quý khách có thể mở thưởng hoặc bán lại trên Maket ngay sau
                                khi mua hộp
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 px-0 content-home">
                    <img src="https://hinhanhdep.net/wp-content/uploads/2017/06/anh-hoa-hong-dep-18.jpg" alt="" />
                </div>
            </div>
            <div class="mx-1 py-2 bg-danger-orange text-white text-center">
                <h4>PHẦN THƯỞNG</h4>
                <span>Gồm có 10 phần thưởng ngẫu nhiên khi mở box</span>
            </div>
            <div class="row py-2">
                <!-- gift -->
                @if (empty($products))
                <marquee><h1>Hiện tại chưa có sự kiện mở bán sản phẩm nào</h1></marquee>
                @else
                @foreach ($products as $product)
                <div class="col-md-6 col-6 py-2">
                    <a href="#" class="mx-1 d-md-flex bg-white product-card rounded">
                        <div class="col-md-6 pb-3 px-md-0 px-1 text-center">
                            <p class="font-weight-bold">
                                {{$product->title}}
                            </p>
                            <span class="price bg-danger text-white font-weight-bold px-1 py-2 rounded-circle">Giá:
                                {{ number_format($product->price)}}</span>
                        </div>
                        <div class="col-md-6 px-0">
                            <img class="rounded-right"
                                src="{{\App\Helpers\ConstCommon::getLinkImageToStorage($product->link_image) }}" />
                        </div>
                    </a>
                </div>
                @endforeach
                @endif
                

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            var time = '';

            @if ($timeEventInCase)
                time = '{{ $timeEventInCase }}';
            @endif

            @if ($timeEventNotInCase)
                time = '{{ $timeEventNotInCase }}';
            @endif
            console.log(time);
            // var time = "{{ $time }}";
            // Set the date we're counting down to
            var countDownDate = new Date(time).getTime();

            var timenow = new Date().getTime();

            // Find the distance between now and the count down date
            var distanceTime = countDownDate - timenow;
            if (distanceTime < 0) {
                document.getElementById("countdown").innerHTML = "00:00";
            } else {
                // Update the count down every 1 second
                var x = setInterval(function() {

                    // Get today's date and time
                    var now = new Date().getTime();

                    // Find the distance between now and the count down date
                    var distance = countDownDate - now;

                    // Time calculations for days, hours, minutes and seconds
                    // var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    // Output the result in an element with id="demo"
                    document.getElementById("countdown").innerHTML = hours + ": " +
                        minutes + ": " + seconds;

                    // If the count down is over, write some text
                    if (distance < 0) {
                        clearInterval(x);
                        // location.reload();
                        document.getElementById("countdown").innerHTML = "Đã mở bán vui lòng khởi động lại trang web";
                    }
                }, 1000);
            }
        });
    </script>
@endsection
