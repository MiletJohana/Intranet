
<?php 
include '../../conexion.php';
include "../../plantilla/credentials.php";
?>
<div class="row">
    <div class="col-md-12 text-center">
        <h3>Tiempos  De Operación  </h3>
        <hr style="width:70%;">
    </div>
</div>

<div class="row">
    <div class="col-md-3 col-sm-12">
        <button id="tapSen" type="button" class="btn btn-danger" onclick="appearTa(1);">
            Tapete Sencillo
        </button>
    </div>
    <div class="col-md-3 col-sm-12" >
        <button id="tapCom" type="button" class="btn btn-danger" onclick="appearTa(2);" >
            Tapete Complejo
        </button>
    </div>
    <div class="col-md-3 col-sm-12">
        <button id="TapSin" type="button" class="btn btn-danger" onclick="appearTa(3);" >
            Tapete Sin Logo
        </button>
    </div>
    <div class="col-md-3 col-sm-12">
        <button id="TapSin" type="button" class="btn btn-danger" onclick="appearTa(4);" >
            Mano De obra 
        </button>
    </div>

</div>
<br>
<div  id="tipTap">
<?php if(isset($_POST['resp']) && $_POST['resp']==1){
    include 'Tsimples.php';
}else if(isset($_POST['resp']) && $_POST['resp']==2){ 
    include 'Tcomplejos.php';
}else if(isset($_POST['resp']) && $_POST['resp']==3){
    include 'Tsinlogo.php';
}else if(isset($_POST['resp']) && $_POST['resp']==2){
    include 'manoT.php';
}?>
</div>

