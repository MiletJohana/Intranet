<?php 
include '../../conexion.php';
$sql = "SELECT * FROM ind_cargos WHERE id_carg = " . $_SESSION['cargo'];
$query = $conexion->query($sql);
$r = $query->fetch(PDO::FETCH_ASSOC);
?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb mt-3 ms-3">
    <li class="breadcrumb-item"><a href="../home/">Inicio</a></li>
    <li class="breadcrumb-item active text-mq" aria-current="page">Configuración</li>
  </ol>
</nav>
<div class="col-md-12">
  <div class="py-3">
    <h3>Configuración</h3>
  </div>
  <div class="py-2">
    <h1><i class="fa-solid fa-user me-3"></i><strong>Usuario</strong></h1>
    <h2><?php echo $sesion_nom; ?></h2>
    <h4><?php echo $session_email ?></h3>
    <h5><?php if (isset($r['nom_carg'])) { echo $r['nom_carg']; } ?></h4>
  </div>
  <hr>
  <div class="py-3">
  <h1><i class="fa-solid fa-pencil me-3"></i><strong>Apariencia</strong></h1>
  <form>
    <div>
      Tamaño de barra de aplicaciones
      <br>
      <label class="radio-inline <?php if ($session_dark == 1) {
                                    echo 'text-light';
                                  } ?>">
        <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" onclick="theme(0, 'size')" <?php if ($session_nav_size == 'py-md-0') {
                                                                                                                      echo "checked";
                                                                                                                    } ?>> Pequeño
      </label>
      <label class="radio-inline <?php if ($session_dark == 1) {
                                    echo 'text-light';
                                  } ?>">
        <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" onclick="theme(1, 'size')" <?php if ($session_nav_size == 'py-md-1') {
                                                                                                                      echo "checked";
                                                                                                                    } ?>> Mediano
      </label>
      <label class="radio-inline <?php if ($session_dark == 1) {
                                    echo 'text-light';
                                  } ?>">
        <input type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3" onclick="theme(2, 'size')" <?php if ($session_nav_size == 'py-md-2') {
                                                                                                                      echo "checked";
                                                                                                                    } ?>> Grande
      </label>
    </div>
    <div class="switch">
      <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" id="switchTheme" onclick="<?php if ($session_dark == 1) {
                                          echo "theme(0, 'dark')";
                                        } else {
                                          echo "theme(1, 'dark')";
                                        } ?>" <?php if ($session_dark == 1) {
                                                  echo "checked";
                                                } ?>>
        <label class="form-check-label" for="switchTheme">Tema oscuro</label>
      </div>
    </div>
  </form>
  </div>
  
</div>