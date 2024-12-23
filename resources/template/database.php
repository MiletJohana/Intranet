<?php 
class Database extends PDO
{
	public $action;
	function __construct()
	{
		try{
			parent::__construct('mysql:host=localhost;dbname=masterqu_intranet', 'masterqu_admin', 'Y24(2pyu)S');
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