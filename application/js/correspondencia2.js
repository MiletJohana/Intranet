function crearCorr(id_cli) {
    $('#modal-title-lg').html("Correspondencia");
    $.ajax({
        url: '../correspondencia2/form.php',
        type: 'POST',
        data: {
            resp: 1,
            id_cli: id_cli
        },
        success: function(resp) {
            $('#modal-body-lg').html(resp);
        }
    });
    $.ajax({
        url: '../correspondencia2/boton.php',
        type: 'POST',
        data: {
            resp: 1,
            id_cli: id_cli
        },
        success: function(resp) {
            $('#modal-footer-lg').html(resp);
        }
    });
}

function agregarCorr(id_cli) {
    if (validarCampos('form-corres') == 0 && $('#nom_cli').val() != '') {
        Swal.fire({
            title: 'Esta seguro de crear esta correspondencia, Recuerde solo dar un click',
            icon: "question",
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false,
            showDenyButton: true,
            confirmButtonText: "Si, crear",
            denyButtonText: `No`
        }).then((result) => {
            if (result.isConfirmed) {
                var formIngreso = new FormData($("#form-corres")[0]);
                $.ajax({
                    url: '../correspondencia2/correspondencia.controller.php',
                    data: formIngreso,
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    success: function(resp) {
                        if (resp.substr(0, 1) == 1) {
                            $('#largeModal').modal('hide');
                            $('#modal-title-lg-2').html('Correspondencia Masiva');
                            $('#modal-body-lg-2').html(resp.substr(1));
                            $('#smallModal').modal('show');
                            if (id_cli == 0) {
                                $('#modal-footer-sm').html('<button type="button" class="btn btn-secondary" onclick="refreshTableCor(1, 0)" data-bs-dismiss="modal">Cerrar</button>');
                            } else {
                                $('#modal-footer-sm').html('<button type="button" class="btn btn-secondary" onclick="refreshTableCor(5, ' + id_cli + ')" data-bs-dismiss="modal">Cerrar</button>');
                            }
                        } else {
                            $('#largeModal').modal('hide');
                            $('#modal-title-sm').html('Correspondencia Creada');
                            $('#modal-body-sm').html(resp);
                            $('#smallModal').modal('show');
                            if (id_cli == 0) {
                                $('#btn-footer-sm').attr('onclick', 'refreshTableCor(1, 0)');
                            } else {
                                $('#btn-footer-sm').attr('onclick', 'refreshTableCor(5,' +id_cli+');');
                            }
                        }
                    }
                });
            }
        });
    }
}

function provedor() {
    var id_prove = document.getElementById('id_provedorAuto').value;
    $.ajax({
        type: "POST",
        url: "../correspondencia2/correspondencia.controller.php",
        data: { action: 'provedo', id_prove },
        success: function(resp) {
            if (resp == 1) {
                $('#id_provedorAuto').css("border", "1px solid red");
                $('#btnAgregar').attr('disabled', "true");
                $('#btnActualizar').attr('disabled', "true");
            } else if (resp == 2) {
                $('#id_provedorAuto').css("border", "1px solid green");
                $('#btnAgregar').removeAttr('disabled');
                $('#btnAcatualizar').removeAttr('disabled');
            }
        }
    });
}

function verificarPass(value) {
    if (value == 1) {
        var val_con = $('#val_con').val();
    } else {
        var val_con = $('#val_con2').val();
    }
    $.ajax({
        type: "POST",
        url: "../correspondencia2/correspondencia.controller.php",
        data: { action: 'password', val_con: val_con },
        success: function(resp) {
            if (resp == 2) {
                if (value == 1) {
                    $('#val_con').css("border", "1px solid red");
                } else if (value == 2) {
                    $('#val_con2').css("border", "1px solid red");
                }
                $('#btnAgregar').attr('disabled', "true");
                $('#btnActualizar').attr('disabled', "true");
                $('#buton_prov').attr('disabled', "true");
                $('#buton_can').attr('disabled', "true");

            } else {
                if (value == 1) {
                    $('#val_con').css("border", "1px solid green");
                } else if (value == 2) {
                    $('#val_con2').css("border", "1px solid green");
                }
                $('#btnAgregar').removeAttr('disabled');
                $('#btnActualizar').removeAttr('disabled');
                $('#buton_prov').removeAttr('disabled');
                $('#buton_can').removeAttr('disabled');
            }
        }
    })
}

function appear(value, resp) {
    if (value == 1 || value == 10) {
        if (resp == 1) {
            var data = { resp: 1, value: value, carg: 1 };
            $('#carg_mas').attr('onclick', 'appear(1,2)');
            $('#accion_form').attr('value', 'cargMasiv');
            $('#vis').css('display', 'none');
            $('#form-prove').css('display', 'none');

        } else {
            var data = { resp: 1, value: value };
            $('#carg_mas').attr('onclick', 'appear(1,1)');
            $('#accion_form').attr('value', 'add');
            $('#vis').css('display', 'block');
            $('#form-prove').css('display', 'block');
        }
        $.ajax({
            url: '../correspondencia2/fact.php',
            type: 'POST',
            data: data,
            success: function(resp) {
                $('#mp').html(resp);
                $('#btnAgregar').attr('onclick', 'agregarCorr(0);');

            }
        });
    } else if (value == 7 || value == 8 || value == 9) {
        $.ajax({
            url: '../correspondencia2/simCaja.php',
            type: 'POST',
            data: { resp: 1, value: value },
            success: function(resp) {
                $('#mp').html(resp);
                $('#btnAgregar').attr('onclick', 'agregarCaja(1);');
                $('#accion_form').val('addCaj');
                $('#vis').css('display', 'none');
            }
        });
    } else {
        $("#mp").html('');
        $("#pro").html('');
        $("#doc").html('');
        $('#btnAgregar').attr('onclick', 'agregarCorr(0);');

    }
}

function remove() {
    $('#pro').html('');
    $('#buton_prov').attr('onclick', 'appear(2)');
    $('#id_provedor').attr('readonly', '');
    $('#d_v').attr('readonly', '');
}


function agregarCaja(param) {
    if (param == 1) {
        var action = 'add';
        var id_seg = null;
    } else {
        var action = 'updateForm';
        var id_seg = document.getElementById('id_seg').value;
    }
    console.log(action);
    var formIngreso = new FormData($("#form-corres")[0]);
    if (validarCampos('form-corres') == 0) {
        $.ajax({
            url: '../correspondencia2/correspondencia.controller.php',
            data: formIngreso,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function(respCaj) {
                if (respCaj == 1) {
                    var id_prov = document.getElementsByName('id_provedor[]');
                    var nom_pro = document.getElementsByName('nom_provedor[]');
                    var num_fac = document.getElementsByName('num_faR[]');
                    var val_tot = document.getElementsByName('val[]');
                    var jus = document.getElementsByName('jus[]');
                    var doc_caj = document.getElementsByName('doc_ocu[]');
                    var nom_fac = document.getElementById('nom_fac').value;
                    var fec_rec = document.getElementById('fec_rec').value;
                    var area_n = document.getElementById('area_n').value;
                    var per_enc = document.getElementById('per_enc').value;
                    var justi = document.getElementById('justi').value;
                    var fac_regi = document.getElementById('fac_regi').value;
                    var id_provedor = document.getElementById('id_cli').value;
                    var id = [];
                    var num = [];
                    var valu = [];
                    var just = [];
                    var docu = [];
                    for (var i = 0; i < nom_pro.length; i++) {
                        id.push(id_prov[i].value);
                        num.push(num_fac[i].value);
                        valu.push(val_tot[i].value);
                        just.push(jus[i].value);
                        docu.push(doc_caj[i].value);
                        console.log(docu);
                    }

                    var data = {
                        id_seg: id_seg,
                        id: id,
                        num: num,
                        valu: valu,
                        nom_fac: nom_fac,
                        fec_rec: fec_rec,
                        area_n: area_n,
                        per_enc: per_enc,
                        justi: justi,
                        fac_regi: fac_regi,
                        id_provedor: id_provedor,
                        docu: docu,
                        just: just,
                        action: action
                    }

                    $.ajax({
                        url: '../correspondencia2/correspondencia.controller.php',
                        type: 'POST',
                        data: data,
                        success: function(data) {
                            console.log(data);
                            $('#largeModal').modal('hide');
                            $('#modal-title-sm').html('Crear Correspondencia');
                            $('#modal-body-sm').html(data);
                            $('#smallModal').modal('show');
                            $('#btn-footer-sm').attr('onclick', 'refreshTableCor(1)');
                        }
                    });
                } else {
                    $('#largeModal').modal('hide');
                    $('#modal-title-sm').html('Crear Correspondencia');
                    $('#modal-body-sm').html(respCaj);
                    $('#smallModal').modal('show');
                    $('#btn-footer-sm').attr('onclick', 'refreshTableCor(1)');
                }
            }
        });
    }
}

function crear(value) {
    if (value == 1) {
        $('#buton_prov').attr("class", "btn btn-danger ms-auto");
        $('#buton_prov').attr("onclick", "crearCliente(3);");
        $.ajax({
            url: '../correspondencia2/prove.php',
            type: 'POST',
            data: { resp: 1 },
            success: function(resp) {
                $('#pro').html(resp);
                $('#tip_doc').removeAttr('disabled');
                $('#num_doc').removeAttr('readonly');
                $('#search').removeAttr('onkeyup');
                $('#num_doc').attr("onkeyup", "verificarcli();");
                $('#buton_prov').attr("disabled", "true");
            }
        });
    } else if (value == 2) {
        $('#buton_prov').attr("class", "btn btn-primary ms-auto");
        $('#buton_prov').attr("onclick", "crear(1);");

        $('#buton_prov').removeAttr("disabled");
        $('#search').attr("onkeyup", "buscarCliente(2);");

        $('#pro').html('');
        $('#num_doc').attr('readonly', '');
        $('#tip_doc').attr('disabled', '');
        $('#num_doc').css("border", "");
    }
}

function recibirFac() {
    $('#modal-title-lg').html("Correspondencia");
    $.ajax({
        url: '../correspondencia2/formEntrega.php',
        type: 'POST',
        data: { resp: 3 },
        success: function(resp) {
            $('#modal-body-lg').html(resp);
        }
    });
    $.ajax({
        url: '../correspondencia2/boton.php',
        type: 'POST',
        data: { resp: 3 },
        success: function(resp) {
            $('#modal-footer-lg').html(resp);
        }
    });
}

function auto() {
    $("#nom_provedorAuto").autocomplete({
        source: '../autocomplete/correspondencia2/buscador.php',
        minLength: 3,
        select: function(event, ui) {
            $("#id_provedorAuto").val(ui.item.id_prove);
            $("#id_provedor").val(ui.item.id_prove);
            $("#id_prov").val(ui.item.id_prove);
            $('#nom_provedorAuto').val(ui.item.nom_pro);
            $('#nom_provedor').val(ui.item.nom_pro);
            $('#d_vAuto').val(ui.item.dig_ver);
            $('#d_v').val(ui.item.dig_ver);
            $('#d_vAuto').attr('readonly', '');
            $("#id_provedorAuto").attr('readonly', '');
            $('#id_provedor').val(ui.item.id_prove);
        }
    });
}

function auto2(param) {
    $("#search").autocomplete({
        source: '../autocomplete/clientes2/buscador.php',
        minLength: 3,
        select: function(event, ui) {
            var newRow = tabla.insertRow(tabla.length),
                cell1 = newRow.insertCell(0),
                cell2 = newRow.insertCell(1),
                cell3 = newRow.insertCell(2),
                cell4 = newRow.insertCell(3),
                cell5 = newRow.insertCell(4),
                cell6 = newRow.insertCell(5),
                cell7 = newRow.insertCell(6);
            cell1.innerHTML = '<input type="number" class="form-control" " name="id_provedor[]" value="' + ui.item.num_doc + '" readonly >';
            cell2.innerHTML = '<input type="text" class="form-control"  name="nom_provedor[]" value="' + ui.item.value + '" readonly >';
            cell3.innerHTML = '<input type="text" class="form-control"  name="num_faR[]" value="" >';
            cell4.innerHTML = '<input type="text" class="form-control" name="val[]" value="" >';
            cell5.innerHTML = '<input type="text" class="form-control" name="jus[]" value="" >';
            cell6.innerHTML = '<div class="fileUpload btn btn-primary btn-sm"><span id="fac' + param + '"> Seleccionar Archivo</span><input type="file" name="doc_caj[]" id="doc_caj' + param + '" onchange="doc(' + param + ');" class="upload" accept="application/pdf"><input type="hidden" name="doc_ocu[]" id="doc_ocu' + param + '"  value=""></div>';
            cell7.innerHTML = '<a id="but_x" name="but_x" class="btn btn-danger btn-sm mb-3" required onclick="eliminarFac(' + ui.item.id_cli + param + ');"><i class="fa-solid fa-close" style="color: #ffffff;"></i></a>';
            newRow.setAttribute("id", ui.item.id_cli + param);
            if (param == 1) {
                $("#id_cli").val(ui.item.id_cli);
            }
            var suma = param + 1;
            $('#search').attr('onkeyup', 'auto2(' + suma + ')');
        }
    });
}

function doc(param) {
    if (param > 99) {
        var docum = "Actualizado";
    } else {
        var docum = "Documento Cargado";
    }
    var nom = document.getElementById('doc_caj' + param).files[0].name;
    document.getElementById('fac' + param).innerHTML = docum;
    $('#doc_ocu' + param).val(nom);
}

function eliminarFac(value) {
    var r = confirm("Estas seguro que deseas eliminar este campo");
    if (r == true) {
        $('#' + value).remove();
    }
}

function usuarios(value) {
    $.ajax({
        url: '../correspondencia2/correspondencia.controller.php',
        type: 'POST',
        data: { action: 'usuario', value: value },
        success: function(resp) {
            $('#per_enc').html(resp);
        }
    });
}

function mostrarCorr(id, id_estSeg) {
    $('#modal-title-lg').html('Seguimiento');
    $.ajax({
        url: '../correspondencia2/seguimiento.php',
        data: { resp: 4, id_seg: id, id_estSeg: id_estSeg },
        type: 'POST',
        success: function(resp) {
            $('#modal-body-lg').html(resp);
        }
    });
    $.ajax({
        url: '../correspondencia2/boton.php',
        type: 'POST',
        data: { resp: 0, id_estSeg: id_estSeg },
        success: function(boton) {
            console.log(boton)
            $('#modal-footer-lg').html(boton);
        }
    });
}

function entregarCorr(id, id_estSeg, id_nom, id_prove) {
    $('#modal-title-lg').html('Información');
    $.ajax({
        url: '../correspondencia2/informacion.php',
        data: { resp: 5, id_seg: id, id_estSeg: id_estSeg },
        type: 'POST',
        success: function(resp) {
            $('#modal-body-lg').html(resp);
            $('#largeModal-dialog').attr('style', 'min-width:1200px');
        }
    });
    $.ajax({
        url: '../correspondencia2/boton.php',
        type: 'POST',
        data: { resp: 5, id_estSeg: id_estSeg, id_seg: id, id_nom, id_prove },
        success: function(boton) {
            $('#modal-footer-lg').html(boton);
            $('#btnRemit').attr('onclick', 'remitirCorr()');
        }
    });
}

function remitirCorr() {
    if (validarCampos('form-remit') == 0) {
        var informacion = new FormData($("#form-remit")[0]);
        $.ajax({
            url: '../correspondencia2/correspondencia.controller.php',
            data: informacion,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function(resp) {
                $('#error-validation').html(resp);
                $('#largeModal').modal('hide');
                $('#modal-title-sm').html('Seguimiento Actualizado');
                $('#modal-body-sm').html(resp);
                $('#smallModal').modal('show');
                $('#modal-footer-sm').html('<button type="button" class="btn btn-secondary" onclick="refreshTableCor(1, 0)" data-bs-dismiss="modal">Cerrar</button>');
            }
        });
    }
}

function editarCorr(id, id_estSeg, id_nom, id_prove) {
    $('#modal-title-lg').html('Edición Correspondencia');
    $.ajax({
        url: '../correspondencia2/form.php',
        type: 'POST',
        data: { resp: 6, id_seg: id, id_estSeg: id_estSeg, value: id_estSeg, id_nom: id_nom, id_cli: id_prove },
        success: function(resp) {
            $('#modal-body-lg').html(resp);
            $('#largeModal-dialog').attr('style', 'min-width:1200px');
            if (id_nom == 7 || id_nom == 8 || id_nom == 9) {
                $('#accion_form').attr('value', 'addCaj');
            }
        }
    });
    $.ajax({
        url: '../correspondencia2/boton.php',
        type: 'POST',
        data: { resp: 6 },
        success: function(resp) {
            $('#modal-footer-lg').html(resp);
            if (id_nom == 7 || id_nom == 8 || id_nom == 9) {
                $('#btnActualizar').attr('onclick', 'agregarCaja(2)');
            } else {
                $('#btnActualizar').attr('onclick', 'actualiCorr()');
            }
        }
    });
}

function actualiCorr() {
    var formIngreso = new FormData($("#form-corres")[0])
    for (var value of formIngreso.values()) {
        console.log(value);
    }
    $.ajax({
        url: '../correspondencia2/correspondencia.controller.php',
        data: formIngreso,
        type: 'POST',
        contentType: false,
        processData: false,
        success: function(resp) {
            $('#error-validation').html(resp);
            $('#largeModal').modal('hide');
            $('#modal-title-sm').html('Seguimiento Actualizado');
            $('#modal-body-sm').html(resp);
            $('#smallModal').modal('show');
            $('#modal-footer-sm').html('<button type="button" class="btn btn-secondary" onclick="refreshTableCor(4, 0)" data-bs-dismiss="modal">Cerrar</button>');
        }
    })
}



function misCorres(val) {
    if (val == 1) {
        $.ajax({
            url: '../correspondencia2/tabla.php',
            type: 'POST',
            data: { misC: 1 },
            success: function(resp) {
                $('#content-table').html(resp);
                $(document).ready(function() {
                    $('#datatable').dataTable({
                        "ordering": false,
                        "language": {
                            "sProcessing": "Procesando...",
                            "sLengthMenu": "Mostrar _MENU_ Cotizaciones",
                            "sZeroRecords": "No se encontraron Cotizaciones",
                            "sEmptyTable": "Ningún dato disponible en esta tabla",
                            "sInfo": "Mostrando Cotizaciones del _START_ al _END_ de un total de _TOTAL_ Cotizaciones",
                            "sInfoEmpty": "Mostrando Cotizaciones del 0 al 0 de un total de 0 Cotizaciones",
                            "sInfoFiltered": "(filtrado de un total de _MAX_ Cotizaciones)",
                            "sInfoPostFix": "",
                            "sSearch": "Buscar:",
                            "sUrl": "",
                            "sInfoThousands": ",",
                            "sLoadingRecords": "Cargando...",
                            "oPaginate": {
                                "sFirst": "Primero",
                                "sLast": "Último",
                                "sNext": "Siguiente",
                                "sPrevious": "Anterior"
                            },
                            "oAria": {
                                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                            }
                        }
                    });
                });
            }
        });
    } else {
        $.ajax({
            url: '../correspondencia2/tabla.php',
            type: 'POST',
            data: { mis: 1 },
            success: function(resp) {
                $('#content-table').html(resp);
                $('#MC').html('Mis Correspondencias');
                $('#MC').attr('class', 'btn btn-success btn-sm');
                $('#MC').attr('onclick', 'misCorres(1)');
                $(document).ready(function() {
                    $('#datatable').dataTable({
                        "ordering": false,
                        "language": {
                            "sProcessing": "Procesando...",
                            "sLengthMenu": "Mostrar _MENU_ Cotizaciones",
                            "sZeroRecords": "No se encontraron Cotizaciones",
                            "sEmptyTable": "Ningún dato disponible en esta tabla",
                            "sInfo": "Mostrando Cotizaciones del _START_ al _END_ de un total de _TOTAL_ Cotizaciones",
                            "sInfoEmpty": "Mostrando Cotizaciones del 0 al 0 de un total de 0 Cotizaciones",
                            "sInfoFiltered": "(filtrado de un total de _MAX_ Cotizaciones)",
                            "sInfoPostFix": "",
                            "sSearch": "Buscar:",
                            "sUrl": "",
                            "sInfoThousands": ",",
                            "sLoadingRecords": "Cargando...",
                            "oPaginate": {
                                "sFirst": "Primero",
                                "sLast": "Último",
                                "sNext": "Siguiente",
                                "sPrevious": "Anterior"
                            },
                            "oAria": {
                                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                            }
                        }
                    });
                });
            }
        });
    }
}

function aceptado(id_seg, nom_fac, id_provedor, id_estSeg) {
    var action = "aceptado";
    $.ajax({
        url: '../correspondencia2/correspondencia.controller.php',
        type: 'POST',
        data: { id_seg, action, nom_fac, id_provedor },
        success: function(resp) {
            if (resp == 1) {
                console.log(resp);
                $("#estReci" + id_seg).attr("disabled","");
                refreshTableCor(1);
                alertaSuccessCorres(id_seg, id_estSeg, 'Correspondencia ' + id_seg + ' actualizada correctamente');
           
            } else {
                alertError('No se ha podido modificar');
            }
        }
    });
}

function finalizado(id_seg, nom_fac, id_provedor) {
    var action = "finalizado";
    $.ajax({
        url: '../correspondencia2/correspondencia.controller.php',
        type: 'POST',
        data: { id_seg, action, nom_fac, id_provedor },
        success: function(resp) {
            if (resp == 1) {
                $("#estFin" + id_seg).attr("disabled", "");
                alertSuccess('Correspondencia ' + id_seg + ' finalizada correctamente', '', 1);
            } else {
                alertError('No se ha podido modificar' +resp);
            }
        }
    });
}

function refreshTableCor(param, id_cli) {
    if (param == 5) {
        $.ajax({
            url: "../clientes2/perfil.php",
            type: 'GET',
            data: { id: id_cli },
            success: function(resp) {
                $('#content-table').html(resp);
            }
        });
    } else {
        if (param == 1) {
            url = '../correspondencia2/tabla.php';
        } else if (param == 2) {
            url = '../correspondencia2/tabla2.php';
        } else if (param == 4) {
            url = '../correspondencia2/tabla4.php';
        }
        $.ajax({
            url: url,
            type: 'POST',
            data: { resp: 1 },
            success: function(resp) {
                $('#content-table').html(resp);
            }
        });
    }
}

function contaCorr(id_seg, id_nom, id_prove) {
    var r = confirm("¿Está seguro de contabilizar ésta solicitud?");
    if (r == true) {
        $.ajax({
            url: '../correspondencia2/correspondencia.controller.php',
            type: 'POST',
            data: { action: 'updateConta', id_seg, id_nom, id_prove },
            success: function(resp) {
                $('#smallModal').modal('show');
                $('#modal-footer-sm').html('<button type="button" class="btn btn-secondary" onclick="refreshTableCor(2, 0)" data-bs-dismiss="modal">Cerrar</button>');
                $('#largeModal').modal('hide');
                $('#modal-title-sm').html('Seguimiento Actualizado');
                $('#modal-body-sm').html(resp);

            }
        });
    }
}

function filtroCorr(params, table) {
    var param = params.split(',');
    var para = [];
    for (var i = 0; i < param.length; i++) {
        para.push($('#' + param[i]).val());
        // console.log(para[i]);
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

function confirmarEliminarCorr(id_seg) {
    $.ajax({
        type: 'POST',
        success: function() {
            $('#largeModal').modal('hide');
            $('#modal-title-sm').html('Eliminar Correspondencia');
            $('#modal-body-sm').html('¿Está seguro de Eliminar la Correspondencia No.'+id_seg+'?');
            $('#smallModal').modal('show');
        }
    });
    $.ajax({
        url: '../correspondencia2/boton.php',
        type: 'POST',
        data: { resp: 8},
        success: function(boton) {
            $('#modal-footer-sm').html(boton);
            $('#btnEliminar').attr('onclick', 'eliminarCorr(' + id_seg + ');');
        }
    });
}

function eliminarCorr(id_seg) {
    $.ajax({
        url: '../correspondencia2/correspondencia.controller.php',
        type: 'POST',
        data: { action: 'eliminar', id_seg },
        success: function(resp) {
            $('#smallModal').modal('hide');
            alertSuccess(resp, '', 1);
            refreshTableCor(1);
        }
    });
}

function filter(resp) {
    let card_filter = document.getElementById('card_filter');
    let btn_filter = document.getElementById('btn_filter');
    if (resp == 1) {
        card_filter.classList.remove('d-none');
        btn_filter.innerHTML= '<i class="fa-solid fa-filter-circle-xmark me-2"></i> Ocultar Filtro';
        btn_filter.setAttribute('onclick', 'filter(2);');
    } else {
        card_filter.classList.add('d-none');
        btn_filter.innerHTML= '<i class="fa-solid fa-filter me-2"></i> Filtrar';
        btn_filter.setAttribute('onclick', 'filter(1);');
    }
}
function filter_his(resp) {
    var table = $('#tableCorrespondencia4').DataTable();
    table.ajax.reload();
}