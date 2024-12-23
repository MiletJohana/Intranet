<?php
include '../../resources/template/session.php';
include "../../conexion.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Intranet | Cotizador</title>

    <?php
    include('../../resources/template/head.php');
    ?>

    <link rel="stylesheet" href="../../resources/css/permisos/permisos.css">

</head>

<body>
    <div class="container-fluid">
        <?php
        include('../../resources/template/navbar.php');
        ?>
        <main>
            <?php if ($sesion_id == 0) { ?>
                <div class="container-fluid">
                    <div class="col-12 mt-4">
                        <div class="alert alert-warning" role="alert">
                            Aplicativo temporalmente en mantenimiento.
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <?php include('content.php'); ?>
                    <?php
                    if (isset($_GET['table']) && $_GET['table'] == 1) {
                        include('tabla.php');
                    } else if (isset($_GET['table']) && $_GET['table'] == 2) {
                        include('tabla2.php');
                    } else if (isset($_GET['table']) && $_GET['table'] == 3) {
                        include('tabla3.php');
                    } else if (isset($_GET['table']) && $_GET['table'] == 4) {
                        //include('tabla4.php');
                        include('../clientes2/content.php');
                    } else if (isset($_GET['table']) && $_GET['table'] == 5) {
                        //include('tabla5.php');
                        include('../contactos/tabla.php');
                    } else if (isset($_GET['table']) && $_GET['table'] == 6) {
                        include('tabla6.php');
                    } else if (isset($_GET['table']) && $_GET['table'] == 7) {
                        include('tabla7.php');
                    } else if (isset($_GET['table']) && $_GET['table'] == 8) {
                        include('precios.php');
                    } else if (isset($_GET['table']) && $_GET['table'] == 9) {
                        include('../contactos/andi_tabla.php');
                    }
                    ?>
                </div>
                <?php
                include('../../resources/template/modals.php');
                ?>
            <?php } ?>
        </main>
    </div>

    <?php
    include('../../resources/template/scripts.php');
    ?>
    <script>
        
    </script>
    <script type="text/javascript" src="../../resources/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="../js/cotizacionesv2.js"></script>
    <script type="text/javascript" src="../js/clientV2.js"></script>

    <script type="text/javascript" src="../js/cliente2.js"></script>
    <script type="text/javascript" src="../js/contactos.js"></script>

    <script type="text/javascript" src="../js/tapetes.js"></script>
    <script type="text/javascript" src="../js/snackbar.js"></script>

</body>

</html>