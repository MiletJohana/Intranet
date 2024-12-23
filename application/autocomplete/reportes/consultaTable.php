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

if(isset($_POST['usuario']) && $_POST['usuario']!="-"){

	$sql="SELECT COUNT(tip_dlg.id_tip_dlg) as cant,nom_tip_dlg,dia_dlg FROM mq_dlg, tip_dlg 
                                      WHERE mq_dlg.id_tip_dlg=tip_dlg.id_tip_dlg 
                                      AND dia_dlg BETWEEN '$fech%' AND '$fech2%'
                                      AND nom_res = \"$_POST[usuario]\"
                                      GROUP by tip_dlg.id_tip_dlg";
                                      $usuario=json_encode("-");
  //Contar cuantas diligencias son 
  $sql2="SELECT COUNT(tip_dlg.id_tip_dlg) as cant,nom_tip_dlg,dia_dlg FROM mq_dlg, tip_dlg 
                                  WHERE mq_dlg.id_tip_dlg=tip_dlg.id_tip_dlg 
                                  AND dia_dlg BETWEEN '$fech%' AND '$fech2%'
                                      AND nom_res = \"$_POST[usuario]\"";


	}else{

	$sql="SELECT COUNT(tip_dlg.id_tip_dlg) as cant,nom_tip_dlg,dia_dlg FROM mq_dlg, tip_dlg 
                                      WHERE mq_dlg.id_tip_dlg=tip_dlg.id_tip_dlg 
                                      AND dia_dlg BETWEEN '$fech%' AND '$fech2%' 
                                      GROUP by tip_dlg.id_tip_dlg";
                                      $usuario=json_encode("-");
  //Contar cuantas diligencias son 
  $sql2="SELECT COUNT(tip_dlg.id_tip_dlg) as cant,nom_tip_dlg,dia_dlg FROM mq_dlg, tip_dlg 
                                  WHERE mq_dlg.id_tip_dlg=tip_dlg.id_tip_dlg 
                                  AND dia_dlg BETWEEN '$fech%' AND '$fech2%'";

}
$query=$conexion->query($sql);
$query2=$conexion->query($sql2);
$r2=$query2->fetch(PDO::FETCH_ASSOC);
if($query->rowCount()>0){
echo '
<p>Resultados de las diligencias realizadas en el rango del mes mostrado o solicitado. Porcentaje correspondiente por tipo de diligencia de un total de 100%.</p>
<br>
<table class="table table-bordered table-hover" id="datatable">
	<thead>
		<tr>
			<th>Tipo Diligencia</th>
			<th>Cantidad</th>
			<th>Porcentaje</th>
		</tr>
	</thead>
	<tbody>
			'; while ($r=$query->fetch(PDO::FETCH_ASSOC)) { 
echo '
		<tr>
			<td>'.$r['nom_tip_dlg'].'</td>
			<td>'.$r['cant'].'</td>
			<td>'.round(($r['cant']/$r2['cant'])*100).'%</td>
		</tr>
			';}
echo '
		<tr style="background-color: gray !important;">
			<td>Total</td>
			<td>'.$r2['cant'].'</td>
			<td>100%</td>
			
		</tr>
	</tbody>
</table>';
}else{
	echo '<div class="alert alert-success">No hay resultados disponibles.</div>';
}