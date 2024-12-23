<?php
include "../../resources/template/credentials.php";
include '../../conexion.php';
if (isset($_POST['tipo']) && $_POST['tipo'] == 1) { ?>
    <div class="row">
        <div class="col-12 text-center">
            <h3>Correo</h3>
            <hr class="mx-auto" style="width:60%;">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="row">
                <label for="destino" class="form-label">Destino</label>
                <input type="email" class="form-control" id="destino" name="destino" max="15" required>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="row">
                <label for="asunto" class="form-label">Asunto</label>
                <input type="text" class="form-control" id="asunto" name="asunto" max="20" required>
            </div>
        </div>
        <div class="col-md-12 mb-3">
            <div class="row">
                <label for="cuerpo" class="form-label">Cuerpo</label>
                <input type="text" class="form-control" id="cuerpo" name="cuerpo" max="400">
            </div>
        </div>
    </div>
<?php } else if (isset($_POST['tipo']) && $_POST['tipo'] == 2) { ?>
    <div class="row mt-5">
        <div class="col-12 text-center">
            <h3>Nota</h3>
            <hr class="mx-auto" style="width:60%;">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="row">
                <label for="titulo" class="form-label">Titulo</label>
                <input type="email" class="form-control" id="titulo" name="titulo" max="20" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <div class="row">
                <label for="contenido" class="form-label">Contenido</label>
                <textarea class="form-control" id="contenido" name="contenido" max="280"></textarea>
            </div>
        </div>
    </div>
<?php } else if (isset($_POST['tipo']) && $_POST['tipo'] == 3) { ?>
    <div class="row">
        <?php if (!isset($_SESSION['access_token'])) { ?>
        <div class="alert alert-warning alert-dismissible fade show mt-2" role="alert">
            <i class="fa fa-warning icon me-2"></i>
            No iniciaste sesión con Google, por tanto, si creas un recordatorio, el evento en tu calendario no se creará
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php } ?>
    </div>
    <div class="row mt-5">
        <div class="col-12 text-center">
            <h3>Recordatorio</h3>
            <hr class="mx-auto" style="width:60%;">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="row">
                <label for="fecha_recorda" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="fecha_recorda" name="fecha_recorda" required>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="row">
                <label for="hora_recorda" class="form-label">Hora</label>
                <input type="time" class="form-control" id="hora_recorda" name="hora_recorda" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="row">
                <label for="asunto1" class="form-label">Asunto</label>
                <input type="text" class="form-control" id="asunto1" name="asunto" max="15" required>
            </div>
        </div>
    </div>
<?php } else if (isset($_POST['tipo']) && $_POST['tipo'] == 4) { ?>
    <div class="row mt-5">
        <div class="col-12 text-center">
            <h3>Llamada</h3>
            <hr class="mx-auto" style="width:60%;">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="row">
                <label for="destino" class="form-label">Destino</label>
                <input type="text" class="form-control" id="destino" name="destino" max="20" required>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <label class="btn btn-default">
                <input type="checkbox" id="agendar" name="agendar" value="1" onchange="if(this.value == 1) {this.value = 0} else {this.value = 1}" required checked>
                Agendar
            </label>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mb-3">
            <div class="row">
                <label for="observacion" class="form-label">Observación</label>
                <textarea class="form-control" id="observacion" name="observacion" max="100"></textarea>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="row">
        <div class="col-12">
            <div class="alert alert-warning alert-dismissible fade show mt-4 d-flex align-items-center" role="alert">
                <i class="fa-solid fa-triangle-exclamation me-3 fa-xl"></i>
                    Debes seleccionar un tipo de transacción para continuar
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
<?php } ?>