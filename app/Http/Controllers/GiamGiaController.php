<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\giamgia;

use Session;

class GiamGiaController extends Controller
{
    public function Admin()
    {
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            $giamgia = giamgia::orderBy('maGG', 'DESC')->Paginate(8);
            $datangay = 0;
            $datathang = 0;
            $datanam = 0;
            return view('giamgia.admin', compact('giamgia', 'datangay', 'datathang', 'datanam'))->with('i', (request()->input('page', 1) - 1) * 8);
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function getThemGiamGia()
    {
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            $datangay = 0;
            $datathang = 0;
            $datanam = 0;
            return view('giamgia.themgiamgia.themgiamgia', compact('datangay', 'datathang', 'datanam'));
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function postThemGiamGia(Request $request)
    {
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            $giamgia = new giamgia();
            $giamgia->tenGG = $request->tenGG;
            $giamgia->phanTramGG = $request->phanTramGG;
            $giamgia->ngayBD = $request->ngayBD;
            $giamgia->ngayKT = $request->ngayKT;
            $giamgia->save();
            $giamgia = giamgia::orderBy('maGG', 'DESC')->get();
            return redirect()->route('admin.giamgia', compact('giamgia'))->with('success-themban', 'Thêm giảm giá thành công!');
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function getSuaGiamGia($maGG)
    {
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            $giamgia = giamgia::where('maGG', $maGG)->get();
            $datangay = 0;
            $datathang = 0;
            $datanam = 0;
            return view('giamgia.suagiamgia.suagiamgia', ['giamgia' => $giamgia, 'datangay' => $datangay, 'datathang' => $datathang, 'datanam' => $datanam]);
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function postSuaGiamGia(Request $request, $maGG)
    {
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            $giamgia = giamgia::where('maGG', $maGG)->update([
                'tenGG' => $request->tenGG,
                'phanTramGG' => $request->phanTramGG,
                'ngayBD' => $request->ngayBD,
                'ngayKT' => $request->ngayKT,
            ]);
            $giamgia = giamgia::orderBy('maGG', 'DESC')->get();
            return redirect()->route('admin.giamgia', compact('giamgia'))->with('success-themban', 'Sửa giảm giá thành công!');
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function xoaGiamGia($maGG)
    {
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            giamgia::where('maGG', $maGG)->delete();
            $giamgia = giamgia::orderBy('maGG', 'DESC')->get();
            return redirect()->route('admin.giamgia', compact('giamgia'))->with('success-themban', 'Xóa giảm giá thành công!');
        } else {
            return redirect()->route('dangnhap');
        }
    }
}
