function updateDataRep(param) {
    switch (param) {
        case 1:
            $.ajax({
                url: '../estadisticas/reportes/permisosCsv.php',
                type: 'POST',
                data: { param },
                succes: function() {

                }
            });
            console.log("permisosCsv.php Actualizado");
            $.ajax({
                url: '../estadisticas/reportes/certificadosCsv.php',
                type: 'POST',
                data: { param },
                succes: function() {

                }
            });
            console.log("certificadosCsv.php Actualizado");
            break;
        case 2:
            $.ajax({
                url: '../estadisticas/reportes/visitasCsv.php',
                type: 'POST',
                data: { param },
                succes: function() {

                }
            });
            console.log("visitasCsv.php Actualizado");
            $.ajax({
                url: '../estadisticas/reportes/diligenciasCsv.php',
                type: 'POST',
                data: { param },
                succes: function() {

                }
            });
            console.log("diligenciasCsv.php Actualizado");
            $.ajax({
                url: '../estadisticas/reportes/enrutamientosCsv.php',
                type: 'POST',
                data: { param },
                succes: function() {

                }
            });
            console.log("enrutamientosCsv.php Actualizado");
            break;
        case 3:
            $.ajax({
                url: '../estadisticas/reportes/correspondenciaCsv.php',
                type: 'POST',
                data: { param },
                succes: function() {

                }
            });
            console.log("correspondenciaCsv.php Actualizado");
            break;
        case 4:
            $.ajax({
                url: '../estadisticas/reportes/cotizadorCsv.php',
                type: 'POST',
                data: { param },
                succes: function() {

                }
            });
            console.log("cotizadorCsv.php Actualizado");
            break;
        case 5:
            $.ajax({
                url: '../estadisticas/reportes/comercialesCsv.php',
                type: 'POST',
                data: { param },
                succes: function() {

                }
            });
            console.log("comercialesCsv.php Actualizado");
            $.ajax({
                url: '../estadisticas/reportes/creditoCsv.php',
                type: 'POST',
                data: { param },
                succes: function() {

                }
            });
            console.log("creditoCsv.php Actualizado");
            break;
        default:
            break;
    }
    console.log("Datos Actualizados");
}