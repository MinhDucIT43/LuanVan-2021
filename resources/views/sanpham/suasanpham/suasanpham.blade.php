@extends("master")

@section('page_title')
    Admin - Sửa sản phẩm
@endsection

@section('convert_color_menu_sp')
    active
@endsection

@section('main')
    @foreach($sanpham as $sp)
    <form action="{{route('postSuaSanPham',['maSP' => $sp['maSP']]) }}" method="post" enctype="multipart/form-data" id="form-themchucvu"> @csrf
        <h2 id="title-themnhanvien" class="title-nhanvien">SỬA SẢN PHẨM</h2>
        <table>
            <tr>
                <td><label for="tensanpham">Tên sản phẩm</label></td>
                <td><input type="text" name="tensanpham" id="tensanpham" placeholder="Nhập tên sản phẩm" value="{{$sp->tenSP}}" required=""/></td>
            </tr>
            <tr>
                <td><label for="thuocloai">Thuộc loại sản phẩm</label></td>
                <td>
                    <select name="thuocloai">
                    @foreach($loaisanpham as $lsp)
                        @if($sp->maLSP == $lsp->maLSP)
                            <option value="{{$lsp->maLSP}}" selected="selected" style="display:none">{{$lsp->tenLSP}}</option>
                        @endif
                            <option value="{{$lsp->maLSP}}">{{$lsp->tenLSP}}</option>
                    @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="gianhap">Giá nhập</label></td>
                <td><input type="text" id="gianhap" name="gianhap" placeholder="Nhập giá nhập" value="{{$sp->gianhap}}" required=""/></td>
            </tr>
            <tr>
                <td><label for="hansudung">Hạn sử dụng</label></td>
                <td><input type="date" id="hansudung" name="hansudung" value="{{$sp->HSD}}" required=""/></td>
            </tr>
            <tr>
                <td><label for="slnhap">Số lượng nhập</label></td>
                <td><input type="text" id="slnhap" name="slnhap" placeholder="Nhập số lượng" value="{{$sp->SLton}}" required=""/></td>
                <td>
                    <select name="donvitinh">
                    @foreach($donvitinh as $dvt)
                        @if($sp->maDVT == $dvt->maDVT)
                            <option value="{{$dvt->maDVT}}" selected="selected" style="display:none">{{$dvt->tenDVT}}</option>
                        @endif
                            <option value="{{$dvt->maDVT}}">{{$dvt->tenDVT}}</option>
                    @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input class="btn btn-primary m-1" type="submit" value="Sửa" onclick="return kiemtrathemsanpham()"></td>
            </tr>
        </table>
        <label id='errorgianhap'></label><br>
        <label id='errorsoluong'></label>
    </form>
    @endforeach
@endsection