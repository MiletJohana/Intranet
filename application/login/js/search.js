function searchTable(){

	var buscar=$("#search").val();
	$.ajax({
		url:'table.php',
		type:'POST',
		data: {buscar:buscar},
		success: function(resp){
			$("#content-table").html(resp);
			$("#search-message").html('Mostrando resultados de busqueda para: "'+buscar+'"');
		}
	});

}

function searchTableVis(){

	var buscar=$("#search").val();
	$.ajax({
		url:'tableVisitant.php',
		type:'POST',
		data: {buscar:buscar},
		success: function(resp){
			$("#content-table").html(resp);
			$("#search-message").html('Mostrando resultados de busqueda para: "'+buscar+'"');
		}
	});

}
function searchTableCert(){

	var buscar=$("#search").val();
	$.ajax({
		url:'certificaciones/table.php',
		type:'POST',
		data: {buscar:buscar},
		success: function(resp){
			console.log(resp);
			$("#content-table").html(resp);
			$("#search-message").html('Mostrando resultados de busqueda para: "'+buscar+'"');
		}
	});

}