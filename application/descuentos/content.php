<nav aria-label="breadcrumb">
    <ol class="breadcrumb mt-3 ms-3">
        <li class="breadcrumb-item"><a href="../home/">Inicio</a></li>
        <li class="breadcrumb-item">T. Humano</li>
        <li class="breadcrumb-item active text-mq" aria-current="page">Descuentos de Nómina</li>
    </ol>
</nav>
<div class="col-12">
    <div class="py-3">
        <h3>Descuentos de Nómina</h3>
    </div>
    <div class="table-responsive-sm">
        <ul class="nav nav-underline ms-2 pb-3 flex-nowrap">
            <li class="nav-item">
                <a class="nav-link <?php if (isset($_GET['table']) && $_GET['table'] == 1) {
                              echo "active";
                            } ?>" href="index.php?table=1">Mis descuentos</a>
            </li>
            <?php  if (($_SESSION['lid'] == 2 || $_SESSION['lid'] == 1 || $_SESSION['lid'] == 4) || ($_SESSION['are'] == 9 && $_SESSION['lid'] == 3)) {  ?>
            <li class="nav-item">
                <a class="nav-link <?php if (isset($_GET['table']) && $_GET['table'] == 2) {
                                echo "active";
                              } ?>" href="index.php?table=2">Pendientes</a>
            </li>
            <?php }
      if (($_SESSION['lid'] == 1 || $_SESSION['lid'] == 4 || $_SESSION['cargo'] == 550 || $_SESSION['cargo'] == 124 || $_SESSION['cargo'] == 17004)  || ($_SESSION['are'] == 9 && $_SESSION['lid'] == 3)) { ?>
            <li class="nav-item">
                <a class="nav-link <?php if (isset($_GET['table']) && $_GET['table'] == 3) {
                                echo "active";
                              } ?>" href="index.php?table=3">Histórico</a>
            </li>
            <?php } ?>
        </ul>
    </div> 
    <div class="row">
        <?php if ($_GET['table'] == 3) { ?>
        <div class="col-md-2 col-sm-12">
            <label for="mes" class="form-label">Mes:</label><br>
            <input type="month" id="mes" name="mes" value="<?php date('Y-m') ?>" max="" class="form-control"
                onchange="filtroMes('0', 'mes','../descuentos/tabla3.php','Descuentos')">
        </div>
        <form action="../indicadores/reportes/descuentosExcel.php" id="formExcel" method="POST" class="mt-2">
            <input type="hidden" name="action" value="reporteCoti">
            <div class="dropdown">
                <label for="exp" class="form-label">Exportar a:</label><br>
                <button class=" btn btn-success dropdown-btn dropdown-toggle" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fa-solid fa-file-excel me-1"></i>Exportar
                </button>
                <div class="dropdown-menu dropdown-menu-start">
                    <a class="btn btn-link dropdown-item" href="#1" onclick="form(1);" id="expMes">Mes</a>
                    <a class="btn btn-link dropdown-item" href="#2" onclick="form(2);" id="expAnual">Anual</a>
                </div>
            </div>
        </form>
        <form role="form" action="../indicadores/reportes/descuentosExcelAnual.php" id="formExcelAnual" method="POST">
            <input type="hidden" name="action" value="anual">
        </form>
    </div>
    <?php } ?>
</div>
</div>