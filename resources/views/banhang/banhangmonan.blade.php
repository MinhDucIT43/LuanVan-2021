@extends("banhang")

@section('convert_color_monan')
    active
@endsection

@section('main')
    <div id="monan-private">
        <div id="monan-private-content">
            @foreach($thit as $t)
            @endforeach
            @if(!empty($t))
                <div class="formSearch">
                    <form action="{{route('banhang.monan.search')}}" method="get" role="search">
                        <div class="input-group mb-3">
                            <input style="height: 42px;" type="text" class="form-control" name="search" placeholder="Nhập thông tin tìm kiếm...">
                            <button class="btn btn-success" id="button-search" type="submit">Search</button>
                        </div>
                    </form>
                </div>
                <table id="monan-private-table">
                    <tr style="text-align: center;">
                        <td><h3 class="title-mathang">Món ăn</h3></td>
                    </tr>
                    <tr style="font-family: Comic Sans MS cursive;">
                        <td>
                        @foreach($thit as $t)
                            <b>{{$t['tenmon']}}</b>
                            @if($t['soluong'] == 0)
                                <p style="display: inline; color: red;">Hết hàng</p>
                            @else
                            @endif
                            </p>
                        @endforeach
                        {{ $thit->withQueryString()->links() }}
                        </td>
                    </tr>
                </table>
            @else
                <div class="formSearch">
                    <form action="{{route('banhang.monan.search')}}" method="get" role="search">
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
            <img src="{{asset('hinhanh/backgroundmonan1.jpg')}}" alt="Món ăn" class="backgroundmonan rounded"></br>
            <img src="{{asset('hinhanh/backgroundmonan3.jpg')}}" alt="Món ăn" class="backgroundmonan3 backgroundmonan rounded-circle">
            <img src="{{asset('hinhanh/backgroundmonan2.jpg')}}" alt="Món ăn" class="backgroundmonan rounded">
        </div>
    </div>
@endsection