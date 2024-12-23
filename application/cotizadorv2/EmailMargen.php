<link rel="stylesheet" type="text/css" href="../../resources/css/cssAuto.css">
<?php
include '../../conexion.php';
$sqlCoti="SELECT * FROM cot_cotizaciones AS cot
INNER JOIN mq_usu AS us
ON cot.id_usu=us.id_usu
INNER JOIN mq_clientes As cli
ON cot.id_cli=cli.id_cli ";
if(isset($_GET['id_coti']) && $_GET['id_coti']!=''){
    $sqlCoti.=" WHERE cot.id_coti=".$_GET['id_coti'];
}else{
    $sqlCoti.=" WHERE cot.id_coti=".$cot;
}
//echo $sqlCoti; 
$queryCoti=$conexion->query($sqlCoti);
$coti = NULL;
$ven  = NULL;
$ger  = NULL;
$com  = NULL;
while($rC=$queryCoti->fetch(PDO::FETCH_OBJ)){
    $coti=$rC;
}

//COORDINADOR DE VENTAS
$sqlVent="SELECT * FROM mq_usu
          WHERE id_carg  = 103  
          AND   usu_elim = 0";
$queryVent=$conexion->query($sqlVent);
while($rV=$queryVent->fetch(PDO::FETCH_OBJ)){
    $ven=$rV;
}
// GERENCIA
$sqlGere="SELECT * FROM mq_usu 
          WHERE id_carg = 180 
          AND usu_elim  = 0";
$queryGere=$conexion->query($sqlGere);
while($rG=$queryGere->fetch(PDO::FETCH_OBJ)){
    $ger=$rG;
}

// PRODUCTOS X COTIZACION
$sqlPro="SELECT * FROM cot_pro_x_cot ";
if(isset($_GET['id_coti']) && $_GET['id_coti']!=''){
    $sqlPro.=" WHERE id_coti=".$_GET['id_coti'];
}else{
    $sqlPro.=" WHERE id_coti=".$cot;
}
$queryPro=$conexion->query($sqlPro);
//echo $sqlPro;


// COMENTARIO RECHAZO
$sqlComR="SELECT * FROM cot_descrip_rech";
if (isset($_GET['id_coti']) && $_GET['id_coti']!=''){
    $sqlComR.=" WHERE id_coti=".$_GET['id_coti'];
}else{
    $sqlComR.=" WHERE id_coti=".$cot;
}
$sqlComR.=" ORDER by id_rechazo DESC LIMIT 1";
$queryComR=$conexion->query($sqlComR);

while($rCom=$queryComR->fetch(PDO::FETCH_OBJ)){
    $com=$rCom;
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

if(isset($_POST['action'])){
    $action=$_POST['action'];
}elseif(isset($_GET['action'])){
    $action=$_GET['action'];
}
if($action=='emailMargen'){
    $i=null;
    for($i=1;$i<=2;$i++){
        if($i==1){
            //$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
            $mail->setFrom($coti->eml_usu,  $coti->nom_usu);
            //$mail->addAddress($ven->eml_usu, $uvensu->nom_usu);
            //$mail->addAddress($ger->eml_usu, $ger->eml_usu);
            //$mail->addAddress('milet.ruiz@masterquimica.com','Milet Ruiz');

            //emails de prueba de Andres y Nahia 
            $mail->addAddress("aprendiztd1@masterquimica.com","Nahia");
            $mail->addAddress("aprendiztd2@masterquimica.com","Andres");

            //Mensaje del correo
            $mail->isHTML(true);
            $mail->Subject = 'Cotización N°'.$coti->id_coti.' '. $coti->nom_cli; //Asunto
            include 'bodyMargen.php'; 
            if (!$mail->send()) {
                echo 'Error: ' . $mail->ErrorInfo;
            } else {
                //echo 'Enviado correctamente Admin';  
            }
        }elseif($i==2){
            $mail->ClearAllRecipients();
            $mail->setFrom('cotizaciones@masterquimica.com',  'Administrador de Cotizaciones');
            //$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
            //$mail->addAddress($coti->eml_usu,  $coti->nom_usu);

            //emails de prueba de Andres y Nahia 
            $mail->addAddress("aprendiztd1@masterquimica.com","Nahia");
            $mail->addAddress("aprendiztd2@masterquimica.com","Andres");

            //Mensaje del correo
            $mail->isHTML(true);
            $mail->Subject = 'Cotización N°'.$coti->id_coti.' '. $coti->nom_cli; //Asunto
            include 'bodyMargen.php'; 
            if (!$mail->send()) {
             echo 'Error: ' . $mail->ErrorInfo;
            } else {
                //echo 'Enviado correctamente 1';  
            }
        }
    }
}elseif($action=='aproMargen'){
    $sqlApro="UPDATE cot_cotizaciones  
              SET id_estmarg = 2 
              WHERE id_coti=".$_GET['id_coti'];
    $queryApro=$conexion->query($sqlApro);
    include 'Aprobacion.php';
    $i=null;
    for($i=3;$i<=4;$i++){
        if($i==3){
            //$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
            $mail->setFrom($coti->eml_usu,  $coti->nom_usu);
            //$mail->addAddress($ven->eml_usu, $uvensu->nom_usu);
            //$mail->addAddress($ger->eml_usu, $ger->eml_usu);
            //$mail->addAddress('milet.ruiz@masterquimica.com','Milet Ruiz');

            //emails de prueba de Andres y Nahia 
            $mail->addAddress("aprendiztd1@masterquimica.com","Nahia");
            $mail->addAddress("aprendiztd2@masterquimica.com","Andres");

            //Mensaje del correo
            $mail->isHTML(true);
            $mail->Subject = 'Cotización N°'.$coti->id_coti.' '. $coti->nom_cli; //Asunto
            include 'bodyMargen.php'; 
            if (!$mail->send()) {
                echo 'Error: ' . $mail->ErrorInfo;
            } else {
                //echo 'Enviado correctamente Admin';  
            }
        }elseif($i==4){
            $mail->ClearAllRecipients();
            $mail->setFrom('cotizaciones@masterquimica.com',  'Administrador de Cotizaciones');
            //$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
            //$mail->addAddress($coti->eml_usu,  $coti->nom_usu);

            //emails de prueba de Andres y Nahia 
            $mail->addAddress("aprendiztd1@masterquimica.com","Nahia");
            $mail->addAddress("aprendiztd2@masterquimica.com","Andres");

            //Mensaje del correo
            $mail->isHTML(true);
            $mail->Subject = 'Cotización N°'.$coti->id_coti.' '. $coti->nom_cli; //Asunto
            include 'bodyMargen.php'; 
            if (!$mail->send()) {
             echo 'Error: ' . $mail->ErrorInfo;
            } else {
                //echo 'Enviado correctamente 1';  
            }
        }
    }
}elseif($action=='rechaMargen'){
    $sqlRech="UPDATE cot_cotizaciones  
              SET id_estmarg = 3 
              WHERE id_coti=".$_GET['id_coti'];
    $queryRech=$conexion->query($sqlRech);
    include 'Rechazado.php';
    $i=null;
    for($i=5;$i<=6;$i++){
        if($i==5){
            //$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
            $mail->setFrom($coti->eml_usu,  $coti->nom_usu);
            //$mail->addAddress($ven->eml_usu, $uvensu->nom_usu);
            //$mail->addAddress($ger->eml_usu, $ger->eml_usu);
            //$mail->addAddress('milet.ruiz@masterquimica.com','Milet Ruiz');

            //emails de prueba de Andres y Nahia 
            $mail->addAddress("aprendiztd1@masterquimica.com","Nahia");
            $mail->addAddress("aprendiztd2@masterquimica.com","Andres");

            //Mensaje del correo
            $mail->isHTML(true);
            $mail->Subject = 'Cotización N°'.$coti->id_coti.' '. $coti->nom_cli; //Asunto
            include 'bodyMargen.php'; 
            if (!$mail->send()) {
                echo 'Error: ' . $mail->ErrorInfo;
            } else {
                //echo 'Enviado correctamente Admin';  
            }
        }elseif($i==6){
            $mail->ClearAllRecipients();
            $mail->setFrom('cotizaciones@masterquimica.com',  'Administrador de Cotizaciones');
            //$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
            //$mail->addAddress($coti->eml_usu,  $coti->nom_usu);

            //emails de prueba de Andres y Nahia 
            $mail->addAddress("aprendiztd1@masterquimica.com","Nahia");
            $mail->addAddress("aprendiztd2@masterquimica.com","Andres");

            //Mensaje del correo
            $mail->isHTML(true);
            $mail->Subject = 'Cotización N°'.$coti->id_coti.' '. $coti->nom_cli; //Asunto
            include 'bodyMargen.php'; 
            if (!$mail->send()) {
             echo 'Error: ' . $mail->ErrorInfo;
            } else {
                //echo 'Enviado correctamente 1';  
            }
        }
    }
}elseif($action=='comentario'){
    $i=null;
    for($i=7;$i<=8;$i++){
        if($i==7){
            //$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
            $mail->setFrom($coti->eml_usu,  $coti->nom_usu);
            //$mail->addAddress($ven->eml_usu, $uvensu->nom_usu);
            //$mail->addAddress($ger->eml_usu, $ger->eml_usu);
            //$mail->addAddress('milet.ruiz@masterquimica.com','Milet Ruiz');

            //emails de prueba de Andres y Nahia 
            $mail->addAddress("aprendiztd1@masterquimica.com","Nahia");
            $mail->addAddress("aprendiztd2@masterquimica.com","Andres");

            //Mensaje del correo
            $mail->isHTML(true);
            $mail->Subject = 'Cotización N°'.$coti->id_coti.' '. $coti->nom_cli; //Asunto
            include 'bodyMargen.php'; 
            if (!$mail->send()) {
                echo 'Error: ' . $mail->ErrorInfo;
            } else {
                //echo 'Enviado correctamente Admin';  
            }
        }elseif($i==8){
            $mail->ClearAllRecipients();
            $mail->setFrom('cotizaciones@masterquimica.com',  'Administrador de Cotizaciones');
            //$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
            //$mail->addAddress($coti->eml_usu,  $coti->nom_usu);

            //emails de prueba de Andres y Nahia 
            $mail->addAddress("aprendiztd1@masterquimica.com","Nahia");
            $mail->addAddress("aprendiztd2@masterquimica.com","Andres");
            
            //Mensaje del correo
            $mail->isHTML(true);
            $mail->Subject = 'Cotización N°'.$coti->id_coti.' '. $coti->nom_cli; //Asunto
            include 'bodyMargen.php'; 
            if (!$mail->send()) {
             echo 'Error: ' . $mail->ErrorInfo;
            } else {
                //echo 'Enviado correctamente 1';  
            }
        }
    }

}

?>