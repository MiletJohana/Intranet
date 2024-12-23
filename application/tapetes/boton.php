<?php
include '../../resources/template/credentials.php';
if($_POST['resp']==1){?>
    <button id="agregarMano" type="button" class="btn btn-danger" onclick="crearTapetes('form-mano','tapetes','');">Mano De Obra </button>
    <button id="cerrar1" type="button" class="btn btn-default ml-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<?php } elseif($_POST['resp']==2){?>
    <button id="agregartap" type="button" class="btn btn-danger" onclick="crearTapetes('form-Tsen','tapetes','');">Tapete Sencillo </button>
    <button id="cerrar" type="button" class="btn btn-default ml-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<?php } elseif($_POST['resp']==3){?>
    <button id="agregarCosto" type="button" class="btn btn-danger" onclick="crearTapetes('form-costos','tapetes','');">Costos</button>
    <button id="cerrar" type="button" class="btn btn-default ml-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<?php } elseif($_POST['resp']==4){?>
    <button id="agregarDes" type="button" class="btn btn-danger" onclick="crearTapetes('form-descrip','tapetes','');"> Descripción</button>
    <button id="cerrar4" type="button" class="btn btn-default ml-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<?php }elseif($_POST['resp']==0){ ?>
    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cerrar</button>
<?php } ?>