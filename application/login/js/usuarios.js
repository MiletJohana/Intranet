function crearUsuario() {
    $('#modal-title-lg').html("Crear Usuario");
    $.ajax({

        url: '../usuarios/form1.php',
        type: 'POST',
        data: { resp: 1 },
        success: function(resp) {
            $('#largeModal-dialog').attr('style', 'min-width:1200px');
            $('#modal-body-lg').html(resp);
        }
    });

    $.ajax({
        url: '../usuarios/boton.php',
        type: 'POST',
        data: { resp: 1 },
        success: function(resp) {
            $('#modal-footer-lg').html(resp);
        }
    });
}

function agregarUsuario() {
    if (validarCampos() == 0) {
        var formulario = new FormData($("#form-usuario")[0]);
        $.ajax({
            url: '../usuarios/usuarios.controller.php',
            data: formulario,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function(resp) {
                $('#largeModal').modal('hide');
                $('#modal-title-sm').html('Crear Usuario');
                $('#modal-body-sm').html(resp);
                $('#smallModal').modal('show');
                $('#modal-footer-sm').html('<button type="button" class="btn btn-default" onclick="refreshTableUsu()" data-bs-dismiss="modal">Cerrar</button>');
            }
        });
    }
}

function actualizarUsuario(id) {
    $('#modal-title-lg').html("Actualizar Usuario");
    $.ajax({
        url: '../usuarios/form1.php',
        type: 'POST',
        data: { resp: 2, id_usu: id },
        success: function(resp) {
            $('#modal-body-lg').html(resp);
            $('#id_usu').attr("readonly", true);
        }
    });
    $.ajax({
        url: '../usuarios/boton.php',
        type: 'POST',
        data: { resp: 2 },
        success: function(resp) {
            $('#modal-footer-lg').html(resp);
        }
    });
    $.ajax({
        data: { id_usu: id },
        url: '../usuarios/consultaPerm.php',
        type: 'POST',
        success: function(resp) {
            $('#permisos').html(resp);
            console.log(resp);
        }
    });
}

function refreshTableUsu() {
    $.ajax({
        url: '../usuarios/tabla.php',
        type: 'POST',
        data: { resp: 1 },
        success: function(resp) {
            $('#content-table').html(resp);
        }
    });

}

function modificarUsuario() {

    var formulario = new FormData($("#form-usuario")[0]);
    $.ajax({
        url: '../usuarios/usuarios.controller.php',
        data: formulario,
        type: 'POST',
        contentType: false,
        processData: false,
        success: function(resp) {
            $('#largeModal').modal('hide');
            $('#modal-body-sm').html(resp);
            $('#modal-title-sm').html('Aviso');
            $('#smallModal').modal('show');
            $('#modal-footer-sm').html('<button type="button" class="btn btn-default" onclick="refreshTableUsu()" data-bs-dismiss="modal">Cerrar</button>');
        }
    });
}

function eliminarUsuario(id) {
    $('#modal-title-md').html('Confirmación');
    $('#modal-body-md').html('¿Está seguro de eliminar este usuario?');
    $.ajax({
        url: '../usuarios/boton.php',
        type: 'POST',
        data: { resp: 3 },
        success: function(resp) {
            $('#modal-footer-md').html(resp);
            $('#btnEliminar').attr('value', id);
        }
    });
}

function confirmEliminar() {
    $('#mediumModal').modal('hide');
    var id = $('#btnEliminar').val();
    $.ajax({
        url: '../usuarios/usuarios.controller.php',
        data: { action: 'delete', id_usu: id },
        type: 'POST',
        success: function(resp) {
            $('#modal-body-sm').html(resp);
            $('#modal-title-sm').html('Aviso');
            $('#smallModal').modal('show');
            $('#modal-footer-sm').html('<button type="button" class="btn btn-default" onclick="refreshTableUsu()" data-bs-dismiss="modal">Cerrar</button>');
            $.ajax({
                url: '../usuarios/boton.php',
                type: 'POST',
                data: { resp: 4 },
                success: function(resp) {
                    $('#modal-footer-sm').html(resp);
                }
            });
        }
    });
}

function crearPermiso() {
    $('#modal-title-md').html("Permisos");
    $.ajax({
        url: '../usuarios/form2.php',
        type: 'POST',
        data: { resp: 1 },
        success: function(resp) {
            $('#modal-body-md').html(resp);
        }
    });

    $.ajax({
        url: '../usuarios/boton.php',
        type: 'POST',
        data: { resp: 6 },
        success: function(resp) {
            $('#modal-footer-md').html(resp);
        }
    });
}

function agregarPermiso() {

    if (validarCampos() == 0) {
        var id_perm = [];
        var id_usu_per = document.getElementById("id_usu_per").value;
        var action = document.getElementById("accion_form_per").value;
        var permisos = document.getElementsByName("id_perm[]");
        for (var i = permisos.length - 1; i >= 0; i--) {
            if (permisos[i].checked == true) {
                id_perm.push(permisos[i].value);
            }
        }

        $.ajax({
            url: '../usuarios/usuarios.controller.php',
            data: { id_per: id_perm, action: action, id_usu_per: id_usu_per },
            type: 'POST',
            success: function(resp) {
                $('#mediumModal').modal('hide');
                $('#modal-title-sm').html('Crear Permisos');
                $('#modal-body-sm').html(resp);
                $('#smallModal').modal('show');
                $('#modal-footer-sm').html('<button type="button" class="btn btn-default" onclick="location.reload()" data-bs-dismiss="modal">Cerrar</button>');
            }
        });
    }
}



function auto() {
    $("#id_usu3").autocomplete({
        source: '../autocomplete/usuarios/buscador.php',
        minLength: 3,
        select: function(event, ui) {
            $("#nom_usu").html('<strong>Nombre: </strong>' + ui.item.nom_usu);
            $("#usuario").html('<strong>Usuario: </strong>' + ui.item.usuario);
            $("#cargo").html('<strong>Cargo: </strong>' + ui.item.nom_carg);
            $("#id_usu4").attr('value', ui.item.id_usu);
            $.ajax({
                url: '../usuarios/permisos.php',
                type: 'POST',
                data: { id_usu: ui.item.id_usu },
                success: function(resp) {
                    $('#permisos').html(resp);
                }
            });
        }
    });
}

function verificar() {

    $('#Info').html('<img src="../../resources/img/loader.gif" alt="Cargando..."/>').fadeOut(1000);

    var id_usu = $('#id_usu').val();
    var dataString = 'id_usu=' + id_usu;

    $.ajax({
        type: "POST",
        url: "../usuarios/consulta.php",
        data: dataString,
        success: function(data) {
            if (data == "0") {
                $('#id_usu').css("border", "1px solid red");
                $('#btnAgregar').attr('disabled', "true");
                $('#btnAcatualizar').attr('disabled', "true");
            } else if (data == "1") {
                $('#id_usu').css("border", "1px solid green");
                $('#btnAgregar').removeAttr('disabled');
                $('#btnAcatualizar').removeAttr('disabled');
            }
        }
    });
}

$(function() {
    $("#search").autocomplete({
        source: '../autocomplete/usuarios/buscador.php',
        minLength: 3,
        select: function(event, ui) {
            searchTable();
        }
    });
});