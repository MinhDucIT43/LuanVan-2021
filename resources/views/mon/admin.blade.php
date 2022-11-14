@extends("./master")

@section('page_title')
    Admin - Món ăn
@endsection

@section('convert_color_menu_ma')
    active
@endsection

@section('main')
    <h2 class="title-nhanvien">THÔNG TIN MÓN ĂN</h2>
    @if(session('success-themmonan'))
        <p style="color:#e32b56;"><i class="fas fa-check"></i> {{ session('success-themmonan') }}</p>
    @endif
    <form action="{{route('admin.mon.search')}}" method="get" role="search">
        <label for="keyword">Tìm kiếm</label>
        <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Nhập từ khoá..." style="width:250px;display:inline;">
        <select name="timkiemdanhmuc" id="timkiemdanhmuc">
            <option value="">Danh mục</option>
            <optgroup label="Nhóm món">
                @foreach($nhommon as $nm)
                    <option value="{{$nm->maNM}}">{{$nm['tenNM']}}</option>
                @endforeach
            </optgroup>
            <optgroup label="Loại vé">
                @foreach($loaive as $lv)
                    <option value="{{$lv->mave}}">{{$lv['tenve']}}</option>
                @endforeach
            </optgroup>
        </select>
        <button class="fa fa-search" id="button-search" type="submit"></button>
    </form>
    <a class="btn btn-primary m-1" href="{{route('admin.mon.themmon')}}" role="button" id="button-themnhanvien">Thêm món ăn</a>
    <div>
        @foreach($mon as $ma)
        @endforeach
        @if(!empty($ma))
            <table class="table table-bordered table-hover" id="danhsachnhanvien">
                <thead class="table-primary">
                    <tr>
                        <th>STT</th>
                        <th>Tên món ăn</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Thuộc nhóm món</th>
                        <th>Thuộc loại vé</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($mon as $ma)
                    <tr>
                        <td align="center">{{++$i}}</td>
                        <td>{{ $ma['tenmon'] }}</td>
                        <td>{{ number_format($ma['gia']) }} VNĐ</td>
                        <td>{{ $ma['soluong'] }}  {{ App\Models\donvitinh::where('maDVT',$ma['maDVT'])->value('tenDVT') }}</td>
                        <td>{{ App\Models\nhommon::where('maNM',$ma['maNM'])->value('tenNM') }}</td>
                        <td>{{ App\Models\ve::where('mave',$ma['mave'])->value('tenve') }}</td>
                        <td id="thaotac">
                            <a href="{{ route('admin.mon.suamon',['mamon' => $ma['mamon']]) }}"><i class="fas fa-wrench" style="color: #3b95ef"></i></a>
                            <a class="deleteMonAn" href="{{ route('admin.mon.xoamon',['mamon' => $ma['mamon']]) }}"><i class="fas fa-user-minus" style="color: #ff0000"></i></a>
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
    {{ $mon->links() }}
@endsection