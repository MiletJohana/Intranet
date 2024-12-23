<div class="col-12 mt-3 mb-3">
    <button type="button" onclick="crearVisita();" class="btn btn-danger mb-4" data-bs-toggle="modal" data-bs-target="#largeModal">
        Crear visita
    </button>
</div>

<div class="col-12">
    <div class="table-responsive">
        <table class="table table-bordered" style="width:100%" id="tableVisitas">
            <thead class="table-dark">
                <tr>
                <th>Hora de Llegada</th>
                    <th>Cédula</th>
                    <th>Nombre</th>
                    <th>Empresa</th>
                    <th>Salida</th>
                    <th>Área</th>
                    <th>Imagen</th>
                    <th>D.Encuesta</th>
                    <th></th>
                </tr>
            </thead>
           
        </table>
    </div>
</div>
        
<script type="text/javascript">
    $(document).ready(function() {
        serverSideVisitas();
    });
</script>
