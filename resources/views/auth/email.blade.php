@extends('auth.layout')
@section('style')
@endsection
@section('content')
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <input type="email" name="email" required autofocus>
        <button type="submit">Gửi liên kết đặt lại mật khẩu</button>
    </form>
@endsection
@section('script')
@endsection
