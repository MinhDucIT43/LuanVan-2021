@extends("./master")

@section('page_title')
    Admin - Giảm giá
@endsection

@section('convert_color_menu_gg')
    active
@endsection

@section('main')
    <h2 class="title-nhanvien">THÔNG TIN GIẢM GIÁ</h2>
    @if(session('success-themban'))
        <p style="color:#e32b56;"><i class="fas fa-check"></i> {{ session('success-themban') }}</p>
    @endif
    <form action="#" method="get" role="search">
        <label for="keyword">Tìm kiếm</label>
        <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Nhập từ khoá..." style="width:250px;display:inline;">
        <button class="fa fa-search" id="button-search" type="submit"></button>
    </form>
    <a class="btn btn-primary m-1" href="{{route('admin.giamgia.themgiamgia')}}" role="button" id="button-themnhanvien">Thêm giảm giá</a>
    @foreach($giamgia as $gg)
    @endforeach
    @if(!empty($gg))
        <div>
            <table class="table table-bordered table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>STT</th>
                        <th>Giảm giá</th>
                        <th style="width:96px;">Phần trăm giảm giá</th>
                        <th>Ngày bắt đầu</th>
                        <th>Ngày kết thúc</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($giamgia as $gg)
                    <tr>
                        <td align="center">{{++$i}}</td>
                        <td>{{ $gg['tenGG'] }}</td>
                        <td>{{ $gg['phanTramGG'] }}</td>
                        <?php 
                            $ngayBD = date_create($gg['ngayBD']);
                            $ngayKT = date_create($gg['ngayKT']) 
                        ?>
                        <td>{{date_format($ngayBD,"d-m-Y")}}</td>
                        <td>{{date_format($ngayKT,"d-m-Y")}}</td>
                        <td id="thaotac">
                            <a href="{{ route('admin.giamgia.suagiamgia',['maGG' => $gg['maGG']]) }}"><i class="fas fa-wrench" style="color: #3b95ef"></i></a>
                            <a href="{{ route('admin.giamgia.xoagiamgia',['maGG' => $gg['maGG']]) }}"><i class="fas fa-user-minus" style="color: #ff0000"></i></a>
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
    {{ $giamgia->links() }}
@endsection