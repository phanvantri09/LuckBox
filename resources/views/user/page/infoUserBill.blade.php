@extends('user.layout.index')
@section('css')
@endsection
@section('content')
    <div class="bg-white text-orange title-page">
        <div class="container">
            <p>LuckyBox | Tạo thông tin nhận hàng</p>
        </div>
    </div>

    <div class="content-container py-md-4 py-3">
        <div class="container my-lg-2 my-0 bg-white py-4">
            <div class="row content-page p-lg-5">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12 px-lg-5">
                    <div class="title text-danger pt-sm-2">Tạo thông tin nhận hàng</div>
                    <form action="{{ route('infoUserBillPost') }}" class="border p-3 mt-2 rounded" method="post">
                        @csrf
                        <div class="form-group">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Họ tên</label>
                                <input type="text" name="name" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Nguyễn Văn A..." value="{{ old('name', $user->name ?? null) }}" required />
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput2">Số điện thoại</label>
                                <input id="exampleFormControlInput2"
                                    type="tel" pattern="((\+84|0)[3|5|7|8|9])+([0-9]{8})" oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                    placeholder="Số điện thoại" required name="number_phone" class="form-control"
                                    value="{{ old('number_phone', $user->number_phone ?? null) }}" required/>
                                    @error('number_phone')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="exampleFormControlInput5">Địa chỉ cụ thể nhận hàng</label>
                                    <textarea name="address" id=""  class="form-control" cols="30" rows="3" required>{{old('address')}}</textarea>
                                    @error('address')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn bg-orange text-white">Lưu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script src="./js/address.js"></script>
@endsection
