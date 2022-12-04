@extends("banhang")

@section('convert_color_all')
    active
@endsection

@section('main')
    <div id="thucuong">
        <table>
            <tr>
                <td class="title-mathang"><h3><strong>Thức uống:</strong></h3></td>
            </tr>
            @foreach($nuoc as $n)
            <tr style="padding-left: 5px;">
                <td class="tenmon">
                    {{$n['tenmon']}}
                </td>
                <td>
                    <i class="title-mathang">..... {{number_format($n['gia'])}} VNĐ</i>
                </td>
                <td>
                    @if($n['soluong'] == 0)
                        <b style="display: inline; color: red;"> => Hết hàng</b>
                    @else
                    @endif
                </td>
            </tr>
            @endforeach
        </table>
        {{ $nuoc->withQueryString()->links() }}
    </div>
    <div id="monan">
        <table>
            <tr>
                <td class="title-mathang"><h3><strong>Món ăn:</strong></h3></td>
            </tr>
            @foreach($thit as $t)
            <tr>
                <td class="tenmon">
                    {{$t['tenmon']}}
                </td>
                <td>
                    @if($t['soluong'] == 0)
                        ..... <b style="display: inline; color: red;">Hết hàng</b> .....
                    @else
                    @endif
                </td>
            </tr>
            @endforeach
        </table>
        {{ $thit->withQueryString()->links() }}
    </div>
    <div id="show-pic">
        <br/><br/>
        <img src="{{asset('hinhanh/thucuong1.jpg')}}" alt="Thức uống 1" class="img-thucuong rounded">
        <br/><br/><br/>
        <img src="{{asset('hinhanh/thit1.jpg')}}" alt="Thịt 1" class="img-monan rounded">
        <br/><br/><br/>
        <img src="{{asset('hinhanh/thit3.jpg')}}" alt="Thịt 2" class="img-monan rounded">
    </div>
    <div id="vebuffet">
        <table>
            <tr>
                <td class="title-mathang"><h3><strong>Vé Buffet:</strong></h3></td>
            </tr>
            <tr>
                <td>
                @foreach($vebuffet as $ve)
                    <p class="tenmon">
                    {{$ve['tenve']}}:
                    <i class="title-mathang"> ................{{number_format($ve['gia'])}} VNĐ</i>
                    </p>
                @endforeach
                <p style="font-size: 13px;" class="tenmon">
                    <b>Trẻ cao dưới 1m:</b> Miễn phí (số vé trẻ = số vé người lớn, nhiều hơn thì với mỗi vé nhiều hơn thu 75,000).</br>
                    <b>Trẻ cao từ 1m đến 1m3:</b> 75,000 đồng/trẻ.</br>
                    <b>Trẻ cao hơn 1m3:</b> Thu giá vé như người lớn.
                </p>
                {{ $vebuffet->withQueryString()->links() }}
                </td>
            </tr>
        </table>
    </div>
@endsection