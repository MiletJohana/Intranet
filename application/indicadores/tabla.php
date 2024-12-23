<!-- Tabla de Rotación de Personal-->
<style>
    a{
        cursor: pointer;
    }
</style>
<h3 class="text-center">Rotación de Personal</h3>
<div class="table-responsive">
    <table class="table table-bordered table-hover table-sm" style="font-size: 70%;" >
        <?php include 'headTable.php';
        $meta = '5%' ?>
        <tbody>
            <tr class="table-info text-dark">
                <td><b>Meta % Cumplimiento</b></td>
                <?php for ($i = 0; $i < 12; $i++) { ?>
                    <td><?php echo $meta ?></td>
                <?php } ?>
                <td><b><?php echo $meta ?></b></td>
            </tr>
            <tr>
                <td><b>Trabajadores Activos Inicio Mes</b></td>
                <?php for ($i = 0; $i < 12; $i++) { ?>
                    <td><a onclick="mostrarUsus(1, <?php echo $i + 1; ?>)" class="" data-bs-toggle="modal" data-bs-target="#mediumModal"><?php echo rotaPer(0, 1, 0, $i + 1, $conexion); ?></a></td>
                <?php } ?>
                <td><b><?php echo rotaPer(0, 1, 1, 0, $conexion); ?></b></td>
            </tr>
            <tr>
                <td><b>Trabajadores Activos Fin Mes</b></td>
                <?php for ($i = 0; $i < 12; $i++) { ?>
                    <td><a onclick="mostrarUsus(2, <?php echo $i + 1; ?>)" class="" data-bs-toggle="modal" data-bs-target="#mediumModal"><?php echo rotaPer(0, 2, 0, $i + 1, $conexion); ?></a></td>
                <?php } ?>
                <td><b><?php echo rotaPer(0, 2, 1, 0, $conexion); ?></b></td>
            </tr>
            <tr>
                <td><b>Ingresos</b></td>
                <?php for ($i = 0; $i < 12; $i++) { ?>
                    <td><a onclick="mostrarUsus(3, <?php echo $i + 1; ?>)" class="" data-bs-toggle="modal" data-bs-target="#mediumModal"><?php echo rotaPer(0, 3, 0, $i + 1, $conexion); ?></a></td>
                <?php } ?>
                <td><b><?php echo rotaPer(0, 3, 1, 0, $conexion); ?></b></td>
            </tr>
            <tr>
                <td><b>Retiros</b></td>
                <?php for ($i = 0; $i < 12; $i++) { ?>
                    <td><a onclick="mostrarUsus(4, <?php echo $i + 1; ?>)" class="" data-bs-toggle="modal" data-bs-target="#mediumModal"><?php echo rotaPer(0, 4, 0, $i + 1, $conexion); ?></a></td>
                <?php } ?>
                <td><b><?php echo rotaPer(0, 4, 1, 0, $conexion); ?></b></td>
            </tr>
            <tr class="table-warning text-dark">
                <td><b> % Total</b></td>
                <?php for ($i = 0; $i < 12; $i++) { ?>
                    <td><?php echo sumTotalRot($i + 1, $conexion) . "%"; ?></td>
                <?php } ?>
                <td><b><?php echo promYearRot($conexion) . "%"; ?></b></td>
            </tr>
        </tbody>
    </table>
</div>
<!-- Tabla de Actividades de Bienestar-->
<hr>
<br>
<h3 class="text-center">Actividades de Bienestar</h3>
<div class="table-responsive">
    <table class="table table-bordered table-hover table-sm" style="font-size: 70%;" >
        <?php include 'headTable.php';
        $meta = '98%' ?>
        <tbody>
            <tr class="table-info text-dark">
                <td><b>Meta % Cumplimiento</b></td>
                <?php for ($i = 0; $i < 12; $i++) { ?>
                    <td><?php echo $meta ?></td>
                <?php } ?>
                <td><b><?php echo $meta ?></b></td>
            </tr>
            <tr>
                <td><b>Actividades programadas</b></td>
                <?php for ($i = 0; $i < 12; $i++) { ?>
                    <td><?php echo activBien(1, 0, $i + 1, $conexion); ?></td>
                <?php } ?>
                <td><b><?php echo activBien(1, 1, 0, $conexion); ?></b></td>
            </tr>
            <tr>
                <td><b>Actividades ejecutadas</b></td>
                <?php for ($i = 0; $i < 12; $i++) { ?>
                    <td><?php echo activBien(2, 0, $i + 1, $conexion); ?></td>
                <?php } ?>
                <td><b><?php echo activBien(2, 1, 0, $conexion); ?></b></td>
            </tr>
            <tr class="table-warning text-dark">
                <td><b> % Total</b></td>
                <?php for ($i = 0; $i < 12; $i++) { ?>
                    <td><?php echo sumTotalAct(0, $i + 1, $conexion) . "%"; ?></td>
                <?php } ?>
                <td><b><?php echo promYearAct($conexion) . "%"; ?></b></td>
            </tr>
        </tbody>
    </table>
</div>
<!-- Tabla de Capacitaciones-->
<hr>
<br>
<h3 class="text-center">Capacitaciones</h3>
<div class="table-responsive">
    <table class="table table-bordered table-hover table-sm" style="font-size: 70%;" >
        <?php include 'headTable.php';
        $meta = '92%' ?>
        <tbody>
            <tr class="table-info text-dark">
                <td><b>Meta % Cumplimiento</b></td>
                <?php for ($i = 0; $i < 12; $i++) { ?>
                    <td><?php echo $meta ?></td>
                <?php } ?>
                <td><b><?php echo $meta ?></b></td>
            </tr>
            <tr>
                <td><b>Capacitaciones programadas</b></td>
                <?php for ($i = 0; $i < 12; $i++) { ?>
                    <td><?php echo capacitacion(1, 0, $i + 1, $conexion); ?></td>
                <?php } ?>
                <td><b><?php echo capacitacion(1, 1, 0, $conexion); ?></b></td>
            </tr>
            <tr>
                <td><b>Capacitaciones en producto</b></td>
                <?php for ($i = 0; $i < 12; $i++) { ?>
                    <td><?php echo capacitacion(2, 0, $i + 1, $conexion); ?></td>
                <?php } ?>
                <td><b><?php echo capacitacion(2, 1, 0, $conexion); ?></b></td>
            </tr>
            <tr>
                <td><b>Capacitaciones ejecutadas</b></td>
                <?php for ($i = 0; $i < 12; $i++) { ?>
                    <td><?php echo capacitacion(3, 0, $i + 1, $conexion); ?></td>
                <?php } ?>
                <td><b><?php echo capacitacion(3, 1, 0, $conexion); ?></b></td>
            </tr>
            <tr class="table-warning text-dark">
                <td><b> % Total</b></td>
                <?php for ($i = 0; $i < 12; $i++) { ?>
                    <td><?php echo sumTotalCap(0, $i + 1, $conexion) . "%"; ?></td>
                <?php } ?>
                <td><b><?php echo promYearCap($conexion) . "%"; ?></b></td>
            </tr>
        </tbody>
    </table>
</div>
<!-- Tabla de pagos dias antes -->
<hr>
<br>
<h3 class="text-center">Días De Entrega Antes Del Pago</h3>
<div class="table-responsive">
    <table class="table table-bordered table-hover table-sm" style="font-size: 70%;" >
        <?php include 'headTable.php';
        $meta = '0' ?>
        <tbody>
            <tr class="table-info text-dark">
                <td><b> Meta Cumplimiento 0 Días Antes </b></td>
                <?php for ($i = 0; $i < 12; $i++) { ?>
                    <td><?php echo $meta ?></td>
                <?php } ?>
                <td><b><?php echo $meta ?></b></td>
            </tr>
            <tr>
                <td><b>Entregas de Variable (1 Día Antes)</b></td>
                <?php for ($i = 0; $i < 12; $i++) { ?>
                    <td><?php pago(1, 0, $i + 1, 0, $conexion); ?></td>
                <?php } ?>
                <td><b><?php pago(1, 1, 0, 0, $conexion); ?></b></td>
            </tr>
            <tr>
                <td><b>Entregas de Nomina (1 Día Antes) </b></td>
                <?php for ($i = 0; $i < 12; $i++) { ?>
                    <td><?php pago(2, 0, $i + 1, 0, $conexion); ?></td>
                <?php } ?>
                <td><b><?php pago(2, 1, 0, 0, $conexion); ?></b></td>
            </tr>
            <tr>
                <td><b>Entrega Seguridad Social (5 Días Antes) </b></td>
                <?php for ($i = 0; $i < 12; $i++) { ?>
                    <td><?php pago(3, 0, $i + 1, 0, $conexion); ?></td>
                <?php } ?>
                <td><b><?php pago(3, 1, 0, 0, $conexion); ?></b></td>
            </tr>
            <tr>
                <td><b>Entrega Liquidaciones (5 Días Posteriores ) </b></td>
                <?php for ($i = 0; $i < 12; $i++) { ?>
                    <td><?php pago(4, 0, $i + 1, 0, $conexion); ?></td>
                <?php } ?>
                <td><b><?php pago(4, 1, 0, 0, $conexion); ?></b></td>
            </tr>
            <tr class="table-warning text-dark">
                <td><b>Cumplimiento Promedio en días antes </b></td>
                <?php for ($i = 0; $i < 12; $i++) { ?>
                    <td><?php Sumes(0, $i + 1, $conexion); ?></td>
                <?php } ?>
                <td><b><?php SumYe($conexion); ?></b></td>
            </tr>
        </tbody>
    </table>
</div>
<!-- Errores de Nómina -->
<hr>
<br>
<h3 class="text-center">Errores en Nómina</h3>
<div class="table-responsive">
    <table class="table table-bordered table-hover table-sm" style="font-size: 70%;" >
        <?php include 'headTable.php';
        $meta = '0' ?>
        <tbody>
            <tr class="table-info text-dark">
                <td><b>Meta Cumplimiento 0 Errores </b></td>
                <?php for ($i = 0; $i < 12; $i++) { ?>
                    <td><?php echo $meta ?></td>
                <?php } ?>
                <td><b><?php echo $meta ?></b></td>
            </tr>
            <tr>
                <td><b>Errores en Nómina</b></td>
                <?php for ($i = 0; $i < 12; $i++) { ?>
                    <td>
                        <?php if (error(1, 0, $i + 1, $conexion) > 0) {
                                echo "<span style='color: #ff0000'><b>" . error(1, 0, $i + 1, $conexion) . "</b></span>";
                            } else {
                                echo error(1, 0, $i + 1, $conexion);
                            } ?>
                    </td>
                <?php } ?>
                <td><b><?php echo error(1, 1, 0, $conexion); ?></b></td>
            </tr>
            <tr>
                <td><b>Errores en Comisiones</b></td>
                <?php for ($i = 0; $i < 12; $i++) { ?>
                    <td><?php if (error(2, 0, $i + 1, $conexion) > 0) {
                                echo "<span style='color: #ff0000'><b>" . error(2, 0, $i + 1, $conexion) . "</b></span>";
                            } else {
                                echo error(2, 0, $i + 1, $conexion);
                            } ?></td>
                <?php } ?>
                <td><b><?php echo error(2, 1, 0, $conexion); ?></b></td>
            </tr>
            <tr>
                <td><b>Errores en Seguridad Social</b></td>
                <?php for ($i = 0; $i < 12; $i++) { ?>
                    <td><?php if (error(3, 0, $i + 1, $conexion) > 0) {
                                echo "<span style='color: #ff0000'><b>" . error(3, 0, $i + 1, $conexion) . "</b></span>";
                            } else {
                                echo error(3, 0, $i + 1, $conexion);
                            } ?></td>
                <?php } ?>
                <td><b><?php echo error(3, 1, 0, $conexion); ?></b></td>
            </tr>
            <tr>
                <td><b>Errores en Liquidaciones </b></td>
                <?php for ($i = 0; $i < 12; $i++) { ?>
                    <td><?php if (error(4, 0, $i + 1, $conexion) > 0) {
                                echo "<span style='color: #ff0000'><b>" . error(4, 0, $i + 1, $conexion) . "</b></span>";
                            } else {
                                echo error(4, 0, $i + 1, $conexion);
                            } ?></td>
                <?php } ?>
                <td><b><?php echo error(4, 1, 0, $conexion); ?></b></td>
            </tr>
            <tr class="table-warning text-dark">
                <td><b>Suma Total de Errores</b></td>
                <?php for ($i = 0; $i < 12; $i++) { ?>
                    <td><?php echo sumTotalErr(0, $i + 1, $conexion); ?></td>
                <?php } ?>
                <td><b><?php echo sumTotalErr(1, 0, $conexion); ?></b></td>
            </tr>
        </tbody>
    </table>
</div>
<!-- Tabla de Seleccion de personal - tiempos -->
<hr>
<br>
<h3 class="text-center">Selección de Personal - Tiempos</h3>
<div class="table-responsive">
    <table class="table table-bordered table-hover table-sm" style="font-size: 70%;" >
        <?php include 'headTable.php';
        $meta = '80%' ?>
        <tbody>
            <tr class="table-info text-dark">
                <td><b>Meta Cumplimiento en tiempo</b></td>
                <?php for ($i = 0; $i < 12; $i++) { ?>
                    <td><?php echo $meta ?></td>
                <?php } ?>
                <td><b><?php echo $meta ?></b></td>
            </tr>
            <tr>
                <td><b>Requisiciones para el mes</b></td>
                <?php for ($i = 0; $i < 12; $i++) { ?>
                    <td><?php echo tiempos(1, 0, $i + 1, $conexion); ?></td>
                <?php } ?>
                <td><b><?php echo tiempos(1, 1, 0, $conexion); ?></b></td>
            </tr>
            <tr>
                <td><b>Requisiones cubiertas en el Tiempo según tabla</b></td>
                <?php for ($i = 0; $i < 12; $i++) { ?>
                    <td><?php echo tiempos(2, 0, $i + 1, $conexion); ?></td>
                <?php } ?>
                <td><b><?php echo tiempos(2, 1, 0, $conexion); ?></b></td>
            </tr>
            <tr>
                <td><b>Requisiciones cubiertas fuera de los Tiempos</b></td>
                <?php for ($i = 0; $i < 12; $i++) { ?>
                    <td><?php echo tiempos(3, 0, $i + 1, $conexion); ?></td>
                <?php } ?>
                <td><b><?php echo tiempos(3, 1, 0, $conexion); ?></b></td>
            </tr>
            <tr class="table-warning text-dark">
                <td><b>% del Total</b></td>
                <?php for ($i = 0; $i < 12; $i++) { ?>
                    <td><b><?php echo sumTotalTie($i + 1, 0, $conexion) . "%"; ?></b></td>
                <?php } ?>
                <td><b><?php echo sumTotalTie(0, 1, $conexion) . "%"; ?></b></td>
            </tr>
        </tbody>
    </table>
</div>
<!-- Tabla de Seleccion de personal - efectividad -->
<hr>
<br>
<h3 class="text-center">Selección de Personal - Efectividad</h3>
<div class="table-responsive">
    <table class="table table-bordered table-hover table-sm" style="font-size: 70%;" >
        <?php include 'headTable.php';
        $meta = '75%' ?>
        <tbody>
            <tr class="table-info text-dark">
                <td><b>Meta Cumplimiento en tiempo</b></td>
                <?php for ($i = 0; $i < 12; $i++) { ?>
                    <td><?php echo $meta ?></td>
                <?php } ?>
                <td><b><?php echo $meta ?></b></td>
            </tr>
            <tr>
                <td><b>Ingresos hace seis meses</b></td>
                <?php for ($i = 0; $i < 12; $i++) { ?>
                    <td><?php echo efectividad(1, 0, $i + 1, $conexion); ?></td>
                <?php } ?>
                <td><b><?php echo efectividad(1, 1, 0, $conexion); ?></b></td>
            </tr>
            <tr>
                <td><b>Continuidad de ingresos</b></td>
                <?php for ($i = 0; $i < 12; $i++) { ?>
                    <td><?php echo efectividad(2, 0, $i + 1, $conexion); ?></td>
                <?php } ?>
                <td><b><?php echo efectividad(2, 1, 0, $conexion); ?></b></td>
            </tr>
            <tr class="table-warning text-dark">
                <td><b>% del Total</b></td>
                <?php for ($i = 0; $i < 12; $i++) { ?>
                    <td><b><?php echo sumTotalEfe($i + 1, 0, $conexion) . "%"; ?></b></td>
                <?php } ?>
                <td><b><?php echo sumTotalEfe($i + 1, 1, $conexion) . "%"; ?></b></td>
            </tr>
        </tbody>
    </table>
</div>