<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';
if (isset($_SESSION['access_token'])) {
    include 'calendar.php';
}
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d H:i:s");
$action = $_POST['action'];
switch ($action) {
    case 'add':
        $sqlAntesDe = "SELECT id_cli FROM mq_clie WHERE id_cli = " . $_POST['id_cli'];
        $queryAntesDe = $conexion->query($sqlAntesDe);
        if ($queryAntesDe->num_rows == 0) {
            $sqlCli = "INSERT INTO mq_clie (id_cli, 
                                          tip_id, 
                                          nom_cli,
                                          con_cli,
                                          dir_cli, 
                                          tel_cli,
                                          eml_cli,
                                          web_cli,
                                          hor_cli,
                                          usu_upt,
                                          lst_upt, 
                                          fec_cre, 
                                          id_reg, 
                                          id_tipcli)
                                    VALUES('" . $_POST['id_cli'] . "',
                                           '" . $_POST['tip_id'] . "',
                                           '" . $_POST['nom_cli'] . "',
                                           '" . $_POST['con_cli'] . "',
                                           '" . $_POST['dir_cli'] . "',
                                           '" . $_POST['tel_cli'] . "',
                                           '" . $_POST['eml_cli'] . "',
                                           '" . $_POST['web_cli'] . "',
                                           '" . $_POST['hor_cli'] . "',
                                           '" . $_SESSION['usu'] . "',
                                           '$fecha',
                                           '$fecha',
                                           '" . $_SESSION['reg'] . "', 
                                           '" . $_POST['tip_cliD'] . "')";
            $queryCli = $conexion->query($sqlCli);
        }

        $sqlBus = "SELECT id_sac FROM mq_usu WHERE id_usu =" . $_SESSION['id'];
        $queryBus = $conexion->query($sqlBus);
        $r = $queryBus->fetch_array();

        $sqlAgen = "INSERT INTO agen_com (id_agen, 
                                                id_cli,
                                                nom_con,
                                                eml_con,
                                                carg_con,
                                                dir_cli,
                                                id_usu, 
                                                id_raz, 
                                                fec_cre, 
                                                id_est,
                                                lat_ini,
                                                lon_ini, 
                                                id_sac,
                                                id_tipcli)
                                        VALUES (NULL,
                                                '" . $_POST['id_cli'] . "',
                                                '" . $_POST['con_cli'] . "',
                                                '" . $_POST['eml_con'] . "',
                                                '" . $_POST['carg_con'] . "',
                                                '" . $_POST['dir_cli'] . "',
                                                '" . $_SESSION['id'] . "',
                                                '" . $_POST['id_raz'] . "',
                                                '$fecha',
                                                '3',
                                                '" . $_POST['lat_ini'] . "',
                                                '" . $_POST['lon_ini'] . "',
                                                '" . $r['id_sac'] . "',
                                                '" . $_POST['tip_cliD'] . "')";
        $queryAgen = $conexion->query($sqlAgen);
        if ($queryAgen != null) {
            echo '¡Cita agregada correctamente!<br>';
            //echo $sqlCli;
            //echo $sqlAgen;
        } else {
            echo $sqlAgen;
        }
        break;
    case 'update':
        $sqlAgen = "UPDATE agen_com  SET  id_cli='" . $_POST['id_cli'] . "',
                                            nom_con='" . $_POST['con_cli'] . "',
                                            eml_con='" . $_POST['eml_con'] . "',
                                            carg_con='" . $_POST['carg_con'] . "',
                                            dir_cli='" . $_POST['dir_cli'] . "',
                                            id_raz ='" . $_POST['id_raz'] . "', 
                                            obs_agen ='" . utf8_decode($_POST['obs_agen']) . "',
                                            concl_agen ='" . utf8_decode($_POST['concl_agen']) . "',
                                            id_est ='4',
                                            fec_fin ='$fecha',
                                            lat_fin ='" . $_POST['lat_ini'] . "',
                                            lon_fin ='" . $_POST['lon_ini'] . "', 
                                            id_llam='" . $_POST['tip_llam'] . "'
                                        WHERE id_agen=" . $_POST['id_agen'];
        $queryAgen = $conexion->query($sqlAgen);
        if ($queryAgen != null) {
            echo '¡Cita finalizada correctamente!';
            $sqlC = "SELECT nom_cli FROM mq_clie WHERE id_cli = " . $_POST['id_cli'];
            $queryC = $conexion->query($sqlC);
            $rC = $queryC->fetch_array();

            $sqlEvent = "SELECT DATE(fec_cre) as fecha1, DATE(fec_fin) AS fecha2, DATE_FORMAT(fec_cre, '%H:%i') as hora1, DATE_FORMAT(fec_fin, '%H:%i') AS hora2 FROM agen_com ORDER BY id_agen DESC LIMIT 1";
            $queryEvent = $conexion->query($sqlEvent);
            $rE = $queryEvent->fetch_array();
           //echo $rE['fecha1'] . "</br>" . $rE['fecha2'] . "</br>" . $rE['hora1'] . "</br>" . $rE['hora2'] . "</br>" . "Visita a:" . $rC['nom_cli'] . "</br>" . $_POST['dir_cli'] . "</br>" . "Observaciones :" . $_POST['obs_agen'] . "</br>" . $session_email ;
           /*if (isset($_SESSION['access_token'])) {
                $event = new Event(); 
                $event->newEvent($rE['fecha1'], $rE['fecha2'], $rE['hora1'], $rE['hora2'], "Visita a: " . $rC['nom_cli'], $_POST['dir_cli'], "Observaciones: " . $_POST['obs_agen'], $session_email);
                $event->newEvent($rE['fecha1'], $rE['fecha2'], $rE['hora1'], $rE['hora2'], "Visita a: " . $rC['nom_cli'] . ", de " . $sesion_nom , $_POST['dir_cli'], "Observaciones: ". $_POST['obs_agen'] . " Conclusiones: " . $_POST['con_cli'], "masterquimica.com_e268m2ol5puhci9os8mat9i788@group.calendar.google.com");
            }*/
        } else {
            echo "Ocurrió algo inesperado: SQL: </br>" . $sqlAgen;
        }
        if ($_POST['id_raz'] != 1) {
            include 'Email.php';
        }
        break;
    case 'cancel':
        $sqlAgen = "UPDATE agen_com SET id_est = '5',
                                              obs_agen = '" . utf8_decode($_POST['obs_agenC']) . "',
                                              concl_agen = '" . utf8_decode($_POST['concl_agen']) . "',
                                              fec_fin = '$fecha',
                                              lat_fin = '" . $_POST['lat_fin'] . "',
                                              lon_fin = '" . $_POST['lon_fin'] . "'
                                        WHERE id_agen = " . $_POST['id_agen'];
        $queryAgen = $conexion->query($sqlAgen);
        if ($queryAgen != null) {
            echo '¡Cita cancelada correctamente!';
        } else {
            echo $sqlAgen;
        }
        break;
}
