<?php
include '../../conexion.php';

$sql1 = "SELECT dlxen.num_ord,
dlxen.num_dlg,
dl.dir_dlg,
dl.obs_dlg,
dl.dil_des,
dl.est_dlg,
dl.efc_dlg,
dl.cos_dlg,
cli.id_cli,
dl.tel_dlg,
dl.hor_dlg,
cli.nom_cli,
dl.con_dlg,
en.cos_enr,
dl.con_dlg,
dl.fot_dlg,
es.nom_est_dlg
FROM mq_clientes AS cli
INNER JOIN mq_diligencias AS dl
ON cli.id_cli = dl.id_cli 
INNER JOIN mq_dilig_x_enrt AS dlxen
ON dl.num_dlg = dlxen.num_dlg 
INNER JOIN mq_est_dlg AS es
ON dl.est_dlg = es.id_est_dlg
INNER JOIN mq_enrt AS en
ON en.num_enr = dlxen.num_enr
WHERE dlxen.num_enr = " . $_POST["num_enr"] . " 
ORDER BY LENGTH(dlxen.num_ord), dlxen.num_ord";
$query = $conexion->query($sql1);
$sql2 = "SELECT max(num_ord) from mq_dilig_x_enrt where num_enr=" . $_POST["num_enr"];
$query2 = $conexion->query($sql2);
$r = $query2->fetch(PDO::FETCH_ASSOC);
$j = $r["max(num_ord)"];
?>

<form role="form" id="form-enrutamiento">

  <input type="hidden" id="num_enr" name="num_enr" value="<?php echo $_POST["num_enr"]; ?>">
  <div class="row">
    <div class="col-12" align="center">
      <h2 align="center">EN RUTA # <?php echo $_POST["num_enr"]; ?></h2>
      <hr class="mx-auto" style="width:60%;">
    </div>
  </div>
  <div id="info"></div>
  <div class="row">
    <div class="col-12" style="height: 350px;">
      <div class="table-responsive h-100">
        <table class="table col-8" style="font-size: 90%;">
          <thead>
            <tr>
              <th>#</th>
              <th>Diligencia</th>
              <th>Cliente:</th>
              <th>Nit:</th>
              <th>Contacto:</th>
              <th>Direccion:</th>
              <th>Horario:</th>
              <th>Descripcion:</th>
              <th>Observacion:</th>
              <th>Costos</th>
              <th>Efec</th>
              <th></th>
            </tr>
          </thead>
          <tbody id="ruta">
            <?php while ($r = $query->fetch(PDO::FETCH_ASSOC)) { ?>
              <tr>
                <td name="num_ord"><?php echo $r["num_ord"] ?></td>
                <td name="num_dlg"><?php echo $r["num_dlg"]; ?></td>
                <td name="nom_cli"><?php echo $r["nom_cli"]; ?></td>
                <td name="id_cli"><?php echo $r["id_cli"]; ?></td>
                <td name="con_cli"><?php echo $r["con_cli"]; ?></td>
                <td name="dir_dlg"><?php echo $r["dir_dlg"]; ?></td>
                <td name="hor_cli"><?php echo $r["hor_cli"]; ?></td>
                <td name="dil_des"><?php echo $r["dil_des"]; ?></td>
                <?php if ($_POST['resp'] == 5) { ?>
                  <td>
                    <?php echo $r["obs_dlg"]; ?>
                  </td>
                  <td>
                    <?php echo $r["cos_dlg"]; ?>
                  </td>
                  <td>
                    <?php if ($r["efc_dlg"] == 1) {
                      echo 'Si';
                    } else {
                      echo 'No';
                    } ?><br>
                  </td>
                <?php } else { ?>
                  <td>
                    <textarea class="form-control" name="obs_enr" style="font-size: 100%"><?php echo $r["obs_dlg"]; ?></textarea>
                  </td>
                  <td>
                    <input type="number" class="form-control" name="cos_dlg" style="font-size: 100%">
                  </td>
                  <td>
                    <input type="checkbox" name="efec_enr" value="SI"><br>
                  </td>
                  <td><?php if ($r["fot_dlg"] != "") { ?>
                      <a class="btn btn-details" href=" ../../diligencia/<?php echo $r["fot_dlg"]; ?> " target="_blank"><i class="fa-solid fa-file"></i></a>
                    <?php
                      } ?></td>
                <?php } ?>
              </tr>
            <?php }
            if ($_POST['resp'] == 2) {
              $sql3 = "SELECT cos_enr FROM mq_enrt WHERE num_enr='" . $_POST["num_enr"] . "'";
              $query3 = $conexion->query($sql3);
              $r3 = $query3->fetch(PDO::FETCH_ASSOC); ?>
              <tr>
                <td colspan="7"></td>
                <td colspan="1"><strong>Costos Adicionales</strong></td>
                <td colspan="3"><input type="number" class="form-control" value="<?php echo $r3["cos_enr"]; ?>" readonly></td>
              </tr>
            <?php } else { ?>
              <tr>
                <td colspan="7"></td>
                <td colspan="1"><strong>Costos Adicionales</strong></td>
                <td colspan="3">
                  <input type="number" class="form-control" id="cos_enr" name="cos_enr" style="font-size: 100%" placeholder="Costos de transportación, otros">
                </td>
              </tr>
            <?php } ?>

          </tbody>
        </table>
        <input type="hidden" id="accion_form" name="action" value="<?php echo ($_POST['resp'] == 1) ? "add" : "update"; ?>">
      </div>
    </div>
  </div>
</form>