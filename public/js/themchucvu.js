function kiemtratienluong(tienluong){
    var letter=/[0-9]/g;
    var errortienluong=document.getElementById('errortienluong');
    var errortenchucvu=document.getElementById('errortenchucvu');

    if (!tienluong.value.match(letter)){
        errortienluong.innerHTML="Tiền lương: Chỉ nhập số";
        errortienluong.style.color = "red";
        return false; 
    }else if(tienluong.value < 0){
        errortienluong.innerHTML="Tiền lương không được âm";
        errortienluong.style.color = "red";
        return false; 
    }else{
        errortienluong.innerHTML = "";
        errortienluong.style.color = "";
    }
    if(errortenchucvu.innerHTML==="Chức vụ đã tồn tại"){
        errortenchucvu.style.color = "red";
        return false; 
    }else{
        errortenchucvu.innerHTML = "";
        errortenchucvu.style.color = "";
    }
}

$(document).ready(function(){
    $("#tenchucvu").change(function(){
        var tenchucvu = $(this).val();
        var errortenchucvu=document.getElementById('errortenchucvu');
        $.get("kiemtratenchucvu/"+tenchucvu,function(data){
            if(data==="Chức vụ đã tồn tại"){
                errortenchucvu.innerHTML = "Chức vụ đã tồn tại";
                errortenchucvu.style.color = "red";
            }else{
                errortenchucvu.innerHTML = "";
                errortenchucvu.style.color = "";
            }
        });
    });
});