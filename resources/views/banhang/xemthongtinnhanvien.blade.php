<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin nhân viên</title>
    <link rel="icon" href="{{asset('hinhanh/logo.png')}}">
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
    <div>
        <a href="{{route('banhangall')}}" class="btn btn-success" id="trove">Trở về</a>
        <form action="{{route('xemnhanvien.searchnhanvien')}}" method="get" role="search" style="display: inline;float:right;">
            <label for="keyword"><strong>Tìm kiếm</strong></label>
            <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Nhập từ khoá..." style="width:250px;display:inline;">
            <select name="timkiemdanhmuc" id="timkiemdanhmuc">
                <option hidden value="">Danh mục</option>
                <optgroup label="Chức vụ">
                    @foreach($chucvu as $cv)
                    <option value="{{$cv->maCV}}">{{$cv['tenCV']}}</option>
                    @endforeach
                </optgroup>
                <optgroup label="Giới tính">
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                </optgroup>
            </select>
            <button class="btn btn-success" id="button-search" type="submit">Search</button>
        </form>
        <h1 align="center" style="color:blue;">DANH SÁCH NHÂN VIÊN</h1>
        @foreach($nhanvien as $nv)
        @endforeach
        @if(!empty($nv))
        <table class="table table-bordered table-hover" id="danhsachnhanvien">
            <thead class="table-primary">
                <tr>
                    <th>STT</th>
                    <th>Tên nhân viên</th>
                    <th>Ảnh</th>
                    <th>Năm sinh</th>
                    <th>Giới tính</th>
                    <th>Địa chỉ</th>
                    <th>Số điện thoại</th>
                    <th>Ngày vào làm</th>
                    <th>Chức vụ</th>
                </tr>
            </thead>
            <tbody>
                @foreach($nhanvien as $nv)
                <tr>
                    <td align="center">{{++$i}}</td>
                    <td>{{$nv['tenNV']}}</td>
                    <td><img id="anhnhanvien" src="{{asset('anhnhanvien/'.$nv['anhnhanvien'])}}" alt="{{$nv['anhnhanvien']}}"></td>
                    <?php $namsinh = date_create($nv['namsinh']) ?>
                    <td>{{date_format($namsinh,"d-m-Y")}}</td>
                    <td align="center">{{$nv['gioitinh']}}</td>
                    <td>{{$nv['diachi']}}</td>
                    <td>{{$nv['soDT']}}</td>
                    <?php $ngayvaolam = date_create($nv['ngayvaolam']) ?>
                    <td>{{date_format($ngayvaolam,"d-m-Y")}}</td>
                    <td>{{App\Models\chucvu::where('maCV',$nv['maCV'])->value('tenCV')}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @elseif($nhaptext && !$nhapselect)
            <br /><br />
            <h2>Rất tiếc, không tìm thấy kết quả nào phù hợp với từ khóa "{{$nhaptext}}".</h2>
        @elseif($nhapselect && !$nhaptext)
            <br /><br />
            <h2>Rất tiếc, không tìm thấy kết quả nào phù hợp với từ khóa "{{$nhapselect}}".</h2>
        @else
            <br /><br />
            <h2>Rất tiếc, không tìm thấy kết quả nào phù hợp với từ khóa "{{$nhaptext}} - {{App\Models\chucvu::where('maCV',$nhapselect)->value('tenCV')}}".</h2>
        @endif
    </div>
    {{ $nhanvien->links() }}

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>

</html>