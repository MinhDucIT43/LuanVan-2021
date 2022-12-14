<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt bàn - Duyệt bàn đặt</title>
    <link rel="stylesheet" href="{{asset('css/datban.css')}}">
    <link rel="shortcut icon" href="{{asset('hinhanh/logo.png')}}">
    <!-- Link Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Link Fontawesome-icon -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- Link jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>
</head>

<body>
    <div id="duyetban" style="padding-left: 9px;">
        <a href="{{route('datban')}}" class="btn btn-success" id="trove">Trở về</a>
        <h2 id="text-duyetdatban">Duyệt đặt bàn</h2>
        @foreach($datban as $db)
        <form action="{{route('postDuyetDatBan',['maDatBan' => $db['maDatBan']]) }}" method="post" enctype="multipart/form-data"> @csrf
            <div class="mb-3" style="width: 1349px;">
                <label for="inputName" class="form-label"><strong>Họ và tên</strong></label>
                <input autofocus="" data-parsley-required-message="Thông tin bắt buộc" type="text" class="form-control" id="inputName" name="inputName" placeholder="Điền họ và tên" value="{{$db->hoTen}}" required>
            </div>
            <div class="row" style="width: 1361px;">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="inputEmail" class="form-label"><strong>Email</strong></label>
                        <input autofocus="" data-parsley-required-message="Thông tin bắt buộc" data-parsley-type-message="Địa chỉ email không đúng định dạng" type="email" parsley-type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="Điền email" value="{{$db->email}}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="inputPhone" class="form-label"><strong>Số điện thoại</strong></label>
                        <input data-parsley-required-message="Thông tin bắt buộc" type="text" class="form-control" id="inputPhone" name="inputPhone" placeholder="Điền số điện thoại" value="{{$db->soDT}}" required>
                    </div>
                </div>
            </div>
            <div class="row row-cols-lg-auto g-3" style="width: 1357px;">
                <div class="mb-3">
                    <label class="form-label" for="inputDate"><strong>Ngày đặt bàn</strong></label>
                    <div class="input-group" id="datepicker2">
                        <input type="date" id="ngaydatban" name="ngaydatban" value="{{$db->ngayDat}}" required="" />
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="inputHour"><strong>Giờ</strong></label>
                    <select class="form-select " required="" data-parsley-required-message="Thông tin bắt buộc" name="inputHour" id='inputHour' style="min-width: 150px">
                        <option value="{{$db->gioDat}}">{{$db->gioDat}} H</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="inputMinute"><strong>Phút</strong></label>
                    <select class="form-select" name="inputMinute" id='inputMinute' required="" data-parsley-required-message="Thông tin bắt buộc">
                        @switch($db->phutDat)
                        @case(0) <option value="{{$db->phutDat}}" style="display:none" selected="selected">{{$db->phutDat}} '</option>
                        <option value="15">15 '</option>
                        <option value="30">30 '</option>
                        <option value="45">45 '</option> @break
                        @case(15) <option value="{{$db->phutDat}}" style="display:none" selected="selected">{{$db->phutDat}} '</option>
                        <option value="0">0 '</option>
                        <option value="30">30 '</option>
                        <option value="45">45 '</option> @break
                        @case(30) <option value="{{$db->phutDat}}" style="display:none" selected="selected">{{$db->phutDat}} '</option>
                        <option value="0">0 '</option>
                        <option value="30">15 '</option>
                        <option value="45">45 '</option> @break
                        @case(45) <option value="{{$db->phutDat}}" style="display:none" selected="selected">{{$db->phutDat}} '</option>
                        <option value="0">0 '</option>
                        <option value="30">15 '</option>
                        <option value="45">45 '</option> @break
                        @endswitch
                    </select>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="inputNumber"><strong>Số người</strong></label>
                        <input class="form-control" type="number" style="width:244px;" min="1" value="{{$db->soNguoi}}" required="" data-parsley-required-message="Thông tin bắt buộc" placeholder="Điền số người" id="inputNumber" name="inputNumber">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="tendangnhap"><strong>Nhân viên duyệt</strong></label><br/>
                        <select name="tendangnhap" id="tendangnhap">
                            @foreach($nhanvien as $nv)
                                <option value="{{$nv['tendangnhap']}}">{{$nv['tenNV']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="inputNote" class="form-label"><strong>Ghi chú</strong></label>
                    <textarea class="form-control" rows="3" cols="53" id="descriptionInput" name="inputNote">{{$db->ghiChu}}</textarea>
                </div>
                <div class="mb-3 form-check" style="padding-left:50px;">
                    <strong>Chọn bàn</strong>
                    <ul class="nav">
                        @foreach($maDatBan_co_bandadat as $mdb_c_bdd)
                        @endforeach
                        @if(empty($mdb_c_bdd))
                            <?php $allban = DB::table('ban')->get(); ?>
                            @foreach($allban as $ab)
                                <li style="margin-right: 37px;" class="nav-item"><input type="checkbox" class="form-check-input" id="inputTable" name="inputTable[]" value="{{$ab->maban}}">
                                    <label class="form-check-label" for="inputTable">{{$ab->banso}}</label>
                                </li><br />
                            @endforeach
                            <button class="btn btn-primary" type="submit" name="submit" id="inputSubmit">Duyệt</button>
                        @else
                            <?php
                                $tongBanDaDat = [];
                                foreach($maDatBan_co_bandadat as $mdb_c_bdd){
                                    $cacbandadat = DB::table('chitiet_datban')->where('maDatBan',$mdb_c_bdd)->get();
                                    foreach($cacbandadat as $cbdd){
                                        $maban = explode(',', $cbdd->maban);
                                        $tongBanDaDat = array_merge($tongBanDaDat,$maban);
                                    }
                                }
                                $tongBanDaDat = array_unique($tongBanDaDat);
                                $ban = DB::table('ban')->whereNotIn('maban', $tongBanDaDat)->get();
                            ?>
                            @foreach($ban as $b)
                                <li style="margin-right: 37px;" class="nav-item"><input type="checkbox" class="form-check-input" id="inputTable" name="inputTable[]" value="{{$b->maban}}">
                                    <label class="form-check-label" for="inputTable">{{$b->banso}}</label>
                                </li><br />
                            @endforeach
                            <button class="btn btn-primary" type="submit" name="submit" id="inputSubmit">Duyệt</button>
                        @endif
                    </ul>
                </div>
            </div>
        </form>
        @endforeach
    </div>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>

</html>