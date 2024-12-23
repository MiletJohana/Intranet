<?php 
include '../../../../resources/template/database.php';
class Producto extends Database
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function buscar($producto)
	{
		$datos=array();


		$sql="SELECT p.nom_pro, p.des_pro, p.und_emp, pr.pre_pro,p.cod_pro,p.cod_ref,p.can_emp ,p.sin_dev,p.img_pro
			from cot_productos p , cot_precios pr 
			where pr.cod_pro=p.cod_pro  
			AND pr.nit_cli is null 
			AND (p.cod_ref like '%$producto%' or p.nom_pro like '%$producto%')";
		$sth= $this->prepare($sql);


		$sth->execute();

		$result=$sth->fetchAll();

		foreach ($result as $key => $value) {
		$datos[]=array("value"  =>$value['nom_pro'],
					   "des_pro"=>$value['des_pro'],
					   "und_emp"=>$value['und_emp'],
					   "can_emp"=>$value['can_emp'],
					   "pre_pro"=>$value['pre_pro'],
					   "cod_pro"=>$value['cod_pro'],
					   "cod_ref"=>$value['cod_ref'],
					   "und_emp1"=>$value['und_emp'],
					   "sin_dev"=>$value['sin_dev'],
					   "img_pro"=>$value['img_pro'],
					   "nom_pro"=>$value['nom_pro']);
		}


		return $datos;
	}


}
 ?>