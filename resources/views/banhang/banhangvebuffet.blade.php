@extends("banhang")

@section('convert_color_ve')
    active
@endsection

@section('main')
    <div id="vebuffet-private">
        <table id="vebuffet-private-table">
            <tr style="text-align: center;">
                <td><h3 style="color: #FF4500;">Vé Buffet</h3></td>
            </tr>
            <tr style="font-family: Comic Sans MS cursive;">
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
        <img src="{{asset('hinhanh/backgroundvebuffet.jpg')}}" alt="Vé Buffet" id="backgroundvebuffet">
    </div>
@endsection