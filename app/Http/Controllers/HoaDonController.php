<?php

namespace App\Http\Controllers;

use App\Models\nhanvien;
use App\Models\thanhtoan;
use App\Models\ban;
use App\Models\order;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Session;

class HoaDonController extends Controller
{
    public function Admin()
    {
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            $thanhtoan = thanhtoan::orderBy('mathanhtoan', 'DESC')->get();
            $datangay = 0;
            $datathang = 0;
            $datanam = 0;
            return view('hoadon.admin', compact('thanhtoan', 'datangay', 'datathang','datanam'))->with('i', (request()->input('page', 1) - 1));
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function ThuNgan()
    {
        if (Session::has('thungan') && Session::has('vaitrothungan')) {
            $thanhtoan = thanhtoan::orderBy('mathanhtoan', 'DESC')->get();
            return view('hoadon.thungan', compact('thanhtoan'))->with('i', (request()->input('page', 1) - 1));
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function ChiTietHoaDon($mathanhtoan){
        if (Session::has('admin') && Session::has('vaitroadmin') || Session::has('thungan') && Session::has('vaitrothungan')) {
            $mathanhtoan = thanhtoan::where('mathanhtoan',$mathanhtoan)->get();
            return view('hoadon.chitiethoadon',compact('mathanhtoan'))->with('i', (request()->input('page', 1) - 1));
        }else {
            return redirect()->route('dangnhap');
        }
    }

    public function TimKiemHoaDon(Request $request){
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            $datangay = 0;
            $datathang = 0;
            $datanam = 0;
            $tenNV = nhanvien::where('tenNV','LIKE','%'.$request->search.'%')->first();
            $banso = ban::where('banso','LIKE','%'.$request->search.'%')->first();
            if($request->search == NULL){
                return redirect()->back();
            }else{
                if($tenNV){
                    $tenNV = nhanvien::where('tenNV','LIKE','%'.$request->search.'%')->get();
                    foreach ($tenNV as $tnv){}
                    $thanhtoan = thanhtoan::where('nhanvien',$tnv->tendangnhap)->get();
                }else if($banso){
                    $banso = ban::where('banso','LIKE','%'.$request->search.'%')->get();
                    foreach ($banso as $bs){}
                    $order = order::where('maban',$bs->maban)->where('trangthai',1)->first();
                    if($order){
                        $order = order::where('maban',$bs->maban)->where('trangthai',1)->get();
                        foreach ($order as $o){
                            $thanhtoan = thanhtoan::where('maorder',$o->maorder)->get();
                        }
                    }
                }else{
                    $thanhtoan = thanhtoan::where('mathanhtoan','LIKE','%'.$request->search.'%')
                                        ->orderBy('mathanhtoan', 'DESC')->get();
                }
            }
            $nhap = $request->search;
            return view('hoadon.admin', compact('thanhtoan', 'datangay', 'datathang','datanam','nhap'))->with('i', (request()->input('page', 1) - 1));
        }else {
            return redirect()->route('dangnhap');
        }
    }

    public function TimKiemHoaDonThuNgan(Request $request){
        if (Session::has('thungan') && Session::has('vaitrothungan')) {
            $tenNV = nhanvien::where('tenNV','LIKE','%'.$request->search.'%')->first();
            $banso = ban::where('banso','LIKE','%'.$request->search.'%')->first();
            if($request->search == NULL){
                return redirect()->back();
            }else{
                if($tenNV){
                    $tenNV = nhanvien::where('tenNV','LIKE','%'.$request->search.'%')->get();
                    foreach ($tenNV as $tnv){}
                    $thanhtoan = thanhtoan::where('nhanvien',$tnv->tendangnhap)->get();
                }else if($banso){
                    $banso = ban::where('banso','LIKE','%'.$request->search.'%')->get();
                    foreach ($banso as $bs){}
                    $order = order::where('maban',$bs->maban)->where('trangthai',1)->first();
                    if($order){
                        $order = order::where('maban',$bs->maban)->where('trangthai',1)->get();
                        foreach ($order as $o){
                            $thanhtoan = thanhtoan::where('maorder',$o->maorder)->get();
                        }
                    }
                }else{
                    $thanhtoan = thanhtoan::where('mathanhtoan','LIKE','%'.$request->search.'%')
                                        ->orderBy('mathanhtoan', 'DESC')->get();
                }
            }
            $nhap = $request->search;
            return view('hoadon.thungan', compact('thanhtoan','nhap'))->with('i', (request()->input('page', 1) - 1));
        }else {
            return redirect()->route('dangnhap');
        }
    }

    public function TimKiemHoaDonHomNay(){
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            $datangay = 0;
            $datathang = 0;
            $datanam = 0;
            $thanhtoan = DB::select(DB::raw("SELECT * 
                                            FROM `thanhtoan` 
                                            WHERE DATE(giothanhtoan)=CURRENT_DATE();"));
            $nhap = "";
            return view('hoadon.admin',compact('thanhtoan','nhap','datangay','datathang','datanam'))->with('i', (request()->input('page', 1) - 1));
        }else {
            return redirect()->route('dangnhap');
        }
    }

    public function TimKiemHoaDonHomNayThuNgan(){
        if (Session::has('thungan') && Session::has('vaitrothungan')) {
            $thanhtoan = DB::select(DB::raw("SELECT * 
                                            FROM `thanhtoan` 
                                            WHERE DATE(giothanhtoan)=CURRENT_DATE();"));
            $nhap = "";
            return view('hoadon.thungan',compact('thanhtoan','nhap'))->with('i', (request()->input('page', 1) - 1));
        }else {
            return redirect()->route('dangnhap');
        }
    }

    public function TimKiemHoaDonTuNgayDenNgay(Request $request){
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            $datangay = 0;
            $datathang = 0;
            $datanam = 0;
            $nhap = "";
            if($request->tuNgay == NULL){
                if($request->denNgay != NULL){
                    $thanhtoan = thanhtoan::where('giothanhtoan','<=',$request->denNgay." 00:00:00")->get();
                }else{
                    return redirect()->back();
                }
            }else if($request->tuNgay != NULL){
                if($request->denNgay != NULL){
                    $thanhtoan = thanhtoan::where('giothanhtoan','>=',$request->tuNgay." 00:00:00")->where('giothanhtoan','<=',$request->denNgay." 00:00:00")->get();
                }else{
                    $thanhtoan = thanhtoan::where('giothanhtoan','>=',$request->tuNgay." 00:00:00")->get();
                }
            }
            return view('hoadon.admin',compact('thanhtoan','nhap','datangay','datathang','datanam'))->with('i', (request()->input('page', 1) - 1));
        }else {
            return redirect()->route('dangnhap');
        }
    }

    public function TimKiemHoaDonTuNgayDenNgayThuNgan(Request $request){
        if (Session::has('thungan') && Session::has('vaitrothungan')) {
            $nhap = "";
            if($request->tuNgay == NULL){
                if($request->denNgay != NULL){
                    $thanhtoan = thanhtoan::where('giothanhtoan','<=',$request->denNgay." 00:00:00")->get();
                }else{
                    return redirect()->back();
                }
            }else if($request->tuNgay != NULL){
                if($request->denNgay != NULL){
                    $thanhtoan = thanhtoan::where('giothanhtoan','>=',$request->tuNgay." 00:00:00")->where('giothanhtoan','<=',$request->denNgay." 00:00:00")->get();
                }else{
                    $thanhtoan = thanhtoan::where('giothanhtoan','>=',$request->tuNgay." 00:00:00")->get();
                }
            }
            return view('hoadon.thungan',compact('thanhtoan','nhap'))->with('i', (request()->input('page', 1) - 1));
        }else {
            return redirect()->route('dangnhap');
        }
    }
}
