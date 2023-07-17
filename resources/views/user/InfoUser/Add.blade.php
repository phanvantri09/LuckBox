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
    @endsection
    @section('scripts')

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
@endsection
