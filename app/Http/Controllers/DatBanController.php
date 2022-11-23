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
            $bandadat = datban::where('trangthai',1)->where('ngayDat','>=',date('Y/m/d'))->where('gioDat','>',$db->gioDat-5)->get();
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
            $datban = datban::where('maDatBan', $maDatBan)->update([
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
            $datban = datban::orderBy('maDatBan', 'DESC')->Paginate(10);
            return view('datban.dadatban',compact('datban'))->with('i', (request()->input('page', 1) - 1) * 10);
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
}
