<?php
include '../../resources/template/credentials.php';
$sqlEm = "SELECT corr.*, usu.eml_usu, cli.nom_cli
FROM crm_correos AS corr
INNER JOIN crm_transaccion AS tra
ON corr.id_tra = tra.id_tra
INNER JOIN negocios AS neg
ON tra.id_neg = neg.id_neg
INNER JOIN mq_clientes AS cli
ON cli.id_cli = neg.id_cli
INNER JOIN mq_usu AS usu
ON tra.id_usu = usu.id_usu
ORDER BY corr.id_correo DESC 
LIMIT 1";
$queryEm = $conexion->query($sqlEm);
//echo $sqlEm;
$correo = null;
while ($r = $queryEm->fetch_object()) {
    $correo = $r;
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

//$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
$mail->setFrom($correo->eml_usu,  $correo->asunto);

//$mail->addAddress($usu->destino);
//Mensaje del correo
$mail->isHTML(true);
$mail->Subject = $correo->asunto; //Asunto
include 'body.php';
if (!$mail->send()) {
    echo 'Error: ' . $mail->ErrorInfo;
} else {
    //echo 'Enviado correctamente Admin';  
}
