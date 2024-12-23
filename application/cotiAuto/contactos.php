<?php include '../../conexion.php'; ?>
<form role="form" id="form-contac">
    <div class="row">
        <input type="hidden" name="id_coti" value="<?php $_POST['id_coti']; ?>" />
        <input type="hidden" id="accion_form" name="action" value="emailMas" />
    </div>
    <div class="row">
        <div class="col-12 col-sm-12">
            <div class="alert alert-warning alert-dismissible fade show mt-4 d-flex align-items-center" role="alert">
                <i class="fa-solid fa-triangle-exclamation me-3 fa-xl"></i>
                Recuerde que al enviar el correo tambien se le enviara automáticamente al contacto de la cotización .
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 col-sm-12" align="center">
            <button id="btnM" type="button" class="btn btn-ms btn-success" onclick="desp2();">+</button>
        </div>
        <div class="col-md-5 col-sm-12">
            <label for="nom_ema1" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nom_ema1" name="nom_ema1" value="" required>
        </div>
        <div class="col-md-5 col-sm-12">
            <label for="ema_ema1" class="form-label">Email</label>
            <input type="email" class="form-control" id="ema_ema1" name="ema_ema1" value="" required>
        </div>
    </div>
    <div class="row" id="desp2">
    </div>
    <div class="row" id="desp3">
    </div>
    <div class="row" id="desp4">
    </div>
</form>