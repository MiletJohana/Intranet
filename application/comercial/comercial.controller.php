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

        $sqlBus = "SELECT id_sac FROM mq_usu WHERE id_usu =" . $_SESSION['id'];
        $queryBus = $conexion->query($sqlBus);
        $r = $queryBus->fetch(PDO::FETCH_ASSOC);

        $sqlAgen = "INSERT INTO agen_comerciales (id_agen, 
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
                                                tel_con,
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
                                                '" . $_POST['tel_cli'] . "',
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
            $sqlAgen = "UPDATE agen_comerciales SET  id_cli='" . $_POST['id_cli'] . "',
                                                nom_con='" . $_POST['con_cli'] . "',
                                                eml_con='" . $_POST['eml_con'] . "',
                                                carg_con='" . $_POST['carg_con'] . "',
                                                dir_cli='" . $_POST['dir_cli'] . "',
                                                id_raz ='" . $_POST['id_raz'] . "', 
                                                obs_agen ='" . $_POST['obs_agen'] . "',
                                                concl_agen ='" . $_POST['concl_agen'] . "',
                                                id_est ='4',
                                                fec_fin ='$fecha',
                                                lat_fin ='" . $_POST['lat_ini'] . "',
                                                lon_fin ='" . $_POST['lon_ini'] . "', 
                                                tel_con=  '" . $_POST['tel_cli']."',
                                                id_llam='" . $_POST['tip_llam'] . "'
                                            WHERE id_agen=" . $_POST['id_agen'];
            $queryAgen = $conexion->query($sqlAgen);
            if ($queryAgen != null) {
                echo '¡Cita finalizada correctamente!';
                $sqlC = "SELECT nom_cli FROM mq_clientes WHERE id_cli = " . $_POST['id_cli'];
                $queryC = $conexion->query($sqlC);
                $rC = $queryC->fetch(PDO::FETCH_ASSOC);

                $sqlEvent = "SELECT com.obs_agen, com.concl_agen, DATE(com.fec_cre) as fecha1, DATE(com.fec_fin) AS fecha2, DATE_FORMAT(com.fec_cre, '%H:%i') as hora1, DATE_FORMAT(com.fec_fin, '%H:%i') AS hora2 , raz.nom_raz
                FROM agen_comerciales com, agen_raz raz
                WHERE com.id_raz=raz.id_raz
                ORDER BY id_agen DESC LIMIT 1";
                $queryEvent = $conexion->query($sqlEvent);
                $rE = $queryEvent->fetch(PDO::FETCH_ASSOC);

             // echo $rE['fecha1'] . "</br>" . $rE['fecha2'] . "</br>" . $rE['hora1'] . "</br>" . $rE['hora2'] . "</br>" . "Visita a:" . $rC['nom_cli'] . "</br>" . $_POST['dir_cli'] . "</br>" . "Observaciones :" . $_POST['obs_agen'] . "</br>" . $session_email, $rE['nom_raz'];
              if (isset($_SESSION['access_token'])) {
                $event = new Event();
                $event->newEvent($rE['nom_raz']." a: " . $rC['nom_cli'], $_POST['dir_cli'], "Observaciones: " . $_POST['obs_agen'],$rE['fecha1'], $rE['fecha2'], $rE['hora1'], $rE['hora2'], $session_email);
                $event->newEvent($rE['nom_raz']." a: " . $rC['nom_cli'].", de " . $sesion_nom, $_POST['dir_cli'], "Observaciones: " . $_POST['obs_agen'] . " Conclusiones: " . $_POST['con_cli'],$rE['fecha1'], $rE['fecha2'], $rE['hora1'], $rE['hora2'], "masterquimica.com_e268m2ol5puhci9os8mat9i788@group.calendar.google.com");
            }
                
            } else {
                echo "Ocurrió algo inesperado: SQL: </br>" . $sqlAgen;
            }
        
            if ($_POST['id_raz'] != 1) {
            include 'Email.php';
            }
        break;
        case 'cancel':
            $sqlAgen = "UPDATE agen_comerciales SET id_est = '5',
                                                obs_agen = '" . $_POST['obs_agenC'] . "',
                                                concl_agen = '" . $_POST['concl_agen'] . "',
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
