<?php
include '../../resources/template/credentials.php';
$sqlComer1 = "SELECT com.eml_con, com.nom_con, com.obs_agen, us.nom_usu, us.eml_usu, us.id_car, us.ext_usu, tip.nom_car, com.id_agen, com.concl_agen, 
DATE_FORMAT(fec_cre, '%a %d %b %Y') AS fec_cre
FROM agen_comerciales com , mq_usu us , cot_tip_cotizador tip
WHERE com.id_usu=us.id_usu 
AND  us.id_car=tip.id_car";
if ((isset($_POST['action']) && $_POST['action'] == 'update')) {
    $sqlComer1 .= " AND com.id_agen=" . $_POST['id_agen'];
} else {
    $sqlComer1 .= " AND com.id_agen=" . $_POST['id_agen'];
}
$queryComer1 = $conexion->query($sqlComer1);
//echo $sqlComer1;
$com = null;
$cli = null;
$sac = null;
while ($r = $queryComer1->fetch(PDO::FETCH_OBJ)) {
    $com = $r;
    break;
}

$sqlCli = "SELECT nom_cli , tel_cli 
FROM mq_clientes cli, agen_comerciales com 
WHERE com.id_cli=cli.id_cli";
if ((isset($_POST['action']) && $_POST['action'] == 'update')) {
    $sqlCli .= " AND com.id_cli=" . $_POST['id_cli'];
    $sqlCli .= " GROUP BY com.id_cli";
} else {
    $sqlCli .= " AND com.id_cli=" . $_POST['id_cli'];
    $sqlCli .= " GROUP BY com.id_cli";
}
$queryCli = $conexion->query($sqlCli);
//echo $sqlCli;
while ($r3 = $queryCli->fetch(PDO::FETCH_OBJ)) {
    $cli = $r3;
    break;
}

$sqlSac2 = "SELECT us.nom_usu, us.eml_usu 
FROM agen_comerciales com , mq_usu us 
WHERE com.id_sac=us.id_usu ";
if ((isset($_POST['action']) && $_POST['action'] == 'update')) {
    $sqlSac2 .= " AND com.id_agen=" . $_POST['id_agen'];
    $sqlSac2 .= " GROUP BY com.id_agen";
} else {
    $sqlSac2 .= " AND com.id_agen=" . $_POST['id_agen'];
    $sqlSac2 .= " GROUP BY com.id_agen";
}
$querySac2 = $conexion->query($sqlSac2);
//echo $sqlSac2;

$sac = null;
while ($r2 = $querySac2->fetch(PDO::FETCH_OBJ)) {
    $sac = $r2;
    break;
}
$sqlGe="SELECT us.nom_usu, us.eml_usu 
        FROM agen_comerciales com , mq_usu us
        WHERE us.id_carg = 103 
        AND us.usu_elim= 0 
        GROUP BY us.id_usu";
$queryGe = $conexion->query($sqlGe);
$Gen=null;
while ($rGe = $queryGe->fetch(PDO::FETCH_OBJ)){
    $Gen = $rGe;
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

if ($_POST['action'] == 'update') {
    $i = null;
    if($_POST['correo']==1){
    for ($i = 1; $i <= 2; $i++) { 
        if ($i == 1) {
            //$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
            $mail->setFrom($com->eml_usu,   $com->nom_usu);
            $mail->addAddress($com->eml_con, $com->nom_con);
            $mail->addAddress($com->eml_con, $com->nom_con);

            //Mensaje del correo
            $mail->isHTML(true);
            $mail->Subject = "Contacto Comercial $cli->nom_cli "; //Asunto
            include 'contentEma.php';
            if (!$mail->send()) {
                echo 'Error: ' . $mail->ErrorInfo;
            } else {
                //echo 'Enviado correctamente Admin';  
            }
        } elseif ($i == 2) {
                $mail->ClearAllRecipients();
                $mail->setFrom($com->eml_usu,  $com->nom_usu);
                $mail->addAddress($com->eml_usu,  $com->nom_usu);
                $mail->addAddress($sac->eml_usu, $sac->nom_usu);
                $mail->addAddress($Gen->eml_usu, $Gen->nom_usu);

                //Mensaje del correo
                $mail->isHTML(true);
                $mail->Subject = "Contacto Comercial $cli->nom_cli "; //Asunto
                include 'contentEma.php';
                if (!$mail->send()) {
                    echo 'Error: ' . $mail->ErrorInfo;
                } else {
                    //echo 'Enviado correctamente 1';  
                }
            }
        }
    } else{
    for ($i = 2; $i <= 2; $i++) { 
            if ($i == 2) {
            $mail->ClearAllRecipients();
            $mail->setFrom($com->eml_usu,  $com->nom_usu);
            $mail->addAddress($com->eml_usu,  $com->nom_usu);
            $mail->addAddress($sac->eml_usu, $sac->nom_usu);
            $mail->addAddress($Gen->eml_usu, $Gen->nom_usu);
            
            //Mensaje del correo
            $mail->isHTML(true);
            $mail->Subject = "Contacto Comercial $cli->nom_cli "; //Asunto
            include 'contentEma.php';
            if (!$mail->send()) {
                echo 'Error: ' . $mail->ErrorInfo;
            } else {
                //echo 'Enviado correctamente 1';  
            }
        }
    }
}
}
