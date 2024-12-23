<?php
include '../../../resources/template/database.php';
class Usuario extends Database
{

	public function __construct()
	{
		parent::__construct();
	}

	public function buscar($buscar)
	{
		$datos = array();
		$sth = $this->prepare("SELECT * FROM mq_usu AS u
		INNER JOIN mq_are AS a
		ON u.id_are = a.id_are 
		INNER JOIN mq_reg AS r
		ON u.id_reg = r.id_reg 
		INNER JOIN ind_cargos AS c
		ON u.id_carg = c.id_carg 
		WHERE ext_usu IS NOT NULL AND( 
		u.id_usu   LIKE '%$buscar%' OR 
		u.nom_usu  LIKE '%$buscar%' OR 
		u.usuario  LIKE '%$buscar%' OR 
		u.eml_usu  LIKE '%$buscar%' OR 
		u.fec_crea LIKE '%$buscar%' OR 
		a.nom_are  LIKE '%$buscar%' OR 
		r.nom_reg  LIKE '%$buscar%' OR 
		c.nom_carg  LIKE '%$buscar%')
		ORDER BY nom_usu");

		$sth->execute();

		$result = $sth->fetchAll();

		foreach ($result as $key  => $value) {
			$datos[] = array(
				"value"    => $value['nom_usu'],
				"id_usu"   => $value['id_usu'],
				"nom_usu"  => $value['nom_usu'],
				"usuario"  => $value['usuario'],
				"eml_usu"  => $value['eml_usu'],
				"fec_crea"  => $value['fec_crea'],
				"nom_carg"  => $value['nom_carg'],
				"usu_upt"  => $value['usu_upt']
			);
		}

		return $datos;
	}
}
