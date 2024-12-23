<nav aria-label="breadcrumb">
    <ol class="breadcrumb mt-3 ms-3">
        <li class="breadcrumb-item"><a href="../home/">Inicio</a></li>
        <li class="breadcrumb-item">Cotizador</li>
        <li class="breadcrumb-item active text-mq" aria-current="page">Cotizaciones</li>
    </ol>
</nav>
<div class="col-12 py-3">
    <div class="d-flex">
        <h3>Cotizaciones</h3>
    </div>
    <div class="table-responsive-sm">
        <ul class="nav nav-tabs flex-nowrap">
            <li class="nav-item">
                <a class="nav-link <?php if (isset($_GET['table']) && $_GET['table'] == 1) {
                              echo "active";
                            } ?>" href="index.php?table=1">Cotizaciones</a>
            </li>
            <li class="nav-item">
            <li class="nav-item">
                <a class="nav-link <?php if (isset($_GET['table']) && $_GET['table'] == 7) {
                                echo "active";
                              } ?>" href="index?table=7">Resumen</a>

            </li>
            <?php if ($_SESSION['lid'] == 1) { ?>
            <li class="nav-item">
                <a class="nav-link <?php if (isset($_GET['table']) && $_GET['table'] == 3) {
                                echo "active";
                              } ?>" href="index.php?table=3">Historial</a>
            </li>
            <?php } ?>
            <li class="nav-item">
                <a class="nav-link <?php if (isset($_GET['table']) && $_GET['table'] == 4) {
                              echo "active";
                            } ?>" href="index.php?table=4">Clientes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if (isset($_GET['table']) && $_GET['table'] == 5) {
                              echo "active";
                            } ?>" href="index.php?table=5">Contactos</a>
            </li>
            <!--<li class="nav-item">
        <a class="nav-link <?php //if (isset($_GET['table']) && $_GET['table'] == 6) {
                              //echo "active";
                           // } ?>" href="index.php?table=6">Productos</a>
      </li>-->
            <?php if ($_SESSION['id'] == 1072448076 || $_SESSION['id'] == 1018437049) { ?>
            <li class="nav-item">
                <a class="nav-link <?php if (isset($_GET['table']) && $_GET['table'] == 8) {
                                echo "active";
                              } ?>" href="index?table=8">Precios</a>
            </li>
            <?php } ?>
            <!-- <li class="nav-item">
                <a class="nav-link <?php /*if (isset($_GET['table']) && $_GET['table'] == 9) {
                              echo "active";
                            } */?>" href="index?table=9">Andi</a>
            </li> -->
        </ul>
    </div>
</div>
<?php if (isset($_GET['table']) && $_GET['table'] == 1) { ?>
<div class="col-12">
    <div class="p-3">
        <h5>Mis Cotizaciones</h5>
    </div>
    <button onclick="newCotizacion(1,<?php $_SESSION['id'] ?>);" class="btn btn-danger" data-bs-toggle="modal"
        data-bs-target="#largeModal">
        Crear Cotización
    </button>
    <button onclick="newCotizacion(15,<?php $_SESSION['id'] ?>);" class="btn btn-primary" data-bs-toggle="modal"
        data-bs-target="#largeModal">
        Subir Cotización
    </button>
    <a id="Opt"
        onclick="mostrarMisCoti(<?php echo $_SESSION['id'] . ',' . date('Y') . ',' . date('m') . ',' . date('Y'); ?>);"
        class="btn btn-info text-white">
        Ver todas mis cotizaciones
    </a>
    <a id="Asoc" onclick="mostrarCotiAsoc(<?php echo $_SESSION['id']; ?>);" class="btn btn-warning text-white">
        Ver asociadas
    </a>
    <?php if (($_SESSION['lid'] == 1 || $_SESSION['lid'] == 4) || ($_SESSION['lid'] == 2 && ($_SESSION['are'] == 2 || $_SESSION['are'] == 13))) { ?>
    <button onclick="newTapete(1,'Mano de Obra','../tapetes/tabsForm.php');" class="btn btn-success"
        data-bs-toggle="modal" data-bs-target="#largeModal">
        Costos Tapete
    </button>
    <button onclick="newTapete(20,'Cotizacion de Ensayo','../tapetes/form4.php');" class="btn btn-danger"
        data-bs-toggle="modal" data-bs-target="#largeModal">
        Cotizacion Ensayo
    </button>
    <?php } ?>
</div>
<div class="col-12 pt-2">
    <div class="row justify-content-center">
        <div class="col-md-2 col-sm-12">
            <label for="id_usu" class="form-label">Usuario</label>
            <select class="form-select" name="id_usu" id="id_usu"
                onchange="cotUsu(<?php date('m') . ',' . date('Y') ?>);">
                <option value="<?php echo $_SESSION['id']; ?>">Mis cotizaciones</option>
                <?php
                $sql = "SELECT nom_usu, id_usu FROM mq_usu WHERE (id_are != 10) AND id_are IN (0,4,6,7,11,12) AND id_usu != '" . $_SESSION['id'] . "'";
                $query = $conexion->query($sql);
                $sqlAng = "SELECT nom_usu, id_usu FROM mq_usu WHERE (id_are != 10) AND id_are IN (4,7) AND id_reg = 1 AND id_usu != '" . $_SESSION['id'] . "'";;
                $queryAng = $conexion->query($sqlAng);
                $sqlcali= "SELECT nom_usu, id_usu FROM mq_usu WHERE (id_are != 10) AND id_are IN (0,4,6,7,11,12) AND id_reg = 2 AND id_usu != '" . $_SESSION['id'] . "'";
                $querycali =$conexion->query($sqlcali);
                $sqlmedell= "SELECT nom_usu, id_usu FROM mq_usu WHERE (id_are != 10) AND id_are IN (0,4,6,7,11,12) AND id_reg = 3 AND id_usu != '" . $_SESSION['id'] . "'";
                $querymedell =$conexion->query($sqlmedell);
                $sqlbar= "SELECT nom_usu, id_usu FROM mq_usu WHERE (id_are != 10) AND id_are IN (0,4,6,7,11,12) AND id_reg = 4 AND id_usu != '" . $_SESSION['id'] . "'";
                $querybar =$conexion->query($sqlbar);
                $sqlAna= "SELECT nom_usu, id_usu FROM mq_usu WHERE id_usu = 51865185";
                $queryAna =$conexion->query($sqlAna);


                if (($_SESSION['lid'] == 1) || ($_SESSION['lid'] == 2 && ($_SESSION['are'] == 13 ||  $_SESSION['are'] == 7 || $_SESSION['are'] == 11 || $_SESSION['are'] == 3|| $_SESSION['are'] == 4))) { ?>
                <option value="100">SAC</option>
                <?php while ($rA = $queryAng->fetch(PDO::FETCH_ASSOC)) { ?>
                <option value="<?php echo $rA['id_usu']; ?>">
                    <?php echo ucwords(strtolower($rA['nom_usu'])); ?></option>
                <?php } }
                if (($_SESSION['lid'] == 1)  || ($_SESSION['lid'] == 2 && ($_SESSION['are'] == 13 ||  $_SESSION['are'] == 11 || $_SESSION['are'] == 3 || $_SESSION['are'] == 4))) { ?>
                <option value="200">Ventas</option>
                <?php }
                if (($_SESSION['lid'] == 1) || ($_SESSION['lid'] == 2 && ($_SESSION['are'] == 13 ||  $_SESSION['id'] == 6 || $_SESSION['id'] == 3))) { ?>
                <option value="300">Ventas Internas</option>
                <?php }
                if (($_SESSION['lid'] == 1) ||  ($_SESSION['lid'] == 2 && ($_SESSION['are'] == 13 ||  $_SESSION['id'] == 6   ||  $_SESSION['are'] == 11 || $_SESSION['id'] == 3))) { ?>
                <?php while ($r = $query->fetch(PDO::FETCH_ASSOC)) { ?>
                <option value="<?php echo $r['id_usu']; ?>">
                    <?php echo ucwords(strtolower($r['nom_usu'])); ?></option>
                <?php }
                }
                if (($_SESSION['lid']==2)&&($_SESSION['reg']==2)){
                  while ($rc = $querycali->fetch(PDO::FETCH_ASSOC)) { ?>
                <option value="<?php echo $rc['id_usu']; ?>">
                    <?php echo ucwords(strtolower($rc['nom_usu'])); ?></option>
                <?php }
                }else if(($_SESSION['lid']==2)&&($_SESSION['reg']==3)) {
                  while ($rm = $querymedell->fetch(PDO::FETCH_ASSOC)) { ?>
                <option value="<?php echo $rm['id_usu']; ?>">
                    <?php echo ucwords(strtolower($rm['nom_usu'])); ?></option>
                <?php }
                }else if(($_SESSION['lid']==2)&&($_SESSION['reg']==4)) {
                  while ($rb = $querybar->fetch(PDO::FETCH_ASSOC)) { ?>
                <option value="<?php echo $rb['id_usu']; ?>">
                    <?php echo ucwords(strtolower($rb['nom_usu'])); ?></option>
                <?php }
                } 
                if ($_SESSION['id']==77143387){
                  while ($rAna = $queryAna->fetch(PDO::FETCH_ASSOC)) { ?>
                <option value="<?php echo $rAna['id_usu']; ?>">
                    <?php echo ucwords(strtolower($rAna['nom_usu'])); ?></option>
                <?php }
              } ?>




            </select>
        </div>
        <div class="col-md-2 col-sm-12">
            <label for="est_cot" class="form-label">Estado</label>
            <select class="form-select" id="est_cot" name="est_cot" onchange="cotUsu(php date('m') . ',' . date('Y') ?>);">
                <option value="">Todos</option>
                <option value="1">Pendiente</option>
                <option value="2">Aprobado</option>
                <option value="3">Rechazado</option>
                <option value="4">Actualización de precios</option>
            </select>
        </div>
        <div class="col-md-2 col-sm-12">
            <label for="mes" class="form-label">Mes</label>
            <input class="form-control" type="month" name="mes" id="mes"
                onchange="cotUsu(<?php date('m') . ',' . date('Y') ?>);"
                value="<?php if (isset($_GET['mes'])) {
                                                                                                                                      echo $_GET['mes'];
                                                                                                                                    } else {
                                                                                                                                      echo date('Y-m');
                                                                                                                                     } ?>">
            <input type="hidden" name="mes2" value="<?php echo date('m'); ?>">
        </div>
        <form action="../cotizador/reportes/reportePrueba.php" id="formExcel" method="POST" class="mt-2">
            <div class="col-md-2">
                <input type="hidden" name="action" value="reporteCoti">
                <div class="dropdown">
                    <button class=" btn btn-success dropdown-btn dropdown-toggle" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fa-solid fa-file-excel me-1"></i>Exportar
                    </button>
                    <div class="dropdown-menu dropdown-menu-start">
                        <a class="btn btn-link dropdown-item" href="#1" onclick="form(1);" id="expMes">Mes</a>
                        <a class="btn btn-link dropdown-item" href="#2" onclick="form(2);" id="expAnual">Anual</a>
                    </div>
                </div>
            </div><br>
        </form>
        <div id="estadistics" class="container">
            <?php include "table_stadistics.php" ?>
            <input type="hidden" name="action" value="reporteCoti">
        </div>
        <form role="form" action="../cotizador/reportes/reporteAnual.php" id="formExcelAnual" method="POST">
            <input type="hidden" name="action" value="anual">
        </form>
    </div>
</div>

<?php } ?>