<?php
include '../../../resources/template/database.php';
class Cliente extends Database
{

    public function __construct()
    {
        parent::__construct();
    }

    public function buscar($buscar)
    {
        $datos = array();

        $sth = $this->prepare("SELECT * FROM mq_clientes WHERE 
							  nom_cli LIKE '%$buscar%' OR
							  id_cli  LIKE '%$buscar%' OR
							  tel_cli LIKE '%$buscar%' OR
							  dir_cli LIKE '%$buscar%' OR
							  eml_cli LIKE '%$buscar%'");

        $sth->execute();

        $result = $sth->fetchAll();


        foreach ($result as $key => $value) {
            $datos[] = array(
                "value" => $value['nom_cli'],
                "id_cli" => $value['id_cli'],
                "nom_cli" => $value['nom_cli'],
                "tip_doc" => $value['tip_doc'],
                "num_doc" => $value['num_doc'],
                "tel_cli" => $value['tel_cli'],
                "dir_cli" => $value['dir_cli'],
                "eml_cli" => $value['eml_cli']
            );
        }

        return $datos;
    }
}
