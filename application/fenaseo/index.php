<?php

include '../../resources/template/session.php';

include "../../conexion_fenaseo.php";

?>

<!DOCTYPE html>

<html lang="es">



<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" type="text/css" href="../../resources/css/creditos/creditos.css">



    <title>Intranet | Fenaseo</title>



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

            <?php

                include('../../resources/template/modals.php');

            ?>

        </main>

    </div>



    <?php

    include('../../resources/template/scripts.php');

    ?>

    <script type="text/javascript" src="../../resources/js/sweet-alert.js"></script>

    <script type="text/javascript" src="../../resources/js/jquery-ui.min.js"></script>

    <script type="text/javascript" src="../js/fenaseo.js"></script>

</body>



</html>