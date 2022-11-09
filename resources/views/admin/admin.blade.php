@extends("master")

@section('page_title')
Admin
@endsection

@section('main')
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-chart-area me-1"></i>
        DOANH THU THEO NGÀY TRONG THÁNG {{$thang}}
    </div>
    <div class="card-body"><canvas id="myAreaChart" width="100%" height="30"></canvas></div>
    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>
<script type="text/javascript">
    var songay = JSON.parse('{{ json_encode($ngay) }}');
</script>
@endsection