<?php

require ("../../../conexion.php");
require_once ("../../../resources/utils/phpexcel/vendor/autoload.php");
require 'estilosReporte.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

$anio = date("Y");
$mes = date("m");
$mesM = date("M"); 

$sql = "SELECT ing.*,us.nom_usu,are.nom_are,mot.descrip_per, mes.nom_mes, us.id_lider 
FROM per_ingreso ing , mq_are are, mq_usu us, per_estado es, per_ingre_x_mov mov ,per_motivo mot , ind_mes mes
        WHERE ing.id_are = are.id_are 
        AND ing.id_usu = us.id_usu 
        AND ing.id_estPer=es.id_estPer 
        AND ing.id_mes=mes.id_mes 
        AND ing.id_per=mov.id_per 
        AND ing.mot_per=mot.mot_per
        AND ing.fech_aus LIKE '" . $_POST['mes'] . "%'";
$sql .= " GROUP BY ing.id_per;";
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
function sop($id)
{
    if ($id == null || $id == "") {
        return "Sin soporte";
    } else {
        return $id;
    }
}


    $objPHPExcel = new Spreadsheet();
    $objPHPExcel -> getProperties()->setCreator('MasterQuimica')->setTitle('Excel Prueba');

    $objPHPExcel -> setActiveSheetIndex(0);
    $hoja = $objPHPExcel ->getActiveSheet();

    $hoja -> getRowDimension('1')->setRowHeight(25);
    $hoja -> mergeCells('A1:N1') -> setCellValue('A1', 'Permisos');
    $hoja -> getColumnDimension('A')->setWidth(9);
    $hoja -> setCellValue('A2', '#');
    $hoja -> getColumnDimension('B')->setWidth(35);
    $hoja -> setCellValue('B2', 'Usuario Del Permiso');
    $hoja -> getColumnDimension('C')->setWidth(20);
    $hoja -> setCellValue('C2', 'Fecha De Ausencia');
    $hoja -> getColumnDimension('D')->setWidth(20);
    $hoja -> setCellValue('D2', 'Área');
    $hoja -> getColumnDimension('E')->setWidth(10);
    $hoja -> setCellValue('E2', 'H.Inicio');
    $hoja -> getColumnDimension('F')->setWidth(10);
    $hoja -> setCellValue('F2', 'H.Final');
    $hoja -> getColumnDimension('G')->setWidth(18);
    $hoja -> setCellValue('G2', 'Motivo');
    $hoja -> getColumnDimension('H')->setWidth(18);
    $hoja -> setCellValue('H2', 'Soporte');
    $hoja -> getColumnDimension('I')->setWidth(20);
    $hoja -> setCellValue('I2', 'Estado');
    $hoja -> getColumnDimension('J')->setWidth(15);
    $hoja -> setCellValue('J2', 'Revisado TH');
    $hoja -> getColumnDimension('K')->setWidth(18);
    $hoja -> setCellValue('K2', 'Horas Ausente');
    $hoja -> getColumnDimension('L')->setWidth(21);
    $hoja -> setCellValue('L2', 'Observación TTHH');
    $hoja -> getColumnDimension('M')->setWidth(30);
    $hoja -> setCellValue('M2', 'Observación de Colaborador');
    $hoja -> getColumnDimension('N')->setWidth(18);
    $hoja -> setCellValue('N2', 'Mes de Indicador');

    $fila = 3;
    while ($r = $query->fetch(PDO::FETCH_ASSOC)) {
        $hoja->setCellValue('A' . $fila, $r['id_per'])
            ->setCellValue('B' . $fila, $r['nom_usu'])
            ->setCellValue('C' . $fila, $r['fech_aus'])
            ->setCellValue('D' . $fila, $r['nom_are'])
            ->setCellValue('E' . $fila, $r['fech_ini'])
            ->setCellValue('F' . $fila, $r['fech_fin'])
            ->setCellValue('G' . $fila, mot($r['mot_per'], $conexion))
            ->setCellValue('H' . $fila, sop($r['doc_perm']))
            ->setCellValue('I' . $fila, est($r['id_estPer'], $conexion))
            ->setCellValue('J' . $fila, rev($r['revi_rec']))
            ->setCellValue('K' . $fila, $r['hor_tot'])
            ->setCellValue('L' . $fila, $r['obs_talen'])
            ->setCellValue('M' . $fila, $r['obser_perm'])
            ->setCellValue('N' . $fila, $r['nom_mes']);
        $fila++;
    }

    $fila--;
    //Estilos
    $objPHPExcel->getActiveSheet()->getStyle('A1:N1')->applyFromArray($Arial12);
    $objPHPExcel->getActiveSheet()->getStyle('A1:N2')->applyFromArray($alignCenter);
    $objPHPExcel->getActiveSheet()->getStyle('A1:N2')->applyFromArray($whiteFont);
    $objPHPExcel->getActiveSheet()->getStyle('A1:N2')->applyFromArray($bold);
    $objPHPExcel->getActiveSheet()->getStyle('A1:N2')->applyFromArray($mq);
    $objPHPExcel->getActiveSheet()->getStyle('A2:N' . $fila)->applyFromArray($Arial11);
    $objPHPExcel->getActiveSheet()->getStyle('A1:N' . $fila)->applyFromArray($borderThin);
   
    /*

    



 
    $objPHPExcel->getActiveSheet()->getStyle('E3:E' . $fila)->getNumberFormat()->setFormatCode(Style_NumberFormat::FORMAT_DATE_TIME6);
    $objPHPExcel->getActiveSheet()->getStyle('F3:F' . $fila)->getNumberFormat()->setFormatCode(Style_NumberFormat::FORMAT_DATE_TIME6);
    $objPHPExcel->getActiveSheet()->getStyle('K3:K' . $fila)->getNumberFormat()->setFormatCode(Style_NumberFormat::FORMAT_DATE_TIME6);
*/

    header("Content-Type: text/html;charset=utf-8");
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="HistorialPermisos.xlsx"');
    header('Cache-Control: max-age=0');
    $objWriter = IOFactory::createWriter($objPHPExcel, 'Xlsx');
    $objWriter->save('php://output');
    

