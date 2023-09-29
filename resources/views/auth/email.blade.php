@extends('auth.layout')
@section('style')
@endsection
@section('content')
    <form action="{{ route('password.email') }}" method="post" class="col-12 bg-white p-4 shadow rounded d-flex flex-column align-items-center">
        @csrf
        <h3 class="text-center mt-2 mb-2">Đổi mật khẩu</h3>
        <div class="form-group col-sm-12 col-md-5 d-flex flex-column align-items-center">
            <label class="text-center" for="uname">Nhập email hoặc số điện thoại</label>
            <input type="text" placeholder="Nhập email hoặc số điện thoại để kiểm tra" class="form-control border" name="email"
                value="{{ old('email') }}" required>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-5"><b class="text-danger">Lưu ý:</b> <br>
            
            1. nhập email bạn sẽ nhận được liên kết đổi mật khẩu gửi về mail đã đăng ký. <br>
            2. Nhập số điện thoại bạn sẽ nhận dc OTP về Số điện thoại đã đăng ký.
        </div>

        <button type="submit" class="btn bg-orange text-white w-100 my-1 col-md-4 mt-4">Kiểm tra</button>

        
    </form>
@endsection
@section('script')
@endsection
