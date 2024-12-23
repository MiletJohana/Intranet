function newInventario(resp, title, url) {
    $('#modal-title-lg').html(title);
    if (url != '') {
        $.ajax({
            url: url,
            type: 'POST',
            data: { resp },
            success: function(respHtml) {
                $('#modal-body-lg').html(respHtml);
                console.log(resp)
                if (resp != 12) {
                    $('#agregar').attr('disabled', "true");
                }
            }
        });
    }
    $.ajax({
        url: '../inventarios/boton.php',
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
            url: '../permisos/permisos.controller.php',
            data: formulario,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function(resp) {
                $('#largeModal').modal('hide');
                $('#modal-title-sm').html('Solicitud Creada');
                $('#modal-body-sm').html(resp);
                $('#smallModal').modal('show');
                $('#btn-footer-sm').attr('onclick', 'refreshTablePer("' + file + '","' + table + '")');
            }
        });
    }
}