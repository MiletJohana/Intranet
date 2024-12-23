<?php 
include '../conexion.php';
include '../plantilla/credentials.php';
$sqlEst="SELECT * FROM agen_com WHERE id_est = 3 AND id_usu = ".$_SESSION['id'];
$queryEst=$conexion->query($sqlEst);
if($queryEst->num_rows>0){
    echo 1;
}else{
    echo $sqlEst;
}
?>