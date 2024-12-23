<?php

    if (isset($_SESSION['rol_inv']) && $_SESSION['rol_inv'] == 2) { 
        /* Consulta estados solicitud */
        $sqlEstSol = "SELECT * FROM inv_est_sol WHERE id_est_sol in (?,?,?)";
        $queryEstSol = $conexion -> prepare($sqlEstSol);
        $queryEstSol -> execute([1,2,4]);

        $rowInfoEstSol = $queryEstSol->fetchAll(PDO::FETCH_ASSOC);
?>

        <div class="row g-0 mx-4">
            <div class="col-3 mt-4">
                <label for="est_sol" class="form-label">Estado</label>
                <input type="hidden" name="rol_inv" id="rol_inv" value="<?php echo $_SESSION['rol_inv']; ?>">
                <select class="form-select" id="est_sol" onchange="filter_his(1);">
                    <option value="1,2,4">Todas</option>
                    <?php foreach($rowInfoEstSol as $estado){ ?>
                        <option value="<?php echo $estado['id_est_sol']; ?>"><?php echo $estado['nom_est_sol']; ?></option>
                    <?php } ?>
                </select>
            </div>  
        </div>
        <div class="row g-0 mx-4">
            <div class="col-12 mt-4">
                <div class="table-responsive px-2">
                    <table class="table table-hover table-bordered" style="width:100%" id="table_inv_solicitud">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th></th>
                                <th>Productos - Cantidad</th>
                                <th>Estado</th>
                                <th>Fecha de Solicitud</th>
                                <th></th>
                            </tr>
                        </thead>
                    
                    </table>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function() {
                serverSideInvSolicitud(2, '1,2,4', <?php echo $_SESSION['rol_inv']; ?>);
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