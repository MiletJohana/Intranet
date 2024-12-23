<?php

include '../../conexion.php';
include '../../resources/template/credentials.php';

$sql_info_solicitante = "SELECT usu.id_usu, usu.nom_usu, usu.eml_usu FROM inv_solicitud AS sol INNER JOIN mq_usu usu ON sol.id_usu = usu.id_usu WHERE sol.id_sol = ?";
$query_info_solicitante = $conexion -> prepare($sql_info_solicitante);
$query_info_solicitante -> execute([$id_sol]);
$rowInfoSolicitante = $query_info_solicitante->fetch(PDO::FETCH_OBJ);

/* Consulta nombre y correo administrador */
$sqlEmailAdmin = "SELECT * FROM inv_config WHERE id IN (?,?)";
$queryEmailAdmin = $conexion -> prepare($sqlEmailAdmin);
$queryEmailAdmin -> execute([1, 2]);

$rowInfoEmailAdmin = $queryEmailAdmin->fetchAll(PDO::FETCH_ASSOC);

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
//vocm mbpf rnsb bqit
// Datos para enviar y a quien se envia el correo 
if($_POST['action']=='inv_create_sol'){
    $i=null;
    for($i=1;$i<=2;$i++){
        if($i==1){
            /* Correo que recibe el solicitante al crear la solicitud */
            $mail->setFrom('desarrollo@masterquimica.com', 'Inventarios MQ');
            $mail->addAddress($rowInfoSolicitante->eml_usu, $rowInfoSolicitante->nom_usu);

            //Mensaje del correo
            $mail->isHTML(true);
            $mail->Subject = 'Solicitud #'.$id_sol.' Creada | Inventarios MQ'; //Asunto
            include 'bodyEmail.php';
            if (!$mail->send()) {
                echo 'Error: ' . $mail->ErrorInfo;
            } else {
                //echo 'Enviado correo Solicitante correctamente ';  
            }
        } else if($i==2){
            /* Correo que recibe el administrador del inventario cuando se crea una solicitud */
            $mail->ClearAllRecipients();
            $mail->setFrom('desarrollo@masterquimica.com', 'Inventarios MQ');
            $mail->addAddress($rowInfoEmailAdmin[1]['valor'], $rowInfoEmailAdmin[0]['valor']);
             
            //Mensaje del correo
            $mail->isHTML(true);
            $mail->Subject = 'Solicitud #'.$id_sol.' Creada | Inventarios MQ'; //Asunto
            include 'bodyEmail.php';
            if (!$mail->send()) {
                echo 'Error: ' . $mail->ErrorInfo;
            } else {
                //echo 'Enviado correctamente Admin Inventarios';  
            }
        }
    }
}elseif($_POST['action']=='entregar_sol'){
    $i=null;
    for($i=3;$i<=4;$i++){
        if($i==3){
            /* Correo que recibe el solicitante notificando la entrega (parcial/completa) de la solicitud */
            $mail->setFrom('desarrollo@masterquimica.com', 'Inventarios MQ');
            $mail->addAddress($rowInfoSolicitante->eml_usu, $rowInfoSolicitante->nom_usu);
            $mail->AddAddress('desarrollo@masterquimica.com', 'Milet Ruiz');
        
            //Mensaje del correo
            $mail->isHTML(true);
            $mail->Subject = 'Solicitud #'.$id_sol.' Entregada '.(($est_sol == 3) ? 'Completamente' : "Parcialmente").' | Inventarios MQ'; //Asunto
            include 'bodyEmail.php';
            if (!$mail->send()) {
                echo 'Error: ' . $mail->ErrorInfo;
            } else {
                //echo 'Enviado correctamente 1';  
            }
        }elseif($i==4){
            /* Correo que recibe el administrador del inventario cuando se hace una entrega (parcial/completa) */
            $mail->ClearAllRecipients();
            $mail->setFrom('desarrollo@masterquimica.com', 'Inventarios MQ');
            $mail->addAddress($rowInfoEmailAdmin[1]['valor'], $rowInfoEmailAdmin[0]['valor']);

            //Mensaje del correo
            $mail->isHTML(true);
            $mail->Subject = 'Solicitud #'.$id_sol.' Entregada '.(($est_sol == 3) ? 'Completamente' : "Parcialmente").' | Inventarios MQ'; //Asunto
            include 'bodyEmail.php';
            if (!$mail->send()) {
                echo 'Error: ' . $mail->ErrorInfo;
            } else {
                //echo 'Enviado correctamente Admin';  
            }
        }
    }
    
    }elseif($_POST['action']=='rechazar_sol'){
        
        $i=null;
        for($i=5;$i<=5;$i++){
            if($i==5){
                $mail->setFrom('desarrollo@masterquimica.com', 'Inventarios MQ');
                $mail->addAddress($rowInfoSolicitante->eml_usu, $rowInfoSolicitante->nom_usu);
                $mail->addAddress('desarrollo@masterquimica.com', 'Inventarios MQ');

                //Mensaje del correo
                $mail->isHTML(true);
                $mail->Subject = 'Solicitud #'.$id_sol.' Rechazada | Inventarios MQ'; //Asunto
                include 'bodyEmail.php';
                if (!$mail->send()) {
                    echo 'Error: ' . $mail->ErrorInfo;
                } else {
                    //echo 'Enviado correctamente 1';  
                }
            }elseif($i==6){
                $mail->ClearAllRecipients();
                $mail->setFrom('desarrollo@masterquimica.com', 'Inventarios MQ');
                $mail->addAddress($rowInfoEmailAdmin[1]['valor'], $rowInfoEmailAdmin[0]['valor']);

                //}
                //Mensaje del correo
                $mail->isHTML(true);
                $mail->Subject = 'Solicitud #'.$id_sol.' Rechazada | Inventarios MQ'; //Asunto
                include 'bodyEmail.php';
                if (!$mail->send()) {
                    echo 'Error: ' . $mail->ErrorInfo;
                } else {
                    //echo 'Enviado correctamente Admin';  
                }
            }
        }
        
    }
