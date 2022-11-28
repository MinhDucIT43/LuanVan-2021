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
use App\Models\datban;

use Carbon\Carbon;
use PDF;
use Illuminate\Support\Facades\Storage;

use Session;

class BanHangController extends Controller
{
    public function BanHangAll()
    {
        if (Session::has('thungan') && Session::has('vaitrothungan') || Session::has('phucvu') && Session::has('vaitrophucvu')) {
            $ban = ban::orderBy('maban', 'ASC')->paginate(9, '*', 'bp');
            $datban = datban::where('ngayDat', '>=', date('Y/m/d'))->where('trangthai', 1)->get();
            $manuoc = nhommon::where('tenNM', 'LIKE', '%' . 'nước' . '%')->pluck('maNM');
            $nuoc = mon::whereIn('maNM', $manuoc)->paginate(8, '*', 'np');
            $mathit = nhommon::where('tenNM', 'LIKE', '%' . 'thịt' . '%')
                ->orwhere('tenNM', 'LIKE', '%' . 'hải sản' . '%')
                ->orwhere('tenNM', 'LIKE', '%' . 'lẩu' . '%')
                ->orwhere('tenNM', 'LIKE', '%' . 'canh' . '%')
                ->orwhere('tenNM', 'LIKE', '%' . 'truyền thống' . '%')
                ->pluck('maNM');
            $thit = mon::whereIn('maNM', $mathit)->paginate(18, '*', 'tp');
            $vebuffet = ve::orderBy('mave', 'ASC')->paginate(3, '*', 'vp');
            return view('banhang.banhangall', ['ban' => $ban, 'nuoc' => $nuoc, 'thit' => $thit, 'vebuffet' => $vebuffet, 'datban' => $datban]);
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function BanHangVeBuffet()
    {
        if (Session::has('thungan') && Session::has('vaitrothungan') || Session::has('phucvu') && Session::has('vaitrophucvu')) {
            $ban = ban::orderBy('maban', 'ASC')->paginate(9, '*', 'bp');
            $vebuffet = ve::orderBy('mave', 'ASC')->paginate(3, '*', 'vp');
            $datban = datban::where('ngayDat', '>=', date('Y/m/d'))->where('trangthai', 1)->get();
            return view('banhang.banhangvebuffet', ['ban' => $ban, 'vebuffet' => $vebuffet, 'datban' => $datban]);
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function BanHangMonAn()
    {
        if (Session::has('thungan') && Session::has('vaitrothungan') || Session::has('phucvu') && Session::has('vaitrophucvu')) {
            $ban = ban::orderBy('maban', 'ASC')->paginate(9, '*', 'bp');
            $mathit = nhommon::where('tenNM', 'LIKE', '%' . 'thịt' . '%')
                ->orwhere('tenNM', 'LIKE', '%' . 'hải sản' . '%')
                ->orwhere('tenNM', 'LIKE', '%' . 'lẩu' . '%')
                ->orwhere('tenNM', 'LIKE', '%' . 'canh' . '%')
                ->orwhere('tenNM', 'LIKE', '%' . 'truyền thống' . '%')
                ->pluck('maNM');
            $thit = mon::whereIn('maNM', $mathit)->paginate(11, '*', 'tp');
            $datban = datban::where('ngayDat', '>=', date('Y/m/d'))->where('trangthai', 1)->get();
            return view('banhang.banhangmonan', ['ban' => $ban, 'thit' => $thit, 'datban' => $datban]);
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function BanHangThucUong()
    {
        if (Session::has('thungan') && Session::has('vaitrothungan') || Session::has('phucvu') && Session::has('vaitrophucvu')) {
            $ban = ban::orderBy('maban', 'ASC')->paginate(9, '*', 'bp');
            $manuoc = nhommon::where('tenNM', 'LIKE', '%' . 'nước' . '%')->pluck('maNM');
            $nuoc = mon::whereIn('maNM', $manuoc)->paginate(11, '*', 'np');
            $datban = datban::where('ngayDat', '>=', date('Y/m/d'))->where('trangthai', 1)->get();
            return view('banhang.banhangnuocuong', ['ban' => $ban, 'nuoc' => $nuoc, 'datban' => $datban]);
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function BanSoVe($maban)
    {
        if (Session::has('thungan') && Session::has('vaitrothungan') || Session::has('phucvu') && Session::has('vaitrophucvu')) {
            $banso = ban::where('maban', $maban)->get();
            $trangthai = ban::where('maban', $maban)->where('trangthai', 1)->first();
            $chuathanhtoan = order::where('maban', $maban)->where('trangthai', 0)->first();
            $vebuffet = ve::orderBy('mave', 'ASC')->paginate(5);
            $vetreem = mon::where('mamon', 0)->get();
            if ($trangthai) {
                if ($chuathanhtoan) {
                    $vechon = order::where('maban', $maban)->get('mave');
                    foreach ($vechon as $v) {
                    }
                    $listmon = mon::where('mave', '<=', $v->mave)->where('mamon', '<>', 0)->get();
                    $vebuffet = ve::where('mave', $v->mave)->get();
                    return view('banhang.chitietban199', compact('banso', 'listmon', 'vebuffet', 'vetreem'))->with('i', (request()->input('page', 1) - 1));
                }
            } else {
                return view('banhang.chitietbanve', ['banso' => $banso, 'vebuffet' => $vebuffet])->with('i', (request()->input('page', 1) - 1));
            }
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function postThemVe(Request $request)
    {
        if (Session::has('thungan') && Session::has('vaitrothungan') || Session::has('phucvu') && Session::has('vaitrophucvu')) {
            $order = order::where('maban', $request->maban)->where('trangthai', 0)->first();
            if ($order) {
                $order = order::where('maban', $request->maban)->where('trangthai', 0)->get();
                foreach ($order as $o) {
                }
                $soluongmoi = $o->soluong + $request->soluong;
                order::where('maban', $request->maban)->where('trangthai', 0)->update([
                    'soluong' => $soluongmoi,
                ]);
            } else {
                $order = new order();
                $order->soluong = $request->soluong;
                $gia = ve::where('mave', $request->mave)->get();
                foreach ($gia as $g) {
                }
                $order->gia = $g->gia;
                $order->mave = $request->mave;
                $order->maban = $request->maban;
                ban::where('maban', $request->maban)->where('trangthai', 0)->update([
                    'trangthai' => 1,
                ]);
                $order->giovao = $request->giovao;
                $order->save();
            }
            return redirect()->back();
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function postThemMon(Request $request)
    {
        if (Session::has('thungan') && Session::has('vaitrothungan') || Session::has('phucvu') && Session::has('vaitrophucvu')) {
            $maorder = order::where('maban', $request->maban)->where('trangthai', 0)->get();
            foreach ($maorder as $ma) {
            }
            $checkmamon = chitietorder::where('mamon', $request->mamon)->where('maorder', $ma->maorder)->first();
            if ($checkmamon) {
                $checkmamon = chitietorder::where('mamon', $request->mamon)->where('maorder', $ma->maorder)->get();
                foreach ($checkmamon as $cmm) {
                }
                $soluongmoi = $cmm->soluong + $request->soluong;
                $thanhtienmoi = $cmm->gia * $soluongmoi;
                chitietorder::where('mamon', $request->mamon)->where('maorder', $ma->maorder)->update([
                    'soluong' => $soluongmoi,
                    'thanhtien' => $thanhtienmoi,
                ]);
            } else {
                $chitietorder = new chitietorder();
                $chitietorder->soluong = $request->soluong;
                $giamon = mon::where('mamon', $request->mamon)->get('gia');
                foreach ($giamon as $g) {
                }
                $chitietorder->gia = $g->gia;
                $chitietorder->thanhtien = $request->soluong * $g->gia;
                $chitietorder->mamon = $request->mamon;
                $chitietorder->maorder = $ma->maorder;
                $chitietorder->save();
            }
            return redirect()->back();
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function XoaOrderMon($mactorder)
    {
        if (Session::has('thungan') && Session::has('vaitrothungan') || Session::has('phucvu') && Session::has('vaitrophucvu')) {
            chitietorder::where('mactorder', $mactorder)->delete();
            return redirect()->back();
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function XoaOrderVe($maban, $mave)
    {
        if (Session::has('thungan') && Session::has('vaitrothungan') || Session::has('phucvu') && Session::has('vaitrophucvu')) {
            $maorder = order::where('maban', $maban)->where('mave', $mave)->where('trangthai', 0)->get();
            foreach ($maorder as $ma) {
            }
            $check = chitietorder::where('maorder', $ma->maorder)->first();
            if ($check) {
                return redirect()->back()->with('delete-Ve', 'Không thể xoá vé.');
            } else {
                order::where('maban', $maban)->where('mave', $mave)->where('trangthai', 0)->delete();
                ban::where('maban', $maban)->update([
                    'trangthai' => 0,
                ]);
                return redirect()->back();
            }
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function postChuyenBan(Request $request)
    {
        if (Session::has('thungan') && Session::has('vaitrothungan') || Session::has('phucvu') && Session::has('vaitrophucvu')) {
            $banso = ban::where('maban', $request->mabanmoi)->get();
            $vechon = order::where('maban', $request->mabancu)->where('trangthai', 0)->get();
            foreach ($vechon as $vc) {
            }
            $listmon = mon::where('mave', '<=', $vc->mave)->where('mamon', '<>', 0)->get();
            $vebuffet = ve::where('mave', $vc->mave)->get();
            $vetreem = mon::where('mamon', 0)->get();
            if ($request->mabanmoi == '') {
                return redirect()->back();
            } else {
                order::where('maban', $request->mabancu)->update([
                    'maban' => $request->mabanmoi,
                ]);
                ban::where('maban', $request->mabancu)->update([
                    'trangthai' => 0,
                ]);
                ban::where('maban', $request->mabanmoi)->update([
                    'trangthai' => 1,
                ]);
                return view('banhang.chitietban199', compact('banso', 'listmon', 'vebuffet', 'vetreem'))->with('i', (request()->input('page', 1) - 1));
            }
        }
    }

    public function thanhtoan($maorder)
    {
        if (Session::has('thungan') && Session::has('vaitrothungan')) {
            $chitietorder = chitietorder::where('maorder', $maorder)->get();
            $order = order::where('maorder', $maorder)->get();
            $data = [
                'danhsachorder' => $order,
                'danhsachchitietorder'    => $chitietorder,
            ];
            foreach ($order as $o) {
            }
            $thanhtienve = $o->soluong * $o->gia;
            $thanhtienmon = chitietorder::where('maorder', $maorder)->sum('thanhtien');
            // return view('banhang.thanhtoan')
            //         ->with('danhsachorder', $order)
            //         ->with('danhsachchitietorder', $chitietorder)
            //         ->with('thanhtienve', $thanhtienve)
            //         ->with('thanhtienmon', $thanhtienmon);
            $thanhtoan = new thanhtoan();
            $thanhtoan->nhanvien = Session::get('thungan');
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $thanhtoan->giothanhtoan = date('Y/m/d h:i:s');
            $thanhtoan->maorder = $maorder;
            ban::where('maban', $o->maban)->update([
                'trangthai' => 0,
            ]);
            order::where('maorder', $maorder)->update([
                'trangthai' => 1,
            ]);
            $thanhtoan->thanhtien = ($thanhtienve + $thanhtienmon);
            $thanhtoan->save();
            $pdf = PDF::loadView('banhang.thanhtoan', $data);
            $banso = ban::where('maban', $o->maban)->get();
            foreach ($banso as $b) {
            }
            Storage::put('public/storage/hoadon/' . $b->banso . '_' . date('Y') . date('m') . date('d') . '_' . rand() . '.' . 'pdf', $pdf->output());
            return redirect()->route('banhangall');
        } else {
            return redirect()->route('dangnhap');
        }
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
