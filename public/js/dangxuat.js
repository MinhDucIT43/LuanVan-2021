$('.dangXuat').on('click',function(e){
    e.preventDefault();
    var self = $(this);
    // console.log(self.data('title'));
    Swal.fire({
        title: 'ĐĂNG XUẤT',
        text: "Bạn chắc chắn muốn thoát khỏi hệ thống?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Đăng xuất',
        cancelButtonText: 'Huỷ',
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
            'Đã đăng xuất!',
            'Đăng xuất thành công.',
            'success'
            )
            location.href = self.attr('href');
        }
    })
})