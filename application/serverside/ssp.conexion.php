<?php



$host        = "localhost";



$database    = "masterqu_intranet";



$user        = "masterqu_admin";



$passwd      = "Y24(2pyu)S";







$conn = new PDO('mysql:host=' . $host . ';dbname=' . $database, $user, $passwd, array(



    PDO::ATTR_PERSISTENT => true, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'



));



?>



