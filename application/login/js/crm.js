/*---------------Negocios----------------*/

function modalNegocio(resp, id_neg, id_cli, param) {
    if (resp == 1) {
        $('#modal-title-lg').html('Nuevo negocio');
    } else {
        $('#modal-title-lg').html('Editar negocio');
    }
    $.ajax({
        url: '../crm/form.php',
        type: 'POST',
        data: {
            resp,
            id_neg,
            id_cli
        },
        success: function(respHtml) {
            $('#modal-body-lg').html(respHtml);
        }
    });
    $.ajax({
        url: '../crm/boton.php',
        type: 'POST',
        data: {
            resp,
            param,
            id_cli,
            id_neg
        },
        success: function(respHtml) {
            $('#modal-footer-lg').html(respHtml);
        }
    });
}

function crearNegocio(param, id) {
    var formulario = new FormData($("#form-neg")[0]);
    $.ajax({
        url: '../crm/crm.controller.php',
        data: formulario,
        type: 'POST',
        contentType: false,
        processData: false,
        success: function(resp) {
            $('#largeModal').modal('hide');
            $('#modal-title-sm').html('Información');
            $('#modal-body-sm').html(resp);
            $('#smallModal').modal('show');
            if (param == 1) {
                $('#btn-footer-sm').attr("onclick", "refreshNegocio('crm','tabla.php'," + param + "," + id + ")");
            } else if (param == 2) {
                $('#btn-footer-sm').attr("onclick", "refreshNegocio('clientes2','perfil.php'," + param + "," + id + ")");
            }
        }
    });
}

function editarNegocio(param, id) {
    var formulario = new FormData($("#form-neg")[0]);
    $.ajax({
        url: '../crm/crm.controller.php',
        data: formulario,
        type: 'POST',
        contentType: false,
        processData: false,
        success: function(resp) {
            $('#largeModal').modal('hide');
            $('#modal-title-sm').html('Información');
            $('#modal-body-sm').html(resp);
            $('#smallModal').modal('show');
            if (param == 1) {
                $('#btn-footer-sm').attr("onclick", "refreshNegocio('crm','tabla.php'," + param + "," + id + ")");
            } else if (param == 2) {
                $('#btn-footer-sm').attr("onclick", "refreshNegocio('clientes2','perfil.php'," + param + "," + id + ")");
            } else if (param == 3) {
                $('#btn-footer-sm').attr("onclick", "refreshNegocio('crm','negocios.php', 2," + id + ")");
            }
        }
    });
}

function refreshNegocio(file, table, param, id) {
    if (param == 1) {
        filtro('fec_crea,tip_pro,id_est,todos', '../crm/tabla.php');
        $.ajax({
            url: '../' + file + '/' + table,
            type: 'POST',
            data: {
                resp: 'cerrar'
            },
            success: function(resp) {
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

/*---------------Transacciones----------------*/

function modalTransaccion(resp, id_neg, id_cli, id_tran, param) {
    if (resp == 10) {
        $('#modal-title-lg').html('Nueva Actividad De Cliente');
    } else if (resp == 11) {
        $('#modal-title-lg').html('Editar Actividad De Cliente');
    } else if (resp == 12) {
        $('#modal-title-lg').html('Eliminar Actividad De Cliente');
    }
    $.ajax({
        url: '../crm/form2.php',
        type: 'POST',
        data: {
            resp: resp,
            id_neg: id_neg,
            id_cli: id_cli
        },
        success: function(respHtml) {
            if (resp == 10 || resp == 11) {
                $('#modal-body-lg').html(respHtml);
            } else if (resp == 12) {
                $('#modal-body-lg').html('¿Estas seguro de eliminar la Actividad De Cliente #' + id_tran + "?");
            }
        }
    });
    //tipoTra(2);
    $.ajax({
        url: '../crm/boton.php',
        type: 'POST',
        data: {
            resp,
            param,
            id_neg,
            id_cli,
            id_tran
        },
        success: function(respHtml) {
            $('#modal-footer-lg').html(respHtml);
        }
    });
}

function crearTransaccion(param, id) {
    var formulario = new FormData($("#form-tran")[0]);
    $.ajax({
        url: '../crm/crm.controller.php',
        data: formulario,
        type: 'POST',
        contentType: false,
        processData: false,
        success: function(resp) {
            $('#largeModal').modal('hide');
            $('#modal-title-sm').html('Información');
            $('#modal-body-sm').html(resp);
            $('#smallModal').modal('show');
            if (param == 1) {
                $('#btn-footer-sm').attr("onclick", "refreshTransaccion('clientes2','perfil.php'," + id + ")");
            } else if (param == 2) {
                $('#btn-footer-sm').attr("onclick", "refreshTransaccion('crm','negocios.php'," + id + ")");
            }
        }
    });
}

function eliminarTransaccion(param, id) {
    $.ajax({
        url: '../crm/crm.controller.php',
        data: {
            id: id,
            action: 'dltTransaccion'
        },
        type: 'POST',
        contentType: false,
        processData: false,
        success: function(resp) {
            $('#largeModal').modal('hide');
            $('#modal-title-sm').html('Información');
            $('#modal-body-sm').html(resp);
            $('#smallModal').modal('show');
            if (param == 1) {
                $('#btn-footer-sm').attr("onclick", "refreshTransaccion('clientes2','perfil.php'," + id + ")");
            } else if (param == 2) {
                $('#btn-footer-sm').attr("onclick", "refreshTransaccion('crm','negocios.php'," + id + ")");
            }
        }
    });
}

function refreshTransaccion(file, table, id) {
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

/*---------------Funciones----------------*/

function tipoTra(tipo) {
    $.ajax({
        url: '../crm/form3.php',
        type: 'POST',
        data: {
            tipo
        },
        success: function(respHtml) {
            $('#transacc').html(respHtml);
            $('#crear').removeAttr("disabled");
        }
    });
}

function buscarCliente() {
    $("#nom_cli").autocomplete({
        source: '../autocomplete/clientes2/buscador.php',
        minLength: 3,
        select: function(event, ui) {
            $("#nom_cli").attr('value', ui.item.nom_cli);
            $("#id_cli").attr('value', ui.item.id_cli);
            $('#crear').removeAttr("disabled");
        }
    });
}

function check(param, value) {
    switch (value) {
        case 1:
            if (param == 0) {
                $('#pot_crea').attr('value', '1');
            } else {
                $('#pot_crea').attr('value', '0');
            }
            break;

        case 2:
            if (param == 0) {
                $('#cont_rea').attr('value', '1');
                $('#pot_crea').attr('checked', 'true');
                $('#pot_crea').attr('value', '1');
            } else {
                $('#cont_rea').attr('value', '0');
            }
            break;

        case 3:
            if (param == 0) {
                $('#visi_rea').attr('value', '1');
                $('#pot_crea').attr('checked', 'true');
                $('#pot_crea').attr('value', '1');
                $('#cont_rea').attr('checked', 'true');
                $('#cont_rea').attr('value', '1');
            } else {
                $('#visi_rea').attr('value', '0');
            }
            break;

        case 4:
            if (param == 0) {
                $('#cot_soli').attr('value', '1');
                $('#pot_crea').attr('checked', 'true');
                $('#pot_crea').attr('value', '1');
                $('#cont_rea').attr('checked', 'true');
                $('#cont_rea').attr('value', '1');
                $('#visi_rea').attr('checked', 'true');
                $('#visi_rea').attr('value', '1');
            } else {
                $('#cot_soli').attr('value', '0');
            }
            break;

        case 5:
            if (param == 0) {
                $('#ped_rea').attr('value', '1');
                $('#pot_crea').attr('checked', 'true');
                $('#pot_crea').attr('value', '1');
                $('#cont_rea').attr('checked', 'true');
                $('#cont_rea').attr('value', '1');
                $('#visi_rea').attr('checked', 'true');
                $('#visi_rea').attr('value', '1');
                $('#cot_soli').attr('checked', 'true');
                $('#cot_soli').attr('value', '1');
            } else {
                $('#ped_rea').attr('value', '0');
            }
            break;

        case 6:
            if (param == 0) {
                $('#neg_per').attr('value', '1');
                $('#pot_crea').attr('checked', 'true');
                $('#pot_crea').attr('value', '1');
                $('#cont_rea').attr('checked', 'true');
                $('#cont_rea').attr('value', '1');
                $('#visi_rea').attr('checked', 'true');
                $('#visi_rea').attr('value', '1');
                $('#cot_soli').attr('checked', 'true');
                $('#cot_soli').attr('value', '1');
                $('#ped_rea').attr('checked', 'true');
                $('#ped_rea').attr('value', '1');
            } else {
                $('#neg_per').attr('value', '0');
            }
            break;

        default:
            break;
    }
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

function selFiltroCrm(value) {
    switch (value) {
        case '0':
            $('#filTipPro').attr("style", "display: none");
            $('#filFecCrea').attr("style", "display: none");
            $('#filEst').attr("style", "display: none");
            break;
        case '1':
            $('#filTipPro').removeAttr("style");
            $('#filFecCrea').attr("style", "display: none");
            $('#filEst').attr("style", "display: none");
            break;
        case '2':
            $('#filFecCrea').removeAttr("style");
            $('#filTipPro').attr("style", "display: none");
            $('#filEst').attr("style", "display: none");
            break;
        case '3':
            $('#filEst').removeAttr("style");
            $('#filTipPro').attr("style", "display: none");
            $('#filFecCrea').attr("style", "display: none");
            break;
        default:
            break;
    }
}

function ocultar(param, value) {
    if (value == 0) {
        $('#' + param).attr("style", "display: none");
        $('#hide-' + param).attr("onclick", "ocultar('" + param + "', 1)");
        $('#icon-hide-' + param).attr("class", "fa-solid fa-eye");
    } else {
        $('#' + param).removeAttr("style");
        $('#hide-' + param).attr("onclick", "ocultar('" + param + "', 0)");
        $('#icon-hide-' + param).attr("class", "fa-solid fa-eye-slash");
    }
}