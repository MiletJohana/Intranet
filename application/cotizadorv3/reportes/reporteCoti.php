<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
//include database configuration file
include '../../../conexion.php';

//Consultas------------------------ 
include 'consultas.php';
//-----------------------------------

    if($query->rowCount() > 0 ){
                        
        date_default_timezone_set('America/Bogota');

        if (PHP_SAPI == 'cli')
            die('Este archivo solo se puede ver desde un navegador web');

        /** Se agrega la libreria PhpSpreadsheet */
        require_once ("../../../resources/utils/phpexcel/vendor/autoload.php");

        // Se crea el objeto PhpSpreadsheet
        $objPHPExcel = new Spreadsheet();

        // Se asignan las propiedades del libro
        $objPHPExcel->getProperties()->setCreator("Codedrinks") //Autor
                             ->setLastModifiedBy("Codedrinks") //Ultimo usuario que lo modificó
                             ->setTitle("Reporte Excel con PHP y MySQL")
                             ->setSubject("Reporte Excel con PHP y MySQL")
                             ->setDescription("Reporte de diligencias")
                             ->setKeywords("reporte diligencias")
                             ->setCategory("Reporte excel");
        //Estilos--------------------------------------------
        include 'estilosReporte.php';
        //----------------------------------------------------------    
        
        if ($_POST["id_usu"]=="100" || $_POST["id_usu"]=="200" || $_POST["id_usu"]=="300") {
            $tituloReporte = "CONTROL COTIZACIONES";
            if($_POST["id_usu"]=="100"){
                $tituloReporte.=" SAC"; 
            }elseif($_POST["id_usu"]=="200"){
                $tituloReporte.=" VENTAS"; 
            }else{
                $tituloReporte.=" TELEVENTAS"; 
            }

        }else{
            $tituloReporte = "Control Cotizaciones: ".ucwords(strtolower($r2["nom_cotz"]));
        }
        //-------------------------Primera y Segunda Tabla-------------------
        $objPHPExcel->setActiveSheetIndex(0)
                    ->mergeCells('A1:G2');

        $titTabl1 = array('Estado de las cotizaciones','Cantidad', 'Total Cotizado', 'Total aprobado', 'Total perdido');
    
                        
        // Se agregan los titulos del reporte
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1',  $tituloReporte)
                    ->setCellValue('A4',  $titTabl1[0])
                    ->setCellValue('B4',  $titTabl1[1])
                    ->setCellValue('D4',  $titTabl1[2])
                    ->setCellValue('E4',  $titTabl1[3])
                    ->setCellValue('F4',  $titTabl1[4]);
        //Se agregan los datos
        $i = 5;
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('D'.$i,  (int)$precTot['totCot'])
                    ->setCellValue('E'.$i,  (int)$prec['total'])
                    ->setCellValue('F'.$i,  (int)($precTot['totCot']-$prec['total']));
                    
        while ($fila = $queryest-> fetch(PDO::FETCH_ASSOC)) {
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i,  $fila["estado"])
                    ->setCellValue('B'.$i,  $fila["cantidad"]);
                    $i++;
        }
            $objPHPExcel->getActiveSheet()->getStyle('A1:G2')->applyFromArray($estiloTituloReporte);
            $objPHPExcel->getActiveSheet()->getStyle('A4:B4')->applyFromArray($estiloTituloColumnas);       
            $objPHPExcel->getActiveSheet()->getStyle('D4:F4')->applyFromArray($estiloTituloColumnas);
            $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A5:B".($i-1));
            $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "D5:F5");

        $titTabl3 = array('Cons.','tipo de cotización','Fecha de creacion', 'Cliente / contacto', 'Estado', 'Solicita', 'Productos cotizados', 'Día', 'Comentario', 'Razón', 'Precio aprobado');

        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.($i+2),  $titTabl3[0])
                    ->setCellValue('B'.($i+2),  $titTabl3[1])
                    ->setCellValue('D'.($i+2),  $titTabl3[2])
                    ->setCellValue('C'.($i+2),  $titTabl3[3])
                    ->setCellValue('E'.($i+2),  $titTabl3[4])
                    ->setCellValue('F'.($i+2),  $titTabl3[5])
                    ->setCellValue('G'.($i+2),  $titTabl3[6])
                    ->setCellValue('H'.($i+2),  $titTabl3[7])
                    ->setCellValue('I'.($i+2),  $titTabl3[8])
                    ->setCellValue('J'.($i+2),  $titTabl3[9])
                    ->setCellValue('K'.($i+2),  $titTabl3[10]);

            $objPHPExcel->getActiveSheet()->getStyle('A'.($i+2).':K'.($i+2))->applyFromArray($estiloTituloColumnas);            
        $a=$i+2;
        while ($r = $query-> fetch(PDO::FETCH_ASSOC)) {
            if($r['est_cot']=='1'){
                $est="Pendiente";
            }elseif($r['est_cot']=='2'){
                $est="Aprobado";
            }elseif($r['est_cot']=='3'){
                $est="Rechazado";
            }elseif($r['est_cot']=='4'){
                $est="Actualización de precios";
            }else{
                $est="Sin Actualizar";
            }
            if($r['sol_cot']=='1'){
                $sol="Teléfono";
            }elseif($r['sol_cot']=='2'){
                $sol="Email";
            }elseif($r['sol_cot']=='3'){
                $sol="Vendedor";
            }else{
                $sol="Sin Actualizar";
            }
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.($i+3),  $r["nom_cns"].'-'.str_pad($r["cns_coti"], 4, "0", STR_PAD_LEFT))
                    ->setCellValue('B'.($i+3),  $r["nom_tip_cot"])
                    ->setCellValue('D'.($i+3),  $r["fecha_dl"])
                    ->setCellValue('C'.($i+3),  $r["raz_cli"].' / '.$r["nom1_cont"]." ".$r["nom2_cont"]." ".$r["ape1_cont"]." ".$r["ape2_cont"])
                    ->setCellValue('E'.($i+3),  $est)
                    ->setCellValue('F'.($i+3),  $sol)
                    ->setCellValue('G'.($i+3),  $r["prc_cot"])
                    ->setCellValue('H'.($i+3),  $r["env_cot"])
                    ->setCellValue('I'.($i+3),  $r["com_cot"])
                    ->setCellValue('J'.($i+3),  $r["mot_cot"])
                    ->setCellValue('K'.($i+3),  (int)$r["prec_cot"]);
            $i++;
            if($r['est_cot']=='1'){
                $objPHPExcel->getActiveSheet()->getStyle('E'.($i+2).':E'.($i+2))->applyFromArray($estColorYellow);            
            }elseif($r['est_cot']=='2'){
                $objPHPExcel->getActiveSheet()->getStyle('E'.($i+2).':E'.($i+2))->applyFromArray($estColorGreen);            
            }elseif($r['est_cot']=='3'){
                $objPHPExcel->getActiveSheet()->getStyle('E'.($i+2).':E'.($i+2))->applyFromArray($estColorRed);
            }elseif($r['est_cot']=='4'){
                $objPHPExcel->getActiveSheet()->getStyle('E'.($i+2).':E'.($i+2))->applyFromArray($estColorBlue);
            }else{
                $objPHPExcel->getActiveSheet()->getStyle('E'.($i+2).':E'.($i+2))->applyFromArray($estColorNin);
            }
            $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, 'A'.($a+1).':D'.($i+2));
            $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, 'F'.($a+1).':K'.($i+2));
            }
            
            //Poner estilos
                    
            for($i2 = 'A'; $i2 <= 'S'; $i2++){
                $objPHPExcel->setActiveSheetIndex(0)            
                    ->getColumnDimension($i2)->setAutoSize(TRUE);
            }
        // Se activa la hoja para que sea la que se muestre cuando el archivo se abre
        $objPHPExcel->setActiveSheetIndex(0);
        // Inmovilizar paneles 
        //$objPHPExcel->getActiveSheet(0)->freezePane('A4');
        //$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);

        // Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
        // Se asigna el nombre a la hoja
        $objPHPExcel->getActiveSheet()->setTitle('Control');

        header("Content-Type: text/html;charset=utf-8");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Prueba.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = IOFactory::createWriter($objPHPExcel, 'Xlsx');
        $objWriter->save('php://output');

        exit;
        
    }else{
        print "<script>alertInfo(\"No hay resultados para mostrar\"); window.location.reload();</script>";
    }
?>