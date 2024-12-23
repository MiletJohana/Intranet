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

    <title>Intranet | Administrar</title>

    <?php
    include('../../resources/template/head.php');
    ?>
    <link rel="stylesheet" href="../../resources/css/inventarios/inventarios.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowgroup/1.5.0/css/rowGroup.dataTables.css">
</head>

<body>
    <div class="container-fluid">
        <?php
        include('../../resources/template/navbar.php');
        ?>
        <main>
            <?php 
                include('content.php'); 
                if (isset($_SESSION['rol_inv']) && $_SESSION['rol_inv'] == 2) { ?>
                    <div id="content-table">
                        <?php

                        if (isset($_GET['table']) && $_GET['table'] == 2) {
                            include('tabla2.php');
                        } else if (isset($_GET['table']) && $_GET['table'] == 3) {
                            include('tabla3.php');
                        } else if (isset($_GET['table']) && $_GET['table'] == 4) {
                            include('config_inv.php');
                        } 
                } else { ?>
                    <div class="row g-0 mx-4">
                        <div class="col-12 mt-4">
                            <div class="alert alert-warning d-flex align-items-center fs-5" role="alert">
                                <i class="fa-solid fa-triangle-exclamation me-2"></i>
                                <div>
                                    <span class="fw-bold">Acceso denegado: </span> No tienes permisos para acceder a esta sección.
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                </div>
            <?php include('../../resources/template/modals.php');
            ?>
        </main>
    </div>

    <?php
    include('../../resources/template/scripts.php');
    ?>
    <script type="text/javascript" src="../js/inventarios.js"></script>

    <script type="text/javascript">
        if (getQueryVariable('table') == 1) {
            window.addEventListener('load', select_regional());
        }
    </script> 

    <script type="text/javascript" src="https://cdn.datatables.net/rowgroup/1.5.0/js/dataTables.rowGroup.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/rowgroup/1.5.0/js/rowGroup.dataTables.js"></script>
</body>

</html>
  

