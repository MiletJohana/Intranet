function verificar() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(mostrarUbicacion);
    } else {
        alert("¡Error! Este navegador no soporta la Geolocalización.");
    }
}

function mostrarUbicacion(position) {
    var times = position.timestamp;
    var latitud = position.coords.latitude;
    var longitud = position.coords.longitude;
    var altitud = position.coords.altitude;
    var exactitud = position.coords.accuracy;
    $('#latitud').attr('value', latitud);
    $('#longitud').attr('value', longitud);
    // if (latitud != '') {
    //     alert('Debes activar el GPS para poder continuar');
    //     window.location('../comercial/index.php');
    // }
}

function cerrar() {
    $('#largeModal').modal('hide');
    window.location = '../comercial/index.php?table=1';
}

function crearCita() {
    var latitud = $('#latitud').val();
    var longitud = $('#longitud').val();
    $('#modal-title-lg').html("Crear Cita");
    $.ajax({
        url: '../comercial/form.php',
        type: 'POST',
        data: {
            resp: 1
        },
        success: function(resp) {
            $('#modal-body-lg').html(resp);
            $('#lat_ini').attr('value', latitud);
            $('#lon_ini').attr('value', longitud);
            var estado = $('#id_est2').val();
            if (estado == 3) {
                var resp = 0;
            } else {
                var resp = 1;
            }
            $.ajax({
                url: '../comercial/boton.php',
                type: 'POST',
                data: {
                    resp
                },
                success: function(resp) {
                    $('#modal-footer-lg').html(resp);
                }
            });
        }
    });
}

function auto() {
    $("#nom_cli").autocomplete({
        source: '../autocomplete/comercial/buscador.php',
        minLength: 3,
        select: function(event, ui) {
            $("#id_cli").val(ui.item.id_cli);
            $("#id_cli").attr('readonly', '');
            $("#con_cli").val(ui.item.con_cli);
            $("#tel_cli").val(ui.item.tel_cli);
            $("#dir_cli").val(ui.item.dir_cli);
            $("#cargo_conta").val(ui.item.cargo_conta);
            $("#eml_cli").val(ui.item.eml_cli);
            $("#hor_cli").val(ui.item.hor_cli);
            $("#btnAgregar").removeAttr("disabled");
            $("#btnUpdCli").removeAttr("disabled");
        }
    });
}

function agregarCita() {
    //if (validarCampos('form-cita') == 0) {
    var id_raz = $('select[name=id_raz]').val();
    if (id_raz == "0") {
        alert('Debes escoger una razón');
    } else {
        var formulario = new FormData($("#form-cita")[0]);
        $.ajax({
            url: '../comercial/comercial.controller.php',
            data: formulario,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function(resp) {
                $('#largeModal').modal('hide');
                $('#modal-title-sm').html('Crear Cita');
                $('#modal-body-sm').html(resp);
                $('#smallModal').modal('show');
                $('#btn-footer-sm').attr('onclick', 'cerrar();');
            }
        });
    }
    //}
}


function cambiarCita() {
    var latitud = $('#latitud').val();
    var longitud = $('#longitud').val();
    if (latitud == '' || longitud == '') {
        alert('Debes activar el GPS para continuar con el proceso');
        window.location = '../comercial/index.php?table=1';
    } else {
        $.ajax({
            url: '../comercial/form.php',
            type: 'POST',
            data: {
                resp: 2
            },
            success: function(resp) {
                $('#modal-body-lg').html(resp);
                var id_agen = $('#id_agen').val();
                var estado = $('#id_est').val();
                if (estado == 3) {
                    $('#lat_ini').attr('value', latitud);
                    $('#lon_ini').attr('value', longitud);
                    $('#largeModal').modal('show');
                    $('#modal-title-lg').html("Modificar Cita");
                    $('#cancelarCita').attr('onclick', 'cancelarCita(' + id_agen + ');');
                    $.ajax({
                        url: '../comercial/boton.php',
                        type: 'POST',
                        data: {
                            resp: 2
                        },
                        success: function(resp) {
                            $('#modal-footer-lg').html(resp);
                        }
                    });
                }
            }
        });
    }
}

function modificarCita() {
    var obs_agen = $('#obs_agen').val();
    if (obs_agen == '') {
        alert('Debes agregar las observaciones correspondientes');
    } else {
        var r = confirm("Estas seguro de finalizar la cita, Recuerde solo dar un click");
        if (r == true) {
            var formulario = new FormData($("#form-cita")[0]);
            $.ajax({
                url: '../comercial/comercial.controller.php',
                data: formulario,
                type: 'POST',
                contentType: false,
                processData: false,
                success: function(resp) {
                    console.log(resp);
                    $('#largeModal').modal('hide');
                    $('#modal-title-sm').html('Modificar cita');
                    $('#modal-body-sm').html(resp);
                    $('#smallModal').modal('show');
                    $('#btn-footer-sm').attr('onclick', 'cerrar();');
                }
            });
        }
    }
}

function confirmarCita(id_agen) {
    $('#modal-title-md').html("Modificar Cita");
    $.ajax({
        url: '../comercial/form.php',
        type: 'POST',
        data: {
            resp: 3,
            id_agen: id_agen
        },
        success: function(resp) {
            $('#modal-body-md').html(resp);
        }
    });
    $.ajax({
        url: '../comercial/boton.php',
        type: 'POST',
        data: {
            resp: 3
        },
        success: function(resp) {
            $('#modal-footer-md').html(resp);
        }
    });
}

function aceptarConfirmar() {
    var formulario = new FormData($("#form-cita")[0]);
    $.ajax({
        url: '../comercial/comercial.controller.php',
        data: formulario,
        type: 'POST',
        contentType: false,
        processData: false,
        success: function(resp) {
            $('#mediumModal').modal('hide');
            $('#modal-title-sm').html('Modificar cita');
            $('#modal-body-sm').html(resp);
            $('#smallModal').modal('show');
            $('#btn-footer-sm').attr('onclick', 'cerrar();');
        }
    });
}

function actualizarCita(id_agen) {
    $('#modal-title-md').html("Actualizar Cita");
    $.ajax({
        url: '../comercial/form.php',
        type: 'POST',
        data: {
            resp: 4,
            id_agen: id_agen
        },
        success: function(resp) {
            $('#modal-body-md').html(resp);
        }
    });
    $.ajax({
        url: '../comercial/boton.php',
        type: 'POST',
        data: {
            resp: 4
        },
        success: function(resp) {
            $('#btn-md').html(resp);
        }
    });
}

function confirmActualizacion() {
    var formulario = new FormData($("#form-cita")[0]);
    $.ajax({
        url: '../comercial/comercial.controller.php',
        data: formulario,
        type: 'POST',
        contentType: false,
        processData: false,
        success: function(resp) {
            $('#mediumModal').modal('hide');
            $('#modal-title-sm').html('Actualizar Cita');
            $('#modal-body-sm').html(resp);
            $('#smallModal').modal('show');
            $('#btn-footer-sm').attr('onclick', 'cerrar();');
        }
    });
}

function cancelarCita(id_agen) {
    var latitud = $('#latitud').val();
    var longitud = $('#longitud').val();
    console.log(latitud + longitud);
    $('#modal-title-lg').html("Aviso");
    $.ajax({
        url: '../comercial/form.php',
        type: 'POST',
        data: {
            resp: 5,
            id_agen: id_agen
        },
        success: function(resp) {
            $('#modal-body-lg').html(resp);
            $('#lat_fin').attr('value', latitud);
            $('#lon_fin').attr('value', longitud);
        }
    });
    $.ajax({
        url: '../comercial/boton.php',
        type: 'POST',
        data: {
            resp: 5
        },
        success: function(resp) {
            $('#modal-footer-lg').html(resp);
        }
    });
}

function confirmCancelar() {
    var formulario = new FormData($("#form-cita")[0]);
    var obs = $('#obs_agenC').val();
    if (obs == '') {
        alert("Es necesario tener un motivo por el cual cancelar la cita");
    } else {
        $.ajax({
            url: '../comercial/comercial.controller.php',
            data: formulario,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function(resp) {
                $('#mediumModal').modal('hide');
                $('#modal-title-sm').html('Aviso');
                $('#modal-body-sm').html(resp);
                $('#smallModal').modal('show');
                $('#btn-footer-sm').attr('onclick', 'cerrar();');
            }
        });
    }
}


function refreshTable() {
    $.ajax({
        url: '../comercial/tabla.php',
        type: 'POST',
        data: {
            resp: 1
        },
        success: function(resp) {
            $('#content-table').html(resp);
        }
    });

}

function mostrarCita(id_agen) {
    $('#modal-title-lg').html("Información Visita #" + id_agen);
    $.ajax({
        url: '../comercial/informacion.php',
        type: 'POST',
        data: {
            resp: 6,
            id_agen: id_agen
        },
        success: function(resp) {
            $('#modal-body-lg').html(resp);
        }
    });
    $.ajax({
        url: '../comercial/boton.php',
        type: 'POST',
        data: {
            resp: 6
        },
        success: function(resp) {
            $('#modal-footer-lg').html(resp);
        }
    });
}

function misVisitas(mostrar) {
    $.ajax({
        url: '../comercial/tabla.php',
        type: 'POST',
        data: {
            mostrar
        },
        success: function(resp) {
            $('#table1').html(resp);
            $('#historial').attr('class', 'btn btn-red btn-sm');
            $('#misVisitas').attr('class', 'btn btn-sm btn-secondary');
        }
    });
}

function historial(historial) {
    $.ajax({
        url: '../comercial/tabla.php',
        type: 'POST',
        data: {
            historial
        },
        success: function(resp) {
            $('#table1').html(resp);
            $('#misVisitas').attr('class', 'btn btn-red btn-sm');
            $('#historial').attr('class', 'btn btn-sm btn-secondary');
        }
    });
}

function newClie(com, param) {
    var latitud = $('#latitud').val();
    var longitud = $('#longitud').val();
    $.ajax({
        url: '../clientes2/form.php',
        type: 'POST',
        data: { resp: 1, com },
        success: function(resp) {
            //console.log(com);
            $('#modal-body-lg').html(resp);
            $('#lat_ini').attr('value', latitud);
            $('#lon_ini').attr('value', longitud);
        }
    });
    $.ajax({
        url: '../comercial/boton.php',
        type: 'POST',
        data: { resp: 8, param },
        success: function(resp) {
            $('#modal-footer-lg').html(resp);
        }
    });
}

function selectRaz(val) {
    console.log(val);
    if (val == 1 || val == 10) {
        $('#nom_cli').removeAttr('required');
        $('#dir_cli').removeAttr('required');
        $('#tel_cli').removeAttr('required');
        $('#eml_cli').removeAttr('required');
        $('#btnAgregar').removeAttr('disabled');
        $('#btnAcatualizar').removeAttr('disabled');
        var req = document.getElementsByName("req");
        $(req).html('');
    } else {
        $('#nom_cli').attr('required', '');
        $('#dir_cli').attr('required', '');
        $('#tel_cli').attr('required', '');
        $('#con_cli').attr('required', '');
        $('#eml_cli').attr('required', '');
        var req = document.getElementsByName("req");
        $(req).html('*');
    }
    $('#nom_cli').focus();
}

function actOjo(mail) {
    $('#correoCli').html(mail);
}

function crearCita2() {
    if (validarCampos('form-cliente') == 0) {
        var formulario = new FormData($("#form-cliente")[0]);
        $.ajax({
            url: '../clientes2/clientes.controller.php',
            data: formulario,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function(resp) {
                console.log(resp);
                $('#largeModal').modal('hide');
                $('#modal-title-sm').html('Mensaje');
                $('#smallModal').modal('show');
                $('#modal-body-sm').html(resp);
                $('#modal-footer-sm').html('onclick', 'cerrar();');
            }
        });
    }
}

function checkMail(value) {
    if (value == 1) {
        $("#correo").attr('value', 0);
    } else {
        $("#correo").attr('value', 1);
    }
}