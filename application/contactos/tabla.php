<?php
include "../../conexion.php";

$mes = date('Y-m');

$sql1 = "SELECT * FROM contactos AS con
INNER JOIN mq_clientes AS cli
ON con.id_cli = cli.id_cli ";

if (isset($_POST['para'])) {
    $para = $_POST['para'];
    //print_r($para);
    //echo "<br>";
    if ($para[0] != '') {
        $sql1 .= "WHERE con.fec_crea LIKE '$para[0]%' ";
    }
} else {
    $sql1 .= "WHERE con.fec_crea LIKE '$mes%' ";
}

$sql1 .= "GROUP BY con.id_cont";
$query = $conexion->query($sql1);
//echo $sql1;
?>
<style>
    #tableContactos_processing {
        background-color: #6b6b6b !important;
    }
</style>
<div class="col-md-12">
    <?php if ($query->rowCount() > 0) { ?>
        <div class="table-responsive">
            <table class="table table-bordered" id="tableContactos">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>NIT/CC</th>
                        <th>Cliente</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Cargo</th>
                        <th>Acción</th>
                    </tr>
                </thead>
            </table>
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                serverSideContactos();
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