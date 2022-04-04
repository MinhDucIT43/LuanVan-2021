@extends("master")

@section('page_title')
    Admin - Thêm loại sản phẩm
@endsection

@section('convert_color_menu_lsp')
    active
@endsection

@section('main')
    <form action="{{route('postThemLoaiSanPham')}}" method="post" enctype="multipart/form-data" id="form-themchucvu"> @csrf
        <h2 id="title-themnhanvien" class="title-nhanvien">THÊM LOẠI SẢN PHẨM</h2>
        <table>
            <tr>
                <td><label for="tenloaisanpham">Tên loại sản phẩm</label></td>
                <td><input type="text" name="tenloaisanpham" id="tenloaisanpham" placeholder="Nhập tên loại sản phẩm" required=""/></td>
            </tr>
            <tr>
                <td></td>
                <td><input class="btn btn-primary m-1" type="submit" value="Thêm" onclick="return kiemtratenlsp()"></td>
            </tr>
        </table>
        <label id='errortenlsp'></label>
    </form>
@endsection