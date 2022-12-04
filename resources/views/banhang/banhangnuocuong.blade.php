@extends("banhang")

@section('convert_color_thucuong')
active
@endsection

@section('main')
    <div id="thucuong-private">
        <div id="monan-private-content">
            @foreach($nuoc as $n)
            @endforeach
            @if(!empty($n))
                <div class="formSearch">
                    <form action="{{route('banhang.thucuong.search')}}" method="get" role="search">
                        <div class="input-group mb-3">
                            <input style="height: 42px;" type="text" class="form-control" name="search" placeholder="Nhập thông tin tìm kiếm...">
                            <button class="btn btn-success" id="button-search" type="submit">Search</button>
                        </div>
                    </form>
                </div>
                <table id="thucuong-private-table">
                    <tr style="text-align: center;">
                        <td>
                            <h3 class="title-mathang">Thức uống</h3>
                        </td>
                    </tr>
                    <tr style="font-family: Comic Sans MS cursive;">
                        <td>
                            @foreach($nuoc as $n)
                            <b>{{$n['tenmon']}}</b>
                            <i class="title-mathang">................{{number_format($n['gia'])}} VNĐ</i>
                            @if($n['soluong'] == 0)
                            <p style="display: inline; color: red;"><b>=> Hết hàng</b></p>
                            @else
                            @endif
                            </p>
                            @endforeach
                            {{ $nuoc->withQueryString()->links() }}
                        </td>
                    </tr>
                </table>
            @else
                <div class="formSearch">
                    <form action="{{route('banhang.thucuong.search')}}" method="get" role="search">
                        <div class="input-group mb-3">
                            <input style="height: 42px;" type="text" class="form-control" name="search" placeholder="Nhập thông tin tìm kiếm...">
                            <button class="btn btn-success" id="button-search" type="submit">Search</button>
                        </div>
                    </form>
                </div>
                <h4 class="title-mathang">Rất tiếc, không tìm thấy kết quả nào phù hợp với từ khóa "{{$nhap}}".</h4>
            @endif
        </div>
        <div id="monan-private-pic">
            <img src="{{asset('hinhanh/backgroundthucuong1.jpg')}}" alt="Thức uống" class="backgroundthucuong rounded"></br></br>
            <img src="{{asset('hinhanh/backgroundthucuong2.jpg')}}" alt="Thức uống" class="backgroundthucuong2 backgroundthucuong rounded">
        </div>
    </div>
@endsection