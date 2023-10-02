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
                                <th>Tiêu đề</th>
                                <th>Box</th>
                                <th>Thời gian</th>
                                <th>Thời gian tạo</th>
                                <th>Trạng thái </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($getEvent as $item)
                                @php
                                    $i = $i + 1;
                                @endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>Đang có: {{count($item->boxItem).' box'}}</td>
                                    <td> <b class="">{{ date(' H:i | d-m-Y ', strtotime($item->time_start)) }}</b> <br> <b>{{ date(' H:i | d-m-Y ', strtotime($item->time_end))}}</b></td>
                                    <td> {{ date(' H:i:s - d/m/Y ', strtotime($item->created_at)) }}</td>
                                    @if ($item->status == 1 )
                                    <td class="bg-info text-bold">
                                        Đang đợi lên sàn
                                    </td>
                                    @endif
                                    @if ($item->status == 2 )
                                    <td class="bg-success text-bold">
                                        Đang bán
                                    </td>
                                    @endif
                                    @if ($item->status == 3 )
                                    <td class="bg-warning text-bold">
                                        Kết thúc bán
                                    </td>
                                    @endif
                                    
                                    <td>
                                        <a href="{{route('box.box_event.box_item.add', ['id_box_event' => $item->id])}}"
                                            class="btn btn-app">
                                            <i class="fas fa-book-open"></i> Thêm Box
                                        </a>
                                        <a href="{{route('box.box_event.show',['id' => $item->id])}}"
                                            class="btn btn-app">
                                            <i class="fas fa-book-open"></i> Xem
                                        </a>

                                        <a href="{{route('box.box_event.edit',['id' => $item->id])}}" class="btn btn-app">
                                            <i class="fas fa-edit"></i> Sửa
                                        </a>
                                        <a href="{{route('box.box_event.delete',['id' => $item->id])}}"
                                            onclick="return confirm('Bạn có chắc chắn xóa không?')" class="btn btn-app">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-switch@3.3.4/dist/js/bootstrap-switch.min.js"></script>
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
    <script>
        $(document).ready(function() {
            $('.input-switch').bootstrapSwitch('readonly', true);
            // $('.input-switch').on('switchChange.bootstrapSwitch', function(event, state) {
            //     var status = state ? 1 : 2;
            //     var slideId = $(this).data('slide-id'); // lấy giá trị slide_id từ thuộc tính data-slide-id
            //     $.ajax({
            //         url: "{{ route('box.box_event.changeStatus', ['id' => ':slideId']) }}".replace(':slideId',
            //             slideId), // lấy giá trị thực tế của slideId gán vào id khi người dùng thực hiện yêu cầu ajax
            //         method: "POST",
            //         data: {
            //             _token: "{{ csrf_token() }}",
            //             status: status
            //         },
            //         success: function(response) {
            //             if (response.status == 1) {
            //                 $(this).bootstrapSwitch('state', true);
            //             } else {
            //                 $(this).bootstrapSwitch('state', false);
            //             }
            //         }.bind(this),
            //         error: function(xhr, status, error) {
            //             console.log(error);
            //         }
            //     });
            // });
        });
    </script>

@endsection
