@extends('user.layout.index')
@section('css')
@endsection
@section('content')
    <div class="bg-white text-orange title-page">
        <div class="container">
            <p>LuckyBox | Hoa hồng từ bán box</p>
        </div>
    </div>
    <div class="content-container py-md-4 py-3">
        <div class="container my-lg-2 my-0 bg-white py-4">
            <div class="text-center pb-2">(Đây là danh sách dữ liệu doanh thu của bạn)</div>
            <table class="table table-bordered table-hover">
                <thead class="bg-orange text-white">
                    <tr>
                        <th>Loại</th>
                        <th>Số tiền</th>
                        <th>F</th>
                        <th>Thời gian</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- 'box', 'number_order', 'dataCart', 'folows' --}}
                    @foreach ($transactions as $key => $transaction)
                        <tr>
                            <td>
                                {{-- @if ($transaction->type == 1 || ($transaction->type == 3 && $transaction->id_cart != null) )
                                Trừ tiền
                                @else
                                Cộng tiền
                                @endif --}}
                                Hoa hồng bán box
                                </td>
                            <td>+{{number_format($transaction->total)}}</td>
                            <td><b>F{{$transaction->folow}}</b> </td>
                            <td>{{date('H:i:s d-m-Y', strtotime($transaction->created_at))}}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
