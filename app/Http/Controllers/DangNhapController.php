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
    public function Admin()
    {
        return view('dangnhap.dangnhap');
    }

    public function DangNhap(Request $request)
    {
        $request->validate([
            'tendangnhap' => 'required',
            'matkhau' => 'required',
        ], [
            'tendangnhap.required' => 'Tên đăng nhập rỗng.',
            'matkhau.required' => 'Mật khẩu rỗng.',
        ]);

        $tendangnhap = $request->tendangnhap;
        $matkhau =  md5($request->matkhau);

        $phucvu = chucvu::where('tenCV', 'LIKE', '%' . 'phục vụ' . '%')->get();
        foreach($phucvu as $pv){}
        $thungan = chucvu::where('tenCV', 'LIKE', '%' . 'thu ngân' . '%')->get();
        foreach ($thungan as $tn){}
        $admin = chucvu::where('tenCV', 'LIKE', '%' . 'admin' . '%')->get();
        foreach ($admin as $ad){}

        $phucvu = nhanvien::where('tendangnhap', $tendangnhap)->where('matkhau', $matkhau)->where('maCV', $pv->maCV)->first();
        $admin = nhanvien::where('tendangnhap', $tendangnhap)->where('matkhau', $matkhau)->where('maCV', $ad->maCV)->first();
        $thungan = nhanvien::where('tendangnhap', $tendangnhap)->where('matkhau', $matkhau)->where('maCV', $tn->maCV)->first();
        if ($admin) {
            Session::put('admin', $admin->tendangnhap);
            Session::put('vaitroadmin', $admin->maCV);
            return redirect()->route('admin');
        } else if ($thungan) {
            Session::put('thungan', $thungan->tendangnhap);
            Session::put('vaitrothungan', $thungan->maCV);
            return redirect()->route('banhangall');
        } else if($phucvu){
            Session::put('phucvu', $phucvu->tendangnhap);
            Session::put('vaitrophucvu', $phucvu->maCV);
            return redirect()->route('banhangall');
        } else {
            return redirect::back()->withInput()->with('alert-sai', 'Sai tên đăng nhập hoặc mật khẩu.');
        }
    }

    public function DoiMatKhau()
    {
        return view('dangnhap.doimatkhau');
    }

    public function postDoiMatKhau(Request $request)
    {
        $request->validate([
            'tendangnhap' => 'required',
            'matkhaucu' => 'required',
            'matkhaumoi' => 'required',
        ], [
            'tendangnhap.required' => 'Tên đăng nhập rỗng.',
            'matkhaucu.required' => 'Mật khẩu cũ rỗng.',
            'matkhaumoi.required' => 'Mật khẩu mới rỗng.',
        ]);

        $tendangnhap = $request->tendangnhap;
        $matkhaucu =  md5($request->matkhaucu);

        $nhanvien = nhanvien::where('tendangnhap', $tendangnhap)->where('matkhau', $matkhaucu)->first();

        if ($nhanvien) {
            nhanvien::where('tendangnhap', $tendangnhap)->where('matkhau', $matkhaucu)->update([
                'matkhau' => md5($request->matkhaumoi),
            ]);
            return redirect()->route('doimatkhau')->with('success-doimatkhau', 'Đổi mật khẩu thành công!');
        } else {
            return redirect::back()->withInput()->with('fail-doimatkhau', 'Sai tên đăng nhập hoặc mật khẩu cũ.');
        }
    }

    public function DangXuatAdmin()
    {
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            Session::forget('admin');
            Session::forget('vaitroadmin');
            return redirect()->route('dangnhap');
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function DangXuatThuNgan()
    {
        if (Session::has('thungan') && Session::has('vaitrothungan')) {
            Session::forget('thungan');
            Session::forget('vaitrothungan');
            return redirect()->route('dangnhap');
        } else if(Session::has('phucvu') && Session::has('vaitrophucvu')){
            Session::forget('phucvu');
            Session::forget('vaitrophucvu');
            return redirect()->route('dangnhap');
        }
        else {
            return redirect()->route('dangnhap');
        }
    }

    public function TroVe()
    {
        return redirect()->intended();
    }
}
