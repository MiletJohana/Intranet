<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';

$sqldoc = "SELECT doc_consGer, doc_rut, doc_estFin, doc_refCom, doc_refcom2, doc_refBanc, doc_form 
FROM cre_solicitud WHERE  id_sol=".$_POST['id_sol'];
 $querydoc = $conexion->query($sqldoc);
 while ($r = $querydoc->fetch(PDO::FETCH_OBJ)) {
    $doc = $r;
    break;
}

?>
<div>
    <h3 class="text-center">Documentos</h3>
    <hr class="mx-auto" style="width:60%;">
</div>
<form role="form" id="form-documentos">
    <div class="row mt-4 mb-3">
            <input type="hidden" name="id_sol" id="id_sol" value="<?php echo $_POST['id_sol']; ?>">
            <div class="col-md-4 col-sm-12 text-center"> 
                <li class="alert alert-warning" id="archivo1">
                    Certificado de constitución y gerencia con fecha de expedición no mayor a <b>60</b> días
                    <hr class="text-white">
                    <div class="fileUpload btn btn-warning mt-2" id="btn_archivo1" style="display:none;">
                        <span id="cer_co">Seleccionar</span>
                        <input type="file" name="certCon" id="certCon" class="upload" accept="multipart/form-data">
                        <div>
                            <script type="text/javascript">
                                document.getElementById('certCon').onchange = function() {
                                    let archivoOpcion = validarSize('certCon');
                                    if(archivoOpcion == 1){
                                        console.log(this.value);
                                        document.getElementById('cer_co').innerHTML = document.getElementById('certCon').files[0].name;
                                        cambiarColor(1, 'success');
                                    }
                                    else{
                                        alertWarningSize();
                                        document.getElementById('certCon').value = '';
                                    }
                                }
                            </script>
                        </div>
                    </div>
                    <div id="eliminar">
                        <div class="d-flex justify-content-between" id="eliminar">
                        <a href="../../documentos/credito/<?php echo $doc->doc_consGer; ?>" target="_blank" ><button class="btn btn-info" type="button"> Ver Documento</button></a>
                        <button class="btn btn-danger" type="button" onclick="deleteDocument('<?php echo $doc->doc_consGer; ?>', 'doc_consGer',<?php echo $_POST['id_sol']; ?>, 'btn_archivo1', 'eliminar');"><i class="fa-solid fa-trash" style="font-size:11px"></i></button>
                        </div>
                    </div>
                    
                </li>
            </div> 
    
        <div class="col-md-4 col-sm-12 text-center">
                <li class="alert alert-warning" id="archivo2">
                    Copia del RUT
                    <hr class="text-white">
                    <div>
                        <div class="fileUpload btn btn-warning mt-2" id="btn_archivo2" style="display:none;">
                            <span id="cop_u">Seleccionar</span>
                            <input type="file" name="copRu" id="copRu" class="upload" accept="multipart/form-data">
                            <div>
                                <script type="text/javascript">
                                    document.getElementById('copRu').onchange = function() {
                                        let archivoOpcion = validarSize('copRu');
                                        if(archivoOpcion == 1){
                                            console.log(this.value);
                                            document.getElementById('cop_u').innerHTML = document.getElementById('copRu').files[0].name;
                                            cambiarColor(2, 'success');
                                        }
                                        else{
                                            alertWarningSize();
                                            document.getElementById('copRu').value = '';
                                        }
                                    }
                                </script>
                            </div>
                        </div>
                    </div>
                    <div id="eliminar2">
                        <div class="d-flex justify-content-between" id="eliminar2" style="display:none;">
                        <a href="../../documentos/credito/<?php echo $doc->doc_rut; ?>" target="_blank" ><button class="btn btn-info" type="button"> Ver Documento</button></a>
                        <button class="btn btn-danger" type="button" onclick="deleteDocument('<?php echo $doc->doc_rut; ?>', 'doc_rut',<?php echo $_POST['id_sol']; ?>, 'btn_archivo2', 'eliminar2');"><i class="fa-solid fa-trash" style="font-size:11px"></i></button>
                        </div>
                    </div>
                </li>
            </div>
            <div class="col-md-4 col-sm-12 text-center">
                <li class="alert alert-warning" id="archivo3">
                    Copia de Estados Financieros de los Dos Ultimos Años Fiscales (Balance General y Estado de Resultados) <br>
                    <hr class="text-white">
                    <div class="fileUpload btn btn-warning mt-2" id="btn_archivo3" style="display:none;">
                        <span id="cop_f">Seleccionar</span>
                        <input type="file" name="copFin" id="copFin" class="upload" accept="multipart/form-data">
                        <div>
                            <script type="text/javascript">
                                document.getElementById('copFin').onchange = function() {
                                    let archivoOpcion = validarSize('copFin');
                                    if(archivoOpcion == 1){
                                        console.log(this.value);
                                        document.getElementById('cop_f').innerHTML = document.getElementById('copFin').files[0].name;
                                        cambiarColor(3, 'success');
                                    }
                                    else{
                                        alertWarningSize();
                                        document.getElementById('copFin').value = '';
                                    }
                                }
                            </script>
                        </div>
                    </div>
                    <div id="eliminar3">
                        <div class="d-flex justify-content-between" id="eliminar3" >
                        <a href="../../documentos/credito/<?php echo $doc->doc_estFin; ?>" target="_blank" ><button class="btn btn-info" type="button"> Ver Documento</button></a>
                        <button class="btn btn-danger" type="button" onclick="deleteDocument('<?php echo $doc->doc_estFin; ?>', 'doc_estFin',<?php echo $_POST['id_sol']; ?>, 'btn_archivo3', 'eliminar3');"><i class="fa-solid fa-trash" style="font-size:11px"></i></button>
                        </div>
                    </div>
                </li>
            </div>
    </div>
<div class="row">
        <div class="col-md-4 col-sm-12 text-center">
            <li class="alert alert-warning" id="archivo7">
                Dos referencias comerciales, (En casos particulares se acepta una de estas de forma verbal) con fecha de expedicion <b>NO</b> mayor a 6 meses 
                <hr class="text-white">  
                <div class="fileUpload btn btn-warning mt-2" id="btn_archivo7"  style="display:none;">
                        <span id="re_com">Seleccionar</span>
                        <input type="file" name="refComer" id="refComer" class="upload" accept="multipart/form-data">
                        <div>
                            <script type="text/javascript">
                                document.getElementById('refComer').onchange = function() {
                                    let archivoOpcion = validarSize('refComer');
                                    if(archivoOpcion == 1){
                                        console.log(this.value);
                                        document.getElementById('re_com').innerHTML = document.getElementById('refComer').files[0].name;
                                        cambiarColor(7, 'success');
                                    }
                                    else{
                                        alertWarningSize();
                                        document.getElementById('refComer').value = '';
                                    }
                                }
                            </script>
                        </div>
                </div>
                    <div id="eliminar4">
                        <div class="d-flex justify-content-between" id="eliminar4" >
                        <a href="../../documentos/credito/<?php echo $doc->doc_refCom; ?>" target="_blank" ><button class="btn btn-info" type="button"> Ver Documento</button></a>
                        <button class="btn btn-danger" type="button" onclick="deleteDocument('<?php echo $doc->doc_refCom; ?>', 'doc_refCom',<?php echo $_POST['id_sol']; ?>, 'btn_archivo7', 'eliminar4');"><i class="fa-solid fa-trash" style="font-size:11px"></i></button>
                        </div>
                    </div>

                    <br>
                    <div class="fileUpload btn btn-warning" id="btn_archivo8" style="display:none;">
                        <span id="ref_com2">Seleccionar</span>
                        <input type="file" name="refComer2" id="refComer2" class="upload" accept="multipart/form-data">
                        <div>
                            <script type="text/javascript">
                                document.getElementById('refComer2').onchange = function() {
                                    let archivoOpcion = validarSize('refComer2');
                                    if(archivoOpcion == 1){
                                        console.log(this.value);
                                        document.getElementById('ref_com2').innerHTML = document.getElementById('refComer2').files[0].name;
                                        cambiarColor(8, 'success');
                                    }
                                    else{
                                        alertWarningSize();
                                        document.getElementById('refComer2').value = '';
                                    }
                                }
                            </script>
                        </div>
                    </div>
                    <div id="eliminar5">
                        <div class="d-flex justify-content-between" id="eliminar5" >
                        <a href="../../documentos/credito/<?php echo $doc->doc_refcom2; ?>" target="_blank" ><button class="btn btn-info" type="button"> Ver Documento</button></a>
                        <button class="btn btn-danger" type="button" onclick="deleteDocument('<?php echo $doc->doc_refcom2; ?>', 'doc_refCom2',<?php echo $_POST['id_sol']; ?>, 'btn_archivo8', 'eliminar5');"><i class="fa-solid fa-trash" style="font-size:11px"></i></button>
                        </div>
                    </div>
            </li>
        </div>
        <div class="col-md-4 col-sm-12 text-center">
            <li class="alert alert-warning" id="archivo9">
                Una referencia bancaria con fecha de expedición <b>NO</b> Mayor a 6 Meses
                <hr class="text-white">
                <div>
                    <div class="fileUpload btn btn-warning mt-2" id="btn_archivo9" style="display:none;">
                        <span id="ref_ban">Seleccionar</span>
                        <input type="file" name="refBan" id="refBan" class="upload" accept="multipart/form-data">
                        <div>
                            <script type="text/javascript">
                                document.getElementById('refBan').onchange = function() {
                                    let archivoOpcion = validarSize('refBan');
                                    if(archivoOpcion == 1){
                                        console.log(this.value);
                                        document.getElementById('ref_ban').innerHTML = document.getElementById('refBan').files[0].name;
                                        cambiarColor(9, 'success');
                                    }
                                    else{
                                        alertWarningSize();
                                        document.getElementById('refBan').value = '';
                                    }
                                }
                            </script>
                        </div>
                    </div>
                </div>
                    <div id="eliminar6">
                        <div class="d-flex justify-content-between" id="eliminar6" >
                        <a href="../../documentos/credito/<?php echo $doc->doc_refBanc; ?>" target="_blank" ><button class="btn btn-info" type="button"> Ver Documento</button></a>
                        <button class="btn btn-danger" type="button" onclick="deleteDocument('<?php echo $doc->doc_refBanc; ?>', 'doc_refBanc',<?php echo $_POST['id_sol']; ?>, 'btn_archivo9', 'eliminar6');"><i class="fa-solid fa-trash" style="font-size:11px"></i></button>
                        </div>
                    </div>
            </li>
        </div>
        <div class="col-md-4 col-sm-12 text-center">
            <li class="alert alert-warning" id="archivo10">
                Formulario de estudio de crédito
                <hr class="text-white">
                <div>
                    <div class="fileUpload btn btn-warning mt-2" id="btn_archivo10" style="display:none;">
                        <span id="for_cre1">Seleccionar</span>

                        <input type="file" name="form_cre" id="form_cre" class="upload" accept="multipart/form-data">
                        <div>
                            <script type="text/javascript">
                                document.getElementById('form_cre').onchange = function() {
                                    let archivoOpcion = validarSize('form_cre');
                                    if(archivoOpcion == 1){
                                        console.log(this.value);
                                        document.getElementById('for_cre1').innerHTML = document.getElementById('form_cre').files[0].name;
                                        cambiarColor(10, 'success');
                                    }
                                    else{
                                        alertWarningSize();
                                        document.getElementById('form_cre').value = '';
                                    }
                                }
                            </script>
                        </div>
                    </div>
                </div>
                    <div id="eliminar7">
                        <div class="d-flex justify-content-between" id="eliminar7" >
                        <a href="../../documentos/credito/<?php echo $doc->doc_form; ?>" target="_blank" ><button class="btn btn-info" type="button"> Ver Documento</button></a>
                        <button class="btn btn-danger" type="button" onclick="deleteDocument('<?php echo $doc->doc_form; ?>', 'doc_form',<?php echo $_POST['id_sol']; ?>, 'btn_archivo10', 'eliminar7');"><i class="fa-solid fa-trash" style="font-size:11px"></i></button>
                        </div>
                    </div>

            </li>
        </div>
        <input type="hidden" id="accion_form" name="action" value="actualizacionForm1">
</div>

</form>






