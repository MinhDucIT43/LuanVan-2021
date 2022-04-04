<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;

class AdminController extends Controller
{
    public function Admin(){
        if(Session::has('tendangnhap') && Session::has('vaitro')){
            return view('admin.admin');
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
