<?php
include "../../conexion.php";
$sql = "SELECT dl.num_dlg, dl.dir_dlg, dl.dia_dlg, est.nom_est_dlg, dl.efc_dlg, cl.nom_cli, cl.id_cli, dl.fec_cre, dl.lst_upt, dl.usu_upt, dl.nom_res, reg.nom_reg
      FROM mq_diligencias dl, mq_clientes cl, mq_est_dlg est, mq_reg reg 
      WHERE dl.id_cli=cl.id_cli 
      AND dl.est_dlg=est.id_est_dlg 
      AND dl.id_reg=reg.id_reg 
      AND num_dlg=\"$_POST[num_dlg]\"";
$query = $conexion->query($sql);
if ($query != null) {
      $r = $query->fetch(PDO::FETCH_ASSOC);?>
      <div class="row">
            <div class="col-12">
                  <ul class="list-group list-group-flush">
                        <li class="list-group-item p-1 me-0 d-flex justify-content-between">Dirección: <span class="badge bg-secondary rounded-pill"><?php echo $r['dir_dlg']; ?></span></li>
                        <li class="list-group-item p-1 d-flex justify-content-between">Fecha de diligencia: <span class="badge bg-secondary rounded-pill"><?php echo $r['dia_dlg']; ?></span></li>
                        <li class="list-group-item p-1 d-flex justify-content-between">Estado: <span class="badge bg-secondary rounded-pill"><?php echo $r['nom_est_dlg']; ?></span></li>
                        <li class="list-group-item p-1 d-flex justify-content-between">Efectiva: <span class="badge bg-secondary rounded-pill"><?php if ($r["efc_dlg"] == 1) {
                              echo 'Si';
                        } else {
                              echo 'No';
                        } ?></span></li>
                        <li class="list-group-item p-1 d-flex justify-content-between">Cliente: <span class="badge bg-secondary rounded-pill"><?php echo $r['nom_cli']; ?></span></li>
                        <li class="list-group-item p-1 d-flex justify-content-between">NIT: <span class="badge bg-secondary rounded-pill"><?php echo $r['id_cli']; ?></span></li>
                        <li class="list-group-item p-1 d-flex justify-content-between">Fecha de creación: <span class="badge bg-secondary rounded-pill"><?php echo $r['fec_cre']; ?></span></li>
                        <li class="list-group-item p-1 d-flex justify-content-between">Ultima actualización: <span class="badge bg-secondary rounded-pill"><?php echo $r['lst_upt']; ?></span></li>
                        <li class="list-group-item p-1 d-flex justify-content-between">Usuario que actualizo: <span class="badge bg-secondary rounded-pill"><?php echo $r['usu_upt']; ?></span></li>
                        <li class="list-group-item p-1 d-flex justify-content-between">Persona responsable: <span class="badge bg-secondary rounded-pill"><?php echo $r['nom_res']; ?></span></li>
                        <li class="list-group-item p-1 d-flex justify-content-between">Región: <span class="badge bg-secondary rounded-pill"><?php echo $r['nom_reg']; ?></span></li>
                  </ul>
            </div>
      </div>
<?php } else {
      printf("Error: %s\n", $conexion->errorInfo());
} ?>