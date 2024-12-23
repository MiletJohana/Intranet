function modalContacto(resp, id_cli, param) {
    if (resp == 1) {
        $('#modal-title-lg').html("Nuevo Contacto");
    } else {
        $('#modal-title-lg').html("Editar Contacto");
    }
    if (param != 3) {
        $.ajax({
            url: '../contactos/form.php',
            type: 'POST',
            data: {
                resp,
                id_cli
            },
            success: function(resp) {
                $('#modal-body-lg').html(resp);
            }
        });
    }
    $.ajax({
        url: '../contactos/boton.php',
        type: 'POST',
        data: {
            resp,
            id_cli,
            param
        },
        success: function(resp) {
            $('#modal-footer-lg').html(resp);
        }
    });
}

function modalAndi(resp, id_cli, param) {
    $('#modal-title-lg').html("Ingresa tus datos de contacto");
    if (param != 3) {
        $.ajax({
            url: 'subdominios/intranet/application/contactos/form.php',
            type: 'POST',
            data: {
                resp,
                id_cli
            },
            success: function(resp) {
                $('#modal-body-lg').html(resp);
            }
        });
    }
    $.ajax({
        url: 'subdominios/intranet/application/contactos/boton.php',
        type: 'POST',
        data: {
            resp,
            id_cli,
            param
        },
        success: function(resp) {
            $('#modal-footer-lg').html(resp);
        }
    });
}

function crearContacto(param, id_cli) {
    console.log("en funcion");
    var formulario = new FormData($("#form-contacto")[0]);
    $.ajax({
        url: '../contactos/contactos.controller.php',
        data: formulario,
        type: 'POST',
        contentType: false,
        processData: false,
        success: function(resp) {
            console.log(resp);
            if (param == 3) {
                $('#alert-texto-contacto').html(resp);
                $('#alert-contacto').removeAttr("style");
                $('#alert-contacto').addClass("alert-info");
            } else {
                $('#largeModal').modal('hide');
                $('#modal-title-sm').html('Mensaje');
                $('#modal-body-sm').html(resp);
                $('#smallModal').modal('show');
                if (param == 1) {
                    $('#btn-footer-sm').attr('onclick', "refreshContacto('contactos', 'tabla.php', " + param + ", " + id_cli + ")");
                } else if (param == 2) {
                    $('#btn-footer-sm').attr('onclick', "refreshContacto('clientes2', 'perfil.php', " + param + ", " + id_cli + ")");
                }
            }
        }
    });
}

function editarContacto(param, id_cli) {
    var formulario = new FormData($("#form-contacto")[0]);
    $.ajax({
        url: '../contactos/contactos.controller.php',
        data: formulario,
        type: 'POST',
        contentType: false,
        processData: false,
        success: function(resp) {
            if (param == 3) {
                $('#alert-texto-contacto').html(resp);
                $('#alert-contacto').removeAttr("style");
                $('#alert-contacto').addClass("alert-info");
            } else {
                $('#largeModal').modal('hide');
                $('#modal-title-sm').html('Mensaje');
                $('#modal-body-sm').html(resp);
                $('#smallModal').modal('show');
                if (param == 1) {
                    $('#btn-footer-sm').attr('onclick', "refreshContacto('contactos', 'tabla.php', " + param + ", " + id_cli + ")");
                } else if (param == 2) {
                    $('#btn-footer-sm').attr('onclick', "refreshContacto('clientes2', 'perfil.php', " + param + ", " + id_cli + ")");
                }
            }
        }
    });
}

function refreshContacto(file, table, param, id) {
    if (param == 1) {
        filtro('fec_crea', '../contactos/tabla.php');
        $.ajax({
            url: '../' + file + '/' + table,
            type: 'POST',
            data: {
                resp: 'cerrar'
            },
            success: function(resp) {
                console.log(month);
                $('#fec_crea').attr('value', month);
                $('#content-table').html(resp);
            }
        });
    } else if (param == 2) {
        $.ajax({
            url: '../' + file + '/' + table,
            type: 'GET',
            data: {
                id: id
            },
            success: function(resp) {
                $('#content-table').html(resp);
            }
        });
    }
}

function buscarClienteCont() {
    $("#nom_cli2").autocomplete({
        source: '../autocomplete/clientes2/buscador.php',
        minLength: 3,
        select: function(event, ui) {
            $("#nom_cli2").attr('value', ui.item.nom_cli);
            $("#id_cli2").attr('value', ui.item.id_cli);
            $('#nom_cont').focus();
            $('#crear').removeAttr("disabled");
            $('#editar').removeAttr("disabled");
        }
    });
}

function buscarCont() {
    $("#nom_cli2").autocomplete({
        source: '../autocomplete/contactos/buscador.php',
        minLength: 3,
        select: function(event, ui) {
            console.log(ui.item.id_cont);
            $("#id_cont1").attr('value', ui.item.id_cont);
            $("#nom_cont").attr('value', ui.item.nom_cont);
            $("#eml_cont").attr('value', ui.item.eml_cont);
            $("#car_conta").attr('value', ui.item.car_cont);
            $("#tel_cont").attr('value', ui.item.tel_cont);
            if (ui.item.cont_desh == 'Si') {
                $("#cont_desh").attr('checked', 'true');
                $("#cont_desh").attr('value', 1);
                habilitarDatos(0, 0, 2);
            } else if (ui.item.cont_desh == 'No') {
                $("#cont_desh").removeAttr('checked');
                $("#cont_desh").attr('value', 0);
            }
            $('#desh').removeAttr('style');
            $('#nom_cont').focus();
            $('#editar').removeAttr("disabled");
        }
    });
}

function filtro(params, table) {
    var param = params.split(',');
    var para = [];
    for (var i = 0; i < param.length; i++) {
        para.push($('#' + param[i]).val());
    }
    $.ajax({
        url: table,
        type: 'POST',
        data: {
            para
        },
        success: function(respHTML) {
            console.log(para);
            $('#content-table').html(respHTML);
        }
    });
}

function habilitarDatos(value, id, param) {

    if (param == 1) {
        if (value == 1) {
            $('#nom_cont' + id).removeAttr("readonly");
            $('#eml_cont' + id).removeAttr("readonly");
            $('#car_cont' + id).removeAttr("readonly");
            $('#tel_cont' + id).removeAttr("readonly");
        } else {
            $('#nom_cont' + id).attr("readonly", "true");
            $('#eml_cont' + id).attr("readonly", "true");
            $('#car_cont' + id).attr("readonly", "true");
            $('#tel_cont' + id).attr("readonly", "true");
        }
    } else if (param == 2) {
        if (value == 1) {
            $('#nom_cont').removeAttr("readonly");
            $('#eml_cont').removeAttr("readonly");
            $('#car_conta').removeAttr("readonly");
            $('#tel_cont').removeAttr("readonly");
        } else {
            $('#nom_cont').attr("readonly", "true");
            $('#eml_cont').attr("readonly", "true");
            $('#car_conta').attr("readonly", "true");
            $('#tel_cont').attr("readonly", "true");
        }
        // if (value == 1) {
        //     $('#cont_desh' + id).val(0);
        // } else {
        //     $('#cont_desh' + id).val(1);
        // }
    }
}

function editarCont(value) {
    if (value == 0) {
        $('#editar_cont').val(1);
        $('#actionCont').val('updateContacto2');
        $('#alert-editar').removeAttr('style');
        $('#nom_cli2').attr('onkeyup', 'buscarCont()');
        $('#titulo1').html('Buscar Contacto');
        $('#label-nom_cli').html('Contacto');
        $.ajax({
            url: '../contactos/boton.php',
            type: 'POST',
            data: {
                resp: 2,
                param: 3
            },
            success: function(resp) {
                $('#modal-footer-lg').html(resp);
            }
        });
    } else {
        $('#editar_cont').val(0);
        $('#actionCont').val('addContacto');
        $('#alert-editar').attr('style', 'display: none');
        $('#nom_cli2').attr('onkeyup', 'buscarClienteCont()');
        $('#desh').attr('style', 'display: none');
        $('#titulo1').html('Cliente relacionado');
        $('#label-nom_cli').html('Cliente');
        $.ajax({
            url: '../contactos/boton.php',
            type: 'POST',
            data: {
                resp: 1,
                param: 3
            },
            success: function(resp) {
                $('#modal-footer-lg').html(resp);
            }
        });
    }
}