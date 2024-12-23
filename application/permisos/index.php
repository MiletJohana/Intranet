<?php
include '../../resources/template/session.php';
include '../../conexion.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Intranet | Permisos</title>

    <?php
    require('../../resources/template/head.php');
    ?>

    <link rel="stylesheet" href="../../resources/css/permisos/permisos.css">
</head>

<body>
 
    <div class="container-fluid">
        <?php
        require('../../resources/template/navbar.php');
        ?>
        <main>
            <?php include 'content.php'; ?>
            <div id="content-table">
                <?php
                if (isset($_GET['table']) && $_GET['table'] == 1) {
                    require('tabla.php');
                } else if (isset($_GET['table']) && $_GET['table'] == 2) {
                    require('tabla2.php');
                } else if (isset($_GET['table']) && $_GET['table'] == 3) {
                    require('tabla3.php');
                } else if (isset($_GET['table']) && $_GET['table'] == 4) {
                    require('tabla4.php');
                }?>
            </div>
            <?php require('../../resources/template/modals.php');
            ?>
        </main>
    </div>

    <?php
    require('../../resources/template/scripts.php');
    ?>
    <script type="text/javascript" src="../js/permisos.js"></script>
</body>

</html>