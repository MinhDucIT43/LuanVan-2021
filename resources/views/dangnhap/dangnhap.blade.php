<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>King BBQ</title>
        <link rel="stylesheet" href="{{asset('css/dangnhap.css')}}">
        <link rel="shortcut icon" href="{{asset('hinhanh/icon.png')}}">
        <!-- Link Bootstrap -->
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <!-- Link Fontawesome-icon -->
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    </head>
    <body>
        <div class="sidenav">
            <div class="login-main-text">
                <i class="fas fa-utensils"></i>
                <h2>Nhà hàng Buffet</h2>
                <p>King BBQ</p>
            </div>
        </div>
        <div class="main">
            <div class="col-md-6 col-sm-12">
                <div class="login-form">
                    <img src="{{asset('hinhanh/dangnhap.png')}}" alt="Đăng nhập" id="dangnhap-img">
                    <form method="post" action="{{ route('postDangNhap') }}"> @csrf
                        <div class="form-group" id="top-form">
                            <label>Tên đăng nhập</label>
                            <input type="text" name="tendangnhap" class="form-control" placeholder="Nhập tên đăng nhập" value="{{old('tendangnhap')}}">
                        </div>
                        <div class="form-group">
                            <label>Mật khẩu</label>
                            <input type="password" name="matkhau" class="form-control" placeholder="Nhập mật khẩu" value="{{old('matkhau')}}">
                        </div>
                        <button type="submit" class="btn btn-black">Đăng nhập</button>
                        <a href="{{route('doimatkhau')}}" id="doimatkhau"><img src="{{asset('hinhanh/key.png')}}" alt="Key" id="key"> Đổi mật khẩu</a>
                        <ul class="alert text-danger">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        @if (session('alert-sai'))
                            <div>
                                <p style="color:#dc3545;"><i class="fa fa-circle" aria-hidden="true" style="font-size:8px;"></i> {{ session('alert-sai') }}</p>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>