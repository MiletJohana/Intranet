<?php 
include '../../../../resources/template/database.php';
class Contactos extends Database
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function buscar($contactos)
	{
		$datos=array();

		$sth= $this->prepare("SELECT *,cont.tel_cont FROM cot_contactos cont,mq_clie cli 
							  WHERE cont.id_cli=cli.id_cli 
							  AND (nom_cont LIKE '%$contactos%' OR
							  nom_cli LIKE '%$contactos%')");

		$sth->execute();

		$result=$sth->fetchAll();

		foreach ($result as $key => $value) {
		$datos[]=array("value"=>$value['nom_cont'].' - ('.$value['nom_cli'].')',
					   "id_cont"=>$value['id_cont'],
					   "nom_cont"=>$value['nom_cont'],
					   "id_cli"=>$value['id_cli'],
					   "car_cont"=>$value['car_cont'],
					   "eml_cont"=>$value['eml_cont'],
					   "tel_cont"=>$value['tel_cont'],
					   "tel_cont2"=>$value['tel_cont2'],
					   "nom_cli"=>$value['nom_cli']);
		}
		return $datos;
	}


}
 ?>