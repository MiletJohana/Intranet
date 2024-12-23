<?php
require_once '../../../resources/utils/phpexcel/PHPExcel.php';

include '../../../conexion.php';
$objPHPExcel = new PHPExcel();

//include '../../descuentos/functions.php';
//include 'estilosReporte.php';

$anio = date("Y");
$mes = date("m");
$mesM = date("M");

$sqlDescCuo = "SELECT d.*, c.cuot_desc, c.fec_desc 
FROM ind_desc AS d 
INNER JOIN ind_des_cuo AS c 
ON d.id_desc = c.id_desc
WHERE c.fec_desc LIKE '$anio-$mes%' GROUP BY d.id_desc";

$queryDescCuo = $conexion->query($sqlDescCuo);
if ($queryDescCuo->rowCount() > 0) {
    $objPHPExcel->setActiveSheetIndex(0)
        ->mergeCells('A1:M1');
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A1', 'Diligencias mes: ' . $mesM)
        ->setCellValue('A2', '#')
        ->setCellValue('B2', 'Usuario')
        ->setCellValue('C2', 'Cliente')
        ->setCellValue('D2', 'Contacto')
        ->setCellValue('E2', 'Teléfono')
        ->setCellValue('F2', 'Dirección')
        ->setCellValue('G2', 'Horario Cliente')
        ->setCellValue('H2', 'Tipo Diligencia')
        ->setCellValue('I2', 'Día de Diligencia')
        ->setCellValue('J2', 'Descripción Diligencia')
        ->setCellValue('K2', 'Observaciones')
        ->setCellValue('L2', 'Estado')
        ->setCellValue('M2', 'Efectividad');
    $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(25);
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(3);
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(35);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(11);
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(23);
    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(23);
    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(16);
    $fila = 3;
    while ($r = $queryDescCuo->fetch(PDO::FETCH_ASSOC)) {
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A' . $fila, $r['id_desc'])
            ->setCellValue('B' . $fila, usus(($r['id_usus']), $conexion))
            ->setCellValue('C' . $fila, usus(($r['id_usu']), $conexion))
            ->setCellValue('D' . $fila, reg(($r['id_reg']), $conexion))
            ->setCellValue('E' . $fila, tip(($r['id_tip_desc']), $conexion))
            ->setCellValue('F' . $fila, esta(($r['id_estado']), $conexion))
            ->setCellValue('G' . $fila, $r['conc_desc'])
            ->setCellValue('H' . $fila, $r['val_desc'])
            ->setCellValue('I' . $fila, $r['cuo_des'])
            ->setCellValue('J' . $fila, $r['cuot_desc']);
        $fila++;
    }
    $fila = $fila - 1;
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J' . ($fila + 1), "=SUM(J3:J" . $fila . ")");
    //Estilos
    $objPHPExcel->getActiveSheet()->getStyle('A1:J1')->applyFromArray($Arial12);
    $objPHPExcel->getActiveSheet()->getStyle('A1:J2')->applyFromArray($alignCenter);
    $objPHPExcel->getActiveSheet()->getStyle('A1:J2')->applyFromArray($whiteFont);
    $objPHPExcel->getActiveSheet()->getStyle('A1:J2')->applyFromArray($bold);
    $objPHPExcel->getActiveSheet()->getStyle('A1:J2')->applyFromArray($mq);
    $objPHPExcel->getActiveSheet()->getStyle('A2:J' . $fila)->applyFromArray($Arial11);
    $objPHPExcel->getActiveSheet()->getStyle('J' . ($fila + 1))->applyFromArray($Arial11);
    $objPHPExcel->getActiveSheet()->getStyle('A1:J' . $fila)->applyFromArray($borderThin);
    $objPHPExcel->getActiveSheet()->getStyle('J' . ($fila + 1))->applyFromArray($borderThin);
    $objPHPExcel->getActiveSheet()->getStyle('G3:G' . $fila)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);
    $objPHPExcel->getActiveSheet()->getStyle('J3:J' . ($fila + 1))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);

    $objPHPExcel->getActiveSheet()->setTitle('Historial de Descuentos');
    $objPHPExcel->setActiveSheetIndex(0);

    header("Content-Type: text/html;charset=utf-8");
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="HistorialDescuentos.xlsx"');
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('php://output');
} else { ?>
    <script>
        window.alert("No hay ningún descuento APROBADO para ESTE MES, hasta el momento");
        window.location.href='../index.php?table=3';
    </script>
<?php } ?>