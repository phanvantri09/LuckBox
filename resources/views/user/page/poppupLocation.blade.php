<div  class="modal fade changeaddress" id="changeaddress" tabindex="-1" role="dialog" aria-labelledby="changeaddressLabel"
    aria-hidden="true">
    <div action="" class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changeaddressLabel">Địa chỉ của tôi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body overflow-auto">
                <div class="form-check py-2 border-bottom">
                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1"
                        checked>
                    <label class="form-check-label" for="gridRadios1">
                        First radio
                    </label>
                </div>
                @foreach ($inforUserBills as $inforUserBill)
                    <div class="form-check py-2 border-bottom">
                        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2"
                            value="option2">
                        <label class="form-check-label" for="gridRadios2">
                            Họ và tên: {{ $inforUserBill->name }} <br>
                            Số điện thoại: {{ $inforUserBill->number_phone }} <br>
                            Địa chỉ: {{ $inforUserBill->address }} <br>
                        </label>
                    </div>
                @endforeach
                <div class="form-check py-2 border-bottom">
                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="option3">
                    <label class="form-check-label" for="gridRadios3">
                        Third disabled radio
                    </label>
                </div>
                <div class="form-check py-2 border-bottom">
                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="option3">
                    <label class="form-check-label" for="gridRadios3">
                        Third disabled radio
                    </label>
                </div>
                <div class="form-check py-2 border-bottom">
                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="option3">
                    <label class="form-check-label" for="gridRadios3">
                        Third disabled radio
                    </label>
                </div>
                <a href="{{ route('infoUserBill') }}" class="text-decoration-none" target="_blank">
                    <button type="button" class="btn bg-white text-dark border rounded d-flex align-items-center my-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-plus-lg" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                        </svg>
                        Thêm địa chỉ mới
                    </button>
                </a>
            </div>
            <div class="p-1 modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                <button type="button" class="btn bg-orange text-white">Thay đổi</button>
            </div>
        </div>
    </div>
</form>
