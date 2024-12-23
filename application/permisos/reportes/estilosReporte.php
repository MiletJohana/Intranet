<?php
$styleArray = [
    'font' => [
        'bold' => true,
    ],
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
    ],
    'borders' => [
        'inside' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
    ],
    'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
        'rotation' => 90,
        'startColor' => [
            'argb' => 'FFA0A0A0',
        ],
        'endColor' => [
            'argb' => 'FFFFFFFF',
        ],
    ],
];
$Arial11 = array(
    'font' => array(
        'name' => 'Arial',
        'size' => 11,
    )
);
$Arial12 = array(
    'font' => array(
        'name' => 'Arial',
        'size' => 12,
    )
);
$bold = array(
    'font' => array(
        'bold' => true,
    )
);
$mq = array(
    'fill' => array(
        'fillType'  => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        'color' => array('rgb' => 'ff2323')
    )
);
$whiteFont = array(
    'font' => array(
        'color' => array(
            'rgb' => 'ffffff'
        )
    )
);
$borderThin = array(
    'borders' => array(
        'allBorders' => array(
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        )
    )
);
$alignCenter = array(
    'alignment' => array(
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
    )
);
/*
$borderThick = array(
    'borders' => array(
        'outline' => array(
            'style' => PHPExcel_Style_Border::BORDER_THICK,
        )
    )
);
$borderNone = array(
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_NONE,
        )
    )
);
$azul = array(
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => '8db3e2')
    )
);
$amarillo = array(
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'ffff99')
    )
);
$rojo = array(
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'fbd4b4')
    )
);
$conditionalS = array(
    'font' => array(
        'bold' => true,
        'color' => array(
            'rgb' => 'ff0000'
        )
    )
);
$bold = array(
    'font' => array(
        'bold' => true,
    )
);
*/