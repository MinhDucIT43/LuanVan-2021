@extends("master")

@section('page_title')
    Admin - Thêm đơn vị tính
@endsection

@section('convert_color_menu_dvt')
    active
@endsection

@section('main')
    <form action="" method="post" enctype="multipart/form-data" id="form-themchucvu"> @csrf
        <h2 id="title-themnhanvien" class="title-nhanvien">THÊM ĐƠN VỊ TÍNH</h2>
        <table>
            <tr>
                <td><label for="tendonvitinh">Tên đơn vị tính</label></td>
                <td><input type="text" name="tendonvitinh" id="tendonvitinh" placeholder="Nhập tên đơn vị tính" required=""/></td>
            </tr>
            <tr>
                <td></td>
                <td><input class="btn btn-primary m-1" type="submit" value="Thêm" onclick="return kiemtratendvt()"></td>
            </tr>
        </table>
        <label id='errortendvt'></label>
    </form>
@endsection