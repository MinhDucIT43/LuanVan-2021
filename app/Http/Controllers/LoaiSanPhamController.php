<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\loaisanpham;
use App\Models\sanpham;

use Session;

class LoaiSanPhamController extends Controller
{
    public function Admin()
    {
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            $loaisanpham = loaisanpham::orderBy('maLSP', 'DESC')->Paginate(8);
            $datangay = 0;
            $datathang = 0;
            return view('loaisanpham.admin', compact('loaisanpham','datangay','datathang'))->with('i', (request()->input('page', 1) - 1) * 8);
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function Search(Request $request)
    {
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            if ($request->keyword == '') {
                $loaisanpham = loaisanpham::orderBy('maLSP', 'DESC')->Paginate(8);
            } else {
                $loaisanpham = loaisanpham::where('tenLSP', 'LIKE', '%' . $request->keyword . '%')->orderBy('maLSP', 'DESC')->Paginate(8);
            }
            $nhap = $request->keyword;
            $datangay = 0;
            $datathang = 0;
            return view('loaisanpham.admin', compact('loaisanpham', 'nhap','datangay','datathang'));
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function getThemLoaiSanPham()
    {
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            $datangay = 0;
            $datathang = 0;
            return view('loaisanpham.themloaisanpham.themloaisanpham',compact('datangay','datathang'));
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function kiemtratenlsp($tenloaisanpham)
    {
        $loaisanpham = loaisanpham::all();
        foreach ($loaisanpham as $lsp) {
            if ($tenloaisanpham == $lsp->tenLSP) {
                echo "Loại sản phẩm đã tồn tại";
            } else {
                echo "";
            }
        }
    }

    public function postThemLoaiSanPham(Request $request)
    {
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            $loaisanpham = new loaisanpham();
            $loaisanpham->tenLSP = $request->tenloaisanpham;
            $loaisanpham->save();
            $loaisanpham = loaisanpham::orderBy('maLSP', 'DESC')->get();
            return redirect()->route('admin.loaisanpham', compact('loaisanpham'))->with('success-themloaisanpham', 'Thêm loại sản phẩm thành công!');
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function getSuaLoaiSanPham($maLSP)
    {
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            $loaisanpham = loaisanpham::orderBy('maLSP', 'DESC')->get();
            $loaisanpham_tt = sanpham::where('maLSP', $maLSP)->first();
            $datangay = 0;
            $datathang = 0;
            if ($loaisanpham_tt) {
                return redirect()->route('admin.loaisanpham', compact('loaisanpham','datangay','datathang'))->with('success-themloaisanpham', 'Tồn tại sản phẩm thuộc loại sản phẩm bạn muốn sửa.');
            } else {
                $loaisanpham = loaisanpham::where('maLSP', $maLSP)->get();
                return view('loaisanpham.sualoaisanpham.sualoaisanpham', ['loaisanpham' => $loaisanpham,'datangay' => $datangay, 'datathang' => $datathang]);
            }
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function postSuaLoaiSanPham(Request $request, $maLSP)
    {
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            $loaisanpham = loaisanpham::where('maLSP', $maLSP)->update([
                'tenLSP' => $request->tenloaisanpham,
            ]);
            $loaisanpham = loaisanpham::orderBy('maLSP', 'DESC')->get();
            return redirect()->route('admin.loaisanpham', compact('loaisanpham'))->with('success-themloaisanpham', 'Sửa loại sản phẩm thành công!');
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function XoaLoaiSanPham($maLSP)
    {
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            $loaisanpham = loaisanpham::orderBy('maLSP', 'DESC')->get();
            $loaisanpham_tt = sanpham::where('maLSP', $maLSP)->first();
            if ($loaisanpham_tt) {
                return redirect()->route('admin.loaisanpham', compact('loaisanpham'))->with('success-themloaisanpham', 'Tồn tại sản phẩm thuộc loại sản phẩm bạn muốn xóa.');
            } else {
                loaisanpham::where('maLSP', $maLSP)->delete();
                $loaisanpham = loaisanpham::orderBy('maLSP', 'DESC')->get();
                return redirect()->route('admin.loaisanpham', compact('loaisanpham'))->with('success-themloaisanpham', 'Xóa loại sản phẩm thành công!');
            }
        } else {
            return redirect()->route('dangnhap');
        }
    }
}
