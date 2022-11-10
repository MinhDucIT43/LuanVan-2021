<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{asset('hinhanh/icon.png')}}">
    <title>King BBQ</title>
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
    <div id="wrapper" class="main-content" style="width:1342px; height:625px; margin:auto;">
        <div>
            <div class="container-fluid" style="padding-left:0;padding-right:0">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body pb-5 mt-2">
                                <h2 style="text-align:center;">THÔNG TIN ĐẶT BÀN</h2>
                                <div class="col-md-12">
                                    <div class="alert alert-primary" role="alert">
                                        Lưu ý: <br>• Các trường thông tin có dấu * là bắt buộc.<br>
                                        • Quý khách vui lòng đặt bàn trước giờ dùng bữa ít nhất <b>1</b> tiếng
                                    </div>

                                </div>
                                <form action="" method="post" enctype="multipart/form-data"> @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="inputName" class="form-label">Họ và tên (*)</label>
                                                <input autofocus="" data-parsley-required-message="Thông tin bắt buộc" type="text" class="form-control" id="inputName" name="inputName" placeholder="Điền họ và tên" value="" required>

                                            </div>
                                        </div>
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
                                                <input autofocus="" data-parsley-required-message="Thông tin bắt buộc" type="text" class="form-control" id="inputPhone" name="inputPhone" placeholder="Điền số điện thoại" value="" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row row-cols-lg-auto g-3  ">
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label class="form-label" for="inputDate">Chọn ngày đặt bàn (*)</label>
                                                <div class="input-group" id="datepicker2">
                                                    <input type="date" id="ngaydatban" name="ngaydatban" required="" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <label class="form-label" for="inputHour">Giờ</label>
                                                <select class="form-select " required="" data-parsley-required-message="Thông tin bắt buộc" name="inputHour" id='inputHour' style="min-width: 150px">
                                                    <option value="">Chọn giờ đặt bàn</option>
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
                                        </div>
                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <label class="form-label" for="inputMinute">Phút</label>
                                                <select class="form-select" name="inputMinute" id='inputMinute' required="" data-parsley-required-message="Thông tin bắt buộc">
                                                    <option selected="" value="00">00 '</option>
                                                    <option value="15">15 '</option>
                                                    <option value="30">30 '</option>
                                                    <option value="45">45 '</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="inputNumber">Số người (*)</label>
                                                    <input class="form-control" type="number" value="2" required="" data-parsley-required-message="Thông tin bắt buộc" placeholder="Điền số người" id="inputNumber" name="inputNumber">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label for="inputNote" class="form-label">Ghi chú</label>
                                                        <textarea class="form-control" rows="3" id="descriptionInput" name="inputNote"></textarea>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center mt-5">
                                        <button class="btn btn-primary" type="submit" name="submit" id="inputSubmit">Đặt bàn <i style="margin-left: 10px" class="fas fa-spinner fa-spin visually-hidden"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>

</html>