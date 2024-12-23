<?php 
include '../../../resources/template/database.php';
class Usuarios extends Database
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function buscar($buscar)
	{
        $datos=array();
        $sth=$this->prepare("SELECT * FROM mq_usu WHERE
                             id_usu LIKE '%$buscar%' OR
                             nom_usu LIKE '%$buscar%' OR
                             eml_usu LIKE '%$buscar%'");
        $sth->execute();

        $result=$sth->fetchAll();
        
        foreach ($result as $key => $value) {

            $datos[]=array("value"   =>$value ['nom_usu'],
                           "id_usu" =>$value ['id_usu'],
                           "eml_usu"=>$value ['eml_usu'],
                           "nom_usu"=>$value ['nom_usu']);
        }
        return $datos;
	}
}
 ?>