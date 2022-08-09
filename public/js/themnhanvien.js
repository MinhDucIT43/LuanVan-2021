function Kiemtranhapso(so){
    var letter=/([0-9]{10})\b/g;
    var errorsoDT=document.getElementById('errorsoDT');
    var errornamsinh=document.getElementById('errornamsinh');

    if (!so.value.match(letter)){
        errorsoDT.innerHTML="Số điện thoại: Chỉ nhập số";
        errorsoDT.style.color = "red";
        return false; 
    }//else if(errorsoDT.innerHTML==="Số điện thoại: Số điện thoại đã tồn tại"){
    //     errorsoDT.style.color = "red";
    //     return false; 
    // }else{
    //     errorsoDT.innerHTML = "";
    //     errorsoDT.style.color = "";
    // }
    // if(errornamsinh.innerHTML==="Năm sinh: Chưa đủ 18 tuổi"){
    //     errornamsinh.style.color = "red";
    //     return false; 
    // }else{
    //     errornamsinh.innerHTML = "";
    //     errornamsinh.style.color = "";
    // }
}

$(document).ready(function(){
    $("#soDT").change(function(){
        var sodienthoai = $(this).val();
        var errorsoDT=document.getElementById('errorsoDT');
        $.get("kiemtrasdtduynhat/"+sodienthoai,function(data){
            // console.log(data);
            // alert(data);
            if(data===""){
                errorsoDT.innerHTML = "";
            }else{
                errorsoDT.innerHTML = "Số điện thoại: Số điện thoại đã tồn tại";
                errorsoDT.style.color = "red";
            }
        });
    });
    $("#namsinh").change(function(){
        var namsinh = $(this).val();
        var errornamsinh=document.getElementById('errornamsinh');
        // alert(namsinh);
        $.get("kiemtratuoi/"+namsinh,function(data){
            // console.log(data);
            if(data==="Năm sinh: Chưa đủ 18 tuổi"){
                errornamsinh.innerHTML = "Năm sinh: Chưa đủ 18 tuổi";
                errornamsinh.style.color = "red";
            }else{
                errornamsinh.innerHTML = "";
                errornamsinh.style.color = "";
            }
        });
    });
});