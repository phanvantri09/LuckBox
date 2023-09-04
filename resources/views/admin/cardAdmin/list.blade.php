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
                                <th>stt</th>
                                <th>QR code</th>
                                <th>Tên người dùng</th>
                                <th>Số tài khoản</th>
                                <th>Chi nhánh</th>
                                <th>Trạng thái</th>
                                <th>Ngân hàng</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        @if($item->image_ql_code)
                                        <img style="width: 150px;" src="{{\Illuminate\Support\Facades\Storage::url($item->image_ql_code)}}" alt="Cover Image">
                                        @endif
                                    </td>
                                    <td>{{$item->card_name}}</td>
                                    <td>{{$item->card_number}}</td>
                                    <td>{{$item->card_branch}}</td>
                                    <td>{{ array_search($item->status, \App\Helpers\ConstCommon::TypeCard)}}</td>
                                    <td>{{ \App\Helpers\ConstCommon::BankVN[$item->bank]['name'] }}</td>
                                    <td>
                                        <a  href="{{ route('card.editPostStatusAdmin', ['id'=>$item->id]) }}" class="btn btn-app">
                                            <i class="fas fa-edit"></i> Đặt làm <span style="text-transform: lowercase;">{{ array_search(!$item->status, \App\Helpers\ConstCommon::TypeCard)}}</span>
                                        </a>
                                        <a  href="{{ route('card.editAdmin', ['id'=>$item->id]) }}" class="btn btn-app">
                                            <i class="fas fa-edit"></i> Sửa
                                        </a>
                                        <a href="{{ route('card.deleteAdmin', ['id'=>$item->id]) }}" class="btn btn-app">
                                            <i class="fas fa-trash-alt"></i>Xóa
                                        </a>

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
        });
    </script>
@endsection
