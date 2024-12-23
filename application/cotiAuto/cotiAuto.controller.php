<?php
include '../../conexion.php';
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d H:i:s");
if (isset($_POST['action'])) {
   switch ($_POST['action']) {
        case 'comentario':
        $sqlUpdaCot="UPDATE `cot_cotizaciones` SET `com_cotOnl` = '1'
                                               WHERE  `id_coti`=" . $_POST['id_coti'];
        $queryUpdaCot=$conexion->query($sqlUpdaCot);
        $sqlCom="INSERT INTO `cot_comentarios_onl`(`id_coti`,
                                                    `comentario`,
                                                    `fec_coment`,
                                                    `id_usu`,
                                                    `usu_mq`, 
                                                    `nom_usu`)
                                            VALUES('".$_POST['id_coti']."',
                                                    '".$_POST['com_cot']."',
                                                    '$fecha',
                                                    '".$_POST['id_usu']."',
                                                    '".$_POST['usu_mq']."', 
                                                    '".$_POST['nom_usu']."')";
        $queryCom=$conexion->query($sqlCom);
        include '../cotizador/Email.php';
        if($queryCom != null && $sqlUpdaCot != null) {
            if($_POST['usu_mq']==2){ 
                echo '<div align="center">
                    <br>¡Comentario enviado correctamente! Pronto un Asesor o Representante se comunicará contigo. <br><br>
                </div>';
               }else{ 
                   echo '<div align="center">
                    <br>¡Comentario enviado correctamente!. <br><br>
                </div>';
               }
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show mt-4 d-flex align-items-center" style="font-size:15px;" role="alert">
                    <i class="fa-solid fa-circle-exclamation me-3 fa-xl"></i>
                        <strong>No se pudo actualizar.</strong>
                  </div>'.$sqlCom.$sqlUpdaCot;
        }
    break;
}
}

?>
