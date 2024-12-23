<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d H:i:s");
if (isset($_POST['action'])) {
   switch ($_POST['action']) {
      case 'add':
         $sql = "INSERT INTO mq_clie(`id_cli`, 
                                      `tip_id`,
                                      `nom_cli`,
                                      `con_cli`, 
                                      `dir_cli`, 
                                      `tel_cli`, 
                                      `eml_cli`, 
                                      `web_cli`, 
                                      `hor_cli`, 
                                      `usu_upt`, 
                                      `lst_upt`, 
                                      `fec_cre`, 
                                      `id_reg`) 
                                      VALUES ('" . $_POST['id_cli'] . "',
                                             '" . $_POST['tip_id'] . "',
                                             '" . utf8_decode($_POST['nom_cli']) . "',
                                             '" . utf8_decode($_POST['con_cli']) . "',
                                             '" . $_POST['dir_cli'] . "',
                                             '" . $_POST['tel_cli'] . "',
                                             '" . $_POST['eml_cli'] . "',
                                             '" . $_POST['web_cli'] . "',
                                             '" . $_POST['hor_cli'] . "',
                                             '$sesion_usu',
                                             '$fecha',
                                             '$fecha',
                                             '" . $_POST['id_reg'] . "')";
         $query = $conexion->query($sql);
         if ($query != null) {
            echo "Cliente creado correctamente.";
         } else {
            printf("Errormessage: %s\n", $conexion->error);
         }
         break;

      case 'update':
         $sql = "UPDATE mq_clie SET tip_id=   '" . $_POST['tip_id'] . "',
                                     nom_cli=  '" . utf8_decode($_POST['nom_cli']) . "',
                                     con_cli=  '" . utf8_decode($_POST['con_cli']) . "',
                                     dir_cli=  '" . $_POST['dir_cli'] . "',
                                     tel_cli=  '" . $_POST['tel_cli'] . "',
                                     eml_cli=  '" . $_POST['eml_cli'] . "',
                                     web_cli=  '" . $_POST['web_cli'] . "',
                                     hor_cli=  '" . $_POST['hor_cli'] . "',
                                     usu_upt=  '$sesion_usu',
                                     lst_upt=  '$fecha',
                                     id_reg=    '" . $_POST['id_reg'] . "'
                               WHERE id_cli='" . $_POST['id_cli'] . "'";
         $query = $conexion->query($sql);
         if ($query != null) {
            echo "Cliente actualizado correctamente.";
         } else {
            printf("Errormessage: %s\n", $conexion->error);
         }
         break;

      case 'delete':
         $sql = "DELETE FROM mq_clie WHERE id_cli='" . $_POST['id_cli'] . "'";
         $query = $conexion->query($sql);
         if ($query != null) {
            echo "Cliente eliminado correctamente.";
         } else {
            printf("No puedes eliminar éste cliente debido a que tiene una o más diligencias asociadas.");
         }
         break;
   }
}
