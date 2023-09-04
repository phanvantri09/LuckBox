@extends('admin.index')
@section('css')
    <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-warning">
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
                    <form action="{{ route('box.box_product.addPost',['id_box'=>$id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Sản phẩm</label>
                                    <select name="products[]" id="mySelect" class="select2" multiple="multiple" data-placeholder="Nhập tiên sản phẩm" style="width: 100%;">
                                        @foreach($optionsProducts as $option)
                                            <option value="{{ $option['id'] }}">{{ $option['title'] }}</option>
                                        @endforeach
                                    </select>
                                    @error('products')
                                    <div class="alert alert-danger">{{ $errors->first('products') }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <h3>Các sản phẩm đang có trong box</h3>
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>stt</th>
                                        <th>Tiêu đề</th>
                                        <th>Nội dung</th>
                                        <th>Loại </th>
                                        <th>Số tiền </th>
                                        <th>Số lượng </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($product->boxProducts as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{$item->product->title}}</td>
                                            <td>{!! $item->product->description !!}</td>
                                            <td>{{$item->product->category->title}}</td>
                                            <td>{{number_format($item->product->price) }} vnđ</td>
                                            <td>{{number_format($item->product->amount)}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Lưu lại</button>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="../../plugins/select2/js/select2.full.min.js"></script>
    <script>
        $(function () {
            $('#mySelect').select2();
        });
    </script>
@endsection
