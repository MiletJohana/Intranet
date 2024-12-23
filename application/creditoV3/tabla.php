<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';
?>
<div class="col-12 mb-5">
    <div class="p-3">
        <h4><i class="fa-solid fa-clock me-2"></i> Pendientes</h4>

    </div>
    <?php if ($query->rowCount() > 0) { ?>
        <div class="table-responsive-sm">
            <table class="table table-bordered" id="tableCredito">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nombre del cliente </th>
                        <th>Nombre de Contacto</th>
                        <th>Fecha </th>
                        <th>Asesor Tecnico</th>
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
                serverSideCreditos(1, 1, <?php echo $_SESSION['rol']; ?>);
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
<?php if (((isset($_SESSION['rol']) && $_SESSION['rol'] == 100) || (isset($_POST['rol']) && $_POST['rol'] == 100)) || ((isset($_SESSION['rol']) && $_SESSION['rol'] == 500) || (isset($_POST['rol']) && $_POST['rol'] == 500))) {
    include 'tabla2.php';
} ?>
