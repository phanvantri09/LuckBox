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
                    <i class="fas fa-pen"></i> Tên box: {{old('title', $data->title)}}
                    <small class="float-right"><span>Ngày tạo: {{old('title', $data->created_at)}}</span> - Ngày sửa: {{old('title', $data->updated_at)}}</small>
                </h4>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                <br>
                <b>Mã box:</b> {{old('id', $data->id)}}<br>
                <b>Loại:</b> {{$data->category->title}}<br>
                <b>Số lượng:</b> {{number_format($data->amount) }}<br>
                <b>Giá tiền | VNĐ:</b> {{number_format($data->price) }} vnđ<br>
                <b>Tạo bởi:</b> {{$data->userCreated->email ?? 'User tạo box này đã bị xóa'}}<br>
                <b>Sửa bởi:</b> {{$data->userUpdated->email ?? 'User tạo box này đã bị xóa'}}
            </div>
            <div class="col-sm-4 invoice-col">
                <div class="cover-image">
                    <img src="{{\App\Helpers\ConstCommon::getLinkImageToStorage($data->link_image)}}" alt="Cover Image">
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="mt-4">
            <h3>Mô tả</h3>
            <div>
                {!! empty(old('description')) ? $data->description : old('description') !!}
            </div>
        </div>
        <!-- Table row -->
        <div class="row mt-4">
            <h3>Sản phẩm</h3>
            @error('errStatus')
            <div class="alert alert-danger">{{ $errors->first('errStatus') }}</div>
            @enderror
            <div class="col-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>stt</th>
                        <th>Tiêu đề</th>
                        <th>Nội dung</th>
                        <th>Loại </th>
                        <th>Trạng thái </th>
                        <th>Số tiền </th>
                        <th>Số lượng </th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($product->boxProducts as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{$item->product->title}}</td>
                        <td>{!! $item->product->description !!}</td>
                        <td>{{$item->product->category->title}}</td>
                        <td>{{$item->status == 2 ? 'Không được chọn' : 'Được chọn'}}</td>
                        <td>{{number_format($item->product->price) }} vnđ</td>
                        <td>{{number_format($item->product->amount)}}</td>
                        <td>
                            <a  href="{{ route('box.box_product.changeStatus', ['id'=>$item->id]) }}" class="btn btn-app">
                                <i class="fas fa-edit"></i> Thay đổi trạng thái
                            </a>
                            <a href="{{ route('box.box_product.delete', ['id'=>$item->id]) }}" class="btn btn-app">
                                <i class="fas fa-trash-alt"></i> Xóa
                            </a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
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
