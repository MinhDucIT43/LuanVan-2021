<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\mon;
use App\Models\nhommon;
use App\Models\donvitinh;
use App\Models\ve;

use Session;

class MonController extends Controller
{
    public function Admin(){
        if(Session::has('tendangnhap') && Session::has('vaitro')){
            $mon = mon::orderBy('mamon','DESC')->Paginate(8);
            $nhommon = nhommon::orderBy('maNM','DESC')->get();
            $loaive = ve::orderBy('mave','DESC')->get();
            $datangay=0;
            $datathang=0;
            return view('mon.admin',compact('mon','nhommon','loaive','datangay','datathang'));
        }else{
            return redirect()->route('dangnhap');
        }
    }

    public function Search(Request $request){
        if($request->keyword==''){
            if($request->timkiemdanhmuc==''){
                $mon = mon::orderBy('mamon','DESC')->Paginate(8);
            }else{
                $mon = mon::where('maNM',$request->timkiemdanhmuc)
                                    ->orwhere('mave',$request->timkiemdanhmuc)
                                    ->orderBy('mamon','DESC')->Paginate(8);
            }
        }else{
            $tenNM = nhommon::where('tenNM',$request->keyword)->first();
            $loaive = ve::where('tenve',$request->keyword)->first();
            if($tenNM){
                $tenNM = nhommon::where('tenNM',$request->keyword)->get();
                foreach($tenNM as $nm){}
                $mon = mon::where('maNM','LIKE','%'.$nm->maNM.'%')->orderBy('mamon','DESC')->Paginate(8);
            }else if($loaive){
                $loaive = ve::where('tenve',$request->keyword)->get();
                foreach($loaive as $lv){}
                $mon = mon::where('mave','LIKE','%'.$lv->mave.'%')->orderBy('mamon','DESC')->Paginate(8);
            }else{
                $mon = mon::where('tenmon','LIKE','%'.$request->keyword.'%')
                            ->orderBy('mamon','DESC')->Paginate(8);
            }
        }
        $nhap = $request->keyword;
        $nhommon = nhommon::orderBy('maNM','DESC')->get();
        $loaive = ve::orderBy('mave','DESC')->get();
        $datangay=0;
        $datathang=0;
        return view('mon.admin',compact('mon','nhap','nhommon','loaive','datangay','datathang'));
    }

    public function getThemMon(){
        if(Session::has('tendangnhap') && Session::has('vaitro')){
            $nhommon = nhommon::all();
            $ve = ve::all();
            $donvitinh = donvitinh::all();
            $datangay=0;
            $datathang=0;
            return view('mon.themmon.themmon',['nhommon' => $nhommon,'donvitinh' => $donvitinh,'ve' => $ve,'datangay'=>$datangay,'datathang'=>$datathang]);
        }else{
            return redirect()->route('dangnhap');
        }
    }

    public function postThemMonAn(Request $request){
        if(Session::get('tendangnhap') && Session::get('vaitro')){
            $mon = new mon();
            $mon->tenmon = $request->tenmon;
            $mon->maNM = $request->thuocnhom;
            $mon->mave = $request->thuocve;
            $mon->gia = $request->gia;
            $mon->soluong = $request->soluong;
            $mon->maDVT = $request->donvitinh;
            $mon->save();
            $mon = mon::orderBy('mamon','DESC')->get();
            $nhommon = nhommon::orderBy('maNM','DESC')->get();
            $loaive = ve::orderBy('mave','DESC')->get();
            return redirect()->route('admin.mon',compact('mon','nhommon','loaive'))->with('success-themmonan','Thêm món ăn thành công!');
        }else{
            return redirect()->route('dangnhap');
        }
    }

    public function getSuaMon($mamon){
        if(Session::has('tendangnhap') && Session::has('vaitro')){
            $mon = mon::where('mamon',$mamon)->get();
            $nhommon = nhommon::all();
            $donvitinh = donvitinh::all();
            $ve = ve::all();
            $datangay=0;
            $datathang=0;
            return view('mon.suamon.suamon',['mon' => $mon, 'nhommon' => $nhommon, 'donvitinh' => $donvitinh, 've' => $ve,'datangay'=>$datangay,'datathang'=>$datathang]);
        }else{
            return redirect()->route('dangnhap');
        }
    }

    public function postSuaMon(Request $request, $mamon){
        if(Session::has('tendangnhap') && Session::has('vaitro')){
            $mon = mon::where('mamon',$mamon)->update([
                'tenmon' => $request->tenmon,
                'maNM' => $request->thuocnhom,
                'mave' => $request->thuocve,
                'gia' => $request->gia,
                'soluong' => $request->soluong,
                'maDVT' => $request->donvitinh,
            ]);
            $mon = mon::orderBy('mamon','DESC')->get();
            $nhommon = nhommon::orderBy('maNM','DESC')->get();
            $loaive = ve::orderBy('mave','DESC')->get();
            return redirect()->route('admin.mon',compact('mon','nhommon','loaive'))->with('success-themmonan','Sửa món ăn thành công!');
        }else{
            return redirect()->route('dangnhap');
        }
    }

    public function XoaMon($mamon){
        if(Session::has('tendangnhap') && Session::has('vaitro')){
            mon::where('mamon',$mamon)->delete();
            $mon = mon::orderBy('mamon','DESC')->get();
            $nhommon = nhommon::orderBy('maNM','DESC')->get();
            $loaive = ve::orderBy('mave','DESC')->get();
            return redirect()->route('admin.mon',compact('mon','nhommon','loaive'))->with('success-themmonan','Xóa món ăn thành công!');
        }else{
            return redirect()->route('dangnhap');
        }
    }
}
