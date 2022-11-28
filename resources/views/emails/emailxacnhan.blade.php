<div id="emails">
    @foreach($banDat as $bd)
        <h3>Xin chào {{$bd->hoTen}}!</h3>
    @endforeach
    <p>Chúng tôi chân thành cảm ơn vì bạn đã quan tâm đến nhà hàng chúng tôi.</p>
    <p>Dưới đây là thông tin đặt bàn của bạn, vui lòng kiểm tra lại thông tin, nếu đồng ý thì nhấn vào nút xác nhận đặt bàn:</p>
    <table border="1" cellspacing="0" cellpadding="10" style="width: 100%;">
        <thead class="table-primary">
            <tr>
                <th>Tên khách hàng</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Đặt lúc</th>
                <th>Bàn</th>
                <th>Số người</th>
                <th>Ghi chú</th>
            </tr>
        </thead>
        <tbody>
            @foreach($banDat as $bd)
            <tr>
                <td>{{ $bd['hoTen'] }}</td>
                <td>{{ $bd['email'] }}</td>
                <td>{{ $bd['soDT'] }}</td>
                <?php $ngayDat = date_create($bd['ngayDat']) ?>
                <td>{{$bd['gioDat'].' giờ '.$bd['phutDat'].' phút'}}<br />{{ date_format($ngayDat,"d-m-Y") }}</td>
                <td>
                    @foreach(explode(',',$bd['maban']) as $vl)
                    {{App\Models\ban::where('maban',$vl)->value('banso')}} <br />
                    @endforeach
                </td>
                <td align="center">{{ $bd['soNguoi'] }}</td>
                <td>{{ $bd['ghiChu'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{route('emails.xacnhan',['maDatBan' => $bd['maDatBan']])}}" style="float:right; background:green; color:white; padding: 7px 25px; font-weight:bold">Xác nhận đặt bàn</a>
</div>