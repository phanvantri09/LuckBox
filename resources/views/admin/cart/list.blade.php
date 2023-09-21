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
                                <th>Box</th>
                                <th>Thông tin đặt hàng</th>
                                <th>Số lượng</th>
                                <th>Thời gian mua hàng</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-start">
                                            <span>Tên: {{ $item->name }}</span>
                                            <span>Email: {{ $item->email }}</span>
                                            @if ($item->status != 2)
                                                <span>Số Điện thoại: {{ $item->number_phone }}</span>
                                                <span>Địa chỉ nhận hàng: {{ $item->address }}</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-start">
                                            <span>Số lượng: {{  $item->amount  }}</span>
                                            <span>Tổng tiền: {{number_format(($item->amount * $item->price_cart))}} VNĐ</span>
                                        </div>
                                    </td>
                                    <td>{{ $item->created_at }}</td>
                                    @if ($item->status != 5)
                                        <td>
                                            @if ($item->status != 2)
                                                <a href="{{ route('cart.productChoeseOrder', ['id_cart' => $item->id]) }}"
                                                    class="btn btn-app">
                                                    <i class="fas fa-shopping-basket"></i> Sản phẩm cần giao
                                                </a>
                                            @endif

                                            @if ($item->status == 7)
                                                <a href="{{ route('cart.changeStatus', ['id_cart' => $item->id, 'status' => 4]) }}"
                                                    class="btn btn-app">
                                                    <i class="fas fa-check-square"></i> Duyệt đơn và giao hàng
                                                </a>
                                                <a href="{{ route('cart.changeStatus', ['id_cart' => $item->id, 'status' => 6]) }}"
                                                    class="btn btn-app">
                                                    <i class="fas fa-ban"></i> Từ chối Đơn
                                                </a>

                                            @endif
                                            @if ($item->status == 4)
                                                <a href="{{ route('cart.changeStatus', ['id_cart' => $item->id, 'status' => 5]) }}"
                                                    class="btn btn-app">
                                                    <i class="fas fa-donate"></i> Xác nhận đã giao thành công
                                                </a>
                                            @endif
                                            @if ($item->status == 2)
                                                <a href="{{ route('cart.productOrder', ['id_cart' => $item->id]) }}"
                                                    class="btn btn-app">
                                                    <i class="fas fa-cart-plus"></i> 4 sản phẩm admin chọn
                                                </a>
                                            @endif
                                        </td>
                                    @endif
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
