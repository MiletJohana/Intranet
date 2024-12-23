function crearEnrutamiento() {
    $('#modal-title-lg').html("Crear Enrutamiento");
    $.ajax({
        url: '../enrutamientos/form.php',
        type: 'POST',
        data: { resp: 1 },
        success: function(resp) {
            $('#modal-body-lg').html(resp);
        }
    });

    $.ajax({
        url: '../enrutamientos/boton.php',
        type: 'POST',
        data: { resp: 1 },
        success: function(resp) {
            $('#modal-footer-lg').html(resp);
        }
    });
}

function agregarEnrutamiento() {
    var action = $('#accion_form').val();
    var data = [];
    var childrens = $("#ruta").children();
    for (var i = 0; i < childrens.length; i++) {
        var id_order = $(childrens[i]).data("id")
        data.push(id_order)
    }
    $.ajax({
        url: '../enrutamientos/enrutamiento.controller.php',
        data: { data, action },
        type: 'POST',
        success: function(resp) {
            $('#largeModal').modal('hide');
            $('#modal-body-sm').html(resp);
            $('#modal-title-sm').html('Aviso');
            $('#smallModal').modal('show');
            $('#modal-footer-sm').html('<button type="button" class="btn btn-default" onclick="refreshTableEnrut()" data-bs-dismiss="modal">Cerrar</button>');
        }
    });
}

function actualizarEnrutamiento(id) {
    $('#modal-title-lg').html('Información Enrutamiento');
    var formulario = new FormData($("#form-usuario")[0]);
    $.ajax({
        url: '../enrutamientos/informacion.php',
        data: { num_enr: id, resp: 3 },
        type: 'POST',
        success: function(resp) {
            $('#modal-body-lg').html(resp);
        }
    });
    $.ajax({
        url: '../enrutamientos/boton.php',
        type: 'POST',
        data: { resp: 2 },
        success: function(resp) {
            $('#modal-footer-lg').html(resp);
            $('#btnAcatualizar').attr('value', id);
            $('#btnImprimir').attr('href', 'https://intranet.masterquimica.com/application/enrutamientos/imp.php?num_enr=' + id);
        }
    });
}

function modificarEnrutamiento() {
    var obs = document.getElementsByName('obs_enr');
    var obs_enr = [];
    var efec = $("input[name='efec_enr']");
    var efec_enr = [];
    for (var value of obs) {
        obs_enr.push(value.value);
    }

    efec.each(function(index) {
        var input = $(this);
        efec_enr.push(input.prop("checked"));
    });
    var cos = document.getElementsByName('cos_dlg');
    var cos_dlg = [];
    for (var value of cos) {
        cos_dlg.push(value.value);
    }
    var cos_enr = $('#cos_enr').val();
    console.log(cos_enr);
    var action = $('#accion_form').val();
    var num_enr = $('#num_enr').val();
    $.ajax({
        url: '../enrutamientos/enrutamiento.controller.php',
        data: { obs_enr, efec_enr, action, num_enr, cos_dlg, cos_enr },
        type: 'POST',
        success: function(resp) {
            $('#largeModal').modal('hide');
            $('#modal-body-sm').html(resp);
            $('#modal-title-sm').html('Aviso');
            $('#smallModal').modal('show');
            $('#modal-footer-sm').html('<button type="button" class="btn btn-default" onclick="refreshTableEnrut()" data-bs-dismiss="modal">Cerrar</button>');
        }
    });
}


function mostrarEnrutamiento(id) {
    $('#modal-title-lg').html('Información Enrutamiento');
    $.ajax({
        url: '../enrutamientos/informacion.php',
        data: { num_enr: id, resp: 5 },
        type: 'POST',
        success: function(resp) {
            $('#modal-body-lg').html(resp);
            $.ajax({
                url: '../enrutamientos/boton.php',
                type: 'POST',
                data: { resp: 5 },
                success: function(resp) {
                    $('#modal-footer-lg').html(resp);
                    $('#btnImprimir').attr('href', 'https://intranet.masterquimica.com/application/enrutamientos/imp.php?num_enr=' + id);
                }
            });
        }
    });
}

function imrpimirEnrutamiento(num_enr) {
    $('#modal-title-lg').html('Confirmación');

    $.ajax({
        url: '../enrutamientos/informacion.php',
        data: { num_enr: num_enr, resp: 2 },
        type: 'POST',
        success: function(resp) {
            $('#modal-body-lg').html(resp);
            $('#info').html('<div class="alert alert-danger alert-dismissible" style="font-size:15px;"> ¿Está seguro que desea imprimir la ruta ' + num_enr + '? <br> Recuerde que de confirmar no se podra modificar ninguna de las diligencias ni se podra eliminar la ruta.</div>');
        }
    });

    $.ajax({
        url: '../enrutamientos/boton.php',
        type: 'POST',
        data: { resp: 4, num_enr: num_enr },
        success: function(resp) {
            $('#modal-footer-lg').html(resp);
        }
    });
}

function confirmImprimir(num_enr) {
    $('#largeModal').modal('hide');
    var action = 'updateEnru';
    $.ajax({
        url: '../enrutamientos/enrutamiento.controller.php',
        data: { action, num_enr },
        type: 'POST',
        success: function(resp) {
            if (resp = "1") {
                window.open('https://intranet.masterquimica.com/application/enrutamientos/imp.php?num_enr=' + num_enr, '_blank');
                $('#modal-body-sm').html("<div align='center'><br>Enrutamiento # '" + num_enr + "'<br>Estado: EN RUTA<br></div>");
                $('#modal-title-sm').html('Aviso');
                $('#smallModal').modal('show');
                $('#modal-footer-sm').html('<button type="button" class="btn btn-default" onclick="refreshTableEnrut()" data-bs-dismiss="modal">Cerrar</button>');
            } else {
                $('#modal-title-sm').html('Aviso');
                $('#modal-body-sm').html(resp);
                $('#smallModal').modal('show');
                $('#modal-footer-sm').html('<button type="button" class="btn btn-default" onclick="refreshTableEnrut()" data-bs-dismiss="modal">Cerrar</button>');
            }
        }
    });
}

function eliminarEnrut(id) {
    var r = confirm('¿Está seguro de eliminar este Enrutamiento?');
    if (r == true) {
        var action = "delete";
        $.ajax({
            url: '../enrutamientos/enrutamiento.controller.php',
            type: 'POST',
            data: { num_enr: id, action: action },
            success: function(resp) {
                $('#modal-title-sm').html('Eliminar Enrutamiento');
                $('#modal-body-sm').html(resp);
                $('#smallModal').modal('show');
                $('#btn-footer-sm').html('<button type="button" class="btn btn-default" onclick="refreshTableEnrut()" data-bs-dismiss="modal">Cerrar</button>');
            }
        });
    }
}

function refreshTableEnrut() {
    var reg = $('#reg').val();
    $.ajax({
        url: '../enrutamientos/',
        type: 'POST',
        data: { resp: 1, reg },
        success: function(resp) {
            console.log(url);
            $('#content-table').html(resp);
        }
    });

}

function moverDiligencia(id) {
    $('#' + id).appendTo("#ruta");
    $('#' + id + ' :nth-child(6)').html('<button type="button" onclick="retornarDiligencia(' + id + ')" class="btn btn-danger">' +
        '<span class="fa fa-remove"></span></button>');
}

function retornarDiligencia(id) {
    $('#' + id).appendTo("#diligencias");
    $('#' + id + ' :nth-child(6)').html('<button type="button" onclick="moverDiligencia(' + id + ')" class="btn btn-success">' +
        '<span class="fa-solid fa-check"></span></button>');
    ordenar();
}


function validarEnrutamiento(id) {
    $.ajax({
        url: '../enrutamientos/enrutamientoMensajero.php',
        type: 'POST',
        data: { id: id },
        success: function(resp) {
            $('#contenidoMensajero').html(resp);
            $('#textoMensajero').html('selecciona una Diligencia');
        }
    });
}

function editarDiligencia(diligencia, enrutamiento) {
    $.ajax({
        url: '../enrutamientos/enrutamientoMensajeroDil.php',
        type: 'POST',
        data: { num_dlg: diligencia, num_enr: enrutamiento },
        success: function(resp) {
            $('#contenidoMensajero').html(resp);
            $('#textoMensajero').html('Diligencia # ' + diligencia);
        }
    });
}

function actualizarDiligencia(enrutamiento) {
    var formulario = new FormData($("#form-diligencia")[0]);
    $.ajax({
        url: '../diligencias/diligencia.controller.php',
        type: 'POST',
        data: formulario,
        cache: false,
        contentType: false,
        processData: false,
        success: function(resp2) {
            validarEnrutamiento(enrutamiento);
            $('#mensajes').append(resp2);

        }
    });

}

function volverAEnrutamientos() {
    $.ajax({
        url: '../enrutamientos/enrutamientoMensajeroEnr.php',
        type: 'POST',
        data: { resp: 1 },
        success: function(resp) {
            $('#contenidoMensajero').html(resp);
        }
    });
}