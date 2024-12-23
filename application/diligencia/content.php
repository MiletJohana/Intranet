<?php
$hoy = date("Y-m-d");
$d = strtotime("-1 days");
$d2 = strtotime("-3 days");
$tr = date("Y-m-d", $d);
$mtr = date("Y-m-d", $d2);
?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb mt-3 ms-3">
    <li class="breadcrumb-item"><a href="../home/">Inicio</a></li>
    <li class="breadcrumb-item">Mensajería</li>
    <li class="breadcrumb-item active text-mq" aria-current="page">Diligencias</li>
  </ol>
</nav>
<div class="col-12">
  <div class="py-3">
    <h3>Diligencias</h3>
  </div>
</div>
<div class="container-fluid">
  <div class="col-md-2 col-sm-12 mb-4">
    <button type="button" onclick="newDiligencia();" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#largeModal">
      Crear diligencia
    </button>
  </div>
  <div class="d-flex">
    <div class="col-md-2 col-sm-12">
      <label for="estado" class="form-label">Estado:</label>
      <select class="form-select" id="estado" onchange="estado();">
        <option value="Todas" id="estadoTodas">Todas</option>
        <option value="Nueva">Nueva</option>
        <option value="En Ruta">En Ruta</option>
        <option value="Pendiente">Pendiente</option>
        <option value="Cerrada">Cerrada</option>
      </select>
    </div>
    <div class="col-md-3 col-sm-12 mt-4">
      <form action="">
        <label class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="<?php echo $hoy; ?>" onclick="espera(this.value);"> 
          <label class="form-check-label" for="inlineRadio1">Nueva (Hoy)</label>
        </label>
        <label class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="<?php echo $tr; ?>" onclick="espera(this.value);"> 
          <label class="form-check-label" for="inlineRadio2">Tarde (1 a 3 días)</label>
        </label>
        <label class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="<?php echo $mtr; ?>" onclick="espera(this.value);"> 
          <label class="form-check-label" for="inlineRadio3">Muy tarde (+ 3 días)</label>
        </label>
      </form>
    </div>
    <div class="col-md-2 col-sm-12 mt-4">
      <button type="button" class="btn btn-info" onclick="resetFiltros1();">
        Reiniciar Filtros
      </button>
    </div>
  </div>
</div>