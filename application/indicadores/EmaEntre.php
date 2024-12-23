<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';

$sqlEnt="SELECT * FROM ind_select_per per,mq_are ar,ind_estados es, ind_solcarg ind, mq_lider lid, mq_usu us, ind_cargos carg 
WHERE ind.area_sol=ar.id_are 
AND ind.id_solC=per.id_solC 
AND per.id_estaSol=es.id_estaSol 
AND lid.id_are=ar.id_are 
AND lid.id_lider=us.id_usu 
AND ind.carg_sol=carg.id_carg 
ORDER BY id_sel DESC limit 1";
$queryEnt=$conexion->query($sqlEnt);
$usu=null;
 while ($rusu=$queryEnt->fetch(PDO::FETCH_OBJ)){
    $usu=$rusu;
    break;
}
//echo $sqlEnt;
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
$mail->isHTML(true);  
$mail->Username = 'milet.ruiz@masterquimica.com';
$mail->Password = 'itMR.2019';

if($_POST['action']=='addSelect'){
    $i=null;
    for($i=1;$i<=2;$i++){
        if($i==1){
            $mail->addReplyTo('milet.ruiz@masterquimica.com', 'Milet Ruiz');
            $mail->setFrom('Entrevistas@masterquimica.com',  'Entrevistas MQ');
            $mail->addAddress($usu->ema_ent, $usu->nom_per);

            //Mensaje del correo
            $mail->isHTML(true);
            $mail->Subject = 'Entrevista Master Quimica '; //Asunto
            include 'contEntre.php'; 
            if (!$mail->send()) {
                echo 'Error: ' . $mail->ErrorInfo;
            } else {
                //echo 'Enviado correctamente Admin';  
            }
        }elseif($i==2){
            $mail->ClearAllRecipients();
            $mail->setFrom('Entrevistas@masterquimica.com',  'Entrevistas MQ');
            
            //emails de prueba de Andres y Nahia 
            $mail->addAddress("aprendiztd1@masterquimica.com","Nahia");
            $mail->addAddress("aprendiztd2@masterquimica.com","Andres");
            //$mail->addAddress('milet.ruiz@masterquimica.com', 'Milet Ruiz');
            //$mail->addAddress($usu->eml_usu, $usu->nom_lider);
            //$mail->addAddress('angela.casas@masterquimica.com', 'Angela Casas');
            //Mensaje del correo
            $mail->isHTML(true);
            $mail->Subject = 'Entrevista Master Quimica '; //Asunto
            include 'contEntre.php';
            if (!$mail->send()) {
             echo 'Error: ' . $mail->ErrorInfo;
            } else {
                //echo 'Enviado correctamente 1';  
            }
        }
    }
}
?>