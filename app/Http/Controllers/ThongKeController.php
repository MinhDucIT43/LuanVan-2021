<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Session;

class ThongKeController extends Controller
{
    public function ThongKeNgay()
    {
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            $thang = date('m');
            $resultngay = DB::select(DB::raw("SELECT DATE(giothanhtoan) ngay, SUM(thanhtien) tongtien
                                        FROM `thanhtoan`
                                        WHERE MONTH(DATE(giothanhtoan))=MONTH(CURDATE())
                                        GROUP BY DATE(giothanhtoan);"));
            $datangay = "";
            foreach ($resultngay as $valngay) {
                $datangay .= "['" . $valngay->ngay . "'," . $valngay->tongtien . "],";
            }
            $datathang = 0;
            return view('thongke.thongkengay', compact('thang', 'datangay', 'datathang'));
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function ThongKeThang()
    {
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            $thang = date('m');
            $datangay = 0;
            $resultthang = DB::select(DB::raw("SELECT MONTH(DATE(giothanhtoan)) thang, SUM(thanhtien) tongtien 
            FROM `thanhtoan` 
            GROUP BY MONTH(DATE(giothanhtoan));"));
            $datathang = "";
            foreach ($resultthang as $valthang) {
                $datathang .= "['" . $valthang->thang . "'," . $valthang->tongtien . "],";
            }
            return view('thongke.thongkethang', compact('thang', 'datangay', 'datathang'));
        } else {
            return redirect()->route('dangnhap');
        }
    }
}
