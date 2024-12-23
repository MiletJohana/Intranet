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

    <title>Intranet | Inventarios</title>

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
            <?php include('content.php'); ?>
                <div id="content-table"></div>
            <?php include('../../resources/template/modals.php'); ?>
        </main>
    </div>

    <?php
    include('../../resources/template/scripts.php');
    ?>
    <script type="text/javascript" src="../js/inventarios.js"></script>
</body>

</html>

<script type="text/javascript">
    document.getElementById('regional').addEventListener('change', function () {
        if(this.value != ''){
            var name_reg = document.getElementById('reg'+this.value).innerHTML;
            toastSuccess('Has seleccionado la regional ' + name_reg);

            document.getElementById('text-principal-inv').innerHTML = 'Inventarios - ' + name_reg;
            var formulario = new FormData();
            formulario.append('reg', this.value);
            fetch('tabla.php', {
                method: 'POST',
                body: formulario
            })
            .then(response => response.text()) 
                .then(data => {
                    document.getElementById('content-table').innerHTML = data; 
                    const scripts =  document.getElementById('content-table').getElementsByTagName('script');
                    for (let i = 0; i < scripts.length; i++) {
                        eval(scripts[i].innerHTML); // Ejecutar el script
                    }
                })
            .catch(error => console.error('Error:', error)); 
        } else {
            document.getElementById('content-table').innerHTML = '';
            document.getElementById('text-principal-inv').innerHTML = 'Inventarios';
        }
    });
    
</script>
