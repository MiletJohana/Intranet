<?php 
include '../../../resources/template/database_fenaseo.php';
class Producto extends Database
{
    
    public function __construct()
    {
        parent::__construct();
    }
    public function buscar($producto)
    {
        $datos=array();

        $sth= $this->prepare('SELECT * FROM wpgb_posts WHERE post_type = "product" AND post_title LIKE "%'.$producto.'%" OR ID LIKE "%'.$producto.'%";');
        $sth->execute(); 

        $result=$sth->fetchAll();

        foreach ($result as $key => $value) {

         $datos[]=array("value"=>$value['post_title'],
                        "id_product"  =>$value['ID'],
                        "nom_product" =>$value['post_title']);
					    
		}

		return $datos;
    }
    
    }
