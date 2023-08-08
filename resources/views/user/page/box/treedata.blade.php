@extends('user.layout.index')
@section('css')
@endsection
@section('content')
    <div class="bg-white text-orange title-page">
        <div class="container">
            <p>LuckyBox | Hoa hồng từ bán box</p>
        </div>
    </div>
    <div class="content-container py-4">
        <div class="container my-lg-2 my-0 bg-white py-4">
            <div class="text-center pb-2">(Đây là danh sách dữ liệu doanh thu của box này)</div>
            <table class="table table-bordered table-hover">
                <thead class="bg-orange text-white">
                    <tr>
                        <th>STT</th>
                        <th>Số tiền</th>
                        <th>Loại</th>
                        <th>Ngày mua</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- 'box', 'number_order', 'dataCart', 'folows' --}}
                    @foreach ($transactions as $key => $transaction)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{number_format($transaction->total)}}</td>
                            <td>{{$transaction->total == 4 ? "Trừ tiền" : "Cộng tiền"}}</td>
                            <td>{{$transaction->created_at}}</td>
                        </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
