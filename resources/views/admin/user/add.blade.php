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
                    <form action="{{ route('user.addPost') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" value="{{old('email')}}" class="form-control" placeholder="Enter ...">
                                    @error('email')
                                        <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Mật khẩu</label>
                                    <input type="text" name="password" value="{{old('password')}}" class="form-control" placeholder="Enter ...">
                                    @error('password')
                                        <div class="alert alert-danger">{{ $errors->first('password') }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <!-- select -->
                                <div class="form-group">
                                    <label>Loại người dùng</label>
                                    <select name="type" class="form-control">
                                        @foreach (\App\Helpers\ConstCommon::ListTypeUser as $key => $item)
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
