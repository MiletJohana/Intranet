<?php

// VIEW
// create VIEW permisos_view AS SELECT a.id_per, b.id_usu, b.nom_usu, b.id_lider, a.fech_sis, a.fech_aus, c.nom_are, a.fech_ini, a.fech_fin, d.mot_per, a.obser_perm, d.descrip_per, e.id_estPer, e.nom_estPer, a.doc_perm, a.crea_rec, a.revi_rec, a.id_are FROM per_ingreso a , mq_usu b, mq_are c, per_motivo d, per_estado e WHERE a.id_usu = b.id_usu AND a.id_are = c.id_are AND a.mot_per= d.mot_per AND a.id_estPer = e.id_estPer ORDER BY a.id_per;

require_once('ssp.class.php');



include "ssp.conexion.php";

include '../../resources/template/credentials.php';

switch ($_POST['numTable']) {

    case '1':

                

        $option = $_POST['option'];

        $id_usu = $_SESSION['id'];



        $columns = array(

            array('db' => 'id_per', 'dt' => 'id_per'),

            array('db' => 'nom_usu', 'dt' => 'nom_usu'),

            array('db' => 'fech_sis', 'dt' => 'fech_sis'),

            array('db' => 'fech_aus',  'dt' => 'fech_aus'),

            array('db' => 'nom_are', 'dt' => 'nom_are'),

            array('db' => 'fech_ini', 'dt' => 'fech_ini'),

            array('db' => 'fech_fin', 'dt' => 'fech_fin'),

            array('db' => 'mot_per', 'dt' => 'mot_per'),

            array('db' => 'descrip_per', 'dt' => 'descrip_per'),

            array('db' => 'doc_perm', 'dt' => 'doc_perm'),

            array('db' => 'id_estPer', 'dt' => 'id_estPer'),

            array('db' => 'nom_estPer', 'dt' => 'nom_estPer'),

            array('db' => 'crea_rec', 'dt' => 'crea_rec')

        );



        switch ($option) {

            case '1':

                if ( $id_usu != '') { 

                    echo json_encode(

                        SSP::complex($_POST, $conn, 'permisos_view', 'id_per', $columns, 'id_usu =' .$id_usu)

                    );

                } 

                break;



            case '2':

                $where = "revi_rec != 1 AND id_estPer >= 3 AND crea_rec != 1 AND id_are != 9";

                echo json_encode(

                    SSP::complex( $_POST, $conn, 'permisos_view', 'id_per', $columns, $where )

                );

                break;

        }



        break;

    

    case '2':



        $columns = array(

            array('db' => 'id_per', 'dt' => 'id_per'),

            array('db' => 'nom_usu', 'dt' => 'nom_usu'),

            array('db' => 'fech_sis', 'dt' => 'fech_sis'),

            array('db' => 'fech_aus',  'dt' => 'fech_aus'),

            array('db' => 'nom_are', 'dt' => 'nom_are'),

            array('db' => 'fech_ini', 'dt' => 'fech_ini'),

            array('db' => 'fech_fin', 'dt' => 'fech_fin'),

            array('db' => 'mot_per', 'dt' => 'mot_per'),

            array('db' => 'obser_perm', 'dt' => 'obser_perm'),

            array('db' => 'descrip_per', 'dt' => 'descrip_per'),

            array('db' => 'doc_perm', 'dt' => 'doc_perm'),

            array('db' => 'id_estPer', 'dt' => 'id_estPer'),

            array('db' => 'nom_estPer', 'dt' => 'nom_estPer')

        );



        

        $contador=0;

        if (isset($_SESSION['lid']) && $_SESSION['lid'] == 2 || $_SESSION['lid'] == 1 || $_SESSION['lid'] == 4) {

            $contador=1;

            $where = "id_estPer = 2 AND id_lider = " .$_SESSION['id'];

        }

        if (isset($_SESSION['are']) && $_SESSION['are'] == 9 && $_SESSION['lid'] == 3) {

            if($contador == 1){

                $where .= " AND id_estPer >= 3 AND crea_rec != 1 AND revi_rec != 1";

            }

            else{

                $where = " id_estPer >= 3 AND crea_rec != 1 AND revi_rec != 1";

            }     

        }



        echo json_encode(

            SSP::complex( $_POST, $conn, 'permisos_view', 'id_per', $columns, $where )

        );

        break;

 

}





 