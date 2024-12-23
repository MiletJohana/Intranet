<div class="col-12">
    <button type="button" onclick="newIndicador(20,'Actividades de bienestar','../eventos/form1.php');" class="btn btn-danger my-3" data-bs-toggle="modal" data-bs-target="#largeModal">
        Crear actividad </button>
        <div class="table-responsive">
            <table class="table table-bordered" id="tableActividades">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Mes</th>
                        <th>Nombre de la actividad</th>
                        <th>Usuario que registra</th>
                        <th>Cumlplimiento</th>
                         <th>Acción</th>
                    </tr>
                </thead>
                
               
            </table>
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                serverSideEventos();
            });
        </script>
</div>