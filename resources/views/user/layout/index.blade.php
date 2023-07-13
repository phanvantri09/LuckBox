<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lucky Box</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        /* Make the image fully responsive */
        .carousel-inner img {
            width: 100%;
            height: 500px;
        }

        .carousel-indicators li {
            width: 10px;
            height: 10px;
            border-radius: 100%;
        }
    </style>
</head>

<body>
    <!-- Menu -->
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        Dropdown link
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Link 1</a>
                        <a class="dropdown-item" href="#">Link 2</a>
                        <a class="dropdown-item" href="#">Link 3</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End Menu -->

    <!-- SlideShow -->
    <div id="demo" class="carousel slide" data-ride="carousel">

        <!-- Indicators -->
        <ul class="carousel-indicators">
            <li data-target="#demo" data-slide-to="0" class="active"></li>
            <li data-target="#demo" data-slide-to="1"></li>
            <li data-target="#demo" data-slide-to="2"></li>
        </ul>

        <!-- The slideshow -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://hinhanhdep.net/wp-content/uploads/2017/06/anh-hoa-hong-dep-18.jpg" alt="Los Angeles">
            </div>
            <div class="carousel-item">
                <img src="https://hoala.vn/upload/img/images/album-nhung-hinh-anh-dep-nhat-ve-hoa-hong-leo-07.jpg"
                    alt="Chicago">
            </div>
            <div class="carousel-item">
                <img src="https://img4.thuthuatphanmem.vn/uploads/2020/05/14/hinh-anh-hoa-hong-leo-dep_021528729.jpg"
                    alt="New York">
            </div>
        </div>

        <!-- Left and right controls -->
        <a class="carousel-control-prev" href="#demo" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#demo" data-slide="next">
            <span class="carousel-control-next-icon"></span>
        </a>
    </div>
    <!-- End SlideShow -->
    <div class="container-fluid bg-warning py-4">
        <div class="row mx-1 py-2">
            <div class="col-sm-7 bg-white py-2">
                <div class="row">
                    <div class="col-sm-6 d-flex justify-content-center">
                        <img src="https://img4.thuthuatphanmem.vn/uploads/2020/05/14/hinh-anh-hoa-hong-leo-dep_021528729.jpg"
                            width="50%" height="200">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <button type="button" class="quantity-left-minus btn btn-danger btn-number"
                                    data-type="minus" data-field="">
                                    <span class="glyphicon glyphicon-minus"></span>
                                </button>
                            </span>
                            <input type="text" id="quantity" name="quantity" class="form-control input-number"
                                value="1" min="1" max="100">
                            <span class="input-group-btn">
                                <button type="button" class="quantity-right-plus btn btn-success btn-number"
                                    data-type="plus" data-field="">
                                    <span class="glyphicon glyphicon-plus"></span>
                                </button>
                            </span>
                        </div>
                        <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                            <h6 class="mb-0">2.000.000</h6>
                        </div>
                        <button type="button" class="btn btn-dark btn-block btn-lg"data-mdb-ripple-color="dark">Mua
                            ngay</button>

                    </div>
                    <div class="col-sm-5 border border-right-0 font-weight-bold">
                        <h3 class="text-danger text-center">LƯU Ý</h3>
                        <p>- Mở bán vào khung giờ 12h00 và 22h00 hằng ngày</p>
                        <p>- Số lượng: 50.000 hộp/phiên bản</p>
                        <p>- Với tiêu chí người đến trước bán trước đến khi hết hộp sẽ đóng phiên</p>
                        <p>- Mỗi khách hàng chỉ được mua tối đa 100 hộp/phiên bản</p>
                        <p>- Quý khách có thể mở thưởng hoặc bán lại trên Maket ngay sau khi mua hộp</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-5 pr-0">
                <img src="https://hinhanhdep.net/wp-content/uploads/2017/06/anh-hoa-hong-dep-18.jpg" alt="New York"
                    width="100%" height="500">
            </div>
        </div>
        <div class="mx-1 py-2 bg-danger text-center">
            <h4>PHẦN THƯỞNG</h4>
            <span>Gồm có 10 phần thưởng ngẫu nhiên khi mở box</span>
        </div>
        <div class="row py-2">
            <div class="col-sm-6 py-2">
                <div class="mx-1 row bg-white">
                    <div class="col-sm-6 text-center">
                        <p class="font-weight-bold">Smart Tivi Samsung 4K Crystal UHD 50 Inch UA50AUS100</p>
                        <span class="price bg-danger text-white font-weight-bold px-2 py-2 rounded-circle">Giá:
                            12.000.000đ</span>
                    </div>
                    <div class="col-sm-6">
                        <img src="https://hinhanhdep.net/wp-content/uploads/2017/06/anh-hoa-hong-dep-18.jpg"
                            alt="New York" width="100%" height="200">
                    </div>
                </div>
            </div>
            <div class="col-sm-6 py-2">
                <div class="mx-1 row bg-white">
                    <div class="col-sm-6 text-center">
                        <p class="font-weight-bold">Smart Tivi Samsung 4K Crystal UHD 50 Inch UA50AUS100</p>
                        <span class="price bg-danger text-white font-weight-bold px-2 py-2 rounded-circle">Giá:
                            12.000.000đ</span>
                    </div>
                    <div class="col-sm-6">
                        <img src="https://hinhanhdep.net/wp-content/uploads/2017/06/anh-hoa-hong-dep-18.jpg"
                            alt="New York" width="100%" height="200">
                    </div>
                </div>
            </div>
            <div class="col-sm-6 py-2">
                <div class="mx-1 row bg-white">
                    <div class="col-sm-6 text-center">
                        <p class="font-weight-bold">Smart Tivi Samsung 4K Crystal UHD 50 Inch UA50AUS100</p>
                        <span class="price bg-danger text-white font-weight-bold px-2 py-2 rounded-circle">Giá:
                            12.000.000đ</span>
                    </div>
                    <div class="col-sm-6">
                        <img src="https://hinhanhdep.net/wp-content/uploads/2017/06/anh-hoa-hong-dep-18.jpg"
                            alt="New York" width="100%" height="200">
                    </div>
                </div>
            </div>
            <div class="col-sm-6 py-2">
                <div class="mx-1 row bg-white">
                    <div class="col-sm-6 text-center">
                        <p class="font-weight-bold">Smart Tivi Samsung 4K Crystal UHD 50 Inch UA50AUS100</p>
                        <span class="price bg-danger text-white font-weight-bold px-2 py-2 rounded-circle">Giá:
                            12.000.000đ</span>
                    </div>
                    <div class="col-sm-6">
                        <img src="https://hinhanhdep.net/wp-content/uploads/2017/06/anh-hoa-hong-dep-18.jpg"
                            alt="New York" width="100%" height="200">
                    </div>
                </div>
            </div>
            <div class="col-sm-6 py-2">
                <div class="mx-1 row bg-white">
                    <div class="col-sm-6 text-center">
                        <p class="font-weight-bold">Smart Tivi Samsung 4K Crystal UHD 50 Inch UA50AUS100</p>
                        <span class="price bg-danger text-white font-weight-bold px-2 py-2 rounded-circle">Giá:
                            12.000.000đ</span>
                    </div>
                    <div class="col-sm-6">
                        <img src="https://hinhanhdep.net/wp-content/uploads/2017/06/anh-hoa-hong-dep-18.jpg"
                            alt="New York" width="100%" height="200">
                    </div>
                </div>
            </div>
            <div class="col-sm-6 py-2">
                <div class="mx-1 row bg-white">
                    <div class="col-sm-6 text-center">
                        <p class="font-weight-bold">Smart Tivi Samsung 4K Crystal UHD 50 Inch UA50AUS100</p>
                        <span class="price bg-danger text-white font-weight-bold px-2 py-2 rounded-circle">Giá:
                            12.000.000đ</span>
                    </div>
                    <div class="col-sm-6">
                        <img src="https://hinhanhdep.net/wp-content/uploads/2017/06/anh-hoa-hong-dep-18.jpg"
                            alt="New York" width="100%" height="200">
                    </div>
                </div>
            </div>
            <div class="col-sm-6 py-2">
                <div class="mx-1 row bg-white">
                    <div class="col-sm-6 text-center">
                        <p class="font-weight-bold">Smart Tivi Samsung 4K Crystal UHD 50 Inch UA50AUS100</p>
                        <span class="price bg-danger text-white font-weight-bold px-2 py-2 rounded-circle">Giá:
                            12.000.000đ</span>
                    </div>
                    <div class="col-sm-6">
                        <img src="https://hinhanhdep.net/wp-content/uploads/2017/06/anh-hoa-hong-dep-18.jpg"
                            alt="New York" width="100%" height="200">
                    </div>
                </div>
            </div>
            <div class="col-sm-6 py-2">
                <div class="mx-1 row bg-white">
                    <div class="col-sm-6 text-center">
                        <p class="font-weight-bold">Smart Tivi Samsung 4K Crystal UHD 50 Inch UA50AUS100</p>
                        <span class="price bg-danger text-white font-weight-bold px-2 py-2 rounded-circle">Giá:
                            12.000.000đ</span>
                    </div>
                    <div class="col-sm-6">
                        <img src="https://hinhanhdep.net/wp-content/uploads/2017/06/anh-hoa-hong-dep-18.jpg"
                            alt="New York" width="100%" height="200">
                    </div>
                </div>
            </div>
            <div class="col-sm-6 py-2">
                <div class="mx-1 row bg-white">
                    <div class="col-sm-6 text-center">
                        <p class="font-weight-bold">Smart Tivi Samsung 4K Crystal UHD 50 Inch UA50AUS100</p>
                        <span class="price bg-danger text-white font-weight-bold px-2 py-2 rounded-circle">Giá:
                            12.000.000đ</span>
                    </div>
                    <div class="col-sm-6">
                        <img src="https://hinhanhdep.net/wp-content/uploads/2017/06/anh-hoa-hong-dep-18.jpg"
                            alt="New York" width="100%" height="200">
                    </div>
                </div>
            </div>
            <div class="col-sm-6 py-2">
                <div class="mx-1 row bg-white">
                    <div class="col-sm-6 text-center">
                        <p class="font-weight-bold">Smart Tivi Samsung 4K Crystal UHD 50 Inch UA50AUS100</p>
                        <span class="price bg-danger text-white font-weight-bold px-2 py-2 rounded-circle">Giá:
                            12.000.000đ</span>
                    </div>
                    <div class="col-sm-6">
                        <img src="https://hinhanhdep.net/wp-content/uploads/2017/06/anh-hoa-hong-dep-18.jpg"
                            alt="New York" width="100%" height="200">
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script>
        $(document).ready(function() {

            var quantitiy = 0;
            $('.quantity-right-plus').click(function(e) {

                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var quantity = parseInt($('#quantity').val());

                // If is not undefined

                $('#quantity').val(quantity + 1);


                // Increment

            });

            $('.quantity-left-minus').click(function(e) {
                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var quantity = parseInt($('#quantity').val());

                // If is not undefined

                // Increment
                if (quantity > 0) {
                    $('#quantity').val(quantity - 1);
                }
            });

        });
    </script>
</body>

</html>
