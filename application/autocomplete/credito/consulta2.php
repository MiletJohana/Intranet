<?php 
include '../../../resources/template/database.php';
class asesor extends Database
{
    
    public function __construct()
    {
        parent::__construct();
    }
    public function buscar($asesor)
    {
        $datos=array();

        $sth= $this->prepare('SELECT * FROM mq_usu WHERE nom_usu LIKE "%'.$asesor.'%" OR id_usu LIKE "%'.$asesor.'%" AND id_are=11');
        $sth->execute(); 

        $result=$sth->fetchAll();

        foreach ($result as $key => $value) {

         $datos[]=array("value"  =>$value['nom_usu'],
                        "id_usu" =>$value['id_usu'],
                        "nom_usu"=>$value['nom_usu']);
					    
		}

		return $datos;
    }
    
    }
