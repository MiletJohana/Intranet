<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d H:i:s");
$date =date ("Y-m-d");
if (isset($_GET["id_coti"])) {
   require_once '../../resources/utils/phppdf/vendor/autoload.php';
   $cot = $_GET["id_coti"];
   $tip_cot = $_GET["tip_cot"];
   $id_cli = $_GET["id_cli"];
   $id = $_GET["id"];
   $id_cont = $_GET["id_cont"];
   $mpdf = new \Mpdf\Mpdf([
      'mode' => 'utf-8',
      'format' => 'A4', '', '', '2', '2', '2', '2'
   ]);
   //$mpdf->showImageErrors = true;
   $mpdf->allow_charset_conversion = true;
   $mpdf->charset_in = 'UTF-8';
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
         <img src="../../resources/img/documentos/imagen2.jpg" width="100%" >
      </div>
   ', 'O');
   if ($tip_cot == 1) {
      include "imp/cinta.php";
   } elseif ($tip_cot == 4) {
      include "imp/producto.php";
   } elseif ($tip_cot == 2) {
      include "imp/cintaimpresa.php";
   } elseif ($tip_cot == 7) {
      include "imp/productosMedellin.php";
   } elseif ($tip_cot == 8) {
      include "imp/productosCali.php";
   } elseif ($tip_cot == 10) {
      include "imp/productosBarran.php";
   }
   $mpdf->WriteHTML($html);
   $mpdf->AddPage();
   $mpdf->WriteHTML($html2);
   $mpdf->Output("cotizacion.pdf", 'I');
}
$sqlCot = "UPDATE cot_cotizaciones SET ";
if (isset($_POST['action'])) {
   switch ($_POST['action']) {
      case 'add':
         if (isset($_POST['verifi']) && $_POST['verifi'] == 1) {
            $sql = "SELECT * FROM cot_cotizaciones ORDER BY id_coti DESC";
            $query = $conexion->query($sql);
            $r = $query->fetch(PDO::FETCH_ASSOC);
            echo $r['doc_coti'];
         } else {
            $usu = $_SESSION['usu'];
            $nom = $_SESSION['nom'];
            $id = $_SESSION['id'];
            if (isset($_POST["productos"])) {
               $id_cli        = $_POST["id_cli"];
               $id_cont       = $_POST["id_cont"];
               $dia_ent       = $_POST["dia_ent"];
               $for_pag       = $_POST["for_pag"];
               $id_ciu        = $_POST["id_ciu"];
               $tip_cot       = $_POST["tip_cot"];
               $val_cot       = $_POST["val_cot"];
               $idAse         = $_POST['ced_ase'];
               $idSac         = $_POST['ced_sac'];
               $productos     = $_POST["productos"];
               $precios       = $_POST["precios"];
               $descripciones = $_POST["descripciones"];
               $observaciones = $_POST["observaciones"];
               $nombres       = $_POST["nombres"];
               $cantidad      = $_POST["cantidad"];
               $total         = 0;
               $iva           = $_POST["iva"];
               $remitir       = $_POST["remitir"];
               $rem_ciu       = $_POST["rem_ciu"];
               $sql12 = 'SELECT cns_cotz FROM mq_usu where id_usu="' . $_SESSION['id'] . '"';
               $query12 = $conexion->query($sql12);
               $r12 = $query12->fetch(PDO::FETCH_ASSOC);
               $cns = $r12['cns_cotz'] + 1;
               date_default_timezone_set("America/Bogota");
               $hor_act = date("Y-m-d h:i:sa");
               for ($i = 0; $i < count($productos); $i++) {
                  $sqlP = "SELECT can_emp FROM cot_productos WHERE cod_pro=" . $productos[$i];
                  $queryP = $conexion->query($sqlP);
                  $rP = $queryP->fetch(PDO::FETCH_ASSOC);
                  $total = $total + ($precios[$i] * $cantidad[$i] * $rP['can_emp']);
               }
               $sql = "SELECT max(id_coti) from cot_cotizaciones";
               $query = $conexion->query($sql);
               $r = $query->fetch(PDO::FETCH_ASSOC);
               $cot = $r["max(id_coti)"] + 1;
               $ruta = "../cotizadorv3/cotizaciones.controller.php?id_coti=" . $cot . "&tip_cot=" . $tip_cot . "&id_cli=" . $id_cli . "&id=" . $id . "&id_cont=" . $id_cont;
               $sql1 = "INSERT INTO `cot_cotizaciones`
                                 (`id_coti`,
                                 `doc_coti`,
                                 `fec_coti`,
                                 `id_cli`,
                                 `id_usu`,
                                 `sol_cot`,
                                 `ced_ase`,
                                 `ced_sac`,
                                 `dia_ent`,
                                 `for_pag`,
                                 `id_tip_cot`,
                                 `cost_cot`,
                                 `id_cont`,
                                 `val_cot`,
                                 `id_ciu`,
                                 `sol_upd`,
                                 `cns_coti`,
                                 `est_cot`,
                                 `est_vigen`,
                                 `cot_iva`";
               if ($_POST['remitir'] == 1) {
                  $sql1 .= ",`rem_ciu`";
               }
               $sql1 .= ") VALUES
                                 (	$cot,
                                    '$ruta',
                                    '$fecha',
                                    '$id_cli',
                                    '$id',
                                    '4',
                                    '$idAse',
                                    '$idSac',
                                    '$dia_ent',
                                    '$for_pag',
                                    $tip_cot,
                                    $total,
                                    $id_cont,
                                    '$val_cot',
                                    $id_ciu,
                                    '$fecha',
                                    $cns,
                                    '1',
                                    '0',
                                    $iva";
               if ($_POST['remitir'] == 1) {
                  $sql1 .= ",$rem_ciu";
               }
               $sql1 .= ")";
               $query1 = $conexion->query($sql1);
               if (!$query1) {
                  echo $sql1;
               }
               for ($i = 0; $i < count($productos); $i++) {
                  $descripcion = $descripciones[$i];
                  $obs = $observaciones[$i];
                  $sql2 = "INSERT INTO `cot_pro_x_cot`(`id_coti`, 
                                                     `cod_pro`, 
                                                     `pre_cot`, 
                                                     `des_pro_cot`,
                                                     `obs_prod`, 
                                                     `can_com`, 
                                                     `nom_pro_cot`)  
                                             VALUES ($cot, 
                                                     '$productos[$i]', 
                                                     $precios[$i],
                                                     '$descripcion',
                                                     '$obs',
                                                     '$cantidad[$i]',
                                                     '$nombres[$i]')";
                  $query2 = $conexion->query($sql2);
                //  echo $sql2;
                  if (!$query2) {
                     echo $sql2;
                  }
               }
               $sql8 = "UPDATE `mq_usu` SET`cns_cotz`=cns_cotz+1 WHERE id_usu=$id";
               $query8 = $conexion->query($sql8);
               if (!$query8) {
                  echo $sql8;
               }
            }
            if ($query1 != null && $query2 != null && $query8 != null) {
               echo "1";
            } else {
               printf("Errormessage: %s\n", $conexion->error);
               echo $sql8;
               echo $sql2;
               echo $sql1;
            }
         }
         break;
      case 'updateCot':
         if (isset($_POST['verifi']) && $_POST['verifi'] == 1) {
            $sql = "SELECT * FROM cot_cotizaciones ORDER BY id_coti DESC";
            $query = $conexion->query($sql);
            $r = $query->fetch(PDO::FETCH_ASSOC);
            echo $r['doc_coti'];
         } elseif (isset($_POST['verifi']) && $_POST['verifi'] == 2) {
            $sql = "SELECT * FROM cot_cotizaciones WHERE id_coti=" . $_POST['id_coti'];
            $query = $conexion->query($sql);
            $r = $query->fetch(PDO::FETCH_ASSOC);
            echo $r['doc_coti'];
         } else {
            $usu = $_SESSION['usu'];
            $nom = $_SESSION['nom'];
            $id = $_SESSION['id'];
            if (isset($_POST["productos"])) {
               $id_coti        = $_POST["id_coti"];
               $id_cli         = $_POST["id_cli"];
               $id_cont        = $_POST["id_cont"];
               $dia_ent        = $_POST["dia_ent"];
               $for_pag        = $_POST["for_pag"];
               $id_ciu         = $_POST["id_ciu"];
               $tip_cot        = $_POST["tip_cot"];
               $val_cot        = $_POST["val_cot"];
               $idAse          = $_POST['ced_ase'];
               $idSac          = $_POST['ced_sac'];
               $productos      = $_POST["productos"];
               $precios        = $_POST["precios"];
               $descripciones  = $_POST["descripciones"];
               $observaciones  = $_POST["observaciones"];
               $nombres        = $_POST["nombres"];
               $cantidad       = $_POST["cantidad"];
               $total          = 0;
               $iva            = $_POST["iva"];
               $remitir        = $_POST["remitir"];
               $rem_ciu        = $_POST["rem_ciu"];
               for ($i = 0; $i < count($productos); $i++) {
                  $sqlP = "SELECT can_emp FROM cot_productos WHERE cod_pro=" . $productos[$i];
                  $queryP = $conexion->query($sqlP);
                  $rP = $queryP->fetch(PDO::FETCH_ASSOC);
                  $total = $total + ($precios[$i] * $cantidad[$i] * $rP['can_emp']);
               }
               $sql = "SELECT * from cot_cotizaciones where id_coti=$id_coti";
               $query = $conexion->query($sql);
               $r = $query->fetch(PDO::FETCH_ASSOC);
               $cot = $r["id_coti"];
               $id = $r["id_usu"];
               $ruta = "../cotizadorv3/cotizaciones.controller.php?id_coti=" . $cot . "&tip_cot=" . $tip_cot . "&id_cli=" . $id_cli . "&id=" . $id . "&id_cont=" . $id_cont;
               $sql1 = "UPDATE `cot_cotizaciones` SET
                              `id_coti`		=$cot,
                              `doc_coti`	   ='$ruta',
                              `fec_coti`	   ='$fecha',
                              `id_cli`		   ='$id_cli',
                              `ced_ase`		='$idAse',
                              `ced_sac`		='$idSac',
                              `dia_ent`		='$dia_ent',
                              `for_pag`		='$for_pag',
                              `id_tip_cot`	=$tip_cot,
                              `cost_cot`	   =$total,
                              `val_cot`      ='$val_cot',
                              `id_cont`		=$id_cont,
                              `cot_iva`		=$iva";
               if ($_POST['remitir'] == 1) {
                  $sql1 .= ", `rem_ciu`='$rem_ciu'";
               } else {
                  $sql1 .= ", `rem_ciu`=NULL";
               }
               $sql1 .= " where id_coti=$id_coti";
               $query1 = $conexion->query($sql1);
               if (!$query1) {
                  echo $sql1;
               }
               $sql9 = "DELETE FROM `cot_pro_x_cot` where `id_coti`=$id_coti";
               $query9 = $conexion->query($sql9);
               if (!$query9) {
                  echo $sql9;
               }
               for ($i = 0; $i < count($productos); $i++) {
                  $desc = $descripciones[$i];
                  $obs = $observaciones[$i];
                  $sql2 = "INSERT INTO `cot_pro_x_cot`(`id_coti`, `cod_pro`, `pre_cot`, `des_pro_cot`, `obs_prod`, `can_com`, `nom_pro_cot`)  
                                    VALUES ($id_coti, '$productos[$i]', $precios[$i],'$desc','$obs','$cantidad[$i]','$nombres[$i]')";
                  $query2 = $conexion->query($sql2);
                  if (!$query2) {
                     echo $sql2;
                  }
               }
            }
            if ($query1 != null && $query2 != null && $query9 != null) {
               echo "1";
            } else {
               printf("Errormessage: %s\n", $conexion->error);
               echo $sql1;
               echo $sql2;
            }
         }
         break;
      case 'addSubCot':
         $file = "../../documentos/cotizador/docs/";
         opendir($file);
         $nombre = uniqid() . ".pdf";
         $destino = $file . $nombre;
         copy($_FILES['docum']['tmp_name'], $destino);
         $documento = $_FILES['docum']['name'];         
         $sql12 = 'SELECT cns_cotz FROM mq_usu where id_usu="' . $_SESSION['id'] . '"';
         $query12 = $conexion->query($sql12);
         $r12 = $query12->fetch(PDO::FETCH_ASSOC);
         $cns = $r12['cns_cotz'] + 1;
         $sql = "INSERT INTO `cot_cotizaciones` (`doc_coti`,
                                                `fec_coti`,
                                                `id_cli`,
                                                `id_cont`,
                                                `id_usu`,
                                                `dia_ent`,
                                                `for_pag`,
                                                `cost_cot`,
                                                `id_tip_cot`,
                                                `cns_coti`, 
                                                `val_cot`, 
                                                `est_cot`)
                                             VALUES ('$nombre',
                                                   '$fecha',
                                                   '" . $_POST['id_cli'] . "',
                                                   '" . $_POST['id_cont'] . "',
                                                   '" . $_SESSION['id'] . "',
                                                   '" . $_POST['dia_ent'] . "',
                                                   '" . $_POST['for_pag'] . "',
                                                   '" . $_POST['cost_cot'] . "',
                                                   '" . $_POST['tip_cot'] . "',
                                                   $cns,
                                                   '" . $_POST['cost_cot'] . "',
                                                   '1')";
         $query = $conexion->query($sql);
         $sql8 = "UPDATE `mq_usu` SET `cns_cotz`=cns_cotz+1 WHERE id_usu=" . $_SESSION['id'];
         $query8 = $conexion->query($sql8);
         if ($query != null && $query8 != null) {
            echo 'Cotización creada correctamente.';
         } else {
            echo 'No se ha podido creada. Contacta con el Administrador. <br>'.$sql;
         }
         break;
      case 'updateSubCoti':
         $sql = "UPDATE `cot_cotizaciones` SET `id_cli`    ='" . $_POST['id_cli'] . "',
                                                   `id_cont`   ='" . $_POST['id_cont'] . "',
                                                   `for_pag`   ='" . $_POST['for_pag'] . "',
                                                   `dia_ent`   ='" . $_POST['dia_ent'] . "',
                                                   `id_tip_cot`='" . $_POST['tip_cot'] . "',
                                                   `cost_cot`  ='" . $_POST['cost_cot'] . "'";
         if (!empty($_FILES['docum']['name'])) {
            $file = "../../documentos/cotizador/docs/";
            opendir($file);
            $nombre = uniqid() . ".pdf";
            $destino = $file . $nombre;
            copy($_FILES['docum']['tmp_name'], $destino);
            $documento = $_FILES['docum']['name'];
            $ruta = $destino;
            if (file_exists($_POST['documActu'])) {
               unlink($_POST['documActu']);
            }
            $sql .= " ,`doc_coti`   ='$nombre'";
         }
         $sql .= " WHERE `id_coti`   ='" . $_POST['id_coti'] . "'";
         $query = $conexion->query($sql);
         if ($query != null) {
            echo 'Cotización actualizada correctamente.';
         } else {
            echo 'No se ha podido creada. Contacta con el Administrador.';
         }
         break;
     
      case 'addProd':
         $sqlP = "SELECT * FROM `cot_productos` WHERE cod_ref= '" . $_POST['cod_ref1'] . "'";
         $queryP = $conexion->query($sqlP);
         if ($queryP->rowCount() > 0) {
            echo '<div class="alert alert-danger">
                           <b>¡No se ha podido agregar!</b> Puede que el producto o la referencia ya exista.' . $sqlP . '
                        </div>';
         } else {
            $sql2 = "SELECT max(cod_pro) from cot_productos";
            $query2 = $conexion->query($sql2);
            $r = $query2->fetch(PDO::FETCH_ASSOC);
            $prod = $r["max(cod_pro)"] + 1;
            $file = "../../documentos/cotizador/images/";
            opendir($file);
            $foto = $_FILES['foto']['name'];
            $destino = $file . $foto;
            copy($_FILES['foto']['tmp_name'], $destino);
            $sql = "INSERT INTO cot_productos (`cod_pro`, 
                                                `cod_ref`, 
                                                `nom_pro`, 
                                                `des_pro`, 
                                                `img_pro`, 
                                                `und_emp`, 
                                                `can_emp`, 
                                                `cat_prod`,
                                                `sin_dev`)                                                
                                       VALUES ($prod,
                                                '" . $_POST['cod_ref1'] . "',
                                                '" . $_POST['nom_pro1'] . "',
                                                '" . $_POST['des_pro1'] . "',
                                                '" . $foto . "',
                                                '" . $_POST['und_emp1'] . "',
                                                '" . $_POST['can_emp1'] . "',
                                                '" . $_POST['cat_prod'] . "',";
            if (isset($_POST['sin_dev1']) && $_POST['sin_dev1'] != '') {
               $sql .= "'" . $_POST['sin_dev1'] . "'";
            } else {
               $sql .= "0";
            }
            $sql .= ")";
            $query = $conexion->query($sql);
            $sql3 = "INSERT INTO `cot_precios`(`cod_pro`,
                                                `pre_pro`)
                                        VALUES ($prod,
                                                '" . $_POST['pre_pro1'] . "')";
            $query3 = $conexion->query($sql3);
            if ($query != null) {
               echo '<div class="alert alert-success col-md-12">
                        <a href="#" class="close" data-bs-dismiss="alert" aria-label="close">&times;</a>
                        <b>¡Se ha agregado el producto correctamente!</b> Puedes continuar con otro proceso en el Cotizador.
                     </div>';
                        //echo $sql;
                        //echo $sql3;
                        //echo $sql2;
            } else {
               echo '<div class="alert alert-danger col-md-12">
                        <a href="#" class="close" data-bs-dismiss="alert" aria-label="close">&times;</a>
                        <b>¡No se ha podido agregar!</b> Contacta con el administrador.
                     </div>';
            }
         }
         break;
      case 'updateProd':
         if (!empty($_FILES['foto']['name'])) {
            $file = "../../documentos/cotizador/images/";
            opendir($file);
            $foto = $_FILES['foto']['name'];
            $destino = $file . $foto;
            copy($_FILES['foto']['tmp_name'], $destino);
            $sqlP = "SELECT img_pro FROM cot_productos WHERE cod_pro = " . $_POST['cod_pro1'];
            $queryP = $conexion->query($sqlP);
            $r = $queryP->fetch(PDO::FETCH_ASSOC);
            if (file_exists($file . $r["img_pro"])) {
               unlink($file . $r["img_pro"]);
            }
         }
         $sql = "UPDATE cot_productos SET cod_ref = '" . $_POST['cod_ref1'] . "', 
                                           nom_pro = '" . $_POST['nom_pro1'] . "', 
                                           des_pro = '" . $_POST['des_pro1'] . "', 
                                           can_emp = '" . $_POST['can_emp1'] . "', 
                                           und_emp = '" . $_POST['und_emp1'] . "',
                                           cat_prod ='" . $_POST['cat_prod'] . "' ";
         if (isset($_POST['sin_dev1']) && $_POST['sin_dev1'] != '') {
            $sql .= ", sin_dev = '" . $_POST['sin_dev1'] . "'";
         } else {
            $sql .= ", sin_dev = '0'";
         }
         if (!empty($_FILES['foto']['name'])) {
            $sql .= ", img_pro = '$foto'";
         }
         $sql .= "WHERE cod_pro = '" . $_POST['cod_pro1'] . "'";
         $query = $conexion->query($sql);
         $sqlPrecio = "UPDATE cot_precios SET pre_pro = '" . $_POST['pre_pro1'] . "' WHERE cod_pro = " . $_POST['cod_pro1'];
         $query = $conexion->query($sqlPrecio);
         if ($query != null) {
            echo '<div class="alert alert-success col-md-12">
                        <a href="#" class="close" data-bs-dismiss="alert" aria-label="close">&times;</a>
                        <b>¡Se ha actualizado el producto correctamente!</b> Puedes continuar con otro proceso en el Cotizador.
                     </div>'; 
                      //echo $sql;
                      //echo $sqlPrecio;
         } else {
            echo '<div class="alert alert-danger col-md-12">
                        <a href="#" class="close" data-bs-dismiss="alert" aria-label="close">&times;</a>
                        <b>¡No se ha podido actualizar!</b> Contacta con el administrador.
                     </div>';
         }
         break;
      case 'elimProd':
         $sql = "DELETE FROM cot_productos WHERE cod_pro=" . $_POST['elim'];
         $query = $conexion->query($sql);
         if ($query != null) {
            echo '¡Se ha eliminado el producto correctamente!';
         } else {
            echo '¡No se ha podido eliminar! Contacta con el administrador.';
         }
         break;
      case 'updateDatos':
         $sql = "UPDATE mq_usu SET nom_usu='" . $_POST['nom_usu'] . "',
                                    ext_usu='" . $_POST['ext_usu'] . "',
                                    cel2_usu='" . $_POST['cel2_usu'] . "',";
         if ($_POST['cel_usu'] != '') {
            $sql .= "cel_usu='" . $_POST['cel_usu'] . "',";
         } else {
            $sql .= "cel_usu=NULL,";
         }
         $sql .= "nom_cns='" . $_POST['nom_cns'] . "',
                                          cns_cotz='" . $_POST['cns_cotz'] . "'
                                    WHERE id_usu='" . $_POST['id_usu'] . "'";
         $query = $conexion->query($sql);
         if ($query != null) {
            echo '<div class="alert alert-success">
                        <b>¡Se han actualizado tus datos correctamente!</b> Puedes continuar con otro proceso en el Cotizador.
                     </div>';
         } else {
            echo '<div class="alert alert-danger">
                        <b>¡No se ha podido actualizar!</b> Contacta con el administrador.
                     </div>';
         }
         break;
      case 'contacto':
         $sql = "SELECT id_cont, nom_cont 
                           FROM contactos
                           WHERE id_cli=" . $_POST['id_cli'];
         $query = $conexion->query($sql);
         if ($query->rowCount() > 0) {
            echo '<option value="">-- por favor, seleccione --</option>';
            while ($r = $query->fetch(PDO::FETCH_ASSOC)) {
               echo '<option value="' . $r['id_cont'] . '">' . $r["nom_cont"] . '</option>';
            }
         } else {
            echo '<option value="">No hay contactos</option>';
         }
         break;
      case 'select':
         if ($_POST['id_usu'] == '') {
            echo 0;
         } else {
            $sql = "SELECT * FROM mq_usu where id_usu=" . $_POST['id_usu'];
            $query = $conexion->query($sql);
            if ($query != null) {
               $r = $query->fetch(PDO::FETCH_ASSOC);
               echo '<option value="' . $r['id_usu'] . '">' . $r['nom_usu'] . '</option>';
               if ($_POST['param'] == 1) {
                  $sqlO = "SELECT * FROM mq_usu where id_usu!='" . $r['nom_usu'] . "' and id_are IN (11,6) order by nom_usu";
                  $queryO = $conexion->query($sqlO);
                  while ($r2 = $queryO->fetch(PDO::FETCH_ASSOC)) {
                     echo '<option value="' . $r2['id_usu'] . '">' . $r2['nom_usu'] . '</option>';
                  }
               } else {
                  $sqlO = "SELECT * FROM mq_usu where id_usu!='" . $r['nom_usu'] . "' and id_car=3 order by nom_usu";
                  $queryO = $conexion->query($sqlO);
                  while ($r2 = $queryO->fetch(PDO::FETCH_ASSOC)) {
                     echo '<option value="' . $r2['id_usu'] . '">' . $r2['nom_usu'] . '</option>';
                  }
               }
            }
         }
         break;
         /// Funciones de la tabla Cotizaciones para actualización ////
      case 'updateSol':
         include 'fechFestivos.php';
         $sqlDif=" SELECT `fec_coti` , `env_cot`  FROM `cot_cotizaciones` WHERE `id_coti`='" . $_POST['id_coti'] . "'";
         $queryDif=$conexion->query($sqlDif);
         $rdif=$queryDif->fetch(PDO::FETCH_ASSOC);
         $fech_ini = $rdif['fec_coti'];
         $fech_fin = $rdif['env_cot'];
         $arrayDates = getDateHoliday($year);
         $habil = getDiasHabiles($fech_ini, $fech_fin, $arrayDates);
         $habilC = count($habil);
         if (count($habil) == 1) {
         $habil2= $habilC;
         }else{
            $habil2= ($habilC-1);
         }
         $sqlCot .= "sol_cot=\"$_POST[sol_cot]\",
                     env_cot ='$date',
                     dif_diasEn = '$habil2',
                     sol_upd ='$fecha'
                     WHERE id_coti=\"$_POST[id_coti]\"";
         $query = $conexion->query($sqlCot);
         if ($query != null) {
            echo 1;
         } else {
            echo 'No se pudo actualizar';
         }
         break;
      case 'updatePrc':
         $sql1 = "DELETE FROM cot_cat_dlg WHERE id_coti='" . $_POST['id_coti'] . "'";
         $query1 = $conexion->query($sql1);
         if (isset($_POST['id_cat']) && $_POST['id_cat'] != '') {
            $cat = $_POST['id_cat'];
            if ($cat != null) {
               foreach ($cat as $r) {
                  $sql2 = "INSERT INTO cot_cat_dlg values($r,$_POST[id_coti])";
                  $query2 = $conexion->query($sql2);
               }
            }
            if ($query2 != null) {
               $sql3 = "SELECT GROUP_CONCAT(nom_cat SEPARATOR ', ') as prc FROM cot_categoria,cot_cat_dlg WHERE cot_categoria.id_cat=cot_cat_dlg.id_cat And id_coti='" . $_POST['id_coti'] . "'";
               $query3 = $conexion->query($sql3);
               $r1 = $query3->fetch(PDO::FETCH_ASSOC);
               $prc = $r1['prc'];
               $sqlCot .= "prc_cot='$prc',
                  prc_upd='$fecha'
                  WHERE id_coti=\"$_POST[id_coti]\"";
            }
            $query = $conexion->query($sqlCot);
            $sql4 = "SELECT prc_cot FROM cot_cotizaciones where id_coti='" . $_POST['id_coti'] . "'";
            $query4 = $conexion->query($sql4);
            $r4 = $query4->fetch(PDO::FETCH_ASSOC);
            if ($query != null) {
               echo '<textarea name="prc_cot" class="form-control" style="resize: none; font-size: 11px;" readonly>' . $r4["prc_cot"] . '</textarea>';
            } else {
               echo 1;
            }
         } else {
            $sql2 = "UPDATE cot_cotizaciones SET prc_cot='', prc_upd='$fecha' WHERE id_coti='" . $_POST['id_coti'] . "'";
            $query2 = $conexion->query($sql2);
            echo '<textarea name="prc_cot" class="form-control" style="resize: none; font-size: 11px;" readonly></textarea>';
         }
      break;
      case 'recoAprob':
         $sqlCot .= "direccion_1=\"$_POST[dir_uno]\",
                     direccion_2=\"$_POST[dir_dos]\",
                     date_mypro ='$fecha',
                     post_code =\"$_POST[cod_post]\",
                     id_pag=\"$_POST[pag_mypro]\",
                     id_tip_pedi=\"$_POST[tip_pedido]\"
                     WHERE id_coti=\"$_POST[id_coti]\"";
         $queryCot=$conexion->query($sqlCot);
         if ( $queryCot != null) {
            echo 'Pedido enviado correctamente a Myprocess.';
         } else {
            echo 'No se ha podido Enviar la cotización. Contacta con el Administrador.'.$sqlCot;
         }
      break;
      case 'updateEnv':
         include 'fechFestivos.php';
         ini_set('display_errors', 1);
         ini_set('display_startup_errors', 1);
         error_reporting(E_ALL);
         $sqlbb= "SELECT * FROM cot_cotizaciones coti, contactos cont 
                  WHERE coti.id_cont=cont.id_cont
                  AND coti.id_coti='" . $_POST['id_coti'] . "'";
         $querybb= $conexion->query($sqlbb);
         $rb = $querybb->fetch(PDO::FETCH_ASSOC);
         $sqlDif=" SELECT `fec_coti` , `env_cot`  FROM `cot_cotizaciones` WHERE `id_coti`='" . $_POST['id_coti'] . "'";
         $queryDif=$conexion->query($sqlDif);
         $rdif=$queryDif->fetch(PDO::FETCH_ASSOC);
         $fech_ini = $rdif['fec_coti'];
         $fech_fin = $rdif['env_cot'];
         $arrayDates = getDateHoliday($year);
         $habil = getDiasHabiles($fech_ini, $fech_fin, $arrayDates);
         $habilC = count($habil);
         if (count($habil) == 1) {
         $habil2= $habilC;
         }else{
            $habil2= ($habilC-1);
         }
         $sqlCot .= "env_cot=\"$_POST[env_cot]\",
                     dif_diasEn='$habil2',
			            env_upd='$date'
			   WHERE id_coti=\"$_POST[id_coti]\"";
         $query = $conexion->query($sqlCot);
         if ($query != null) {
            echo 1;
         } else {
            echo 'No se pudo actualizar';
         }
         break;
      case 'updateEst':
         $sqlCot .= "est_cot=\"$_POST[est_cot]\",
            est_upd='$fecha',
            conf_cotiz=\"$_POST[nom_cont]\"
            WHERE id_coti=\"$_POST[id_coti]\"";
         $query = $conexion->query($sqlCot);
         if ($query != null) {
            echo 1;
            //echo $sqlCot;
         } else {
            echo $sqlCot;
            echo 'No se pudo actualizar.';
         }
         break;
      case 'updateCom':
         $sqlCot .= "com_cot=\"$_POST[com_cot]\",
			   com_upd='$fecha'
			   WHERE id_coti=\"$_POST[id_coti]\"";
         $query = $conexion->query($sqlCot);
         if ($query != null) {
            echo 1;
         } else {
            echo 'No se pudo actualizar';
         }
      break;
      
      case 'updatePer':
         $sqlCot .= "conf_cotiz=\"$_POST[conf_cotiz]\",
			   com_upd='$fecha'
			   WHERE id_coti=\"$_POST[id_coti]\"";
         $query = $conexion->query($sqlCot);
         if ($query != null) {
            echo 1;
         } else {
            echo 'No se pudo actualizar';
         }
      break;
      
      case 'updateMot':
         $sqlCot .= "mot_cot=\"$_POST[mot_cot]\",
			   mot_upd='$fecha'
			   WHERE id_coti=\"$_POST[id_coti]\"";
         $query = $conexion->query($sqlCot);
         if ($query != null) {
            echo 1;
         } else {
            echo 'No se pudo actualizar';
         }
         break;
      case 'updateLlam':
         $sqlCot .= "llam_cot=\"$_POST[llam_cot]\",
			   llam_upd='$fecha'
			   WHERE id_coti=\"$_POST[id_coti]\"";
         $query = $conexion->query($sqlCot);
         if ($query != null) {
            echo 1;
         } else {
            echo 'No se pudo actualizar';
         }
         break;
      case 'remCiu':
         $sql = "SELECT * FROM cot_ciudad order by nom_ciu";
         $query = $conexion->query($sql);
         if ($query != null) {
            echo '<select class="form-select" id="remCiu" name="remCiu" style="height: 35px;" required>
								<option value="">Seleccionar</option>';
            while ($r = $query->fetch(PDO::FETCH_ASSOC)) {
               echo '<option value=' . $r['id_ciu'] . '>' . $r['nom_ciu'] . '</option>';
            }
            echo '</select>';
         } else {
            echo $sql;
         }
         break;
         case 'email':
            include 'fechFestivos.php';
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
            $sqlbb= "SELECT * FROM cot_cotizaciones coti, contactos cont 
                     WHERE coti.id_cont=cont.id_cont
                     AND coti.id_coti='" . $_POST['id_coti'] . "'";
            $querybb= $conexion->query($sqlbb);
            $rb = $querybb->fetch(PDO::FETCH_ASSOC);
            $sqlDif=" SELECT `fec_coti` , `env_cot`  FROM `cot_cotizaciones` WHERE `id_coti`='" . $_POST['id_coti'] . "'";
            $queryDif=$conexion->query($sqlDif);
            $rdif=$queryDif->fetch(PDO::FETCH_ASSOC);
            $fech_ini = $rdif['fec_coti'];
            $fech_fin = $rdif['env_cot'];
            $arrayDates = getDateHoliday($year);
            $habil = getDiasHabiles($fech_ini, $fech_fin, $arrayDates);
            $habilC = count($habil);
            if (count($habil) == 1) {
            $habil2= $habilC;
            }else{
               $habil2= ($habilC-1);
            }
         
            $sqlEm=" UPDATE `cot_cotizaciones` SET    `env_cot`= '$date',
                                                      `id_ema` = '1',
                                                      `sol_cot`= '2',
                                                      `dif_diasEn` = '$habil2',
                                                      `conf_cotiz` = '".$rb['nom_cont']."'
                                               WHERE  `id_coti`=" . $_POST['id_coti'];
            $queryEm=$conexion->query($sqlEm);
            
            $sqlU=" SELECT  us.nom_usu
            FROM cot_estados_cot es, mq_usu us, cot_cotizaciones cot
            WHERE cot.id_usu=us.id_usu
            AND cot.id_coti=".$_POST['id_coti'];
            $queryU= $conexion->query($sqlU);
            $rU=$queryU->fetch(PDO::FETCH_ASSOC);
 
            $sqlMov="INSERT INTO `cot_x_mov` (`id_coti`,
                                             `id_estado`,
                                             `nom_estado`, 
                                             `id_usu`,
                                             `nom_usu`,
                                             `fec_mov`)
                                       VALUES('".$_POST['id_coti']."',
                                             '1',
                                             'Enviado',
                                             '".$_SESSION['id']."',
                                             '".$rU['nom_usu']."',
                                             '$fecha')";
            $queryMov=$conexion->query($sqlMov);
            include 'Email.php';
            if ( $queryEm != null) {
               echo 'Cotización enviada correctamente.'; 
            } else {
               echo 'No se ha podido Enviar la cotización. Contacta con el Administrador.'.$sqlEm;
            }
            break;
         
            case 'emailMas':
               include 'fechFestivos.php';
               $sqlbb= "SELECT * FROM cot_cotizaciones coti, contactos cont 
                     WHERE coti.id_cont=cont.id_cont
                     AND coti.id_coti='" . $_POST['id_coti'] . "'";
               $querybb= $conexion->query($sqlbb);
               $rb = $querybb->fetch(PDO::FETCH_ASSOC);
                  
               $sqlDif=" SELECT `fec_coti` , `env_cot`  FROM `cot_cotizaciones` WHERE `id_coti`='" . $_POST['id_coti'] . "'";
               $queryDif=$conexion->query($sqlDif);
               $rdif=$queryDif->fetch(PDO::FETCH_ASSOC);
               $fech_ini = $rdif['fec_coti'];
               $fech_fin = $rdif['env_cot'];
               $arrayDates = getDateHoliday($year);
               $habil = getDiasHabiles($fech_ini, $fech_fin, $arrayDates);
               $habilC = count($habil);
               if (count($habil) == 1) {
               $habil2= $habilC;
               }else{
                  $habil2= ($habilC-1);
               }
               $sqlEm=" UPDATE `cot_cotizaciones` SET  `envio_masiv`= '1',
                                                      `id_ema` = '1',
                                                      `sol_cot`= '2',
                                                      `dif_diasEn` ='$habil2',
                                                      `conf_cotiz` = '".$rb['nom_cont']."'
                                                WHERE  `id_coti`=" . $_POST['id_coti'];
               $queryEm=$conexion->query($sqlEm);
               $sqlEmai=" INSERT INTO `cot_cont_ema` (`id_coti`,
                                                      `fec_ema`,
                                                      `email_contacto`,
                                                      `nom_contacto`";
                                    if(isset($_POST['ema_ema2']) && $_POST['ema_ema2']!=''){
                                       $sqlEmai.=", `email_contacto1`";
                                    }
                                    if(isset($_POST['nom_ema2']) && $_POST['nom_ema2']!=''){
                                       $sqlEmai.=", `nom_contacto1`";
                                    }
                                    if(isset($_POST['ema_ema3']) && $_POST['ema_ema3']!=''){
                                       $sqlEmai.=",`email_contacto2`";
                                    }
                                    if(isset($_POST['nom_ema3']) && $_POST['nom_ema3']!=''){
                                       $sqlEmai.=",`nom_contacto2`";
                                    }
                                    if(isset($_POST['ema_ema4']) && $_POST['ema_ema4']!=''){
                                       $sqlEmai.=" ,`email_contacto3`";
                                    }
                                    if(isset($_POST['nom_ema4']) && $_POST['nom_ema4']!=''){
                                       $sqlEmai.=", `nom_contacto3`";
                                    }
                                       $sqlEmai.= " ) VALUES(
                                                   '".$_POST['id_coti']."',
                                                   '$fecha', 
                                                   '".$_POST['ema_ema1']."',
                                                   '".$_POST['nom_ema1']."'";
                                    if(isset($_POST['ema_ema2']) && $_POST['ema_ema2']!=''){
                                       $sqlEmai.=", '".$_POST['ema_ema2']."'";
                                    }
                                    if(isset($_POST['nom_ema2']) && $_POST['nom_ema2']!=''){
                                       $sqlEmai.=", '".$_POST['nom_ema2']."'";
                                    }
                                    if(isset($_POST['ema_ema3']) && $_POST['ema_ema3']!=''){
                                       $sqlEmai.=", '".$_POST['ema_ema3']."'";
                                    }
                                    if(isset($_POST['nom_ema3']) && $_POST['nom_ema3']!=''){
                                       $sqlEmai.=", '".$_POST['nom_ema3']."'";
                                    }
                                    if(isset($_POST['ema_ema4']) && $_POST['ema_ema4']!=''){
                                       $sqlEmai.=", '".$_POST['ema_ema4']."'";
                                    }
                                    if(isset($_POST['nom_ema4']) && $_POST['nom_ema4']!=''){
                                       $sqlEmai.=", '".$_POST['nom_ema4']."'";
                                    }
                                    $sqlEmai.=" ) ";
               $queryEmai=$conexion->query($sqlEmai);
               include 'Email.php';
               if ( $queryEmai != null && $sqlEm != null) {
                  echo 'Cotización enviada correctamente.';
               } else {
                  echo 'No se ha podido Enviar la cotización. Contacta con el Administrador.'.$sqlEmai . $sqlEm;
               }
               break;
            
            case 'aprobado': 
               $sqlaprob=" UPDATE `cot_cotizaciones` SET    `id_ema` = '2'
                                                  WHERE  `id_coti`=" . $_POST['id_coti'];
               $queryaprob=$conexion->query($sqlaprob);
               $sqlEst=" SELECT es.nom_ema , cot.id_ema , cot.id_cli, cl.nom_cli
               FROM cot_ema_est es, cot_cotizaciones cot,  mq_clie cl
               WHERE cot.id_ema=es.id_ema
               AND cot.id_cli=cl.id_cli
               AND cot.id_coti=".$_POST['id_coti'];
               $queryEst= $conexion->query($sqlEst);
               $rE=$queryEst->fetch(PDO::FETCH_ASSOC);
               $sqlMov="INSERT INTO `cot_x_mov` (`id_coti`,
                                                `id_estado`,
                                                `nom_estado`, 
                                                `id_usu`,
                                                `nom_usu`,
                                                `fec_mov`)
                                          VALUES('".$_POST['id_coti']."',
                                                '2',
                                                '".$rE['nom_ema']."',
                                                '".$rE['id_cli']."',
                                                '".$rE['nom_cli']."',
                                                '$fecha')";
               $queryMov=$conexion->query($sqlMov);
               include 'Email.php';
               if ( $queryaprob != null) {
                  echo 1;
               } else {
                  echo '<div class="alert alert-danger">
                      <strong>No se pudo actualizar.</strong>
                    </div>';
               }
            break;
            
            case 'rechazado': 
               $sqlrech=" UPDATE `cot_cotizaciones` SET    `id_ema` = '3'
                                                  WHERE  `id_coti`=" . $_POST['id_coti'];
               $queryrech=$conexion->query($sqlrech);
               $sqlEst=" SELECT es.nom_ema , cot.id_ema , cot.id_cli, cl.nom_cli
               FROM cot_ema_est es, cot_cotizaciones cot, mq_clie cl
               WHERE cot.id_ema=es.id_ema
               AND cot.id_cli=cl.id_cli
               AND cot.id_coti=".$_POST['id_coti'];
               $queryEst= $conexion->query($sqlEst);
               $rE=$queryEst->fetch(PDO::FETCH_ASSOC);
                 $sqlMov="INSERT INTO `cot_x_mov` (`id_coti`,
                                                `id_estado`,
                                                `nom_estado`, 
                                                `id_usu`, 
                                                `fec_mov`,
                                                `nom_usu`)
                                          VALUES('".$_POST['id_coti']."',
                                                '3',
                                                '".$rE['nom_ema']."',
                                                '".$rE['id_cli']."',
                                                '$fecha',
                                                '".$rE['nom_cli']."')";
               $queryMov=$conexion->query($sqlMov);
               include 'Email.php';
               if ( $queryrech != null) {
                  echo 2;
               } else {
                  echo '<div class="alert alert-danger">
                      <strong>No se pudo actualizar.</strong>
                    </div>';
               }
            break;
   }
}
