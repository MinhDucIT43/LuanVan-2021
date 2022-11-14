@extends("master")

@section('page_title')
    Admin - Sửa bàn ăn
@endsection

@section('convert_color_menu_b')
    active
@endsection

@section('main')
    @foreach($ban as $b)
    <form action="{{route('postSuaBan',['maban' => $b['maban']]) }}" method="post" enctype="multipart/form-data" id="form-themchucvu"> @csrf
        <h2 id="title-themnhanvien" class="title-nhanvien">SỬA BÀN ĂN</h2>
        <table>
            <tr>
                <td><label for="banso">Bàn số</label></td>
                <td><input type="text" name="banso" id="banso" value="{{$b->banso}}" placeholder="Nhập số bàn" required=""/></td>
            </tr>
            <tr>
                <td><label for="trangthai">Trạng thái</label></td>
                @switch($b->trangthai)
                    @case(0) 
                        <td>
                            <input type="radio" name="trangthai" id="trangthai" value="0" checked="checked"/>Trống
                            <input type="radio" name="trangthai" id="trangthai" value="1"/>Có khách
                        </td>
                        @break
                    @case(1)
                        <td>
                            <input type="radio" name="trangthai" id="trangthai" value="0"/>Trống
                            <input type="radio" name="trangthai" id="trangthai" value="1" checked="checked"/>Có khách
                        </td>
                        @break
                @endswitch
            </tr>
            <tr>
                <td></td>
                <td><input class="btn btn-primary m-1" type="submit" onclick="return kiemtrasoban()" value="Sửa"></td>
            </tr>
        </table>
        <label id='errorsoban'></label>
    </form>
    @endforeach
@endsection