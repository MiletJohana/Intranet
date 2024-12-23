<?php 
  include('../../resources/template/head.php');
 include('../../resources/template/scripts.php');
 include '../../conexion.php';
?>
<!DOCTYPE html>
<html lang="en">

<body style="font-family:Arial;font-size:16px;background-color: #fff;">
<div class="container-fluid">
    <main>
        <div style="text-align: center">
            <img style="max-width:611px;" src="https://intranet.masterquimica.com/resources/img/recMrgen.png">
        </div>
        <div align="center">
            <a onclick="comeRecha('<?php echo $_GET['id_coti']?>');" data-bs-toggle="modal" data-bs-target="#mediumModal">
                <img src='https://intranet.masterquimica.com/resources/img/botonMQ.png' style="height:85px;margin-top:-99px;">
            </a>
        </div>
        <?php  include('../../resources/template/modals.php'); ?>
    </main>
    <script type="text/javascript" src="../js/cotizacionesv2.js"></script>
</div>
</body>

</html>