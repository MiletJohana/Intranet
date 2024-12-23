$(function() {
    $("#adicional").on('click', function() {
        $("#coti").append('<tr><td>hola men</td></tr>');
    });
    $(document).on("click", ".eliminar", function() {
        var r = confirm("Estas seguro que deseas eliminar este producto");
        if (r == true) {
            var parent = $(this).parents().get(0);
            $(parent).remove();
        }
    });
});

function auto(param) {
    if (param == 1) {
        $("#nom_cli").autocomplete({
            source: '../autocomplete/clientes2/buscador.php',
            minLength: 3,
            select: function(event, ui) {
                $("#nom_pro").attr("readonly", false);
                $("#id_cli").val(ui.item.id_cli);
                get_clientes();
            }
        });
    } else if (param == 2) {
        $("#nom_cli2").autocomplete({
            source: '../autocomplete/cotizador/clientes/buscador.php',
            minLength: 3,
            select: function(event, ui) {
                $("#id_cli2").val(ui.item.id_cli);
                $('#btnContacto').removeAttr('disabled');
            }
        });
    } else if (param == 3) {
        $("#nom_cli3").autocomplete({
            source: '../autocomplete/cotizador/clientes/buscador.php',
            minLength: 3,
            select: function(event, ui) {
                $("#id_cli1").val(ui.item.id_cli);
                $("#id_cli1").attr('readonly', '');
                $("#nom_cli1").val(ui.item.nom_cli);
                $("#tel_cli1").val(ui.item.tel_cli);
                $("#dir_cli1").val(ui.item.dir_cli);
                $("#eml_cli1").val(ui.item.eml_cli);
                if (ui.item.tip_id == 'Natural') {
                    $('#persNatural').attr('checked', '');
                }
                $('#btnCliente').removeAttr('disabled');
                getAsesor(1, ui.item.ase_com);
                getAsesor(2, ui.item.rep_sac);
            }
        });
    }
}

function getAsesor(param, id_usu) {
    $.ajax({
        url: '../cotizadorv2/cotizaciones.controller.php',
        type: 'POST',
        data: { action: 'select', id_usu, param },
        success: function(resp) {
            if (param == 1) {
                if (resp == 0) {
                    $('#ase_com1').val('');
                } else {
                    $('#ase_com1').html(resp);
                }
            } else if (param == 2) {
                if (resp == 0) {
                    $('#rep_sac1').val('');
                } else {
                    $('#rep_sac1').html(resp);
                }
            }
        }
    });

}

function autoProd(param) {
    if (param == 1) {
        $("#nom_pro").autocomplete({
            source: '../autocomplete/cotizadorv2/productos/buscador.php',
            minLength: 3,
            select: function(event, ui) {
                $("#des_pro").val(ui.item.desc_prod);
                $("#und_emp").val(ui.item.id_uni_med);
                $("#can_emp").val(ui.item.uni_emp_mq);
                //$("#pre_pro").val(ui.item.pre_pro);
                $("#cod_pro").val(ui.item.id_prod);
                $("#cod_ref").val(ui.item.cod_pro);
                $('#pre_base').val(ui.item.pre_base);
            }
        });
    } else {
        $("#nom_pro2").autocomplete({
            source: '../autocomplete/cotizadorv2/productos/buscador.php',
            minLength: 3,
            select: function(event, ui) {
                $('#nom_pro1').val(ui.item.value);
                $("#des_pro1").val(ui.item.des_pro);
                $("#opt1").val(ui.item.und_emp);
                $("#can_emp1").val(ui.item.can_emp);
                $("#pre_pro1").val(ui.item.pre_pro);
                $("#cod_pro1").val(ui.item.cod_pro);
                $("#cod_ref1").val(ui.item.cod_ref);
                $("#cod_ref2").val(ui.item.cod_ref);
                $("#cod_ref1").attr('onkeyup', 'verifyProd(this.value,1)');
                $('#opt1').html(ui.item.und_emp1);
                $('#img_pro1Auto').attr('class', 'col-md-3 col-sm-12');
                $('#img_pro1Auto').html('Imagen actual<br><img width = "100" heigth = "100" src = "../../documentos/cotizador/images/' + ui.item.img_pro + '">');
                if (ui.item.sin_dev == 1) {
                    $("#sin_dev1").attr('checked', '');
                    $("#sin_dev1").attr('value', '1');
                }
                $('#btnProducto').removeAttr('disabled');
                $('#foto1').html('Seleccionar');
            }
        });
    }
}

function autoCont() {
    $("#nom_cont3").autocomplete({
        source: '../autocomplete/cotizadorv2/contactos/buscador.php',
        minLength: 3,
        select: function(event, ui) {
            $("#nom_cont2").val(ui.item.nom_cont);
            $("#id_cli2").val(ui.item.id_cli);
            $("#id_cont2").val(ui.item.id_cont);
            $("#nom_cli2").val(ui.item.nom_cli);
            $("#eml_cont2").val(ui.item.eml_cont);
            $("#car_cont2").val(ui.item.car_cont);
            $("#tel_cont22").val(ui.item.tel_cont);
            $("#tel_cont2").val(ui.item.tel_cont2);
            $('#btnContacto').removeAttr('disabled');
        }
    });
}

function get_clientes() {
    var id_cli = document.getElementById("id_cli").value;
    if (id_cli) {
        $.ajax({
            type: 'POST',
            url: '../cotizadorv2/cotizaciones.controller.php',
            data: { id_cli, action: 'contacto' },
            success: function(resp) {
                $('#id_cont').html(resp);
            }
        });
    }
}

function remCiu(param) {
    $.ajax({
        url: '../cotizadorv2/cotizaciones.controller.php',
        type: 'POST',
        data: { action: 'remCiu' },
        success: function(resp) {
            $('#remCiu1').html(resp);
            $('#rem_ciu').attr('onclick', 'remCiu2(1);');
        }
    });
}

function remCiu2(param) {
    $('#remCiu1').html('');
    $('#rem_ciu').attr('onclick', 'remCiu(2);');
}

function crearCotizacion(param) {
    if (validarCampos('form-cotizaciones') == 0) {
        var r = confirm("Estas seguro de crear Cotización");
        if (r == true) {
            var id_cli = document.getElementById("id_cli").value,
                id_cont = document.getElementById("id_cont").value,
                dia_ent = document.getElementById("dia_ent").value,
                for_pag = document.getElementById("for_pag").value,
                id_ciu = document.getElementById("id_ciu").value,
                tip_cot = document.getElementById("tip_cot").value,
                val_cot = document.getElementById("val_cot").value,
                ced_ase = document.getElementById("ced_ase").value,
                ced_sac = document.getElementById("ced_sac").value,
                est_mar = document.getElementById("est_mar").value,
                action = document.getElementById("accion_form").value;
            var iva = $('#cot_iva').is(':checked');
            if (
                ced_ase != "" ||
                ced_sac != ""
            ) {
                if (!iva) {
                    var iva = 0;
                } else {
                    var iva = 1;
                }
                var remitir = $('#rem_ciu').is(':checked');
                if (!remitir) {
                    remitir = 0;
                    var rem_ciu = 'NA';
                } else {
                    remitir = 1;
                    var rem_ciu = $('#remCiu').val();
                }

                var productos = [];
                var precios = [];
                var descripciones = [];
                var nombres = [];
                var observaciones = [];
                var cantidad = [];
                var margen = [];
                var childrens = document.getElementById("table").rows;
                if (childrens.length <= 1) {
                    alert("Necesitas tener una lista de productos");
                } else {
                    for (var i = 1; i < childrens.length; i++) {
                        var id_order = childrens[i].getAttribute("id");
                        productos.push(id_order);
                        var prec = childrens[i].cells[5].innerHTML;
                        precios.push(prec);
                        var desc = childrens[i].cells[1].innerHTML;
                        descripciones.push(desc);
                        var nomb = childrens[i].cells[0].innerHTML;
                        nombres.push(nomb);
                        var cant = childrens[i].cells[6].innerHTML;
                        cantidad.push(cant);
                        var obs_cot = childrens[i].cells[2].innerHTML;
                        observaciones.push(obs_cot);
                        var marg = childrens[i].cells[7].innerHTML;
                        margen.push(marg);
                    }
                    var data = {
                        id_cli: id_cli,
                        id_cont: id_cont,
                        dia_ent: dia_ent,
                        for_pag: for_pag,
                        id_ciu: id_ciu,
                        est_mar: est_mar,
                        tip_cot: tip_cot,
                        val_cot: val_cot,
                        ced_ase: ced_ase,
                        ced_sac: ced_sac,
                        productos: productos,
                        precios: precios,
                        descripciones: descripciones,
                        nombres: nombres,
                        cantidad: cantidad,
                        observaciones: observaciones,
                        iva: iva,
                        action: action,
                        remitir: remitir,
                        margen: margen,
                        rem_ciu: rem_ciu
                    }
                    $.ajax({
                        url: '../cotizadorv2/cotizaciones.controller.php',
                        type: 'POST',
                        data: data,
                        success: function(resp) {
                            if (resp == 1) {
                                $.ajax({
                                    url: '../cotizadorv2/cotizaciones.controller.php',
                                    type: 'POST',
                                    data: { action: 'add', verifi: 1 },
                                    success: function(resp) {
                                        window.open(resp, '_blank');
                                        $('#largeModal').modal('hide');
                                        $('#modal-title-sm').html('Crear Cotización');
                                        $('#modal-body-sm').html('Cotización creada correctamente.');
                                        $('#smallModal').modal('show');
                                        if (param == 2) {
                                            $('#modal-footer-sm').html('<button type="button" class="btn btn-default" onclick="refreshTable(18, ' + id_cli + ')" data-bs-dismiss="modal">Cerrar</button>');
                                        } else {
                                            $('#modal-footer-sm').html('<button type="button" class="btn btn-default" onclick="refreshTable(1, 0)" data-bs-dismiss="modal">Cerrar</button>');
                                        }
                                    }
                                }).done(function() {
                                    EnvioEmail();
                                });

                            } else {
                                $('#largeModal').modal('hide');
                                $('#modal-title-sm').html('Crear Cotización');
                                $('#modal-body-sm').html(resp);
                                $('#smallModal').modal('show');
                            }

                        }
                    });
                }
            } else {
                alert('Debes escoger el Asesor o Representate responsable');
            }
        }
    }
}

function EnvioEmail() {
    $.ajax({
        url: '../cotizadorv2/cotizaciones.controller.php',
        type: 'POST',
        data: { action: 'emailMargen' },
        success: function(resp) {
            console.log(resp);
        }

    });
}

function actualizarCotizacion() {
    if (validarCampos('form-cotizaciones') == 0) {
        var r = confirm("Estas seguro de Actualizar la Cotización");
        if (r == true) {
            var id_coti = document.getElementById("id_coti").value,
                id_cli = document.getElementById("id_cli").value,
                id_cont = document.getElementById("id_cont").value,
                dia_ent = document.getElementById("dia_ent").value,
                for_pag = document.getElementById("for_pag").value,
                id_ciu = document.getElementById("id_ciu").value,
                tip_cot = document.getElementById("tip_cot").value;
            val_cot = document.getElementById("val_cot").value;
            ced_ase = document.getElementById("ced_ase").value;
            ced_sac = document.getElementById("ced_sac").value;
            var iva = $('#cot_iva').is(':checked');
            if (
                ced_ase != "" ||
                ced_sac != ""
            ) {
                if (!iva) {
                    var iva = 0;
                } else {
                    var iva = 1;
                }
                var remitir = $('#rem_ciu').is(':checked');
                if (!remitir) {
                    remitir = 0;
                    var rem_ciu = 'NA';
                } else {
                    remitir = 1;
                    var rem_ciu = $('#remCiu').val();
                }
                var productos = [];
                var precios = [];
                var descripciones = [];
                var observaciones = [];
                var nombres = [];
                var cantidad = [];
                var margen = [];
                var childrens = document.getElementById("table").rows;
                if (childrens.length <= 1) {
                    alert("necesitas tener una lista de productos");
                } else {
                    for (var i = 1; i < childrens.length; i++) {
                        var id_order = childrens[i].getAttribute("id");
                        productos.push(id_order);
                        var prec = childrens[i].cells[5].innerHTML;
                        precios.push(prec);
                        var desc = childrens[i].cells[1].innerHTML;
                        descripciones.push(desc);
                        var nomb = childrens[i].cells[0].innerHTML;
                        nombres.push(nomb);
                        var cant = childrens[i].cells[6].innerHTML;
                        cantidad.push(cant);
                        var obs_cot = childrens[i].cells[2].innerHTML;
                        observaciones.push(obs_cot);
                        var marg = childrens[i].cells[7].innerHTML;
                        margen.push(marg);
                    }
                    var data = {
                        id_coti: id_coti,
                        id_cli: id_cli,
                        id_cont: id_cont,
                        dia_ent: dia_ent,
                        for_pag: for_pag,
                        id_ciu: id_ciu,
                        tip_cot: tip_cot,
                        val_cot: val_cot,
                        ced_ase: ced_ase,
                        ced_sac: ced_sac,
                        productos: productos,
                        precios: precios,
                        descripciones: descripciones,
                        nombres: nombres,
                        cantidad: cantidad,
                        observaciones: observaciones,
                        iva: iva,
                        remitir: remitir,
                        rem_ciu: rem_ciu,
                        margen: margen,
                        action: 'updateCot'
                    }
                    $.ajax({
                        url: '../cotizadorv2/cotizaciones.controller.php',
                        type: 'POST',
                        data: data,
                        success: function(resp) {
                            if (resp == 1) {
                                $.ajax({
                                    url: '../cotizadorv2/cotizaciones.controller.php',
                                    type: 'POST',
                                    data: { action: 'updateCot', verifi: 2, id_coti },
                                    success: function(resp) {
                                        window.open(resp, '_blank');
                                        $('#largeModal').modal('hide');
                                        $('#modal-title-sm').html('Actualizar Cotización');
                                        $('#modal-body-sm').html('<div align="center"><br> Cotización Actualizada correctamente.<br><br></div>');
                                        $('#smallModal').modal('show');
                                        $('#btn-footer-sm').html('<button type="button" class="btn btn-default" onclick="refreshTable(1)" data-bs-dismiss="modal">Cerrar</button>');
                                        //alert("Cotización creada");

                                    }
                                });

                            } else {
                                $('#largeModal').modal('hide');
                                $('#modal-title-sm').html('Crear Cotizaición');
                                $('#modal-body-sm').html(resp);
                                $('#smallModal').modal('show');
                            }

                        }
                    });
                }
            } else {
                alert('Debes escoger el Asesor o Representate responsable');
            }
        }
    }
}