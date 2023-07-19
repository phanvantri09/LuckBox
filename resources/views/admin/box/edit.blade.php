@extends('admin.index')
@section('css')
    <link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.min.css">
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">
                        @isset($title)
                            {{ $title }}
                        @else
                            Chưa có tiêu đề cho trang này
                        @endisset
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ route('box.editPost',['id'=>$data->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Tiêu đề</label>
                                    <input type="text" name="title" class="form-control" placeholder="Nhập tiêu đề..." value="{{old('title', $data->title)}}">
                                    @error('title')
                                    <div class="alert alert-danger">{{ $errors->first('title') }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Số lượng</label>
                                    <input type="number" name="amount" class="form-control" placeholder="Nhập số lượng..." value="{{old('amount', $data->amount)}}">
                                    @error('amount')
                                        <div class="alert alert-danger">{{ $errors->first('amount') }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Giá tiền | VNĐ</label>
                                    <input type="text" name="price" class="form-control" placeholder="Nhập số tiền..." value="{{old('price', $data->price)}}">
                                    @error('price')
                                        <div class="alert alert-danger">{{ $errors->first('price') }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <!-- select -->
                                <div class="form-group">
                                    <label>Loại</label>
                                    <select name="id_category" class="form-control">
                                        @foreach ($category as $key => $item)
                                            <option {{ $item->id == $data->category_id ? 'selected':'' }} value="{{ $item->id }}"> {{ $item->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_category')
                                    <div class="alert alert-danger">{{ $errors->first('id_category') }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <!-- select -->
                                <div class="form-group">
                                    <label>Ảnh</label>
                                    <div class="custom-file">
                                        <input name="image" type="file" class="custom-file-input" id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">Chọn ảnh</label>
                                    </div>
                                    @error('image')
                                    <div class="alert alert-danger">{{ $errors->first('image') }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <!-- select -->
                                <div class="form-group">
                                    <label>Mô tả</label>
                                    <textarea name="description" rows="3" id="summernoteDescription">
                                        {{empty(old('description')) ? $data->description : old('description')}}
                                      </textarea>
                                    @error('description')
                                    <div class="alert alert-danger">{{ $errors->first('description') }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

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
    <script src="../../plugins/summernote/summernote-bs4.min.js"></script>
    <script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script>
        $(function () {
            bsCustomFileInput.init();
        });
        $(function () {
            // Summernote
            $('#summernoteDescription').summernote()
        })
    </script>
@endsection
