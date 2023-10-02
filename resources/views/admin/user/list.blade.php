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
                                <th>Email</th>
                                <th>Tên</th>
                                <th>Số tiền </th>
                                <th>Số điện thoại </th>
                                <th>Người giới thiệu </th>
                                <th>Ngày tạo </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($users as $key => $item)
                                @php
                                    $i = $i + 1;
                                @endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ number_format($item->balance) }} VNĐ</td>
                                    <td>{{ $item->number_phone }}</td>
                                    <td>
                                        @if (!empty($userGTs))
                                            @foreach ($userGTs[$key] as $keyss => $user)
                                                @php
                                                    $lenghtU = count($userGTs[$key]);
                                                @endphp
                                                <div class="border-bottom">
                                                    <b>F{{ $lenghtU - $keyss }} -
                                                        {{ $user->type == 111 ? 'Người dùng' : 'admin' }}</b> <br>
                                                    @if (!empty($user->name))
                                                        Tên: {{ $user->name }} <br>
                                                    @endif
                                                    @if (!empty($user->email))
                                                        Email: {{ $user->email }}<br>
                                                    @endif
                                                    @if (!empty($user->number_phone))
                                                        Số điện thoại: {{ $user->number_phone }}
                                                    @endif
                                                </div>
                                            @endforeach
                                        @endif

                                        {{-- @php
                                            $user = null;
                                            if (!empty($item->id_user_referral)) {
                                                $user = Auth::user()->find($item->id_user_referral);
                                            }
                                        @endphp --}}

                                    </td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        <a href="{{ route('user.show', ['id' => $item->id]) }}" class="btn btn-app">
                                            <i class="fas fa-book-open"></i> Xem thông tin
                                        </a>

                                        @if ($item->type != 222)
                                            <a href="{{ route('user.transaction', ['id' => $item->id]) }}"
                                                class="btn btn-app">
                                                <i class="fas fa-money-bill-alt"></i> Lịch sử giao dịch
                                            </a>
                                        @endif
                                        <a href="{{ route('user.edit', ['id' => $item->id]) }}" class="btn btn-app">
                                            <i class="fas fa-edit"></i> Sửa
                                        </a>
                                        <a href="{{ route('user.delete', ['id' => $item->id]) }}"
                                            onclick="return confirm('Bạn có chắc chắn xóa không?')" class="btn btn-app">
                                            <i class="fas fa-trash-alt"></i>Xóa
                                        </a>
                                        <a href="{{ route('user.listCartMarket', ['id' => $item->id]) }}"
                                            class="btn btn-app"> <i class="fas fa-box-open"></i>
                                            Các hộp hiện có
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
