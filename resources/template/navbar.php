<?php
include "credentials.php";
include "../../conexion.php";

  $sql = "SELECT p.padre FROM usu_per AS u
  INNER JOIN mq_per AS p
  ON u.id_per = p.id_per
  WHERE id_usu  = '" . $_SESSION['id'] .
    "' GROUP BY p.padre;";
  $query = $conexion->query($sql);
  $per = array();
  while ($r = $query->fetch(PDO::FETCH_ASSOC)) {
    array_push($per, $r["padre"]);
  }
  $sql1 = "SELECT p.id_per 
  FROM usu_per AS u 
  INNER JOIN mq_per AS p 
  ON u.id_per = p.id_per 
  WHERE id_usu = " . $_SESSION['id'];
  $query1 = $conexion->query($sql1);
  $per1 = array();
  while ($r1 = $query1->fetch(PDO::FETCH_ASSOC)) {
    array_push($per1, $r1["id_per"]);
  }
  $sql = "SELECT * FROM ind_cargos WHERE id_carg = " . $_SESSION['cargo'];
  $query = $conexion->query($sql);
  $r = $query->fetch(PDO::FETCH_ASSOC); ?>
  <script src="../../application/js/reportes.js"></script>
  <nav class="navbar navbar-expand-lg navbar-dark bg-mq sticky-top product-sans <?php echo $session_nav_size; ?>">
    <a class="navbar-item mx-4 p-1" href="../../application/home/">
      <img src="../../resources/img/logoMQ-Blanco.png" width="60" height="60" alt="">
    </a>
    <button class="navbar-toggler mx-4" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarMain">
      <ul class="navbar-nav ">
        <li class="nav-item mx-1 dropdown">
          <a class="nav-link text-white" href="#" id="recursosDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="../../resources/img/recursos.png" class="icons-main" alt="">
            Recursos
          </a>
          <div class="dropdown-menu dropdown-menu-dark bg-dark" aria-labelledby="recursosDropdown">
            <a class="dropdown-item nav-item text-light" href="../../application/manual/"><i class="fa fa-address-book"></i> Manual MQ</a>
            <?php if (in_array(2, $per1)) { ?>
              <a class="dropdown-item nav-item text-light" href="../../application/permisos/index.php?table=1"><i class="fa-regular fa-calendar-check"></i> Permisos</a>
            <?php }
            if (in_array(3, $per1)) { ?>
              <a class="dropdown-item nav-item text-light" href="../../application/certificados/index.php?table=1"><i class="fa-regular fa-file-lines"></i> Certificaciones</a>
            <?php } ?>
          </div>
        </li>
        <?php if (in_array(5, $per)) { ?>
          <li class="nav-item mx-1 dropdown">
            <a class="nav-link text-white" href="#" id="mensajeriaDropdown" role="button" data-bs-toggle="dropdown"  aria-expanded="false">
              <img src="../../resources/img/mensajeria.png" class="icons-main" alt="">
              Mensajería
            </a>
            <div class="dropdown-menu dropdown-menu-dark bg-dark" aria-labelledby="mensajeriaDropdown">
              <?php if (in_array(6, $per1)) { ?>   
                <a class="dropdown-item nav-item text-light" href="../../application/diligencia/"><i class="fa fa-book"></i> Diligencias</a>
              <?php }
              if (in_array(7, $per1)) { ?>
                <a class="dropdown-item nav-item text-light" href="../../application/enrutamientos/"><i class="fa fa-motorcycle"></i> Enrutamientos</a>
                <?php }
              if (in_array(10, $per1)) { ?>
                <a class="dropdown-item nav-item text-light" href="../../application/visitas/index.php?table=1"><i class="fa fa-drivers-license"></i> Visitas</a>
              <?php } ?>
            </div>
          </li>
        <?php } ?>
        <?php if (in_array(32, $per)) { ?>
          <li class="nav-item mx-1 dropdown">
            <a class="nav-link text-white" href="#" id="ventasDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="../../resources/img/icon_inventarios.png" class="icons-main" alt="">
              Inventario
            </a>
            <div class="dropdown-menu dropdown-menu-dark bg-dark" aria-labelledby="ventasDropdown">
              <?php
              if (in_array(33, $per1)) { ?>
                <a class="dropdown-item nav-item text-light" href="../../application/solicitudInven/index.php?table=1"><i class="fa-solid fa-list-check"></i> Solicitudes</a>
              <?php }
              if (in_array(34, $per1)) {  ?>
                <a class="dropdown-item nav-item text-light" href="../../application/administrarInven/index.php?table=1"><i class="fa-solid fa-gear"></i> Administrar </a>
              <?php }  ?>
            </div>
          </li>
          <?php } ?>
        <?php if (in_array(12, $per)) { ?>
          <?php if (in_array(13, $per1)) { ?>
            <li class="nav-item mx-1">
              <a class="nav-link text-white" href="../../application/correspondencia2/index.php?table=1">
                <img src="../../resources/img/correspondencia.png" class="icons-main" alt="">
                Correspondencia
              </a>
            </li>
          <?php } ?>
        <?php } ?>
        <?php if (in_array(15, $per)) { ?>
          <?php if (in_array(16, $per1)) { ?>
            <li class="nav-item mx-1">
              <a class="nav-link text-white" href="../../application/cotizadorv3/index.php?table=1">
                <img src="../../resources/img/cotizador.png" class="icons-main" alt="">
                Cotizador
              </a>
            </li>
          <?php } ?>
        <?php } ?>
        <?php if (in_array(18, $per)) { ?>
          <li class="nav-item mx-1">
            <?php if (in_array(19, $per1)) { ?>
                <a class="nav-link text-white" href="../../application/creditoV3/index.php?table=1">
                  <img src="../../resources/img/ventas.png" class="icons-main" alt="">
                  Créditos
                </a>
            <?php } ?>
          </li>
        <?php } ?>
        <?php if (in_array(23, $per)) { ?>
          <li class="nav-item mx-1 dropdown">
            <a class="nav-link text-white" href="#" id="thDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="../../resources/img/talento_humano.png" class="icons-main" alt="">
              T. Humano
            </a>
            <div class="dropdown-menu dropdown-menu-dark bg-dark" aria-labelledby="thDropdown">
              <?php
              if (in_array(24, $per1)) { ?>
                <a class="dropdown-item nav-item text-light" href="../../application/personal/index.php?table=1"><i class="fa-solid fa-users" ></i> Personal</a>
              <?php }
              if (in_array(24, $per1)) { ?>
                <a class="dropdown-item nav-item text-light" href="../../application/pagos/index.php?table=1"><i class="fa fa-dollar"></i> Pagos</a>
              <?php }
              if (in_array(25, $per1)) { ?>
                <a class="dropdown-item nav-item text-light" href="../../application/eventos/index.php?table=1"><i class="fa fa-child"></i> Eventos</a>
              <?php }
              if (in_array(26, $per1)) { ?>
                <a class="dropdown-item nav-item text-light" href="../../application/descuentos/index.php?table=1"><i class="fa-regular fa-money-bill-1"></i> Descuentos de Nomina</a>
              <?php }
              if (in_array(27, $per1)) { ?>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item nav-item text-light" href="../../application/indicadores"><i class="fa-solid fa-chart-pie"></i> Indicadores</a>
              <?php } ?>
            </div>
          </li>
        <?php } ?>
        <?php if (in_array(35, $per)) { ?>
          <li class="nav-item mx-1">
                <a class="nav-link text-white" href="../../application/fenaseo/index.php">
                  <img src="../../resources/img/fenaseo.png" class="icons-main" alt="">
                  Fenaseo
                </a>
          </li>
        <?php } ?>
        <?php if (in_array(28, $per)) { ?>
          <li class="nav-item mx-1 dropdown">
            <a class="nav-link text-white" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="../../resources/img/administracion.png" class="icons-main" alt="">
              Administración
            </a>
            <div class="dropdown-menu dropdown-menu-dark bg-dark" aria-labelledby="adminDropdown">
              <a class="dropdown-item nav-item text-light" href="../../application/usuarios/index.php"><i class="fa fa-user"></i> Usuarios</a>
            </div>
          </li>
        <?php } ?>
      </ul>
      <ul class="navbar-nav mx-4 ms-auto">
        <li class="nav-item dropdown align-items-end">
          <a class="nav-link text-white logos" href="#" id="sesionDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php if (isset($_SESSION['access_token'])) { ?>
              <img src="../../resources/img/google.png" class="logoGoogle" >
            <?php } else { ?>
              <i class="fa fa-google text-mq"></i>
            <?php } ?>
          <i class="fa-solid fa-circle-user logo-user"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-dark bg-dark dropdown-menu-end" aria-labelledby="sesionDropdown">
            <a class="dropdown-item nav-item text-light fs-4">
              <?php echo $sesion_nom; ?>
              <a class="dropdown-item nav-item text-light fs-6 fst-italic text-end">
                <?php if (isset($r['nom_carg'])) { echo $r['nom_carg']; } ?>
              </a>
            </a>
        
            <a class="dropdown-item nav-item text-light" href="../../application/configuracion/index.php">
              <i class="fa fa-cog"></i> Configuración
            </a>
            <a class="dropdown-item nav-item text-light" href="../../session/logout.php">
              <i class="fa fa-power-off"></i> Cerrar Sesión
            </a>
          
          </div>
          
        </li>
      </ul>
    </div>
  </nav>
  <div class="" id="alert-loader"></div>

