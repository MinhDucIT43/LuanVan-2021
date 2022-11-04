<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ve;
use App\Models\donvitinh;
use App\Models\mon;
use App\Models\order;

use Session;

class VeController extends Controller
{
    public function Admin(){
        if(Session::has('tendangnhap') && Session::has('vaitro')){
            $vebuffet = ve::orderBy('mave','DESC')->Paginate(8);
            return view('ve.admin',compact('vebuffet'));
        }else{
            return redirect()->route('dangnhap');
        }
    }

    public function getThemVeBuffet(){
        if(Session::has('tendangnhap') && Session::has('vaitro')){
            $donvitinh = donvitinh::all();
            return view('ve.themvebuffet.themvebuffet',['donvitinh'=>$donvitinh]);
        }else{
            return redirect()->route('dangnhap');
        }
    }

    public function postThemVeBuffet(Request $request){
        if(Session::get('tendangnhap') && Session::get('vaitro')){
            $vebuffet = new ve();
            $vebuffet->tenve = $request->tenve;
            $vebuffet->gia = $request->gia;
            $vebuffet->maDVT = $request->donvitinh;
            $vebuffet->save();
            $vebuffet = ve::orderBy('mave','DESC')->get();
            return redirect()->route('admin.ve',compact('vebuffet'))->with('success-themvebuffet','Thêm vé Buffet thành công!');
        }else{
            return redirect()->route('dangnhap');
        }
    }

    public function getSuaVeBuffet($mave){
        if(Session::has('tendangnhap') && Session::has('vaitro')){
            $vebuffet = ve::where('mave',$mave)->get();
            $donvitinh = donvitinh::all();
            return view('ve.suavebuffet.suavebuffet',['vebuffet' => $vebuffet,'donvitinh'=>$donvitinh]);
        }else{
            return redirect()->route('dangnhap');
        }
    }

    public function kiemtratenve($tenve){
        $vebuffet = ve::all();
        foreach($vebuffet as $ve){
            if($tenve == $ve->tenve){
                echo "Vé đã tồn tại";
            }else{
                echo "";
            }
        }
    }

    public function postSuaVeBuffet(Request $request, $mave){
        if(Session::has('tendangnhap') && Session::has('vaitro')){
            $vebuffet = ve::where('mave',$mave)->update([
                'tenve' => $request->tenve,
                'gia' => $request->gia,
                'maDVT' => $request->donvitinh,
            ]);
            $vebuffet = ve::orderBy('mave','DESC')->get();
            return redirect()->route('admin.ve',compact('vebuffet'))->with('success-themvebuffet','Sửa vé Buffet thành công!');
        }else{
            return redirect()->route('dangnhap');
        }
    }

    public function XoaVe($mave){
        if(Session::has('tendangnhap') && Session::has('vaitro')){
            $vebuffet = ve::orderBy('mave','DESC')->get();
            $mon_ve = mon::where('mave',$mave)->first();
            $order_ve = order::where('mave',$mave)->first();
            if($mon_ve){
                return redirect()->route('admin.ve',compact('vebuffet'))->with('success-themvebuffet','Tồn tại món ăn thuộc loại vé bạn muốn xoá!');
            }else if($order_ve){
                return redirect()->route('admin.ve',compact('vebuffet'))->with('success-themvebuffet','Tồn tại order có loại vé bạn muốn xoá!');                
            }else{
                ve::where('mave',$mave)->delete();
            return redirect()->route('admin.ve',compact('vebuffet'))->with('success-themvebuffet','Xóa vé Buffet thành công!');
            }
        }else{
            return redirect()->route('dangnhap');
        }
    }
}
