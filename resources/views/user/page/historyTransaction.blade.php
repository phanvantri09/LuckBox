@extends('user.layout.index')
@section('css')
@endsection
@section('content')
    <div class="bg-white text-orange title-page">
        <div class="container">
            <p>LuckyBox | Lịch sử giao dịch</p>
        </div>
    </div>
    <div class="content-container py-4">
        <div class="container my-lg-2 my-0 bg-white py-4">
            <table class="table table-bordered table-hover">
                <thead class="bg-orange text-white">
                    <tr>
                        <th>STT</th>
                        <th>Loại giao dịch</th>
                        <th>Số tiền</th>
                        <th>Thời gian</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Nạp tiền</td>
                        <td>200.000</td>
                        <td>12:00 22/04/2023</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Rút tiền</td>
                        <td>200.000</td>
                        <td>12:00 22/04/2023</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Thanh toán box</td>
                        <td>200.000</td>
                        <td>12:00 22/04/2023</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @endsection
@section('scripts')
@endsection