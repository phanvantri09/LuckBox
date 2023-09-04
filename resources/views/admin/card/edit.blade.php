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
                    <form action="{{ route('card.editPost',['id'=>$data->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Tên người dùng thẻ</label>
                                    <input type="text" name="card_name" class="form-control" placeholder="Nhập chi nhánh mở thẻ..." value="{{old('card_name', $data->card_name)}}">
                                    @error('card_name')
                                    <div class="alert alert-danger">{{ $errors->first('card_name') }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Chi nhánh mở thẻ</label>
                                    <input type="text" name="card_branch" class="form-control" placeholder="Nhập chi nhánh mở thẻ..." value="{{old('card_branch', $data->card_branch)}}">
                                    @error('card_branch')
                                    <div class="alert alert-danger">{{ $errors->first('card_branch') }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Số tài khoản mở thẻ</label>
                                    <input type="number" name="card_number" class="form-control" placeholder="Nhập số tài khoản mở thẻ..." value="{{old('card_number', $data->card_number)}}">
                                    @error('card_number')
                                    <div class="alert alert-danger">{{ $errors->first('card_number') }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Trạng thái</label>
                                    <select name="status" class="form-control">
                                        @foreach (\App\Helpers\ConstCommon::TypeCard as $key => $item)
                                            <option {{ $item == $data->status ? 'selected':'' }} value="{{ $item }}"> {{ $key }}</option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                    <div class="alert alert-danger">{{ $errors->first('status') }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <!-- select -->
                                <div class="form-group">
                                    <label>Ảnh QR code</label>
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
                                    <label>Ngân hàng</label>
                                    <select name="bank" class="form-control select2bs4" style="width: 100%;">
                                        @foreach ($banks as $key => $item)
                                            <option {{ $key == $data->bank ? 'selected':'' }} value="{{ $key }}" data-thumbnail="{{ $item['image'] }}">{{ $item['name'] }}</option>
                                        @endforeach
                                    </select>
                                    @error('bank')
                                    <div class="alert alert-danger">{{ $errors->first('bank') }}</div>
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
    <script src="../../plugins/select2/js/select2.full.min.js"></script>
    <script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script>
        $(function () {
            bsCustomFileInput.init();
            $('.select2bs4').select2({
                theme: 'bootstrap4',
                templateResult: formatState,
                templateSelection: formatState
            })
            function formatState (opt) {
                if (!opt.id) {
                    return opt.text.toUpperCase();
                }
                const BASE_URL = $('base[ href ]').attr('href');

                var optimage = $(opt.element).attr('data-thumbnail');
                console.log(optimage)
                if(!optimage){
                    return opt.text.toUpperCase();
                } else {
                    var $opt = $(
                        '<span><img src="' + BASE_URL +  optimage + '" width="20px" /> ' + opt.text + '</span>'
                    );
                    return $opt;
                }
            }
        });
    </script>
@endsection
