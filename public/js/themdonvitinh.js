function kiemtratendvt(){
    var errortendvt=document.getElementById('errortendvt');
    if(errortendvt.innerHTML==="Đơn vị đã tồn tại"){
        errortendvt.style.color = "red";
        return false; 
    }else{
        errortendvt.innerHTML = "";
        errortendvt.style.color = "";
    }
}

$(document).ready(function(){
    $("#tendonvitinh").change(function(){
        var tendonvitinh = $(this).val();
        var errortendvt=document.getElementById('errortendvt');
        $.get("kiemtratendvt/"+tendonvitinh,function(data){
            if(data==="Đơn vị đã tồn tại"){
                errortendvt.innerHTML = "Đơn vị đã tồn tại";
                errortendvt.style.color = "red";
            }else{
                errortendvt.innerHTML = "";
                errortendvt.style.color = "";
            }
        });
    });
});