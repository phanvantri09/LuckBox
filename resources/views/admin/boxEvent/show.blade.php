@extends('admin.index')
@section('css')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-3">
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
                        {{ date('H:i - d/m/Y', strtotime($showEvent->time_start)) }}</td>
                    </p>

                    <hr>

                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Ngày kết thúc</strong>

                    <p class="text-muted">
                        {{ date('H:i - d/m/Y', strtotime($showEvent->time_end)) }}
                    </p>

                    <hr>
                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Thời gian tạo</strong>

                    <p class="text-muted">
                        {{ date('H:i - d/m/Y', strtotime($showEvent->created_at)) }}
                    </p>

                    <hr>

                    <strong><i class="far fa-file-alt mr-1"></i> Mô tả</strong>

                    <p class="text-muted">
                        {!! $showEvent->description !!}
                    </p>

                    <hr>

                    <strong><i class="far fa-file-alt mr-1"></i> Hình ảnh</strong>
                    <p>
                        <img style="width: 100%" src="{{ \App\Helpers\ConstCommon::getLinkImageToStorage($showEvent->link_image) }}"
                            alt="">
                    </p>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <div class="col-9">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Thông tin các box trong sự kiện này</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>

                                <th>Tên Box</th>
                                <th>Ngày bắt đầu</th>
                                <th>Ngày kết thúc</th>
                                <th>Thời gian tạo</th>
                                <th>Trạng thái</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataMain as $item)
                                <tr>

                                    <td>{{ $item[1][0]->title }}</td>
                                    <td>{{ date('H:i - d/m/Y', strtotime($item[0]->time_start)) }}</td>
                                    <td>{{ date('H:i - d/m/Y', strtotime($item[0]->time_end)) }}</td>
                                    <td>{{ date('H:i:s - d/m/Y', strtotime($item[0]->created_at)) }}</td>
                                    <td>
                                        <form class="status-form"
                                            action="{{ route('box.box_event.box_item.changeStatus', ['id' => $item[0]->id]) }}"
                                            method="POST">
                                            @csrf
                                            <select class="status-select form-control" name="status">
                                                @if ($item[0]->status == 1)
                                                    <option selected value="1">Đợi lên sàn để bán</option>
                                                    <option value="2">Đang bán</option>
                                                    <option value="3">Hết hạn</option>
                                                @else
                                                    @if ($item[0]->status == 2)
                                                        <option value="1">Đợi lên sàn để bán</option>
                                                        <option selected value="2">Đang bán</option>
                                                        <option value="3">Hết hạn</option>
                                                    @else
                                                        <option value="1">Đợi lên sàn để bán</option>
                                                        <option value="2">Đang bán</option>
                                                        <option selected value="3">Hết hạn</option>
                                                    @endif
                                                @endif

                                            </select>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="{{ route('box.box_event.box_item.edit', ['id' => $item[0]->id]) }}" class="btn btn-app">
                                            <i class="fas fa-edit"></i> Sửa
                                        </a>
                                        <a href="{{ route('box.box_event.box_item.delete', ['id' => $item[0]->id]) }}" onclick="return confirm('Bạn có muốn xóa?')" class="btn btn-app">
                                            <i class="fas fa-trash-alt"></i> Xóa
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
    <script>
        $(function() {
            $('.status-select').on('change', function() {
                $(this).closest('form').submit();
            });
        });
    </script>
@endsection
