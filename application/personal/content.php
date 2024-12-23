<nav aria-label="breadcrumb">
  <ol class="breadcrumb mt-3 ms-3">
    <li class="breadcrumb-item"><a href="../home/">Inicio</a></li>
    <li class="breadcrumb-item">T. Humano</li>
    <li class="breadcrumb-item active text-mq" aria-current="page">Personal</li>
  </ol>
</nav>
<div class="col-12">
  <div class="py-3">
    <h3>Personal</h3>
  </div>
  <div class="table-responsive-sm">
    <ul class="nav nav-underline ms-2 flex-nowrap ">
      <li class="nav-item">
        <a class="nav-link <?php if (isset($_GET['table']) && $_GET['table'] == 1) {
                              echo "active";
                            } ?>" href="index.php?table=1">Requisición</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if (isset($_GET['table']) && $_GET['table'] == 2) {
                              echo "active";
                            } ?>" href="index.php?table=2">Solicitud</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if (isset($_GET['table']) && $_GET['table'] == 3) {
                              echo "active";
                            } ?>" href="index.php?table=3">Tiempos</a>
      </li>
    </ul>
  </div>
</div>

  <?php if (isset($_GET['table']) && $_GET['table'] == 2) { ?>
    <div class="row mt-3">
            <?php if($_SESSION['are']==9 || $_SESSION['lid']==1 || $_SESSION['lid']==4){?>
              <div class="col-md-2 col-sm-12 ms-3">
                  <button type="button" onclick="newIndicador(5,'Crear entrevista','../personal/form3.php');" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#largeModal">
                      Crear entrevista
                  </button>
              </div>
            <?php }?>
            <div class="col-md-2 col-sm-12">
                <label for="estPer" class="form-label">Estado</label>
                <select class="form-select" id="estPer" onchange="filtroMes('estPer,mesUniq','../personal/tabla2.php','Personal')">
                    <option value="1,2">Principal</option>
                    <option value="2">Pendientes</option>
                    <option value="3">Aprobadas</option>
                    <option value="4">Rechazadas</option>
                    <option value="1,2,3,4">Todas</option>
                </select>
            </div>
            <div class="col-md-2 col-sm-12">
                <label for="mesUniq" class="form-label">Mes</label>
                <input type="month" id="mesUniq" name="mesUniq" value="<?php date('Y-m')?>" max="" class="form-control" 
                onchange="filtroMes('estPer,mesUniq','../personal/tabla2.php','Personal')">
            </div>
    </div>
  <?php } ?>