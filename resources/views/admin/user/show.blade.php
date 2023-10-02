@extends('admin.index')
@section('css')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" src="{{empty($user->link_image)?asset('/dist/img/noavt.jpg'):\App\Helpers\ConstCommon::getLinkImageToStorage($user->link_image)}}"
                            alt="User profile picture">
                    </div>
                    <h1 class="profile-username text-center">ID: {{$data->id}}_{{$data->code}}</h1>
                    <h3 class="profile-username text-center">Họ tên: {{$data->name ?? $user->name ?? "Chưa cập nhật"}}</h3>

                    {{-- <p class="text-muted text-center">{{$user->birthdate}}</p> --}}

                    <p class="text-muted text-center">Số dư tài khoản: <b class="text-danger">{{ number_format($data->balance).' VNĐ' }}</b></p>

                    {{-- <p class="text-muted text-center">Ngày tạo tài khoản: {{ date('d/m/Y', strtotime($user->created_at)) }}</p> --}}


                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Thông tin chi tiết</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <strong><i class="fas fa-phone"></i> Số điện thoại</strong>

                    <p class="text-muted">
                        {{$data->number_phone ?? 'Chưa có SĐT'}}
                    </p>

                    <hr>
                    <strong><i class="fas fa-envelope"></i></i> Email</strong>

                    <p class="text-muted">
                        {{$data->email ?? 'Chưa có email'}}
                    </p>

                    <hr>
                    <strong><i class="fas fa-map-marker-alt"></i> Địa chỉ</strong>

                    <p class="text-muted">{{$user->house_number_street ?? 'Chưa cập nhật '}}</p>

                    <hr>
                    <strong><i class="fas fa-calendar-week"></i> Ngày sinh</strong>

                    <p class="text-muted"> {{$user->birthdate ?? 'Chưa cập nhật '}}</p>

                    <hr>
                    <strong><i class="fas fa-calendar-alt"></i> Ngày tạo tài khoản:</strong>

                    <p class="text-muted">{{ date('d/m/Y', strtotime($data->created_at)) }}</p>

                    <hr>
                    <strong><i class="fas fa-user-check"></i> Giới thiệu bản thân:</strong>

                    <p class="text-muted">{!! $user->content ?? "Chưa cập nhật" !!}</p>

                    <hr>

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
