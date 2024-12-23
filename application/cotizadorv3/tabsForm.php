<?php
require '../../resources/template/credentials.php'; ?>
<div class="table-responsive">
    <ul class="nav nav-underline flex-nowrap " id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#Cotizaciones" role="tab" aria-controls="Cotizaciones"  onclick="newAgregar(<?php if ($_POST['resp'] == 6) {
                                                                                                                                                echo '6';
                                                                                                                                            } else if ($_POST['resp'] == 15) {
                                                                                                                                                echo '15';
                                                                                                                                            } else {
                                                                                                                                                echo '1';
                                                                                                                                            } ?>,<?php echo $_POST['id_usu']; ?>,<?php echo $_POST['resp']; ?>);" aria-selected="true">Cotizaciones</a>
        </li>
        <?php if ($_POST['resp'] != 18) { ?>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#Clientes" role="tab" aria-controls="Clientes" onclick="modalCliente(1,0,3);" aria-selected="false">Clientes</a>
            </li>
        <?php } ?>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#Contactos" role="tab" aria-controls="Contactos" onclick="modalContacto(1,0,3);" aria-selected="false">Contactos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#Productos" role="tab" aria-controls="Productos" onclick="newAgregar(<?php if ($_POST['resp'] == 9) {
                                                                                                                                    echo '9';
                                                                                                                                } else {
                                                                                                                                    echo '4';
                                                                                                                                } ?>,<?php echo $_POST['id_usu']; ?>,<?php echo $_POST['resp']; ?>);" aria-selected="false">Productos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#misDatos" role="tab" aria-controls="misDatos" onclick="newAgregar(<?php if ($_POST['resp'] == 10) {
                                                                                                                                echo '10';
                                                                                                                            } else {
                                                                                                                                echo '5';
                                                                                                                            } ?>,<?php echo $_POST['id_usu']; ?>,<?php echo $_POST['resp']; ?>);" aria-selected="false">Mis Datos</a>
        </li>
    </ul>
</div>

<div class="tab-content mt-2" id="myTabContent">
    <div class="tab-pane fade show active" id="Cotizaciones" role="tabpanel" aria-labelledby="Cotizaciones-tab">
        <div id="content-tableCl">
            <?php if ($_POST['resp'] == 15 || $_POST['resp'] == 16) {
                include "../cotizadorv3/form2.php";
            } else {
                include "../cotizadorv3/form.php";
            } ?>
        </div>
    </div>
    <?php if ($_POST['resp'] != 18) { ?>
        <div class="tab-pane fade" id="Clientes" role="tabpanel" aria-labelledby="Clientes-tab">
            <div id="content-tableCl">
                <?php
                $param = 2;
                include "../clientes2/form.php";
                ?>
            </div>
        </div>
    <?php } ?>
    <div class="tab-pane fade" id="Contactos" role="tabpanel" aria-labelledby="Contactos-tab">
        <div id="content-tableCont">
            <?php
            $param = 2;
            include "../contactos/form.php";
            ?>
        </div>
    </div>
    <div class="tab-pane fade" id="Productos" role="tabpanel" aria-labelledby="Productos-tab">
        <div id="content-tableCl">
            <?php include "../cotizadorv3/form5.php"; ?>
        </div>
    </div>
    <div class="tab-pane fade" id="misDatos" role="tabpanel" aria-labelledby="misDatos-tab">
        <div id="content-tableCl">
            <?php include "../cotizadorv3/form6.php"; ?>
        </div>
    </div>
</div>