<input type="hidden" id="latitud" name="latitud" value="">
<input type="hidden" id="longitud" name="longitud" value="">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb mb-0 ">
    <li class="breadcrumb-item"><a href="../home/">Inicio</a></li>
    <li class="breadcrumb-item">Ventas</li>
    <li class="breadcrumb-item active" aria-current="page">Visitas Comerciales</li>
  </ol>
</nav>
<div class="col-md-12">
  <div class="py-3">
    <h3>Visitas Comerciales</h3>
  </div>
  <ul class="nav nav-tabs ">
    <li class="nav-item">
      <a class="nav-link <?php if (isset($_GET['table']) && $_GET['table'] == 1) {
                            echo "active";
                          } ?>" href="index.php?table=1">Mis Visitas</a>
    </li>
    <?php if ($_SESSION['lid'] == 2 || $_SESSION['are'] == 9 || $_SESSION['lid'] == 1 || $_SESSION['lid'] == 4) { ?>
      <li class="nav-item">
        <a class="nav-link <?php if (isset($_GET['table']) && $_GET['table'] == 2) {
                              echo "active";
                            } ?>" href="index.php?table=2">Historial</a>
      </li>
    <?php } ?>
  </ul>
  <?php if (!isset($_SESSION['access_token'])) { ?>
    <div class="alert alert-info alert-dismissible fade show mt-2" role="alert">
      No iniciaste sesión con Google, por tanto, si creas una visita el evento en tu calendario no se creará
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php } ?>
</div>