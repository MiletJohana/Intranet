<form role="form" id="form-Cart">
    <div class="row">
        <div class="col-md-4 mb-3">
            <label for="InfVig" class="form-label">Esta Información es la vigente a: </label>
            <input type="text" class="form-control" id="InfVig" name="InfVig" value="">
        </div>
        <div class="col-md-3 mb-3 ">
            <label for="CarVen" class="form-label">Cartera Vencida</label>
            <input type="text" class="form-control" id="CarVen" name="CarVen" value="">
        </div>
        <div class="col-md-2 mb-3">
            <label for="diaCar" class="form-label">Días de Cartera</label>
            <input type="text" class="form-control" id="diaCar" name="diaCar" value="">
        </div>

        <div class="col-md-3 mb-3" class="form-label">
            <label for="cupCa">Cupo de Cartera</label>
            <input type="text" class="form-control" id="cupCa" name="cupCa" value="">
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-1 mb-3">
            <h4 aling="right"><label for="fe_ven1">Fecha Vencimiento </label></h4>
            <input type="text" class="form-control" id="fe_ven1" name="fe_ven1" value="">
        </div>
        <div class="col-md-3 mb-3 ">
            <h4> <label for="no_fac1">No.Factura</label></h4>
            <input type="text" class="form-control" id="no_fac1" name="no_fac1" value="">
        </div>
        <div class="col-md-2 mb-3 ">
            <h4><label for="sald1">Saldo</label></h4>
            <input type="text" class="form-control" id="sald1" name="sald1" value="">
        </div>
        <div class="col-md-1 mb-3" aling=" right">
            <button id="btnagre" type="button" class="btn btn-ms btn-success" style="margin-top: 40px" onclick="car();">+</button>
        </div>
    </div>

    <div class="row mb-3" id="car1" value="0"></div>

    <div class="row">
        <div class="col-md-7 mb-3"></div>
        <div class="col-md-1 mb-3">
            <h4> <label>Total</label></h4>
        </div>
        <div class="col-md-2 mb-3">
            <input type="text" class="form-control" id="sald1" name="sald1" value="">
        </div>

</form>