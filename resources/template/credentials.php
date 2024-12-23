<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['usu'])) {
    header('Location: ../../index.php');
} else {
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
}
//var_dump($_SESSION); 