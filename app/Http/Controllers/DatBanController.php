<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\datban;
use App\Models\ban;

use Session;

class DatBanController extends Controller
{
    public function Admin(){
        if (Session::has('thungan') && Session::has('vaitrothungan')) {
            $datban = datban::orderBy('maDatBan', 'DESC')->Paginate(5);
            return view('datban.dadatban',compact('datban'))->with('i', (request()->input('page', 1) - 1) * 5);
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function getDuyetBanDat($maDatBan){
        if (Session::has('thungan') && Session::has('vaitrothungan')) {
            $datban = datban::where('maDatBan',$maDatBan)->get();
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $datadatban = datban::where('trangthai',1)->where('ngayDat','>=',date('Y/m/d'))->get();
            return view('datban.duyetban',compact('datban','datadatban'));
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function postDuyetDatBan(Request $request, $maDatBan)
    {
        if (Session::has('thungan') && Session::has('vaitrothungan')) {
            $datban = datban::where('maDatBan', $maDatBan)->update([
                'hoTen' => $request->inputName,
                'email' => $request->inputEmail,
                'soDT' => $request->inputPhone,
                'ngayDat' => $request->ngaydatban,
                'gioDat' => $request->inputHour,
                'phutDat' => $request->inputMinute,
                'soNguoi' => $request->inputNumber,
                'maban' => implode(',', $request->inputTable),
                'tendangnhap' => $request->tendangnhap,
                'ghiChu' => $request->inputNote,
                'trangthai' => 1,
            ]);
            $datban = datban::orderBy('maDatBan', 'DESC')->Paginate(10);
            return view('datban.dadatban',compact('datban'))->with('i', (request()->input('page', 1) - 1) * 10);
        } else {
            return redirect()->route('dangnhap');
        }
    }
}
