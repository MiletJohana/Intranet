<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';
$sqlEmil="SELECT us.eml_usu,us.nom_usu,us.id_rol,est.id_est,est.nom_est,sol.id_sol
 FROM mq_usu us, cre_estadosol est,cre_solicitud sol
 WHERE us.id_usu=sol.id_usu
 AND sol.id_est=est.id_est
 AND us.id_usu=".$_SESSION['id'];
 $queryEmil=$conexion->query($sqlEmil);
 $usuM=null;
 $usuMRem=null;
 $usuMRe=null;
 $nom=null;
 while ($rM=$queryEmil-> fetch(PDO::FETCH_OBJ)){
    $usuM=$rM;
    break;
 }
 $sqlNom="SELECT us.nom_usu,us.eml_usu
FROM mq_usu us, cre_solicitud sol
WHERE sol.id_usu=us.id_usu";
$queryNom=$conexion->query($sqlNom);
while ($r=$queryNom-> fetch(PDO::FETCH_OBJ)){
    $nom=$r;
    break;
}
 $sqlMailRem="SELECT us.nom_usu, us.eml_usu
 FROM mq_usu us
 WHERE id_rol=200";
 $queryMailRem=$conexion->query($sqlMailRem);
 $queryMailRem1=$conexion->query($sqlMailRem);
 while ($rMe=$queryMailRem-> fetch(PDO::FETCH_OBJ)){
    $usuMRem=$rMe;
    break;
 }
 $sqlMailRe="SELECT us.nom_usu, us.eml_usu 
 FROM mq_usu us
 WHERE id_rol=300";
 $queryMailRe=$conexion->query($sqlMailRe);
 $queryMailRe1=$conexion->query($sqlMailRe);
 while ($rMm=$queryMailRe-> fetch(PDO::FETCH_OBJ)){
    $usuMRe=$rMm;
    break;
}
$sqlsac="SELECT sol.id_sol, sol.id_usu ,sol.id_est,es.nom_est
FROM cre_solicitud sol, cre_estadosol es
WHERE sol.id_est=es.id_est";
if((isset($_POST['action']) && $_POST['action']=='add')){
 $sqlsac.=" ORDER BY sol.id_sol DESC";
}else{
 $sqlsac.=" AND sol.id_sol=".$_POST['id_sol'];
}
$querysac=$conexion->query($sqlsac);
while($rSac=$querysac-> fetch(PDO::FETCH_OBJ)){
    $sac=$rSac;
    break;
}
$sqlUsac="SELECT us.eml_usu, us.nom_usu, us.id_rol
FROM mq_usu us
WHERE us.id_usu=$rSac->id_usu";
$queryUsac=$conexion->query($sqlUsac);
while ($rUsac=$queryUsac-> fetch(PDO::FETCH_OBJ)){
    $usac=$rUsac;
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
// Datos para enviar y a quien se envia el correo 
if($_POST['action']=='add'){
    $i=null;
    for($i=1;$i<=2;$i++){
        if($i==1){
            $mail->setFrom($usuMRem->eml_usu, $usuMRem->nom_usu);
            //$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
            $mail->addAddress($usac->eml_usu, $usac->nom_usu);
            $mail->AddAddress('milet.ruiz@masterquimica.com', 'Milet Ruiz');

            //Mensaje del correo
            $mail->isHTML(true);
            $mail->Subject = 'Solicitud de Crédito'; //Asunto
            include 'body.php';
            if (!$mail->send()) {
                echo $usuMRem->eml_usu, $usuMRem->nom_usu;
                echo $usac->eml_usu, $usac->nom_usu; // echo 'Error: ' . $mail->ErrorInfo;
            } else {
                //echo 'Enviado correctamente 1';  
            }
        }elseif($i==2){
            $mail->ClearAllRecipients();
            //$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
            $mail->setFrom($usac->eml_usu, $usac->nom_usu);
            $mail->addAddress($usuMRem->eml_usu, $usuMRem->nom_usu);
            $mail->AddAddress('milet.ruiz@masterquimica.com', 'Milet Ruiz');
             
            //Mensaje del correo
            $mail->isHTML(true);
            $mail->Subject = 'Solicitud de Crédito'; //Asunto
            include 'body.php'; 
            if (!$mail->send()) {
                echo 'Error: ' . $mail->ErrorInfo;
            } else {
                //echo 'Enviado correctamente Admin';  
            }
        }
    }
}elseif($_POST['action']=='update'){
    $i=null;
    for($i=3;$i<=4;$i++){
        if($i==3){
            $mail->setFrom($usuMRe->eml_usu, $usuMRe->nom_usu);
            //$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
            $mail->addAddress($usuMRem->eml_usu, $usuMRem->nom_usu);
            $mail->AddAddress('milet.ruiz@masterquimica.com', 'Milet Ruiz');
        
            //Mensaje del correo
            $mail->isHTML(true);
            $mail->Subject = 'Solicitud de Crédito'; //Asunto
            include 'body.php';
            if (!$mail->send()) {
                echo 'Error: ' . $mail->ErrorInfo;
            } else {
                //echo 'Enviado correctamente 1';  
            }
        }elseif($i==4){
            $mail->ClearAllRecipients();
            //$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
            $mail->setFrom($usuMRem->eml_usu, $usuMRem->nom_usu);
            $mail->AddAddress('milet.ruiz@masterquimica.com', 'Milet Ruiz');

            /*while ($rMm1= $queryMailRe1->fetch(PDO::FETCH_ASSOC)){
                $mail->addAddress($rMm1['eml_usu']);
            }*/
            //Mensaje del correo
            $mail->isHTML(true);
            $mail->Subject = 'Solicitud de Crédito'; //Asunto
            include 'body.php'; 
            if (!$mail->send()) {
                echo 'Error: ' . $mail->ErrorInfo;
            } else {
                //echo 'Enviado correctamente Admin';  
            }
        }
    }
    
    }elseif($_POST['action']=='updateAprob'){
        
        $i=null;
        for($i=5;$i<=6;$i++){
            if($i==5){
                $mail->setFrom($usac->eml_usu, $usac->nom_usu);
                //$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
                $mail->addAddress($usuMRe->eml_usu, $usuMRe->nom_usu);
                $mail->AddAddress('milet.ruiz@masterquimica.com', 'Milet Ruiz');

                //Mensaje del correo
                $mail->isHTML(true);
                $mail->Subject = 'Solicitud de Crédito'; //Asunto
                include 'body.php';
                if (!$mail->send()) {
                    echo 'Error: ' . $mail->ErrorInfo;
                } else {
                    //echo 'Enviado correctamente 1';  
                }
            }elseif($i==6){
                $mail->ClearAllRecipients();
                $mail->setFrom($usuMRe->eml_usu, $usuMRe->nom_usu);
                //$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
                $mail->addAddress($usuMRem->eml_usu, $usuMRem->nom_usu);
                $mail->addAddress($usac->eml_usu, $usac->nom_usu);
                $mail->AddAddress('milet.ruiz@masterquimica.com', 'Milet Ruiz');

                //}
                //Mensaje del correo
                $mail->isHTML(true);
                $mail->Subject = 'Solicitud de Crédito'; //Asunto
                include 'body.php'; 
                if (!$mail->send()) {
                    echo 'Error: ' . $mail->ErrorInfo;
                } else {
                    //echo 'Enviado correctamente Admin';  
                }
            }
        }
        
    }elseif($_POST['action']=='rechazar'){
        $i=null;
        for($i=7;$i<=8;$i++){
            if($i==7){
                $mail->setFrom($usac->eml_usu, $usac->nom_usu);
                //$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
                $mail->addAddress($usuMRe->eml_usu, $usuMRe->nom_usu);
                $mail->AddAddress('milet.ruiz@masterquimica.com', 'Milet Ruiz');

                //Mensaje del correo
                $mail->isHTML(true);
                $mail->Subject = 'Solicitud de Crédito'; //Asunto
                include 'body.php';
                if (!$mail->send()) {
                    echo 'Error: ' . $mail->ErrorInfo;
                } else {
                    //echo 'Enviado correctamente 1';  
                }
            }elseif($i==8){
                $mail->ClearAllRecipients();
                
                $mail->setFrom($usuMRe->eml_usu, $usuMRe->nom_usu);
                 //$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
                $mail->addAddress($usuMRem->eml_usu, $usuMRem->nom_usu);
                $mail->addAddress($usac->eml_usu, $usac->nom_usu);
                $mail->AddAddress('milet.ruiz@masterquimica.com', 'Milet Ruiz');

                //Mensaje del correo
                $mail->isHTML(true);
                $mail->Subject = 'Solicitud de Crédito'; //Asunto
                include 'body.php'; 
                if (!$mail->send()) {
                    echo 'Error: ' . $mail->ErrorInfo;
                } else {
                    //echo 'Enviado correctamente Admin';  
                }
            }
        }
    }elseif($_POST['action']=='edicion'){
        $i=null;
        for($i=9;$i<=10;$i++){
            if($i==9){
                $mail->setFrom($usac->eml_usu, $usac->nom_usu);
                //$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
                $mail->addAddress($usuMRe->eml_usu, $usuMRe->nom_usu);
                $mail->AddAddress('milet.ruiz@masterquimica.com', 'Milet Ruiz');

                //Mensaje del correo
                $mail->isHTML(true);
                $mail->Subject = 'Solicitud de Crédito'; //Asunto
                include 'body.php';
                if (!$mail->send()) {
                    echo 'Error: ' . $mail->ErrorInfo;
                } else {
                    //echo 'Enviado correctamente 1';  
                }
            }elseif($i==10){
                $mail->ClearAllRecipients();
                $mail->setFrom($usuMRe->eml_usu, $usuMRe->nom_usu);
                //$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
                $mail->addAddress($usac->eml_usu, $usac->nom_usu);
                $mail->addAddress($usuMRem->eml_usu, $usuMRem->nom_usu);
                $mail->AddAddress('milet.ruiz@masterquimica.com', 'Milet Ruiz');

                //Mensaje del correo
                $mail->isHTML(true);
                $mail->Subject = 'Solicitud de Crédito'; //Asunto
                include 'body.php'; 
                if (!$mail->send()) {
                    echo 'Error: ' . $mail->ErrorInfo;
                } else {
                    //echo 'Enviado correctamente Admin';  
                }
            }
        }
    }elseif($_POST['action']=='edicion2'){
        $i=null;
        for($i=11;$i<=12;$i++){
            if($i==11){
                $mail->setFrom($usuMRem->eml_usu, $usuMRem->nom_usu);
                //$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
                $mail->addAddress($usuMRe->eml_usu, $usuMRe->nom_usu);
                $mail->AddAddress('milet.ruiz@masterquimica.com', 'Milet Ruiz');

                //Mensaje del correo
                $mail->isHTML(true);
                $mail->Subject = 'Solicitud de Crédito'; //Asunto
                include 'body.php';
                if (!$mail->send()) {
                    echo 'Error: ' . $mail->ErrorInfo;
                } else {
                    //echo 'Enviado correctamente 1';  
                }
            }elseif($i==12){
                $mail->ClearAllRecipients();
                $mail->setFrom($usuMRe->eml_usu, $usuMRe->nom_usu);
                 //$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
                $mail->addAddress($usuMRem->eml_usu, $usuMRem->nom_usu);
                $mail->addAddress($usac->eml_usu, $usac->nom_usu);
                $mail->AddAddress('milet.ruiz@masterquimica.com', 'Milet Ruiz');
                
                //Mensaje del correo
                $mail->isHTML(true);
                $mail->Subject = 'Solicitud de Crédito'; //Asunto
                include 'body.php'; 
                if (!$mail->send()) {
                    echo 'Error: ' . $mail->ErrorInfo;
                } else {
                    //echo 'Enviado correctamente Admin';  
                }
            }
        }
    }elseif($_POST['action']=='actualizacionForm1'){
        $i=null;
        for($i=13;$i<=14;$i++){
            if($i==13){
                $mail->setFrom($usuMRem->eml_usu, $usuMRem->nom_usu);
                //$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
                $mail->addAddress($usac->eml_usu, $usac->nom_usu);
                $mail->AddAddress('milet.ruiz@masterquimica.com', 'Milet Ruiz');

                //Mensaje del correo
                $mail->isHTML(true);
                $mail->Subject = 'Solicitud de Crédito'; //Asunto
                include 'body.php';
                if (!$mail->send()) {
                    echo 'Error: ' . $mail->ErrorInfo;
                } else {
                    //echo 'Enviado correctamente 1';  
                }
            }elseif($i==14){
                $mail->ClearAllRecipients();
                //$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
                $mail->setFrom($usac->eml_usu, $usac->nom_usu);
                $mail->addAddress($usuMRem->eml_usu, $usuMRem->nom_usu);
                $mail->AddAddress('milet.ruiz@masterquimica.com', 'Milet Ruiz');

                //Mensaje del correo
                $mail->isHTML(true);
                $mail->Subject = 'Solicitud de Crédito'; //Asunto
                include 'body.php'; 
                if (!$mail->send()) {
                    echo 'Error: ' . $mail->ErrorInfo;
                } else {
                    //echo 'Enviado correctamente Admin';  
                }
            }
        }
        }elseif($_POST['action']=='actualizacionForm2'){
        $i=null;
        for($i=15;$i<=16;$i++){
            if($i==15){
                
                $mail->setFrom($usuMRem->eml_usu, $usuMRem->nom_usu);
                //$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
                $mail->addAddress($usuMRe->eml_usu, $usuMRe->nom_usu);
                $mail->AddAddress('milet.ruiz@masterquimica.com', 'Milet Ruiz');

                //Mensaje del correo
                $mail->isHTML(true);
                $mail->Subject = 'Solicitud de Crédito'; //Asunto
                include 'body.php';
                if (!$mail->send()) {
                    echo 'Error: ' . $mail->ErrorInfo;
                } else {
                    //echo 'Enviado correctamente 1';  
                }
            }elseif($i==16){
                $mail->ClearAllRecipients();
                $mail->setFrom($usuMRe->eml_usu, $usuMRe->nom_usu);
                //$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
                $mail->addAddress($usuMRem->eml_usu, $usuMRem->nom_usu);
                $mail->addAddress($usac->eml_usu, $usac->nom_usu);
                //Mensaje del correo
                $mail->isHTML(true);
                $mail->Subject = 'Solicitud de Crédito'; //Asunto
                include 'body.php'; 
                if (!$mail->send()) {
                    echo 'Error: ' . $mail->ErrorInfo;
                } else {
                    //echo 'Enviado correctamente Admin';  
                }
            }
        }
    }
