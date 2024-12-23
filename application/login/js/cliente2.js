function modalCliente(resp, id_cli, param) {
    if (resp == 1) {
        $('#modal-title-lg').html("Nuevo Cliente");
    } else {
        $('#modal-title-lg').html("Editar Cliente");
    }
    if (param != 3) {
        $.ajax({
            url: '../clientes2/form.php',
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
        url: '../clientes2/boton.php',
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

function crearCliente(param) {
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
                if (param == 3) {
                    if (!Number.isInteger(resp)) {
                        $('#alert-texto-cliente').html('Cliente creado correctamente; <a class="text-info" target="_blank" href="../clientes2/index.php?id=' + resp + '">ver</a>');
                        $('#alert-cliente').removeAttr("style");
                        $('#alert-cliente').addClass("alert-success");
                        snackbar('Cliente creado correctamente <a class="text-info" target="_blank" href="../clientes2/index.php?id=' + resp + '">ver</a>', "snackbar", 0, true);
                    } else {
                        $('#alert-texto-cliente').html(resp);
                        $('#alert-cliente').removeAttr("style");
                        $('#alert-cliente').addClass("alert-warning");
                        snackbar(resp, "snackbar", 0, true);
                    }
                } else {
                    $('#largeModal').modal('hide');
                    $('#modal-title-sm').html('Mensaje');
                    if (param == 1) {
                        if (Number.isInteger(resp)) {
                            $('#modal-body-sm').html("Cliente creado correctamente");
                            $('#modal-footer-sm').html('<a class="btn btn-default ml-1" href="index.php?id=' + resp + '">Cerrar</a>');
                        } else {
                            $('#modal-body-sm').html(resp);
                            $('#btn-footer-sm').attr('onclick', "refreshCliente('clientes2', 'tabla.php')");
                        }
                    } else if (param == 4) {
                        $('#modal-body-sm').html(resp);
                        $('#modal-footer-sm').html('<a class="btn btn-default ml-1" href="../comercial/index.php?table=1">Cerrar</a>');

                    } else {
                        //$('#modal-body-sm').html(resp);
                        //$('#btn-footer-sm').attr('onclick', "refreshCliente('clientes2', 'tabla.php')");
                    }
                    $('#smallModal').modal('show');
                }
            }
        });
    }
}

function editarCliente(param, id) {
    var formulario = new FormData($("#form-cliente")[0]);
    $.ajax({
        url: '../clientes2/clientes.controller.php',
        data: formulario,
        type: 'POST',
        contentType: false,
        processData: false,
        success: function(resp) {
            if (param == 3) {
                $('#alert-texto-cliente').html(resp);
                $('#alert-cliente').removeAttr("style");
                $('#alert-cliente').addClass("alert-success");
            } else {
                $('#largeModal').modal('hide');
                $('#modal-title-sm').html('Mensaje');
                $('#modal-body-sm').html(resp);
                if (param == 1) {
                    $('#btn-footer-sm').attr('onclick', "refreshCliente('clientes2', 'tabla.php', " + param + ", " + id + ")");
                } else if (param == 2) {
                    $('#btn-footer-sm').attr('onclick', "refreshCliente('clientes2', 'perfil.php', " + param + ", " + id + ")");
                }
                $('#smallModal').modal('show');
            }
        }
    });
}

function refreshCliente(file, table, param, id) {
    if (param == 1) {
        filtro('fec_crea,tip_cli,nitCc,id_ciu', '../clientes2/tabla.php');
        $.ajax({
            url: '../' + file + '/' + table,
            type: 'POST',
            data: {
                resp: 'cerrar'
            },
            success: function(resp) {
                console.log(month);
                $('#fec_crea').val(month);
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

function verificarcli() {
    var num_doc = $('#num_doc').val();
    var dataString = 'num_doc=' + num_doc;
    $.ajax({
        type: "POST",
        url: "../clientes2/consulta.php",
        data: dataString,
        success: function(data) {
            if (data == "0") {
                $('#num_doc').css("border", "1px solid red");
                $('#buton_prov').attr("disabled", "");
            } else if (data == "1") {
                $('#num_doc').css("border", "1px solid green");
                $('#buton_prov').removeAttr("disabled");
            }
        }
    });
}

function insert(value, param) {
    if (param == 1) {
        $('#nom_cont0').attr("value", value);
    } else if (param == 2) {
        $('#tel_cont0').attr("value", value);
    } else if (param == 3) {
        $('#eml_cont0').attr("value", value);
    } else {
        $('#car_cont0').attr("value", value);
    }
}

function tipDoc(value) {
    if (value == "C.C") {
        $('#textCont').html("(Aquí puedes registrar más contactos)");
        $('#info').html("(Estos datos serán tomados como el contacto principal del cliente)");
        $('#num').html(value);
        $('#tel_cli').attr("placeholder", "Teléfono de la persona");
        $('#cargo').removeAttr("style");
    } else {
        $('#textCont').html("(Este va a ser el contacto principal del cliente)");
        $('#info').html("");
        $('#num').html(value);
        $('#tel_cli').attr("placeholder", "Teléfono de la empresa");
        $('#cargo').attr("style", "display: none");
    }
}

function addContact(value) {
    plus = value + 1
    $('#cont-' + value).removeAttr("style");
    $('#addContact').attr("onclick", "addContact(" + plus + ")");
}

function filtro(params, table) {
    var param = params.split(',');
    var para = [];
    for (var i = 0; i < param.length; i++) {
        para.push($('#' + param[i]).val());
        console.log(para[i]);
    }
    $.ajax({
        url: table,
        type: 'POST',
        data: { para },
        success: function(respHTML) {
            console.log(para);
            $('#content-table').html(respHTML);
        }
    });
}

function selFiltroCli(value) {
    console.log(value);
    switch (value) {
        case '0':
            $('#filTipCli').attr("style", "display: none");
            $('#filFecCrea').attr("style", "display: none");
            $('#filNitCc').attr("style", "display: none");
            $('#filCiu').attr("style", "display: none");
            break;
        case '1':
            $('#filTipCli').removeAttr("style");
            $('#filFecCrea').attr("style", "display: none");
            $('#filNitCc').attr("style", "display: none");
            $('#filCiu').attr("style", "display: none");
            break;
        case '2':
            $('#filFecCrea').removeAttr("style");
            $('#filTipCli').attr("style", "display: none");
            $('#filNitCc').attr("style", "display: none");
            $('#filCiu').attr("style", "display: none");
            break;
        case '3':
            $('#filNitCc').removeAttr("style");
            $('#filTipCli').attr("style", "display: none");
            $('#filFecCrea').attr("style", "display: none");
            $('#filCiu').attr("style", "display: none");
            break;
        case '4':
            $('#filCiu').removeAttr("style");
            $('#filTipCli').attr("style", "display: none");
            $('#filFecCrea').attr("style", "display: none");
            $('#filNitCc').attr("style", "display: none");
            break;
        default:
            break;
    }
}

function buscarCliente(param) {
    $("#search").autocomplete({
        source: '../autocomplete/clientes2/buscador.php',
        minLength: 3,
        select: function(event, ui) {
            if (param == 1) {
                $("#id_cli1").val(ui.item.id_cli);
                $("#nom_cli1").val(ui.item.nom_cli);
                $("#tip_doc").val(ui.item.tip_doc);
                $("#num_doc").val(ui.item.num_doc);
                $("#tel_cli").val(ui.item.tel_cli);
                $("#eml_cli").val(ui.item.eml_cli);
                $("#hor_cli1").val(ui.item.hor_cli1);
                $("#hor_cli2").val(ui.item.hor_cli2);
                $("#dir_cli").val(ui.item.dir_cli);
                $("#id_ciu1").val(ui.item.id_ciu);
                $("#zip_cli").val(ui.item.zip_cli);
                $("#web_cli").val(ui.item.web_cli);
                $("#tip_cli").val(ui.item.tip_cli);
                $("#ase_com").val(ui.item.ase_com);
                $("#rep_sac").val(ui.item.rep_sac);
                $('#nom_cli1').focus();
                $('#editar').removeAttr("disabled");
            } else if (param == 2) {
                $("#id_cli").val(ui.item.id_cli);
                $("#id_cli2").val(ui.item.id_cli);
                $("#search").val(ui.item.nom_cli);
                $("#tip_doc").val(ui.item.tip_doc);
                $("#num_doc").val(ui.item.num_doc);
            }
        }
    });
}

function limpiarDatos() {
    $("#id_cli1").val('');
    $("#nom_cli1").val('');
    $("#tip_doc").val('');
    $("#num_doc").val('');
    $("#tel_cli").val('');
    $("#eml_cli").val('');
    $("#hor_cli1").val('07:00');
    $("#hor_cli2").val('17:00');
    $("#dir_cli").val('');
    $("#id_ciu1").val('1');
    $("#zip_cli").val('');
    $("#web_cli").val('');
    $("#tip_cli").val('');
    $("#ase_com").val('');
    $("#rep_sac").val('');
}

function editarCli(value) {
    if (value == 0) {
        $('#editar_cli').val(1);
        $('#actionCli').val('updateCliente');
        $('#contact-form').attr('style', 'display: none');
        $.ajax({
            url: '../clientes2/boton.php',
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
        $('#editar_cli').val(0);
        $('#actionCli').val('addCliente');
        $('#contact-form').removeAttr('style');
        limpiarDatos();
        $.ajax({
            url: '../clientes2/boton.php',
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

function buscarActividadEco() {
    $("#act_eco").autocomplete({
        source: '../autocomplete/act_eco/buscador.php',
        minLength: 3,
        select: function(event, ui) {
            $("#id_act").val(ui.item.id_act);
        }
    });
}