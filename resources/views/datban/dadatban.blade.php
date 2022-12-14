@extends("./datban")

@section('page_title')
Đặt bàn - Đã đặt bàn
@endsection

@section('convert_color_dadatban')
active
@endsection

@section('main')
<div id="dadatban">
    @foreach($datban as $db)
    @endforeach
    @if(!empty($db))
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
                        <th class="columnName">Khách hàng xác nhận</th>
                        <th class="columnName">Nhân viên duyệt</th>
                        <th></th>
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
                            @foreach($chitiet_datban as $ctdb)
                                @if($ctdb->maDatBan == $db['maDatBan'])
                                    {{App\Models\ban::where('maban',$ctdb->maban)->value('banso')}}<br/>
                                @endif
                            @endforeach
                        </td>
                        <td align="center">{{ $db['soNguoi'] }}</td>
                        <td>{{App\Models\nhanvien::where('tendangnhap',$db['tendangnhap'])->value('tenNV')}}</td>
                        <td>{{ $db['ghiChu'] }}</td>
                        <td>
                            @switch($db['accept'])
                                @case (0) <strong style="background-color:#FF4500;color:white;padding:8px;">Chưa xác nhận</strong> @break
                                @case (1) <strong style="background-color:green;color:white;padding:8px;">Đã xác nhận</strong> @break
                            @endswitch
                        </td>
                        <td>
                            @switch($db['trangthai'])
                                @case (0) <a style="text-decoration: none;" href="{{ route('datban.getduyetbandat',['maDatBan' => $db['maDatBan']]) }}">
                                    <p style="color: #FF4500"><i class="far fa-frown"></i> Chưa duyệt</p>
                                </a> @break
                                @case (1) <p style="color: green;"><i class="far fa-smile"></i> Đã được duyệt</p> @break
                            @endswitch
                        </td>
                        <td>
                            @if($db['huy']==1)
                                <a href="" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Đã huỷ</a>
                                <ul class="dropdown-menu">
                                    <li><strong>Lý do:</strong> {{App\Models\huydatban::where('maDatBan',$db['maDatBan'])->value('lyDo')}}</li>
                                </ul>
                            @else
                                <a href="" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Huỷ</a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <form action="{{route('postHuyDatBan')}}" method="post" enctype="multipart/form-data"> @csrf
                                            <input type="hidden" name="maDatBan" value="{{$db['maDatBan']}}">
                                            <div class="mb-3" style="padding: 0px 20px 0px 20px;">
                                                <label for="inputLyDo" class="form-label"><strong>Nhập lý do huỷ đơn đặt bàn này:</strong></label>
                                                <textarea class="form-control" rows="3" width="30" id="descriptionInput" name="inputLyDo"></textarea>
                                                <button class="btn btn-danger" type="submit" name="submit" style="float:right; margin-top: 10px">Huỷ đặt bàn</button>
                                            </div>
                                        </form>
                                    </li>
                                </ul>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $datban->links() }}
        </div>
    @else
        <h1>Chưa có đơn đặt bàn nào.</h1>
    @endif
</div>
@endsection