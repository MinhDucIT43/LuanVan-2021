@extends("master")

@section('page_title')
    Admin - Thêm giảm giá
@endsection

@section('convert_color_menu_gg')
    active
@endsection

@section('main')
    <form action="{{route('postThemGiamGia')}}" method="post" enctype="multipart/form-data" id="form-themchucvu"> @csrf
        <h2 id="title-themnhanvien" class="title-nhanvien">THÊM GIẢM GIÁ</h2>
        <table>
            <tr>
                <td><label for="tenGG">Tên giảm giá</label></td>
                <td><input type="text" name="tenGG" id="tenGG" placeholder="Nhập tên giảm giá" required=""/></td>
            </tr>
            <tr>
                <td><label for="phanTramGG">Phần trăm giảm giá</label></td>
                <td><input type="text" name="phanTramGG" id="phanTramGG" placeholder="Nhập phần trăm giảm giá" required=""/></td>
            </tr>
            <tr>
                <td><label for="ngayBD">Ngày bắt đầu</label></td>
                <td><input type="date" id="ngayBD" name="ngayBD" required=""/></td>
            </tr>
            <tr>
                <td><label for="ngayKT">Ngày kết thúc</label></td>
                <td><input type="date" id="ngayKT" name="ngayKT" required=""/></td>
            </tr>
            <tr>
                <td></td>
                <td><input class="btn btn-primary m-1" type="submit" value="Thêm"></td>
            </tr>
        </table>
    </form>
@endsection