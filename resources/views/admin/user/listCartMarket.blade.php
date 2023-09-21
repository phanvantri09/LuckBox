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
                                <th>Số tiền </th>
                                <th>Trạng thái </th>
                                <th>Số lượng </th>
                                <th>Thời gian tạo </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($cart as $key => $item)
                                <tr>
                                    <td>{{ $key +1 }}</td>
                                    <td>{{ number_format($item->price_cart) }} VNĐ</td>
                                    <td>@if ($item->status == 1)
                                        vừa thêm vào và chưa thanh toán
                                    @endif
                                    @if ($item->status == 2)
                                        đã thanh toán chưa mở Hộp
                                    @endif
                                    @if ($item->status == 10)
                                        đăng bán lại
                                    @endif
                                    @if ($item->status == 11)
                                        Giới hạng F30
                                    @endif
                                    @if ($item->status == 3)
                                        đã mở Hộp chưa được user xác nhận giao
                                    @endif
                                    @if ($item->status == 7)
                                        đã xác nhận giao hàng
                                    @endif
                                    @if ($item->status == 4)
                                        admin duyệt đơn để giao hàng
                                    @endif
                                    @if ($item->status == 5)
                                        đã giao thành công
                                    @endif
                                    @if ($item->status == 6)
                                        bị từ chối
                                    @endif</td>
                                    <td>{{ $item->amount }} </td>
                                    <td>{{ $item->created_at }}</td>
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
