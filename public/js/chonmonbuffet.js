function kiemtrasoluongmon(soluong){
    var errorsoluongmon=document.getElementById('errorsoluongmon');
    if(soluong.value == 0){
        errorsoluongmon.innerHTML = "Vui lòng nhập số lượng món ăn!"
        errorsoluongmon.style.color = "red";
        return false; 
    }else{
        errorsoluongmon.innerHTML = "";
        errorsoluongmon.style.color = "";
    }
}