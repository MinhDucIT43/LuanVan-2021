@extends("./khachhang")

@section('page_title')
Khách hàng
@endsection

@section('convert_color_trangchu')
active
@endsection

@section('main')
<div id="trangchu">
    <div id="slides0" class="mySlides an">
        <img src="{{asset('hinhanh/trangchu0.jpg')}}" height="600" width="1349" alt="" />
    </div>
    <div id="slides1" class="mySlides an">
        <img src="{{asset('hinhanh/trangchu1.jpg')}}" height="600" width="1349" alt="" />
    </div>
    <div id="slides2" class="mySlides an">
        <img src="{{asset('hinhanh/trangchu2.jpg')}}" height="600" width="1349" alt="" />
    </div>
    <div id="slides3" class="mySlides an">
        <img src="{{asset('hinhanh/trangchu3.jpg')}}" height="600" width="1349" alt="" />
    </div>
    <!-- <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
	<a class="next" onclick="plusSlides(1)">&#10095;</a> -->
    <div style="text-align:center">
		<span class="cham" onclick="currentSlide(1)"></span>
        <span class="cham" onclick="currentSlide(2)"></span> 
		<span class="cham" onclick="currentSlide(3)"></span> 
		<span class="cham" onclick="currentSlide(4)"></span>
	</div>
    <div id="concept">
        <div id="concept-noidung">
            <h1 class="text">Concept</h1>
            <p>
                Được mệnh danh là “Vua nướng”. Bí quyết của <strong>King BBQ</strong> nằm ở nước sốt tẩm ướp 
                thịt được chế biến từ nguyên liệu hoàn toàn tự nhiên, theo công thức bí truyền, hội tụ tinh hoa từ những miền ẩm thực nổi tiếng Hàn Quốc.
            </p>
            <img class="rounded" src="{{asset('hinhanh/nuocsot.jpg')}}" height="230" width="400" alt="">
        </div>
        <div id="concept-hinhanh">
            <img class="rounded-pill" src="{{asset('hinhanh/trangchu4.jpg')}}" height="400" width="800" alt="">
        </div>
    </div>
    <div id="menu1">
        <img class="img-thumbnail" id="menu-hinhanh" src="{{asset('hinhanh/trangchu5.jpg')}}" height="500" width="1349" alt="">
    </div>
    <div id="menu2">
        <div id="menu2_hinhanh">
            <div id="menu2_hinhanh1">
                <img class="rounded" src="{{asset('hinhanh/trangchu6.jpg')}}" height="200" width="300" alt="">
                <img class="rounded" src="{{asset('hinhanh/trangchu7.jpg')}}" height="200" width="300" alt="">
            </div>
            <div id="menu2_hinhanh2">
                <img class="rounded" src="{{asset('hinhanh/trangchu8.jpg')}}" height="200" width="300" alt="">
                <img class="rounded" src="{{asset('hinhanh/trangchu9.jpg')}}" height="200" width="300" alt="">
            </div>
        </div>
        <div id="menu2_contents">
            <a href="{{route('khachhang.thucdon')}}"><h1 class="text">Menu</h1></a>
            <p>
                Menu KingBBQ đem đến cho khách hàng hơn 200 món ăn, được chắt lọc từ Tinh hoa ẩm thực Hàn Quốc. 
                Tất cả được chính đầu bếp Hàn Quốc chế biến, khéo léo kết hợp trong nhiều combo và set ăn hấp dẫn của King BBQ Alacart và vô vàn món ngon không giới hạn từ King BBQ Buffet
            </p>
        </div>
    </div>
    <div class="footer">
        <div id="info">
            <h1>Duck BBQ</h1>
            <h3>Khu II - Trường Đại học Cần Thơ</h3>
            <h5>Nguyễn Minh Đức -- 0945579649</h5>
        </div>
    </div>
</div>
@endsection