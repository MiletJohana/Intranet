<?php
include '../../conexion.php';
require_once '../../excel/lib/PHPExcel/PHPExcel.php';
$objPHPExcel = new PHPExcel();
$sql = "SELECT dl.num_dlg, 
cl.nom_cli, 
dl.con_dlg, 
dl.dia_dlg, 
dl.dir_dlg, 
tp.nom_tip_dlg, 
dl.dil_des, 
dl.tel_dlg, 
es.nom_est_dlg, 
dl.est_dlg, 
cl.id_cli, 
reg.nom_reg, 
dl.nom_res, 
usu.nom_usu, 
are.nom_are 
FROM mq_dlg AS dl 
INNER JOIN mq_clie AS cl 
ON dl.id_cli = cl.id_cli 
INNER JOIN tip_dlg AS tp 
ON dl.id_tip_dlg = tp.id_tip_dlg 
INNER JOIN mq_est_dlg AS es 
ON dl.est_dlg = es.id_est_dlg 
INNER JOIN mq_reg AS reg 
ON dl.id_reg = reg.id_reg 
INNER JOIN mq_usu AS usu 
ON dl.usu_upt = usu.id_usu 
INNER JOIN mq_are AS are 
ON usu.id_are = are.id_are";
$query = $conexion->query($sql);
function res($id, $conexion)
{
    $sqlEst = "SELECT nom_usu FROM mq_usu WHERE usuario = '$id'";
    $queryEst = $conexion->query($sqlEst);
    $rEst = $queryEst->fetch(PDO::FETCH_ASSOC);
    return $rEst['nom_usu'];
}
$anio = date('Y');
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', 'Id')
    ->setCellValue('B1', 'Empresa')
    ->setCellValue('C1', 'Fecha')
    ->setCellValue('D1', 'Dirección')
    ->setCellValue('E1', 'Tipo')
    ->setCellValue('F1', 'Estado')
    ->setCellValue('G1', 'Regional')
    ->setCellValue('H1', 'Responsable')
    ->setCellValue('I1', 'Usuario')
    ->setCellValue('J1', 'Área');
$fila = 2;
while ($r = $query->fetch(PDO::FETCH_ASSOC)) {
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A' . $fila, $r['num_dlg'])
        ->setCellValue('B' . $fila, $r['nom_cli'])
        ->setCellValue('C' . $fila, date("Ymd", strtotime($r['dia_dlg'])))
        ->setCellValue('D' . $fila, $r['dir_dlg'])
        ->setCellValue('E' . $fila, $r['nom_tip_dlg'])
        ->setCellValue('F' . $fila, $r['nom_est_dlg'])
        ->setCellValue('G' . $fila, $r['nom_reg'])
        ->setCellValue('H' . $fila, $res($r['nom_res'], $conexion))
        ->setCellValue('I' . $fila, $r['nom_usu'])
        ->setCellValue('J' . $fila, $r['nom_are']);
    $fila++;
}

$objPHPExcel->getActiveSheet()->setTitle('Historial de Diligencias');
$objPHPExcel->setActiveSheetIndex(0);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
$objWriter->setSheetIndex(0);   // Select which sheet.
$objWriter->setDelimiter(',');  // Define delimiter
$filename = "diligencias.csv";
$objWriter->save($filename);
