<?php
include '../../../resources/template/database.php';
class ActEconimica extends Database
{

    public function __construct()
    {
        parent::__construct();
    }

    public function buscar($buscar)
    {
        $datos = array();

        $sth = $this->prepare("SELECT * FROM act_economica WHERE 
        cod_act LIKE '%$buscar%' OR
        nom_act LIKE '%$buscar%'");

        $sth->execute();

        $result = $sth->fetchAll();


        foreach ($result as $key => $value) {
            $datos[] = array(
                "value" => $value['nom_act'],
                "id_act" => $value['id_act'],
                "nom_act" => $value['nom_act'],
                "cod_act" => $value['cod_act']
            );
        }

        return $datos;
    }
}
