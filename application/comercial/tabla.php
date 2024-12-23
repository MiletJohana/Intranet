<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';
$sql1 = "SELECT com.id_agen, com.fec_cre, cli.nom_cli, com.dir_cli, us.nom_usu, est.nom_est
FROM agen_comerciales AS com 
INNER JOIN mq_usu AS us
ON com.id_usu = us.id_usu
INNER JOIN mq_clientes AS cli
ON com.id_cli = cli.id_cli
INNER JOIN agen_est AS est
ON est.id_est = com.id_est
WHERE us.id_usu = " . $_SESSION['id'];
$query = $conexion->query($sql1); ?>

<div class="col-12">
    <button type="button" onclick="crearCita();" class="btn btn-danger my-3" data-bs-toggle="modal" data-bs-target="#largeModal">
        Crear cita
    </button>
        <div class="table-responsive mt-3">
            <table class="table table-bordered" id="tableComerciales">
                <thead class="table-dark">
                    <tr>
                        <th>Acción</th>
                        <th>#</th>
                        <th>Fecha Cita</th>
                        <th>Cliente</th>
                        <th>Dirección</th>
                        <th>Asesor</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($r = $query->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                            <td class="table-td-sm">
                                <button class="btn btn-default ms-1 p-2" type="button" onclick="mostrarCita(<?php echo $r['id_agen']; ?>);" data-bs-toggle="modal" data-bs-target="#largeModal"><i class="fa fa-info"></i></button>
                            </td>
                            <td><?php echo $r["id_agen"]; ?></td>
                            <td><?php echo $r["fec_cre"]; ?></td>
                            <td><?php echo $r["nom_cli"]; ?></td>
                            <td><?php echo $r["dir_cli"]; ?></td>
                            <td><?php echo $r["nom_usu"]; ?></td>
                            <td><?php echo $r["nom_est"]; ?></td>  
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
</div>