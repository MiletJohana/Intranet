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
            $("#num_doc").val(ui.item.num_doc);
            //$("#con_client").val(ui.item.con_cli);
            $("#tel_client").val(ui.item.tel_cli);
            $("#dir_client").val(ui.item.dir_cli);
            $("#hor_cli1").val(ui.item.hor_cli1);
            $("#hor_cli2").val(ui.item.hor_cli2);
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
                $('#modal-title-sm').html('Actualizar Diligencia');
                $('#modal-body-sm').html(resp);
                $('#smallModal').modal('show');
                $('#btn-footer-sm').html('<button type="button" class="btn btn-secondary" onclick="refreshTableDil(1, 0)" data-bs-dismiss="modal">Cerrar</button>');
            }
        });
    }
}

function eliminarDil(id) {
    Swal.fire({
        title: '¿Está seguro de eliminar esta diligencia?',
        icon: "question",
        allowOutsideClick: false,
        allowEscapeKey: false,
        allowEnterKey: false,
        showDenyButton: true,
        confirmButtonText: "Si, eliminar",
        denyButtonText: `No`
    }).then((result) => {
        if (result.isConfirmed) {
            var action = "delete";
            $.ajax({
                url: '../diligencia/diligencia.controller.php',
                type: 'POST',
                data: { id: id, action: action },
                success: function (resp) {
                    $('#modal-title-sm').html('Eliminar Diligencia');
                    $('#modal-body-sm').html(resp);
                    $('#smallModal').modal('show');
                    $('#btn-footer-sm').html('<button type="button" class="btn btn-secondary" onclick="refreshTableDil(1, 0)" data-bs-dismiss="modal">Cerrar</button>');
                }
            });
        }
    });
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
    $('#modal-title-lg').html("Crear Cliente");
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
    //var con_client = $('#con_client').val();
    var tel_client = $('#tel_client').val();
    var hor_cli1 = $('#hor_cli1').val();
    var hor_cli2 = $('#hor_cli2').val();
    var dir_client = $('#dir_client').val();
    $.ajax({
        url: '../diligencia/diligencia.controller.php',
        type: 'POST',
        data: { id_client, tel_client, hor_cli1, hor_cli2, dir_client, action },
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
    /*var table = $('#tableDiligencias').DataTable();
    table.column(6).search(est_dlg).draw();*/
    var table = $('#tableDiligencias').DataTable();
    table.ajax.reload();
   /* $.ajax({
        url: '../diligencia/ser.php',
        data: { est_dlg, reg },
        type: 'POST',
        success: function (resp) {
            $('#content-table').html(resp);
        }
    });*/
}

function espera(dia_dlg) {
    var est_dlg = $('#estado').val();
    var reg = $('#reg').val();
    //alert(dia_dlg);
    var table = $('#tableDiligencias').DataTable();
    table.ajax.reload();
    /*$.ajax({
        url: 'tabla.php',
        data: { est_dlg, dia_dlg, reg },
        type: 'POST',
        success: function (resp) {
            $('#content-table').html(resp);
        }
    });*/
}

function resetFiltros1() {
    $('.form-check-input').prop('checked', false);
    $('#estadoTodas').prop('selected', true);
    var table = $('#tableDiligencias').DataTable();
    table.ajax.reload();
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