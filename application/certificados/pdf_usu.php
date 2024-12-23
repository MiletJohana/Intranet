<?php
include "../../conexion.php";
include '../../resources/template/credentials.php';
$sqlNom = "SELECT * FROM mq_usu us, ind_cargos car WHERE us.id_carg=car.id_carg AND us.id_usu=" . $us;
$queryNom = $conexion->query($sqlNom);
$rU = $queryNom->fetch(PDO::FETCH_ASSOC);


$fech = $rU['fec_firm'];
$fec_ret = $rU['fec_ret'];

function fechaCastellano($fecha)
{
    $fecha = substr($fecha, 0, 10);
    $numeroDia = date('d', strtotime($fecha));
    $dia = date('l', strtotime($fecha));
    $mes = date('F', strtotime($fecha));
    $anio = date('Y', strtotime($fecha));
    $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
    $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
    $nombredia = str_replace($dias_EN, $dias_ES, $dia);
    $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
    return ($numeroDia) . " días del mes de " . $nombreMes . " de dos mil veinticuatro  " . ($anio);
}


function fechaCastell($fech)
{
    $fech = substr($fech, 0, 10);
    $numeroDia = date('d', strtotime($fech));
    $dia = date('l', strtotime($fech));
    $mes = date('F', strtotime($fech));
    $anio = date('Y', strtotime($fech));
    $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
    $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
    $nombredia = str_replace($dias_EN, $dias_ES, $dia);
    $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
    return ($numeroDia) . " de " . $nombreMes . " de  " . ($anio);
}
function fechaCastellano3($fec_ret)
{
    $fec_ret = substr($fec_ret, 0, 10);
    $numeroDia = date('d', strtotime($fec_ret));
    $dia = date('l', strtotime($fec_ret));
    $mes = date('F', strtotime($fec_ret));
    $anio = date('Y', strtotime($fec_ret));
    $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
    $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
    $nombredia = str_replace($dias_EN, $dias_ES, $dia);
    $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
    return ($numeroDia) . " de " . $nombreMes . " de  " . ($anio);
}
$hor_cert = fechaCastellano(date("Y-m-d"));
$hor_cont = fechaCastell($fech);
$hor_ret = fechaCastellano3($fec_ret);
$html = '
    <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../resources/librerias/css/style.css" media="all" />
    </head>
    <body style="font-family:Cambria;">
    <br><br><br>
    <div align="center" style="font-size:16px;" > <b> EL ÁREA DE TALENTO HUMANO DE MASTER QUÍMICA S.A.S </b></div>
    <br><br><br><br>
    <div align="center" style="font-size:16px;"> <b>HACE CONSTAR</b></div>
    <br><br><br>
    <div style="font-size:14px;">
        <p align="justify">Que <b>' . $rU["nom_usu"] . ' </b>, identificado(a) con Cédula de Ciudadania 
        <b> No.' . $rU["id_usu"] . '</b>,';
if ($rU['usu_elim'] == 0) {
    $html .= ' labora en la Compañía <b>MASTER QUÍMICA S.A.S</b>, con <b>Nit 860.531.097-2</b>, con un <b>' . $rU["tip_contrato"] . '</b>, 
        desde el <b>' . $hor_cont . '</b> desempeñando el cargo de <b>' . $rU["nom_carg"] . '</b>';
} else {
    $html .= '  laboró en la Compañía <b>MASTER QUÍMICA  S.A.S</b>, con <b>Nit 860.531.097-2</b>, con un <b>' . $rU["tip_contrato"] . '</b>, 
             desde el <b>' . $hor_cont . '</b> hasta el <b>' . $hor_ret . '</b> desempeñando el cargo de <b>' . $rU["nom_carg"] . '</b>';
}
if ($rU['cer_salario'] == 1) {
    $html .= ', con un salario básico de <b>$' . $rU['sala_base'] . '</b> ';
} else {
}
if ($rU['cer_varia'] == 1) {
    $html .= ',más un salario variable mensual de <b>$' . $rU["sala_varia"] . '</b>';
} else {
}
if ($rU['cer_rodam'] == 1) {
    $html .= ',Con un rodamiento mensual no prestacional por un valor de <b> $' . $rU["sal_roda"] . '</b>';
} else {
}
$html .= '.';
$html .= '<br><br><br> La presente se expide a solicitud del interesado';
if ($rU['destino_cert'] != '') {
    $html .= ', con destino a <b>' . $rU["destino_cert"] . '</b>';
} else {
}
$html .= ' a los ' . $hor_cert . '.<br><br><br><br><br></p>
              Cordialmente,<br>
              <img src="../../resources/img/documentos/FirmaAngela.png" width="52%" align="left"></td><br>
    
              </div></body>';
