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
                        @isset($title)
                            {{ $title }}
                        @else
                            Chưa có tiêu đề cho trang này
                        @endisset
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
                                <th>Trạng thái</th>
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
                                    <td style="
                                    border-radius: 3px;
                                    color: #fff;
                                    background-color: {{ ($item->type == 1 || $item->type == 3 || $item->type == 4 ) ? '#28a745' : 'red' }};
                                ">{{ \App\Helpers\ConstCommon::TypeTransaction[$item->type] }}</td>
                                    </td>
                                    <td>{{ $item->User->email }}</td>
                                    <td>{{ number_format($item->total) }}đ</td>
                                    <td>{{ $item->card_name }}</td>
                                    <td>{{ $item->card_number }}</td>
                                    <td>{{ $item->bank }}</td>
                                    <td>
                                        <form class="status-form"
                                            action="{{route('transaction.changeStatus', ['id' => $item->id,'id_user' => $item->id_user,'type' => $item->type])}}"
                                            method="POST">
                                            @csrf
                                            <select class="status-select form-control" name="status">
                                                <option {{ $item->status == 1 ? 'selected' : '' }} value="1">Vừa mới tạo</option>
                                                <option {{ $item->status == 2 ? 'selected' : '' }} value="2">Thành Công</option>
                                                <option {{ $item->status == 3 ? 'selected' : '' }} value="3">Từ chối</option>
                                            </select>
                                        </form>
                                    </td>


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
            $('.status-select').on('change', function() {
                $(this).closest('form').submit();
            });
        });
    </script>
@endsection
