<?php 
include '../../../resources/template/database.php';
class Clientes extends Database
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function buscar($cliente)
	{
		$datos=array();

		$sth= $this->prepare("SELECT * FROM mq_clientes WHERE 
							  nom_cli LIKE '%$cliente%' OR
							  num_doc  LIKE '%$cliente%'");

		$sth->execute();

		$result=$sth->fetchAll();

		foreach ($result as $key => $value) {

		$datos[]=array("value"=>$value['nom_cli'],
					   "id_cli"=>$value['id_cli'],
                       "num_doc"=>$value['num_doc'],
					   "nom_cli"=>$value['nom_cli'],
					   "tel_cli"=>$value['tel_cli'],
					   "dir_cli"=>$value['dir_cli'],
					   "eml_cli"=>$value['eml_cli']
					);
		}

		return $datos;
	}


}
 ?>