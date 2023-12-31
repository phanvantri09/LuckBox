@extends('user.layout.index')
@section('css')
@endsection
@section('content')
    <div class="bg-white text-orange title-page">
        <div class="container">
            <p>LuckyBox | Sự kiện box</p>
        </div>
    </div>
    <div class="content-container py-md-4 py-3">
        <!-- desktop -->
        <div class="container d-lg-block d-none">
            <div class="row bg-white my-lg-2 my-0 py-2 align-items-center">
                <div class="col-lg-2">Hình ảnh</div>
                <div class="col-lg-2">Tên hộp box</div>
                <div class="col-lg-2">Đơn giá (VND)</div>
                <div class="col-lg-2">Số lượng (hộp)</div>
                <div class="col-lg-2">Thời gian bắt đầu</div>
                <div class="col-lg-2">Thời gian kết thúc</div>
            </div>
            <!-- khung box -->
            @foreach ($getEvent as $key => $item)
            <div class="row bg-white my-lg-3 my-0 py-2 align-items-center">
                <div class="col-lg-2">
                    <img src="{{\App\Helpers\ConstCommon::getLinkImageToStorage($item->boxInfo->link_image)}}" width="75%"
                        height="auto" />
                </div>
                <div class="col-lg-2">{{$item->boxInfo->title}}</div>
                <div class="col-lg-2 font-weight-bold text-danger">{{number_format($item->boxInfo->price)}}</div>
                <div class="col-lg-2 text-info font-weight-bold">{{number_format($item->boxInfo->amount)}}</div>
                <div class="col-lg-2 ">{{date('d/m/Y - H:i', strtotime($item->time_start))}}</div>
                <div class="col-lg-2">{{date('d/m/Y - H:i', strtotime($item->time_end))}}</div>
            </div>
            @endforeach
            <!-- end khung box -->
        </div>
        <!-- end desktop -->

        <!-- mobile -->
        <div class="container d-lg-none d-block">
            <table class="table table-bordered table-hover bg-white table-responsive text-nowrap">
                <thead class="bg-orange text-white">
                    <tr>
                        <th>Hình ảnh</th>
                        <th class="width-100">Tên hộp box</th>
                        <th>Đơn giá (VND)</th>
                        <th>Số lượng (hộp)</th>
                        <th>Thơi gian bắt đầu</th>
                        <th>Thời gian kết thúc</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <img src="https://vn-live-01.slatic.net/p/dbf45cda7d56f7641227a80a5957efdf.jpg" width="100px"
                                height="auto" />
                        </td>
                        <td>Title Title Title Title Title Title Title</td>
                        <td>2.000.000.000</td>
                        <td>2.000.000</td>
                        <td>22/04/2023</td>
                        <td>22/05/2023</td>
                    </tr>
                    <tr>
                        <td>
                            <img src="https://vn-live-01.slatic.net/p/dbf45cda7d56f7641227a80a5957efdf.jpg" width="100px"
                                height="auto" />
                        </td>
                        <td>Title Title Title Title Title Title Title</td>
                        <td>2.000.000.000</td>
                        <td>2.000.000</td>
                        <td>22/04/2023</td>
                        <td>22/05/2023</td>
                    </tr>
                    <tr>
                        <td>
                            <img src="https://vn-live-01.slatic.net/p/dbf45cda7d56f7641227a80a5957efdf.jpg" width="100px"
                                height="auto" />
                        </td>
                        <td>Title Title Title Title Title Title Title</td>
                        <td>2.000.000.000</td>
                        <td>2.000.000</td>
                        <td>22/04/2023</td>
                        <td>22/05/2023</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- end mobile -->
    </div>
@endsection
@section('scripts')
@endsection
