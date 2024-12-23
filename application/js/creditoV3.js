function auto(opcion) {
    if(opcion == 1){
        vaciarCampos();
        $("#nom_clie").autocomplete({
            source: '../autocomplete/creditov3/buscador.php',
            minLength: 3,
            select: function(event, ui) {
                $("#id_cli").val(ui.item.id_cli);
                $("#id_nit").val(ui.item.num_doc);
                $("#nom_com").val(ui.item.con_cli);
                $("#celCli").val(ui.item.tel_cli);
                $("#dirEmp").val(ui.item.dir_cli);
                $("#eml_cli").val(ui.item.eml_cli);
                $("#nom_clie1").val(ui.item.nom_cli);
                $("#Actsol").removeAttr("disabled");
                $("#nom_com").removeAttr("disabled");
                //$("#btn-editUsu").removeAttr("disabled");
                $("#telcon").val('');
                $("#correo_cont").val('');
                $("#car_cont").val('');
                autoContactos(ui.item.id_cli, 1, '');
            }
            
        });
    }
    else if(opcion == 2){
        $("#nomAse").autocomplete({
            source: '../autocomplete/creditov3/buscador2.php',
            minLength: 3,
            select: function(event, ui) {
                $("#nomAse").val(ui.item.nom_usu);
                $("#aseCom").val(ui.item.id_usu);
                $("#aseCom").attr('readonly', '');
            }
        });
    }
    else if(opcion == 3){
        $("#nomSac").autocomplete({
            source: '../autocomplete/creditov3/buscador3.php',
            minLength: 3,
            select: function(event, ui) {
                $("#nomSac").val(ui.item.nom_usu);
                $("#aseSac").val(ui.item.id_usu);
                $("#aseSac").attr('readonly', '');
            }
        });
    }
}

function numberFormat(e) {
    if (e.value.trim()=="" || e.value.trim()=="-") {
        return;
    }
    // Obtenemos un array con el numero y los decimales si hay
    let contenido = e.value.replace(/[^0-9\.]/g, "").split(",");
 
    // añadimos los separadores de miles al primer numero del array
    contenido[0] = contenido[0].length ? new Intl.NumberFormat('es-MX').format(parseInt(contenido[0])) : "0";
 
    // Juntamos el numero con los decimales si hay decimales
    let resultado=contenido.length>1 ? contenido.slice(0, 2).join(".") : contenido[0];
    e.value=e.value[0]=="-" ? "-"+resultado : resultado;

}

function autoContactos(id, opcion, id_sol, id_est){
    $.ajax({
        url: '../creditoV3/selectContactos.php',
        type: 'POST',
        data: { id_cli: id, opcion: opcion, id_sol, id_est },
        success: function (resp) {
            $('#select_contact').html(resp);
        }
    });
}

function selectContact(id) {
    var id_cont = id;
    $.ajax({
        url: '../creditoV3/selectContactos.php',
        type: 'POST',
        dataType: 'json',
        data: { id_cont: id, opcion: 2 },
        success: function (datos) {
            $("#nom_com1").val(datos['nom_cont']);
            $("#telcon").val(datos['tel_cont']);
            $("#correo_cont").val(datos['eml_cont']);
            $("#car_cont").val(datos['car_cont']);
        }
    });
    
}

//Creacion de cliente durante el proceso de diligencia
function crearClientCred(action) {
    $('#modal-title-lg').html("Crear Cliente");
    
    $.ajax({
        url: '../clientes2/form.php',
        type: 'POST',
        data: { resp: 1, action: action },
        beforeSend: function() {
            $('#modal-body-lg').html('<div class="d-flex flex-column align-items-center"><img src="../../resources/img/loader.gif" alt="Cargando..." width="40px"><p class="mt-2">Cargando....</p></div>'); 
        },
        success: function (resp) {
            $('#modal-title-lg').html("Cliente nuevo"); 
            $('#modal-body-lg').html(resp);
        }
    });
    $.ajax({
        url: '../creditoV3/boton.php',
        type: 'POST',
        data: { resp: 20 },
        success: function (resp) {
            $('#modal-footer-lg').html(resp);
        }
    });
}

function editarClientCred() {
    $("#id_nit").removeAttr("readonly");
    $("#dirEmp").removeAttr("readonly");
    $("#telcon").removeAttr("readonly");
    $("#correo_cont").removeAttr("readonly");
    $("#car_cont").removeAttr("readonly");
    $("#eml_cli").removeAttr("readonly");
    $("#celCli").removeAttr("readonly");
    $("#TelF").removeAttr("readonly");
    $("#input_editNomClie").removeClass("none");
    $("#input_editNomCont").removeClass("none");
}

function crearContactCred(resp, id_cli, id_sol, id_est, param) {
    $('#modal-title-lg').html("Nuevo Contacto");
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
        url: '../creditoV3/boton.php',
        type: 'POST',
        data: {
            resp: 21,
            id_cli,
            id_sol,
            id_est,
            param
        },
        success: function (resp) {
            $('#modal-footer-lg').html(resp);
        }
    });
}

function crearContaCredito(param, id_cli, id_sol, id_est) {
    var formulario = new FormData($("#form-contacto")[0]);
    let nombreCont = $("#nom_cont").val();
    let emailCont = $("#eml_cont").val();
    let cargoCont = $("#id_conta").val();
    let telefonoCont = $("#tel_cont").val();

    if(nombreCont != "" && emailCont != "" && cargoCont != "" && telefonoCont != ""){
        $.ajax({
            url: '../contactos/contactos.controller.php',
            data: formulario,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function(resp) {
                console.log(resp);
                if(param == 5){
                    $('#modal-title-lg').html("Solicitud de crédito");
                    $.ajax({
                        url: '../creditoV3/tabsForm.php',
                        type: 'POST',
                        data: { resp: 1 },
                        success: function(resp) {
                            $('#modal-body-lg').html(resp);
                            $('#alert-newClient').html('<div class="alert alert-success alert-dismissible fade show mt-2 d-flex align-items-center" role="alert"><i class="fa-solid fa-circle-check me-3 fa-xl"></i>Contacto creado correctamente</div>');
                        }
                    });
                    $.ajax({
                        url: '../creditoV3/boton.php',
                        type: 'POST',
                        data: { resp: 1 },
                        success: function(boton) {
                            $('#modal-footer-lg').html(boton);
                        }
                    });
                } else if(param == 6){
                    $('#modal-title-lg').html('Edición de la Solicitud');
                    $.ajax({
                        url: '../creditoV3/tabsForm.php',
                        data: { resp: 7, id_sol: id_sol, id_est: id_est },
                        type: 'POST',
                        beforeSend: function() {
                            $('#modal-body-lg').html('<div class="d-flex flex-column align-items-center"><img src="../../resources/img/loader.gif" alt="Cargando..." width="40px"><p class="mt-2">Cargando....</p></div>'); 
                        },
                        success: function(resp) {
                            $('#modal-body-lg').html(resp);
                            $('#alert-newClient').html('<div class="alert alert-success alert-dismissible fade show mt-2 d-flex align-items-center" role="alert"><i class="fa-solid fa-circle-check me-3 fa-xl"></i>Contacto creado correctamente</div>');
                            autoContactos(id_cli, 3, id_sol);
                        }
                    });
                    $.ajax({
                        url: '../creditoV3/boton.php',
                        type: 'POST',
                        data: { resp: 9, id_est: id_est },
                        success: function(boton) {
                            $('#modal-footer-lg').html(boton);
                            $('#btnActual').attr('onclick', 'actuCrm();');
                
                        }
                    });
                }
            }
        });
    } else {
        alertError('Verifique los campos vacios');
    }
    
}

function crearCrm() {
    $('#modal-title-lg').html("Solicitud de crédito");
    $.ajax({
        url: '../creditoV3/tabsForm.php',
        type: 'POST',
        data: { resp: 1 },
        beforeSend: function() {
            $('#modal-body-lg').html('<div class="d-flex flex-column align-items-center"><img src="../../resources/img/loader.gif" alt="Cargando..." width="40px"><p class="mt-2">Cargando....</p></div>');         },
        success: function(resp) {
            $('#modal-body-lg').html(resp);
        }
    });
    $.ajax({
        url: '../creditoV3/boton.php',
        type: 'POST',
        data: { resp: 1 },
        success: function(boton) {
            $('#modal-footer-lg').html(boton);
        }
    });
}



function agregarCrm() {
    var nom_clie = document.getElementById('nom_clie');
    var certCon = $("#certCon").val();
    var copRu = $("#copRu").val();
    var refBan = $("#refBan").val();
    var form_cre = $("#form_cre").val();
    if(nom_clie.value != ""){
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
                        url: '../creditoV3/credito.controller.php',
                        data: formuIngComer,
                        type: 'POST',
                        contentType: false,
                        processData: false,
                        beforeSend: function() {
                            $('#largeModal').modal('hide');
                            cargar(1);
                        },
                        success: function(resp) {
                            cargar(2);
                            $('#modal-title-sm').html('Crear Solicitud');
                            $('#modal-body-sm').html(resp);
                            $('#smallModal').modal('show');
                            $('#modal-footer-sm').html('<a href="../creditoV3/index.php" class="btn btn-secondary">Cerrar</a>');
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
            if (refBan != "") { var refBan = ""; } else { var refBan = " Referencia Bancaria - "; }
            if (form_cre != "") { var form_cre = ""; } else { var form_cre = " Formulario de solicitud de credito"; }
            var texta = " Los archivos ";
            var texta2 = " no pueden estar vacios";
    
            alertError(texta.concat(certCon, copRu, refBan, form_cre, texta2));
        }
    } else{
        alertError('Debe seleccionar un cliente');
    }
   
}

function validacionEditCrm(id_sol, id_cli, rol, id_est) {
    $.ajax({
        url: '../creditoV3/consultas.php',
        type: 'POST',
        data: { resp: 1, id_sol: id_sol},
        success: function(resp) {
            // alert(resp +','+id_sol+','+id_cli+','+rol+','+id_est)
            if(resp != 0){
                actualizar1Crm(id_sol, id_est, rol);
            }
            else {
                EditarCrm(id_sol, id_cli, rol, id_est);
            }
        }
    });
}

function EditarCrm(id_sol, id_cli, rol, id_est) {
    $('#modal-title-lg').html("Resultado de Estudio de Crédito");
    $.ajax({
        url: '../creditoV3/tabsForm.php',
        type: 'POST',
        data: { resp: 2, id_sol: id_sol, id_cli: id_cli, rol: rol, id_est: id_est },
        beforeSend: function() {
            $('#modal-body-lg').html('<div class="d-flex flex-column align-items-center"><img src="../../resources/img/loader.gif" alt="Cargando..." width="40px"><p class="mt-2">Cargando....</p></div>'); 
        },
        success: function(resp) {
            $('#modal-body-lg').html(resp);
            autoContactos(id_cli, 3);
        }
    });
    $.ajax({
        url: '../creditoV3/boton.php',
        type: 'POST',
        data: { resp: 2 },
        success: function(boton) {
            $('#modal-footer-lg').html(boton);
            $('#btnpermiti1').attr('onclick', 'permisoEditar(' + id_sol + ',4);');
        }
    });
}

function modificarCrm() {
    var formuIngComer = new FormData($("#form-crm")[0]);
    for (var value of formuIngComer.values()) {
        console.log(value);
    }
    $.ajax({
        url: '../creditoV3/credito.controller.php',
        data: formuIngComer,
        type: 'POST',
        contentType: false,
        processData: false,
        beforeSend: function() {
            $('#largeModal').modal('hide');
            cargar(1);
        },
        success: function(resp) {
            cargar(2);
            $('#error-validation').html(resp);
            $('#modal-title-sm').html('Solicitud Actualizada');
            $('#modal-body-sm').html(resp);
            $('#smallModal').modal('show');
            $('#modal-footer-sm').html('<a href="../creditoV3/index.php" class="btn btn-secondary">Cerrar</a>');
        }
    });
}

function EditarSol(id_sol, id_cli, rol, id_est) {
    $('#modal-title-lg').html("Resultado de Estudio de Credito");
    $.ajax({
        url: '../creditoV3/tabsForm.php',
        type: 'POST',
        data: { resp: 3, id_sol: id_sol, id_cli: id_cli, rol: rol, id_est: id_est },
        success: function(resp) {
            $('#modal-body-lg').html(resp);
            $('#btnModificar').attr('onclick', 'confirmarActualizarSol(' + id_sol + ')');
            calcular();
        }
    });
    $.ajax({
        url: '../creditoV3/boton.php',
        type: 'POST',
        data: { resp: 3 },
        success: function(boton) {
            $('#modal-footer-lg').html(boton);
            $('#btnpermi').attr('onclick', 'permisoEditar(' + id_sol + ',3);');
        }
    });
}

function confirmarActualizarSol(id_sol) {
    $.ajax({
        type: 'POST',
        success: function() {
            $('#largeModal').modal('hide');
            $('#modal-title-sm').html('Aprobar Crédito');
            $('#modal-body-sm').html('Estas seguro de aprobar el crédito No.'+ id_sol);
            $('#smallModal').modal('show');
        }
    });
    $.ajax({
        url: '../creditoV3/boton.php',
        type: 'POST',
        data: { resp: 24},
        success: function(boton) {
            $('#modal-footer-sm').html(boton);
            $('#btnAprobar').attr('onclick', 'actualizarSol(' + id_sol + ');');
        }
    });
}

function actualizarSol() {
    var formuIngComer = new FormData($("#form-crm")[0]);
    for (var value of formuIngComer.values()) {
        console.log(value);
    }
    $.ajax({
        url: '../creditoV3/credito.controller.php',
        data: formuIngComer,
        type: 'POST',
        contentType: false,
        processData: false,
        success: function(resp) {
            $('#smallModal').modal('hide');
            alertSuccess(resp, '../creditoV3/index.php', 2);
        }
    });
}


function mostrarCrm(id_sol, id_est) {
    $('#modal-title-lg').html('Información de la Solicitud ');
    $.ajax({
        url: '../creditoV3/tabsForm.php',
        data: { resp: 5, id_sol: id_sol, id_est: id_est },
        type: 'POST',
        success: function(resp) {
            $('#modal-body-lg').html(resp);
            calcular();
        }
    });
    $.ajax({
        url: '../creditoV3/boton.php',
        type: 'POST',
        data: { resp: 5, id_est: id_est },
        success: function(boton) {
            $('#btn-lg').html(boton);
            $('#btnpermi2').attr('onclick', 'permisoEditar(' + id_sol + ',4);');

        }
    });
}

function actualizaCrm(id_sol, id_cli, id_est) {
    $('#modal-title-sm').html('Editar');
    $.ajax({
        url: '../creditoV3/editarCredito.php',
        data: {id_sol: id_sol, id_est: id_est, id_cli: id_cli },
        type: 'POST',
        beforeSend: function() {
            $('#modal-body-sm').html('<div class="d-flex flex-column align-items-center"><img src="../../resources/img/loader.gif" alt="Cargando..." width="40px"><p class="mt-2">Cargando....</p></div>'); 
        },
        success: function(resp) {
            $('#modal-body-sm').html(resp);
        }
    });
   /* $.ajax({
        url: '../creditoV3/boton.php',
        type: 'POST',
        data: { resp: 9, id_est: id_est },
        success: function(boton) {
            $('#modal-footer-lg').html(boton);
            $('#btnActual').attr('onclick', 'actuCrm();');

        }
    });*/
}

function editarInfoCredito(id_sol, id_cli, id_est) {
    $('#modal-title-lg').html('Edición de la Solicitud');
    $.ajax({
        url: '../creditoV3/tabsForm.php',
        data: { resp: 7, id_sol: id_sol, id_est: id_est },
        type: 'POST',
        beforeSend: function() {
            $('#modal-body-lg').html('<div class="d-flex flex-column align-items-center"><img src="../../resources/img/loader.gif" alt="Cargando..." width="40px"><p class="mt-2">Cargando....</p></div>'); 
        },
        success: function(resp) {
            $('#modal-body-lg').html(resp);
            autoContactos(id_cli, 3, id_sol, id_est);
        }
    });
    $.ajax({
        url: '../creditoV3/boton.php',
        type: 'POST',
        data: { resp: 9, id_est: id_est },
        success: function(boton) {
            $('#modal-footer-lg').html(boton);
            $('#btnActual').attr('onclick', 'actuCrm("'+"form-crm"+'");');

        }
    });
}

function editarDocument(id_sol, id_cli, id_est) {
    $('#modal-title-lg').html('Edición de Documentos');
    $.ajax({
        url: '../creditoV3/EditDocument.php',
        data: { id_sol: id_sol, id_est: id_est },
        type: 'POST',
        beforeSend: function() {
            $('#modal-body-lg').html('<div class="d-flex flex-column align-items-center"><img src="../../resources/img/loader.gif" alt="Cargando..." width="40px"><p class="mt-2">Cargando....</p></div>'); 
        },
        success: function(resp) {
            $('#modal-body-lg').html(resp);
        }
    });
    $.ajax({
        url: '../creditoV3/boton.php',
        type: 'POST',
        data: { resp: 9, id_est: id_est },
        success: function(boton) {
            $('#modal-footer-lg').html(boton);
            $('#btnActual').attr('onclick', 'actuCrm("'+"form-documentos"+'");');

        }
    });
}

function mostrarSeg(id_sol, id_est) {
    $('#modal-title-md').html('Seguimiento de Solicitud');
    $.ajax({
        url: '../creditoV3/seguim.php',
        data: { resp: 11, id_sol: id_sol, id_est: id_est },
        type: 'POST',
        success: function(resp) {
            $('#modal-body-md').html(resp);
        }
    });
    $.ajax({
        url: '../creditoV3/boton.php',
        type: 'POST',
        data: { resp: 11, id_est: id_est },
        success: function(boton) {
            $('#modal-footer-md').html(boton);
        }
    });
}


function actuCrm(form) {
    Swal.fire({
        title: "¿Desea seguir editando este crédito?",
        icon: "question",
        allowOutsideClick: false,
        allowEscapeKey: false,
        allowEnterKey: false,
        showDenyButton: true,
        confirmButtonText: "Si",
        denyButtonText: `No`
      }).then((result) => {
        if (result.isConfirmed) {
            var formuIngComer = new FormData($('#'+ form)[0]);
            formuIngComer.append('formulario', form);
            formuIngComer.append('actualizarEstado', '7');
            for (var value of formuIngComer.values()) {
                console.log(value);
            }
            $.ajax({
                url: '../creditoV3/credito.controller.php',
                data: formuIngComer,
                type: 'POST',
                contentType: false,
                processData: false,
                success: function(resp) {
                    $('#largeModal').modal('hide');
                    $('#modal-title-sm').html('Solicitud Editada');
                    $('#modal-body-sm').html(resp);
                    $('#smallModal').modal('show');
                    $('#modal-footer-sm').html('<a href="../creditoV3/index.php" class="btn btn-secondary">Cerrar</a>');
                }
            });
        } 
        else if (result.isDenied) {
            var formuIngComer = new FormData($("#"+ form)[0]);
            formuIngComer.append('formulario', form);
            formuIngComer.append('actualizarEstado', '1');
            for (var value of formuIngComer.values()) {
                console.log(value);
            }
            $.ajax({
                url: '../creditoV3/credito.controller.php',
                data: formuIngComer,
                type: 'POST',
                contentType: false,
                processData: false,
                success: function(resp) {
                    $('#largeModal').modal('hide');
                    $('#modal-title-sm').html('Solicitud Editada');
                    $('#modal-body-sm').html(resp);
                    $('#smallModal').modal('show');
                    $('#modal-footer-sm').html('<a href="../creditoV3/index.php" class="btn btn-secondary">Cerrar</a>');
                }
            });
        }
      });
    /*var formuIngComer = new FormData($("#form-crm")[0]);
    for (var value of formuIngComer.values()) {
        console.log(value);
    }
    $.ajax({
        url: '../creditoV3/credito.controller.php',
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
            $('#modal-footer-sm').html('<a href="../creditoV3/index.php" class="btn btn-secondary">Cerrar</a>');
        }
    });*/
}

function actualizar1Crm(id_sol, id_est, rol) {
    //alert(id_sol+','+id_est)
    $('#modal-title-lg').html('Edición de la Solicitud');
    $.ajax({
        url: '../creditoV3/tabsForm.php',
        data: { resp: 8, id_sol: id_sol, id_est: id_est, rol },
        type: 'POST',
        success: function(resp) {
            $('#modal-body-lg').html(resp);
            calcular();
        }
    });
    $.ajax({
        url: '../creditoV3/boton.php',
        type: 'POST',
        data: { resp: 10, id_est: id_est },
        success: function(boton) {
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
        url: '../creditoV3/credito.controller.php',
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
            $('#modal-footer-sm').html('<a href="../creditoV3/index.php" class="btn btn-secondary">Cerrar</a>');

        }
    });
}

function EliminarCrm(id_sol) {
    $('#modal-title-md').html('Confirmación');
    $('#modal-body-md').html('¿Está seguro de eliminar esta Solicitud?');
    $.ajax({
        url: '../creditoV3/boton.php',
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
        url: '../creditoV3/credito.controller.php',
        data: { action: 'delete', id_sol: id_sol },
        type: 'POST',
        success: function(resp) {
            $('#modal-body-sm').html(resp);
            $('#modal-title-sm').html('Aviso');
            $('#smallModal').modal('show');
            $('#modal-footer-sm').html('<a href="../creditoV3/index.php" class="btn btn-secondary">Cerrar</a>');
        }
    });
}

function rechazarCrm(id_sol) {
    $('#largeModal').modal('hide');
   
    $.ajax({
        url: '../creditoV3/motivRechazo.php',
        data: { id_sol: id_sol },
        type: 'POST',
        beforeSend: function() {
            $('#modal-body-sm').html('<div class="d-flex flex-column align-items-center"><img src="../../resources/img/loader.gif" alt="Cargando..." width="40px"><p class="mt-2">Cargando....</p></div>'); 
        },
        success: function (resp) {
            $('#modal-title-sm').html('Confirmación'); 
            $('#modal-body-sm').html(resp);
        }
    });
    $.ajax({
        url: '../creditoV3/boton.php',
        type: 'POST',
        data: { resp: 23 },
        success: function(boton) {
            $('#modal-footer-sm').html(boton);
            $('#btnrechazar').attr('onclick', 'confirmRechazarCrm(' + id_sol + ');');
        }
    });
}

function confirmRechazarCrm(id_sol) {
    
    var obs_aprob = $('#obs_aprob').val();
    var caurec = $('input[name="motivoRechazo"]:checked').val();
    $('#smallModal').modal('hide');
    $.ajax({
        url: '../creditoV3/credito.controller.php',
        data: { id_sol: id_sol, obs_aprob: obs_aprob, action: 'rechazar', caurec: caurec },
        type: 'POST',
        success: function(resp) {
            alertSuccess(resp, '../creditoV3/index.php', 2);
        }
    });
    
}

function permisoEditar(id_sol, param) {
    $('#largeModal').modal('hide');
    if (param == 3 || param == 4) {
        if (param == 3) {
            var resp1 = { resp: 8 };
        } else if (param == 4) {
            var resp1 = { resp: 7 };
        } else {
            var resp1 = { resp: 20 };
        }
    }

    $('#modal-title-sm').html('Aviso'); 
    $('#modal-body-sm').html('<form id="observa"><label for="observa" class="form-label">¿Cuál es el motivo por el que quiere habilitar la edición del crédito? <span name="req" class="text-mq">*</span></label><textarea class="form-control" id="observa" name="observa" rows="3"  placeholder="LLena este espacio para justificar el permiso" required></textarea></form>');
    $('#smallModal').modal('show');

    $.ajax({
        url: '../creditoV3/boton.php',
        type: 'POST',
        data: resp1,
        success: function(resp) {
            $('#modal-footer-sm').html(resp);
            $('#btnhabcon').attr('onclick', 'confirmPerc(' + id_sol + ',1);');
            $('#btnpermiti2').attr('onclick', 'confirmPerc(' + id_sol + ',2);');
            $('#btnpermiti3').attr('onclick', 'confirmPerc(' + id_sol + ',2);');
        }
    });
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
    } 
    
    if (validarCampos('observa') == 0) {
        
        $.ajax({
            url: '../creditoV3/credito.controller.php',
            data: data,
            type: 'POST',
            success: function(resp) {
                $('#smallModal').modal('hide');
                alertSuccess(resp, '../creditoV3/index.php', 2);
            }
        });
    }
}

function refreshTableCrm() {
    var reg = $('#reg').val();
    var id = $('#id').val();
    var rol = $('#rol').val();
    $.ajax({
        url: '../creditoV3/tabla2.php',
        type: 'POST',
        data: { resp: 1, reg: reg, id: id, rol: rol },
        success: function(resp) {
            $('#content-table').html(resp);
        }
    });
}

function remove(id) {
    if (id == 1) {
        $('#pun_u1').val('');
        $('#ciu1').val('');
        $('#tel_fij1').val('');
        $('#hor_1').val('');
        $('#hor1_1').val('');
    } else if (id == 2) {
        $('#btnMen2').remove();
        $('#desp2').html('');
        $('#btnMas').attr('onclick', 'desp2()');
       // $('#btnMen11').attr('id', 'btnMen22');
    } else if (id == 3) {
        $('#desp3').html('');
        $('#btnMen3').remove();
        $('#btnMas').attr('onclick', 'desp3()');

       // $('#btnMen3').attr('id', 'btnMen2');
    }
}

function desp2() {
    $.ajax({
        url: '../creditoV3/despacho.php',
        type: 'POST',
        data: { resp: 2 },
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
        }
    });
}

function desp3() {
    $.ajax({
        url: '../creditoV3/despacho.php',
        type: 'POST',
        data: { resp: 3 },
        success: function(resp) {
            $('#desp3').html(resp);
            $('#text-despacho').html('* Solo se pueden agregar máximo tres puntos de despacho *');
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
        }
    });
}

function calcular() {
    if ($('#ac_cor').val() != "") {
        var activo1 = $('#ac_cor').val().replace(/,/g, '');
        /*let input = document.getElementById('ac_cor');
        var activo1 = input.getAttribute('data-valor-original');
        alert (activo1)*/
        $('#act_raz').attr("value", separadorMiles(activo1));
        $('#ac_pas').attr("value", separadorMiles(activo1)); 
        if ($('#inv').val() != "") {
            var inv = $('#inv').val().replace(/,/g, '');
            var restaA = parseInt(activo1) - parseInt(inv);
            $('#act_raz2').attr("value", separadorMiles(restaA));
        }
    }
    if ($('#pas_cor').val() != "") {
        //alert($('#pas_cor').val())
        var pasivo1 = $('#pas_cor').val().replace(/,/g, '');
        $('#pas_raz').attr("value", separadorMiles(pasivo1));
        $('#pas_raz2').attr("value", separadorMiles(pasivo1));
        $('#pas_ac').attr("value", separadorMiles(pasivo1));
        if ($('#inv').val() != "") {
            var divacid = parseInt(restaA) / parseInt(pasivo1);
            $('#res2').attr("value", separadorMiles(divacid));
            $('#pas_act2').attr("value", separadorMiles(divacid));

        }
    }
    if ($('#ac_cor').val() != "" && $('#pas_cor').val() != "") {
        var division1 = parseInt(activo1) / parseInt(pasivo1);
        var rescap = parseInt(activo1) - parseInt(pasivo1);
        $('#res').attr("value", separadorMiles(division1));
        $('#pas_act').attr("value", separadorMiles(division1));
        $('#to_pas').attr("value", separadorMiles(rescap));
        $('#des_pas').attr("value", separadorMiles(rescap));
    }
    if ($('#ac_cor1').val() != "") {
        var act1 = $('#ac_cor1').val().replace(/,/g, '');
        $('#act_raz1').attr("value", separadorMiles(act1));
        $('#ac_pas1').attr("value", separadorMiles(act1));
        if ($('#inv1').val() != "") {
            var inv1 = $('#inv1').val().replace(/,/g, '');
            var rest = parseInt(act1) - parseInt(inv1);
            $('#act_raz3').attr("value", separadorMiles(rest));
        }
    }
    if ($('#pas_cor1').val() != "") {
        var pas1 = $('#pas_cor1').val().replace(/,/g, '');
        $('#pas_raz1').attr("value", separadorMiles(pas1));
        $('#pas_raz3').attr("value", separadorMiles(pas1));
        $('#pas_ac1').attr("value", separadorMiles(pas1));
        if ($('#inv1').val() != "") {
            var divacid2 = parseInt(rest) / parseInt(pas1);
            $('#res3').attr("value", separadorMiles(divacid2));
            $('#pas_act3').attr("value", separadorMiles(divacid2));
        }
    }
    if ($('#ac_cor1').val() != "" && $('#pas_cor1').val() != "") {
        var divisi = parseInt(act1) / parseInt(pas1);
        var rescap1 = parseInt(act1) - parseInt(pas1);
        $('#res1').attr("value", separadorMiles(divisi));
        $('#pas_act1').attr("value", separadorMiles(divisi));
        $('#to_pas1').attr("value", separadorMiles(rescap1));
        $('#des_pas1').attr("value", separadorMiles(rescap1));
    }
    if ($('#pasi').val() != "") {
        var pasiv = $('#pasi').val().replace(/,/g, '');
        $('#end_raz').attr("value", separadorMiles(pasiv));
    }

    if ($('#activ').val() != "") {
        var activ = $('#activ').val().replace(/,/g, '');
        $('#act_end').attr("value", separadorMiles(activ));
    }
    if ($('#pasi').val() != "" && $('#activ').val() != "") {
        var division2 = Math.round((parseInt(pasiv) / parseInt(activ)) * 100);
        $('#res_end').attr("value", separadorMiles(division2));
        $('#ac_acre').attr("value", separadorMiles(division2));
    }
    if ($('#pasi1').val() != "") {
        var pasiv1 = $('#pasi1').val().replace(/,/g, '');
        $('#end_raz1').attr("value", separadorMiles(pasiv1));
    }

    if ($('#activ1').val() != "") {
        var activ1 = $('#activ1').val().replace(/,/g, '');
        $('#act_end1').attr("value", separadorMiles(activ1));
    }
    if ($('#pasi1').val() != "" && $('#activ1').val() != "") {
        var division3 = Math.round((parseInt(pasiv1) / parseInt(activ1)) * 100);
        $('#res_end1').attr("value", separadorMiles(division3));
        $('#ac_acre1').attr("value", separadorMiles(division3));
    }

    if ($('#util').val() != "") {
        var util = $('#util').val().replace(/,/g, '');
    }
    if ($('#ing').val() != "") {
        var ing = $('#ing').val().replace(/,/g, '');
        if ($('#util_an').val() != "") {
            var util_an = $('#util_an').val().replace(/,/g, '');
            var diviu1 = parseInt(util_an) / parseInt(ing);
            $('#porcent_ing2').attr("value", separadorMiles(diviu1));
        }
    }
    if ($('#util').val() != "" && $('#ing').val() != "") {
        var diviutil = parseInt(util) / parseInt(ing);
        $('#porcent_ing').attr("value", separadorMiles(diviutil));

    }
    if ($('#utilun').val() != "") {
        var utilun = $('#utilun').val().replace(/,/g, '');
    }

    if ($('#ing1').val() != "") {
        var ing1 = $('#ing1').val().replace(/,/g, '');
        if ($('#util_an1').val() != "") {
            var util_an1 = $('#util_an1').val().replace(/,/g, '');
            var div = parseInt(util_an1) / parseInt(ing1);
            $('#porcent_ing3').attr("value", separadorMiles(div));
        }
    }
    if ($('#utilun').val() != "" && $('#ing1').val() != "") {
        var diviutil1 = parseInt(utilun) / parseInt(ing1);
        $('#porcent_ing1').attr("value", separadorMiles(diviutil1));
    }
}

function vaciarCampos() {
    /*$("#btn-editUsu").attr("disabled", true);
    $("#btn_addContat").attr("disabled", true);
    $("#id_nit").attr("readonly" , true);
    $("#dirEmp").attr("readonly", true);
    $("#eml_cli").attr("readonly", true);
    $("#celCli").attr("readonly", true);
    $("#TelF").attr("readonly", true);
    $("#telcon").attr("readonly", true);
    $("#correo_cont").attr("readonly", true);
    $("#car_cont").attr("readonly", true);*/
    $("#nom_com").attr("disabled", true);
    $("#Actsol").attr("disabled", true);
    $("#input_editNomClie").addClass("none");
    $("#id_cli").val('');
    $("#id_nit").val('');
    $("#nom_com").val('');
    $("#celCli").val('');
    $("#dirEmp").val('');
    $("#eml_cli").val('');
    $("#Actsol").val('');
    $("#nom_com").val('');
    $("#telcon").val('');
    $("#correo_cont").val('');
    $("#car_cont").val('');
    $("#nom_clie1").val('');
    $("#nom_com1").val('');
}

function cambiarColor(opcion, color) {
    var inputArchivo1 = document.getElementById('refComer');
    var inputArchivo2 = document.getElementById('refComer2');

    $("#btn_archivo" + opcion).removeClass('btn-warning');
    $("#btn_archivo" + opcion).addClass('btn-'+color);

    if(opcion != 7 && opcion != 8){
        $("#archivo" + opcion).removeClass('alert-warning');
        $("#archivo" + opcion).addClass('alert-'+color);
    }

    if (inputArchivo1.value != '' && inputArchivo2.value != '') {
        $("#archivo7").removeClass('alert-warning');
        $("#archivo7").addClass('alert-'+color);
    }
}

$(function() {
    $("#search").autocomplete({
        source: '../autocomplete/creditoV3/buscador3.php',
        minLength: 3,
        select: function(event, ui) {
            searchTable();
        }
    });
});

function Imputnew(a, b, c){
 
    if(b=='Mostrar'){
        alert("¿Está seguro de agregar este contacto?");
        if(a==1){
            document.getElementById('ENCARGADO').style.display ='block';
            document.getElementById('btn-compras').innerHTML ='Eliminar';
            $("#btn-servicios, #btn-salud, #btn-tesoreria").attr('disabled', true);
            $('#btn-compras').attr('onclick', 'Imputnew(1, "Ocultar");');
            
        }else if(a==2){
            document.getElementById('SALUD').style.display ='block';
            document.getElementById('btn-salud').innerHTML ='Eliminar';
            $("#btn-servicios, #btn-compras, #btn-tesoreria").attr('disabled', true);
            $('#btn-salud').attr('onclick', 'Imputnew(1, "Ocultar");');
        
        }else if(a==3){
            document.getElementById('SERVICIOS').style.display ='block';
            document.getElementById('btn-servicios').innerHTML ='Eliminar';
            $("#btn-salud, #btn-compras, #btn-tesoreria").attr('disabled', true);
            $('#btn-servicios').attr('onclick', 'Imputnew(1, "Ocultar");');
        
        }else if(a==4){
            document.getElementById('TESO').style.display ='block';
            document.getElementById('btn-tesoreria').innerHTML ='Eliminar';
            $("#btn-servicios, #btn-compras, #btn-salud").attr('disabled', true);
            $('#btn-tesoreria').attr('onclick', 'Imputnew(1, "Ocultar");');
        
        };
        $('#' +c).attr('onclick', 'Imputnew('+a+', "Ocultar");');
    }else if(b=='Ocultar'){
        alert("buena");
    };
    
    


}
     
function confirmacionCorreo(opcion, id_sol, id_cli) {
    if(opcion == 1){
        $('#modal-title-md').html("Enviar Correo");
        $('#modal-body-md').html(`¿Está seguro de enviar la confirmación al cliente sobre el estudio de crédito?`);
    } else {
        $('#modal-title-md').html("Reenviar Correo");
        $('#modal-body-md').html(`¿Está seguro de reenviar la confirmación al cliente sobre el estudio de crédito?`);
    }
    
    $.ajax({
        url: '../creditoV3/boton.php',
        type: 'POST',
        data: { resp: 25 },
        success: function(resp) {
            $('#modal-footer-md').html(resp);
            $('#btnEnviarCorreo').attr('onclick', 'enviarCorreo(' + id_sol + ', '+id_cli+')');
        }
    });
}

function enviarCorreo(id_sol, id_cli) {
    $('#mediumModal').modal('hide');
    $.ajax({
        url: '../creditoV3/credito.controller.php',
        data: { id_sol: id_sol, id_cli: id_cli, action: 'estudioCredRechazado'},
        type: 'POST',
        success: function(resp) {
            alertSuccess(resp, '../creditoV3/index.php', 2);
        }
    });
}
    
function deleteDocument(documento, columna, id_sol, id, ver){
    Swal.fire({
        title: '¿Quiere eliminar el documento anterior?',
        icon: "question",
        allowOutsideClick: false,
        allowEscapeKey: false,
        allowEnterKey: false,
        showDenyButton: true,
        confirmButtonText: "Si",
        denyButtonText: `No`
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '../creditoV3/credito.controller.php',
                data: { name_document: documento, action: 'eliminarDoc', columna: columna, id_sol: id_sol},
                type: 'POST',
                success: function(resp) {
                    if(resp == 1){
                        toastSuccess("Documento Eliminado Exitosamente");
                        habilitarBoton(id, ver);
                        
                    } else if(resp == 2){
                        toastWarning("Documento eliminado en la Base datos, error al eliminar en el servidor");
                        habilitarBoton(id, ver);
                     
                    } else if(resp == 3){
                        toastError("Error al eliminar el Documento");
                    }
                  
                }
            });
        } 
      });
   
}

function habilitarBoton(boton1, boton2) {
    const BTN_HABILITAR = document.getElementById(boton1);
    const BTN_OCULTAR = document.getElementById(boton2);
    
    BTN_OCULTAR.style.display = 'none';
    BTN_HABILITAR.style.display = 'block';
}