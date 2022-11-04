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
                <p id="home">Nhân viên: <i style="color: #00ff00;"> {{ App\Models\nhanvien::where('tendangnhap',Session::get('tendangnhap'))->value('tenNV') }} </i></p>
                <input type="hidden" {{date_default_timezone_set("Asia/Ho_Chi_Minh")}}>
                <b style="color: white;" id="time">{{date('d/m/Y h:i:s a')}}</b>
            </div>
            <div id="cacban">
                @foreach($ban as $b)
                    <a href="{{ route('banhang.chitietbanve',['maban' => $b['maban']]) }}" class="active" style="text-decoration: none">
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
            <h3 id="text-danhsachmonan">DANH SÁCH MẶT HÀNG</h3>
            <a href="{{ route('dangxuat') }}" class="btn btn-danger" id="logout"><i class="fas fa-sign-out-alt">Đăng xuất</i></a>
            <div id="display-danhsachmonan">
                <div id="menu-mathang">
                    <ul class="nav">
                        <li class="nav-item"><a href="{{route('banhangall')}}" class="nav-link list-group-item @yield('convert_color_all')">Tất cả</a></li>
                        <li class="nav-item"><a href="{{route('banhangvebuffet')}}" class="nav-link list-group-item @yield('convert_color_ve')">Vé Buffet</a></li>
                        <li class="nav-item"><a href="{{route('banhangmonan')}}" class="nav-link list-group-item @yield('convert_color_monan')">Món ăn</a></li>
                        <li class="nav-item"><a href="{{route('banhangthucuong')}}" class="nav-link list-group-item @yield('convert_color_thucuong')">Thức uống</a></li>
                    </ol>
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
</body>
</html>