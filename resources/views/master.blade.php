<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <meta http-equiv="refresh" content="1"> -->
        <title>@yield('page_title')</title>
        <link rel="stylesheet" href="{{asset('css/master.css')}}">
        <link rel="icon" href="{{asset('hinhanh/icon.png')}}">
        <!-- Link Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <!-- Link Fontawesome-icon -->
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <!-- Link jquery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- SweetAlert2 -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="sweetalert2.all.min.js"></script>
        <!-- Bootstrap thống kê -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="assets/demo/chart-pie-demo.js"></script>

        <script src="{{asset('js/trove.js')}}"></script>
    </head>
    <body>
        <input type="hidden" {{date_default_timezone_set("Asia/Ho_Chi_Minh")}}>
        <div id="wrapper">
            <div id="header">
                <p class="thongtin">Admin: <i style="color: #00ff00;"> {{ App\Models\nhanvien::where('tendangnhap',Session::get('tendangnhap'))->value('tenNV') }} </i> || </p>
                <b class="thongtin">{{date('d/m/Y h:i:s a')}}</b>
                <a href="javascript:goBack()" class="btn btn-secondary" id="back">Trở về</a>
                <a href="{{route('dangxuat')}}" class="btn btn-danger" id="logout"><i class="fas fa-sign-out-alt"> Đăng xuất</i></a>
            </div>
            <div id="menu">
                <div id="menu-showadmin">
                    <a href="{{route('admin')}}" id="link-admin">
                        <h5 id="h4-QLNH">QUẢN LÝ NHÀ HÀNG</h5>
                        <img src="{{asset('hinhanh/admin.png')}}" alt="Admin" id="iconadmin-menu">
                        <h4 id="h4-admin">Admin</h4>
                        <i class="fas fa-circle" id="online-menu">online</i>
                    </a>
                </div>
                <div id="caption">Menu</div>
                <div id="menu-option">
                    <div class="list-group">
                        <a href="{{route('admin.nhanvien')}}" class="list-group-item @yield('convert_color_menu_nv')"><i class="fas fa-address-book"></i>Quản lý nhân viên</a>
                        <a href="{{route('admin.chucvu')}}" class="list-group-item @yield('convert_color_menu_cv')"><i class="fas fa-user-tag"></i>Quản lý chức vụ</a>
                        <a href="{{route('admin.donvitinh')}}" class="list-group-item @yield('convert_color_menu_dvt')"><i class="fab fa-acquisitions-incorporated"></i> Quản lý đơn vị tính</a>
                        <a href="{{route('admin.loaisanpham')}}" class="list-group-item @yield('convert_color_menu_lsp')"><i class="fas fa-calendar-minus"></i> Quản lý loại sản phẩm</a>
                        <a href="{{route('admin.sanpham')}}" class="list-group-item @yield('convert_color_menu_sp')"><i class="fas fa-business-time"></i> Quản lý sản phẩm</a>
                        <a href="{{route('admin.nhommon')}}" class="list-group-item @yield('convert_color_menu_nma')"><i class="fas fa-dolly"></i>Quản lý nhóm món ăn</a>
                        <a href="{{route('admin.mon')}}" class="list-group-item @yield('convert_color_menu_ma')"><i class="fas fa-cookie"></i>Quản lý món ăn</a>
                        <a href="{{route('admin.ve')}}" class="list-group-item @yield('convert_color_menu_ve')"><i class="fa fa-ticket" aria-hidden="true"></i>Quản lý vé Buffet</a>
                        <a href="{{route('admin.ban')}}" class="list-group-item @yield('convert_color_menu_b')"><i class="fas fa-table"></i>Quản lý bàn</a>
                        <div class="btn-group dropend">
                            <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-chart-line">Quản lý doanh thu</i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Doanh thu theo ngày</a></li>
                                <li><a class="dropdown-item" href="{{route('admin.thongke')}}">Doanh thu theo tháng</a></li>
                                <li><a class="dropdown-item" href="#">Doanh thu theo năm</a></li>
                                <li><a class="dropdown-item" href="#">Doanh thu theo quý</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div id="content">
                @yield('main')
            </div>
        </div>
        <!-- Script Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
        <script src="{{asset('js/themnhanvien.js')}}"></script>
        <script src="{{asset('js/themchucvu.js')}}"></script>
        <script src="{{asset('js/themsanpham.js')}}"></script>
        <script src="{{asset('js/themdonvitinh.js')}}"></script>
        <script src="{{asset('js/themloaisanpham.js')}}"></script>
        <script src="{{asset('js/themnhommon.js')}}"></script>
        <script src="{{asset('js/themmon.js')}}"></script>
        <script src="{{asset('js/themban.js')}}"></script>
        <script src="{{asset('js/themve.js')}}"></script>
        <script src="{{asset('js/xoanhanvien.js')}}"></script>
        <script src="{{asset('js/xoachucvu.js')}}"></script>
        <script src="{{asset('js/xoadonvitinh.js')}}"></script>
        <script src="{{asset('js/xoanhommon.js')}}"></script>
        <script src="{{asset('js/xoamonan.js')}}"></script>
        <script src="{{asset('js/xoave.js')}}"></script>
        <script src="{{asset('js/xoaban.js')}}"></script>
        <script src="{{asset('js/chart-area-demo.js')}}"></script>
    </body>
</html>