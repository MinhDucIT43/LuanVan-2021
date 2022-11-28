<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\datban;

class KhachHangController extends Controller
{
    public function KhachHang(){
        return view('khachhang.trangchu');
    }

    public function DatBan(){
        return view('khachhang.datban');
    }

    public function postDatBan(Request $request){
        $sdt_chuaduyet = datban::where('soDT',$request->inputPhone)->where('trangthai',0)->first();
        $sdt_ngaygio = datban::where('soDT',$request->inputPhone)->where('ngayDat',$request->ngaydatban)->where('gioDat',$request->inputHour)->first();
        if($sdt_chuaduyet){
            return redirect()->back()->with('datbanthanhcong','Số điện thoại này đã đặt bàn nhưng chưa được duyệt.');
        }else if($sdt_ngaygio){
            return redirect()->back()->with('datbanthanhcong','Số điện thoại này đã đặt bàn vào giờ và ngày này.');
        }else{
            $datban = new datban();
            $datban->hoTen = $request->inputName;
            $datban->email = $request->inputEmail;
            $datban->soDT = $request->inputPhone;
            $datban->ngayDat = $request->ngaydatban;
            $datban->gioDat = $request->inputHour;
            $datban->phutDat = $request->inputMinute;
            $datban->soNguoi = $request->inputNumber;
            $datban->ghiChu = $request->inputNote;
            $datban->save();
            return redirect()->back()->with('datbanthanhcong','Cảm ơn bạn đã đặt bàn! Chúng tôi sẽ thông tin đến bạn qua email.');
        }
    }

    public function ThucDon(){
        return view('khachhang.thucdon');
    }
}
