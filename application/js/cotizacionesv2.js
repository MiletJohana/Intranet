function newCotizacion(resp, id_usu) {
    if (resp == 1 || resp == 18 || resp == 15) {
        var title = 'Crear Cotización';
    } else if (resp == 2) {
        var title = 'Crear Cliente';
    } else if (resp == 3) {
        var title = 'Crear Contacto';
    } else if (resp == 4) {
        var title = 'Crear Producto';
    } else if (resp == 5) {
        var title = 'Actualizar Datos';
    }
    $('#modal-title-lg').html(title);
    $.ajax({
        url: '../cotizadorv2/tabsForm.php',
        type: 'POST',
        data: {
            resp,
            id_usu
        },
        success: function(respHtml) {
            $('#modal-body-lg').html(respHtml);
            var i = null;
            for (i = 1; i <= 5; i++) {
                if (i == resp) {
                    $('#error' + i).html('<div class="col-md-4" id="error-validation"></div>');
                } else {
                    $('#error' + i).html('');
                }
            }
        }
    });

    $.ajax({
        url: '../cotizadorv2/boton.php',
        type: 'POST',
        data: { resp, id_usu },
        success: function(respHtml) {
            $('#modal-footer-lg').html(respHtml);
            if (resp != 18) {
                for (var i = 1; i <= 10; i++) {
                    $('#cerrar' + i).attr('onclick', 'refreshTable(' + resp + ',0)');
                }
            }
        }
    });

    $('#largeModal').modal({
        backdrop: 'static',
        keyboard: false
    });
}

function resumen(id, mes) {
    $('#modal-title-lg').html('Resumen Cotizaciones');
    $.ajax({
        url: '../cotizadorv2/resumen.php',
        type: 'POST',
        data: { resp: 1, mes },
        success: function(respHtml) {
            $('#modal-body-lg').html(respHtml);
            $('#largeModal-dialog').attr('style', 'min-width:1300px');
        }
    });
    $.ajax({
        url: '../cotizadorv2/boton.php',
        type: 'POST',
        data: { resp: 20 },
        success: function(respHtml) {
            $('#modal-footer-lg').html(respHtml);
        }
    });
}


function newAgregar(resp, id_usu, cerrar) {
    if (resp == 1) {
        var title = 'Crear Cotización';
    } else if (resp == 2) {
        var title = 'Crear Cliente';
    } else if (resp == 3) {
        var title = 'Crear Contacto';
    } else if (resp == 4) {
        var title = 'Crear Producto';
    } else if (resp == 5) {
        var title = 'Actualizar Datos';
    } else if (resp == 6) {
        var title = 'Actualizar Cotización';
    } else if (resp == 7) {
        var title = 'Actualizar Cliente';
    } else if (resp == 8) {
        var title = 'Actualizar Contacto';
    } else if (resp == 9) {
        var title = 'Actualizar Producto';
    } else if (resp == 10) {
        var title = 'Cotización';
    }
    $('#modal-title-lg').html(title);
    $.ajax({
        url: '../cotizadorv2/boton.php',
        type: 'POST',
        data: {
            resp,
            id_usu,
            cerrar
        },
        success: function(respHtml) {
            $('#modal-footer-lg').html(respHtml);
            var i = null;
            for (i = 1; i <= 5; i++) {
                if (i == resp) {
                    $('#error' + i).html('<div class="col-md-4" id="error-validation"></div>');
                } else {
                    $('#error' + i).html('');
                }
            }
        }
    });
}

function editar(resp, edit, id_usu) {
    if (resp == 6 || resp == 16) {
        var title = 'Actualizar Cotización';
    } else if (resp == 7) {
        var title = 'Actualizar Cliente';
    } else if (resp == 8) {
        var title = 'Actualizar Contacto';
    } else if (resp == 9) {
        var title = 'Actualizar Producto';
    } else if (resp == 11) {
        var title = 'Duplicar Cotización';
    }
    $('#modal-title-lg').html(title);
    $.ajax({
        url: '../cotizadorv2/tabsForm.php',
        type: 'POST',
        data: { resp, edit, id_usu },
        success: function(respHtml) {
            $('#modal-body-lg').html(respHtml);
            var i = null;
            for (i = 1; i <= 5; i++) {
                if (i == resp) {
                    $('#error' + i).html('<div class="col-md-4" id="error-validation"></div>');
                } else {
                    $('#error' + i).html('');
                }
            }
        }
    });

    $.ajax({
        url: '../cotizadorv2/boton.php',
        type: 'POST',
        data: { resp, id_usu },
        success: function(resp) {
            $('#modal-footer-lg').html(resp);
            for (var i = 1; i <= 10; i++) {
                $('#cerrar' + i).attr('onclick', 'refreshTable(' + i + ')');
            }
        }
    });
}


function editarForm(resp, title, url, edit, param, file, table) {
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
            $('#btn-lg').html(respHtml);
            $('#editar').attr('onclick', "modInd('" + param + "','" + file + "','" + table + "')");
        }
    });
}



function eliminar(resp, elim, nom, conf) {
    if (conf == 1) {
        if (resp == 12) {
            var title = 'Eliminar Cliente';
        } else if (resp == 13) {
            var title = 'Eliminar Contacto';
        } else if (resp == 14) {
            var title = 'Eliminar Producto';
        }
        $('#modal-title-md').html(title);
        $('#modal-body-md').html('<br><div align="center"> ¿Está seguro de elimnar el registro #' + elim + ' con nombre ' + nom + '?<br></div><br>');
        $.ajax({
            url: '../cotizadorv2/boton.php',
            type: 'POST',
            data: { resp, elim },
            success: function(respHtml) {
                $('#modal-footer-md').html(respHtml);
            }
        });
    } else if (conf == 2) {
        $.ajax({
            url: '../cotizadorv2/cotizaciones.controller.php',
            type: 'POST',
            data: { elim, action: nom },
            success: function(respHtml) {
                $('#mediumModal').modal('hide');
                $('#modal-body-sm').html(respHtml);
                $('#modal-title-sm').html('Aviso');
                $('#smallModal').modal('show');
                $('#modal-footer-sm').html('<button id="elim" type="button" class="btn btn-secondary" onclick="refreshTable(' + resp + ')" data-bs-dismiss="modal">Cerrar</button>');
            }
        });
    }
}

function subirCoti(id_usu) {
    if (validarCampos('form-SubCoti') == 0) {
        var formulario = new FormData($("#form-SubCoti")[0]);
        $.ajax({
            url: '../cotizadorv2/cotizaciones.controller.php',
            data: formulario,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function(respHtml) {
                $('#largeModal').modal('hide');
                $('#modal-title-sm').html('Subir Cotización');
                $('#modal-body-sm').html(respHtml);
                $('#smallModal').modal('show');
                $('#modal-footer-sm').html('<button type="button" class="btn btn-secondary" onclick="refreshTable(1)" data-bs-dismiss="modal">Cerrar</button>');
            }
        });
    }
}

function actualizarCoti() {
    if (validarCampos('form-SubCoti') == 0) {
        var formulario = new FormData($("#form-SubCoti")[0]);
        $.ajax({
            url: '../cotizadorv2/cotizaciones.controller.php',
            data: formulario,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function(respHtml) {
                $('#largeModal').modal('hide');
                $('#modal-title-sm').html('Actualizar Cotización');
                $('#modal-body-sm').html(respHtml);
                $('#smallModal').modal('show');
                $('#modal-footer-sm').html('<button type="button" class="btn btn-secondary" onclick="refreshTable(1)" data-bs-dismiss="modal">Cerrar</button>');
            }
        });
    }
}

function contactosEma(id_coti, id_usu, id_cont) {
    $('#modal-title-md').html('Destinatarios de la cotización ');
    $.ajax({
        url: '../cotiAuto/contactos.php',
        data: { resp: 10, id_coti: id_coti, id_usu: id_usu, id_cont: id_cont },
        type: 'POST',
        success: function(resp) {
            $('#modal-body-md').html(resp);

        }
    });
    $.ajax({
        url: '../cotizadorv2/boton.php',
        type: 'POST',
        data: { resp: 10, id_coti: id_coti, id_usu: id_usu, id_cont: id_cont },
        success: function(boton) {
            $('#modal-footer-md').html(boton);
            $('#modal-footer-sm').html('<button type="button" class="btn btn-secondary" onclick="refreshTable(1)" data-bs-dismiss="modal">Cerrar</button>');

        }
    });
}

function desp2() {
    $.ajax({
        url: '../cotiAuto/contContactos.php',
        type: 'POST',
        data: { resp: 1 },
        success: function(resp) {
            $('#desp2').html(resp);
            $('#btnM').attr('onclick', 'desp3()');
            $('#nom_ema').attr('name', 'nom_ema2');
            $('#nom_ema').attr('id', 'nom_ema2');
            $('#ema_ema').attr('name', 'ema_ema2');
            $('#ema_ema').attr('id', 'ema_ema2');
            $('#btnMen').attr('id', 'btnMen1');
            $('#btnMen1').attr('onclick', 'remove(1)');
        }
    });
}

function desp3() {
    $.ajax({
        url: '../cotiAuto/contContactos.php',
        type: 'POST',
        data: { resp: 1 },
        success: function(resp) {
            $('#desp3').html(resp);
            $('#btnM').attr('onclick', 'desp4()');
            $('#nom_ema').attr('name', 'nom_ema3');
            $('#nom_ema').attr('id', 'nom_ema3');
            $('#ema_ema').attr('name', 'ema_ema3');
            $('#ema_ema').attr('id', 'ema_ema3');
            $('#btnMen').attr('id', 'btnMen2');
            $('#btnMen2').attr('onclick', 'remove(2)');
        }
    });
}

function desp4() {
    $.ajax({
        url: '../cotiAuto/contContactos.php',
        type: 'POST',
        data: { resp: 1 },
        success: function(resp) {
            $('#desp4').html(resp);
            $('#btnM').attr('onclick', 'desp5()');
            $('#nom_ema').attr('name', 'nom_ema4');
            $('#nom_ema').attr('id', 'nom_ema4');
            $('#ema_ema').attr('name', 'ema_ema4');
            $('#ema_ema').attr('id', 'ema_ema4');
            $('#btnMen').attr('id', 'btnMen3');
            $('#btnMen3').attr('onclick', 'remove(3)');
        }
    });
}

function remove(id) {
    if (id == 1) {
        $('#btnMen1').remove();
        $('#desp2').html('');
        $('#btnM').attr('onclick', 'desp2()');
    } else if (id == 2) {
        $('#desp3').html('');
        $('#btnMen2').remove();
        $('#btnM').attr('onclick', 'desp3()');
    } else {
        $('#desp4').html('');
        $('#btnMen3').remove();
        $('#btnM').attr('onclick', 'desp4()');
    }
}

function crearContaEma() {
    if (validarCampos('form-contac') == 0) {
        var formulario = new FormData($("#form-contac")[0]);
        $.ajax({
            url: '../cotizadorv2/cotizaciones.controller.php',
            data: formulario,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function(resp) {
                $('#mediumModal').modal('hide');
                $('#modal-title-sm').html('Correo Masivo ');
                $('#modal-body-sm').html(resp);
                $('#smallModal').modal('show');
                $('#modal-footer-sm').html('<button type="button" class="btn btn-secondary" onclick="refreshTable(1)" data-bs-dismiss="modal">Cerrar</button>');
            }
        });
    }
}


function email(id_coti, id_usu) {
    var r = confirm("Estas seguro de enviar la Cotización");
    if (r == true) {
        var action = "email";
        $.ajax({
            url: '../cotizadorv2/cotizaciones.controller.php',
            type: 'POST',
            data: { id_coti: id_coti, id_usu: id_usu, action: action },
            success: function(resp) {
                $('#modal-title-sm').html('Envio de cotización');
                $('#modal-body-sm').html(resp);
                $('#smallModal').modal('show');

            }
        });
    }
}

function estadosCot(id_coti, value) {
    if (value == 1) {
        var action = "aprobado";
    } else if (value == 2) {
        var action = "rechazado";
    }
    $.ajax({
        url: '../cotizadorv2/cotizaciones.controller.php',
        type: 'POST',
        data: { id_coti: id_coti, value: value, action: action },
        success: function(resp) {
            if (resp == 1) {
                $('#selloaprob').css('visibility', 'visible');
                $('#btnAprob').attr('disabled', "true");
                $('#btnRecha').css('visibility', 'hidden');

            } else if (resp == 2) {
                $('#selloRech').css('visibility', 'visible');
                $('#btnRecha').attr('disabled', "true");
                $('#btnAprob').css('visibility', 'hidden');
            }
        }
    });
}

function crearComentario(id_usu, id_coti, id_mq, nom_usu, id_cont, id_asc) {
    $('#modal-title-md').html("Chat De Comentarios");
    $.ajax({
        url: '../cotiAuto/contenido.php',
        type: 'POST',
        data: { resp: 1, id_usu, id_coti, id_mq, nom_usu, id_cont, id_asc },
        success: function(resp) {
            $('#modal-body-md').html(resp);

        }
    });
    $.ajax({
        url: '../cotiAuto/formulario.php',
        type: 'POST',
        data: { resp: 1, id_usu, id_coti, id_mq, nom_usu, id_cont, id_asc },
        success: function(boton) {
            $('#modal-footer-md').html(boton);
        }
    });
}

function comeRecha(id_coti) {
    $('#modal-title-md').html("Comentarios");
    $.ajax({
        url: '../cotizadorv2/formR.php',
        type: 'POST',
        data: { resp: 1, id_coti },
        success: function(resp) {
            $('#modal-body-md').html(resp);
        }
    });
}

function enviComRec() {
    var formulario = new FormData($("#form-comR")[0]);
    $.ajax({
        url: '../cotizadorv2/cotizaciones.controller.php',
        data: formulario,
        type: 'POST',
        contentType: false,
        processData: false,
        success: function(resp) {
            $('#mediumModal').modal('hide');
            $('#modal-title-sm').html('');
            $('#modal-body-sm').html(resp);
            $('#smallModal').modal('show');
            $('#modal-footer-sm').html('<a href="https://intranet.masterquimica.com/" class="btn btn-secondary">Cerrar</a>');

        }
    });
}


function enviarCom(id_coti, id_cont, id_asc, id_mq, id_usu) {
    var formulario = new FormData($("#form-comen")[0]);
    $.ajax({
        url: '../cotiAuto/cotiAuto.controller.php',
        data: formulario,
        type: 'POST',
        contentType: false,
        processData: false,
        success: function(resp) {
            $('#mediumModal').modal('hide');
            $('#modal-title-sm').html('Mensaje');
            $('#modal-body-sm').html(resp);
            $('#smallModal').modal('show');
            if (id_mq == 1) {
                $('#modal-footer-sm').html('<a href="https://intranet.masterquimica.com/application/cotiAuto/index.php?id_coti=' + id_coti + '&xont=' + id_cont + '&asc=' + id_asc + '&ux=' + id_usu + '" class="btn btn-secondary">Cerrar</a>');
            } else {
                $('#modal-footer-sm').html('<a href="https://intranet.masterquimica.com/application/cotiAuto/index.php?id_coti=' + id_coti + '&xont=' + id_cont + '&asc=' + id_asc + '" class="btn btn-secondary">Cerrar</a>');
            }
        }
    });
}


////////////////////////////////////////////////////////////////////////////


function buscarClie(param) {
    if (param == 1) {
        $('#nom_cli3').attr('type', 'text');
        $('#buscarClie').html('Nuevo');
        $('#buscarClie').attr('onclick', 'buscarClie(2)');
        $('#btnCliente').html('Actualizar Cliente');
        $('#btnCliente').attr('onclick', 'actualizarClie();');
        $('#btnCliente').attr('disabled', '');
        $('#accionClie').attr('value', 'updateClie');
        $('#infoCont').attr('style', 'display:none');
        $('#nom_cont4').removeAttr('required');
        $('#tel_cont44').removeAttr('required');
        $('#eml_cont4').removeAttr('required');
        $("#id_cli1").removeAttr('onkeyup');
        $('#id_cli1').css("border", "");
        $('#natura').html('<div class="col-md-6"><label for="eml_cont3" class="form-label">Correo</label><input type = "email" class= "form-control" id = "eml_cli1" name = "eml_cli1" placeholder = "Correo electrónico" required ><input type="hidden" id="natura1" name="natura1" value="1"></div>');
    } else if (param == 2) {
        $('#id_cli1').css("border", "");
        $('#nom_cli3').attr('type', 'hidden');
        $('#buscarClie').html('Editar Existente');
        $('#buscarClie').attr('onclick', 'buscarClie(1)');
        $('#btnCliente').html('Crear Cliente');
        $('#btnCliente').attr('disabled', '');
        $('#btnCliente').attr('onclick', 'crearClientec();');
        $('#accionClie').attr('value', 'addClie');
        $('#nom_clie3').val('');
        $('#id_cli1').val('');
        $('#nom_cli1').val('');
        $('#tel_cli1').val('');
        $('#dir_cli1').val('');
        $('#ase_com1').val('');
        $('#rep_sac1').val('');
        $('#eml_cli1').val('');
        $('#infoCont').attr('style', 'display:inline');
        $('#nom_cont4').attr('required', '');
        $('#tel_cont44').attr('required', '');
        $('#eml_cont4').attr('required', '');
        $("#id_cli1").attr('onkeyup', 'verifyClie(this.value)');
    } else if (param == 3) {
        $('#infoCont').attr('style', 'display:none');
        $('#nom_cont4').removeAttr('required');
        $('#tel_cont44').removeAttr('required');
        $('#eml_cont4').removeAttr('required');
        $('#persNatural').attr('onclick', 'buscarClie(4);');
        $('#natura').html('<div class="col-md-6"><label for="eml_cont3" class="form-label">Correo</label><input type="email" class="form-control" id="eml_cli1" name="eml_cli1" placeholder="Correo electrónico" required ><input type="hidden" id="natura1" name="natura1" value="1"></div>');
    } else if (param == 4) {
        $('#infoCont').attr('style', 'display:block');
        $('#nom_cont4').attr('required', '');
        $('#tel_cont44').attr('required', '');
        $('#eml_cont4').attr('required', '');
        $('#persNatural').attr('onclick', 'buscarClie(3);');
        $('#natura').html('');
    }
}

function verifyClie(id_cli) {
    if (id_cli == '') {
        $('#id_cli1').css("border", "1px solid red");
        $('#btnCliente').attr('disabled', '');
    } else {
        $.ajax({
            url: '../cotizadorv2/cotizaciones.controller.php',
            type: 'POST',
            data: { id_cli, action: 'verifyClie' },
            success: function(resp) {
                if (resp == "1") {
                    $('#id_cli1').css("border", "1px solid red");
                    $('#btnCliente').attr('disabled', '');
                } else {
                    $('#id_cli1').css("border", "1px solid green");
                    $('#btnCliente').removeAttr('disabled');
                }
            }
        });
    }
}


function crearProducto() {
    if (validarCampos('form-productos') == 0) {
        var formulario = new FormData($("#form-productos")[0]);
        $.ajax({
            url: '../cotizadorv2/cotizaciones.controller.php',
            data: formulario,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function(resp) {
                $('#ProductosResp').html(resp);
                $('#error4').html('');
            }
        });
    }
}

function actualizarProd() {
    if (validarCampos('form-productos') == 0) {
        var formulario = new FormData($("#form-productos")[0]);
        $.ajax({
            url: '../cotizadorv2/cotizaciones.controller.php',
            data: formulario,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function(resp) {
                $('#ProductosResp').html(resp);
                $('#error4').html('');
            }
        });
    }
}

function verifyProd(cod_pro, param) {
    if (param == 0) {
        $.ajax({
            url: '../cotizadorv2/cotizaciones.controller.php',
            type: 'POST',
            data: { cod_pro, action: 'verifyProd' },
            success: function(resp) {
                if (resp == "1") {
                    $('#cod_ref1').css("border", "1px solid red");
                    $('#btnProducto').attr('disabled', '');
                    console.log(resp);
                } else {
                    $('#cod_ref1').css("border", "1px solid green");
                    $('#btnProducto').removeAttr('disabled');
                    console.log(resp);
                }
            }
        });
    } else if (param == 1) {
        var codi = $('#cod_ref2').val();
        if (codi == cod_pro) {
            $('#cod_ref1').css("border", "");
        } else {
            $.ajax({
                url: '../cotizadorv2/cotizaciones.controller.php',
                type: 'POST',
                data: { cod_pro, action: 'verifyProd' },
                success: function(resp) {
                    if (resp == "1") {
                        $('#cod_ref1').css("border", "1px solid red");
                        $('#btnProducto').attr('disabled', '');
                    } else {
                        $('#cod_ref1').css("border", "1px solid green");
                        $('#btnProducto').removeAttr('disabled');
                        console.log(resp);
                    }
                }
            });
        }
    }
}

function buscarProd(param) {
    if (param == 1) {
        $('#nom_pro2').attr('type', 'text');
        $('#nom_pro2').attr('onclick', 'autoProd(2)');
        $('#nom_pro2').focus();
        $('#buscarProd').html('Nuevo');
        $('#buscarProd').attr('onclick', 'buscarProd(2)');
        $('#actionProd').attr('value', 'updateProd');
        $('#btnProducto').attr('onclick', 'actualizarProd();');
        $('#btnProducto').html('Actualizar Producto');
        $('#cod_ref1').removeAttr('onkeyup');
        $('#titleProd').html('Actualizar Producto');
        $('#foto').removeAttr('required');
        $('#cod_ref1').css("border", "");
    } else {
        $('#cod_ref1').css("border", "");
        $('#nom_pro2').val('');
        $('#nom_pro2').attr('type', 'hidden');
        $('#buscarProd').html('Editar Existente');
        $('#buscarProd').attr('onclick', 'buscarProd(1)');
        $('#nom_pro1').val('');
        $("#des_pro1").val('');
        $("#opt1").val('');
        $("#can_emp1").val('');
        $("#pre_pro1").val('');
        $("#cod_pro1").val('');
        $("#cod_ref1").val('');
        $('#opt1').html('Seleccionar');
        $('#img_pro1Auto').attr('class', '');
        $('#img_pro1Auto').html('');
        $("#sin_dev1").removeAttr('checked');
        $("#sin_dev1").attr('value', '0');
        $('#actionProd').attr('value', 'addProd');
        $('#btnProducto').attr('onclick', 'crearProducto();');
        $('#btnProducto').html('Crear Producto');
        $('#btnProducto').attr('disabled', '');
        $('#titleProd').html('Nuevo Producto');
        $('#foto').attr('required', '');
        $('#img_pro1Auto1').html('');
        $('#cod_ref1').attr('onkeyup', 'verifyProd(this.value,0);');
    }
}

function actualizarDatos(id_usu) {
    if (validarCampos('form-misDatos') == 0) {
        var formulario = new FormData($("#form-misDatos")[0]);
        $.ajax({
            url: '../cotizadorv2/cotizaciones.controller.php',
            data: formulario,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function(resp) {
                $('#MisDatosResp').html(resp);
                $('#error5').html('');
            }
        });
    }
}

function refreshTable(param, id_cli) {
    if (param == 18) {
        $.ajax({
            url: "../clientes2/perfil.php",
            type: 'GET',
            data: {
                id: id_cli
            },
            success: function(resp) {
                console.log(resp);
                $('#content-table').html(resp);
            }
        });
    } else {
        if (param == '' || param == 1) {
            var url = '../cotizadorv2/tabla.php';
            var name = "Cotizaciones";
        } else if (param == 2 || param == 7 || param == 11 || param == 12) {
            var url = '../cotizadorv2/tabla.php';
            var name = "Clientes";
        } else if (param == 3 || param == 8 || param == 13) {
            var url = '../cotizadorv2/tabla5.php';
            var name = "Contactos";
        } else if (param == 4 || param == 9 || param == 14) {
            var url = '../cotizadorv2/tabla6.php';
            var name = "Productos";
        } else if (param == 5 || param == 10 || param == 15) {
            var url = '../cotizadorv2/tabla.php';
        }
        $.ajax({
            url: url,
            type: 'POST',
            data: { resp: 'cerrar' },
            success: function(resp) {
                console.log(resp);
                $('#content-table').html(resp);
            }
        });
    }
}
/// Funcioes del cotizadorv2 para actualizar tabla ////

function actualizarTablaEstadisticas(id) {
    var est_cot = document.getElementsByName("est_cot")[0].value;
    var mes = document.getElementsByName("mes")[0].value;
    var mes2 = document.getElementsByName("mes")[0].value;
    $.ajax({
        url: '../cotizadorv2/table_stadistics.php',
        data: { id_usu: id, est_cot, mes, mes2, resp: 6 },
        type: 'POST',
        success: function(resp) {
            $('#estadistics').html(resp);
        }
    });
}

function updSol(sol_cot, id_coti, state) {
    $.ajax({
        url: '../cotizadorv2/cotizaciones.controller.php',
        data: { sol_cot, action: 'updateSol', id_coti },
        type: 'POST',
        success: function(resp) {
            if (resp != 1) {
                $('#modal-title-md').html('Actualización Solicitud');
                $('#modal-body-md').html(resp);
                $('#mediumModal').modal('show');
            }
            actualizarSolicitaCotizacion(state, sol_cot);
        }

    });
}



function updPrc(id_coti) {
    var id_cat = [];
    var id_cats = document.getElementsByName("id_cat[]" + id_coti);
    for (var i = id_cats.length - 1; i >= 0; i--) {
        if (id_cats[i].checked == true) {
            id_cat.push(id_cats[i].value);
        }
    }
    $.ajax({
        url: '../cotizadorv2/cotizaciones.controller.php',
        data: { id_coti, action: 'updatePrc', id_cat },
        type: 'POST',
        success: function(resp) {
            if (resp == 1) {
                $('#modal-title-md').html('Actualización Solicitud');
                $('#modal-body-md').html('<div class="alert alert-danger alert-dismissible"><strong>No se pudo actualizar.</strong></div>');
                $('#mediumModal').modal('show');
            } else {
                $('#prc' + id_coti).html(resp);
                console.log(id_coti);
            }
        }

    });
}

function updEnv(env_cot, id_coti) {
    $.ajax({
        url: '../cotizadorv2/cotizaciones.controller.php',
        data: { env_cot, action: 'updateEnv', id_coti },
        type: 'POST',
        success: function(resp) {
            if (resp != 1) {
                $('#modal-title-md').html('Actualización Solicitud');
                $('#modal-body-md').html(resp);
                $('#mediumModal').modal('show');
            }
        }

    });
}

function updEst(est_cot, id_coti, nom_cont, state) {
    if (est_cot != 3) {
        $('#' + state + 'r').attr("disabled", "true");
        $('#' + state + 'r2').removeAttr("disabled");
    } else {
        $('#' + state + 'r').removeAttr("disabled");
        $('#' + state + 'r2').attr("disabled", 'true');
    }
    ///if (est_cot == 2) {
    //  var r = confirm("Estas seguro de aprobar la cotizacion,recuerde que una vez aprobada se creara en Myprocess");
    //}
    var id = $('#id_usu').val();
    console.log(id);
    $.ajax({
        url: '../cotizadorv2/cotizaciones.controller.php',
        data: { est_cot, action: 'updateEst', nom_cont, id_coti },
        type: 'POST',
        success: function(resp) {
            if (resp != 1) {
                $('#modal-title-sm').html('Actualización Solicitud');
                $('#modal-body-sm').html(resp);
                $('#smallModal').modal('show');
            }
            actualizarEstadoCotizacion(state, est_cot);
            actualizarTablaEstadisticas(id);
        }

    });

}

function updCom(com_cot, id_coti) {
    $.ajax({
        url: '../cotizadorv2/cotizaciones.controller.php',
        data: { com_cot, action: 'updateCom', id_coti },
        type: 'POST',
        success: function(resp) {
            if (resp != 1) {
                $('#modal-title-md').html('Actualización Solicitud');
                $('#modal-body-md').html(resp);
                $('#mediumModal').modal('show');
            }
        }

    });
}

function updper(conf_cotiz, id_coti) {
    $.ajax({
        url: '../cotizadorv2/cotizaciones.controller.php',
        data: { conf_cotiz, action: 'updatePer', id_coti },
        type: 'POST',
        success: function(resp) {
            if (resp != 1) {
                $('#modal-title-md').html('Actualización Solicitud');
                $('#modal-body-md').html(resp);
                $('#mediumModal').modal('show');
            }
        }

    });
}


function updMot(mot_cot, id_coti) {
    $.ajax({
        url: '../cotizadorv2/cotizaciones.controller.php',
        data: { mot_cot, action: 'updateMot', id_coti },
        type: 'POST',
        success: function(resp) {
            if (resp != 1) {
                $('#modal-title-md').html('Actualización Solicitud');
                $('#modal-body-md').html(resp);
                $('#mediumModal').modal('show');
            }
        }

    });
}

function updLlam(llam_cot, id_coti) {
    $.ajax({
        url: '../cotizadorv2/cotizaciones.controller.php',
        data: { llam_cot, action: 'updateLlam', id_coti },
        type: 'POST',
        success: function(resp) {
            if (resp != 1) {
                $('#modal-title-md').html('Actualización Solicitud');
                $('#modal-body-md').html(resp);
                $('#mediumModal').modal('show');
            }
        }

    });
}


function actualizarEstadoCotizacion(state, opc) {
    var a = $('#' + state);
    switch (opc) {
        case 1:
            a.attr("class", "btn btn-secondary btn-warning btn-sm");
            break;
        case 2:
            a.attr("class", "btn btn-secondary btn-success btn-sm");
            break;
        case 3:
            a.attr("class", "btn btn-secondary btn-danger btn-sm");
            break;
        case 4:
            a.attr("class", "btn btn-secondary btn-info btn-sm");
            break;
    }
}


function actualizarSolicitaCotizacion(state, opc) {
    var a = $('#' + state);
    console.log(a);
    switch (opc) {
        case 1:
            a.html('Teléfono');
            break;
        case 2:
            a.html('Email');
            break;
        case 3:
            a.html('Vendedor');
            break;
    }
}

function ctrlUsu() {
    var id = document.getElementsByName("id_usu2")[0].value;
    var mes = document.getElementsByName("mesR")[0].value;
    var mes2 = document.getElementsByName("mesR2")[0].value;

    $.ajax({
        url: '../cotizadorv2/table_control.php',
        type: 'POST',
        data: { id, id_usu: id, mes, mes2 },
        success: function(resp) {
            $('#content-table2').html(resp);
        }
    });
    /*
        $.ajax({
            url: '../cotizadorv2/table_stadistics.php',
            type: 'GET',
            data: { id, id_usu: id, mes, mes2 },
            success: function(resp) {
                $('#estadistics2').html(resp);
            }

        });*/
}


function ctrlResum() {
    var id = document.getElementsByName("id_usu2")[0].value;
    var mes = document.getElementsByName("mesR")[0].value;
    var mes2 = document.getElementsByName("mesR2")[0].value;

    $.ajax({
        url: '../cotizadorv2/tablacontrol.php',
        type: 'POST',
        data: { id, id_usu: id, mes, mes2 },
        success: function(resp) {
            $('#datatable2').html(resp);
        }
    });
}


function form(params) {
    if (params == 1) {
        $('#formExcel').submit();
    } else if (params == 2) {
        var id_usu = $('#id_usu').val();
        var mes = $('#mes').val();
        $('#formExcelAnual').append('<input type="hidden" name="id_usu" id="id_usu" value="' + id_usu + '"> <input type="hidden" name="mes" id="mes" value="' + mes + '">');
        $('#formExcelAnual').submit();
    }
}

function cotUsu(actu, anio) {
    var id_usu = document.getElementsByName("id_usu")[0].value;
    var est_cot = document.getElementsByName("est_cot")[0].value;
    var mes = document.getElementsByName("mes")[0].value;
    if (actu < 10) {
        var actu = '0' + actu;
    }
    var mes2 = anio + '-' + actu;
    $.ajax({
        url: '../cotizadorv2/table_stadistics.php',
        data: { id_usu, mes, mes2, est_cot },
        type: 'POST',
        success: function(resp) {
            $('#estadistics').html(resp);
        }
    });
    $.ajax({
        url: '../cotizadorv2/tabla.php',
        data: { id_usu, est_cot, mes },
        type: 'POST',
        success: function(resp) {
            console.log(resp);
            $('#tableCotizaciones').html(resp);
            $('#tableCotizaciones').removeAttr("style");
            $('#tableCotizaciones').removeAttr("class");
        }
    });
}


function mostrarMisCoti(id, mes, actu, anio) {
    var id_usu = id;
    var tot = '2018-01';
    var mes = mes + '-12-31';
    console.log(mes);
    $.ajax({
        url: '../cotizadorv2/tabla.php',
        data: { tot, mes, id_usu },
        type: 'POST',
        success: function(resp) {
            $('#content-table').html(resp);
            $('#Opt').html('Cotizaciones');
            $('#Opt').attr('href', 'index.php?table=1');
        }
    });
}

function controlCoti(id_usu, mes, actu, anio) {
    var est_cot = document.getElementsByName("est_cot")[0].value;
    var anio = document.getElementById("anio").value;
    if (mes < 10) {
        var mes = '0' + mes;
    }
    var mes = anio + '-' + mes;
    $.ajax({
        url: '../cotizadorv2/tabla.php',
        data: { resp: 1, id_usu, est_cot, mes },
        type: 'POST',
        success: function(resp) {
            $('#content-table').html(resp);
            $('#Opt').html('Todas mis cotizaciones');
            $('#Opt').attr('onclick', 'mostrarMisCoti(' + id_usu + ', ' + anio + ', ' + actu + ', ' + anio + ');');
            $('#Asoc').html('Cotizaciones Asociadas');
            $('#Asoc').attr('onclick', 'mostrarCotiAsoc(' + id_usu + ')');
        }
    });
}

function mostrarCotiAsoc(id_usu2) {
    var id_usu = id_usu2;
    $.ajax({
        url: '../cotizadorv2/tabla.php',
        data: { id_usu, id_usu2 },
        type: 'POST',
        success: function(resp) {
            $('#content-table').html(resp);
            $('#Asoc').html('Cotizaciones');
            $('#Asoc').removeAttr('onclick');
            $('#Asoc').attr('href', 'index.php?table=1');
        }
    });
}

function mostrarTabAutor(id_usu2) {
    var id_usu = id_usu2;
    $.ajax({
        url: '../cotizadorv2/tabla8.php',
        data: { id_usu, id_usu2 },
        type: 'POST',
        success: function(resp) {
            $('#content-table').html(resp);
            $('#formExcel').attr("style", "display:none;")
            $('#Pen').html('Cotizaciones');
            $('#Pen').attr('href', 'index.php?table=1');
        }
    });
}

function mostrarCoti() {
    var id_usu = document.getElementsByName("id_usu")[0].value;
    $.ajax({
        url: '../cotizadorv2/tablaTotal.php',
        data: { resp: 1 },
        type: 'POST',
        success: function(resp) {
            $('#content-table').html(resp);
        }
    });
}

function appear(value) {
    if (value == 2 || value == 4 || value == 7 || value == 8 || value == 10) {
        $.ajax({
            url: '../tapetes/productos.php',
            type: 'POST',
            data: { value: value },
            success: function(resp) {
                $('#tapetes').html(resp);
            }
        });
    } else if (value == 5) {
        $.ajax({
            url: '../tapetes/tapetes.php',
            type: 'POST',
            data: { value: value },
            success: function(resp) {
                $('#tapetes').html(resp);
            }
        });
    } else {
        $.ajax({
            url: '../tapetes/productos.php',
            type: 'POST',
            data: { value: value },
            success: function(resp) {
                $('#tapetes').html(resp);
            }
        });
    }
}

function editarForm(resp, title, url, edit, param, file) {
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
        url: '../cotizadorv2/boton.php',
        type: 'POST',
        data: { resp },
        success: function(respHtml) {
            console.log(resp);
            $('#modal-footer-lg').html(respHtml);
            $('#editar').attr('onclick', "modCoti('" + param + "','" + file + "')");
        }
    });
}


function modCoti(param, carpeta) {
    var r = confirm("Estas seguro de aprobar la cotizacion,recuerde que una vez aprobada se creará en Myprocess");
    if (r == true) {
        if (validarCampos(param) == 0) {
            var formulario = new FormData($("#" + param)[0]);
            $.ajax({
                url: '../cotizadorv2/cotizaciones.controller.php',
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
}

//// PRODUCTOS - MARGEN
function calcuPreci(param) {
    var precB = $('#pre_base').val();
    if ((param >= 16)||(param <= 22)){
        var valPar = ((parseFloat(precB) / 100) * param);
        var total = Math.round(parseFloat(precB) + valPar);
        $('#pre_pro').val(total).text();
        $('#est_mar').val('1');
        $('#porcet').val(param+'%');
        $('#marg_alert').removeAttr("style", "display:none;");
    } else if ((param >= 23) ||( param <=45)) {
        var valPar = (parseInt(precB) / 100) * param;
        var total = Math.round(parseFloat(precB) + valPar);
        $('#pre_pro').val(total).text();
        $('#est_mar').val('0');
        $('#porcet').val(param+'%');
        $('#marg_alert').attr("style", "display:none;");
    }
}