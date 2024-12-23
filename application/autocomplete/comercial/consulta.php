<?php
include '../../../resources/template/database.php';
class Comerciales extends Database
{
	public function __construct()
	{
		parent::__construct();
	}
	public function buscar($comerciales)
	{
		$datos = array();
		$sth = $this->prepare('SELECT * FROM mq_clientes WHERE nom_cli LIKE "%' . $comerciales . '%" OR num_doc LIKE "%' . $comerciales . '%"');
		$sth->execute();
		$result = $sth->fetchAll();
		foreach ($result as $key => $value) {
			$datos[] = array(
				"value" => $value['nom_cli'],
				"id_cli" => $value['id_cli'],
				"tel_cli" => $value['tel_cli'],
				"dir_cli" => $value['dir_cli']
			);
		}
		return $datos;
	}
}
