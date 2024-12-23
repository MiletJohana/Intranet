<?php
include '../../resources/template/credentials.php';
include '../../resources/utils/phppdf/vendor/autoload.php';
   $soli=$_POST["id_sol"];
   $id_cli=$_POST["id_cli"];
   $id=$_SESSION["id"];
   $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8',
      'format'=>'A4', '', '', '2', '2', '2', '2'
   ]);

   $mpdf->allow_charset_conversion=true;
   $mpdf->charset_in='UTF-8';
   $mpdf->setAutoTopMargin = 'stretch';
   $mpdf->setAutoBottomMargin = 'stretch';
   $mpdf->SetHTMLHeader('
   <table align="center">
      <tr>
         <td width="100%"><img src="../../resources/img/documentos/logo sin bureo.jpg" width="100%"></td>
      </tr>
   </table>
   ', 'O');
      $mpdf->SetHTMLFooter(' 

      <div class="notice "align="center">
         <img src="../../resources/utils/phppdf/img/imagen2.jpg" width="90%" >
      </div>

   ', 'O');

include 'bodypdf2.php';

$sql5="SELECT * FROM mq_clientes cli, cre_solicitud sol, mq_usu us
             where cli.id_cli=sol.id_cli
             AND sol.id_usu=us.id_usu";
				 if(isset($_POST['id_sol']) && $_POST['id_sol']!=''){
					 $sql5.=" AND sol.id_sol=".$_POST['id_sol'];
				 }
$query5=$conexion->query($sql5);
while ($rEmail=$query5->fetch(PDO::FETCH_OBJ)){
   $emacli=$rEmail;
   break;
}
$sqlSol1="SELECT *,DATE(fec_sol) as fecha FROM cre_solicitud";
if(isset($_POST['id_sol']) && $_POST['id_sol']!=''){
   $sql5.=" where id_sol=".$_POST['id_sol'];
}
$querySol1=$conexion->query($sqlSol1);
while ($rsol=$querySol1->fetch(PDO::FETCH_OBJ)){
      $sol1=$rsol;
      break;
}


$sqlAse="SELECT * FROM mq_usu WHERE id_usu ='".$emacli->ase_com."';";
$queryAse=$conexion->query($sqlAse);
while($rAse=$queryAse->fetch(PDO::FETCH_OBJ)){
   $ase=$rAse;
}
  

$mpdf->WriteHTML($html);
$doc=$mpdf->Output('','S');
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
$mail->ClearAllRecipients();
/////////////////////////////////////
if(isset($_POST['action'])){
   $action=$_POST['action'];
}elseif(isset($_GET['action'])){
   $action=$_GET['action'];
}
if($action=='updateAprob'){
      $mail->setFrom('contabilidad@masterquimica.com');
      $mail->AddAddress('contabilidad@masterquimica.com', 'Carolina Bernal');
      $mail->AddAddress('rosario.hernandez@masterquimica.com', 'Maria Del Rosario Hernandez Herrera');
      $mail->AddAddress('tesoreria@masterquimica.com', 'Claudia Mora');
      $mail->AddAddress($emacli->eml_cli, $emacli->nom_cli);
      $mail->AddAddress('milet.ruiz@masterquimica.com', 'Milet Ruiz');
      $mail->AddAddress($emacli->eml_usu, $emacli->nom_usu);
      $mail->AddAddress($ase->eml_usu, $ase->nom_usu);

      //Mensaje del correo
      $mail->isHTML(true);
      $mail->setFrom('contabilidad@masterquimica.com');
      $mail->AddAddress('milet.ruiz@masterquimica.com', 'Milet Ruiz');

      $mail->Subject = 'Solicitud de Crédito'; //Asunto
      $mail->Body = 'Respetado '.$emacli->nom_cli. '<br>'.' Anexo respuesta de estudio de crédito solicitado.';
      $mail->AddStringAttachment($doc, 'doc.pdf', 'base64', 'application/pdf');

      if (!$mail->send()) {
         echo 'Error: ' . $mail->ErrorInfo;
      } else {
         // echo $datosclie["nom_cli"];
   }
}elseif($action=='estudioCredRechazado'){
   
      $mail->setFrom('contabilidad@masterquimica.com');
      $mail->AddAddress('contabilidad@masterquimica.com', 'Carolina Bernal');
      $mail->AddAddress('rosario.hernandez@masterquimica.com', 'Maria Del Rosario Hernandez Herrera');
      $mail->AddAddress('yurani.rivera@masterquimica.com', 'Yurani Rivera');
      $mail->AddAddress('tesoreria@masterquimica.com', 'Claudia Mora');
      $mail->AddAddress($emacli->eml_cli, $emacli->nom_cli);
      $mail->AddAddress('milet.ruiz@masterquimica.com', 'Milet Ruiz');
      $mail->addAddress($ema1->eml_usu, $ema1->nom_usu);
      $mail->AddAddress($ase->eml_usu, $ase->nom_usu);

   //Mensaje del correo
   $mail->isHTML(true);
   $mail->Subject = 'Solicitud de Crédito'; //Asunto
   $mail->Body = 'Respetado '.$emacli->nom_cli. '<br>'.' Anexo respuesta de estudio de crédito solicitado.';
   $mail->AddStringAttachment($doc, 'doc.pdf', 'base64', 'application/pdf');

   if (!$mail->send()) {
      echo 'Error: ' . $mail->ErrorInfo;
   } else {
      //echo 'Correo enviado Exitosamente';
   }
}

?>