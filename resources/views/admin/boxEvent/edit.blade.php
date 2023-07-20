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
                            <label for="customFile">Image</label>
                            <div class="custom-file">
                                <input type="file" name="link_image" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Chọn ảnh</label>
                            </div>
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
        {{-- <script>
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
        <script type="text/javascript">
            $(function() {
                $('#datetimepicker7').datetimepicker();
                $('#datetimepicker8').datetimepicker({
                    useCurrent: false
                });
                $("#datetimepicker7").on("change.datetimepicker", function(e) {
                    $('#datetimepicker8').datetimepicker('minDate', e.date);
                });
                $("#datetimepicker8").on("change.datetimepicker", function(e) {
                    $('#datetimepicker7').datetimepicker('maxDate', e.date);
                });
            });
        </script> --}}
    @endsection
