<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

use App\Models\nhanvien;
use App\Models\ban;
use App\Models\chucvu;
use App\Models\sanpham;
use App\Models\mon;
use App\Models\nhommon;
use App\Models\ve;
use App\Models\order;
use App\Models\chitietorder;
use App\Models\thanhtoan;

use Carbon\Carbon;
use PDF;
use Illuminate\Support\Facades\Storage;

use Session;

class BanHangController extends Controller
{
    public function BanHangAll(){
        if(Session::get('tendangnhap') && Session::get('vaitro')){
            $ban = ban::orderBy('maban','ASC')->paginate(16,'*','bp');
            $manuoc = nhommon::where('tenNM','LIKE','%'.'nước'.'%')->pluck('maNM');
            $nuoc = mon::whereIn('maNM',$manuoc)->paginate(8,'*','np');
            $mathit = nhommon::where('tenNM','LIKE','%'.'thịt'.'%')
                                ->orwhere('tenNM','LIKE','%'.'hải sản'.'%')
                                ->orwhere('tenNM','LIKE','%'.'lẩu'.'%')
                                ->orwhere('tenNM','LIKE','%'.'canh'.'%')
                                ->orwhere('tenNM','LIKE','%'.'truyền thống'.'%')
                                ->pluck('maNM');
            $thit = mon::whereIn('maNM',$mathit)->paginate(18,'*','tp');
            $vebuffet = ve::orderBy('mave','ASC')->paginate(3,'*','vp');
            $tableisworking = order::where('trangthai',0)->first();
            return view('banhang.banhangall',['ban'=>$ban,'nuoc'=>$nuoc,'thit'=>$thit,'vebuffet'=>$vebuffet,'tableisworking'=>$tableisworking]);
        }else {
            return redirect()->route('dangnhap');
        }
    }

    public function BanHangVeBuffet(){
        if(Session::get('tendangnhap') && Session::get('vaitro')){
            $ban = ban::orderBy('maban','ASC')->paginate(16,'*','bp');
            $vebuffet = ve::orderBy('mave','ASC')->paginate(4,'*','vp');
            return view('banhang.banhangvebuffet',['ban'=>$ban,'vebuffet'=>$vebuffet]);
        }else {
            return redirect()->route('dangnhap');
        }
    }

    public function BanHangMonAn(){
        if(Session::get('tendangnhap') && Session::get('vaitro')){
            $ban = ban::orderBy('maban','ASC')->paginate(16,'*','bp');
            $mathit = nhommon::where('tenNM','LIKE','%'.'thịt'.'%')
                                ->orwhere('tenNM','LIKE','%'.'hải sản'.'%')
                                ->orwhere('tenNM','LIKE','%'.'lẩu'.'%')
                                ->orwhere('tenNM','LIKE','%'.'canh'.'%')
                                ->orwhere('tenNM','LIKE','%'.'truyền thống'.'%')
                                ->pluck('maNM');
            $thit = mon::whereIn('maNM',$mathit)->paginate(11,'*','tp');
            return view('banhang.banhangmonan',['ban'=>$ban,'thit'=>$thit]);
        }else {
            return redirect()->route('dangnhap');
        }
    }

    public function BanHangThucUong(){
        if(Session::get('tendangnhap') && Session::get('vaitro')){
            $ban = ban::orderBy('maban','ASC')->paginate(16,'*','bp');
            $manuoc = nhommon::where('tenNM','LIKE','%'.'nước'.'%')->pluck('maNM');
            $nuoc = mon::whereIn('maNM',$manuoc)->paginate(11,'*','np');
            return view('banhang.banhangnuocuong',['ban'=>$ban,'nuoc'=>$nuoc]);
        }else {
            return redirect()->route('dangnhap');
        }
    }

    // public function BanSo($maban){
    //     if(Session::get('tendangnhap') && Session::get('vaitro')){
    //         $banso = ban::where('maban',$maban)->get();
    //         return view('banhang.chitietban',['banso'=>$banso]);
    //     }else{
    //         return redirect()->route('dangnhap');
    //     }
    // }

    public function BanSoVe($maban){
        if(Session::get('tendangnhap') && Session::get('vaitro')){
            $banso = ban::where('maban',$maban)->get();
            //$thanhtien = order::where('maban',$maban)->sum(soluong*gia);
            $trangthai = ban::where('maban',$maban)->where('trangthai',"Có khách")->first();
            $chuathanhtoan = order::where('maban',$maban)->where('trangthai',0)->first();
            $vebuffet = ve::orderBy('mave','ASC')->paginate(5);
            $maorder = order::where('maban',$maban)->get();
            foreach($maorder as $ma){}
            if($trangthai){
                if($chuathanhtoan){
                //     $vechon = order::where('maban',$maban)->get('mave');
                //     foreach($vechon as $v){}
                //     $listmon = mon::where('mave','<=',$v->mave)->where('mamon','<>',0)->get();
                //     // $mon199 = mon::where('mave',13)->get();
                //     // $mon269 = mon::where('mave',13)->orwhere('mave',14)->get();
                //     // $mon319 = mon::where('mave',13)->orwhere('mave',14)->orwhere('mave',15)->get();
                //     $soluongve = order::where('maban',$maban)->get('soluong');
                //     foreach($soluongve as $slv){}
                //     $giave = order::where('maban',$maban)->get('gia');
                //     foreach($giave as $gv){}
                //     $thanhtienve = $slv->soluong*$gv->gia;
                //     $thanhtienmon = chitietorder::where('maorder',$ma->maorder)->sum('thanhtien');
                //     $vebuffet = ve::where('mave',$v->mave)->get();
                //     $vetreem = mon::where('mamon',0)->get();
                //     // switch($v->mave){
                //     //     case 13: return view('banhang.chitietban199',compact('banso','thanhtien','mon199','vebuffet')); break;
                //     //     case 14: return view('banhang.chitietban269',compact('banso','thanhtien','mon269','vebuffet')); break;
                //     //     case 15: return view('banhang.chitietban319',compact('banso','thanhtien','mon319','vebuffet')); break;
                //     // }
                //     return view('banhang.chitietban199',compact('banso','thanhtienve','thanhtienmon','listmon','vebuffet','vetreem'));
                // }
                $vechon = order::where('maban',$maban)->get('mave');
                foreach($vechon as $v){}
                $listmon = mon::where('mave','<=',$v->mave)->where('mamon','<>',0)->get();
                // $mon199 = mon::where('mave',13)->get();
                // $mon269 = mon::where('mave',13)->orwhere('mave',14)->get();
                // $mon319 = mon::where('mave',13)->orwhere('mave',14)->orwhere('mave',15)->get();
                $soluongve = order::where('maban',$maban)->get('soluong');
                foreach($soluongve as $slv){}
                $giave = order::where('maban',$maban)->get('gia');
                foreach($giave as $gv){}
                $thanhtienve = $slv->soluong*$gv->gia;
                $thanhtienmon = chitietorder::where('maorder',$ma->maorder)->sum('thanhtien');
                $vebuffet = ve::where('mave',$v->mave)->get();
                $vetreem = mon::where('mamon',0)->get();
                // switch($v->mave){
                //     case 13: return view('banhang.chitietban199',compact('banso','thanhtien','mon199','vebuffet')); break;
                //     case 14: return view('banhang.chitietban269',compact('banso','thanhtien','mon269','vebuffet')); break;
                //     case 15: return view('banhang.chitietban319',compact('banso','thanhtien','mon319','vebuffet')); break;
                // }
                return view('banhang.chitietban199',compact('banso','thanhtienve','thanhtienmon','listmon','vebuffet','vetreem'));
                }
            }else{
                $thanhtienve = 0;
                $thanhtienmon = 0;
                return view('banhang.chitietbanve',['banso'=>$banso,'vebuffet'=>$vebuffet,'thanhtienve'=>$thanhtienve,'thanhtienmon'=>$thanhtienmon]);
            }
        }else{
            return redirect()->route('dangnhap');
        }
    }

    public function postThemVe(Request $request){
        if(Session::get('tendangnhap') && Session::get('vaitro')){
            $gia = ve::where('mave',$request->mave)->get('gia');
            $banso = ban::where('maban',$request->maban)->get();
            $order = order::where('maban',$request->maban)->where('mave',$request->mave)->where('trangthai',0)->first();
            $maorder = order::where('maban',$request->maban)->get();
            foreach($maorder as $ma){}
            if($order){
                $order = order::where('maban',$request->maban)->where('mave',$request->mave)->get();
                foreach($order as $o){}
                $soluongmoi = $o->soluong + $request->soluong;
                order::where('maban',$request->maban)->where('mave',$request->mave)->update([
                    'soluong' => $soluongmoi,
                ]);
            }else{
                $order = new order();
                $order->soluong = $request->soluong;
                foreach($gia as $g){}
                $order->gia = $g->gia;
                $order->maban =$request->maban;
                $order->mave = $request->mave;
                $order->giovao = $request->giovao;
                ban::where('maban',$request->maban)->update([
                    'trangthai' => "Có khách",
                ]);
                $order->save();
            }
            $soluongve = order::where('maban',$request->maban)->get('soluong');
            foreach($soluongve as $slv){}
            $giave = order::where('maban',$request->maban)->get('gia');
            foreach($giave as $gv){}
            $thanhtienve = $slv->soluong*$gv->gia;
            $thanhtienmon = 0;
            $vechon = $request->mave;
            $listmon = mon::where('mave','<=',$vechon)->where('mamon','<>',0)->get();
            // $mon269 = mon::where('mave',13)->get();
            // $mon269 = mon::where('mave',13)->orwhere('mave',14)->get();
            // $mon319 = mon::where('mave',13)->orwhere('mave',14)->orwhere('mave',15)->get();
            $vebuffet = ve::where('mave',$request->mave)->get();
            $vetreem = mon::where('mamon',0)->get();
            //witch($vechon){
                //case 13: return view('banhang.chitietban199',compact('banso','thanhtien','mon199','vebuffet')); break;
                // case 14: return view('banhang.chitietban269',compact('banso','thanhtien','mon269')); break;
                // case 15: return view('banhang.chitietban319',compact('banso','thanhtien','mon319')); break;
            //}
            return view('banhang.chitietban199',compact('banso','thanhtienve','thanhtienmon','listmon','vebuffet','vetreem'));
        }else{
            return redirect()->route('dangnhap');
        }
    }

    public function postThemMon(Request $request){
        if(Session::get('tendangnhap') && Session::get('vaitro')){
            $banso = ban::where('maban',$request->maban)->get();
            $vechon = $request->mave;
            $listmon = mon::where('mave','<=',$vechon)->where('mamon','<>',0)->get();
            $maorder = order::where('maban',$request->maban)->where('trangthai',0)->get();
            foreach($maorder as $ma){}
            $vebuffet = ve::where('mave',$ma->mave)->get();
            $vetreem = mon::where('mamon',0)->get();
            $checkmaorder = chitietorder::where('mamon',$request->mamon)->first();
            if($checkmaorder){
                $checkmaorder = chitietorder::where('mamon',$request->mamon)->get();
                foreach($checkmaorder as $cmo){}
                $check = order::where('maban',$request->maban)->where('maorder',$cmo->maorder)->where('trangthai',0)->first();
                if($check){
                    $check = chitietorder::where('mamon',$request->mamon)->get();
                    foreach($check as $c){}
                    $soluongmoi = $c->soluong + $request->soluong;
                    $thanhtienmoi = $c->gia*$soluongmoi;
                    chitietorder::where('mamon',$request->mamon)->update([
                        'soluong' => $soluongmoi,
                        'thanhtien' => $thanhtienmoi,
                    ]);
                }else{
                    $chitietorder = new chitietorder();
                    $chitietorder->soluong = $request->soluong;
                    $giamon = mon::where('mamon',$request->mamon)->get('gia');
                    foreach($giamon as $g){}
                    $chitietorder->gia = $g->gia;
                    $chitietorder->thanhtien = $request->soluong*$g->gia;
                    $chitietorder->mamon = $request->mamon;
                    $chitietorder->maorder = $ma->maorder;
                    $chitietorder->save();
                }
            }
            $soluongve = order::where('maban',$request->maban)->get('soluong');
            foreach($soluongve as $slv){}
            $giave = order::where('maban',$request->maban)->get('gia');
            foreach($giave as $gv){}
            $thanhtienve = $slv->soluong*$gv->gia;
            $thanhtienmon = chitietorder::where('maorder',$ma->maorder)->sum('thanhtien');
            return view('banhang.chitietban199',compact('banso','thanhtienmon','thanhtienve','listmon','vebuffet','vetreem'));
        }else{
            return redirect()->route('dangnhap');
        }
    }

    public function XoaOrderMon($mactorder){
        if(Session::get('tendangnhap') && Session::get('vaitro')){
            $maorder = chitietorder::where('mactorder',$mactorder)->get();
            foreach($maorder as $ma){}
            $banso = order::where('maorder',$ma->maorder)->get();
            $order = order::where('maorder',$ma->maorder)->get();
            foreach($order as $o){}
            $thanhtienve = $o->soluong*$o->gia;
            $listmon = mon::where('mave','<=',$o->mave)->where('mamon','<>',0)->get();
            $vebuffet = ve::where('mave',$o->mave)->get();
            $vetreem = mon::where('mamon',0)->get();
            chitietorder::where('mactorder',$mactorder)->delete();
            $thanhtienmon = chitietorder::where('maorder',$ma->maorder)->sum('thanhtien');
            return view('banhang.chitietban199',compact('banso','thanhtienmon','thanhtienve','listmon','vebuffet','vetreem'));
        }else{
            return redirect()->route('dangnhap');
        }
    }

    public function XoaOrderVe($maban,$mave){
        if(Session::get('tendangnhap') && Session::get('vaitro')){
            $banso = order::where('maban',$maban)->get();
            $maorder = order::where('maban',$maban)->where('mave',$mave)->get();
            foreach($maorder as $ma){}
            $thanhtienmon = chitietorder::where('maorder',$ma->maorder)->sum('thanhtien');
            $order = order::where('maorder',$ma->maorder)->get();
            foreach($order as $o){}
            $thanhtienve = $o->soluong*$o->gia;
            $listmon = mon::where('mave','<=',$mave)->where('mamon','<>',0)->get();
            $vebuffet = ve::where('mave',$mave)->get();
            $vetreem = mon::where('mamon',0)->get();
            $check = chitietorder::where('maorder',$ma->maorder)->first();
            if($check){
                return view('banhang.chitietban199',compact('banso','thanhtienmon','thanhtienve','listmon','vebuffet','vetreem'))->with('delete-xoave','Không thể xoá vé Buffet.');
            }else{
                order::where('maban',$maban)->where('mave',$mave)->delete();
                ban::where('maban',$maban)->update([
                    'trangthai' => "Trống",
                ]);
                return view('banhang.chitietban199',compact('banso','thanhtienmon','thanhtienve','listmon','vebuffet','vetreem'));
            }
        }else{
            return redirect()->route('dangnhap');
        }
    }

    public function thanhtoan($maorder){
        $chitietorder = chitietorder::where('maorder',$maorder)->get();
        $order = order::where('maorder',$maorder)->get();
        $data = [
            'danhsachorder' => $order,
            'danhsachchitietorder'    => $chitietorder,
        ];
        // return view('banhang.thanhtoan')
        //         ->with('danhsachorder', $order)
        //         ->with('danhsachchitietorder', $chitietorder);
        $thanhtoan = new thanhtoan();
        $thanhtoan->nhanvien = Session::get('tendangnhap');
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $thanhtoan->giothanhtoan = date('Y/m/d h:i:s');
        $thanhtoan->maorder = $maorder;
        foreach($order as $or){}
        ban::where('maban',$or->maban)->update([
            'trangthai' => "Trống",
        ]);
        order::where('maorder',$maorder)->update([
            'trangthai' => 1,
        ]);
        $thanhtoan->save();
        $pdf = PDF::loadView('banhang.thanhtoan',$data);
        $banso = ban::where('maban',$or->maban)->get();
        foreach($banso as $b){}
        Storage::put('public/storage/hoadon/'.$b->banso.'_'.date('Y').date('m').date('d').'_'.rand().'.'.'pdf',$pdf->output());
        return redirect()->route('banhangall');
    }

    // public function postThanhToan(Request $request){
    //     if(Session::get('tendangnhap') && Session::get('vaitro')){
    //         $datenow = Carbon::now('Asia/Ho_Chi_Minh');
    //         $mahd = random_int(0,9999);
    //         $kiemtrahd = hoadon::where('MaHD_Thu',$mahd)->first();
    //         if($kiemtrahd){
    //             while(!$kiemtrahd){
    //                 $mahd = random_int(0,9999);
    //             }
    //         }
    //         $hoadon = new hoadon();
    //         $hoadon->MaHD_Thu = $mahd;
    //         $hoadon->TongTien = $request->thanhtien;
    //         $hoadon->TenDangNhap = Session::get('tendangnhap');
    //         $hoadon->MaBan = $request->maban;
    //         $hoadon->NgayLap = $datenow->toDateString();
    //         $hoadon->save();
    //         $temp = temp::where('MaBan',$request->maban)->get();
    //         foreach($temp as $t){
    //             $chitiethd = new chitiet_hd_thu();
    //             $chitiethd->MaHD_Thu = $mahd;
    //             $chitiethd->MaMon = $t->MaMon;
    //             $chitiethd->soluong = $t->soluong;
    //             $mon = mon::where('MaMon',$t->MaMon)->get();
    //             foreach($mon as $m){}
    //             $chitiethd->DonGia = $m->Gia;
    //             $chitiethd->ThanhTien = ($t->soluong)*($m->Gia);
    //             $chitiethd->save();
    //         }
    //         temp::where('MaBan',$request->maban)->delete();
    //         $trusl = chitiet_hd_thu::where('MaHD_Thu',$mahd)->get();
    //         foreach($trusl as $tru){
    //             $truslmon = mon::where('MaMon',$tru->MaMon)->get();
    //             foreach($truslmon as $slmon){
    //                 $soluong = $slmon->soluong;
    //             }
    //             $soluongmoi = $soluong - $tru->soluong;
    //             mon::where('MaMon',$tru->MaMon)->update([
    //                 'soluong' => $soluongmoi
    //             ]);
    //         }
    //         $mon = mon::orderBy('MaMon','ASC')->paginate(10);
    //         $data = ban::orderBy('MaBan','ASC')->get();
    //         return view('banhang.admin',compact('mon','data'));
    //     }else{
    //         return redirect()->route('showlogin');
    //     }
    // }
}