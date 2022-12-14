@extends("master")

@section('page_title')
    Admin - Thống kê
@endsection

@section('convert_color_menu_tk')
    background-color: blue;
@endsection

@section('convert_color_menu_tkt')
    active
@endsection

@section('main')
	<div style="padding-top: 20px; text-align:center; font-size: 30px" class="card-header">
		<i class="fas fa-chart-area me-1"></i>
        <b>DOANH THU THEO NGÀY TRONG THÁNG {{$thang}}</b>
		<div style="padding-top: 30px;" id="chart_div_thang"></div>
	</div>
@endsection