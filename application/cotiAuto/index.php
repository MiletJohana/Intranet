<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Cotización</title>

    <?php
    include('../../resources/template/head.php');
    ?>

    <link rel="stylesheet" type="text/css" href="../../resources/css/cssAuto.css">

</head>

<body style="font-family:Arial;font-size:16px;background-color: #fff;">
    <div class="container-fluid">
        <main>
            <?php include "CotiOnline.php" ?>
            <?php
            include('../../resources/template/modals.php');
            ?>
        </main>
    </div>

    <?php
    include('../../resources/template/scripts.php');
    ?>
    <script type="text/javascript" src="../js/cotizaciones.js"></script>

</body>

</html>