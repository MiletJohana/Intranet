<?php
require_once ("../../../resources/utils/phpexcel/vendor/autoload.php");

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

include '../../../conexion.php';
$objPHPExcel = new Spreadsheet();
include '../../descuentos/functions.php';
include 'estilosReporte.php';

// $anio = date("Y");
// $mes = date("m");
// $mesM = date("M");


$sqlDescCuo = "SELECT d.*, c.cuot_desc, c.fec_desc 
FROM ind_desc AS d 
INNER JOIN ind_des_cuo AS c 
ON d.id_desc = c.id_desc
WHERE YEAR(c.fec_desc) = " . $_POST['year'] . "
GROUP BY d.id_desc";

$queryDescCuo = $conexion->query($sqlDescCuo);
if ($queryDescCuo->rowCount() > 0) {
    $objPHPExcel->setActiveSheetIndex(0)
        ->mergeCells('A1:J1');
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A1', 'Cuotas año: ' . $_POST['year'])
        ->setCellValue('A2', '#')
        ->setCellValue('B2', 'Solicitante')
        ->setCellValue('C2', 'Registrado por')
        ->setCellValue('D2', 'Regional')
        ->setCellValue('E2', 'Tipo de Descuento')
        ->setCellValue('F2', 'Estado')
        ->setCellValue('G2', 'Entidad')
        ->setCellValue('H2', 'Valor total')
        ->setCellValue('I2', 'N° Factura')
        ->setCellValue('J2', 'Cant. Cuotas')
        ->setCellValue('K2', 'Cuota mes Act');
    $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(25);
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(8);
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(35);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(11);
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(23);
    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(23);
    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(16);
    $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(16);
    $fila = 3;
    while ($r = $queryDescCuo-> fetch(PDO::FETCH_ASSOC)) {
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A' . $fila, $r['id_desc'])
            ->setCellValue('B' . $fila, usus(($r['id_usus']), $conexion))
            ->setCellValue('C' . $fila, usus(($r['id_usu']), $conexion))
            ->setCellValue('D' . $fila, reg(($r['id_reg']), $conexion))
            ->setCellValue('E' . $fila, tip(($r['id_tip_desc']), $conexion))
            ->setCellValue('F' . $fila, esta(($r['id_estado']), $conexion))
            ->setCellValue('G' . $fila, $r['conc_desc'])
            ->setCellValue('H' . $fila, $r['val_desc'])
            ->setCellValue('I' . $fila, $r['fact_desc'])
            ->setCellValue('J' . $fila, $r['cuo_des'])
            ->setCellValue('K' . $fila, $r['cuot_desc']);
        $fila++;
    }
    $fila = $fila - 1;
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K' . ($fila + 1), "=SUM(K3:K" . $fila . ")");
    //Estilos
    $objPHPExcel->getActiveSheet()->getStyle('A1:K1')->applyFromArray($Arial12);
    $objPHPExcel->getActiveSheet()->getStyle('A1:K2')->applyFromArray($alignCenter);
    $objPHPExcel->getActiveSheet()->getStyle('A1:K2')->applyFromArray($whiteFont);
    $objPHPExcel->getActiveSheet()->getStyle('A1:K2')->applyFromArray($bold);
    $objPHPExcel->getActiveSheet()->getStyle('A1:K2')->applyFromArray($mq);
    $objPHPExcel->getActiveSheet()->getStyle('A2:K' . $fila)->applyFromArray($Arial11);
    $objPHPExcel->getActiveSheet()->getStyle('K' . ($fila + 1))->applyFromArray($Arial11);
    $objPHPExcel->getActiveSheet()->getStyle('A1:K' . $fila)->applyFromArray($borderThin);
    $objPHPExcel->getActiveSheet()->getStyle('K' . ($fila + 1))->applyFromArray($borderThin);
    $objPHPExcel->getActiveSheet()->getStyle('H3:H' . $fila)->getNumberFormat()->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);
    $objPHPExcel->getActiveSheet()->getStyle('K3:K' . ($fila + 1))->getNumberFormat()->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);

    $objPHPExcel->getActiveSheet()->setTitle('Historial de Descuentos');
    $objPHPExcel->setActiveSheetIndex(0);

    header("Content-Type: text/html;charset=utf-8");
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="HistorialDescuentosAño'.$_POST['year'].'.xlsx"');
    header('Cache-Control: max-age=0');
    $objWriter = IOFactory::createWriter($objPHPExcel, 'Xlsx');
    $objWriter->save('php://output');
    
} else { ?>
    <script>
        window.alert("No hay ningún descuento APROBADO para ESTE MES, hasta el momento");
        window.location.href='../index.php?table=3';
    </script>
<?php } ?>