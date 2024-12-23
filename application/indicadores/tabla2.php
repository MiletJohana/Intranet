<!-- Tabla de Clima Laboral -->
<hr>
<br>
<h3 class="text-center">Clima Laboral
    <button class="btn btn-warning" onclick="newIndicador(26,'Clima Laboral','../indicadores/form.php');" data-bs-toggle="modal" data-bs-target="#largeModal">Insertar Evaluación</button>
</h3>
<div class="table-responsive">
    <div id="tableClima">
        <table class="table table-bordered table-hover table-sm" style="font-size: 70%;">
            <?php include 'headTable.php';
            $meta = 70 ?>
            <tbody>
                <tr class="table-info text-dark">
                    <td><b>Meta Cumplimiento en tiempo</b></td>
                    <?php for ($i = 0; $i < 12; $i++) { ?>
                        <td><?php echo $meta . "%" ?></td>
                    <?php } ?>
                    <td><b><?php echo $meta . "%" ?></b></td>
                </tr>
                <tr>
                    <td><b>Evaluación Clima Laboral</b></td>
                    <?php for ($i = 0; $i < 12; $i++) { ?>
                        <td><?php echo clima(1, 0, 1, $i + 1, $conexion); ?></td>
                    <?php } ?>
                    <td><b><?php echo clima(1, 1, 1, 0, $conexion); ?></b></td>
                </tr>
                <tr class="table-warning text-dark">
                    <td><b>% del Total</b></td>
                    <?php for ($i = 0; $i < 12; $i++) { ?>
                        <td><b><?php echo sumTotalCli(1, $i + 1, $conexion, $meta); ?></b></td>
                    <?php } ?>
                    <td><b><?php echo promYearCli($conexion, $meta); ?></b></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>