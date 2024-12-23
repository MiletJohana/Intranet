<?php
include '../../conexion.php';
require_once '../../excel/lib/PHPExcel/PHPExcel.php';
$objPHPExcel = new PHPExcel();
include '../indicadores/functions.php';
$anio = date('Y');
$hoy = date("Y-m-d h:i:s");
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', 'MES');
$x = array('B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN');
$titulos = array('Meta % Cumplimiento RP', 'Trabajadores Activos Inicio de Mes', 'Trabajadores Activos Final de Mes', 'Ingresos', 'Retiros', '% del Total RP', 'Meta % Cumplimiento AB', 'Actividades programadas', 'Actividades ejecutadas', '% del Total AB', 'Meta % Cumplimiento CAP', 'Capacitaciones programadas', 'Capacitaciones en producto', 'Capacitaciones ejecutadas', '% del Total CAP', 'Meta  Cumplimiento 0 dias antes DEAP', 'Entregas de Variable (1 Días antes)', 'Entregas de Nomina (1 Días antes)', 'Entrega seguridad Social (5 días habiles antes)', 'Entrega Liquidaciones (5 días habiles posteriores)', 'Cumplimiento promedio en días antes DEAP', 'Meta  Cumplimiento 0 Errores EN', 'Errores en Nomina', 'Errores en Comisiones', 'Errores en Seguridad Social', 'Errores en Liquidaciones', 'Suma Total de Errores EN', 'Meta Cumplimiento  en tiempo SPT', 'Requisiciones para el mes', 'Requisiones cubiertas en el Tiempo según tabla', 'Requisiciones cubiertas fuera de los Tiempos', '% del Total SPT', 'Meta Cumplimiento  en tiempo SPE', 'Ingresos hace seis meses', 'Continuidad de ingresos', '% del Total SPE', 'Meta Cumplimiento  en tiempo CL', 'Evaluación Clima Laboral', '% del Total CL');
for ($i = 0; $i < count($x); $i++) {
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue($x[$i] . '1', $titulos[$i]);
}
$meses = array('ENE', 'FEB', 'MAR', 'ABR', 'MAY', 'JUN', 'JUL', 'AGO', 'SEP', 'OCT', 'NOV', 'DIC', 'TOTAL');
for ($i = 0; $i < 13; $i++) {
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A' . ($i + 2), $meses[$i]);
}
$metasn = array('5', '98', '92', '0', '80', '75', '70');
for ($i = 0; $i < 13; $i++) {
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('B' . ($i + 2), $metasn[0])
        ->setCellValue('H' . ($i + 2), $metasn[1])
        ->setCellValue('L' . ($i + 2), $metasn[2])
        ->setCellValue('Q' . ($i + 2), $metasn[3])
        ->setCellValue('W' . ($i + 2), $metasn[3])
        ->setCellValue('AC' . ($i + 2), $metasn[4])
        ->setCellValue('AH' . ($i + 2), $metasn[5])
        ->setCellValue('AL' . ($i + 2), $metasn[6]);
}

for ($i = 0; $i < 12; $i++) {
    if (pago(1, 0, $i + 1, 1, $conexion) == '') {
        $pago1 = 0;
    } else {
        $pago1 = pago(1, 0, $i + 1, 1, $conexion);
    }
    if (pago(2, 0, $i + 1, 1, $conexion) == '') {
        $pago2 = 0;
    } else {
        $pago2 = pago(2, 0, $i + 1, 1, $conexion);
    }
    if (pago(3, 0, $i + 1, 1, $conexion) == '') {
        $pago3 = 0;
    } else {
        $pago3 = pago(3, 0, $i + 1, 1, $conexion);
    }
    if (pago(4, 0, $i + 1, 1, $conexion) == '') {
        $pago4 = 0;
    } else {
        $pago4 = pago(4, 0, $i + 1, 1, $conexion);
    }
    if (is_null(clima(1, 0, 0, $i + 1, $conexion))) {
        $clima = null;
    } else {
        $clima = clima(1, 0, 0, $i + 1, $conexion)*100;
    }
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('C' . ($i + 2), rotaPer(0, 1, 0, $i + 1, $conexion))
        ->setCellValue('D' . ($i + 2), rotaPer(0, 2, 0, $i + 1, $conexion))
        ->setCellValue('E' . ($i + 2), rotaPer(0, 3, 0, $i + 1, $conexion))
        ->setCellValue('F' . ($i + 2), rotaPer(0, 4, 0, $i + 1, $conexion))
        ->setCellValue('G' . ($i + 2), '=ROUND((IF(ISERROR((F' . ($i + 2) . '+E' . ($i + 2) . ')/(C' . ($i + 2) . '+D' . ($i + 2) . ')),0,(F' . ($i + 2) . '+E' . ($i + 2) . ')/(C' . ($i + 2) . '+D' . ($i + 2) . '))*100),0)')
        ->setCellValue('I' . ($i + 2), activBien(1, 0, $i + 1, $conexion))
        ->setCellValue('J' . ($i + 2), activBien(2, 0, $i + 1, $conexion))
        ->setCellValue('K' . ($i + 2), '=ROUND((IF(ISERROR(J' . ($i + 2) . '/I' . ($i + 2) . '),0,J' . ($i + 2) . '/I' . ($i + 2) . ')*100),0)')
        ->setCellValue('M' . ($i + 2), capacitacion(1, 0, $i + 1, $conexion))
        ->setCellValue('N' . ($i + 2), capacitacion(2, 0, $i + 1, $conexion))
        ->setCellValue('O' . ($i + 2), capacitacion(3, 0, $i + 1, $conexion))
        ->setCellValue('P' . ($i + 2), '=ROUND((IF(ISERROR(O' . ($i + 2) . '/M' . ($i + 2) . '),0,O' . ($i + 2) . '/M' . ($i + 2) . ')*100),0)')
        ->setCellValue('R' . ($i + 2), $pago1)
        ->setCellValue('S' . ($i + 2), $pago2)
        ->setCellValue('T' . ($i + 2), $pago2)
        ->setCellValue('U' . ($i + 2), $pago2)
        ->setCellValue('V' . ($i + 2), '=ROUND((IF(ISERROR(AVERAGE(R' . ($i + 2) . ':U' . ($i + 2) . ')),0,AVERAGE(R' . ($i + 2) . ':U' . ($i + 2) . '))*100),0)')
        ->setCellValue('X' . ($i + 2), error(1, 0, $i + 1, $conexion))
        ->setCellValue('Y' . ($i + 2), error(2, 0, $i + 1, $conexion))
        ->setCellValue('Z' . ($i + 2), error(3, 0, $i + 1, $conexion))
        ->setCellValue('AA' . ($i + 2), error(4, 0, $i + 1, $conexion))
        ->setCellValue('AB' . ($i + 2), '=ROUND((IF(ISERROR(SUM(X' . ($i + 2) . ':AA' . ($i + 2) . ')),0,SUM(X' . ($i + 2) . ':AA' . ($i + 2) . '))*100),0)')
        ->setCellValue('AD' . ($i + 2), tiempos(1, 0, $i + 1, $conexion))
        ->setCellValue('AE' . ($i + 2), tiempos(2, 0, $i + 1, $conexion))
        ->setCellValue('AF' . ($i + 2), tiempos(3, 0, $i + 1, $conexion))
        ->setCellValue('AG' . ($i + 2), '=ROUND((IF(ISERROR(AE' . ($i + 2) . '/AD' . ($i + 2) . '),0,AE' . ($i + 2) . '/AD' . ($i + 2) . ')*100),0)')
        ->setCellValue('AI' . ($i + 2), efectividad(1, 0, $i + 1, $conexion))
        ->setCellValue('AJ' . ($i + 2), efectividad(2, 0, $i + 1, $conexion))
        ->setCellValue('AK' . ($i + 2), '=ROUND((IF(ISERROR(AJ' . ($i + 2) . '/AI' . ($i + 2) . '),0,AJ' . ($i + 2) . '/AI' . ($i + 2) . ')*100),0)')
        ->setCellValue('AM' . ($i + 2), $clima)
        ->setCellValue('AN' . ($i + 2), '=IF(AM' . ($i + 2) . '="","",AM' . ($i + 2) . '-AL' . ($i + 2) . ')');
}

$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('C14', '=SUM(C2:C13)')
    ->setCellValue('D14', '=SUM(D2:D13)')
    ->setCellValue('E14', '=SUM(E2:E13)')
    ->setCellValue('F14', '=SUM(F2:F13)')
    ->setCellValue('G14', '=AVERAGE(G2:G13)')
    ->setCellValue('I14', '=SUM(I2:I13)')
    ->setCellValue('J14', '=SUM(J2:J13)')
    ->setCellValue('K14', '=AVERAGE(K2:K13)')
    ->setCellValue('M14', '=SUM(M2:M13)')
    ->setCellValue('N14', '=SUM(N2:N13)')
    ->setCellValue('O14', '=SUM(O2:O13)')
    ->setCellValue('P14', '=SUM(P2:P13)')
    ->setCellValue('R14', '=AVERAGE(R2:R13)')
    ->setCellValue('S14', '=AVERAGE(S2:S13)')
    ->setCellValue('T14', '=AVERAGE(T2:T13)')
    ->setCellValue('U14', '=AVERAGE(U2:U13)')
    ->setCellValue('V14', '=AVERAGE(V2:V13)')
    ->setCellValue('X14', '=SUM(X2:X13)')
    ->setCellValue('Y14', '=SUM(Y2:Y13)')
    ->setCellValue('Z14', '=SUM(Z2:Z13)')
    ->setCellValue('AA14', '=SUM(AA2:AA13)')
    ->setCellValue('AB14', '=SUM(AB2:AB13)')
    ->setCellValue('AD14', '=SUM(AD2:AD13)')
    ->setCellValue('AE14', '=SUM(AE2:AE13)')
    ->setCellValue('AF14', '=SUM(AF2:AF13)')
    ->setCellValue('AG14', '=IF(ISERROR(AE14/AD14),0,(AE14/AD14)*100)')
    ->setCellValue('AI14', '=SUM(AI2:AI13)')
    ->setCellValue('AJ14', '=SUM(AJ2:AJ13)')
    ->setCellValue('AK14', '=IF(ISERROR(AJ14/AI14),0,(AJ14/AI14)*100)')
    ->setCellValue('AM14', '=AVERAGE(AM2:AM13)')
    ->setCellValue('AN14', '=AVERAGE(AN2:AN13)');

$objPHPExcel->setActiveSheetIndex(0);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
$objWriter->setSheetIndex(0);   // Select which sheet.
$objWriter->setDelimiter(';');  // Define delimiter
$filename = "INDICADORES.csv";
$objWriter->save($filename);
