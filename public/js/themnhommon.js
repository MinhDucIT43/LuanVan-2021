function kiemtratennhommon(){
    var errortennm=document.getElementById('errortennm');

    if(errortennm.innerHTML==="Nhóm món này đã tồn tại"){
        errortennm.style.color = "red";
        return false; 
    }else{
        errortennm.innerHTML = "";
        errortennm.style.color = "";
    }
}

$(document).ready(function(){
    $("#tennhommon").change(function(){
        var tennhommon = $(this).val();
        var errortennm=document.getElementById('errortennm');
        $.get("kiemtratennm/"+tennhommon,function(data){
            if(data==="Nhóm món này đã tồn tại"){
                errortennm.innerHTML = "Nhóm món này đã tồn tại";
                errortennm.style.color = "red";
            }else{
                errortennm.innerHTML = "";
            }
        });
    });
});