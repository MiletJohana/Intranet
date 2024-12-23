<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';
if(isset($_POST['action'])){
    $action=$_POST['action'];
}elseif(isset($_GET['action'])){
    $action=$_GET['action'];
}
$mes= date('Y-m');
$sqlEmail="SELECT * FROM correspondencias AS cor
INNER JOIN mq_usu AS us
ON cor.id_usu = us.id_usu
INNER JOIN seg_estado AS es
ON cor.id_estSeg = es.id_estSeg
INNER JOIN seg_nomdoc AS nom
ON cor.id_nom = nom.id_nom
INNER JOIN mq_clientes cl
ON cor.id_prove=cl.id_cli
INNER JOIN mq_are AS ar
ON us.id_are = ar.id_are";
if ((isset($action) && $action == 'add')){
    $sqlEmail.= " ORDER BY cor.id_seg DESC limit 1 ";   
}else{
    $sqlEmail.= " WHERE cor.id_seg=" . $_POST['id_seg'];
}
$queryEmail=$conexion->query($sqlEmail);
$usuM=null;
$usuMRe=null;
$usuID=null;
//ECHO $sqlEmail;
//echo $var;
while($rM=$queryEmail-> fetch(PDO::FETCH_LAZY)){
    $usuM=$rM;
    break;
}

$sqlMailRe="SELECT * FROM mq_usu usu, mq_are are
WHERE usu.id_are = are.id_are
AND id_usu='$usuM->per_encarga'";
$queryMailRe=$conexion->query($sqlMailRe);
// echo $sqlMailRe;
while ($rMm=$queryMailRe-> fetch(PDO::FETCH_LAZY)){
    $usuMRe=$rMm;
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
// Datos para enviar y a quien se envia el correo 


if(isset($_POST['action'])){
    $action=$_POST['action'];
 }elseif(isset($_GET['action'])){
    $action=$_GET['action'];
 }
if($action == 'add'){
    $i=null;
    for($i=1;$i<=2;$i++){
        if($i==1){
            $mail->setFrom('correspondencia@masterquimica.com',  'Administrador Correspondencia');
            //$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
            $mail->addAddress($usuM->eml_usu, $usuM->nom_usu);

            //Mensaje del correo
            $mail->isHTML(true);
            $mail->Subject = 'Correspondencia'; //Asunto
            include 'body.php';
            if (!$mail->send()) {
                echo 'Error: ' . $mail->ErrorInfo;
            } else {
                //echo 'Enviado correctamente 1';  
            }
        }elseif($i==2){
            $mail->ClearAllRecipients();
            //$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
            $mail->setFrom($usuM->eml_usu, $usuM->nom_usu);
            $mail->addAddress($usuMRe->eml_usu, $usuMRe->nom_usu);

            //Mensaje del correo
            $mail->isHTML(true);
            $mail->Subject = 'Correspondencia'; //Asunto
            include 'body.php'; 
            if (!$mail->send()) {
                echo 'Error: ' . $mail->ErrorInfo;
            } else {
                //echo 'Enviado correctamente Admin';  
            }
        }
    }
}elseif($action =='updateRemit'){
      $i=null;
      for($i=3;$i<=4;$i++){
        if($i==3){
            $mail->setFrom( 'correspondencia@masterquimica.com',  'Administrador Correspondencia');
            //$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
            $mail->addAddress($usuM->eml_usu, $usuM->nom_usu);

            //Mensaje del correo
            $mail->isHTML(true);
            $mail->Subject = 'Correspondencia'; //Asunto
            include 'body.php';
            if (!$mail->send()) {
                echo 'Error: ' . $mail->ErrorInfo;
            } else {
                //echo 'Enviado correctamente 1';  
            }
        }elseif($i==4){
            $mail->ClearAllRecipients();
            //$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
            $mail->setFrom($usuM->eml_usu, $usuM->nom_usu);
            $mail->addAddress($usuMRe->eml_usu,  $usuMRe->nom_usu);

            //Mensaje del correo
            $mail->isHTML(true);
            $mail->Subject = 'Correspondencia'; //Asunto
            include 'body.php'; 
            if (!$mail->send()) {
                echo 'Error: ' . $mail->ErrorInfo;
            } else {
                //echo $sqlEmail.'<br>'.$sqlMailRem.'<br>'.$sqlMailRe;  
            }
        }
      }
 }elseif($action =='updateConta'){
        $i=null;
        for($i=5;$i<=6;$i++){
            if($i==5){
            $mail->setFrom( 'correspondencia@masterquimica.com',  'Administrador Correspondencia');
            //$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
            $mail->addAddress($usuMRem->eml_usu, $usuMRem->nom_usu);

            //Mensaje del correo
            $mail->isHTML(true);
            $mail->Subject = 'Correspondencia'; //Asunto
            include 'body.php';
            if (!$mail->send()) {
                echo 'Error: ' . $mail->ErrorInfo;
            } else {
                //echo 'Enviado correctamente 1';  
            }
        }elseif($i == 6){
            $mail->ClearAllRecipients();
            //$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
            $mail->setFrom( $usuMRe->eml_usu,  $usuMRe->nom_usu);
            $mail->addAddress( $ulti->eml_usu, $ulti->nom_usu);
            
            //Mensaje del correo
            $mail->isHTML(true);
            $mail->Subject = 'Correspondencia'; //Asunto
            include 'body.php'; 
            if (!$mail->send()) {
                echo 'Error: ' . $mail->ErrorInfo;
            } else {
                //echo 'Enviado correctamente Admin';  
            }
        }
    }
    }elseif($action == 'cargMasiv'){
        $i=null;
        for($i=7;$i<=8;$i++){
            if($i==7){
                $mail->setFrom('correspondencia@masterquimica.com',  'Administrador Correspondencia');
                //$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
                $mail->addAddress($usuMRem->eml_usu, $usuMRem->nom_usu);
                //Mensaje del correo
                $mail->isHTML(true);
                $mail->Subject = 'Correspondencia'; //Asunto
                include 'body.php';
                if (!$mail->send()) {
                    echo 'Error: ' . $mail->ErrorInfo;
                } else {
                    //echo 'Enviado correctamente 1';  
                }
    }elseif($i==8){
            $mail->ClearAllRecipients();
            //$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
            $mail->setFrom($usuMRem->eml_usu, $usuMRem->nom_usu);
            $mail->addAddress($usuMRe->eml_usu, $usuMRe->nom_usu);
            //Mensaje del correo
            $mail->isHTML(true);
            $mail->Subject = 'Correspondencia'; //Asunto
            include 'body.php'; 
            if (!$mail->send()) {
                echo 'Error: ' . $mail->ErrorInfo;
            } else {
                //echo 'Enviado correctamente Admin';  
            }
        }
    }
}
