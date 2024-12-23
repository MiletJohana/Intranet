function newLLam(resp, title, url) {
    $('#modal-title-lg').html(title);
    if (url != '') {
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                resp
            },
            success: function (respHtml) {
                $('#modal-body-lg').html(respHtml);
            }
        });
    }
    $.ajax({
        url: '../llamadas/boton.php',
        type: 'POST',
        data: {
            resp
        },
        success: function (respHtml) {
            $('#modal-footer-lg').html(respHtml);
        }
    });
}

function auto() {
    $("#nom_rem").autocomplete({
        source: '../autocomplete/usuarios/buscador.php',
        minLength: 3,
        select: function (event, ui) {
            $("#nom_rem").attr('value', ui.item.nom_usu);
            $("#id_rem").attr('value', ui.item.id_usu);
            $("#buttonagregar").removeAttr('disabled');
        }
    });
}

function crear(param, file, table) {
    if (validarCampos(param) == 0) {
        var formulario = new FormData($("#" + param)[0]);
        $.ajax({
            url: '../llamadas/llamadas.controller.php',
            data: formulario,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (resp) {
                console.log(resp);
                $('#largeModal').modal('hide');
                $('#modal-title-sm').html('Llamada creada');
                $('#modal-body-sm').html(resp);
                $('#smallModal').modal('show');
                $('#btn-footer-sm').attr('onclick', 'refreshTablellam("' + file + '","' + table + '")');
            }
        });
    }
}

function refreshTablellam(file, table) {
    $.ajax({
        url: '../' + file + '/' + table,
        type: 'POST',
        data: {
            resp: 'cerrar'
        },
        success: function (resp) {
            $('#content-table').html(resp);
        }
    });
}

function checkMail(value) {
    if (value == 1) {
        $("#correo").attr('value', 0);
    } else {
        $("#correo").attr('value', 1);
    }
}