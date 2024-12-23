<?php
include "../../conexion.php";
date_default_timezone_set("America/Bogota");
if ($_POST['resp'] == 2) {
  $sql = "SELECT cl.id_cli,cl.num_doc,cl.nom_cli,cl.hor_cli1,cl.hor_cli2,dl.num_dlg,dl.con_dlg,dl.tel_dlg,dl.hor_dlg,dl.dia_dlg,dl.dir_dlg,dl.id_tip_dlg,dl.id_reg,dl.dil_des,dl.obs_dlg
          FROM  mq_diligencias as dl,
                mq_clientes as cl 
          WHERE dl.id_cli=cl.id_cli
          AND dl.num_dlg=\"$_POST[num_dlg]\"";
  $query = $conexion->query($sql);
  $r = $query->fetch(PDO::FETCH_ASSOC);
  $id_tip_dlg = $r['id_tip_dlg'];
  $sql2 = "SELECT * FROM tip_dlg WHERE id_tip_dlg=$id_tip_dlg";
  $query2 = $conexion->query($sql2);
  $sql22 = "SELECT * FROM tip_dlg WHERE id_tip_dlg!=$id_tip_dlg";
  $query22 = $conexion->query($sql22);
  $id_reg = $r['id_reg'];
  $slq3 = "SELECT * FROM mq_reg WHERE id_reg=$id_reg";
  $query3 = $conexion->query($slq3);
  $r3 = $query3->fetch(PDO::FETCH_ASSOC);
  $slq33 = "SELECT * FROM mq_reg WHERE id_reg!=$id_reg";
  $query33 = $conexion->query($slq33);
} else {
  $fecha = date("Y-m-d");
  $sql2 = "SELECT * FROM tip_dlg";
  $query2 = $conexion->query($sql2);
  $slq3 = "SELECT * FROM mq_reg";
  $query3 = $conexion->query($slq3);
  $sqlNom = "SELECT * FROM mq_clientes
            WHERE id_cli=\"$_POST[id_cli]\"";
  $queryNom = $conexion->query($sqlNom);
  $rNom = $queryNom->fetch(PDO::FETCH_ASSOC);
}
?>
<form role="form" id="form-dilg2">
  <div class="row">
    <div class="col-md-6 col-sm-12 mb-3">
        <label for="nom_client" class="form-label" >Empresa o Cliente <span name="req" class="text-mq">*</span></label>
        <div class="input-group">
          <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
            <?php if (isset($_POST['id_cli'])) { ?>
              <input type="text" class="form-control" id="nom_client" name="nom_client" value="<?php echo $rNom['nom_cli']; ?>" readonly>
            <?php } else { ?>
              <input type="text" class="form-control" id="nom_client" name="nom_client" value="<?php echo ($_POST['resp'] == 2) ? $r['nom_cli'] : ''; ?>" required onkeyup="autoDil();">
            <?php } ?>
        </div>
    </div>
    <?php if ($_POST['resp'] == 2) { ?>
      <div class="col-md-6 col-sm-12 mb-3">
        <label for="num_dlg" class="form-label">Número Diligencia</label>
        <input type="text" class="form-control" id="num_dlg" name="num_dlg" value="<?php echo $r['num_dlg']; ?>" readonly>
      </div>
    <?php } else if (isset($_POST['id_cli'])) { ?>
      <div class="col-md-6 col-sm-12 p-2 text-end">
      </div>
    <?php } else { ?>
      <div class="col-md-6 col-sm-12 p-2 text-end mb-3">
        <label class="me-auto" class="form-label">Nuevo Cliente</label>
        <button id="btnAddCli" type="button" class="btn btn-danger" onclick="crearClientdil('addClient');">Agregar</button>
      </div>
    <?php } ?>
  </div>
  <div class="row">
    <div class="col-md-6 col-sm-12 mb-3">
      <label for="id_client" class="form-label">NIT</label>
      <?php if (isset($_POST['id_cli'])) { ?>
        <input type="text" class="form-control" id="num_doc" name="num_doc" value="<?php echo $_POST['num_doc']; ?>" readonly >
        <input type="hidden" class="form-control" id="id_client" name="id_client" value="<?php echo $_POST['id_cli']; ?>" readonly >
      <?php } else { ?>
        <input type="text" class="form-control" id="num_doc" name="num_doc" value="<?php echo ($_POST['resp'] == 2) ? $r['num_doc'] : ''; ?>" readonly >
        <input type="hidden" class="form-control" id="id_client" name="id_client" value="<?php echo ($_POST['resp'] == 2) ? $r['id_cli'] : ''; ?>" readonly >
      <?php } ?>
    </div>
    <div class="col-md-6 col-sm-12 mb-3">
      <label for="con_client" class="form-label">Contacto</label>
      <input type="text" class="form-control" id="con_client" name="con_client" value="<?php echo ($_POST['resp'] == 2) ? $r['con_dlg'] : ''; ?>" required>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 col-sm-12 mb-3">
      <label for="tel_client" class="form-label">Teléfono</label>
      <?php if (isset($_POST['id_cli'])) { ?>
        <input type="text" class="form-control" id="tel_client" name="tel_client" value="<?php echo $rNom['tel_cli']; ?>" required>
      <?php } else { ?>
        <input type="text" class="form-control" id="tel_client" name="tel_client" value="<?php echo ($_POST['resp'] == 2) ? $r['tel_dlg'] : ''; ?>" required>
      <?php } ?>
    </div>
    <div class="col-md-6 col-sm-12 mb-3">
      <label for="id_tip_dlg" class="form-label">Tipo de Diligencia</label>
      <select id="id_tip_dlg" name="id_tip_dlg" class="form-select" onchange="tipDilg(this.value)" required>
        <?php if ($_POST['resp'] == 1) { ?>
          <option value="">Seleccionar</option>
        <?php }
        while ($r2 = $query2->fetch(PDO::FETCH_ASSOC)) { ?>
          <option value="<?php echo $r2['id_tip_dlg']; ?>"><?php echo $r2['nom_tip_dlg']; ?></option>
          <?php }
        if ($_POST['resp'] == 2) {
          while ($r22 = $query22->fetch(PDO::FETCH_ASSOC)) { ?>
            <option value="<?php echo $r22['id_tip_dlg']; ?>"><?php echo $r22['nom_tip_dlg']; ?></option>
        <?php }
        } ?>
      </select>
    </div>
  </div>
  <div class="row">
     <div class="col-md-6 col-sm-12">
            <label class="form-label">Horario</label>
            <div class="row">
                <div class="col-5 mb-3 d-flex">
                    <input type="time" class="form-control" id="hor_cli1" name="hor_cli1" value="<?php if ($_POST['resp'] == 2) {
                                                                                                            echo $r['hor_cli1'];
                                                                                                        } else {
                                                                                                            echo '--:--';
                                                                                                        } ?>">
                </div>
             
                <div class="col-7 d-flex align-items-baseline">
                    <label for="hor_cli2" class="" style="font-size:16px;">a:</label>
                    <input type="time" class="form-control ms-4" id="hor_cli2" name="hor_cli2" value="<?php if ($_POST['resp'] == 2) {
                                                                                                            echo $r['hor_cli2'];
                                                                                                        } else {
                                                                                                            echo '--:--';
                                                                                                        } ?>">
                </div>
            </div>
      </div>
    <div class="col-md-6 col-sm-12 mb-3">
      <label for="dia_dlg" class="form-label">Fecha</label>
      <input type="date" class="form-control" id="dia_dlg" name="dia_dlg" value="<?php echo ($_POST['resp'] == 2) ? $r['dia_dlg'] : $fecha; ?>" required>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 col-sm-12 mb-3">
      <label for="dir_client" class="form-label">Dirección</label>
      <input type="text" class="form-control" id="dir_client" name="dir_client" value="<?php echo ($_POST['resp'] == 2) ? $r['dir_dlg'] : ''; ?>" required>
    </div>
    <div class="col-md-6 col-sm-12 mb-3">
      <label for="id_regclient" class="form-label">Regional</label>
      <select id="id_regclient" name="id_regclient" class="form-select" required>
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
  </div>
  <?php if (!isset($_POST['id_cli'])) { ?>
    <div class="row">
      <div class="col-md-6 col-sm-12 mb-3">
        <label class="form-label me-2">¿Datos Erroneos?</label>
        <button id="btnUpdCli" type="button" class="btn btn-danger" onclick="actualizarClientdil('updateClient');" disabled>Actualizar Cliente </button>
      </div>
    </div>
  <?php } ?>
  <div class="row">
    <div class="col-md-12 col-sm-12 mb-3">
      <label for="dil_descri" class="form-label">Descripción</label>
      <textarea class="form-control" id="dil_descri" name="dil_descri" placeholder="LLena este espacio con  todo lo necesario para hacer la diligencia" required><?php echo ($_POST['resp'] == 2) ? $r['dil_des'] : ''; ?></textarea>
    </div>
  </div>
  <div class="row">
    <div class="col-md-9 col-sm-12 mb-3">
      <button type="button" class="btn btn-warning" onclick="option1('Cobrar cheque');">Cobrar cheque</button>
      <button type="button" class="btn btn-warning" onclick="option1('Radicación factura');">Radicación factura</button>
      <button type="button" class="btn btn-warning" onclick="option1('Material entregado');">Material entregado</button>
    </div>
  </div>
  <div class="row">
    <?php if ($_POST['resp'] == 2) { ?>
      <div class="col-6 mb-3">
        <label for="est_dlg" class="form-label">Estado</label>
        <select class="form-select" id="est_dlg" name="est_dlg">
          <option value="1">Nueva</option>
          <option value="4">Cerrar</option>
        </select>
      </div>
      <div class="col-6 mb-3">
        <label for="obs_dlg" class="form-label">Observaciones</label>
        <textarea class="form-control" id="obs_dlg" name="obs_dlg"><?php echo ($_POST['resp'] == 2) ? $r['obs_dlg'] : ''; ?></textarea>
      </div>
    <?php } ?>
  </div>
  <div class="row mb-3">
    <div class="col-4" id="error-validation"></div>
  </div>
  <div class="row">
    <div class="col-12 mb-3" id="resClient"></div>
    <div class="col-12 mb-3" id="alertDilPer" style="display: none" >
      <div class="alert alert-warning alert-dismissible fade show d-flex align-items-center" role="alert">
        <i class="fa-solid fa-triangle-exclamation me-3 fa-xl"></i>
        <div>
        <strong>Advertencia! </strong>
        <p>Se creará un descuento de nómina por el valor de $6.000 por tu diligencia personal, sí creas la diligencia debes aprobar el descuento en la ventana <strong> T.Humano -> Descuentos de Nómina</strong>, en los 3 puntos debes ir a <strong>Aprobar</strong>, ingresas tu contraseña y lo apruebas.</p>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    </div>
  </div>
  <input type="hidden" id="accion_form" name="action" value="<?php echo ($_POST['resp'] == 1) ? "add" : "update"; ?>">
  </div>
</form>