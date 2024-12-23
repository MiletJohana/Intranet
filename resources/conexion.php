<?php



try {

    $conexion = new PDO('mysql:host=localhost;dbname=masterqu_intranet', 'masterqu_admin', 'Y24(2pyu)S', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

    $conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



} catch(PDOException $e){

    echo $e->getMessage();

}



?>