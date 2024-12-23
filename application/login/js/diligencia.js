function newDiligencia(id_cli) {
    $('#modal-title-lg').html("Crear Diligencia");
    $.ajax({

        url: '../diligencia/form.php',
        type: 'POST',
        data: { resp: 1, id_cli: id_cli },
        success: function (resp) {
            $('#modal-body-lg').html(resp);
        }
    });

    $.ajax({
        url: '../diligencia/boton.php',
        type: 'POST',
        data: { resp: 1, id_cli: id_cli },
        success: function (resp) {
            $('#modal-footer-lg').html(resp);
        }
    });
}


function autoDil() {
    $("#nom_client").autocomplete({
        source: '../autocomplete/diligencias/buscador.php',
        minLength: 3,
        select: function (event, ui) {
            $("#id_client").val(ui.item.id_cli);
            $("#con_client").val(ui.item.con_cli);
            $("#tel_client").val(ui.item.tel_cli);
            $("#dir_client").val(ui.item.dir_cli);
            $("#hor_client").val(ui.item.hor_cli);
            $("#btnAgregar").removeAttr("disabled");
            $("#btnUpdCli").removeAttr("disabled");
        }
    });
}


function agregarDil(param, id_cli) {
    if (validarCampos('form-dilg2') == 0) {
        var formulario = new FormData($("#form-dilg2")[0]);
        $.ajax({
            url: '../diligencia/diligencia.controller.php',
            data: formulario,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (resp) {
                $('#largeModal').modal('hide');
                $('#modal-title-sm').html('Crear Diligencia');
                $('#modal-body-sm').html(resp);
                $('#smallModal').modal('show');
                if (param == 1) {
                    $('#btn-footer-sm').attr('onclick', 'refreshTableDil(1, 0)');
                } else if (param == 2) {
                    $('#btn-footer-sm').attr('onclick', 'refreshTableDil(2, ' + id_cli + ')');
                }
            }
        });

    }
}


function actualizarDilg(id) {
    $('#modal-title-lg').html("Actualizar Diligencia");
    $.ajax({
        url: '../diligencia/form.php',
        type: 'POST',
        data: { resp: 2, num_dlg: id },
        success: function (resp) {
            $('#modal-body-lg').html(resp);
            $("#btnUpdCli").removeAttr("disabled");
        }
    });
    $.ajax({
        url: '../diligencia/boton.php',
        type: 'POST',
        data: { resp: 2 },
        success: function (resp) {
            $('#modal-footer-lg').html(resp);
        }
    });
}


function modificarDilig() {
    if (validarCampos('form-dilg2') == 0) {
        var formulario = new FormData($("#form-dilg2")[0]);
        $.ajax({
            url: '../diligencia/diligencia.controller.php',
            data: formulario,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (resp) {
                $('#largeModal').modal('hide');
                $('#modal-body-sm').html(resp);
                $('#modal-title-sm').html('Actualizar Diligencia');
                $('#smallModal').modal('show');
                $('#btn-footer-sm').html('<button type="button" class="btn btn-default" onclick="refreshTableDil()" data-bs-dismiss="modal">Cerrar</button>');
            }
        });
    }
}

function eliminarDil(id) {
    var r = confirm('¿Está seguro de eliminar esta diligencia?');
    if (r == true) {
        var action = "delete";
        $.ajax({
            url: '../diligencia/diligencia.controller.php',
            type: 'POST',
            data: { id: id, action: action },
            success: function (resp) {
                $('#modal-title-sm').html('Eliminar Diligencia');
                $('#modal-body-sm').html(resp);
                $('#smallModal').modal('show');
                $('#btn-footer-sm').html('<button type="button" class="btn btn-default" onclick="refreshTableDil()" data-bs-dismiss="modal">Cerrar</button>');
            }
        });
    }
}


function mostrarDil(id) {
    $('#modal-title-md').html('Información Diligencia <b>#' + id + "</b>");
    $.ajax({
        url: '../diligencia/informacion.php',
        data: { num_dlg: id },
        type: 'POST',
        success: function (resp) {
            $('#modal-body-md').html(resp);
        }
    });
}

//Creacion de cliente durante el proceso de diligencia
function crearClientdil(action) {
    $('#modal-title-lg-2').html("Crear Cliente");
    $.ajax({
        url: '../clientes2/form.php',
        type: 'POST',
        data: { resp: 1, action: action },
        success: function (resp) {
            $('#modal-title-lg').html("Cliente nuevo");
            $('#modal-body-lg').html(resp);
        }
    });
    $.ajax({
        url: '../diligencia/boton.php',
        type: 'POST',
        data: { resp: 5 },
        success: function (resp) {
            $('#modal-footer-lg').html(resp);
        }
    });
}


//Actualización de cliente durate la creación de la diligencia
function actualizarClientdil(action) {
    var id_client = $('#id_client').val();
    var con_client = $('#con_client').val();
    var tel_client = $('#tel_client').val();
    var hor_client = $('#hor_client').val();
    var dir_client = $('#dir_client').val();
    $.ajax({
        url: '../diligencia/diligencia.controller.php',
        type: 'POST',
        data: { id_client, con_client, tel_client, hor_client, dir_client, action },
        success: function (resp) {
            $('#resClient').html(resp);
            refreshTableDil();
        }
    });
}



function option1(opt) {
    $('#dil_descri').html(opt);
}

function refreshTableDil(param, id_cli) {
    var reg = $('#reg').val();
    console.log(reg);
    if (param == 1) {
        $.ajax({
            url: '../diligencia/tabla.php',
            type: 'POST',
            data: { resp: 1, reg },
            success: function (resp) {
                $('#content-table').html(resp);
            }
        });
    } else if (param == 2) {
        $.ajax({
            url: '../clientes2/perfil.php',
            type: 'GET',
            data: { id: id_cli },
            success: function (resp) {
                $('#content-table').html(resp);
            }
        });
    }
}

function estado() {
    var est_dlg = $('#estado').val();
    var reg = $('#reg').val();
    $.ajax({
        url: 'tabla.php',
        data: { est_dlg, reg },
        type: 'POST',
        success: function (resp) {
            $('#content-table').html(resp);
        }
    });
}

function espera(dia_dlg) {
    var est_dlg = $('#estado').val();
    var reg = $('#reg').val();
    console.log(dia_dlg);
    $.ajax({
        url: 'tabla.php',
        data: { est_dlg, dia_dlg, reg },
        type: 'POST',
        success: function (resp) {
            $('#content-table').html(resp);
        }
    });
}

function tipDilg(value) {
    if (value == 5) {
        $('#alertDilPer').removeAttr("style");
    } else {
        $('#alertDilPer').attr("style", "display: none");
    }
}

function exportExcel(param) {
    $.ajax({
        url: '../diligencia/reportes/excelDiligencias.php',
        data: { param },
        type: 'POST',
        success: function (resp) {
            
        }
    });
}