function crearVisita() {
    $('#modal-title-lg').html("Crear Visita");
    $.ajax({

        url: '../visitas/form.php',
        type: 'POST',
        data: { resp: 1 },
        success: function(resp) {
            $('#modal-body-lg').html(resp);
        }
    });

    $.ajax({
        url: '../visitas/boton.php',
        type: 'POST',
        data: { resp: 1 },
        success: function(resp) {
            $('#modal-footer-lg').html(resp);
        }
    });
}

function auto() {
    $("#id_per2").autocomplete({
        source: '../autocomplete/visitas/buscador.php',
        minLength: 2,
        select: function(event, ui) {
            $("#addVisitante").addClass("none");
            $("#infoVisitante").removeClass("none");
            $("#are_vis").removeAttr("disabled");
            $("#are_vis").focus();
            $("#nom_per").html('<b>Nombre de vistante: </b>' + ui.item.nom_per);
            $("#emp_per").html('<b>Empresa: </b>' + ui.item.emp_per);
            $("#eps_per").html('<b>E.P.S: </b>' + ui.item.eps_per);
            $("#arl_per").html('<b>A.R.L: </b>' + ui.item.arl_per);
            $("#tel_per").html('<b>Teléfono: </b>' + ui.item.tel_per);
            $("#con_per").html('<b>Contacto emergencia: </b>' + ui.item.con_per);
            $("#tel_con").html('<b>Teléfono del contacto: </b>' + ui.item.tel_con);
            $("#btnEditar").attr('type', 'button');
            $("#btnEditar").attr('onclick', 'editarVisitante(' + ui.item.id_per + ');');
            $("#btnAgregar").removeAttr("disabled");
            $("#btnUpdCli").removeAttr("disabled");
        }
    });
}

function agregarVisita() {
    var img = $('#imginput').val();
    if (img != "") {
        if (validarCampos('form-visita') == 0) {
            var formulario = new FormData($("#form-visita")[0]);
            $.ajax({
                url: '../visitas/visitas.controller.php',
                data: formulario,
                type: 'POST',
                contentType: false,
                processData: false,
                success: function(resp) {
                    $('#largeModal').modal('hide');
                    $('#modal-title-sm').html('Crear Visita');
                    $('#modal-body-sm').html(resp);
                    $('#smallModal').modal('show');
                    $('#modal-footer-sm').html('<button type="button" class="btn btn-default" onclick="refreshTableVis()" data-bs-dismiss="modal">Cerrar</button>');
                }
            });
        }
    } else {
        snackbar('Debes tomar una foto', "toast", 3000, true);
    }
}

function actualizarVisita(id) {
    $('#modal-title-md').html("Actualizar Visita");
    $.ajax({
        url: '../visitas/informacion.php',
        type: 'POST',
        data: { resp: 2, id_vis: id },
        success: function(resp) {
            $('#modal-body-lg').html(resp);
            $("#btnUpdCli").removeAttr("disabled");
        }
    });
    $.ajax({
        url: '../visitas/boton.php',
        type: 'POST',
        data: { resp: 2 },
        success: function(resp) {
            $('#modal-footer-lg').html(resp);
        }
    });
}

function encuesta(id) {
    $('#modal-title-lg').html('Covid-19');
    $.ajax({
        url: '../visitas/form3.php',
        type: 'POST',
        data: { resp: 6, id: id },
        success: function(respHtml) {
            $('#modal-body-lg').html(respHtml);
        }
    });
    $.ajax({
        url: '../visitas/boton.php',
        type: 'POST',
        data: { resp: 6, id: id },
        success: function(respHtml) {
            $('#modal-footer-lg').html(respHtml);
        }
    });
}

function crearEncuesta() {
    if (validarCampos('form-encuesta') == 0) {
        var formulario = new FormData($("#form-encuesta")[0]);
        $.ajax({
            url: '../visitas/visitas.controller.php',
            data: formulario,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function(resp) {
                $('#largeModal').modal('hide');
                $('#modal-body-sm').html(resp);
                $('#modal-title-sm').html('Actualizar Visita');
                $('#smallModal').modal('show');
                $('#btn-footer-sm').html('<button type="button" class="btn btn-default" onclick="refreshTableVis()" data-bs-dismiss="modal">Cerrar</button>');
            }
        });
    }
}

function modificarVisita() {
    if (validarCampos('form-Visita') == 0) {
        var formulario = new FormData($("#form-Visita")[0]);
        $.ajax({
            url: '../visitas/visitas.controller.php',
            data: formulario,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function(resp) {
                $('#largeModal').modal('hide');
                $('#modal-title-sm').html('Covid-19');
                $('#modal-body-sm').html(resp);
                $('#smallModal').modal('show');
                $('#btn-footer-sm').html('<button type="button" class="btn btn-default" onclick="refreshTableVis()" data-bs-dismiss="modal">Cerrar</button>');
            }
        });
    }
}

function actualizarVisitante(id) {
    $('#modal-title-lg').html("Actualizar Visitante");
    $.ajax({
        url: '../visitas/form2.php',
        type: 'POST',
        data: { resp: 4, id_per: id },
        success: function(resp) {
            $('#modal-body-lg').html(resp);
            $("#id_per3").attr('readonly', 'true');
        }
    });
    $.ajax({
        url: '../visitas/boton.php',
        type: 'POST',
        data: { resp: 4 },
        success: function(resp) {
            $('#modal-footer-lg').html(resp);
        }
    });
}

function modificarVisitante() {
    if (validarCampos('form-visitante2') == 0) {
        var formulario = new FormData($("#form-visitante2")[0]);
        $.ajax({
            url: '../visitas/visitas.controller.php',
            data: formulario,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function(resp) {
                $('#largeModal').modal('hide');
                $('#modal-body-sm').html(resp);
                $('#modal-title-sm').html('Actualizar Visitante');
                $('#smallModal').modal('show');
                $('#btn-footer-sm').html('<button type="button" class="btn btn-default" onclick="refreshTableVis()" data-bs-dismiss="modal">Cerrar</button>');
            }
        });
    }
}

function editarVisitante(id) {
    $("#infoVisitante").addClass("none");
    $('#Visit').attr("class", "col-md-12");
    $.ajax({
        url: '../visitas/form2.php',
        type: 'POST',
        data: { resp: 6, id_per: id },
        success: function(resp) {
            $('#Visit').html(resp);
            $("#id_per3").attr('readonly', 'true');
        }
    });
}

function editVisit() {
    if (validarCampos('form-visitante2') == 0) {
        var formulario = new FormData($("#form-visitante2")[0]);
        var id = $('#id_per3').val();
        $.ajax({
            url: '../visitas/visitas.controller.php',
            data: formulario,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function(resp) {
                $('#Visit').html(resp);
                $('#Visit').attr('class', 'col-md-12 alert alert-success');
                $.ajax({
                    url: '../autocomplete/visitas/consulta2.php',
                    type: 'POST',
                    data: { id },
                    success: function(resp) {
                        $('#datos').html(resp);
                        $("#btnEditar").attr('onclick', 'editarVisitante(' + ui.item.id_per + ');');
                    }
                });

            }
        });
    }
}

function crearVisitante() {
    $('#video').removeAttr('id');
    $('#estado').removeAttr('id');
    $('#canvas').removeAttr('id');
    $('#respuesta').removeAttr('id');
    $('#imginput').removeAttr('id');
    $('#boton').removeAttr('id');
    $('#message').removeAttr('id');
    $('#modal-title-lg').html("Crear Visitante");
    $.ajax({
        url: '../visitas/form2.php',
        type: 'POST',
        data: { resp: 5 },
        success: function(resp) {
            $('#modal-body-lg').html(resp);
        }
    });
    $.ajax({
        url: '../visitas/boton.php',
        type: 'POST',
        data: { resp: 5 },
        success: function(resp) {
            $('#modal-footer-lg').html(resp);
        }
    });
}

function agregarVisitante() {
    var img = $('#imginput').val();
    if (img != "") {
        if (validarCampos('form-visitante2') == 0) {
            var formulario = new FormData($("#form-visitante2")[0]);
            $.ajax({
                url: '../visitas/visitas.controller.php',
                data: formulario,
                type: 'POST',
                contentType: false,
                processData: false,
                success: function(resp) {
                    $('#largeModal').modal('hide');
                    $('#modal-title-sm').html('Crear Visitante');
                    $('#modal-body-sm').html(resp);
                    $('#smallModal').modal('show');
                    $('#modal-footer-sm').html('<button type="button" class="btn btn-default" onclick="refreshTableVis()" data-bs-dismiss="modal">Cerrar</button>');
                }
            });
        }
    } else {
        $('#message').html('<br><div class="alert alert-danger">Debes tomar una foto</div>');
    }
}

function refreshTableVis() {
    $.ajax({
        url: '../visitas/tabla.php',
        type: 'POST',
        data: { resp: 1 },
        success: function(resp) {
            $('#content-table').html(resp);
        }
    });

}

function mostrarVisitantes() {
    $.ajax({
        url: '../visitas/tableVisitant.php',
        type: 'POST',
        data: { resp: 1 },
        success: function(resp) {
            $('#tablas').html('Registros');
            $('#tablas').attr('onclick', 'refreshTable();');
            $('#content-table').html(resp);
            $('#search-button').attr('onclick', 'searchTableVis();');
        }
    });
}