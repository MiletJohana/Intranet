<?php
//include database configuration file
include '../../../conexion.php';

//get records from database
//
//
include 'consultas.php';
//
//

if ($query->rowCount() > 0) {

    date_default_timezone_set('America/Bogota');

    if (PHP_SAPI == 'cli')
        die('Este archivo solo se puede ver desde un navegador web');

    /** Se agrega la libreria PHPExcel */
    require_once '../../../resources/utils/phpexcel/PHPExcel.php';

    // Se crea el objeto PHPExcel
    $objPHPExcel = new PHPExcel();

    // Se asignan las propiedades del libro
    $objPHPExcel->getProperties()->setCreator("Codedrinks") //Autor
        ->setLastModifiedBy("Codedrinks") //Ultimo usuario que lo modificó
        ->setTitle("Reporte Excel con PHP y MySQL")
        ->setSubject("Reporte Excel con PHP y MySQL")
        ->setDescription("Reporte de diligencias")
        ->setKeywords("reporte diligencias")
        ->setCategory("Reporte excel");

    //Estilos--------------------------------------------
    include 'estilosControl.php';
    //---------------------------------------------------
    $fech = $anio . '-' . $month . '-' . date("d");
    setlocale(LC_ALL, 'es_ES', 'Spanish_Spain', 'Spanish');
    $StrMonth = ucwords(strftime("%b", strtotime($anio . '-' . $month)));
    $StrMes2 = ucwords(strftime("%b", strtotime($anio . '-' . $mes2)));
    $StringMes = ucwords(strftime("%B", strtotime($fech)));
    $tituloReporte1 = "RESUMEN CONTROL DE COTIZACIONES  ENERO A DICIEMBRE DE " . $anio;
    $tituloReporte2 = "MASTER QUIMICA";
    $tituloMesActual = "Mes " . $StrMonth . ' - ' . $StrMes2;

    $objPHPExcel->setActiveSheetIndex(0)
        ->mergeCells('A1:B1');
    $objPHPExcel->setActiveSheetIndex(0)
        ->mergeCells('F1:I1');
    $objPHPExcel->setActiveSheetIndex(0)
        ->mergeCells('T2:U2');
    //Tamaño de la fila
    $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(40);

    // Se agregan los titulos del reporte
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A1',  $tituloReporte1)
        ->setCellValue('F1',  $tituloReporte2)
        ->setCellValue('T2',  $tituloMesActual);

    $objPHPExcel->getActiveSheet()->getStyle('T2:U2')->applyFromArray($estColorYellow);
    $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(27);
    $objPHPExcel->getActiveSheet()->getStyle('T2:U2')
        ->getAlignment()->setWrapText(true);


    $objPHPExcel->getActiveSheet()->getStyle('A1:I1')->applyFromArray($estiloTituloReporte);
    //------------------------------------------
    //Sub Titulos fila 2
    $titulosColumnas1 = array('ENE', 'FEB', 'MAR', 'TOTAL 1Q', 'ABR', 'MAY', 'JUN', 'TOTAL 2Q', 'JUL', 'AGO', 'SEP', 'TOTAL 3Q', 'OCT', 'NOV', 'DIC', 'TOTAL 4Q', 'TOTAL ANUAL', 'PROMD Mensual');

    $objPHPExcel->setActiveSheetIndex(0)
        ->mergeCells('A3:B3');
    $objPHPExcel->setActiveSheetIndex(0)
        ->mergeCells('T3:U3');
    //Estilos para color textos
    // Se agregan filas 2
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('C3',  $titulosColumnas1[0])
        ->setCellValue('D3',  $titulosColumnas1[1])
        ->setCellValue('E3',  $titulosColumnas1[2])
        ->setCellValue('F3',  $titulosColumnas1[3])
        ->setCellValue('G3',  $titulosColumnas1[4])
        ->setCellValue('H3',  $titulosColumnas1[5])
        ->setCellValue('I3',  $titulosColumnas1[6])
        ->setCellValue('J3',  $titulosColumnas1[7])
        ->setCellValue('K3',  $titulosColumnas1[8])
        ->setCellValue('L3',  $titulosColumnas1[9])
        ->setCellValue('M3',  $titulosColumnas1[10])
        ->setCellValue('N3',  $titulosColumnas1[11])
        ->setCellValue('O3',  $titulosColumnas1[12])
        ->setCellValue('P3',  $titulosColumnas1[13])
        ->setCellValue('Q3',  $titulosColumnas1[14])
        ->setCellValue('R3',  $titulosColumnas1[15])
        ->setCellValue('S3',  $titulosColumnas1[16])
        ->setCellValue('T3',  $titulosColumnas1[17]);

    $objPHPExcel->getActiveSheet()->getStyle('A3:U3')->applyFromArray($estiloTituloColumnas);




    //------------------------------------------
    //Sub Titulos fila 3
    $titulosColumnas2 = array('ESTADO DE LA COTIZACIÓN', 'APROBADO', 'PENDIENTE', 'PERDIDO', 'ACTUALIZACION DE PRECIOS', 'EMAIL', 'TELÉFONO', 'COTIZACIONES DEFINIDAS', 'SAC', 'VENTAS', ' TL COTIZACIONES', 'EFICIENCIA EN COTIZACIONES', 'CUMPLIMIENTO DE ENTREGAS', 'COTIZACIONES ENVIADAS EN 1 DÍA HÁBIL', 'TOTAL DE LLAMADAS DE SEGUIMIENTO');

    $objPHPExcel->setActiveSheetIndex(0)
        ->mergeCells('A4:A7');
    $objPHPExcel->setActiveSheetIndex(0)
        ->mergeCells('A8:A9');
    $objPHPExcel->setActiveSheetIndex(0)
        ->mergeCells('A11:B11');
    $objPHPExcel->setActiveSheetIndex(0)
        ->mergeCells('A12:B12');
    $objPHPExcel->setActiveSheetIndex(0)
        ->mergeCells('A13:B13');
    $objPHPExcel->setActiveSheetIndex(0)
        ->mergeCells('A15:B15');
    // Se agregan filas 3
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A4',  $titulosColumnas2[0])
        ->setCellValue('B4',  $titulosColumnas2[1])
        ->setCellValue('B5',  $titulosColumnas2[2])
        ->setCellValue('B6',  $titulosColumnas2[4])
        ->setCellValue('B7',  $titulosColumnas2[3])
        ->setCellValue('B8',  $titulosColumnas2[5])
        ->setCellValue('B9',  $titulosColumnas2[6])
        ->setCellValue('A10', $titulosColumnas2[7])
        ->setCellValue('B10', '$' . $titulosColumnas2[9])
        ->setCellValue('A11', $titulosColumnas2[10])
        ->setCellValue('A12', '$' . $titulosColumnas2[10])
        ->setCellValue('A13', $titulosColumnas2[11])
        ->setCellValue('A14', $titulosColumnas2[12])
        ->setCellValue('B14', $titulosColumnas2[13])
        ->setCellValue('A15', $titulosColumnas2[14]);




    $objPHPExcel->getActiveSheet()->getStyle('B4:B4')->applyFromArray($estColorGreen);
    $objPHPExcel->getActiveSheet()->getStyle('B5:B5')->applyFromArray($estColorYellow);
    $objPHPExcel->getActiveSheet()->getStyle('B6:B6')->applyFromArray($estColorBlue);
    $objPHPExcel->getActiveSheet()->getStyle('B7:B7')->applyFromArray($estColorRed);
    $objPHPExcel->getActiveSheet()->getStyle('A4:A7')->applyFromArray($estColorNin);
    $objPHPExcel->getActiveSheet()->getStyle('A4:A7')
        ->getAlignment()->setWrapText(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getStyle('A8:B12')->applyFromArray($estColorNin);
    $objPHPExcel->getActiveSheet()->getStyle('A13:B13')->applyFromArray($estColorLetRoja);
    $objPHPExcel->getActiveSheet()->getStyle('A14:B14')->applyFromArray($estColorWhite);
    $objPHPExcel->getActiveSheet()->getStyle('A14:B14')
        ->getAlignment()->setWrapText(true);
    $objPHPExcel->getActiveSheet()->getStyle('A15:B15')->applyFromArray($estColorWhite);


    foreach (range('B4', 'B7') as $columnID) {
        $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
            ->setAutoSize(true);
    }

    //Aqui empieza a introducir datos
    $totalAnio = 0;
    for ($i = 1; $i <= 12; $i++) {
        $totalAnio += cotXMes($conexion, $id, $i, $anio);
    }
    // Estado 2 Aporbado
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('C4',  estXMes($conexion, $id, 1, 2, $anio))
        ->setCellValue('D4',  estXMes($conexion, $id, 2, 2, $anio))
        ->setCellValue('E4',  estXMes($conexion, $id, 3, 2, $anio))
        ->setCellValue('F4',  estXMes($conexion, $id, 1, 2, $anio) + estXMes($conexion, $id, 2, 2, $anio) + estXMes($conexion, $id, 3, 2, $anio))
        ->setCellValue('G4',  estXMes($conexion, $id, 4, 2, $anio))
        ->setCellValue('H4',  estXMes($conexion, $id, 5, 2, $anio))
        ->setCellValue('I4',  estXMes($conexion, $id, 6, 2, $anio))
        ->setCellValue('J4',  estXMes($conexion, $id, 4, 2, $anio) + estXMes($conexion, $id, 5, 2, $anio) + estXMes($conexion, $id, 6, 2, $anio))
        ->setCellValue('K4',  estXMes($conexion, $id, 7, 2, $anio))
        ->setCellValue('L4',  estXMes($conexion, $id, 8, 2, $anio))
        ->setCellValue('M4',  estXMes($conexion, $id, 9, 2, $anio))
        ->setCellValue('N4',  estXMes($conexion, $id, 7, 2, $anio) + estXMes($conexion, $id, 8, 2, $anio) + estXMes($conexion, $id, 9, 2, $anio))
        ->setCellValue('O4',  estXMes($conexion, $id, 10, 2, $anio))
        ->setCellValue('P4',  estXMes($conexion, $id, 11, 2, $anio))
        ->setCellValue('Q4',  estXMes($conexion, $id, 12, 2, $anio))
        ->setCellValue('R4',  estXMes($conexion, $id, 10, 2, $anio) + estXMes($conexion, $id, 11, 2, $anio) + estXMes($conexion, $id, 12, 2, $anio));

    $total = 0;
    for ($i = 1; $i <= 12; $i++) {
        $total += estXMes($conexion, $id, $i, 2, $anio);
    }
    $totalc = 0;
    $total2 = 0;
    if ($month != $mes2) {
        $total2 = $total / $mes2;
        $totalc = round($total2);
    } else {
        $totalc = round($total / ($mes2 - ($month - 1)));
    }

    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('S4', $total)
        ->setCellValue('T4', $totalc)
        ->setCellValue('U4', number_format(porcentaje($totalc, $totalAnio)) . "%");
    // Estado 1 Pendiente
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('C5',  estXMes($conexion, $id, 1, 1, $anio))
        ->setCellValue('D5',  estXMes($conexion, $id, 1, 1, $anio))
        ->setCellValue('E5',  estXMes($conexion, $id, 3, 1, $anio))
        ->setCellValue('F5',  estXMes($conexion, $id, 1, 1, $anio) + estXMes($conexion, $id, 1, 1, $anio) + estXMes($conexion, $id, 3, 1, $anio))
        ->setCellValue('G5',  estXMes($conexion, $id, 4, 1, $anio))
        ->setCellValue('H5',  estXMes($conexion, $id, 5, 1, $anio))
        ->setCellValue('I5',  estXMes($conexion, $id, 6, 1, $anio))
        ->setCellValue('J5',  estXMes($conexion, $id, 4, 1, $anio) + estXMes($conexion, $id, 5, 1, $anio) + estXMes($conexion, $id, 6, 1, $anio))
        ->setCellValue('K5',  estXMes($conexion, $id, 7, 1, $anio))
        ->setCellValue('L5',  estXMes($conexion, $id, 8, 1, $anio))
        ->setCellValue('M5',  estXMes($conexion, $id, 9, 1, $anio))
        ->setCellValue('N5',  estXMes($conexion, $id, 7, 1, $anio) + estXMes($conexion, $id, 8, 1, $anio) + estXMes($conexion, $id, 9, 1, $anio))
        ->setCellValue('O5',  estXMes($conexion, $id, 10, 1, $anio))
        ->setCellValue('P5',  estXMes($conexion, $id, 11, 1, $anio))
        ->setCellValue('Q5',  estXMes($conexion, $id, 12, 1, $anio))
        ->setCellValue('R5',  estXMes($conexion, $id, 10, 1, $anio) + estXMes($conexion, $id, 11, 1, $anio) + estXMes($conexion, $id, 12, 1, $anio));

    $total = 0;
    for ($i = 1; $i <= 12; $i++) {
        $total += estXMes($conexion, $id, $i, 1, $anio);
    }
    $totalc = 0;
    $total2 = 0;
    if ($month != $mes2) {
        $total2 = $total / $mes2;
        $totalc = round($total2);
    } else {
        $totalc = round($total / ($mes2 - ($month - 1)));
    }

    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('S5', $total)
        ->setCellValue('T5', $totalc)
        ->setCellValue('U5', number_format(porcentaje($totalc, $totalAnio)) . "%");

    // Estado 4 Actualización de precios
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('C6',  estXMes($conexion, $id, 1, 4, $anio))
        ->setCellValue('D6',  estXMes($conexion, $id, 2, 4, $anio))
        ->setCellValue('E6',  estXMes($conexion, $id, 3, 4, $anio))
        ->setCellValue('F6',  estXMes($conexion, $id, 1, 4, $anio) + estXMes($conexion, $id, 2, 4, $anio) + estXMes($conexion, $id, 3, 4, $anio))
        ->setCellValue('G6',  estXMes($conexion, $id, 4, 4, $anio))
        ->setCellValue('H6',  estXMes($conexion, $id, 5, 4, $anio))
        ->setCellValue('I6',  estXMes($conexion, $id, 6, 4, $anio))
        ->setCellValue('J6',  estXMes($conexion, $id, 4, 4, $anio) + estXMes($conexion, $id, 5, 4, $anio) + estXMes($conexion, $id, 6, 4, $anio))
        ->setCellValue('K6',  estXMes($conexion, $id, 7, 4, $anio))
        ->setCellValue('L6',  estXMes($conexion, $id, 8, 4, $anio))
        ->setCellValue('M6',  estXMes($conexion, $id, 9, 4, $anio))
        ->setCellValue('N6',  estXMes($conexion, $id, 7, 4, $anio) + estXMes($conexion, $id, 8, 4, $anio) + estXMes($conexion, $id, 9, 4, $anio))
        ->setCellValue('O6',  estXMes($conexion, $id, 10, 4, $anio))
        ->setCellValue('P6',  estXMes($conexion, $id, 11, 4, $anio))
        ->setCellValue('Q6',  estXMes($conexion, $id, 12, 4, $anio))
        ->setCellValue('R6',  estXMes($conexion, $id, 10, 4, $anio) + estXMes($conexion, $id, 11, 4, $anio) + estXMes($conexion, $id, 12, 4, $anio));

    $total = 0;
    for ($i = 1; $i <= 12; $i++) {
        $total += estXMes($conexion, $id, $i, 4, $anio);
    }
    $totalc = 0;
    $total2 = 0;
    if ($month != $mes2) {
        $total2 = $total / $mes2;
        $totalc = round($total2);
    } else {
        $totalc = round($total / ($mes2 - ($month - 1)));
    }

    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('S6', $total)
        ->setCellValue('T6', $totalc)
        ->setCellValue('U6', number_format(porcentaje($totalc, $totalAnio)) . "%");

    // Estado 3 Actualización de precios
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('C7',  estXMes($conexion, $id, 1, 3, $anio))
        ->setCellValue('D7',  estXMes($conexion, $id, 2, 3, $anio))
        ->setCellValue('E7',  estXMes($conexion, $id, 3, 3, $anio))
        ->setCellValue('F7',  estXMes($conexion, $id, 1, 3, $anio) + estXMes($conexion, $id, 2, 3, $anio) + estXMes($conexion, $id, 3, 3, $anio))
        ->setCellValue('G7',  estXMes($conexion, $id, 4, 3, $anio))
        ->setCellValue('H7',  estXMes($conexion, $id, 5, 3, $anio))
        ->setCellValue('I7',  estXMes($conexion, $id, 6, 3, $anio))
        ->setCellValue('J7',  estXMes($conexion, $id, 4, 3, $anio) + estXMes($conexion, $id, 5, 3, $anio) + estXMes($conexion, $id, 6, 3, $anio))
        ->setCellValue('K7',  estXMes($conexion, $id, 7, 3, $anio))
        ->setCellValue('L7',  estXMes($conexion, $id, 8, 3, $anio))
        ->setCellValue('M7',  estXMes($conexion, $id, 9, 3, $anio))
        ->setCellValue('N7',  estXMes($conexion, $id, 7, 3, $anio) + estXMes($conexion, $id, 8, 3, $anio) + estXMes($conexion, $id, 9, 3, $anio))
        ->setCellValue('O7',  estXMes($conexion, $id, 10, 3, $anio))
        ->setCellValue('P7',  estXMes($conexion, $id, 11, 3, $anio))
        ->setCellValue('Q7',  estXMes($conexion, $id, 12, 3, $anio))
        ->setCellValue('R7',  estXMes($conexion, $id, 10, 3, $anio) + estXMes($conexion, $id, 11, 3, $anio) + estXMes($conexion, $id, 12, 3, $anio));

    $total = 0;
    for ($i = 1; $i <= 12; $i++) {
        $total += estXMes($conexion, $id, $i, 3, $anio);
    }
    $totalc = 0;
    $total2 = 0;
    if ($month != $mes2) {
        $total2 = $total / $mes2;
        $totalc = round($total2);
    } else {
        $totalc = round($total / ($mes2 - ($month - 1)));
    }

    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('S7', $total)
        ->setCellValue('T7', $totalc)
        ->setCellValue('U7', number_format(porcentaje($totalc, $totalAnio)) . "%");

    // E-MAIL
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('C8',  solXMes($conexion, $id, 1, 2, $anio))
        ->setCellValue('D8',  solXMes($conexion, $id, 2, 2, $anio))
        ->setCellValue('E8',  solXMes($conexion, $id, 3, 2, $anio))
        ->setCellValue('F8',  solXMes($conexion, $id, 1, 2, $anio) + solXMes($conexion, $id, 2, 2, $anio) + solXMes($conexion, $id, 3, 2, $anio))
        ->setCellValue('G8',  solXMes($conexion, $id, 4, 2, $anio))
        ->setCellValue('H8',  solXMes($conexion, $id, 5, 2, $anio))
        ->setCellValue('I8',  solXMes($conexion, $id, 6, 2, $anio))
        ->setCellValue('J8',  solXMes($conexion, $id, 4, 2, $anio) + solXMes($conexion, $id, 5, 2, $anio) + solXMes($conexion, $id, 6, 2, $anio))
        ->setCellValue('K8',  solXMes($conexion, $id, 7, 2, $anio))
        ->setCellValue('L8',  solXMes($conexion, $id, 8, 2, $anio))
        ->setCellValue('M8',  solXMes($conexion, $id, 9, 2, $anio))
        ->setCellValue('N8',  solXMes($conexion, $id, 7, 2, $anio) + solXMes($conexion, $id, 8, 2, $anio) + solXMes($conexion, $id, 9, 2, $anio))
        ->setCellValue('O8',  solXMes($conexion, $id, 10, 2, $anio))
        ->setCellValue('P8',  solXMes($conexion, $id, 11, 2, $anio))
        ->setCellValue('Q8',  solXMes($conexion, $id, 12, 2, $anio))
        ->setCellValue('R8',  solXMes($conexion, $id, 10, 2, $anio) + solXMes($conexion, $id, 11, 2, $anio) + solXMes($conexion, $id, 12, 2, $anio));
    $total = 0;
    for ($i = 1; $i <= 12; $i++) {
        $total += solXMes($conexion, $id, $i, 2, $anio);
    }
    $totalc = 0;
    $total2 = 0;
    if ($month != $mes2) {
        $total2 = $total / $mes2;
        $totalc = round($total2);
    } else {
        $totalc = round($total / ($mes2 - ($month - 1)));
    }

    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('S8', $total)
        ->setCellValue('T8', $totalc)
        ->setCellValue('U8', number_format(porcentaje($totalc, $totalAnio)) . "%");
    // Teléfono
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('C9',  solXMes($conexion, $id, 1, 1, $anio))
        ->setCellValue('D9',  solXMes($conexion, $id, 2, 1, $anio))
        ->setCellValue('E9',  solXMes($conexion, $id, 3, 1, $anio))
        ->setCellValue('F9',  solXMes($conexion, $id, 1, 1, $anio) + solXMes($conexion, $id, 2, 1, $anio) + solXMes($conexion, $id, 3, 1, $anio))
        ->setCellValue('G9',  solXMes($conexion, $id, 4, 1, $anio))
        ->setCellValue('H9',  solXMes($conexion, $id, 5, 1, $anio))
        ->setCellValue('I9',  solXMes($conexion, $id, 6, 1, $anio))
        ->setCellValue('J9',  solXMes($conexion, $id, 4, 1, $anio) + solXMes($conexion, $id, 5, 1, $anio) + solXMes($conexion, $id, 6, 1, $anio))
        ->setCellValue('K9',  solXMes($conexion, $id, 7, 1, $anio))
        ->setCellValue('L9',  solXMes($conexion, $id, 8, 1, $anio))
        ->setCellValue('M9',  solXMes($conexion, $id, 9, 1, $anio))
        ->setCellValue('N9',  solXMes($conexion, $id, 7, 1, $anio) + solXMes($conexion, $id, 8, 1, $anio) + solXMes($conexion, $id, 9, 1, $anio))
        ->setCellValue('O9',  solXMes($conexion, $id, 10, 1, $anio))
        ->setCellValue('P9',  solXMes($conexion, $id, 11, 1, $anio))
        ->setCellValue('Q9',  solXMes($conexion, $id, 12, 1, $anio))
        ->setCellValue('R9',  solXMes($conexion, $id, 10, 1, $anio) + solXMes($conexion, $id, 11, 1, $anio) + solXMes($conexion, $id, 12, 1, $anio));

    $total = 0;
    for ($i = 1; $i <= 12; $i++) {
        $total += solXMes($conexion, $id, $i, 1, $anio);
    }
    $totalc = 0;
    $total2 = 0;
    if ($month != $mes2) {
        $total2 = $total / $mes2;
        $totalc = round($total2);
    } else {
        $totalc = round($total / ($mes2 - ($month - 1)));
    }

    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('S9', $total)
        ->setCellValue('T9', $totalc)
        ->setCellValue('U9', number_format(porcentaje($totalc, $totalAnio)) . "%");

    // COTIZACIONES DEFINIDAS - $VENTAS
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('C10',  "$" . number_format(totalApr($conexion, $id, 1, $anio), 0, '.', ','))
        ->setCellValue('D10',  "$" . number_format(totalApr($conexion, $id, 2, $anio), 0, '.', ','))
        ->setCellValue('E10',  "$" . number_format(totalApr($conexion, $id, 3, $anio), 0, '.', ','))
        ->setCellValue('F10',  "$" . number_format((totalApr($conexion, $id, 1, $anio) + totalApr($conexion, $id, 2, $anio) + totalApr($conexion, $id, 3, $anio)), 0, '.', ','))
        ->setCellValue('G10',  "$" . number_format(totalApr($conexion, $id, 4, $anio), 0, '.', ','))
        ->setCellValue('H10',  "$" . number_format(totalApr($conexion, $id, 5, $anio), 0, '.', ','))
        ->setCellValue('I10',  "$" . number_format(totalApr($conexion, $id, 6, $anio), 0, '.', ','))
        ->setCellValue('J10',  "$" . number_format((totalApr($conexion, $id, 4, $anio) + totalApr($conexion, $id, 5, $anio) + totalApr($conexion, $id, 6, $anio)), 0, '.', ','))
        ->setCellValue('K10',  "$" . number_format(totalApr($conexion, $id, 7, $anio), 0, '.', ','))
        ->setCellValue('L10',  "$" . number_format(totalApr($conexion, $id, 8, $anio), 0, '.', ','))
        ->setCellValue('M10',  "$" . number_format(totalApr($conexion, $id, 9, $anio), 0, '.', ','))
        ->setCellValue('N10',  "$" . number_format((totalApr($conexion, $id, 7, $anio) + totalApr($conexion, $id, 8, $anio) + totalApr($conexion, $id, 9, $anio)), 0, '.', ','))
        ->setCellValue('O10',  "$" . number_format(totalApr($conexion, $id, 10, $anio), 0, '.', ','))
        ->setCellValue('P10',  "$" . number_format(totalApr($conexion, $id, 11, $anio), 0, '.', ','))
        ->setCellValue('Q10',  "$" . number_format(totalApr($conexion, $id, 12, $anio), 0, '.', ','))
        ->setCellValue('R10',  "$" . number_format((totalApr($conexion, $id, 10, $anio) + totalApr($conexion, $id, 11, $anio) + totalApr($conexion, $id, 12, $anio)), 0, '.', ','));

    for ($i = 1; $i <= 12; $i++) {
        $total += totalApr($conexion, $id, $i, $anio);
    }
    $totalc = 0;
    $total2 = 0;
    if ($month != $mes2) {
        $total2 = $total / $mes2;
        $totalc = round($total2);
    } else {
        $totalc = round($total / ($mes2 - ($month - 1)));
    }

    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('S10', '$' . number_format($total))
        ->setCellValue('T10', '$' . number_format($totalc))
        ->setCellValue('U10', porcentaje($totalc, $total) . "%");

    //TL COTIZACIONES
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('C11',  cotXMes($conexion, $id, 1, $anio))
        ->setCellValue('D11',  cotXMes($conexion, $id, 2, $anio))
        ->setCellValue('E11',  cotXMes($conexion, $id, 3, $anio))
        ->setCellValue('F11', (cotXMes($conexion, $id, 1, $anio) + cotXMes($conexion, $id, 2, $anio) + cotXMes($conexion, $id, 3, $anio)))
        ->setCellValue('G11',  cotXMes($conexion, $id, 4, $anio))
        ->setCellValue('H11',  cotXMes($conexion, $id, 5, $anio))
        ->setCellValue('I11',  cotXMes($conexion, $id, 6, $anio))
        ->setCellValue('J11', (cotXMes($conexion, $id, 4, $anio) + cotXMes($conexion, $id, 5, $anio) + cotXMes($conexion, $id, 6, $anio)))
        ->setCellValue('K11',  cotXMes($conexion, $id, 7, $anio))
        ->setCellValue('L11',  cotXMes($conexion, $id, 8, $anio))
        ->setCellValue('M11',  cotXMes($conexion, $id, 9, $anio))
        ->setCellValue('N11', (cotXMes($conexion, $id, 7, $anio) + cotXMes($conexion, $id, 8, $anio) + cotXMes($conexion, $id, 9, $anio)))
        ->setCellValue('O11',  cotXMes($conexion, $id, 10, $anio))
        ->setCellValue('P11',  cotXMes($conexion, $id, 11, $anio))
        ->setCellValue('Q11',  cotXMes($conexion, $id, 12, $anio))
        ->setCellValue('R11', (cotXMes($conexion, $id, 10, $anio) + cotXMes($conexion, $id, 11, $anio) + cotXMes($conexion, $id, 12, $anio)));
        $total = 0;
        for ($i = 1; $i <= 12; $i++) {
            $total += cotXMes($conexion, $id, $i, $anio);
        }
        $totalc = 0;
        $total2 = 0;
        if ($month != $mes2) {
            $total2 = $total / $mes2;
            $totalc = round($total2);
        } else {
            $totalc = round($total / ($mes2 - ($month - 1)));
        }
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('S11', $totalAnio)
        ->setCellValue('T11', ($totalc))
        ->setCellValue('U11', number_format(porcentaje($totalc, $totalAnio)) . "%");

    // $TL COTIZACIONES
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('C12',  "$" . number_format(total($conexion, $id, 1, $anio), 0, '.', ','))
        ->setCellValue('D12',  "$" . number_format(total($conexion, $id, 2, $anio), 0, '.', ','))
        ->setCellValue('E12',  "$" . number_format(total($conexion, $id, 3, $anio), 0, '.', ','))
        ->setCellValue('F12',  "$" . number_format((total($conexion, $id, 1, $anio) + total($conexion, $id, 2, $anio) + total($conexion, $id, 3, $anio)), 0, '.', ','))
        ->setCellValue('G12',  "$" . number_format(total($conexion, $id, 4, $anio), 0, '.', ','))
        ->setCellValue('H12',  "$" . number_format(total($conexion, $id, 5, $anio), 0, '.', ','))
        ->setCellValue('I12',  "$" . number_format(total($conexion, $id, 6, $anio), 0, '.', ','))
        ->setCellValue('J12',  "$" . number_format((total($conexion, $id, 4, $anio) + total($conexion, $id, 5, $anio) + total($conexion, $id, 6, $anio)), 0, '.', ','))
        ->setCellValue('K12',  "$" . number_format(total($conexion, $id, 7, $anio), 0, '.', ','))
        ->setCellValue('L12',  "$" . number_format(total($conexion, $id, 8, $anio), 0, '.', ','))
        ->setCellValue('M12',  "$" . number_format(total($conexion, $id, 9, $anio), 0, '.', ','))
        ->setCellValue('N12',  "$" . number_format((total($conexion, $id, 7, $anio) + total($conexion, $id, 8, $anio) + total($conexion, $id, 9, $anio)), 0, '.', ','))
        ->setCellValue('O12',  "$" . number_format(total($conexion, $id, 10, $anio), 0, '.', ','))
        ->setCellValue('P12',  "$" . number_format(total($conexion, $id, 11, $anio), 0, '.', ','))
        ->setCellValue('Q12',  "$" . number_format(total($conexion, $id, 12, $anio), 0, '.', ','))
        ->setCellValue('R12',  "$" . number_format((total($conexion, $id, 10, $anio) + total($conexion, $id, 11, $anio) + total($conexion, $id, 12, $anio)), 0, '.', ','));

    for ($i = 1; $i <= 12; $i++) {
        $total += total($conexion, $id, $i, $anio);
    }
    $totalc = 0;
    $total2 = 0;
    if ($month != $mes2) {
        $total2 = $total / $mes2;
        $totalc = round($total2);
    } else {
        $totalc = round($total / ($mes2 - ($month - 1)));
    }

    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('S12', '$' . number_format($total))
        ->setCellValue('T12', '$' . number_format($totalc))
        ->setCellValue('U12', porcentaje($totalc, $total) . "%");

    //EFICIENCIA EN COTIZACIONES
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('C13',  porcentaje(estXMes($conexion, $id, 1, 2, $anio), cotXMes($conexion, $id, 1, $anio)) . "%")
        ->setCellValue('D13',  porcentaje(estXMes($conexion, $id, 2, 2, $anio), cotXMes($conexion, $id, 2, $anio)) . "%")
        ->setCellValue('E13',  porcentaje(estXMes($conexion, $id, 3, 2, $anio), cotXMes($conexion, $id, 3, $anio)) . "%")
        ->setCellValue('F13',  porcentaje(
            estXMes($conexion, $id, 1, 2, $anio) + estXMes($conexion, $id, 2, 2, $anio) + estXMes($conexion, $id, 3, 2, $anio),
            cotXMes($conexion, $id, 1, $anio) + cotXMes($conexion, $id, 2, $anio) + cotXMes($conexion, $id, 3, $anio)
        ) . "%")
        ->setCellValue('G13',  porcentaje(estXMes($conexion, $id, 4, 2, $anio), cotXMes($conexion, $id, 4, $anio)) . "%")
        ->setCellValue('H13',  porcentaje(estXMes($conexion, $id, 5, 2, $anio), cotXMes($conexion, $id, 5, $anio)) . "%")
        ->setCellValue('I13',  porcentaje(estXMes($conexion, $id, 6, 2, $anio), cotXMes($conexion, $id, 6, $anio)) . "%")
        ->setCellValue('J13',  porcentaje(
            estXMes($conexion, $id, 4, 2, $anio) + estXMes($conexion, $id, 5, 2, $anio) + estXMes($conexion, $id, 6, 2, $anio),
            cotXMes($conexion, $id, 4, $anio) + cotXMes($conexion, $id, 5, $anio) + cotXMes($conexion, $id, 6, $anio)
        ) . "%")
        ->setCellValue('K13',  porcentaje(estXMes($conexion, $id, 7, 2, $anio), cotXMes($conexion, $id, 7, $anio)) . "%")
        ->setCellValue('L13',  porcentaje(estXMes($conexion, $id, 8, 2, $anio), cotXMes($conexion, $id, 8, $anio)) . "%")
        ->setCellValue('M13',  porcentaje(estXMes($conexion, $id, 9, 2, $anio), cotXMes($conexion, $id, 9, $anio)) . "%")
        ->setCellValue('N13',  porcentaje(
            estXMes($conexion, $id, 4, 2, $anio) + estXMes($conexion, $id, 5, 2, $anio) + estXMes($conexion, $id, 6, 2, $anio),
            cotXMes($conexion, $id, 4, $anio) + cotXMes($conexion, $id, 5, $anio) + cotXMes($conexion, $id, 6, $anio)
        ) . "%")
        ->setCellValue('O13',  porcentaje(estXMes($conexion, $id, 7, 2, $anio), cotXMes($conexion, $id, 7, $anio)) . "%")
        ->setCellValue('P13',  porcentaje(estXMes($conexion, $id, 8, 2, $anio), cotXMes($conexion, $id, 8, $anio)) . "%")
        ->setCellValue('Q13',  porcentaje(estXMes($conexion, $id, 9, 2, $anio), cotXMes($conexion, $id, 9, $anio)) . "%")
        ->setCellValue('R13',  porcentaje(
            estXMes($conexion, $id, 10, 2, $anio) + estXMes($conexion, $id, 11, 2, $anio) + estXMes($conexion, $id, 12, 2, $anio),
            cotXMes($conexion, $id, 10, $anio) + cotXMes($conexion, $id, 11, $anio) + cotXMes($conexion, $id, 12, $anio)
        ) . "%");



    $total = 0;
    $totaldiv = 0;
    for ($i = 1; $i <= 12; $i++) {
        $total += estXMes($conexion, $id, $i, 2, $anio);
        $totaldiv += cotXMes($conexion, $id, $i, $anio);
    }
    $totalef1 = porcentaje($total, $totaldiv);

    $total = 0;
    $totaldiv = 0;
    for ($i = 1; $i <= 12; $i++) {
        $total += estXMes($conexion, $id, $i, 2, $anio);
        $totaldiv += cotXMes($conexion, $id, $i, $anio);
    }
    $totalef = porcentaje($total, $totaldiv);
    $totalc = 0;
    if ($month != $mes2) {
        $total1 = $totalef / $month;
        $total2 = $totalef / $mes2;
        $totalc = round($total1 - $total2);
    } else {
        $totalc = round($totalef / ($mes2 - ($month - 1)));
    }

    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('S13', $totalef1 . "%")
        ->setCellValue('T13', number_format($totalc) . "%")
        ->setCellValue('U13', '');

    //CUMPLIMINETO DE ENTREGAS - COTIZACIONES ENVIADAS EN 1 DÍA HÁBIL
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('C14',  cumpMes($conexion, $id, 1, $anio))
        ->setCellValue('D14',  cumpMes($conexion, $id, 2, $anio))
        ->setCellValue('E14',  cumpMes($conexion, $id, 3, $anio))
        ->setCellValue('F14',  cumpMes($conexion, $id, 1, $anio) + cumpMes($conexion, $id, 2, $anio) + cumpMes($conexion, $id, 3, $anio))
        ->setCellValue('G14',  cumpMes($conexion, $id, 4, $anio))
        ->setCellValue('H14',  cumpMes($conexion, $id, 5, $anio))
        ->setCellValue('I14',  cumpMes($conexion, $id, 6, $anio))
        ->setCellValue('J14',  cumpMes($conexion, $id, 4, $anio) + cumpMes($conexion, $id, 5, $anio) + cumpMes($conexion, $id, 6, $anio))
        ->setCellValue('K14',  cumpMes($conexion, $id, 7, $anio))
        ->setCellValue('L14',  cumpMes($conexion, $id, 8, $anio))
        ->setCellValue('M14',  cumpMes($conexion, $id, 9, $anio))
        ->setCellValue('N14',  cumpMes($conexion, $id, 7, $anio) + cumpMes($conexion, $id, 8, $anio) + cumpMes($conexion, $id, 9, $anio))
        ->setCellValue('O14',  cumpMes($conexion, $id, 10, $anio))
        ->setCellValue('P14',  cumpMes($conexion, $id, 11, $anio))
        ->setCellValue('Q14',  cumpMes($conexion, $id, 12, $anio))
        ->setCellValue('R14',  cumpMes($conexion, $id, 10, $anio) + cumpMes($conexion, $id, 11, $anio) + cumpMes($conexion, $id, 12, $anio));

    $total = 0;
    $totalc = 0;

    for ($i = 1; $i <= 12; $i++) {
        $total += cumpMes($conexion, $id, $i, $anio);
    }
    for ($i = 1; $i <= 12; $i++) {
        $total += cumpMes($conexion, $id, $i, $anio);
    }
    if ($month != $mes2) {
        $total1 = $total / $month;
        $total2 = $total / $mes2;
        $totalc = round($total1 - $total2);
    } else {
        $totalc = round($total / ($mes2 - ($month - 1)));
    }

    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('S14', $total)
        ->setCellValue('T14', $totalc)
        ->setCellValue('U14', number_format(porcentaje($total, $month)) . "%");


    //TOTAL LLAMADAS 
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('C15',  llamMes($conexion, $id, 1, $anio))
        ->setCellValue('D15',  llamMes($conexion, $id, 2, $anio))
        ->setCellValue('E15',  llamMes($conexion, $id, 3, $anio))
        ->setCellValue('F15',  llamMes($conexion, $id, 1, $anio) + llamMes($conexion, $id, 2, $anio) + llamMes($conexion, $id, 3, $anio))
        ->setCellValue('G15',  llamMes($conexion, $id, 4, $anio))
        ->setCellValue('H15',  llamMes($conexion, $id, 5, $anio))
        ->setCellValue('I15',  llamMes($conexion, $id, 6, $anio))
        ->setCellValue('J15',  llamMes($conexion, $id, 4, $anio) + llamMes($conexion, $id, 5, $anio) + llamMes($conexion, $id, 6, $anio))
        ->setCellValue('K15',  llamMes($conexion, $id, 7, $anio))
        ->setCellValue('L15',  llamMes($conexion, $id, 8, $anio))
        ->setCellValue('M15',  llamMes($conexion, $id, 9, $anio))
        ->setCellValue('N15',  llamMes($conexion, $id, 7, $anio) + llamMes($conexion, $id, 8, $anio) + llamMes($conexion, $id, 9, $anio))
        ->setCellValue('O15',  llamMes($conexion, $id, 10, $anio))
        ->setCellValue('P15',  llamMes($conexion, $id, 11, $anio))
        ->setCellValue('Q15',  llamMes($conexion, $id, 12, $anio))
        ->setCellValue('R15',  llamMes($conexion, $id, 10, $anio) + llamMes($conexion, $id, 11, $anio) + llamMes($conexion, $id, 12, $anio));

    $total = 0;
    for ($i = 1; $i <= 12; $i++) {
        $total += llamMes($conexion, $id, $i, $anio);
    }
    $totalc = 0;
    if ($month != $mes2) {
        $total1 = $total / $month;
        $total2 = $total / $mes2;
        $totalc = round($total1 - $total2);
    } else {
        $totalc = round($total / ($mes2 - ($month - 1)));
    }

    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('S15', $total)
        ->setCellValue('T15', $totalc)
        ->setCellValue('U15', number_format(porcentaje($totalc, $total)) . "%");



    $objPHPExcel->getActiveSheet()->getStyle('C4:U15')->applyFromArray($estColorWhite);
    $objPHPExcel->getActiveSheet()->getStyle('F3:F14')->applyFromArray($estResult);
    $objPHPExcel->getActiveSheet()->getStyle('J3:J14')->applyFromArray($estResult);
    $objPHPExcel->getActiveSheet()->getStyle('N3:N14')->applyFromArray($estResult);
    $objPHPExcel->getActiveSheet()->getStyle('R3:R14')->applyFromArray($estResult);
    $objPHPExcel->getActiveSheet()->getStyle('C13:U13')->applyFromArray($estColorLetRoja);

    //Campos adaptarse al contenido de cada celda
    foreach (range('C4', 'U15') as $columnID) {
        $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
            ->setAutoSize(true);
    }

    foreach (range('C3', 'U3') as $columnID) {
        $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
            ->setAutoSize(true);
    }
    // Se asigna el nombre a la hoja
    $objPHPExcel->getActiveSheet()->setTitle('Resumen');
    // Se activa la hoja para que sea la que se muestre cuando el archivo se abre
    $objPHPExcel->setActiveSheetIndex(0);
    // Inmovilizar paneles 
    $objPHPExcel->getActiveSheet(0)->freezePane('A3');
    $objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(2, 4);

    // Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Resumen-' . date("d") . '-' . $StrMonth . '/' . $StrMes2 . '-' . $anio . '.xls"');
    header('Cache-Control: max-age=0');

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('php://output');
    exit;
} else {
    echo $sql;
    //print "<script>alert(\"No hay resultados para mostrar\");window.location.href='../cotizaciones/';</script>";
}
