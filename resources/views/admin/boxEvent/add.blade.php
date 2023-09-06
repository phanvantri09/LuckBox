@extends('admin.index')
@section('css')
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Event</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('box.box_event.addPost') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="inputName">Tiêu đề</label>
                        <input type="text" name="title" id="inputName" class="form-control"
                            value="{{ old('title') }}">
                        @error('title')
                            <div class="alert alert-danger">{{ $errors->first('title') }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="inputDescription">Mô tả</label>
                        <textarea id="summernote" name="description" class="form-control" rows="4">{{ old('time_start') }}</textarea>
                        @error('description')
                            <div class="alert alert-danger">{{ $errors->first('description') }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="customFile">Hình ảnh</label>
                            <input type="file" name="link_image" class="form-control-file border rounded px-1 py-1"
                                id="image-input" accept="image/*">
                            <img id="preview-image" src="" alt="Preview" style="display: none; height:100px;">
                            @error('link_image')
                                <div class="alert alert-danger">{{ $errors->first('link_image') }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="timeStart">Ngày bắt đầu</label>
                            <div class="input-group" id="" data-target-input="nearest">
                                <input type="datetime-local" name="time_start" class="form-control "
                                    value="{{ old('time_start') }}" data-target="" />
                            </div>
                            @error('time_start')
                                <div class="alert alert-danger">{{ $errors->first('time_start') }}</div>
                            @enderror
                            @if ($errors->any())
                                <div class="alert alert-danger">{{ $errors->first() }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="timeEnd">Ngày kết thúc</label>
                            <div class="input-group " id="" data-target-input="nearest">
                                <input type="datetime-local" name="time_end" class="form-control"
                                    value="{{ old('time_end') }}" data-target="" />

                            </div>
                            @error('time_end')
                                <div class="alert alert-danger">{{ $errors->first('time_end') }}</div>
                            @enderror
                            @if ($errors->any())
                                <div class="alert alert-danger">{{ $errors->first() }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
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

                    <div class="row">
                        <div class="col-12">
                            <input type="submit" value="Lưu" class="btn btn-success float-right">
                        </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    </div>
@endsection
@section('scripts')
    <script src="../../plugins/codemirror/codemirror.js"></script>
    <script src="../../plugins/codemirror/mode/css/css.js"></script>
    <script src="../../plugins/codemirror/mode/xml/xml.js"></script>
    <script src="../../plugins/codemirror/mode/htmlmixed/htmlmixed.js"></script>
    <script>
        document.getElementById('image-input').addEventListener('change', function(event) {
            var input = event.target;

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    var previewImage = document.getElementById('preview-image');

                    // Hiển thị hình ảnh xem trước
                    previewImage.src = e.target.result;
                    previewImage.style.display = 'block';
                };

                reader.readAsDataURL(input.files[0]);
            }
        });
    </script>
    //
    <script type="text/javascript">
        //     $(function() {
        //         $('#datetimepicker7').datetimepicker();
        //         $('#datetimepicker8').datetimepicker({
        //             useCurrent: false
        //         });
        //         $("#datetimepicker7").on("change.datetimepicker", function(e) {
        //             $('#datetimepicker8').datetimepicker('minDate', e.date);
        //         });
        //         $("#datetimepicker8").on("change.datetimepicker", function(e) {
        //             $('#datetimepicker7').datetimepicker('maxDate', e.date);
        //         });
        //     });
        //
    </script>
@endsection
