<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';
date_default_timezone_set("America/Bogota");
$sqlSol = "SELECT sol.*, est.*, usu.nom_usu, usu.id_reg, usu.id_are FROM inv_solicitud sol 
           INNER JOIN inv_est_sol est ON sol.est_sol = est.id_est_sol
           INNER JOIN mq_usu usu ON sol.id_usu = usu.id_usu
           WHERE sol.id_sol = '".$_POST['id']. "';";
$querySol = $conexion -> query($sqlSol);

$rowInfoSol = $querySol->fetch(PDO::FETCH_ASSOC);
$sqlArea = "SELECT * FROM mq_are WHERE id_are = '".$rowInfoSol['id_are']. "';";
$queryArea = $conexion -> query($sqlArea);
$rowInfoArea = $queryArea->fetch(PDO::FETCH_ASSOC);
$sqlReg = "SELECT * FROM mq_reg WHERE id_reg = '".$rowInfoSol['id_reg']. "';";
$queryReg = $conexion -> query($sqlReg);
$rowInfoReg = $queryReg->fetch(PDO::FETCH_ASSOC);
?>
<div class="row">
    <div class="container">
        <div style="text-align:center;" class="col-12 mb-5">
            <h2><i class="fa-solid fa-truck-ramp-box me-3"></i><span id="text-principal-sol">Solicitud # <?php echo $_POST['id']; ?></span></h2>
            <input type="hidden" id="id_sol" name="id_sol" value="<?php echo $_POST['id']; ?>">
            <p class="fst-italic" style="text-align: left;">Información Usuario:</p>
            <hr class="mb-4">
            <p class="fs-5 fw-bold separar-text">Solicitante: 
                <span><?php echo $rowInfoSol['nom_usu']; ?></span>
            </p>
            <p class="separar-text">Área: <span><?php echo $rowInfoArea['nom_are']; ?></span></p>
            <p class="separar-text">Regional: <span><?php echo $rowInfoReg['nom_reg']; ?></span></p>
            <p class="separar-text">Estado: <span class="rounded-pill badge bg-<?php echo $rowInfoSol['color_est']; ?>"><?php echo $rowInfoSol['nom_est_sol']; ?></span></p>
            <p class="separar-text">Fecha de Solicitud: <span><?php echo $rowInfoSol['fec_sol']; ?></span></p>
          
        </div>
        <div class="col-12 mb-5">
            <p class="fst-italic" id="text-select-product">Productos Seleccionados:</p>
            <hr>
            <p id="form_message" class="text-mq" style="text-align:center;"></p>
        </div>
        <div class="col-12 text-center" id="div_table_products">
            <div class="table-responsive">
                <table class="table table-hover" style="width:100%" id="table_prod_sol">
                    <thead class="table-dark">
                        <tr>
                            <th></th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Entregado</th>
                            <th>Requiere aprobación</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
   
</div>
<script type="text/javascript">
    /*$(document).ready(function() {
        serverSideInvSolDetallada(1, <?php //echo $_POST['id']; ?>);
    });*/
</script>
    </div>
</div>
