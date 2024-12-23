<?php
    if (isset($_SESSION['rol_inv']) && $_SESSION['rol_inv'] == 2) { 
        /* Consulta estados solicitud */
        $sqlEstSol = "SELECT * FROM inv_est_sol WHERE id_est_sol != ?";
        $queryEstSol = $conexion -> prepare($sqlEstSol);
        $queryEstSol -> execute([6]);

        $rowInfoEstSol = $queryEstSol->fetchAll(PDO::FETCH_ASSOC);

        /* Consulta empleados MQ */
        $sqlUsuMQ = "SELECT usu.id_usu, usu.nom_usu, are.nom_are FROM mq_usu AS usu 
                    INNER JOIN mq_are AS are ON usu.id_are = are.id_are
                    WHERE usu.usu_elim != ? 
                    ORDER BY are.id_are ASC";
        $queryUsuMQ = $conexion -> prepare($sqlUsuMQ);
        $queryUsuMQ -> execute([1]);

        $rowInfoUsuMQ = $queryUsuMQ->fetchAll(PDO::FETCH_ASSOC);
?>

    <div class="row g-0 px-4 my-4">
        <div class="col-12">
            <button class="btn btn-info" id="btn_filter" onclick="filter(1);"><i class="fa-solid fa-filter me-2"></i>Filtrar</button>
        </div>
    </div>
        


        <div class="card border-primary mx-4 mb-4 d-none" id="card_filter">
            <h5 class="card-header bg-dark text-white fs-4"> <i class="fa-solid fa-filter me-2"></i>Filtros</h5>
                <div class="row d-flex justify-content-evenly">
                    <div class="col-md-3 col-sm-12">
                        <label for="est_sol" class="form-label">Estado</label>
                        <select class="form-select" id="est_sol" onchange="filter_his(2);">
                                <option value="1,2,3,4,5">Todas</option>
                                <?php foreach($rowInfoEstSol as $estado){ ?>
                                    <option value="<?php echo $estado['id_est_sol']; ?>"><?php echo $estado['nom_est_sol']; ?></option>
                                <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-4 col-sm-12 mb-3">
                        <label class="form-label">Rango de Fechas</label>
                        <div class="row">
                            <div class="col">
                                <input type="date" id="fecha1" name="fecha1" value="<?php //echo date('Y-m'); ?>" max="" min="" class="form-control" onchange="filter_his(2);">  
                            </div>
                            <div class="col">
                                <input type="date" id="fecha2" name="fecha2" value="<?php //echo date('Y-m'); ?>" max="" min="" class="form-control" onchange="filter_his(2);">     
                            </div>
                        </div> 
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="empleado_mq" class="form-label">Empleado</label>
                        <select class="form-select" id="empleado_mq" onchange="filter_his(2);">
                                <option value="">Todos</option>
                                <?php foreach($rowInfoUsuMQ as $usu){ ?>
                                    <option value="<?php echo $usu['id_usu']; ?>"><?php echo $usu['nom_usu'] .' ('.$usu['nom_are'].')'; ?></option>
                                <?php } ?>
                        </select>
                    </div>
                </div> 
            </div>
        </div>
            


    <div class="row g-0 px-4">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-hover table-bordered" style="width:100%" id="table_inv_sol_hist">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th></th>
                            <th>Productos - Cantidad</th>
                            <th>Estado</th>
                            <th>Fecha y Hora de Solicitud</th>
                            <th>Solicitante</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            serverSideInvSolHist();
        });
    </script>

<?php } else { ?>
        <div class="row g-0 mx-4">
            <div class="col-12 mt-4">
                <div class="alert alert-warning d-flex align-items-center fs-5" role="alert">
                    <i class="fa-solid fa-triangle-exclamation me-2"></i>
                    <div>
                        <span class="fw-bold">Acceso denegado: </span> No tienes permisos para acceder a esta sección.
                    </div>
                </div>
            </div>
        </div>
       
    <?php } ?>