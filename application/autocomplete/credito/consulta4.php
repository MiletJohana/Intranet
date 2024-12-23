<?php 
include '../../../resources/template/database.php';
class sac extends Database
{
    
    public function __construct()
    {
        parent::__construct();
    }
    public function buscar($sac)
    {
        $datos=array();

        $sth= $this->prepare('SELECT * FROM mq_usu WHERE nom_usu LIKE "%'.$sac.'%" OR id_usu LIKE "%'.$sac.'%" AND id_are=7');
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
