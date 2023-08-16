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
                <h5 class="text-center">Thêm tài khoản ngân hàng</h5>
                <form action="{{ route('createCard') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nganhang">Tên ngân hàng</label>
                        <select name="bank" class="form-control" id="nganhang">
                            @foreach ($dataBank as $key => $item)
                                <option value="{{ $key }}">{{ $item['name'] }}</option>
                            @endforeach
                        </select>
                        @error('bank')
                            <div class="alert alert-danger">{{ $errors->first('bank') }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Chi nhánh</label>
                        <input type="text" name="card_branch" class="form-control" id="exampleFormControlInput1"
                            placeholder="Nhập chi nhánh mà bạn đăng ký thẻ">
                        @error('card_branch')
                            <div class="alert alert-danger">{{ $errors->first('card_branch') }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Tên chủ thẻ</label>
                        <input type="text" name="card_name" class="form-control" id="exampleFormControlInput1"
                            placeholder="Nhập tên chủ thẻ">
                        @error('card_name')
                            <div class="alert alert-danger">{{ $errors->first('card_name') }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput2">Số thẻ/Số tài khoản</label>
                        <input type="number" name="card_number" class="form-control" id="exampleFormControlInput2"
                            placeholder="Nhập số thẻ/số tài khoản">
                        @error('card_number')
                            <div class="alert alert-danger">{{ $errors->first('card_number') }}</div>
                        @enderror
                    </div>
                    <input type="hidden" value="1" name="status">
                    <button type="submit"
                        class="btn bg-success text-white font-weight-bold d-flex mx-auto px-4">Lưu</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
