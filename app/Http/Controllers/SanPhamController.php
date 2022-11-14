<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\sanpham;
use App\Models\loaisanpham;
use App\Models\donvitinh;

use Session;

class SanPhamController extends Controller
{
    public function Admin()
    {
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            $sanpham = sanpham::orderBy('maSP', 'DESC')->Paginate(10);
            return view('sanpham.admin', compact('sanpham'));
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function Search(Request $request)
    {
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            if ($request->keyword == '') {
                $sanpham = sanpham::orderBy('maSP', 'DESC')->Paginate(10);
            } else {
                $tenLSP = loaisanpham::where('tenLSP', $request->keyword)->first();
                if ($tenLSP) {
                    $tenLSP = loaisanpham::where('tenLSP', $request->keyword)->get();
                    foreach ($tenLSP as $t) {
                    }
                    $sanpham = sanpham::where('maLSP', 'LIKE', '%' . $t->maLSP . '%')->orderBy('maSP', 'DESC')->Paginate(10);
                } else {
                    $sanpham = sanpham::where('tenSP', 'LIKE', '%' . $request->keyword . '%')->orderBy('maSP', 'DESC')->Paginate(10);
                }
            }
            $nhap = $request->keyword;
            return view('sanpham.admin', compact('sanpham', 'nhap'));
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function getThemSanPham()
    {
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            $loaisanpham = loaisanpham::all();
            $donvitinh = donvitinh::all();
            return view('sanpham.themsanpham.themsanpham', ['loaisanpham' => $loaisanpham, 'donvitinh' => $donvitinh]);
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function postThemSanPham(Request $request)
    {
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            $sanpham = new sanpham();
            $sanpham->tenSP = $request->tensanpham;
            $sanpham->maLSP = $request->thuocloai;
            $sanpham->gianhap = $request->gianhap;
            $sanpham->HSD = $request->hansudung;
            $sanpham->SLton = $request->slnhap;
            $sanpham->maDVT = $request->donvitinh;
            $sanpham->save();
            $sanpham = sanpham::orderBy('maSP', 'DESC')->get();
            return redirect()->route('admin.sanpham', compact('sanpham'))->with('success-themsanpham', 'Thêm sản phẩm thành công!');
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function getSuaSanPham($maSP)
    {
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            $sanpham = sanpham::where('maSP', $maSP)->get();
            $loaisanpham = loaisanpham::all();
            $donvitinh = donvitinh::all();
            return view('sanpham.suasanpham.suasanpham', ['sanpham' => $sanpham, 'loaisanpham' => $loaisanpham, 'donvitinh' => $donvitinh]);
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function postSuaSanPham(Request $request, $maSP)
    {
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            $sanpham = sanpham::where('maSP', $maSP)->update([
                'tenSP' => $request->tensanpham,
                'maLSP' => $request->thuocloai,
                'gianhap' => $request->gianhap,
                'HSD' => $request->hansudung,
                'SLton' => $request->slnhap,
                'maDVT' => $request->donvitinh,
            ]);
            $sanpham = sanpham::orderBy('maSP', 'DESC')->get();
            return redirect()->route('admin.sanpham', compact('sanpham'))->with('success-themsanpham', 'Sửa sản phẩm thành công!');
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function XoaSanPham($maSP)
    {
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            sanpham::where('maSP', $maSP)->delete();
            $sanpham = sanpham::orderBy('maSP', 'DESC')->get();
            return redirect()->route('admin.sanpham', compact('sanpham'))->with('success-themsanpham', 'Xóa sản phẩm thành công!');
        } else {
            return redirect()->route('dangnhap');
        }
    }
}
