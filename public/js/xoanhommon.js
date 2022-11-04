$('.deleteNhomMon').on('click',function(e){
    e.preventDefault();
    var self = $(this);
    // console.log(self.data('title'));
    Swal.fire({
        title: 'Xoá nhóm món!',
        text: "Bạn chắc chắn muốn xoá nhóm món ăn này?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Xoá',
        cancelButtonText: 'Huỷ',
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
            'Đã xoá nhóm món ăn!',
            'Nhóm món ăn bạn muốn xoá đã bị xoá.',
            'success'
            )
            location.href = self.attr('href');
        }
    })
})