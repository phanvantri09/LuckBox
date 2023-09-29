@extends('auth.layout')
@section('style')
    <style>
        #show_eye {
            display: block;
        }

        #hide_eye {
            display: none;
        }

        #show_eye_new {
            display: block;
        }

        #hide_eye_new {
            display: none;
        }

        #show_eye_confirm_password {
            display: block;
        }

        #hide_eye_confirm_password {
            display: none;
        }
    </style>
@endsection
@section('content')
    <div class="d-flex justify-content-center align-items-center ">
        <div class="bg-white rounded py-4 px-4 col-md-8 border">
            <h3 class="text-center">Đổi mật khẩu mới</h3>
            <form action="{{ route('password.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="psw"><b class="text-danger">*</b> Mật khẩu mới</label>
                    <div class="input-group mb-3">
                        <input type="hidden" name="id_user" value="{{ $id_user }}" />
                        <input type="password" placeholder="Nhập mật khẩu mới" class="form-control" id="passwordNew"
                            name="passwordNew" required="true" aria-label="password" aria-describedby="basic-addon1" />
                        <div class="input-group-append">
                            <span class="input-group-text" onclick="password_show_hideUp();">
                                <svg xmlns="http://www.w3.org/2000/svg" id="show_eye_new" width="16" height="16"
                                    fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                    <path
                                        d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" id="hide_eye_new" width="16" height="16"
                                    fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16">
                                    <path
                                        d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z" />
                                    <path
                                        d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z" />
                                </svg>
                            </span>
                        </div>
                    </div>
                    @error('passwordNew')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="psw"><b class="text-danger">*</b>Xác nhận mật khẩu mới</label>
                    <div class="input-group mb-3">
                        <input type="password" placeholder="Nhập lại mật khẩu mới" class="form-control"
                            id="confirm_password" name="confirm_password" required="true" aria-label="password"
                            aria-describedby="basic-addon1" />
                        <div class="input-group-append">
                            <span class="input-group-text" onclick="password_show_hide_confirm_password();">
                                <svg xmlns="http://www.w3.org/2000/svg" id="show_eye_confirm_password" width="16"
                                    height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                    <path
                                        d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" id="hide_eye_confirm_password" width="16"
                                    height="16" fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16">
                                    <path
                                        d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z" />
                                    <path
                                        d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z" />
                                </svg>
                            </span>
                        </div>
                    </div>
                    @error('confirm_password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn bg-orange text-white font-weight-bold">Đổi mật
                    khẩu</button>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function password_show_hide() {
            var x = document.getElementById("password");
            var show_eye = document.getElementById("show_eye");
            var hide_eye = document.getElementById("hide_eye");
            hide_eye.classList.remove("d-none");
            if (x.type === "password") {
                x.type = "text";
                show_eye.style.display = "none";
                hide_eye.style.display = "block";
            } else {
                x.type = "password";
                show_eye.style.display = "block";
                hide_eye.style.display = "none";
            }
        }

        function password_show_hideUp() {
            console.log(123213);
            var xx = document.getElementById("passwordNew");
            var show_eye_new = document.getElementById("show_eye_new");
            var hide_eye_new = document.getElementById("hide_eye_new");
            hide_eye_new.classList.remove("d-none");
            if (xx.type === "password") {
                xx.type = "text";
                show_eye_new.style.display = "none";
                hide_eye_new.style.display = "block";
            } else {
                xx.type = "password";
                show_eye_new.style.display = "block";
                hide_eye_new.style.display = "none";
            }
        }

        function password_show_hide_confirm_password() {
            var xxx = document.getElementById("confirm_password");
            var show_eye_confirm_password = document.getElementById("show_eye_confirm_password");
            var hide_eye_confirm_password = document.getElementById("hide_eye_confirm_password");
            hide_eye_confirm_password.classList.remove("d-none");
            if (xxx.type === "password") {
                xxx.type = "text";
                show_eye_confirm_password.style.display = "none";
                hide_eye_confirm_password.style.display = "block";
            } else {
                xxx.type = "password";
                show_eye_confirm_password.style.display = "block";
                hide_eye_confirm_password.style.display = "none";
            }
        }
    </script>
@endsection
