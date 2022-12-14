<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bán hàng - Hoá đơn</title>
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
    <div id="wrapper">
        <a href="{{route('banhangall')}}" class="btn btn-secondary" id="trove">Trở về</a>
        <div class="formSearch" style="width:400px;margin-top:5px;">
            <form action="{{route('hoadon.timkiemhoadonthungan')}}" method="get" role="search">
                <div class="input-group mb-3">
                    <input style="height: 42px;" type="text" class="form-control" name="search" placeholder="Nhập thông tin tìm kiếm...">
                    <button class="btn btn-success" id="button-search" type="submit">Search</button>
                </div>
            </form>
        </div>
        <div style="position:absolute;float:right;top: 40px;right: 0px;">
            <table border="0">
                <thead>
                    <th>Từ ngày</th>
                    <th>Đến ngày</th>
                    <th></th>
                </thead>
                <tbody>
                    <form action="{{route('hoadon.timkiemhoadontungaydenngaythungan')}}" method="get" role="search">
                        <tr>
                            <td><input type="date" name="tuNgay" id="tuNgay"></td>
                            <td><input type="date" name="denNgay" id="denNgay"></td>
                            <td><button class="btn btn-success" type="submit" style="height: 30px;">Search</button></td>
                        </tr>
                        <tr>
                            <td><a class="btn btn-success m-1" href="{{route('hoadon.timkiemhoadonhomnaythungan')}}" role="button">Hôm nay</a></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </form>
                </tbody>
            </table>
        </div>
        <h2 class="title-nhanvien" align="center"><strong>HOÁ ĐƠN BÁN HÀNG</strong></h2>
        <div>
            @foreach($thanhtoan as $tt)
            @endforeach
            @if(!empty($tt))
            <table class="table table-bordered table-hover" id="table-dshd">
                <thead class="table-primary">
                    <tr>
                        <th align="center">STT</th>
                        <th>Mã hoá đơn</th>
                        <th>Nhân viên thanh toán</th>
                        <th>Giờ vào</th>
                        <th>Giờ ra</th>
                        <th>Giá vé</th>
                        <th>Số lượng</th>
                        <th>Ngồi bàn</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($thanhtoan as $tt)
                    <tr>
                        <td align="center">{{++$i}}</td>
                        <td>HĐ{{$tt->mathanhtoan}}</td>
                        <td>{{App\Models\nhanvien::where('tendangnhap',$tt->nhanvien)->value('tenNV')}}</td>
                        <?php
                        $giovao = date_create(App\Models\order::where('maorder', $tt->maorder)->value('giovao'));
                        $giora = date_create($tt->giothanhtoan);
                        ?>
                        <td>{{date_format($giovao,"d-m-Y: H:i:s A")}}</td>
                        <td>{{date_format($giora,"d-m-Y: H:i:s A")}}</td>
                        <?php
                        $maorder = App\Models\order::where('maorder', $tt->maorder)->get();
                        foreach ($maorder as $mo) {
                        }
                        ?>
                        <td>{{number_format(App\Models\ve::where('mave',$mo['mave'])->value('gia'))}} VNĐ</td>
                        <td align="center">{{$mo['soluong']}}</td>
                        <td>{{App\Models\ban::where('maban',$mo['maban'])->value('banso')}}</td>
                        <td><a href="{{ route('admin.hoadon.chitiethoadon',['mathanhtoan' => $tt->mathanhtoan]) }}">Xem chi tiết</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <br /><br />
            <h2>Rất tiếc, không tìm thấy kết quả nào phù hợp với từ khóa "{{$nhap}}".</h2>
            @endif
        </div>

        <!-- Script Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>

</html>