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
    <div class="m-3">
        <!-- title row -->
        <div class="row">
            <div class="col-12">
                <h4>
                    <i class="fas fa-pen"></i> Tên sản phẩm: {{old('title', $data->title)}}
                    <small class="float-right"><span>Ngày tạo: {{old('title', $data->created_at)}}</span> - Ngày sửa: {{old('title', $data->updated_at)}}</small>
                </h4>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                <br>
                <b>Mã sản phẩm:</b> {{old('id', $data->id)}}<br>
                <b>Loại:</b> {{$data->category->title}}<br>
                <b>Số lượng:</b> {{number_format($data->amount) }}<br>
                <b>Giá tiền | VNĐ:</b> {{number_format($data->price) }} vnđ<br>
                <b>Tạo bởi:</b> {{$data->userCreated->email ?? 'User tạo box này đã bị xóa'}}<br>
                <b>Sửa bởi:</b> {{$data->userUpdated->email ?? 'User tạo box này đã bị xóa'}}
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="mt-4">
            <h3>Ảnh chính hiển thị</h3>
            @if($getAllByIDProductMain)
            <div class="d-flex flex-row">
                <img style="width: 200px;height: 200px; object-fit: cover;" class="rounded" src="{{\App\Helpers\ConstCommon::getLinkImageToStorage( $getAllByIDProductMain['link_image'] ?? null)}}">
                <div class="ml-3 d-flex align-items-center">
                    <a href="{{ route('product.deleteImage', ['id'=> $getAllByIDProductMain['id']]) }}" type="button" class="btn btn-outline-danger btn-block btn-sm"><i class="fa fa-book"></i> Xóa ảnh</a>
                </div>
            </div>
            @else
                <p>Chưa có ảnh</p>
            @endif
        </div>
        <div class="mt-4">
            <h3>Ảnh slide</h3>
            @if($getAllByIDProductSlide)
            <div class="d-flex flex-row">
                <img style="width: 200px;height: 200px; object-fit: cover;" class="rounded" src="{{\App\Helpers\ConstCommon::getLinkImageToStorage( $getAllByIDProductSlide['link_image'] ?? null)}}">
                <div class="ml-3 d-flex align-items-center">
                    <a href="{{ route('product.deleteImage', ['id'=> $getAllByIDProductSlide['id']]) }}" type="button" class="btn btn-outline-danger btn-block btn-sm"><i class="fa fa-book"></i> Xóa ảnh</a>
                </div>
            </div>
            @else
            <p>Chưa có ảnh</p>
            @endif
        </div>
        <div class="mt-4">
            <h3>Ảnh thành phần</h3>
            @if(count($getAllByIDProductItem))
            @foreach ($getAllByIDProductItem as $key => $item)
                <div class="d-flex flex-row mb-3">
                    <img style="width: 200px;height: 200px; object-fit: cover;" class="rounded" src="{{\App\Helpers\ConstCommon::getLinkImageToStorage( $item->link_image ?? null)}}">
                    <div class="ml-3 d-flex align-items-center">
                        <a href="{{ route('product.deleteImage', ['id'=>$item->id]) }}" type="button" class="btn btn-outline-danger btn-block btn-sm"><i class="fa fa-book"></i> Xóa ảnh</a>
                    </div>
                </div>
            @endforeach
            @else
                <p>Chưa có ảnh</p>
            @endif
        </div>
        <div class="mt-4">
            <h3>Mô tả</h3>
            <div>
                {!! empty(old('description')) ? $data->description : old('description') !!}
            </div>
        </div>
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
