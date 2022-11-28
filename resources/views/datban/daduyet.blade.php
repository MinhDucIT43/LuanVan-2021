@extends("./datban")

@section('page_title')
Đặt bàn - Đã duyệt
@endsection

@section('convert_color_daduyet')
active
@endsection

@section('main')
<div id="daduyet">
    @foreach($daduyet as $dd)
    @endforeach
    @if(!empty($dd))
        <h1 id="text-danhsachdatban">DANH SÁCH ĐẶT BÀN ĐÃ ĐƯỢC DUYỆT</h1>
        <div id="danhsachdatban">
            <table class="table table-bordered table-hover table-striped">
                <thead class="table-primary">
                    <tr>
                        <th class="columnName">STT</th>
                        <th class="columnName">Tên khách hàng</th>
                        <th class="columnName">Email</th>
                        <th class="columnName">Số điện thoại</th>
                        <th class="columnName">Đặt lúc</th>
                        <th class="columnName">Bàn</th>
                        <th class="columnName">Số người</th>
                        <th class="columnName">Nhân viên duyệt</th>
                        <th class="columnName">Ghi chú</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($daduyet as $dd)
                    <tr>
                        <td align="center">{{++$i}}</td>
                        <td>{{ $dd['hoTen'] }}</td>
                        <td>{{ $dd['email'] }}</td>
                        <td align="center">{{ $dd['soDT'] }}</td>
                        <?php $ngayDat = date_create($dd['ngayDat']) ?>
                        <td>{{$dd['gioDat'].' giờ '.$dd['phutDat'].' phút'}}<br />{{ date_format($ngayDat,"d-m-Y") }}</td>
                        <td>
                            @foreach(explode(',',$dd['maban']) as $vl)
                                {{App\Models\ban::where('maban',$vl)->value('banso')}} <br/>
                            @endforeach
                        </td>
                        <td align="center">{{ $dd['soNguoi'] }}</td>
                        <td>{{$dd['tendangnhap']}}</td>
                        <td>{{$dd['ghiChu']}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $daduyet->links() }}
        </div>
    @else
        <h1>Chưa duyệt đơn đặt bàn nào.</h1>
    @endif
</div>
@endsection