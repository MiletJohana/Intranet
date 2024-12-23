<?php
include '../../conexion.php';
require_once '../../excel/lib/PHPExcel/PHPExcel.php';
$objPHPExcel = new PHPExcel();
$sql = "SELECT com.id_agen, cli.nom_cli, com.dir_cli, us.nom_usu, DATE(com.fec_cre) AS fec_cre, com.obs_agen, est.nom_est, com.lat_ini, com.lon_ini, com.lat_fin, com.lon_fin
FROM agen_com AS com 
INNER JOIN mq_usu AS us
ON com.id_usu = us.id_usu
INNER JOIN mq_clie AS cli
ON com.id_cli = cli.id_cli
INNER JOIN agen_raz AS raz
ON com.id_raz = raz.id_raz
INNER JOIN agen_est AS est
ON est.id_est = com.id_est
ORDER BY com.id_agen";
//Esta consulta trae las visitas que tienen relacionado un cliente, cuando el cliente es null no aparece en la consulta
$query = $conexion->query($sql);
$anio = date('Y');
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', 'Id')
    ->setCellValue('B1', 'Cliente')
    ->setCellValue('C1', 'Dirección')
    ->setCellValue('D1', 'Usuario')
    ->setCellValue('E1', 'Fecha')
    ->setCellValue('F1', 'Estado')
    ->setCellValue('G1', 'Ubicación Inicial')
    ->setCellValue('H1', 'Ubicación Final');
$fila = 2;
while ($r = $query->fetch(PDO::FETCH_ASSOC)) {
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A' . $fila, $r['id_agen'])
        ->setCellValue('B' . $fila, $r['nom_cli'])
        ->setCellValue('C' . $fila, $r['dir_cli'])
        ->setCellValue('D' . $fila, $r['nom_usu'])
        ->setCellValue('E' . $fila, date("Ymd", strtotime($r['fec_cre'])))
        ->setCellValue('F' . $fila, $r['nom_est'])
        ->setCellValue('G' . $fila, $r['lat_ini'] . "," . $r['lon_ini'])
        ->setCellValue('H' . $fila, $r['lat_fin'] . "," . $r['lon_fin']);
    $fila++;
}
$fila = $fila - 1;
//Estilos

$objPHPExcel->getActiveSheet()->setTitle('Historial de Visitas');
$objPHPExcel->setActiveSheetIndex(0);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
$objWriter->setSheetIndex(0);   // Select which sheet.
$objWriter->setDelimiter(',');  // Define delimiter
$filename = "comerciales.csv";
$objWriter->save($filename);
