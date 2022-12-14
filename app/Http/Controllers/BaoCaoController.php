<?php

namespace App\Http\Controllers;

use App\Models\nhanvien;
use Illuminate\Http\Request;

use Session;

class BaoCaoController extends Controller
{
    public function BaoCao()
    {
        if (Session::has('thungan') && Session::has('vaitrothungan')) {
            $nhanvien = nhanvien::where('maCV',Session::get('vaitrothungan'))->get();
            return view('baocao.admin',compact('nhanvien'));
        } else {
            return redirect()->route('dangnhap');
        }
    }
}
