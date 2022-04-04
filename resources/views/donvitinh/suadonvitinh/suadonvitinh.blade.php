@extends("master")

@section('page_title')
    Admin - Sửa đơn vị tính
@endsection

@section('convert_color_menu_dvt')
    active
@endsection

@section('main')
    @foreach($donvitinh as $dvt)
    <form action="{{route('postSuaDonViTinh',['maDVT' => $dvt['maDVT']]) }}" method="post" enctype="multipart/form-data" id="form-themchucvu"> @csrf
        <h2 id="title-themnhanvien" class="title-nhanvien">SỬA ĐƠN VỊ TÍNH</h2>
        <table>
            <tr>
                <td><label for="tendonvitinh">Tên đơn vị tính</label></td>
                <td><input type="text" name="tendonvitinh" id="tendonvitinh" value="{{$dvt->tenDVT}}" placeholder="Nhập tên đơn vị tính" required=""/></td>
            </tr>
            <tr>
                <td></td>
                <td><input class="btn btn-primary m-1" type="submit" value="Sửa" onclick="return kiemtratendvt()"></td>
            </tr>
        </table>
        <label id='errortendvt'></label>
    </form>
    @endforeach
@endsection