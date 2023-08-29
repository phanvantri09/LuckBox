@extends('user.layout.index')
@section('css')
@endsection
@section('content')
    <div class="bg-white text-orange title-page">
        <div class="container">
            <p>LuckyBox | Ví của bạn</p>
        </div>
    </div>
    <div class="content-container py-md-4 py-2">
        <div class="container my-lg-2 my-0 d-flex justify-content-center">
            <div class="bg-white py-2 rounded mb-2 px-4 w-md-50">
                <h5 class="text-center">Thông tin ví</h5>
                <div class="d-sm-flex align-items-center justify-content-between">
                    <p class="mb-0">Số dư: <span
                            class="text-danger font-weight-bold">{{ number_format($currentUser->balance) . 'đ' }}</span></p>
                    <div class="d-flex d-sm-block justify-content-between py-sm-0 py-1">
                        <a href="{{ route('infoCardPay') }}" class="text-decoration-none">
                            <button class="btn bg-warning text-white">Nạp tiền</button>
                        </a>
                        <a href="{{ route('cashOut') }}" class="text-decoration-none">
                            <button class="btn bg-success text-white">Rút tiền</button>
                        </a>
                    </div>
                </div>
                <h5 class="text-center">Tài khoản thanh toán</h5>
                <p>Tên ngân hàng: {{ $showCardDefault->bank }}</p>
                <p>Chi nhánh: {{ $showCardDefault->card_branch }}</p>
                <p>Số tài khoản/Số thẻ: {{ $showCardDefault->card_number }}</p>
                <p>Chủ tài khoản: {{ $showCardDefault->card_name }}</p>
                <a href="{{ route('createCard') }}" class="d-flex justify-content-start text-decoration-none">
                    <button class="btn bg-orange text-white">Thêm tài khoản</button>
                </a>
            </div>
        </div>
        <div class="container">
            <hr>
        </div>
        <div class="container my-lg-2 my-0 d-flex justify-content-center">
            <div class="bg-white py-2 rounded mb-2 px-4 w-md-50">
                <div style="height: 270px;
                overflow: auto;">
                    @foreach ($getAllCard as $key => $item)
                        <div>
                            <h5 class="text-center">-----------------------------</h5>
                            <h6 class="text-center">Thẻ {{ $key + 1 }}</h6>
                            <p>Tên ngân hàng: {{ $item->bank }}</p>
                            <p>Chi nhánh: {{ $item->card_branch }}</p>
                            <p>Số tài khoản/Số thẻ: {{ $item->card_number }}</p>
                            <p>Chủ tài khoản: {{ $item->card_name }}</p>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('changeStatus', ['id' => $item->id]) }}"
                                    class="d-flex justify-content-start text-decoration-none">
                                    <button class="btn bg-orange text-white"
                                        style="
                                    background: green;
                                ">Chọn
                                        mặc định</button>
                                </a>
                                <button type="button" class="btn bg-danger text-white" data-toggle="modal"
                                    data-target="#exampleModal{{ $item->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path
                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                        <path
                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                                    </svg> &nbsp;
                                    Xóa thẻ
                                </button>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
        @foreach ($getAllCard as $key => $item)
            <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Bạn có muốn xóa ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                            <button type="button" onclick="deleteCard({{ $item->id }})" class="btn btn-primary">Xóa
                                ngay</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
@section('scripts')
    <script>
        function deleteCard(id){
            $.ajax({
            url: "{{ route('deleteCard') }}",
            method: "GET",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: id,
            },
            success: function(response) {

                toastr.options = {
                    "closeButton": true,
                    "progressBar": true
                }
                toastr.success("Xóa thẻ thành công");

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
                toastr.error("Xóa thẻ Thất bại");
            }
        });
        }

    </script>
@endsection
