<?php
include '../../conexion.php';
require_once '../../excel/lib/PHPExcel/PHPExcel.php';
$objPHPExcel = new PHPExcel();
$sql = "SELECT ing.id_per, 
us.nom_usu, 
DATE(ing.fech_sis) AS fech_sis, 
ing.fech_aus, 
are.nom_are, 
ing.fech_ini, 
ing.fech_fin, 
mot.descrip_per, 
ing.id_estPer, 
ing.doc_perm, 
ing.revi_rec, 
ing.mot_per, 
ing.hor_tot, 
ing.obs_talen, 
mes.nom_mes, 
ing.id_mes, 
ing.obser_perm 
FROM per_ingreso AS ing 
INNER JOIN mq_are AS are
ON ing.id_are = are.id_are 
INNER JOIN mq_usu AS us
ON ing.id_usu = us.id_usu 
INNER JOIN per_estado AS es
ON ing.id_estPer = es.id_estPer 
INNER JOIN per_ingre_x_mov AS mov
ON ing.id_per = mov.id_per
INNER JOIN per_motivo AS mot 
ON ing.mot_per=mot.mot_per
INNER JOIN ind_mes AS mes 
ON ing.id_mes = mes.id_mes
GROUP BY ing.id_per";
$query = $conexion->query($sql);
function mot($id, $conexion)
{
    $sqlMot = "SELECT descrip_per FROM per_motivo WHERE mot_per = $id";
    $queryMot = $conexion->query($sqlMot);
    $rMot = $queryMot->fetch(PDO::FETCH_ASSOC);
    return $rMot['descrip_per'];
}
function est($id, $conexion)
{
    $sqlEst = "SELECT nom_estPer FROM per_estado WHERE id_estPer = $id";
    $queryEst = $conexion->query($sqlEst);
    $rEst = $queryEst->fetch(PDO::FETCH_ASSOC);
    return $rEst['nom_estPer'];
}
function rev($id)
{
    if ($id == 0) {
        return "Sin revisión";
    } else {
        return "Revisado";
    }
}
function day($date)
{
    return date("l", strtotime($date));
}
function hra($inicio, $fin)
{
    $horaInicio = new DateTime($inicio);
    $horaTermino = new DateTime($fin);

    $interval = $horaInicio->diff($horaTermino);
    return $interval->format('%H:%I');
}
$anio = date('Y');
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', 'Id')
    ->setCellValue('B1', 'Usuario Del Permiso')
    ->setCellValue('C1', 'Fecha')
    ->setCellValue('D1', 'Fecha De Ausencia')
    ->setCellValue('E1', 'Área')
    ->setCellValue('F1', 'H.Inicio')
    ->setCellValue('G1', 'H.Final')
    ->setCellValue('H1', 'Motivo')
    ->setCellValue('I1', 'Estado del permiso')
    ->setCellValue('J1', 'Revisado TH')
    ->setCellValue('K1', 'Mes de Indicador')
    ->setCellValue('L1', 'Día de la ausencia')
    ->setCellValue('M1', 'Horas de ausencia');
$fila = 2;
while ($r = $query->fetch(PDO::FETCH_ASSOC)) {
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A' . $fila, $r['id_per'])
        ->setCellValue('B' . $fila, $r['nom_usu'])
        ->setCellValue('C' . $fila, date("Ymd", strtotime($r['fech_sis'])))
        ->setCellValue('D' . $fila, date("Ymd", strtotime($r['fech_aus'])))
        ->setCellValue('E' . $fila, $r['nom_are'])
        ->setCellValue('F' . $fila, date("Hi", strtotime($r['fech_ini'])))
        ->setCellValue('G' . $fila, date("Hi", strtotime($r['fech_fin'])))
        ->setCellValue('H' . $fila, mot($r['mot_per'], $conexion))
        ->setCellValue('I' . $fila, est($r['id_estPer'], $conexion))
        ->setCellValue('J' . $fila, rev($r['revi_rec']))
        ->setCellValue('K' . $fila, $r['nom_mes'])
        ->setCellValue('L' . $fila, day($r['fech_aus']))
        ->setCellValue('M' . $fila, hra($r['fech_ini'], $r['fech_fin']));
    $fila++;
}
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
$objWriter->setSheetIndex(0);   // Select which sheet.
$objWriter->setDelimiter(',');  // Define delimiter
$filename = "permisos.csv";
$objWriter->save($filename);
