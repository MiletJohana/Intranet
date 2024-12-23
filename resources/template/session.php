<?php
require_once('../../pruebas/vendor/autoload.php');
require_once('../../App/Clases/google_auth.php');
$googleClient = new Google_Client();
$auth = new GoogleAuth($googleClient);
include '../../conexion.php';
if (!isset($_SESSION) || !isset($auth)) {
    header('Location: ../index.php');
}
if ($auth->checkRedirectCode() || isset($_SESSION['id'])) {
    include '../../conexion.php';
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM mq_usu where id_usu = $id";
    $query = $conexion->query($sql);
    while ($r = $query->fetch(PDO::FETCH_ASSOC)) {
        $sesion_id = $_SESSION['id'];
        $sesion_usu = $_SESSION['usu'] = $r["usuario"];
        $sesion_nom = $_SESSION['nom'] = $r["nom_usu"];
        $sesion_reg = $_SESSION['reg'] = $r["id_reg"];
        $sesion_are = $_SESSION['are'] = $r["id_are"];
        $sesion_rol = $_SESSION['rol'] = $r["id_rol"];
        $sesion_rol_inv = $_SESSION['rol_inv'] = $r["rol_inv"];
        $sesion_com = $_SESSION['com'] = $r["id_perf"];
        $sesion_lid = $_SESSION['lid'] = $r["id_tipumq"];
        $session_theme = $_SESSION['theme'] = $r["theme"];
        $session_dark = $_SESSION['dark'] = $r["dark"];
        $session_nav_size = $_SESSION['nav_size'] = $r["nav_size"];
        $session_email = $_SESSION['eml_usu'] = $r["eml_usu"];
        $session_cargo = $_SESSION['cargo'] = $r["id_carg"];
    }
} elseif (isset($_SESSION["usu"]) || isset($_SESSION['id'])) {
    $sesion_usu = $_SESSION['usu'];
    $sesion_nom = $_SESSION['nom'];
    $sesion_id = $_SESSION['id'];
    $sesion_reg = $_SESSION['reg'];
    $sesion_are = $_SESSION['are'];
    $sesion_rol = $_SESSION['rol'];
    $sesion_rol_inv = $_SESSION['rol_inv'];
    $sesion_com = $_SESSION['com'];
    $sesion_lid = $_SESSION['lid'];
    $session_theme = $_SESSION['theme'];
    $session_dark = $_SESSION['dark'];
    $session_nav_size = $_SESSION['nav_size'];
    $session_email = $_SESSION['eml_usu'];
    $session_cargo = $_SESSION['cargo'];
}
