@extends('admin.index')
@section('css')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- About Me Box -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Thông tin chi tiết về sự kiện</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <strong><i class=""></i> Tiêu đề</strong>
                    <p class="text-muted">
                        {{ $showEvent->title }}
                    </p>

                    <hr>

                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Ngày bắt đầu</strong>

                    <p class="text-muted">
                        {{$showEvent->time_start}}
                    </p>

                    <hr>

                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Ngày kết thúc</strong>

                    <p class="text-muted">
                        {{$showEvent->time_end}}
                    </p>

                    <hr>

                    <strong><i class="far fa-file-alt mr-1"></i> Mô tả</strong>

                    <p class="text-muted">
                        {!!$showEvent->description!!}
                    </p>

                    <hr>

                    <strong><i class="far fa-file-alt mr-1"></i> Hình ảnh</strong>
                    <p>
                        <img src="{{\App\Helpers\ConstCommon::getLinkImageToStorage($showEvent->link_image)}}" alt="">
                    </p>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <!-- /.content -->
@endsection
@section('scripts')
@endsection
