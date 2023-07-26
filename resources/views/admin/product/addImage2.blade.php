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
                    <form action="{{ route('product.addImagePost', ['id'=>$id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- select -->
                                <div class="form-group">
                                    <label>Ảnh chính hiển thị</label>
                                    <div class="custom-file">
                                        <input name="imageMain" type="file" class="custom-file-input" id="inputFileImageMain">
                                        <label class="custom-file-label" for="inputFileImageMain">Chọn ảnh</label>
                                    </div>
                                    @error('imageMain')
                                    <div class="alert alert-danger">{{ $errors->first('imageMain') }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <!-- select -->
                                <div class="form-group">
                                    <label>Ảnh slide</label>
                                    <div class="custom-file">
                                        <input name="imageSlide" type="file" class="custom-file-input" id="inputFileImageSlide">
                                        <label class="custom-file-label" for="inputFileImageSlide">Chọn ảnh</label>
                                    </div>
                                    @error('imageSlide')
                                    <div class="alert alert-danger">{{ $errors->first('imageSlide') }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <!-- select -->
                                <div class="form-group">
                                    <label>Ảnh thành phần</label>
                                    <div class="custom-file">
                                        <input  multiple="" name="imageItem[]" type="file" class="custom-file-input" id="inputFileImageItem">
                                        <label class="custom-file-label" for="inputFileImageItem">Chọn ảnh</label>
                                    </div>
                                    @error('imageItem')
                                    <div class="alert alert-danger">{{ $errors->first('imageItem') }}</div>
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
