@extends("./master")

@section('page_title')
    Admin - Vé Buffet
@endsection

@section('convert_color_menu_ve')
    active
@endsection

@section('main')
    <h2 class="title-nhanvien">THÔNG TIN VÉ BUFFET</h2>
    @if(session('success-themvebuffet'))
        <p style="color:#e32b56;"><i class="fas fa-check"></i> {{ session('success-themvebuffet') }}</p>
    @endif
    <form action="{{route('admin.ve.search')}}" method="get" role="search">
        <label for="keyword">Tìm kiếm</label>
        <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Nhập từ khoá..." style="width:250px;display:inline;">
        <button class="fa fa-search" id="button-search" type="submit"></button>
    </form>
    <a class="btn btn-primary m-1" href="{{route('admin.ve.themve')}}" role="button" id="button-themnhanvien">Thêm vé Buffet</a>
    <div>
        @foreach($vebuffet as $ve)
        @endforeach
            <table class="table table-bordered table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>STT</th>
                        <th id="thongtin-ten">Loại vé</th>
                        <th class="thongtin-ngay">Giá vé</th>
                        <th>Đơn vị tính</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($vebuffet as $ve)
                    <tr>
                        <td align="center">{{++$i}}</td>
                        <td>{{ $ve['tenve'] }}</td>
                        <td>{{number_format($ve['gia'])}} VNĐ</td>
                        <td>{{ App\Models\donvitinh::where('maDVT',$ve['maDVT'])->value('tenDVT') }}</td>
                        <td id="thaotac">
                            <a href="{{ route('admin.ve.suave',['mave' => $ve['mave']]) }}"><i class="fas fa-wrench" style="color: #3b95ef"></i></a>
                            <a class="deleteVe" href="{{ route('admin.ve.xoave',['mave' => $ve['mave']]) }}"><i class="fas fa-user-minus" style="color: #ff0000"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
    </div>
    {{ $vebuffet->links() }}
@endsection