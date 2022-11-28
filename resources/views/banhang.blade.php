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
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- Link jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>
</head>

<body>
    <div id="wrapper">
        <div class="ban">
            <div id="header">
                    @if(Session::has('thungan') && Session::has('vaitrothungan'))
                        <p id="home">Thu ngân: <i style="color: #00ff00;">
                        {{ App\Models\nhanvien::where('tendangnhap',Session::get('thungan'))->value('tenNV') }} </i> ||
                    @elseif(Session::has('phucvu') && Session::has('vaitrophucvu'))
                        <p id="home">Phục vụ: <i style="color: #00ff00;">
                        {{ App\Models\nhanvien::where('tendangnhap',Session::get('phucvu'))->value('tenNV') }} </i> ||
                    @endif
                </p>
                <input type="hidden" {{date_default_timezone_set("Asia/Ho_Chi_Minh")}}>
                <b style="color: white;" id="time">{{date('d/m/Y')}} <strong><p style="display:inline;" id="demo"></p></strong></b>
                <?php $countDatBan = DB::table('datban')->where('ngayDat','>=',date('Y-m-d'))->where('trangthai',0)->count(); ?>
                @if(Session::has('thungan') && Session::has('vaitrothungan'))
                    <a id="banDat" class="btn btn-info" href="{{route('datban')}}">Bàn được đặt</a><strong id="soLuongBanDat">{{$countDatBan}}</strong>
                @endif
            </div>
            <div id="cacban">
                <!-- Thông báo Paypal -->
                @if(\Session::has('error'))
                    <div class="alert alert-danger">{{ \Session::get('error') }}</div>
                    {{ \Session::forget('error') }}
                @endif
                @if(\Session::has('success'))
                    <div class="alert alert-success">{{ \Session::get('success') }}</div>
                    {{ \Session::forget('success') }}
                @endif
                <!-- Thông báo Paypal -->
                <div class="row">
                    @foreach($ban as $b)
                    <div class="col-md-4">
                        <div class="text-center" style="padding-bottom: 5px;">
                            @if($b['trangthai']==0)
                            <a class="linkBan trong" href="{{ route('banhang.chitietbanve',['maban' => $b['maban']]) }}">
                                <i id="khachhang" class="fas fa-users"></i>
                                <p style="margin-bottom: 0rem;">{{$b['banso']}}</p>
                            </a>
                            <div class="thongtinBan">
                                    @foreach($datban as $db)
                                        @foreach(explode(',',$db['maban']) as $vl)
                                            @if($b['maban'] == $vl)
                                                <?php $ngayDat = date_create($db['ngayDat']) ?>
                                                <strong style="font-size: 12px; color:#FF4500;">Được đặt: {{date_format($ngayDat,"d-m-Y")}} ({{$db['gioDat']}}h{{$db['phutDat']}})</strong><br />
                                            @endif
                                        @endforeach
                                    @endforeach
                                </div>
                            @else
                            <a class="linkBan coKhach" href="{{ route('banhang.chitietbanve',['maban' => $b['maban']]) }}">
                                <i id="khachhang" class="fas fa-users"></i>
                                <p style="margin-bottom: 0rem">{{$b['banso']}}</p>
                                <div class="thongtinBan">
                                    @foreach($datban as $db)
                                        @foreach(explode(',',$db['maban']) as $vl)
                                            @if($b['maban'] == $vl)
                                                <?php $ngayDat = date_create($db['ngayDat']) ?>
                                                <strong style="font-size: 12px; color:#FF4500;">Được đặt: {{date_format($ngayDat,"d-m-Y")}} ({{$db['gioDat']}}h{{$db['phutDat']}})</strong><br />
                                            @endif
                                        @endforeach
                                    @endforeach
                                </div>
                            </a>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                {{ $ban->withQueryString()->links() }}
            </div>
        </div>
        <div id="danhsachmonan">
            <h3 id="text-danhsachmonan">DANH SÁCH MẶT HÀNG</h3>
            <a class="btn btn-danger dangXuat" href="{{ route('dangxuatthungan') }}" id="logout"><i class="fas fa-sign-out-alt">Đăng xuất</i></a>
            <div id="display-danhsachmonan">
                <div id="menu-mathang">
                    <ul class="nav">
                        <li class="nav-item"><a href="{{route('banhangall')}}" class="nav-link list-group-item @yield('convert_color_all')">Tất cả</a></li>
                        <li class="nav-item"><a href="{{route('banhangvebuffet')}}" class="nav-link list-group-item @yield('convert_color_ve')">Vé Buffet</a></li>
                        <li class="nav-item"><a href="{{route('banhangmonan')}}" class="nav-link list-group-item @yield('convert_color_monan')">Món ăn</a></li>
                        <li class="nav-item"><a href="{{route('banhangthucuong')}}" class="nav-link list-group-item @yield('convert_color_thucuong')">Thức uống</a></li>
                    </ul>
                </div>
                <div id="noidung-mathang">
                    @yield('main')
                </div>
            </div>
        </div>
    </div>
    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="{{asset('js/dangxuat.js')}}"></script>
    <script src="{{asset('js/time.js')}}"></script>
</body>

</html>