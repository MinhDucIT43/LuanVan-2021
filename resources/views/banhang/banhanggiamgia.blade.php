@extends("banhang")

@section('convert_color_giamgia')
active
@endsection

@section('main')
<div id="giamgia-private">
    @foreach($giamgia as $gg)
    @endforeach
    @if(!empty($gg))
    <div class="formSearch">
        <form action="{{route('banhang.giamgia.search')}}" method="get" role="search">
            <div class="input-group mb-3">
                <input style="height: 42px;" type="text" class="form-control" name="search" placeholder="Nhập thông tin tìm kiếm...">
                <button class="btn btn-success" id="button-search" type="submit">Search</button>
            </div>
        </form>
    </div>
    <div style="float:right;">
        <table border="0">
            <thead>
                <th>Từ ngày</th>
                <th>Đến ngày</th>
                <th></th>
            </thead>
            <tbody>
                <form action="{{route('banhang.giamgiatudenngay.search')}}" method="get" role="search">
                    <tr>
                        <td><input type="date" name="tuNgay" id="tuNgay"></td>
                        <td><input type="date" name="denNgay" id="denNgay"></td>
                        <td><button class="btn btn-success" type="submit" style="height: 30px;">Search</button></td>
                    </tr>
                    <tr>
                        <td><a class="btn btn-success m-1" href="{{route('banhang.giamgiahomnay.search')}}" role="button">Hôm nay</a></td>
                        <td></td>
                        <td></td>
                    </tr>
                </form>
            </tbody>
        </table>
    </div>
    <div style="float:left;width:473px;height:473px;">
        <table border="0">
            <tr style="text-align: center;">
                <td colspan="4">
                    <h3 class="title-mathang">Các loại khuyến mãi</h3>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><strong>Ngày bắt đầu</strong></td>
                <td><strong>Ngày kết thúc</strong></td>
            </tr>
            @foreach($giamgia as $gg)
            <tr style="font-family: Comic Sans MS cursive;">
                <td>{{++$i}}.</td>
                <td style="padding-right:25px;">
                    {{$gg['tenGG']}}
                </td>
                <?php
                $ngayBD = date_create($gg['ngayBD']);
                $ngayKT = date_create($gg['ngayKT'])
                ?>
                <td>{{date_format($ngayBD,"d-m-Y")}}</td>
                <td>{{date_format($ngayKT,"d-m-Y")}}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="4">{{ $giamgia->withQueryString()->links() }}</td>
            </tr>
        </table>
    </div>
    <div id="giamgia-private-pic">
        <img src="{{asset('hinhanh/khuyenmai1.png')}}" height="340" width="310" alt="Khuyến mãi" class="rounded"></br></br>
    </div>
    @else
    <div class="formSearch">
        <form action="{{route('banhang.giamgia.search')}}" method="get" role="search">
            <div class="input-group mb-3">
                <input style="height: 42px;" type="text" class="form-control" name="search" placeholder="Nhập thông tin tìm kiếm...">
                <button class="btn btn-success" id="button-search" type="submit">Search</button>
            </div>
        </form>
    </div>
    <div style="float:right;">
        <table border="0">
            <thead>
                <th>Từ ngày</th>
                <th>Đến ngày</th>
                <th></th>
            </thead>
            <tbody>
                <form action="{{route('banhang.giamgiatudenngay.search')}}" method="get" role="search">
                    <tr>
                        <td><input type="date" name="tuNgay" id="tuNgay"></td>
                        <td><input type="date" name="denNgay" id="denNgay"></td>
                        <td><button class="btn btn-success" type="submit" style="height: 30px;">Search</button></td>
                    </tr>
                    <tr>
                        <td><a class="btn btn-success m-1" href="{{route('banhang.giamgiahomnay.search')}}" role="button">Hôm nay</a></td>
                        <td></td>
                        <td></td>
                    </tr>
                </form>
            </tbody>
        </table>
    </div>
    <div style="float:left;width:473px;height:473px;">
        <h4 style="position:relative;top:249px;" class="title-mathang">Rất tiếc, không tìm thấy kết quả nào phù hợp với từ khóa "{{$nhap}}".</h4>
    </div>
    <div id="giamgia-private-pic">
        <img src="{{asset('hinhanh/khuyenmai1.png')}}" height="340" width="310" alt="Khuyến mãi" class="rounded"></br></br>
    </div>
    @endif
</div>
@endsection