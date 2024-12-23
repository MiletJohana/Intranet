<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';
$sql1 = "SELECT com.id_agen, com.id_cli, cli.nom_cli, com.dir_cli, com.id_usu, us.nom_usu, com.fec_cre, com.obs_agen, est.nom_est, com.id_est 
	FROM agen_comerciales AS com 
	INNER JOIN mq_usu AS us
	ON com.id_usu = us.id_usu
	INNER JOIN mq_clientes AS cli
	ON com.id_cli = cli.id_cli
	INNER JOIN agen_raz AS raz
	ON com.id_raz = raz.id_raz
	INNER JOIN agen_est AS est
    ON est.id_est = com.id_est
    ORDER BY com.id_agen";
$query = $conexion->query($sql1); ?>
<div class="col-12">
    <?php if ($query->rowCount() > 0) { ?>
        <div class="table-responsive">
            <table class="table table-bordered" id="tableComerciales2">
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
                $('#tableComerciales2').DataTable({
                    "ordering": true,
                    "order": [
                        [1, "desc"]
                    ]
                });
                $('.dataTables_length').addClass('bs-select');
            });
        </script>
    <?php } else { ?>
        <div class="alert alert-success alert-dismissible fade show mt-4 d-flex align-items-center" role="alert">
            <i class="fa-solid fa-circle-check me-3 fa-xl"></i>
                    No hay resultados
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
</div>