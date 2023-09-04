@extends('admin.index')
@section('css')
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
                    <form action="{{ route('product.addPost') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Tiêu đề</label>
                                    <input type="text" name="title" class="form-control" placeholder="Enter ..."
                                        value="{{ old('title') }}">
                                    @error('title')
                                        <div class="alert alert-danger">{{ $errors->first('title') }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Nội dung</label>
                                    <textarea name="description" rows="3" id="summernote">
                                      </textarea>
                                    @error('description')
                                        <div class="alert alert-danger">{{ $errors->first('description') }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Số lượng</label>
                                    <input type="number" name="amount" class="form-control" placeholder="Enter ..."
                                        value="{{ old('title') }}">
                                    @error('amount')
                                        <div class="alert alert-danger">{{ $errors->first('amount') }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Giá tiền | VNĐ</label>
                                    <input type="number" name="price" class="form-control" placeholder="Enter ..."
                                        value="{{ old('title') }}">
                                    @error('price')
                                        <div class="alert alert-danger">{{ $errors->first('price') }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <!-- select -->
                                <div class="form-group">
                                    <label>Loại</label>
                                    <select name="id_category" class="form-control">
                                        @foreach ($category as $key => $item)
                                            <option value="{{ $item->id }}"> {{ $item->title }}</option>
                                        @endforeach
                                    </select>
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
    <script src="../../plugins/codemirror/codemirror.js"></script>
    <script src="../../plugins/codemirror/mode/css/css.js"></script>
    <script src="../../plugins/codemirror/mode/xml/xml.js"></script>
    <script src="../../plugins/codemirror/mode/htmlmixed/htmlmixed.js"></script>
    <script>
        $(function() {
            // Summernote
            $('#summernote').summernote()

            // CodeMirror
            CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
                mode: "htmlmixed",
                theme: "monokai"
            });
        })
    </script>
@endsection
