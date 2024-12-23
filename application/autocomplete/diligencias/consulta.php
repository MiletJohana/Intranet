<?php
include '../../../resources/template/database.php';
class Clientedil extends Database
{

	public function __construct()
	{
		parent::__construct();
	}

	public function buscar($dili)
	{
		$datos = array();

		$sth = $this->prepare('SELECT * FROM mq_clientes WHERE nom_cli LIKE "%' . $dili . '%" OR id_cli LIKE "%' . $dili . '%" OR num_doc LIKE "%'. $dili .'%"');
		
		$sth->execute();

		$result = $sth->fetchAll();

		foreach ($result as $key => $value) {
			$datos[] = array(
				"value" => $value['nom_cli'],
				"id_cli" => $value['id_cli'],
				"num_doc" => $value['num_doc'],
				"tel_cli" => $value['tel_cli'],
				"dir_cli" => $value['dir_cli'],
				"hor_cli1" => $value['hor_cli1'],
				"hor_cli2" => $value['hor_cli2']
			);
		}

		return $datos;
	}
}
