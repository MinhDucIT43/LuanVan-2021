@extends("master")

@section('page_title')
    Admin - Sửa chức vụ
@endsection

@section('convert_color_menu_cv')
    active
@endsection

@section('main')
    @foreach($chucvu as $cv)
    <form action="{{route('postSuaChucVu',['maCV' => $cv['maCV']]) }}" method="post" enctype="multipart/form-data" id="form-themchucvu" onsubmit="return kiemtratienluong(tienluong)"> @csrf
        <h2 id="title-themnhanvien" class="title-nhanvien">SỬA CHỨC VỤ</h2>
        <table>
            <tr>
                <td><label for="tenchucvu">Tên chức vụ</label></td>
                <td><input type="text" name="tenchucvu" id="tenchucvu" value="{{$cv->tenCV}}" placeholder="Nhập tên chức vụ" required=""/></td>
            </tr>
            <tr>
                <td><label for="tienluong">Tiền lương</label></td>
                <td><input type="text" id="tienluong" name="tienluong" value="{{$cv->tienluong}}" placeholder="Nhập tiền lương" required=""/></td>
            </tr>
            <tr>
                <td></td>
                <td><input class="btn btn-primary m-1" type="submit" value="Sửa"></td>
            </tr>
        </table>
        <label id='errortenchucvu'></label></br>
        <label id='errortienluong'></label>
    </form>
    @endforeach
@endsection