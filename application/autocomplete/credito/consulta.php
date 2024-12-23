<?php 
include '../../../resources/template/database.php';
class Solicitud extends Database
{
    
    public function __construct()
    {
        parent::__construct();
    }
    public function buscar($solicitud)
    {

        include '../../../conexion.php';
        $datos=array();

        $sql="SELECT * FROM mq_clie WHERE nom_cli LIKE '%'.$solicitud.'%' 
                                    OR id_cli LIKE '%'.$solicitud.'%'";
        $query=$conexion->query($sql);
        if($query->rowCount()>0){
            $sth= $this->prepare("SELECT * FROM mq_clie WHERE nom_cli LIKE '%'.$solicitud.'%' 
                                                        OR id_cli LIKE '%'.$solicitud.'%'");
            $sth->execute();
            $result=$sth->fetchAll();

            foreach ($result as $key => $value) {
                
            $datos[]=array("value"=>$value['nom_cli'],
                        "id_cli"=>$value['id_cli'],
                        "con_cli"=>$value['con_cli'],
                        "tel_cli"=>$value['tel_cli'],
                        "dir_cli"=>$value['dir_cli'],
                        "eml_cli"=>$value['eml_cli'],
                        "ase_com"=>$value['ase_com'],
                        "nom_usu"=>$value['nom_usu'],
                        "tel_cli"=>$value['tel_cli'],
                        "cargo_conta"=>$value['cargo_conta'],
                        "telefono_fijo"=>$value['telefono_fijo']);
            }
        }else{
            $sth= $this->prepare('SELECT * FROM mq_clie WHERE nom_cli LIKE "%'.$solicitud.'%" OR id_cli LIKE "%'.$solicitud.'%"');
            $sth->execute();
            $result=$sth->fetchAll();

            foreach ($result as $key => $value) {
                
            $datos[]=array("value"=>$value['nom_cli'],
                        "id_cli"=>$value['id_cli'],
                        "con_cli"=>$value['con_cli'],
                        "tel_cli"=>$value['tel_cli'],
                        "dir_cli"=>$value['dir_cli'],
                        "eml_cli"=>$value['eml_cli'],
                        "tel_cli"=>$value['tel_cli'],
                        "cargo_conta"=>$value['cargo_conta'],
                        "telefono_fijo"=>$value['telefono_fijo'],
                        "prod_preg"=>$value['prod_preg'],
                        "ase_com"=>'0');
            }
        }

		return $datos;
    }
    
    }


    
    
    
?>