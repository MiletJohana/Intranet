function newPermiso(resp, title, url) {
    $('#modal-title-lg').html(title);
    if (url != '') {
        $.ajax({
            url: url,
            type: 'POST',
            data: { resp },
            success: function(respHtml) {
                $('#modal-body-lg').html(respHtml);
                console.log(resp)
                if (resp != 12) {
                    $('#agregarPer').attr('disabled', "true");
                }
            }
        });
    }
    $.ajax({
        url: '../permisos/boton.php',
        type: 'POST',
        data: { resp },
        success: function(respHtml) {
            $('#modal-footer-lg').html(respHtml);
        }
    });
}

function crear(param, file, table) {
    Swal.fire({
        title: 'Estas seguro de crear el permiso, Recuerde solo dar un click',
        icon: "question",
        allowOutsideClick: false,
        allowEscapeKey: false,
        allowEnterKey: false,
        showDenyButton: true,
        confirmButtonText: "Si, crear",
        denyButtonText: `No`
    }).then((result) => {
        if (result.isConfirmed) {
            if (validarCampos(param) == 0) {
                var formulario = new FormData($("#" + param)[0]);
                $.ajax({
                    url: '../permisos/permisos.controller.php',
                    data: formulario,
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#largeModal').modal('hide');
                        cargar(1);
                    },
                    success: function(resp) {
                        cargar(2);
                        $('#modal-title-sm').html('Solicitud Creada');
                        $('#modal-body-sm').html(resp);
                        $('#smallModal').modal('show');
                        $('#btn-footer-sm').attr('onclick', 'refreshTablePer("' + file + '","' + table + '")');
                    }
                });
            }
        }
    });

}

function editarPer(resp, title, url, edit, param, file, table) {
    $('#modal-title-lg').html(title);
    $.ajax({
        url: url,
        type: 'POST',
        data: { resp, edit: edit },
        success: function(respHtml) {
            $('#modal-body-lg').html(respHtml);
        }
    });
    $.ajax({
        url: '../permisos/boton.php',
        type: 'POST',
        data: { resp },
        success: function(respHtml) {
            $('#modal-footer-lg').html(respHtml);
            $('#editar').attr('onclick', "modPer('" + param + "','" + file + "','" + table + "')");
        }
    });
}

function modPer(param, file, table) {
    if (validarCampos(param) == 0) {
        var formulario = new FormData($("#" + param)[0]);
        $.ajax({
            url: '../permisos/permisos.controller.php',
            data: formulario,
            type: 'POST',
            contentType: false,
            processData: false,
            beforeSend: function() {
                $('#largeModal').modal('hide');
                cargar(1);
            },
            success: function(resp) {
                cargar(2);
                console.log(resp);
                $('#largeModal').modal('hide');
                $('#modal-title-sm').html('Actualizar');
                $('#modal-body-sm').html(resp);
                $('#smallModal').modal('show');
                $('#btn-footer-sm').attr('onclick', 'refreshTablePer("' + file + '","' + table + '")');
            }
        });
    }
}

function verificar() {
    var val_con = $('#val_con').val();
    $.ajax({
        type: 'POST',
        url: '../permisos/permisos.controller.php',
        data: { action: 'password', val_con: val_con },
        success: function(resp) {
            if (resp == "2") {
                $('#val_con').css("border", "2px solid red");
                $('#agregarPer').attr('disabled', "true");
                $('#btnAcatualizar').attr('disabled', "true");
            } else if (resp == "1") {
                $('#val_con').css("border", "2px solid green");
                $('#agregarPer').removeAttr('disabled');
                $('#btnAcatualizar').removeAttr('disabled');
            }
        }
    });
}

function usuarios(value) {
    $.ajax({
        url: '../permisos/permisos.controller.php',
        type: 'POST',
        data: { action: 'usuario', value: value },
        success: function(resp) {
            $('#us_per').html(resp);
        }
    });
}

function formPerm(id, lid) {
    var mes = $('#mes').val();
    console.log(mes);
    $('#formExp').append('<input type="hidden" name="id" id="id" value="' + id + '"> <input type="hidden" name="lid" id="lid" value="' + lid + '"> <input type="hidden" name="mes" id="mes" value="' + mes + '">');
    $('#formExp').submit();
}

function aceptado(id, file, table) {
    var action = "aceptado";
    $.ajax({
        url: '../permisos/permisos.controller.php',
        type: 'POST',
        data: { id, action, file },
        success: function(resp) {
            if (resp == 1) {
                $("#estPer" + id).attr("disabled", "");
                alertRevisarPerm(1, "Permiso " + id + " revisado correctamente", '');
                mostrarSeg(5, 'Seguimiento', '../permisos/seguimiento.php' ,  id );
                refreshTablePer(file, table);
            } else {
                alertRevisarPerm(2, "¡Ocurrió un error inesperado!", 'https://masterquimica.freshservice.com/support/tickets/new');
                $('#resp').html(resp);
                $('#resp').html('<div class="alert alert-danger alert-dismissible fade show mt-4 d-flex align-items-center" role="alert"><i class="fa-solid fa-triangle-exclamation me-3 fa-xl"></i>' + resp + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
            }
        }
    });
}

function updEst(estado, idsesion, state, file, table) {
    $.ajax({
        url: '../permisos/permisos.controller.php',
        data: { estado, action: 'updateEst', idsesion },
        type: 'POST',
        success: function(resp) {
            if (resp != 1) {
                $('#modal-title-md').html('Actualización Solicitud');
                $('#modal-body-md').html(resp);
                $('#modal-medium').modal('show');
            }
            if (estado == 2){
                alertSuccess('Permiso ' + idsesion + ' actualizado correctamente ', '', 1);
            } else if (estado == 3){
                alertSuccess('Permiso ' + idsesion + ' Aprobado correctamente ', '', 1);
            } else if (estado == 4){ 
                alertSuccess('Permiso ' + idsesion + ' Rechazado correctamente ', '', 1);
            }

            refreshTablePer(file, table);
            actualizarEstadoPermiso(state, estado);
        }
    });
}

function actualizarEstadoPermiso(state, opc) {
    var a = $('#' + state);
    switch (opc) {
        case 1:
            a.attr("class", "btn btn-secondary   btn-dafault");
            break;
        case 2:
            a.attr("class", "btn btn-secondary   btn-info");
            break;
        case 3:
            a.attr("class", "btn btn-secondary   btn-success");
            break;
        case 4:
            a.attr("class", "btn btn-secondary   btn-danger");
            break;

    }
}

function habilitar(param) {
    if (param == 1) {
        $("#div_otro_mot").addClass("none");
        $("#otro_mot").attr("value", "");
        $("#otro_mot").attr("readonly", "");
    } else if (param == 2) {
        $("#div_otro_mot1").addClass("none");
        $("#otro_mot1").attr("value", "");
        $("#otro_mot1").attr("readonly", "");
    }
}

function filtroper(params, table) {
    var param = params.split(',');
    var para = [];
    for (var i = 0; i < param.length; i++) {
        para.push($('#' + param[i]).val());
        // console.log(para[i]);
    }
    $.ajax({
        url: table,
        type: 'POST',
        data: { para },
        success: function(respHTML) {
            $('#content-table').html(respHTML);
        }
    });
}

function mostrarSeg(resp, title, url, edit) {
    $('#modal-title-md').html(title);
    $.ajax({
        url: url,
        data: { resp: resp, edit: edit },
        type: 'POST',
        success: function(respHtml) {
            $('#modal-body-md').html(respHtml);
        }
    });
    $.ajax({
        url: '../permisos/boton.php',
        type: 'POST',
        data: { resp },
        success: function(respHtml) {
            //console.log(respHtml);
            $('#modal-footer-md').html(respHtml);
        }
    });
}

function refreshTablePer(file, table) {
    $.ajax({
        url: '../' + file + '/' + table,
        type: 'POST',
        data: { resp: 'cerrar' },
        success: function(resp) {
            $('#content-table').html(resp);
        }
    });
}

function updObser(obs_talen, id_per) {
    $.ajax({
        url: '../permisos/permisos.controller.php',
        data: { obs_talen, action: 'updateObs', id_per },
        type: 'POST',
        success: function(resp) {
            if (resp != 1) {
                alertError(resp);
            } else {
                alertSuccess('Observación Agregada Correctamente', '', 1);
            }
        }

    });
}

function updSol(id_mes, id_per, state) {
    $.ajax({
        url: '../permisos/permisos.controller.php',
        data: { id_mes, action: 'updatePer', id_per },
        type: 'POST',
        success: function(resp) {
            if (resp != 1) {
                $('#modal-title-md').html('Actualización Solicitud');
                $('#modal-body-md').html(resp);
                $('#modal-medium').modal('show');
            }
            actualizarSolicitaPermis(state, id_mes);
        }

    });
}


function actualizarSolicitaPermis(state, opc) {
    var a = $('#' + state);
    console.log(a);
    switch (opc) {
        case 1:
            a.html('Enero');
            break;
        case 2:
            a.html('Febrero');
            break;
        case 3:
            a.html('Marzo');
            break;
        case 4:
            a.html('Abril');
            break;
        case 5:
            a.html('Mayo');
            break;
        case 6:
            a.html('Junio');
            break;
        case 7:
            a.html('Julio');
            break;
        case 8:
            a.html('Agosto');
            break;
        case 9:
            a.html('Septiembre');
            break;
        case 10:
            a.html('Octubre');
            break;
        case 11:
            a.html('Noviembre');
            break;
        case 12:
            a.html('Diciembre');
            break;

    }
}
$('#permisosBtn').click(
    function() {
        param = 1;
        $.ajax({
            url: '../permisos/reportes/permisosCsv.php',
            type: 'POST',
            data: { param },
            succes: function() {
                console.log("CSV Actualizado")
            }
        });
        console.log("Archivo Actualizado");
    }
);

function exportToSheets(title) {
    $.ajax({
        url: '../permisos/sheets.php',
        data: { title },
        type: 'POST',
        success: function(resp) {
            console.log(resp);
            $('#modal-title-sm').html('Hoja');
            $('#modal-body-sm').html(resp);
            $('#modal-small').modal('show');
        }

    });
}
