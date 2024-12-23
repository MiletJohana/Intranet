  function actper(id){
    var data = {
          id_per:id,
          nom_per : $('#nom_per').val(),
          ape_per : $('#ape_per').val(),
          eps_per : $('#eps_per').val(),
          arl_per : $('#arl_per').val(),
          emp_per : $('#emp_per').val(),
          con_per : $('#con_per').val(),
          tel_con : $('#tel_con').val(),
          tel_per : $('#tel_per').val()
        }
    if($('#id_per').val() && $('#nom_per').val() && $('#ape_per').val() && $('#eps_per').val() && $('#arl_per').val() 
      && $('#emp_per').val() && $('#tel_per').val() && $('#con_per').val() && $('#tel_con').val()){
    $.ajax({
      url:'actper.php',
      data: data,
      type:'POST',
      success: function(resp){
        if (resp!="1"){
          alert("No se pudo actualizar.");
        }else{
          alert("Actualizado exitosamente");
          $.ajax({
          url:'actualizado.php',
          data: {id_per:id},
          type:'POST',
          success: function(respuesta){
            $('#resultado').html(respuesta);
          }
        });
        }
      }
    });
  }else{
    if($("#id_per").val() == ""){
        alert("El campo Cédula no puede estar vacío.");
        $("#id_per1").focus();
        return false;
      }
      if($("#nom_per").val() == ""){
        alert("El campo Nombre no puede estar vacío.");
        $("#nom_per1").focus();
        return false;
      }
      if($("#ape_per").val() == ""){
        alert("El campo Apellido no puede estar vacío.");
        $("#ape_per1").focus();
        return false;
      }
      if($("#eps_per").val() == ""){
        alert("El campo EPS no puede estar vacío.");
        $("#eps_per1").focus();
        return false;
      }
      ///
      if($("#arl_per").val() == ""){
        alert("El campo ARL no puede estar vacío.");
        $("#arl_per1").focus();
        return false;
      }
      if($("#tel_per").val() == ""){
        alert("El campo Teléfono no puede estar vacío.");
        $("#tel_per1").focus();
        return false;
      }
      if($("#con_per").val() == ""){
        alert("El campo Contacto emergencia no puede estar vacío.");
        $("#con_per1").focus();
        return false;
      }
      if($("#tel_con").val() == ""){
        alert("El campo Teléfono del contacto no puede estar vacío.");
        $("#tel_con1").focus();
        return false;
      }
    }

  }
function valida(e){
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8){
        return true;
    }
        
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
    }
  function validaText(e){
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8){
        return true;
    }
        
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[A-Z a-z]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
    }