<nav aria-label="breadcrumb">
    <ol class="breadcrumb mt-3 ms-3">
        <li class="breadcrumb-item"><a href="../home/">Inicio</a></li>
        <li class="breadcrumb-item">Estadisticas</li>
        <li class="breadcrumb-item active text-mq" aria-current="page">
            <?php if ($_GET['app'] == 1) { ?>
                <?php if ($_GET['cha'] == 1) { ?>
                    Permisos
                <?php } else if ($_GET['cha'] == 2) { ?>
                    Certificados
                <?php } ?>
            <?php } else if ($_GET['app'] == 2) { ?>
                <?php if ($_GET['cha'] == 1) { ?>
                    Correspondencia
                <?php } ?>
            <?php } else if ($_GET['app'] == 3) { ?>
                <?php if ($_GET['cha'] == 1) { ?>
                    Diligencias y Enrutamientos
                <?php } else if ($_GET['cha'] == 2) { ?>
                    Visitas
                <?php } ?>
            <?php } else if ($_GET['app'] == 4) { ?>
                <?php if ($_GET['cha'] == 1) { ?>
                    Solicitud de crédito
                <?php } else if ($_GET['cha'] == 2) { ?>
                    Agenda comercial
                <?php } ?>
            <?php } else if ($_GET['app'] == 5) { ?>
                <?php if ($_GET['cha'] == 1) { ?>
                    Cotizador
                <?php } ?>
            <?php } else if ($_GET['app'] == 6) { ?>
                <?php if ($_GET['cha'] == 1) { ?>
                    Ventas
                <?php } ?>
            <?php } ?>
        </li>
    </ol>
</nav>
<div class="col-12">
    <ul class="nav nav-tabs ">
        <?php if ($_GET['app'] == 1) { ?>
            <li class="nav-item">
                <a class="nav-link" href="index.php?app=1&cha=1">Permisos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?app=1&cha=2">Certificados</a>
            </li>
        <?php } else if ($_GET['app'] == 2) { ?>
            <li class="nav-item">
                <a class="nav-link" href="index.php?app=2&cha=1">Correspondencia</a>
            </li>
        <?php } else if ($_GET['app'] == 3) { ?>
            <li class="nav-item">
                <a class="nav-link" href="index.php?app=3&cha=1">Diligencias y Enrutamientos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?app=3&cha=2">Visitas</a>
            </li>
        <?php } else if ($_GET['app'] == 4) { ?>
            <li class="nav-item">
                <a class="nav-link" href="index.php?app=4&cha=1">Solicitud de crédito</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?app=4&cha=2">Agenda comercial</a>
            </li>
        <?php } else if ($_GET['app'] == 5) { ?>
            <li class="nav-item">
                <a class="nav-link" href="index.php?app=5&cha=1">Cotizador</a>
            </li>
        <?php } else if ($_GET['app'] == 6) { ?>
            <li class="nav-item">
                <a class="nav-link" href="index.php?app=6&cha=1">Cotizador</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?app=6&cha=2">Visitas comerciales</a>
            </li>
        <?php } ?>
    </ul>
</div>
<div class="row">
    <div class="col-12">
        <?php if ($_GET['app'] == 1) { ?>
            <?php if ($_GET['cha'] == 1) { ?>
                <iframe width="100%" height="455" src="https://datastudio.google.com/embed/reporting/1HBExeuRRW4JbSiffYGhUsNoDWo_VcigJ/page/CI85" frameborder="0" style="border:0" allowfullscreen></iframe>
            <?php } else if ($_GET['cha'] == 2) { ?>
                <iframe width="100%" height="455" src="https://datastudio.google.com/embed/reporting/18fV7dIAJHkNgp1rqNBHfPqD3iEsh2qVs/page/CW55" frameborder="0" style="border:0" allowfullscreen></iframe>
            <?php } ?>
        <?php } else if ($_GET['app'] == 2) { ?>
            <?php if ($_GET['cha'] == 1) { ?>
                <iframe width="100%" height="455" src="https://datastudio.google.com/embed/reporting/1MwSowLa19RDDKr8dOwuL6fhc1wclgIZl/page/CW55" frameborder="0" style="border:0" allowfullscreen></iframe>
            <?php } ?>
        <?php } else if ($_GET['app'] == 3) { ?>
            <?php if ($_GET['cha'] == 1) { ?>
                <iframe width="100%" height="455" src="https://datastudio.google.com/embed/reporting/1g_v-bbRJw5TETl6FkXVg4x-HfSf3Sl_M/page/CW55" frameborder="0" style="border:0" allowfullscreen></iframe>
            <?php } else if ($_GET['cha'] == 2) { ?>
                <iframe width="100%" height="455" src="https://datastudio.google.com/embed/reporting/1heNM7UB66NqBisEAGutT2TupuQZZVf0A/page/CW55" frameborder="0" style="border:0" allowfullscreen></iframe>
            <?php } ?>
        <?php } else if ($_GET['app'] == 4) { ?>
            <?php if ($_GET['cha'] == 1) { ?>
                <iframe width="100%" height="455" src="https://datastudio.google.com/embed/reporting/1SKxD_o34xQPCRcBh00f2kcQWNXDtJqr2/page/CW55" frameborder="0" style="border:0" allowfullscreen></iframe>
            <?php } else  if ($_GET['cha'] == 2) { ?>
                <iframe width="100%" height="455" src="https://datastudio.google.com/embed/reporting/1tqFku3NuUKpNrBvQ9dBQ7P8lagYe5hAX/page/3Bx6" frameborder="0" style="border:0" allowfullscreen></iframe>
            <?php } ?>
        <?php } else if ($_GET['app'] == 5) { ?>
            <?php if ($_GET['cha'] == 1) { ?>
                <iframe width="100%" height="455" src="https://datastudio.google.com/embed/reporting/1rbu-hr1E2xOCwV0sdfFQmvPG0utzSBHL/page/CW55" frameborder="0" style="border:0" allowfullscreen></iframe>
            <?php } ?>
        <?php } else if ($_GET['app'] == 6) { ?>
            <?php if ($_GET['cha'] == 1) { ?>
                <iframe width="100%" height="455" src="https://datastudio.google.com/embed/reporting/1rbu-hr1E2xOCwV0sdfFQmvPG0utzSBHL/page/CW55" frameborder="0" style="border:0" allowfullscreen></iframe>
            <?php } else  if ($_GET['cha'] == 2) { ?>
                <iframe width="100%" height="455" src="https://datastudio.google.com/embed/reporting/1tqFku3NuUKpNrBvQ9dBQ7P8lagYe5hAX/page/CW55" frameborder="0" style="border:0" allowfullscreen></iframe>
            <?php } ?>
        <?php } ?>
    </div>
</div>