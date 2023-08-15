@extends('user.layout.index')
@section('css')
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
                    <div class="bg-white py-4 px-4">
                        <div class="d-flex">
                            <img src="{{ empty($getInfoUser->link_image) ? asset('/dist/img/noavt.jpg') : \App\Helpers\ConstCommon::getLinkImageToStorage($getInfoUser->link_image) }}"
                                width="50%" height="160" class="pr-1" alt="">
                            <span>Chào mừng bạn,
                                <br><b>{{ Auth::user()->name ?? null }}</b>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-12">
                    <div class="bg-white rounded py-4 px-4">
                        <h5 class="text-center">Cập nhật thông tin cá nhân</h5>
                        <form action="{{ route('updateInfoPost') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Họ và tên</label>
                                <input type="text" name="name" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Nguyễn Văn A"
                                    value="{{ Auth::user()->name ?? null }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput2">Số điện thoại</label>
                                <input type="tel" name="number_phone" pattern="((\+84|0)[3|5|7|8|9])+([0-9]{8})" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required class="form-control" id="exampleFormControlInput2"
                                    placeholder="Số điện thoại"
                                    value="{{ empty($getInfoUser->number_phone) ? '' : $getInfoUser->number_phone }}">
                                    @error('number_phone')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput3">Ngày sinh</label>
                                <input type="date" name="birthdate" class="form-control" id="exampleFormControlInput3"
                                    placeholder="Nguyễn Văn A"
                                    value="{{ empty($getInfoUser->birthdate) ? '' : $getInfoUser->birthdate }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="customFile">Hình ảnh</label>
                                <input type="file" name="link_image" class="form-control-file border rounded px-1 py-1" id="image-input" accept="image/*">
                                <img id="preview-image" 
                                    src="{{ empty($getInfoUser->link_image) ? '' : $getInfoUser->link_image }}" alt="Preview" style="display: none; height:100px;">
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
                            
                            <button type="submit" class="btn bg-orange text-white font-weight-bold">Lưu</button>
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
    </script>
@endsection
