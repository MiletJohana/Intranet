<?php 
include '../../../resources/template/database.php';
class Cliente extends Database
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function buscar($buscar)
	{
		$datos=array();

		$sth= $this->prepare("SELECT * FROM mq_clie WHERE 
							  nom_cli LIKE '%$buscar%' OR
							  id_cli  LIKE '%$buscar%' OR
							  con_cli LIKE '%$buscar%' OR
							  tel_cli LIKE '%$buscar%' OR
							  dir_cli LIKE '%$buscar%' OR
							  hor_cli LIKE '%$buscar%'");

		$sth->execute();

		$result=$sth->fetchAll();


		foreach ($result as $key => $value) {
		$datos[]=array("value"=>$value['nom_cli'],
					   "id_cli"=>$value['id_cli'],
					   "con_cli"=>$value['con_cli'],
					   "tel_cli"=>$value['tel_cli'],
					   "dir_cli"=>$value['dir_cli'],
					   "hor_cli"=>$value['hor_cli']);
		}

		return $datos;
	}


}
 ?>