function kiemtrathemmon(){
    var check = true;
    var letter=/[0-9]/g;
    var gia=document.getElementById('gia');
    var soluong=document.getElementById('soluong');
    var errorgia=document.getElementById('errorgia');
    var errorsoluong=document.getElementById('errorsoluong');

    if (!gia.value.match(letter)){
        errorgia.innerHTML="Giá: Chỉ nhập số";
        errorgia.style.color = "red";
        check=false; 
    }else if(gia.value < 0){
        errorgia.innerHTML="Giá không được âm";
        errorgia.style.color = "red";
        check=false; 
    }else{
        errorgia.innerHTML = "";
    }
    if (!soluong.value.match(letter)){
        errorsoluong.innerHTML="Số lượng: Chỉ nhập số";
        errorsoluong.style.color = "red";
        check=false; 
    }else if(soluong.value < 0){
        errorsoluong.innerHTML="Số lượng không được âm";
        errorsoluong.style.color = "red";
        check=false; 
    }else{
        errorsoluong.innerHTML = "";
    }
    return check;
}