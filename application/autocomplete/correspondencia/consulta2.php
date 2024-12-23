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
    $sth= $this->prepare("SELECT seg.id_seg , seg.id_estSeg, us.nom_usu, nom.nom_doc, seg.fech_ini, ar.nom_are, seg.per_encarga,es.nom_estS
    FROM seg_ingreso seg, mq_usu us, seg_nomdoc nom, mq_are ar,seg_estado es, seg_ingre_x_movi inse,mq_reg reg
    WHERE seg.id_usu =us.id_usu
    AND seg.id_estSeg=es.id_estSeg
    AND seg.area_remit=ar.id_are
    AND seg.id_nom=nom.id_nom
    AND seg.id_reg=reg.id_reg 
    AND (\n id_seg like '%$search%' OR \n
        nom_usu    like '%$search%' OR \n
        fech_ini   like '%$search%' OR \n
        nom_are    like '%$search%' OR \n
        nom_pro    like '%$search%' OR \n
        nom_doc    like '%$search%')
        order by nom_usu");

    $sth->execute();
    $result=$sth->fetchAll();
        if ($result->rowCount()>0){
            $sth= $this->prepare("SELECT * FROM mq_dlg_x_enrt en,mq_usu us WHERE en.per_encarga=us.id_usu AND ( \n 
            nom_usu like '%$search%')
            ORDER BY nom_usu");
            foreach($result as $key => $value){
                $datos[]=array ("value"=>$value['nom_usu']);
            }
        }else{
            foreach($result as $key => $value){
                $datos[]=array ("value"    =>$value['nom_usu'],
                                "id_seg"   =>$value['id_seg'],
                                "fech_ini" =>$value['fech_ini'],
                                "nom_are"  =>$value['nom_are'],
                                "nom_pro"  =>$value['nom_pro'],
                                "nom_doc"  =>$value['nom_doc']);
            }
        }
         return $datos;
    }
}
?>