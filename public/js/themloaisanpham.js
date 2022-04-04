function kiemtratenlsp(){
    var errortenlsp=document.getElementById('errortenlsp');

    if(errortenlsp.innerHTML==="Loại sản phẩm đã tồn tại"){
        errortenlsp.style.color = "red";
        return false; 
    }else{
        errortenlsp.innerHTML = "";
        errortenlsp.style.color = "";
    }
}

$(document).ready(function(){
    $("#tenloaisanpham").change(function(){
        var tenloaisanpham = $(this).val();
        var errortenlsp=document.getElementById('errortenlsp');
        $.get("kiemtratenlsp/"+tenloaisanpham,function(data){
            if(data==="Loại sản phẩm đã tồn tại"){
                errortenlsp.innerHTML = "Loại sản phẩm đã tồn tại";
                errortenlsp.style.color = "red";
            }else{
                errortenlsp.innerHTML = "";
            }
        });
    });
});