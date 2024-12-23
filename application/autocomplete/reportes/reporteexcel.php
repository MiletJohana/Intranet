<?php
//include database configuration file
include '../conexion.php';

//get records from database
if($_POST['dil_mesIn']!=""){
$fech=$_POST['dil_mesIn'];
$fech2=$_POST['dil_mesFn'];
$usu=$_POST['mis_dlg'];
}else{
$fech=date("Y-m-01");
$fech2=date("Y-m-d");
$usu=$_POST['mis_dlg'];
}
if($usu!="-"){
    $sql="SELECT *
                                    FROM mq_dlg, tip_dlg ,mq_usu ,mq_clie, mq_est_dlg
                                    WHERE mq_dlg.id_tip_dlg=tip_dlg.id_tip_dlg
                                    AND mq_clie.id_cli=mq_dlg.id_cli
                                    AND mq_usu.usuario=mq_dlg.nom_res
                                    AND mq_est_dlg.id_est_dlg=mq_dlg.id_tip_dlg
                                    AND nom_res='$usu'
                                    AND dia_dlg BETWEEN '$fech%' AND '$fech2%'
                                    ORDER BY nom_usu ASC";
    //Contar cuantas diligencias son segun el usuario responsable
    $sql2="SELECT COUNT(tip_dlg.id_tip_dlg) as tipo,nom_tip_dlg,dia_dlg FROM mq_dlg, tip_dlg 
                                    WHERE mq_dlg.id_tip_dlg=tip_dlg.id_tip_dlg 
                                    AND dia_dlg BETWEEN '$fech%' AND '$fech2%'
                                    AND nom_res = '$usu'";
    //Contar cuantas diligencias son y agrupar por tipo de diligencia
    $sql3="SELECT COUNT(tip_dlg.id_tip_dlg) as tipo,nom_tip_dlg,dia_dlg FROM mq_dlg, tip_dlg 
                                    WHERE mq_dlg.id_tip_dlg=tip_dlg.id_tip_dlg 
                                    AND dia_dlg BETWEEN '$fech%' AND '$fech2%'
                                    AND nom_res = '$usu'
                                    GROUP BY nom_tip_dlg";
}else{
    if(isset($_POST['action']) && $_POST['action']=='costos'){
        $sql="SELECT num_dlg,tip_dlg.nom_tip_dlg,mq_clie.id_cli,nom_cli,dir_dlg,dia_dlg,dil_des,obs_dlg,nom_est_dlg,efc_dlg,mq_dlg.fec_cre,mq_dlg.lst_upt,mq_dlg.nom_res,mq_dlg.usu_upt,nom_reg,cos_dlg 
                            FROM mq_dlg, tip_dlg, mq_clie, mq_reg,mq_est_dlg 
                            WHERE mq_dlg.id_tip_dlg=tip_dlg.id_tip_dlg 
                            AND mq_dlg.id_cli=mq_clie.id_cli 
                            AND mq_dlg.id_reg=mq_reg.id_reg 
                            AND mq_dlg.est_dlg=mq_est_dlg.id_est_dlg 
                            AND dia_dlg BETWEEN '$fech%' AND '$fech2%'
                            ORDER BY num_dlg DESC";
        //Consulta de suma de costros por tipo de diligencia
        $sql2="SELECT SUM(cos_dlg) as costo,tip_dlg.nom_tip_dlg 
                                    FROM `mq_dlg`, tip_dlg 
                                    WHERE mq_dlg.id_tip_dlg=tip_dlg.id_tip_dlg 
                                    AND dia_dlg BETWEEN '$fech%' AND '$fech2%' 
                                    GROUP by tip_dlg.nom_tip_dlg";
        //Consulta del costo total
        $sql3="SELECT SUM(cos_dlg) as costoTotal FROM `mq_dlg` 
                                    WHERE dia_dlg BETWEEN '$fech%' AND '$fech2%'";
        $sql4="SELECT mq_dlg_x_enrt.num_enr,num_dlg,usu_upt,fec_crea,lst_upt,fec_enr,est_enr,cos_enr,nom_reg 
                                    FROM `mq_dlg_x_enrt`,mq_enrt ,mq_reg
                                    WHERE mq_dlg_x_enrt.num_enr=mq_enrt.num_enr
                                    AND mq_enrt.id_reg=mq_reg.id_reg
                                    AND fec_crea BETWEEN '$fech%' AND '$fech2%'
                                    ORDER by num_enr DESC";
        $query4=$conexion->query($sql4);
    }else{
        $sql="SELECT *
                                        FROM mq_dlg, tip_dlg ,mq_usu ,mq_clie, mq_est_dlg
                                        WHERE mq_dlg.id_tip_dlg=tip_dlg.id_tip_dlg
                                        AND mq_clie.id_cli=mq_dlg.id_cli
                                        AND mq_usu.usuario=mq_dlg.nom_res
                                        AND mq_est_dlg.id_est_dlg=mq_dlg.id_tip_dlg
                                        AND dia_dlg BETWEEN '$fech%' AND '$fech2%'
                                        ORDER BY nom_usu ASC";
        //Contar cuantas diligencias son 
        $sql2="SELECT COUNT(tip_dlg.id_tip_dlg) as tipo,nom_tip_dlg,dia_dlg FROM mq_dlg, tip_dlg 
                                        WHERE mq_dlg.id_tip_dlg=tip_dlg.id_tip_dlg 
                                        AND dia_dlg BETWEEN '$fech%' AND '$fech2%'";
        //Contar cuantas diligencias son y agrupar por tipo de diligencia
        $sql3="SELECT COUNT(tip_dlg.id_tip_dlg) as tipo,nom_tip_dlg,dia_dlg FROM mq_dlg, tip_dlg 
                                        WHERE mq_dlg.id_tip_dlg=tip_dlg.id_tip_dlg 
                                        AND dia_dlg BETWEEN '$fech%' AND '$fech2%'
                                        GROUP BY nom_tip_dlg";
    }
}
$query=$conexion->query($sql);
$query2=$conexion->query($sql2);
$query3=$conexion->query($sql3);
$r=$query3->fetch(PDO::FETCH_ASSOC);
setlocale(LC_TIME, 'spanish'); //Lenguaje
$fecha1=ucwords(strftime("%B-%Y-%d", strtotime($fech)));// conversión a string
$fecha2=ucwords(strftime("%B-%Y-%d", strtotime($fech2)));

	if($query->rowCount() > 0 ){
						
		date_default_timezone_set('America/Bogota');

		if (PHP_SAPI == 'cli')
			die('Este archivo solo se puede ver desde un navegador web');

		/** Se agrega la libreria PHPExcel */
		require_once '../excel/lib/PHPExcel/PHPExcel.php';

		// Se crea el objeto PHPExcel
		$objPHPExcel = new PHPExcel();

		// Se asignan las propiedades del libro
		$objPHPExcel->getProperties()->setCreator("Codedrinks") //Autor
							 ->setLastModifiedBy("Codedrinks") //Ultimo usuario que lo modificó
							 ->setTitle("Reporte Excel con PHP y MySQL")
							 ->setSubject("Reporte Excel con PHP y MySQL")
							 ->setDescription("Reporte de diligencias")
							 ->setKeywords("reporte diligencias")
							 ->setCategory("Reporte excel");

		$tituloReporte = "TABLA DE DILIGENCIAS";
        if(isset($_POST['action']) && $_POST['action']=='costos'){
            $titulosColumnas = array('#','Tipo Diligencia','Nit Cliente','Cliente','Dirección','Día de Diligencia','Descripción','Observaciones','Estado Dil.','Efectividad','Fecha creación','Fecha actualización','Responsable','Usuario Actualizó','Regional','Costos');
        
            $objPHPExcel->setActiveSheetIndex(0)
                        ->mergeCells('A1:P2');
                            
            // Se agregan los titulos del reporte
            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A1',  $tituloReporte)
                        ->setCellValue('A3',  $titulosColumnas[0])
                        ->setCellValue('B3',  $titulosColumnas[1])
                        ->setCellValue('C3',  $titulosColumnas[2])
                        ->setCellValue('D3',  $titulosColumnas[3])
                        ->setCellValue('E3',  $titulosColumnas[4])
                        ->setCellValue('F3',  $titulosColumnas[5])
                        ->setCellValue('G3',  $titulosColumnas[6])
                        ->setCellValue('H3',  $titulosColumnas[7])
                        ->setCellValue('I3',  $titulosColumnas[8])
                        ->setCellValue('J3',  $titulosColumnas[9])
                        ->setCellValue('K3',  $titulosColumnas[10])
                        ->setCellValue('L3',  $titulosColumnas[11])
                        ->setCellValue('M3',  $titulosColumnas[12])
                        ->setCellValue('N3',  $titulosColumnas[13])
                        ->setCellValue('O3',  $titulosColumnas[14])
                        ->setCellValue('P3',  $titulosColumnas[15]);
        }else{            
		$titulosColumnas = array('#','Nombre Usuario','Tipo Diligencia','Cliente','Contacto Cl.','Teléfono','Dirección','Día de Diligencia','Horario Cliente','Descripción Diligencia','Observaciones','Estado Dil.','Efectividad');
		
		$objPHPExcel->setActiveSheetIndex(0)
        		    ->mergeCells('A1:M2');
						
		// Se agregan los titulos del reporte
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A1',  $tituloReporte)
        		    ->setCellValue('A3',  $titulosColumnas[0])
		            ->setCellValue('B3',  $titulosColumnas[1])
            		->setCellValue('C3',  $titulosColumnas[2])
            		->setCellValue('D3',  $titulosColumnas[3])
		            ->setCellValue('E3',  $titulosColumnas[4])
        		    ->setCellValue('F3',  $titulosColumnas[5])
            		->setCellValue('G3',  $titulosColumnas[6])
            		->setCellValue('H3',  $titulosColumnas[7])
		            ->setCellValue('I3',  $titulosColumnas[8])
        		    ->setCellValue('J3',  $titulosColumnas[9])
            		->setCellValue('K3',  $titulosColumnas[10])
        		    ->setCellValue('L3',  $titulosColumnas[11])
            		->setCellValue('M3',  $titulosColumnas[12]);
        }
		
		//Se agregan los datos de la diligencia
		$i = 4;
		while ($fila = $query->fetch(PDO::FETCH_ASSOC)) {
            if($fila['efc_dlg']==1){
                $efec="Si";
            }elseif($fila['efc_dlg']=='0'){
                $efec="No";
            }else{
                $efec="Pendiente";
            }
            if(isset($_POST['action']) && $_POST['action']=='costos'){
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i,  $fila['num_dlg'])
                    ->setCellValue('B'.$i,  $fila['nom_tip_dlg'])
                    ->setCellValue('C'.$i,  $fila['id_cli'])
                    ->setCellValue('D'.$i,  $fila['nom_cli'])
                    ->setCellValue('E'.$i,  $fila['dir_dlg'])
                    ->setCellValue('F'.$i,  $fila['dia_dlg'])
                    ->setCellValue('G'.$i,  $fila['dil_des'])
                    ->setCellValue('H'.$i,  $fila['obs_dlg'])
                    ->setCellValue('I'.$i,  $fila['nom_est_dlg'])
                    ->setCellValue('J'.$i,  $efec)
                    ->setCellValue('K'.$i,  $fila['fec_cre'])
                    ->setCellValue('L'.$i,  $fila['lst_upt'])
                    ->setCellValue('M'.$i,  $fila['nom_res'])
                    ->setCellValue('N'.$i,  $fila['usu_upt'])
                    ->setCellValue('O'.$i,  $fila['nom_reg'])
                    ->setCellValue('P'.$i,  "$".(substr($fila['cos_dlg'],0,-3).".".substr($fila['cos_dlg'],-3)));
                    $i++;
            }else{

			    $objPHPExcel->setActiveSheetIndex(0)
        		    ->setCellValue('A'.$i,  $fila['num_dlg'])
		            ->setCellValue('B'.$i,  $fila['nom_usu'])
            		->setCellValue('C'.$i,  $fila['nom_tip_dlg'])
            		->setCellValue('D'.$i,  $fila['nom_cli'])
		            ->setCellValue('E'.$i,  $fila['con_dlg'])
        		    ->setCellValue('F'.$i,  $fila['tel_dlg'])
            		->setCellValue('G'.$i,  $fila['dir_dlg'])
            		->setCellValue('H'.$i,  $fila['dia_dlg'])
		            ->setCellValue('I'.$i,  $fila['hor_dlg'])
        		    ->setCellValue('J'.$i,  $fila['dil_des'])
            		->setCellValue('K'.$i,  $fila['obs_dlg'])
            		->setCellValue('L'.$i,  $fila['nom_est_dlg'])
            		->setCellValue('M'.$i,  $efec);
					$i++;
            }
		}

		$estiloTituloReporte = array(
        	'font' => array(
	        	'name'      => 'Verdana',
    	        'bold'      => true,
        	    'italic'    => false,
                'strike'    => false,
               	'size' =>12,
	            	'color'     => array(
    	            	'rgb' => 'FFFFFF'
        	       	)
            ),
	        'fill' => array(
				'type'	=> PHPExcel_Style_Fill::FILL_SOLID,
				'color'	=> array('argb' => 'ED2939')
			),
            'borders' => array(
               	'allborders' => array(
                	'style' => PHPExcel_Style_Border::BORDER_NONE                    
               	)
            ), 
            'alignment' =>  array(
        			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        			'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        			'rotation'   => 0,
        			'wrap'       => TRUE
    		)
        );
		$estiloTituloColumnas = array(
            'font' => array(
                'name'      => 'Arial',
                'bold'      => true,                          
                'color'     => array(
                    'rgb' => 'FFFFFF'
                )
            ),
	        'fill' => array(
				'type'	=> PHPExcel_Style_Fill::FILL_SOLID,
				'color'	=> array('argb' => '363A41')
			),
            'borders' => array(
               	'allborders' => array(
                	'style' => PHPExcel_Style_Border::BORDER_NONE                    
               	)
            ), 
            'alignment' =>  array(
        			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        			'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        			'rotation'   => 0,
        			'wrap'       => TRUE
    		)
        );
			
		$estiloInformacion = new PHPExcel_Style();
		$estiloInformacion->applyFromArray(
			array(
           		'font' => array(
               	'name'      => 'Arial',               
               	'color'     => array(
                   	'rgb' => '000000'
               	)
           	),
           	'fill' 	=> array(
				'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
				'color'		=> array('argb' => 'FFFFFF')
			),
           	'borders' => array(
               	'allborders'     => array(
                   	'style' => PHPExcel_Style_Border::BORDER_THIN,
	                'color' => array(
    	            	'rgb' => '3a2a47'
                   	)
               	)             
           	)
        ));
		if(isset($_POST['action']) && $_POST['action']=='costos'){
            $objPHPExcel->getActiveSheet()->getStyle('A1:P2')->applyFromArray($estiloTituloReporte);
            $objPHPExcel->getActiveSheet()->getStyle('A3:P3')->applyFromArray($estiloTituloColumnas);       
            $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:P".($i-1));
                    
            for($i2 = 'A'; $i2 <= 'P'; $i2++){
                $objPHPExcel->setActiveSheetIndex(0)            
                    ->getColumnDimension($i2)->setAutoSize(TRUE);
            }
            //---------------------TABLA COSTOS POR ENRUTAMIENTOS----------------------------//
            $tituloReporteEnr = "TABLA ENRUTAMIENTOS";
            $titulosColumnasEnr = array('# Enr.','# Dil.','Usuario Actualizó','Fecha cración','Fecha Actualización','Fecha enrutamiento','Estado','Costos Adicionales','Regional');

            $objPHPExcel->setActiveSheetIndex(0)
                        ->mergeCells('A'.($i+1).':I'.($i+2).'');


            $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.($i+1),  $tituloReporteEnr)
            ->setCellValue('A'.($i+3),  $titulosColumnasEnr[0])
            ->setCellValue('B'.($i+3),  $titulosColumnasEnr[1])
            ->setCellValue('C'.($i+3),  $titulosColumnasEnr[2])
            ->setCellValue('D'.($i+3),  $titulosColumnasEnr[3])
            ->setCellValue('E'.($i+3),  $titulosColumnasEnr[4])
            ->setCellValue('F'.($i+3),  $titulosColumnasEnr[5])
            ->setCellValue('G'.($i+3),  $titulosColumnasEnr[6])
            ->setCellValue('H'.($i+3),  $titulosColumnasEnr[7])
            ->setCellValue('I'.($i+3),  $titulosColumnasEnr[8]);

                $objPHPExcel->getActiveSheet()->getStyle('A'.($i+1).':I'.($i+2).'')->applyFromArray($estiloTituloReporte);
                $objPHPExcel->getActiveSheet()->getStyle('A'.($i+3).':I'.($i+3).'')->applyFromArray($estiloTituloColumnas);
            $a=$i;
            while ($filaEnr = $query4->fetch(PDO::FETCH_ASSOC)) {
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.($i+4),  $filaEnr['num_enr'])
                    ->setCellValue('B'.($i+4),  $filaEnr['num_dlg'])
                    ->setCellValue('C'.($i+4),  $filaEnr['usu_upt'])
                    ->setCellValue('D'.($i+4),  $filaEnr['fec_crea'])
                    ->setCellValue('E'.($i+4),  $filaEnr['lst_upt'])
                    ->setCellValue('F'.($i+4),  $filaEnr['fec_enr'])
                    ->setCellValue('G'.($i+4),  $filaEnr['est_enr'])
                    ->setCellValue('H'.($i+4),  $filaEnr['cos_enr'])
                    ->setCellValue('I'.($i+4),  $filaEnr['nom_reg']);
                $i++;
                $i3=$i;
            }
                $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, 'A'.($a+4).':I'.($i+3));

            

            //---------------------TABLA COSTOS POR TIPO DE DILIGENCIA----------------------------//
            
            $tituloReporteCos = "TABLA COSTOS POR TIPO DE DILIGENCIA";
            $titulosColumnasCostos = array('Tipo Diligencia','Costos','Porcentaje');
        
            $objPHPExcel->setActiveSheetIndex(0)
                        ->mergeCells('A'.($i3+5).':C'.($i3+6).'');
                            
           
            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A'.($i3+5),  $tituloReporteCos)
                        ->setCellValue('A'.($i3+7),  $titulosColumnasCostos[0])
                        ->setCellValue('B'.($i3+7),  $titulosColumnasCostos[1])
                        ->setCellValue('C'.($i3+7),  $titulosColumnasCostos[2]);
                $objPHPExcel->getActiveSheet()->getStyle('A'.($i3+5).':C'.($i3+6).'')->applyFromArray($estiloTituloReporte);
                $objPHPExcel->getActiveSheet()->getStyle('A'.($i3+7).':C'.($i3+7).'')->applyFromArray($estiloTituloColumnas);
                $a2=$i3;
            while ($filaCos = $query2->fetch(PDO::FETCH_ASSOC)) {
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.($i3+8),  $filaCos['nom_tip_dlg'])
                    ->setCellValue('B'.($i3+8),  $filaCos['costo'])
                    ->setCellValue('C'.($i3+8),  number_format((($filaCos['costo']/$r['costoTotal'])*100),2,'.','').'%');
                $i3++;
            }
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.($i3+8),  ('TOTAL'))
                    ->setCellValue('B'.($i3+8),  "$".(substr($r['costoTotal'],0,-6)."'".substr($r['costoTotal'],-6,-3).".".substr($r['costoTotal'],-3)))
                    ->setCellValue('C'.($i3+8),  ('100%'));

                $objPHPExcel->getActiveSheet()->getStyle('A'.($i3+8).':C'.($i3+8).'')->applyFromArray($estiloTituloColumnas);
                $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, 'A'.($a2+8).':C'.($i3+7));
            
            //---------------------TABLA COSTOS POR AÑO----------------------------//
            /*
            $tituloReporteCosTotal = "TABLA COSTOS TOTAL DIL.";
            $titulosColumnasCostos = array('Tipo Diligencia','Costos','Porcentaje');
        
            $objPHPExcel->setActiveSheetIndex(0)
                        ->mergeCells('A'.($i).':C'.($i).'');
                            
           
            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('B'.($i+1),  $tituloReporteCos)
                        ->setCellValue('A'.($i+2),  $titulosColumnasCostos[0])
                        ->setCellValue('B'.($i+2),  $titulosColumnasCostos[1])
                        ->setCellValue('C'.($i+2),  $titulosColumnasCostos[2]);
                $objPHPExcel->getActiveSheet()->getStyle('A'.($i+1).':C'.($i+1).'')->applyFromArray($estiloTituloReporte);
                $objPHPExcel->getActiveSheet()->getStyle('A'.($i+2).':C'.($i+2).'')->applyFromArray($estiloTituloColumnas);
                $a=$i;
            while ($filaCos = $query2->fetch(PDO::FETCH_ASSOC)) {
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.($i+3),  $filaCos['nom_tip_dlg'])
                    ->setCellValue('B'.($i+3),  $filaCos['costo'])
                    ->setCellValue('C'.($i+3),  number_format((($filaCos['costo']/$r['costoTotal'])*100),2,'.',''));
                $i++;
            }
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.($i+3),  ('TOTAL'))
                    ->setCellValue('B'.($i+3),  "$".(substr($r['costoTotal'],0,-6)."'".substr($r['costoTotal'],-6,-3).".".substr($r['costoTotal'],-3)))
                    ->setCellValue('C'.($i+3),  ('100%'));

                $objPHPExcel->getActiveSheet()->getStyle('A'.($i+3).':C'.($i+3).'')->applyFromArray($estiloTituloColumnas);
                $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, 'A'.($a+3).':C'.($i+2));


                $objPHPExcel->getActiveSheet()->setTitle('Costos');*/
        }else{
    		$objPHPExcel->getActiveSheet()->getStyle('A1:M1')->applyFromArray($estiloTituloReporte);
    		$objPHPExcel->getActiveSheet()->getStyle('A3:M3')->applyFromArray($estiloTituloColumnas);		
    		$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:M".($i-1));
    				
    		for($i2 = 'A'; $i2 <= 'M'; $i2++){
    			$objPHPExcel->setActiveSheetIndex(0)			
    				->getColumnDimension($i2)->setAutoSize(TRUE);
    		}
    		
    		// Se asigna el nombre a la hoja
    		$objPHPExcel->getActiveSheet()->setTitle('Diligencias');
        }
		// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
		$objPHPExcel->setActiveSheetIndex(0);
		// Inmovilizar paneles 
		//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
		//$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);

		// Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$fecha1.'/'.$fecha2.'.xls"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
		
	}else{
		print "<script>alert(\"No hay resultados para mostrar\");window.location.href='index.php';</script>";
	}
?>