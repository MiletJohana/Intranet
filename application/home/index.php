<?php
include '../../resources/template/session.php';
include "../../conexion.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Intranet | Inicio</title>

    <?php
    include ('../../resources/template/head.php');
    ?>

    <link rel="stylesheet" href="../../resources/css/home/home.css">

</head>

<body class="h-100">
    <div class="container-fluid">
        <?php
        include('../../resources/template/navbar.php');
        ?>
        <main>
            <?php
            include('content.php');
            ?>
        </main>
    </div>

    <?php
    include ('../../resources/template/scripts.php');
    ?>
</body>

</html>