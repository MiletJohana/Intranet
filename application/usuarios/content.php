<nav aria-label="breadcrumb">
    <ol class="breadcrumb ms-3 mt-3 ">
        <li class="breadcrumb-item"><a href="../home/">Inicio</a></li>
        <li class="breadcrumb-item">Administración</li>
        <li class="breadcrumb-item active text-mq" aria-current="page">Usuarios</li>
    </ol>
</nav>
<div class="col-12">
    <div class="py-3">
        <h3>Usuarios</h3>
    </div>
</div>
<div class="col-12">
    <button type="button" onclick="crearUsuario();" class="btn btn-danger mb-4" data-bs-toggle="modal" data-bs-target="#largeModal">
        <i class="fa-solid fa-user-plus me-2"></i> Crear usuario
    </button>

    <button type="button" onclick="crearPermiso();" class="btn btn-danger mb-4" data-bs-toggle="modal" data-bs-target="#mediumModal">
        <i class="fa-solid fa-user-gear me-2"></i> Asignar permiso
    </button>
</div>
<div class="col-md-2 col-12 mb-4">
    <label for="perfil" class="form-label">Perfil:</label>
    <select class="form-select" id="perfil" onchange="filterPerfil();">
        <option value="1,2" id="perfil-todos">Todos</option>
        <option value="1">Usuario</option>
        <option value="2">Líder</option>
    </select>
</div>