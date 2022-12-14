<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán</title>
    <link rel="stylesheet" href="{{asset('css/thanhtoan.css')}}">
    <link rel="icon" href="{{asset('hinhanh/icon.png')}}">
</head>
<body>
    <div class="row">
        @foreach ($danhsachorder as $sp)
            <table border="0" align="center">
                <tr style="text-align: center;">
                    <td class="companyInfo" colspan="4">
                        <img src="{{asset('hinhanh/logo.png')}}" alt="Đăng nhập" style="width: 300px; height: 70px;">
                        <p>
                            Địa chỉ: Khu 2, đường 3/2, phường Xuân Khánh, quận Ninh Kiều, thành phố Cần Thơ <br/>
                            - 0945.579.649 -
                        </p>
                        <h1 class="tieude">HOÁ ĐƠN THANH TOÁN</h1>
                    </td>
                </tr>
                <tr>
                    <td style="width: 400px;">Số hoá đơn: <strong>HĐ{{$sp->maorder}}</strong><br/></td>
                    <td style="width: 300px;">Bàn: <strong>{{App\Models\ban::where('maban',$sp['maban'])->value('banso')}}</strong></td>
                </tr>
                <tr>
                    <td style="width: 400px;">
                        <input type="hidden" {{date_default_timezone_set("Asia/Ho_Chi_Minh")}}>
                        Giờ thanh toán: <strong>{{date('d/m/Y h:i:s a')}}</strong>
                    </td>
                    <td style="width: 300px;">Thu ngân: <strong>{{ App\Models\nhanvien::where('tendangnhap',Session::get('thungan'))->value('tenNV') }}</strong></td>
                </tr>
            </table>
        @endforeach
        <?php 
            $tongSoTrang = ceil(count($danhsachorder)/5);
        ?>
        <table border="0" align="center" cellpadding="5">
            <!-- <caption>Danh sách sản phẩm</caption> -->
            <!-- <tr>
                <th colspan="6" align="center">Trang 1 / {{ $tongSoTrang }}</th>
            </tr> -->
            <tr class="tieude">
                <th class="thanhphan">STT</th>
                <th class="thanhphan">Món</th>
                <th class="thanhphan">Số lượng</th>
                <th class="thanhphan">Đơn giá</th>
                <th class="thanhphan">KM</th>
                <th class="thanhphan">Thành tiền</th>
            </tr>
            @foreach ($danhsachorder as $sp)
            <?php $thanhtienve =  $sp->soluong*$sp->gia ?>
            <tr>
                <td align="center">{{ $loop->index + 1 }}</td>
                <td>{{App\Models\ve::where('mave',$sp['mave'])->value('tenve')}}</td>
                <td align="center">{{ $sp->soluong }}</td>
                <td align="right">{{number_format($sp->gia)}}</td>
                <td align="right"></td>
                <td align="right">{{number_format($thanhtienve)}}</td>
            </tr>
                @foreach ($danhsachchitietorder as $l)
                <?php $thanhtienmon =  App\Models\chitietorder::where('maorder',$l->maorder)->sum('thanhtien')?>
            <tr>
                <td align="center">{{ $loop->index + 2 }}</td>
                <td>{{App\Models\mon::where('mamon',$l['mamon'])->value('tenmon')}}</td>
                <td align="center">{{ $l->soluong }}</td>
                <td align="right">{{number_format($l->gia)}}</td>
                <td align="right"></td>
                <td align="right">{{number_format($l->thanhtien)}}</td>
            </tr>
                @endforeach
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td colspan="2">Tổng trước thuế:</td>
                <td align="right"><b>{{number_format($thanhtienmon+$thanhtienve)}}</b></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td colspan="2">Giảm giá:</td>
                @if($sp->maGG == NULL)
                    <td align="right"><b>0</b></td>
                @elseif($sp->maGG == 1)
                    <td align="right"><b>- {{number_format($sp->gia)}}</b></td>
                @elseif($sp->maGG == 2)
                    <td align="right"><b>- {{number_format(40000)}}</b></td>
                @endif
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td colspan="2" class="vat">VAT (10%):</td>
                <td align="right" class="vat"><b>{{number_format(($thanhtienmon+$thanhtienve)*0.1)}}</b></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td colspan="2"><b>TỔNG:</b></td>
                @if($sp->maGG == NULL)
                    <td align="right"><b>{{number_format((($thanhtienmon+$thanhtienve)+(($thanhtienmon+$thanhtienve)*0.1)))}}</b></td>
                @elseif($sp->maGG == 1)
                    <td align="right"><b>{{number_format((($thanhtienmon+$thanhtienve)+(($thanhtienmon+$thanhtienve)*0.1))- $sp->gia)}}</b></td>
                @elseif($sp->maGG == 2)
                    <td align="right"><b>{{number_format((($thanhtienmon+$thanhtienve)+(($thanhtienmon+$thanhtienve)*0.1))- 40000)}}</b></td>
                @endif
            </tr>
            <tr>
                <td colspan="6" align="center"><h3>Cảm ơn quý khách, hẹn gặp lại!</h3></td>
            </tr>
        </table>
        @if (($loop->index + 1) % 5 == 0)
        <table border="1" align="center" cellpadding="5">
            <tr>
                <th colspan="6" align="center">Trang {{ 1 + floor(($loop->index + 1) / 5) }} / {{ $tongSoTrang }}</th>
            </tr>
            <tr>
                <th>STT</th>
                <th>Hình sản phẩm</th>
                <th>Tên sản phẩm</th>
                <th>Giá gốc</th>
                <th>Giá bán</th>
                <th>Loại sản phẩm</th>
            </tr>
        @endif
            @endforeach
        </table>
    </div>
</body>
</html>