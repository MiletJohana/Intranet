<?php
if (isset($_POST['resp']) && $_POST['resp'] == 'cerrar') {
  include "../../conexion.php";
  include '../../resources/template/credentials.php';
} elseif (!isset($_POST['para'])) {
  include "../../conexion.php";
  include '../../resources/template/credentials.php';
} else {
  include "../../conexion.php";
  include '../../resources/template/credentials.php';
}
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d H:i:s");

?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb mt-3 ms-3">
    <li class="breadcrumb-item"><a href="../home/">Inicio</a></li>
    <li class="breadcrumb-item">Recursos</li>
    <li class="breadcrumb-item active text-mq" aria-current="page">Certificados</li>
  </ol>
</nav>
<div class="col-12">
  <div class="py-3">
    <h3>Certificados</h3>
  </div>
  <ul class="nav nav-underline ms-2 mb-4">
    <li class="nav-item">
      <a class="nav-link <?php if (isset($_GET['table']) && $_GET['table'] == 1) {
                            echo "active";
                          } ?>" href="index.php?table=1">Solicitud</a>
    </li>
    <?php if ($_SESSION['are']==9 || $_SESSION['lid']== 1){?>
    <li class="nav-item">
      <a class="nav-link <?php if (isset($_GET['table']) && $_GET['table'] == 2) {
                            echo "active";
                          } ?>" href="index.php?table=2">Personal Activo</a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?php if (isset($_GET['table']) && $_GET['table'] == 3) {
                            echo "active";
                          } ?>" href="index.php?table=3">Personal Retirado</a>
    </li>
    <?php } ?>
  </ul>
</div>