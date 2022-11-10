<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KhachHangController extends Controller
{
    public function KhachHang(){
        return view('khachhang.khachhang');
    }
}
