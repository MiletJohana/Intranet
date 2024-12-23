<?php

include '../../conexion.php';

include '../../resources/template/credentials.php';

date_default_timezone_set("America/Bogota");

    $sqlArea="SELECT * FROM mq_are WHERE id_are != 10;";

    $queryArea= $conexion ->query($sqlArea);

   $rowInfoArea = $queryArea->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="row mb-3">

    <div class="col-12 text-center">

        <h3><i class="fa-solid fa-clipboard-list"></i></h3>

        <?php if(isset($_POST['resp']) && $_POST['resp'] == 2){ ?>

            <h3>Editar Área</h3>

        <?php } else { ?>

            <h3>Asignar Productos Por Areas</h3>

        <?php } ?>

    </div>

</div>

<form role="form" id="form-area-x-prod" enctype="multipart/form-data">

    <div class="row">

        <div class="col-12 mb-3">

            <label for="Prueba" class="form-label">Seleccione el area <span name="req" class="text-mq" >*</span></label>

            <select class="form-select" name="area" id="area" onchange="asignar_area(1);">

                <option selected>Seleccionar el area</option>


                <?php

                
                foreach ($rowInfoArea as $area) {?> 

                    <option value="<?php echo $area["id_are"]; ?>"><?php echo $area["nom_are"]; ?></option>
                    
                <?php }

                

                ?>

            </select>

 </div>

 </div>

 <div class="row">  

<div class="col-md-12 col-sm-12 mb-3 none" id="buscador">
    <div class="alert alert-warning" role="alert"><a href="#" class="alert-link">Si el producto no aparece</a>, ya esta relacionado al área
</div>
        <label for="nom_prod" class="form-label" >Escriba el nombre del producto a asignar</label>

        <div class="input-group">

			<span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>

            <input type="text" class="form-control" id="nom_prod" name="nom_prod" required onkeyup="auto(1);">                                                                                                    

            <input type="hidden" id="id_prod" name="id_prod" value="" required>              

            

        </div>

    </div>

    <input type="hidden" id="accion_form" name="action" value="<?php if ($_POST['resp'] == 10) {

                                                                echo "adm_prod_x_area";

                                                            }?>">

 <div class="col-12 none" style="text-align:center;" id="table_prod">

            <div class="table-responsive">

                <table class="table table-hover table-bordered" style="width:100%" id="table_asig_prod">

                    <thead class="table-dark">

                        <tr>

                            <th class="none">ID</th>

                            <th>Producto</th>

                            <th>Cantidad Max</th>

                            <th></th>

                        </tr>

                    </thead>

                </table>

            </div>

        </div>

</form>

