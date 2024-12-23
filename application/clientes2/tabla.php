
<style>
    #tableClientes_processing {
        background-color: #6b6b6b !important;
    }
</style>
<div class="col-12 mt-4">
    <div class="table-responsive">
        <table class="table table-bordered" id="tableClientes">
            <thead class="table-dark">
                <tr>
                    <th style="width: 3em;">ID</th>
                    <th>NIT/CC</th>
                    <th>Razón Social</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Dirección</th>
                    <th>Acción</th>
                </tr>
            </thead>
        </table>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            serverSideClientes();
        });
    </script>
</div>