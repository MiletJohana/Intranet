<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';

      if (isset($_POST['id_agen']) && $_POST['id_agen'] != '') {
            $sqlAgen = "SELECT nom_raz,nom_est,nom_cli,com.id_cli,tel_cli,com.dir_cli,obs_agen,com.fec_cre,fec_fin,lat_ini,lon_ini,lat_fin,lon_fin,nom_con, concl_agen
                  FROM agen_comerciales as com,mq_clientes as cl , agen_est as est, agen_raz as raz
                  WHERE com.id_cli=cl.id_cli
                  AND com.id_est=est.id_est
                  AND com.id_raz=raz.id_raz
                  AND id_agen=" . $_POST['id_agen'];
            $queryAgen = $conexion->query($sqlAgen);
            $r = $queryAgen->fetch(PDO::FETCH_ASSOC);
      }
?>
<div class="row">
      <div class="col-12 text-center">
            <h5 class="col-12" for="nom_est">Estado: <?php echo $r['nom_est']; ?></h5>
            <hr class="mx-auto" style="width:60%;">
      </div>
</div>
<div class="row">
      <div class="col-12">
             <ul class="list-group list-group-flush">
                  <li class="list-group-item p-1 d-flex justify-content-between">Cliente: <span class="badge bg-secondary rounded-pill"><?php echo $r['nom_cli']; ?></span></li>
                  <li class="list-group-item p-1 d-flex justify-content-between">Contacto: <span class="badge bg-secondary rounded-pill"><?php echo $r['nom_con']; ?></span></li>
                  <li class="list-group-item p-1 d-flex justify-content-between">Dirección: <span class="badge bg-secondary rounded-pill"><?php echo $r['dir_cli']; ?></span></li>
                  <li class="list-group-item p-1 d-flex justify-content-between">Teléfono: <span class="badge bg-secondary rounded-pill"><?php echo $r['tel_cli']; ?></span></li>
                  <li class="list-group-item p-1 d-flex justify-content-between">Fecha de cita: <span class="badge bg-secondary rounded-pill"><?php echo $r['fec_cre']; ?></span></li>
                  <?php if ($r['nom_est'] != 'Cancelada') { ?>
                        <li class="list-group-item p-1 d-flex justify-content-between">Fecha de finalización: <span class="badge bg-secondary rounded-pill"><?php echo $r['fec_fin']; ?></span></li>
                        <?php if ($_SESSION['com'] == 1 || $_SESSION['com'] == 2) { ?>
                              <!--Aqui va el mapa pero no sirve-->
                              <div class="col-12" style="margin-bottom: inherit;">
                                    <!--<label class="col-md-5" for="fec">Ubicaciones:</label>-->
                                    <input type="hidden" id="lat_ini2" value="<?php $r['lat_ini'] ?>">
                                    <input type="hidden" id="lon_ini2" value="<?php $r['lon_ini'] ?>">
                                    <input type="hidden" id="lat_fin2" value="<?php $r['lat_fin'] ?>">
                                    <input type="hidden" id="lon_fin2" value="<?php $r['lon_fin'] ?>">
                              </div>
                  <?php }
                  } ?>
                  <li class="list-group-item p-1 d-flex justify-content-between">Razón: <span class="badge bg-secondary rounded-pill"><?php echo $r['nom_raz']; ?></span></li>
                  <li class="list-group-item p-1 d-flex justify-content-between">Observaciones Internas: <span class="badge bg-secondary rounded-pill"><?php echo $r['obs_agen']; ?></span></li>
                  <li class="list-group-item p-1 d-flex justify-content-between">Conclusión para cliente: <span class="badge bg-secondary rounded-pill"><?php echo $r['concl_agen']; ?></span></li>
                  <?php if ($_SESSION['com'] == 1 || $_SESSION['com'] == 2 ) { 
                     include 'mapa.php';
                  } ?>
            </ul>
      </div>
</div>