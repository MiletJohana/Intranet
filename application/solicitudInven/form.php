<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';
date_default_timezone_set("America/Bogota");

if($_POST['resp'] == 1){
    $sqlArea = "SELECT * FROM mq_are WHERE id_are = ? ;";
    $queryArea = $conexion -> prepare($sqlArea);
    $queryArea -> execute([$sesion_are]);
    $rowInfoArea = $queryArea->fetch(PDO::FETCH_ASSOC);
    
    $sqlReg = "SELECT * FROM mq_reg WHERE id_reg = ? ;";
    $queryReg = $conexion -> prepare($sqlReg);
    $queryReg -> execute([$sesion_reg]);
    $rowInfoReg = $queryReg->fetch(PDO::FETCH_ASSOC);
} else {
    $sqlArea = "SELECT * FROM mq_are WHERE id_are != ?;";
    $queryArea = $conexion -> prepare($sqlArea);
    $queryArea -> execute([10]);
    $rowInfoArea = $queryArea->fetchAll(PDO::FETCH_ASSOC);
    
    $sqlReg = "SELECT * FROM mq_reg;";
    $queryReg = $conexion -> prepare($sqlReg);
    $queryReg -> execute();
    $rowInfoReg = $queryReg->fetchAll(PDO::FETCH_ASSOC);
}


?>
<div class="row">
    <div class="container">
        <div style="text-align:center;" class="col-12 mb-5">
            <h2><i class="fa-solid fa-boxes-packing me-4"></i><span id="text-principal-sol">Crear Solicitud</span></h2>
            <p class="fst-italic" style="text-align: left;">Información Usuario:</p>
            <hr class="mb-4">

            <?php if ($_POST['resp'] == 1) { ?>
                <p class="fs-5 fw-bold separar-text">Solicitante: <span><?php echo $sesion_nom; ?></span></p>
                <input type="hidden" name="id_usu" id="id_usu" value="<?php echo $sesion_id; ?>">

                <p class="separar-text">Área: <span><?php echo $rowInfoArea['nom_are']; ?></span></p>
                <input type="hidden" name="id_are" id="id_are" value="<?php echo $sesion_are; ?>">

                <p class="separar-text">Regional: <span><?php echo $rowInfoReg['nom_reg']; ?></span></p>
                <input type="hidden" name="id_reg" id="id_reg" value="<?php echo $sesion_reg; ?>">
           
            <?php } else { ?>
                <p class="fw-bold separar-text">Regional: <select name="id_reg" id="id_reg" class="form-select" style="width: 300px;">
                                                        <?php foreach ($rowInfoReg as $reg) {?>
                                                                <option value="<?php echo $reg['id_reg']; ?>"><?php echo $reg['nom_reg']; ?></option>
                                                            <?php } ?>
                                                        </select>
                </p>
                <p class="fw-bold separar-text">Área:   <select name="id_are" id="id_are" class="form-select" style="width: 300px;" onchange="select_user_mq(this.value);">
                                                    <option value="" selected>Seleccionar área</option>
                                                    <?php foreach ($rowInfoArea as $are) {?>
                                                        <option value="<?php echo $are['id_are']; ?>"><?php echo $are['nom_are']; ?></option>
                                                    <?php } ?>
                                                    </select>
                </p>
                <p class="fw-bold separar-text">Solicitante:   <select name="id_usu" id="id_usu" class="form-select" style="width: 300px;" onchange="validar_sol(this.value);" disabled>
                                                                        <option value="">Seleccionar Personal MQ...</option>
                                                                    </select>
                </p>
            <?php } ?>
           
        </div>
        <div class="col-12 mb-5">
            <p class="fst-italic" id="text-select-product">Seleccionar Productos:</p>
            <hr>
        </div>
        <div id="div_tabla_resumen" class="none col-12" style="text-align:center;">
            <div class="table-responsive">
                <table class="table table-hover table-bordered" style="width:100%" id="tableResumenSolInv">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th></th>
                            <th>Producto</th>
                            <th>Cantidad Solicitada</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

        <div class="col-12 text-center" id="div_table_products">
            <div class="table-responsive">
                <table class="table table-hover" style="width:100%" id="tableSolicitudInv">
                    <thead class="table-dark">
                        <tr>
                            <th></th>
                            <th>Producto</th>
                            <th>Máx</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
   
</div>
<?php if ($_POST['resp'] == 1) { ?>
    <script type="text/javascript">
        $(document).ready(function() {
            serverSideSolicitudInv(<?php echo $sesion_reg; ?>, <?php echo $sesion_are; ?>);
        });
    </script>
<?php } ?>

