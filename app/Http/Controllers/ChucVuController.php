<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\chucvu;
use App\Models\nhanvien;

use Session;

class ChucVuController extends Controller
{
    public function Admin(){
        if(Session::has('tendangnhap') && Session::has('vaitro')){
            $chucvu = chucvu::orderBy('maCV','DESC')->Paginate(8);
            $datangay = 0;
            $datathang = 0;
            return view('chucvu.admin',compact('chucvu','datangay','datathang'));
        }else{
            return redirect()->route('dangnhap');
        }
    }

    public function Search(Request $request){
        if($request->keyword==''){
            $chucvu = chucvu::orderBy('maCV','DESC')->Paginate(8);
        }else{
            $chucvu = chucvu::where('tenCV','LIKE','%'.$request->keyword.'%')->orderBy('maCV','DESC')->Paginate(8);
        }
        $nhap = $request->keyword;
        $datangay = 0;
        $datathang = 0;
        return view('chucvu.admin',compact('chucvu','nhap','datangay','datathang'));
    }

    public function getThemChucVu(){
        if(Session::has('tendangnhap') && Session::has('vaitro')){
            $datangay = 0;
            $datathang = 0;
            return view('chucvu.themchucvu.themchucvu',compact('datangay','datathang'));
        }else{
            return redirect()->route('dangnhap');
        }
    }

    public function kiemtratenchucvu($tenchucvu){
        $chucvu = chucvu::all();
        foreach($chucvu as $cv){
            if($tenchucvu == $cv->tenCV){
                echo "Chức vụ đã tồn tại";
            }else{
                echo "";
            }
        }
    }

    public function postThemChucVu(Request $request){
        if(Session::get('tendangnhap') && Session::get('vaitro')){
            $chucvu = new chucvu();
            $chucvu->tenCV = $request->tenchucvu;
            $chucvu->tienluong = $request->tienluong;
            $chucvu->save();
            $chucvu = chucvu::orderBy('maCV','DESC')->get();
            return redirect()->route('admin.chucvu',compact('chucvu'))->with('success-themchucvu','Thêm chức vụ thành công!');
        }else{
            return redirect()->route('dangnhap');
        }
    }

    public function getSuaChucVu($maCV){
        if(Session::has('tendangnhap') && Session::has('vaitro')){
                $chucvu = chucvu::where('maCV',$maCV)->get();
                $datangay = 0;
                $datathang = 0;
                return view('chucvu.suachucvu.suachucvu',['chucvu' => $chucvu,'datangay'=>$datangay,'datathang'=>$datathang]);
        }else{
            return redirect()->route('dangnhap');
        }
    }

    public function postSuaChucVu(Request $request, $maCV){
        if(Session::has('tendangnhap') && Session::has('vaitro')){
            $chucvu = chucvu::where('maCV',$maCV)->update([
                'tenCV' => $request->tenchucvu,
                'tienluong' => $request->tienluong,
            ]);
            $chucvu = chucvu::orderBy('maCV','DESC')->get();
            return redirect()->route('admin.chucvu',compact('chucvu'))->with('success-themchucvu','Sửa chức vụ thành công!');
        }else{
            return redirect()->route('dangnhap');
        }
    }

    public function XoaChucVu($maCV){
        if(Session::has('tendangnhap') && Session::has('vaitro')){
            $chucvu = chucvu::orderBy('maCV','DESC')->get();
            $chucvu_tt = nhanvien::where('maCV',$maCV)->first();
            if($chucvu_tt){
                return redirect()->route('admin.chucvu',compact('chucvu'))->with('success-themchucvu','Tồn tại nhân viên có chức vụ bạn muốn xóa.');
            }else{
                chucvu::where('maCV',$maCV)->delete();
                return redirect()->route('admin.chucvu',compact('chucvu'))->with('success-themchucvu','Xóa chức vụ thành công!');
            }
        }else{
            return redirect()->route('dangnhap');
        }
    }
}