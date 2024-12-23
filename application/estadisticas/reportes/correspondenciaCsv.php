<?php
include '../../conexion.php';
require_once '../../excel/lib/PHPExcel/PHPExcel.php';
$objPHPExcel = new PHPExcel();
$sql = "SELECT seg.id_seg, 
us.nom_usu, 
nom.nom_doc, 
seg.fech_ini, 
ar.nom_are, 
seg.per_encarga, 
es.nom_estS, 
pro.id_prove, 
seg.fec_ven, 
seg.nom_pro
FROM seg_ingreso AS seg
INNER JOIN mq_usu AS us
ON seg.id_usu = us.id_usu 
INNER JOIN seg_nomdoc AS nom
ON seg.id_nom = nom.id_nom  
INNER JOIN mq_are AS ar
ON seg.area_remit = ar.id_are 
INNER JOIN seg_estado AS es
ON seg.id_estSeg = es.id_estSeg
INNER JOIN mq_prove AS pro 
ON seg.id_prove = pro.id_prove
GROUP BY seg.id_seg";
$query = $conexion->query($sql);
function usu($id, $conexion)
{
    $sql = "SELECT nom_usu FROM mq_usu WHERE id_usu = $id";
    $query = $conexion->query($sql);
    $r = $query->fetch(PDO::FETCH_ASSOC);
    return $r['nom_usu'];
}
$anio = date('Y');
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', 'Id')
    ->setCellValue('B1', 'Usuario')
    ->setCellValue('C1', 'Nombre Documento')
    ->setCellValue('D1', 'Fecha Inicio')
    ->setCellValue('E1', 'Área')
    ->setCellValue('F1', 'Persona encargada')
    ->setCellValue('G1', 'Estado')
    ->setCellValue('H1', 'ID Proveedor')
    ->setCellValue('I1', 'Fecha de Vencimiento')
    ->setCellValue('J1', 'Nombre Proveedor');
$fila = 2;
while ($r = $query->fetch(PDO::FETCH_ASSOC)) {
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A' . $fila, $r['id_seg'])
        ->setCellValue('B' . $fila, $r['nom_usu'])
        ->setCellValue('C' . $fila, $r['nom_doc'])
        ->setCellValue('D' . $fila, date("Ymd", strtotime($r['fech_ini'])))
        ->setCellValue('E' . $fila, $r['nom_are'])
        ->setCellValue('F' . $fila, usu($r['per_encarga'], $conexion))
        ->setCellValue('G' . $fila, $r['nom_estS'])
        ->setCellValue('H' . $fila, $r['id_prove'])
        ->setCellValue('I' . $fila, date("Ymd", strtotime($r['fec_ven'])))
        ->setCellValue('J' . $fila, $r['nom_pro']);
    $fila++;
}
$fila = $fila - 1;
//Estilos

$objPHPExcel->getActiveSheet()->setTitle('Historial de Correspondencia');
$objPHPExcel->setActiveSheetIndex(0);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
$objWriter->setSheetIndex(0);   // Select which sheet.
$objWriter->setDelimiter(',');  // Define delimiter
$filename = "correspondencia.csv";
$objWriter->save($filename);
