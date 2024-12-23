<nav aria-label="breadcrumb">
  <ol class="breadcrumb mt-3 ms-3">
    <li class="breadcrumb-item"><a href="../home/">Inicio</a></li>
    <li class="breadcrumb-item">T. Humano</li>
    <li class="breadcrumb-item active text-mq" aria-current="page">Pagos</li>
  </ol>
</nav>
<div class="col-12">
  <div class="py-3">
    <h3>Pagos</h3>
  </div>
  <div class="table-responsive-sm">
    <ul class="nav nav-underline ms-2 flex-nowrap">
      <li class="nav-item">
        <a class="nav-link <?php if (isset($_GET['table']) && $_GET['table'] == 1) {
                              echo "active";
                            } ?>" href="index.php?table=1">Solicitud</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if (isset($_GET['table']) && $_GET['table'] == 2) {
                              echo "active";
                            } ?>" href="index.php?table=2">Liquidación</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if (isset($_GET['table']) && $_GET['table'] == 3) {
                              echo "active";
                            } ?>" href="index.php?table=3">Errores de Nómina</a>
      </li>
    </ul>
  </div>
</div>
<div class="col-12 pt-2">
  <?php if (isset($_GET['table']) && $_GET['table'] == 2) { ?>
    <div class="row mt-3">
        <div class="col-sm-12 col-md-1">
            <button type="button" onclick="newIndicador(16,'Solicitud de Liquidación','../pagos/form6.php');" class="btn btn-danger my-3" data-bs-toggle="modal" data-bs-target="#largeModal">
                Crear
            </button>
        </div>
        <div class="col-sm-12 col-md-2">
            <label for="mesliq" class="form-label">Mes</label>
            <input type="month" id="mesliq" name="mesliq" value="<?php date('Y-m') ?>" max=""  class="form-control" onchange="filtro('0,mesliq','../pagos/tabla2.php','Personal', 'tablePagos2')">
        </div>
    </div>
    <?php } else if (isset($_GET['table']) && $_GET['table'] == 3) {?>
      <div class="row mt-4">
        <div class="col-sm-12 col-md-1">
          <button type="button" onclick="newIndicador(18,'Errores de Nómina','../pagos/form7.php');" class="btn btn-danger my-3" data-bs-toggle="modal" data-bs-target="#largeModal"> Crear
          </button>
        </div>
        <div class="col-sm-12 col-md-2">
            <label for="meserror" class="form-label">Mes</label>
            <input type="month" id="meserror" name="meserror" value="<?php date('Y-m') ?>" max=""  class="form-control" onchange="filtro('0,meserror','../pagos/tabla3.php','Personal', 'tablePagos3')">
        </div>
      </div>
      <div id="alertInfo" style="display:none">
        <div class="alert alert-info alert-dismissible fade show mt-4 d-flex align-items-center" role="alert" >
            <i class="fa-solid fa-circle-info me-3 fa-xl"></i>
            <div id="content-alertInfo">    
            </div>
        </div>
      </div>
      <input type="hidden" name="rol" id="rol" value="<?php echo $_SESSION['are']; ?>">
    <?php }?>