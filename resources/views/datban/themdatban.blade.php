@extends("./datban")

@section('page_title')
Đặt bàn - Thêm đặt bàn
@endsection

@section('convert_color_themdatban')
active
@endsection

@section('main')
<div id="themdatban">
    @if(session('datbanthanhcong'))
    <p style="color:#e32b56;"><i class="fas fa-check"></i> {{ session('datbanthanhcong') }}</p>
    @endif
    <h2 style="text-align:center;">THÔNG TIN ĐẶT BÀN</h2>
    <div class="alert alert-primary" role="alert">
        Lưu ý: <br>• Các trường thông tin có dấu * là bắt buộc.<br>
        • Quý khách vui lòng đặt bàn trước giờ dùng bữa ít nhất <b>1</b> tiếng.
    </div>
    <form action="{{route('postDatBan')}}" method="post" enctype="multipart/form-data"> @csrf
        <div class="mb-3">
            <label for="inputName" class="form-label">Họ và tên (*)</label>
            <input autofocus="" data-parsley-required-message="Thông tin bắt buộc" type="text" class="form-control" id="inputName" name="inputName" placeholder="Điền họ và tên" value="" required>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="inputEmail" class="form-label">Email (*)</label>
                    <input autofocus="" data-parsley-required-message="Thông tin bắt buộc" data-parsley-type-message="Địa chỉ email không đúng định dạng" type="email" parsley-type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="Điền email" value="" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="inputPhone" class="form-label">Số điện thoại (*)</label>
                    <input data-parsley-required-message="Thông tin bắt buộc" type="text" class="form-control" id="inputPhone" name="inputPhone" placeholder="Điền số điện thoại" value="" required>
                </div>
            </div>
        </div>
        <div class="row row-cols-lg-auto g-3  ">
            <div class="mb-3">
                <label class="form-label" for="inputDate">Chọn ngày đặt bàn (*)</label>
                <div class="input-group" id="datepicker2">
                    <input type="date" id="ngaydatban" name="ngaydatban" required="" />
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label" for="inputHour">Giờ</label>
                <select class="form-select " required="" data-parsley-required-message="Thông tin bắt buộc" name="inputHour" id='inputHour' style="min-width: 150px">
                    <option value="10">10 H</option>
                    <option value="11">11 H</option>
                    <option value="12">12 H</option>
                    <option value="13">13 H</option>
                    <option value="14">14 H</option>
                    <option value="15">15 H</option>
                    <option value="16">16 H</option>
                    <option value="17">17 H</option>
                    <option value="18">18 H</option>
                    <option value="19">19 H</option>
                    <option value="20">20 H</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label" for="inputMinute">Phút</label>
                <select class="form-select" name="inputMinute" id='inputMinute' required="" data-parsley-required-message="Thông tin bắt buộc">
                    <option selected="" value="00">00 '</option>
                    <option value="15">15 '</option>
                    <option value="30">30 '</option>
                    <option value="45">45 '</option>
                </select>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="inputNumber">Số người (*)</label>
                    <input class="form-control" type="number" min="1" value="2" required="" data-parsley-required-message="Thông tin bắt buộc" placeholder="Điền số người" id="inputNumber" name="inputNumber">
                </div>
            </div>
            <div class="mb-3">
                <label for="inputNote" class="form-label">Ghi chú</label>
                <textarea class="form-control" rows="3" id="descriptionInput" name="inputNote"></textarea>
            </div>
            <div class="mb-3">
                <button class="btn btn-primary" type="submit" name="submit" id="inputSubmit">Xác nhận<i style="margin-left: 10px" class="fas fa-spinner fa-spin visually-hidden"></i></button>
            </div>
        </div>
    </form>
</div>
@endsection