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

    <title>Intranet | Clientes</title>

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
            <?php include('content.php'); ?>
            <div id="content-table">
                <?php 
                if ($_GET['table'] == 1 || $_GET['table'] == 2) {
                    include('tabla.php');
                }

                if (isset($_GET['id'])) {
                    include('perfil.php');
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
    <script type="text/javascript" src="../js/cliente2.js"></script>
    <script type="text/javascript" src="../js/crm.js"></script>
    <script type="text/javascript" src="../js/contactos.js"></script>
    <script type="text/javascript" src="../js/creditoV2.js"></script>
    <script type="text/javascript" src="../js/diligencia.js"></script>
    <script type="text/javascript" src="../js/cotizaciones.js"></script>
    <script type="text/javascript" src="../js/correspondencia2.js"></script>
    <script type="text/javascript" src="../js/client.js"></script>
    
    <script type="text/javascript" src="../../resources/js/jquery-ui.min.js"></script>

</body>

</html>