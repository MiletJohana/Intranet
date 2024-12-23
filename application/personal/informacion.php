<?php 
include '../../conexion.php';
include '../../resources/template/credentials.php';
$sql1="SELECT ind.id_solC, ind.area_sol, ar.nom_are, ind.carg_sol ,  ind.fecha_sol , ind.id_usu , us.nom_usu,ind.id_estaSol,est.nom_estS, ind.sal_sol, 
ind.cont_sol,ind.fecha_sol, ind.per_sol,ed.num_edad, ind.id_edad,ind.obs_sol, ind.concep_sol, ind.car_sol, ind.obs_rec
FROM ind_solcarg ind,mq_are ar, mq_usu us, ind_estados est ,ind_edad ed
WHERE ind.area_sol=ar.id_are
AND ind.id_estaSol=est.id_estaSol
AND ind.id_usu=us.id_usu
AND ind.id_solC=".$_POST['info'];
$query=$conexion->query($sql1);
//ECHO $sql1;
if($query->rowCount()>0){
  ?>

<div class="row">
    <div class="col-12" >
        <h3 align="center"> Información Solicitud </h3>
        <hr class="mx-auto" style="width:60%;">
    </div>
</div>
<div class="">
    <div class="table-responsive" style="max-height:800px;">
        <table class="table table-bordered " id="datatable" style="font-size:85%;">
            <thead>
                <th> Tipo</th>
                <th> Área solicitada</th>
                <th> Cargo Solicitado</th>
                <th> Fecha Solicitado</th>
                <th> Tipo De Contrato</th>
                <th> Salario</th>
                <th> N° De Personas</th>
                <th style="width: 40px;"> Edad </th>
                <th> Observación</th>
                <th> Nombre Del Creador </th>
                <th> Estado </th>
            </thead>
            <tbody>
            <?php
                $r=$query->fetch(PDO::FETCH_ASSOC);
                $sqlCar="SELECT * FROM ind_cargos WHERE id_carg='".$r['carg_sol']."'";
                $queryCar=$conexion->query($sqlCar);
                $rCar=NULL;
                if($queryCar->rowCount()>0){
                    $rCar=$queryCar->fetch(PDO::FETCH_ASSOC);
                }?>
                    <tr>
                        <td class="table-td-sm center-text">
                            <?php if(strlen($r["carg_sol"])>3){echo 'Nuevo';}else{echo 'Existente';}?></td>
                            <td><?php echo $r["nom_are"];?></td>
                            <td><?php if($rCar!=NULL){echo $rCar['nom_carg'];}else{echo $r["carg_sol"];}?></td>
                            <td><?php echo $r["fecha_sol"];?></td>
                            <td><?php echo$r["cont_sol"];?></td>
                            <td><?php echo $r["sal_sol"];?></td>
                            <td><?php echo $r["per_sol"];?></td>
                            <td><?php echo $r["num_edad"];?></td>
                            <td><?php if($r["obs_sol"]!=''){echo $r["obs_sol"];}elseif($r["concep_sol"]!=''){echo $r["concep_sol"];}else{echo '--';}?></td>
                            <td><?php echo $r["nom_usu"];?></td>
                            <td><?php echo $r["nom_estS"];?></td>
                    </tr>
            </tbody>
        </table>
    </div>
    <?php if($r['id_estaSol']==4){?>
        <div class="alert alert-danger alert-dismissible fade show mt-4 d-flex align-items-center" role="alert">
            <b>Motivo Rechazo: </b>
            <p><?php $r['obs_rec']; ?></p>
        </div>
    <?php }
        $sqlPer="SELECT * FROM ind_select_per sel, ind_estados est 
                WHERE sel.id_estaSol=est.id_estaSol
                AND id_solC=".$_POST['info'];
        $queryPer=$conexion->query($sqlPer);
        if($queryPer->rowCount()>0){?>
        <br>
    <div class="row">
        <div class="col-12" >
            <h3 align="center"> Entrevistados </h3>
            <hr class="mx-auto" style="width:60%;">
        </div>
    </div>
    <div class="table-responsive" style="max-height:800px;">
        <table class="table table-bordered " id="datatable" style="font-size:90%;">
        <br>
        <thead>
        <th> Entrevistado</th>
        <th width="110"> Fecha de Entrevsita </th>
        <th>Obs. Líder</th>
        <?php if($_SESSION['lid']==2 ){?>
        <th>Entrevistado</th>
        <th>Pruebas</th>
        <th>Análisis</th>
        <th>Polígrafo</th>
        <th>Examenes M</th>
        <?php } if($_SESSION['are']==9 || $_SESSION['lid']==1 || $_SESSION['lid']==4){?>
        <th>Obs. TH</th>
        <th>Obs. Gerente</th>
        <?php } ?>
        <th width="130"> Estado </th>
        </thead>
    <tbody>
    <?php
    while($r2=$queryPer->fetch(PDO::FETCH_ASSOC)){?>
            <tr align="center">
                <td><?php echo $r2['nom_per'].'<br>ID: '.  $r2['id_per'].'<br>Cel: '. $r2['cel_per']?></td>
                <td><?php echo $r2['fec_ent']?></td>
                <td style="width: 300px !important;"><?php echo $r2['obs_lid']?></td>
                <?php if($_SESSION['lid']==2 ){?>
                    <td align="center" <?php if($r2['pro_entre']=='Si'){echo'style="background-color:b3d5ff;"';}?>><?php if($r2['pro_entre']=='Si'){ echo '<i class="fa fa-thumbs-up" style="font-size:22px;">';}?></td>
                    <td align="center" <?php if($r2['pro_prue']=='Si'){echo'style="background-color:b3d5ff;"';}?>><?php if($r2['pro_prue']=='Si'){ echo '<i class="fa fa-thumbs-up" style="font-size:22px;">';}?></td>
                    <td align="center" <?php if($r2['pro_ana']=='Si'){echo'style="background-color:b3d5ff;"';}?>><?php if($r2['pro_ana']=='Si'){ echo '<i class="fa fa-thumbs-up" style="font-size:22px;">';}?></td>
                    <td align="center" <?php if($r2['pro_poli']=='Si'){echo'style="background-color:b3d5ff;"';}?>><?php if($r2['pro_poli']=='Si'){ echo '<i class="fa fa-thumbs-up" style="font-size:22px;">';}?></td>
                    <td align="center" <?php if($r2['pro_visi']=='Si'){echo'style="background-color:b3d5ff;"';}?>><?php if($r2['pro_visi']=='Si'){ echo '<i class="fa fa-thumbs-up" style="font-size:22px;">';}?></td>
                <?php } if($_SESSION['are']==9){?>
                    <td style="width: 300px !important;"><?php echo $r2['obs_th']?></td>
                    <td style="width: 300px !important;"><?php echo $r2['obs_ger']?></td>
                <?php } ?>
                <td style="background-color:#<?php echo $r2['back-ground']; ?>"><?php echo $r2['nom_estS'];?></td>
            </tr>
    <?php } ?>
    </tbody>

    <?php }} ?>
</div>

<?php //} ?>