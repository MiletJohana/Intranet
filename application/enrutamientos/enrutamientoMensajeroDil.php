<?php
include '../../conexion.php';

$sql = "SELECT cl.nom_cli,dl.num_dlg,dl.con_dlg,dl.tel_dlg,dl.hor_dlg,dl.dia_dlg,dl.dir_dlg,dl.id_tip_dlg,dl.id_reg,dl.dil_des,cl.id_cli,dl.obs_dlg, est.nom_est_dlg, dl.est_dlg, dl.cos_dlg
FROM mq_dlg as dl,mq_clie as cl, mq_est_dlg as est
WHERE dl.id_cli=cl.id_cli 
AND dl.est_dlg=est.id_est_dlg
AND dl.num_dlg=\"$_POST[num_dlg]\"";

$query = $conexion->query($sql);
$r = $query->fetch(PDO::FETCH_ASSOC);
?>
<button type="button" class="btn btn-red" onclick="validarEnrutamiento(<?php echo  $_POST['num_enr']; ?>)">Volver enrutamiento: <?php echo  $_POST["num_enr"]; ?></button>
<?php echo $r["nom_cli"]; ?>
<?php echo $r["con_dlg"]; ?><br>
<?php echo $r["dil_des"]; ?><br>
<?php echo $r["dir_dlg"]; ?><br>
<form id="form-diligencia" method="POST" enctype="multipart/form-data">
  <label for="est_dlg" class="form-label">Estado</label>
  <select class="form-control" id="est_dlg" name="est_dlg">
    <option value="<?php echo $r['est_dlg']; ?>"><?php echo $r["nom_est_dlg"]; ?></option>
    <?php switch ($r["est_dlg"]) {
      case 2:
        echo '<option value="3">Pendiente</option>
                        <option value="4">Cerrada</option>';
        break;
      case 3:
        echo '<option value="2">En ruta</option>
                        <option value="4">Cerrada</option>';
        break;
      case 4:
        echo '<option value="3">Pendiente</option>
                        <option value="2">En ruta</option>';
        break;
    } ?>
  </select>
  <label for="obs_dlg" class="form-label">Observaciones</label>
  <textarea class="form-control" id="obs_dlg" name="obs_dlg"><?php echo $r["obs_dlg"]; ?></textarea>
  <label for="cos_dlg" class="form-label">Costo</label>
  <input type="number" class="form-control" id="cos_dlg" name="cos_dlg" value='<?php echo $r["cos_dlg"]; ?>'>
  <div class="input-file-containe">
    <label for="fot_dlg" class="form-label">Foto</label>
    <input class="input-fil" type="file" name="foto" id="foto">
    <label tabindex="0" for="my-file" class="input-file-trigge" class="form-label">Seleccionar</label>
    <p class="file-return"></p>
  </div>
  <div>
    <output id="list"></output>
  </div>
  <input type="hidden" id="accion_form" name="action" value="updateMessengerDlg">
  <input type="hidden" id="num_dlg" name="num_dlg" value="<?php echo $_POST['num_dlg']; ?>">
</form>
<button type="button" class="btn btn-red" onclick="actualizarDiligencia(<?php echo $_POST['num_enr']; ?>)">Actualizar</button>