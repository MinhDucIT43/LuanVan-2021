@extends("./master")

@section('page_title')
    Admin - Bàn
@endsection

@section('convert_color_menu_b')
    active
@endsection

@section('main')
    <h2 class="title-nhanvien">THÔNG TIN BÀN ĂN</h2>
    @if(session('success-themban'))
        <p style="color:#e32b56;"><i class="fas fa-check"></i> {{ session('success-themban') }}</p>
    @endif
    <form action="{{route('admin.ban.search')}}" method="get" role="search">
        <label for="keyword">Tìm kiếm</label>
        <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Nhập từ khoá..." style="width:250px;display:inline;">
        <button class="fa fa-search" id="button-search" type="submit"></button>
    </form>
    <a class="btn btn-primary m-1" href="{{route('admin.ban.themban')}}" role="button" id="button-themnhanvien">Thêm bàn ăn</a>
    @foreach($ban as $b)
    @endforeach
    @if(!empty($b))
        <div>
            <table class="table table-bordered table-hover" id="table-dsb">
                <thead class="table-primary">
                    <tr>
                        <th>Bàn số</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($ban as $b)
                    <tr>
                        <td>{{ $b['banso'] }}</td>
                        <td>{{ $b['trangthai'] }}</td>
                        <td id="thaotac">
                            <a href="{{ route('admin.ban.suaban',['maban' => $b['maban']]) }}"><i class="fas fa-wrench" style="color: #3b95ef"></i></a>
                            <a href="{{ route('admin.ban.xoaban',['maban' => $b['maban']]) }}"><i class="fas fa-user-minus" style="color: #ff0000"></i></a>
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
    {{ $ban->links() }}
@endsection