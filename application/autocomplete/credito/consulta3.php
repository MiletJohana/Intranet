<?php 
include '../../../resources/template/database.php';
class search extends Database
{
	
	public function __construct()
	{
		parent::__construct();
    }
    public function buscar($search)
	{
        $datos=array();
		$sth= $this->prepare("SELECT * from mq_clie,crm_solicitud WHERE mq_clie.id_cli=crm_solicitud.id_cli AND ( \n
        id_sol   like '%$search%' OR \n 
		crm_solicitud.id_cli  like '%$search%' OR \n
		nom_cli  like '%$search%' OR \n
		eml_cli  like '%$search%' OR \n
		ase_com like '%$search%' OR \n
		rep_sac  like '%$search%' OR \n
		activ_solicitada  like '%$search%')
        order by nom_cli");
        
        $sth->execute();

		$result=$sth->fetchAll();


		foreach ($result as $key => $value) {
		$datos[]=array ("value"=>$value['nom_cli'],
					   "id_cli"=>$value['id_cli'],
					   "id_sol"=>$value['id_sol'],
					   "eml_cli"=>$value['eml_cli'],
					   "ase_com"=>$value['ase_com'],
                       "rep_sac"=>$value['rep_sac'],
                       "activ_solicitada"=>$value['activ_solicitada']);
		}

		return $datos;
	}


}
?>