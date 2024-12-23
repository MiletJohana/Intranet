<?php 
include '../../../resources/template/database.php';
class Visita extends Database
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function buscar($diligencia)
	{
		$datos=array();

		$sth= $this->prepare('SELECT * FROM mq_pers WHERE nom_per LIKE "%'.$diligencia.'%" OR id_per LIKE "%'.$diligencia.'%"');

		$sth->execute();

		$result=$sth->fetchAll();

		foreach ($result as $key => $value) {
		$datos[]=array("value"=>$value['id_per'],
					   "id_per"=>$value['id_per'],
					   "nom_per"=>$value['nom_per'],
					   "emp_per"=>$value['emp_per'],
					   "eps_per"=>$value['eps_per'],
					   "arl_per"=>$value['arl_per'],
					   "tel_per"=>$value['tel_per'],
					   "con_per"=>$value['con_per'],
					   "tel_con"=>$value['tel_con']);
		}
		//echo $diligencia;
		return $datos;
	}


}
 ?>