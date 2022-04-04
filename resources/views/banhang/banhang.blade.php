<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bán hàng</title>
    <link rel="stylesheet" href="{{asset('css/banhang.css')}}">
    <link rel="shortcut icon" href="./hinhanh/icon.png">
    <!-- Link Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Link Fontawesome-icon -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body>
    <div id="wrapper">
        <div class="ban">
            <div id="header">
                <p id="home">Nhân viên: {{ App\Models\nhanvien::where('tendangnhap',Session::get('tendangnhap'))->value('tenNV') }}</p>
                <a href="{{ route('dangxuat') }}" class="btn btn-danger" id="logout"><i class="fas fa-sign-out-alt">Đăng xuất</i></a>
            </div>
            <div id="cacban">
                @foreach($ban as $b)
                    <a href="" style="text-decoration: none">
                        <button id="display-ban" type="submit">
                            <i id="khachhang" class="fas fa-users"></i>
                            <p>{{$b['banso']}}</p>
                        </button>
                    </a>
                @endforeach
                {{ $ban->withQueryString()->links() }}
            </div>
        </div>
        <div id="danhsachmonan">
            <h3 id="text-danhsachmonan">DANH SÁCH MÓN ĂN</h3>
            <div id="display-danhsachmonan">
                <div>
                    <div id="thucuong">
                        <table>
                            <tr>
                                <td><h3 id="text-thucuong">Thức uống:</h3></td>
                            </tr>
                            <tr id="content-thucuong">
                                <td>
                                    <br/>
                                    @foreach($nuoc as $n)
                                        @foreach($mon as $m)
                                            @if($n['maNM'] == $m['maNM'])
                                                    {{$m['tenmon']}}
                                                    ................
                                                    {{number_format($m['gia'])}} VNĐ
                                                    .......
                                                    @if($m['soluong'] == 0)
                                                        SL: <p style="display: inline; color: red;">Hết hàng</p>
                                                    @else
                                                        SL: {{$m['soluong']}}
                                                    @endif
                                                </p>
                                            @endif
                                        @endforeach
                                    @endforeach
                                    {{ $nuoc->withQueryString()->links() }}
                                </td>
                                <td>
                                    <img src="{{asset('hinhanh/thucuong.jpg')}}" alt="Thức uống" id="img-thucuong">
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div id="vebuffet">
                        <table>
                            <tr>
                                <td><h3 id="text-thucuong">Vé Buffet:</h3></td>
                            </tr>
                            <tr id="content-thucuong">
                                <td>
                                    <br/>
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
                    <div id="monan">
                        <table>
                            <tr>
                                <td><h3 id="text-thucuong">Món ăn:</h3></td>
                            </tr>
                            <tr id="content-thucuong">
                                <td>
                                    <br/>
                                    @foreach($thit as $t)
                                        @foreach($mon as $m)
                                            @if($t['maNM'] == $m['maNM'])
                                                    {{$m['tenmon']}}
                                                    ................
                                                    {{number_format($m['gia'])}} VNĐ
                                                    .......
                                                    @if($m['soluong'] == 0)
                                                        SL: <p style="display: inline; color: red;">Hết hàng</p>
                                                    @else
                                                        SL: {{$m['soluong']}}
                                                    @endif
                                                </p>
                                            @endif
                                        @endforeach
                                    @endforeach
                                    {{ $thit->links() }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>