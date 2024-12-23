<?php
include '../../resources/template/credentials.php';
$sqlEm = "SELECT llam.id_llama, llam.id_usu, llam.id_rem, llam.ema_llamada,
llam.ob_llam, llam.fec_llam, us.nom_usu, us.eml_usu
FROM mq_usu AS us
INNER JOIN reg_llam AS llam
ON us.id_usu=llam.id_usu
ORDER BY llam.id_llama DESC 
LIMIT 1";
$queryEm = $conexion->query($sqlEm);
//echo $sqlEm;
$usu = null;
$rem = null;
while ($r = $queryEm->fetch_object()) {
    $usu = $r;
    break;
}

$sqlrem = "SELECT us.eml_usu, us.nom_usu
FROM mq_usu AS us
WHERE us.id_usu = $usu->id_rem";
//echo $sqlrem;
$queryrem = $conexion->query($sqlrem);
while ($rM = $queryrem->fetch_object()) {
    $rem = $rM;
    break;
}

//require 'phpmailer/PHPMailerAutoload.php';
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
$i = null;
for ($i = 1; $i <= 2; $i++) {
    if ($i == 1) {
        //$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
        $mail->setFrom('',  '');
        $mail->addAddress($usu->eml_usu, $usu->nom_usu);

        //Mensaje del correo
        $mail->isHTML(true);
        $mail->Subject = 'Llamadas'; //Asunto
        include 'body.php';
        if (!$mail->send()) {
            echo 'Error: ' . $mail->ErrorInfo;
        } else {
            //echo 'Enviado correctamente Admin';  
        }
    } elseif ($i == 2) {
        $mail->ClearAllRecipients();
        $mail->setFrom('',  '');
        //$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
        $mail->addAddress($rem->eml_usu, $rem->nom_usu);
        
        //Mensaje del correo
        $mail->isHTML(true);
        $mail->Subject = 'Llamadas'; //Asunto
        include 'body.php';
        if (!$mail->send()) {
            echo 'Error: ' . $mail->ErrorInfo;
        } else {
            //echo 'Enviado correctamente 1';  
        }
    }
}
