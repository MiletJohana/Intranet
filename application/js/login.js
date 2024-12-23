let flag=true;
function contra(){
    let  oculto=document.getElementById("oculto");
   if(flag){
        document.getElementById("contrasena").type = "text";
        oculto.classList.remove("fa-eye-slash");
        oculto.classList.add("fa-eye");
        flag=false;
    }else{
        document.getElementById("contrasena").type = "password";
        oculto.classList.remove("fa-eye");
        oculto.classList.add("fa-eye-slash");
        flag=true;
    };
}

function formsubmit() {
    var usuario = $('#usuario').val();
    var contrasena = $('#contrasena').val();
    var data = {
        usuario: usuario,
        contrasena: contrasena
    };
    $.ajax({
        url: 'session/login.php',
        type: 'POST',
        data: data,
        success: function(resp) {
            if (resp == "1") {
                location.href = "application/home/";
            } else {
                alertError("Datos erroneos, intente nuevamente");
            }
        }
    });
}


