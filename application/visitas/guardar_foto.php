<?php
/*
    Tomar una fotografía y guardarla en un archivo
    @date 2017-11-22
    @author parzibyte
    @web parzibyte.me/blog
*/

if (isset($_POST['param']) && $_POST['param'] == 'cambiar') {
    $ante = $_POST["anterior"];
    unlink($ante);
    $imagenCodificada = $_POST["foto"];
} else {
    $imagenCodificada = file_get_contents("php://input"); //Obtener la imagen
}
if (strlen($imagenCodificada) <= 0) exit("No se recibió ninguna imagen");
//La imagen traerá al inicio data:image/png;base64, cosa que debemos remover
$imagenCodificadaLimpia = str_replace("data:image/png;base64,", "", urldecode($imagenCodificada));

//Venía en base64 pero sólo la codificamos así para que viajara por la red, ahora la decodificamos y
//todo el contenido lo guardamos en un archivo
$imagenDecodificada = base64_decode($imagenCodificadaLimpia);

//Calcular un nombre único
$nombreImagenGuardada = "../../documentos/visitas/foto_" . uniqid() . ".jpg";

file_put_contents($nombreImagenGuardada, $imagenDecodificada);
exit($nombreImagenGuardada);
