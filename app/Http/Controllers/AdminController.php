<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

use App\Models\thanhtoan;

use Carbon\Carbon;

use Session;

class AdminController extends Controller
{
    public function Admin(){
        if(Session::has('tendangnhap') && Session::has('vaitro')){
            $thang = date('m');
            switch($thang){
                case 1: case 3: case 5: case 7: case 8: case 10: case 12:
                    $songay = 31;    break;
                case 2: case 4: case 6: case 9: case 11:
                    $songay = 30; break;
            }
            $ngay = [];
            for($i=1; $i<=$songay; $i++){
                $ngay[] = $i;
            }
            $giothanhtoan = thanhtoan::select('giothanhtoan')->get();
            foreach($giothanhtoan as $gtt){}
            dd(substr($gtt->giothanhtoan,8,2));
            return view('admin.admin',compact('thang','ngay'));
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
