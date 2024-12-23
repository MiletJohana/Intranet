function theme(param, action) {
    $.ajax({
        url: '../configuracion/configuracion.controller.php',
        type: 'POST',
        data: { param: param, action: action },
        success: function(resp) {
            location.reload();
        }
    });
}