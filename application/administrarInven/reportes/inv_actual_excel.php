<?php

require ("../../../conexion.php");
require_once ("../../../resources/utils/phpexcel/vendor/autoload.php");
require 'estilosReporte.php';
include "../../../resources/template/credentials.php";
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d H:i:s");

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


$sqlInvActual = "SELECT inv.*, prod.nom_prod, reg.nom_reg FROM inv_inventario inv 
                 INNER JOIN inv_product prod ON inv.id_prod = prod.id_prod
                 INNER JOIN mq_reg reg ON inv.id_reg = reg.id_reg 
                 WHERE inv.id_reg = ? ;";
$queryInvActual = $conexion -> prepare($sqlInvActual);
$queryInvActual -> execute([$_POST['id_reg']]);

function ult_mov($razon, $id_prod, $conexion){
    $sqlFecMov = "SELECT fec_mov FROM inv_mov_inventario WHERE id_prod = ? AND razon = ? ORDER BY id_mov DESC LIMIT 1;";
    $queryFecMov = $conexion->prepare($sqlFecMov);
    $queryFecMov -> execute([$id_prod, $razon]);
    $rFecMov = $queryFecMov->fetch(PDO::FETCH_ASSOC);
    
    if (is_array($rFecMov)) {
        $fec_mov = (($rFecMov['fec_mov'] != '') ? $rFecMov['fec_mov'] : '----/--/-- --:--:--');
    } else {
        $fec_mov = '----/--/-- --:--:--';
    }
   
    return $fec_mov;
}

$objPHPExcel = new Spreadsheet();
$objPHPExcel -> getProperties()->setCreator('MasterQuimica')->setTitle('Reporte Inventario Actual MQ | Intranet');

$objPHPExcel -> setActiveSheetIndex(0);
$hoja = $objPHPExcel ->getActiveSheet();

$hoja -> getRowDimension('1')->setRowHeight(25);
$hoja -> mergeCells('A1:F1') -> setCellValue('A1', 'Reporte Inventario Actual MQ');

$hoja -> mergeCells('A2:B2') -> setCellValue('A2', 'Generado por:');
$hoja -> setCellValue('C2', $sesion_nom);
$hoja -> setCellValue('D2', 'Fecha y Hora:');
$hoja -> mergeCells('E2:F2') -> setCellValue('E2', $fecha);

$hoja -> getColumnDimension('A')->setWidth(10);
$hoja -> setCellValue('A4', 'Id');
$hoja -> getColumnDimension('B')->setWidth(40);
$hoja -> setCellValue('B4', 'Producto');
$hoja -> getColumnDimension('C')->setWidth(40);
$hoja -> setCellValue('C4', 'Cantidad Disponible');
$hoja -> getColumnDimension('D')->setWidth(24);
$hoja -> setCellValue('D4', 'Última Entrada');
$hoja -> getColumnDimension('E')->setWidth(24);
$hoja -> setCellValue('E4', 'Última Salida');
$hoja -> getColumnDimension('F')->setWidth(12);
$hoja -> setCellValue('F4', 'Bodega');

$fila = 5;
while ($r = $queryInvActual->fetch(PDO::FETCH_ASSOC)) {
    $hoja->setCellValue('A' . $fila, $r['id_prod'])
        ->setCellValue('B' . $fila, $r['nom_prod'])
        ->setCellValue('C' . $fila, $r['cantidad'])
        ->setCellValue('D' . $fila, ult_mov('Ingreso', $r['id_prod'], $conexion))
        ->setCellValue('E' . $fila, ult_mov('Salida', $r['id_prod'], $conexion))
        ->setCellValue('F' . $fila, $r['nom_reg']);
    $fila++;
}

$fila--;
//Estilos
$objPHPExcel->getActiveSheet()->getStyle('A1:F1')->applyFromArray($Arial12);
$objPHPExcel->getActiveSheet()->getStyle('A1:F4')->applyFromArray($alignCenter);
$objPHPExcel->getActiveSheet()->getStyle('A1:F4')->applyFromArray($whiteFont);
$objPHPExcel->getActiveSheet()->getStyle('A2:F2')->applyFromArray($blackFont);
$objPHPExcel->getActiveSheet()->getStyle('A1:F1')->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('A2')->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('D2')->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('A4:F4')->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('A1:F1')->applyFromArray($mq);
$objPHPExcel->getActiveSheet()->getStyle('A4:F4')->applyFromArray($mq);
$objPHPExcel->getActiveSheet()->getStyle('A5:A' . $fila)->applyFromArray($alignCenter);
$objPHPExcel->getActiveSheet()->getStyle('C5:C' . $fila)->applyFromArray($alignCenter);
$objPHPExcel->getActiveSheet()->getStyle('A2:F' . $fila)->applyFromArray($Arial11);
$objPHPExcel->getActiveSheet()->getStyle('A1:F2')->applyFromArray($borderThin);
$objPHPExcel->getActiveSheet()->getStyle('A4:F' . $fila)->applyFromArray($borderThin);
   
header("Content-Type: text/html;charset=utf-8");
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="InventarioActualMQ.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = new Xlsx($objPHPExcel);
$objWriter->save('php://output');
    
exit;