@extends("./master")

@section('page_title')
    Admin - Sản phẩm
@endsection

@section('convert_color_menu_sp')
    active
@endsection

@section('main')
    <h2 class="title-nhanvien">THÔNG TIN SẢN PHẨM</h2>
    @if(session('success-themsanpham'))
        <p style="color:#e32b56;"><i class="fas fa-check"></i> {{ session('success-themsanpham') }}</p>
    @endif
    <form action="{{route('admin.sanpham.search')}}" method="get" role="search">
        <label for="keyword">Tìm kiếm</label>
        <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Nhập từ khoá..." style="width:250px;display:inline;">
        <button class="fa fa-search" id="button-search" type="submit"></button>
    </form>
    <a class="btn btn-primary m-1" href="{{route('admin.sanpham.themsanpham')}}" role="button" id="button-themnhanvien">Thêm sản phẩm</a>
    <div>
        @foreach($sanpham as $sp)
        @endforeach
        @if(!empty($sp))
            <table class="table table-bordered table-hover" id="danhsachnhanvien">
                <thead class="table-primary">
                    <tr>
                        <th>STT</th>
                        <th id="thongtin-ten">Tên sản phẩm</th>
                        <th>Giá nhập</th>
                        <th>Hạn sử dụng</th>
                        <th>Số lượng tồn kho</th>
                        <th>Thuộc loại</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($sanpham as $sp)
                    <tr>
                        <td align="center">{{++$i}}</td>
                        <td>{{ $sp['tenSP'] }}</td>
                        <td>{{ number_format($sp['gianhap']) }} VNĐ</td>
                        <?php $hsd = date_create($sp['HSD']) ?>
                        <td>{{date_format($hsd,"d-m-Y")}}</td>
                        <td>{{ $sp['SLton'] }}  {{ App\Models\donvitinh::where('maDVT',$sp['maDVT'])->value('tenDVT') }}</td>
                        <td>{{ App\Models\loaisanpham::where('maLSP',$sp['maLSP'])->value('tenLSP') }}</td>
                        <td id="thaotac">
                            <a href="{{ route('admin.sanpham.suasanpham',['maSP' => $sp['maSP']]) }}"><i class="fas fa-wrench" style="color: #3b95ef"></i></a>
                            <a href="{{ route('admin.sanpham.xoasanpham',['maSP' => $sp['maSP']]) }}"><i class="fas fa-user-minus" style="color: #ff0000"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <br/><br/>
            <h2>Rất tiếc, không tìm thấy kết quả nào phù hợp với từ khóa "{{$nhap}}".</h2>
        @endif
    </div>
    {{ $sanpham->links() }}
@endsection