<?php 
include '../../conexion.php';
include '../../resources/template/credentials.php';
$sqlSeg="SELECT * FROM ind_fechas WHERE id_pag=3";
$querySeg=$conexion->query($sqlSeg);
while($row3=$querySeg->fetch(PDO::FETCH_ASSOC)){
    $fech_pag3[]=$row3["fech_pag"];  
}
?>
<div class="row">
    <div class="col-12 text-center">
        <h3>Datos Seguridad Social</h3>
        <hr class="mx-auto" style="width:60%;">
    </div>
</div>
<form role="form" id="form-Segur">
    <div class="row">
        <div class="col-md-3 col-sm-12 mb-3">
            <label for="fech_pags1" class="form-label">Enero</label>
            <input type="date" class="form-control" min="<?php date("Y");?>-01-01" max="<?php echo date("Y");?>-01-31" id="fech_pags1" name="fech_pag3[]" value="<?php echo $fech_pag3[0];if($fech_pag3[0]!=''){echo '"readonly="';}?>" required>
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
          <label for="fech_pags2" class="form-label">Febrero</label>
          <input type="date" class="form-control" id="fech_pags2" min="<?php echo date("Y");?>-02-01" max="<?php echo date("Y");?>-02-<?php if(date("Y")%4==0){echo '29';}else{echo '28';}?>" name="fech_pag3[]" value="<?php echo $fech_pag3[1];if($fech_pag3[1]!=''){echo '"readonly="';}?>" required>
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
          <label for="fech_pags3" class="form-label">Marzo</label>
          <input type="date" class="form-control" id="fech_pags3" min="<?php echo date("Y");?>-03-01"  max="<?php echo date("Y");?>-03-31" name="fech_pag3[]" value="<?php echo $fech_pag3[2];if($fech_pag3[2]!=''){echo '"readonly="';}?>" required>
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
          <label for="fech_pags4" class="form-label">Abril</label>
          <input type="date" class="form-control" id="fech_pags4" min="<?php echo date("Y");?>-04-01" max="<?php echo date("Y");?>-04-30" name="fech_pag3[]" value="<?php echo $fech_pag3[3];if($fech_pag3[3]!=''){echo '"readonly="';}?>" required>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-12 mb-3">
          <label for="fech_pags5" class="form-label">Mayo</label>
          <input type="date" class="form-control" id="fech_pags5" min="<?php echo date("Y");?>-05-01" max="<?php echo date("Y");?>-05-30" name="fech_pag3[]" value="<?php echo $fech_pag3[4];if($fech_pag3[4]!=''){echo '"readonly="';}?>" required>
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
          <label for="fech_pags6" class="form-label">Junio</label>
          <input type="date" class="form-control" id="fech_pags6" min="<?php echo date("Y");?>-06-01" max="<?php echo date("Y");?>-06-30" name="fech_pag3[]" value="<?php echo $fech_pag3[5];if($fech_pag3[5]!=''){echo '"readonly="';}?>" required>
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
          <label for="fech_pags7" class="form-label">Julio</label>
          <input type="date" class="form-control" id="fech_pags7" min="<?php echo date("Y");?>-07-01" max="<?php echo date("Y");?>-07-31"name="fech_pag3[]" value="<?php echo $fech_pag3[6];if($fech_pag3[6]!=''){echo '"readonly="';}?>" required>
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
          <label for="fech_pags8" class="form-label">Agosto</label>
          <input type="date" class="form-control" id="fech_pags8" min="<?php echo date("Y");?>-08-01" max="<?php echo date("Y");?>-08-31" name="fech_pag3[]" value="<?php echo $fech_pag3[7];if($fech_pag3[7]!=''){echo '"readonly="';}?>" required>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-12 mb-3">
          <label for="fech_pags9" class="form-label">Septiembre</label>
          <input type="date" class="form-control" id="fech_pags9" min="<?php echo date("Y");?>-09-01" max="<?php echo date("Y");?>-09-30" name="fech_pag3[]" value="<?php echo $fech_pag3[8];if($fech_pag3[8]!=''){echo '"readonly="';}?>" required>
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
          <label for="fech_pags10" class="form-label">Octubre</label>
          <input type="date" class="form-control" id="fech_pags10" min="<?php echo date("Y");?>-10-01" max="<?php echo date("Y");?>-10-31" name="fech_pag3[]" value="<?php echo $fech_pag3[9];if($fech_pag3[9]!=''){echo '"readonly="';}?>" required>
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
          <label for="fech_pags11" class="form-label">Noviembre</label>
          <input type="date" class="form-control" id="fech_pags11" min="<?php echo date("Y");?>-11-01" max="<?php echo date("Y");?>-11-30" name="fech_pag3[]" value="<?php echo $fech_pag3[10];if($fech_pag3[10]!=''){echo '"readonly="';}?>" required>
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
          <label for="fech_pags12" class="form-label">Diciembre</label>
          <input type="date" class="form-control" id="fech_pags12" min="<?php echo date("Y");?>-12-01" max="<?php echo date("Y");?>-12-31" name="fech_pag3[]" value="<?php echo $fech_pag3[11];if($fech_pag3[11]!=''){echo '"readonly="';}?>" required>
        </div>
    </div>
</form>
    