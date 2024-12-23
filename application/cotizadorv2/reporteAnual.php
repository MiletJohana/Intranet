<?php
//include database configuration file
include '../../../conexion.php';
$sql="SELECT * FROM cot_cotizaciones ";
if($_POST['id_usu']=='100'){
    $sql.=" cot,mq_usu us WHERE cot.id_usu=us.id_usu AND grup_car IN(18)";
}elseif($id=='200'){
    $sql.=" cot,mq_usu us WHERE cot.id_usu=us.id_usu AND grup_car IN(19)";
}elseif($id=='300'){
    $sql.=" cot,mq_usu us WHERE cot.id_usu=us.id_usu AND grup_car IN(20)";
}else{
    $sql.=" WHERE id_usu='".$_POST['id_usu']."'";
}
$queryVer=$conexion->query($sql);
//Consultas------------------------ 
//-----------------------------------
    if($queryVer->rowCount() > 0 ){
        if (PHP_SAPI == 'cli')
            die('Este archivo solo se puede ver desde un navegador web');

            /** Se agrega la libreria PHPExcel */
            require_once '../../../resources/utils/phpexcel/PHPExcel.php';

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

        $pag=0;
        for($an=1;$an<=12;$an++){
        if($an<10){
            $an='0'.$an;
        }
        include 'consultas.php';
        if($query->rowCount() > 0 ){
            date_default_timezone_set('America/Bogota');

            //Estilos--------------------------------------------
            include 'estilosReporte.php';
            //----------------------------------------------------------    
            
            if ($_POST["id_usu"]=="100") {
                $tituloReporte = "CONTROL COTIZACIONES SAC";
            }elseif($_POST["id_usu"]=="200"){
                $tituloReporte = "CONTROL COTIZACIONES VENTAS";
            }elseif($_POST["id_usu"]=="300"){
                $tituloReporte = "CONTROL COTIZACIONES TELEVENTAS";
            }else{
                $tituloReporte = "Control Cotizaciones: ".ucwords(strtolower($r2["nom_usu"]));
            }
            $titulosSecundarios = array('FOSC1-1.05','MASTER QUIMICA');

            $objPHPExcel->setActiveSheetIndex($pag)
                        ->mergeCells('A1:B1');
            $objPHPExcel->setActiveSheetIndex($pag)
                        ->mergeCells('C1:N1');
            $objPHPExcel->setActiveSheetIndex($pag)
                        ->mergeCells('O1:S1');
            $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(40);

            $objPHPExcel->setActiveSheetIndex($pag)
                        ->setCellValue('A1',  $titulosSecundarios[0])
                        ->setCellValue('C1',  $tituloReporte)
                        ->setCellValue('O1',  $titulosSecundarios[1]);

                $objPHPExcel->getActiveSheet()->getStyle('A1:S1')->applyFromArray($estiloTituloReporte);


            $SubTitulos= array('MES','AÑO:','REPRESENTANTE SC / VE','CODIGO  COLOR:','APROBADO','PENDIENTE','PERDIDO','ACTUALIZACIÓN DE PRECIOS','FECHA: SOLO SE DIGITA EL DÍA','MEDIO','ENVIO COTIZAC','SEGUIMIENTO');

            $objPHPExcel->setActiveSheetIndex($pag)
                        ->mergeCells('A2:B2');
            $objPHPExcel->setActiveSheetIndex($pag)
                        ->mergeCells('E2:G2');
            $objPHPExcel->setActiveSheetIndex($pag)
                        ->mergeCells('H2:N2');
            $objPHPExcel->setActiveSheetIndex($pag)
                        ->mergeCells('A3:C3');
            $objPHPExcel->setActiveSheetIndex($pag)
                        ->mergeCells('D3:G3');
            $objPHPExcel->setActiveSheetIndex($pag)
                        ->mergeCells('J3:N3');
            $objPHPExcel->setActiveSheetIndex($pag)
                        ->mergeCells('O2:S4');

            setlocale(LC_ALL, 'es_ES', 'Spanish_Spain', 'Spanish');
            $StringMes=ucwords(strftime("%B", strtotime($mesAn."-".$an)));
            $StringAnio=ucwords(strftime("%Y", strtotime($mesAn."-".$an)));
            $objPHPExcel->setActiveSheetIndex($pag)
                        ->setCellValue('A2',  $SubTitulos[0])
                        ->setCellValue('C2',  $StringMes)
                        ->setCellValue('D2',  $SubTitulos[1])
                        ->setCellValue('E2',  $StringAnio)
                        ->setCellValue('H2',  $SubTitulos[2])
                        ->setCellValue('A3',  $SubTitulos[3])
                        ->setCellValue('D3',  $SubTitulos[4])
                        ->setCellValue('H3',  $SubTitulos[5])
                        ->setCellValue('I3',  $SubTitulos[6])
                        ->setCellValue('J3',  $SubTitulos[7]);

                $objPHPExcel->getActiveSheet()->getStyle('A2:S3')->applyFromArray($estColorNin);
                $objPHPExcel->getActiveSheet()->getStyle('D3:D3')->applyFromArray($estColorGreen);
                $objPHPExcel->getActiveSheet()->getStyle('H3:H3')->applyFromArray($estColorYellow);
                $objPHPExcel->getActiveSheet()->getStyle('I3:I3')->applyFromArray($estColorRed);
                $objPHPExcel->getActiveSheet()->getStyle('J3:J3')->applyFromArray($estColorBlue);
                $objPHPExcel->getActiveSheet()->getStyle('A2:A2')->applyFromArray($estColorLetRoja);
                $objPHPExcel->getActiveSheet()->getStyle('D2:D2')->applyFromArray($estColorLetRoja);
                    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
                    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(22);
                    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
                    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(5);
                    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(3);
                    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(3);
                    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
                    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(25);
                    $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(10);
                    $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(5);
                    $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(10);
                    $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(5);
                    $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(5);
                    $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(5);
                    $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(5);
                
                $SubTitulos2= array('FECHA: SOLO SE DIGITA EL DÍA','MEDIO','ENVIO COTIZAC','SEGUIMIENTO', 'FECHA SOL' ,'CONSEC', 'CLIENTE', 'TELEFONO', 'SOL. V','T','E', 'CONFIRMADO POR', 'PRODUCTOS COTIZADOS','FECHA', 'CUMP  SI  NO','COMENTARIO', 'FECHA','CA', 'EST', 'DEF X S/V', 'VALOR COMPRA' ,'ZONA');


                $objPHPExcel->setActiveSheetIndex($pag)
                        ->mergeCells('A4:C4');
                $objPHPExcel->setActiveSheetIndex($pag)
                        ->mergeCells('E4:G4');
                $objPHPExcel->setActiveSheetIndex($pag)
                        ->mergeCells('J4:N4');
                $objPHPExcel->setActiveSheetIndex($pag)
                        ->mergeCells('L5:M5');

                $objPHPExcel->setActiveSheetIndex($pag)
                        ->setCellValue('A4',  $SubTitulos2[0])
                        ->setCellValue('E4',  $SubTitulos2[1])
                        ->setCellValue('J4',  $SubTitulos2[2])
                        ->setCellValue('L4',  $SubTitulos2[3])

                        ->setCellValue('A5',  $SubTitulos2[4])
                        ->setCellValue('B5',  $SubTitulos2[5])
                        ->setCellValue('C5',  $SubTitulos2[6])
                        ->setCellValue('D5',  $SubTitulos2[7])
                        ->setCellValue('E5',  $SubTitulos2[8])
                        ->setCellValue('F5',  $SubTitulos2[9])
                        ->setCellValue('G5',  $SubTitulos2[10])
                        ->setCellValue('H5',  $SubTitulos2[11])
                        ->setCellValue('I5',  $SubTitulos2[12])
                        ->setCellValue('J5',  $SubTitulos2[13])
                        ->setCellValue('K5',  $SubTitulos2[14])
                        ->setCellValue('L5',  $SubTitulos2[15])
                        ->setCellValue('N5',  $SubTitulos2[16])
                        ->setCellValue('O5',  $SubTitulos2[17])
                        ->setCellValue('P5',  $SubTitulos2[18])
                        ->setCellValue('Q5',  $SubTitulos2[19])
                        ->setCellValue('R5',  $SubTitulos2[20])
                        ->setCellValue('S5',  $SubTitulos2[21]);

                    $objPHPExcel->getActiveSheet()->getStyle('A4:S5')->applyFromArray($estColorNin);
                    $objPHPExcel->getActiveSheet()->getStyle('E5')->getAlignment()->setTextRotation(90);
                    $objPHPExcel->getActiveSheet()->getStyle('J5')->getAlignment()->setTextRotation(90);
                    $objPHPExcel->getActiveSheet()->getStyle('K5')->getAlignment()->setTextRotation(90);
                    $objPHPExcel->getActiveSheet()->getStyle('N5')->getAlignment()->setTextRotation(90);
                    $objPHPExcel->getActiveSheet()->getStyle('O5')->getAlignment()->setTextRotation(90);
                    $objPHPExcel->getActiveSheet()->getStyle('P5')->getAlignment()->setTextRotation(90);
                    $objPHPExcel->getActiveSheet()->getStyle('Q5')->getAlignment()->setTextRotation(90);
                    $objPHPExcel->getActiveSheet()->getStyle('S5')->getAlignment()->setTextRotation(90);

                $i=6;
                while ($r=$query->fetch(PDO::FETCH_ASSOC)) {
                $objPHPExcel->setActiveSheetIndex($pag)
                        ->mergeCells('L'.$i.':M'.$i);
                $objPHPExcel->setActiveSheetIndex($pag)
                        ->setCellValue('A'.$i, $r['fec_sol'])
                        ->setCellValue('B'.$i, $r['nom_cns'].'-'.str_pad($r["cns_coti"], 4, "0", STR_PAD_LEFT))
                        ->setCellValue('C'.$i, $r['nom_cli'])
                        ->setCellValue('D'.$i,$r['tel_cli']);
                            if($r['sol_cot']=='1'){
                            $objPHPExcel->setActiveSheetIndex($pag)
                                ->setCellValue('F'.$i, "X");
                            }elseif($r['sol_cot']=='2'){
                            $objPHPExcel->setActiveSheetIndex($pag)
                                ->setCellValue('G'.$i, "X");
                            }elseif($r['sol_cot']=='3'){
                            $objPHPExcel->setActiveSheetIndex($pag)
                                ->setCellValue('E'.$i, "X");
                            }
                $objPHPExcel->setActiveSheetIndex($pag)
                        ->setCellValue('H'.$i, $r['conf_cotiz'])
                        ->setCellValue('I'.$i, $r['prc_cot'])
                        ->setCellValue('J'.$i, $r['env_cot'])
                        ->setCellValue('K'.$i, "")
                        ->setCellValue('L'.$i, $r['com_cot'])
                        ->setCellValue('N'.$i, $r['est_upd'])
                        ->setCellValue('O'.$i, "")
                        ->setCellValue('P'.$i, "")
                        ->setCellValue('Q'.$i, "")
                        ->setCellValue('R'.$i, "$".number_format($r['prec_cot']))
                        ->setCellValue('S'.$i, "");


                if($r['est_cot']=='1'){
                    $objPHPExcel->getActiveSheet()->getStyle('C'.($i).':C'.($i))->applyFromArray($estColorYellow);            
                }elseif($r['est_cot']=='2'){
                    $objPHPExcel->getActiveSheet()->getStyle('C'.($i).':C'.($i))->applyFromArray($estColorGreen);            
                }elseif($r['est_cot']=='3'){
                    $objPHPExcel->getActiveSheet()->getStyle('C'.($i).':C'.($i))->applyFromArray($estColorRed);
                }elseif($r['est_cot']=='4'){
                    $objPHPExcel->getActiveSheet()->getStyle('C'.($i).':C'.($i))->applyFromArray($estColorBlue);
                }else{
                    $objPHPExcel->getActiveSheet()->getStyle('C'.($i).':C'.($i))->applyFromArray($estColorNin);
                }
                $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, 'A'.($i).':B'.($i));
                $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, 'D'.($i).':S'.($i));
                $i++;
                }

                $objPHPExcel->getActiveSheet()->getStyle('C6:U'.$i)
                                ->getAlignment()->setWrapText(true);
                        
            // Se activa la hoja para que sea la que se muestre cuando el archivo se abre
            $objPHPExcel->setActiveSheetIndex($pag);
            // Inmovilizar paneles 
            $objPHPExcel->getActiveSheet(0)->freezePane('A1');
            $objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,6);

            // Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
            // Se asigna el nombre a la hoja
            $StringMes2=ucwords(strftime("%b", strtotime($mesAn."-".$an)));
            $objPHPExcel->getActiveSheet()->setTitle($StringMes2);
            // Aqui se crea la nueva pestaña
            if($an<=12){
                $myWorkSheet = new PHPExcel_Worksheet($objPHPExcel, 'Nueva');
                $objPHPExcel->addSheet($myWorkSheet, $pag+1);
            }
            $pag++;
            }
            }
            //
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="Control-Anual-'.$mesAn.$r2["nom_cns"].'.xls"');
            header('Cache-Control: max-age=0');

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save('php://output');
            exit;

    }else{
        print "<script>alert(\"No hay resultados para mostrar\");window.location.href='../cotizaciones/index.php';</script>";
    }
?>