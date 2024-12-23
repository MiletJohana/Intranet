<?php 
include "../conexion.php";
$sql="SELECT mq_vis.id_vis,mq_pers.id_per,mq_pers.nom_per,mq_pers.emp_per,mq_vis.fec_vis,mq_vis.fec_sal,mq_are.nom_are,mq_vis.fot_vis
       FROM mq_pers,mq_vis,mq_are
       WHERE mq_pers.id_per=mq_vis.id_per
       AND mq_vis.id_are=mq_are.id_are
       AND mq_vis.id_vis=\"$_POST[id_vis]\"";
$query=$conexion->query($sql);
if($query!=null){
$r=$query->fetch(PDO::FETCH_ASSOC);
date_default_timezone_set("America/Bogota");
$hor_actual=date("H:i");
?>
<form role="form" id="form-Visita">
  <div class="row">
      <div class="col-12" style="font-size: 25px;">
            <label class="col-12" for="id_vis" align="center">Visita # <?php echo $r['id_vis']; ?></label>
            <input type="hidden" name="id_vis" value="<?php echo $_POST["id_vis"]; ?>">
           <hr class="mx-auto" style="width:60%;">
      </div>
  </div>
  <div class="row" style="font-size: 15px;">
      <div class="col-12">
            <label class="col-6" for="id_per" align="right">Cédula:</label>
            <p><?php echo $r['id_per'];?></p>
      </div>
      <div class="col-12">
            <label class="col-6" for="nom_per" align="right">Nombre:</label>
            <p><?php echo $r['nom_per'];?></p>
      </div>
      <div class="col-12">
            <label class="col-6" for="emp_per" align="right">Empresa:</label>
            <p><?php echo $r['emp_per'];?></p>
      </div>
      <div class="col-12">
            <label class="col-6" for="nom_are" align="right">Área a la que se dirigió :</label>
            <p><?php echo $r['nom_are'];?></p>
      </div>
      <div class="col-12">
            <label class="col-6" for="hor_cli" align="right">Imágen:</label>
            <p><img width="80" src='<?php echo $r['fot_vis'];?>'></p>
      </div>
      <div class="col-12">
            <label class="col-6" for="fec_vis" align="right">Fecha de Ingreso:</label>
            <p><?php echo $r['fec_vis'];?></p>
      </div>
      <div class="col-12">
            <label class="col-6" for="dir_cli" align="right">Hora salida:</label>
            <p class="col-3">
                <input class="form-control" type="time" name="fec_sal" value="<?php echo $hor_actual; ?>"> 
            </p>
      </div>
      <input type="button" name="action" id="form-accion" value="update">
  </div>
</form>
<?php }else {
            printf("Errormessage: %s\n", $conexion->error);
      } ?>