@extends('user.layout.index')
@section('css')
@endsection
@section('content')
    <div class="bg-white text-orange title-page">
        <div class="container">
            <p>LuckyBox | Lịch sử giao dịch</p>
        </div>
    </div>
    <div class="content-container py-md-4 py-3">
        <div class="container my-lg-2 my-0 bg-white py-4">
            <table class="table table-bordered table-hover">
                <thead class="bg-orange text-white">
                    <tr>
                        <th>Loại giao dịch</th>
                        <th>Số tiền</th>
                        <th>Trạng thái</th>
                        <th>Thời gian</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $key => $data)
                    <tr>
                        <td>{{ \App\Helpers\ConstCommon::TypeTransaction[$data->type] }}</td>
                        <td>
                            @if ($data->type == 1 || ($data->type == 3 && $data->id_cart != null) )
                            -
                            @else
                            +
                            @endif
                            {{number_format($data->total)}} VNĐ</td>
                            @if ($data->status == 1)
                            <td style="background: rgb(114, 170, 192)">
                                <span ><b>Đợi duyệt</b></span>
                            </td>
                            @endif
                            @if ($data->status == 2)
                            <td style="background: rgb(101, 153, 24)">
                                <span ><b>Thành công</b></span>
                            </td>
                            @endif
                            @if ($data->status == 3)
                            <td style="background: rgb(255, 47, 47)">
                                <span ><b>Không thành công</b></span>
                            </td>
                            @endif
                        <td>{{date('H:i:s d-m-Y', strtotime($data->created_at))}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endsection
@section('scripts')
@endsection
