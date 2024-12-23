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


		$sql="SELECT p.id_prod, p.cod_pro, p.cod_stock, p.nom_prod, p.desc_prod,p.id_uni_med, p.uni_emp, p.uni_emp_mq , p.id_fam, p.url_img, pr.pre_base
		      FROM productos p , precios pr WHERE pr.id_prod=p.id_prod 
			  AND (p.cod_pro like '%$producto%' or p.nom_prod like '%$producto%')";
		$sth= $this->prepare($sql);


		$sth->execute();

		$result=$sth->fetchAll();

		foreach ($result as $key => $value) {
		$datos[]=array("value"      =>$value['nom_prod'],
		               "id_prod"    =>$value['id_prod'],
					   "cod_pro"    =>$value['cod_pro'],
					   "cod_stock"  =>$value['cod_stock'],
					   "nom_prod"   =>$value['nom_prod'],
					   "desc_prod"  =>$value['desc_prod'],
					   "id_uni_med" =>$value['id_uni_med'],
					   "uni_emp"    =>$value['uni_emp'],
					   "uni_emp_mq" =>$value['uni_emp_mq'],
					   "id_fam"     =>$value['id_fam'],
					   "url_img"    =>$value['url_img'],
					   "pre_base"   =>$value['pre_base']					   					   
					);
		}


		return $datos;
	}

} 
 ?>