<?php
include '../../conexion.php';
$sqlEm="SELECT cot.id_coti, cot.doc_coti, cot.id_cli , cot.id_usu , cot.id_ema , cot.ced_ase , cot.ced_sac , cot.envio_masiv, cot.com_cotOnl, ema.nom_ema,cot.id_tip_cot,
cot.id_cont, cont.nom_cont, cont.tel_cont, cont.eml_cont , cli.nom_cli, us.nom_usu, us.eml_usu, us.id_car
FROM cot_cotizaciones cot , cot_ema_est ema, contactos cont , mq_clientes cli , mq_usu us
WHERE cot.id_cli=cli.id_cli
AND cot.id_cont =cont.id_cont
AND cot.id_usu=us.id_usu
AND cot.id_ema=ema.id_ema";
$sqlEm.=" AND cot.id_coti=".$_POST['id_coti'];
$sqlEm.=" GROUP by cot.id_coti";
$queryEm=$conexion->query($sqlEm);
//echo $sqlEm;
$usu=null;
while($r=$queryEm->fetch(PDO::FETCH_OBJ)){
   $usu=$r;
break;
}
if ($usu->ced_sac !=""){
$sqlSac="SELECT us.eml_usu, us.nom_usu, us.id_car , tip.nom_car, us.ext_usu
FROM mq_usu us, cot_tip_cotizador tip
WHERE us.id_car=tip.id_car
AND us.id_usu=$usu->ced_sac";
//echo $sqlSac;
$querySac=$conexion->query($sqlSac);
while($rSac=$querySac->fetch(PDO::FETCH_OBJ)){
    $sac=$rSac;
    break;
}
}
if ($usu->ced_ase !=""){
$sqlAce="SELECT us.eml_usu, us.nom_usu, us.id_car , tip.nom_car, us.ext_usu
FROM mq_usu us, cot_tip_cotizador tip
WHERE us.id_car=tip.id_car
AND us.id_usu=$usu->ced_ase";
//echo $sqlAce;
$queryAce=$conexion->query($sqlAce);
while($rAce=$queryAce->fetch(PDO::FETCH_OBJ)){
    $ace=$rAce;
    break;
}
}
if ($usu->envio_masiv !=""){
$sqlemasiv="SELECT em.id_coti , em.fec_ema ,em.email_contacto, em.nom_contacto , em.email_contacto1, em.nom_contacto1, em.email_contacto2, em.nom_contacto2 ,em.email_contacto3, em.nom_contacto3 
FROM cot_cotizaciones cot , cot_cont_ema em
WHERE cot.id_coti=em.id_coti
and em.id_coti=".$_POST['id_coti'];
$sqlemasiv.= " ORDER BY em.fec_ema  DESC limit 1 ";
$queryemasiv=$conexion->query($sqlemasiv);
//echo $sqlemasiv;
while($remas=$queryemasiv->fetch(PDO::FETCH_OBJ)){
    $masv=$remas;
break;
}
}
if($usu->com_cotOnl !=""){
$sqlCha=" SELECT onl.id_coti, onl.comentario, onl.fec_coment, onl.nom_usu, onl.usu_mq
FROM cot_comentarios_onl onl, cot_cotizaciones cot
WHERE cot.id_coti =onl.id_coti
AND onl.id_coti=".$_POST['id_coti'];
$sqlCha.= " ORDER BY fec_coment  DESC limit 1 ";
$queryCha= $conexion->query($sqlCha);
//echo $sqlCha;
while($rchat=$queryCha->fetch(PDO::FETCH_OBJ)){
      $chat=$rchat;
break;
}
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
if($_POST['action']=='email'){
    $i=null;
    for($i=1;$i<=2;$i++){
        if($i==1){
            //$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
            $mail->setFrom($usu->eml_usu,  $usu->nom_usu);
            $mail->addAddress($usu->eml_cont, $usu->nom_cont);

            //Mensaje del correo
            $mail->isHTML(true);
            $mail->Subject = 'Cotización N°'.$usu->id_coti.' '. $usu->nom_cli; //Asunto
            include 'body.php'; 
            if (!$mail->send()) {
                echo 'Error: ' . $mail->ErrorInfo;
            } else {
                //echo 'Enviado correctamente Admin';  
            }
        }elseif($i==2){
            $mail->ClearAllRecipients();
            $mail->setFrom('cotizaciones@masterquimica.com',  'Administrador de Cotizaciones');
            //$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
            $mail->addAddress($usu->eml_usu,  $usu->nom_usu);

            //Mensaje del correo
            $mail->isHTML(true);
            $mail->Subject = 'Cotización N°'.$usu->id_coti.' '. $usu->nom_cli; //Asunto
            include 'body.php'; 
            if (!$mail->send()) {
             echo 'Error: ' . $mail->ErrorInfo;
            } else {
                //echo 'Enviado correctamente 1';  
            }
        }
    }
}elseif($_POST['action']=='aprobado'){
    $i=null;
    for($i=3;$i<=4;$i++){
        if($i==3){
            //$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
            $mail->setFrom($usu->eml_usu,  $usu->nom_usu);
            $mail->addAddress($usu->eml_cont, $usu->nom_cont);

            //Mensaje del correo
            $mail->isHTML(true);
            $mail->Subject = 'Cotización N°'.$usu->id_coti.' '. $usu->nom_cli; //Asunto
            include 'body.php'; 
            if (!$mail->send()) {
                echo 'Error: ' . $mail->ErrorInfo;
            } else {
                //echo 'Enviado correctamente Admin';  
            }
        }elseif($i==4){
            $mail->ClearAllRecipients();
            $mail->setFrom('cotizaciones@masterquimica.com',  'Administrador de Cotizaciones');
            //$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
            $mail->addAddress($usu->eml_usu,  $usu->nom_usu);

            //Mensaje del correo
            $mail->isHTML(true);
            $mail->Subject = 'Cotización N°'.$usu->id_coti.' '. $usu->nom_cli;//Asunto
            include 'body.php'; 
            if (!$mail->send()) {
             echo 'Error: ' . $mail->ErrorInfo;
            } else {
                //echo 'Enviado correctamente 1';  
            }
        }
    }
}elseif($_POST['action']=='rechazado'){
    $i=null;
    for($i=5;$i<=6;$i++){
        if($i==5){
            //$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
            $mail->setFrom($usu->eml_usu,  $usu->nom_usu);
            $mail->addAddress($usu->eml_cont, $usu->nom_cont);

            //Mensaje del correo
            $mail->isHTML(true);
            $mail->Subject = 'Cotización N°'.$usu->id_coti.' '. $usu->nom_cli; //Asunto
            include 'body.php'; 
            if (!$mail->send()) {
                echo 'Error: ' . $mail->ErrorInfo;
            } else {
                //echo 'Enviado correctamente Admin';  
            }
        }elseif($i==6){
            $mail->ClearAllRecipients();
            $mail->setFrom('cotizaciones@masterquimica.com',  'Administrador de Cotizaciones');
            //$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
            $mail->addAddress($usu->eml_usu,  $usu->nom_usu);

            //Mensaje del correo
            $mail->isHTML(true);
            $mail->Subject ='Cotización N°'.$usu->id_coti.'  '. $usu->nom_cli; //Asunto
            include 'body.php'; 
            if (!$mail->send()) {
             echo 'Error: ' . $mail->ErrorInfo;
            } else {
                //echo 'Enviado correctamente 1';  
            }
        }
    }
}elseif($_POST['action']=='emailMas'){
    $i=null;
    for($i=7;$i<=8;$i++){
        if($i==7){
            //$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
            $mail->setFrom($usu->eml_usu,  $usu->nom_usu);
            /*$mail->addAddress($usu->eml_cont, $usu->nom_cont);
            $mail->AddAddress($masv->email_contacto, $masv->nom_contacto);
            $mail->AddAddress($masv->email_contacto1, $masv->nom_contacto1);
            $mail->AddAddress($masv->email_contacto2, $masv->nom_contacto2);
            $mail->AddAddress($masv->email_contacto3, $masv->nom_contacto3);*/

            //emails de prueba de Andres y Nahia 
            $mail->addAddress("aprendiztd1@masterquimica.com","Nahia");
            $mail->addAddress("aprendiztd2@masterquimica.com","Andres");
        
           //Mensaje del correo
            $mail->isHTML(true);
            $mail->Subject = 'Cotización N°'.$usu->id_coti.' '. $usu->nom_cli; //Asunto
            include 'body.php'; 
            if (!$mail->send()) {
                echo 'Error: ' . $mail->ErrorInfo;
            } else {
                //echo 'Enviado correctamente Admin';  
            }
        }elseif($i==8){
            $mail->ClearAllRecipients();
            $mail->setFrom('cotizaciones@masterquimica.com',  'Administrador de Cotizaciones');
            //$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
            //$mail->addAddress($usu->eml_usu,  $usu->nom_usu);
           
            //emails de prueba de Andres y Nahia 
            $mail->addAddress("aprendiztd1@masterquimica.com","Nahia");
            $mail->addAddress("aprendiztd2@masterquimica.com","Andres");

            //Mensaje del correo
            $mail->isHTML(true);
            $mail->Subject = 'Cotización N°'.$usu->id_coti.' '. $usu->nom_cli; //Asunto
            include 'body.php'; 
            if (!$mail->send()) {
             echo 'Error: ' . $mail->ErrorInfo;
            } else {
                //echo 'Enviado correctamente 1';  
            }
        }
    }
}elseif($_POST['action']=='comentario'){
    $i=null;
    for($i=9;$i<=10;$i++){
        if($i==9){
            //$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
            if($chat->usu_mq == 2){
            $mail->setFrom($usu->eml_usu,  $usu->nom_usu);
            //$mail->addAddress($usu->eml_cont, $usu->nom_cont);

            //emails de prueba de Andres y Nahia 
            $mail->addAddress("aprendiztd1@masterquimica.com","Nahia");
            $mail->addAddress("aprendiztd2@masterquimica.com","Andres");

            }else{
            $mail->setFrom($usu->eml_cont, $usu->nom_cont);
            //$mail->addAddress($usu->eml_usu,  $usu->nom_usu);

            //emails de prueba de Andres y Nahia 
            $mail->addAddress("aprendiztd1@masterquimica.com","Nahia");
            $mail->addAddress("aprendiztd2@masterquimica.com","Andres");

            }
           //Mensaje del correo
            $mail->isHTML(true);
            $mail->Subject = 'Cotización N°'.$usu->id_coti.' '. $usu->nom_cli; //Asunto
            include 'body.php'; 
            if (!$mail->send()) {
                echo 'Error: ' . $mail->ErrorInfo;
            } else {
                //echo 'Enviado correctamente Admin';  
            }
        }elseif($i==10){
            $mail->ClearAllRecipients();
            if($chat->usu_mq == 2){
            $mail->setFrom('cotizaciones@masterquimica.com',  'Administrador de Cotizaciones');
            //$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
            //$mail->addAddress($usu->eml_usu,  $usu->nom_usu);

            //emails de prueba de Andres y Nahia 
            $mail->addAddress("aprendiztd1@masterquimica.com","Nahia");
            $mail->addAddress("aprendiztd2@masterquimica.com","Andres");

            }else{
            $mail->setFrom($usu->eml_usu,  $usu->nom_usu);
            //$mail->addAddress($usu->eml_cont, $usu->nom_cont);

            //emails de prueba de Andres y Nahia 
            $mail->addAddress("aprendiztd1@masterquimica.com","Nahia");
            $mail->addAddress("aprendiztd2@masterquimica.com","Andres");
            
            }
            //Mensaje del correo
            $mail->isHTML(true);
            $mail->Subject = 'Cotización N°'.$usu->id_coti.' '. $usu->nom_cli; //Asunto
            include 'body.php'; 
            if (!$mail->send()) {
             echo 'Error: ' . $mail->ErrorInfo;
            } else {
                //echo 'Enviado correctamente 1';  
            }
        }
    }
}
?>