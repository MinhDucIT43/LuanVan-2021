function kiemtrathemsanpham(){
    var check = true;
    var letter=/[0-9]/g;
    var gianhap=document.getElementById('gianhap');
    var soluong=document.getElementById('slnhap');
    var errorgianhap=document.getElementById('errorgianhap');
    var errorsoluong=document.getElementById('errorsoluong');

    if (!gianhap.value.match(letter)){
        errorgianhap.innerHTML="Giá nhập: Chỉ nhập số";
        errorgianhap.style.color = "red";
        check = false; 
    }else if(gianhap.value < 0){
        errorgianhap.innerHTML="Giá nhập không âm";
        errorgianhap.style.color = "red";
        check = false; 
    }else{
        errorgianhap.innerHTML = "";
    }
    if (!soluong.value.match(letter)){
        errorsoluong.innerHTML="Số lượng: Chỉ nhập số";
        errorsoluong.style.color = "red";
        check = false; 
    }else if(soluong.value < 0){
        errorsoluong.innerHTML="Số lượng không âm";
        errorsoluong.style.color = "red";
        check = false; 
    }else{
        errorsoluong.innerHTML = "";
    }
    return check;
}