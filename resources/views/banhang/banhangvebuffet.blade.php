@extends("banhang")

@section('convert_color_ve')
    active
@endsection

@section('main')
    <div id="vebuffet-private">
        @foreach($vebuffet as $ve)
        @endforeach
        @if(!empty($ve))
            <div class="formSearch">
                <form action="{{route('banhang.vebuffet.search')}}" method="get" role="search">
                    <div class="input-group mb-3">
                        <input style="height: 42px;" type="text" class="form-control" name="search" placeholder="Nhập thông tin tìm kiếm...">
                        <button class="btn btn-success" id="button-search" type="submit">Search</button>
                    </div>
                </form>
            </div>
            <table id="vebuffet-private-table">
                <tr style="text-align: center;">
                    <td><h3 class="title-mathang"><strong>Vé Buffet</strong></h3></td>
                </tr>
                <tr style="font-family: Comic Sans MS cursive;">
                    <td>
                        @foreach($vebuffet as $ve)
                            <p>
                            <b class="title-mathang">{{$ve['tenve']}}</b>
                            <i class="title-mathang">................{{number_format($ve['gia'])}} VNĐ</i>
                            </p>
                        @endforeach
                        {{ $vebuffet->withQueryString()->links() }}
                    </td>
                </tr>
                <tr class="title-mathang">
                    <td><b>Trẻ cao dưới 1m:</b> Miễn phí (số vé trẻ = số vé người lớn, </br>nhiều hơn thì với mỗi vé nhiều hơn thu 75,000).</td>
                </tr>
                <tr class="title-mathang">
                    <td><b>Trẻ cao từ 1m đến 1m3:</b> 75,000 đồng/trẻ.</td>
                </tr>
                <tr class="title-mathang">
                    <td><b>Trẻ cao hơn 1m3:</b> Thu giá vé như người lớn.</td>
                </tr>
            </table>
        @else
        <div class="formSearch">
                <form action="{{route('banhang.vebuffet.search')}}" method="get" role="search">
                    <div class="input-group mb-3">
                        <input style="height: 42px;" type="text" class="form-control" name="search" placeholder="Nhập thông tin tìm kiếm...">
                        <button class="btn btn-success" id="button-search" type="submit">Search</button>
                    </div>
                </form>
            </div>
            <h4 style="position:relative;top:249px;" class="title-mathang">Rất tiếc, không tìm thấy kết quả nào phù hợp với từ khóa "{{$nhap}}".</h4>
        @endif
    </div>
@endsection