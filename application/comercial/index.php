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
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">

    <title>Intranet | Comerciales</title>

    <?php
    include('../../resources/template/head.php');
    ?>

</head>

<body>
    <div class="container-fluid">
        <?php
        include('../../resources/template/navbar.php');
        ?>
        <main>
            <?php
            include('content.php');
            ?>
            <div id="content-table">
                <?php
                if (isset($_GET['table']) && $_GET['table'] == 1) {
                    include('tabla.php');
                } else if (isset($_GET['table']) && $_GET['table'] == 2) {
                    include('tabla2.php');
                }
                ?>
            </div>
            <?php
            include('../../resources/template/modals.php');
            ?>
        </main>
    </div>

    <?php
    include('../../resources/template/scripts.php');
    ?>
    <script type="text/javascript" src="../js/comerciales.js"></script>
    <script type="text/javascript" src="../js/cliente2.js"></script>
    <script type="text/javascript" src="../../resources/js/jquery-ui.min.js"></script>
    <script>
        window.onload = setTimeout("verificar();", 1);
        window.onload = setTimeout("cambiarCita();", 500);
    </script>
</body>

</html>