<?php
include '../../../resources/template/database.php';
class Lider extends Database
{

	public function __construct()
	{
		parent::__construct();
	}

	public function buscar($lider)
	{
		$datos = array();
		$sth = $this->prepare("SELECT * FROM mq_lider 
		WHERE nom_lider LIKE "%'.$lider.'%")");

		$sth->execute();

		$result = $sth->fetchAll();

		foreach ($result as $key  => $value) {
			$datos[] = array(
				"value"    => $value['nom_lider'],
				"id_are"   => $value['id_are'],
				"id_lider"  => $value['id_lider'],
				"nom_lider"  => $value['nom_lider']
			);
		}

		return $datos;
	}
}
