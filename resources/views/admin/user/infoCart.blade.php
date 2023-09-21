@extends('admin.index')
@section('css')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">

            <!-- Profile Image -->
            {{-- <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" src="{{empty($user->link_image)?asset('/dist/img/noavt.jpg'):\App\Helpers\ConstCommon::getLinkImageToStorage($user->link_image)}}"
                            alt="User profile picture">
                    </div>

                    <h3 class="profile-username text-center">{{$user->name}}</h3>

                    <p class="text-muted text-center">{{$user->birthdate}}</p>

                    <p class="text-muted text-center">Số dư tài khoản: {{ number_format($user->blance).' VNĐ' }}</p>

                    <p class="text-muted text-center">Ngày tạo tài khoản:{{ date('d/m/Y', strtotime($user->created_at)) }}</p>


                </div>
                <!-- /.card-body -->
            </div> --}}
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Thông tin giỏ hàng của giao dịch</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <strong><i class="fas fa-book mr-1"></i> Người tạo</strong>
                    <p class="text-muted">
                        @php
                            $user = Auth::user()->find($cartCurrent->id_user_create);
                        @endphp
                        Tên: {{ $user->name ?? null }} <br>
                        Email: {{ $user->email ?? null }}<br>
                        SĐT:  {{ $user->number_phone ?? null }}
                    </p>
                    <hr>

                    <strong><i class="fas fa-map-marker-alt mr-1"></i>Trạng thái </strong>
                    <p class="text-muted">

                        @if ($cartCurrent->status == 1)
                            vừa thêm vào và chưa thanh toán
                        @endif
                        @if ($cartCurrent->status == 2)
                            đã thanh toán chưa mở Hộp
                        @endif
                        @if ($cartCurrent->status == 10)
                            đăng bán lại
                        @endif
                        @if ($cartCurrent->status == 11)
                            Giới hạng F30
                        @endif
                        @if ($cartCurrent->status == 3)
                            đã mở Hộp chưa được user xác nhận giao
                        @endif
                        @if ($cartCurrent->status == 7)
                            đã xác nhận giao hàng
                        @endif
                        @if ($cartCurrent->status == 4)
                            admin duyệt đơn để giao hàng
                        @endif
                        @if ($cartCurrent->status == 5)
                            đã giao thành công
                        @endif
                        @if ($cartCurrent->status == 6)
                            bị từ chối
                        @endif
                    </p>
                    <hr>
                    <strong><i class="far fa-file-alt mr-1"></i>Số lượng</strong>

                    <p class="text-muted">{{ $cartCurrent->amount }}</p>
                    <hr>

                    <strong><i class="fas fa-tachometer-alt"></i> Thời gian</strong>

                    <p class="text-muted">{{ $cartCurrent->created_at }}</p>
                </div>
                <!-- /.card-body -->
            </div>
            <div class="card">
                <div class="card-header bg-warning">
                    <h3 class="card-title">Thông tin giỏ đăng bán</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <strong><i class="fas fa-book mr-1"></i> Người tạo</strong>
                    <p class="text-muted">
                        @php
                            $userOld = Auth::user()->find($cartOld->id_user_create);
                        @endphp
                        Tên: {{ $userOld->name ?? null }} <br>
                        Email: {{ $userOld->email ?? null }}<br>
                        SĐT: {{ $userOld->number_phone ?? null }}
                    </p>
                    <hr>

                    <strong><i class="fas fa-map-marker-alt mr-1"></i>Trạng thái </strong>
                    <p class="text-muted">
                        @if ($cartOld->status == 1)
                            vừa thêm vào và chưa thanh toán
                        @endif
                        @if ($cartOld->status == 2)
                            đã thanh toán chưa mở Hộp
                        @endif
                        @if ($cartOld->status == 10)
                            đăng bán lại
                        @endif
                        @if ($cartOld->status == 11)
                            Giới hạng F30
                        @endif
                        @if ($cartOld->status == 3)
                            đã mở Hộp chưa được user xác nhận giao
                        @endif
                        @if ($cartOld->status == 7)
                            đã xác nhận giao hàng
                        @endif
                        @if ($cartOld->status == 4)
                            admin duyệt đơn để giao hàng
                        @endif
                        @if ($cartOld->status == 5)
                            đã giao thành công
                        @endif
                        @if ($cartOld->status == 6)
                            bị từ chối
                        @endif
                    </p>
                    <hr>
                    <strong><i class="far fa-file-alt mr-1"></i>Số lượng</strong>

                    <p class="text-muted">{{ $cartOld->amount }}</p>
                    <hr>
                    <strong><i class="fas fa-tachometer-alt"></i> Thời gian</strong>

                    <p class="text-muted">{{ $cartOld->created_at }}</p>
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
