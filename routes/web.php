<?php

use Illuminate\Support\Facades\Route;

//Đăng nhập:
Route::get('/','App\Http\Controllers\DangNhapController@Admin')->name('dangnhap');
Route::post('dangnhap',[
    'as'=>'postDangNhap',
    'uses'=>'App\Http\Controllers\DangNhapController@DangNhap',
]);
//---------------------------------------------------------------------------------//

//Đổi mật khẩu:
Route::get('doimatkhau','App\Http\Controllers\DangNhapController@DoiMatKhau')->name('doimatkhau');
Route::post('doimatkhau',[
    'as'=>'postDoiMatKhau',
    'uses'=>'App\Http\Controllers\DangNhapController@postDoiMatKhau',
]);
//---------------------------------------------------------------------------------//

//Đăng xuất:
Route::get('dangxuatadmin','App\Http\Controllers\DangNhapController@DangXuatAdmin')->name('dangxuatadmin');
Route::get('dangxuatthungan','App\Http\Controllers\DangNhapController@DangXuatThuNgan')->name('dangxuatthungan');
//---------------------------------------------------------------------------------//

//Trở về:
Route::get('trove','App\Http\Controllers\DangNhapController@TroVe')->name('trove');
//---------------------------------------------------------------------------------//

//Gọi Admin:
Route::get('admin','App\Http\Controllers\AdminController@Admin')->name('admin');
//---------------------------------------------------------------------------------//

//Quản lý nhân viên:
Route::prefix('admin/nhanvien')->group(function(){
    Route::get('/','App\Http\Controllers\NhanVienController@Admin')->name('admin.nhanvien');
    //Search:
    Route::get('search','App\Http\Controllers\NhanVienController@Search')->name('admin.nhanvien.search');
    //Gọi form thêm nhân viên:
    Route::get('themnhanvien','App\Http\Controllers\NhanVienController@getThemNhanVien')->name('admin.nhanvien.themnhanvien');
    //Kiểm tra số điện thoại:
    Route::get('kiemtrasdtduynhat/{soDT}','App\Http\Controllers\NhanVienController@kiemtrasdt')->name('kiemtrasdtduynhat');
    //Kiểm tra tuổi:
    Route::get('kiemtratuoi/{namsinh}','App\Http\Controllers\NhanVienController@kiemtratuoi')->name('kiemtratuoi');
    Route::post('themnhanvien',[
        'as'=>'postThemNhanVien',
        'uses'=>'App\Http\Controllers\NhanVienController@postThemNhanVien',
    ]);
    //Kiểm tra số điện thoại:
    Route::get('suanhanvien/kiemtrasdtduynhat/{soDT}','App\Http\Controllers\NhanVienController@kiemtrasdt')->name('kiemtrasdtduynhat');
    //Kiểm tra tuổi:
    Route::get('suanhanvien/kiemtratuoi/{namsinh}','App\Http\Controllers\NhanVienController@kiemtratuoi')->name('kiemtratuoi');
    Route::get('suanhanvien/{tendangnhap}','App\Http\Controllers\NhanVienController@getSuaNhanVien')->name('admin.nhanvien.suanhanvien');
    Route::post('suanhanvien/{tendangnhap}',[
        'as'=>'postSuaNhanVien',
        'uses'=>'App\Http\Controllers\NhanVienController@postSuaNhanVien',
    ]);
    //Xoá nhân vien
    Route::get('xoanhanvien/{tendangnhap}','App\Http\Controllers\NhanVienController@XoaNhanVien')->name('admin.nhanvien.xoanhanvien');
});

//Quản lý chức vụ:
Route::prefix('admin/chucvu')->group(function(){
    Route::get('/','App\Http\Controllers\ChucVuController@Admin')->name('admin.chucvu');
    //Search:
    Route::get('search','App\Http\Controllers\ChucVuController@Search')->name('admin.chucvu.search');
    Route::get('themchucvu','App\Http\Controllers\ChucVuController@getThemChucVu')->name('admin.chucvu.themchucvu');
    //Kiểm tra tên chức vụ:
    Route::get('kiemtratenchucvu/{tenchucvu}','App\Http\Controllers\ChucVuController@kiemtratenchucvu')->name('kiemtratenchucvu');
    Route::post('themchucvu',[
        'as'=>'postThemChucVu',
        'uses'=>'App\Http\Controllers\ChucVuController@postThemChucVu',
    ]);
    //Kiểm tra chức vụ:
    Route::get('suachucvu/kiemtratenchucvu/{tenchucvu}','App\Http\Controllers\ChucVuController@kiemtratenchucvu')->name('kiemtratenchucvu');
    Route::get('suachucvu/{maCV}','App\Http\Controllers\ChucVuController@getSuaChucVu')->name('admin.chucvu.suachucvu');
    Route::post('suachucvu/{maCV}',[
        'as'=>'postSuaChucVu',
        'uses'=>'App\Http\Controllers\ChucVuController@postSuaChucVu',
    ]);
    Route::get('xoachucvu/{maCV}','App\Http\Controllers\ChucVuController@XoaChucVu')->name('admin.chucvu.xoachucvu');
});

//Quản lý đơn vị tính:
Route::get('admin/donvitinh','App\Http\Controllers\DonViTinhController@Admin')->name('admin.donvitinh');
//Search:
Route::get('admin/donvitinh/search','App\Http\Controllers\DonViTinhController@Search')->name('admin.donvitinh.search');
Route::get('admin/donvitinh/themdonvitinh','App\Http\Controllers\DonViTinhController@getThemDonViTinh')->name('admin.donvitinh.themdonvitinh');
//Kiểm tra tên đơn vị tính:
Route::get('admin/donvitinh/kiemtratendvt/{tendonvitinh}','App\Http\Controllers\DonViTinhController@kiemtratendvt')->name('kiemtratendvt');
Route::post('admin/donvitinh/themdonvitinh',[
    'as'=>'postThemDonViTinh',
    'uses'=>'App\Http\Controllers\DonViTinhController@postThemDonViTinh',
]);
Route::get('admin/donvitinh/suadonvitinh/{maDVT}','App\Http\Controllers\DonViTinhController@getSuaDonViTinh')->name('admin.donvitinh.suadonvitinh');
//Kiểm tra tên đơn vị tính:
Route::get('admin/donvitinh/suadonvitinh/kiemtratendvt/{tendonvitinh}','App\Http\Controllers\DonViTinhController@kiemtratendvt')->name('kiemtratendvt');
Route::post('admin/donvitinh/suadonvitinh/{maDVT}',[
    'as'=>'postSuaDonViTinh',
    'uses'=>'App\Http\Controllers\DonViTinhController@postSuaDonViTinh',
]);
Route::get('admin/donvitinh/xoadonvitinh/{maDVT}','App\Http\Controllers\DonViTinhController@XoaDonViTinh')->name('admin.donvitinh.xoadonvitinh');

//Quản lý loại sản phẩm:
Route::get('admin/loaisanpham','App\Http\Controllers\LoaiSanPhamController@Admin')->name('admin.loaisanpham');
//Search:
Route::get('admin/loaisanpham/search','App\Http\Controllers\LoaiSanPhamController@Search')->name('admin.loaisanpham.search');
Route::get('admin/loaisanpham/themloaisanpham','App\Http\Controllers\LoaiSanPhamController@getThemLoaiSanPham')->name('admin.loaisanpham.themloaisanpham');
//Kiểm tra tên loại sản phẩm:
Route::get('admin/loaisanpham/kiemtratenlsp/{tenloaisanpham}','App\Http\Controllers\LoaiSanPhamController@kiemtratenlsp')->name('kiemtratenlsp');
Route::post('admin/loaisanpham/themloaisanpham',[
    'as'=>'postThemLoaiSanPham',
    'uses'=>'App\Http\Controllers\LoaiSanPhamController@postThemLoaiSanPham',
]);
Route::get('admin/loaisanpham/sualoaisanpham/{maLSP}','App\Http\Controllers\LoaiSanPhamController@getSuaLoaiSanPham')->name('admin.loaisanpham.sualoaisanpham');
//Kiểm tra tên loại sản phẩm:
Route::get('admin/loaisanpham/sualoaisanpham/kiemtratenlsp/{tenloaisanpham}','App\Http\Controllers\LoaiSanPhamController@kiemtratenlsp')->name('kiemtratenlsp');
Route::post('admin/loaisanpham/sualoaisanpham/{maLSP}',[
    'as'=>'postSuaLoaiSanPham',
    'uses'=>'App\Http\Controllers\LoaiSanPhamController@postSuaLoaiSanPham',
]);
Route::get('admin/loaisanpham/xoaloaisanpham/{maLSP}','App\Http\Controllers\LoaiSanPhamController@XoaLoaiSanPham')->name('admin.loaisanpham.xoaloaisanpham');

//Quản lý sản phẩm:
Route::get('admin/sanpham','App\Http\Controllers\SanPhamController@Admin')->name('admin.sanpham');
//Search:
Route::get('admin/sanpham/search','App\Http\Controllers\SanPhamController@Search')->name('admin.sanpham.search');
Route::get('admin/sanpham/themsanpham','App\Http\Controllers\SanPhamController@getThemSanPham')->name('admin.sanpham.themsanpham');
Route::post('admin/sanpham/themsanpham',[
    'as'=>'postThemSanPham',
    'uses'=>'App\Http\Controllers\SanPhamController@postThemSanPham',
]);
Route::get('admin/sanpham/suasanpham/{maSP}','App\Http\Controllers\SanPhamController@getSuaSanPham')->name('admin.sanpham.suasanpham');
Route::post('admin/sanpham/suasanpham/{maSP}',[
    'as'=>'postSuaSanPham',
    'uses'=>'App\Http\Controllers\SanPhamController@postSuaSanPham',
]);
Route::get('admin/sanpham/xoasanpham/{maSP}','App\Http\Controllers\SanPhamController@XoaSanPham')->name('admin.sanpham.xoasanpham');

//Quản lý nhóm món ăn:
Route::get('admin/nhommon','App\Http\Controllers\NhomMonController@Admin')->name('admin.nhommon');
//Search:
Route::get('admin/nhommon/search','App\Http\Controllers\NhomMonController@Search')->name('admin.nhommon.search');
Route::get('admin/nhommon/themnhommon','App\Http\Controllers\NhomMonController@getThemNhomMon')->name('admin.nhommon.themnhommon');
//Kiểm tra tên nhóm món ăn:
Route::get('admin/nhommon/kiemtratennm/{tennhommon}','App\Http\Controllers\NhomMonController@kiemtratennm')->name('kiemtratennm');
Route::post('admin/nhommon/themnhommon',[
    'as'=>'postThemNhomMon',
    'uses'=>'App\Http\Controllers\NhomMonController@postThemNhomMon',
]);
Route::get('admin/nhommon/suanhommon/{maNM}','App\Http\Controllers\NhomMonController@getSuaNhomMon')->name('admin.nhommon.suanhommon');
//Kiểm tra tên nhóm món ăn:
Route::get('admin/nhommon/suanhommon/kiemtratennm/{tennhommon}','App\Http\Controllers\NhomMonController@kiemtratennm')->name('kiemtratennm');
Route::post('admin/nhommon/suanhommon/{maNM}',[
    'as'=>'postSuaNhomMon',
    'uses'=>'App\Http\Controllers\NhomMonController@postSuaNhomMon',
]);
Route::get('admin/nhommon/xoanhommon/{maNM}','App\Http\Controllers\NhomMonController@XoaNhomMon')->name('admin.nhommon.xoanhommon');

//Quản lý món ăn:
Route::get('admin/mon','App\Http\Controllers\MonController@Admin')->name('admin.mon');
//Search:
Route::get('admin/mon/search','App\Http\Controllers\MonController@Search')->name('admin.mon.search');
Route::get('admin/mon/themmon','App\Http\Controllers\MonController@getThemMon')->name('admin.mon.themmon');
Route::post('admin/mon/themmon',[
    'as'=>'postThemMonAn',
    'uses'=>'App\Http\Controllers\MonController@postThemMonAn',
]);
Route::get('admin/mon/suamon/{mamon}','App\Http\Controllers\MonController@getSuaMon')->name('admin.mon.suamon');
Route::post('admin/mon/suamon/{mamon}',[
    'as'=>'postSuaMon',
    'uses'=>'App\Http\Controllers\MonController@postSuaMon',
]);
Route::get('admin/mon/xoamon/{mamon}','App\Http\Controllers\MonController@XoaMon')->name('admin.mon.xoamon');

//Quản lý vé Buffet:
Route::get('admin/vebuffet','App\Http\Controllers\VeController@Admin')->name('admin.ve');
//Search:
Route::get('admin/vebuffet/search','App\Http\Controllers\VeController@Search')->name('admin.ve.search');
Route::get('admin/vebuffet/themvebuffet','App\Http\Controllers\VeController@getThemVeBuffet')->name('admin.ve.themve');
//Kiểm tra tên vé:
Route::get('admin/vebuffet/kiemtratenve/{tenve}','App\Http\Controllers\VeController@kiemtratenve')->name('kiemtratenve');
Route::post('admin/vebuffet/themvebuffet',[
    'as'=>'postThemVeBuffet',
    'uses'=>'App\Http\Controllers\VeController@postThemVeBuffet',
]);
Route::get('admin/vebuffet/suavebuffet/{mave}','App\Http\Controllers\VeController@getSuaVeBuffet')->name('admin.ve.suave');
//Kiểm tra tên vé:
Route::get('admin/vebuffet/suavebuffet/kiemtratenve/{tenve}','App\Http\Controllers\VeController@kiemtratenve')->name('kiemtratenve');
Route::post('admin/vebuffet/suavebuffet/{mave}',[
    'as'=>'postSuaVeBuffet',
    'uses'=>'App\Http\Controllers\VeController@postSuaVeBuffet',
]);
Route::get('admin/vebuffet/xoavebuffet/{mave}','App\Http\Controllers\VeController@XoaVe')->name('admin.ve.xoave');

//Quản lý bàn ăn:
Route::get('admin/ban','App\Http\Controllers\BanController@Admin')->name('admin.ban');
//Search:
Route::get('admin/ban/search','App\Http\Controllers\BanController@Search')->name('admin.ban.search');
Route::get('admin/ban/themban','App\Http\Controllers\BanController@getThemBan')->name('admin.ban.themban');
//Kiểm tra số bàn ăn:
Route::get('admin/ban/kiemtrasoban/{banso}','App\Http\Controllers\BanController@kiemtrasoban')->name('kiemtrasoban');
Route::post('admin/ban/themban',[
    'as'=>'postThemBan',
    'uses'=>'App\Http\Controllers\BanController@postThemBan',
]);
Route::get('admin/ban/suaban/{maban}','App\Http\Controllers\BanController@getSuaBan')->name('admin.ban.suaban');
//Kiểm tra số bàn ăn:
Route::get('admin/ban/suaban/kiemtrasoban/{banso}','App\Http\Controllers\BanController@kiemtrasoban')->name('kiemtrasoban');
Route::post('admin/ban/suaban/{maban}',[
    'as'=>'postSuaBan',
    'uses'=>'App\Http\Controllers\BanController@postSuaBan',
]);
Route::get('admin/ban/xoaban/{maban}','App\Http\Controllers\BanController@XoaBan')->name('admin.ban.xoaban');

//Bán hàng:
// Route::get('banhang','App\Http\Controllers\BanHangController@BanHang')->name('banhang');
Route::get('banhang','App\Http\Controllers\BanHangController@BanHangAll')->name('banhangall');
Route::get('banhang/vebuffet','App\Http\Controllers\BanHangController@BanHangVeBuffet')->name('banhangvebuffet');
Route::get('banhang/vebuffet/search','App\Http\Controllers\BanHangController@SearchVeBuffet')->name('banhang.vebuffet.search');
Route::get('banhang/monan','App\Http\Controllers\BanHangController@BanHangMonAn')->name('banhangmonan');
Route::get('banhang/monan/search','App\Http\Controllers\BanHangController@SearchMonAn')->name('banhang.monan.search');
Route::get('banhang/thucuong','App\Http\Controllers\BanHangController@BanHangThucUong')->name('banhangthucuong');
Route::get('banhang/thucuong/search','App\Http\Controllers\BanHangController@SearchThucUong')->name('banhang.thucuong.search');
//Route::get('banhang/chitietban/{maban}','App\Http\Controllers\BanHangController@BanSo')->name('banhang.chitietban');
Route::get('banhang/chitietbanve/{maban}','App\Http\Controllers\BanHangController@BanSoVe')->name('banhang.chitietbanve');
Route::post('banhang/chitietbanve/order',[
    'as'=>'postThemVe',
    'uses'=>'App\Http\Controllers\BanHangController@postThemVe',
]);
Route::post('banhang/chitietbanve/order1',[
    'as'=>'postThemMon',
    'uses'=>'App\Http\Controllers\BanHangController@postThemMon',
]);
Route::get('banhang/chitietban/xoaorderve/{maban}/{mave}','App\Http\Controllers\BanHangController@XoaOrderVe')->name('banhang.chitietban.xoaorderve');
Route::get('banhang/chitietban/xoaordermon/{mactorder}','App\Http\Controllers\BanHangController@XoaOrderMon')->name('banhang.chitietban.xoaordermon');
Route::post('banhang/chitietban/chuyenban',[
    'as'=>'postChuyenBan',
    'uses'=>'App\Http\Controllers\BanHangController@postChuyenBan',
]);
Route::get('banhang/chitietban/thanhtoan/{maorder}','App\Http\Controllers\BanHangController@thanhtoan')->name('thanhtoan.pdf');

//Quản lý thống kê:
Route::get('admin/thongke/thongkengay','App\Http\Controllers\ThongKeController@ThongKeNgay')->name('admin.thongke.thongkengay');
Route::get('admin/thongke/thongkethang','App\Http\Controllers\ThongKeController@ThongKeThang')->name('admin.thongke.thongkethang');

//Gọi trang khách hàng:
Route::get('khachhang','App\Http\Controllers\KhachHangController@KhachHang')->name('khachhang');
Route::get('khachhang/datban','App\Http\Controllers\KhachHangController@DatBan')->name('khachhang.datban');
Route::post('khachhang/datban',[
    'as'=>'postDatBan',
    'uses'=>'App\Http\Controllers\KhachHangController@postDatBan',
]);
Route::get('khachhang/thucdon','App\Http\Controllers\KhachHangController@ThucDon')->name('khachhang.thucdon');

// Đặt bàn:
Route::get('datban','App\Http\Controllers\DatBanController@Admin')->name('datban');
Route::get('datban/duyetbandat/{maDatBan}','App\Http\Controllers\DatBanController@getDuyetBanDat')->name('datban.getduyetbandat');
Route::post('datban/duyetbandat/{maDatBan}',[
    'as'=>'postDuyetDatBan',
    'uses'=>'App\Http\Controllers\DatBanController@postDuyetDatBan',
]);
Route::get('datban/daduyet','App\Http\Controllers\DatBanController@DaDuyet')->name('datban.daduyet');
Route::get('datban/themdatban','App\Http\Controllers\DatBanController@getThemDatBan')->name('datban.getthembandat');
Route::get('datban/xacnhan/{maDatBan}','App\Http\Controllers\DatBanController@xacNhan')->name('emails.xacnhan');

// Thanh toán PayPal:
Route::get('create-transaction','App\Http\Controllers\PayPalController@createTransaction')->name('createTransaction');
Route::get('process-transaction/{maorder}','App\Http\Controllers\PayPalController@processTransaction')->name('processTransaction');
Route::get('success-transaction/{maorder}','App\Http\Controllers\PayPalController@successTransaction')->name('successTransaction');
Route::get('cancel-transaction','App\Http\Controllers\PayPalController@cancelTransaction')->name('cancelTransaction');