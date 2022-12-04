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
            <b id="time">{{date('d/m/Y')}} <strong><p style="display:inline;" id="demo"></p></strong></b>
        </div>
        <div id="chonmon">
            <div id="header-chonmon">
                <?php
                $data = DB::table('order')->where('maban', $b->maban)->where('trangthai', 0)->first();
                $danhSachBan = DB::table('ban')->where('maban', '<>', $b->maban)->where('trangthai', 0)->get();
                ?>
                @foreach($banso as $b)
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
                                    Thanh toán<!-- <a class="btn btn-success thanhToan" href="{{ url('') }}/banhang/chitietban/thanhtoan/{{$dt->maorder}}">Thanh toán</a> -->
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="btn btn-success thanhToan" href="{{ url('') }}/banhang/chitietban/thanhtoan/{{$dt->maorder}}">Thanh toán bằng tiền mặt</a></li>
                                    <li>
                                        <div class="col-md--12">
                                            <?php 
                                                $vnd_to_usd = round(($thanhtienve+$thanhtienmon)/24780,2); 
                                                \Session::put('vnd_to_usd',$vnd_to_usd);
                                            ?>
                                            <!-- <div id="paypal-button"></div> -->
                                            <a class="btn btn-primary m-3" href="{{ route('processTransaction', ['maorder' => $dt->maorder]) }}">Thanh toán bằng Paypal</a>
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
    <script src="{{asset('js/chonmonbuffet.js')}}"></script>
    <script src="{{asset('js/thanhtoan.js')}}"></script>
    <script src="{{asset('js/time.js')}}"></script>

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