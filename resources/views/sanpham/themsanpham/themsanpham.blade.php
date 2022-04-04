@extends("master")

@section('page_title')
    Admin - Thêm sản phẩm
@endsection

@section('convert_color_menu_sp')
    active
@endsection

@section('main')
    <form action="{{route('postThemSanPham')}}" method="post" enctype="multipart/form-data" id="form-themchucvu"> @csrf
        <h2 id="title-themnhanvien" class="title-nhanvien">THÊM SẢN PHẨM</h2>
        <table>
            <tr>
                <td><label for="tensanpham">Tên sản phẩm</label></td>
                <td><input type="text" name="tensanpham" id="tensanpham" placeholder="Nhập tên sản phẩm" required=""/></td>
            </tr>
            <tr>
                <td><label for="thuocloai">Thuộc loại sản phẩm</label></td>
                <td>
                    <select name="thuocloai">
                    @foreach($loaisanpham as $lsp)
                        <option value="{{$lsp->maLSP}}">{{$lsp->tenLSP}}</option>
                    @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="gianhap">Giá nhập</label></td>
                <td><input type="text" id="gianhap" name="gianhap" placeholder="Nhập giá nhập" required=""/></td>
            </tr>
            <tr>
                <td><label for="hansudung">Hạn sử dụng</label></td>
                <td><input type="date" id="hansudung" name="hansudung" required=""/></td>
            </tr>
            <tr>
                <td><label for="slnhap">Số lượng nhập</label></td>
                <td><input type="text" id="slnhap" name="slnhap" placeholder="Nhập số lượng" required=""/></td>
                <td>
                    <select name="donvitinh">
                    @foreach($donvitinh as $dvt)
                        <option value="{{$dvt->maDVT}}">{{$dvt->tenDVT}}</option>
                    @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input class="btn btn-primary m-1" type="submit" value="Thêm" onclick="return kiemtrathemsanpham()"></td>
            </tr>
        </table>
        <label id='errorgianhap'></label><br>
        <label id='errorsoluong'></label>
    </form>
@endsection