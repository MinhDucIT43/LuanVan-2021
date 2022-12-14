@extends("./master")

@section('page_title')
Admin - Hoá đơn
@endsection

@section('convert_color_menu_hd')
active
@endsection

@section('main')
    <div class="formSearch" style="width:400px;margin-top:5px;">
        <form action="{{route('admin.hoadon.timkiemhoadon')}}" method="get" role="search">
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
                <form action="{{route('admin.hoadon.timkiemhoadontungaydenngay')}}" method="get" role="search">
                    <tr>
                        <td><input type="date" name="tuNgay" id="tuNgay"></td>
                        <td><input type="date" name="denNgay" id="denNgay"></td>
                        <td><button class="btn btn-success" type="submit" style="height: 30px;">Search</button></td>
                    </tr>
                    <tr>
                        <td><a class="btn btn-success m-1" href="{{route('admin.hoadon.timkiemhoadonhomnay')}}" role="button">Hôm nay</a></td>
                        <td></td>
                        <td></td>
                    </tr>
                </form>
            </tbody>
        </table>
    </div>
    <h2 class="title-nhanvien" style="margin-top: 86px;">HOÁ ĐƠN BÁN HÀNG</h2>
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
@endsection