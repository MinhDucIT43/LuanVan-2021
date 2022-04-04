@extends("./master")

@section('page_title')
    Admin - Loại sản phẩm
@endsection

@section('convert_color_menu_lsp')
    active
@endsection

@section('main')
    <h2 class="title-nhanvien">THÔNG TIN LOẠI SẢN PHẨM</h2>
    @if(session('success-themloaisanpham'))
        <p style="color:#e32b56;"><i class="fas fa-check"></i> {{ session('success-themloaisanpham') }}</p>
    @endif
    <form action="{{route('admin.loaisanpham.search')}}" method="get" role="search">
        <label for="keyword">Tìm kiếm</label>
        <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Nhập từ khoá..." style="width:250px;display:inline;">
        <button class="fa fa-search" id="button-search" type="submit"></button>
    </form>
    <a class="btn btn-primary m-1" href="{{route('admin.loaisanpham.themloaisanpham')}}" role="button" id="button-themnhanvien">Thêm loại sản phẩm</a>
    @foreach($loaisanpham as $lsp)
    @endforeach
    @if(!empty($lsp))
        <div id="table-dsnv">
            <table class="table table-bordered table-hover">
                <thead class="table-primary">
                    <tr>
                        <th id="thongtin-ten">Tên loại sản phẩm</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($loaisanpham as $lsp)
                    <tr>
                        <td>{{ $lsp['tenLSP'] }}</td>
                        <td id="thaotac">
                            <a href="{{ route('admin.loaisanpham.sualoaisanpham',['maLSP' => $lsp['maLSP']]) }}"><i class="fas fa-wrench" style="color: #3b95ef"></i></a>
                            <a href="{{ route('admin.loaisanpham.xoaloaisanpham',['maLSP' => $lsp['maLSP']]) }}"><i class="fas fa-user-minus" style="color: #ff0000"></i></a>
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
    {{ $loaisanpham->links() }}
@endsection