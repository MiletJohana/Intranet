
<?php 
include "../../conexion.php"; 
$fecha = date('Y-m-d');
$sqlChat=" SELECT comentario, fec_coment, nom_usu, usu_mq
FROM cot_comentarios_onl onl, cot_cotizaciones cot
WHERE cot.id_coti =onl.id_coti
AND onl.id_coti=".$_POST['id_coti'];
$queryChat= $conexion->query($sqlChat);
//echo $sqlChat;
?>
 <?php if ($queryChat->rowCount() > 0) { ?>
<div id="contenedor">
    <div id="caja-chat" >
      <div id="chatA">
        <?php while($r=$queryChat->fetch(PDO::FETCH_ASSOC)){?>
          <?php if ($r['usu_mq']==2){?>
            <div id="datos-chat" class="alert alert-danger" >
          <?php }?>
          <?php if ($r['usu_mq']==1){?>
            <div id="datos-chat" class="alert alert-primary" style="background-color:#D1CECE;" >
          <?php }?>
              <span style="color: #333;"><strong><?php echo $r['nom_usu'];?></strong></span>
              <span align="left" style="color: #5F5B5B;"><?php echo $r['comentario'];?>   <strong><?php echo $r['fec_coment'];?></strong></span>
              
          </div>
        <?php }?>
      </div>
    </div>
<div>
<?php }else{?>
  <p class="alert alert-danger" >¡Aquí puedes enviar un comentario de la cotización y pronto un Asesor o Representante se comunicará contigo!</p>
<?php }?>