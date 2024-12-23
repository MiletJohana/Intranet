

<div class="col-12">
    <button type="button" onclick="newIndicador(32,'Mi Certificado','../certificados/form.php');" class="btn btn-danger my-3" data-bs-toggle="modal" data-bs-target="#largeModal">
        Generar certificado
    </button>
        <div class="table-responsive">
            <table class="table table-bordered tableCertificados table-sm" id="tableCertificados">
                <thead class="table-dark">
                    <tr>
                        <th></th><!--Columna id_cert no visible-->
                        <th>Fecha de Creación</th>
                        <th>Destino </th>
                        <th>Con Salario</th>
                        <th>Con Variable</th>
                        <th>Con Rodamiento</th>
                        <th>Sin Salario</th>
                    </tr>
                </thead>
            </table>
        </div>

</div>
<script type="text/javascript">
    $(document).ready(function() {
        serverSideCertificados();
    });
</script>
