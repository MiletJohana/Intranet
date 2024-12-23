<?php

try {
    $conexion = new PDO('mysql:host=localhost;dbname=masterqu_fen2', 'masterqu_fen2', 'p6[3SZ8m(N',
    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    echo $e->getMessage();
}

?>