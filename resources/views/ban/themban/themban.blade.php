@extends("master")

@section('page_title')
    Admin - Thêm bàn ăn
@endsection

@section('convert_color_menu_b')
    active
@endsection

@section('main')
    <form action="{{route('postThemBan')}}" method="post" enctype="multipart/form-data" id="form-themchucvu"> @csrf
        <h2 id="title-themnhanvien" class="title-nhanvien">THÊM BÀN ĂN</h2>
        <table>
            <tr>
                <td><label for="banso">Bàn số</label></td>
                <td><input type="text" name="banso" id="banso" placeholder="Nhập số bàn" required=""/></td>
            </tr>
            <tr>
                <td><label for="trangthai">Trạng thái</label></td>
                <td>
                    <input type="radio" name="trangthai" id="trangthai" value="0" checked="checked"/>Trống
                    <input type="radio" name="trangthai" id="trangthai" value="1"/>Có khách
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input class="btn btn-primary m-1" type="submit" value="Thêm" onclick="return kiemtrasoban()"></td>
            </tr>
        </table>
        <label id='errorsoban'></label>
    </form>
@endsection