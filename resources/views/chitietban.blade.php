<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bán hàng - @foreach($banso as $b) {{App\Models\ban::where('maban',$b['maban'])->value('banso')}} @endforeach</title>
    <link rel="stylesheet" href="{{asset('css/chitietban.css')}}">
    <link rel="shortcut icon" href="{{asset('hinhanh/icon.png')}}">
    <!-- Link Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Link Fontawesome-icon -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- Link jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>
    <script src="{{asset('js/trove.js')}}"></script>
</head>

<body>
    <div id="wrapper">
        <div id="header">
            <a href="{{route('banhangall')}}" class="btn btn-success" id="trove">Trở về</a>
            @if(Session::has('thungan') && Session::has('vaitrothungan'))
            <p id="nhanvien">Thu ngân: <strong style="color: #00ff00;">
                    {{ App\Models\nhanvien::where('tendangnhap',Session::get('thungan'))->value('tenNV') }} </strong> ||
                @elseif(Session::has('phucvu') && Session::has('vaitrophucvu'))
            <p id="nhanvien">Phục vụ: <strong style="color: #00ff00;">
                    {{ App\Models\nhanvien::where('tendangnhap',Session::get('phucvu'))->value('tenNV') }} </strong> ||
                @endif
                <input type="hidden" {{date_default_timezone_set("Asia/Ho_Chi_Minh")}}>
                <b id="time">{{date('d/m/Y')}} <strong>
                        <p style="display:inline;" id="demo"></p>
                    </strong></b>
        </div>
        <div id="chonmon">
            <div id="header-chonmon">
                @foreach($banso as $b)
                <?php
                $data = DB::table('order')->where('maban', $b->maban)->where('trangthai', 0)->first();
                $danhSachBan = DB::table('ban')->where('maban', '<>', $b->maban)->where('trangthai', 0)->get();
                ?>
                <p id="banso">{{App\Models\ban::where('maban',$b['maban'])->value('banso')}}</p>
                @if($data)
                <form action="{{route('postChuyenBan')}}" method="post" id="chuyenBan">@csrf
                    <button type="submit" class="btn btn-warning">Chuyển bàn</button>
                    <input type="hidden" name="mabancu" value="{{$b['maban']}}">
                    <select name="mabanmoi">
                        <option hidden value="">Chuyển đến</option>
                        @foreach($danhSachBan as $dsb)
                        <option value="{{$dsb->maban}}">{{$dsb->banso}}</option>
                        @endforeach
                    </select>
                </form>
                @endif
                @endforeach
            </div>
            <div id="content-chonmon">
                <div id="maincontent-chonmon">
                    @yield('main')
                </div>
            </div>
        </div>
        <div id="order">
            @if($data)
                <?php
                    $mabancoorder = DB::table('order')->where('maban', $b->maban)->where('trangthai', 0)->get();
                    foreach ($mabancoorder as $mbco) {
                    }
                    $thanhtienve = $mbco->soluong * $mbco->gia;
                    $monorder = DB::table('chitietorder')->where('maorder', $mbco->maorder)->first();
                ?>
                <table class="table table-bordered table-hover table-striped">
                    <thead class="table-primary">
                        <tr>
                            <th style="width: 3px;">STT</th>
                            <th style="width: 235px;">Tên món</th>
                            <th style="width: 41px;">Số lượng</th>
                            <th>Đơn giá</th>
                            <th>Thành tiền</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $monorderne = DB::table('chitietorder')->where('maorder', $mbco->maorder)->get();
                            $thanhtienmon = DB::table('chitietorder')->where('maorder', $mbco->maorder)->sum('thanhtien');
                        ?>
                        @foreach($mabancoorder as $dt)
                            <tr>
                                <td align="center">{{ $loop->index + 1 }}</td>
                                <td><b>{{ App\Models\ve::where('mave',$dt->mave)->value('tenve') }}
                                        @if(session('delete-Ve'))
                                        <p style="color:red;"><i class="fas fa-exclamation-triangle"></i> {{ session('delete-Ve') }}</p>
                                        @endif
                                    </b></td>
                                <td align="center">{{$dt->soluong}}</td>
                                <td align="right">{{ number_format(App\Models\ve::where('mave',$dt->mave)->value('gia'))}}</td>
                                <td align="right">{{ number_format(($dt->soluong)*(App\Models\ve::where('mave',$dt->mave)->value('gia'))) }}</td>
                                <td><a href="{{ url('') }}/banhang/chitietban/xoaorderve/{{$dt->maban}}/{{$dt->mave}}"><i class="fas fa-trash-alt" style="color: #ff0000"></i></a></td>
                            </tr>
                        @endforeach
                        @if($monorder)
                            @foreach($monorderne as $mo)
                                <tr>
                                    <td align="center">{{ $loop->index + 2 }}</td>
                                    <td><b>{{ App\Models\mon::where('mamon',$mo->mamon)->value('tenmon') }}</b></td>
                                    <td align="center">{{$mo->soluong}}</td>
                                    <td align="right">{{ number_format(App\Models\mon::where('mamon',$mo->mamon)->value('gia'))}}</td>
                                    <td align="right">{{ number_format(($mo->soluong)*(App\Models\mon::where('mamon',$mo->mamon)->value('gia'))) }}</td>
                                    <td><a href="{{ url('') }}/banhang/chitietban/xoaordermon/{{$mo->mactorder}}"><i class="fas fa-trash-alt" style="color: #ff0000"></i></a></td>
                                </tr>
                            @endforeach
                        @endif
                        <tr>
                            @if(Session::has('thungan') && Session::has('vaitrothungan'))
                                @foreach($mabancoorder as $dt)
                                <td colspan="3">
                                    <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Thanh toán
                                        <!-- <a class="btn btn-success thanhToan" href="{{ url('') }}/banhang/chitietban/thanhtoan/{{$dt->maorder}}">Thanh toán</a> -->
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown dropend">
                                            <a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color:#FFA500;">Thanh toán bằng tiền mặt</a>
                                            <ul class="dropdown-menu" aria-labelledby="multilevelDropdownMenu1" style="width:400px;">
                                                <li>
                                                    <h3 align="center"><strong>Thanh toán</strong></h3>
                                                    <form action="" method="post" enctype="multipart/form-data"> @csrf
                                                        <div class="mb-3" style="padding: 0px 20px 0px 20px;">
                                                            <table>
                                                                <tr>
                                                                    <td><strong>Tổng tiền thanh toán:</strong></td>
                                                                    <td>
                                                                        @switch($mbco->maGG)
                                                                            @case(NULL)
                                                                                <input readonly type="text" name="tongCongDisplay" id="tongCongDisplay" value="{{number_format(($thanhtienve+$thanhtienmon)+(($thanhtienve+$thanhtienmon)*0.1))}}">
                                                                                <input hidden readonly type="text" name="tongCong" id="tongCong" value="{{(($thanhtienve+$thanhtienmon)+(($thanhtienve+$thanhtienmon)*0.1))}}">
                                                                            @break
                                                                            @case(1)
                                                                                <input readonly type="text" name="tongCongDisplay" id="tongCongDisplay" value="{{number_format((($thanhtienve+$thanhtienmon)+(($thanhtienve+$thanhtienmon)*0.1)) - $mbco->gia)}}">
                                                                                <input hidden readonly type="text" name="tongCong" id="tongCong" value="{{(($thanhtienve+$thanhtienmon)+(($thanhtienve+$thanhtienmon)*0.1)) - $mbco->gia}}">
                                                                            @break
                                                                            @case(2)
                                                                                <input readonly type="text" name="tongCongDisplay" id="tongCongDisplay" value="{{number_format((($thanhtienve+$thanhtienmon)+(($thanhtienve+$thanhtienmon)*0.1)) - 40000)}}">
                                                                                <input hidden readonly type="text" name="tongCong" id="tongCong" value="{{(($thanhtienve+$thanhtienmon)+(($thanhtienve+$thanhtienmon)*0.1)) - 40000}}">
                                                                            @break
                                                                        @endswitch
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>Tiền thừa:</strong></td>
                                                                    <td>
                                                                        <input readonly type="text" name="tienThua" id="tienThua">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>Khách đưa:</strong></td>
                                                                    <td><input type="text" name="khachDua" id="khachDua" onkeyup="checkResult()"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>
                                                                        <a class="btn btn-danger thanhToan" href="{{ url('') }}/banhang/chitietban/thanhtoan/{{$dt->maorder}}" style="float:right; margin-top: 10px">Xác nhận</a>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </form>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <div class="col-md--12">
                                                <?php
                                                if($mbco->maGG == NULL){
                                                    $vnd_to_usd = round((($thanhtienmon + $thanhtienve) + (($thanhtienmon + $thanhtienve) * 0.1)) / 24780, 2);
                                                    \Session::put('vnd_to_usd', $vnd_to_usd);
                                                }else if($mbco->maGG == 1){
                                                    $vnd_to_usd = round(((($thanhtienmon + $thanhtienve) + (($thanhtienmon + $thanhtienve) * 0.1)) - $mbco->gia) / 24780, 2);
                                                    \Session::put('vnd_to_usd', $vnd_to_usd);
                                                }else if($mbco->maGG == 2){
                                                    $vnd_to_usd = round(((($thanhtienmon + $thanhtienve) + (($thanhtienmon + $thanhtienve) * 0.1)) - 40000) / 24780, 2);
                                                    \Session::put('vnd_to_usd', $vnd_to_usd);
                                                }
                                                ?>
                                                <!-- <div id="paypal-button"></div> -->
                                                <a class="btn btn-warning m-3" href="{{ route('processTransaction', ['maorder' => $dt->maorder]) }}">Thanh toán <strong style="color:#0000FF;">Pay</strong><strong style="color:#00BFFF;">Pal</strong></a>
                                                <!-- <input type="hidden" id="vnd_to_usd" value="{{$vnd_to_usd}}"> -->
                                            </div>
                                        </li>
                                    </ul>
                                </td>
                                @endforeach
                            @else
                                <td></td>
                                <td></td>
                                <td></td>
                            @endif
                            <td><strong>Tổng tiền:</strong></td>
                            <td align="right"><strong>{{number_format($thanhtienve+$thanhtienmon)}}</strong></td>
                        </tr>
                        @if(Session::has('thungan') && Session::has('vaitrothungan'))
                            <tr>
                                <td colspan="6">
                                    <strong>Giảm giá áp dụng:</strong>
                                    @if($dt->maGG == NULL)
                                        Chưa áp dụng.
                                    @else
                                        {{App\Models\giamgia::where('maGG',$dt->maGG)->value('tenGG')}}
                                        <a href="{{ url('') }}/banhang/chitietban/xoaGG/{{$dt->maorder}}/{{$dt->maGG}}"><i class="fas fa-trash-alt" style="color: #ff0000"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                @foreach($giamgia as $gg)
                @endforeach
                @if(Session::has('thungan') && Session::has('vaitrothungan'))
                    @if($gg)
                        <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Áp dụng mã giảm giá</button>
                        <ul class="dropdown-menu">
                            <li class="dropdown dropend">
                                <table style="width:340px;" class="table table-bordered table-hover table-striped">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>Khuyến mãi được áp dụng:</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    @foreach($giamgia as $gg)
                                    <tbody>
                                        <form action="{{route('postApDungGG')}}" method="post" enctype="multipart/form-data"> @csrf
                                            <input type="hidden" name="maGG" value="{{$gg->maGG}}">
                                            @foreach($banso as $b)
                                            <input type="hidden" name="maban" value="{{$b['maban']}}">
                                            @endforeach
                                            <tr>
                                                <td>{{$gg->tenGG}}</td>
                                                <td><button type="submit" class="btn btn-success" style="font-size: 11px;">Chọn</button></td>
                                            </tr>
                                        </form>
                                    </tbody>
                                    @endforeach
                                </table>
                            </li>
                        </ul>
                    @endif
                @endif
                @if(session('apdung-GG'))
                    <p style="color:red;"><i class="fas fa-exclamation-triangle"></i> {{ session('apdung-GG') }}</p>
                @endif
            @endif
        </div>
    </div>
    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    <script src="{{asset('js/themvebuffet.js')}}"></script>
    <script src="{{asset('js/chonmonbuffet.js')}}"></script>
    <script src="{{asset('js/thanhtoan.js')}}"></script>
    <script src="{{asset('js/time.js')}}"></script>

    <!-- Script menu nhiều cấp thanh toán -->
    <script>
        let dropdowns = document.querySelectorAll('.dropdown-toggle')
        dropdowns.forEach((dd) => {
            dd.addEventListener('click', function(e) {
                var el = this.nextElementSibling
                el.style.display = el.style.display === 'block' ? 'none' : 'block'
            })
        })
    </script>

    <!-- Tiền thừa -->
    <script>
        function checkResult() {
            var tongCong = document.getElementById("tongCong").value;
            var khachDua = document.getElementById("khachDua").value;
            tongCong = parseInt(tongCong);
            khachDua = parseInt(khachDua);
            if (!isNaN(khachDua - tongCong)){
                var tienThua = khachDua - tongCong;
                document.getElementById("tienThua").value = format2(tienThua,"");
            }
        }

        function format2(n, currency) {
            return n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,') + currency;
        }
    </script>

    <!-- Thanh toán PayPal -->
    <!-- <script src="https://www.paypalobjects.com/api/checkout.js"></script>
    <script>
    var usd = document.getElementById("vnd_to_usd").value;
    paypal.Button.render({
        // Configure environment
        env: 'sandbox',
        client: {
            sandbox: 'AY2Zmj9QdDkWTdH5KW7U9kG5Wem8cjS1LTEy4ZJ2VhWsNR288MjbeO3cyQHoU9hadWAVY2VFlU7Ilqxr',
            production: 'demo_production_client_id'
        },
        // Customize button (optional)
        locale: 'en_US',
        style: {
            size: 'small',
            color: 'gold',
            shape: 'pill',
        },

        // Enable Pay Now checkout flow (optional)
        commit: true,

        // Set up a payment
        payment: function(data, actions) {
        return actions.payment.create({
            transactions: [{
            amount: {
                total: `${usd}`,
                currency: 'USD'
            }
            }]
        });
        },
        // Execute the payment
        onAuthorize: function(data, actions) {
        return actions.payment.execute().then(function() {
            // Show a confirmation message to the buyer
            window.alert('Thanh toán thành công!');
        });
        }
    }, '#paypal-button');

    </script> -->
</body>

</html>