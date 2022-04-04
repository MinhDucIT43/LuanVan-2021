<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\loaisanpham;
use App\Models\sanpham;

use Session;

class LoaiSanPhamController extends Controller
{
    public function Admin(){
        if(Session::has('tendangnhap') && Session::has('vaitro')){
            $loaisanpham = loaisanpham::orderBy('maLSP','DESC')->Paginate(8);
            return view('loaisanpham.admin',compact('loaisanpham'));
        }else{
            return redirect()->route('dangnhap');
        }
    }

    public function Search(Request $request){
        if($request->keyword==''){
            $loaisanpham = loaisanpham::orderBy('maLSP','DESC')->Paginate(8);
        }else{
            $loaisanpham = loaisanpham::where('tenLSP','LIKE','%'.$request->keyword.'%')->orderBy('maLSP','DESC')->Paginate(8);
        }
        $nhap = $request->keyword;
        return view('loaisanpham.admin',compact('loaisanpham','nhap'));
    }

    public function getThemLoaiSanPham(){
        if(Session::has('tendangnhap') && Session::has('vaitro')){
            return view('loaisanpham.themloaisanpham.themloaisanpham');
        }else{
            return redirect()->route('dangnhap');
        }
    }

    public function kiemtratenlsp($tenloaisanpham){
        $loaisanpham = loaisanpham::all();
        foreach($loaisanpham as $lsp){
            if($tenloaisanpham == $lsp->tenLSP){
                echo "Loại sản phẩm đã tồn tại";
            }else{
                echo "";
            }
        }
    }

    public function postThemLoaiSanPham(Request $request){
        if(Session::get('tendangnhap') && Session::get('vaitro')){
            $loaisanpham = new loaisanpham();
            $loaisanpham->tenLSP = $request->tenloaisanpham;
            $loaisanpham->save();
            $loaisanpham = loaisanpham::orderBy('maLSP','DESC')->get();
            return redirect()->route('admin.loaisanpham',compact('loaisanpham'))->with('success-themloaisanpham','Thêm loại sản phẩm thành công!');
        }else{
            return redirect()->route('dangnhap');
        }
    }

    public function getSuaLoaiSanPham($maLSP){
        if(Session::has('tendangnhap') && Session::has('vaitro')){
            $loaisanpham = loaisanpham::orderBy('maLSP','DESC')->get();
            $loaisanpham_tt = sanpham::where('maLSP',$maLSP)->first();
            if($loaisanpham_tt){
                return redirect()->route('admin.loaisanpham',compact('loaisanpham'))->with('success-themloaisanpham','Tồn tại sản phẩm thuộc loại sản phẩm bạn muốn sửa.');
            }else{
                $loaisanpham = loaisanpham::where('maLSP',$maLSP)->get();
                return view('loaisanpham.sualoaisanpham.sualoaisanpham',['loaisanpham' => $loaisanpham]);
            }
        }else{
            return redirect()->route('dangnhap');
        }
    }

    public function postSuaLoaiSanPham(Request $request, $maLSP){
        if(Session::has('tendangnhap') && Session::has('vaitro')){
            $loaisanpham = loaisanpham::where('maLSP',$maLSP)->update([
                'tenLSP' => $request->tenloaisanpham,
            ]);
            $loaisanpham = loaisanpham::orderBy('maLSP','DESC')->get();
            return redirect()->route('admin.loaisanpham',compact('loaisanpham'))->with('success-themloaisanpham','Sửa loại sản phẩm thành công!');
        }else{
            return redirect()->route('dangnhap');
        }
    }

    public function XoaLoaiSanPham($maLSP){
        if(Session::has('tendangnhap') && Session::has('vaitro')){
            $loaisanpham = loaisanpham::orderBy('maLSP','DESC')->get();
            $loaisanpham_tt = sanpham::where('maLSP',$maLSP)->first();
            if($loaisanpham_tt){
                return redirect()->route('admin.loaisanpham',compact('loaisanpham'))->with('success-themloaisanpham','Tồn tại sản phẩm thuộc loại sản phẩm bạn muốn xóa.');
            }else{
                loaisanpham::where('maLSP',$maLSP)->delete();
                $loaisanpham = loaisanpham::orderBy('maLSP','DESC')->get();
                return redirect()->route('admin.loaisanpham',compact('loaisanpham'))->with('success-themloaisanpham','Xóa loại sản phẩm thành công!');
            }
        }else{
            return redirect()->route('dangnhap');
        }
    }
}
