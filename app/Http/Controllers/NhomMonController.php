<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\nhommon;
use App\Models\mon;

use Session;

class NhomMonController extends Controller
{
    public function Admin(){
        if(Session::has('tendangnhap') && Session::has('vaitro')){
            $nhommon = nhommon::orderBy('maNM','DESC')->Paginate(8);
            return view('nhommon.admin',compact('nhommon'));
        }else{
            return redirect()->route('dangnhap');
        }
    }

    public function Search(Request $request){
        if($request->keyword==''){
            $nhommon = nhommon::orderBy('maNM','DESC')->Paginate(8);
        }else{
            $nhommon = nhommon::where('tenNM','LIKE','%'.$request->keyword.'%')->orderBy('maNM','DESC')->Paginate(8);
        }
        $nhap = $request->keyword;
        return view('nhommon.admin',compact('nhommon','nhap'));
    }

    public function getThemNhomMon(){
        if(Session::has('tendangnhap') && Session::has('vaitro')){
            return view('nhommon.themnhommon.themnhommon');
        }else{
            return redirect()->route('dangnhap');
        }
    }

    public function kiemtratennm($tennhommon){
        $nhommon = nhommon::all();
        foreach($nhommon as $nm){
            if($tennhommon == $nm->tenNM){
                echo "Nhóm món này đã tồn tại";
            }else{
                echo "";
            }
        }
    }

    public function postThemNhomMon(Request $request){
        if(Session::get('tendangnhap') && Session::get('vaitro')){
            $nhommon = new nhommon();
            $nhommon->tenNM = $request->tennhommon;
            $nhommon->save();
            $nhommon = nhommon::orderBy('maNM','DESC')->get();
            return redirect()->route('admin.nhommon',compact('nhommon'))->with('success-themnhommon','Thêm nhóm món ăn thành công!');
        }else{
            return redirect()->route('dangnhap');
        }
    }

    public function getSuaNhomMon($maNM){
        if(Session::has('tendangnhap') && Session::has('vaitro')){
            $nhommon = nhommon::orderBy('maNM','DESC')->get();
            $nhommon_tt = mon::where('maNM',$maNM)->first();
            if($nhommon_tt){
                return redirect()->route('admin.nhommon',compact('nhommon'))->with('success-themnhommon','Tồn tại món thuộc nhóm món bạn muốn sửa.');
            }else{
                $nhommon = nhommon::where('maNM',$maNM)->get();
                return view('nhommon.suanhommon.suanhommon',['nhommon' => $nhommon,]);
            }
        }else{
            return redirect()->route('dangnhap');
        }
    }

    public function postSuaNhomMon(Request $request, $maNM){
        if(Session::has('tendangnhap') && Session::has('vaitro')){
            $nhommon = nhommon::where('maNM',$maNM)->update([
                'tenNM' => $request->tennhommon,
            ]);
            $nhommon = nhommon::orderBy('maNM','DESC')->get();
            return redirect()->route('admin.nhommon',compact('nhommon'))->with('success-themnhommon','Sửa nhóm món thành công!');
        }else{
            return redirect()->route('dangnhap');
        }
    }

    public function XoaNhomMon($maNM){
        if(Session::has('tendangnhap') && Session::has('vaitro')){
            $nhommon = nhommon::orderBy('maNM','DESC')->get();
            $nhommon_tt = mon::where('maNM',$maNM)->first();
            if($nhommon_tt){
                return redirect()->route('admin.nhommon',compact('nhommon'))->with('success-themnhommon','Tồn tại món thuộc nhóm món bạn muốn xóa.');
            }else{
                nhommon::where('maNM',$maNM)->delete();
                $nhommon = nhommon::orderBy('maNM','DESC')->get();
                return redirect()->route('admin.nhommon',compact('nhommon'))->with('success-themnhommon','Xóa nhóm món thành công!');
            }
        }else{
            return redirect()->route('dangnhap');
        }
    }
}
