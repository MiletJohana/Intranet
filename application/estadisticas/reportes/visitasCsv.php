<?php
include '../../conexion.php';
require_once '../../excel/lib/PHPExcel/PHPExcel.php';
$objPHPExcel = new PHPExcel();
$sql = "SELECT vis.id_vis, per.id_per, per.nom_per, per.emp_per, vis.fec_vis, vis.fec_sal, are.nom_are, vis.fot_vis
FROM mq_pers AS per
INNER JOIN mq_vis AS vis
ON per.id_per = vis.id_per
INNER JOIN mq_are AS are
ON vis.id_are = are.id_are
ORDER BY vis.fec_vis DESC";
$query = $conexion->query($sql);
$anio = date('Y');
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', 'Id')
    ->setCellValue('B1', 'Documento Visitante')
    ->setCellValue('C1', 'Nombre Visitante')
    ->setCellValue('D1', 'Empresa Visitante')
    ->setCellValue('E1', 'Fecha')
    ->setCellValue('F1', 'Área')
    ->setCellValue('G1', 'Salida')
    ->setCellValue('H1', 'Imagen');
$fila = 2;
while ($r = $query->fetch(PDO::FETCH_ASSOC)) {
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A' . $fila, $r['id_vis'])
        ->setCellValue('B' . $fila, $r['id_per'])
        ->setCellValue('C' . $fila, $r['nom_per'])
        ->setCellValue('D' . $fila, $r['emp_per'])
        ->setCellValue('E' . $fila, date("Ymd", strtotime($r['fec_vis'])))
        ->setCellValue('F' . $fila, $r['nom_are'])
        ->setCellValue('G' . $fila, date("Hi", strtotime($r['fec_sal'])))
        ->setCellValue('H' . $fila, $r['fot_vis']);
    $fila++;
}
$fila = $fila - 1;
//Estilos

$objPHPExcel->getActiveSheet()->setTitle('Historial de Visitas');
$objPHPExcel->setActiveSheetIndex(0);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
$objWriter->setSheetIndex(0);   // Select which sheet.
$objWriter->setDelimiter(',');  // Define delimiter
$filename = "visitas.csv";
$objWriter->save($filename);
