<?php

  $sql="SELECT * FROM mq_reg;";
  $query = $conexion ->query($sql);
  $rowInfo = $query->fetchAll(PDO::FETCH_ASSOC);

?>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb mt-3 ms-3">
    <li class="breadcrumb-item"><a href="../home/">Inicio</a></li>
    <li class="breadcrumb-item">Inventario</li>
    <li class="breadcrumb-item active text-mq" aria-current="page">Inventarios</li>
  </ol>
</nav>
<div class="col-12">
  <div class="py-3">
    <h3 id="text-principal-inv">Inventarios</h3>
  </div>
  <div class="col-3">
    <label for="regional" class="form-label">Seleccione la Regional: <span name="req" class="text-mq">*</span></label>
    <select class="form-select" name="regional" id="regional">
      <option value="" selected>Seleccionar...</option>
      <?php foreach ($rowInfo as $reg) { ?>
        <option value="<?php echo $reg['id_reg']; ?>" id="reg<?php echo $reg['id_reg']; ?>"><?php echo $reg['nom_reg']; ?></option>
      <?php } ?>

    </select>
  </div>
</div>