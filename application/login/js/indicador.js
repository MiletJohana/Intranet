function newIndicador(resp, title, url) {
    $('#modal-title-lg').html(title);
    if (url != '') {
        $.ajax({
            url: url,
            type: 'POST',
            data: { resp },
            success: function(respHtml) {
                $('#modal-body-lg').html(respHtml);
                if (resp != 5) {
                    if (resp == 20 || resp == 21 || resp == 26 || resp == 32 || resp == 33) {
                        //$('#largeModal-dialog').attr('style', 'min-width:800px');
                    } else {
                        //$('#largeModal-dialog').attr('style', 'min-width:1200px');
                        $('#agregarDes').attr('disabled', "true");
                    }
                } else if (resp != 12) {
                    //$('#largeModal-dialog').attr('style', 'min-width:1200px');
                }
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

function crear(param, file, table) {
    if (validarCampos(param) == 0) {
        var formulario = new FormData($("#" + param)[0]);
        $.ajax({
            url: '../indicadores/indicador.controller.php',
            data: formulario,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function(resp) {
                $('#largeModal').modal('hide');
                $('#modal-title-sm').html('Solicitud Creada');
                $('#modal-body-sm').html(resp);
                $('#smallModal').modal('show');
                if (file == 'capacitaciones') {
                    $('#btn-footer-sm').attr('onclick', 'refreshTableInd(' + "'" + file + "'" + ',' + "'" + table + "'" + ')');
                } else if (table == "tableInd.php") {
                    $('#btn-footer-sm').attr('onclick', 'refreshFunctions()');
                } else {
                    $('#btn-footer-sm').attr('onclick', 'refreshTableInd("' + file + '","' + table + '")');
                }
            }
        });
    }
}

function crear2(param, file, table) {
    if (validarCampos(param) == 0) {
        var formulario = new FormData($("#" + param)[0]);
        $.ajax({
            url: '../indicadores/indicador.controller.php',
            data: formulario,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function(resp) {
                window.open(resp, '_blank');
                $('#largeModal').modal('hide');
                $('#modal-title-sm').html('Crear Certificación');
                $('#modal-body-sm').html('Certificación creada correctamente.');
                $('#smallModal').modal('show');
                $('#btn-footer-sm').attr('onclick', 'refreshTableInd("' + file + '","' + table + '")');
            }
        });
    }
}

function IndPagos(param, form, file, table) {
    if (validarCampos(form) == 0) {
        var fecha = document.getElementsByName('fech_pag' + param + '[]');
        var fech = [];
        for (var i = 0; i < fecha.length; i++) {
            fech.push(fecha[i].value);
            console.log(fecha[i].value);
        }
        $.ajax({
            url: '../indicadores/indicador.controller.php',
            type: 'POST',
            data: { fech, action: 'pagos', param },
            success: function(data) {
                $('#largeModal').modal('hide');
                $('#modal-title-sm').html('Solicitud Actualizada');
                $('#modal-body-sm').html(data);
                $('#smallModal').modal('show');
                $('#btn-footer-sm').attr('onclick', 'refreshTableInd("' + file + '","' + table + '")');
            }
        });
    }
}

function editarInd(resp, title, url, edit, param, carpeta, table) {
    $('#modal-title-lg').html(title);
    $.ajax({
        url: url,
        type: 'POST',
        data: { resp, edit: edit },
        success: function(respHtml) {
            console.log(edit);
            $('#modal-body-lg').html(respHtml);
        }
    });
    $.ajax({
        url: '../indicadores/boton.php',
        type: 'POST',
        data: { resp },
        success: function(respHtml) {
            $('#modal-footer-lg').html(respHtml);
            $('#editar').attr('onclick', "modInd('" + param + "','" + carpeta + "','" + table + "')");
        }
    });
}

function editarForm(resp, title, url, edit, carg, param, file, table) {
    $('#modal-title-lg').html(title);
    $.ajax({
        url: url,
        type: 'POST',
        data: { resp, edit: edit, carg: carg },
        success: function(respHtml) {
            $('#modal-body-lg').html(respHtml);
        }
    });
    $.ajax({
        url: '../indicadores/boton.php',
        type: 'POST',
        data: { resp },
        success: function(respHtml) {
            $('#modal-footer-lg').html(respHtml);
            $('#editar').attr('onclick', "modInd('" + param + "','" + file + "','" + table + "')");
        }
    });
}

function editarCert(id_usu, file, table) {
    $.ajax({
        url: '../indicadores/indicador.controller.php',
        type: 'POST',
        data: { action: 'certif3', id_usu: id_usu },
        success: function(resp) {
            window.open(resp, '_blank');
            $('#largeModal').modal('hide');
            $('#modal-title-sm').html('Crear Certificación');
            $('#modal-body-sm').html('<div align="center"><br> Certificación creada correctamente.<br><br></div>');
            $('#btn-footer-sm').attr('onclick', 'refreshTableInd("' + file + '","' + table + '")');
        }
    });
}

function form(params) {
    if (params == 1) {
        var mes = $('#mes').val();
        $('#formExcel').append('<input type="hidden" name="mes" id="mes" value="' + mes + '">');
        $('#formExcel').submit();
    } else if (params == 2) {
        var mes = $('#mes').val();
        $('#formExcelAnual').append('<input type="hidden" name="mes" id="mes" value="' + mes + '">');
        $('#formExcelAnual').submit();
    }
}



function modInd(param, carpeta, table) {
    if (validarCampos(param) == 0) {
        var formulario = new FormData($("#" + param)[0]);
        $.ajax({
            url: '../indicadores/indicador.controller.php',
            data: formulario,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function(resp) {
                $('#largeModal').modal('hide');
                $('#modal-title-sm').html('Actualizar');
                $('#modal-body-sm').html(resp);
                $('#smallModal').modal('show');
                $('#btn-footer-sm').attr('onclick', 'refreshTableInd(' + "'" + carpeta + "'" + ',' + "'" + table + "'" + ')');
            }
        });
    }
}

function cargos(para, value) {
    console.log(value);
    console.log(para);
    if (para == 1) {
        $.ajax({
            url: '../indicadores/indicador.controller.php',
            type: 'POST',
            data: { action: 'cargo', value: value },
            success: function(resp) {
                $('#car_per').html(resp);
                $('#id_car').html(resp);
            }
        });
    } else if (para == 2) {
        $.ajax({
            url: '../indicadores/indicador.controller.php',
            type: 'POST',
            data: { action: 'cargo', para: para },
            success: function(resp) {}
        });
    }
}

function usuario(value) {
    $.ajax({
        url: '../indicadores/indicador.controller.php',
        type: 'POST',
        data: { action: 'usuario', value: value },
        success: function(resp) {
            $('#usu_liq').html(resp);
        }
    });
}

function aceptado(id_solC, carg_col, file, table) {
    var action = "aceptado";
    $.ajax({
        url: '../indicadores/indicador.controller.php',
        type: 'POST',
        data: { id_solC, action, carg_col },
        success: function(resp) {
            console.log(resp);
            if (resp == 1) {
                refreshTableInd(file, table);
                $("#estAp" + id_solC).attr("disabled", "");
                $('#respPer').html('<br><br></brt><div class="col-md-12 alert alert-success"> <a href="#" class="close" data-bs-dismiss="alert" aria-label="close">×</a> Seguimiento ' + id_solC + ' actualizado correctamente </a> </div>');
            } else {
                $('#resp').html(resp);
                $('#respPer').html('<br><br><div class="col-md-12 alert alert-danger"> No se ha podido modificar ' + resp + '</div>');
            }
        }
    });
}

function aceptado2(id, file, table) {
    var action = "aceptado2";
    $.ajax({
        url: '../indicadores/indicador.controller.php',
        type: 'POST',
        data: { id_liqui: id, action },
        success: function(resp) {
            if (resp == 1) {
                refreshTableInd(file, table);
                $("#estAp" + id).attr("disabled", "");
                $('#resp').html('<div class="col-md-12 alert alert-success" style="margin-top:15px;"> <a href="#" class="close" data-bs-dismiss="alert" aria-label="close">×</a> Pago actualizado correctamente</a> </div>');
            } else {
                $('#resp').html(resp);
                $('#resp').html('<div class="col-md-12 alert alert-danger" style="margin-top:15px;"> No se ha podido modificar' + resp + '</div>');
            }
        }
    });
}

function aceptado3(id_relPag, file, table) {
    var action = "aceptadoFech";
    $.ajax({
        url: '../indicadores/indicador.controller.php',
        type: 'POST',
        data: { id_relPag: id_relPag, action },
        success: function(resp) {
            if (resp == 1) {
                refreshTableInd(file, table);
                $("#estAp" + id_relPag).attr("disabled", "");
                $('#resp').html('<div class="col-md-12 alert alert-success" style="margin-top:15px;"> <a href="#" class="close" data-bs-dismiss="alert" aria-label="close">×</a> Pago actualizado correctamente</a> </div>');
            } else {
                $('#resp').html(resp);
                $('#resp').html('<div class="col-md-12 alert alert-danger" style="margin-top:15px;"> No se ha podido modificar' + resp + '</div>');
            }
        }
    });
}

function cumProces(param, id) {
    $.ajax({
        url: '../indicadores/indicador.controller.php',
        type: 'POST',
        data: { action: 'procesos', param: param, id: id },
        succes: function(resp) {
            if (param == 1) {
                $("est_entre" + id).attr("disabled", "");
            } else if (param == 2) {
                $("est_prue" + id).attr("disabled", "");
            } else if (param == 3) {
                $("est_ana" + id).attr("disabled", "");
            } else if (param == 4) {
                $("est_poli" + id).attr("disabled", "");
            } else if (param == 5) {
                $("est_vis" + id).attr("disabled", "");
            }
        }
    });
}

function aceptProcess() {
    $.ajax({
        url: '../indicadores/indicador.controller.php',
        type: 'POST',
        data: { action: 'unique' },
        success: function(resp) {
            if (resp == 1) {
                $('#largeModal').modal('hide');
                $('#modal-title-sm').html('Proceso Actualizado');
                $('#modal-body-sm').html('<div align="center"> <br> Proceso Actualizado Correctamente. <br><br></div>');
                $('#smallModal').modal('show');
            } else {
                $('#largeModal').modal('hide');
                $('#modal-title-sm').html('Proceso Actualizado');
                $('#modal-body-sm').html('<div align="center"> <br> El Proceso No Pudo Actualizarse. <br><br></div>');
                $('#smallModal').modal('show')
            }
        }
    });
}

function informacion(resp, title, url, info) {
    $('#modal-title-lg').html(title);
    $.ajax({
        url: url,
        type: 'POST',
        data: { info },
        success: function(respHTML) {
            $('#modal-body-lg').html(respHTML);
            $('#largeModal-dialog').attr('style', 'min-width:1200px');
        }
    });
    $.ajax({
        url: '../indicadores/boton.php',
        type: 'POST',
        data: { resp },
        success: function(respHtml) {
            $('#modal-footer-lg').html(respHtml);
        }
    });
}

function updateTable(param, value, edit, id, action, atrib, upd, file, table) {
    // param - Si se desea realizar cambios en la tabla
    $.ajax({
        url: '../indicadores/indicador.controller.php',
        type: 'POST',
        data: { value, edit, action },
        success: function(respHTML) {
            if (respHTML == 1) {
                if (param == 1) {
                    $('#' + id).attr(atrib, upd);
                }
            }
            console.log(respHTML);
            refreshTableInd(file, table);
        }
    });
}

function fec(fec, table) {
    $.ajax({
        url: table,
        type: 'POST',
        data: { fec },
        success: function(respHTML) {
            $('#content-table').html(respHTML);
        }
    });
}

function updateAll(ids, atribs, values) {
    var id = ids.split(',');
    var atrib = atribs.split(',');
    var value = values.split(',');
    for (var i = 0; i < id.length; i++) {
        $('#' + id[i]).attr(atrib[i], value[i]);
    }
}

function filtro(params, table, title) {
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
            $('#content-table').html(respHTML);

        }
    });
}

function ajaxCheckBox(params, values, action) {
    var param = params.split(',');
    var value = values.split(',');

    if ($('#' + param[0]).is(':checked')) {
        $.ajax({
            url: '../indicadores/indicador.controller.php',
            type: 'POST',
            data: { resp: 1, action },
            success: function(respHTML) {
                $('#' + param[1]).html(respHTML);
                $('#' + param[0]).attr('value', value[1]);
            }
        });
    } else {
        $.ajax({
            url: '../indicadores/indicador.controller.php',
            type: 'POST',
            data: { resp: 2, action },
            success: function(respHTML) {
                $('#' + param[1]).html(respHTML);
                $('#' + param[0]).attr('value', value[0]);
            }
        });
    }

}

function refreshTableInd(file, table) {
    $.ajax({
        url: '../' + file + '/' + table,
        type: 'POST',
        data: { resp: 'cerrar' },
        success: function(resp) {
            if (table == 'tableInd.php') {
                $('#content-table').load('#tableClima');
            } else {
                $('#content-table').html(resp);
            }
        }
    });
}


function usuarios(param, value) {
    $.ajax({
        url: '../indicadores/indicador.controller.php',
        type: 'POST',
        data: { action: 'usuarios', value: value, param: param },
        success: function(resp) {
            if (param == 1) {
                $('#id_usus').html(resp);
            } else if (param == 2) {
                $('#pass').html(resp);
            }

        }
    });
}

function verificar(pass, usu) {
    $.ajax({
        type: "POST",
        url: "../indicadores/indicador.controller.php",
        data: { action: 'password', pass: pass, usu: usu },
        success: function(resp) {
            if (resp == "1") {
                $('#pass').css("border", "1px solid green");
                $('#apr').removeAttr('disabled');
                //$('#editar').removeAttr('disabled');
            } else if (resp == "2") {
                $('#pass').css("border", "1px solid red");
                $('#apr').attr('disabled', 'true');
                //$('#editar').attr('disabled', 'true');
            }
        }
    });
}

function remCuo(c) {
    $('#tabla tr').eq(c + 1).remove();
}

function sumCuo(cuo) {
    $('#total').html('');
    val = [];
    for (let i = 0; i < cuo; i++) {
        val.push($('#cuota' + i).val());
        //console.log(val[i]);
    }
    total = 0;
    for (let s = 0; s < val.length; s++) {
        total = parseInt(total) + parseInt(val[s]);
    }
    $('#total').html((total / 1000).toFixed(3));
    des = $('#val_desc').val();
    if (total == des) {
        $('#ttotal').attr('style', 'color: #005200;');
        $('#agregarDes').removeAttr('disabled');
        $('#editar').removeAttr('disabled');
    } else {
        $('#ttotal').attr('style', 'color: #ff0000;');
        $('#agregarDes').attr('disabled', 'true');
        $('#editar').attr('disabled', 'true');
    }
}

function cumplirAct(id) {
    $.ajax({
        url: '../indicadores/indicador.controller.php',
        type: 'POST',
        data: { action: 'cumplir', id: id },
        success: function(resp) {
            refreshTableInd('capacitaciones', 'tabla.php');
            if (resp == 1) {
                $('#alertB').html('<div class="col-md-12 alert alert-success"> <a href="#" class="close" data-bs-dismiss="alert" aria-label="close">×</a> Actividad #' + id + ' actualizada correctamente </div>');
            } else {
                $('#alertB').html('<div class="col-md-12 alert alert-danger"> <a href="#" class="close" data-bs-dismiss="alert" aria-label="close">×</a> La actividad #' + id + ' no fue actualizada correctamente </div>');
            }
        }
    });
}

function cambiarEstado(id, est, param) {
    if (param == 1) {
        $.ajax({
            url: '../indicadores/indicador.controller.php',
            type: 'POST',
            data: { action: 'cambiarEs', id: id, est: est },
            success: function(resp) {
                snackbar('Descuento ' + id + ' actualizado correctamente <a class="btn btn-info" data-bs-toggle="modal" data-bs-target="#mediumModal" onclick="ver(' + id + ',' + "'" + 'Información del Seguimiento' + "', '" + "../descuentos/segDesc.php" + "' , " + id + ');">Ver</a>', "snackbar", 0, true);
                $("#pass").attr("disabled", "");
                $("#apr").attr("disabled", "");
                $("#modal-footer-lg").html("");
                //  $("#modal-footer-lg").html('<button type="button" class="btn btn-default" data-bs-dismiss="modal" onclick="refreshTableInd(' + "'" + "descuentos" + "'" + ',' + "'" + "tabla.php" + "'" + ')">Cerrar</button>');
            }
        });
    } else {
        $.ajax({
            url: '../indicadores/indicador.controller.php',
            type: 'POST',
            data: { action: 'cambiarEs', id: id, est: est },
            success: function() {
                refreshTableInd('descuentos', 'tabla2.php');
                snackbar('Descuento ' + id + ' actualizado correctamente <a class="btn btn-info" data-bs-toggle="modal" data-bs-target="#mediumModal" onclick="ver(' + id + ',' + "'" + 'Información del Seguimiento' + "', '" + "../descuentos/segDesc.php" + "'" + ')">Ver</a>', "snackbar", 0, true);
            }
        });
    }
}

function activarCalcular(u) {
    if ($('#val_desc').val() > 1000) {
        if (u == 1) {
            if ($('#cant').val() > 0 && $('#cant').val() < 121) {
                $('#calcular').removeAttr('disabled');
            } else {
                $('#calcular').attr('disabled', 'true');
            }
        } else {
            if ($('#cant').val() > 0 && $('#cant').val() < 4) {
                $('#calcular').removeAttr('disabled');
            } else {
                $('#calcular').attr('disabled', 'true');
            }
        }
    } else {
        $('#calcular').attr('disabled', 'true');
    }
}

function calcularCuotas(val, cuo) {
    $('#tabla').removeAttr('style');
    cant = val / cuo;
    cant = Math.round(cant);
    var date = new Date();
    var month = parseInt((date.getMonth()) + 1);
    var year = parseInt((date.getFullYear()));

    c = 0;
    for (let i = 0; i < cuo; i++) {
        anio = year;
        mes = month + c;
        if (mes == 12) {
            month = 0;
            c = 0;
            year += 1;
        }
        if (mes > 0 && mes < 10) {
            mes = "0" + mes;
        }
        if (mes == '02') {
            fecha = anio + "-" + mes + "-28";
        } else {
            fecha = anio + "-" + mes + "-30";
        }
        var tbody = document.getElementById('tabla').getElementsByTagName('tbody')[0];
        var newRow = tbody.insertRow(tbody.length),
            cell1 = newRow.insertCell(0),
            cell2 = newRow.insertCell(1);
        cell1.innerHTML = '<input type="number" required class="form-control" onkeyup="sumCuo(cant.value, this.value)" name="cuotas[]" id="cuota' + i + '" value=' + cant + '>';
        cell2.innerHTML = '<input type="date" required class="form-control" name="fechas[]" id="fecha' + i + '" value=' + fecha + '>';
        c++;
    }
    total = cant * cuo;
    var footer = document.getElementById('tabla').getElementsByTagName('tfoot')[0];
    var newRow = footer.insertRow(0);
    if (total != val) {
        newRow.innerHTML = '<td colspan="3"><h4 style="color: #ff0000;" id="ttotal"><b>Total: $</b><b id="total"">' + (total / 1000).toFixed(3) + '</b></h4></td>';
    } else {
        newRow.innerHTML = '<td colspan="3"><h4 style="color: #005200;" id="ttotal"><b>Total: $</b><b id="total"">' + (total / 1000).toFixed(3) + '</b></h4></td>';
        $('#agregarDes').removeAttr('disabled');
        $('#editar').removeAttr('disabled');
    }
    $("#calcular").attr("disabled", "disabled");
    $("#limpiar").removeAttr("disabled");
}

function cleanTable() {
    $("#tabla tbody").remove();
    $("#tabla tfoot").remove();
    $("#calcular").removeAttr("disabled");
    $("#limpiar").attr("disabled", "disabled");
    $("#agregarDes").attr("disabled", "disabled");
    var tbody = "<tbody></tbody>";
    var tfoot = "<tfoot></tfoot>";
    $("#tabla").append(tbody);
    $("#tabla").append(tfoot);
}

function habilitarOtro(val, param) {
    if (param == 0) {
        if (val == 4) {
            $("#otro_tip").removeAttr("readonly");
            $("#otro_tip").focus();
        } else {
            $("#otro_tip").attr("value", "");
            $("#otro_tip").attr("readonly", "");
            $("#met_cap").focus();
        }
    } else {
        if (val == 5) {
            $("#otro_tip").removeAttr("readonly");
            $("#otro_tip").focus();
        } else {
            $("#otro_tip").attr("value", "");
            $("#otro_tip").attr("readonly", "");
            $("#met_cap").focus();
        }
    }
}

function mostrarCorr(id, id_estSeg) {
    $('#modal-title-lg').html('Información del Seguimiento');
    $.ajax({
        url: '../indicadores/seguimiento.php',
        data: { resp: 4, id_seg: id, id_estSeg: id_estSeg },
        type: 'POST',
        success: function(resp) {
            $('#modal-body-lg').html(resp);
            $('#largeModal-dialog').attr('style', 'min-width:1200px');
        }
    });
    $.ajax({
        url: '../correspondencia/boton.php',
        type: 'POST',
        data: { resp: 4, id_estSeg: id_estSeg },
        success: function(boton) {
            $('#btn-lg').html(boton);
        }
    });
}

function blocAgregarAct(mes) {
    if (mes != 01) {
        $('#agregarAct').attr('disabled', '');
    }
}

function crearDesc(param, file, table) {
    if (param == 1) {
        var action = 'insDesc';
        var id_desc = null;
    } else {
        var action = 'editDesc';
        var id_desc = document.getElementById('id_desc').value;
    }
    var formDesc = new FormData($('#form-desc')[0]);
    if (validarCampos('form-desc') == 0) {
        $.ajax({
            url: '../indicadores/indicador.controller.php',
            data: formDesc,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function(respht) {
                if (respht == 1) {
                    var cuotas = document.getElementsByName('cuotas');
                    var fechas = document.getElementsByName('fechas');
                    var val_desc = document.getElementById('val_desc').value;
                    var cant = document.getElementById('cant').value;
                    var conc_desc = document.getElementById('conc_desc').value;
                    var id_usus = document.getElementById('id_usus').value;
                    var id_are = document.getElementById('id_are').value;
                    var c = [];
                    var f = [];
                    for (var i = 0; i < cuotas.length; i++) {
                        cuotas.push(cuotas[i].value);
                        fechas.push(fechas[i].value);
                    }
                    var data = {
                        id_desc: id_desc,
                        val_desc: val_desc,
                        cant: cant,
                        conc_desc: conc_desc,
                        id_usus: id_usus,
                        id_are: id_are,
                        cuotas: cuotas,
                        fechas: fechas,
                        action: action,
                    }
                    $.ajax({
                        url: '../indicadores/indicador.controller.php',
                        type: 'POST',
                        data: data,
                        success: function(data) {
                            $('#largeModal').modal('hide');
                            $('#modal-title-sm').html('Crear Descuento');
                            $('#modal-body-sm').html(data);
                            $('#smallModal').modal('show');
                            $('#modal-footer-sm').html('<button type="button" class="btn btn-default" onclick="refreshTableInd(' + "'" + file + "'" + ',' + "'" + table + "'" + ')" data-bs-dismiss="modal">Cerrar</button>');
                        }
                    })
                } else {
                    $('#largeModal').modal('hide');
                    $('#modal-title-sm').html('Crear Descuento');
                    $('#modal-body-sm').html(respht);
                    $('#smallModal').modal('show');
                    $('#modal-footer-sm').html('<button type="button" class="btn btn-default" onclick="refreshTableInd(' + "'" + file + "'" + ',' + "'" + table + "'" + ')" data-bs-dismiss="modal">Cerrar</button>');
                }
            }
        });
    }
}

function ver(id, title, file) {
    $('#modal-title-lg').html(title);
    $.ajax({
        url: file,
        type: 'POST',
        data: { id },
        success: function(respHtml) {
            $('#modal-body-lg').html(respHtml);
            cerrar = "<button type='button' class='btn btn-default' data-bs-dismiss='modal'>Cerrar</button>"
            $('#modal-footer-lg').html(cerrar);
        }
    });
}

function mostrarUsus(param, mes) {
    if (param == 1) {
        title = "activos a inicio de mes";
    } else if (param == 2) {
        title = "activos a fin de mes";
    } else if (param == 3) {
        title = "nuevos";
    } else {
        title = "retirados";
    }
    $('#modal-title-md').html('Usuarios ' + title);
    $.ajax({
        url: "../indicadores/rotaPerU.php",
        type: 'POST',
        data: { param, mes },
        success: function(respHtml) {
            $('#modal-body-md').html(respHtml);
            cerrar = "<button type='button' class='btn btn-default' data-bs-dismiss='modal'>Cerrar</button>"
            $('#btn-md').html(cerrar);
        }
    });
}
//En desarrollo
function filtroAnio(param, table, file) {
    console.log(param);
    $.ajax({
        url: table,
        type: 'POST',
        data: { param },
        success: function(respHTML) {
            $('#content-table').html(respHTML);
        }
    });
    $.ajax({
        url: file,
        type: 'POST',
        data: { param },
        success: function(respHTML) {
            $('#content-table').html(respHTML);
        }
    });
}

function refreshFunctions() {
    $.ajax({
        success: function() {
            location.reload();
        }
    });
}

function exportTo() {
    param = 1;
    //Sube el archivo al servidor
    $.ajax({
        url: '../indicadores/reportes/indicadoresCsv.php',
        type: 'POST',
        data: { param },
        succes: function() {
            console.log("CSV Actualizado")
        }
    });
    $.ajax({
        url: '../indicadores/reportes/indicadoresExcel.php',
        type: 'POST',
        data: { param },
        succes: function() {
            window.location.href = '../indicadores/reportes/indicadoresExcel.php';
        }
    });
    console.log("Archivo Actualizado");
}

function cambiarInfo(param) {
    $('#infoDesc').html("");
    $('#infoDesc').html(param);
}