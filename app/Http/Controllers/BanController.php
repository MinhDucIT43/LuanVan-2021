<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ban;
use App\Models\order;

use Session;

class BanController extends Controller
{
    public function Admin()
    {
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            $ban = ban::orderBy('maban', 'DESC')->Paginate(8);
            $datangay = 0;
            $datathang = 0;
            $datanam = 0;
            return view('ban.admin', compact('ban', 'datangay', 'datathang', 'datanam'))->with('i', (request()->input('page', 1) - 1) * 8);
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function Search(Request $request)
    {
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            if ($request->keyword == '') {
                $ban = ban::orderBy('maban', 'DESC')->Paginate(8);
            } else if ($request->keyword == "Trống" || $request->keyword == "trống") {
                $ban = ban::where('trangthai', 0)->orderBy('maban', 'DESC')->Paginate(8);
            } else if ($request->keyword == "Có khách" || $request->keyword == "có khách") {
                $ban = ban::where('trangthai', 1)->orderBy('maban', 'DESC')->Paginate(8);
            } else {
                $ban = ban::where('banso', 'LIKE', '%' . $request->keyword . '%')->orderBy('maban', 'DESC')->Paginate(8);
            }
            $nhap = $request->keyword;
            $datangay = 0;
            $datathang = 0;
            $datanam = 0;
            return view('ban.admin', compact('ban', 'nhap', 'datangay', 'datathang', 'datanam'))->with('i', (request()->input('page', 1) - 1) * 8);
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function getThemBan()
    {
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            $datangay = 0;
            $datathang = 0;
            $datanam = 0;
            return view('ban.themban.themban', compact('datangay', 'datathang', 'datanam'));
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function kiemtrasoban($banso)
    {
        $ban = ban::all();
        foreach ($ban as $b) {
            if ($banso == $b->banso) {
                echo "Số bàn này đã tồn tại";
            } else {
                echo "";
            }
        }
    }

    public function postThemBan(Request $request)
    {
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            $ban = new ban();
            $ban->banso = $request->banso;
            $ban->trangthai = $request->trangthai;
            $ban->save();
            $ban = ban::orderBy('maban', 'DESC')->get();
            return redirect()->route('admin.ban', compact('ban'))->with('success-themban', 'Thêm bàn ăn thành công!');
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function getSuaBan($maban)
    {
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            $ban = ban::where('maban', $maban)->get();
            $datangay = 0;
            $datathang = 0;
            $datanam = 0;
            return view('ban.suaban.suaban', ['ban' => $ban, 'datangay' => $datangay, 'datathang' => $datathang, 'datanam' => $datanam]);
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function postSuaBan(Request $request, $maban)
    {
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            $ban = ban::where('maban', $maban)->update([
                'banso' => $request->banso,
                'trangthai' => $request->trangthai,
            ]);
            $ban = ban::orderBy('maban', 'DESC')->get();
            return redirect()->route('admin.ban', compact('ban'))->with('success-themban', 'Sửa bàn ăn thành công!');
        } else {
            return redirect()->route('dangnhap');
        }
    }

    public function XoaBan($maban)
    {
        if (Session::has('admin') && Session::has('vaitroadmin')) {
            $order_ban = order::where('maban', $maban)->first();
            $ban = ban::orderBy('maban', 'DESC')->get();
            if ($order_ban) {
                return redirect()->route('admin.ban', compact('ban'))->with('success-themban', 'Bàn bạn muốn xoá đang có khách!');
            } else {
                ban::where('maban', $maban)->delete();
                return redirect()->route('admin.ban', compact('ban'))->with('success-themban', 'Xóa bàn ăn thành công!');
            }
        } else {
            return redirect()->route('dangnhap');
        }
    }
}
