function newSolici(resp, title, url) {
    $('#modal-title-lg').html(title);
    if (url != '') {
        $.ajax({
            url: url,
            type: 'POST',
            data: { resp },
            success: function(respHtml) {
                $('#modal-body-lg').html(respHtml);
            }
        });
    }
    $.ajax({
        url: '../indicadores/boton.php',
        type: 'POST',
        data: { resp },
        success: function(respHtml) {
            $('#modal-footer-lg').html(respHtml);
        }
    });
}

function agregarCrm() {
    var certCon = $("#certCon").val();
    var copRu = $("#copRu").val();
    var refBan = $("#refBan").val();
    var form_cre = $("#form_cre").val();
    if (certCon != "" && copRu != "" && refBan != "" && form_cre != "") {
        if ($("#form-crm input[name='tipCli']:radio").is(':checked') &&
            $("#form-crm input[name='reten']:radio").is(':checked')
        ) {
            var formuIngComer = new FormData($("#form-crm")[0]);
            for (var value of formuIngComer.values()) {
                console.log(value);
            }
            if (validarCampos('form-crm') == 0) {
                $.ajax({
                    url: '../creditoV2/credito.controller.php',
                    data: formuIngComer,
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    success: function(resp) {
                        $('#largeModal').modal('hide');
                        $('#modal-title-sm').html('Crear Solicitud');
                        $('#modal-body-sm').html(resp);
                        $('#smallModal').modal('show');
                        $('#modal-footer-sm').html('<a href="../creditoV2/index.php" class="btn btn-default">Cerrar</a>');
                    }
                });
            }
        } else {
            if ($("#form-crm input[name='tipCli']:radio").is(':checked')) { var tipCli = ""; } else { var tipCli = " Tipo de Cliente - "; }
            if ($("#form-crm input[name='reten']:radio").is(':checked')) { var reten = ""; } else { var reten = " Retención en la fuente - "; }

            var text = " Los campos";
            var text2 = " no pueden estar vacios";
            alert(text.concat(tipCli, reten, text2));
        }
    } else {
        if (certCon != "") { var certCon = ""; } else { var certCon = " Certificado de Constitución y Gerencia con Fecha - "; }
        if (copRu != "") { var copRu = ""; } else { var copRu = " Copia del Rut - "; }
        if (refBan != "") { var refBan = ""; } else { var refBan = " Referencia Bancaria -"; }
        if (form_cre != "") { var form_cre = ""; } else { var form_cre = "Formulario de solicitud de credito"; }
        var texta = " Los archivos ";
        var texta2 = " no pueden estar vacios";

        alert(texta.concat(certCon, copRu, refBan, form_cre, texta2));
    }
}


function EditarCrm(id_sol, id_cli, rol, id_est) {
    $('#modal-title-lg').html("Resultado de Estudio de Credito");
    $.ajax({
        url: '../creditoV2/tabsForm.php',
        type: 'POST',
        data: { resp: 2, id_sol: id_sol, id_cli: id_cli, rol: rol, id_est: id_est },
        success: function(resp) {
            $('#modal-body-lg').html(resp);
        }
    });
    $.ajax({
        url: '../creditoV2/boton.php',
        type: 'POST',
        data: { resp: 2 },
        success: function(boton) {
            $('#modal-footer-lg').html(boton);
            $('#btnpermiti1').attr('onclick', 'confirmPerc(' + id_sol + ',4);');

        }
    });
}

function modificarCrm() {
    var formuIngComer = new FormData($("#form-crm")[0]);
    for (var value of formuIngComer.values()) {
        console.log(value);
    }
    $.ajax({
        url: '../creditoV2/credito.controller.php',
        data: formuIngComer,
        type: 'POST',
        contentType: false,
        processData: false,
        success: function(resp) {
            $('#error-validation').html(resp);
            $('#largeModal').modal('hide');
            $('#modal-title-sm').html('Solicitud Actualizada');
            $('#modal-body-sm').html(resp);
            $('#smallModal').modal('show');
            $('#btn-footer-sm').html('<button type="button" class="btn btn-default" onclick="refreshTableCrm()" data-bs-dismiss="modal">Cerrar</button>');
        }
    });
}

function EditarSol(id_sol, id_cli, rol, id_est) {
    $('#modal-title-lg').html("Resultado de Estudio de Credito");
    $.ajax({
        url: '../creditoV2/tabsForm.php',
        type: 'POST',
        data: { resp: 3, id_sol: id_sol, id_cli: id_cli, rol: rol, id_est: id_est },
        success: function(resp) {
            $('#modal-body-lg').html(resp);
            $('#btnModificar').attr('onclick', 'actualizarSol(' + id_sol + ')');
            calcular();
        }
    });
    $.ajax({
        url: '../creditoV2/boton.php',
        type: 'POST',
        data: { resp: 3 },
        success: function(boton) {
            $('#modal-footer-lg').html(boton);
            $('#btnpermi').attr('onclick', 'confirmPerc(' + id_sol + ',3);');
        }
    });
}


function actualizarSol() {
    var formuIngComer = new FormData($("#form-crm")[0]);
    for (var value of formuIngComer.values()) {
        console.log(value);
    }
    $.ajax({
        url: '../creditoV2/credito.controller.php',
        data: formuIngComer,
        type: 'POST',
        contentType: false,
        processData: false,
        success: function(resp) {
            $('#error-validation').html(resp);
            $('#largeModal').modal('hide');
            $('#modal-title-sm').html('Solicitud Aprobada');
            $('#modal-body-sm').html(resp);
            $('#smallModal').modal('show');
            $('#btn-footer-sm').html('<button type="button" class="btn btn-default" onclick="refreshTableCrm()" data-bs-dismiss="modal">Cerrar</button>');

        }
    });
}


function mostrarCrm(id_sol, id_est) {
    $('#modal-title-lg').html('Información de la Solicitud ');
    $.ajax({
        url: '../creditoV2/tabsForm.php',
        data: { resp: 5, id_sol: id_sol, id_est: id_est },
        type: 'POST',
        success: function(resp) {
            $('#modal-body-lg').html(resp);
            calcular();
        }
    });
    $.ajax({
        url: '../creditoV2/boton.php',
        type: 'POST',
        data: { resp: 5, id_est: id_est },
        success: function(boton) {
            $('#btn-lg').html(boton);
            $('#btnpermi2').attr('onclick', 'confirmPerc(' + id_sol + ',4);');

        }
    });
}

function actualizaCrm(id_sol, id_est) {
    $('#modal-title-lg').html('Edición de la Solicitud');
    $.ajax({
        url: '../creditoV2/tabsForm.php',
        data: { resp: 7, id_sol: id_sol, id_est: id_est },
        type: 'POST',
        success: function(resp) {
            $('#modal-body-lg').html(resp);

        }
    });
    $.ajax({
        url: '../creditoV2/boton.php',
        type: 'POST',
        data: { resp: 9, id_est: id_est },
        success: function(boton) {
            $('#modal-footer-lg').html(boton);
            $('#btnActual').attr('onclick', 'actuCrm();');

        }
    });
}

function mostrarSeg(id_sol, id_est) {
    $('#modal-title-md').html('Seguimiento de Solicitud');
    $.ajax({
        url: '../creditoV2/seguim.php',
        data: { resp: 11, id_sol: id_sol, id_est: id_est },
        type: 'POST',
        success: function(resp) {
            $('#modal-body-md').html(resp);
        }
    });
    $.ajax({
        url: '../creditoV2/boton.php',
        type: 'POST',
        data: { resp: 11, id_est: id_est },
        success: function(boton) {
            $('#modal-footer-md').html(boton);
        }
    });
}

function actuCrm() {
    var formuIngComer = new FormData($("#form-crm")[0]);
    for (var value of formuIngComer.values()) {
        console.log(value);
    }
    $.ajax({
        url: '../creditoV2/credito.controller.php',
        data: formuIngComer,
        type: 'POST',
        contentType: false,
        processData: false,
        success: function(resp) {
            $('#error-validation').html(resp);
            $('#largeModal').modal('hide');
            $('#modal-title-sm').html('Solicitud Editada');
            $('#modal-body-sm').html(resp);
            $('#smallModal').modal('show');
            $('#btn-footer-sm').html('<button type="button" class="btn btn-default" onclick="refreshTableCrm()" data-bs-dismiss="modal">Cerrar</button>');
        }
    });
}

function actualizar1Crm(id_sol, id_est) {
    $('#modal-title-lg').html('Edición de la Solicitud');
    $.ajax({
        url: '../creditoV2/tabsForm.php',
        data: { resp: 8, id_sol: id_sol, id_est: id_est },
        type: 'POST',
        success: function(resp) {
            $('#modal-body-lg').html(resp);
            calcular();
        }
    });
    $.ajax({
        url: '../creditoV2/boton.php',
        type: 'POST',
        data: { resp: 10, id_est: id_est },
        success: function(boton) {
            console.log(resp);
            $('#modal-footer-lg').html(boton);
            $('#btnActual1').attr('onclick', 'actu1Crm(' + id_sol + ');');

        }
    });
}

function actu1Crm() {
    var formuIngComer = new FormData($("#form-crm")[0]);
    for (var value of formuIngComer.values()) {
        console.log(value);
    }
    $.ajax({
        url: '../creditoV2/credito.controller.php',
        data: formuIngComer,
        type: 'POST',
        contentType: false,
        processData: false,
        success: function(resp) {
            $('#error-validation').html(resp);
            $('#largeModal').modal('hide');
            $('#modal-title-sm').html('Solicitud Editada');
            $('#modal-body-sm').html(resp);
            $('#smallModal').modal('show');
            $('#btn-footer-sm').html('<button type="button" class="btn btn-default" onclick="refreshTableCrm()" data-bs-dismiss="modal">Cerrar</button>');

        }
    });
}

function EliminarCrm(id_sol) {
    $('#modal-title-md').html('Confirmación');
    $('#modal-body-md').html('¿Está seguro de eliminar esta Solicitud?');
    $.ajax({
        url: '../creditoV2/boton.php',
        type: 'POST',
        data: { resp: 4, id_sol: id_sol },
        success: function(resp) {
            $('#modal-footer-md').html(resp);
            $('#btnEliminarcrm').attr('onclick', 'confirmEliminarcrm(' + id_sol + ')');
        }
    });
}



function confirmEliminarcrm(id_sol) {
    $('#mediumModal').modal('hide');
    $.ajax({
        url: '../creditoV2/credito.controller.php',
        data: { action: 'delete', id_sol: id_sol },
        type: 'POST',
        success: function(resp) {
            $('#modal-body-sm').html(resp);
            $('#modal-title-sm').html('Aviso');
            $('#smallModal').modal('show');
            $('#modal-footer-sm').html('<a class="btn btn-default" href="../creditoV2/index.php" data-bs-dismiss="modal">Cerrar</a>');;
            $.ajax({
                url: '../creditoV2/boton.php',
                type: 'POST',
                data: { resp: 4 },
                success: function(resp) {
                    $('#btn-footer-sm').html(resp);
                    $('#btnEliminarcrm').attr('onclick', 'confirmEliminarcrm(' + id_sol + ')');
                }
            });
        }
    });
}

function rechazarCrm(id_sol) {
    var obs_aprob = $('#obs_aprob').val();
    if ($("#form-crm input[id='caurec']:checkbox").is(':checked')) {
        var caurec = $('#caurec').val();
    } else if ($("#form-crm input[id='caurep']:checkbox").is(':checked')) {
        var caurec = $('#caurep').val();
    } else if ($("#form-crm input[id='caumon']:checkbox").is(':checked')) {
        var caurec = $('#caumon').val();
    }
    var r = confirm("Estas seguro rechazar ésta solicitud?");
    if (r == true) {
        $.ajax({
            url: '../creditoV2/credito.controller.php',
            data: { id_sol: id_sol, obs_aprob: obs_aprob, action: 'rechazar', caurec: caurec },
            type: 'POST',
            success: function(resp) {
                $('#largeModal').modal('hide');
                $('#modal-title-sm').html('Aviso');
                $('#modal-body-sm').html(resp);
                $('#smallModal').modal('show');
                $('#btn-footer-sm').html('<button type="button" class="btn btn-default" onclick="refreshTableCrm()" data-bs-dismiss="modal">Cerrar</button>');
            }
        });
    }
}

function confirmPerc(id_sol, param) {
    if (param == 1) {
        var obser_perm = $('textarea#observa').val();
        console.log(obser_perm);
        var data = { action: 'edicion2', id_sol: id_sol, obser_perm: obser_perm };
    } else if (param == 2) {
        var obser_perm = $('textarea#observa').val();
        console.log(obser_perm);
        var data = { action: 'edicion', id_sol: id_sol, obser_perm: obser_perm };
    } else {
        var data = { id_sol: id_sol };
    }
    if (validarCampos('observa') == 0) {
        $.ajax({
            url: '../creditoV2/credito.controller.php',
            data: data,
            type: 'POST',
            success: function(resp) {
                if (param == 3 || param == 4) {
                    $('#modal-body-sm').html('<br>¿A que rol deseas habilitar el permiso? <br><br><form id="observa" > <label for="observa">Observacion</label><textarea class="form-control" id="observa" name="observa" rows="3"  placeholder="LLena este espacio para justificar el permiso" required></textarea></form>');
                } else {
                    $('#modal-body-sm').html(resp);
                    $('#btn-footer-sm').html('<button type="button" class="btn btn-default" onclick="refreshTableCrm()" data-bs-dismiss="modal">Cerrar</button>');
                    $('#largeModal').modal('hide');
                }
                $('#modal-title-sm').html('Aviso');
                $('#smallModal').modal('show');
                $('#btn-footer-sm').html('<button type="button" class="btn btn-default" onclick="refreshTableCrm()" data-bs-dismiss="modal">Cerrar</button>');
                $('#btn-footer-sm').html('<a href="../creditoV2/index.php" class="btn btn-default">Cerrar</a>');
                if (param == 3 || param == 4) {
                    if (param == 3) {
                        var resp1 = { resp: 8 };
                    } else if (param == 4) {
                        var resp1 = { resp: 7 };
                    } else {
                        var resp1 = { resp: 20 };
                    }
                    $.ajax({
                        url: '../creditoV2/boton.php',
                        type: 'POST',
                        data: resp1,
                        success: function(resp) {
                            $('#btn-footer-sm').html(resp);
                            $('#btnhabcon').attr('onclick', 'confirmPerc(' + id_sol + ',1);');
                            $('#btnpermiti2').attr('onclick', 'confirmPerc(' + id_sol + ',2);');
                            $('#btnpermiti3').attr('onclick', 'confirmPerc(' + id_sol + ',2);');
                        }
                    });
                }
            }
        });
    }
}

function refreshTableCrm() {
    var reg = $('#reg').val();
    var id = $('#id').val();
    var rol = $('#rol').val();
    $.ajax({
        url: '../creditoV2/tabla2.php',
        type: 'POST',
        data: { resp: 1, reg: reg, id: id, rol: rol },
        success: function(resp) {
            $('#content-table').html(resp);
        }
    });
}

function remove(id) {
    if (id == 1) {
        $('#btnMen1').remove();
        $('#desp2').html('');
        $('#btnMas').attr('onclick', 'desp2()');
    } else {
        $('#desp3').html('');
        $('#btnMen2').remove();
        $('#btnMas').attr('onclick', 'desp3()');
    }
}

function desp2() {
    $.ajax({
        url: '../creditoV2/despacho.php',
        type: 'POST',
        data: { resp: 1 },
        success: function(resp) {
            $('#desp2').html(resp);
            $('#btnMas').attr('onclick', 'desp3()');
            $('#pun_u').attr('name', 'pun_u2');
            $('#pun_u').attr('id', 'pun_u2');
            $('#ciu').attr('name', 'ciu2');
            $('#ciu').attr('id', 'ciu2');
            $('#tel_fij').attr('name', 'tel_fij2');
            $('#tel_fij').attr('id', 'tel_fij2');
            $('#hor').attr('name', 'hor_2');
            $('#hor').attr('id', 'hor_2');
            $('#hora').attr('name', 'hor2_2');
            $('#hora').attr('id', 'hor2_2');
            $('#btnMen11').html('<div class="col-md-1 col-sm-12"><button id="btnMen1" type="button" class="btn btn-sm btn-danger" onclick="remove(1);"><i class="fa fa-remove"></i></button></div>');
        }
    });
}

function desp3() {
    $.ajax({
        url: '../creditoV2/despacho.php',
        type: 'POST',
        data: { resp: 1 },
        success: function(resp) {
            $('#desp3').html(resp);
            $('#btnMas').removeAttr('onclick');
            $('#pun_u').attr('name', 'pun_u3');
            $('#pun_u').attr('id', 'pun_u3');
            $('#ciu').attr('name', 'ciu3');
            $('#ciu').attr('id', 'ciu3');
            $('#tel_fij').attr('name', 'tel_fij3');
            $('#tel_fij').attr('id', 'tel_fij3');
            $('#hor').attr('name', 'hor_3');
            $('#hor').attr('id', 'hor_3');
            $('#hora').attr('name', 'hor3_3');
            $('#hora').attr('id', 'hor3_3');
            $('#btnMen22').html('<div class="col-md-1 col-sm-12"><button id="btnMen1" type="button" class="btn btn-sm btn-danger" onclick="remove(2);"><i class="fa fa-remove"></i></button></div>');
        }
    });
}

function autoCre(param) {
    if(param==1){
        $("#nom_clie").autocomplete({
            source: '../autocomplete/creditov2/buscador.php',
            minLength: 3,
            select: function(event, ui) {
                $("#id_nit").val(ui.item.num_doc);
                $("#nom_com").val(ui.item.con_cli);
                $("#celCli").val(ui.item.tel_cli);
                $("#dirEmp").val(ui.item.dir_cli);
                $("#correo").val(ui.item.eml_cli);
                $("#telcon").val(ui.item.tel_cli);     
            }
        });
    }else if (param==2){
        $("#nomAse").autocomplete({
            source: '../autocomplete/credito/buscador2.php',
            minLength: 3,
            select: function(event, ui) {
                $("#nomAse").val(ui.item.nom_usu);
                $("#aseCom").val(ui.item.id_usu);
                $("#aseCom").attr('readonly', '');
    
            }
        });
    }else if(param ==3){
        $("#nomSac").autocomplete({
            source: '../autocomplete/credito/buscador4.php',
            minLength: 3,
            select: function(event, ui) {
                $("#nomSac").val(ui.item.nom_usu);
                $("#aseSac").val(ui.item.id_usu);
                $("#aseSac").attr('readonly', '');
    
            }
        });

    }
}


function calcular() {
    if ($('#ac_cor').val() != "") {
        var activo1 = $('#ac_cor').val();
        $('#act_raz').attr("value", activo1);
        $('#ac_pas').attr("value", activo1);
        if ($('#inv').val() != "") {
            var inv = $('#inv').val();
            var restaA = parseInt(activo1) - parseInt(inv);
            $('#act_raz2').attr("value", restaA);
        }
    }
    if ($('#pas_cor').val() != "") {
        var pasivo1 = $('#pas_cor').val();
        $('#pas_raz').attr("value", pasivo1);
        $('#pas_raz2').attr("value", pasivo1);
        $('#pas_ac').attr("value", pasivo1);
        if ($('#inv').val() != "") {
            var divacid = parseInt(restaA) / parseInt(pasivo1);
            $('#res2').attr("value", divacid);
            $('#pas_act2').attr("value", divacid);
        }
    }
    if ($('#ac_cor').val() != "" && $('#pas_cor').val() != "") {
        var division1 = parseInt(activo1) / parseInt(pasivo1);
        var rescap = parseInt(activo1) - parseInt(pasivo1);
        $('#res').attr("value", division1);
        $('#pas_act').attr("value", division1);
        $('#to_pas').attr("value", rescap);
        $('#des_pas').attr("value", rescap);
    }
    if ($('#ac_cor1').val() != "") {
        var act1 = $('#ac_cor1').val();
        $('#act_raz1').attr("value", act1);
        $('#ac_pas1').attr("value", act1);
        if ($('#inv1').val() != "") {
            var inv1 = $('#inv1').val();
            var rest = parseInt(act1) - parseInt(inv1);
            $('#act_raz3').attr("value", rest);
        }
    }
    if ($('#pas_cor1').val() != "") {
        var pas1 = $('#pas_cor1').val();
        $('#pas_raz1').attr("value", pas1);
        $('#pas_raz3').attr("value", pas1);
        $('#pas_ac1').attr("value", pas1);
        if ($('#inv1').val() != "") {
            var divacid2 = parseInt(rest) / parseInt(pas1);
            $('#res3').attr("value", divacid2);
            $('#pas_act3').attr("value", divacid2);
        }
    }
    if ($('#ac_cor1').val() != "" && $('#pas_cor1').val() != "") {
        var divisi = parseInt(act1) / parseInt(pas1);
        var rescap1 = parseInt(act1) - parseInt(pas1);
        $('#res1').attr("value", divisi);
        $('#pas_act1').attr("value", divisi);
        $('#to_pas1').attr("value", rescap1);
        $('#des_pas1').attr("value", rescap1);
    }
    if ($('#pasi').val() != "") {
        var pasiv = $('#pasi').val();
        $('#end_raz').attr("value", pasiv);
    }

    if ($('#activ').val() != "") {
        var activ = $('#activ').val();
        $('#act_end').attr("value", activ);
    }
    if ($('#pasi').val() != "" && $('#activ').val() != "") {
        var division2 = Math.round((parseInt(pasiv) / parseInt(activ)) * 100);
        $('#res_end').attr("value", division2);
        $('#ac_acre').attr("value", division2);
    }
    if ($('#pasi1').val() != "") {
        var pasiv1 = $('#pasi1').val();
        $('#end_raz1').attr("value", pasiv1);
    }

    if ($('#activ1').val() != "") {
        var activ1 = $('#activ1').val();
        $('#act_end1').attr("value", activ1);
    }
    if ($('#pasi1').val() != "" && $('#activ1').val() != "") {
        var division3 = Math.round((parseInt(pasiv1) / parseInt(activ1)) * 100);
        $('#res_end1').attr("value", division3);
        $('#ac_acre1').attr("value", division3);
    }

    if ($('#util').val() != "") {
        var util = $('#util').val();
    }
    if ($('#ing').val() != "") {
        var ing = $('#ing').val();
        if ($('#util_an').val() != "") {
            var util_an = $('#util_an').val();
            var diviu1 = parseInt(util_an) / parseInt(ing);
            $('#porcent_ing2').attr("value", diviu1);
        }
    }
    if ($('#util').val() != "" && $('#ing').val() != "") {
        var diviutil = parseInt(util) / parseInt(ing);
        $('#porcent_ing').attr("value", diviutil);

    }
    if ($('#utilun').val() != "") {
        var utilun = $('#utilun').val();
    }

    if ($('#ing1').val() != "") {
        var ing1 = $('#ing1').val();
        if ($('#util_an1').val() != "") {
            var util_an1 = $('#util_an1').val();
            var div = parseInt(util_an1) / parseInt(ing1);
            $('#porcent_ing3').attr("value", div);
        }
    }
    if ($('#utilun').val() != "" && $('#ing1').val() != "") {
        var diviutil1 = parseInt(utilun) / parseInt(ing1);
        $('#porcent_ing1').attr("value", diviutil1);
    }
}

$(function() {
    $("#search").autocomplete({
        source: '../autocomplete/credito/buscador3.php',
        minLength: 3,
        select: function(event, ui) {
            searchTable();
        }
    });
});

function crearClientcred(action) {
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
        url: '../creditoV2/boton.php',
        type: 'POST',
        data: { resp: 7 },
        success: function (resp) {
            $('#modal-footer-lg').html(resp);
        }
    });
}
