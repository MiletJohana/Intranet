function newCotizacionAca(resp, id_usu) {
    if (resp == 1) {
        var title = 'Crear Cotización ACÁ';
    } else if (resp == 2) {
        var title = 'Crear Cliente';
    } else if (resp == 3) {
        var title = 'Crear Contacto';
    } else if (resp == 4) {
        var title = 'Crear Producto';
    } else {
        var title = 'Actualizar Datos';
    }
    $('#modal-title-lg').html(title);
    $.ajax({
        url: '../cotizadorAca/tabsForm.php',
        type: 'POST',
        data: { resp, id_usu },
        success: function(respHtml) {
            $('#modal-body-lg').html(respHtml);
            var i = null;
            for (i = 1; i <= 5; i++) {
                if (i == resp) {
                    $('#error' + i).html('<div class="col-md-4" id="error-validation"></div>');
                } else {
                    $('#error' + i).html('');
                }
            }
        }
    });

    $.ajax({
        url: '../cotizadorAca/boton.php',
        type: 'POST',
        data: { resp, id_usu },
        success: function(respHtml) {
            $('#modal-footer-lg').html(respHtml);
            for (var i = 1; i <= 10; i++) {
                $('#cerrar' + i).attr('onclick', 'refreshTable(' + resp + ')');
            }
        }
    });
}


function newAgregarAca(resp, id_usu, cerrar) {
    if (resp == 1) {
        var title = 'Crear Cotización';
    } else if (resp == 2) {
        var title = 'Crear Cliente';
    } else if (resp == 3) {
        var title = 'Crear Contacto';
    } else if (resp == 4) {
        var title = 'Crear Producto';
    } else if (resp == 5) {
        var title = 'Actualizar Datos';
    } else if (resp == 6) {
        var title = 'Actualizar Cotización';
    } else if (resp == 7) {
        var title = 'Actualizar Cliente';
    } else if (resp == 8) {
        var title = 'Actualizar Contacto';
    } else if (resp == 9) {
        var title = 'Actualizar Producto';
    }
    $('#modal-title-lg').html(title);
    $.ajax({
        url: '../cotizadorAca/boton.php',
        type: 'POST',
        data: { resp, id_usu, cerrar },
        success: function(respHtml) {
            $('#modal-footer-lg').html(respHtml);
            var i = null;
            for (i = 1; i <= 5; i++) {
                if (i == resp) {
                    $('#error' + i).html('<div class="col-md-4" id="error-validation"></div>');
                } else {
                    $('#error' + i).html('');
                }
            }
        }
    });
}

function APPEAR(value) {
    if (value == 1) {

    } else if (value == 2) {
        $.ajax({
            url: '../cotizadorAca/cubiertas.php',
            type: 'POST',
            data: { resp: 1, value: value },
            success: function(resp) {
                $('#tipC').html(resp);
            }
        });
    } else if (value == 3) {
        $.ajax({
            url: '../cotizadorAca/antideslizantes.php',
            type: 'POST',
            data: { resp: 1, value: value },
            success: function(resp) {
                $('#tipC').html(resp);


            }
        });
    } else if (value == 4) {
        $.ajax({
            url: '../cotizadorAca/epoxico.php',
            type: 'POST',
            data: { resp: 1, value: value },
            success: function(resp) {
                $('#tipC').html(resp);

            }
        });
    }
}

function agregarTabl(resp) {
    if (resp == 1) {
        $('#tablaC').removeAttr('style');
        var table = document.getElementById("tablaC");
        var newRow = table.insertRow(table.length),
            cell1 = newRow.insertCell(0),
            cell2 = newRow.insertCell(1),
            cell3 = newRow.insertCell(2),
            cell4 = newRow.insertCell(3);
        cell1.innerHTML = '<input type="text" class="form-control" " name="ubicacion[]" value="">';
        cell2.innerHTML = '<input type="number" class="form-control"  name="cot_medidas[]" value="" >';
        cell3.innerHTML = '<input type="number" class="form-control"  name="cot_cant[]" value="" >';
        cell4.innerHTML = '<button id="" type="button" class="btn btn-danger" onclick="();">X</button>';
        newRow.setAttribute("id", +resp);
    } else if (resp == 2) {
        $('#tablaCub').removeAttr('style');
        var table = document.getElementById("tablaCub");
        var newRow = table.insertRow(table.length),
            cell1 = newRow.insertCell(0),
            cell2 = newRow.insertCell(1),
            cell3 = newRow.insertCell(2),
            cell4 = newRow.insertCell(3);
        cell1.innerHTML = '<input type="text" class="form-control" " name="descrip[]" value="">';
        cell2.innerHTML = '<input type="number" class="form-control"  name="cubMed[]" value="" >';
        cell3.innerHTML = '<input type="number" class="form-control"  name="valor[]" value="" >';
        cell4.innerHTML = '<button id="" type="button" class="btn btn-danger" onclick="();">X</button>';
    } else if (resp == 3) {
        $('#tablaEpox').removeAttr('style');
        var table = document.getElementById("tablaEpox");
        var newRow = table.insertRow(table.length),
            cell1 = newRow.insertCell(0),
            cell2 = newRow.insertCell(1),
            cell3 = newRow.insertCell(2),
            cell4 = newRow.insertCell(3);
        cell1.innerHTML = '<input type="text" class="form-control" " name="ubicac_ep[]" value="">';
        cell2.innerHTML = '<input type="number" class="form-control"  name="epoMed[]" value="" >';
        cell3.innerHTML = '<input type="number" class="form-control"  name="valor_ep[]" value="" >';
        cell4.innerHTML = '<button id="" type="button" class="btn btn-danger" onclick="();">X</button>';
    }
}