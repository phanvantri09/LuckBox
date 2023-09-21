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
                    <form action="{{ route('user.editPost',['id' => $user->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" value="{{ $user->email }}" name="email" class="form-control"
                                        placeholder="Enter ...">
                                    @error('email')
                                        <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Số điện thoại</label>
                                    <input type="tel" value="{{ $user->number_phone }}" name="number_phone" class="form-control"
                                        placeholder="Enter ...">
                                    @error('number_phone')
                                        <div class="alert alert-danger">{{ $errors->first('number_phone') }}</div>
                                    @enderror
                                </div>
                            </div> --}}
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Số dư tài khoản</label>
                                    <input type="number" value="{{ $user->balance }}" name="balance" class="form-control"
                                        placeholder="Enter ...">
                                    @error('balance')
                                        <div class="alert alert-danger">{{ $errors->first('balance') }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Mật khẩu mới</label>
                                    <input type="text" name="password" class="form-control"
                                        placeholder="Nhập mật khẩu mới">
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
                                            <option value="{{ $item }}"
                                                @if ($item == $user->type) selected @endif> {{ $key }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
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
