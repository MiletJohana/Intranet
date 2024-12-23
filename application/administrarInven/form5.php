<?php if($_POST['resp'] == 11){ ?>
    <div class="row g-0 mx-2 mt-3">
        <div class="col-12">
            <h3><i class="fa-solid fa-book me-2"></i> Tipos de Reportes</h3>
        </div>
    </div>
    <div class="row g-0 mx-2 mt-3">
        <div class="col-12">
            <p>Seleccione el tipo de reporte que desea generar:</p>
        </div>
    </div>
    <div class="row g-0 mx-2 mt-3">
        <div class="col-12">
            <button type="button" class="btn btn-info" onclick="reportMovInv(12,'Reporte - Movimiento Inventario','../administrarInven/form5.php');" data-bs-toggle="modal" data-bs-target="#largeModal"><i class="fa-solid fa-cart-flatbed me-2"></i> Movimiento de Inventario</button>
            <button type="button" class="btn btn-warning" onclick="excel_report_inv(2, <?php echo $_POST['id_reg']; ?>, '../administrarInven/reportes/inv_actual_excel.php');"><i class="fa-solid fa-boxes-stacked me-2"></i> Inventario Actual</button>
        </div>
    </div>
<?php } else if ($_POST['resp'] == 12) { ?>
    <div class="row g-0 mx-2 mt-3">
        <div class="col-12">
            <h3 class="text-center"><i class="fa-solid fa-truck-ramp-box me-2"></i> Movimientos Inventario</h3>
            <hr class="mx-auto" style="width:60%;">
        </div>
    </div>
    <form role="form" id="form_report_his_inv">
        <div class="row mt-3">
            <div class="col-md-4 col-sm-12 text-center">
                <label for="mov_razon" class="form-label">Razón</label>
                <select name="mov_razon" id="mov_razon" class="form-select" onchange="val_inputs_report();">
                    <option value="" selected>Seleccionar...</option>
                    <option value="Todos">Ingresos & Salidas</option>
                    <option value="Ingreso">Ingreso</option>
                    <option value="Salida">Salida</option>
                </select> 
            </div>
            <div class="col-md-8 col-sm-12 text-center">
                <label class="form-label">Rango de Fechas</label>
                <div class="row">
                    <div class="col">
                        <input type="date" id="fecha1" name="fecha1" value="<?php //echo date('Y-m'); ?>" max="" min="" class="form-control" onchange="val_inputs_report();">  
                    </div>
                    <div class="col">
                        <input type="date" id="fecha2" name="fecha2" value="<?php //echo date('Y-m'); ?>" max="" min="" class="form-control" onchange="val_inputs_report();">     
                    </div>
                </div> 
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12 text-center">
                <button id="btn_search_report" type="button" class="btn btn-danger" onclick="table_his_inv_mov();" disabled><i class="fa-solid fa-magnifying-glass me-2"></i> Buscar</button>
                <button id="btn_excel_report" type="button" class="btn btn-success d-none" onclick="excel_report_inv(1, 'form_report_his_inv', '../administrarInven/reportes/mov_inv_excel.php');"><i class="fa-solid fa-file-excel me-2"></i> Generar Archivo Excel</button>
            </div>
        </div>
    </form>

    <div class="row mt-3 d-none" id="row_table_his">
        <div class="col-12 text-center">
            <div class="table-responsive">
                <table class="table table-hover table-bordered" style="width:100%" id="tableMovInv">
                    <thead class="table-dark">
                        <tr>
                            <th>Fecha</th>
                            <th>Producto</th>
                            <th>Razón</th>
                            <th>Más detalles</th>
                            <th>Realizado por</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
<?php } ?>
