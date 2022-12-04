<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Duck BBQ</title>
        <link rel="stylesheet" href="{{asset('css/doimatkhau.css')}}">
        <link rel="shortcut icon" href="{{asset('hinhanh/logo.png')}}">
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
                <p>Duck BBQ</p>
            </div>
        </div>
        <div class="main">
            <div class="col-md-6 col-sm-12">
                <div class="login-form">
                <a class="btn btn-secondary" href="{{route('trove')}}" role="button" id="trove">Trở về</a>
                    <h1 id="title-doimatkhau">Đổi mật khẩu</h1>
                    <form method="post" action="{{ route('postDoiMatKhau') }}"> @csrf
                        <div class="form-group" id="top-form">
                            <label>Tên đăng nhập</label>
                            <input type="text" name="tendangnhap" class="form-control" placeholder="Nhập tên đăng nhập" value="{{old('tendangnhap')}}">
                        </div>
                        <div class="form-group">
                            <label>Mật khẩu cũ</label>
                            <input type="password" name="matkhaucu" class="form-control" placeholder="Nhập mật khẩu cũ" value="{{old('matkhaucu')}}">
                        </div>
                        <div class="form-group">
                            <label>Mật khẩu mới</label>
                            <input type="password" name="matkhaumoi" class="form-control" placeholder="Nhập mật khẩu mới" value="{{old('matkhaumoi')}}">
                        </div>
                        <button type="submit" class="btn btn-success">Cập nhật</button>
                        <ul class="alert text-danger">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        @if(session('success-doimatkhau'))
                        <div class="alert alert-success">
                            <strong>{{ session('success-doimatkhau') }}</strong>
                        </div>
                        @endif
                        @if(session('fail-doimatkhau'))
                            <p style="color:#dc3545;"><i class="fa fa-circle" aria-hidden="true" style="font-size:8px;"></i> {{ session('fail-doimatkhau') }}</p>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>