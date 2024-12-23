<?php
include '../../conexion.php';
include "../../resources/template/credentials.php";
if (isset($_POST['edit']) && $_POST['edit'] != '' && ($_POST['resp'] == 6 || $_POST['resp'] == 11)) {
$sqlaa="SELECT * FROM cot_tap_tip_tapete ";
$queryaa=$conexion->query($sqlaa);

}else{
//Selct de tablas 
$sqla="SELECT * FROM cot_tap_tip_tapete";
$querya=$conexion->query($sqla);
$sqlb="SELECT * FROM cot_tap_tip_perfil";
$queryb=$conexion->query($sqlb);
$sqld="SELECT * FROM cot_tap_tip_mano";
$queryd=$conexion->query($sqld);
$sqle="SELECT * FROM cot_tap_tip_logo";
$querye=$conexion->query($sqle);
}
//Lecturas  de costo por unidad
$sqlc="SELECT * FROM cot_tap_costos";
$queryc=$conexion->query($sqlc);
$rC=$queryc->fetch(PDO::FETCH_ASSOC);
//Lecturas  de costo por unidad
$sqlm="SELECT * FROM cot_tap_man_x_tap ";
$querym=$conexion->query($sqlm);
$rM=$querym->fetch(PDO::FETCH_ASSOC);

$tn3lcost= $rC['nomtre_m'];
$quit3l= str_replace( ".", "", $tn3lcost);
$tn1lcost= $rC['nomil_m'];
$quit1l = str_replace( ".", "", $tn1lcost);



?>
<div class="row">
    <div class="col-md-12 text-center">
        <h3>Cotizador Tapete</h3>

    </div>
</div>
<br>

<div class="row" style="color: #02587f;background-color: #cdeefd;border-color: #b8e7fc">
    <div class="col-md-3 col-sm-12 pt-3">
        <label for="des_perf" class="form-label">Desperdicio perfil (5%)</label>
        <input type="text" id="des_perf" name="des_perf" class="form-control" placeholder="5%" required readonly value="0,05">
    </div>
    <div class="col-md-3 col-sm-12 pt-3">
        <label for="des_base" class="form-label">Desperdicio T.Base (2%)</label>
        <input type="text" id="des_base" name="des_base" class="form-control" placeholder="2%" required readonly value="0,02">
    </div>
    <div class="col-md-3 col-sm-12 pt-3">
        <label for="desp_log" class="form-label">Desperdicio Logo (5%)</label>
        <input type="text" id="desp_log" name="desp_log" class="form-control" placeholder="5%" required readonly value="0,05">
    </div>
    <div class="col-md-3 col-sm-12 pt-3">
        <label for="por_prom" class="form-label">Logo Porcentaje %</label>
        <input type="text" id="por_prom" name="por_prom" class="form-control" placeholder="0,35%" required readonly value="0,35">
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-3 col-sm-12 pt-3">
        <label class="form-label"><strong>Dimensiones Base</strong></label><hr style="width:0%;" >
    </div>
    <div class="col-md-3 col-sm-12 pt-3">
        <input type="Text" id="base_anc" name="base_anc" class="form-control" placeholder="Base (Ancho)" onkeyup="calculator()"  value="">
    </div>
    <div class="col-md-3 col-sm-12 pt-3">
        <input type="Text" id="base_alt" name="base_alt" class="form-control" placeholder="Base Alto (Paso)"  onkeyup="calculator()"  value="">
    </div>
    <div class="col-md-3 col-sm-12 pt-3">
        <input type="Text" id="anch_est" name="anch_est" class="form-control" placeholder="Base(Ancho Estandar)" onkeyup="calculator()"  value="">
    </div>
</div><br>
<div class="row">
    <div class="col-md-3 col-sm-12 pt-3">
        <label class="form-label"><strong>Dimensiones Logo</strong></label><hr style="width:0%;" >
    </div>
    <div class="col-md-3 col-sm-12 pt-3">
        <input type="Text" id="log_anc" name="log_anc" class="form-control" placeholder="Logo (Ancho)" onkeyup="calculator()"  value="">
    </div>
    <div class="col-md-3 col-sm-12 pt-3">
        <input type="Text" id="log_alt" name="log_alt" class="form-control" placeholder="Logo Alto (Paso)" onkeyup="calculator()"  value="">
    </div>
    <div class="col-md-3 col-sm-12 pt-3">
        <input type="Text" id="log_est" name="log_est" class="form-control" placeholder="Logo(Ancho Estandar)" onkeyup="calculator()"  value="">
    </div>
</div><br>
<div class="row">
    <div class="col-md-3 col-sm-12 pt-3">
        <label class="form-label"><strong>Descripción Tapete</strong></label><hr style="width:0%;" >
    </div>
    <div class="col-md-3 col-sm-12 pt-3">
        <select class="form-select" id="tip_manObra" name="tip_manObra" style="height:34px;" onchange="calcuTapint(1,this.value);" >
        <?php if (!isset($_POST['edit'])) { ?>
                <option value="">Mano De Obra</option>
            <?php } while ($rd =$queryd->fetch(PDO::FETCH_ASSOC)){?>
                <option value="<?php echo $rd['id_mano']; ?>"><?php echo $rd['nom_mano']; ?> </option>
            <?php }
            if(($_POST['resp'] == 6) || ($_POST['resp']==11)){
                while ($rdd = $querydd->fetch(PDO::FETCH_ASSOC)){?>
                    <option value="<?php echo $rdd['id_mano']; ?>"><?php echo $rdd['nom_mano']; ?></option>
            <?php }} ?>
        </select>
    </div>
    <div class="col-md-3 col-sm-12 pt-3">
        <select class="form-select" id="tip_per" name="tip_per" style="height:34px;" onchange="calcuTapint(2,this.value);"  >
            <?php if (!isset($_POST['edit'])) { ?>
                <option value="">Tipo de perfil</option>
            <?php } while ($rb =$queryb->fetch(PDO::FETCH_ASSOC)){?>
                <option value="<?php echo $rb['id_tiper']; ?>"><?php echo $rb['nom_tiper']; ?> </option>
            <?php }
            if(($_POST['resp'] == 6) || ($_POST['resp']==11)){
                while ($rbb = $querybb->fetch(PDO::FETCH_ASSOC)){?>
                    <option value="<?php echo $rbb['id_tiper']; ?>"><?php echo $rbb['nom_tiper']; ?></option>
            <?php }} ?>
        </select>
    </div>
    <div class="col-md-3 col-sm-12 pt-3">
        <select class="form-select" id="tip_tap" name="tip_tap" style="height:34px;"  onchange="calcuTapint(3,this.value);"  >
            <?php if (!isset($_POST['edit'])) { ?>
                <option value="">Tipo de Tapete</option>
            <?php } while ($ra =$querya->fetch(PDO::FETCH_ASSOC)){?>
                <option value="<?php echo $ra['id_tap']; ?>"><?php echo $ra['nom_tap']; ?> </option>
            <?php }
            if(($_POST['resp'] == 6) || ($_POST['resp']==11)){
                while ($raa = $queryaa->fetch(PDO::FETCH_ASSOC)){?>
                    <option value="<?php echo $raa['id_tap']; ?>"><?php echo $raa['nom_tap']; ?></option>
            <?php }} ?>
        </select>
    </div><br>
</div>
<div class="row">
    <div class="col-md-3 col-sm-12 pt-3">
    </div>
    <div class="col-md-3 col-sm-12 pt-3">
        <input type="Text" id="ubicacion" name="ubicacion" class="form-control" placeholder="ubicacion" value="">
    </div>
    <div class="col-md-3 col-sm-12 pt-3">
        <button id="openlog" type="button" class="btn btn-success" onclick="openTap(3);">Tapete con Logo</button>
    </div>
    <div class="col-md-3 col-sm-12 pt-3" id="idlogo" style="visibility:hidden;"  >
        <select class="form-select" id="tip_tap_log" name="tip_tap_log" style="height:34px;">
            <?php if (!isset($_POST['edit'])) { ?>
                <option value="">Tipo de Logo</option>
            <?php } while ($re =$querye->fetch(PDO::FETCH_ASSOC)){?>
                <option value="<?php echo $re['id_tip_log']; ?>"><?php echo $re['nom_tip_log']; ?> </option>
            <?php }
            if(($_POST['resp'] == 6) || ($_POST['resp']==11)){
                while ($ree = $queryee->fetch(PDO::FETCH_ASSOC)){?>
                    <option value="<?php echo $ree['id_tip_log']; ?>"><?php echo $ree['nom_tip_log']; ?></option>
            <?php }} ?>
        </select>
    </div>

</div>
<br>
<input type="text" id="perfil" name="perfil" class="form-control" value=""  style="display:none;">
<input type="text" id="tapete" name="tapete" class="form-control" value=""  style="display:none;">
<input type="text" id="estandlog" name="estandlog" class="form-control" value="" s style="display:none;">
<input type="text" id="logo" name="" class="form-control" value=""  style="display:none;"> 
<?php if(($_SESSION['lid'] == 1 || $_SESSION['lid']==4) || ($_SESSION['lid']==2 && $_SESSION['are']==2)){?>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <button id="opentapetes" type="button" class="btn btn-info" onclick="openTap(1);">Detalles</button>
    </div>
</div>
<br>
<div id="openTa" style="display:none;">
    <div class="row mt-5">
        <div class="col-12 text-center">
            <h3> Descripción Detallada Del Tapete </h3>
        </div>
    </div><br>
    <div class="row">
        <div class="col-md-3 col-sm-12 mb-3">
            <label class="form-label"><strong> Mano De Obra T. Sencillo</strong></label>
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
            <input type="number" id="mans_can" name="mans_can" class="form-control" placeholder="Cantidad"  value="">
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
            <input type="number" id="mans_cost" name="mans_cost" class="form-control" placeholder="$ Costo x Unidad"  value="<?php echo $rM['man_tapsen'];?>">
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
            <input type="number" id="mans_ctot" name="mans_ctot" class="form-control" placeholder="$ Costo Total"  value="">
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
            <input type="number" id="mans_part" name="mans_part" class="form-control" placeholder="% Participacíon "  value="">
        </div>
    </div><br>
    <div class="row">
        <div class="col-md-3 col-sm-12 mb-3">
            <label class="form-label"><strong> Mano De Obra T. Complejo</strong></label>
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
            <input type="number" id="mancom_can" name="mancom_can" class="form-control" placeholder="Cantidad"  value="">
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
            <input type="number" id="mancom_cost" name="mancom_cost" class="form-control" placeholder="$ Costo x Unidad"  value="<?php echo $rM['man_tapcom'];?>">
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
            <input type="number" id="mancom_ctot" name="mancom_ctot" class="form-control" placeholder="$ Costo Total"   value="">
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
            <input type="number" id="mancom_part" name="mancom_part" class="form-control" placeholder="% Participacíon"  value="">
        </div>
    </div><br>
    <div class="row">
        <div class="col-md-3 col-sm-12 mb-3">
            <label class="form-label"><strong> Mano De Obra T.Sin Logo</strong></label>
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
            <input type="number" id="mansin_can" name="mansin_can" class="form-control" placeholder="Cantidad"   value="">
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
            <input type="number" id="mansin_cost" name="mansin_cost" class="form-control" placeholder="$ Costo x Unidad"  value="<?php echo $rM['man_taplog'];?>">
        </div>
        <div class="col-md-2 col-sm-12" mb-3>
            <input type="number" id="mansin_ctot" name="mansin_ctot" class="form-control" placeholder="$ Costo Total"   value="">
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
            <input type="number" id="mansin_part" name="mansin_part" class="form-control" placeholder="% Participacíon"  value="">
        </div>
    </div><br>
    <div class="row">
        <div class="col-md-3 col-sm-12 mb-3">
            <label for="" class="form-label"><strong>Perfil Mediano</strong></label>
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
            <input type="text" id="perM_can" name="perM_can" class="form-control" placeholder="Cantidad"  value="">
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
            <input type="text" id="perM_cost" name="perM_cost" class="form-control" placeholder="$ Costo x Unidad"  value="<?php echo $rC['perm_ml'];?>">
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
            <input type="text" id="perM_ctot" name="perM_ctot" class="form-control" placeholder="$ Costo Total"   value="">
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
            <input type="text" id="perM_part" name="perM_part" class="form-control" placeholder="% Participación"  value="">
        </div>
    </div><br>
    <div class="row">
        <div class="col-md-3 col-sm-12 mb-3">
            <label class="form-label"><strong>Perfil Grueso</strong></label>
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
            <input type="text" id="perG_can" name="perG_can" class="form-control" placeholder="Cantidad"  value="">
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
            <input type="text" id="perG_cost" name="perG_cost" class="form-control" placeholder="$ Costo x Unidad"  value="<?php echo $rC['perg_ml'];?>">
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
            <input type="text" id="perG_ctot" name="perG_ctot" class="form-control" placeholder="$ Costo Total"   value="">
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
            <input type="text" id="perG_part" name="perG_part" class="form-control" placeholder="% Participación"  value="">
        </div>
    </div><br>
    <div class="row">
        <div class="col-md-3 col-sm-12 mb-3">
            <label class="form-label"><strong>Tapete Nomad T3000 base</strong></label>
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
            <input type="text" id="tap3_can" name="tap3_can" class="form-control" placeholder="Cantidad"  value="">
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
            <input type="text" id="tap3_cost" name="tap3_cost" class="form-control" placeholder="$ Costo x Unidad"  value="<?php echo $rC['nomtre_ml'];?>">
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
            <input type="text" id="tap3_ctot" name="tap3_ctot" class="form-control" placeholder="$ Costo Total" value="">
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
            <input type="text" id="tap3_part" name="tap3_part" class="form-control" placeholder="% Participación" value="">
        </div>
    </div><br>
    <div class="row">
        <div class="col-md-3 col-sm-12 mb-3">
            <label class="form-label"><strong> Tapete Nomad T1000 base </strong></label>
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
            <input type="text" id="tap1_can" name="tap1_can" class="form-control" placeholder="Cantidad" value="">
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
            <input type="text" id="tap1_cost" name="tap1_cost" class="form-control" placeholder="$ Costo x Unidad"  value="<?php echo $rC['nomil_ml'];?>">
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
            <input type="text" id="tap1_ctot" name="tap1_ctot" class="form-control" placeholder="$ Costo Total"  value="">
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
            <input type="text" id="tap1_part" name="tap1_part" class="form-control" placeholder="% Participación"  value="">
        </div>
    </div><br>
    <div class="row">
        <div class="col-md-3 col-sm-12 mb-3">
            <label class="form-label"><strong>Tapete Koreano Trafico Pesado Base</strong></label>
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
            <input type="text" id="tkpb_can" name="tkpb_can" class="form-control" placeholder="Cantidad"  value="">
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
            <input type="text" id="tkpb_cost" name="tkpb_cost" class="form-control" placeholder="$ Costo x Unidad"  value="<?php echo $rC['korl_ml'];?>">
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
            <input type="text" id="tkpb_ctot" name="tkpb_ctot" class="form-control" placeholder="$ Costo Total"   value="">
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
            <input type="text" id="tkpb_part" name="tkpb_part" class="form-control" placeholder="% Participación"  value="">
        </div>
    </div><br>
    <div class="row">
        <div class="col-md-3 col-sm-12 mb-3">
            <label class="form-label"><strong>Tapete Koreano Trafico Liviano Base</strong></label>
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
            <input type="text" id="tktlb_can" name="tktlb_can" class="form-control" placeholder="Cantidad"  value="">
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
            <input type="text" id="tktlb_cost" name="tktlb_cost" class="form-control" placeholder="$ Costo x Unidad"  value="<?php echo $rC['korp_ml'];?>">
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
            <input type="text" id="tktlb_ctot" name="tktlb_ctot" class="form-control" placeholder="$ Costo Total"   value="">
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
            <input type="text" id="tktlb_part" name="tktlb_part" class="form-control" placeholder="% Participación"  value="">
        </div>
    </div><br>
    <div class="row">
        <div class="col-md-3 col-sm-12 mb-3">
            <label class="form-label"><strong>Tapete Boston</strong></label>
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
            <input type="text" id="boston_can" name="boston_can" class="form-control" placeholder="Cantidad"  value="">
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
            <input type="text" id="boston_cost" name="boston_cost" class="form-control" placeholder="$ Costo x Unidad"  value="<?php echo $rC['bost_ml'];?>">
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
            <input type="text" id="boston_ctot" name="boston_ctot" class="form-control" placeholder="$ Costo Total" value="">
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
            <input type="text" id="boston_part" name="boston_part" class="form-control" placeholder="% Participación" value="">
        </div>
    </div><br>
    <div class="row">
        <div class="col-md-3 col-sm-12 mb-3">
            <label class="form-label"><strong>Tapete Aqua</strong></label>
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
            <input type="text" id="aqua_can" name="aqua_can" class="form-control" placeholder="Cantidad" value="">
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
            <input type="text" id="aqua_cost" name="aqua_cost" class="form-control" placeholder="$ Costo x Unidad" value="<?php echo $rC['aqua_ml'];?>">
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
            <input type="text" id="aqua_ctot" name="aqua_ctot" class="form-control" placeholder="$ Costo Total" value="">
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
            <input type="text" id="aqua_part" name="aqua_part" class="form-control" placeholder="% Participación" value="">
        </div>
    </div><br>
    <div class="row">
        <div class="col-md-3 col-sm-12 mb-3">
            <label class="form-label"><strong>Tapete Nomad Sin Base</strong></label>
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
            <input type="text" id="tnsb_can" name="tnsb_can" class="form-control" placeholder="Cantidad" value="">
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
            <input type="text" id="tnsb_cost" name="tnsb_cost" class="form-control" placeholder="$ Costo x Unidad" value="<?php echo $rC['nomsinb_ml'];?>">
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
            <input type="text" id="tnsb_ctot" name="tnsb_ctot" class="form-control" placeholder="$ Costo Total" value="">
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
            <input type="text" id="tnsb_part" name="tnsb_part" class="form-control" placeholder="% Participación" value="">
        </div>
    </div><br>

    <div class="row">
        <div class="col-md-3 col-sm-12 mb-3">
            <label class="form-label"><strong>Tapete Nomad T3000 Logo</strong></label>
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
            <input type="text" id="tn3l_can" name="tn3l_can" class="form-control" placeholder="Cantidad" value="">
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
            <input type="text" id="tn3l_cost" name="tn3l_cost" class="form-control" placeholder="$ Costo x Unidad" value="<?php echo $quit3l;;?>">
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
            <input type="text" id="tn3l_ctot" name="tn3l_ctot" class="form-control" placeholder="$ Costo Total" value="">
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
            <input type="text" id="tn3l_part" name="tn3l_part" class="form-control" placeholder="% Participación" value="">
        </div>
    </div><br>
    <div class="row">
        <div class="col-md-3 col-sm-12 mb-3">
            <label class="form-label"><strong>Tapete Nomad T1000 Logo</strong></label>
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
            <input type="text" id="tn1l_can" name="tn1l_can" class="form-control" placeholder="Cantidad"  value="">
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
            <input type="text" id="tn1l_cost" name="tn1l_cost" class="form-control" placeholder="$ Costo x Unidad"  value="<?php echo $quit1l;?>">
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
            <input type="text" id="tn1l_ctot" name="tn1l_ctot" class="form-control" placeholder="$ Costo Total"   value="">
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
            <input type="text" id="tn1l_part" name="tn1l_part" class="form-control" placeholder="% Participación"  value="">
        </div>
    </div><br>
    <div class="row">
        <div class="col-md-3 col-sm-12 mb-3">
            <label class="form-label"><strong>Tapete Koreano Trafico Liviano Logo</strong></label>
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
            <input type="text" id="tktll_can" name="tktll_can" class="form-control" placeholder="Cantidad"  value="">
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
            <input type="text" id="tktll_cost" name="tktll_cost" class="form-control" placeholder="$ Costo x Unidad"  value="<?php echo $rC['korp_m'];?>">
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
            <input type="text" id="tktll_ctot" name="tktll_ctot" class="form-control" placeholder="$ Costo Total"  value="">
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
            <input type="text" id="tktll_part" name="tktll_part" class="form-control" placeholder="% Participación"  value="">
        </div>
    </div><br>
    <div class="row">
        <div class="col-md-3 col-sm-12 mb-3">
            <label class="form-label"><strong>Pegante Maxon</strong></label>
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
            <input type="number" id="pegm_can" name="pegm_can" class="form-control" placeholder="Cantidad"  value="">
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
            <input type="number" id="pegm_cost" name="pegm_cost" class="form-control" placeholder="$ Costo x Unidad"  value="<?php echo $rC['val_pegxtap'];?>">
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
            <input type="number" id="pegm_ctot" name="pegm_ctot" class="form-control" placeholder="$ Costo Total"   value="">
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
            <input type="number" id="pegm_part" name="pegm_part" class="form-control" placeholder="% Participación"  value="">
        </div>
    </div><br>
    <div class="row">
        <div class="col-md-3 col-sm-12 mb-3">
            <label class="form-label"><strong>Pliego papel bond</strong></label>
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
            <input type="number" id="ppb_can" name="ppb_can" class="form-control" placeholder="Cantidad"  value="">
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
            <input type="number" id="ppb_cost" name="ppb_cost" class="form-control" placeholder="$ Costo x Unidad"  value="<?php echo $rC['papel_bond'];?>">
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
            <input type="number" id="ppb_ctot" name="ppb_ctot" class="form-control" placeholder="$ Costo Total"   value="">
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
            <input type="number" id="ppb_part" name="ppb_part" class="form-control" placeholder="% Participación"  value="">
        </div>
    </div><br>
    <div class="row">
        <div class="col-md-3 col-sm-12 mb-3">
            <label class="form-label"><strong>Otros</strong></label>
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
            <input type="number" id="otro_can" name="otro_can" class="form-control" placeholder="Cantidad"  value="">
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
            <input type="number" id="otro_cost" name="otro_cost" class="form-control" placeholder="$ Costo x Unidad"  value="">
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
            <input type="number" id="otro_ctot" name="otro_ctot" class="form-control" placeholder="$ Costo Total"   value="">
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
            <input type="number" id="otro_part" name="otro_part" class="form-control" placeholder="% Participación"  value="">
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-6 col-sm-12 mb-3">
        <label class="form-label"><strong> Costo Total</strong></label>
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="number" id="tot_cost" name="tot_cost" class="form-control"  placeholder="Costo Total"  readonly value=""> 
    </div>
</div>
<?php }?>
<br>
<div class="row" >
    <div class="col-md-6 col-sm-12 mb-3">
        <label class="form-label"><strong> Cantidad </strong></label>
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
    </div>
    <div class="col-md-3 col-sm-12 pt-3">
        <input type="number" id="cant_tap" name="cant_tap" class="form-control" placeholder="Cantidad"   value="">
    </div>
</div><br>
<div class="row" >
    <div class="col-md-6 col-sm-12 mb-3">
        <label class="form-label"style="color: #02587f;"><strong> PSPV 3M 2020</strong></label>
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="number" id="pspv20" name="pspv20" class="form-control"  placeholder="" readonly value=""> 
    </div>
</div><br>
<div class="row" >
    <div class="col-md-6 col-sm-12 mb-3">
        <label class="form-label" style="color: #7f231c;"><strong> Margen</strong></label>
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="text" id="margen" name="margen" style="color: #7f231c;" class="form-control"  placeholder=""  readonly value="30,0%"> 
    </div>
</div>
<div class="row">
		<div class="col-md-12 col-sm-12 pt-3">
			<button type="button" class="btn btn-success" onclick="calculartotTab();" id="Calcular"><i class="fa-solid fa-pen-to-square"></i> Calcular</button>
			<button type="button" class="btn btn-primary" onclick="editarTape();" id="edita"><i class="fa-solid fa-check"></i> Agregar</button>
			<button type="button" class="btn btn-danger" onclick="eliminarTape();" id="elimina" style="visibility: hidden;"><i class="fa-solid fa-eraser"></i> Eliminar</button>
			<button type="button" class="btn btn-warning" onclick="cancelarTape();" id="cancela" style="visibility: hidden;"><i class="fa-solid fa-ban"></i> Cancelar</button>
		</div>
    </div>
    
    <div class="row" style="min-height: 250px;">
		<div class="col-12">
			<div class="table-responsive-sm">
				<div class="tab-final">
					<table id="table" class="table" style=" font-size: 100%;">
						<tr style="background-color: #363a41; color: white;">
							<td width="25%">Ubicación </td>
							<td width="25%">Ancho (M)</td>
							<td width="15%">Largo (Paso)(M)</td>
							<td width="10%">M2</td>
							<td width="10%">CAN</td>
							<td width="10%">VR unit</td>
							<td width="20%">Total</td>
						</tr>