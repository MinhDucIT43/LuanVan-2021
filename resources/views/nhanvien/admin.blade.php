@extends("master")

@section('page_title')
    Admin - Nhân viên
@endsection

@section('convert_color_menu_nv')
    active
@endsection

@section('main')
    <h2 class="title-nhanvien">THÔNG TIN NHÂN VIÊN</h2>
    @if(session('success-themnhanvien'))
        <p style="color:#e32b56;"><i class="fas fa-check"></i> {{ session('success-themnhanvien') }}</p>
    @endif
    <form action="{{route('admin.nhanvien.search')}}" method="get" role="search">
        <label for="keyword">Tìm kiếm</label>
        <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Nhập từ khoá..." style="width:250px;display:inline;">
        <select name="timkiemdanhmuc" id="timkiemdanhmuc">
            <option value="">Danh mục</option>
            <optgroup label="Chức vụ">
                @foreach($chucvu as $cv)
                    <option value="{{$cv->maCV}}">{{$cv['tenCV']}}</option>
                @endforeach
            </optgroup>
            <optgroup label="Giới tính">
                <option value="Nam">Nam</option>
                <option value="Nữ">Nữ</option>
            </optgroup>
        </select>
        <button class="btn btn-success" id="button-search" type="submit">Search</button>
    </form>
    <a class="btn btn-primary m-1" href="{{route('admin.nhanvien.themnhanvien')}}" role="button" id="button-themnhanvien">Thêm nhân viên</a>
    <div>
        @foreach($nhanvien as $nv)
        @endforeach
        @if(!empty($nv))
            <table class="table table-bordered table-hover" id="danhsachnhanvien">
                <thead class="table-primary">
                <tr>
                    <th>Tên nhân viên</th>
                    <th>Ảnh</th>
                    <th>Năm sinh</th>
                    <th>Giới tính</th>
                    <th>Địa chỉ</th>
                    <th>Số điện thoại</th>
                    <th>Ngày vào làm</th>
                    <th class="tendangnhap">Tên đăng nhập</th>
                    <th>Chức vụ</th>
                    <th>Thao tác</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($nhanvien as $nv)
                    <tr>
                        <td>{{$nv['tenNV']}}</td>
                        <td><img id="anhnhanvien" src="{{asset('anhnhanvien/'.$nv['anhnhanvien'])}}" alt="{{$nv['anhnhanvien']}}"></td>
                        <?php $namsinh = date_create($nv['namsinh']) ?>
                        <td>{{date_format($namsinh,"d-m-Y")}}</td>
                        <td>{{$nv['gioitinh']}}</td>
                        <td>{{$nv['diachi']}}</td>
                        <td>{{$nv['soDT']}}</td>
                        <?php $ngayvaolam = date_create($nv['ngayvaolam']) ?>
                        <td>{{date_format($ngayvaolam,"d-m-Y")}}</td>
                        <td class="tendangnhap">{{$nv['tendangnhap']}}</td>
                        <td>{{App\Models\chucvu::where('maCV',$nv['maCV'])->value('tenCV')}}</td>
                        <td>
                            <a href="{{ route('admin.nhanvien.suanhanvien',['tendangnhap' => $nv['tendangnhap']]) }}" class="icon-sua-xoa"><i class="fas fa-wrench"></i></a>
                            <a href="{{ route('admin.nhanvien.xoanhanvien',['tendangnhap' => $nv['tendangnhap']]) }}" class="icon-sua-xoa deleteNhanVien" style="color:red;"><i class="fas fa-user-minus"></i></a>
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
    {{ $nhanvien->links() }}
@endsection