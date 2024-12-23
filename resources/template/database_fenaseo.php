<?php 
class Database extends PDO
{
	public $action;
	function __construct()
	{
		try{
			parent::__construct('mysql:host=localhost;dbname=masterqu_fen2;charset=utf8','masterqu_fen2','p6[3SZ8m(N');
		    parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
		    $this->exec("set names utf8");
        }
        catch (Exception $ex) 
        {
        	echo "Error al conectar con la base de datos";
        }
    }

 }
 ?>