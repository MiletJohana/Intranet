<nav aria-label="breadcrumb">
    <ol class="breadcrumb mt-3 ms-3">
        <li class="breadcrumb-item"><a href="../home/">Inicio</a></li>
        <li class="breadcrumb-item active text-mq" aria-current="page">
            Contactos
        </li>
    </ol>
</nav>
<div class="col-12">
    <div class="py-3">
        <h3>Contactos</h3>
    </div>
    <div class="row mb-2">
        <div class="col-md-2">
            <button type="button" onclick="modalContacto(1, 0, 1);" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#largeModal">
                Crear contacto
            </button>
        </div>
        <div class="col-md-2">
            <?php if ($_GET['table'] == 1) { ?>
                <a class="btn btn-success" href="index.php?table=2">
                    Contactos Andi
                </a>
            <?php } else if ($_GET['table'] == 2) { ?>
                <a class="btn btn-danger" href="index.php?table=1">
                    Contactos
                </a>
            <?php } ?>
        </div>
        <?php if ($_GET['table'] == 1) { ?>
            <div class="col-md-2">
                <label for="fec_crea">Fecha de creación</label>
                <input type="month" id="fec_crea" name="fec_crea" value="<?= date('Y-m') ?>" max="<?= date('Y-12') ?>" min=" " class="form-control" onchange="filtro('fec_crea','../contactos/tabla.php')">
            </div>
        <?php } ?>
    </div>
</div>