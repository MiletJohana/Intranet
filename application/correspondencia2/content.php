<nav aria-label="breadcrumb">
  <ol class="breadcrumb mt-3 ms-3">
    <li class="breadcrumb-item"><a href="../home/">Inicio</a></li>
    <li class="breadcrumb-item active text-mq" aria-current="page">Correspondencia</li>
  </ol>
</nav>
<div class="col-12">
  <div class="py-3">
    <h3>Correspondencia</h3>
  </div>
  <div class="table-responsive-lg">
    <ul class="nav nav-underline ms-2 flex-nowrap">
      <li class="nav-item">
        <a class="nav-link <?php if (isset($_GET['table']) && $_GET['table'] == 1) {
                              echo "active";
                            } ?>" href="index.php?table=1">Correspondencia</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if (isset($_GET['table']) && $_GET['table'] == 2) {
                              echo "active";
                            } ?>" href="index.php?table=2">Pendientes</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if (isset($_GET['table']) && $_GET['table'] == 4) {
                              echo "active";
                            } ?>" href="index.php?table=4">Histórico</a>
      </li>
    </ul>
  </div>
</div>
<div class="col-12 pt-2">
  <?php if ($_GET['table'] == 1) { ?>
    <div class="row mt-3">
      <div class="col-md-3 col-sm-12">
        <button type="button" onclick="crearCorr(0);" class="btn btn-danger my-3" data-bs-toggle="modal" data-bs-target="#largeModal">
          Crear correspondencia
        </button>
      </div>
      <div class="col-md-2 col-sm-12">
        <label for="est1" class="form-label">Estado</label>
        <select class="form-select" id="est1" onchange="filtroCorr('est1,mes1','../correspondencia2/tabla.php')">
          <option value="1">Nuevas</option>
          <option value="2">Remitidas</option>
          <option value="4">Contabilizadas</option>
        </select>
      </div>
      <div class="col-md-2 col-sm-12">
        <label for="mes1" class="form-label">Mes</label>
        <input type="month" id="mes1" name="mes1" value="<?php date('Y-m') ?>" max="" min="" class="form-control" onchange="filtroCorr('est1,mes1','../correspondencia2/tabla.php')">
      </div>
    </div>
  <?php } else if ($_GET['table'] == 2) { ?>
    <div class="row mt-3">
      <div class="col-md-2 col-sm-12">
        <label for="est" class="form-label">Estado</label>
        <select class="form-select" id="est" onchange="filtroCorr('est,mes2','../correspondencia2/tabla2.php')">
          <option value="1">Nuevas</option>
          <option value="2">Remitidas</option>
          <option value="4">Contabilizadas</option>
        </select>
      </div>
      <div class="col-md-2 col-sm-12">
        <label for="mes2" class="form-label">Mes</label>
        <input type="month" id="mes2" name="mes2" value="<?php date('Y-m') ?>" max="" min="" class="form-control" onchange="filtroCorr('est,mes2','../correspondencia2/tabla2.php')">
      </div>
    </div>
  <?php } ?>
</div>