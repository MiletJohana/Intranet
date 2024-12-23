<?php
include '../../resources/template/credentials.php';
$sqlDes="SELECT us.eml_usu, us.nom_usu, est.nom_est, tip.tip_desc, de.id_usu, de.id_desc, de.val_desc, de.cuo_des , de.otro_tip_desc 
FROM ind_desc de ,mq_usu us , ind_desc_tip tip, ind_desc_esta est
WHERE de.id_usu = us.id_usu 
AND de.id_estado =est.id_estado 
AND de.id_tip_desc =tip.id_tip_desc";
if((isset($_POST['action']) && $_POST['action']=='insDesc')){
$sqlDes.=" ORDER BY de.id_desc DESC limit 1" ;
}elseif((isset($_POST['action']) && $_POST['action']=='editDesc')){
$sqlDes.=" AND de.id_desc= ".$_POST['id_desc'];
}elseif((isset($_POST['action']) && $_POST['action']=='cambiarEs')){
$sqlDes.=" AND de.id_desc= ".$_POST['id'];
}
$queryDes=$conexion->query($sqlDes);
$usu=null;
while ($rU=$queryDes->fetch(PDO::FETCH_OBJ)){
    $usu=$rU;
    break;
}
//echo $sqlDes;
$sqlSoli="SELECT us.eml_usu, us.nom_usu, est.nom_est, tip.tip_desc, de.id_usus, de.id_desc, de.val_desc, de.cuo_des, de.otro_tip_desc 
FROM ind_desc de ,mq_usu us , ind_desc_tip tip, ind_desc_esta est
WHERE de.id_usus = us.id_usu 
AND de.id_estado =est.id_estado 
AND de.id_tip_desc =tip.id_tip_desc";
if((isset($_POST['action']) && $_POST['action']=='insDesc')){
$sqlSoli.=" ORDER BY de.id_desc DESC limit 1" ;
}elseif((isset($_POST['action']) && $_POST['action']=='editDesc')){
$sqlSoli.=" AND de.id_desc= ".$_POST['id_desc'];
}elseif((isset($_POST['action']) && $_POST['action']=='cambiarEs')){
$sqlSoli.=" AND de.id_desc= ".$_POST['id'];
}
$querySoli=$conexion->query($sqlSoli);
$usuS=null;
while ($rUS=$querySoli->fetch(PDO::FETCH_OBJ)){
    $usuS=$rUS;
    break;
}
//echo $sqlSoli;
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

//CREACION DE DESCUENTOS
if($_POST['action']=='insDesc'){
    $i=null;
    for($i=1;$i<=2;$i++){
        if($i==1){
            //$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
            $mail->setFrom('descuentos@masterquimica.com',  'Descuentos MQ');
            $mail->addAddress($usu->eml_usu, $usu->nom_usu);

            //Mensaje del correo
            $mail->isHTML(true);
            $mail->Subject = 'Descuento De Nomina'; //Asunto
            include 'contEmail.php'; 
            if (!$mail->send()) {
                echo 'Error: ' . $mail->ErrorInfo;
            } else {
                //echo 'Enviado correctamente Admin';  
            }
        }elseif($i==2){
            $mail->ClearAllRecipients();
            $mail->setFrom('descuentos@masterquimica.com',  'Descuentos MQ');
            //$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
            $mail->addAddress($usuS->eml_usu, $usuS->nom_usu);

            //Mensaje del correo
            $mail->isHTML(true);
            $mail->Subject = 'Descuento De Nomina'; //Asunto
            include 'contEmail.php';
            if (!$mail->send()) {
             echo 'Error: ' . $mail->ErrorInfo;
            } else {
                //echo 'Enviado correctamente 1';  
            }
        }
    }
}elseif($_POST['action']=='editDesc'){// CASO DE RECURSOS HUMANOS O ADMIN CREAR EL PERMISO 
    $i=null;
    for($i=3;$i<=4;$i++){
        if($i==3){
            //$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
            $mail->setFrom('descuentos@masterquimica.com',  'Descuentos MQ');
            $mail->addAddress($usu->eml_usu, $usu->nom_usu);
         
            //Mensaje del correo
            $mail->isHTML(true);
            $mail->Subject = 'Descuento De Nomina'; //Asunto
            include 'contEmail.php'; 
            if (!$mail->send()) {
                echo 'Error: ' . $mail->ErrorInfo;
            } else {
                //echo 'Enviado correctamente Admin';  
            }
        }elseif($i==4){
            $mail->ClearAllRecipients();
            $mail->setFrom('descuentos@masterquimica.com',  'Descuentos MQ');
            //$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
            $mail->addAddress($usuS->eml_usu, $usuS->nom_usu);

            //Mensaje del correo
            $mail->isHTML(true);
            $mail->Subject = 'Descuento De Nomina'; //Asunto
            include 'contEmail.php';
            if (!$mail->send()) {
             echo 'Error: ' . $mail->ErrorInfo;
            } else {
                //echo 'Enviado correctamente 1';  
            }
        }
    }
}elseif($_POST['action']=='cambiarEs'){
    $i=null;
    for($i=5;$i<=6;$i++){
    if($i==5){
        //$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
        $mail->setFrom('descuentos@masterquimica.com',  'Descuentos MQ');
        $mail->addAddress($usu->eml_usu, $usu->nom_usu);

        //Mensaje del correo
        $mail->isHTML(true);
        $mail->Subject = 'Descuento De Nomina'; //Asunto
        include 'contEmail.php'; 
        if (!$mail->send()) {
            echo 'Error: ' . $mail->ErrorInfo;
        } else {
            //echo 'Enviado correctamente Admin';  
        }
    }elseif($i==6){
        $mail->ClearAllRecipients();
        $mail->setFrom('descuentos@masterquimica.com',  'Descuentos MQ');
        //$mail->addReplyTo('milet.ruiz@masterquimica.com', 'Jhon G');
        $mail->addAddress($usuS->eml_usu, $usuS->nom_usu);
        
        //Mensaje del correo
        $mail->isHTML(true);
        $mail->Subject = 'Descuento De Nomina'; //Asunto
        include 'contEmail.php';
        if (!$mail->send()) {
         echo 'Error: ' . $mail->ErrorInfo;
        } else {
            //echo 'Enviado correctamente 1';  
        }
    }
}
}
?>