$(document).ready(function(){
 	actualizar()
})

function actualizar(){
	var rol  = document.getElementById("usu_r").innerHTML;
	var id   = $('#id_cli').val()
	var con  = $('#con_cli').val()
	var tel  = $('#tel_cli' ).val()
	var hor  = $('#hor_cli' ).val()
	var dir  = $('#dir_cli' ).val()
	var data= 'id_cli='+id+'&con_cli='+con+'&tel_cli='+tel+'&hor_cli='+hor+'&dir_cli='+dir+'&usu_r='+rol;

		$.ajax({
			url:'actcli.php',
			type:'POST',
			data: data,
			success: function(resp){
				$('#message').html(resp);
			}
		})
}
