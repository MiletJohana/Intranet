<nav aria-label="breadcrumb">
  <ol class="breadcrumb mt-3 ms-3">
    <li class="breadcrumb-item"><a href="../home/">Inicio</a></li>
    <li class="breadcrumb-item">T. Humano</li>
    <li class="breadcrumb-item active text-mq" aria-current="page">Eventos</li>
  </ol>
</nav>
<div class="col-12">
  <div class="py-3">
    <h3>Eventos</h3>
  </div>
  <ul class="nav nav-tabs ">
    <li class="nav-item">
      <a class="nav-link <?php if (isset($_GET['table']) && $_GET['table'] == 1) {
                            echo "active";
                          } ?>" href="index.php?table=1">Actividades</a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?php if (isset($_GET['table']) && $_GET['table'] == 2) {
                            echo "active";
                          } ?>" href="index.php?table=2">Capacitaciones</a>
    </li>
  </ul>
</div>