<?php

$host        = "localhost";

$database    = "masterqu_fen2";

$user        = "masterqu_fen2";

$passwd      = "p6[3SZ8m(N";



$conn = new PDO('mysql:host=' . $host . ';dbname=' . $database, $user, $passwd, array(

    PDO::ATTR_PERSISTENT => true, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'

));

?>

