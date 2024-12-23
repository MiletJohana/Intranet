<nav aria-label="breadcrumb">
    <ol class="breadcrumb mt-3 ms-3">
        <li class="breadcrumb-item"><a href="../home/">Inicio</a></li>
        <li class="breadcrumb-item disable">Inventarios</li>
        <li class="breadcrumb-item active text-mq" aria-current="page">Administrar</li>
    </ol>
</nav>
<div class="col-12">
    <div class="py-3">
        <h3 id="text-principal-inv"> Administrar 
            <?php if (isset($_GET['table']) && $_GET['table'] == 1) {
                    echo "- Inventario";
                } else if(isset($_GET['table']) && $_GET['table'] == 2){
                    echo "- Productos";
                } else if(isset($_GET['table']) && $_GET['table'] == 3){
                    echo "- Áreas y Asignación";
                }?>
        </h3>
    </div>
    <div class="table-responsive-sm mb-4">
        <ul class="nav nav-underline ms-2 flex-nowrap">
            <li class="nav-item">
                <a class="nav-link <?php if (isset($_GET['table']) && $_GET['table'] == 1) {
                                    echo "active";
                                    } ?>" href="index.php?table=1">Inventarios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if (isset($_GET['table']) && $_GET['table'] == 2) {
                                    echo "active";
                                    } ?>" href="index.php?table=2">Productos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if (isset($_GET['table']) && $_GET['table'] == 3) {
                                    echo "active";
                                } ?>" href="index.php?table=3">Áreas y Asignación de Productos</a>
            </li>
            <?php if (isset($_SESSION['rol_inv']) && isset($_SESSION['lid']) && $_SESSION['rol_inv'] == 2 && $_SESSION['lid'] == 1) { ?>
                <li class="nav-item">
                    <a class="nav-link <?php if (isset($_GET['table']) && $_GET['table'] == 4) {
                                        echo "active";
                                    } ?>" href="index.php?table=4">Configuración</a>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>

    <?php 
        if (isset($_SESSION['rol_inv']) && $_SESSION['rol_inv'] == 2) {
            if (isset($_GET['table']) && $_GET['table'] == 1) { 
                $sql="SELECT * FROM mq_reg;";
                $query = $conexion ->query($sql);
                $rowInfo = $query->fetchAll(PDO::FETCH_ASSOC); 
    ?>
            <div class="col-4">
                <label for="regional" class="form-label">Seleccione la Regional: <span name="req" class="text-mq">*</span></label>
                <select class="form-select" name="regional" id="regional" onchange="select_regional();">
                    <option value="">Seleccionar...</option>
                    <?php foreach ($rowInfo as $reg) { ?>
                        <option value="<?php echo $reg['id_reg']; ?>" id="reg<?php echo $reg['id_reg']; ?>" <?php echo (($reg['id_reg'] == 1) ? "selected" : "disabled"); ?>><?php echo $reg['nom_reg']; ?></option>
                    <?php } ?>
                </select>
            </div>
    <?php 
            } 
        }
    ?>
