<?php
include '../../resources/template/credentials.php';
include "../../conexion.php";

    if($sesion_are == 5){
    /* Consulta empleados MQ */
    $sqlUsuMQ = "SELECT usu.id_usu, usu.nom_usu FROM mq_usu AS usu 
    WHERE usu.id_are = ? ;";
    $queryUsuMQ = $conexion -> prepare($sqlUsuMQ);
    $queryUsuMQ -> execute([5]);

    $rowInfoUsuMQ = $queryUsuMQ->fetchAll(PDO::FETCH_ASSOC);
    
?>
 <div class="row g-0 px-4 my-4">
        <div class="col-12">
            <button class="btn btn-info" id="btn_filter" onclick="filter(1);"><i class="fa-solid fa-filter me-2"></i>Filtrar</button>
        </div>
    </div>

        <div class="card border-primary mx-4 mb-4 d-none" id="card_filter">
            <h5 class="card-header bg-dark text-white fs-4"> <i class="fa-solid fa-filter me-2"></i>Filtros</h5>
                <div class="row d-flex justify-content-evenly mt-3">
                    <div class="col-md-4 col-sm-12 mb-3">
                        <label for="mesHs" class="form-label">Mes</label>
                        <input type="month" id="mes" name="mes" value="<?php //echo date('Y-m'); ?>" max="" min="" class="form-control" onchange="filter_his(2);">
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="empleado_mq" class="form-label">Empleado</label>
                        <select class="form-select" id="empleado_mq" onchange="filter_his(2);">
                                <option value="">Todos</option>
                                <?php foreach($rowInfoUsuMQ as $usu){ ?>
                                    <option value="<?php echo $usu['id_usu']; ?>"><?php echo $usu['nom_usu']; ?></option>
                                <?php } ?>
                        </select>
                    </div>
                </div> 
            </div>
        </div>
<?php } ?>
<div class="row g-0 px-4">
    <div class="col-12 mt-4">
        <div class="table-responsive">
            <table class="table table-bordered" style="width:100%" id="tableCorrespondencia4">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nombre del Creador</th>
                        <th>Nombre del Documento</th>
                        <th>Proveedor</th>
                        <th>Fecha</th>
                        <th>N-Fact</th>
                        <th>Remitido A</th>
                        <th>Estado</th>
                        <th></th>
                    </tr>
                </thead>
            </table>
        </div>
        <input type="hidden" name="id_usu" id="id_usu" value="<?php echo (isset($sesion_id)) ? $sesion_id : ''; ?>">
        <input type="hidden" name="id_are" id="id_are" value="<?php echo (isset($sesion_are)) ? $sesion_are : ''; ?>">
        <script type="text/javascript">
            $(document).ready(function() {
                serverSideCorrespondencia4();
            });
        </script>
</div>
</div>

