@extends('user.layout.index')
@section('css')
@endsection
@section('content')
    <div class="content-container">
        <!-- SlideShow -->
        <div id="demo" class="carousel slide container-lg px-0 my-3" data-ride="carousel">
            <!-- Indicators -->
            {{-- @if (empty($imageSlide))
            <marquee><h1>Hiện tại chưa có sự kiện nào mở</h1></marquee>
            @else --}}
            @if (!empty($imageSlide))
                <ul class="carousel-indicators">
                    @foreach ($imageSlide as $key => $slide)
                        <li data-target="#demo" data-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}">
                        </li>
                    @endforeach
                </ul>
                <!-- The slideshow -->
                <div class="carousel-inner carousel-inner-img">
                    @foreach ($imageSlide as $key => $slide)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <img src="{{ \App\Helpers\ConstCommon::getLinkImageToStorage($slide) }}" />
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

            {{-- @endif --}}

        </div>
        <!-- End SlideShow -->
        <div class="container-lg bg-warning py-2">
            <div class="px-2 py-3">
                <div class="row align-items-center bg-white">
                    {{-- <div class="col-12"> <h3 class="text-danger text-center">{{$datas[0]->title}}</h3></div> --}}
                    <div class="col-md-7 py-2">
                        <div class="row">
                            <form action="{{ route('addToCart') }}" method="post" enctype="multipart/form-data"
                                class="col-sm-6 d-flex flex-column align-items-center justify-content-center">
                                @csrf
                                @if (empty($cachebox))
                                    <a href="{{ route('home') }}"
                                        class="d-flex flex-column align-items-center w-100 text-decoration-none">
                                        <img src="/dist/img/imageBox.jpg" width="60%" height="auto" />
                                        <h4 class="mt-1 text-danger text-center">Sự kiện sẽ được cập nhật trong thời gian gần nhất</h4>
                                    </a>
                                @else
                                    <a href="{{ route('boxInfo', ['id' => $cachebox->id]) }}"
                                        class="d-flex flex-column align-items-center w-100 text-decoration-none">
                                        <img src="{{ \App\Helpers\ConstCommon::getLinkImageToStorage($cachebox->link_image) }}"
                                            width="60%" height="auto" />
                                        <h4 class="mt-1 text-danger text-center">{{ $cachebox->title ?? null }}</h4>
                                    </a>
                                @endif
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
                                    @if (empty($cacheBoxItem))
                                        <input type="number" id="quantity" name="amount"
                                        onblur="validateInput()"
                                            class="form-control input-number text-center" value="1" min="1"
                                            max="100"
                                            title="Phải là số nguyên và mọi người chỉ được mua nhiều nhất 100 Hộp." required />
                                    @else
                                        <input type="number" id="quantity" name="amount"
                                        onblur="validateInput()"
                                            class="form-control input-number text-center" value="1" min="1"
                                            max="{{\App\Helpers\ConstCommon::getAmountBoxItem($cacheBoxItem->id) < 100 ? \App\Helpers\ConstCommon::getAmountBoxItem($cacheBoxItem->id): 100}}"
                                            title="Phải là số nguyên và mọi người chỉ được mua nhiều nhất 100 Hộp." required />
                                    @endif
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
                                @if (!empty($cacheBoxItem))
                                    @if ($cacheBoxItem->amount <= 0)
                                        <div class="text-decoration-none">
                                            <div type="submit"
                                                class="btn bg-orange font-weight-bold text-white btn-block btn-lg" disabled>
                                                Hết hàng
                                            </div>
                                        </div>
                                    @else
                                        @if (!empty($timeEventNotInCase))
                                            <div class="text-decoration-none">
                                                <div type="submit"
                                                    class="btn bg-orange font-weight-bold text-white btn-block btn-lg"
                                                    disabled>
                                                    Sắp mở bán
                                                </div>
                                            </div>
                                        @elseIf($timeEventNotInCase == 1000)
                                            <div class="text-decoration-none">
                                                <div class="btn bg-orange font-weight-bold text-white btn-block btn-lg ">
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
                                    @endif
                                @endif



                            </form>
                            <div class="col-sm-5 border border-right-0 font-weight-bold m-2">
                                <h3 class="text-danger text-center">LƯU Ý</h3>
                                <div class="text-right font-weight-normal">Đã bán:
                                    {{ $countSale }}
                                </div>
                                <div class="rank-bar">
                                    @if (empty($cacheBoxItem))
                                        <div class="rank-progress" style="width:0%;"></div>
                                    @else
                                        @if ($cacheBoxItem->amount <= 0)
                                            <div class="rank-progress"
                                                style="width: 100%;">
                                            </div>
                                        @else
                                        <div class="rank-progress"
                                            style="width: {{ ($countSale != 0) ? (($countSale / ($cacheBoxItem->amount + $countSale)) * 100) : 0 }}%;">
                                        </div>
                                        @endif
                                        
                                    @endif

                                </div>
                                @if (empty($cacheBoxItem))
                                    <div class="text-left font-weight-normal">Còn lại: 0</div>
                                @else
                                    <div class="text-left font-weight-normal">Còn lại: {{ number_format($cacheBoxItem->amount) }}</div>
                                @endif
                                <p>- Mở bán vào khung giờ 12:00 hằng ngày</p>
                                {{-- <p>- Số lượng: 50.000 hộp/phiên bản</p> --}}
                                <p>
                                    - Với tiêu chí người đến trước bán trước đến khi hết hộp sẽ đóng
                                    phiên
                                </p>
                                <p>- Mỗi khách hàng chỉ được mua tối đa 100 hộp/phiên bán</p>
                                <p>
                                    - Quý khách có thể mở thưởng hoặc bán lại trên Maket ngay sau
                                    khi mua hộp
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 px-0 content-home d-flex justify-content-center align-content-center">
                        <img id="myImage" src="dist/img/flashsale.png" alt="" />
                        {{-- <h3 style="
                    font-weight: bold;
                    text-shadow: -1px 1px 0 #000,
                                1px 1px 0 #000,
                                1px -1px 0 #000,
                                -1px -1px 0 #000;"
                        class="text-block" id="time-event">Ngày - Giờ - Phút - Piây</h3> --}}
                    </div>
                </div>
            </div>
            <div class="row py-2 bg-danger-orange text-white d-flex flex-column align-items-center">
                <h4>PHẦN THƯỞNG</h4>
                <span>Gồm có 10 phần thưởng ngẫu nhiên khi mở box</span>
            </div>
            <div class="row justify-content-center py-2">
                <!-- gift -->
                @if (empty($products))
                    <marquee>
                        <h1>Hiện tại chưa có sự kiện mở bán sản phẩm nào</h1>
                    </marquee>
                @else
                    @foreach ($products as $product)
                        <div class="col-lg-3 col-md-4 col-sm-6 col-6 py-2 px-md-1 px-0">
                            <a href="{{ route('productDetails', ['id' => $product->id]) }}"
                                class="text-decoration-none text-dark">
                                <div class="mx-1 p-2 bg-white product-card rounded">
                                    <img class="rounded-right"
                                        src="{{ \App\Helpers\ConstCommon::getLinkImageToStorage($product->link_image) }}" />
                                    <div class="p-2">
                                        <p class="mb-0 product-card-title">
                                            {{ $product->title }}
                                        </p>
                                        <p class="text-danger font-weight-bold mb-0">
                                            {{ number_format($product->price) }}đ</p>
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
                @endif


            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            function formatNumberWithLeadingZero(number) {
                if (number < 10) {
                    return "0" + number;
                } else {
                    return number.toString();
                }
            }
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
                    var hours = formatNumberWithLeadingZero(Math.floor((distance % (1000 * 60 * 60 * 24)) /
                        (1000 * 60 * 60)));
                    var minutes = formatNumberWithLeadingZero(Math.floor((distance % (1000 * 60 * 60)) / (
                        1000 * 60)));
                    var seconds = formatNumberWithLeadingZero(Math.floor((distance % (1000 * 60)) / 1000));

                    // Output the result in an element with id="demo"
                    document.getElementById("countdown").innerHTML = hours + ": " +
                        minutes + ": " + seconds;

                    // If the count down is over, write some text
                    if (distance < 0) {
                        clearInterval(x);
                        // location.reload();
                        document.getElementById("countdown").innerHTML =
                            "Đã mở bán vui lòng khởi động lại trang web";
                    }
                }, 1000);
            }

            var timeEvent = timeEventStart = timeEventEnd = null;
            @if ($timeEventStart)
                timeEvent = '{{ $timeEventStart }}';
                timeEventStart = '{{ $timeEventStart }}';
            @endif

            @if ($timeEventEnd)
                timeEvent = '{{ $timeEventEnd }}';
                timeEventEnd = '{{ $timeEventEnd }}';
            @endif
            var countDownDateEvent = new Date(timeEvent).getTime();

            var timenowEvent = new Date().getTime();

            // Find the distance between now and the count down date
            // var distanceTimeEvent = countDownDateEvent - timenowEvent;
            // if (distanceTimeEvent < 0) {
            //     document.getElementById("time-event").innerHTML = "00:00:00";
            // } else {
            //     // Update the count down every 1 second
            //     var x = setInterval(function() {

            //         // Get today's date and time
            //         var nowEvent = new Date().getTime();

            //         // Find the distance between now and the count down date
            //         var distanceEvent = countDownDateEvent - nowEvent;

            //         // Time calculations for days, hours, minutes and seconds
            //         var days = Math.floor(distanceEvent / (1000 * 60 * 60 * 24));
            //         var hoursE = formatNumberWithLeadingZero(Math.floor((distanceEvent % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)));
            //         var minutesE = formatNumberWithLeadingZero(Math.floor((distanceEvent % (1000 * 60 * 60)) / (1000 * 60)));
            //         var secondsE = formatNumberWithLeadingZero(Math.floor((distanceEvent % (1000 * 60)) / 1000));

            //         // Output the result in an element with id="demo"

            //         if (timeEventStart !== null) {
            //             document.getElementById("time-event").innerHTML = 'Sắp mở<br>' + days + " ngày " +
            //                 hoursE + ": " +
            //                 minutesE + ": " + secondsE;
            //         }
            //         if (timeEventEnd !== null) {
            //             document.getElementById("time-event").innerHTML = 'Còn lại<br>' + days + " ngày " +
            //                 hoursE + ": " +
            //                 minutesE + ": " + secondsE;
            //         }


            //         // If the count down is over, write some text
            //         if (distance < 0) {
            //             clearInterval(x);
            //             // location.reload();
            //             document.getElementById("time-event").innerHTML =
            //                 "Đã mở bán vui lòng khởi động lại trang web";
            //         }
            //     }, 1000);
            // }

            // , 'timeEventStart', 'timeEventEnd'

            function startShake() {
                var image = document.getElementById("myImage");
                image.classList.add("shake");
            }

            function stopShake() {
                var image = document.getElementById("myImage");
                image.classList.remove("shake");
            }

            // Kích hoạt hiệu ứng rung sau 5 giây và lặp lại sau mỗi 5 giây
            setInterval(function() {
                startShake();
                setTimeout(stopShake, 2000); // Dừng hiệu ứng sau 0.5 giây
            }, 5000);
            // function openGift() {
            // var giftBox = document.getElementById("giftBox");
            // giftBox.style.animation = "none";
            // giftBox.style.backgroundColor = "yellow";

            // setTimeout(function() {
            //     giftBox.innerHTML = "🎉";
            // }, 500);
            // }

            // setTimeout(openGift, 2000);

        });
    </script>
    <script>
        $(document).ready(function() {
            var quantitiy = 0;
            var amount = '{{$cacheBoxItem->amount ?? 0}}'
            $(".quantity-right-plus").click(function(e) {
                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var quantity = parseInt($("#quantity").val());

                // If is not undefined

                if (quantity < amount) {
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
