<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use App\Models\nhanvien;
use App\Models\chucvu;

use Session;

class DangNhapController extends Controller
{
    public function Admin(){
        return view('dangnhap.dangnhap');
    }

    public function DangNhap(Request $request){
        $request->validate([
            'tendangnhap'=>'required',
            'matkhau'=>'required',
        ],[
            'tendangnhap.required'=>'Tên đăng nhập rỗng.',
            'matkhau.required'=>'Mật khẩu rỗng.',
        ]);

        $tendangnhap = $request->tendangnhap;
        $matkhau =  $request->matkhau;

        $chucvuadmin=1;
        $chucvuthungan=2;

        $admin = nhanvien::where('tendangnhap',$tendangnhap)->where('matkhau',$matkhau)->where('maCV',$chucvuadmin)->first();
        $thungan = nhanvien::where('tendangnhap',$tendangnhap)->where('matkhau',$matkhau)->where('maCV',$chucvuthungan)->first();

        if($admin){
            Session::put('tendangnhap',$admin->tendangnhap);
            Session::put('vaitro',$admin->maCV);
            return redirect()->route('admin');
        }else if($thungan){
            Session::put('tendangnhap',$thungan->tendangnhap);
            Session::put('vaitro',$thungan->maCV);
            //$data = ban::orderBy('MaBan','ASC')->get();
            return redirect()->route('banhang');
        }else{
            return redirect::back()->withInput()->with('alert-sai','Sai tên đăng nhập hoặc mật khẩu.');
        }
    }

    public function DoiMatKhau(){
        return view('dangnhap.doimatkhau');
    }

    public function postDoiMatKhau(Request $request){
        $request->validate([
            'tendangnhap'=>'required',
            'matkhaucu'=>'required',
            'matkhaumoi'=>'required',
        ],[
            'tendangnhap.required'=>'Tên đăng nhập rỗng.',
            'matkhaucu.required'=>'Mật khẩu cũ rỗng.',
            'matkhaumoi.required'=>'Mật khẩu mới rỗng.',
        ]);

        $tendangnhap = $request->tendangnhap;
        $matkhaucu =  $request->matkhaucu;

        $nhanvien = nhanvien::where('tendangnhap',$tendangnhap)->where('matkhau',$matkhaucu)->first();

        if($nhanvien){
            nhanvien::where('tendangnhap',$tendangnhap)->where('matkhau',$matkhaucu)->update([
                'matkhau' => $request->matkhaumoi,
            ]);
            return redirect()->route('doimatkhau')->with('success-doimatkhau','Đổi mật khẩu thành công!');
        }else{
            return redirect::back()->withInput()->with('fail-doimatkhau','Sai tên đăng nhập hoặc mật khẩu cũ.');
        }
    }

    public function DangXuatAdmin(){
        Session::put('tendangnhap',null);
        Session::put('vaitro',null);
        return redirect()->route('dangnhap');
    }

    public function TroVe(){
        return redirect()->intended();
    }
}