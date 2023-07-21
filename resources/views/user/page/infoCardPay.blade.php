@extends('user.layout.index')
@section('css')
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
                        Không ghi bất kỳ từ nào liên quan đến tiền mã hóa (ví dụ tiền mã hóa, BTC) trong phần nội dung
                        chuyển
                        tiền thanh toán của bạn.
                    </span>
                </div>
                <div class="pl-4 content-bank">
                    <span class="pl-2 border-left border-warning">Chuyển khoản ngân hàng(Việt Nam)</span>
                    <div class="row justify-content-between align-items-start pt-1">
                        <span class="col-5 text-secondary">Họ và tên</span>
                        <div class="col-6 text-right" id="hoten">
                            Nguyễn Thị Quỳnh Hoa
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
                            ACB-Ngân hàng Á Châu
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
                            34895497
                        </div>
                        <button class="border-0 bg-white col-1 px-0 clickcopy" onclick="copyText('#numberCard')">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                                <path
                                    d="M433.941 65.941l-51.882-51.882A48 48 0 0 0 348.118 0H176c-26.51 0-48 21.49-48 48v48H48c-26.51 0-48 21.49-48 48v320c0 26.51 21.49 48 48 48h224c26.51 0 48-21.49 48-48v-48h80c26.51 0 48-21.49 48-48V99.882a48 48 0 0 0-14.059-33.941zM266 464H54a6 6 0 0 1-6-6V150a6 6 0 0 1 6-6h74v224c0 26.51 21.49 48 48 48h96v42a6 6 0 0 1-6 6zm128-96H182a6 6 0 0 1-6-6V54a6 6 0 0 1 6-6h106v88c0 13.255 10.745 24 24 24h88v202a6 6 0 0 1-6 6zm6-256h-64V48h9.632c1.591 0 3.117.632 4.243 1.757l48.368 48.368a6 6 0 0 1 1.757 4.243V112z" />
                            </svg>
                        </button>
                    </div>
                    <div class="row justify-content-between align-items-start pt-1">
                        <span class="col-5 text-secondary">Nội dung chuyển khoản đề xuất</span>
                        <div class="col-6 text-right" id="ndckdx">
                            NAP TIEN VAO VI, id_user, email
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
                <form action="">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Tên chủ tài khoản</label>
                            <input type="text" name="name" class="form-control" id="exampleFormControlInput1"
                                placeholder="Nguyễn Văn A">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput2">Tên ngân hàng</label>
                            <input type="text" name="tennganhang" class="form-control" id="exampleFormControlInput2"
                                placeholder="Agribank">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput3">Số tài khoản/Số thẻ</label>
                            <input type="text" name="sothe" class="form-control" id="exampleFormControlInput3"
                                placeholder="2356....">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput4">Số tiền nạp vào ví</label>
                            <input type="text" name="sotien" class="form-control" id="exampleFormControlInput4"
                                placeholder="2.000.000">
                        </div>
                        <input type="hidden" name="name" class="form-control" id="exampleFormControlInput5" value="noidungck">
                    </div>
                    <div class="d-flex">
                        <span class="bg-warning rounded-circle icon-stt">3</span>
                        <span class="pl-1">
                            Sau khi nhập đủ thông tin, nhấp vào nút "Đã chuyển tiền, thông báo cho người bán" bên dưới.
                        </span>
                    </div>
                    <div class="row align-items-center justify-content-between mt-2">
                        <a href="checkout.html" class="col-4 pr-0">
                            <button class="btn bg-info font-weight-bold content-bank">Trợ giúp</button>
                        </a>
                        <a href="checkout.html" class="col-8 text-right">
                            <button class="btn bg-warning font-weight-bold content-bank">Đã chuyển tiền, thông báo cho người bán</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function copyText(idName) {
            console.log(123213);
            var textToCopy = $(idName).text();
            var $tempInput = $("<input>");
            $("body").append($tempInput);
            $tempInput.val(textToCopy).select();
            document.execCommand("copy");
            $tempInput.remove();
            alert('Đã sao chép nội dung!');
        }
    </script>
@endsection
