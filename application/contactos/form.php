<?php
include "../../conexion.php";
if ($_POST['resp'] == 2) {
    //Editar
    $contactos = array();

    $sqlCon = "SELECT con.*, cli.nom_cli FROM contactos AS con
    INNER JOIN mq_clientes AS cli
    ON con.id_cli = cli.id_cli
    WHERE cli.id_cli = " . $_POST['id_cli'];
    $query2 = $conexion->query($sqlCon);
    while ($r2 = $query2->fetch(PDO::FETCH_ASSOC)) {
        array_push($contactos, $r2);
    }
}

?>

<form role="form" id="form-contacto">
    <div id="contacto-container">
        <?php if ($_POST['resp'] == 2 || $_POST['id_cli'] == 0) { ?>
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="col-md-12">
                        <h3><i class="fa-solid fa-users-between-lines"></i></h3>
                        <h3 id="titulo1">Cliente relacionado</h3>
                        <hr class="mx-auto" style="width:60%;">
                        <p id="info"></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div id="alert-editar" style="display: none" class="alert alert-info" role="alert">
                        <div class="d-flex">
                            <p class="mb-0">Debes buscar el <strong>Contacto</strong> y aparecerán todos sus datos</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-9 col-sm-12">
                    <label for="nom_cli2" id="label-nom_cli" class="form-label">Cliente</label>
                    <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                            <input type="text" class="form-control " id="nom_cli2" name="nom_cli" onkeyup="buscarClienteCont()" value="<?php if ($_POST['resp'] == 2) {
                                                                                                                                        echo utf8_encode($contactos[0]['nom_cli']);
                                                                                                                                    } else {
                                                                                                                                        echo '';
                                                                                                                                    } ?>" <?php if ($_POST['resp'] == 2) {
                                                                                                                                                echo "disabled";
                                                                                                                                            } ?> required>
                    </div>
                </div>
                <?php if ($param == 2 || $_POST['param'] == 2) { ?>
                        <div class="col-md-3 col-sm-12 mt-4">
                            <button class="btn btn-danger" type="button" name="editar_cont" id="editar_cont" value="0" onclick="editarCont(this.value)">Editar Contacto</button>
                        </div>
            
                <?php }?>
            </div>
        <?php } ?>
        <input type="hidden" id="id_cli2" name="id_cli" value="<?php if(isset($_POST['id_cli'])){ echo $_POST['id_cli']; } ?>">
       
        <div id="contact-form">
            <div class="row mb-3">
                <div class="col-md-12 text-center">
                    <div class="col-md-12">
                        <h3><i class="fa-solid fa-address-book"></i></h3>
                        <h3 id="titleClie">Datos Contacto</h3>
                        <hr class="mx-auto" style="width:60%;">
                    </div>
                </div>
            </div>
            <div class="row my-2">
                <div class="col-12">
                    <div class="alert alert-dismissible fade show" role="alert" id="alert-contacto" style="display: none;">
                        <span id="alert-texto-contacto"></span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
            <?php if ($_POST['resp'] == 2) {
                $i = 0;
                foreach ($contactos as $contacto) { ?>
                    <div class="row mt-4">
                        <input type="hidden" id="id_cont<?php echo $i; ?>" name="id_cont<?php echo $i; ?>" value="<?php echo $contacto['id_cont']; ?>">
                        <div class="col-md-3 col-sm-12">
                            <label for="nom_cont <?php echo $i; ?>" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nom_cont<?php echo $i; ?>" name="nom_cont<?php echo $i; ?>" placeholder="Nombre Contacto" value="<?php echo utf8_encode($contacto['nom_cont']); ?>" <?php if ($contacto['cont_desh'] == 'Si') {
                                                                                                                                                                                                                                echo "readonly";
                                                                                                                                                                                                                            } ?>>
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <label for="eml_cont <?php echo $i; ?>" class="form-label">Email</label>
                            <input type="email" class="form-control" id="eml_cont<?php echo $i; ?>" name="eml_cont<?php echo $i; ?>" placeholder="Correo del contacto" value="<?php echo utf8_encode($contacto['eml_cont']); ?>" <?php if ($contacto['cont_desh'] == 'Si') {
                                                                                                                                                                                                                                        echo "readonly";
                                                                                                                                                                                                                                    } ?>>
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <label for="car_cont <?php echo $i; ?>" class="form-label">Cargo</label>
                            <input type="text" class="form-control" id="car_cont<?php echo $i; ?>" name="car_cont<?php echo $i; ?>" placeholder="Cargo del contacto" value="<?php echo utf8_encode($contacto['car_cont']); ?>" <?php if ($contacto['cont_desh'] == 'Si') {
                                                                                                                                                                                                                                    echo "readonly";
                                                                                                                                                                                                                                } ?>>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <label for="tel_cont <?php echo $i; ?>" class="form-label">Teléfono o celular</label>
                            <input type="number" class="form-control" id="tel_cont<?php echo $i; ?>" name="tel_cont<?php echo $i; ?>" placeholder="Teléfono del contacto" value="<?php echo utf8_encode($contacto['tel_cont']); ?>" <?php if ($contacto['cont_desh'] == 'Si') {
                                                                                                                                                                                                                                        echo "readonly";
                                                                                                                                                                                                                                    } ?>>
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <label for="cont_desh<?php echo $i; ?>" class="form-label">Deshabilitar</label>
                            <label class="btn btn-default">
                                <input type="checkbox" name="cont_desh<?php echo $i; ?>" id="cont_desh<?php echo $i; ?>" value="<?php if ($contacto['cont_desh'] == 'Si') {
                                                                                                                                    echo 1;
                                                                                                                                } else {
                                                                                                                                    echo 0;
                                                                                                                                } ?>" onchange="habilitarDatos(this.value, <?php echo $i; ?>, 1); if (this.value == 1) { this.value = 0; } else { this.value = 1; }" <?php if ($contacto['cont_desh'] == 'Si') {
                                                                                                                                                                                                                                                                            echo "checked";
                                                                                                                                                                                                                                                                        } ?>>
                            </label>
                        </div>
                    </div>
                <?php $i++;
                }
            } else { ?>
                <input type="hidden" id="id_cont1" name="id_cont" value="">
                <div class="row">
                    <div class="col-md-3 col-sm-12">
                        <label for="nom_cont" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nom_cont" name="nom_cont" placeholder="Nombre Contacto" required>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <label for="eml_cont" class="form-label">Email</label>
                        <input type="email" class="form-control" id="eml_cont" name="eml_cont" placeholder="Correo del contacto" required>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <label for="car_cont" class="form-label">Cargo</label>
                        <input type="text" class="form-control" id="car_conta" name="car_cont" placeholder="Cargo del contacto">
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <label for="tel_cont" class="form-label">Teléfono o celular</label>
                        <input type="number" class="form-control" id="tel_cont" name="tel_cont" placeholder="Teléfono del contacto" required>
                    </div>
                </div>
                <div class="row" id="desh" style="display: none;">
                    <div class="col-md-2 col-sm-12">
                        <label for="cont_desh" class="form-label">Deshabilitar</label>
                        <label class="btn btn-default">
                            <input type="checkbox" name="cont_desh" id="cont_desh" value="" onchange="habilitarDatos(this.value, 0, 2); if (this.value == 1) { this.value = 0; } else { this.value = 1; }">
                        </label>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <input type="hidden" id="actionCont" name="actionCont" value="<?php if ($_POST['resp'] == 1) {
                                                                        echo "addContacto";
                                                                    } else {
                                                                        echo "updateContacto";
                                                                    } ?>">
</form>