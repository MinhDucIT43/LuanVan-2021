@extends("banhang")

@section('convert_color_thucuong')
    active
@endsection

@section('main')
    <div id="thucuong-private">
        <div id="monan-private-content">
            <table id="monan-private-table">
                <tr style="text-align: center;">
                    <td><h3 class="title-mathang">Thức uống</h3></td>
                </tr>
                <tr style="font-family: Comic Sans MS cursive;">
                    <td>
                    @foreach($nuoc as $n)
                        {{$n['tenmon']}}
                        ................
                        {{number_format($n['gia'])}} VNĐ
                        @if($n['soluong'] == 0)
                            <p style="display: inline; color: red;"> => Hết hàng</p>
                        @else
                        @endif
                        </p>
                    @endforeach
                    {{ $nuoc->withQueryString()->links() }}
                    </td>
                </tr>
            </table>
        </div>
        <div id="monan-private-pic">
            <img src="{{asset('hinhanh/backgroundthucuong1.jpg')}}" alt="Món ăn" class="backgroundmonan"></br></br>
            <img src="{{asset('hinhanh/backgroundthucuong2.jpg')}}" alt="Món ăn" class="backgroundmonan">
        </div>
    </div>
@endsection