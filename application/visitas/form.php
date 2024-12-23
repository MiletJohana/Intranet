<?php
include "../../conexion.php";
date_default_timezone_set("America/Bogota");
$sql2 = "SELECT * FROM mq_are  WHERE id_are != 10";
$query2 = $conexion->query($sql2);
?>
<form role="form" id="form-visita">
    <div class="row mb-4">
        <div class="col-12 col-sm-12 my-1 text-center">
            <h4 for="tip_id"><i class="fa-solid fa-circle-user me-2"></i> Información de la Visita</h4>
            <hr class="mx-auto" style="width:60%;">
        </div>
        <div class="col-md-6 col-sm-12 mt-3">
            <label for="id_vis2" class="form-label">Cédula</label>
            <input type="text" class="form-control" id="id_per2" name="id_per2" placeholder="Cédula de la persona" onkeydown="auto();" required>
        </div>
        <div class="col-md-6 col-sm-12 mt-3">
            <label for="are_vis" class="form-label">Área a la que se dirige</label>
            <select class="form-select" id="are_vis" name="are_vis" required disabled>
                <option value="">Seleccionar</option>
                <?php while ($r2 = $query2->fetch(PDO::FETCH_ASSOC)) {  ?>
                    <option value="<?php echo $r2['id_are']; ?>"><?php echo $r2['nom_are']; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="row color-factura p-2  rounded" id="infoVisitante" style="display: none;">
        <div class="col-md-6 col-sm-12 p-3 d-flex justify-content-center align-items-center">
            <i class="fa-solid fa-address-book icon__vis"></i>
        </div>
        <div class="col-md-6 col-sm-12 p-3">
            <h4 for="tip_id">Datos del Visitante</h4>
            <div id="datos">
                <p id="nom_per"></p>
                <p id="emp_per"></p>
                <p id="eps_per"></p>
                <p id="arl_per"></p>
                <p id="tel_per"></p>
                <p id="con_per"></p>
                <p id="tel_con"></p>
            </div>
            <input id="btnEditar" type="hidden" class="btn btn-danger" onclick="" value="Editar" />
        </div>
        
    </div>
    <div class="row mt-4" id="addVisitante">
        <div class="col-12 col-sm-12 text-center">
            Nuevo Visitante <br>
            <button id="btnAddVis" type="button" class="btn btn-danger" onclick="crearVisitante();">Agregar</button>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12" id="Visit">
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-12 col-sm-12 mt-3 text-center">
            <h4 for="tip_id"><i class="fa-solid fa-file-signature me-2"></i>Evidencia de la Visita</h4>
            <hr class="mx-auto" style="width:60%;">
        </div>
        <div class="col-12 col-sm-12 mt-3 text-center">
            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFotoVis" aria-expanded="false" aria-controls="collapseFotoVis" data-bs-parent="#collapseFotoVis">
                <i class="fa-solid fa-camera-retro me-2"></i> Foto del Visitante
            </button>
            <button class="btn btn-info" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDocEva" aria-expanded="false" aria-controls="collapseFotoVis" data-bs-parent="#collapseFotoVis">
                <i class="fa-solid fa-person-chalkboard me-2"></i> Evaluación Inducción
            </button>
        </div>
       
        <div class="collapse row mt-5" id="collapseFotoVis">
            <div class="col-md-12 col-sm-12 text-center" id="camara">
                <label for="con_cli" class="form-label">Foto</label><br>
                <video id="video" style="width: 210px; height: 160px;"></video><br>
                <button id="boton" type="button" class="btn btn-danger"><i class="fa-solid fa-camera me-3"></i> Tomar foto</button>
                <p id="estado"></p>
                <canvas id="canvas" style="display: none;"></canvas>
            </div>
            <div class="col-md-6 col-sm-12 text-center" style="display: none;" id="prevFoto">
                <label for="con_cli" class="form-label">Previsualizar</label><br>
                <img id="respuesta" src="" style="width: 210px; height: 160px;" required>
                <input id="imginput" name="imagen" type="hidden" value="" required>
                <div id="message" class="text-center"></div>
            </div>
        </div>
        <div class="collapse row mt-5" id="collapseDocEva">
            <div class="col-md-12 col-sm-12 text-center" id="container_doc">
                <label for="doc_induccion" class="form-label">Evaluación Inducción</label><br>

                <div class="fileUpload btn btn-warning" id="btn-add-doc">
                    <span id="doc_induccion"><i class="fa-solid fa-file me-3"></i> Adjuntar Documento</span>
                    <input type="file" name="doc_induccion" id="doc_induccion" accept="image/*, application/pdf" class="upload" onchange="previewDoc(event, 'file-return', 'preview-doc');">
                </div>
                <br>
                <span id="file-return"></span>
            </div>
            <div class="d-none container_preview_doc col-6 mb-3 text-center">
                    <label class="form-label">Previsualizar</label>
                    <iframe id="preview-doc" src="" width="100%" height="200px"></iframe>
            
                </div>
        </div>

        <input type="hidden" id="accion_form" name="action" value="add">
        <div class="col-12" id="error-validation"></div>
    </div>
    <script type="text/javascript" src="../js/script.js"></script>
    <script type="text/javascript" src="../js/visitas.js"></script>
</form>
