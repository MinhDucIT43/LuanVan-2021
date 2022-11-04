@extends("banhang")

@section('convert_color_ve')
    active
@endsection

@section('main')
    <div id="vebuffet-private">
        <table id="vebuffet-private-table">
            <tr style="text-align: center;">
                <td><h3 class="title-mathang">Vé Buffet</h3></td>
            </tr>
            <tr style="font-family: Comic Sans MS cursive;">
                <td>
                    @foreach($vebuffet as $ve)
                        <p>
                        <b>{{$ve['tenve']}}</b>
                        ................
                        {{number_format($ve['gia'])}} VNĐ
                        </p>
                    @endforeach
                    {{ $vebuffet->withQueryString()->links() }}
                </td>
            </tr>
            <tr>
                <td><b>Trẻ cao dưới 1m:</b> Miễn phí (số vé trẻ = số vé người lớn, </br>nhiều hơn thì với mỗi vé nhiều hơn thu 75,000).</td>
            </tr>
            <tr>
                <td><b>Trẻ cao từ 1m đến 1m3:</b> 75,000 đồng/trẻ.</td>
            </tr>
            <tr>
                <td><b>Trẻ cao hơn 1m3:</b> Thu giá vé như người lớn.</td>
            </tr>
        </table>
        <img src="{{asset('hinhanh/backgroundvebuffet.jpg')}}" alt="Vé Buffet" id="backgroundvebuffet">
    </div>
@endsection