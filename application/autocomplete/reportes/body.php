<?php
date_default_timezone_set("America/Bogota");
$e2=date("Y-m-d");
$mes=date('m');
$year=date('Y');
$fech=date("Y-m-01");
//Consultas de las diligencias
$sql="SELECT COUNT(tip_dlg.id_tip_dlg) as cant,nom_tip_dlg,dia_dlg FROM mq_dlg, tip_dlg 
                                      WHERE mq_dlg.id_tip_dlg=tip_dlg.id_tip_dlg 
                                      AND dia_dlg BETWEEN '$fech%' AND '$e2%' 
                                      GROUP by tip_dlg.id_tip_dlg";
                                      $usuario=json_encode("-");
  //Contar cuantas diligencias son 
  $sql2="SELECT COUNT(tip_dlg.id_tip_dlg) as cant,nom_tip_dlg,dia_dlg FROM mq_dlg, tip_dlg 
                                  WHERE mq_dlg.id_tip_dlg=tip_dlg.id_tip_dlg 
                                  AND dia_dlg BETWEEN '$fech%' AND '$e2%'";
$query=$conexion->query($sql);
$query2=$conexion->query($sql2);
$r2=$query2->fetch(PDO::FETCH_ASSOC);
//Consultas de los costos
$sql4="SELECT SUM(cos_dlg) as costo,tip_dlg.nom_tip_dlg 
						FROM `mq_dlg`, tip_dlg 
						WHERE mq_dlg.id_tip_dlg=tip_dlg.id_tip_dlg 
						AND dia_dlg BETWEEN '2018-10-01%' 
						AND '2018-10-31%' 
						GROUP by tip_dlg.nom_tip_dlg"; 
$query4=$conexion->query($sql4);
$sql44="SELECT SUM(cos_dlg) as total FROM `mq_dlg` WHERE dia_dlg BETWEEN '2018-10-01%' AND '2018-10-31%'";
$query44=$conexion->query($sql44);
$r44=$query44->fetch(PDO::FETCH_ASSOC);
include '../reportes/grafDil.php';
include '../reportes/char.php';
include '../reportes/grafEfect.php';
include '../reportes/grafCost.php';
?>