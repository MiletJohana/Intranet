
<?php 
 include '../../conexion.php';
 include '../../resources/template/credentials.php';
$sqlVar="SELECT * FROM ind_fechas WHERE id_pag=1";
$queryVar=$conexion->query($sqlVar);
while($row2=$queryVar->fetch(PDO::FETCH_ASSOC)){
    $fech_pag2[]=$row2["fech_pag"];  
}
?>
<div class="row">
    <div class="col-12 text-center">
        <h3>Datos Variable</h3>
        <hr class="mx-auto" style="width:60%;">
    </div>
</div>
<form role="form" id="form-Variab">
    <div class="row">
        <div class="col-md-3 col-sm-12 mb-3" >
            <label for="fech_pagv1" class="form-label">Enero</label>
            <input type="date" class="form-control"  min="<?php echo date("Y");?>-01-01" max="<?php echo date("Y");?>-01-31" id="fech_pagv1" name="fech_pag1[]" value="<?php echo $fech_pag2[0];?>" required
            <?php $i=1; if(date('m')>$i){echo 'readonly';}?>>
          </div>
        <div class="col-md-3 col-sm-12 mb-3">
          <label for="fech_pagv2" class="form-label">Febrero</label>
          <input type="date" class="form-control" id="fech_pagv2" min="<?php echo date("Y");?>-02-01" max="<?php echo date("Y");?>-02-<?php if(date("Y")%4==0){echo '29';}else{echo '28';}?>" name="fech_pag1[]" value="<?php echo $fech_pag2[1];?>" required
          <?php $i=2; if(date('m')>$i){echo 'readonly';}?>>
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
          <label for="fech_pagv3" class="form-label">Marzo</label>
          <input type="date" class="form-control" id="fech_pagv3" min="<?php echo  date("Y");?>-03-01"  max="<?php echo date("Y");?>-03-31" name="fech_pag1[]" value="<?php echo $fech_pag2[2];?>" required
          <?php $i=3; if(date('m')>$i){echo 'readonly';}?>>
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
          <label for="fech_pagv4" class="form-label">Abril</label>
          <input type="date" class="form-control" id="fech_pagv4" min="<?php echo date("Y");?>-04-01" max="<?php echo date("Y");?>-04-30" name="fech_pag1[]" value="<?php echo $fech_pag2[3];?>" required
          <?php $i=4; if(date('m')>$i){echo 'readonly';}?>>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-12 mb-3">
          <label for="fech_pagv5" class="form-label">Mayo</label>
          <input type="date" class="form-control" id="fech_pagv5" min="<?php echo date("Y");?>-05-01" max="<?php echo date("Y");?>-05-30" name="fech_pag1[]" value="<?php echo $fech_pag2[4];?>" required
          <?php $i=5; if(date('m')>$i){echo 'readonly';}?>>
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
          <label for="fech_pagv6" class="form-label">Junio</label>
          <input type="date" class="form-control" id="fech_pagv6" min="<?php echo date("Y");?>-06-01" max="<?php echo date("Y");?>-06-30" name="fech_pag1[]" value="<?php echo $fech_pag2[5];?>" required
          <?php $i=6; if(date('m')>$i){echo 'readonly';}?>>
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
          <label for="fech_pagv7" class="form-label">Julio</label>
          <input type="date" class="form-control" id="fech_pagv7" min="<?php echo date("Y");?>-07-01" max="<?php echo date("Y");?>-07-31"name="fech_pag1[]" value="<?php echo $fech_pag2[6];?>" required
          <?php $i=7; if(date('m')>$i){echo 'readonly';}?>>
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
          <label for="fech_pagv8" class="form-label">Agosto</label>
          <input type="date" class="form-control" id="fech_pagv8" min="<?php echo date("Y");?>-08-01" max="<?php echo date("Y");?>-08-31" name="fech_pag1[]" value="<?php echo $fech_pag2[7];?>" required
          <?php $i=8; if(date('m')>$i){echo 'readonly';}?>>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-12 mb-3">
          <label for="fech_pagv9" class="form-label">Septiembre</label>
          <input type="date" class="form-control" id="fech_pagv9" min="<?php echo date("Y");?>-09-01" max="<?php echo date("Y");?>-09-30" name="fech_pag1[]" value="<?php echo $fech_pag2[8];?>" required
          <?php $i=9; if(date('m')>$i){echo 'readonly';}?>>
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
          <label for="fech_pagv10" class="form-label">Octubre</label>
          <input type="date" class="form-control" id="fech_pagv10" min="<?php echo date("Y");?>-10-01" max="<?php echo date("Y");?>-10-31" name="fech_pag1[]" value="<?php echo $fech_pag2[9];?>" required
          <?php $i=10; if(date('m')>$i){echo 'readonly';}?>>
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
          <label for="fech_pagv11" class="form-label">Noviembre</label>
          <input type="date" class="form-control" id="fech_pagv11" min="<?php echo date("Y");?>-11-01" max="<?php echo date("Y");?>-11-30" name="fech_pag1[]" value="<?php echo $fech_pag2[10];?>" required
          <?php $i=11; if(date('m')>$i){echo 'readonly';}?>>
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
          <label for="fech_pagv12" class="form-label">Diciembre</label>
          <input type="date" class="form-control" id="fech_pagv12" min="<?php echo date("Y");?>-12-01" max="<?php echo date("Y");?>-12-31" name="fech_pag1[]" value="<?php echo $fech_pag2[11];?>" required
          <?php $i=12; if(date('m')>$i){echo 'readonly';}?>>
        </div>
    </div>
</form>