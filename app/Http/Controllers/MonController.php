<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\mon;
use App\Models\nhommon;
use App\Models\donvitinh;

use Session;

class MonController extends Controller
{
    public function Admin(){
        if(Session::has('tendangnhap') && Session::has('vaitro')){
            $mon = mon::orderBy('mamon','DESC')->Paginate(8);
            return view('mon.admin',compact('mon'));
        }else{
            return redirect()->route('dangnhap');
        }
    }

    public function Search(Request $request){
        if($request->keyword==''){
            $mon = mon::orderBy('mamon','DESC')->Paginate(8);
        }else{
            $tenNM = nhommon::where('tenNM',$request->keyword)->first();
            if($tenNM){
                $tenNM = nhommon::where('tenNM',$request->keyword)->get();
                foreach($tenNM as $nm){}
                $mon = mon::where('maNM','LIKE','%'.$nm->maNM.'%')->orderBy('mamon','DESC')->Paginate(8);
            }else{
                $mon = mon::where('tenmon','LIKE','%'.$request->keyword.'%')
                            ->orderBy('mamon','DESC')->Paginate(8);
            }
        }
        $nhap = $request->keyword;
        return view('mon.admin',compact('mon','nhap'));
    }

    public function getThemMon(){
        if(Session::has('tendangnhap') && Session::has('vaitro')){
            $nhommon = nhommon::all();
            $donvitinh = donvitinh::all();
            return view('mon.themmon.themmon',['nhommon' => $nhommon,'donvitinh' => $donvitinh]);
        }else{
            return redirect()->route('dangnhap');
        }
    }

    public function postThemMon(Request $request){
        if(Session::get('tendangnhap') && Session::get('vaitro')){
            $mon = new mon();
            $mon->tenmon = $request->tenmon;
            $mon->maNM = $request->thuocnhom;
            $mon->gia = $request->gia;
            $mon->soluong = $request->soluong;
            $mon->maDVT = $request->donvitinh;
            $mon->save();
            $mon = mon::orderBy('mamon','DESC')->get();
            return redirect()->route('admin.mon',compact('mon'))->with('success-themmonan','Thêm món ăn thành công!');
        }else{
            return redirect()->route('dangnhap');
        }
    }

    public function getSuaMon($mamon){
        if(Session::has('tendangnhap') && Session::has('vaitro')){
            $mon = mon::where('mamon',$mamon)->get();
            $nhommon = nhommon::all();
            $donvitinh = donvitinh::all();
            return view('mon.suamon.suamon',['mon' => $mon, 'nhommon' => $nhommon, 'donvitinh' => $donvitinh]);
        }else{
            return redirect()->route('dangnhap');
        }
    }

    public function postSuaMon(Request $request, $mamon){
        if(Session::has('tendangnhap') && Session::has('vaitro')){
            $mon = mon::where('mamon',$mamon)->update([
                'tenmon' => $request->tenmon,
                'maNM' => $request->thuocnhom,
                'gia' => $request->gia,
                'soluong' => $request->soluong,
                'maDVT' => $request->donvitinh,
            ]);
            $mon = mon::orderBy('mamon','DESC')->get();
            return redirect()->route('admin.mon',compact('mon'))->with('success-themmonan','Sửa món ăn thành công!');
        }else{
            return redirect()->route('dangnhap');
        }
    }

    public function XoaMon($mamon){
        if(Session::has('tendangnhap') && Session::has('vaitro')){
            mon::where('mamon',$mamon)->delete();
            $mon = mon::orderBy('mamon','DESC')->get();
            return redirect()->route('admin.mon',compact('mon'))->with('success-themmonan','Xóa món ăn thành công!');
        }else{
            return redirect()->route('dangnhap');
        }
    }
}
