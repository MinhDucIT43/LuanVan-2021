@extends("./datban")

@section('page_title')
Đặt bàn - Đã đặt bàn
@endsection

@section('convert_color_dadatban')
active
@endsection

@section('main')
<div id="dadatban">
    <h1 id="text-danhsachdatban">DANH SÁCH KHÁCH ĐẶT BÀN</h1>
    <p style="display: inline; margin-right: 20px; color: #FF4500"><i class="far fa-frown"></i> Chưa duyệt</p>
    <p style="display: inline; color: #0000FF;"><i class="far fa-smile"></i> Đã được duyệt</p>
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
                    <th class="columnName">Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                @foreach($datban as $db)
                <tr>
                    <td align="center">{{++$i}}</td>
                    <td>{{ $db['hoTen'] }}</td>
                    <td>{{ $db['email'] }}</td>
                    <td align="center">{{ $db['soDT'] }}</td>
                    <?php $ngayDat = date_create($db['ngayDat']) ?>
                    <td>{{$db['gioDat'].' giờ '.$db['phutDat'].' phút'}}<br />{{ date_format($ngayDat,"d-m-Y") }}</td>
                    <td>
                        @foreach(explode(',',$db['maban']) as $vl)
                            {{App\Models\ban::where('maban',$vl)->value('banso')}} <br/>
                        @endforeach
                    </td>
                    <td align="center">{{ $db['soNguoi'] }}</td>
                    <td>{{$db['tendangnhap']}}</td>
                    <td>{{ $db['ghiChu'] }}</td>
                    <td>
                        @switch($db['trangthai'])
                        @case (0) <a style="text-decoration: none;" href="{{ route('datban.getduyetbandat',['maDatBan' => $db['maDatBan']]) }}">
                            <p style="color: #FF4500"><i class="far fa-frown"></i> Chưa duyệt</p>
                        </a> @break
                        @case (1) <p style="color: #0000FF;"><i class="far fa-smile"></i> Đã được duyệt</p> @break
                        @endswitch
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $datban->links() }}
    </div>
</div>
@endsection