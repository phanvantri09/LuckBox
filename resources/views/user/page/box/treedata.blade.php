@extends('user.layout.index')
@section('css')
@endsection
@section('content')
    <div class="bg-white text-orange title-page">
        <div class="container">
            <p>LuckyBox | Danh sách người mua box</p>
        </div>
    </div>
    <div class="content-container py-4">
        <div class="container my-lg-2 my-0 bg-white py-4">
            <div class="text-center pb-2">(Đây là danh sách dữ liệu doanh thu của box này)</div>
            <table class="table table-bordered table-hover">
                <thead class="bg-orange text-white">
                    <tr>
                        <th>STT</th>
                        <th>Số tiền thưởng</th>
                        <th>Người mua</th>
                        <th>Ngày mua</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>1.000.000</td>
                        <td>Nguyễn văn A</td>
                        <td>22/04/2023</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>1.000.000</td>
                        <td>Moe</td>
                        <td>22/04/2023</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>1.000.000</td>
                        <td>Dooley</td>
                        <td>22/04/2023</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
