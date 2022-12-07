@extends("master")

@section('page_title')
    Admin - Sửa giảm giá
@endsection

@section('convert_color_menu_gg')
    active
@endsection

@section('main')
    @foreach($giamgia as $gg)
    <form action="{{route('postSuaGiamGia',['maGG' => $gg['maGG']]) }}" method="post" enctype="multipart/form-data" id="form-themchucvu"> @csrf
        <h2 id="title-themnhanvien" class="title-nhanvien">SỬA GIẢM GIÁ</h2>
        <table>
            <tr>
                <td><label for="tenGG">Bàn số</label></td>
                <td><input type="text" name="tenGG" id="tenGG" value="{{$gg->tenGG}}" placeholder="Nhập tên giảm giá" required=""/></td>
            </tr>
            <tr>
                <td><label for="phanTramGG">Phần trăm giảm giá</label></td>
                <td><input type="text" name="phanTramGG" id="phanTramGG" value="{{$gg->phanTramGG}}" placeholder="Nhập phần trăm giảm giá" required=""/></td>
            </tr>
            <tr>
                <td><label for="ngayBD">Ngày bắt đầu</label></td>
                <td><input type="date" id="ngayBD" name="ngayBD" value="{{$gg->ngayBD}}" required=""/></td>
            </tr>
            <tr>
                <td><label for="ngayKT">Ngày kết thúc</label></td>
                <td><input type="date" id="ngayKT" name="ngayKT" value="{{$gg->ngayKT}}" required=""/></td>
            </tr>
            <tr>
                <td></td>
                <td><input class="btn btn-primary m-1" type="submit" value="Sửa"></td>
            </tr>
        </table>
    </form>
    @endforeach
@endsection