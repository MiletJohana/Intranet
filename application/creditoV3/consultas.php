<?php
    if(isset($_POST['resp']) && $_POST['resp']==1){
        include "../../conexion.php";
    }
    $sqlEva = "SELECT *,DATE(fech_ini) AS fecha_ini,DATE(fech_fin) AS fecha_fin FROM cre_eva_clie where id_sol='" . $_POST['id_sol'] . "'";
    $queryEva = $conexion->query($sqlEva);
    $row = $queryEva -> rowCount();
    if(isset($_POST['resp']) && $_POST['resp']==1){
        echo $row;
    }
?>