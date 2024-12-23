function crearArea(){
	$('#modal-title-md').html("Crear Area");
	$.ajax({

		url:'../areas/formulario.php',
		type:'POST',
		data: {resp:1},
		success: function(resp){
			$('#modal-body-md').html(resp);
		}		
	});
	$.ajax({
		url:'../areas/boton.php',
		type:'POST',
		data: {resp:1},
		success: function(resp){
			$('#btn-md').html(resp);
		}
	});
}

function agegarArea(){

  if (validarCampos('form-area')==0) {
    var formulario = new FormData($("#form-area")[0]);
     $.ajax({
        url:'../areas/area.controller.php',
        data:formulario,
        type:'POST',
      contentType: false,
      processData: false,
        success: function(resp){
            $('#modal-medium').modal('hide');
            $('#modal-title-sm').html('Crear Area');
            $('#modal-body-sm').html(resp);
            $('#modal-small').modal('show');
            $('#btn-footer-sm').html('<button type="button" class="btn btn-secondary" onclick="refreshTableArea()" data-bs-dismiss="modal">Cerrar</button>');
        }
    }); 
  }
}

function actualizarArea(id){
	$('#modal-title-md').html("Actualizar Area");
	$.ajax({
		url:'../areas/formulario.php',
		type:'POST',
		data: {resp:2,id_are:id},
		success: function(resp){
			$('#modal-body-md').html(resp);
		}
	});
	$.ajax({
		url:'../areas/boton.php',
		type:'POST',
		data: {resp:2},
		success: function(resp){
			$('#btn-md').html(resp);
		}
	});
}



function modificarArea(){

	var formulario = new FormData($("#form-area")[0]);
	 $.ajax({
      url:'../areas/area.controller.php',
      data:formulario,
      type:'POST',
	  contentType: false,
	  processData: false,
      success: function(resp){
      		$('#modal-body-sm').html(resp);
          $('#modal-title-sm').html('Aviso');
          $('#modal-small').modal('show');
          $('#btn-footer-sm').html('<button type="button" class="btn btn-secondary" onclick="refreshTableArea()" data-bs-dismiss="modal">Cerrar</button>');
      }
	});
}

function eliminarArea(id){
    $('#modal-title-md').html('Confirmación');
    $('#modal-body-md').html('¿Está seguro de eliminar esta área?');
    $.ajax({
        url:'../areas/boton.php',
        type:'POST',
        data: {resp:3},
        success: function(resp){
        $('#btn-md').html(resp);
        $('#btnEliminar').attr('value',id);
        }   
      });
}

function confirmEliminar() {
    $('#modal-medium').modal('hide');
    var id = $('#btnEliminar').val();
    $.ajax({
      url: '../areas/area.controller.php',
      data:{action:'delete',id_are:id},
      type:'POST',
      success: function(resp){
        $('#modal-body-sm').html(resp);
        $('#modal-title-sm').html('Eliminar Area');
        $('#modal-small').modal('show');
        $('#btn-footer-sm').html('<button type="button" class="btn btn-secondary" onclick="refreshTableArea()" data-bs-dismiss="modal">Cerrar</button>');  
        $.ajax({
            url:'../areas/boton.php',
            type:'POST',
            data: {resp:4},
            success: function(resp){
            $('#btn-footer-sm').html(resp);
            }   
        });
      }
    });
}

function refreshTableArea(){
    $.ajax({
    url:'../areas/table.php',
    type:'POST',
    data: {resp:1},
    success: function(resp){
      $('#content-table').html(resp);
    }
  });

}

function verificar(){
   
    $('#Info').html('<img src="../css/loader.gif" alt="" />').fadeOut(1000);

    var nom_are = $('#nom_are').val();   
    var dataString = 'nom_are='+nom_are;
    
    $.ajax({
            type: "POST",
            url: "../areas/consulta.php",
            data: dataString,
            success: function(data) {
            if(data=="0"){
              $('#nom_are').css("border", "1px solid red");
              $('#btnAgregar').attr('disabled',"true");
              $('#btnAcatualizar').attr('disabled',"true");
            }else if(data=="1"){
              $('#nom_are').css("border", "1px solid green");
              $('#btnAgregar').removeAttr('disabled');
              $('#btnAcatualizar').removeAttr('disabled');
            }
            }
        });         
}

function mostrarUsuarios(id,nombre){
    $('#modal-title-md').html(nombre);
    $.ajax({
        url:'../areas/usuarios.php',
        type:'POST',
        data: {id_are:id},
        success: function(resp){
          $('#modal-body-md').html(resp);
        }   
      });
}