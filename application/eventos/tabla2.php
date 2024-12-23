<div class="col-12">
    <button type="button" onclick="newIndicador(22,'Capacitaciones','../eventos/form2.php');" class="btn btn-danger my-3" data-bs-toggle="modal" data-bs-target="#largeModal">
        Crear capacitación
    </button>
        <div class="table-responsive">
            <table class="table table-bordered" id="tableCapacitaciones">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Lugar, Dentro de MQ</th>
                        <th>Tipo de Capacitación</th>
                        <th>Objetivo</th>
                        <th>Tema</th>
                        <th>Dicta Capacitacion</th>
                        <th>Área</th>
                        <th>Fecha</th>
                        <th>Evaluación</th>
                        <th>Realizada</th>
                        <th>Usuario</th>
                        <th>Acción</th>
                    </tr>
                </thead>
            </table>
        </div>
</div>
</div>
        <script type="text/javascript">
            $(document).ready(function() {
                serverSideCapacitaciones();
            });
        </script>
</div>