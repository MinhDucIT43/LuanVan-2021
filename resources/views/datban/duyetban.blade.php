@extends("./datban")

@section('page_title')
Đặt bàn - Duyệt bàn đặt
@endsection

@section('main')
<div id="duyetban">
    <h2 id="text-duyetdatban">Duyệt đặt bàn</h2>
    @foreach($datban as $db)
    <form action="{{route('postDuyetDatBan',['maDatBan' => $db['maDatBan']]) }}" method="post" enctype="multipart/form-data"> @csrf
        <div class="mb-3">
            <label for="inputName" class="form-label">Họ và tên</label>
            <input autofocus="" data-parsley-required-message="Thông tin bắt buộc" type="text" class="form-control" id="inputName" name="inputName" placeholder="Điền họ và tên" value="{{$db->hoTen}}" required>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="inputEmail" class="form-label">Email</label>
                    <input autofocus="" data-parsley-required-message="Thông tin bắt buộc" data-parsley-type-message="Địa chỉ email không đúng định dạng" type="email" parsley-type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="Điền email" value="{{$db->email}}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="inputPhone" class="form-label">Số điện thoại</label>
                    <input data-parsley-required-message="Thông tin bắt buộc" type="text" class="form-control" id="inputPhone" name="inputPhone" placeholder="Điền số điện thoại" value="{{$db->soDT}}" required>
                </div>
            </div>
        </div>
        <div class="row row-cols-lg-auto g-3">
            <div class="mb-3">
                <label class="form-label" for="inputDate">Ngày đặt bàn</label>
                <div class="input-group" id="datepicker2">
                    <input type="date" id="ngaydatban" name="ngaydatban" value="{{$db->ngayDat}}" required="" />
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label" for="inputHour">Giờ</label>
                <select class="form-select " required="" data-parsley-required-message="Thông tin bắt buộc" name="inputHour" id='inputHour' style="min-width: 150px">
                    <option value="{{$db->gioDat}}">{{$db->gioDat}} H</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label" for="inputMinute">Phút</label>
                <select class="form-select" name="inputMinute" id='inputMinute' required="" data-parsley-required-message="Thông tin bắt buộc">
                    @switch($db->phutDat)
                        @case(0) <option value="{{$db->phutDat}}" style="display:none" selected="selected" >{{$db->phutDat}} '</option>
                                <option value="15">15 '</option>
                                <option value="30">30 '</option>
                                <option value="45">45 '</option> @break
                        @case(15) <option value="{{$db->phutDat}}" style="display:none" selected="selected" >{{$db->phutDat}} '</option>
                                <option value="0">0 '</option>
                                <option value="30">30 '</option>
                                <option value="45">45 '</option> @break
                        @case(30) <option value="{{$db->phutDat}}" style="display:none" selected="selected" >{{$db->phutDat}} '</option>
                                <option value="0">0 '</option>
                                <option value="30">15 '</option>
                                <option value="45">45 '</option> @break
                        @case(45) <option value="{{$db->phutDat}}" style="display:none" selected="selected" >{{$db->phutDat}} '</option>
                                <option value="0">0 '</option>        
                                <option value="30">15 '</option>
                                <option value="45">45 '</option> @break
                    @endswitch
                </select>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="inputNumber">Số người (*)</label>
                    <input class="form-control" type="number" min="1" value="{{$db->soNguoi}}" required="" data-parsley-required-message="Thông tin bắt buộc" placeholder="Điền số người" id="inputNumber" name="inputNumber">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3 form-check">
                    <label for="tendangnhap">Nhân viên duyệt</label>
                    <input data-parsley-required-message="Thông tin bắt buộc" type="text" class="form-control" id="tendangnhap" name="tendangnhap" placeholder="Điền số điện thoại" value="{{App\Models\nhanvien::where('tendangnhap',Session::get('thungan'))->value('tenNV')}}" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="inputNote" class="form-label">Ghi chú</label>
                <textarea class="form-control" rows="3" id="descriptionInput" name="inputNote">{{$db->ghiChu}}</textarea>
            </div>
            <div class="mb-3 form-check">
                <p>Chọn bàn</p>
                <ul class="nav">
                    @foreach($datadatban as $dt)
                        <li style="margin-right: 37px;" class="nav-item"><input type="checkbox" class="form-check-input" id="inputTable" name="inputTable[]" value="{{App\Models\ban::where('maban',$dt)->value('maban')}}">
                        <label class="form-check-label" for="inputTable">{{App\Models\ban::where('maban',$dt)->value('banso')}}</label></li><br/>
                    @endforeach
                </ul>
            </div>
            <div class="mb-3">
                <button class="btn btn-primary" type="submit" name="submit" id="inputSubmit">Duyệt<i style="margin-left: 10px" class="fas fa-spinner fa-spin visually-hidden"></i></button>
            </div>
        </div>
    </form>
    @endforeach
</div>
@endsection