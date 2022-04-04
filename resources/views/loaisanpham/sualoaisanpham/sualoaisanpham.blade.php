@extends("master")

@section('page_title')
    Admin - Sửa loại sản phẩm
@endsection

@section('convert_color_menu_lsp')
    active
@endsection

@section('main')
    @foreach($loaisanpham as $lsp)
    <form action="{{route('postSuaLoaiSanPham',['maLSP' => $lsp['maLSP']]) }}" method="post" enctype="multipart/form-data" id="form-themchucvu"> @csrf
        <h2 id="title-themnhanvien" class="title-nhanvien">SỬA LOẠI SẢN PHẨM</h2>
        <table>
            <tr>
                <td><label for="tenloaisanpham">Tên loại sản phẩm</label></td>
                <td><input type="text" name="tenloaisanpham" id="tenloaisanpham" value="{{$lsp->tenLSP}}" placeholder="Nhập tên loại sản phẩm" required=""/></td>
            </tr>
            <tr>
                <td></td>
                <td><input class="btn btn-primary m-1" type="submit" value="Sửa" onclick="return kiemtratenlsp()"></td>
            </tr>
        </table>
        <label id='errortenlsp'></label>
    </form>
    @endforeach
@endsection