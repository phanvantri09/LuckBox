@extends('user.layout.index')
@section('css')
@endsection
@section('content')
    <div class="bg-white text-orange title-page">
        <div class="container">
            <p>LuckyBox | Thêm tài khoản ngân hàng</p>
        </div>
    </div>
    <div class="content-container py-md-4 py-2">
        <div class="container my-lg-2 my-0 d-flex justify-content-center">
            <div class="bg-white py-2 rounded mb-2 px-4 w-md-50">
                <h5 class="text-center">Cập nhật thông tin cá nhân</h5>
                <div class="form-group">
                    <label for="nganhang">Tên ngân hàng</label>
                    <select name="nganhang" class="form-control" id="nganhang">
                        @foreach ($dataBank as $key => $item)
                            <option value="{{ $key }}" selected>{{ $item['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Chi nhánh</label>
                    <input type="text" name="name" class="form-control" id="exampleFormControlInput1"
                        placeholder="Đà Nẵng">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Tên chủ thẻ</label>
                    <input type="text" name="name" class="form-control" id="exampleFormControlInput1"
                        placeholder="Nguyễn Văn A">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput2">Số thẻ/Số tài khoản</label>
                    <input type="text" name="name" class="form-control" id="exampleFormControlInput2"
                        placeholder="Nguyễn Văn A">
                </div>
                <button type="submit" class="btn bg-success text-white font-weight-bold d-flex mx-auto px-4">Lưu</button>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
