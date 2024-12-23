<?php 
   include '../../conexion.php';
   include '../../resources/template/credentials.php';

?>

<nav aria-label="breadcrumb">
   <ol class="breadcrumb mt-3 ms-3">
       <li class="breadcrumb-item"><a href="../home/">Inicio</a></li>
       <li class="breadcrumb-item disable">Recursos</li>
       <li class="breadcrumb-item active text-mq" aria-current="page">Permisos</li>
   </ol>

</nav>

<div class="col-12">
   <div class="py-3">
       <h3>Permisos</h3>
   </div>
   <div class="table-responsive-sm">
       <ul class="nav nav-underline ms-2">
           <li class="nav-item">
               <a class="nav-link <?php if (isset($_GET['table']) && $_GET['table'] == 1) {
                             echo "active";
                           } ?>" href="index.php?table=1">Solicitud</a>
           </li>
           <?php if (($_SESSION['lid'] == 2 || $_SESSION['lid'] == 1 || $_SESSION['lid'] == 4) || ($_SESSION['are'] == 9 && $_SESSION['lid'] == 3)) { ?>
           <li class="nav-item">
               <a class="nav-link <?php if (isset($_GET['table']) && $_GET['table'] == 2) {
                               echo "active";
                             } ?>" href="index.php?table=2">Pendientes</a>
           </li>
           <?php }
         if (($_SESSION['lid'] == 2 || $_SESSION['lid'] == 1 || $_SESSION['lid'] == 4) || ($_SESSION['are'] == 9 && $_SESSION['lid'] == 3)) { ?>
           <li class="nav-item">
               <a class="nav-link <?php if (isset($_GET['table']) && $_GET['table'] == 3) {
                               echo "active";
                             } ?>" href="index.php?table=3">Histórico</a>
           </li>
           <?php }?>
       </ul>
   </div>

</div>

<div class="col-12 pt-2">


   <?php if (!isset($_SESSION['access_token'])) { ?>
   <div class="alert alert-warning alert-dismissible fade show mt-2" role="alert">
         <i class="fa fa-warning icon me-2"></i>
       No iniciaste sesión con Google, por tanto, si creas un permiso el evento en tu calendario no se creará
       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
   </div>
   <?php } ?>


   <?php if (isset($_GET['table']) && $_GET['table'] == 3) { ?>


   <div class="row mt-3">
       <div class="col-md-2 col-sm-12">
           <label for="esta" class="form-label">Estado</label>
           <select class="form-select" id="esta" onchange="filtroper('esta,mes','../permisos/tabla3.php')">
               <option value="2,3,4">Todas</option>
               <option value="2">Pendiente Por Lider</option>
               <option value="3">Aprobadas</option>
               <option value="4">Rechazadas</option>
           </select>
       </div>
       <div class="col-md-2 col-sm-12">
           <label for="mesHs" class="form-label">Mes</label>
           <input type="month" id="mes" name="mes" value="<?php echo date('Y-m'); ?>" max="" min="" class="form-control"
               onchange="filtroper('esta,mes','../permisos/tabla3.php')">
       </div>
       <form action="../permisos/reportes/permisosExcel.php" id="formExp" method="POST" class="mt-2 col-md-2 col-sm-12">
           <div class="dropdown">
               <label for="exp" class="form-label">Exportar a:</label><br>
               <button class=" btn btn-success dropdown-btn dropdown-toggle" data-bs-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                   <i class="fa-regular fa-file-excel me-2"></i>Exportar
               </button>
               <div class="dropdown-menu dropdown-menu-start">
                   <a class="btn btn-link dropdown-item" href="#1" 
                       onclick="formPerm('<?php echo $_SESSION['id'];?>','<?php echo $_SESSION['lid'];?>', '<?php echo $_SESSION['are'];?>')">Mes</a>
               </div>
           </div>
       </form>
   </div>
   <?php } ?>
   

</div>