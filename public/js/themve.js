function kiemtrave(gia){
    var letter=/[0-9]/g;
    var errorgia=document.getElementById('errorgia');
    var errortenve=document.getElementById('errortenve');

    if (!gia.value.match(letter)){
        errorgia.innerHTML="Gia vé: Chỉ nhập số";
        errorgia.style.color = "red";
        return false; 
    }else if(gia.value < 0){
        errorgia.innerHTML="Giá vé không được âm";
        errorgia.style.color = "red";
        return false; 
    }else{
        errorgia.innerHTML = "";
        errorgia.style.color = "";
    }
    if(errortenve.innerHTML==="Vé đã tồn tại"){
        errortenve.style.color = "red";
        return false; 
    }else{
        errortenve.innerHTML = "";
        errortenve.style.color = "";
    }
}

$(document).ready(function(){
    $("#tenve").change(function(){
        var tenve = $(this).val();
        var errortenve=document.getElementById('errortenve');
        $.get("kiemtratenve/"+tenve,function(data){
            if(data==="Vé đã tồn tại"){
                errortenve.innerHTML = "Vé đã tồn tại";
                errortenve.style.color = "red";
            }else{
                errortenve.innerHTML = "";
                errortenve.style.color = "";
            }
        });
    });
});