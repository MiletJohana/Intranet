let flag=true;
function mostrar(){
   if(flag){
        document.getElementById("contrasena").type = "password";
        document.getElementById("oculto").src ='resources/img/showme.png';
        flag=false;
    }else {
        document.getElementById("contrasena").type= "text";
        document.getElementById("oculto").src = 'resources/img/showme1.png';
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
                //snackbar('Datos erroneos, intenta nuevamente', "toast", 3000, true);
                alert("Datos erroneos, intenta nuevamente");
              
                    
            }
        }
    });
}

function snackbar(content, style, timeout, htmlAllowed) {
    
   /* var options = {
        content: content,
        style: style,
        timeout: timeout,
        htmlAllowed: htmlAllowed
    }
    $.snackbar(options);*/
}