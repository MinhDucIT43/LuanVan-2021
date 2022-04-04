<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ban;

use Session;

class BanController extends Controller
{
    public function Admin(){
        if(Session::has('tendangnhap') && Session::has('vaitro')){
            $ban = ban::orderBy('maban','DESC')->Paginate(8);
            return view('ban.admin',compact('ban'));
        }else{
            return redirect()->route('dangnhap');
        }
    }

    public function Search(Request $request){
        if($request->keyword==''){
            $ban = ban::orderBy('maban','DESC')->Paginate(8);
        }else{
            $ban = ban::where('banso','LIKE','%'.$request->keyword.'%')
                        ->orwhere('trangthai','LIKE','%'.$request->keyword.'%')
                        ->orderBy('maban','DESC')->Paginate(8);
        }
        $nhap = $request->keyword;
        return view('ban.admin',compact('ban','nhap'));
    }

    public function getThemBan(){
        if(Session::has('tendangnhap') && Session::has('vaitro')){
            return view('ban.themban.themban');
        }else{
            return redirect()->route('dangnhap');
        }
    }

    public function kiemtrasoban($banso){
        $ban = ban::all();
        foreach($ban as $b){
            if($banso == $b->banso){
                echo "Số bàn này đã tồn tại";
            }else{
                echo "";
            }
        }
    }

    public function postThemBan(Request $request){
        if(Session::get('tendangnhap') && Session::get('vaitro')){
            $ban = new ban();
            $ban->banso = $request->banso;
            $ban->trangthai = $request->trangthai;
            $ban->save();
            $ban = ban::orderBy('maban','DESC')->get();
            return redirect()->route('admin.ban',compact('ban'))->with('success-themban','Thêm bàn ăn thành công!');
        }else{
            return redirect()->route('dangnhap');
        }
    }

    public function getSuaBan($maban){
        if(Session::has('tendangnhap') && Session::has('vaitro')){
            $ban = ban::where('maban',$maban)->get();
            return view('ban.suaban.suaban',['ban' => $ban]);
        }else{
            return redirect()->route('dangnhap');
        }
    }

    public function postSuaBan(Request $request, $maban){
        if(Session::has('tendangnhap') && Session::has('vaitro')){
            $ban = ban::where('maban',$maban)->update([
                'banso' => $request->banso,
                'trangthai' => $request->trangthai,
            ]);
            $ban = ban::orderBy('maban','DESC')->get();
            return redirect()->route('admin.ban',compact('ban'))->with('success-themban','Sửa bàn ăn thành công!');
        }else{
            return redirect()->route('dangnhap');
        }
    }

    public function XoaBan($maban){
        if(Session::has('tendangnhap') && Session::has('vaitro')){
            ban::where('maban',$maban)->delete();
            $ban = ban::orderBy('maban','DESC')->get();
            return redirect()->route('admin.ban',compact('ban'))->with('success-themban','Xóa bàn ăn thành công!');
        }else{
            return redirect()->route('dangnhap');
        }
    }
}
