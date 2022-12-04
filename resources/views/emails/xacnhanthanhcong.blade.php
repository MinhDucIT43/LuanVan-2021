<div id="emails">
    @foreach($banDat as $bd)
        <h3>Xin chào {{$bd->hoTen}}!</h3>
    @endforeach
    <p>Thông tin của bạn đã được xác nhận. Nhà hàng Duck BBQ xin chân thành cảm ơn!</p>
</div>