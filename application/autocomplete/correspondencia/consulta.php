<?php 
include '../../../resources/template/database.php';
class prov extends Database{
    public function __construct()
    {
    parent::__construct();
    }
    public function buscar($prov)
    {
        $datos=array();

        $sth= $this->prepare
        ('SELECT * FROM mq_prove
         WHERE nom_pro
         LIKE "%'.$prov.'%" OR id_prove LIKE "%'.$prov.'%" AND dig_ver');
        $sth->execute(); 

        $result=$sth->fetchAll();
        foreach ($result as $key => $value) {
         
            $datos[]=array("value"   =>$value ['nom_pro'],
                           "id_prove"=>$value ['id_prove'], 
                            "dig_ver"=>$value ['dig_ver'],
                            "nom_pro"=>$value ['nom_pro']);
        }
        return $datos;
    } 
}
?>