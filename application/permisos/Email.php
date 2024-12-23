<?php
include '../../resources/template/credentials.php';
$sqlEm = "SELECT * FROM mq_usu us, per_estado es, per_ingreso per, per_motivo mot
WHERE us.id_usu=per.id_usu
AND per.id_estPer=es.id_estPer
AND per.mot_per=mot.mot_per";
if ((isset($_POST['action']) && $_POST['action'] == 'permiso' || $_POST['action'] == 'permiso2')) {
    $sqlEm .= " ORDER BY per.id_per DESC limit 1";
} elseif ((isset($_POST['action']) && $_POST['action'] == 'updateEst')) {
    $sqlEm .= " AND per.id_per=" . $_POST['idsesion'];
} else {
    $sqlEm .= " AND per.id_per=" . $_POST['id_per'];
}
$queryEm = $conexion->query($sqlEm);
//echo $sqlEm;
$usu = null;
$lid = null;
$adm = null;
while ($r = $queryEm->fetch(PDO::FETCH_OBJ)) {
    $usu = $r;
    break;
}

$sqlAdmin = "SELECT * FROM mq_usu us, per_estado es, per_ingreso per, per_motivo mot
WHERE per.usu_perm=us.id_usu
AND per.id_estPer=es.id_estPer
AND per.mot_per=mot.mot_per";
if ((isset($_POST['action']) && $_POST['action'] == 'permiso' || $_POST['action'] == 'permiso2')) {
    $sqlAdmin .= " ORDER BY per.id_per DESC limit 1";
} elseif ((isset($_POST['action']) && $_POST['action'] == 'updateEst')) {
    $sqlEm .= "AND per.id_per=" . $_POST['idsesion'];
} else {
    $sqlAdmin .= " AND per.id_per=" . $_POST['id_per'];
}
//echo $sqlAdmin;
$queryAdmin = $conexion->query($sqlAdmin);
while ($rA = $queryAdmin->fetch(PDO::FETCH_OBJ)) {
    $adm = $rA;
}

$sqlLid = "SELECT us.eml_usu, us.nom_usu
FROM mq_usu us
WHERE us.id_usu=$usu->id_lider";
//echo $sqlLid;
$queryLid = $conexion->query($sqlLid);
while ($rL = $queryLid->fetch(PDO::FETCH_OBJ)) {
    $lid = $rL;
    break;
}


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../resources/utils/phpmailer/vendor/autoload.php';


$mail = new PHPMailer();
//Datos necesarios para que funcione el envío de correo

$mail->SMTPDebug = 0;
$mail->Host = 'masterquimica.com';
$mail->SMTPSecure = 'ssl';
$mail->CharSet = 'UTF-8';
$mail->Port = 465;
$mail->SMTPAuth = true;
$mail->isSMTP();
$mail->Username = 'milet.ruiz@masterquimica.com';
$mail->Password = 'itMR.2019';

//CASO DE USUARIO
if ($_POST['action'] == 'permiso2') {
    $i = null;
    for ($i = 1; $i <= 2; $i++) {
        if ($i == 1) {
            //$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
            $mail->setFrom('permisos@masterquimica.com',  'Administrador Permisos');
            $mail->addAddress($usu->eml_usu, $usu->nom_usu);

            //Mensaje del correo
            $mail->isHTML(true);
            $mail->Subject = 'Permiso'; //Asunto
            include 'contEmail.php';
            if (!$mail->send()) {
                echo 'Error: ' . $mail->ErrorInfo;
            } else {
                //echo 'Enviado correctamente Admin';  
            }
        } elseif ($i == 2) {
            $mail->ClearAllRecipients();
            $mail->setFrom('permisos@masterquimica.com',  'Administrador Permisos');
            $mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
            $mail->addAddress($lid->eml_usu, $lid->nom_usu);

            //Mensaje del correo
            $mail->isHTML(true);
            $mail->Subject = 'Permiso'; //Asunto
            include 'contEmail.php';
            if (!$mail->send()) {
                echo 'Error: ' . $mail->ErrorInfo;
            } else {
                //echo 'Enviado correctamente 1';  
            }
        }
    }
} elseif ($_POST['action'] == 'permiso') { // CASO DE RECURSOS HUMANOS O ADMIN CREAR EL PERMISO 
    $i = null;
    for ($i = 3; $i <= 4; $i++) {
        if ($i == 3) {
            //$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
            $mail->setFrom('permisos@masterquimica.com',  'Administrador Permisos');
            $mail->addAddress($adm->eml_usu, $adm->nom_usu);

            //Mensaje del correo
            $mail->isHTML(true);
            $mail->Subject = 'Permiso'; //Asunto
            include 'contEmail.php';
            if (!$mail->send()) {
                echo 'Error: ' . $mail->ErrorInfo;
            } else {
                //echo 'Enviado correctamente Admin';  
            }
        } elseif ($i == 4) {
            $mail->ClearAllRecipients();
            $mail->setFrom('permisos@masterquimica.com',  'Administrador Permisos');
            $mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
            $mail->addAddress($usu->eml_usu, $usu->nom_usu);

            //Mensaje del correo
            $mail->isHTML(true);
            $mail->Subject = 'Permiso'; //Asunto
            include 'contEmail.php';
            if (!$mail->send()) {
                echo 'Error: ' . $mail->ErrorInfo;
            } else {
                //echo 'Enviado correctamente 1';  
            }
        }
    }
} elseif ($_POST['action'] == 'updateEst') {
    $i = null;
    for ($i = 5; $i <= 6; $i++) {
        if ($i == 5) {
            //$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
            $mail->setFrom('permisos@masterquimica.com',  'Administrador Permisos');
            $mail->addAddress($lid->eml_usu, $lid->nom_usu);

            //Mensaje del correo
            $mail->isHTML(true);
            $mail->Subject = 'Permiso'; //Asunto
            include 'contEmail.php';
            if (!$mail->send()) {
                echo 'Error: ' . $mail->ErrorInfo;
            } else {
                //echo 'Enviado correctamente Admin';  
            }
        } elseif ($i == 6) {
            $mail->ClearAllRecipients();
            $mail->setFrom('permisos@masterquimica.com',  'Administrador Permisos');
            $mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
            $mail->addAddress($usu->eml_usu, $usu->nom_usu);
            
            //Mensaje del correo
            $mail->isHTML(true);
            $mail->Subject = 'Permiso'; //Asunto
            include 'contEmail.php';
            if (!$mail->send()) {
                echo 'Error: ' . $mail->ErrorInfo;
            } else {
                //echo 'Enviado correctamente 1';  
            }
        }
    }
}
