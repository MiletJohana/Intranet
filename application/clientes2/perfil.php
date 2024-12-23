<?php
include "../../conexion.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sqlCli = "SELECT * FROM mq_clientes AS cli
    LEFT JOIN ciudades AS ciu
    ON cli.id_ciu = ciu.id_ciu
    WHERE cli.id_cli = $id
    GROUP BY cli.id_cli";
    $queryCli = $conexion->query($sqlCli);
    $rCli = $queryCli->fetch(PDO::FETCH_ASSOC);

    $sqlCots = "SELECT cot.*, usu.nom_cns, est.nom_est, con.nom_cont
    FROM cot_cotizaciones AS cot 
    INNER JOIN mq_usu AS usu 
    ON cot.id_usu = usu.id_usu 
    INNER JOIN cot_estados_cot AS est 
    ON cot.est_cot = est.id_est 
    INNER JOIN contactos AS con 
    ON cot.id_cont = con.id_cont
    WHERE cot.id_cli = $id";
    $queryCots = $conexion->query($sqlCots);
    //echo $sqlCots;

    $sqlDil = "SELECT * FROM 
    mq_diligencias AS dl
    INNER JOIN mq_clientes AS cl
    ON dl.id_cli = cl.id_cli 
    INNER JOIN tip_dlg AS tp
    ON dl.id_tip_dlg=tp.id_tip_dlg
    INNER JOIN mq_est_dlg es
    ON dl.est_dlg=es.id_est_dlg
    WHERE dl.id_cli = $id ";
    $queryDil = $conexion->query($sqlDil);
    // echo $sqlDil;

    $sqlCre = "SELECT * FROM 
    credit_sol AS cr
    INNER JOIN mq_clientes AS cl
    ON cr.id_cli=cl.id_cli
   /* INNER JOIN contactos AS cont
    ON cr.id_cont=cont.id_cont*/
    INNER JOIN credit_estadosol AS est
    ON cr.id_est=est.id_est
    WHERE cr.id_cli= $id"; 
    $queryCre =$conexion->query($sqlCre);
   // echo $sqlCre;

    $sqlCon = "SELECT * FROM contactos
    WHERE id_cli = $id";
    $queryCon = $conexion->query($sqlCon);
}

function usu($id, $conexion)
{
    $sqlUsu = "SELECT * FROM mq_usu
    WHERE id_usu = $id
    GROUP BY id_usu";
    $queryUsu = $conexion->query($sqlUsu);
    $rUsu = $queryUsu->fetch(PDO::FETCH_ASSOC);
    return $rUsu['nom_usu'];
}
?>
<div class="container-fluid pt-2">
    <div class="col-12">
        <div class="row">

            <!--Columna izquierda: Información de cliente-->
            <div class="col-md-2" style="border-right: 1px solid #dee2e6!important;">
                <small class="form-text text-muted">Logotipo</small>
                <?php if ($rCli['log_cli'] != '') { ?>
                    <img src="../../documentos/clientes/logos/<?php echo $rCli['log_cli']; ?>" class="img-thumbnail" alt="Logo Cliente">
                <?php } else { ?>
                    <img src="../../resources/img/image-placeholder.png" class="img-thumbnail" alt="Logo Cliente">
                <?php } ?>
                <div class="d-flex my-1">
                    <button type="button" onclick="modalCliente(2, <?php echo $rCli['id_cli']; ?>, 2);" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#largeModal">
                        <i class="fa-solid fa-pencil" style="font-size: initial;"></i>
                    </button>
                </div>
                <small class="form-text text-muted">Razón Social</small>
                <h5><?php echo $rCli['nom_cli']; ?></h5>
                <?php if ($rCli['num_doc'] != '') { ?>
                    <small class="form-text text-muted">NIT/CC</small>
                    <h5><?php echo $rCli['num_doc']; ?></h5>
                <?php } ?>
                <?php if ($rCli['dir_cli'] != '') { ?>
                    <small class="form-text text-muted">Dirección</small>
                    <a href="https://www.google.com/maps/search/<?php echo $rCli['dir_cli'] . " " . $rCli['nom_ciu']; ?>" target="_blank">
                        <h5><?php echo $rCli['dir_cli'] . " " . $rCli['nom_ciu']; ?></h5>
                    </a>
                <?php } ?>
                <small class="form-text text-muted">Teléfono</small>
                <h5><?php echo $rCli['tel_cli']; ?></h5>
                <small class="form-text text-muted">Horario</small>
                <h5><?php echo $rCli['hor_cli1'] . " - " . $rCli['hor_cli2']; ?></h5>

                <?php if ($rCli['web_cli'] != '') { ?>
                    <small class="form-text text-muted">Web</small>
                    <h5><?php echo $rCli['web_cli']; ?></h5>
                <?php } ?>
                <?php if ($rCli['ase_com'] != '') { ?>
                    <small class="form-text text-muted">Asesor Técnico Comercial</small>
                    <h5><?php echo usu($rCli['ase_com'], $conexion); ?></h5>
                <?php } ?>
                <?php if ($rCli['rep_sac'] != '') { ?>
                    <small class="form-text text-muted">Representante SAC</small>
                    <h5><?php echo usu($rCli['rep_sac'], $conexion); ?></h5>
                <?php } ?>
            </div>

            <!--Columna central: Negocios, Transacciones, Cotizaciones, Correspondencia, Diligencias, Créditos-->
            <div class="col-md-8 mb-2">
                <!--Negocios-->
                <div class="d-flex">
                    <h3 class="mb-4">Negocios</h3> 
                    <button type="button" onclick="modalNegocio(1, 0, <?php echo $rCli['id_cli']; ?>, 2)" class="btn btn-danger ms-2 btn-sm" data-bs-toggle="modal" data-bs-target="#largeModal">
                        <i class="fa-solid fa-plus" style="font-size: initial;"></i>
                    </button>
                    <button type="button" id="hide-negocios" onclick="ocultar('negocios', 0)" class="btn btn-warning btn-sm ms-2">
                        <i class="fa-solid fa-eye-slash" id="icon-hide-negocios" style="font-size: initial;"></i>
                    </button>
                </div>
                <div id="negocios">
                    <?php
                    include 'negocios.php';
                    ?>
                </div>

                <hr style="width: 80%;" class="my-4 mx-auto">

                <!--Transacciones-->
                <div id="transacciones-container">
                    <?php
                    $param = 1;
                    include '../crm/transacciones.php';
                    ?>
                </div>

                <hr style="width: 80%;" class="my-4 mx-auto">

                <!--Cotizaciones-->
                <div class="d-flex my-3">
                    <h3>Cotizaciones</h3>
                    <button type="button" onclick="newCotizacion(18, <?php echo $_GET['id']; ?>);" class="btn btn-danger ms-2 btn-sm" data-bs-toggle="modal" data-bs-target="#largeModal">
                        <i class="fa-solid fa-plus" style="font-size: initial;"></i>
                    </button>
                    <button type="button" id="hide-cotizaciones" onclick="ocultar('cotizaciones', 0)" class="btn btn-warning ms-2 btn-sm">
                        <i class="fa-solid fa-eye-slash" id="icon-hide-cotizaciones" style="font-size: initial;"></i>
                    </button>
                </div>
                <div id="cotizaciones">
                    <?php
                    include 'cotizaciones.php';
                    ?>
                </div>

                <hr style="width: 80%;" class="my-4 mx-auto" >

                <!--Correspondencia-->
                <div class="d-flex my-3">
                    <h3>Correspondencia</h3>
                    <button type="button" onclick="crearCorr(<?php echo $rCli['id_cli']; ?>);" class="btn btn-danger ms-2 btn-sm" data-bs-toggle="modal" data-bs-target="#largeModal">
                        <i class="fa-solid fa-plus" style="font-size: initial;"></i>
                    </button>
                    <button type="button" id="hide-correspondencia" onclick="ocultar('correspondencia', 0)" class="btn btn-warning ms-2 btn-sm">
                        <i class="fa-solid fa-eye-slash" id="icon-hide-correspondencia" style="font-size: initial;"></i>
                    </button>
                </div>
                <div id="correspondencia">
                    <?php
                    include 'correspondencia.php';
                    ?>
                </div>

                <hr style="width: 80%;" class="my-4 mx-auto">

                <!--Diligencias-->
                <div class="d-flex my-3">
                    <h3>Diligencias</h3>
                    <button type="button" onclick="newDiligencia(<?php echo $rCli['id_cli']; ?>);" class="btn btn-danger ms-2 btn-sm" data-bs-toggle="modal" data-bs-target="#largeModal">
                        <i class="fa-solid fa-plus" style="font-size: initial;"></i>
                    </button>
                    <button type="button" id="hide-diligencias" onclick="ocultar('diligencias', 0)" class="btn btn-warning ms-2 btn-sm">
                        <i class="fa-solid fa-eye-slash" id="icon-hide-diligencias" style="font-size: initial;"></i>
                    </button>
                </div>
                <div id="diligencias">
                    <?php
                    include 'diligencias.php';
                    ?>
                </div>

                <hr style="width: 80%;" class="my-4 mx-auto">

                <!--Créditos-->
                <div class="d-flex my-3">
                    <h3>Créditos</h3>
                    <button type="button" onclick="newSolici(1,'Solicitud De Crédito', '../creditoV2/tabsForm.php');" class="btn btn-danger ms-2 btn-sm" data-bs-toggle="modal" data-bs-target="#largeModal">
                        <i class="fa-solid fa-plus" style="font-size: initial;"></i>
                    </button>
                    <button type="button" id="hide-creditos" onclick="ocultar('creditos', 0)" class="btn btn-warning ms-2 btn-sm">
                        <i class="fa-solid fa-eye-slash" id="icon-hide-creditos" style="font-size: initial;"></i>
                    </button>
                </div>
                <div id="creditos">
                    <?php
                    include 'creditos.php';
                    ?>
                </div>
            </div>

            <!--Columna derecha: Contactos-->
            <div class="col-md-2" style="border-left: 1px solid #dee2e6!important;">
                <div class="mb-3">
                    <h3>Contactos</h3> 
                    <button type="button" onclick="modalContacto(1, <?php echo $rCli['id_cli']; ?>, 2);" class="btn btn-danger " data-bs-toggle="modal" data-bs-target="#largeModal">
                        <i class="fa-solid fa-plus" style="font-size: initial;"></i>
                    </button>
                    <button type="button" onclick="modalContacto(2, <?php echo $rCli['id_cli']; ?>, 2);" class="btn btn-danger ms-2" data-bs-toggle="modal" data-bs-target="#largeModal">
                        <i class="fa fa-pencil" style="font-size: initial;"></i>
                    </button>
                </div>
                <ul class="list-group list-group-flush">
                    <?php while ($rCon = $queryCon->fetch(PDO::FETCH_ASSOC)) { ?>
                        <?php if ($rCon['cont_desh'] != 'Si') { ?>
                            <a href="mailto:<?php echo $rCon['eml_cont']; ?>" target="_blank" class="list-group-item d-block p-1">
                                <p class="mb-1 <?php if ($rCon['cont_desh'] == 'Si') {
                                                    echo "text-muted";
                                                } ?>"><?php echo $rCon['nom_cont']; ?></p>
                                <small class="form-text text-muted"><?php echo $rCon['eml_cont']; ?></small>
                            </a>
                        <?php } ?>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>