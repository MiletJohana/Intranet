<?php 
include '../../conexion.php';
include "../../resources/template/credentials.php";
if(isset($_POST['edit']) && $_POST['edit']!='' && $_POST['resp']==8){
    $sql="SELECT *,cont.tel_cont FROM cot_contactos cont,mq_clie cli 
                    WHERE cont.id_cli=cli.id_cli
                    AND id_cont=".$_POST['edit'];
    $query=$conexion->query($sql);
    $cont = null;
    if($query->rowCount()>0){
        while ($r=$query->fetch(PDO::FETCH_OBJ)){
        $cont=$r;
        break;
        }
    }
}

?>
<div class="row">
    <div class="col-12 text-center">
        <div class="col-12">
            <h3 id="titleCont">
                <?php if(isset($_POST['resp']) && $_POST['resp']==8){
                    echo 'Actualizar Contacto';
                }else{
                    echo 'Nuevo Contacto';
                }
                ?>
            </h3>
            <hr class="mx-auto" style="width:60%;">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-1 mb-3">
        <?php if(!isset($_POST['edit'])){?>
            <button class="btn btn-primary" onclick="buscarCont(1)" id="buscarCont">Editar Existente</button>
        <?php }else{?>
            <button class="btn btn-primary" onclick="buscarCont(2)" id="buscarCont">Nuevo</button>
        <?php }?>
    </div>
    <div class="col-md-5 mb-3">
        <input class="form-control" type="hidden" name="nom_cont3" id="nom_cont3" placeholder="Nombre contacto o Empresa" onkeyup="autoCont();">
    </div>
</div>
<br>
<form role="form" id="form-Contacto">
    <div class="row">
        <div class="col-md-3 mb-3">
            <label for="id_cli2" class="form-label">Nit Cliente</label>
            <input type="text" class="form-control" id="id_cli2" name="id_cli2" placeholder="Nit Cliente" readonly value="<?php if(isset($_POST['edit']) && $_POST['resp']==8){echo $cont->id_cli;}?>">
        </div>
        <div class="col-md-3 mb-3">
            <label for="nom_cli2" class="form-label">Cliente</label>
            <input type="text" class="form-control" id="nom_cli2" name="nom_cli2" onkeyup="auto(2);" placeholder="Escribe el nombre de tu cliente (min 3 letras)" value="<?php if(isset($_POST['edit']) && $_POST['resp']==8){echo $cont->nom_cli;}?>" required>
        </div>
        <div class="col-md-3 mb-3">
            <label for="nom_cont2" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nom_cont2" name="nom_cont2" placeholder="Nombre Contacto" value="<?php if(isset($_POST['edit']) && $_POST['resp']==8){echo $cont->nom_cont;}?>" required>
            <input type="hidden" id="id_cont2" name="id_cont2" value="<?php if(isset($_POST['edit']) && $_POST['resp']==8){echo $cont->id_cont;}?>">
        </div>
        <div class="col-md-3 mb-3">
            <label for="car_cont2" class="form-label">Cargo</label>
            <input type="text" class="form-control" id="car_cont2" name="car_cont2" placeholder="Cargo del contacto" value="<?php if(isset($_POST['edit']) && $_POST['resp']==8){echo $cont->car_cont;}?>">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-3 mb-3">
            <label for="eml_cont2" class="form-label">Correo</label>
            <input type="email" class="form-control" id="eml_cont2" name="eml_cont2" placeholder="Correo del contacto" value="<?php if(isset($_POST['edit']) && $_POST['resp']==8){echo $cont->eml_cont;}?>" required>
        </div>
        <div class="col-md-3 mb-3">
            <label for="tel_cont22" class="form-label">Teléfono</label>
            <input type="number" class="form-control" id="tel_cont22" name="tel_cont22" placeholder="Teléfono del contacto" value="<?php if(isset($_POST['edit']) && $_POST['resp']==8){echo $cont->tel_cont;}?>" required>
        </div>
        <div class="col-md-3 mb-3">
            <label for="tel_cont2" class="form-label">Celular</label>
            <input type="number" class="form-control" id="tel_cont2" name="tel_cont2" placeholder="Celular del contacto" value="<?php if(isset($_POST['edit']) && $_POST['resp']==8){echo $cont->tel_cont2;}?>">
        </div>
    </div>
    <input type="hidden" id="accionCont" name="action" value="<?php echo ($_POST['resp']==8)?"updateCont":"addCont"; ?>">
    <br>
    <div class="col-md-12 mb-3" id="respuestaCont"></div>
    <div class="row mb-3" id="error3"></div>
</form>