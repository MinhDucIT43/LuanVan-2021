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
        if(Session::has('admin') && Session::has('vaitroadmin')){
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
            $dathanhtoan = DB::select(DB::raw("SELECT COUNT(*) dathanhtoan 
                                            FROM `thanhtoan` 
                                            WHERE DATE(giothanhtoan)=CURRENT_DATE();"));
            foreach($dathanhtoan as $datadathanhtoan){}
            $sothanhtoan = $datadathanhtoan->dathanhtoan;
            $bandangphucvu = order::where('trangthai',0)->count();
            return view('admin.admin',compact('thang','datangay','datathang','sothanhtoan','bandangphucvu'));
        }else{
            return redirect()->route('dangnhap');
        }
    }
}
