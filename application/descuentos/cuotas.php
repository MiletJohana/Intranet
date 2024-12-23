<div class="col-12 col-sm-12 pt-3">
    <table class="table text-center" id="tabla" <?php if ($_POST['resp'] != 25) {
                                                        echo "style='display: none;'";
                                                    } ?>>
        <thead>
            <tr>
                <th>Cuota por:</th>
                <th>Fecha de cobro:</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($_POST['resp'] == 25) {
                $i = 0;
                while ($rCuo = $queryCuo->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                        <th><input type="number" required class="form-control" onkeyup="sumCuo(cant.value)" id="cuota<?php echo $i ?>" name="cuotas[]" value="<?php echo $rCuo['cuot_desc']; ?>" <?php if ($_POST['resp'] == 25 && $sesion_are != 9 || $sesion_lid != 1) {
                                                                                                                                                                                                    echo 'readonly';
                                                                                                                                                                                                } ?>></th>
                        <th><input type="date" required class="form-control" id="fecha<?php echo $i ?>" name="fechas[]" value="<?php echo $rCuo['fec_desc']; ?>" <?php if ($_POST['resp'] == 25 && $sesion_are != 9 || $sesion_lid != 1) {
                                                                                                                                                                    echo 'readonly';
                                                                                                                                                                } ?>></th>
                    </tr>
            <?php $i++;
                }
            } ?>
        </tbody>
        <tfoot>
            <?php if ($_POST['resp'] == 25) { ?>
                <td colspan="3">
                    <h4 id="ttotal" class="text-mq" style="color: red;"><b>Total: $</b><b id="total" ><?php echo number_format($rDesc['val_desc']); ?></b></h4>
                </td>
            <?php } ?>
        </tfoot>
    </table>
</div>