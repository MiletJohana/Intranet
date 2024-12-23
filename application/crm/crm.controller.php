<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';
date_default_timezone_set("America/Bogota");
if (isset($_SESSION['access_token'])) {
    include 'calendar.php';
    include 'gmail.php';
}
function validar($value)
{
    if ($value == '' || is_null($value)) {
        return 'NULL';
    } else {
        return $value;
    }
}

function etapa($value)
{
    if ($value == 1) {
        return 'Si';
    } else {
        return 'No';
    }
}

function estado($value)
{
    if ($value == 1) {
        return '4';
    } else {
        return '3';
    }
}
if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'addNegocio':
            $sqlAddNeg = "INSERT INTO negocios
                (des_neg,
                val_neg,
                pot_crea,
                cont_rea,
                visi_rea,
                cot_soli,
                ped_rea,
                id_est,
                id_tipo, 
                id_usu,
                id_cli,
                fec_ini,
                fec_fin)
                VALUES
                ('" . $_POST['des_neg'] . "', 
                '" . $_POST['val_neg'] . "', 
                '" . etapa($_POST['pot_crea']) . "',
                '" . etapa($_POST['cont_rea']) . "',
                '" . etapa($_POST['visi_rea']) . "',
                '" . etapa($_POST['cot_soli']) . "',
                '" . etapa($_POST['ped_rea']) . "',
                '" . estado($_POST['neg_per']) . "',
                " . validar($_POST['id_tipo']) . ",
                '$sesion_id',
                " . $_POST['id_cli'] . ",
                '" . $_POST['fec_ini'] . "', 
                '" . $_POST['fec_fin'] . "')";
            $queryAddNeg = $conexion->query($sqlAddNeg);

            $sqlLstNeg = "SELECT * FROM negocios
            ORDER BY id_neg DESC
            LIMIT 1";
            $queryLstNeg = $conexion->query($sqlLstNeg);
            $rL = $queryLstNeg->fetch_array();

            $sqlCat = "SELECT * FROM cot_categoria";
            $queryCat = $conexion->query($sqlCat);
            for ($i = 0; $i < $queryCat->rowCount(); $i++) {
                if ($_POST['tip-' . $i] != 0) {
                    $sqlAddCat = "INSERT INTO cat_x_neg 
                    (id_cat,
                    id_neg)
                    VALUES
                    (" . $_POST['tip-' . $i] . ", "
                        . $rL['id_neg'] . ")";
                    $queryAddCat = $conexion->query($sqlAddCat);
                }
            }

            if ($queryAddNeg != null) {
                echo "Negocio creado correctamente";
            } else {
                printf("Errormessage: %s\n", $conexion->error);
                echo $sqlAddNeg;
            }
            break;
        case 'uptNegocio':
            $sqlUptNeg = "UPDATE negocios
                SET des_neg = '" . $_POST['des_neg'] . "',
                obs_neg = '" . $_POST['obs_neg'] . "', 
                val_neg = '" . $_POST['val_neg'] . "', 
                pot_crea = '" . etapa($_POST['pot_crea']) . "',
                cont_rea = '" . etapa($_POST['cont_rea']) . "',
                visi_rea = '" . etapa($_POST['visi_rea']) . "',
                cot_soli = '" . etapa($_POST['cot_soli']) . "',
                ped_rea = '" . etapa($_POST['ped_rea']) . "',
                id_est = " . $_POST['id_est'] . ",
                id_tipo = " . $_POST['id_tipo'] . ",
                fec_ini = '" . $_POST['fec_ini'] . "',
                fec_fin = '" . $_POST['fec_fin'] . "'
                WHERE id_neg = " . $_POST['id_neg'] . "";
            $queryUptNeg = $conexion->query($sqlUptNeg);

            //acutalizar categorías de producto
            $sqlDelCat = "DELETE FROM cat_x_neg WHERE id_neg = " . $_POST['id_neg'];
            $queryDelCat = $conexion->query($sqlDelCat);

            $sqlCat = "SELECT * FROM cot_categoria";
            $queryCat = $conexion->query($sqlCat);
            for ($i = 0; $i < $queryCat->rowCount(); $i++) {
                if ($_POST['tip-' . $i] != 0) {
                    $sqlAddCat = "INSERT INTO cat_x_neg 
                    (id_cat,
                    id_neg)
                    VALUES
                    (" . $_POST['tip-' . $i] . ", "
                        . $_POST['id_neg'] . ")";
                    $queryAddCat = $conexion->query($sqlAddCat);
                }
            }

            if ($queryUptNeg != null) {
                echo "Negocio editado correctamente";
            } else {
                printf("Errormessage: %s\n", $conexion->error);
                echo $sqlUptNeg;
            }
            break;
        case 'addTransaccion':
            $sqlAddTra = "INSERT INTO crm_transaccion
                (id_usu,
                id_tipo,
                id_neg,
                id_cli)
                VALUES
                ('$sesion_id',
                " . $_POST['tip_tran'] . ",
                " . $_POST['id_neg'] . ",
                " . $_POST['id_cli'] . ")";
            $queryAddTra = $conexion->query($sqlAddTra);

            $sqlLast = "SELECT * FROM crm_transaccion
            ORDER BY id_tra DESC
            LIMIT 1";
            $queryLast = $conexion->query($sqlLast);
            $rL = $queryLast->fetch_array();

            if ($_POST['tip_tran'] == 1) {
                //insertar correo y enviar correo
                $sqlAdd = "INSERT INTO crm_correos
                    (id_tra,
                    destino,
                    asunto,
                    cuerpo)
                    VALUES
                    (" . $rL['id_tra'] . ",
                    '" . $_POST['destino'] . "',
                    '" . $_POST['asunto'] . "',
                    '" . $_POST['cuerpo'] . "')";
                if (isset($_SESSION['access_token'])) {
                    $mail = new Mail();
                    $message = $mail->createMessage($session_email, $_POST['destino'], $_POST['asunto'], $_POST['cuerpo']);
                    $mail->sendMessage("me", $message);
                }
            } else if ($_POST['tip_tran'] == 2) {
                //insertar nota
                $sqlAdd = "INSERT INTO crm_notas
                    (id_tra,
                    titulo,
                    contenido)
                    VALUES
                    (" . $rL['id_tra'] . ",
                    '" . $_POST['titulo'] . "',
                    '" . $_POST['contenido'] . "')";
            } else if ($_POST['tip_tran'] == 3) {
                //insertar recordatorio y enviar evento en calendar
                $sqlAdd = "INSERT INTO crm_recordatorios
                    (id_tra,
                    fecha_recorda,
                    asunto)
                    VALUES
                    (" . $rL['id_tra'] . ",
                    '" . $_POST['fecha_recorda'] . " " . $_POST['hora_recorda'] . "',
                    '" . $_POST['asunto'] . "')";

                if (isset($_SESSION['access_token'])) {
                    $fecha = date("Y-m-d", strtotime($_POST['fecha_recorda']));
                    $horas = date("H:i:s", strtotime($_POST['hora_recorda']));
                    $hora2 = date("H:i:s", mktime(date("H", strtotime($_POST['hora_recorda'])), date("i", strtotime($_POST['hora_recorda'])) + 1, date("s", strtotime($_POST['hora_recorda'])), 0, 0, 0));

                    $event = new Event();
                    $recordar = "Recordar: " . $_POST['asunto'];
                    $event->newReminder($fecha, $fecha, $horas, $hora2, $recordar, "Master Quimica S.A.S", $recordar, $session_email);
                }
            } else if ($_POST['tip_tran'] == 4) {
                //insertar llamada y enviar evento en calendar
                $sqlAdd = "INSERT INTO crm_llamadas
                    (id_tra,
                    destino,
                    agendar,
                    observacion)
                    VALUES
                    (" . $rL['id_tra'] . ",
                    '" . $_POST['destino'] . "',
                    '" . $_POST['agendar'] . "',
                    '" . $_POST['observacion'] . "')";
                if (isset($_SESSION['access_token']) && (isset($_POST['agendar']) && $_POST['agendar'] == 1)) {
                    $fecha = date("Y-m-d");
                    $horas = date("H:i:s");
                    $hora2 = date("H:i:s", mktime(date("H"), date("i") + 1, date("s"), 0, 0, 0));

                    $event = new Event();
                    $recordar = "Llamada a: " . $_POST['destino'];
                    $event->newEvent($fecha, $fecha, $horas, $hora2, $recordar, "Master Quimica S.A.S", $recordar, $session_email);
                }
            }
            $queryAdd = $conexion->query($sqlAdd);
            if ($queryAddTra != null && $queryAdd != null) {
                echo "Transaccion Creada Correctamente";
            } else {
                printf("<br>Errormessage: %s\n", $conexion->error);
                echo $sqlAddTra;
                echo "<br>" . $sqlAdd;
            }
            break;

        case 'uptTransaccion':
            break;
        case 'dltTransaccion':
            break;
    }
}
