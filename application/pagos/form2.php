<?php 
 include '../../conexion.php';
 include '../../resources/template/credentials.php';
$sqlnom="SELECT * FROM ind_fechas WHERE id_pag=2";
$querynom=$conexion->query($sqlnom);
while($row=$querynom->fetch(PDO::FETCH_ASSOC)){
    $fech_pag[]=$row["fech_pag"];  
}
?>
<div class="row">
    <div class="col-12 text-center">
        <h3>Datos Nomina</h3>
        <hr class="mx-auto" style="width:60%;">
    </div>
</div>
<form role="form" id="form-Nom">
    <div class="row">
        <div class="col-md-3 col-sm-12 mb-3">
            <label for="fech_pagn1" class="form-label">Enero</label>
            <input type="date" class="form-control" min="<?php echo date("Y");?>-01-01" max="<?php echo date("Y");?>-01-31" id="fech_pagn1" name="fech_pag2[]" value="<?php echo $fech_pag[0];if($fech_pag[0]!=''){echo '"readonly="';}?>" required>
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
          <label for="fech_pagn2" class="form-label">Febrero</label>
          <input type="date" class="form-control" id="fech_pagn2" min="<?php echo date("Y");?>-02-01" max="<?php echo date("Y");?>-02-<?php if(date("Y")%4==0){echo '29';}else{echo '28';}?>" name="fech_pag2[]" value="<?php echo $fech_pag[1];if($fech_pag[1]!=''){echo '"readonly="';}?>" required>
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
          <label for="fech_pagn3" class="form-label">Marzo</label>
          <input type="date" class="form-control" id="fech_pagn3" min="<?php echo date("Y");?>-03-01"  max="<?php echo date("Y");?>-03-31" name="fech_pag2[]" value="<?php echo $fech_pag[2];if($fech_pag[2]!=''){echo '"readonly="';}?>" required>
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
          <label for="fech_pagn4" class="form-label">Abril</label>
          <input type="date" class="form-control" id="fech_pagn4" min="<?php echo date("Y");?>-04-01" max="<?php echo date("Y");?>-04-30" name="fech_pag2[]" value="<?php echo $fech_pag[3];if($fech_pag[3]!=''){echo '"readonly="';}?>" required>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-12 mb-3">
          <label for="fech_pagn5" class="form-label">Mayo</label>
          <input type="date" class="form-control" id="fech_pagn5" min="<?php echo date("Y");?>-05-01" max="<?php echo date("Y");?>-05-30" name="fech_pag2[]" value="<?php echo $fech_pag[4];if($fech_pag[4]!=''){echo '"readonly="';}?>" required>
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
          <label for="fech_pagn6" class="form-label">Junio</label>
          <input type="date" class="form-control" id="fech_pagn6" min="<?php echo date("Y");?>-06-01" max="<?php echo date("Y");?>-06-30" name="fech_pag2[]" value="<?php echo $fech_pag[5];if($fech_pag[5]!=''){echo '"readonly="';}?>" required>
        </div>
        <div class="col-md-3 col-sm-12  mb-3">
          <label for="fech_pagn7" class="form-label">Julio</label>
          <input type="date" class="form-control" id="fech_pagn7" min="<?php echo date("Y");?>-07-01" max="<?php echo date("Y");?>-07-31"name="fech_pag2[]" value="<?php echo $fech_pag[6];if($fech_pag[6]!=''){echo '"readonly="';}?>" required>
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
          <label for="fech_pagn8" class="form-label">Agosto</label>
          <input type="date" class="form-control" id="fech_pagn8" min="<?php echo date("Y");?>-08-01" max="<?php echo date("Y");?>-08-31" name="fech_pag2[]" value="<?php echo $fech_pag[7];if($fech_pag[7]!=''){echo '"readonly="';}?>" required>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-12 mb-3">
          <label for="fech_pagn9" class="form-label">Septiembre</label>
          <input type="date" class="form-control" id="fech_pagn9" min="<?php echo date("Y");?>-09-01" max="<?php echo date("Y");?>-09-30" name="fech_pag2[]" value="<?php echo $fech_pag[8];if($fech_pag[8]!=''){echo '"readonly="';}?>" required>
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
          <label for="fech_pagn10" class="form-label">Octubre</label>
          <input type="date" class="form-control" id="fech_pagn10" min="<?php echo date("Y");?>-10-01" max="<?php echo date("Y");?>-10-31" name="fech_pag2[]" value="<?php echo $fech_pag[9];if($fech_pag[9]!=''){echo '"readonly="';}?>" required>
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
          <label for="fech_pagn11"class="form-label">Noviembre</label>
          <input type="date" class="form-control" id="fech_pagn11" min="<?php echo date("Y");?>-11-01" max="<?php echo date("Y");?>-11-30" name="fech_pag2[]" value="<?php echo $fech_pag[10];if($fech_pag[10]!=''){echo '"readonly="';}?>" required>
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
          <label for="fech_pagn12" class="form-label">Diciembre</label>
          <input type="date" class="form-control" id="fech_pagn12" min="<?php echo date("Y");?>-12-01" max="<?php echo date("Y");?>-12-31" name="fech_pag2[]" value="<?php echo $fech_pag[11];if($fech_pag[11]!=''){echo '"readonly="';}?>" required>
        </div>
    </div>
   
</form>
    