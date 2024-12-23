function crearRegional(){
	$('#modal-title-md').html("Crear Regional");
	$.ajax({

		url:'../regionales/formulario.php',
		type:'POST',
		data: {resp:1},
		success: function(resp){
			$('#modal-body-md').html(resp);
		}		
	});

	$.ajax({
		url:'../regionales/boton.php',
		type:'POST',
		data: {resp:1},
		success: function(resp){
			$('#btn-md').html(resp);
		}
	});
}

function agregarRegional(){

	var formulario = new FormData($("#form-regional")[0]);
	 $.ajax({
      url:'../regionales/regional.controller.php',
      data:formulario,
      type:'POST',
	  contentType: false,
	  processData: false,
      success: function(resp){
      		$('#modal-medium').modal('hide');
      		$('#modal-title-sm').html('Crear Regional');
      		$('#modal-body-sm').html(resp);
		    $('#modal-small').modal('show');
			$('#btn-footer-sm').html('<button type="button" class="btn btn-secondary" onclick="refreshTableReg()" data-bs-dismiss="modal">Cerrar</button>');   
      }
	});
}

function actualizarRegional(id){
	$('#modal-title-md').html("Actualizar Regional");
	$.ajax({
		url:'../regionales/formulario.php',
		type:'POST',
		data: {resp:2,id_reg:id},
		success: function(resp){
			$('#modal-body-md').html(resp);
		}
	});
	$.ajax({
		url:'../regionales/boton.php',
		type:'POST',
		data: {resp:2},
		success: function(resp){
			$('#btn-md').html(resp);
		}
	});
}


function refreshTableReg (){
    $.ajax({
    url:'../regionales/table.php',
    type:'POST',
    data: {resp:1},
    success: function(resp){
      $('#content-table').html(resp);
    }
  });

}

function modificarRegional(){

	var formulario = new FormData($("#form-regional")[0]);
	 $.ajax({
      url:'../regionales/regional.controller.php',
      data:formulario,
      type:'POST',
	  contentType: false,
	  processData: false,
      success: function(resp){
      		$('#modal-body-sm').html(resp);
          $('#modal-title-sm').html('Aviso');
		  $('#modal-small').modal('show');
		  $('#btn-footer-sm').html('<button type="button" class="btn btn-secondary" onclick="refreshTableReg()" data-bs-dismiss="modal">Cerrar</button>');
      }
	});
}

function confirmation(id){
  	$('#modal-title-md').html('Confirmación');
    $('#modal-body-md').html('¿Está seguro de eliminar esta Regional?');
    $('#modal-medium').modal('show');
    $.ajax({
        url:'../regionales/boton.php',
        type:'POST',
        data: {resp:3,id_reg:id},
        success: function(resp){
        $('#btn-md').html(resp);
        $('#btnEliminar').attr('value',id);
        }   
      });

}

function eliminarRegional(id){
    $.ajax({
      url: '../regionales/regional.controller.php',
      data:{action:'delete',id_reg:id},
      type:'POST',
      success: function(resp){
        $('#modal-body-sm').html(resp);
        $('#modal-title-sm').html('Aviso');
		$('#modal-small').modal('show');
		$('#btn-footer-sm').html('<button type="button" class="btn btn-secondary" onclick="refreshTableReg()" data-bs-dismiss="modal">Cerrar</button>');
      }
    });
  }
