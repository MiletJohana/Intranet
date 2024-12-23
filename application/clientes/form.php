<?php
include "../../conexion.php";
if ($_POST['resp'] == 2) {
      $sql = "SELECT * FROM mq_clie WHERE id_cli=" . $_POST['id_cli'];
      $query = $conexion->query($sql);
      $r = $query->fetch(PDO::FETCH_ASSOC);

      $id_reg = $r['id_reg'];

      $slq3 = "SELECT * FROM mq_reg WHERE id_reg=" . $id_reg;
      $query3 = $conexion->query($slq3);
      $r3 = $query3->fetch(PDO::FETCH_ASSOC);
      
      $slq33 = "SELECT * FROM mq_reg WHERE id_reg!=" . $id_reg;
      $query33 = $conexion->query($slq33);
} else {
      $fecha = date("Y-m-d");
      $sql2 = "SELECT * FROM tip_dlg";
      $query2 = $conexion->query($sql2);
      $slq3 = "SELECT * FROM mq_reg";
      $query3 = $conexion->query($slq3);
}
?>
<form role="form" id="form-cliente">
      <div class="row">
            <div class="col-md-8 col-sm-12 mb-3">
                  <label for="nom_cli">Nombre</label>
                  <input type="text" class="form-control" id="nom_cli" name="nom_cli" value="<?php echo ($_POST['resp'] == 2) ? $r['nom_cli'] : ''; ?>" required>
            </div>
      </div>
      <div class="row">
            <div class="col-md-4 col-sm-12 mb-3">
                  <label for="tip_id">Tipo</label>
                  <select class="form-select" id="tip_id" name="tip_id" required>
                        <option value="Nit">Nit</option>
                        <option value="C.C">C.C</option>
                  </select>
            </div>
            <div class="col-md-4 col-sm-12 mb-3">
                  <label for="id_cli">ID</label>
                  <input type="text" class="form-control" id="id_cli" name="id_cli" value="<?php echo ($_POST['resp'] == 2) ? $r['id_cli'] : ''; ?>" onkeyup="verificar();" required>
            </div>
            <div class="col-md-4 col-sm-12 mb-3">
                  <label for="con_cli">Contacto</label>
                  <input type="text" class="form-control" id="con_cli" name="con_cli" value="<?php echo ($_POST['resp'] == 2) ? $r['con_cli'] : ''; ?>" required>
            </div>
      </div>
      <div class="row">
            <div class="col-md-4 col-sm-12 mb-3">
                  <label for="dir_cli">Dirección</label>
                  <input type="text" class="form-control" id="dir_cli" name="dir_cli" value="<?php echo ($_POST['resp'] == 2) ? $r['dir_cli'] : ''; ?>" required>
            </div>
            <div class="col-md-4 col-sm-12 mb-3">
                  <label for="tel_cli">Teléfono</label>
                  <input type="number" class="form-control" id="tel_cli" name="tel_cli" value="<?php echo ($_POST['resp'] == 2) ? $r['tel_cli'] : ''; ?>" required>
            </div>
            <div class="col-md-4 col-sm-12 mb-3">
                  <label for="eml_cli">Email</label>
                  <input type="email" class="form-control" id="eml_cli" name="eml_cli" value="<?php echo ($_POST['resp'] == 2) ? $r['eml_cli'] : ''; ?>">
            </div>
      </div>
      <div class="row">
            <div class="col-md-4 col-sm-12 mb-3">
                  <label for="web_cli">Web</label>
                  <input type="text" class="form-control" id="web_cli" name="web_cli" value="<?php echo ($_POST['resp'] == 2) ? $r['web_cli'] : ''; ?>">
            </div>
            <div class="col-md-4 col-sm-12 mb-3">
                  <label for="hor_cli">Horario</label>
                  <input type="text" class="form-control" id="hor_cli" name="hor_cli" value="<?php echo ($_POST['resp'] == 2) ? $r['hor_cli'] : ''; ?>" required>
            </div>
            <div class="col-md-4 col-sm-12 mb-3">
                  <label for="id_reg">Regional</label>
                  <select id="id_reg" name="id_reg" class="form-select" required>
                        <?php if ($_POST['resp'] == 1) {
                              while ($r3 = $query3->fetch(PDO::FETCH_ASSOC)) { ?>
                                    <option value="<?php echo $r3['id_reg']; ?>"><?php echo $r3['nom_reg']; ?></option>
                              <?php }
                        } else { ?>
                              <option value="<?php echo $r3['id_reg']; ?>"><?php echo $r3['nom_reg']; ?></option>
                              <?php while ($r33 = $query33->fetch(PDO::FETCH_ASSOC)) { ?>
                                    <option value="<?php echo $r33['id_reg']; ?>"><?php echo $r33['nom_reg']; ?></option>
                        <?php }
                        } ?>
                  </select>
            </div>
            <input type="hidden" id="accion_form" name="action" value="<?php if ($_POST['resp'] == 1) {
                                                                              echo "add";
                                                                        } else {
                                                                              echo "update";
                                                                        } ?>">
      </div>
      <div class="row">
            <div class="col-12 col-sm-12" id="error-validation"></div>
      </div>
</form>