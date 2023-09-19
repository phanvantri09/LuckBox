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
                <form action="{{route('box.box_event.editPost',['id' =>$getEvent->id])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="inputName">Tiêu đề</label>
                        <input type="text" name="title" id="inputName" value="{{$getEvent->title}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="inputDescription">Mô tả</label>
                        <textarea id="summernote" name="description" class="form-control" rows="4">{{$getEvent->description}}</textarea>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                                <label class="form-label" for="customFile">Hình ảnh</label>
                                <input type="file" name="link_image" class="form-control-file border rounded px-1 py-1" id="image-input" accept="image/*">
                                <img id="preview-image" 
                                    src="" alt="Preview" style="display: none; height:100px;">                          
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="timeStart">Ngày bắt đầu</label>
                            <div class="input-group date"  data-target-input="nearest">
                                <input type="datetime-local" name="time_start" class="form-control"
                                    data-target="" value="{{$getEvent->time_start}}" />

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="timeEnd">Ngày kết thúc</label>
                            <div class="input-group date" id="" data-target-input="nearest">
                                <input type="datetime-local" name="time_end" class="form-control "
                                    data-target="" value="{{$getEvent->time_end}}" />

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <!-- select -->
                        <div class="form-group">
                            <label>Trạng thái</label>
                            <select name="status" class="form-control">
                                <option value="1" {{ $getEvent->status == 1 ? "selected" : "" }}> Đang đợi bán</option>
                                <option value="2" {{ $getEvent->status == 2 ? "selected" : "" }}> Đang bán </option>
                                <option value="3" {{ $getEvent->status == 3 ? "selected" : "" }}> Hết hạn bán</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <!-- select -->
                        <div class="form-group">
                            <label>Loại</label>
                            <select name="id_category" class="form-control">
                                @foreach ($category as $key => $item)
                                    <option value="{{ $item->id }}" {{ $item->id == $getEvent->id_category ? "selected" : "" }}> {{ $item->title }}</option>
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
        -- <script>
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

    @endsection
