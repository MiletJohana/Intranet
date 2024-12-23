<nav aria-label="breadcrumb">
  <ol class="breadcrumb mt-3 ms-3">
    <li class="breadcrumb-item"><a href="../home/">Inicio</a></li>
    <li class="breadcrumb-item">Mensajería</li>
    <li class="breadcrumb-item active text-mq" aria-current="page">Visitas</li>
  </ol>
</nav>
<div class="col-12 p-3 mb-4">
  <div class="py-3">
    <h3>Visitas</h3>
  </div>
  <div class="table-responsive-lg">
    <ul class="nav nav-underline ms-2 flex-nowrap ">
      <li class="nav-item">
        <a class="nav-link <?php if (isset($_GET['table']) && $_GET['table'] == 1) {
                              echo "active";
                            } ?>" href="index.php?table=1">Visitas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if (isset($_GET['table']) && $_GET['table'] == 2) {
                              echo "active";
                            } ?>" href="index.php?table=2">Visitantes</a>
      </li>
    </ul>
  </div>
</div>
