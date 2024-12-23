<?php 
date_default_timezone_set("America/Bogota");
include '../conexion.php';
if(isset($_POST['mes1']) && $_POST['mes1']!=""){
        $fech=$_POST['mes1'];
      if (isset($_POST['mes2']) && $_POST['mes2']!=""){
        $fech2=$_POST['mes2'];
      }else{
        $fech2=date("Y-m-d");
      }
}else{
  $fech=date("Y-m-01");
  $fech2=date("Y-m-d");
}
//////////////////////CONSULTA////////////////////////
if(isset($_POST['usuario']) && $_POST['usuario']!="-"){
  $sql="SELECT COUNT(tip_dlg.id_tip_dlg),nom_tip_dlg,dia_dlg FROM mq_dlg, tip_dlg 
                                      WHERE mq_dlg.id_tip_dlg=tip_dlg.id_tip_dlg 
                                      AND dia_dlg BETWEEN '$fech%' AND '$fech2%'
                                      AND nom_res = \"$_POST[usuario]\"
                                      GROUP by tip_dlg.id_tip_dlg";  
                                      $usuario=json_encode($_POST['usuario']);
  //Contar cuantas diligencias son segun el usuario responsable
  $sql2="SELECT COUNT(tip_dlg.id_tip_dlg) as tipo,nom_tip_dlg,dia_dlg FROM mq_dlg, tip_dlg 
  WHERE mq_dlg.id_tip_dlg=tip_dlg.id_tip_dlg 
  AND dia_dlg BETWEEN '$fech%' AND '$fech2%'
  AND nom_res = \"$_POST[usuario]\"";      
}else{
  $sql="SELECT COUNT(tip_dlg.id_tip_dlg),nom_tip_dlg,dia_dlg FROM mq_dlg, tip_dlg 
                                      WHERE mq_dlg.id_tip_dlg=tip_dlg.id_tip_dlg 
                                      AND dia_dlg BETWEEN '$fech%' AND '$fech2%' 
                                      GROUP by tip_dlg.id_tip_dlg";
                                      $usuario=json_encode("-");
  //Contar cuantas diligencias son 
  $sql2="SELECT COUNT(tip_dlg.id_tip_dlg) as tipo,nom_tip_dlg,dia_dlg FROM mq_dlg, tip_dlg 
                                  WHERE mq_dlg.id_tip_dlg=tip_dlg.id_tip_dlg 
                                  AND dia_dlg BETWEEN '$fech%' AND '$fech2%'";
}
$query=$conexion->query($sql);
$query2=$conexion->query($sql2);
//---------VALROES GRÁFICA--------
$valoresY=array();//valores
$valoresX=array();//Días
$valoresN=array();//nombres
//---------VALOR TOTAL DILIGENCIAS--------
$r=$query2->fetch(PDO::FETCH_ASSOC);
$valorDili=$r['tipo'];
$valoresDili=json_encode($valorDili);

while ($ver=$query-> fetch(PDO::FETCH_NUM)) {
  $valoresX[]=$ver[2];
  $valoresY[]=$ver[0];
  array_push($valoresN,$ver[1]);
}
$datosX=json_encode($valoresX);
$datosY=json_encode($valoresY);
$datosN=json_encode($valoresN);
setlocale(LC_TIME, 'spanish'); //Lenguaje
$fecha=ucwords(strftime("%b %d %Y", strtotime($fech)));// conversión a string
$fecha=array($fecha); // creando array
$fecha=json_encode($fecha); //conversion para lectura en Javascript
$fecha2=ucwords(strftime("%b %d %Y", strtotime($fech2)));// conversión a string
$fecha2=array($fecha2); // creando array
$fecha2=json_encode($fecha2); //conversion para lectura en Javascript


?>