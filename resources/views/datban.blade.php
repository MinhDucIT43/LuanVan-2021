<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page_title')</title>
    <link rel="stylesheet" href="{{asset('css/datban.css')}}">
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
        <div id="header">
            <a href="{{route('banhangall')}}" class="btn btn-success" id="trove">Trở về</a>
            <div id="menu-datban">
                <ul class="nav">
                    <li class="nav-item"><a href="{{route('datban')}}" class="nav-link list-group-item @yield('convert_color_dadatban')">Đã đặt bàn</a></li>
                    <li class="nav-item"><a href="{{route('datban.daduyet')}}" class="nav-link list-group-item @yield('convert_color_daduyet')">Đã duyệt</a></li>
                    <li class="nav-item"><a href="{{route('datban.getthembandat')}}" class="nav-link list-group-item @yield('convert_color_themdatban')">Thêm đặt bàn</a></li>
                </ul>
            </div>
        </div>
        <div id="contents">
            @yield('main')
        </div>
    </div>
</body>

</html>