<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';
if (isset($_SESSION['access_token'])) {
    include 'calendar.php';
}
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d H:i:s");
$hora = date("H:i:s");
$year = date("Y");
$mes = date("n");
$cer = ':00';
/*Permiso Creado Correctamente
Caught Google_Service_Exception: { "error": { "code": 401, "message": "Request had invalid authentication credentials. Expected OAuth 2 access token, login cookie or other valid authentication credential. See https://developers.google.com/identity/sign-in/web/devconsole-project.", "errors": [ { "message": "Invalid Credentials", "domain": "global", "reason": "authError", "location": "Authorization", "locationType": "header" } ], "status": "UNAUTHENTICATED" } } */
function diferenciaHoras($horaI, $horaF){
    $diferencia = $horaI->diff($horaF);
    
    return $diferencia->format("%H:%I:%S"); 
}

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'permiso':
            $file = "../../documentos/permisos/";
            opendir($file);
            if (!empty($_FILES['doc_perm']['tmp_name'])) {
                $doc_perm = $_FILES['doc_perm']['name'];
                $destino = $file . $doc_perm;
                copy($_FILES['doc_perm']['tmp_name'], $destino);
            } 

            $horaIn = new DateTime($_POST['hora_ini']);
            $horaFn = new DateTime($_POST['hora_fin']);
            $horaTo = diferenciaHoras($horaIn, $horaFn);
            
            $horaInicial = $horaIn->format('H:i:s');
            $horaFinal = $horaFn->format('H:i:s');
         
            $sqlPer = "INSERT INTO  
            per_ingreso
            (id_per, 
            fech_sis,
            fech_aus,
            id_are,
            id_usu,
            fech_ini,
            fech_fin,
            hor_tot,
            mot_per,
            obser_perm,
            usu_perm,
            crea_rec,
            id_estPer";
            if (!empty($_FILES['doc_perm']['tmp_name'])) {
                $sqlPer .= ", doc_perm";
            }
            $sqlPer .= "
            , perEst_upd,
            revi_rec, 
            id_mes)
            VALUES(
            NULL,
            '$fecha',
            '" . $_POST['fec_ase'] . "',
            '" . $_POST['usu_per'] . "',
            '" . $_POST['us_per'] . "',
            '" . $horaInicial. "',
            '" . $horaFinal. "',
            '" .$horaTo. "',
            '" . $_POST['mot_per'] . "',
            '" . $_POST['obs_per'] . "',
            '" . $_SESSION['id'] . "',
            '1',
            '2'";
            if (!empty($_FILES['doc_perm']['tmp_name'])) {
                $sqlPer .= ",'$doc_perm'";
            }
            $sqlPer .= "
            , '$fecha',
            '1',
            '$mes')";
            $queryPer = $conexion->query($sqlPer);

            $sqlPer1 = "SELECT * FROM per_ingreso ORDER BY id_per DESC ";
            $queryPer1 = $conexion->query($sqlPer1);
            $rPe = $queryPer1->fetch(PDO::FETCH_ASSOC);

            $sqlPermov = " INSERT INTO 
            per_ingre_x_mov
            (id_per,
            id_usu,
            id_estPer,
            fech_sis,
            id_are, 
            fech_aus1,
            mot_per)
            VALUES(
            '" . $rPe['id_per'] . "',
            '" . $_SESSION['id'] . "',
            '1',
            '$fecha',
            '" . $_POST['usu_per'] . "',
            '" . $_POST['fec_ase'] . "',
            '" . $_POST['mot_per'] . "')";
            $queryPermov = $conexion->query($sqlPermov);

            $sqlPermov2 = " INSERT INTO 
            per_ingre_x_mov
            (id_per,
            id_usu,
            id_estPer,
            fech_sis,
            id_are, 
            fech_aus1,
            mot_per)
            VALUES(
            '" . $rPe['id_per'] . "',
            '" . $_SESSION['id'] . "',
            '0',
            '$fecha',
            '" . $_POST['usu_per'] . "',
            '" . $_POST['fec_ase'] . "',
            '" . $_POST['mot_per'] . "')";
            $queryPermov2 = $conexion->query($sqlPermov2);

            $sqlPermov3 = " INSERT INTO 
            per_ingre_x_mov
            (id_per,
            id_usu,
            id_estPer,
            fech_sis,
            id_are, 
            fech_aus1,
            mot_per)
            VALUES(
            '" . $rPe['id_per'] . "',
            '" . $_SESSION['id'] . "',
            '2',
            '$fecha',
            '" . $_POST['usu_per'] . "',
            '" . $_POST['fec_ase'] . "',
            '" . $_POST['mot_per'] . "')";
            $queryPermov3 = $conexion->query($sqlPermov3);

            if ($queryPer != null && $queryPermov != null && $queryPermov2 != null && $queryPermov3 != null) {
                //echo $sqlPer;
                //echo $sqlPermov;
                echo "Permiso Creado Correctamente";
                $sqlU = "SELECT nom_usu, eml_usu FROM mq_usu WHERE id_usu = " . $_POST['us_per'];
                $queryU = $conexion->query($sqlU);
                $rU = $queryU->fetch(PDO::FETCH_ASSOC);
                $emailU = $rU['eml_usu'];
                // echo $_POST['fec_ase'] . "<br>" . $_POST['fec_ase'] . "<br>" . $_POST['hora_ini'] . "<br>" . $_POST['hora_fin'] . "<br>" . "Permiso #" . $rPe['id_per'] . " de " . $rU['nom_usu'] . "<br>" . "Master Quimica S.A.S" . "<br>" . "Observaciones :" . $_POST['obs_per'] . "<br>" . $emailU  ;
                if (isset($_SESSION['access_token'])) {
                    $event = new Event();
                    $event->newEvent($_POST['fec_ase'], $_POST['fec_ase'], $_POST['hora_ini'].$cer, $_POST['hora_fin'].$cer, "Permiso #" . $rPe['id_per'], "Master Quimica S.A.S", "Observaciones : Permiso " . $_POST['obs_per'], $emailU);
                }
            } else {
                echo $sqlPer;
                echo $sqlPermov;
                printf("Errormessage: %s\n", $conexion->error);
            }

            include 'Email.php';
            break;

        case 'updatepermiso':
            $sqlBus = "SELECT * FROM per_ingreso WHERE id_per=" . $_POST['id_per'];
            $queryBus = $conexion->query($sqlBus);
            $r = $queryBus->fetch(PDO::FETCH_ASSOC);
            $file = "../../documentos/permisos/";
            opendir($file);
            if (!empty($_FILES['doc_perm']['tmp_name'])) {
                if (file_exists($file . $r["doc_perm"])) {
                    unlink($file . $r["doc_perm"]);
                }
                $doc_perm = $_FILES['doc_perm']['name'];
                $destino = $file . $doc_perm;
                copy($_FILES['doc_perm']['tmp_name'], $destino);
            }

            $horaIn = new DateTime($_POST['hora_ini']);
            $horaFn = new DateTime($_POST['hora_fin']);
            $horaTo = diferenciaHoras($horaIn, $horaFn);
            
            $horaInicial = $horaIn->format('H:i:s');
            $horaFinal = $horaFn->format('H:i:s');


            $sqlUpdate = "UPDATE per_ingreso SET 
            fech_aus = '" . $_POST['fec_ase'] . "',
            fech_ini = '" . $horaInicial . "',
            fech_fin = '" . $horaFinal . "',
            hor_tot  = '".$horaTo."',
            mot_per  = '" . $_POST['mot_per'] . "',
            obser_perm  = '" . $_POST['obs_per'] . "'";
            if (!empty($_FILES['doc_perm']['tmp_name'])) {
                $sqlUpdate .= ", doc_perm = '$doc_perm'";
            }
            $sqlUpdate .= " , perEst_upd ='$fecha',
            id_mes='$mes'
            WHERE id_per='" . $_POST['id_per'] . "'";
            $queryUpdate = $conexion->query($sqlUpdate);

            $sqlUpd1 = "INSERT INTO 
            per_ingre_x_mov
            (id_per,
            id_usu,
            id_estPer,
            fech_sis,
            id_are, 
            fech_aus1,
            mot_per)
            VALUES(
            '" . $_POST['id_per'] . "',
            '" . $_SESSION['id'] . "',
            '5',
            '$fecha',
            '" . $_SESSION['are'] . "',
            '" . $_POST['fec_ase'] . "',
            '" . $_POST['mot_per'] . "')";
            $queryUpd1 = $conexion->query($sqlUpd1);

            $sqlUpd2 = "INSERT INTO 
            per_ingre_x_mov
            (id_per,
            id_usu,
            id_estPer,
            fech_sis,
            id_are, 
            fech_aus1,
            mot_per)
            VALUES(
            '" . $_POST['id_per'] . "',
            '" . $_SESSION['id'] . "',
            '" . $r['id_estPer'] . "',
            '$fecha',
            '" . $_SESSION['are'] . "',
            '" . $_POST['fec_ase'] . "',
            '" . $_POST['mot_per'] . "')";
            $queryUpd2 = $conexion->query($sqlUpd2);

            if ($queryUpdate != null &&  $queryUpd1 != null && $queryUpd2 != null) {
                echo "Permiso  Actualizado Correctamente.";
            } else {
                printf("Errormessage: %s\n", $sqlUpdate);
            }
            break;

        case 'permiso2':
            $file = "../../documentos/permisos/";
            opendir($file);
            if (!empty($_FILES['doc_perm1']['tmp_name'])) {
                $doc_perm1 = $_FILES['doc_perm1']['name'];
                $destino = $file . $doc_perm1;
                copy($_FILES['doc_perm1']['tmp_name'], $destino);
            }

            $horaIn = new DateTime($_POST['hora_ini1']);
            $horaFn = new DateTime($_POST['hora_fin1']);
            $horaTo = diferenciaHoras($horaIn, $horaFn);
            
            $horaInicial = $horaIn->format('H:i:s');
            $horaFinal = $horaFn->format('H:i:s');

            $sqlPermiso = " INSERT INTO
            per_ingreso
            (id_per, 
            fech_sis,
            fech_aus,
            id_are,
            id_usu,
            fech_ini,
            fech_fin,
            hor_tot,
            mot_per,
            obser_perm,
            crea_rec,
            id_estPer";
            if (!empty($_FILES['doc_perm1']['tmp_name'])) {
                $sqlPermiso .= ", doc_perm";
            }
            $sqlPermiso .= "
            , perEst_upd,
            revi_rec,
            id_mes)
            VALUES(
            NULL,
            '$fecha',
            '" . $_POST['fec_ase1'] . "',
            '" . $_SESSION['are'] . "',
            '" . $_SESSION['id'] . "',
            '" . $horaInicial. "',
            '" . $horaFinal. "',
            '" . $horaTo. "',
            '" . $_POST['mot_per1'] . "',
            '" . $_POST['obs_per1'] . "',
            '0',
            '2'";
            if (!empty($_FILES['doc_perm1']['tmp_name'])) {
                $sqlPermiso .= ",'$doc_perm1'";
            }
            $sqlPermiso .= "
            , '$fecha',
            '0',
            '$mes')";
            $queryPermiso = $conexion->query($sqlPermiso);

            $sqlPer2 = "SELECT per.*, usu.nom_usu, usu.eml_usu FROM per_ingreso AS per
            INNER JOIN mq_usu AS usu
            ON per.id_usu = usu.id_usu
            ORDER BY per.id_per DESC LIMIT 1";
            $queryPer2 = $conexion->query($sqlPer2);
            $rPem = $queryPer2->fetch(PDO::FETCH_ASSOC);

            $sqlPermove = " INSERT INTO 
            per_ingre_x_mov
            (id_per,
            id_usu,
            id_estPer,
            fech_sis,
            id_are, 
            fech_aus1,
            mot_per)
            VALUES(
            '" . $rPem['id_per'] . "',
            '" . $_SESSION['id'] . "',
            '1',
            '$fecha',
            '" . $_SESSION['are'] . "',
            '" . $_POST['fec_ase1'] . "',
            '" . $_POST['mot_per1'] . "')";
            $queryPermove = $conexion->query($sqlPermove);

            $sqlPermove2 = " INSERT INTO 
            per_ingre_x_mov
            (id_per,
            id_usu,
            id_estPer,
            fech_sis,
            id_are, 
            fech_aus1,
            mot_per)
            VALUES(
            '" . $rPem['id_per'] . "',
            '" . $_SESSION['id'] . "',
            '2',
            '$fecha',
            '" . $_SESSION['are'] . "',
            '" . $_POST['fec_ase1'] . "',
            '" . $_POST['mot_per1'] . "')";
            $queryPermove2 = $conexion->query($sqlPermove2);

            if ($queryPermiso != null && $queryPermove != null && $queryPermove2 != null) {
                //echo $sqlPermiso;
                //echo $sqlPermove;
                echo "Permiso creado correctamente";
                
                if (isset($_SESSION['access_token'])) {
                    $event = new Event();
                    $event->newEvent($_POST['fec_ase1'], $_POST['fec_ase1'], $horaInicial, $horaFinal, "Permiso #" . $rPem['id_per'], "Master Quimica S.A.S", "Observaciones: Permiso " . $_POST['obs_per1'], $rPem['eml_usu']);
                }
            } else {
                printf("Errormessage: %s\n", $conexion->error);
            }

            include 'Email.php';

            break;

        case 'updatepermiso2':
            $horaIn = new DateTime($_POST['hora_ini1']);
            $horaFn = new DateTime($_POST['hora_fin1']);
            $horaTo = diferenciaHoras($horaIn, $horaFn);
            
            $horaInicial = $horaIn->format('H:i:s');
            $horaFinal = $horaFn->format('H:i:s');

            $sqlBus2 = "SELECT * FROM per_ingreso WHERE id_per=" . $_POST['id_per'];
            $queryBus2 = $conexion->query($sqlBus2);
            $r2 = $queryBus2->fetch(PDO::FETCH_ASSOC);
            $file = "../../documentos/permisos/";
            opendir($file);
            if (!empty($_FILES['doc_perm1']['tmp_name'])) {
                if (file_exists($file . $r2["doc_perm"])) {
                    unlink($file . $r2["doc_perm"]);
                }
                $doc_perm1 = $_FILES['doc_perm1']['name'];
                $destino1 = $file . $doc_perm1;
                copy($_FILES['doc_perm1']['tmp_name'], $destino1);
            }
            $sqlUpdate2 = "UPDATE per_ingreso SET 
                            fech_aus = '" . $_POST['fec_ase1'] . "',
                            fech_ini = '" . $horaInicial . "',
                            fech_fin = '" . $horaFinal . "',
                            hor_tot = '" . $horaTo . "',
                            mot_per  = '" . $_POST['mot_per1'] . "',
                            obser_perm  = '" . $_POST['obs_per1'] . "'";
            if (!empty($_FILES['doc_perm1']['tmp_name'])) {
                $sqlUpdate2 .= ", doc_perm = '$doc_perm1' ";
            }
            $sqlUpdate2 .= " , perEst_upd ='$fecha',
        id_mes='$mes'
        WHERE id_per='" . $_POST['id_per'] . "'";
            $queryUpdate2 = $conexion->query($sqlUpdate2);

            $sqlUp1 = "INSERT INTO 
        per_ingre_x_mov
        (id_per,
        id_usu,
        id_estPer,
        fech_sis,
        id_are, 
        fech_aus1,
        mot_per)
        VALUES(
        '" . $_POST['id_per'] . "',
        '" . $_SESSION['id'] . "',
        '5',
        '$fecha',
        '" . $_SESSION['are'] . "',
        '" . $_POST['fec_ase1'] . "',
        '" . $_POST['mot_per1'] . "')";
            $queryUp1 = $conexion->query($sqlUp1);

            $sqlUp2 = "INSERT INTO 
        per_ingre_x_mov
        (id_per,
        id_usu,
        id_estPer,
        fech_sis,
        id_are, 
        fech_aus1,
        mot_per)
        VALUES(
        '" . $_POST['id_per'] . "',
        '" . $_SESSION['id'] . "',
        '" . $r2['id_estPer'] . "',
        '$fecha',
        '" . $_SESSION['are'] . "',
        '" . $_POST['fec_ase1'] . "',
        '" . $_POST['mot_per1'] . "')";
            $queryUp2 = $conexion->query($sqlUp2);

            if ($queryUpdate2 != null &&  $queryUp1 != null && $queryUp2 != null) {
                // echo $sqlUpdate2;
                echo "Permiso  Actualizado Correctamente.";
            } else {
                printf("Errormessage: %s\n", $sqlUpdate2);
            }

            break;

        case 'password':
            $sqlPass = "SELECT con_usu FROM mq_usu WHERE id_usu=" . $_SESSION['id'];
            $queryPass = $conexion->query($sqlPass);
            $r = $queryPass->fetch(PDO::FETCH_ASSOC);
            if (password_verify($_POST["val_con"], $r['con_usu'])) {
                echo 1;
            } else {
                echo 2;
            }
            break;
        case 'usuario':
            $sqlUsua = "SELECT nom_usu, id_usu FROM mq_usu WHERE id_are=" . $_POST['value'];
            $queryUsua = $conexion->query($sqlUsua);
            if ($queryUsua->rowCount() > 0) {
                echo '<option>Seleccionar</option>';
                while ($r = $queryUsua->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value=" . $r['id_usu'] . ">" . ($r['nom_usu']) . "</option>";
                }
            }
            break;


        case 'updateEst':
            $sqlmov = " INSERT INTO 
        per_ingre_x_mov
        (id_per,
        id_usu,
        id_estPer,
        fech_sis,
        id_are)
        VALUES(
        '" . $_POST['idsesion'] . "',
        '" . $_SESSION['id'] . "',
        '" . $_POST['estado'] . "',
        '$fecha',
        '" . $_SESSION['are'] . "')";
            $querymov = $conexion->query($sqlmov);

            $sqlE = "UPDATE per_ingreso 
               SET id_estPer=" . $_POST['estado'];
            $sqlE .= " , perEst_upd='$fecha'
               WHERE id_per=" . $_POST['idsesion'];
            $queryE = $conexion->query($sqlE);
            if ($querymov != null && $queryE != null) {
                echo 1;
            } else {
                //echo $sqlE;
                echo 'No se pudo actualizar.';
            }
            include 'Email.php';
            break;

        case 'aceptado':
            $sqlAcept = "INSERT INTO
        per_ingre_x_mov
        (id_per,
        id_usu,
        id_estPer,
        fech_sis,
        id_are)
        VALUES(
        '" . $_POST['id'] . "',
        '" . $_SESSION['id'] . "',
        '0',
        '$fecha',
        '" . $_SESSION['are'] . "')";
            $queryAcept = $conexion->query($sqlAcept);

            $sqlAupd = "UPDATE per_ingreso 
                    SET   perEst_upd='$fecha',
                          revi_rec='1'
                  WHERE id_per=" . $_POST['id'];
            $queryAupd = $conexion->query($sqlAupd);

            if ($queryAcept != null || $queryAupd != null) {
                echo 1;
            } else {
                echo $sqlAupd;
                printf("Errormessage: %s\n", $conexion->error);
            }
            break;

        case 'updateObs':
            $sqlper = " UPDATE per_ingreso 
                  SET obs_talen=\"$_POST[obs_talen]\"
		    	  WHERE id_per=\"$_POST[id_per]\"";
            $queryper = $conexion->query($sqlper);
            if ($queryper != null) {
                echo 1;
            } else {
                echo 'No se pudo actualizar.';
                echo $sqlper;
            }
            break;

        case 'updatePer':
            $sqlper2 = " UPDATE per_ingreso 
                       SET id_mes=\"$_POST[id_mes]\"
                      WHERE id_per=\"$_POST[id_per]\"";
            $query2 = $conexion->query($sqlper2);

            if ($query2 != null) {
                echo 1;
            } else {
                echo 'No se pudo actualizar.';
                echo $sqlper2;
            }
            break;
    }
}
