<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Báo cáo</title>
    <link rel="shortcut icon" href="{{asset('hinhanh/logo.png')}}">
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
    <div class="wrapper">
        <a href="{{route('banhangall')}}" class="btn btn-secondary" id="trove">Trở về</a>
        <h1 align="center">Lập báo cáo</h1>
        <table align="center" border="1">
            <thead>
                <tr>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Nhân viên lập:</td>
                    <td>                        
                        <select name="tendangnhap" id="tendangnhap">
                            @foreach($nhanvien as $nv)
                                <option value="{{$nv['tendangnhap']}}">{{$nv['tenNV']}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Ngày lập:</td>
                    <td><input type="date" name="ngaylap" id="ngaylap" required=""></td>
                </tr>
                <tr>
                    <td></td>
                    <td><button class="btn btn-primary" type="submit" name="submit" id="inputSubmit">Lập báo cáo</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>