<?php
include '../../resources/template/credentials.php';
include '../../resources/template/session.php';
include "../../conexion.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Intranet | Correspondencia</title>

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
                <div class="col-12">
                    <div id="resp" class="alert alert-dismissible fade show mt-4" role="alert" style="display: none;">
                        <span id="resp-text"></span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                <?php
                if (isset($_GET['table']) && $_GET['table'] == 1) {
                    include('../correspondencia2/tabla.php');
                } else if (isset($_GET['table']) && $_GET['table'] == 2) {
                    include('../correspondencia2/tabla2.php');
                } else if (isset($_GET['table']) && $_GET['table'] == 4) {
                    include('../correspondencia2/tabla4.php');
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
    <script type="text/javascript" src="../js/correspondencia2.js"></script>
    <script type="text/javascript" src="../js/cliente2.js"></script>
    <script type="text/javascript" src="../../resources/js/jquery-ui.min.js"></script>

</body>

</html>