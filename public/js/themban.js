function kiemtrasoban(){
    var errorsoban=document.getElementById('errorsoban');
    if(errorsoban.innerHTML==="Số bàn này đã tồn tại"){
        errorsoban.style.color = "red";
        return false; 
    }else{
        errorsoban.innerHTML = "";
        errorsoban.style.color = "";
    }
}

$(document).ready(function(){
    $("#banso").change(function(){
        var banso = $(this).val();
        var errorsoban=document.getElementById('errorsoban');
        $.get("kiemtrasoban/"+banso,function(data){
            if(data==="Số bàn này đã tồn tại"){
                errorsoban.innerHTML = "Số bàn này đã tồn tại";
                errorsoban.style.color = "red";
            }else{
                errorsoban.innerHTML = "";
                errorsoban.style.color = "";
            }
        });
    });
});