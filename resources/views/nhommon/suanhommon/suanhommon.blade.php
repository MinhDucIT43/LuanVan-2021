@extends("master")

@section('page_title')
    Admin - Sửa nhóm món ăn
@endsection

@section('convert_color_menu_nma')
    active
@endsection

@section('main')
    @foreach($nhommon as $nm)
    <form action="{{route('postSuaNhomMon',['maNM' => $nm['maNM']]) }}" method="post" enctype="multipart/form-data" id="form-themchucvu"> @csrf
        <h2 id="title-themnhanvien" class="title-nhanvien">SỬA NHÓM MÓN</h2>
        <table>
            <tr>
                <td><label for="tennhommon">Tên nhóm món ăn</label></td>
                <td><input type="text" name="tennhommon" id="tennhommon" value="{{$nm->tenNM}}" placeholder="Nhập tên nhóm món ăn" required=""/></td>
            </tr>
            <tr>
                <td></td>
                <td><input class="btn btn-primary m-1" type="submit" value="Sửa" onclick="return kiemtratennhommon()"></td>
            </tr>
        </table>
        <label id='errortennm'></label>
    </form>
    @endforeach
@endsection