<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

use App\Models\thanhtoan;
use App\Models\order;

use Carbon\Carbon;

use Session;

class AdminController extends Controller
{
    public function Admin(){
        if(Session::has('tendangnhap') && Session::has('vaitro')){
            $thang = date('m');
            $resultngay = DB::select(DB::raw("SELECT DATE(giothanhtoan) ngay, SUM(thanhtien) tongtien
                                        FROM `thanhtoan`
                                        WHERE MONTH(DATE(giothanhtoan))=MONTH(CURDATE())
                                        GROUP BY DATE(giothanhtoan);"));
            $datangay = "";
            foreach($resultngay as $valngay){
                $datangay.="['".$valngay->ngay."',".$valngay->tongtien."],";
            }
            $resultthang = DB::select(DB::raw("SELECT MONTH(DATE(giothanhtoan)) thang, SUM(thanhtien) tongtien 
                                        FROM `thanhtoan` 
                                        GROUP BY MONTH(DATE(giothanhtoan));"));
            $datathang = "";
            foreach($resultthang as $valthang){
                $datathang.="['".$valthang->thang."',".$valthang->tongtien."],";
            }
            $dathanhtoan = thanhtoan::count();
            $bandangphucvu = order::where('trangthai',0)->count();
            return view('admin.admin',compact('thang','datangay','datathang','dathanhtoan','bandangphucvu'));
        }else{
            return redirect()->route('dangnhap');
        }
    }

    // public function Master(){
    //     if(Session::has('tendangnhap') && Session::has('vaitro')){
    //         return view('master');
    //     }else{
    //         return redirect()->route('dangnhap');
    //     }
    // }
}
