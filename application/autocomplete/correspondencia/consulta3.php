<?php 
include '../../../resources/template/database.php';
class buscador extends Database
{
    public function __construct()
	{
        parent::__construct();
    }
    public function buscar($buscador)
	{
    $datos=array();
    $sth= $this->prepare('SELECT * FROM mq_prove
     WHERE id_prove like "%'.$buscador.'%" OR  nom_pro  like "%'.$buscador.'%"');
    $sth->execute();
    $result=$sth->fetchAll();
    foreach($result as $key => $value){
        $datos[]=array("value"    =>$value ['nom_pro'],
                       "dig_ver"  =>$value ['dig_ver'],
                       "id_prove" =>$value ['id_prove'],
                      "nom_pro"=>$value ['nom_pro']);
    }
    return $datos;
}
}
?>