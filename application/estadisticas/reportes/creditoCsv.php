<?php
include '../../conexion.php';
require_once '../../excel/lib/PHPExcel/PHPExcel.php';
$objPHPExcel = new PHPExcel();
$sql = "SELECT sol.id_sol, 
sol.nom_rep, 
sol.fec_sol, 
sol.act_eco, 
sol.tiem_merc, 
sol.num_emple, 
sol.cupo_sol, 
sol.term_pag, 
sol.dia_pag, 
sol.reg_clie, 
sol.cupoSugA, 
sol.plaSugeA, 
sol.jusPlaCup, 
sol.cup_aut, 
sol.term_auto, 
sol.ob_cupasig, 
sol.retFuen, 
cli.nom_cli, 
est.nom_est, 
sol.segm_clie, 
sol.congen_ase, 
sol.ana_referen, 
sol.doc_consGer, 
sol.doc_rut, 
sol.doc_estFin, 
sol.doc_refCom, 
sol.doc_refcom2, 
sol.doc_refBanc, 
sol.doc_form, 
usu.nom_usu, 
sol.tiem_rad, 
sol.obser_perm, 
sol.num_letra, 
sol.cau_rec, 
sol.fecha_crea, 
sol.ase_com, 
sol.rep_sac
FROM crm_solicitud AS sol
INNER JOIN mq_clie AS cli
ON sol.id_cli = cli.id_cli
INNER JOIN crm_estadosol AS est
ON sol.id_est = est.id_est
INNER JOIN mq_usu AS usu
ON sol.id_usu = usu.id_usu";
$query = $conexion->query($sql);
function usu($id, $conexion)
{
    $sql = "SELECT nom_usu FROM mq_usu WHERE id_usu = $id";
    $query = $conexion->query($sql);
    $r = $query->fetch(PDO::FETCH_ASSOC);
    if ($id == '' || is_null($id)) {
        return '';
    } else {
        return $r['nom_usu'];
    }
}
$anio = date('Y');
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', 'Id')
    ->setCellValue('B1', 'Nombre del representante legal')
    ->setCellValue('C1', 'Fecha De Solicitud')
    ->setCellValue('D1', 'Actividad economica')
    ->setCellValue('E1', 'Tiempo en el mercado')
    ->setCellValue('F1', 'Numero de empleados')
    ->setCellValue('G1', 'Cupo solicitado')
    ->setCellValue('H1', 'Termino de pago solicitado')
    ->setCellValue('I1', 'Dias de pago')
    ->setCellValue('J1', 'Regimen del cliente')
    ->setCellValue('K1', 'Cupo sugerido por ATC')
    ->setCellValue('L1', 'Plazo sugerido por ATC')
    ->setCellValue('M1', 'Justificación del ATC')
    ->setCellValue('N1', 'Cupo de cédito autorizado')
    ->setCellValue('O1', 'Termino de pago autorizado')
    ->setCellValue('P1', 'Observación del cupo asignado')
    ->setCellValue('Q1', 'Retención de fuente')
    ->setCellValue('R1', 'Cliente')
    ->setCellValue('S1', 'Estado')
    ->setCellValue('T1', 'Segmento del cliente')
    ->setCellValue('U1', 'Concepto general del asesor')
    ->setCellValue('V1', 'Análisis de referencias')
    ->setCellValue('W1', 'Documento concepto general')
    ->setCellValue('X1', 'RUT')
    ->setCellValue('Y1', 'Estados Financieros')
    ->setCellValue('Z1', 'Referencia comercial')
    ->setCellValue('AA1', 'Referencia comercial 2')
    ->setCellValue('AB1', 'Referencia bancaria')
    ->setCellValue('AC1', 'Documento formulario de solicitud')
    ->setCellValue('AD1', 'Usuario')
    ->setCellValue('AE1', 'Años o meses en el mercado')
    ->setCellValue('AF1', 'Observación pendiente')
    ->setCellValue('AG1', 'Cupo autorizado en letras')
    ->setCellValue('AH1', 'Tipo de rechazo')
    ->setCellValue('AI1', 'Fecha Sistema')
    ->setCellValue('AJ1', 'Asesor comercial')
    ->setCellValue('AK1', 'Representante SAC');
$fila = 2;
while ($r = $query->fetch(PDO::FETCH_ASSOC)) {
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A' . $fila, $r['id_sol'])
        ->setCellValue('B' . $fila, $r['nom_rep'])
        ->setCellValue('C' . $fila, date("Ymd", strtotime($r['fec_sol'])))
        ->setCellValue('D' . $fila, $r['act_eco'])
        ->setCellValue('E' . $fila, $r['tiem_merc'])
        ->setCellValue('F' . $fila, $r['num_emple'])
        ->setCellValue('G' . $fila, $r['cupo_sol'])
        ->setCellValue('H' . $fila, $r['term_pag'])
        ->setCellValue('I' . $fila, $r['dia_pag'])
        ->setCellValue('J' . $fila, $r['reg_clie'])
        ->setCellValue('K' . $fila, $r['cupoSugA'])
        ->setCellValue('L' . $fila, $r['plaSugeA'])
        ->setCellValue('M' . $fila, $r['jusPlaCup'])
        ->setCellValue('N' . $fila, $r['cup_aut'])
        ->setCellValue('O' . $fila, $r['term_auto'])
        ->setCellValue('P' . $fila, $r['ob_cupasig'])
        ->setCellValue('Q' . $fila, $r['retFuen'])
        ->setCellValue('R' . $fila, $r['nom_cli'])
        ->setCellValue('S' . $fila, $r['nom_est'])
        ->setCellValue('T' . $fila, $r['segm_clie'])
        ->setCellValue('U' . $fila, $r['congen_ase'])
        ->setCellValue('V' . $fila, $r['ana_referen'])
        ->setCellValue('W' . $fila, $r['doc_consGer'])
        ->setCellValue('X' . $fila, $r['doc_rut'])
        ->setCellValue('Y' . $fila, $r['doc_estFin'])
        ->setCellValue('Z' . $fila, $r['doc_refCom'])
        ->setCellValue('AA' . $fila, $r['doc_refcom2'])
        ->setCellValue('AB' . $fila, $r['doc_refBanc'])
        ->setCellValue('AC' . $fila, $r['doc_form'])
        ->setCellValue('AD' . $fila, $r['nom_usu'])
        ->setCellValue('AE' . $fila, $r['tiem_rad'])
        ->setCellValue('AF' . $fila, $r['obser_perm'])
        ->setCellValue('AG' . $fila, $r['num_letra'])
        ->setCellValue('AH' . $fila, $r['cau_rec'])
        ->setCellValue('AI' . $fila, date("Ymd", strtotime($r['fecha_crea'])))
        ->setCellValue('AJ' . $fila, usu($r['ase_com'], $conexion));
    if (!is_null($r['rep_sac'])) {
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('AK' . $fila, usu($r['rep_sac'], $conexion));
    }
    $fila++;
}
$objPHPExcel->getActiveSheet()->setTitle('Historial de Creditos');
$objPHPExcel->setActiveSheetIndex(0);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
$objWriter->setSheetIndex(0);   // Select which sheet.
$objWriter->setDelimiter(',');  // Define delimiter
$filename = "credito.csv";
$objWriter->save($filename);
