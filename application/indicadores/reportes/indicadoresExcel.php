<?php
include '../../conexion.php';
require_once '../../../resources/utils/phpexcel/PHPExcel.php';
$objPHPExcel = new PHPExcel();
include '../indicadores/functions.php';
include 'estilosReporte.php';
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('B1:N1');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('B2:N2');
$anio = date('Y');
$hoy = date("Y-m-d h:i:s");
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', 'CUADRO DE CONTROL TALENTO HUMANO')
    ->setCellValue('B1', 'TALENTO HUMANO')
    ->setCellValue('A2', 'Nombre')
    ->setCellValue('B2',  'Año ' . $anio)
    ->setCellValue('A3',  'DESCRIPCION');
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(60);
$x = array('B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N');
$meses = array('ENE', 'FEB', 'MAR', 'ABR', 'MAY', 'JUN', 'JUL', 'AGO', 'SEP', 'OCT', 'NOV', 'DIC', 'TOTAL');
for ($i = 0; $i < 13; $i++) {
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue($x[$i] . '3', $meses[$i]);
    $objPHPExcel->getActiveSheet()->getStyle($x[$i] . '3')->applyFromArray($borderThick);
}
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('A4:N4');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('A11:N11');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('A16:N16');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('A22:N22');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('A29:N29');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('A36:N36');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('A42:N42');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('A47:N47');
$titulos = array('ROTACION DE PERSONAL', 'ACTIVIDADES DE BIENESTAR', 'ACTIVIDADES DE CAPACITACION', 'DÍAS DE ENTREGA ANTES DEL PAGO', 'ERRORES EN NOMINA', 'SELECCION DE PERSONAL - Tiempos ', 'SELECCION DE PERSONAL - Efectividad', 'CLIMA LABORAL');
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A4', $titulos[0])
    ->setCellValue('A11', $titulos[1])
    ->setCellValue('A16', $titulos[2])
    ->setCellValue('A22', $titulos[3])
    ->setCellValue('A29', $titulos[4])
    ->setCellValue('A36', $titulos[5])
    ->setCellValue('A42', $titulos[6])
    ->setCellValue('A47', $titulos[7]);
$metas = array('Meta % Cumplimiento', 'Meta  Cumplimiento 0 dias antes', 'Meta  Cumplimiento 0 Errores', 'Meta Cumplimiento  en tiempo');
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A5', $metas[0])
    ->setCellValue('A12', $metas[0])
    ->setCellValue('A17', $metas[0])
    ->setCellValue('A23', $metas[1])
    ->setCellValue('A30', $metas[2])
    ->setCellValue('A37', $metas[3])
    ->setCellValue('A43', $metas[3])
    ->setCellValue('A48', $metas[3]);
$metasn = array(0.05, 0.98, 0.92, 0, 0.80, 0.75, 0.70);
for ($i = 0; $i < 13; $i++) {
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue($x[$i] . '5', $metasn[0])
        ->setCellValue($x[$i] . '12', $metasn[1])
        ->setCellValue($x[$i] . '17', $metasn[2])
        ->setCellValue($x[$i] . '23', $metasn[3])
        ->setCellValue($x[$i] . '30', $metasn[3])
        ->setCellValue($x[$i] . '37', $metasn[4])
        ->setCellValue($x[$i] . '43', $metasn[5])
        ->setCellValue($x[$i] . '48', $metasn[6]);
}
$total = array('% del Total', 'Cumplimiento promedio en días antes', 'Suma Total de Errores');
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A10', $total[0])
    ->setCellValue('A15', $total[0])
    ->setCellValue('A21', $total[0])
    ->setCellValue('A28', $total[1])
    ->setCellValue('A35', $total[2])
    ->setCellValue('A41', $total[0])
    ->setCellValue('A46', $total[0])
    ->setCellValue('A50', $total[0]);
$descRP = array('Trabajadores Activos Inicio de Mes', 'Trabajadores Activos Final de Mes', 'Ingresos', 'Retiros');
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A6', $descRP[0])
    ->setCellValue('A7', $descRP[1])
    ->setCellValue('A8', $descRP[2])
    ->setCellValue('A9', $descRP[3]);
$descAB = array('Actividades programadas', 'Actividades ejecutadas');
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A13', $descAB[0])
    ->setCellValue('A14', $descAB[1]);
$descAC = array('Capacitaciones programadas', 'Capacitaciones en producto', 'Capacitaciones ejecutadas');
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A18', $descAC[0])
    ->setCellValue('A19', $descAC[1])
    ->setCellValue('A20', $descAC[2]);
$descAP = array('Entregas de Variable (1 Días antes)', 'Entregas de Nomina (1 Días antes)', 'Entrega seguridad Social (5 días habiles antes)', 'Entrega Liquidaciones (5 días habiles posteriores)');
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A24', $descAP[0])
    ->setCellValue('A25', $descAP[1])
    ->setCellValue('A26', $descAP[2])
    ->setCellValue('A27', $descAP[3]);
$descEN = array('Errores en Nomina', 'Errores en Comisiones', 'Errores en Seguridad Social', 'Errores en Liquidaciones');
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A31', $descEN[0])
    ->setCellValue('A32', $descEN[1])
    ->setCellValue('A33', $descEN[2])
    ->setCellValue('A34', $descEN[3]);
$descST = array('Requisiciones para el mes', 'Requisiones cubiertas en el Tiempo según tabla', 'Requisiciones cubiertas fuera de los Tiempos');
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A38', $descST[0])
    ->setCellValue('A39', $descST[1])
    ->setCellValue('A40', $descST[2]);
$descSE = array('Ingresos hace seis meses', 'Continuidad de ingresos');
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A44', $descSE[0])
    ->setCellValue('A45', $descSE[1]);
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A49', 'Evaluación Clima Laboral');

//Estilos
$objPHPExcel->getActiveSheet()->getStyle('A1:N50')->applyFromArray($Arial11);
$objPHPExcel->getActiveSheet()->getStyle('A1:N3')->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('A1:N3')->applyFromArray($alignCenter);
$objPHPExcel->getActiveSheet()->getStyle('A4:N50')->applyFromArray($borderThin);
$objPHPExcel->getActiveSheet()->getStyle('A1:N2')->applyFromArray($borderNone);
$objPHPExcel->getActiveSheet()->getStyle('A3')->applyFromArray($borderThick);
$objPHPExcel->getActiveSheet()->getStyle('A4:N10')->applyFromArray($borderThick);
$objPHPExcel->getActiveSheet()->getStyle('A11:N15')->applyFromArray($borderThick);
$objPHPExcel->getActiveSheet()->getStyle('A16:N21')->applyFromArray($borderThick);
$objPHPExcel->getActiveSheet()->getStyle('A22:N28')->applyFromArray($borderThick);
$objPHPExcel->getActiveSheet()->getStyle('A29:N35')->applyFromArray($borderThick);
$objPHPExcel->getActiveSheet()->getStyle('A36:N41')->applyFromArray($borderThick);
$objPHPExcel->getActiveSheet()->getStyle('A42:N46')->applyFromArray($borderThick);
$objPHPExcel->getActiveSheet()->getStyle('A47:N50')->applyFromArray($borderThick);
$objPHPExcel->getActiveSheet()->getStyle('A4')->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('A11')->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('A16')->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('A22')->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('A29')->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('A36')->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('A42')->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('A47')->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('A5')->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('N5')->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('A10')->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('A12')->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('N12')->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('A15')->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('A17')->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('N17')->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('A21')->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('A23')->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('N23')->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('A28')->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('A30')->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('N30')->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('A35')->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('A37')->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('N37')->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('A41')->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('A43')->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('N43')->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('A46')->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('A48')->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('N48')->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('A50')->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('A4')->applyFromArray($alignCenter);
$objPHPExcel->getActiveSheet()->getStyle('A11')->applyFromArray($alignCenter);
$objPHPExcel->getActiveSheet()->getStyle('A16')->applyFromArray($alignCenter);
$objPHPExcel->getActiveSheet()->getStyle('A22')->applyFromArray($alignCenter);
$objPHPExcel->getActiveSheet()->getStyle('A29')->applyFromArray($alignCenter);
$objPHPExcel->getActiveSheet()->getStyle('A36')->applyFromArray($alignCenter);
$objPHPExcel->getActiveSheet()->getStyle('A42')->applyFromArray($alignCenter);
$objPHPExcel->getActiveSheet()->getStyle('A47')->applyFromArray($alignCenter);
$objPHPExcel->getActiveSheet()->getStyle('B5:N10')->applyFromArray($alignCenter);
$objPHPExcel->getActiveSheet()->getStyle('B12:N15')->applyFromArray($alignCenter);
$objPHPExcel->getActiveSheet()->getStyle('B17:N21')->applyFromArray($alignCenter);
$objPHPExcel->getActiveSheet()->getStyle('B23:N28')->applyFromArray($alignCenter);
$objPHPExcel->getActiveSheet()->getStyle('B30:N35')->applyFromArray($alignCenter);
$objPHPExcel->getActiveSheet()->getStyle('B37:N41')->applyFromArray($alignCenter);
$objPHPExcel->getActiveSheet()->getStyle('B43:N46')->applyFromArray($alignCenter);
$objPHPExcel->getActiveSheet()->getStyle('B48:N50')->applyFromArray($alignCenter);
$objPHPExcel->getActiveSheet()->getStyle('A4')->applyFromArray($azul);
$objPHPExcel->getActiveSheet()->getStyle('A11')->applyFromArray($azul);
$objPHPExcel->getActiveSheet()->getStyle('A16')->applyFromArray($azul);
$objPHPExcel->getActiveSheet()->getStyle('A22')->applyFromArray($azul);
$objPHPExcel->getActiveSheet()->getStyle('A29')->applyFromArray($azul);
$objPHPExcel->getActiveSheet()->getStyle('A36')->applyFromArray($azul);
$objPHPExcel->getActiveSheet()->getStyle('A42')->applyFromArray($azul);
$objPHPExcel->getActiveSheet()->getStyle('A47')->applyFromArray($azul);
$objPHPExcel->getActiveSheet()->getStyle('A5:N5')->applyFromArray($amarillo);
$objPHPExcel->getActiveSheet()->getStyle('A12:N12')->applyFromArray($amarillo);
$objPHPExcel->getActiveSheet()->getStyle('A17:N17')->applyFromArray($amarillo);
$objPHPExcel->getActiveSheet()->getStyle('A23:N23')->applyFromArray($amarillo);
$objPHPExcel->getActiveSheet()->getStyle('A30:N30')->applyFromArray($amarillo);
$objPHPExcel->getActiveSheet()->getStyle('A37:N37')->applyFromArray($amarillo);
$objPHPExcel->getActiveSheet()->getStyle('A43:N43')->applyFromArray($amarillo);
$objPHPExcel->getActiveSheet()->getStyle('A48:N48')->applyFromArray($amarillo);
$objPHPExcel->getActiveSheet()->getStyle('A10:N10')->applyFromArray($rojo);
$objPHPExcel->getActiveSheet()->getStyle('A15:N15')->applyFromArray($rojo);
$objPHPExcel->getActiveSheet()->getStyle('A21:N21')->applyFromArray($rojo);
$objPHPExcel->getActiveSheet()->getStyle('A28:N28')->applyFromArray($rojo);
$objPHPExcel->getActiveSheet()->getStyle('A35:N35')->applyFromArray($rojo);
$objPHPExcel->getActiveSheet()->getStyle('A41:N41')->applyFromArray($rojo);
$objPHPExcel->getActiveSheet()->getStyle('A46:N46')->applyFromArray($rojo);
$objPHPExcel->getActiveSheet()->getStyle('A50:N50')->applyFromArray($rojo);
$objPHPExcel->getActiveSheet()->getStyle('B5:N5')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE);
$objPHPExcel->getActiveSheet()->getStyle('B10:M10')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE);
$objPHPExcel->getActiveSheet()->getStyle('N10')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
$objPHPExcel->getActiveSheet()->getStyle('B12:N12')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE);
$objPHPExcel->getActiveSheet()->getStyle('B15:N15')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE);
$objPHPExcel->getActiveSheet()->getStyle('B17:N17')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE);
$objPHPExcel->getActiveSheet()->getStyle('B21:N21')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE);
$objPHPExcel->getActiveSheet()->getStyle('B37:N37')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE);
$objPHPExcel->getActiveSheet()->getStyle('B41:N41')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE);
$objPHPExcel->getActiveSheet()->getStyle('B43:N43')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE);
$objPHPExcel->getActiveSheet()->getStyle('B46:N46')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE);
$objPHPExcel->getActiveSheet()->getStyle('B48:N48')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE);
$objPHPExcel->getActiveSheet()->getStyle('B49:N49')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE);
$objPHPExcel->getActiveSheet()->getStyle('B50:N50')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE);

for ($i = 0; $i < 12; $i++) {
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue($x[$i] . '6', rotaPer(0, 1, 0, $i + 1, $conexion))
        ->setCellValue($x[$i] . '7', rotaPer(0, 2, 0, $i + 1, $conexion))
        ->setCellValue($x[$i] . '8', rotaPer(0, 3, 0, $i + 1, $conexion))
        ->setCellValue($x[$i] . '9', rotaPer(0, 4, 0, $i + 1, $conexion))
        ->setCellValue($x[$i] . '10', '=IF(ISERROR((' . $x[$i] . '9+' . $x[$i] . '8)/(' . $x[$i] . '6+' . $x[$i] . '7))," ",(' . $x[$i] . '9+' . $x[$i] . '8)/(' . $x[$i] . '6+' . $x[$i] . '7))')
        ->setCellValue($x[$i] . '13', activBien(1, 0, $i + 1, $conexion))
        ->setCellValue($x[$i] . '14', activBien(2, 0, $i + 1, $conexion))
        ->setCellValue($x[$i] . '15', '=IF(ISERROR(' . $x[$i] . '14/' . $x[$i] . '13)," ",' . $x[$i] . '14/' . $x[$i] . '13)')
        ->setCellValue($x[$i] . '18', capacitacion(1, 0, $i + 1, $conexion))
        ->setCellValue($x[$i] . '19', capacitacion(2, 0, $i + 1, $conexion))
        ->setCellValue($x[$i] . '20', capacitacion(3, 0, $i + 1, $conexion))
        ->setCellValue($x[$i] . '21', '=IF(ISERROR(' . $x[$i] . '20/' . $x[$i] . '18)," ",' . $x[$i] . '20/' . $x[$i] . '18)')
        ->setCellValue($x[$i] . '24', pago(1, 0, $i + 1, 1, $conexion))
        ->setCellValue($x[$i] . '25', pago(2, 0, $i + 1, 1, $conexion))
        ->setCellValue($x[$i] . '26', pago(3, 0, $i + 1, 1, $conexion))
        ->setCellValue($x[$i] . '27', pago(4, 0, $i + 1, 1, $conexion))
        ->setCellValue($x[$i] . '28', '=IF(ISERROR(AVERAGE(' . $x[$i] . '24:' . $x[$i] . '27))," ",AVERAGE(' . $x[$i] . '24:' . $x[$i] . '27))')
        ->setCellValue($x[$i] . '31', error(1, 0, $i + 1, $conexion))
        ->setCellValue($x[$i] . '32', error(2, 0, $i + 1, $conexion))
        ->setCellValue($x[$i] . '33', error(3, 0, $i + 1, $conexion))
        ->setCellValue($x[$i] . '34', error(4, 0, $i + 1, $conexion))
        ->setCellValue($x[$i] . '35', '=IF(ISERROR(SUM(' . $x[$i] . '31:' . $x[$i] . '34))," ",SUM(' . $x[$i] . '31:' . $x[$i] . '34))')
        ->setCellValue($x[$i] . '38', tiempos(1, 0, $i + 1, $conexion))
        ->setCellValue($x[$i] . '39', tiempos(2, 0, $i + 1, $conexion))
        ->setCellValue($x[$i] . '40', tiempos(3, 0, $i + 1, $conexion))
        ->setCellValue($x[$i] . '41', '=IF(ISERROR(' . $x[$i] . '39/' . $x[$i] . '38)," ",' . $x[$i] . '39/' . $x[$i] . '38)')
        ->setCellValue($x[$i] . '44', efectividad(1, 0, $i + 1, $conexion))
        ->setCellValue($x[$i] . '45', efectividad(2, 0, $i + 1, $conexion))
        ->setCellValue($x[$i] . '46', '=IF(ISERROR(' . $x[$i] . '45/' . $x[$i] . '44)," ",' . $x[$i] . '45/' . $x[$i] . '44)')
        ->setCellValue($x[$i] . '49', clima(1, 0, 0, $i + 1, $conexion))
        ->setCellValue($x[$i] . '50', '=IF(' . $x[$i] . '49=""," ",' . $x[$i] . '49-' . $x[$i] . '48)');
}

for ($i = 0; $i < 12; $i++) {
    if ((pago(1, 0, $i + 1, 1, $conexion)) <= 0) {
        $objPHPExcel->getActiveSheet()->getStyle($x[$i] . '24')->applyFromArray($conditionalS);
    }
    if ((pago(2, 0, $i + 1, 1, $conexion)) <= 0) {
        $objPHPExcel->getActiveSheet()->getStyle($x[$i] . '25')->applyFromArray($conditionalS);
    }
    if ((pago(3, 0, $i + 1, 1, $conexion)) <= 0) {
        $objPHPExcel->getActiveSheet()->getStyle($x[$i] . '26')->applyFromArray($conditionalS);
    }
    if ((pago(4, 0, $i + 1, 1, $conexion)) <= 0) {
        $objPHPExcel->getActiveSheet()->getStyle($x[$i] . '27')->applyFromArray($conditionalS);
    }
}
for ($i = 0; $i < 12; $i++) {
    if ((pago(1, 0, $i + 1, 1, $conexion)) > 0) {
        $objPHPExcel->getActiveSheet()->getStyle($x[$i] . '31')->applyFromArray($conditionalS);
    }
    if ((pago(2, 0, $i + 1, 1, $conexion)) > 0) {
        $objPHPExcel->getActiveSheet()->getStyle($x[$i] . '32')->applyFromArray($conditionalS);
    }
    if ((pago(3, 0, $i + 1, 1, $conexion)) > 0) {
        $objPHPExcel->getActiveSheet()->getStyle($x[$i] . '33')->applyFromArray($conditionalS);
    }
    if ((pago(4, 0, $i + 1, 1, $conexion)) > 0) {
        $objPHPExcel->getActiveSheet()->getStyle($x[$i] . '34')->applyFromArray($conditionalS);
    }
}

for ($i = 6; $i < 10; $i++) {
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('N' . $i, "=SUM(B$i:M$i)");
}
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('N10', '=AVERAGE(B10:M10)');
for ($i = 13; $i < 15; $i++) {
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('N' . $i, "=SUM(B$i:M$i)");
}
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('N15', '=AVERAGE(B15:M15)');
for ($i = 18; $i < 21; $i++) {
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('N' . $i, "=SUM(B$i:M$i)");
}
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('N21', '=AVERAGE(B21:M21)');
for ($i = 24; $i < 29; $i++) {
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('N' . $i, '=IF(ISERROR(AVERAGE(B' . $i . ':M' . $i . ')),0,AVERAGE(B' . $i . ':M' . $i . '))');
}
for ($i = 31; $i < 36; $i++) {
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('N' . $i, "=SUM(B$i:M$i)");
}
for ($i = 38; $i < 41; $i++) {
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('N' . $i, "=SUM(B$i:M$i)");
}
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N41', '=IF(ISERROR(N39/N38)," ",N39/N38)');
for ($i = 44; $i < 46; $i++) {
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('N' . $i, "=SUM(B$i:M$i)");
}
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N46', '=IF(ISERROR(N45/N44)," ",N45/N44)');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N49', '=AVERAGE(B49:M49)');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N50', '=AVERAGE(B50:M50)');

$objPHPExcel->getActiveSheet()->setTitle('RESUMEN TTHH');
$objPHPExcel->setActiveSheetIndex(0);

if (isset($_POST['param']) && $_POST['param'] == 1) {
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $filename = "INDICADORES.xls";
    $objWriter->save($filename);
} else if (isset($_POST['param']) && $_POST['param'] == 2) {
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
    $filename = "INDICADORES.csv";
    $objWriter->save($filename);
} else {
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="INDICADORES TTHH.csv"');
    header('Cache-Control: max-age=0');
    $objWriter->save("php://output");
}
