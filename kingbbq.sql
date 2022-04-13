-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 13, 2022 lúc 10:03 AM
-- Phiên bản máy phục vụ: 10.4.22-MariaDB
-- Phiên bản PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `kingbbq`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ban`
--

CREATE TABLE `ban` (
  `maban` int(11) NOT NULL,
  `banso` varchar(10) NOT NULL,
  `trangthai` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `ban`
--

INSERT INTO `ban` (`maban`, `banso`, `trangthai`) VALUES
(3, 'Bàn 1', 'Trống'),
(4, 'Bàn 2', 'Trống'),
(13, 'Bàn 3', 'Trống'),
(14, 'Bàn 4', 'Trống'),
(15, 'Bàn 5', 'Trống'),
(16, 'Bàn 6', 'Trống'),
(17, 'Bàn 7', 'Trống'),
(18, 'Bàn 8', 'Trống'),
(19, 'Bàn 9', 'Trống'),
(20, 'Bàn 10', 'Trống'),
(21, 'Bàn 11', 'Trống'),
(22, 'Bàn 12', 'Trống'),
(24, 'Bàn 13', 'Trống'),
(25, 'Bàn 14', 'Trống'),
(26, 'Bàn 15', 'Trống'),
(27, 'Bàn 16', 'Trống'),
(28, 'Bàn 17', 'Trống');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietorder`
--

CREATE TABLE `chitietorder` (
  `mactorder` int(11) NOT NULL,
  `soluong` int(11) NOT NULL,
  `mamon` int(11) NOT NULL,
  `maorder` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chucvu`
--

CREATE TABLE `chucvu` (
  `maCV` int(11) NOT NULL,
  `tenCV` varchar(20) NOT NULL,
  `tienluong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `chucvu`
--

INSERT INTO `chucvu` (`maCV`, `tenCV`, `tienluong`) VALUES
(1, 'Admin', 20000000),
(2, 'Phục vụ', 10000000),
(50, 'Bếp', 6500000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donvitinh`
--

CREATE TABLE `donvitinh` (
  `maDVT` int(11) NOT NULL,
  `tenDVT` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `donvitinh`
--

INSERT INTO `donvitinh` (`maDVT`, `tenDVT`) VALUES
(18, 'Kg'),
(23, 'Chai'),
(28, 'Ly'),
(29, 'Thố'),
(30, 'Nồi'),
(31, 'Cái'),
(32, 'Vé');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaisanpham`
--

CREATE TABLE `loaisanpham` (
  `maLSP` int(11) NOT NULL,
  `tenLSP` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `loaisanpham`
--

INSERT INTO `loaisanpham` (`maLSP`, `tenLSP`) VALUES
(30, 'Rượu'),
(31, 'Thịt heo'),
(39, 'Thịt gà');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `mon`
--

CREATE TABLE `mon` (
  `mamon` int(11) NOT NULL,
  `tenmon` varchar(30) NOT NULL,
  `gia` int(11) NOT NULL,
  `soluong` int(11) NOT NULL,
  `maNM` int(11) NOT NULL,
  `maDVT` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `mon`
--

INSERT INTO `mon` (`mamon`, `tenmon`, `gia`, `soluong`, `maNM`, `maDVT`) VALUES
(6, '7 up', 9000, 50, 41, 23),
(7, 'Thơm ép', 49000, 10, 45, 28),
(8, 'Cam ép', 59000, 15, 45, 28),
(9, 'Peppsi', 15000, 0, 41, 23),
(10, 'Trà đào cam sả', 45000, 0, 45, 28),
(16, 'Ép cà rốt', 45000, 80, 45, 28),
(25, 'Đùi gà sốt King BBQ', 0, 50, 48, 18),
(26, 'Nạc dăm sốt tỏi', 0, 50, 47, 18),
(27, 'Nạc dăm sốt đặc biệt', 0, 50, 47, 18),
(28, 'Sườn heo', 0, 50, 47, 18),
(29, 'Ba chỉ heo sốt cay', 0, 50, 47, 18),
(30, 'Ba chỉ heo tươi sốt thịt HQ', 0, 50, 47, 18),
(31, 'Ba chỉ heo ướp sốt đặc biệt', 0, 50, 47, 18),
(32, 'Ba chỉ heo sốt ớt chuông đỏ', 0, 50, 47, 18),
(33, 'Ba chỉ bò Mỹ sốt King BBQ', 0, 50, 46, 18),
(34, 'Ba chỉ bò sốt tenjo', 0, 50, 46, 18),
(35, 'Ba chỉ bò Mỹ sốt thịt HQ', 0, 50, 46, 18),
(36, 'Bắp bò sốt thịt HQ', 0, 50, 46, 18),
(37, 'Bắp bò sốt ớt chuông đỏ', 0, 50, 46, 18),
(38, 'Bắp bò sốt King BBQ', 0, 50, 46, 18),
(39, 'Bạch tuột tươi', 0, 50, 49, 18),
(40, 'Bạch tuột sốt cay', 0, 50, 49, 18),
(41, 'Cá saba Nhật sốt muối ớt', 0, 50, 49, 18),
(42, 'Cá basa nướng giấy bạc', 0, 50, 49, 18),
(43, 'Gầu bò sốt ớt chuông đỏ', 0, 50, 46, 18),
(44, 'Gầu bò sốt Guang Yang', 0, 50, 46, 18),
(45, 'Nạm cổ bò Mỹ sốt King BBQ', 0, 50, 46, 18),
(46, 'Nạm cổ bò Mỹ sốt tenjo', 0, 50, 46, 18),
(47, 'Lỗi cổ bò sốt tenjo', 0, 50, 46, 18),
(48, 'Lỗi cổ bò sốt King BBQ', 0, 50, 46, 18),
(49, 'Mực nang sốt muối ớt', 0, 50, 49, 18),
(50, 'Cá tấm nướng sốt Guang Yang', 0, 50, 49, 18),
(51, 'Vẹm xanh nhập khẩu', 0, 50, 49, 18),
(52, 'Lưỡi bò Mỹ sốt Guang Yang', 0, 50, 46, 18),
(53, 'Lưỡi bò Mỹ sốt thịt HQ', 0, 50, 46, 18),
(54, 'Dẻ sườn bò Mỹ sốt King BBQ', 0, 50, 46, 18),
(55, 'Dẻ sườn bò Mỹ sốt ớt chuông đỏ', 0, 50, 46, 18),
(56, 'Tôm nướng', 0, 50, 49, 18),
(57, 'Lẩu Bulgogi', 0, 100, 50, 30),
(58, 'Lẩu Thái', 0, 100, 50, 30),
(59, 'Canh sườn bò', 0, 50, 51, 29),
(60, 'Canh tương', 0, 50, 51, 29),
(61, 'Canh rong biển', 0, 50, 51, 29),
(62, 'Canh kim chi', 0, 50, 51, 29),
(63, 'Cơm trộn Hàn Quốc', 0, 50, 52, 29),
(64, 'Bánh hành hải sản HQ', 0, 50, 52, 31);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
--

CREATE TABLE `nhanvien` (
  `tendangnhap` int(11) NOT NULL,
  `tenNV` varchar(50) NOT NULL,
  `anhnhanvien` varchar(100) NOT NULL,
  `namsinh` date NOT NULL,
  `gioitinh` varchar(5) NOT NULL,
  `matkhau` varchar(30) NOT NULL,
  `diachi` varchar(150) NOT NULL,
  `soDT` varchar(20) NOT NULL,
  `ngayvaolam` date NOT NULL,
  `maCV` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `nhanvien`
--

INSERT INTO `nhanvien` (`tendangnhap`, `tenNV`, `anhnhanvien`, `namsinh`, `gioitinh`, `matkhau`, `diachi`, `soDT`, `ngayvaolam`, `maCV`) VALUES
(1, 'Nguyễn Minh Thành', 'admin.jpg', '1991-09-09', 'Nam', 'admin', 'thành phố Sa Đéc - Đồng Tháp', '0945579649', '2010-02-03', 1),
(2, 'Nguyễn Thị Như', 'thinhu.jpg', '2000-06-01', 'Nữ', 'thinhu00', 'huyện Châu Thành - Đồng Tháp', '0945579650', '2022-02-21', 2),
(4, 'Nguyễn Minh Đức', 'minhduc.jpg', '1998-05-03', 'Nam', 'minhđuc8', 'thành phố Sa Đéc - Đồng Tháp', '0945579651', '2022-02-22', 2),
(37, 'Trần Văn Thiện', 'thien.jpg', '2001-03-22', 'Nam', 'thien01', 'Huyện Cái Bè - tỉnh Tiền Giang', '0945579652', '2022-03-22', 50);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhommon`
--

CREATE TABLE `nhommon` (
  `maNM` int(11) NOT NULL,
  `tenNM` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `nhommon`
--

INSERT INTO `nhommon` (`maNM`, `tenNM`) VALUES
(41, 'Nước ngọt'),
(45, 'Nước ép'),
(46, 'Thịt bò'),
(47, 'Thịt heo'),
(48, 'Thịt gà'),
(49, 'Hải sản'),
(50, 'Lẩu'),
(51, 'Canh'),
(52, 'Truyền thống');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order`
--

CREATE TABLE `order` (
  `maorder` int(11) NOT NULL,
  `soluong` int(11) NOT NULL,
  `thanhtien` int(11) NOT NULL,
  `mave` int(11) NOT NULL,
  `maban` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `maSP` int(11) NOT NULL,
  `tenSP` varchar(30) NOT NULL,
  `gianhap` int(11) NOT NULL,
  `HSD` date NOT NULL,
  `SLton` int(11) NOT NULL,
  `maLSP` int(11) NOT NULL,
  `maDVT` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`maSP`, `tenSP`, `gianhap`, `HSD`, `SLton`, `maLSP`, `maDVT`) VALUES
(9, 'Rượu Sojiu truyền thống', 99000, '2022-03-04', 25, 30, 23),
(10, 'Ba chỉ heo', 180000, '2022-03-04', 100, 31, 18);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ve`
--

CREATE TABLE `ve` (
  `mave` int(11) NOT NULL,
  `tenve` varchar(30) NOT NULL,
  `gia` int(11) NOT NULL,
  `maDVT` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `ve`
--

INSERT INTO `ve` (`mave`, `tenve`, `gia`, `maDVT`) VALUES
(12, 'Trẻ em (1,0m - 1,3m)', 75000, 32),
(13, 'Người lớn 1', 199000, 32),
(14, 'Người lớn 2', 269000, 32),
(15, 'Người lớn 3', 319000, 32);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `ban`
--
ALTER TABLE `ban`
  ADD PRIMARY KEY (`maban`);

--
-- Chỉ mục cho bảng `chitietorder`
--
ALTER TABLE `chitietorder`
  ADD PRIMARY KEY (`mactorder`),
  ADD KEY `mamon` (`mamon`),
  ADD KEY `maorder` (`maorder`);

--
-- Chỉ mục cho bảng `chucvu`
--
ALTER TABLE `chucvu`
  ADD PRIMARY KEY (`maCV`);

--
-- Chỉ mục cho bảng `donvitinh`
--
ALTER TABLE `donvitinh`
  ADD PRIMARY KEY (`maDVT`);

--
-- Chỉ mục cho bảng `loaisanpham`
--
ALTER TABLE `loaisanpham`
  ADD PRIMARY KEY (`maLSP`);

--
-- Chỉ mục cho bảng `mon`
--
ALTER TABLE `mon`
  ADD PRIMARY KEY (`mamon`),
  ADD KEY `maNM` (`maNM`),
  ADD KEY `maDVT` (`maDVT`);

--
-- Chỉ mục cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`tendangnhap`),
  ADD KEY `maCV` (`maCV`);

--
-- Chỉ mục cho bảng `nhommon`
--
ALTER TABLE `nhommon`
  ADD PRIMARY KEY (`maNM`);

--
-- Chỉ mục cho bảng `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`maorder`),
  ADD KEY `maban` (`maban`),
  ADD KEY `mave` (`mave`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`maSP`),
  ADD KEY `maLSP` (`maLSP`),
  ADD KEY `maDVT` (`maDVT`);

--
-- Chỉ mục cho bảng `ve`
--
ALTER TABLE `ve`
  ADD PRIMARY KEY (`mave`),
  ADD KEY `maDVT` (`maDVT`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `ban`
--
ALTER TABLE `ban`
  MODIFY `maban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT cho bảng `chitietorder`
--
ALTER TABLE `chitietorder`
  MODIFY `mactorder` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `chucvu`
--
ALTER TABLE `chucvu`
  MODIFY `maCV` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT cho bảng `donvitinh`
--
ALTER TABLE `donvitinh`
  MODIFY `maDVT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `loaisanpham`
--
ALTER TABLE `loaisanpham`
  MODIFY `maLSP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT cho bảng `mon`
--
ALTER TABLE `mon`
  MODIFY `mamon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `tendangnhap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT cho bảng `nhommon`
--
ALTER TABLE `nhommon`
  MODIFY `maNM` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT cho bảng `order`
--
ALTER TABLE `order`
  MODIFY `maorder` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `maSP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `ve`
--
ALTER TABLE `ve`
  MODIFY `mave` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitietorder`
--
ALTER TABLE `chitietorder`
  ADD CONSTRAINT `chitietorder_ibfk_1` FOREIGN KEY (`mamon`) REFERENCES `mon` (`mamon`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `chitietorder_ibfk_2` FOREIGN KEY (`maorder`) REFERENCES `order` (`maorder`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `mon`
--
ALTER TABLE `mon`
  ADD CONSTRAINT `mon_ibfk_1` FOREIGN KEY (`maNM`) REFERENCES `nhommon` (`maNM`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `mon_ibfk_2` FOREIGN KEY (`maDVT`) REFERENCES `donvitinh` (`maDVT`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD CONSTRAINT `nhanvien_ibfk_1` FOREIGN KEY (`maCV`) REFERENCES `chucvu` (`maCV`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`maban`) REFERENCES `ban` (`maban`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `order_ibfk_3` FOREIGN KEY (`mave`) REFERENCES `ve` (`mave`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`maLSP`) REFERENCES `loaisanpham` (`maLSP`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `sanpham_ibfk_2` FOREIGN KEY (`maDVT`) REFERENCES `donvitinh` (`maDVT`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `ve`
--
ALTER TABLE `ve`
  ADD CONSTRAINT `ve_ibfk_1` FOREIGN KEY (`maDVT`) REFERENCES `donvitinh` (`maDVT`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
