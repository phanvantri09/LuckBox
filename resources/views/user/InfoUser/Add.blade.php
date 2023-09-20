@extends('user.layout.index')
@section('css')
    <style>
        #show_eye {
            display: block;
        }

        #hide_eye {
            display: none;
        }

        #show_eye_new {
            display: block;
        }

        #hide_eye_new {
            display: none;
        }

        #show_eye_confirm_password {
            display: block;
        }

        #hide_eye_confirm_password {
            display: none;
        }
    </style>
@endsection
@section('content')
    <div class="bg-white text-orange title-page">
        <div class="container">
            <p>LuckyBox | Thông tin người dùng</p>
        </div>
    </div>
    <div class="content-container py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-12">
                    <div class="bg-white py-4 px-4 border">
                        <div class="d-flex">
                            <img src="{{ empty($getInfoUser->link_image) ? asset('/dist/img/noavt.jpg') : \App\Helpers\ConstCommon::getLinkImageToStorage($getInfoUser->link_image) }}"
                                width="40%" height="auto" class="pr-1" alt="">
                            <span>Chào mừng bạn,
                                <br><b>{{ $user->name ?? null }}</b> <br>
                                <span>{{ $user->email ?? null }}</span><br>
                                <span>{{ $user->number_phone ?? null }}</span><br>
                                <span>{{ $getInfoUser->house_number_street ?? null }}</span><br>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-12">
                    <div class="bg-white rounded py-4 px-4 border mb-4">
                        <h5 class="text-center">Cập nhật thông tin cá nhân</h5>
                        <form action="{{ route('updateInfoPost') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Họ và tên</label>
                                <input type="text" name="name" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Nguyễn Văn A" value="{{ Auth::user()->name ?? null }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput2">Số điện thoại</label>
                                <input type="tel" name="number_phone" pattern="((\+84|0)[3|5|7|8|9])+([0-9]{8})"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');" required class="form-control"
                                    id="exampleFormControlInput2" placeholder="Số điện thoại"
                                    value="{{ empty($getInfoUser->number_phone) ? '' : $getInfoUser->number_phone }}">
                                @error('number_phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- <div class="form-group">
                                <label for="exampleFormControlInput3">Ngày sinh</label>
                                <input type="date" name="birthdate" class="form-control" id="exampleFormControlInput3"
                                    placeholder="Nguyễn Văn A"
                                    value="{{ empty($getInfoUser->birthdate) ? '' : $getInfoUser->birthdate }}">
                            </div> --}}
                            <div class="form-group">
                                <label class="form-label" for="customFile">Hình ảnh</label>
                                <input type="file" name="link_image" class="form-control-file border rounded px-1 py-1"
                                    id="image-input" accept="image/*">
                                <img id="preview-image"
                                    src="{{ empty($getInfoUser->link_image) ? '' : $getInfoUser->link_image }}"
                                    alt="Preview" style="display: none; height:100px;">
                            </div>
                            @if ($errors->has('link_image'))
                                <label class="text-danger">
                                    {{ $errors->first('link_image') }}
                                </label>
                            @endif
                            <div class="form-group">
                                <label for="exampleFormControlInput4">Giới thiệu bản thân</label>
                                <textarea type="text" name="content" class="form-control" id="exampleFormControlInput4"
                                    placeholder="Giới thiệu bản thân...">{{ empty($getInfoUser->content) ? '' : $getInfoUser->content }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput5">Địa chỉ</label>

                                <textarea type="text" name="house_number_street" class="form-control" id="exampleFormControlInput4"
                                    placeholder="Địa chỉ của bạn">{{ empty($getInfoUser->house_number_street) ? '' : $getInfoUser->house_number_street }}</textarea>

                                {{-- <input name="house_number_street" type="text" class="form-control"
                                    id="exampleFormControlInput5" placeholder="Số nhà..."
                                    value="{{ empty($getInfoUser->house_number_street) ? '' : $getInfoUser->house_number_street }}"> --}}
                            </div>
                            {{-- <div class="row">
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
                            </div> --}}

                            <button type="submit" class="btn bg-orange text-white font-weight-bold">Lưu lại thông
                                tin</button>
                        </form>
                    </div>
                    <div class="bg-white rounded py-4 px-4 border">
                        <h5 class="text-center">Đổi mật khẩu</h5>
                        <form action="{{ route('updatePassword') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="psw"><b class="text-danger">*</b> Mật khẩu hiện tại</label>
                                <div class="input-group mb-3">
                                    <input id="password" type="password" placeholder="Nhập mật khẩu hiện tại"
                                        class="form-control" id="password" name="password" required="true"
                                        aria-label="password" aria-describedby="basic-addon1" />
                                    <div class="input-group-append">
                                        <span class="input-group-text" onclick="password_show_hide();">
                                            <svg xmlns="http://www.w3.org/2000/svg" id="show_eye" width="16"
                                                height="16" fill="currentColor" class="bi bi-eye-fill"
                                                viewBox="0 0 16 16">
                                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                <path
                                                    d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" id="hide_eye" width="16"
                                                height="16" fill="currentColor" class="bi bi-eye-slash-fill"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z" />
                                                <path
                                                    d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                @if (Session::has('error'))
                                    <div class="alert alert-danger">
                                        {{ Session::get('error') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="psw"><b class="text-danger">*</b> Mật khẩu mới</label>
                                <div class="input-group mb-3">
                                    <input type="password" placeholder="Nhập mật khẩu mới" class="form-control"
                                        id="passwordNew" name="passwordNew" required="true" aria-label="password"
                                        aria-describedby="basic-addon1" />
                                    <div class="input-group-append">
                                        <span class="input-group-text" onclick="password_show_hideUp();">
                                            <svg xmlns="http://www.w3.org/2000/svg" id="show_eye_new" width="16"
                                                height="16" fill="currentColor" class="bi bi-eye-fill"
                                                viewBox="0 0 16 16">
                                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                <path
                                                    d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" id="hide_eye_new" width="16"
                                                height="16" fill="currentColor" class="bi bi-eye-slash-fill"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z" />
                                                <path
                                                    d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                @error('passwordNew')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="psw"><b class="text-danger">*</b>Xác nhận mật khẩu mới</label>
                                <div class="input-group mb-3">
                                    <input type="password" placeholder="Nhập lại mật khẩu mới" class="form-control"
                                        id="confirm_password" name="confirm_password" required="true"
                                        aria-label="password" aria-describedby="basic-addon1" />
                                    <div class="input-group-append">
                                        <span class="input-group-text" onclick="password_show_hide_confirm_password();">
                                            <svg xmlns="http://www.w3.org/2000/svg" id="show_eye_confirm_password"
                                                width="16" height="16" fill="currentColor" class="bi bi-eye-fill"
                                                viewBox="0 0 16 16">
                                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                <path
                                                    d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" id="hide_eye_confirm_password"
                                                width="16" height="16" fill="currentColor"
                                                class="bi bi-eye-slash-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z" />
                                                <path
                                                    d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                @error('confirm_password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn bg-orange text-white font-weight-bold">Đổi mật
                                khẩu</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script>
        var citySelectCurrent = districtSelectCurrent = neighborhood_villageSelectCurrent = null;
        @if (!empty($getInfoUser->province_city))
            citySelectCurrent = "{{ $getInfoUser->province_city }}";
        @endif
        @if (!empty($getInfoUser->province_city))
            districtSelectCurrent = "{{ $getInfoUser->district }}";
        @endif
        @if (!empty($getInfoUser->province_city))
            neighborhood_villageSelectCurrent = "{{ $getInfoUser->neighborhood_village }}";
        @endif
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
                if (x.Id == citySelectCurrent) {
                    citis.options[citis.options.length] = new Option(x.Name, x.Id, false, true)
                    // console.log(data[25].Districts);
                } else {
                    citis.options[citis.options.length] = new Option(x.Name, x.Id);
                }
            }
            if (citySelectCurrent !== null) {
                (function() {
                    for (const k of data[citySelectCurrent].Districts) {
                        if (k.Id == districtSelectCurrent) {
                            district.options[district.options.length] = new Option(k.Name, k.Id, false, true);
                        } else {
                            district.options[district.options.length] = new Option(k.Name, k.Id);
                        }
                    }
                })();
            }
            if (neighborhood_villageSelectCurrent !== null) {
                (function() {
                    const dataaaa = data[citySelectCurrent].Districts.find(n => n.Id == districtSelectCurrent);
                    for (const w of dataaaa.Wards) {
                        if (w.Id == neighborhood_villageSelectCurrent) {
                            wards.options[wards.options.length] = new Option(w.Name, w.Id, false, true);
                        } else {
                            wards.options[wards.options.length] = new Option(w.Name, w.Id);
                        }
                    }
                })();
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
        document.getElementById('image-input').addEventListener('change', function(event) {
            var input = event.target;

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    var previewImage = document.getElementById('preview-image');

                    // Hiển thị hình ảnh xem trước
                    previewImage.src = e.target.result;
                    previewImage.style.display = 'block';
                };

                reader.readAsDataURL(input.files[0]);
            }
        });

        function password_show_hide() {
            var x = document.getElementById("password");
            var show_eye = document.getElementById("show_eye");
            var hide_eye = document.getElementById("hide_eye");
            hide_eye.classList.remove("d-none");
            if (x.type === "password") {
                x.type = "text";
                show_eye.style.display = "none";
                hide_eye.style.display = "block";
            } else {
                x.type = "password";
                show_eye.style.display = "block";
                hide_eye.style.display = "none";
            }
        }

        function password_show_hideUp() {
            console.log(123213);
            var xx = document.getElementById("passwordNew");
            var show_eye_new = document.getElementById("show_eye_new");
            var hide_eye_new = document.getElementById("hide_eye_new");
            hide_eye_new.classList.remove("d-none");
            if (xx.type === "password") {
                xx.type = "text";
                show_eye_new.style.display = "none";
                hide_eye_new.style.display = "block";
            } else {
                xx.type = "password";
                show_eye_new.style.display = "block";
                hide_eye_new.style.display = "none";
            }
        }

        function password_show_hide_confirm_password() {
            var xxx = document.getElementById("confirm_password");
            var show_eye_confirm_password = document.getElementById("show_eye_confirm_password");
            var hide_eye_confirm_password = document.getElementById("hide_eye_confirm_password");
            hide_eye_confirm_password.classList.remove("d-none");
            if (xxx.type === "password") {
                xxx.type = "text";
                show_eye_confirm_password.style.display = "none";
                hide_eye_confirm_password.style.display = "block";
            } else {
                xxx.type = "password";
                show_eye_confirm_password.style.display = "block";
                hide_eye_confirm_password.style.display = "none";
            }
        }
    </script>
@endsection
