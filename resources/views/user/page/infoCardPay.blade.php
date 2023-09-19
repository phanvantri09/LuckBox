@extends('user.layout.index')
@section('css')
    <style>
        .custom-file-input:lang(en)~.custom-file-label::after {
            content: "Chọn file";
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            text-align: center;
            background-color: #caf1ee;
            margin: 20% auto;
            padding: 20px 10px;
            border: 1px solid #dc600d;
            width: 300px;
        }
    </style>
@endsection
@section('content')
    <div class="bg-white text-orange title-page">
        <div class="container">
            <p>LuckyBox | Nạp tiền vào ví</p>
        </div>
    </div>
    <div class="content-container py-md-4 py-2">
        <div class="container my-lg-2 my-0 d-flex justify-content-center">
            <div class="bg-white py-2 rounded mb-2 px-4 w-md-50">
                <div class="d-flex">
                    <span class="bg-warning rounded-circle icon-stt">1</span>
                    <span class="pl-1">
                        Thoát ứng dụng, mở nền tảng thanh toán hoặc ngân hàng đã chọn khớp với tên đã xác minh của bạn trên
                        ứng dụng và chuyển tiền vào tài khoản của người bán được cung cấp bên dưới.
                    </span>
                </div>
                <div class="text-note d-flex pl-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-exclamation-circle-fill pt-1" viewBox="0 0 16 16">
                        <path
                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                    </svg>
                    <span class="pl-1">
                        Chú ý nhập đúng thông tin ở tài khoản nhận của chúng tôi ở dưới.
                    </span>
                </div>
                <div class="pl-4 content-bank">
                    <span class="pl-2 border-left border-warning">Chuyển khoản ngân hàng(Việt Nam)</span>
                    <div class="row justify-content-between align-items-start pt-1">
                        <span class="col-5 text-secondary">Họ và tên</span>
                        <div class="col-6 text-right" id="hoten">
                            {{ $getCardAdmin->card_name }}
                        </div>
                        <button class="border-0 bg-white col-1 px-0 clickcopy" onclick="copyText('#hoten')">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                                <path
                                    d="M433.941 65.941l-51.882-51.882A48 48 0 0 0 348.118 0H176c-26.51 0-48 21.49-48 48v48H48c-26.51 0-48 21.49-48 48v320c0 26.51 21.49 48 48 48h224c26.51 0 48-21.49 48-48v-48h80c26.51 0 48-21.49 48-48V99.882a48 48 0 0 0-14.059-33.941zM266 464H54a6 6 0 0 1-6-6V150a6 6 0 0 1 6-6h74v224c0 26.51 21.49 48 48 48h96v42a6 6 0 0 1-6 6zm128-96H182a6 6 0 0 1-6-6V54a6 6 0 0 1 6-6h106v88c0 13.255 10.745 24 24 24h88v202a6 6 0 0 1-6 6zm6-256h-64V48h9.632c1.591 0 3.117.632 4.243 1.757l48.368 48.368a6 6 0 0 1 1.757 4.243V112z" />
                            </svg>
                        </button>
                    </div>
                    <div class="row justify-content-between align-items-start pt-1">
                        <span class="col-5 text-secondary">Tên ngân hàng</span>
                        <div class="col-6 text-right" id="tenNH">
                            {{ $getCardAdmin->bank }}
                        </div>
                        <button class="border-0 bg-white col-1 px-0 clickcopy" onclick="copyText('#tenNH')">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                                <path
                                    d="M433.941 65.941l-51.882-51.882A48 48 0 0 0 348.118 0H176c-26.51 0-48 21.49-48 48v48H48c-26.51 0-48 21.49-48 48v320c0 26.51 21.49 48 48 48h224c26.51 0 48-21.49 48-48v-48h80c26.51 0 48-21.49 48-48V99.882a48 48 0 0 0-14.059-33.941zM266 464H54a6 6 0 0 1-6-6V150a6 6 0 0 1 6-6h74v224c0 26.51 21.49 48 48 48h96v42a6 6 0 0 1-6 6zm128-96H182a6 6 0 0 1-6-6V54a6 6 0 0 1 6-6h106v88c0 13.255 10.745 24 24 24h88v202a6 6 0 0 1-6 6zm6-256h-64V48h9.632c1.591 0 3.117.632 4.243 1.757l48.368 48.368a6 6 0 0 1 1.757 4.243V112z" />
                            </svg>
                        </button>
                    </div>
                    <div class="row justify-content-between align-items-start pt-1">
                        <span class="col-5 text-secondary">Số tài khoản/Số thẻ</span>
                        <div class="col-6 text-right" id="numberCard">
                            {{ $getCardAdmin->card_number }}
                        </div>
                        <button class="border-0 bg-white col-1 px-0 clickcopy" onclick="copyText('#numberCard')">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                                <path
                                    d="M433.941 65.941l-51.882-51.882A48 48 0 0 0 348.118 0H176c-26.51 0-48 21.49-48 48v48H48c-26.51 0-48 21.49-48 48v320c0 26.51 21.49 48 48 48h224c26.51 0 48-21.49 48-48v-48h80c26.51 0 48-21.49 48-48V99.882a48 48 0 0 0-14.059-33.941zM266 464H54a6 6 0 0 1-6-6V150a6 6 0 0 1 6-6h74v224c0 26.51 21.49 48 48 48h96v42a6 6 0 0 1-6 6zm128-96H182a6 6 0 0 1-6-6V54a6 6 0 0 1 6-6h106v88c0 13.255 10.745 24 24 24h88v202a6 6 0 0 1-6 6zm6-256h-64V48h9.632c1.591 0 3.117.632 4.243 1.757l48.368 48.368a6 6 0 0 1 1.757 4.243V112z" />
                            </svg>
                        </button>
                    </div>
                    <div class="row justify-content-between align-items-start pt-1">
                        <span class="col-5 text-secondary">Mã giao dịch (Nội dung CK)</span>
                        <div class="col-6 text-right" id="ndckdx">

                            {{ $codeString ?? null }}
                        </div>
                        <button class="border-0 bg-white col-1 px-0 clickcopy" onclick="copyText('#ndckdx')">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                                <path
                                    d="M433.941 65.941l-51.882-51.882A48 48 0 0 0 348.118 0H176c-26.51 0-48 21.49-48 48v48H48c-26.51 0-48 21.49-48 48v320c0 26.51 21.49 48 48 48h224c26.51 0 48-21.49 48-48v-48h80c26.51 0 48-21.49 48-48V99.882a48 48 0 0 0-14.059-33.941zM266 464H54a6 6 0 0 1-6-6V150a6 6 0 0 1 6-6h74v224c0 26.51 21.49 48 48 48h96v42a6 6 0 0 1-6 6zm128-96H182a6 6 0 0 1-6-6V54a6 6 0 0 1 6-6h106v88c0 13.255 10.745 24 24 24h88v202a6 6 0 0 1-6 6zm6-256h-64V48h9.632c1.591 0 3.117.632 4.243 1.757l48.368 48.368a6 6 0 0 1 1.757 4.243V112z" />
                            </svg>
                        </button>
                    </div>
                    {{-- <div class="row justify-content-between align-items-start pt-1">
                        <span class="col-5 text-secondary">Lưu ý</span>
                        <div class="col-6 text-right" id="luuy">
                            Không ghi chú giao dịch usdt, mua bán usdt
                        </div>
                        <button class="border-0 bg-white col-1 px-0 clickcopy" onclick="copyText('#luuy')">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                                <path
                                    d="M433.941 65.941l-51.882-51.882A48 48 0 0 0 348.118 0H176c-26.51 0-48 21.49-48 48v48H48c-26.51 0-48 21.49-48 48v320c0 26.51 21.49 48 48 48h224c26.51 0 48-21.49 48-48v-48h80c26.51 0 48-21.49 48-48V99.882a48 48 0 0 0-14.059-33.941zM266 464H54a6 6 0 0 1-6-6V150a6 6 0 0 1 6-6h74v224c0 26.51 21.49 48 48 48h96v42a6 6 0 0 1-6 6zm128-96H182a6 6 0 0 1-6-6V54a6 6 0 0 1 6-6h106v88c0 13.255 10.745 24 24 24h88v202a6 6 0 0 1-6 6zm6-256h-64V48h9.632c1.591 0 3.117.632 4.243 1.757l48.368 48.368a6 6 0 0 1 1.757 4.243V112z" />
                            </svg>
                        </button>
                    </div> --}}
                    {{-- <div class="row justify-content-between align-items-start pt-1">
                        <div class="col-5 text-secondary text-note d-flex">
                            <span>Nội dung chuyển khoản</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-exclamation-circle-fill pt-1" viewBox="0 0 16 16">
                                <path
                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                            </svg>
                        </div>
                        <div class="col-6 text-right" id="ndck">
                            20514507860716027904
                        </div>
                        <button class="border-0 bg-white col-1 px-0 clickcopy" onclick="copyText('#ndck')">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                                <path
                                    d="M433.941 65.941l-51.882-51.882A48 48 0 0 0 348.118 0H176c-26.51 0-48 21.49-48 48v48H48c-26.51 0-48 21.49-48 48v320c0 26.51 21.49 48 48 48h224c26.51 0 48-21.49 48-48v-48h80c26.51 0 48-21.49 48-48V99.882a48 48 0 0 0-14.059-33.941zM266 464H54a6 6 0 0 1-6-6V150a6 6 0 0 1 6-6h74v224c0 26.51 21.49 48 48 48h96v42a6 6 0 0 1-6 6zm128-96H182a6 6 0 0 1-6-6V54a6 6 0 0 1 6-6h106v88c0 13.255 10.745 24 24 24h88v202a6 6 0 0 1-6 6zm6-256h-64V48h9.632c1.591 0 3.117.632 4.243 1.757l48.368 48.368a6 6 0 0 1 1.757 4.243V112z" />
                            </svg>
                        </button>
                    </div> --}}
                </div>
                <div class="d-flex">
                    <span class="bg-warning rounded-circle icon-stt">2</span>
                    <span class="pl-1">
                        Sau khi chuyển, vui lòng nhập thông tin vào form bên dưới.
                    </span>
                </div>
                <form action="{{ route('infoCardPay') }}" method="Post" id="myForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Tên chủ tài khoản</label>
                            <input type="text" name="card_name" value="{{ $getCardDefault->card_name }}" required
                                class="form-control card_name" id="exampleFormControlInput1" placeholder="Nguyễn Văn A">
                            @error('card_name')
                                <div class="alert alert-danger">{{ $errors->first('card_name') }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput2">Tên ngân hàng</label>
                            <input type="text" name="bank" value="{{ $getCardDefault->bank }}" class="form-control"
                                required id="exampleFormControlInput2" placeholder="Agribank">
                            @error('bank')
                                <div class="alert alert-danger">{{ $errors->first('bank') }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput3">Số tài khoản/Số thẻ</label>
                            <input type="text" name="card_number" value="{{ $getCardDefault->card_number }}"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '');" required class="form-control"
                                id="exampleFormControlInput3" placeholder="nhập số tài khoản thẻ">
                            @error('card_number')
                                <div class="alert alert-danger">{{ $errors->first('card_number') }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput4">Số tiền nạp vào ví</label>
                            <input type="text" class="form-control" id="price_number" required
                                placeholder="Nhập số tiền bạn đã nạp vào">
                            @error('total')
                                <div class="alert alert-danger">{{ $errors->first('total') }}</div>
                            @enderror
                            <input type="hidden" name="total" id="total">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput4">Mã giao dịch</label>
                            <input required type="text" name="code" class="form-control"
                                id="exampleFormControlInput4" required placeholder="Nhập mã giao dịch"
                                value="{{ $codeString ?? null }}">
                            @error('code')
                                <div class="alert alert-danger">{{ $errors->first('code') }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput4">Hình ảnh giao dịch</label>
                            <div class="custom-file">
                                <input type="file" name="link_image" class="custom-file-input"
                                    id="validatedCustomFile" accept="image/*">
                                <label class="custom-file-label" for="validatedCustomFile">Chọn file.....</label>
                            </div>
                            @error('link_image')
                                <div class="alert alert-danger">{{ $errors->first('link_image') }}</div>
                            @enderror
                            <img id="preview-image" src="" alt="Preview"
                                style="display: none; width: 100%; height:auto;">
                        </div>
                        <input type="hidden" name="transaction_content" class="form-control"
                            id="exampleFormControlInput5" value="noidungck">
                    </div>
                    <div class="d-flex">
                        <span class="bg-warning rounded-circle icon-stt">3</span>
                        <span class="pl-1">
                            Sau khi nhập đủ thông tin, nhấp vào nút "Đã chuyển tiền".
                        </span>
                    </div>
                    <div class="row align-items-center justify-content-between mt-2">
                        <a href="checkout.html" class="col-4 pr-0">
                            {{-- <button class="btn bg-info font-weight-bold content-bank">Trợ giúp</button> --}}
                        </a>
                        <div class="col-8 text-right">
                            <button onclick="submitForm()" class="btn bg-warning font-weight-bold content-bank">Đã chuyển
                                tiền</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div id="myModal" class="modal">
            <div class="modal-content">
                <p>Bạn vừa thực hiện lệnh nạp tiền vào ví <br> Số tiền sẽ được ghi nhận sau vài phút vui lòng đợi
                    giây lát!</p>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"
        integrity="sha512-USPCA7jmJHlCNRSFwUFq3lAm9SaOjwG8TaB8riqx3i/dAJqhaYilVnaf2eVUH5zjq89BU6YguUuAno+jpRvUqA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        var myInput = document.getElementById('price_number');
        // Lắng nghe sự kiện input
        myInput.addEventListener('input', function() {
            var value = myInput.value;
            var formattedValue = numeral(value).format('0,0');
            myInput.value = formattedValue;
            $('#total').val(numeral(formattedValue).value());
        });

        function copyText(idName) {
            var textToCopy = $(idName).text();
            var $tempInput = $("<input>");
            $("body").append($tempInput);
            $tempInput.val(textToCopy).select();
            document.execCommand("copy");
            $tempInput.remove();
            alert('Đã sao chép nội dung!');
        }
        $(document).ready(function() {
            $('.card_name').on('change', function() {
                var inputValue = $(this).val();
                console.log(inputValue);
                var regex = /^[^\d]+$/u;

                if (!regex.test(inputValue)) {
                    $(this).val('');
                    alert('Vui lòng chỉ nhập văn bản và không nhập số!');
                }
            });
            document.getElementById('myForm').addEventListener('submit', function(event) {
                event.preventDefault(); // Ngăn chặn hành động mặc định của form

                // Hiển thị thông báo popup trong 5 giây
                var modal = document.getElementById('myModal');
                modal.style.display = 'block';
                setTimeout(function() {
                    modal.style.display = 'none';
                    document.getElementById('myForm').submit();
                }, 3000);
            });


            // review ảnh
            document.getElementById('validatedCustomFile').addEventListener('change', function(event) {
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
        });
    </script>
@endsection
