@extends('admin.index')
@section('css')
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Sửa Box Item</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('box.box_event.box_item.editPost', ['id' => $getBoxItem->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Chọn Box</label>
                            <select name="id_box" class="form-control select2" style="width: 100%;">
                                <option selected="selected">Chọn Box cho Event này</option>

                                @foreach ($getBox as $item)
                                    @if ($getBoxItem->id_box == $item->id)
                                        <option selected value="{{ $item->id }}">{{ $item->title }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="timeStart">Số lượng box</label>
                            <div class="input-group date">
                                <input type="number" name="amount" class="form-control" value="{{ $getBoxItem->amount ?? null }}" />
                                @error('amount')
                                    <div class="alert alert-danger">{{ $errors->first('amount') }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="timeStart">Ngày bắt đầu</label>
                            <div class="input-group date" id="datetimepicker7" data-target-input="nearest">
                                <input type="text" name="time_start" class="form-control datetimepicker-input"
                                    data-target="#datetimepicker7"  value="{{$getBoxItem->time_start}}"/>
                                <div class="input-group-append" data-target="#datetimepicker7" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                                @error('time_start')
                                    <div class="alert alert-danger">{{ $errors->first('time_start') }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="timeEnd">Ngày kết thúc</label>
                            <div class="input-group date" id="datetimepicker8" data-target-input="nearest">
                                <input type="text" name="time_end" class="form-control datetimepicker-input"
                                    data-target="#datetimepicker8" value="{{$getBoxItem->time_end}}" />
                                <div class="input-group-append" data-target="#datetimepicker8" data-toggle="datetimepicker">
                                    <div class="input-group-text" ><i class="fa fa-calendar"></i></div>
                                </div>
                                @error('time_end')
                                    <div class="alert alert-danger">{{ $errors->first('time_end') }}</div>
                                @enderror
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
    <!-- Select2 -->
    <script src="../../plugins/select2/js/select2.full.min.js"></script>

    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

        })
    </script>
    <script type="text/javascript">
        $(function() {
            $('#datetimepicker7').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss'
            });
            $('#datetimepicker8').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss',
                useCurrent: false
            });
            $("#datetimepicker7").on("change.datetimepicker", function(e) {
                $('#datetimepicker8').datetimepicker('minDate', e.date);
            });
            $("#datetimepicker8").on("change.datetimepicker", function(e) {
                $('#datetimepicker7').datetimepicker('maxDate', e.date);
            });
        });
    </script>
@endsection
