@extends('admin.index')
@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        {{-- @isset($title)
                            {{ $title }}
                        @else
                            Chưa có tiêu đề cho trang này
                        @endisset --}}
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Loại</th>
                                <th>Email</th>
                                <th>Số tiền</th>
                                <th>Chủ tài khoản </th>
                                <th>Số tài khoản</th>
                                <th>Ngân hàng</th>
                                @if (isset($_GET['type']))
                                    @if ($_GET['type'] == 2)
                                        <th>Mã giao dịch</th>
                                        <th>Hình ảnh</th>
                                    @endif
                                @endif
                                <th>Trạng thái</th>
                                <th>Thời gian tạo</th>
                                <th>Thời gian cập nhật</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($getAllTrans as $item)
                                @php
                                    $i = $i + 1;
                                @endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td
                                        style="
                                    border-radius: 3px;
                                    color: #fff;
                                    background-color: {{ $item->type == 1 ? ' red' : '' }}
                                    {{ $item->type == 2 ? 'green' : '' }}
                                    {{ $item->type == 3 ? 'blue' : '' }}
                                    {{ $item->type == 4 ? 'black' : '' }}
                                    {{ $item->type == 5 ? 'orange' : '' }}
                                    {{ $item->type == 6 ? 'gray' : '' }}
                                    ;
                                ">
                                        {{ \App\Helpers\ConstCommon::TypeTransaction[$item->type] }}</td>
                                    </td>
                                    <td>{{ $item->User->email ?? ($item->User->number_phone ?? null) }}</td>
                                    <td>{{ number_format($item->total) }}VNĐ</td>
                                    <td>{{ $item->card_name }}</td>
                                    <td>{{ $item->card_number }}</td>
                                    <td>{{ $item->bank }}</td>
                                    @if (isset($_GET['type']))
                                        @if ($_GET['type'] == 2)
                                            <td><b>{{ $item->code ?? '' }}</b></td>
                                            <td><img style="max-height: 200px; width: auto;"
                                                    src="{{ \App\Helpers\ConstCommon::getLinkImageToStorage($item->link_image) }}"
                                                    alt=""></td>
                                        @endif
                                    @endif
                                    <td>

                                        <div class="btn-group">
                                            <button type="button" class="btn border dropdown-toggle" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                @if ($item->status == 1)
                                                    Vừa tạo
                                                @endif
                                                @if ($item->status == 2)
                                                    Thành Công
                                                @endif
                                                @if ($item->status == 3)
                                                    Từ chối
                                                @endif
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    @if ($item->status != 1) href="{{ route('transaction.changeStatus', ['id' => $item->id, 'id_user' => $item->id_user, 'type' => $item->type, 'status' => 1]) }}" @endif>Vừa
                                                    tạo</a>
                                                <a class="dropdown-item"
                                                    @if ($item->status != 2) href="{{ route('transaction.changeStatus', ['id' => $item->id, 'id_user' => $item->id_user, 'type' => $item->type, 'status' => 2]) }}" @endif>Thành
                                                    Công</a>
                                                <a class="dropdown-item"
                                                    @if ($item->status != 3) href="{{ route('transaction.changeStatus', ['id' => $item->id, 'id_user' => $item->id_user, 'type' => $item->type, 'status' => 3]) }}" @endif>Từ
                                                    chối</a>
                                                <div class="dropdown-divider"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ date('H:i:s d-m-Y', strtotime($item->created_at)) }}</td>
                                    <td>{{ date('H:i:s d-m-Y', strtotime($item->updated_at)) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        {{-- <tfoot>
                            <tr>
                                <th>Rendering engine</th>
                                <th>Browser</th>
                                <th>Platform(s)</th>
                                <th>Engine version</th>
                                <th>CSS grade</th>
                                <th>acttion</th>
                            </tr>
                        </tfoot> --}}
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
@endsection
@section('scripts')
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../../plugins/jszip/jszip.min.js"></script>
    <script src="../../plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../../plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection
