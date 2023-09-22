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
                                <th>Người thực hiện</th>
                                <th>id_cart</th>
                                <th>Loại</th>
                                <th>Trạng thái</th>
                                <th>Số tiền </th>
                                <th>Thời gian tạo </th>
                                <th>Thời gian cập nhật </th>
                                <th>Số dư </th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total = 0;
                                $user = Auth::user()->find($id);
                            @endphp
                            @foreach ($data as $key => $item)
                                <tr>
                                    @php
                                        $cart = [];
                                        if (!empty($item->id_cart)) {
                                            $cart = \App\Helpers\ConstCommon::cartByID( $item->id_cart );
                                        }
                                        $userT = [];
                                        if (!empty($cart)) {
                                            $userT = Auth::user()->find($cart->id_user_create);
                                        }
                                    @endphp
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ empty($userT->name) ? "" : (empty($userT->email) ? $userT->number_phone : $userT->email) }}</td>
                                    <td>{{ $item->id_cart ?? null }}</td>
                                    <td>{{ \App\Helpers\ConstCommon::TypeTransaction[$item->type] }}</td>
                                    @if ($item->status == 1)
                                        <td class="bg-info text-center">Đợi xác nhận</td>
                                    @endif
                                    @if ($item->status == 2)
                                        <td class="bg-success text-center">Thành công</td>
                                    @endif
                                    @if ($item->status == 3)
                                        <td class="bg-danger text-center">Bị từ chối</td>
                                    @endif
                                    <td>
                                        @if ($item->type == 1 || ($item->type == 3 && $item->id_cart != null))
                                            -
                                        @else
                                            +
                                        @endif
                                        {{ number_format($item->total) }}
                                    </td>
                                    <td>
                                        {{ date('H:i:s d-m-Y', strtotime($item->created_at)) }}
                                    </td>
                                    <td>{{ date('H:i:s d-m-Y', strtotime($item->updated_at)) }}</td>

                                    <td>
                                        {{ \App\Helpers\ConstCommon::getTotalTransaction($item->id, $user->balance)}}
                                    </td>
                                    <td>
                                        @if (!empty($item->id_cart) && !empty($item->id_cart_old))
                                        <a href="{{ route('user.transaction.cart', [$item->id_cart, $item->id_cart_old]) }}"
                                            class="btn btn-app">
                                            <i class="fas fa-book-open"></i> Thông tin giỏ
                                        </a>
                                        @endif
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
