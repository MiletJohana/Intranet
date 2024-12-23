<?php 
include '../../../../resources/template/database.php';
class Clientes extends Database
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function buscar($cliente)
	{
		$datos=array();

		$sth= $this->prepare("SELECT * FROM mq_clie WHERE 
							  nom_cli LIKE '%$cliente%' OR
							  id_cli  LIKE '%$cliente%'");

		$sth->execute();

		$result=$sth->fetchAll();

		foreach ($result as $key => $value) {

		$datos[]=array("value"=>$value['nom_cli'],
					   "id_cli"=>$value['id_cli'],
					   "nom_cli"=>$value['nom_cli'],
					   "tel_cli"=>$value['tel_cli'],
					   "dir_cli"=>$value['dir_cli'],
					   "ase_com"=>$value['ase_com'],
					   "rep_sac"=>$value['rep_sac'],
					   "eml_cli"=>$value['eml_cli'],
					   "tip_id"=>$value['tip_id']
					);
		}

		return $datos;
	}


}
 ?>