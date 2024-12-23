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
    $html='
    <head>
    <meta charset="UTF-8">
    <title>'.substr($datoscot["doc_coti"],-17).'</title>
	<link rel="stylesheet" href="../../resources/utils/phppdf/css/style.css" media="all" />
    </head>
    <body style="font-family:Arial; font-size:14px;">
    <main>
    <table >
      <tr>
        <td width="100%" style="text-align: left; line-height:1.5;background-color:transparent;"> 
          <div id="project"  >
          			<div>'.$datoscot["nom_ciu"].', '.$hor_cot.'</div>
          			<br>
          			'.$cotizanteCoti["nom_cns"].'-'.str_pad($datoscot["cns_coti"], 4, "0", STR_PAD_LEFT).'
          			<br>
          			<br>
          			<div>
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

	
		<div style="width: 700px;
				    display: -webkit-flex;
				    display: flex;
				    -webkit-flex-wrap: wrap;
				    flex-wrap: wrap;
				    -webkit-align-content: center;
				    align-content: center;"
				    >
			<div><span>Apreciado señor(a):</span></div>	<br> 
			<div><span>De acuerdo con su solicitud nos permitimos cotizar los siquientes productos:</span></div>
		</div>
		<br>
		 <table border="1"   autosize="1" style=" overflow: auto;">
		        <thead style="background-color: #A00A00; fontcolor:black;">
		          <tr >
		            <th style="width:25%;  background-color: #A00A00;   color: white;">Ref</th>
		            <th style="width:45%;  background-color: #A00A00;   color: white;">Descripción</th>
		            <th style="width:17%;  background-color: #A00A00;   color: white;">Valor Unitario</th>
		            <th style="width:17%;  background-color: #A00A00;   color: white;">Valor de empaque</th>
		            <th style="width:15%;  background-color: #A00A00;   color: white;">Cantidad</th>
		            <th style="width:17%;  background-color: #A00A00;   color: white;">Total</th>
		          </tr>
		        </thead>
		        <tbody>';
			while($r=$query4->fetch(PDO::FETCH_ASSOC))
				{
					//Modificado Aqui
					$sqlP = "SELECT uni_emp_mq FROM productos WHERE id_prod=". $r['id_prod'];
					$queryP = $conexion->query($sqlP);
					$rP = $queryP->fetch(PDO::FETCH_ASSOC);
					$valorTotal = $r["pre_cot"] * $r["can_com"] * $rP['uni_emp_mq'];
					$valorTotalIva = (($r["pre_cot"] * $r["can_com"]) * $rP['uni_emp_mq'] * 0.19) + ($r["pre_cot"] * $r["can_com"] * $rP['uni_emp_mq']);
				//Terminado Aqui
				$html.='<tr>
			        		<td style="text-align:center;background-color:transparent;"><div><img style="max-width:100px;" src="../../documentos/cotizador/images/'.$r["img_pro"].'"></div><p>'.$r["cod_ref"].'</p></td>
									<td style="background-color:transparent;"><strong>'.$r["nom_pro_cot"].'</strong><br><p>'.$r["des_pro_cot"];'</p><br>';
				if($r['obs_prod']!=''){
					$html.='<br><br><p>**'.$r["obs_prod"].'</p>';
				}
				$html.='<br><p><strong>UNIDAD DE EMPAQUE:</strong> '.$r["und_emp"].' '.$r["can_emp"].'</p>';

			        	if($r["sin_dev"]==1){
			        		$html.='<br><p style="color:red;">No se aceptan devoluciones</p>';
									}
									//Modificado aqui
			        		$valorUn=($r["pre_cot"]*$rP['can_emp']);
									//Terminado Aqui
			        		$valorUni=round($valorUn);
			        		$punt='.';
							$pos = strpos($r['pre_cot'], $punt);
							if($pos===false){$pos=0;}
			        		$precio=str_replace('.',',',$r['pre_cot']);
			        		if (strlen($valorUni)>6) {
			        			$html.='</td>
			        			<td style="text-align:center;background-color:transparent;">$'.substr($precio,0-$pos,-6-$pos)."'".substr($precio,-6-$pos,-3-$pos).".".substr($precio,-3-$pos).'</td>';
			        		}else{
			        			$html.='</td>
			        			<td style="text-align:center;background-color:transparent;">$'.substr($precio,0-$pos,-3-$pos).".".substr($precio,-3-$pos).'</td>';
			        		}
			        		if (strlen($r['pre_cot'])>6) {
			        		$html.='<td style="text-align:center;background-color:transparent;">$'.substr($valorUni,0,-6)."'".substr($valorUni,-6,-3).".".substr($valorUni,-3).'</td>';
			        		}else{
			        		$html.='<td style="text-align:center;background-color:transparent;">$'.substr($valorUni,-0,-3).".".substr($valorUni,-3).'</td>';
			        		}
			        		$html.='<td style="text-align:center;background-color:transparent;">'.$r["can_com"].'</td>';
			        		if (strlen($valorTotal)>6) {
			        			$html.="<td >$".substr($valorTotal,0,-6)."'".substr($valorTotal,-6,-3).'.'.substr($valorTotal,-3).'</td>
			        			</tr>
			        			';
			        		}else{
			        			$html.='<td>$'.substr($valorTotal,0,-3).".".substr($valorTotal,-3).'</td>
			        			</tr>
			        			';
			        		}
			        		
		        }       	
				$html.='
						<tr>
							<td colspan="2" style="border:none;background-color:transparent;"></td>';
				        if($datoscot['cot_iva']==1){
									$html.='<td colspan="2" style="background-color:transparent;" align="center">Total sin IVA</td>';
								}else{
									$html.='<td colspan="2"  style="background-color:transparent;" align="center">Total</td>';
								}	
				        	if (strlen($datoscot['cost_cot'])>6) {
				        	$html.='<td colspan="2" align="center" style="background-color:transparent;">$'.substr($datoscot['cost_cot'],0,-6)."'".substr($datoscot['cost_cot'],-6,-3).'.'.substr($datoscot['cost_cot'],-3).'</td>
				        	</tr>';
			        		}else{
				        	$html.='<td colspan="2" align="center" style="background-color:transparent;">$'.substr($datoscot['cost_cot'],0,-3).".".substr($datoscot['cost_cot'],-3).'</td>
			        			</tr>
			        			';
			        		}
				      if($datoscot['cot_iva']==1){
								$html.='<tr>
									<td colspan="2" style="border:none;background-color:transparent;"></td>
											<td colspan="2" align="center">Total con IVA</td>';
											if (strlen($totaliva)>6) {
											$html.='<td colspan="2" style="background-color:transparent;" align="center">$'.substr($totaliva,0,-6)."'".substr($totaliva,-6,-3).'.'.substr($totaliva,-3).'</td>
										</tr>';
											}else{
											$html.='<td colspan="2"  style="background-color:transparent;" align="center">$'.substr($totaliva,0,-3).".".substr($totaliva,-3).'</td>
												</tr>
												';
											}
								}
				    $html.='<tr>
					</tbody>
				    </table>';
if(isset($cotizanteCoti) && ($cotizanteCoti['id_car']==5 || $cotizanteCoti['id_car']==6 || $cotizanteCoti['id_car']==16)){
 $html2.='
 <div>
 <table style="font-size:14px;font-style:Arial;">
 	<tr><td width="3%"style="background-color:transparent;" >
 		</td>
 		<td style="line-height:1.5;background-color:transparent;">
 			Notas:<br><br>
			 <ul>
				<li> Este precio incluye máximo hasta tres tintas en el logotipo, la elaboración del arte y el clisé.Si la frecuencia de  compra es  menor  a 4 meses se realizará un cobro  único de $ 160.000  en factura posterior</li>
				<li> Existe un margen de tolerancia del 10%  en rollos de más o menos en la impresión.</li>
				<li>En impresión por adhesivo: el área de impresión no debe ser mayor al 30% del ancho de la cinta, también se debe tener presente que la leyenda va impresa a lo largo de la cinta y debe tener una medida de 15 cm mínimo y 37 máximo.</li>
				<li>El tiempo de entrega para la cinta impresa es de 8 días hábiles a partir de aprobado el arte.</li>
				<li>La cantidad mínima a elaborar son 144 rollos.</li>
			</ul>
	</td>
 </tr>
</table>
<p style="color:black;font-size:14px;font-style:Arial;">CONDICIONES COMERCIALES :</p>
<table style="align-content: left; line-height:1.5; font-size:14px">
	<tr>
		<td  style="background-color:transparent;">
			Tiempo de entrega:  <br> 
			Forma de pago:<br>
			Validez de la Oferta:<br>
			I.V.A:
		</td>
		<td width="75%"  style="background-color:transparent;" >
			'.($datoscot["dia_ent"]).'<br>
			'.$datoscot["for_pag"].'<br>
		    '.$datoscot["val_cot"].'<br>
			19% No Incluido
		</td>
	</tr>
</table>
<table style="font-size:15px;font-style:Arial;">
 	<tr>
 		<td style="text-align:left;background-color:transparent;">
 			<p style="letter-spacing:0.1px;">
				Solicitamos enviar sus órdenes de compra al correo electrónico <a href="'.$cotizanteCoti["eml_usu"].'">'.$cotizanteCoti["eml_usu"].'</a> nos permite ser más ágiles en la grabación del pedido y ejercer  controles inherentes al proceso.
			</p>
			 			
 		</td>
 	</tr>
</table>
 <table style="font-size:15px;font-style:Arial;">
 	<tr>
 		<td style="background-color:transparent;">
			<p>
				Cualquier inquietud o requerimiento adicional con gusto le atenderemos. <br><br>
				Atentamente,
			</p> 
		</td>
 	</tr>
 </table>';
 }else{
$html2.='
 <div>
 <table style="font-size:14px;font-style:Arial;">
 	<tr><td width="3%"style="background-color:transparent;" >
 		</td>
 		<td style="line-height:1.5;background-color:transparent;">
 			Notas:<br><br>
			 <ul>
				<li>Este precio incluye máximo hasta tres tintas en el logotipo, la elaboración del arte y el clisé.Si la frecuencia de  compra es  menor  a 4 meses se realizará un cobro  único de $ 160.000  en factura posterior</li>
				<li>Existe un margen de tolerancia del 10%  en rollos de más o menos en la impresión.</li>
				<li>En impresión por adhesivo: el área de impresión no debe ser mayor al 30% del ancho de la cinta, también se debe tener presente que la leyenda va impresa a lo largo de la cinta y debe tener una medida de 15 cm mínimo y 37 máximo.</li>
				<li>El tiempo de entrega para la cinta impresa es de 8 días hábiles a partir de aprobado el arte.</li>
				<li>La cantidad mínima a elaborar son 144 rollos.</li>
			</ul>
	</td>
 </tr>
</table>
<p style="color:black;font-size:14px;font-style:Arial;">CONDICIONES COMERCIALES :</p>
<table style="align-content: left; line-height:1.5; font-size:14px">
	<tr>
		<td  style="background-color:transparent;">
			Tiempo de entrega:  <br> 
			Forma de pago:<br>
			Validez de la Oferta:<br>
			I.V.A:
		</td>
		<td width="75%"  style="background-color:transparent;" >
			'.($datoscot["dia_ent"]).'<br>
			'.$datoscot["for_pag"].'<br>
			'.$datoscot["val_cot"].'<br>
			19% No Incluido
		</td>
	</tr>
</table>
<table style="font-size:15px;font-style:Arial;">
 	<tr>
 		<td style="background-color:transparent;">
 			<p>
				Solicitamos enviar sus órdenes de compra al correo electrónico <a href="pedidos@masterquimica.com">pedidos@masterquimica.com</a>  nos permite ser más ágiles en la grabación del pedido y ejercer  controles inherentes al proceso. 
			</p>
			 			
 		</td>
 	</tr>
</table>
 <table style="font-size:15px;font-style:Arial;">
 	<tr>
 		<td style="background-color:transparent;">
			<p>
				Cualquier inquietud o requerimiento adicional con gusto le atenderemos. <br><br>
				Atentamente,
			</p> 
		</td>
 	</tr>
 </table>';
}

if(isset($cotizador)){
if(($cotizador["id_car"]==1 || $cotizador["id_car"]==7 || $cotizador["id_car"]==4 || $cotizador["id_car"]==8 || $cotizador["id_car"]==5 || $cotizador["id_car"]==6 || $cotizador["id_car"]==9 || $cotizador["id_car"]==10 
	|| $cotizador["id_car"]==11 || $cotizador["id_car"]==12 || $cotizador["id_car"]==13 || $cotizador["id_car"]==16 || $cotizador["id_car"]==17 || $datoscot['id_usu']==1110465381)) {
	$html2.='
	<table style="font-size:13px;font-style:Arial;">
		<tr>
			<td width="40%" style="background-color:transparent;">
				<p>
					<span style="font-weight:bold;">'.strtoupper($cotizador["nom_usu"]).'</span><br>
					'.strtoupper($cotizador["nom_car"]).' <br>
					PBX: '.$cotizador["cel2_usu"].' ext. '.$cotizador["ext_usu"].' <br>
					Cel:  '.$cotizador["cel_usu"].' <br>
					<a href="'.$cotizador["eml_usu"].' ">
						'.$cotizador["eml_usu"].' 
					</a>
				</p>
			</td>
			<td width="10%" style="background-color:transparent;">';
	if($datoscot["ced_sac"]!=""){
	$cedSac=$datoscot["ced_sac"];
	$sql7="SELECT * from mq_usu, cot_tip_cotizador where id_usu=$cedSac and mq_usu.id_car=cot_tip_cotizador.id_car";
	$query7=$conexion->query($sql7);
	if ($query7->rowCount()>0) {
	$sac=$query7->fetch(PDO::FETCH_ASSOC);
		$html2.='
			</td>
			<td width="40%" style="background-color:transparent;">
				<p>
					<span style="font-weight:bold;">'.strtoupper($sac["nom_usu"]).'</span><br>
					'.strtoupper($sac["nom_car"]).' <br>
					PBX: 231 6377 ext. '.$sac["ext_usu"].'<br>
					<a href=" '.$sac["eml_usu"].'">
						 '.$sac["eml_usu"].'
					</a>
				</p>
			</td>';
	}
	}
	$html2.='
			</tr>
		</table>
	</div>
	';
	}
	}elseif($datoscot["ced_sac"]!=""){
		$cedSac=$datoscot["ced_sac"];
		$sql7="SELECT * from mq_usu, cot_tip_cotizador where id_usu=$cedSac and mq_usu.id_car=cot_tip_cotizador.id_car";
		$query7=$conexion->query($sql7);
		if ($query7->rowCount()>0) {
			$sac=$query7->fetch(PDO::FETCH_ASSOC);
			$html2.='
			<table style="font-size:13px;font-style:Arial;">
			<tr>
				<td width="40%" style="background-color:transparent;">
					<p>
						<span style="font-weight:bold;">'.strtoupper($sac["nom_usu"]).'</span><br>
						'.strtoupper($sac["nom_car"]).' <br>
						PBX: 231 6377 ext. '.$sac["ext_usu"].'<br>
						<a href=" '.$sac["eml_usu"].'">
							'.$sac["eml_usu"].'
						</a>
					</p>
				</td>
			</tr>
		</table>
	</div>';
	}
}
?>