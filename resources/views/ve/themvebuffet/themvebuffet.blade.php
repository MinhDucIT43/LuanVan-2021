@extends("master")

@section('page_title')
    Admin - Thêm vé Buffet
@endsection

@section('convert_color_menu_ve')
    active
@endsection

@section('main')
    <form action="{{route('postThemVeBuffet')}}" method="post" enctype="multipart/form-data" id="form-themchucvu"> @csrf
        <h2 id="title-themnhanvien" class="title-nhanvien">THÊM VÉ BUFFET</h2>
        <table>
            <tr>
                <td><label for="tenve">Loại vé</label></td>
                <td><input type="text" name="tenve" id="tenve" placeholder="Nhập loại vé" required=""/></td>
            </tr>
            <tr>
                <td><label for="gia">Giá vé</label></td>
                <td><input type="text" id="gia" name="gia" placeholder="Nhập giá vé" required=""/></td>
            </tr>
            <tr>
                <td><label for="donvitinh">Đơn vị tính</label></td>
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
                <td><input class="btn btn-primary m-1" type="submit" value="Thêm" onclick="return kiemtrave(gia)"></td>
            </tr>
        </table>
        <label id='errortenve'></label></br>
        <label id='errorgia'></label>
    </form>
@endsection