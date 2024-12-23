<?php
include '../../conexion.php';
require_once '../../excel/lib/PHPExcel/PHPExcel.php';
$objPHPExcel = new PHPExcel();
$sql = "SELECT enr.num_enr, enr.fec_enr, enr.fec_crea, usu.nom_usu, enr.lst_upt, enr.est_enr, enr.cos_enr, reg.nom_reg, COUNT(dlxen.num_dlg) AS num_enrt
FROM mq_enrt AS enr 
INNER JOIN mq_reg AS reg 
ON enr.id_reg = reg.id_reg
INNER JOIN mq_usu AS usu
ON usu.usuario = enr.usu_upt
INNER JOIN mq_dlg_x_enrt AS dlxen
ON enr.num_enr = dlxen.num_enr
GROUP BY enr.num_enr";
$query = $conexion->query($sql);
$anio = date('Y');
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', 'Id')
    ->setCellValue('B1', 'Fecha Enrutamiento')
    ->setCellValue('C1', 'Fecha De Creación')
    ->setCellValue('D1', 'Usuario')
    ->setCellValue('E1', 'Ultima Actualización')
    ->setCellValue('F1', 'Estado')
    ->setCellValue('G1', 'Costos Ad')
    ->setCellValue('H1', 'Regional')
    ->setCellValue('I1', 'Num. Dilg');
$fila = 2;
while ($r = $query->fetch(PDO::FETCH_ASSOC)) {
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A' . $fila, $r['num_enr'])
        ->setCellValue('B' . $fila, date("Ymd", strtotime($r['fec_enr'])))
        ->setCellValue('C' . $fila, date("Ymd", strtotime($r['fec_crea'])))
        ->setCellValue('D' . $fila, $r['nom_usu'])
        ->setCellValue('E' . $fila, date("Ymd", strtotime($r['lst_upt'])))
        ->setCellValue('F' . $fila, $r['est_enr'])
        ->setCellValue('G' . $fila, $r['cos_enr'])
        ->setCellValue('H' . $fila, $r['nom_reg'])
        ->setCellValue('I' . $fila, $r['num_enrt']);
    $fila++;
}
$fila = $fila - 1;
//Estilos

$objPHPExcel->getActiveSheet()->setTitle('Historial de Enrutamientos');
$objPHPExcel->setActiveSheetIndex(0);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
$objWriter->setSheetIndex(0);   // Select which sheet.
$objWriter->setDelimiter(',');  // Define delimiter
$filename = "enrutamientos.csv";
$objWriter->save($filename);
