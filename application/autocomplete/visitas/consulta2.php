<?php 
include '../../../conexion.php';

	$sql="SELECT * FROM mq_pers WHERE id_per=".$_POST['id'];
	$query=$conexion->query($sql);

if($query!=null){
	$r=$query->fetch(PDO::FETCH_ASSOC);
	echo '<b>Nombre de vistante: </b>'.$r['nom_per'].'
			<p id="nom_per"><b>Empresa: </b>'.$r['emp_per'].'</p>
			<p id="eps_per"><b>E.P.S: </b>'.$r['eps_per'].'</p>
			<p id="arl_per"><b>A.R.L: </b>'.$r['arl_per'].'</p>
			<p id="tel_per"><b>Teléfono: </b>'.$r['tel_per'].'</p>
			<p id="con_per"><b>Contacto emergencia: </b>'.$r['con_per'].'</p>
			<p id="tel_con"><b>Teléfono del contacto: </b>'.$r['tel_con'].'</p>';
}else{
	echo 'error';
}

?>