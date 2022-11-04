@extends("master")

@section('page_title')
    Admin - Thêm món ăn
@endsection

@section('convert_color_menu_ma')
    active
@endsection

@section('main')
    <form action="{{route('postThemMonAn')}}" method="post" enctype="multipart/form-data" id="form-themchucvu"> @csrf
        <h2 id="title-themnhanvien" class="title-nhanvien">THÊM MÓN ĂN</h2>
        <table>
            <tr>
                <td><label for="tenmon">Tên món ăn</label></td>
                <td><input type="text" name="tenmon" id="tenmon" placeholder="Nhập tên món ăn" required=""/></td>
            </tr>
            <tr>
                <td><label for="thuocnhom">Thuộc nhóm món ăn</label></td>
                <td>
                    <select name="thuocnhom">
                    @foreach($nhommon as $nm)
                        <option value="{{$nm->maNM}}">{{$nm->tenNM}}</option>
                    @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="thuocve">Thuộc loại vé</label></td>
                <td>
                    <select name="thuocve">
                    @foreach($ve as $v)
                        <option value="{{$v->mave}}">{{$v->tenve}}</option>
                    @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="gia">Giá</label></td>
                <td><input type="text" id="gia" name="gia" placeholder="Nhập giá" required=""/></td>
            </tr>
            <tr>
                <td><label for="soluong">Số lượng</label></td>
                <td><input type="text" id="soluong" name="soluong" placeholder="Nhập số lượng" required=""/></td>
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
                <td><input class="btn btn-primary m-1" type="submit" value="Thêm" onclick="return kiemtrathemmon()"></td>
            </tr>
        </table>
        <label id='errorgia'></label><br>
        <label id='errorsoluong'></label>
    </form>
@endsection