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
                                <th>Tiêu đề</th>
                                {{-- <th>Loại </th> --}}
                                <th>Số tiền </th>
                                <th>Hình ảnh</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $products->title }}</td>
                                {{-- <td>{!! $products->description !!}</td> --}}
                                <td>{{ number_format($cart->price_cart) }} vnđ</td>
                                <td>
                                    @if (!empty($products->link_image))
                                        <div class="d-flex flex-row">
                                            <img style="width: 200px;height: 200px; object-fit: cover;" class="rounded"
                                                src="{{ \App\Helpers\ConstCommon::getLinkImageToStorage($products->link_image) }}">
                                        </div>
                                    @else
                                        <p>Chưa có ảnh</p>
                                    @endif
                                </td>
                            </tr>

                        </tbody>
                        <div class="card-header d-flex flex-column border pb-2 mb-2">
                            <h2>
                                Thông tin người nhận
                            </h2>
                            <div class="d-flex flex-column">
                                <div>Tên: {{ $bill->name }}</div>
                                <div>Số điện thoại: {{ $bill->number_phone }}</div>
                                <div>Địa chỉ nhận hàng: {{ $bill->address }}</div>
                            </div>

                        </div>
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
