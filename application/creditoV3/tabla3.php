<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';
if ((isset($_SESSION['rol']) && $_SESSION['rol'] == 100) || (isset($_POST['rol']) && $_POST['rol'] == 100)) {
    $sqltabAso = "SELECT * FROM mq_clientes cl , cre_solicitud sl, cre_estadosol es, mq_usu us, contactos cont,  credit_actSol actsol 
    WHERE cl.id_cli = sl.id_cli 
    AND es.id_est = sl.id_est
    AND sl.activ_solicitada = actsol.id_act
    AND cont.id_cli = cl.id_cli
    AND sl.id_cont = cont.id_cont
    AND sl.id_usu=us.id_usu
    And sl.rep_sac=" . $_SESSION['id'];
    $sqltabAso .= " GROUP by sl.id_sol";
    $querytabAso = $conexion->query($sqltabAso);
} else {
    $sqltabAso = "SELECT * FROM mq_clientes cl , cre_solicitud sl, cre_estadosol es, mq_usu us, contactos cont,  credit_actSol actsol 
    WHERE cl.id_cli = sl.id_cli
    AND sl.activ_solicitada = actsol.id_act
    AND es.id_est =sl.id_est
    AND sl.id_usu=us.id_usu
    AND sl.id_cont = cont.id_cont
    And sl.ase_com=" . $_SESSION['id'];
    $sqltabAso .= " GROUP by sl.id_sol";
    $querytabAso = $conexion->query($sqltabAso);
}

//echo $sqltabAso;
?>
<div class="col-12 mt-4">
    <div class="p-3">
        <h4><i class="fa-solid fa-handshake me-2"></i>Asociadas</h4>
    </div>
    <?php if ($querytabAso->rowCount() > 0) { ?>
        <div class="table-responsive-sm">
            <table class="table table-bordered" id="tableCredito3">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nombre Del Cliente</th>
                        <th>Nombre de Contacto</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Actividad Solicitada</th>
                        <th>Usuario</th>
                        <th></th>
                    </tr>
                </thead>
            </table>
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                serverSideCreditos(3, 2, <?php echo $_SESSION['rol']; ?>);
            });
        </script>
    <?php } else { ?>
        <div class="alert alert-success alert-dismissible fade show mt-2 d-flex align-items-center" role="alert">
            <i class="fa-solid fa-circle-check me-3 fa-xl"></i>
                    No hay resultados
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
</div>
