@extends("banhang")

@section('convert_color_all')
    active
@endsection

@section('main')
    <div id="thucuong">
        <table>
            <tr>
                <td><h3>Thức uống:</h3></td>
            </tr>
            <tr>
                <td>
                @foreach($nuoc as $n)
                    {{$n['tenmon']}}
                    ................
                    {{number_format($n['gia'])}} VNĐ
                    .......
                    @if($n['soluong'] == 0)
                        SL: <p style="display: inline; color: red;">Hết hàng</p>
                    @else
                        SL: {{$n['soluong']}}
                    @endif
                    </p>
                @endforeach
                </td>
            </tr>
        </table>
        {{ $nuoc->withQueryString()->links() }}
    </div>
    <div id="monan">
        <table>
            <tr>
                <td><h3>Món ăn:</h3></td>
            </tr>
            <tr>
                <td>
                @foreach($thit as $t)
                    {{$t['tenmon']}}
                    ................
                    @if($t['soluong'] == 0)
                        SL: <p style="display: inline; color: red;">Hết hàng</p>
                    @else
                        SL: {{$t['soluong']}}
                    @endif
                    </p>
                @endforeach
                </td>
            </tr>
        </table>
        {{ $thit->withQueryString()->links() }}
    </div>
    <div id="show-pic">
        <img src="{{asset('hinhanh/thucuong1.jpg')}}" alt="Thức uống 1" class="img-thucuong">
        <img src="{{asset('hinhanh/thucuong2.jpg')}}" alt="Thức uống 2" class="img-thucuong">
        
        <img src="{{asset('hinhanh/thit1.jpg')}}" alt="Thịt 1" class="img-monan">
        <img src="{{asset('hinhanh/thit2.jpg')}}" alt="Thịt 2" class="img-monan">
        <img src="{{asset('hinhanh/thit3.jpg')}}" alt="Thịt 2" class="img-monan">
    </div>
    <div id="vebuffet">
        <table>
            <tr>
                <td><h3>Vé Buffet:</h3></td>
            </tr>
            <tr>
                <td>
                @foreach($vebuffet as $ve)
                    <p>
                    {{$ve['tenve']}}
                    ................
                    {{number_format($ve['gia'])}} VNĐ
                    </p>
                @endforeach
                {{ $vebuffet->withQueryString()->links() }}
                </td>
            </tr>
        </table>
    </div>
@endsection