<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\nhommon;
use App\Models\mon;

use Session;

class NhomMonController extends Controller
{
    public function Admin()
    {
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            $nhommon = nhommon::orderBy('maNM', 'DESC')->Paginate(8);
            $datangay = 0;
            $datathang = 0;
            $datanam = 0;
            return view('nhommon.admin', compact('nhommon', 'datangay', 'datathang', 'datanam'))->with('i', (request()->input('page', 1) - 1) * 8);
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function Search(Request $request)
    {
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            if ($request->keyword == '') {
                $nhommon = nhommon::orderBy('maNM', 'DESC')->Paginate(8);
            } else {
                $nhommon = nhommon::where('tenNM', 'LIKE', '%' . $request->keyword . '%')->orderBy('maNM', 'DESC')->Paginate(8);
            }
            $nhap = $request->keyword;
            $datangay = 0;
            $datathang = 0;
            $datanam = 0;
            return view('nhommon.admin', compact('nhommon', 'nhap', 'datangay', 'datathang', 'datanam'))->with('i', (request()->input('page', 1) - 1) * 8);
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function getThemNhomMon()
    {
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            $datangay = 0;
            $datathang = 0;
            $datanam = 0;
            return view('nhommon.themnhommon.themnhommon', compact('datangay', 'datathang', 'datanam'));
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function kiemtratennm($tennhommon)
    {
        $nhommon = nhommon::all();
        foreach ($nhommon as $nm) {
            if ($tennhommon == $nm->tenNM) {
                echo "Nhóm món này đã tồn tại";
            } else {
                echo "";
            }
        }
    }

    public function postThemNhomMon(Request $request)
    {
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            $nhommon = new nhommon();
            $nhommon->tenNM = $request->tennhommon;
            $nhommon->save();
            $nhommon = nhommon::orderBy('maNM', 'DESC')->get();
            return redirect()->route('admin.nhommon', compact('nhommon'))->with('success-themnhommon', 'Thêm nhóm món ăn thành công!');
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function getSuaNhomMon($maNM)
    {
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            $nhommon = nhommon::where('maNM', $maNM)->get();
            $datangay = 0;
            $datathang = 0;
            $datanam = 0;
            return view('nhommon.suanhommon.suanhommon', ['nhommon' => $nhommon, 'datangay' => $datangay, 'datathang' => $datathang, 'datanam' => $datanam]);
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function postSuaNhomMon(Request $request, $maNM)
    {
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            $nhommon = nhommon::where('maNM', $maNM)->update([
                'tenNM' => $request->tennhommon,
            ]);
            $nhommon = nhommon::orderBy('maNM', 'DESC')->get();
            return redirect()->route('admin.nhommon', compact('nhommon'))->with('success-themnhommon', 'Sửa nhóm món thành công!');
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function XoaNhomMon($maNM)
    {
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            $nhommon = nhommon::orderBy('maNM', 'DESC')->get();
            $nhommon_tt = mon::where('maNM', $maNM)->first();
            if ($nhommon_tt) {
                return redirect()->route('admin.nhommon', compact('nhommon'))->with('success-themnhommon', 'Tồn tại món thuộc nhóm món bạn muốn xóa.');
            } else {
                nhommon::where('maNM', $maNM)->delete();
                return redirect()->route('admin.nhommon', compact('nhommon'))->with('success-themnhommon', 'Xóa nhóm món thành công!');
            }
        } else {
            return redirect()->route('dangnhap');
        }
    }
}
