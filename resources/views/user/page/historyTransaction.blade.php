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
                        <th>STT</th>
                        <th>Loại giao dịch</th>
                        <th>Số tiền</th>
                        <th>Thời gian</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $key => $data)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ \App\Helpers\ConstCommon::TypeTransaction[$data->type] }}</td>
                        <td>{{number_format($data->total)}} VNĐ</td>
                        <td>{{$data->created_at}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endsection
@section('scripts')
@endsection
