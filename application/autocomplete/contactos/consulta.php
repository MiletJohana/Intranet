<?php
include '../../../resources/template/database.php';
class Contacto extends Database
{

    public function __construct()
    {
        parent::__construct();
    }

    public function buscar($buscar)
    {
        $datos = array();

        /*$sth = $this->prepare("SELECT * 
        FROM contactos AS con
        WHERE con.nom_cont LIKE '%$buscar%' OR
        con.eml_cont LIKE '%$buscar%'");*/

        $sth = $this->prepare("SELECT con.*, cli.nom_cli 
        FROM contactos AS con
        INNER JOIN mq_clientes AS cli
        ON con.id_cli = cli.id_cli
        WHERE cli.nom_cli LIKE '%$buscar%' OR
            cli.num_doc  LIKE '%$buscar%' OR
            con.nom_cont LIKE '%$buscar%' OR
            con.eml_cont LIKE '%$buscar%'");

        $sth->execute();

        $result = $sth->fetchAll();

        foreach ($result as $key => $value) {
            $datos[] = array(
                "value" => $value['nom_cont'] . ' - ' . $value['nom_cli'],
                "id_cont" => $value['id_cont'],
                "nom_cont" => $value['nom_cont'],
                "eml_cont" => $value['eml_cont'],
                "car_cont" => $value['car_cont'],
                "tel_cont" => $value['tel_cont'],
                "cont_desh" => $value['cont_desh']
            );
        }

        return $datos;
    }
}
