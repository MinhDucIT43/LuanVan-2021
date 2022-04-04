@extends("master")

@section('page_title')
    Admin - Thêm chức vụ
@endsection

@section('convert_color_menu_cv')
    active
@endsection

@section('main')
    <form action="{{route('postThemChucVu')}}" method="post" enctype="multipart/form-data" id="form-themchucvu"> @csrf
        <h2 id="title-themnhanvien" class="title-nhanvien">THÊM CHỨC VỤ</h2>
        <table>
            <tr>
                <td><label for="tenchucvu">Tên chức vụ</label></td>
                <td><input type="text" name="tenchucvu" id="tenchucvu" placeholder="Nhập tên chức vụ" required=""/></td>
            </tr>
            <tr>
                <td><label for="tienluong">Tiền lương</label></td>
                <td><input type="text" id="tienluong" name="tienluong" placeholder="Nhập tiền lương" required=""/></td>
            </tr>
            <tr>
                <td></td>
                <td><input class="btn btn-primary m-1" type="submit" value="Thêm" onclick="return kiemtratienluong(tienluong)"></td>
            </tr>
        </table>
        <label id='errortenchucvu'></label></br>
        <label id='errortienluong'></label>
    </form>
@endsection