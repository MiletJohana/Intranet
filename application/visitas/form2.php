<?php
include "../../conexion.php";
if ($_POST['resp'] == 4 || $_POST['resp'] == 6) {
    $sql2 = "SELECT * FROM `mq_pers` WHERE id_per=\"$_POST[id_per]\"";
    $query2 = $conexion->query($sql2);
    $r = $query2->fetch(PDO::FETCH_ASSOC);
}
$sql3 = "SELECT * FROM `mq_are`";
$query3 = $conexion->query($sql3);
?>
<form role="form" id="form-visitante2">
    <div class="color-factura p-3 pt-0 rounded">
        <div class="row">
            <div class="col-12 col-sm-12 my-1 text-center">
                <h4 for="tip_id"><i class="fa-solid fa-circle-user me-2"></i> Información Visitante</h4>
                <hr class="mx-auto" style="width:60%;">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12 mb-3">
                <label for="id_per3" class="form-label">Cédula</label>
                <input type="text" class="form-control" id="id_per3" name="id_per3" value="<?php echo ($_POST['resp'] == 4 || $_POST['resp'] == 6) ? $r['id_per'] : '';  ?>" required>
            </div>
            <div class="col-md-6 col-sm-12 mb-3">
                <label for="nom_per3" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nom_per3" name="nom_per3" value="<?php echo ($_POST['resp'] == 4 || $_POST['resp'] == 6) ? $r['nom_per'] : ''; ?>" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12 mb-3">
                <label for="eps_per3" class="form-label">EPS</label>
                <input type="text" class="form-control" id="eps_per3" name="eps_per3" value="<?php echo ($_POST['resp'] == 4 || $_POST['resp'] == 6) ? $r['eps_per'] : ''; ?>" required>
            </div>
            <div class="col-md-6 col-sm-12 mb-3">
                <label for="arl_per3" class="form-label">ARL</label>
                <input type="text" class="form-control" id="arl_per3" name="arl_per3" value="<?php echo ($_POST['resp'] == 4 || $_POST['resp'] == 6) ? $r['arl_per'] : ''; ?>" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12 mb-3">
                <label for="emp_per3" class="form-label">Empresa</label>
                <input type="emtextail" class="form-control" id="emp_per3" name="emp_per3" value="<?php echo ($_POST['resp'] == 4 || $_POST['resp'] == 6) ? $r['emp_per'] : ''; ?>" required>
            </div>
            <div class="col-md-6 col-sm-12 mb-3">
                <label for="tel_per3" class="form-label">Teléfono</label>
                <input type="text" class="form-control" id="tel_per3" name="tel_per3" value="<?php echo ($_POST['resp'] == 4 || $_POST['resp'] == 6) ? $r['tel_per'] : ''; ?>" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12 mb-3">
                <label for="con_per3" class="form-label">Contacto de Emergencia</label>
                <input type="text" class="form-control" id="con_per3" name="con_per3" value="<?php echo ($_POST['resp'] == 4 || $_POST['resp'] == 6) ? $r['con_per'] : ''; ?>" required>
            </div>
            <div class="col-md-6 col-sm-12 mb-3">
                <label for="tel_con3" class="form-label">Teléfono del contacto</label>
                <input type="text" class="form-control" id="tel_con3" name="tel_con3" value="<?php echo ($_POST['resp'] == 4 || $_POST['resp'] == 6) ? $r['tel_con'] : ''; ?>" required>
            </div>
        </div>
        <div class="row text-center">
            <?php if ($_POST['resp'] == 6) { ?>
                <div class="col-12 col-sm-12 mb-3">
                    <br>
                    <button id="btnEdi" type="button" class="btn btn-danger" onclick="editVisit();" style="width: 115px;">Actualizar</button>
                </div>
            <?php } ?>
        </div>
    </div>
    <?php if ($_POST['resp'] == 5) { ?>
        <div class="row">
            <div class="col-12 col-sm-12 mt-5 text-center">
                <h4 for="tip_id"><i class="fa-solid fa-user-clock me-2"></i>Información Visita</h4>
                <hr class="mx-auto" style="width:60%;">
            </div>
            <div class="row justify-content-center mb-3">
                <div class="col-md-7 col-sm-12 col-sm-12">
                    <label for="are_vis3" class="form-label">Área a la que se dirige</label>
                    <select class="form-select" id="are_vis3" name="are_vis3" required>
                        <option value="">Seleccionar</option>
                        <?php while ($r3 = $query3->fetch(PDO::FETCH_ASSOC)) { ?>
                            <option value="<?php echo $r3['id_are']; ?>"><?php echo $r3['nom_are']; ?></option>
                        <?php } ?>
                    </select>
                </div>
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
    <?php } ?>
    <input type="hidden" id="accion_form" name="action" value="<?php echo ($_POST['resp'] == 4 || $_POST['resp'] == 6) ? "updateVisit" : "addVisit"; ?>">
    </div>
    <div class="row">
        <div class="col-10 col-sm-12 mb-3" id="error-validation"></div>
    </div>
    <script type="text/javascript" src="../js/script.js"></script>
    <script type="text/javascript" src="../js/visitas.js"></script>
</form>