@extends('user.layout.index')
@section('css')
@endsection
@section('content')
    <div class="bg-white text-orange title-page">
        <div class="container">
            <p>LuckyBox | Thông tin nhận hàng</p>
        </div>
    </div>
    <div class="content-container py-4">
        <div class="container my-lg-2 my-0 d-flex justify-content-center">
            <div class="bg-white py-4 rounded mb-2 px-4 w-md-50">
                <div class="w-100 px-lg-0 d-flex pb-2 flex-column justify-content-center">
                    <h4 class="text-center">Trạng thái đơn hàng</h4>
                    <button type="submit"
                        class="btn bg-orange text-white p-2 font-weight-bold">{{ $dataCart->status == 3 ? "Đợi admin duyệt giao hàng" : ($dataCart->status == 4 ? "Đang giao hàng" : ($dataCart->status == 5 ? "Đã nhận Hàng" : "Bị từ chối"))  }}</button>
                </div>
                <div class="d-flex justify-content-center">
                    <img src="{{ \App\Helpers\ConstCommon::getLinkImageToStorage($dataCart->link_image) }}" width="40%"
                        height="auto" />
                </div>
                <div class="text-center">
                    <a href="{{ route('boxInfo', ['id' => $dataCart->id]) }}" class="text-decoration-none">
                        <h4 class="text-dark">{{ $dataCart->title }}</h4>
                    </a>
                </div>

                <div class="d-flex flex-column justify-content-between w-100 bg-gray px-2 py-2 rounded">
                    <h4 class="text-center">Thông tin mua hàng</h4>
                    <h5>Giá mua: <span class="text-danger">{{ number_format($dataCart->price_cart) }} VNĐ</span></h5>
                    <h5>Số lượng: <span class="text-danger">{{ $dataCart->amount }}</span></h5>
                    <h5>Tổng tiền : <span class="text-danger">{{ number_format($dataCart->amount * $dataCart->price_cart) }}
                            VNĐ</span></h5>
                </div>
                <div class=" my-2 d-flex flex-column  align-items-center  justify-content-between w-100 bg-gray px-2 py-2 rounded">
                    <h4 class="text-center">Thông tin sản phẩm</h4>
                    <h5><span class="text-danger">{{$dataCart->product_title}}</span></h5>
                    <img src="{{ \App\Helpers\ConstCommon::getLinkImageToStorage($dataCart->product_link_image) }}" width="40%"
                    height="auto" alt="">
                </div>

                <div class="my-2 bg-gray px-2 py-2 rounded">
                    <h4 class="text-center">Thông tin nhận hàng</h4>
                    <p>Email: <span class="text-danger">{{ $dataCart->email }}</span></p>
                    <p>Số điện thoại: <span class="text-danger">{{ $dataCart->number_phone }}</span></p>
                    <p>Tên: <span class="text-danger">{{ $dataCart->name }}</span></p>
                    <p>Địa chỉ: <span class="text-danger">{{ $dataCart->address }}</span></p>
                    {{-- inforUserBills --}}
                    <div class="py-1 d-flex justify-content-center">
                        <button type="button" class="btn bg-info text-white" data-toggle="modal"
                            data-target="#changeaddress">Thay đổi</button>
                    </div>
                </div>

                
            </div>
            <div class="modal fade changeaddress" id="changeaddress" tabindex="-1" role="dialog"
                            aria-labelledby="changeaddressLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="changeaddressLabel">Địa chỉ của tôi</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body overflow-auto">
                                        @foreach ($inforUserBills as $inforUserBill)
                                            <div class="form-check py-2 border-bottom">
                                                <input class="form-check-input" type="radio" name="id_info_user_bill"
                                                    id="gridRadios2" value="{{ $inforUserBill->id }}"
                                                    {{ $inforUserBill->id == $dataCart->id_info_user_bill ? 'checked' : '' }}>
                                                <label class="form-check-label" for="gridRadios2">
                                                    Họ và tên: {{ $inforUserBill->name }} <br>
                                                    Số điện thoại: {{ $inforUserBill->number_phone }} <br>
                                                    Địa chỉ: {{ $inforUserBill->address }} <br>
                                                </label>
                                            </div>
                                        @endforeach
                                        <a href="{{ route('infoUserBill') }}" class="text-decoration-none" target="_blank">
                                            <button type="button"
                                                class="btn bg-white text-dark border rounded d-flex align-items-center my-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd"
                                                        d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                                                </svg>
                                                Thêm địa chỉ mới
                                            </button>
                                        </a>
                                    </div>
                                    <div class="p-1 modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Hủy</button>
                                        <button type="button" class="btn bg-orange text-white">Thay đổi địa chỉ</button>
                                    </div>
                                </div>
                            </div>
                        </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $('input[type=radio][name=id_info_user_bill]').change(function() {
            var selectedValue = $(this).val();

            $.ajax({
                url: "{{ route('changeinfoUserBillUpdate') }}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id_bill: '{{ $dataCart->id_bill }}',
                    value: selectedValue,
                },
                success: function(response) {

                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true
                    }
                    toastr.success("Đổi địa chỉ nhận hàng thành công");

                    // Xử lý kết quả trả về từ server (nếu cần)
                    // Load lại trang hoặc cập nhật các phần tử trên trang
                    window.location.reload(); // Ví dụ: Load lại trang
                },
                error: function(xhr, status, error) {
                    // Xử lý lỗi (nếu có)
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true
                    }
                    toastr.error("Đổi địa chỉ nhận hàng không thành công");
                }
            });
        });
    });
</script>
@endsection
