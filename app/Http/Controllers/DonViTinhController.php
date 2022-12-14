<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\donvitinh;
use App\Models\mon;

use Session;

class DonViTinhController extends Controller
{
    public function Admin()
    {
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            $donvitinh = donvitinh::orderBy('maDVT', 'DESC')->Paginate(8);
            $datangay = 0;
            $datathang = 0;
            $datanam = 0;
            return view('donvitinh.admin', compact('donvitinh', 'datangay', 'datathang','datanam'))->with('i', (request()->input('page', 1) - 1) * 8);
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function Search(Request $request)
    {
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            if ($request->keyword == '') {
                $donvitinh = donvitinh::orderBy('maDVT', 'DESC')->Paginate(8);
            } else {
                $donvitinh = donvitinh::where('tenDVT', 'LIKE', '%' . $request->keyword . '%')->orderBy('maDVT', 'DESC')->Paginate(8);
            }
            $nhap = $request->keyword;
            $datangay = 0;
            $datathang = 0;
            $datanam = 0;
            return view('donvitinh.admin', compact('donvitinh', 'nhap', 'datangay', 'datathang', 'datanam'))->with('i', (request()->input('page', 1) - 1) * 8);
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function getThemDonViTinh()
    {
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            $datangay = 0;
            $datathang = 0;
            $datanam = 0;
            return view('donvitinh.themdonvitinh.themdonvitinh', compact('datangay', 'datathang', 'datanam'));
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function kiemtratendvt($tendonvitinh)
    {
        $donvitinh = donvitinh::all();
        foreach ($donvitinh as $dvt) {
            if ($tendonvitinh == $dvt->tenDVT) {
                echo "Đơn vị đã tồn tại";
            } else {
                echo "";
            }
        }
    }

    public function postThemDonViTinh(Request $request)
    {
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            $donvitinh = new donvitinh();
            $donvitinh->tenDVT = $request->tendonvitinh;
            $donvitinh->save();
            $donvitinh = donvitinh::orderBy('maDVT', 'DESC')->get();
            return redirect()->route('admin.donvitinh', compact('donvitinh'))->with('success-themdonvitinh', 'Thêm đơn vị tính thành công!');
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function getSuaDonViTinh($maDVT)
    {
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            $donvitinh = donvitinh::where('maDVT', $maDVT)->get();
            $datangay = 0;
            $datathang = 0;
            $datanam = 0;
            return view('donvitinh.suadonvitinh.suadonvitinh', ['donvitinh' => $donvitinh, 'datangay' => $datangay, 'datathang' => $datathang, 'datanam' => $datanam]);
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function postSuaDonViTinh(Request $request, $maDVT)
    {
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            $donvitinh = donvitinh::where('maDVT', $maDVT)->update([
                'tenDVT' => $request->tendonvitinh,
            ]);
            $donvitinh = donvitinh::orderBy('maDVT', 'DESC')->get();
            return redirect()->route('admin.donvitinh', compact('donvitinh'))->with('success-themdonvitinh', 'Sửa đơn vị tính thành công!');
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function XoaDonViTinh($maDVT)
    {
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            $donvitinh = donvitinh::orderBy('maDVT', 'DESC')->get();
            $donvitinh_tt = mon::where('maDVT', $maDVT)->first();
            if ($donvitinh_tt) {
                return redirect()->route('admin.donvitinh', compact('donvitinh'))->with('success-themdonvitinh', 'Tồn tại sản phẩm thuộc đơn vị tính bạn muốn xóa.');
            } else {
                donvitinh::where('maDVT', $maDVT)->delete();
                return redirect()->route('admin.donvitinh', compact('donvitinh'))->with('success-themdonvitinh', 'Xóa đơn vị tính thành công!');
            }
        } else {
            return redirect()->route('dangnhap');
        }
    }
}
