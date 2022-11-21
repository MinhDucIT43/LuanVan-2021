@extends("master")

@section('page_title')
Admin
@endsection

@section('main')
<div class="card mb-4">
    <div class="row" style="width:100%;">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">Primary Card</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">Warning Card</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                Số hoá đơn: {{date('d/m/Y')}} <h3 style="text-align:center;"><?php echo $sothanhtoan ?></h3>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">Xem chi tiết</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                Bàn đang phục vụ: <h3 style="text-align:center;"><?php echo $bandangphucvu ?></h3>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">Xem chi tiết</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div id="thongkengay" class="card-header">
        <i class="fas fa-chart-area me-1"></i>
        <b>DOANH THU THEO NGÀY TRONG THÁNG {{$thang}}</b>
        <div id="chart_div_ngay"></div>
    </div>
    <div id="thongkethang" class="card-header">
        <i class="fas fa-chart-area me-1"></i>
        <b>DOANH THU THEO THÁNG {{$thang}}</b>
        <div id="chart_div_thang"></div>
    </div>
</div>
@endsection