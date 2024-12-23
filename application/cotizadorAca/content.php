
<nav aria-label="breadcrumb">
  <ol class="breadcrumb mt-3 ms-3">
    <li class="breadcrumb-item"><a href="../home/">Inicio</a></li>
    <li class="breadcrumb-item">Cotizador</li>
    <li class="breadcrumb-item active text-mq" aria-current="page">Cotizaciones ACÁ</li>
  </ol>
</nav>
<div class="col-12">
  <div class="py-3">
    <h3>Cotizaciones</h3>
  </div>
  <div class="table-responsive-sm">
    <ul class="nav nav-tabs flex-nowrap">
      <li class="nav-item">
      <a class="nav-link <?php if (isset($_GET['table']) && $_GET['table'] == 1) {
                              echo "active";
                            } ?>" href="index.php?table=1">Cotizaciones</a>
      </li>
      </ul>
  </div>
</div>
<?php if (isset($_GET['table']) && $_GET['table'] == 1) { ?>
  <div class="col-12">
    <div class="p-3">
      <h5>Mis Cotizaciones</h5>
    </div>
    <button onclick="newCotizacionAca(1,<?php $_SESSION['id'] ?>);" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#largeModal">
      Crear Cotización
    </button>
    <a id="Opt" onclick="mostrarMisCoti(<?php echo $_SESSION['id'] . ',' . date('Y') . ',' . date('m') . ',' . date('Y'); ?>);" class="btn btn-info">
      Ver todas mis cotizaciones
    </a>
    <a id="Asoc" onclick="mostrarCotiAsoc(<?php echo $_SESSION['id']; ?>);" class="btn btn-warning">
      Ver asociadas
    </a>
    <?php if ($_SESSION['id'] == 1233894121 || $_SESSION['id'] == 1018437049 || $_SESSION['id'] == 35461044 || $_SESSION['id'] == 1032472569 || $_SESSION['id'] == 1072448076 ) { ?>
        <button onclick="mostrarCoti();" type="button" class="btn btn-primary" >Todas las cotizaciones</button>
    <?php } ?>
    <form action="../cotizador/reportes/reportePrueba.php" id="formExcel" method="POST" class="mt-2">
      <div class="row justify-content-md-center">
        <div class="col-md-2">
          <div class="row">
            <label for="id_usu" class="form-label">Usuario</label>
            <select class="form-control" name="id_usu" id="id_usu" onchange="cotUsu(<?php date('m') . ',' . date('Y') ?>);">
              <option value="<?php echo $_SESSION['id']; ?>">Mis cotizaciones</option>
              <?php
              $sql = "SELECT nom_usu, id_usu FROM mq_usu WHERE (id_are != 10) AND id_are IN (0,6,7,11,12) AND id_usu != '" . $_SESSION['id'] . "'";
              $query = $conexion->query($sql);
              $sqlAng = "SELECT nom_usu, id_usu FROM mq_usu WHERE id_usu = 52465553";
              $queryAng = $conexion->query($sqlAng);
              if ($_SESSION['id'] == 1032472569 || $_SESSION['id'] == 1072448076 || $_SESSION['id'] == 1018437049 || $_SESSION['id'] == 1110465381 || $_SESSION['id'] == 35461044  || $_SESSION['id'] == 36455874) { ?>
                <option value="100">SAC</option>
              <?php }
              if ($_SESSION['id'] == 1032472569 || $_SESSION['id'] == 1072448076 || $_SESSION['id'] == 1018437049 || $_SESSION['id'] == 36455874 || $_SESSION['id'] == 35461044) { ?>
                <option value="200">Ventas</option>
              <?php }
              if ($_SESSION['id'] == 1032472569 || $_SESSION['id'] == 1072448076 || $_SESSION['id'] == 1018437049 || $_SESSION['id'] == 1019093683 || $_SESSION['id'] == 35461044  || $_SESSION['id'] == 36455874) { ?>
                <option value="300">Televentas</option>
              <?php }
              if ($_SESSION['id'] == 1032472569 || $_SESSION['id'] == 1072448076 || $_SESSION['id'] == 1018437049 || $_SESSION['id'] == 35461044  || $_SESSION['id'] == 36455874) { ?>
                <?php while ($r = $query->fetch(PDO::FETCH_ASSOC)) { ?>
                  <option value="<?php echo $r['id_usu']; ?>"><?php echo ucwords(strtolower($r['nom_usu'])); ?></option>
                <?php }
              }
              if ($_SESSION['are'] == 7) { ?>
                <?php while ($rA = $queryAng->fetch(PDO::FETCH_ASSOC)) { ?>
                  <option value="<?php echo $rA['id_usu']; ?>"><?php echo ucwords(strtolower($rA['nom_usu'])); ?></option>
              <?php }
              } ?>
            </select>
          </div>
        </div>
        <div class="col-md-2">
          <div class="row">
            <label for="est_cot">Estado</label>
            <select class="form-control" name="est_cot" id="est_cot" onchange="cotUsu(<?php date('m') . ',' . date('Y') ?>);">
              <option value="">Todos</option>
              <option value="1">Pendiente</option>
              <option value="2">Aprobado</option>
              <option value="3">Rechazado</option>
              <option value="4">Actualización de precios</option>
            </select>
          </div>
        </div>
        <div class="col-md-2">
          <div class="row">
            <label for="mesR2">Mes</label>
            <input class="form-control" type="month" name="mes" id="mesR2" onchange="cotUsu(<?php date('m') . ',' . date('Y') ?>);" style="width: 200px;" value="<?php if (isset($_GET['mes'])) {
                                                                                                                                                                  echo $_GET['mes'];
                                                                                                                                                                } else {
                                                                                                                                                                  echo date('Y-m');
                                                                                                                                                                } ?>">
            <input type="hidden" name="mes2" value="<?php echo date('m'); ?>">
          </div>
        </div>
      </div>
    </form>
  </div>


    <?php } ?>