<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';
if ($_POST['resp'] == 6) {
    $sql = "SELECT * FROM correspondencias WHERE id_seg=".$_POST['id_seg']."";
    $query = $conexion->query($sql);
    $r = $query-> fetch(PDO::FETCH_ASSOC);
    $area = $r['area_remit'];
    $sql2 = "SELECT * FROM mq_are  WHERE id_are=$area";
    $query2 = $conexion->query($sql2);
    $sql22 = "SELECT * FROM mq_are WHERE id_are != 1 AND id_are!=$area";
    $query22 = $conexion->query($sql22);
    $reg = $r['id_reg'];
    $sql3 = "SELECT * from mq_reg WHERE id_reg=$reg";
    $query3 = $conexion->query($sql3);
    $sql33 = "SELECT * from mq_reg WHERE id_reg!=$reg";
    $query33 = $conexion->query($sql33);
    $bod = $r['id_bodeg'];
    $sql4 = "SELECT * FROM seg_bodeg WHERE id_bodeg=$bod";
    $query4 = $conexion->query($sql4);
    $sql44 = "SELECT * FROM seg_bodeg WHERE id_bodeg!=$bod";
    $query44 = $conexion->query($sql44);
    $nomdoc = $r['id_nom'];
    $sql5 = "SELECT * FROM seg_nomdoc WHERE id_nom=" . $nomdoc;
    $query5 = $conexion->query($sql5);
    $sql55 = "SELECT * FROM seg_nomdoc WHERE id_nom!=" . $nomdoc;
    $query55 = $conexion->query($sql55);
    $nomUsu = $r['per_encarga'];
    $sql6 = "SELECT * FROM  mq_usu WHERE id_usu=$nomUsu";
    $query6 = $conexion->query($sql6);
    $sql66 = "SELECT * FROM  mq_usu WHERE id_usu!=$nomUsu AND id_are=$area";
    $query66 = $conexion->query($sql66);
} else {
    $sql2 = "SELECT * FROM mq_are WHERE id_are != 1";
    $query2 = $conexion->query($sql2);
    $sql3 = "SELECT * from mq_reg";
    $query3 = $conexion->query($sql3);
    $sql4 = "SELECT * FROM seg_bodeg";
    $query4 = $conexion->query($sql4);
    $query44 = $conexion->query($sql4);
    $sql5 = "SELECT * FROM seg_nomdoc";
    $query5 = $conexion->query($sql5);
    $sql6 = "SELECT * FROM mq_usu";
    $query6 = $conexion->query($sql6);
}
?>


<div class="row p-3">
    <div class="card bg-success">
        <div class="card-body">
            <div class="col-12 col-sm-12 text-center">
                <h3><i class="fa-solid fa-file-invoice text-white"></i></h3>
                <h3 class="text-white">Datos de la Factura</h3>
                <hr class="mx-auto" style="width:60%;">
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12 mb-3">
                    <label for="consec_fact" class="form-label text-white"> Consecutivo de factura en Odoo </label>
                    <input type="text" class="form-control" id="consec_fact" name="consec_fact" value="<?php if ($_POST['resp'] == 6) {
                                                                                                            echo $r['conse_fac'];
                                                                                                        } ?>">
                </div>
                <div class="col-md-6 col-sm-12 mb-3">
                    <label for="num_faR" class="form-label text-white">Número De la Factura </label>
                    <input type="text" class="form-control" id="num_faR" name="num_faR" value="<?php if ($_POST['resp'] == 6) {
                                                                                                    echo $r['num_facR'];
                                                                                                } ?>" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12 mb-3">
                    <label for="num_bog" class="form-label text-white"> Bodega </label>
                    <Select class="form-select" id="num_bog" name="num_bog" value="">
                        <?php if (($_POST['resp'] == 1)) { ?>
                            <option value="">Seleccionar</option>
                            <?php }
                                while ($r4 = $query4-> fetch(PDO::FETCH_ASSOC)) { ?>
                                    <option value="<?php echo $r4['id_bodeg']; ?>"><?php echo $r4['nom_bodega']; ?></option>
                            <?php }

                        if (isset($_POST['resp']) && $_POST['resp'] == 6) { 
                            while ($r4 = $query4-> fetch(PDO::FETCH_ASSOC)) { ?>
                                <option value="<?php echo $r4['id_bodeg']; ?>"><?php echo $r4['nom_bodega']; ?></option>
                            <?php }
                            while ($r44 = $query44-> fetch(PDO::FETCH_ASSOC)) { ?>
                                    <option value="<?php echo $r44['id_bodeg']; ?>"><?php echo $r44['nom_bodega']; ?></option>
                            <?php }
                        } ?>
                    </select>
                </div>
                <div class="col-md-6 col-sm-12 mb-3">
                    <label for="fec_ven" class="form-label text-white"> Fecha de Vencimiento </label>
                    <input type="date" class="form-control" id="fec_ven" name="fec_ven" value="<?php if (isset($_POST['resp']) && $_POST['resp'] == 6) {
                                                                                                    echo $r['fec_ven'];
                                                                                                } ?>" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12 mb-3">
                    <label for="subto" class="form-label text-white">Subtotal</label>
                    <input type="number" class="form-control" id="subto" name="subto" value="<?php if ($_POST['resp'] == 6) {
                                                                                                    echo $r['sub_tota'];
                                                                                                } ?>">
                </div>
                <div class="col-md-6 col-sm-12 mb-3">
                    <label for="iva" class="form-label text-white">IVA</label>
                    <input type="number" class="form-control" id="iva" name="iva" value="<?php if ($_POST['resp'] == 6) {
                                                                                                echo $r['iva'];
                                                                                            } ?>">
                </div>
            </div>
            
            </div>
        </div>
    </div>
</div>

    