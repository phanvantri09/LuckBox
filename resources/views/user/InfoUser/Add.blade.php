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
    <link rel="stylesheet" href="./css/style.css">
    <script src="./js/custom.js"></script>
</head>

<body>

    <!-- Menu -->
    <nav class="navbar navbar-expand-md bg-orange text-white">
        <div class="container-lg">
            <a class="navbar-brand text-white" href="home.html">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbardrop"
                            data-toggle="dropdown">
                            Dropdown link
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item text-white" href="#">Link 1</a>
                            <a class="dropdown-item text-white" href="#">Link 2</a>
                            <a class="dropdown-item text-white" href="#">Link 3</a>
                        </div>
                    </li>
                </ul>
            </div>
            <a href="cart.html" class="text-white px-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                    class="bi bi-cart4" viewBox="0 0 16 16">
                    <path
                        d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z" />
                </svg>
            </a>
            <a href="" class="text-white px-2">Đăng nhập</a>
            <a href="" class="text-white px-2">Đăng ký</a>
            <a href="thongtinuser.html" class="text-white px-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                    class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                    <path fill-rule="evenodd"
                        d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                </svg>
            </a>
        </div>
    </nav>
    <!-- End Menu -->

    <div class="content-container py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-12">
                    <div class="bg-white py-4 px-4">
                        <div class="d-flex">
                            <img src="{{ empty($getInfoUser->link_image) ? asset('/dist/img/noavt.jpg') : \App\Helpers\ConstCommon::getLinkImageToStorage($getInfoUser->link_image) }}"
                                width="50%" height="160" class="pr-1" alt="">
                            <span>Chào mừng bạn,
                                <br><b>{{ empty($getInfoUser->name) ? '' : $getInfoUser->name }}</b>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-12">
                    <div class="bg-white rounded py-4 px-4">
                        <h4 class="text-center">Cập nhật thông tin cá nhân</h4>
                        <form action="{{ route('addPost') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Họ và tên</label>
                                    <input type="text" name="name" class="form-control"
                                        id="exampleFormControlInput1" placeholder="Nguyễn Văn A"
                                        value="{{ empty($getInfoUser->name) ? '' : $getInfoUser->name }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="exampleFormControlInput2">Số điện thoại</label>
                                    <input type="number" name="number_phone" class="form-control"
                                        id="exampleFormControlInput2" placeholder="Số điện thoại"
                                        value="{{ empty($getInfoUser->number_phone) ? '' : $getInfoUser->number_phone }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="exampleFormControlInput3">Ngày sinh</label>
                                    <input type="date" name="birthdate" class="form-control"
                                        id="exampleFormControlInput3" placeholder="Nguyễn Văn A"
                                        value="{{ empty($getInfoUser->birthdate) ? '' : $getInfoUser->birthdate }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <label class="form-label" for="customFile">Hình ảnh</label>
                                    <input type="file" name="link_image"
                                        class="form-control-file border rounded px-1 py-1"
                                        alt="{{ empty($getInfoUser->link_image) ? '' : $getInfoUser->link_image }}"
                                        id="customFile" />
                                </div>
                                @if ($errors->has('link_image'))
                                    <label class="text-danger">
                                        {{ $errors->first('link_image') }}
                                    </label>
                                @endif
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="exampleFormControlInput4">Giới thiệu bản thân</label>
                                    <textarea type="text" name="content" class="form-control" id="exampleFormControlInput4"
                                        placeholder="Giới thiệu bản thân...">{{ empty($getInfoUser->content) ? '' : $getInfoUser->content }}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <input type="hidden" name="country" value="Việt Nam">
                                <div class="form-group col-lg-4 col-md-6">
                                    <label for="city">Tỉnh/Thành phố</label>
                                    <select name="province_city" class="form-control" id="city">
                                        <option value="" selected>Chọn tỉnh thành</option>
                                    </select>
                                </div>
                                <div class="form-group col-lg-4 col-md-6">
                                    <label for="district">Quận/Huyện</label>
                                    <select name="district" class="form-control" id="district">
                                        <option value="" selected>Chọn quận huyện</option>
                                    </select>
                                </div>
                                <div class="form-group col-lg-4 col-md-6">
                                    <label for="ward">Phường/Xã</label>
                                    <select name="neighborhood_village" class="form-control" id="ward">
                                        <option value="" selected>Chọn phường xã</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="exampleFormControlInput5">Số nhà/đường</label>
                                    <input name="house_number_street" type="text" class="form-control"
                                        id="exampleFormControlInput5" placeholder="Số nhà..."
                                        value="{{ empty($getInfoUser->house_number_street) ? '' : $getInfoUser->house_number_street }}">
                                </div>
                            </div>
                            <button type="submit" style="background: black"
                                class="btn bg-orange text-white font-weight-bold">Lưu</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script>
        var citis = document.getElementById("city");
        var districts = document.getElementById("district");
        var wards = document.getElementById("ward");
        var Parameter = {
            url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json",
            method: "GET",
            responseType: "application/json",
        };
        var promise = axios(Parameter);
        promise.then(function(result) {
            renderCity(result.data);
        });

        function renderCity(data) {
            for (const x of data) {
                citis.options[citis.options.length] = new Option(x.Name, x.Id);
            }
            citis.onchange = function() {
                district.length = 1;
                ward.length = 1;
                if (this.value != "") {
                    const result = data.filter(n => n.Id === this.value);

                    for (const k of result[0].Districts) {
                        district.options[district.options.length] = new Option(k.Name, k.Id);
                    }
                }
                @if (!empty($getInfoUser->province_city))
                    citySelect.value = "{{ $getInfoUser->province_city }}";
                @endif
            };
            district.onchange = function() {
                ward.length = 1;
                const dataCity = data.filter((n) => n.Id === citis.value);
                if (this.value != "") {
                    const dataWards = dataCity[0].Districts.filter(n => n.Id === this.value)[0].Wards;

                    for (const w of dataWards) {
                        wards.options[wards.options.length] = new Option(w.Name, w.Id);
                    }
                }
            };
        }
    </script>
</body>

</html>
