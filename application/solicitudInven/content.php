<nav aria-label="breadcrumb">
    <ol class="breadcrumb mt-4 ps-4">
        <li class="breadcrumb-item"><a href="../home/">Inicio</a></li>
        <li class="breadcrumb-item disable">Inventario</li>
        <li class="breadcrumb-item active text-mq" aria-current="page">Solicitud</li>
    </ol>
</nav>

<div class="px-4 py-3">
    <h3>Solicitud</h3>
</div>

<div class="table-responsive-sm px-4">
        <ul class="nav nav-underline flex-nowrap">
            <li class="nav-item">
                <a class="nav-link <?php if (isset($_GET['table']) && $_GET['table'] == 1) {
                                    echo "active";
                                    } ?>" href="index.php?table=1">Mis Solicitudes</a>
            </li>
            <?php if (isset($_SESSION['rol_inv']) && $_SESSION['rol_inv'] == 2) { ?>
                <li class="nav-item">    
                    <a class="nav-link <?php if (isset($_GET['table']) && $_GET['table'] == 2) {
                                        echo "active";
                                    } ?>" href="index.php?table=2">Pendientes</a>
                </li>
            <?php } if (isset($_SESSION['rol_inv']) && $_SESSION['rol_inv'] == 2) { ?>
            <li class="nav-item">
                <a class="nav-link <?php if (isset($_GET['table']) && $_GET['table'] == 3) {
                                    echo "active";
                                } ?>" href="index.php?table=3">Histórico</a>
            </li>
            <?php } ?>
        </ul>
</div>


