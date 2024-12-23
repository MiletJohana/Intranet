<div class="col-md-12">
    <div class="p-3">
        <h4><i class="fa-solid fa-list me-2"></i> Solicitudes</h4>
    </div>
    <?php if ($query->rowCount() > 0) { ?>
        <div class="table-responsive text-wrap">
            <table class="table table-bordered table-sm" id="tableCredito2">
                <thead class="table-dark">
                        <th>#</th>
                        <th>Nombre del cliente </th>
                        <th>Nombre de Contacto</th>
                        <th>Fecha </th>
                        <th>Asesor Tecnico</th>
                        <th>Estado</th>
                        <th>Actividad Solicitada</th>
                        <th>Usuario</th>
                        <th></th>
                </thead>
                <tbody>
                    <?php while ($r = $query->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                            <td class="table-td-sm center-text">
                              <?php echo $r["id_sol"]; ?></td>
                            <td><?php echo $r["nom_cli"]; ?></td>
                            <td><?php echo $r["nom_cont"]; ?></td>
                            <td><?php echo $r["fecha_crea"]; ?></td>
                            <td><?php echo $r['nom_atc']; ?></td>
                            <td><?php if ($r['id_est'] == 1) {
                                        echo '<span class="badge  bg-label-secondary">'.$r['nom_est'].'</span>';
                                    } else if($r['id_est'] == 2){
                                        echo '<span class="badge  bg-label-warning">'.$r['nom_est'].'</span>';
                                    } else if($r['id_est'] == 3){
                                        echo '<span class="badge  bg-label-success">'.$r['nom_est'].'</span>';
                                    } else if($r['id_est'] == 4 || $r['id_est'] == 10){
                                        echo '<span class="badge  bg-label-danger">'.$r['nom_est'].'</span>';
                                    } else if($r['id_est'] == 7){
                                        echo '<span class="badge  bg-label-info">'.$r['nom_est'].'</span>';
                                    } else if($r['id_est'] == 8) {     
                                        echo '<span class="badge  bg-label-info">'.$r['nom_est'].'</span>';
                                    } ?>
                            </td>
                            <td><?php echo $r["nom_act"]; ?></td>
                            <td><?php echo $r["nom_usu"]; ?></td>
                            <td class="table-td-sm">
                            <?php if ($r["id_est"] == 1 && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 400)) { ?>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary rounded btn-sm" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end " aria-labelledby="dropdownMenu2">
                                            <a class="btn btn-link dropdown-item" onclick="EditarCrm(<?php echo $r['id_sol'] . ',' . $r['id_cli'] . ',' . $_SESSION['rol'] . ',' . $r['id_est']; ?>);" data-bs-toggle="modal" data-bs-target="#largeModal"><i class="fa-solid fa-pen-to-square me-2"></i>Editar</a>
                                            <a class="btn btn-link dropdown-item" onclick="mostrarSeg(<?php echo $r['id_sol'] . ',' . $r['id_est']; ?>);" data-bs-toggle="modal" data-bs-target="#mediumModal"><i class="fa-solid fa-share me-2"></i> Seguimiento</a>
                                            <?php if ($_SESSION['rol'] == 400) { ?>
                                                <a class="btn btn-link dropdown-item" onclick="EliminarCrm(<?php echo $r['id_sol']; ?>);" data-bs-toggle="modal" data-bs-target="#mediumModal"><i class="fa-solid fa-eraser me-2"></i>Eliminar</a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php } elseif ($r["id_est"] == 2 && ($_SESSION['rol'] == 300 || $_SESSION['rol'] == 400)) { ?>
                                    <div class="dropdown">
                                        <button class="btn btn-warning rounded btn-sm" type="button" id="dropdownMenu3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenu3">
                                            <a class="btn btn-link dropdown-item" onclick="EditarSol(<?php echo $r['id_sol'] . ',' . $r['id_cli'] . ',' . $_SESSION['rol'] . ',' . $r['id_est']; ?>);" data-bs-toggle="modal" data-bs-target="#largeModal"><i class="fa-solid fa-pen-to-square me-2"></i>Editar</a>
                                            <a class="btn btn-link dropdown-item" onclick="mostrarSeg(<?php echo $r['id_sol'] . ',' . $r['id_est']; ?>);" data-bs-toggle="modal" data-bs-target="#mediumModal"><i class="fa-solid fa-share me-2"></i> Seguimiento</a>
                                            <?php if ($_SESSION['rol'] == 400) { ?>
                                                <a class="btn btn-link dropdown-item" onclick="EliminarCrm(<?php echo $r['id_sol']; ?>);" data-bs-toggle="modal" data-bs-target="#mediumModal"><i class="fa-solid fa-eraser me-2"></i>Eliminar</a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php } elseif ($r["id_est"] == 4 && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 400 ||  $_SESSION['rol'] == 500)) { ?>
                                    <div class="dropdown">
                                        <button class="btn btn-danger rounded btn-sm" type="button" id="dropdownMenu4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenu4">
                                            <a class="btn btn-link dropdown-item" onclick="mostrarSeg(<?php echo $r['id_sol'] . ',' . $r['id_est']; ?>);" data-bs-toggle="modal" data-bs-target="#mediumModal"><i class="fa-solid fa-share me-2"></i> Seguimiento</a>
                                            <a class="btn btn-link dropdown-item" onclick="confirmacionCorreo(<?php if($r['eml_enviado'] == 1){ echo 2; } else { echo 1; } ?> ,<?php echo $r['id_sol']; ?> , <?php echo $r['id_cli']; ?>);" data-bs-toggle="modal" data-bs-target="#mediumModal"><i class="fa-solid fa-envelope me-2"></i> <?php if ($r['eml_enviado'] == 1){
                                                                                                                                                                                                                                                                            echo " Reenviar ";
                                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                                            echo " Enviar ";
                                                                                                                                                                                                                                                                        } ?> Correo</a>
                                            <a class="btn btn-link dropdown-item" onclick="mostrarCrm(<?php echo $r['id_sol'] . ',' . $r['id_est']; ?>);" data-bs-toggle="modal" data-bs-target="#largeModal"><i class="fa fa-tasks me-2"></i> Formulario</a>
                                            <?php if ($_SESSION['rol'] == 400) { ?>
                                                <a class="btn btn-link dropdown-item" onclick="EliminarCrm(<?php echo $r['id_sol']; ?>);" data-bs-toggle="modal" data-bs-target="#mediumModal"><i class="fa-solid fa-eraser me-1"></i>Eliminar</a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php } elseif ($r["id_est"] == 7 && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 400 ||  $_SESSION['rol'] == 500)) { ?>
                                    <div class="dropdown">
                                        <button class="btn btn-info rounded btn-sm" type="button" id="dropdownMenu5" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end " aria-labelledby="dropdownMenu5">
                                            <a class="btn btn-link dropdown-item" onclick="actualizaCrm(<?php echo $r['id_sol'] . ',' . $r['id_cli'] . ',' . $r['id_est']; ?>);" data-bs-toggle="modal" data-bs-target="#smallModal"><i class="fa-solid fa-pen-to-square me-2"></i>Editar</a>
                                            <a class="btn btn-link dropdown-item" onclick="mostrarSeg(<?php echo $r['id_sol'] . ',' . $r['id_est']; ?>);" data-bs-toggle="modal" data-bs-target="#mediumModal"><i class="fa-solid fa-share me-2"></i> Seguimiento</a>
                                            <?php if ($_SESSION['rol'] == 400) { ?>
                                                <a class="btn btn-link dropdown-item" onclick="EliminarCrm(<?php echo $r['id_sol']; ?>);" data-bs-toggle="modal" data-bs-target="#mediumModal"><i class="fa-solid fa-eraser me-2"></i>Eliminar</a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php } elseif ($r["id_est"] == 8 && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 400)) { ?>
                                    <div class="dropdown">
                                        <button class="btn btn-info rounded btn-sm" type="button" id="dropdownMenu6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end " aria-labelledby="dropdownMenu6">
                                            <a class="btn btn-link dropdown-item" onclick="mostrarSeg(<?php echo $r['id_sol'] . ',' . $r['id_est']; ?>);" data-bs-toggle="modal" data-bs-target="#mediumModal"><i class="fa-solid fa-share me-2"></i> Seguimiento</a>
                                            <a class="btn btn-link dropdown-item" onclick="actualizar1Crm(<?php echo $r['id_sol'] . ',' . $r['id_est']. ',' . $_SESSION['rol']; ?>);" data-bs-toggle="modal" data-bs-target="#largeModal"><i class="fa-solid fa-pen-to-square me-2"></i>Editar</a>
                                            <?php if ($_SESSION['rol'] == 400) { ?>
                                                <a class="btn btn-link dropdown-item" onclick="EliminarCrm(<?php echo $r['id_sol']; ?>);" data-bs-toggle="modal" data-bs-target="#mediumModal"><i class="fa-solid fa-eraser me-2"></i>Eliminar</a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="dropdown">
                                        <button class="btn rounded btn-sm btn-<?php if ($r["id_est"] == 1) {
                                                                                                            echo 'secondary';
                                                                                                        } elseif ($r["id_est"] == 2) {
                                                                                                            echo 'warning';
                                                                                                        } elseif ($r["id_est"] == 3) {
                                                                                                            echo 'success';
                                                                                                        } elseif ($r["id_est"] == 4) {
                                                                                                            echo 'danger';
                                                                                                        } else {
                                                                                                            echo 'info';
                                                                                                        } ?>" type="button" id="dropdownMenu" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end " aria-labelledby="dropdownMenu">
                                            <a class="btn btn-link dropdown-item" onclick="mostrarSeg(<?php echo $r['id_sol'] . ',' . $r['id_est']; ?>);" data-bs-toggle="modal" data-bs-target="#mediumModal"><i class="fa-solid fa-share me-2"></i> Seguimiento</a>
                                            <a class="btn btn-link dropdown-item" onclick="mostrarCrm(<?php echo $r['id_sol'] . ',' . $r['id_est']; ?>);" data-bs-toggle="modal" data-bs-target="#largeModal"><i class="fa fa-tasks me-2"></i> Formulario</a>
                                        </div>
                                    </div>
                                <?php } ?>


                  
                
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                $(document).ready(function() {
                $('#tableCredito2').DataTable({
                    "ordering": true,
                    "aaSorting": [],
                    "order": [
                        [0, "desc"]
                    ]
                });
                $('.dataTables_length').addClass('bs-select');
            });
                // serverSideCreditos(2,1)
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
    include 'tabla3.php';
} 

?>

