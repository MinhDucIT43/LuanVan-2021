@extends("master")

@section('page_title')
    Admin - Sửa món ăn
@endsection

@section('convert_color_menu_ma')
    active
@endsection

@section('main')
    @foreach($mon as $m)
    <form action="{{route('postSuaMon',['mamon' => $m['mamon']]) }}" method="post" enctype="multipart/form-data" id="form-themchucvu"> @csrf
        <h2 id="title-themnhanvien" class="title-nhanvien">SỬA MÓN ĂN</h2>
        <table>
            <tr>
                <td><label for="tenmon=">Tên món ăn</label></td>
                <td><input type="text" name="tenmon" id="tenmon" placeholder="Nhập tên món ăn" value="{{$m->tenmon}}" required=""/></td>
            </tr>
            <tr>
                <td><label for="thuocnhom">Thuộc nhóm món ăn</label></td>
                <td>
                    <select name="thuocnhom">
                    @foreach($nhommon as $nm)
                        @if($m->maNM == $nm->maNM)
                            <option value="{{$nm->maNM}}" selected="selected" style="display:none">{{$nm->tenNM}}</option>
                        @endif
                            <option value="{{$nm->maNM}}">{{$nm->tenNM}}</option>
                    @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="gia">Giá</label></td>
                <td><input type="text" id="gia" name="gia" placeholder="Nhập giá" value="{{$m->gia}}" required=""/></td>
            </tr>
            <tr>
                <td><label for="soluong">Số lượng</label></td>
                <td><input type="text" id="soluong" name="soluong" placeholder="Nhập số lượng" value="{{$m->soluong}}" required=""/></td>
                <td>
                    <select name="donvitinh">
                    @foreach($donvitinh as $dvt)
                        @if($m->maDVT == $dvt->maDVT)
                            <option value="{{$dvt->maDVT}}" selected="selected" style="display:none">{{$dvt->tenDVT}}</option>
                        @endif
                            <option value="{{$dvt->maDVT}}">{{$dvt->tenDVT}}</option>
                    @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input class="btn btn-primary m-1" type="submit" value="Sửa" onclick="return kiemtrathemmon()"></td>
            </tr>
        </table>
        <label id='errorgia'></label><br>
        <label id='errorsoluong'></label>
    </form>
    @endforeach
@endsection