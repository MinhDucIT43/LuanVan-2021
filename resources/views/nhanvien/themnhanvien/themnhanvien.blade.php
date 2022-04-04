@extends("master")

@section('page_title')
    Admin - Thêm nhân viên
@endsection

@section('convert_color_menu_nv')
    active
@endsection

@section('main')
    <form action="{{route('postThemNhanVien')}}" method="post" enctype="multipart/form-data" id="form-themnhanvien" onsubmit="return Kiemtranhapso(soDT)"> @csrf
        <h2 id="title-themnhanvien" class="title-nhanvien">THÊM NHÂN VIÊN</h2>
        <table>
            <tr>
                <td><label for="tennhanvien">Tên nhân viên</label></td>
                <td><input type="text" name="tennhanvien" id="tennhanvien" placeholder="Nhập tên nhân viên" required=""/></td>
                <td><label for="anhnhanvien">Hình ảnh</label></td>
                <td><input type="file" name="anhnhanvien" id="anhnhanvien" accept=".jpg,.png"></td>
            </tr>
            <tr>
                <td><label for="namsinh">Năm sinh</label></td>
                <td><input type="date" id="namsinh" name="namsinh" required=""/></td>
                <td><label for="gioitinh">Giới tính</label></td>
                <td>
                    <input type="radio" name="gioitinh" id="gioitinh" value="Nam" checked="checked"/>Nam
                    <input type="radio" name="gioitinh" id="gioitinh" value="Nữ"/>Nữ
                </td>
            </tr>
            <tr>
                <td><label for="diachi">Địa chỉ</label></td>
                <td><textarea name="diachi" id="diachi" cols="21" rows="6" placeholder="Nhập địa chỉ nhân viên" required=""></textarea></td>
                <td><label for="matkhau">Mật khẩu</label></td>
                <td><input type="password" name="matkhau" id="matkhau" placeholder="Nhập mật khẩu nhân viên" required=""/></td>
            </tr>
            <tr>
                <td><label for="soDT">Số điện thoại</label></td>
                <td><input type="text" name="soDT" id="soDT" placeholder="Nhập số điện thoại" required=""/></td>
                <td><label for="ngayvaolam">Ngày vào làm</label></td>
                <td><input type="date" id="ngayvaolam" name="ngayvaolam" required=""/></td>
            </tr>
            <tr>
                <td><label for="chucvu">Chức vụ</label></td>
                <td>
                    <select name="chucvu">
                    @foreach($chucvu as $cv)
                        <option value="{{$cv->maCV}}">{{$cv->tenCV}}</option>
                    @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input class="btn btn-primary m-1" type="submit" value="Thêm" onclick="return Kiemtranhapso(soDT)"></td>
            </tr>
        </table>
        <label id='errorsoDT'></label></br>
        <label id='errornamsinh'></label></br>
    </form>
@endsection