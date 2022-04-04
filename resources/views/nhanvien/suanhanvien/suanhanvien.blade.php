@extends("master")

@section('page_title')
    Admin - Sửa nhân viên
@endsection

@section('convert_color_menu_nv')
    active
@endsection

@section('main')
    @foreach($nhanvien as $nv)
    <form action="{{route('postSuaNhanVien',['tendangnhap' => $nv['tendangnhap']]) }}" method="post" enctype="multipart/form-data" id="form-themnhanvien" onsubmit="return Kiemtranhapso(soDT)"> @csrf
        <h2 id="title-themnhanvien" class="title-nhanvien">SỬA NHÂN VIÊN</h2>
        <table>
            <tr>
                <td><label for="tennhanvien">Tên nhân viên</label></td>
                <td><input type="text" name="tennhanvien" id="tennhanvien" value="{{$nv->tenNV}}" placeholder="Nhập tên nhân viên" required=""/></td>
                <td><label for="anhnhanvien">Hình ảnh</label></td>
                <td><input type="file" name="anhnhanvien" id="anhnhanvien" accept=".jpg,.png"><img id="anh" src="{{asset('anhnhanvien/'.$nv['anhnhanvien'])}}" alt="{{$nv['anhnhanvien']}}"></td>
            </tr>
            <tr>
                <td><label for="namsinh">Năm sinh</label></td>
                <td><input type="date" id="namsinh" name="namsinh" value="{{$nv->namsinh}}" required=""></td>
                <td><label for="gioitinh">Giới tính</label></td>
                @if($nv->gioitinh == 'Nam')
                <td>
                    <input type="radio" name="gioitinh" id="gioitinh" value="Nam" checked="checked"/>Nam
                    <input type="radio" name="gioitinh" id="gioitinh" value="Nữ"/>Nữ
                </td>
                @elseif($nv->gioitinh == 'Nữ')
                <td>
                    <input type="radio" name="gioitinh" id="gioitinh" value="Nam"/>Nam
                    <input type="radio" name="gioitinh" id="gioitinh" value="Nữ" checked="checked"/>Nữ
                </td>
                @endif
            </tr>
            <tr>
                <td><label for="diachi">Địa chỉ</label></td>
                <td><textarea name="diachi" id="diachi" cols="21" rows="6" placeholder="Nhập địa chỉ nhân viên" required="">{{$nv->diachi}}</textarea></td>
                <td><label for="matkhau">Mật khẩu</label></td>
                <td><input type="password" name="matkhau" id="matkhau" value="{{$nv->matkhau}}" placeholder="Nhập mật khẩu nhân viên" required=""/></td>
            </tr>
            <tr>
                <td><label for="soDT">Số điện thoại</label></td>
                <td><input type="text" name="soDT" id="soDT" value="{{$nv->soDT}}" placeholder="Nhập số điện thoại" required=""/></td>
                <td><label for="ngayvaolam">Ngày vào làm</label></td>
                <td><input type="date" id="ngayvaolam" name="ngayvaolam" value="{{$nv->ngayvaolam}}" required=""></td>
            </tr>
            <tr>
                <td><label for="chucvu">Chức vụ</label></td>
                <td>
                    <select name="chucvu">
                    @foreach($chucvu as $cv)
                        @if($nv->maCV == $cv->maCV)
                            <option value="{{$cv->maCV}}" selected="selected" style="display:none">{{$cv->tenCV}}</option>
                        @endif
                            <option value="{{$cv->maCV}}">{{$cv->tenCV}}</option>
                    @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input class="btn btn-primary m-1" type="submit" value="Sửa" onclick="return Kiemtranhapso(soDT)"></td>
            </tr>
        </table>
        @endforeach
        <label id='errorsoDT'></label></br>
        <label id='errornamsinh'></label></br>
    </form>
@endsection