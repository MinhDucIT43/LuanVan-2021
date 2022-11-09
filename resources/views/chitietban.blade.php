<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bán hàng - @foreach($banso as $b) {{$b['banso']}} @endforeach</title>
    <link rel="stylesheet" href="{{asset('css/chitietban.css')}}">
    <link rel="shortcut icon" href="{{asset('hinhanh/icon.png')}}">
    <!-- Link Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Link Fontawesome-icon -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <!-- SweetAlert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>

    <script src="{{asset('js/trove.js')}}"></script>

    <script src="{{asset('js/thanhtoan.js')}}"></script>
</head>
<body>
    <div id="wrapper">
        <div id="header">
            <a href="{{route('banhangall')}}" class="btn btn-success" id="trove">Trở về</a>
            <p id="nhanvien">Nhân viên: <i style="color: #00ff00;"  > {{ App\Models\nhanvien::where('tendangnhap',Session::get('tendangnhap'))->value('tenNV') }} </i></p>
            <input type="hidden" {{date_default_timezone_set("Asia/Ho_Chi_Minh")}}>
                <b style="color: white;" id="time">{{date('d/m/Y h:i:s')}}</b>
        </div>
        <div id="chonmon">
            <div id="header-chonmon">
                @foreach($banso as $b)
                    <p id="banso">{{$b['banso']}}</p>
                @endforeach
            </div>
            <div id="content-chonmon">
                <div id="maincontent-chonmon">
                    @yield('main')
                </div>
            </div>
        </div>
        <div id="order">
            <?php
                $data = DB::table('order')->where('maban',$b->maban)->where('trangthai',0)->first(); 
            ?>
            @if($data)
                <?php
                    $mabancoorder = DB::table('order')->where('maban',$b->maban)->where('trangthai',0)->get();
                    foreach($mabancoorder as $mbco){}
                    $monorder = DB::table('chitietorder')->where('maorder',$mbco->maorder)->first();
                ?>
                <table class="table table-bordered">
                    <tr>
                        <th>STT</th>
                        <th>Tên món</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>
                        <th></th>
                    </tr>
                    <tbody>
                        <?php
                            $datane = DB::table('order')->where('maban',$b->maban)->where('trangthai',0)->get();
                            $monorderne = DB::table('chitietorder')->where('maorder',$mbco->maorder)->get();
                        ?>
                        <form action="" method="POST"> @csrf
                            <input type="hidden" name="maban" value="{{$b['maban']}}">
                            @foreach($datane as $dt)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ App\Models\ve::where('mave',$dt->mave)->value('tenve') }}</td>
                                    <td>{{$dt->soluong}}</td>
                                    <td>{{ number_format(App\Models\ve::where('mave',$dt->mave)->value('gia'))}}</td>
                                    <td>{{ number_format(($dt->soluong)*(App\Models\ve::where('mave',$dt->mave)->value('gia'))) }}</td>
                                    <td><a href="{{ url('') }}/banhang/chitietban/xoaorderve/{{$dt->maban}}/{{$dt->mave}}"><i class="fas fa-trash-alt" style="color: #ff0000"></i></a></td>
                                </tr>
                            @endforeach
                        @if($monorder)
                            @foreach($monorderne as $mo)
                                <tr>
                                    <td>{{ $loop->index + 2 }}</td>
                                    <td>{{ App\Models\mon::where('mamon',$mo->mamon)->value('tenmon') }}</td>
                                    <td>{{$mo->soluong}}</td>
                                    <td>{{ number_format(App\Models\mon::where('mamon',$mo->mamon)->value('gia'))}}</td>
                                    <td>{{ number_format(($mo->soluong)*(App\Models\mon::where('mamon',$mo->mamon)->value('gia'))) }}</td>
                                    <td><a href="{{ url('') }}/banhang/chitietban/xoaordermon/{{$mo->mactorder}}"><i class="fas fa-trash-alt" style="color: #ff0000"></i></a></td>
                                </tr>
                            @endforeach
                        @endif
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Tổng tiền:</td>
                                <td>{{number_format($thanhtienve+$thanhtienmon)}}</td>
                            </tr>
                            @foreach($datane as $dt)
                            <tr>
                                <td><a class="btn btn-success" href="{{ url('') }}/banhang/chitietban/thanhtoan/{{$dt->maorder}}">Thanh toán</a></td>
                            </tr>
                            @endforeach
                        </form>
                    </tbody>
            @else
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            @endif
        </div>
    </div>
    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    <script src="{{asset('js/themvebuffet.js')}}"></script>
</body>
</html>