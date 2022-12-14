<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hoá đơn - Chi tiết hoá đơn</title>
    <link rel="icon" href="{{asset('hinhanh/logo.png')}}">
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
    @foreach($mathanhtoan as $mtt)
    @if(Session::has('admin') && Session::has('vaitroadmin'))
        <a href="{{route('admin.hoadon')}}" class="btn btn-secondary" id="trove">Trở về</a>
    @else
        <a href="{{route('hoadon')}}" class="btn btn-secondary" id="trove">Trở về</a>
    @endif
    <h1 align="center">CHI TIẾT HOÁ ĐƠN MÃ HĐ{{$mtt['mathanhtoan']}}</h1>
    <h4>Các món ăn sử dụng:</h4>
    <table class="table table-bordered table-hover">
        <thead class="table-primary">
            <tr align="center">
                <th>STT</th>
                <th>Tên món</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $mamon = App\Models\chitietorder::where('maorder', $mtt['maorder'])->Paginate(7);
            ?>
            @foreach($mamon as $mm)
                <tr>
                    <td align="center">{{++$i}}</td>
                    <td>{{App\Models\mon::where('mamon',$mm['mamon'])->value('tenmon')}}</td>
                    <td align="center">{{$mm['soluong']}}</td>
                    <td align="right">{{$mm['gia']}}</td>
                    <td align="right">{{$mm['soluong']*$mm['gia']}}</td>
                </tr>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td align="right"><strong>Tổng tiền hoá đơn:</strong></td>
                <td align="right">{{number_format($mtt['thanhtien'])}}</td>
            </tr>
        </tbody>
    </table>
    {{ $mamon->links() }}
    <?php
        $maorder = App\Models\order::where('maorder', $mtt['maorder'])->get();
        foreach ($maorder as $mo) {}
    ?>
    <strong>Giảm giá đã áp dụng: </strong>
    @if($mo->maGG == NULL)
        <strong style="color:red;">Không áp dụng mã giảm giá</strong>
    @else
        <strong style="color:red;">{{App\Models\giamgia::where('maGG',$mo['maGG'])->value('tenGG')}}</strong>
    @endif
    @endforeach
</body>

</html>