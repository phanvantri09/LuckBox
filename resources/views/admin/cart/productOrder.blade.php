@extends('admin.index')
@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <style>
        .cover-image {
            width: 200px;
            position: relative;
        }

        .cover-image img {
            width: 100%;
            height: auto;
        }
    </style>
@endsection
@section('content')
    <div class="m-3 border-top ">

        <!-- info row -->
        @foreach ($products as $data)
            <div class="row invoice-info justify-content-between border-bottom">
                <h4>
                    <i class="fas fa-pen"></i> Tên sản phẩm: {{ old('title', $data->title) }} <br>
                    <small class="float-right"><span>Ngày tạo: {{ old('title', $data->created_at) }}</span> <br>
                        Ngày sửa: {{ old('title', $data->updated_at) }}</small>
                </h4>
                <div class="invoice-col">

                    <br>
                    <b>Mã sản phẩm:</b> {{ old('id', $data->id) }}<br>
                    {{-- <b>Loại:</b> {{$data->category->title}}<br> --}}
                    <b>Số lượng:</b> {{ number_format($data->amount) }}<br>
                    <b>Giá tiền | VNĐ:</b> {{ number_format($data->price) }} vnđ<br>
                    {{-- <b>Tạo bởi:</b> {{$data->userCreated->email}}<br> --}}
                    {{-- <b>Sửa bởi:</b> {{$data->userUpdated->email}} --}}
                    <b>Mô tả sản phẩm:</b> {{ $data->description ?? null }}
                </div>
                <div class="mt-4">
                    <h3>Ảnh chính hiển thị</h3>
                    @if (!empty($data->link_image))
                        <div class="d-flex flex-row">
                            <img style="width: 200px;height: 200px; object-fit: cover;" class="rounded"
                                src="{{ \App\Helpers\ConstCommon::getLinkImageToStorage($data->link_image) }}">
                        </div>
                    @else
                        <p>Chưa có ảnh</p>
                    @endif
                </div>
                <!-- /.col -->
            </div>
        @endforeach

        <!-- /.row -->
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
