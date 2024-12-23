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

    <title>Intranet | Diligencias</title>

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
                include('tabla.php');
                ?>
            </div>
            <input type="hidden" name="" id="reg" value="<?php echo $sesion_reg; ?>">
            <?php
            include('../../resources/template/modals.php');
            ?>
        </main>
    </div>
    <?php
    include('../../resources/template/scripts.php');
    ?>
    <script type="text/javascript" src="../../resources/js/jquery-ui.min.js"></script>

    <script type="text/javascript" src="../js/diligencia.js"></script>
    <script type="text/javascript" src="../js/cliente2.js"></script>

    <script>//alertaMantenimiento();</script>
</body>

</html>