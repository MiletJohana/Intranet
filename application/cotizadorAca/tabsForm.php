<?php require '../../resources/template/credentials.php'; ?>
<div class="table-responsive">
    <ul class="nav nav-underline flex-nowrap" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#CotizacionesAca" role="tab" aria-controls="CotizacionesAca" onclick="newAgregarAca(<?php if ($_POST['resp'] == 6) {
                                                                                                                                                echo '6';
                                                                                                                                            } else {
                                                                                                                                                echo '1';
                                                                                                                                            } ?>,<?php $_POST['id_usu'] ?>,<?php $_POST['resp'] ?>);" aria-selected="true">Cotizaciones</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#ClientesAca" role="tab" aria-controls="ClientesAca" onclick="newAgregarAca(<?php if ($_POST['resp'] == 7) {
                                                                                                                                echo '7';
                                                                                                                            } else {
                                                                                                                                echo '2';
                                                                                                                            } ?>,<?php $_POST['id_usu'] ?>,<?php $_POST['resp'] ?>);" aria-selected="false">Clientes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#ContactosAca" role="tab" aria-controls="ContactosAca" onclick="newAgregarAca(<?php if ($_POST['resp'] == 8) {
                                                                                                                                    echo '8';
                                                                                                                                } else {
                                                                                                                                    echo '3';
                                                                                                                                } ?>,<?php $_POST['id_usu'] ?>,<?php $_POST['resp'] ?>);" aria-selected="false">Contactos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#ProductosAca" role="tab" aria-controls="ProductosAca" onclick="newAgregarAca(<?php if ($_POST['resp'] == 9) {
                                                                                                                                    echo '9';
                                                                                                                                } else {
                                                                                                                                    echo '4';
                                                                                                                                } ?>,<?php $_POST['id_usu'] ?>,<?php $_POST['resp'] ?>);" aria-selected="false">Productos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#misDatosAca" role="tab" aria-controls="misDatosAca" onclick="newAgregarAca(<?php if ($_POST['resp'] == 10) {
                                                                                                                                echo '10';
                                                                                                                            } else {
                                                                                                                                echo '5';
                                                                                                                            } ?>,<?php $_POST['id_usu'] ?>,<?php $_POST['resp'] ?>);" aria-selected="false">Mis Datos</a>
        </li>
    </ul>
</div>

<div class="tab-content mt-2" id="myTabContent">
    <div class="tab-pane fade show active" id="CotizacionesAca" role="tabpanel" aria-labelledby="CotizacionesAca-tab">
        <div id="content-tableCl">
            <?php include "../cotizadorAca/formulario.php"; ?>
        </div>
    </div>
    <div class="tab-pane fade" id="ClientesAca" role="tabpanel" aria-labelledby="ClientesAca-tab">
        <div id="content-tableCl">
            <?php include "../cotizadorAca/formulario2.php"; ?>
        </div>
    </div>
    <div class="tab-pane fade" id="ContactosAca" role="tabpanel" aria-labelledby="ContactosAca-tab">
        <div id="content-tableCl">
            <?php include "../cotizadorAca/formulario3.php"; ?>
        </div>
    </div>
    <div class="tab-pane fade" id="ProductosAca" role="tabpanel" aria-labelledby="ProductosAca-tab">
        <div id="content-tableCl">
            <?php include "../cotizadorAca/formulario4.php"; ?>
        </div>
    </div>
    <div class="tab-pane fade" id="misDatosAca" role="tabpanel" aria-labelledby="misDatosAca-tab">
        <div id="content-tableCl">
            <?php include "../cotizadorAca/formulario5.php"; ?>
        </div>
    </div>
</div>