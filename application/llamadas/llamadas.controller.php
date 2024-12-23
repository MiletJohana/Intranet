<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';
if (isset($_SESSION['access_token'])) {
    include 'calendar.php';
}
if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'add':
            $sqlLlam = "INSERT INTO reg_llam
                (id_usu,
                id_rem, 
                ema_llamada, 
                ob_llam)
                VALUES
                ('$sesion_id',
                '" . $_POST['id_rem'] . "',
                '" . $_POST['correo'] . "',
                '" . $_POST['ob_llam'] . "')";
            $queryLlam = $conexion->query($sqlLlam);

            if ($queryLlam != null) {
                echo "Llamada Creada Correctamente";
                //echo $sqlLlam;
                if (isset($_SESSION['access_token'])) {
                    $sqlPer = "SELECT llam.*, us.nom_usu, DATE(llam.fec_llam) AS fecha, TIME(llam.fec_llam) AS hora
                    FROM reg_llam AS llam 
                    INNER JOIN mq_usu AS us 
                    ON llam.id_usu = us.id_usu 
                    INNER JOIN mq_are AS are 
                    ON us.id_are = are.id_are
                    ORDER BY llam.fec_llam DESC
                    LIMIT 1";
                    $queryPer = $conexion->query($sqlPer);
                    $rP = $queryPer->fetch_array();
                    $fecha = strtotime($rP['fec_llam']);
                    $hora2 = mktime(date("H", $fecha), date("i", $fecha) + 1, date("s", $fecha));
                    $hora2 = date("H:i:s", $hora2);
                    $event = new Event();
                    $event->newEvent($rP['fecha'], $rP['fecha'], $rP['hora'], $hora2, "Llamada #" . $rP['id_llama'], "Master Quimica S.A.S", "Llamada a: " . $rP['id_rem'] . " Observaciones: " . $rP['ob_llam'], $session_email);
                    $event->newEvent($rP['fecha'], $rP['fecha'], $rP['hora'], $hora2, "Llamada #" . $rP['id_llama'] . " de " . $rP['nom_usu'], "Master Quimica S.A.S", "Llamada a: " . $rP['id_rem'] . " Observaciones: " . $rP['ob_llam'], "masterquimica.com_e268m2ol5puhci9os8mat9i788@group.calendar.google.com");
                }
                if (isset($_POST['correo']) && $_POST['correo'] == 1) {
                    include 'Email.php';
                }
            } else {
                printf("<br>Errormessage: %s\n", $conexion->error);
                echo $sqlLlam;
            }
            break;

        case 'email':
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
            $sqlEm = " UPDATE `reg_llam` SET `ema_llamada`= '1'
                                        WHERE  `id_llama`=" . $_POST['id_llam'];
            $queryEm = $conexion->query($sqlEm);

            include 'Email.php';
            if ($queryEm != null) {
                echo '<div align="center">
                                <br> El registro de llamada a sido enviada correctamente. <br><br>
                            </div>';
            } else {
                echo '<div align="center">
                                <br> Ocurrió algo inesperado: SQL: <br><br>
                            </div>' . $sqlEm;
            }
            break;
    }
}
