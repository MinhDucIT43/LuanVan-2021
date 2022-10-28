function kiemtrasoluong(soluong){
    var errorsoluong=document.getElementById('errorsoluong');
    if(soluong.value == 0){
        errorsoluong.innerHTML = "Vui lòng nhập số lượng!"
        errorsoluong.style.color = "red";
        return false; 
    }else{
        errorsoluong.innerHTML = "";
        errorsoluong.style.color = "";
    }
}