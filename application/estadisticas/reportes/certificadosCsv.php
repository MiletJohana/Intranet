<?php
include '../../conexion.php';
require_once '../../excel/lib/PHPExcel/PHPExcel.php';
$objPHPExcel = new PHPExcel();
$sql = "SELECT cer.id_cert, usu.nom_usu, are.nom_are, cer.fec_creacion, cer.cer_salario, cer.cer_varia, cer.cer_rodam, cer.cer_sinsal
FROM ind_cert_x_usu AS cer
INNER JOIN mq_usu AS usu
ON cer.id_usu = usu.id_usu
INNER JOIN mq_are AS are
ON usu.id_are = are.id_are";
$query = $conexion->query($sql);
function flag($param){
    if ($param == NULL || is_null($param)) {
        return 0;
    } else {
        return 1;
    }
}
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', 'Id')
    ->setCellValue('B1', 'Usuario')
    ->setCellValue('C1', 'Área')
    ->setCellValue('D1', 'Fecha Creación')
    ->setCellValue('E1', 'Salario')
    ->setCellValue('F1', 'Variable')
    ->setCellValue('G1', 'Rodamiento')
    ->setCellValue('H1', 'Sin salario');
$fila = 2;
while ($r = $query->fetch(PDO::FETCH_ASSOC)) {
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A' . $fila, $r['id_cert'])
        ->setCellValue('B' . $fila, $r['nom_usu'])
        ->setCellValue('C' . $fila, $r['nom_are'])
        ->setCellValue('D' . $fila, date("Ymd", strtotime($r['fec_creacion'])))
        ->setCellValue('E' . $fila, flag($r['cer_salario']))
        ->setCellValue('F' . $fila, flag($r['cer_varia']))
        ->setCellValue('G' . $fila, flag($r['cer_rodam']))
        ->setCellValue('H' . $fila, flag($r['cer_sinsal']));
    $fila++;
}

$objPHPExcel->getActiveSheet()->setTitle('Historial de Certificados');
$objPHPExcel->setActiveSheetIndex(0);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
$objWriter->setSheetIndex(0);   // Select which sheet.
$objWriter->setDelimiter(',');  // Define delimiter
$filename = "certificados.csv";
$objWriter->save($filename);
