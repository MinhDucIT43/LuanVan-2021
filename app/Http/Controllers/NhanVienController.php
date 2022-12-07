<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Models\nhanvien;
use App\Models\chucvu;

use Image;

use Session;

class NhanVienController extends Controller
{
    public function Admin()
    {
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            $nhanvien = nhanvien::orderBy('tendangnhap', 'DESC')->Paginate(3);
            $chucvu = chucvu::orderBy('maCV', 'DESC')->get();
            $datangay = 0;
            $datathang = 0;
            return view('nhanvien.admin', compact('nhanvien', 'chucvu', 'datangay', 'datathang'))->with('i', (request()->input('page', 1) - 1) * 3);
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function Search(Request $request)
    {
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            if ($request->keyword == '') {
                if($request->timkiemdanhmuc == ""){
                    return redirect()->back();
                }else{
                    $nhanvien = nhanvien::where('maCV', $request->timkiemdanhmuc)
                                        ->orwhere('gioitinh', 'LIKE', '%' . $request->timkiemdanhmuc . '%')
                                        ->orderBy('tendangnhap', 'DESC')->Paginate(3);
                }
            } else if($request->timkiemdanhmuc == "") {
                $tenCV = chucvu::where('tenCV', $request->keyword)->first();
                if ($tenCV) {
                    $tenCV = chucvu::where('tenCV', $request->keyword)->get();
                    foreach ($tenCV as $t) {
                    }
                    $nhanvien = nhanvien::where('maCV', 'LIKE', '%' . $t->maCV . '%')->orderBy('tendangnhap', 'DESC')->Paginate(3);
                } else {
                    $nhanvien = nhanvien::where('soDT', 'LIKE', '%' . $request->keyword . '%')
                                        ->orwhere('tenNV', 'LIKE', '%' . $request->keyword . '%')
                                        ->orwhere('gioitinh', 'LIKE', '%' . $request->keyword . '%')
                                        ->orwhere('namsinh', 'LIKE', '%' . $request->keyword . '%')
                                        ->orwhere('diachi', 'LIKE', '%' . $request->keyword . '%')
                                        ->orderBy('tendangnhap', 'DESC')->Paginate(3);
                }
            }   else{
                $tenCV = chucvu::where('tenCV', $request->keyword)->first();
                if ($tenCV) {
                    $tenCV = chucvu::where('tenCV', $request->keyword)->get();
                    foreach ($tenCV as $t) {
                    }
                    $nhanvien = nhanvien::where('maCV', 'LIKE', '%' . $t->maCV . '%')->where('gioitinh', 'LIKE', '%' . $request->timkiemdanhmuc . '%')->orderBy('tendangnhap', 'DESC')->Paginate(3);
                } else {
                    $nhanvien = nhanvien::where('soDT', 'LIKE', '%' . $request->keyword . '%')->where('maCV', $request->timkiemdanhmuc)
                                        ->orwhere('tenNV', 'LIKE', '%' . $request->keyword . '%')->where('maCV', $request->timkiemdanhmuc)
                                        ->orwhere('gioitinh', 'LIKE', '%' . $request->keyword . '%')->where('maCV', $request->timkiemdanhmuc)
                                        ->orwhere('namsinh', 'LIKE', '%' . $request->keyword . '%')->where('maCV', $request->timkiemdanhmuc)
                                        ->orwhere('diachi', 'LIKE', '%' . $request->keyword . '%')->where('maCV', $request->timkiemdanhmuc)
                                        ->orderBy('tendangnhap', 'DESC')->Paginate(3);
                }
            }
            $nhaptext = $request->keyword;
            $nhapselect = $request->timkiemdanhmuc;
            $chucvu = chucvu::orderBy('maCV', 'DESC')->get();
            $datangay = 0;
            $datathang = 0;
            return view('nhanvien.admin', compact('nhanvien', 'nhaptext', 'nhapselect', 'chucvu', 'datangay', 'datathang'))->with('i', (request()->input('page', 1) - 1) * 3);
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function getThemNhanVien()
    {
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            $chucvu = chucvu::all();
            $datangay = 0;
            $datathang = 0;
            return view('nhanvien.themnhanvien.themnhanvien', ['chucvu' => $chucvu, 'datangay' => $datangay, 'datathang' => $datathang]);
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function kiemtrasdt($soDT)
    {
        $nhanvien = nhanvien::all();
        foreach ($nhanvien as $nv) {
            if ($soDT == $nv->soDT) {
                echo "Số điện thoại: Số điện thoại đã tồn tại";
            } else {
                echo "";
            }
        }
    }
    public function kiemtratuoi($namsinh)
    {
        $namsinhnhap = date_create($namsinh);
        if ((date('Y') - date_format($namsinhnhap, 'Y')) < 18) {
            echo "Năm sinh: Chưa đủ 18 tuổi";
        } else {
            echo "";
        }
    }

    public function postThemNhanVien(Request $request)
    {
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            if ($request->has('anhnhanvien')) {
                $file = $request->anhnhanvien;
                $tenfile_old = $file->getClientoriginalName();
                $tenfile_resize = Image::make($file->getRealPath());
                $tenfile_resize->resize(100, 100);
                $file->move(public_path('anhnhanvien'), $tenfile_old);
                $tenfile = $tenfile_resize->save(public_path('anhnhanvien/' . $tenfile_old))->filename . "." . $tenfile_resize->save(public_path('anhnhanvien/' . $tenfile_old))->extension;
            } else {
                $tenfile = "No";
            }
            $nhanvien = new nhanvien();
            $nhanvien->tenNV = $request->tennhanvien;
            if ($tenfile == "No") {
                $nhanvien->anhnhanvien = "Chưa có ảnh.";
            } else {
                $nhanvien->anhnhanvien = $tenfile_resize->save(public_path('anhnhanvien/' . $tenfile))->filename . "." . $tenfile_resize->save(public_path('anhnhanvien/' . $tenfile))->extension;
            }
            $nhanvien->namsinh = $request->namsinh;
            $nhanvien->gioitinh = $request->gioitinh;
            $nhanvien->matkhau = md5($request->matkhau);
            $nhanvien->diachi = $request->diachi;
            $nhanvien->soDT = $request->soDT;
            $nhanvien->ngayvaolam = $request->ngayvaolam;
            $nhanvien->maCV = $request->chucvu;
            $nhanvien->save();
            $nhanvien = nhanvien::orderBy('tendangnhap', 'DESC')->get();
            return redirect()->route('admin.nhanvien', compact('nhanvien'))->with('success-themnhanvien', 'Thêm nhân viên thành công!');
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function getSuaNhanVien($tendangnhap)
    {
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            $chucvu = chucvu::all();
            $nhanvien = nhanvien::where('tendangnhap', $tendangnhap)->get();
            $datangay = 0;
            $datathang = 0;
            return view('nhanvien.suanhanvien.suanhanvien', ['chucvu' => $chucvu, 'nhanvien' => $nhanvien, 'datangay' => $datangay, 'datathang' => $datathang]);
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function postSuaNhanVien(Request $request, $tendangnhap)
    {
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            if ($request->has('anhnhanvien')) {
                $file = $request->anhnhanvien;
                $tenfile_old = $file->getClientoriginalName();
                $tenfile_resize = Image::make($file->getRealPath());
                $tenfile_resize->resize(100, 100);
                $file->move(public_path('anhnhanvien'), $tenfile_old);
                $tenfile = $tenfile_resize->save(public_path('anhnhanvien/' . $tenfile_old))->filename . "." . $tenfile_resize->save(public_path('anhnhanvien/' . $tenfile_old))->extension;
            } else {
                $nhanvien = nhanvien::where('tendangnhap', $tendangnhap)->get();
                foreach ($nhanvien as $nv) {
                }
                $tenfile = $nv->anhnhanvien;
            }
            $nhanvien = nhanvien::where('tendangnhap', $tendangnhap)->update([
                'tenNV' => $request->tennhanvien,
                'anhnhanvien' => $tenfile,
                'namsinh' => $request->namsinh,
                'gioitinh' => $request->gioitinh,
                'matkhau' => $request->matkhau,
                'diachi' => $request->diachi,
                'soDT' => $request->soDT,
                'ngayvaolam' => $request->ngayvaolam,
                'maCV' => $request->chucvu
            ]);
            $nhanvien = nhanvien::orderBy('tendangnhap', 'DESC')->get();
            return redirect()->route('admin.nhanvien', compact('nhanvien'))->with('success-themnhanvien', 'Sửa nhân viên thành công!');
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function XoaNhanVien($tendangnhap)
    {
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            nhanvien::where('tendangnhap', $tendangnhap)->delete();
            $nhanvien = nhanvien::orderBy('tendangnhap', 'DESC')->get();
            return redirect()->route('admin.nhanvien', compact('nhanvien'))->with('success-themnhanvien', 'Xóa nhân viên thành công!');
        } else {
            return redirect()->route('dangnhap');
        }
    }
}
