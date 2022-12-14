$('.thanhToan').on('click',function(e){
    e.preventDefault();
    var self = $(this);
    // console.log(self.data('title'));
    Swal.fire({
        title: 'THANH TOÁN',
        text: "Bạn chắc chắn muốn thanh toán?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Thanh toán',
        cancelButtonText: 'Huỷ',
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
            'Đã thanh toán!',
            'Hoá đơn đã được lưu.',
            'success'
            )
            location.href = self.attr('href');
        }
    })
})