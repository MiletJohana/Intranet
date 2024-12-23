<?php

require ("../../../conexion.php");
require_once ("../../../resources/utils/phpexcel/vendor/autoload.php");
require 'estilosReporte.php';
include "../../../resources/template/credentials.php";
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d H:i:s");

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


$where = [];

if($_POST['mov_razon'] != 'Todos'){;
    $where[] = 'razon = "'.$_POST['mov_razon'].'"';
}

if($_POST['fecha1'] != '' && $_POST['fecha2'] != ''){
    $where[] = 'fec_mov BETWEEN "'.$_POST['fecha1'].'" AND "'.$_POST['fecha2'].'"';
}

$sqlMovInv = "SELECT * FROM inv_mov_inventario_view WHERE ".join('AND ', $where).";";
$queryMovInv = $conexion -> prepare($sqlMovInv);
$queryMovInv -> execute([]);

function cant_disponible($cant_anterior, $cant_ajuste, $razon){
    switch ($razon) {
        case 'Ingreso':
            $cantidad = "+";
            $cantidad .= $cant_anterior + $cant_ajuste;
            break;
        
        case 'Salida':
            $cantidad = "-";
            $cantidad .= $cant_anterior - $cant_ajuste;
            break;
    }
 
    return $cantidad;
}

$objPHPExcel = new Spreadsheet();
$objPHPExcel -> getProperties()->setCreator('MasterQuimica')->setTitle('Reporte Movimientos Inventario MQ | Intranet');

$objPHPExcel -> setActiveSheetIndex(0);
$hoja = $objPHPExcel ->getActiveSheet();

$hoja -> getRowDimension('1')->setRowHeight(25);
$hoja -> mergeCells('A1:H1') -> setCellValue('A1', 'Reporte Movimientos Inventario MQ');
$hoja -> getColumnDimension('A')->setWidth(22);
$hoja -> mergeCells('A4:A5') -> setCellValue('A4', 'Fecha y Hora');
$hoja -> getColumnDimension('B')->setWidth(40);
$hoja -> mergeCells('B4:B5') -> setCellValue('B4', 'Producto');
$hoja -> getColumnDimension('C')->setWidth(10);
$hoja -> mergeCells('C4:C5') -> setCellValue('C4', 'Razón');
$hoja -> getColumnDimension('D')->setWidth(40);
$hoja -> mergeCells('D4:D5') -> setCellValue('D4', 'Detalles');
$hoja -> mergeCells('E4:G4') -> setCellValue('E4', 'Unidades');
$hoja -> getColumnDimension('E')->setWidth(12);
$hoja -> setCellValue('E5', 'Anterior');
$hoja -> getColumnDimension('F')->setWidth(12);
$hoja -> setCellValue('F5', 'Ajuste');
$hoja -> getColumnDimension('G')->setWidth(14);
$hoja -> setCellValue('G5', 'Disponible');
$hoja -> getColumnDimension('H')->setWidth(50);
$hoja -> mergeCells('H4:H5') -> setCellValue('H4', 'Realizo por');
$hoja -> setCellValue('A2', 'Generado por:');
$hoja -> mergeCells('B2:E2') -> setCellValue('B2', $sesion_nom);
$hoja -> mergeCells('F2:G2') -> setCellValue('F2', 'Fecha y Hora:');
$hoja -> setCellValue('H2', $fecha);

$fila = 6;
while ($r = $queryMovInv->fetch(PDO::FETCH_ASSOC)) {
    $hoja->setCellValue('A' . $fila, $r['fec_mov'])
        ->setCellValue('B' . $fila, $r['nom_prod'])
        ->setCellValue('C' . $fila, $r['razon'])
        ->setCellValue('D' . $fila, (($r['razon_det'] != '') ? $r['razon_det'] : "Ninguno"))
        ->setCellValue('E' . $fila, $r['cant_ant'])
        ->setCellValue('F' . $fila, cant_disponible($r['cant_ant'], $r['new_cant'], $r['razon']))
        ->setCellValue('G' . $fila, $r['new_cant'])
        ->setCellValue('H' . $fila, $r['nom_usu']);
    $fila++;
}

$fila--;
//Estilos
$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->applyFromArray($Arial12);
$objPHPExcel->getActiveSheet()->getStyle('A1:H5')->applyFromArray($alignCenter);
$objPHPExcel->getActiveSheet()->getStyle('A1:H5')->applyFromArray($whiteFont);
$objPHPExcel->getActiveSheet()->getStyle('A2:H2')->applyFromArray($blackFont);
$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('A2')->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('F2')->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('A4:H5')->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->applyFromArray($mq);
$objPHPExcel->getActiveSheet()->getStyle('A4:H5')->applyFromArray($mq);
$objPHPExcel->getActiveSheet()->getStyle('E5:G5')->applyFromArray($subindice);
$objPHPExcel->getActiveSheet()->getStyle('A2:H' . $fila)->applyFromArray($Arial11);
$objPHPExcel->getActiveSheet()->getStyle('A1:H2')->applyFromArray($borderThin);
$objPHPExcel->getActiveSheet()->getStyle('A4:H' . $fila)->applyFromArray($borderThin);
$objPHPExcel->getActiveSheet()->getStyle('E6:G' . $fila)->applyFromArray($alignCenter);
   
header("Content-Type: text/html;charset=utf-8");
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="MovimientosInventarioMQ.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = new Xlsx($objPHPExcel);
$objWriter->save('php://output');
    
exit;