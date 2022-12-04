<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\datban;
use App\Models\huydatban;
use Illuminate\Support\Facades\Mail;

use Session;

class DatBanController extends Controller
{
    public function Admin(){
        if (Session::has('thungan') && Session::has('vaitrothungan')) {
            $datban = datban::orderBy('maDatBan', 'DESC')->Paginate(4);
            return view('datban.dadatban',compact('datban'))->with('i', (request()->input('page', 1) - 1) * 4);
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function getDuyetBanDat($maDatBan){
        if (Session::has('thungan') && Session::has('vaitrothungan')) {
            $datban = datban::where('maDatBan',$maDatBan)->get();
            foreach($datban as $db){}
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $bandadat = datban::where('trangthai',1)->where('ngayDat','>=',date('Y/m/d'))->where('gioDat','>',$db->gioDat-5)->where('huy',0)->get();
            return view('datban.duyetban',compact('datban','bandadat'));
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function postDuyetDatBan(Request $request, $maDatBan)
    {
        if (Session::has('thungan') && Session::has('vaitrothungan')) {
            if($request->inputTable == ""){
                $maban = "";
                $tendangnhap = "";
                $trangthai = 0; 
            }else{
                $maban = implode(',', $request->inputTable);
                $tendangnhap = $request->tendangnhap;
                $trangthai = 1;
            }
            datban::where('maDatBan', $maDatBan)->update([
                'hoTen' => $request->inputName,
                'email' => $request->inputEmail,
                'soDT' => $request->inputPhone,
                'ngayDat' => $request->ngaydatban,
                'gioDat' => $request->inputHour,
                'phutDat' => $request->inputMinute,
                'soNguoi' => $request->inputNumber,
                'maban' => $maban,
                'tendangnhap' => $tendangnhap,
                'ghiChu' => $request->inputNote,
                'trangthai' => $trangthai,
            ]);
            // gửi email xác nhận:
            $banDat = datban::where('maDatBan',$maDatBan)->get();
            foreach($banDat as $bd){}
            Mail::send('emails.emailxacnhan', compact('banDat'), function($email) use($bd){
                $email->subject('Nhà hàng Buffet Duck BBQ - Xác nhận đặt bàn');
                $email->to($bd->email,$bd->hoTen);
            });
            return redirect()->route('datban');
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function DaDuyet(){
        if (Session::has('thungan') && Session::has('vaitrothungan')) {
            $daduyet = datban::where('trangthai',1)->orderBy('maDatBan', 'DESC')->Paginate(5);
            return view('datban.daduyet',compact('daduyet'))->with('i', (request()->input('page', 1) - 1) * 5);
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function getThemDatBan(){
        if (Session::has('thungan') && Session::has('vaitrothungan')) {
            return view('datban.themdatban');
        } else {
            return redirect()->route('dangnhap');
        } 
    }

    public function xacNhan($maDatBan)
    {
        if (Session::has('thungan') && Session::has('vaitrothungan')) {
            $banDat = datban::where('maDatBan',$maDatBan)->get();
            foreach($banDat as $bd){}
            datban::where('maDatBan', $maDatBan)->update([
                'accept' => 1,
            ]);
            Mail::send('emails.xacnhanthanhcong', compact('banDat'), function($email) use($bd){
                $email->subject('Nhà hàng Buffet King BBQ - Xác nhận đặt bàn thành công.');
                $email->to($bd->email,$bd->hoTen);
            });
            return redirect()->to('https://gmail.com');
        }else {
            return redirect()->route('dangnhap');
        } 
    }

    public function postHuyDatBan(Request $request){
        if (Session::has('thungan') && Session::has('vaitrothungan')) {
            $huydatban = new huydatban();
            $huydatban->lyDo = $request->inputLyDo;
            $huydatban->maDatBan = $request->maDatBan;
            $huydatban->save();
            datban::where('maDatBan',$request->maDatBan)->update([
                'huy' => 1,
            ]);
            return redirect()->route('datban');
        }else {
            return redirect()->route('dangnhap');
        }
    }
}
