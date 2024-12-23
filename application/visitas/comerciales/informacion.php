<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';
if (isset($_POST['id_agen']) && $_POST['id_agen'] != '') {
      $sqlAgen = "SELECT nom_raz,nom_est,nom_cli,com.id_cli,hor_cli,tel_cli,com.dir_cli,obs_agen,com.fec_cre,fec_fin,lat_ini,lon_ini,lat_fin,lon_fin,nom_con
            FROM agen_com as com,mq_clie as cl , agen_est as est, agen_raz as raz
            WHERE com.id_cli=cl.id_cli
            AND com.id_est=est.id_est
            AND com.id_raz=raz.id_raz
            AND id_agen=" . $_POST['id_agen'];
      $queryAgen = $conexion->query($sqlAgen);
      $r = $queryAgen->fetch_array();
}

?>
<div class="row">
      <div class="col-md-12 text-center">
            <h5 class="col-md-12" for="nom_est">Estado: <?php echo $r['nom_est']; ?></h5>
            <hr style="width: 60%;">
      </div>
</div>
<div class="row">
      <div class="col-md-12">
            <ul class="list-group text-center mr-0">
                  <li class="list-group-item p-1 mr-0">Cliente: <b class="ml-auto bg-light border-rounded p-2"><?php echo utf8_encode($r['nom_cli']); ?></b></li>
                  <li class="list-group-item p-1">Contacto: <b class="ml-auto bg-light border-rounded p-2"><?php echo $r['nom_con']; ?></b></li>
                  <li class="list-group-item p-1">Dirección: <b class="ml-auto bg-light border-rounded p-2"><?php echo $r['dir_cli']; ?></b></li>
                  <li class="list-group-item p-1">Teléfono: <b class="ml-auto bg-light border-rounded p-2"><?php echo $r['tel_cli']; ?></b></li>
                  <li class="list-group-item p-1">Fecha de cita: <b class="ml-auto bg-light border-rounded p-2"><?php echo $r['fec_cre']; ?></b></li>
                  <?php if ($r['nom_est'] != 'Cancelada') { ?>
                        <li class="list-group-item p-1">Fecha de finalización: <b class="ml-auto bg-light border-rounded p-2"><?php echo $r['fec_fin']; ?></b></li>
                        <?php if ($_SESSION['com'] == 1 || $_SESSION['com'] == 2) { ?>
                              <!--Aqui va el mapa pero no sirve-->
                              <div class="col-md-12" style="margin-bottom: inherit;">
                                    <!--<label class="col-md-5" for="fec">Ubicaciones:</label>-->
                                    <input type="hidden" id="lat_ini2" value="<?= $r['lat_ini'] ?>">
                                    <input type="hidden" id="lon_ini2" value="<?= $r['lon_ini'] ?>">
                                    <input type="hidden" id="lat_fin2" value="<?= $r['lat_fin'] ?>">
                                    <input type="hidden" id="lon_fin2" value="<?= $r['lon_fin'] ?>">
                              </div>
                  <?php }
                  } ?>
                  <li class="list-group-item p-1">Razón: <b class="ml-auto bg-light border-rounded p-2"><?php echo utf8_encode($r['nom_raz']); ?></b></li>
                  <li class="list-group-item p-1">Motivo: <b class="ml-auto bg-light border-rounded p-2"><?php echo utf8_encode($r['obs_agen']); ?></b></li>
                  <?php if ($_SESSION['com'] == 1 || $_SESSION['com'] == 2) { 
                     include 'mapa.php';
                  } ?>
            </ul>
      </div>
</div>