@extends('user.layout.index')
@section('css')
@endsection
@section('content')
    <div class="bg-white text-orange title-page">
        <div class="container">
            <p>LuckyBox | Danh sách người dùng bạn giới thiệu</p>
        </div>
    </div>
    <div class="content-container py-md-4 py-3">
        <div class="container my-lg-2 my-0 bg-white py-4">
            <table class="table table-bordered table-hover">
                <thead class="bg-orange text-white">
                    <tr>
                        <th>Thông tin</th>
                        <th>Thời gian kích hoạt</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $key => $data)
                        <tr>
                            <td>
                                @if (!empty($data->name))
                                    Tên: {{ $data->name }} <br>
                                @endif
                                @if (!empty($data->email))
                                    Email: {{ $data->email }}<br>
                                @endif
                                @if (!empty($data->number_phone))
                                    Số điện thoại: {{ $data->number_phone }}
                                @endif
                                {{-- {{ empty($data->name) ? (empty($data->number_phone) ? $data->email : $data->number_phone) : $data->name }} --}}
                            </td>
                            <td>{{ date('H:i:s d-m-Y', strtotime($data->created_at)) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
