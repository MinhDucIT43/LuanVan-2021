@extends("banhang")

@section('convert_color_monan')
    active
@endsection

@section('main')
    <div id="monan-private">
        <div id="monan-private-content">
            <table id="monan-private-table">
                <tr style="text-align: center;">
                    <td><h3 class="title-mathang">Món ăn</h3></td>
                </tr>
                <tr style="font-family: Comic Sans MS cursive;">
                    <td>
                    @foreach($thit as $t)
                        {{$t['tenmon']}}
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
        </div>
        <div id="monan-private-pic">
            <img src="{{asset('hinhanh/backgroundmonan1.jpg')}}" alt="Món ăn" class="backgroundmonan"></br></br>
            <img src="{{asset('hinhanh/backgroundmonan2.jpg')}}" alt="Món ăn" class="backgroundmonan">
        </div>
    </div>
@endsection