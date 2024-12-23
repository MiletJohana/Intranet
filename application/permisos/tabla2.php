<?php

    include '../../conexion.php';
    include '../../resources/template/credentials.php';

?>


<div class="col-12">
    <div class="p-3">
            <h5>Mis Pendientes</h5>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-sm" id="tablePermisos2-1">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Usuario Del Permiso</th>
                    <th>Fecha De Creación</th>
                    <th>Fecha De Ausencia</th>
                    <th>H.Inicio</th>
                    <th>H.Final</th>
                    <th>Motivo</th>
                    <th>Comentario Col</th>
                    <th>Soporte</th>
                    <?php if (isset($_SESSION['are']) && $_SESSION['are'] == 9 && $_SESSION['lid'] == 3) { ?>
                        <th> Revisado </th>
                    <?php } elseif (isset($_SESSION['lid']) && $_SESSION['lid'] == 2 || $_SESSION['lid'] == 1 || $_SESSION['lid'] == 4) { ?>
                        <th> Estado</th>
                    <?php } ?>
                    <th></th>
                </tr>
            </thead>
        </table>
        <script type="text/javascript">
        $(document).ready(function() {
            serverSidePermisos(2, '', <?php echo $_SESSION['lid'] ?>, <?php echo $_SESSION['are'] ?>);
        });

    </script>
    </div>


    <?php if ($_SESSION['lid'] == 1) { ?>
    <div class="p-3 mt-5">
        <h5>Pendientes Por Recibir</h5>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered tablePermisos1 table-sm" id="tablePermisos2-2">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Usuario Del Permiso</th>
                    <th>Fecha De Creación</th>
                    <th>Fecha De Ausencia</th>
                    <th>Área</th>
                    <th>H.Inicio</th>
                    <th>H.Final</th>
                    <th>Motivo</th>
                    <th>Soporte</th>
                    <th>Revisado</th>
                    <th>Acción</th>
                </tr>
            </thead>
        </table>
    </div>
   
</div>

<?php } ?> 
<script type="text/javascript">
        $(document).ready(function() {
            serverSidePermisos(1, 2, '' , '');
        });

    </script>