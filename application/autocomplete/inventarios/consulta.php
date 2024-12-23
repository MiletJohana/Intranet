<?php 
include '../../../resources/template/database.php';
class Productos extends Database
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function buscar($buscar, $id_are)
	{
        $datos=array();
        $sth=$this->prepare("SELECT prod.* FROM inv_product prod 
                             LEFT JOIN (
                                SELECT prod.id_prod FROM inv_product prod 
                                LEFT JOIN inv_prod_x_are prod_x_are ON prod.id_prod = prod_x_are.id_prod 
                                WHERE prod_x_are.id_are = '$id_are'
                                GROUP BY prod.id_prod
                                ) AS subsql ON prod.id_prod = subsql.id_prod 
                              WHERE prod.id_prod LIKE '%$buscar%' 
                              OR prod.nom_prod LIKE '%$buscar%' 
                              AND subsql.id_prod IS NULL
                              AND prod.prod_elim != 1;");
        $sth->execute();

        $result=$sth->fetchAll();
        
        foreach ($result as $key => $value) {

            $datos[]=array("value"   =>$value ['nom_prod'],
                           "id_prod" =>$value ['id_prod'],
                           "nom_prod"=>$value ['nom_prod'],
                           "img_prod"=>$value ['img_prod'],
                           "req_aprob"=>$value ['req_aprob']);
        }
        return $datos;
	}
}
 ?>