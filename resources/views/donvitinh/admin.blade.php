@extends("./master")

@section('page_title')
    Admin - Chức vụ
@endsection

@section('convert_color_menu_dvt')
    active
@endsection

@section('main')
    <h2 class="title-nhanvien">THÔNG TIN ĐƠN VỊ TÍNH</h2>
    @if(session('success-themdonvitinh'))
        <p style="color:#e32b56;"><i class="fas fa-check"></i> {{ session('success-themdonvitinh') }}</p>
    @endif
    <form action="{{route('admin.donvitinh.search')}}" method="get" role="search">
        <label for="keyword">Tìm kiếm</label>
        <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Nhập từ khoá..." style="width:250px;display:inline;">
        <button class="fa fa-search" id="button-search" type="submit"></button>
    </form>
    <a class="btn btn-primary m-1" href="{{route('admin.donvitinh.themdonvitinh')}}" role="button" id="button-themnhanvien">Thêm đơn vị tính</a>
    @foreach($donvitinh as $dvt)
    @endforeach
    @if(!empty($dvt))
        <div id="table-dsnv">
            <table class="table table-bordered table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>STT</th>
                        <th id="thongtin-ten">Tên đơn vị tính</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($donvitinh as $dvt)
                    <tr>
                        <td align="center">{{++$i}}</td>
                        <td>{{ $dvt['tenDVT'] }}</td>
                        <td id="thaotac">
                            <a href="{{ route('admin.donvitinh.suadonvitinh',['maDVT' => $dvt['maDVT']]) }}"><i class="fas fa-wrench" style="color: #3b95ef"></i></a>
                            <a class="deleteDonViTinh" href="{{ route('admin.donvitinh.xoadonvitinh',['maDVT' => $dvt['maDVT']]) }}"><i class="fas fa-user-minus" style="color: #ff0000"></i></a>
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
    {{ $donvitinh->links() }}
@endsection