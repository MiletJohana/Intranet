<?php
sleep(1);
include('../../conexion.php');
if (isset($_POST['num_doc'])) {
    $num_doc   = $_POST['num_doc'];
    $sql = "SELECT num_doc FROM mq_clientes WHERE num_doc = '" . $num_doc . "'";
    $query = $conexion->query($sql);

    if ($query->rowCount() > 0){
        echo '0';
    } else {
        echo '1';
    }
}
