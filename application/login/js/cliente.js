function crearCliente(action) {
    $('#modal-title-lg').html("Crear Cliente");
    $.ajax({
        url: '../clientes/form.php',
        type: 'POST',
        data: { resp: 1 },
        success: function(resp) {
            $('#modal-body-lg').html(resp);
        }
    });
    $.ajax({
        url: '../clientes/boton.php',
        type: 'POST',
        data: { resp: 1 },
        success: function(resp) {
            $('#modal-footer-lg').html(resp);
        }
    });
}

function agregarCliente(param) {
    if (validarCampos('form-cliente') == 0) {
        var formulario = new FormData($("#form-cliente")[0]);
        $.ajax({
            url: '../clientes/cliente.controller.php',
            type: 'POST',
            data: formulario,
            contentType: false,
            processData: false,
            success: function(resp) {
                if (param == 'clie') {
                    $('#largeModal').modal('hide');
                    $('#modal-body-sm').html(resp);
                    $('#modal-title-sm').html('Aviso');
                    $('#smallModal').modal('show');
                    $('#btn-footer-sm').html('<button type="button" class="btn btn-default" onclick="refreshTableClient()" data-bs-dismiss="modal">Cerrar</button>');
                } else {
                    $('#largeModal-2').modal('hide');
                    $('#modal-body-sm').html(resp);
                    $('#modal-title-sm').html('Aviso');
                    $('#smallModal').modal('show');
                    $('#btn-footer-sm').html('<button type="button" class="btn btn-default" onclick="refreshTableClient()" data-bs-dismiss="modal">Cerrar</button>');
                    $('#btn-sm').removeAttr('onclick');
                }
            }
        });
    }
}

function actualizarCliente(id) {
    $('#modal-title-lg').html("Actualizar Cliente");
    $.ajax({
        url: '../clientes/form.php',
        type: 'POST',
        data: { resp: 2, id_cli: id },
        success: function(resp) {
            console.log(resp);
            $('#modal-body-lg').html(resp);
            $('#id_cli').attr('readonly', '');
        }
    });
    $.ajax({
        url: '../clientes/boton.php',
        type: 'POST',
        data: { resp: 2 },
        success: function(resp) {
            $('#modal-footer-lg').html(resp);
        }
    });
}

function modificarCliente() {
    if (validarCampos('form-cliente') == 0) {
        var formulario = new FormData($("#form-cliente")[0]);
        $.ajax({
            url: '../clientes/cliente.controller.php',
            type: 'POST',
            data: formulario,
            contentType: false,
            processData: false,
            success: function(resp) {
                $('#largeModal').modal('hide');
                $('#modal-body-sm').html(resp);
                $('#modal-title-sm').html('Aviso');
                $('#smallModal').modal('show');
                $('#btn-footer-sm').html('<button type="button" class="btn btn-default" onclick="refreshTableClient()" data-bs-dismiss="modal">Cerrar</button>');
            }
        });
    }
}

function eliminarCliente(id) {
    $('#modal-title-md').html('Confirmación');
    $('#modal-body-md').html('¿Está seguro de eliminar este cliente?');
    $.ajax({
        url: '../clientes/boton.php',
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
        url: '../clientes/cliente.controller.php',
        data: { action: 'delete', id_cli: id },
        type: 'POST',
        success: function(resp) {
            $('#modal-body-sm').html(resp);
            $('#modal-title-sm').html('Aviso');
            $('#smallModal').modal('show');
            $('#btn-footer-sm').html('<button type="button" class="btn btn-default" onclick="refreshTableClient()" data-bs-dismiss="modal">Cerrar</button>');
        }
    });
}

function refreshTableClient() {
    $.ajax({
        url: '../clientes/table.php',
        type: 'POST',
        data: { resp: 1 },
        success: function(resp) {
            $('#content-table').html(resp);
        }
    });
}

function verificar() {
    $('#Info').html('<img src="../../resources/img/loader.gif" alt="" />').fadeOut(1000);
    var id_cli = $('#id_cli').val();
    var dataString = 'id_cli=' + id_cli;
    $.ajax({
        type: "POST",
        url: "../clientes/consulta.php",
        data: dataString,
        success: function(data) {
            if (data == "0") {
                $('#id_cli').css("border", "1px solid red");
                $('#btnAgregar').attr('disabled', "true");
                $('#btnAcatualizar').attr('disabled', "true");
            } else if (data == "1") {
                $('#id_cli').css("border", "1px solid green");
                $('#btnAgregar').removeAttr('disabled');
                $('#btnAcatualizar').removeAttr('disabled');
            }
        }
    });
}

$(function() {
    $("#search").autocomplete({
        source: '../autocomplete/clientes/buscador.php',
        minLength: 3,
        select: function(event, ui) {
            searchTable();
        }
    });
});