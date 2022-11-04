@extends("./master")

@section('page_title')
    Admin - Nhóm món ăn
@endsection

@section('convert_color_menu_nma')
    active
@endsection

@section('main')
    <h2 class="title-nhanvien">THÔNG TIN NHÓM MÓN ĂN</h2>
    @if(session('success-themnhommon'))
        <p style="color:#e32b56;"><i class="fas fa-check"></i> {{ session('success-themnhommon') }}</p>
    @endif
    <form action="{{route('admin.nhommon.search')}}" method="get" role="search">
        <label for="keyword">Tìm kiếm</label>
        <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Nhập từ khoá..." style="width:250px;display:inline;">
        <button class="fa fa-search" id="button-search" type="submit"></button>
    </form>
    <a class="btn btn-primary m-1" href="{{route('admin.nhommon.themnhommon')}}" role="button" id="button-themnhanvien">Thêm nhóm món ăn</a>
    @foreach($nhommon as $nm)
    @endforeach
    @if(!empty($nm))
        <div id="table-dsnv">
            <table class="table table-bordered table-hover">
                <thead class="table-primary">
                    <tr>
                        <th id="thongtin-ten">Tên nhóm món ăn</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($nhommon as $nm)
                    <tr>
                        <td>{{ $nm['tenNM'] }}</td>
                        <td id="thaotac">
                            <a href="{{ route('admin.nhommon.suanhommon',['maNM' => $nm['maNM']]) }}"><i class="fas fa-wrench" style="color: #3b95ef"></i></a>
                            <a class="deleteNhomMon" href="{{ route('admin.nhommon.xoanhommon',['maNM' => $nm['maNM']]) }}"><i class="fas fa-user-minus" style="color: #ff0000"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @else
        <br/><br/>
        <h2>Rất tiếc, không tìm thấy kết quả nào phù hợp với từ khóa "{{$nhap}}".</h2>
    @endif
    {{ $nhommon->links() }}
@endsection