<?php

 include '../../resources/template/credentials.php';
?>

<div class="col-12">
        <div class="table-responsive mt-4">
            <table class="table table-bordered" id="tableDiligencias">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Empresa</th>
                        <th>Fecha</th>
                        <th>Dirección</th>
                        <th>Tipo</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th>Regionales</th>
                        <th>Responsable</th>
                        <th>Acción</th>
                    </tr>
                </thead>
            </table>
        </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function() {
                serverSideDiligencias(<?php echo $_SESSION['lid'] ?>)
            });
    </script>
