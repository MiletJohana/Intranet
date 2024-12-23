function tipDil(){
	var mes1=document.getElementsByName("dil_mesIn")[0].value;
	var mes2=document.getElementsByName("dil_mesFn")[0].value;
	var usuario=document.getElementsByName("mis_dlg")[0].value;
	$.ajax({
		data: {mes1,mes2,usuario},
		url:'../reportes/grafica.php',
		type:'POST',
		success: function(resp){
			$("#grafica").html(resp);
		}
	});
	$.ajax({
		data: {mes1,mes2,usuario},
		url:'../reportes/consultaTable.php',
		type:'POST',
		success: function(resp){
			$("#table").html(resp);
			console.log('hola');
		}
	});
}
