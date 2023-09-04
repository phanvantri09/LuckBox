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
                    <form action="{{ route('category.addPost') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Tiêu đề</label>
                                    <input type="text" name="title" class="form-control" placeholder="Enter ..." value="{{old('title')}}">
                                    @error('title')
                                        <div class="alert alert-danger">{{ $errors->first('title') }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Nội dung</label>

                                    <textarea class="form-control" name="description" rows="3" placeholder="Enter ..." >
                                        {{empty(old('description')) ? '' : old('description')}}
                                    </textarea>
                                    @error('description')
                                        <div class="alert alert-danger">{{ $errors->first('description') }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <!-- select -->
                                <div class="form-group">
                                    <label>Loại</label>
                                    <select name="type" class="form-control">
                                        @foreach (\App\Helpers\ConstCommon::ListTypeCatogory as $key => $item)
                                            <option value="{{ $item }}"> {{ $key }}</option>
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
@endsection
