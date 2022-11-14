@extends("./master")

@section('page_title')
    Admin - Chức vụ
@endsection

@section('convert_color_menu_cv')
    active
@endsection

@section('main')
    <h2 class="title-nhanvien">THÔNG TIN CHỨC VỤ</h2>
    @if(session('success-themchucvu'))
        <p style="color:#e32b56;"><i class="fas fa-check"></i> {{ session('success-themchucvu') }}</p>
    @endif
    <form action="{{route('admin.chucvu.search')}}" method="get" role="search">
        <label for="keyword">Tìm kiếm</label>
        <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Nhập từ khoá..." style="width:250px;display:inline;">
        <button class="fa fa-search" id="button-search" type="submit"></button>
    </form>
    <a class="btn btn-primary m-1" href="{{route('admin.chucvu.themchucvu')}}" role="button" id="button-themnhanvien">Thêm chức vụ</a>
    <div>
        @foreach($chucvu as $cv)
        @endforeach
        @if(!empty($cv))
            <table class="table table-bordered table-hover" id="table-dsnv">
                <thead class="table-primary">
                    <tr>
                        <th>STT</th>
                        <th id="thongtin-ten">Tên chức vụ</th>
                        <th class="thongtin-ngay">Tiền lương</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($chucvu as $cv)
                    <tr>
                        <td align="center">{{++$i}}</td>
                        <td>{{ $cv['tenCV'] }}</td>
                        <td>{{number_format($cv['tienluong'])}} VNĐ</td>
                        <td id="thaotac">
                            <a href="{{ route('admin.chucvu.suachucvu',['maCV' => $cv['maCV']]) }}"><i class="fas fa-wrench" style="color: #3b95ef"></i></a>
                            <a class="deleteChucVu" href="{{ route('admin.chucvu.xoachucvu',['maCV' => $cv['maCV']]) }}"><i class="fas fa-user-minus" style="color: #ff0000"></i></a>
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
    {{ $chucvu->links() }}
@endsection