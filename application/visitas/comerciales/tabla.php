<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';
$sql1 = "SELECT com.id_agen, com.fec_cre, cli.nom_cli, com.dir_cli, us.nom_usu, est.nom_est
FROM agen_com AS com 
INNER JOIN mq_usu AS us
ON com.id_usu = us.id_usu
INNER JOIN mq_clie AS cli
ON com.id_cli = cli.id_cli
INNER JOIN agen_est AS est
ON est.id_est = com.id_est
WHERE us.id_usu = " . $_SESSION['id'];
$query = $conexion->query($sql1); ?>

<div class="col-md-12">
    <button type="button" onclick="crearCita();" class="btn btn-danger btn-raised my-3" data-toggle="modal" data-target="#mediumModal">
        Crear cita
    </button>
    <?php if ($query->num_rows > 0) { ?>
        <div class="table-responsive-sm">
            <table class="table table-bordered table-sm font-table <?php if ($session_theme == 1) {
                                                                        echo "table-dark text-dark";
                                                                    } ?>" id="tableComerciales">
                <thead class="thead-dark">
                    <tr>
                        <th></th>
                        <th>#</th>
                        <th>Fecha Cita</th>
                        <th>Cliente</th>
                        <th>Dirección</th>
                        <th>Asesor</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($r = $query->fetch_array()) { ?>
                        <tr>
                            <td class="table-td-sm">
                                <button class="btn btn-default bmd-btn-fab bmd-btn-fab-sm ml-1 p-2" type="button" onclick="mostrarCita(<?php echo $r['id_agen']; ?>);" data-toggle="modal" data-target="#largeModal"><i class="fa fa-info"></i></button>
                            </td>
                            <td><?php echo utf8_encode($r["id_agen"]); ?></td>
                            <td><?php echo utf8_encode($r["fec_cre"]); ?></td>
                            <td><?php echo utf8_encode($r["nom_cli"]); ?></td>
                            <td><?php echo utf8_encode($r["dir_cli"]); ?></td>
                            <td><?php echo utf8_encode($r["nom_usu"]); ?></td>
                            <td><?php echo utf8_encode($r["nom_est"]); ?></td>  
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <input type="hidden" id="latitud" name="latitud" value="">
            <input type="hidden" id="longitud" name="longitud" value="">
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#tableComerciales').DataTable({
                    "ordering": true,
                    "order": [
                        [0, "desc"]
                    ]
                });
                $('.dataTables_length').addClass('bs-select');
            });
        </script>
    <?php } else { ?>
        <div class="alert alert-warning alert-dismissible fade show mt-2" role="alert">
            No hay resultados
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } ?>
</div>