<?php
function fechaCastellano($fecha)
{
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
	return $numeroDia . " de " . $nombreMes . " de " . $anio;
}

$sql3 = "SELECT *, DATE(fec_coti) AS creacion
				 FROM cot_cotizaciones, mq_clientes, contactos, cot_ciudad , mq_usu
				 WHERE cot_cotizaciones.id_cli = mq_clientes.id_cli 
				 AND contactos.id_cont = cot_cotizaciones.id_cont
				 AND cot_cotizaciones.id_ciu=cot_ciudad.id_ciu
				 AND cot_cotizaciones.id_usu=mq_usu.id_usu
				 AND id_coti = $cot
				 GROUP BY id_coti";
$query3 = $conexion->query($sql3);
$datoscot = $query3->fetch(PDO::FETCH_ASSOC);
$sql4 = "SELECT * FROM cot_pro_x_cot, productos WHERE cot_pro_x_cot.cod_pro=productos.id_prod AND id_coti=$cot";
$query4 = $conexion->query($sql4);
$hor_cot = fechaCastellano($datoscot['creacion']);
$sql5 = "SELECT * FROM contactos WHERE id_cli = (SELECT id_cli FROM cot_cotizaciones WHERE id_coti=$cot) AND id_cont=$id_cont";
$query5 = $conexion->query($sql5);
$contactocot = $query5->fetch(PDO::FETCH_ASSOC);
$cedAse = $datoscot["ced_ase"];
$sql11 = "SELECT * FROM mq_usu WHERE id_usu=" . $datoscot['id_usu'];
$query11 = $conexion->query($sql11);
$cotizanteCoti = $query11->fetch(PDO::FETCH_ASSOC);
if ($datoscot["ced_ase"] != null) {
	$sql6 = "SELECT * FROM mq_usu, cot_tip_cotizador WHERE id_usu=$cedAse AND mq_usu.id_car=cot_tip_cotizador.id_car";
	$query6 = $conexion->query($sql6);
	$cotizador = $query6->fetch(PDO::FETCH_ASSOC);
}
$totaliva = ($datoscot['cost_cot'] * 0.19) + ($datoscot['cost_cot']);
$totaliva = str_replace(".", ",", $totaliva);
$totaliva = intval($totaliva);
$html = '
	<head>
		<meta charset="UTF-8">
		<title>' . substr($datoscot["doc_coti"], -17) . '</title>
		<link rel="stylesheet" href="../../resources/librerias/css/style.css" media="all" />
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	</head>
	<body style="background-image:url(https://intranet.masterquimica.com/resources/librerias/img/fondoCot1.png);
	background-position: top left;
	background-repeat: no-repeat;
	background-image-resize: 4;
	background-image-resolution: from-image;font-family:"Roboto", sans-serif;font-size:24" >
	<main><br><br><br><br>
	<table style="background-color:transparent;padding-left:25px">
      <tr>
        <td  style="background-color:transparent;"> 
          <div id="project" >
          			<div>'.$datoscot["nom_ciu"].', '.$hor_cot.'</div><br><br>
					<div>
						'.$cotizanteCoti["nom_cns"].'-'.str_pad($datoscot["cns_coti"], 4, "0", STR_PAD_LEFT).'
						Señor(a): '.$contactocot["nom_cont"].'<br>
						Cargo: '.$contactocot["car_cont"].' <br>
						<p style="font-weight:Bold;">'.$datoscot["nom_cli"].'</p>
						Tel: '.$contactocot["tel_cont"].'<br>
						mail: '.$contactocot["eml_cont"].'<br>
                    </div>
                </div> 
          </td>
      </tr>
	</table>
	<br><br><br><br>
	<table border="1" autosize="1" style=" overflow:auto;">
	<thead style="background-color: #58585C; fontcolor:black;">
	  <tr>
		<th style="width:25%;  background-color: #58585c;   color: white;">Ref</th>
		<th style="width:45%;  background-color: #58585c;   color: white;">Descripción</th>
		<th style="width:17%;  background-color: #58585c;   color: white;">Valor Unitario</th>
		<th style="width:17%;  background-color: #58585c;   color: white;">Valor de empaque</th>
		<th style="width:15%;  background-color: #58585c;   color: white;">Cantidad</th>
		<th style="width:17%;  background-color: #58585c;   color: white;">Total</th>
	  </tr>
	</thead>
	<tbody>';
		while ($r = $query4->fetch(PDO::FETCH_ASSOC)) {
		//Modificado Aqui
		$sqlP = "SELECT uni_emp_mq FROM productos WHERE id_prod=" . $r['id_prod'];
		$queryP = $conexion->query($sqlP);
		$rP = $queryP->fetch(PDO::FETCH_ASSOC);
		$valorTotal = $r["pre_cot"] * $r["can_com"] * $rP['uni_emp_mq'];
		$valorTotalIva = (($r["pre_cot"] * $r["can_com"]) * $rP['uni_emp_mq'] * 0.19) + ($r["pre_cot"] * $r["can_com"] * $rP['uni_emp_mq']);
		//Terminado Aqui
		$html .= '
			<tr>
				<td style="text-align:center; background-color:transparent;"><div><img style="max-width:100px;" src="../../documentos/cotizador/images/' . $r["img_pro"] . '"></div><p>' . $r["cod_ref"] . '</p></td>
				<td style="background-color:transparent;"><strong>' . $r["nom_pro_cot"] . '</strong><br><p>' . $r["des_pro_cot"];
		'</p><br>';
		if ($r['obs_prod'] != '') {
		$html .= '<br><br><p>**' . $r["obs_prod"] . '</p>';
		}
		$html .= '<br><p><strong>UNIDAD DE EMPAQUE:</strong> ' . $r["und_emp"] . ' ' . $r["uni_emp_mq"] . '</p>';

		if ($r["sin_dev"] == 1) {
		$html .= '<br><p style="color:red;">No se aceptan devoluciones</p>';
		}
		//Modificado aqui
		$valorUn = ($r["pre_cot"] * $rP['uni_emp_mq']);
		//Terminado Aqui
		$valorUni = round($valorUn);
		$punt = '.';
		$pos = strpos($r['pre_cot'], $punt);
		if ($pos === false) {
		$pos = 0;
		}
		$precio = str_replace('.', ',', $r['pre_cot']);
		if (strlen($valorUni) > 6) {
		$html .= '</td>
							<td style="text-align:center;background-color:transparent;">$' . substr($precio, 0 - $pos, -6 - $pos) . "'" . substr($precio, -6 - $pos, -3 - $pos) . "." . substr($precio, -3 - $pos) . '</td>';
		} else {
		$html .= '</td>
							<td style="text-align:center;background-color:transparent;">$' . substr($precio, 0 - $pos, -3 - $pos) . "." . substr($precio, -3 - $pos) . '</td>';
		}
		if (strlen($r['pre_cot']) > 6) {
		$html .= '<td style="text-align:center;background-color:transparent;">$' . substr($valorUni, 0, -6) . "'" . substr($valorUni, -6, -3) . "." . substr($valorUni, -3) . '</td>';
		} else {
		$html .= '<td style="text-align:center;background-color:transparent;">$' . substr($valorUni, -0, -3) . "." . substr($valorUni, -3) . '</td>';
		}
		$html .= '<td style="text-align:center;background-color:transparent;">' . $r["can_com"] . '</td>';
		if (strlen($valorTotal) > 6) {
		$html .= "<td>$" . substr($valorTotal, 0, -6) . "'" . substr($valorTotal, -6, -3) . '.' . substr($valorTotal, -3) . '</td>
							</tr>
							';
		} else {
		$html .= '<td>$' . substr($valorTotal, 0, -3) . "." . substr($valorTotal, -3) . '</td>
							</tr>
							';
		}
		}
		$html .= '
					<tr>
						<td colspan="2" style="border:none;background-color:transparent;"></td>';
		if ($datoscot['cot_iva'] == 1) {
		$html .= '<td colspan="2" style="background-color:transparent;" align="center">Total sin IVA</td>';
		} else {
		$html .= '<td colspan="2" style="background-color:transparent;" align="center">Total</td>';
		}
		if (strlen($datoscot['cost_cot']) > 6) {
		$html .= '<td colspan="2" align="center" style="background-color:transparent;" >$' . substr($datoscot['cost_cot'], 0, -6) . "'" . substr($datoscot['cost_cot'], -6, -3) . '.' . substr($datoscot['cost_cot'], -3) . '</td>
						</tr>';
		} else {
		$html .= '<td colspan="2" align="center" style="background-color:transparent;" >$' . substr($datoscot['cost_cot'], 0, -3) . "." . substr($datoscot['cost_cot'], -3) . '</td>
							</tr>
							';
		}
		if ($datoscot['cot_iva'] == 1) {
		$html .= '<tr>
								<td colspan="2" style="border:none;background-color:transparent;"></td>
										<td colspan="2" align="center">Total con IVA</td>';
		if (strlen($totaliva) > 6) {
		$html .= '<td colspan="2" style="background-color:transparent;" align="center">$' . substr($totaliva, 0, -6) . "'" . substr($totaliva, -6, -3) . '.' . substr($totaliva, -3) . '</td>
									</tr>';
		} else {
		$html .= '<td colspan="2"  style="background-color:transparent;" align="center">$' . substr($totaliva, 0, -3) . "." . substr($totaliva, -3) . '</td>
											</tr>
											';
		}
		}
		$html .= '<tr>
				</tbody>
				</table>
				</main>

					
	</body>';

	$html2 = '';

	$html2 = '';