@extends('user.layout.index')
@section('css')
    <style>
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
            <p>LuckyBox | Yêu cầu rút tiền</p>
        </div>
    </div>
    <div class="content-container py-md-4 py-2">
        <div class="container my-lg-2 my-0 d-flex justify-content-center">
            <div class="bg-white py-2 rounded mb-2 px-4 w-md-50">
                <h5 class="text-center">Yêu cầu rút tiền</h5>
                <form action="{{ route('cashOut') }}" method="POST" id="myForm">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Tên chủ tài khoản</label>
                        <input type="text" name="card_name" value="{{ $getCardDefault->card_name }}"
                            {{ empty($getCardDefault->card_name) ? '' : 'readonly' }} class="form-control"
                            id="exampleFormControlInput1" placeholder="Đà Nẵng">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput2">Tên ngân hàng</label>
                        <input type="text" name="bank" value="{{ $getCardDefault->bank }}"
                            {{ empty($getCardDefault->bank) ? '' : 'readonly' }} class="form-control"
                            id="exampleFormControlInput2" placeholder="Đà Nẵng">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput3">Số tài khoản</label>
                        <input type="text" name="card_number" value="{{ $getCardDefault->card_number }}"
                            {{ empty($getCardDefault->card_number) ? '' : 'readonly' }} class="form-control"
                            id="exampleFormControlInput3" placeholder="Đà Nẵng">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput4">Số tiền</label>
                        <input type="text" class="form-control" id="price_number"
                            placeholder="Nhập số tiền cần rút">
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        <input type="hidden" name="total" id="total">
                    </div>
                    <button onclick="submitForm()" class="btn bg-orange text-white d-flex mx-auto">Gửi yêu cầu</button>
                </form>
            </div>
        </div>
        <div id="myModal" class="modal">
            <div class="modal-content">
                <p>Bạn vừa thực hiện lệnh rút tiền về tk <br> Số tiền sẽ được ghi nhận sau 24h vui lòng đợi
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
            console.log(value);
            var formattedValue = numeral(value).format('0,0');
            myInput.value = formattedValue;
            $('#total').val(numeral(formattedValue).value());
        });

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
        });
    </script>
@endsection
