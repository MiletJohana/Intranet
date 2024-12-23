<?php
//Código para poner el filtro de mes a mes
$month = '01';
$mes2 = date("m");
if (isset($_POST['para'])) {
    $param = $_POST['para'];
    $month = substr($param[0], 5, 6);
    $mes2 = substr($param[1], 5, 6);
}
setlocale(LC_ALL, 'es_ES', 'Spanish_Spain', 'Spanish');
$StrMonth = ucwords(strftime("%b", strtotime(date('Y') . '-' . $month)));
$StrMes2 = ucwords(strftime("%b", strtotime(date('Y') . '-' . $mes2)));
$anio = date('Y');
//----------------------------------------------
// Funciones para mostrar resultados en la tabla
function convertMonth($mes, $param)
{
    if ($param == 0) {
        switch ($mes) {
            case '1':
                $mess = 'Enero';
                break;
            case '2':
                $mess = 'Febrero';
                break;
            case '3':
                $mess = 'Marzo';
                break;
            case '4':
                $mess = 'Abril';
                break;
            case '5':
                $mess = 'Mayo';
                break;
            case '6':
                $mess = 'Junio';
                break;
            case '7':
                $mess = 'Julio';
                break;
            case '8':
                $mess = 'Agosto';
                break;
            case '9':
                $mess = 'Septiembre';
                break;
            case '10':
                $mess = 'Octubre';
                break;
            case '11':
                $mess = 'Noviembre';
                break;
            case '12':
                $mess = 'Diciembre';
                break;
            default:
                $mess = 'Nulo';
                break;
        }
    } else {
        switch ($mes) {
            case '01':
                $mess = '12';
                break;
            case '02':
                $mess = '01';
                break;
            case '03':
                $mess = '02';
                break;
            case '04':
                $mess = '03';
                break;
            case '05':
                $mess = '04';
                break;
            case '06':
                $mess = '05';
                break;
            case '07':
                $mess = '06';
                break;
            case '08':
                $mess = '07';
                break;
            case '09':
                $mess = '08';
                break;
            case '10':
                $mess = '09';
                break;
            case '11':
                $mess = '10';
                break;
            case '12':
                $mess = '11';
                break;
            default:
                $mess = '00';
                break;
        }
    }

    return $mess;
}
//-------------Rotación Personal----------------
function rotaPer($a, $var, $param, $mes, $conexion)
{
    $anio = $GLOBALS['anio'];
    if ($mes < 10) {
        $mes = '0' . $mes;
    }
    if ($var == 1) {
        //Trabajadores Activos Inicio Mes
        if ($param == 0) {
            $sqlRotPer = "SELECT";
            $sqlRotPer2 = "FROM mq_usu WHERE (fec_firm < '$anio-$mes-01' AND fec_firm IS NOT NULL) AND (fec_ret > '$anio-$mes-01' OR fec_ret IS NULL)";
            if ($a == 0) {
                $sqlRotPer .= " COUNT(*) AS tot " . $sqlRotPer2;
            } else {
                return $sqlRotPer .= " * " . $sqlRotPer2;
            }
        } else {
            $rotAn = [];
            for ($i = 0; $i < 12; $i++) {
                $tot = rotaPer(0, 1, 0, $i + 1, $conexion);
                array_push($rotAn, $tot);
            }
            return array_sum($rotAn);
        }
    } else if ($var == 2) {
        //Trabajadores Activos Fin Mes
        if ($param == 0) {
            $sqlRotPer = "SELECT";
            $sqlRotPer2 = "FROM mq_usu WHERE (fec_firm <= '$anio-$mes-31' AND fec_firm IS NOT NULL) AND (fec_ret >= '$anio-$mes-31' OR fec_ret IS NULL)";
            if ($a == 0) {
                $sqlRotPer .= " COUNT(*) AS tot " . $sqlRotPer2;
            } else {
                return $sqlRotPer .= " * " . $sqlRotPer2;
            }
        } else {
            $rotAn = [];
            for ($i = 0; $i < 12; $i++) {
                $tot = rotaPer(0, 2, 0, $i + 1, $conexion);
                array_push($rotAn, $tot);
            }
            return array_sum($rotAn);
        }
    } else if ($var == 3) {
        //Ingresos
        if ($param == 0) {
            $sqlRotPer = "SELECT";
            $sqlRotPer2 = "FROM mq_usu WHERE fec_firm BETWEEN '$anio-$mes-01' AND '$anio-$mes-31'";
            if ($a == 0) {
                $sqlRotPer .= " COUNT(*) AS tot " . $sqlRotPer2;
            } else {
                return $sqlRotPer .= " * " . $sqlRotPer2;
            }
        } else {
            $sqlRotPer = "SELECT COUNT(*) AS tot FROM mq_usu WHERE fec_firm LIKE '$anio%'";
        }
    } else {
        //Retiros
        if ($param == 0) {
            $sqlRotPer = "SELECT";
            $sqlRotPer2 = "FROM mq_usu WHERE fec_ret BETWEEN '$anio-$mes-01' AND '$anio-$mes-31'";
            if ($a == 0) {
                $sqlRotPer .= " COUNT(*) AS tot " . $sqlRotPer2;
            } else {
                return $sqlRotPer .= " * " . $sqlRotPer2;
            }
        } else {
            $sqlRotPer = "SELECT COUNT(*) AS tot FROM mq_usu WHERE fec_ret LIKE '$anio%'";
        }
    }
    $querySqlRot = $conexion->query($sqlRotPer);
    $rRot = $querySqlRot-> fetch(PDO::FETCH_ASSOC);
    return $rRot['tot'];
}
function sumTotalRot($mes, $conexion)
{
    //Trabajadores Activos Inicio Mes
    $aim = rotaPer(0, 1, 0, $mes, $conexion);
    //Trabajadores Activos Fin Mes
    $afm = rotaPer(0, 2, 0, $mes, $conexion);
    //Ingresos
    $in = rotaPer(0, 3, 0, $mes, $conexion);
    //Retiros
    $rt = rotaPer(0, 4, 0, $mes, $conexion);
    $a = ($in + $rt);
    $b = ($aim + $afm);

    if ($b != 0) {
        $total = ($a * 100) / $b;
    } else {
        $total = 0;
    }
    return round($total);
}
function promYearRot($conexion)
{
    $per = [];
    for ($i = 0; $i < 12; $i++) {
        array_push($per, intval(sumTotalRot($i + 1, $conexion)));
    }
    $sum = array_sum($per);
    return bcdiv($sum, 12, 2);
}
//-------------Actividades de Bienestar----------------
function activBien($var, $param, $mes, $conexion)
{
    $anio = $GLOBALS['anio'];
    if ($var == 1) {
        $mess = convertMonth($mes, 0);
        if ($param == 0) {
            $sqlActMes = "SELECT COUNT(*) AS tot FROM ind_act WHERE mes_act = '" . $mess . "' AND fec_sis LIKE '$anio%'";
        } else {
            $sqlActMes = "SELECT COUNT(*) AS tot FROM ind_act WHERE fec_sis LIKE '$anio%'";
        }
    } else if ($var == 2) {
        if ($mes < 10) {
            $mes = '0' . $mes;
        }
        if ($param == 0) {
            $sqlActMes = "SELECT COUNT(*) AS tot FROM ind_act WHERE fec_cum LIKE '$anio-$mes%'";
        } else {
            $sqlActMes = "SELECT COUNT(*) AS tot FROM ind_act WHERE fec_cum LIKE '$anio%'";
        }
    }
    $querySqlActMes = $conexion->query($sqlActMes);
    $rActMes = $querySqlActMes-> fetch(PDO::FETCH_ASSOC);
    return $rActMes['tot'];
}
function sumTotalAct($param, $mes, $conexion)
{
    $total = 0;
    if ($mes < 10) {
        $mes = '0' . $mes;
    }
    if ($param == 0) {
        $p = activBien(1, 0, $mes, $conexion);
        $c = activBien(2, 0, $mes, $conexion);
    } else {
        $p = activBien(1, 1, $mes, $conexion);
        $c = activBien(2, 1, $mes, $conexion);
    }
    if ($p != 0) {
        $p = 100 / $p;
        $total = $p * $c;
    } else {
        $total = 0;
    }
    return round($total);
}
function promYearAct($conexion)
{
    $per = [];
    for ($i = 0; $i < 12; $i++) {
        if (sumTotalAct(0, $i + 1, $conexion) > 0) {
            array_push($per, intval(sumTotalAct(0, $i + 1, $conexion)));
        }
    }
    $sum = array_sum($per);
    $ap = activBien(1, 1, 0, $conexion);
    $total = $sum / $ap;
    return $total;
}
//-------------Capacitaciones----------------
function capacitacion($var, $param, $mes, $conexion)
{
    $anio = $GLOBALS['anio'];
    if ($mes < 10) {
        $mes = '0' . $mes;
    }
    if ($var == 1) {
        if ($param == 0) {
            $sqlCapMes = "SELECT COUNT(*) AS tot FROM ind_cap WHERE prd_cap != 'Si' AND fec_cap LIKE '$anio-$mes%'";
        } else {
            $sqlCapMes = "SELECT COUNT(*) AS tot FROM ind_cap WHERE prd_cap != 'Si' AND fec_cap LIKE '$anio%'";
        }
    } else if ($var == 2) {
        if ($param == 0) {
            $sqlCapMes = "SELECT COUNT(*) AS tot FROM ind_cap WHERE prd_cap = 'Si' AND fec_cap LIKE '$anio-$mes%'";
        } else {
            $sqlCapMes = "SELECT COUNT(*) AS tot FROM ind_cap WHERE prd_cap = 'Si' AND fec_cap LIKE '$anio%'";
        }
    } else {
        if ($param == 0) {
            $sqlCapMes = "SELECT COUNT(*) AS tot FROM ind_cap WHERE prd_cap != 'Si' AND fec_real LIKE '$anio-$mes%'";
        } else {
            $sqlCapMes = "SELECT COUNT(*) AS tot FROM ind_cap WHERE prd_cap != 'Si' AND fec_real LIKE '$anio%'";
        }
    }
    $querySqlCapMes = $conexion->query($sqlCapMes);
    $rCapMes = $querySqlCapMes-> fetch(PDO::FETCH_ASSOC);
    return $rCapMes['tot'];
}
function sumTotalCap($param, $mes, $conexion)
{
    $total = 0;
    if ($param == 0) {
        $p = capacitacion(1, 0, $mes, $conexion);
        $c = capacitacion(3, 0, $mes, $conexion);
    } else {
        $p = capacitacion(1, 1, 0, $conexion);
        $c = capacitacion(3, 1, 0, $conexion);
    }
    if ($p != 0) {
        $p = 100 / $p;
        $total = $p * $c;
    } else {
        $total = 0;
    }
    return round($total);
}
function promYearCap($conexion)
{
    $per = [];
    for ($i = 0; $i < 12; $i++) {
        array_push($per, intval(sumTotalCap(0, $i + 1, $conexion)));
    }
    $sum = array_sum($per);
    $total = $sum / capacitacion(1, 1, 0, $conexion);;
    return $total;
}
//------------- Días De Entrega Antes Del Pago----------------
function pago($var, $param, $mes, $x, $conexion)
{
    $anio = $GLOBALS['anio'];
    if ($mes < 10) {
        $mes = '0' . $mes;
    }
    if ($var == 1) {
        if ($param == 0) {
            $sqlEnMes1 = "SELECT dias_indicador , fec_ent FROM ind_fechas WHERE id_pag = 1  AND dias_indicador != '' AND fech_pag  LIKE '$anio-$mes%'";
            $queryEnMes1 = $conexion->query($sqlEnMes1);
            $rEn1 = $queryEnMes1-> fetch(PDO::FETCH_ASSOC);
            if ($x == 0) {
                if ($rEn1['dias_indicador'] < 0  && $rEn1['fec_ent'] != '') {
                    echo "<span style='color: #ff0000'><b>" . $rEn1['dias_indicador'] . "</b></span>";
                } else if ($rEn1['dias_indicador'] > 0) {
                    echo $rEn1['dias_indicador'];
                } else if ($rEn1['dias_indicador'] == '') {
                    echo "0";
                } else {
                    echo "<span style='color: #ff0000'><b>" . $rEn1['dias_indicador'] . "</b></span>";
                }
            } else {
                if ($rEn1['dias_indicador'] < 0  && $rEn1['fec_ent'] != '') {
                    return $rEn1['dias_indicador'];
                } else if ($rEn1['dias_indicador'] > 0) {
                    return $rEn1['dias_indicador'];
                } else if ($rEn1['dias_indicador'] == '') {
                    return "";
                } else {
                    return $rEn1['dias_indicador'];
                }
            }
        } else {
            // hileras  promedio
            $sqlprom1 = "SELECT AVG(dias_indicador) AS prom FROM ind_fechas WHERE id_pag=1 AND dias_indicador!= '' AND fech_pag LIKE '$anio%'";
            $queryprom1 = $conexion->query($sqlprom1);
            $rP1 = $queryprom1-> fetch(PDO::FETCH_ASSOC);
            $prom = $rP1['prom'];
            echo round($prom, 0, PHP_ROUND_HALF_DOWN);
        }
    } else if ($var == 2) {
        if ($param == 0) {
            $sqlEnMes2 = "SELECT dias_indicador, fec_ent FROM ind_fechas WHERE id_pag = 2  AND dias_indicador != '' AND fech_pag LIKE '$anio-$mes%'";
            $queryEnMes2 = $conexion->query($sqlEnMes2);
            $rEn2 = $queryEnMes2-> fetch(PDO::FETCH_ASSOC);
            if ($x == 0) {
                if ($rEn2['dias_indicador'] < 0 && $rEn2['fec_ent'] != '') {
                    echo "<span style='color: #ff0000'><b>" . $rEn2['dias_indicador'] . "</b></span>";
                } else if ($rEn2['dias_indicador'] > 0) {
                    echo $rEn2['dias_indicador'];
                } else if ($rEn2['dias_indicador'] == '') {
                    echo "0";
                } else {
                    echo "<span style='color: #ff0000'><b>" . $rEn2['dias_indicador'] . "</b></span>";
                }
            } else {
                if ($rEn2['dias_indicador'] < 0  && $rEn2['fec_ent'] != '') {
                    return $rEn2['dias_indicador'];
                } else if ($rEn2['dias_indicador'] > 0) {
                    return $rEn2['dias_indicador'];
                } else if ($rEn2['dias_indicador'] == '') {
                    return "";
                } else {
                    return $rEn2['dias_indicador'];
                }
            }
        } else {
            $sqlprom2 = "SELECT AVG(dias_indicador) AS prom FROM ind_fechas WHERE id_pag=2 AND dias_indicador!= '' AND fech_pag LIKE '$anio%'";
            $queryprom2 = $conexion->query($sqlprom2);
            $rP2 = $queryprom2-> fetch(PDO::FETCH_ASSOC);
            $prom2 = $rP2['prom'];
            echo round($prom2, 0, PHP_ROUND_HALF_DOWN);
        }
    } else if ($var == 3) {
        if ($param == 0) {
            $sqlEnMes3 = "SELECT dias_indicador FROM ind_fechas WHERE id_pag = 3 AND dias_indicador != '' AND fech_pag LIKE '$anio-$mes%'";
            $queryEnMes3 = $conexion->query($sqlEnMes3);
            $rEn3 = $queryEnMes3-> fetch(PDO::FETCH_ASSOC);
            if ($x == 0) {
                if ($rEn3['dias_indicador'] < 0 && $rEn3['fec_ent'] != '') {
                    echo "<span style='color: #ff0000'><b>" . $rEn3['dias_indicador'] . "</b></span>";
                } else if ($rEn3['dias_indicador'] > 0) {
                    echo $rEn3['dias_indicador'];
                } else if ($rEn3['dias_indicador'] == '') {
                    echo "0";
                } else {
                    echo "<span style='color: #ff0000'><b>" . $rEn3['dias_indicador'] . "</b></span>";
                }
            } else {
                if ($rEn3['dias_indicador'] < 0  && $rEn3['fec_ent'] != '') {
                    return $rEn3['dias_indicador'];
                } else if ($rEn3['dias_indicador'] > 0) {
                    return $rEn3['dias_indicador'];
                } else if ($rEn3['dias_indicador'] == '') {
                    return "";
                } else {
                    return $rEn3['dias_indicador'];
                }
            }
        } else {
            $sqlprom3 = "SELECT AVG(dias_indicador) AS prom FROM ind_fechas WHERE id_pag=3 AND dias_indicador!= '' AND fech_pag LIKE '$anio%'";
            $queryprom3 = $conexion->query($sqlprom3);
            $rP3 = $queryprom3-> fetch(PDO::FETCH_ASSOC);
            $prom3 = $rP3['prom'];
            echo round($prom3, 0, PHP_ROUND_HALF_DOWN);
        }
    } else {
        if ($param == 0) {
            $sqlEnMes4 = "SELECT SUM(dias_habiles) AS sums , fech_pag FROM ind_infoli WHERE dias_habiles!= '' AND fec_ret LIKE '$anio-$mes%'";
            $queryEnMes4 = $conexion->query($sqlEnMes4);
            $rEn4 = $queryEnMes4-> fetch(PDO::FETCH_ASSOC);
            if ($x == 0) {
                if ($rEn4['sums'] < 0 && $rEn4['fech_pag'] != '') {
                    echo "<span style='color: #ff0000'><b>" . $rEn4['sums'] . "</b></span>";
                } else if ($rEn4['sums'] > 0) {
                    echo $rEn4['sums'];
                } else if ($rEn4['sums'] == '') {
                    echo "0";
                } else {
                    echo "<span style='color: #ff0000'><b>" . $rEn4['dias_indicador'] . "</b></span>";
                }
            } else {
                if ($rEn4['dias_indicador'] < 0  && $rEn4['fec_ent'] != '') {
                    return $rEn4['dias_indicador'];
                } else if ($rEn4['dias_indicador'] > 0) {
                    return $rEn4['dias_indicador'];
                } else if ($rEn4['dias_indicador'] == '') {
                    return "";
                } else {
                    return $rEn4['dias_indicador'];
                }
            }
        } else {
            $sqlprom4 = "SELECT SUM(dias_habiles) AS prom FROM ind_infoli WHERE dias_habiles!= '' AND fec_ret LIKE '$anio%'";
            $queryprom4 = $conexion->query($sqlprom4);
            $rP4 = $queryprom4-> fetch(PDO::FETCH_ASSOC);
            $sum = $rP4['prom'];
            $sqlcont = "SELECT MONTH(fec_ret) AS mon FROM ind_infoli WHERE dias_habiles!= '' GROUP BY MONTH(fec_ret)";
            $querycont = $conexion->query($sqlcont);
            $num = $querycont->rowCount();
            $tot = $sum / $num;
            echo round($tot, 0,  PHP_ROUND_HALF_DOWN);
        }
    }
}
function Sumes($param, $mes, $conexion)
{
    $anio = date('Y');
    if ($mes < 10) {
        $mes = '0' . $mes;
    }
    if ($param == 0) {
        $sqlpromM = "SELECT SUM(dias_indicador) AS mes FROM ind_fechas WHERE id_pag IN (1,2,3) AND dias_indicador != '' AND fech_pag LIKE '$anio-$mes%'";
        $querypromM = $conexion->query($sqlpromM);
        $rMt = $querypromM-> fetch(PDO::FETCH_ASSOC);
        $me = $rMt['mes'];
        $sqlpromL = "SELECT SUM(dias_habiles) AS liq FROM ind_infoli WHERE dias_habiles!= '' AND fec_ret LIKE '$anio-$mes%'";
        $querypromL = $conexion->query($sqlpromL);
        $rL = $querypromL-> fetch(PDO::FETCH_ASSOC);
        $liq = $rL['liq'];
        $total = $me + $liq;
        echo $total;
        //echo $sqlpromM;
        //echo $sqlpromL;
    }
}
function SumYe($conexion)
{
    $anio = date('Y');
    $sqlpromM = "SELECT SUM(dias_indicador) AS mes FROM ind_fechas WHERE id_pag IN (1,2,3) AND dias_indicador != '' AND fech_pag LIKE '$anio%'";
    $querypromM = $conexion->query($sqlpromM);
    $rMt = $querypromM-> fetch(PDO::FETCH_ASSOC);
    $me = $rMt['mes'];
    $sqlpromL = "SELECT SUM(dias_habiles) AS liq FROM ind_infoli WHERE dias_habiles!= '' AND fec_ret LIKE '$anio%'";
    $querypromL = $conexion->query($sqlpromL);
    $rL = $querypromL-> fetch(PDO::FETCH_ASSOC);
    $liq = $rL['liq'];
    $sum1 = $me + $liq;

    $sqlcont1 = "SELECT dias_indicador FROM ind_fechas WHERE dias_indicador!= '' GROUP BY MONTH(fec_ent)";
    $querycont1 = $conexion->query($sqlcont1);
    $num1 = $querycont1->rowCount();
    $totP = $sum1 / $num1;
    echo round($totP, 0,  PHP_ROUND_HALF_DOWN);
}
//-------------Errores de Nómina----------------
function error($var, $param, $mes, $conexion)
{
    $anio = $GLOBALS['anio'];
    if ($mes < 10) {
        $mes = '0' . $mes;
    }
    if ($var == 1) {
        if ($param == 0) {
            $sqlErrMes = "SELECT COUNT(*) AS tot FROM ind_errores WHERE id_pag = 2 AND fech_error LIKE '$anio-$mes%'";
        } else {
            $sqlErrMes = "SELECT COUNT(*) AS tot FROM ind_errores WHERE id_pag = 2 AND fech_error LIKE '$anio%'";
        }
    } else if ($var == 2) {
        if ($param == 0) {
            $sqlErrMes = "SELECT COUNT(*) AS tot FROM ind_errores WHERE id_pag = 1 AND fech_error LIKE '$anio-$mes%'";
        } else {
            $sqlErrMes = "SELECT COUNT(*) AS tot FROM ind_errores WHERE id_pag = 1 AND fech_error LIKE '$anio%'";
        }
    } else if ($var == 3) {
        if ($param == 0) {
            $sqlErrMes = "SELECT COUNT(*) AS tot FROM ind_errores WHERE id_pag = 3 AND fech_error LIKE '$anio-$mes%'";
        } else {
            $sqlErrMes = "SELECT COUNT(*) AS tot FROM ind_errores WHERE id_pag = 3 AND fech_error LIKE '$anio%'";
        }
    } else {
        if ($param == 0) {
            $sqlErrMes = "SELECT COUNT(*) AS tot FROM ind_errores WHERE id_pag = 6 AND fech_error LIKE '$anio-$mes%'";
        } else {
            $sqlErrMes = "SELECT COUNT(*) AS tot FROM ind_errores WHERE id_pag = 6 AND fech_error LIKE '$anio%'";
        }
    }
    $querySqlErrMes = $conexion->query($sqlErrMes);
    $rErrMes = $querySqlErrMes-> fetch(PDO::FETCH_ASSOC);
    return $rErrMes['tot'];
}
function sumTotalErr($param, $mes, $conexion)
{
    $anio = $GLOBALS['anio'];
    if ($mes < 10) {
        $mes = '0' . $mes;
    }
    if ($param == 0) {
        $sqlErr = "SELECT COUNT(*) AS tot FROM ind_errores WHERE id_pag IN (2, 6, 3, 1) AND fech_error LIKE '$anio-$mes%'";
    } else {
        $sqlErr = "SELECT COUNT(*) AS tot FROM ind_errores WHERE id_pag IN (2, 6, 3, 1) AND fech_error LIKE '$anio%'";
    }
    $querySqlErr = $conexion->query($sqlErr);
    $rErr = $querySqlErr-> fetch(PDO::FETCH_ASSOC);
    $e = intval($rErr['tot']);
    return round($e);
}
//-------------Seleccion de personal - tiempos----------------
function tiempos($var, $param, $mes, $conexion)
{
    $anio = $GLOBALS['anio'];
    if ($mes < 10) {
        $mes = '0' . $mes;
    }
    if ($var == 1) {
        if ($param == 0) {
            $sqlTieMes = "SELECT COUNT(*) AS tot FROM ind_solcarg WHERE fecha_sol LIKE '$anio-$mes%'";
        } else {
            $sqlTieMes = "SELECT COUNT(*) AS tot FROM ind_solcarg WHERE fecha_sol LIKE '$anio%'";
        }
    } else if ($var == 2) {
        if ($param == 0) {
            $sqlTieMes = "SELECT COUNT(*) AS tot FROM ind_solcarg WHERE fec_fin LIKE '$anio-$mes%' AND (fec_fin BETWEEN fec_rec AND fec_estip)";
        } else {
            $sqlTieMes = "SELECT COUNT(*) AS tot FROM ind_solcarg WHERE fec_fin LIKE '$anio%' AND (fec_fin BETWEEN fec_rec AND fec_estip)";
        }
    } else {
        if ($param == 0) {
            $sqlTieMes = "SELECT COUNT(*) AS tot FROM ind_solcarg WHERE fec_fin LIKE '$anio-$mes%' AND (fec_fin > fec_estip)";
        } else {
            $sqlTieMes = "SELECT COUNT(*) AS tot FROM ind_solcarg WHERE fec_fin LIKE '$anio%' AND (fec_fin > fec_estip)";
        }
    }
    $querySqlTieMes = $conexion->query($sqlTieMes);
    $rwTieMes = $querySqlTieMes-> fetch(PDO::FETCH_ASSOC);
    return $rwTieMes['tot'];
}
function sumTotalTie($mes, $var, $conexion)
{
    //Requisiciones para el mes
    $pm = tiempos(1, $var, $mes, $conexion);
    //Requisiones cubiertas en el Tiempo según tabla
    $ct = tiempos(2, $var, $mes, $conexion);

    if ($ct != 0) {
        $total = ($ct * 100) / $pm;
    } else {
        $total = 0;
    }
    return round($total);
}
//-------------Seleccion de personal - efectividad----------------
function efectividad($var, $param, $mes, $conexion)
{
    $anio = $GLOBALS['anio'];
    if ($mes < 10) {
        $mes = '0' . $mes;
    }

    if ($var == 1) {
        if ($param == 0) {
            $sqlEfeMes = "SELECT COUNT(*) AS tot FROM mq_usu WHERE fec_ind LIKE '$anio-$mes%'";
        } else {
            $sqlEfeMes = "SELECT COUNT(*) AS tot FROM mq_usu WHERE fec_ind LIKE '$anio%'";
        }
    } else {
        if ($param == 0) {
            $sqlEfeMes = "SELECT COUNT(*) AS tot FROM mq_usu WHERE fec_ind LIKE '$anio-$mes%' AND fec_ret IS NULL";
        } else {
            $sqlEfeMes = "SELECT COUNT(*) AS tot FROM mq_usu WHERE fec_ind LIKE '$anio%' AND fec_ret IS NULL";
        }
    }
    $querySqlEfeMes = $conexion->query($sqlEfeMes);
    $rwEfeMes = $querySqlEfeMes-> fetch(PDO::FETCH_ASSOC);
    return $rwEfeMes['tot'];
}
function sumTotalEfe($mes, $var, $conexion)
{
    //Ingresos hace seis meses
    $iasm = efectividad(1, $var, $mes, $conexion);
    //Continuidad de ingresos
    $ci = efectividad(2, $var, $mes, $conexion);

    if ($ci != 0) {
        $total = ($ci * 100) / $iasm;
    } else {
        $total = 0;
    }
    return round($total);
}
//-------------Clima Laboral----------------
function clima($var, $param, $a, $mes, $conexion)
{
    $anio = $GLOBALS['anio'];
    if ($mes < 10) {
        $mes = '0' . $mes;
    }

    if ($var == 1) {
        if ($param == 0) {
            $sqlCliMes = "SELECT clima FROM ind_clim WHERE fec_clim LIKE '$anio-$mes%'";
        } else {
            $sqlCliMes = "SELECT SUM(clima)/COUNT(clima) AS clima FROM ind_clim WHERE fec_clim LIKE '$anio%'";
        }
    }
    $querySqlCliMes = $conexion->query($sqlCliMes);
    $rEfeMes = $querySqlCliMes-> fetch(PDO::FETCH_ASSOC);
    if ($rEfeMes['clima'] == 0) {
        return null;
    } else {
        if ($a == 0) {
            return $rEfeMes['clima'] / 100;
        } else {
            return round($rEfeMes['clima']) . "%";
        }
    }
}
function sumTotalCli($a, $mes, $conexion, $meta)
{
    //Ingresos hace seis meses
    $cl = clima(1, 0, 1, $mes, $conexion);
    $total = $cl - $meta;
    if ($cl == 0) {
        if ($a == 0) {
            return 0;
        } else {
            return null;
        }
        return null;
    } else {
        if ($a == 0) {
            return round($total);
        } else {
            return round($total)  . "%";
        }
    }
}
function promYearCli($conexion, $meta)
{
    $clA = [];
    for ($i = 0; $i < 12; $i++) {
        if (sumTotalCli(0, $i + 1, $conexion, $meta) != 0) {
            $cl = intval(sumTotalCli(0, $i + 1, $conexion, $meta));
            array_push($clA, $cl);
        }
    }
    $cll = array_sum($clA);
    $total = $cll / count($clA);
    return round($total) . "%";
}
