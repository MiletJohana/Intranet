<?php 
include '../../conexion.php';
include '../../resources/template/credentials.php';
	function fechaCastellano ($fecha) {
	  $fecha = substr($fecha, 0, 10);
	  $numeroDia = date('d', strtotime($fecha));
	  $dia = date('l', strtotime($fecha));
	  $mes = date('F', strtotime($fecha));
	  $anio = date('Y', strtotime($fecha));
	  $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
	  $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
	  $nombredia = str_replace($dias_EN, $dias_ES, $dia);
	  $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
	  $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
	  $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
	  return $numeroDia." de ".$nombreMes." de ".$anio;
	}
	$hor_cot=fechaCastellano(date("Y-m-d"));
	$sql3="SELECT * FROM mq_clientes cli, cre_solicitud sol
				 where cli.id_cli=sol.id_cli";
				 if(isset($_POST['id_sol']) && $_POST['id_sol']!=''){
					 $sql3.=" AND sol.id_sol=".$_POST['id_sol'];
				 }
	$query3=$conexion->query($sql3);
	$datosclie=$query3->fetch(PDO::FETCH_ASSOC);

	if(isset($_POST['action'])){
		$action=$_POST['action'];
	}elseif(isset($_GET['action'])){
		$action=$_GET['action'];
	}
	if($action=='updateAprob'){
	$html='
    <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://intranet.masterquimica.com/resources/utils/phppdf/css/style.css" media="all" />
    </head>
    <body style="font-family:Arial; font-size:16px;">
    <main>
   
		<div>
		 	<div>
				<br><br> Bogotá,' .$hor_cot. '
		  </div>
			<br><br>
			</div>
			<div>
					Señores:
			</div>
			<br>
			<div>
		
					'.$datosclie["nom_cli"].'
			</div>
			<br>
					<div><span><b> ASUNTO: Aprobación de crédito</b></span></div>	<br><br>
					<div style="width: 700px; display: -webkit-flex;display: flex;-webkit-flex-wrap: wrap; flex-wrap: wrap;-webkit-align-content: center;align-content: center;">
					<div><span>Apreciados señores:</span></div>	
					<div ALIGN="justify"><span><br>
					Por medio de la presente nos permitimos informar que su solicitud de crédito ha
					sido aprobada por '.$datosclie["num_letra"] . ' MILLONES DE PESOS ($ '.($datosclie["cup_aut"]).') con un término de pago a '.$datosclie["term_auto"].'  días. 
					<br>
					<br>
					Agradecemos la confianza depositada en Máster Química como proveedor es una gran satisfacción
					pertenecer a su cadena de valor y estamos seguros que conjuntamente lograremos generar grandes
					beneficios para las partes.
					<br><br><br><br>
					Cordialmente, 
					<br><br><br>
					</span></div>
				</div>
				<img src="https://intranet.masterquimica.com/resources/librerias/img/firmaCarolina.jpg" width="29%" align="left"></td><br>
				<br>
				CAROLINA BERNAL JARAMILLO
				<br>
				CONTADORA
					</tbody>
				    </table>
				    </main>
						</body>';
	}elseif($action=='estudioCredRechazado'){
	$html='
	<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://intranet.masterquimica.com/resources/utils/phppdf/css/style.css" media="all" />
	</head>
	<body style="font-family:Arial; font-size:16px;">
	<main>
	<div>
		 <div>
			<br><br> Bogotá,' .$hor_cot. '
		</div>
		<br><br>
		</div>
		<div>
				Señores:
		</div>
		<br>
		<div>
	
				'.$datosclie["nom_cli"].'
		</div>
		<br>
				<div><span><b> ASUNTO: Resultado de estudio de crédito</b></span></div>	<br><br>
				<div style="width: 700px; display: -webkit-flex;display: flex;-webkit-flex-wrap: wrap; flex-wrap: wrap;-webkit-align-content: center;align-content: center;">
				<div><span>Apreciados señores:</span></div>	
				<div ALIGN="justify"><span><br>
				Por medio de la presente nos permitimos informar que su solicitud de crédito ha
				sido rechazada por '.$datosclie["cau_rec"]. ' . 
				<br>
				<br>
				Agradecemos la confianza depositada en Máster Química como proveedor es una gran satisfacción
				pertenecer a su cadena de valor y estamos seguros que conjuntamente lograremos generar grandes
				beneficios para las partes.
				<br><br><br><br>
				Cordialmente, 
				<br><br><br>
				</span></div>
			</div>
			<img src="https://intranet.masterquimica.com/resources/librerias/img/firmaCarolina.jpg" width="29%" align="left"></td><br>
			<br>
			CAROLINA BERNAL JARAMILLO
			<br>
			CONTADORA
				</tbody>
					</table>
					</main>
					</body>';
}

//echo $html;