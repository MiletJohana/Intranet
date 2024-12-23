<?php
include '../../conexion.php';
require_once '../../excel/lib/PHPExcel/PHPExcel.php';
$objPHPExcel = new PHPExcel();
$sql = "SELECT coti.id_coti, 
coti.doc_coti, 
DATE(coti.fec_coti) AS fec_coti, 
cli.nom_cli, 
usu.nom_usu, 
coti.ced_ase, 
coti.ced_sac, 
coti.dia_ent, 
coti.for_pag, 
tip.nom_tip_cot, 
coti.cost_cot, 
con.nom_cont, 
coti.val_cot, 
ciu.nom_ciu, 
coti.cns_coti, 
coti.cot_iva, 
coti.sol_cot, 
coti.sol_upd, 
coti.prec_cot, 
coti.prec_upd, 
coti.prc_cot, 
coti.prc_upd, 
coti.env_cot, 
coti.env_upd, 
est.nom_est, 
coti.est_upd, 
coti.com_cot, 
coti.com_upd, 
coti.mot_cot, 
coti.mot_upd, 
coti.llam_cot, 
coti.llam_upd, 
coti.rem_ciu 
FROM cot_cotizaciones AS coti
INNER JOIN mq_clie AS cli
ON coti.id_cli = cli.id_cli
INNER JOIN mq_usu AS usu
ON coti.id_usu = usu.id_usu
INNER JOIN cot_tip_cotizacion AS tip
ON coti.id_tip_cot = tip.id_tip_cot
INNER JOIN cot_contactos AS con
ON coti.id_cont = con.id_cont
INNER JOIN cot_ciudad AS ciu
ON coti.id_ciu = ciu.id_ciu
INNER JOIN cot_estados_cot AS est
ON coti.est_cot = est.id_est
GROUP BY coti.id_coti";
$query = $conexion->query($sql);
function usu($id, $conexion){
    $sql = "SELECT nom_usu FROM mq_usu WHERE id_usu = $id";
    $query = $conexion->query($sql);
    $r = $query->fetch(PDO::FETCH_ASSOC);
    if (is_null($id) && $id == '') {
        return '';
    } else {
        return $r['nom_usu'];
    }
}
function ciu($id, $conexion)
{
    $sql = "SELECT nom_ciu FROM cot_ciudad WHERE id_ciu = $id";
    $query = $conexion->query($sql);
    $r = $query->fetch(PDO::FETCH_ASSOC);
    return $r['nom_ciu'];
}
$anio = date('Y');
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', 'Id')
    ->setCellValue('B1', 'Fecha')
    ->setCellValue('C1', 'Cliente')
    ->setCellValue('D1', 'Usuario')
    ->setCellValue('E1', 'Asesor')
    ->setCellValue('F1', 'Representante SAC')
    ->setCellValue('G1', 'Forma de pago')
    ->setCellValue('H1', 'Tipo de cotización')
    ->setCellValue('I1', 'Costo de la cotización')
    ->setCellValue('J1', 'Validez')
    ->setCellValue('K1', 'Ciudad')
    ->setCellValue('L1', 'Consecutivo')
    ->setCellValue('M1', 'Cotización con IVA')
    ->setCellValue('N1', 'Solicitante')
    ->setCellValue('O1', 'Estado de la cotización')
    ->setCellValue('P1', 'Ciudad remitida');
$fila = 2;
while ($r = $query->fetch(PDO::FETCH_ASSOC)) {
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A' . $fila, $r['id_coti'])
        ->setCellValue('B' . $fila, date("Ymd", strtotime($r['fec_coti'])))
        ->setCellValue('C' . $fila, $r['nom_cli'])
        ->setCellValue('D' . $fila, $r['nom_usu']);
    if (!is_null($r['ced_ase']) && $r['ced_ase'] != '') {
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('E' . $fila, usu($r['ced_ase'], $conexion));
    }
    if (!is_null($r['ced_sac']) && $r['ced_sac'] != '') {
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('F' . $fila, usu($r['ced_sac'], $conexion));
    }
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('G' . $fila, $r['for_pag'])
        ->setCellValue('H' . $fila, $r['nom_tip_cot'])
        ->setCellValue('I' . $fila, $r['cost_cot'])
        ->setCellValue('J' . $fila, $r['val_cot'])
        ->setCellValue('K' . $fila, $r['nom_ciu'])
        ->setCellValue('L' . $fila, $r['cns_coti'])
        ->setCellValue('M' . $fila, $r['cot_iva'])
        ->setCellValue('N' . $fila, $r['sol_cot'])
        ->setCellValue('O' . $fila, $r['nom_est']);
    if (!is_null($r['rem_ciu'])) {
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('P' . $fila, ciu($r['rem_ciu'], $conexion));
    }

    $fila++;
}
$fila = $fila - 1;
//Estilos

$objPHPExcel->getActiveSheet()->setTitle('Historial de Cotizaciones');
$objPHPExcel->setActiveSheetIndex(0);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
$objWriter->setSheetIndex(0);   // Select which sheet.
$objWriter->setDelimiter(',');  // Define delimiter
$filename = "cotizaciones.csv";
$objWriter->save($filename);
