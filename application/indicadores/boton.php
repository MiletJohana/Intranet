<?php
include '../../resources/template/credentials.php';
if($_POST['resp']==1){?>
    <button id="agregarPer" type="button" class="btn btn-danger" onclick="crear('form-Personal','personal','tabla.php');">Crear Solicitud</button>
    <button id="cerrar1" type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<?php } elseif($_POST['resp']==2){?>
    <button id="editar" type="button" class="btn btn-danger" onclick="modInd();">Actualizar</button>
    <button id="cerrar" type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<?php } elseif($_POST['resp']==3){?>
    <button id="editar" type="button" class="btn btn-danger" onclick="modInd();">Rechazar</button>
    <button id="cerrar" type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<?php } elseif($_POST['resp']==4){?>
    <button id="agregarCar" type="button" class="btn btn-danger" onclick="crear('form-Cargo','personal','tabla.php');">Crear Cargo</button>
    <button id="cerrar4" type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<?php }elseif($_POST['resp']==5){?>
    <button id="agregarCar" type="button" class="btn btn-danger" onclick="crear('form-Select','solicitud','tabla2.php');">Crear Entrevista</button>
    <button id="cerrar5" type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<?php }elseif($_POST['resp']==6){?>
    <button id="editar" type="button" class="btn btn-danger" onclick="modInd();">Actualizar</button>
    <button id="cerrar6" type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<?php }elseif($_POST['resp']==7){?>
    <button id="editar" type="button" class="btn btn-danger" onclick="crear('form-NewPer','solicitud','tabla.php');">Crear</button>
    <button id="cerrar7" type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<?php }elseif($_POST['resp']==8){?>
    <button id="editar" type="button" class="btn btn-danger" onclick="modInd();">Rechazar</button>
    <button id="cerrar7" type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<!--Trabajo de MILET-->

<?php } elseif ($_POST['resp'] == 11) { ?>
    <button id="agregarVar" type="button" class="btn btn-danger" onclick="IndPagos(1,'form-Variab','pagos','table.php');">Actualizar Variable</button>
    <button id="cerrar" type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<?php } elseif ($_POST['resp'] == 12) { ?>
    <button id="agregarNom" type="button" class="btn btn-danger" onclick="IndPagos(2,'form-Nom','pagos','table.php');">Actualizar Nomina</button>
    <button id="cerrar" type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<?php } elseif ($_POST['resp'] == 13) { ?>
    <button id="agregarSeg" type="button" class="btn btn-danger" onclick="IndPagos(3,'form-Segur','pagos','table.php');">Actualizar Seguridad</button>
    <button id="cerrar" type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<?php } elseif ($_POST['resp'] == 14) { ?>
    <button id="agregarPrim" type="button" class="btn btn-danger" onclick="IndPagos(4,'form-Prim','pagos','table.php');">Actualizar Prima</button>
    <button id="cerrar" type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<?php } elseif ($_POST['resp'] == 15) { ?>
    <button id="agregarCesa" type="button" class="btn btn-danger" onclick="IndPagos(5,'form-Cesan','pagos','table.php');">Actualizar Cesantías</button>
    <button id="cerrar" type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<?php } elseif ($_POST['resp'] == 16) { ?>
    <button id="agregarCar" type="button" class="btn btn-danger" onclick="crear('form-liqui','pagos','tabla2.php');">Crear Liquidación</button>
    <button id="cerrar" type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<?php } elseif ($_POST['resp'] == 17) { ?>
    <button id="editar" type="button" class="btn btn-danger" onclick="modInd();">Actualizar Liquidación</button>
    <button id="cerrar" type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<?php } elseif ($_POST['resp'] == 18) { ?>
    <button id="agregarErr" type="button" class="btn btn-danger" onclick="crear('form-error','pagos','tabla3.php');"> Crear</button>
    <button id="cerrar" type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<?php } elseif ($_POST['resp'] == 19) { ?>
    <button id="editar" type="button" class="btn btn-danger" onclick="modInd();">Actualizar</button>
    <button id="cerrar" type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<!--Trabajo de YAN-->

<?php }elseif($_POST['resp']==20){?>
    <button id="agregarAct"type="button" class="btn btn-danger" onclick="crear('form-act','eventos','tabla.php');" <?php //if(date('m') != 01){echo "disabled";}?> >Crear Actividad</button>
    <button id="cerrar" type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<?php }elseif($_POST['resp']==21){?>
    <button id="editar" type="button" class="btn btn-danger" onclick="modInd();" > Editar Actividad </button>
    <button id="cerrar" type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<?php }elseif($_POST['resp']==22){?>
    <button id="agregarCap"type="button" class="btn btn-danger" onclick="crear('form-cap', 'eventos', 'tabla2.php');">Crear Capacitacion</button>
    <button id="cerrar" type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<?php }elseif($_POST['resp']==23){?>
    <button id="editar"type="button" class="btn btn-danger" onclick="modInd();">Editar Capacitacion</button>
    <button id="cerrar" type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<?php }elseif($_POST['resp']==24){?>
    <button id="agregarDes" type="button" class="btn btn-danger" disabled onclick="crearDesc(1, 'descuentos', '<?php if($_GET['table'] != 3 || $sesion_reg != 1){echo 'tabla.php';} else {echo 'tabla3.php';}?>');">Crear Descuento</button>
    <button id="cerrar" type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<?php }elseif($_POST['resp']==25){?>
    <button id="editar"type="button" class="btn btn-danger" onclick="crearDesc(2, 'descuentos', '<?php if($_GET['des'] != 3){echo 'tabla.php';} else {echo 'tabla3.php';}?>');" <?php if ($sesion_id == 1020777431) { echo 'disabled';}?> >Editar Descuento</button>
    <button id="cerrar" type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<?php }elseif($_POST['resp']==26){?>
    <button id="crearClim" type="button" class="btn btn-danger" onclick="crear('form-clim', 'indicadores', 'tabla2.php');">Crear Clima</button>
    <button id="cerrar" type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<!--Trabajo de Milet-->

<?php }elseif($_POST['resp']==30){?>
    <button id="per"type="button" class="btn btn-danger" onclick="aceptProcess();">Agregar</button>
    <button id="cerrar" type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<?php } elseif ($_POST['resp'] == 31) { ?>
    <button id="agregarErr" type="button" class="btn btn-danger" onclick="crear('form-NewPer','solicitud','tabla3.php');"> Crear</button>
    <button id="cerrar" type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<?php } elseif ($_POST['resp'] == 32) { ?>
    <button id="agregarErr" type="button" class="btn btn-danger" onclick="crear2('form-cert','certificados','tabla.php');"> Crear</button>
    <button id="cerrar" type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<?php } elseif ($_POST['resp'] == 33) { ?>
    <button id="agregarErr" type="button" class="btn btn-danger" onclick="crear2('form-cert','certificados','tabla2.php');"> Crear</button>
    <button id="cerrar" type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<?php } elseif ($_POST['resp'] == 34) { ?>
    <button id="agregarErr" type="button" class="btn btn-danger" onclick="crear('form-actUs','certificados','tabla2.php');">Actualizar</button>
    <button id="cerrar" type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<?php }elseif($_POST['resp']==0){ ?>
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
<?php } ?>