<?php

require_once('ssp.class.php');



include "ssp.conexion.php";



include '../../resources/template/credentials.php';



switch ($_POST['numTable']) {

    case '1':

                

        $option = $_POST['option'];



        $columns = array(

            array('db' => 'id_sol', 'dt' => 'id_sol'),

            array('db' => 'nom_cli', 'dt' => 'nom_cli'),

            array('db' => 'nom_cont', 'dt' => 'nom_cont'),

            array('db' => 'fec_sol',  'dt' => 'fec_sol'),

            array('db' => 'nom_atc', 'dt' => 'nom_atc'),

            array('db' => 'id_est', 'dt' => 'id_est'),

            array('db' => 'nom_est', 'dt' => 'nom_est'),

            array('db' => 'nom_act', 'dt' => 'nom_act'),

            array('db' => 'nom_usu', 'dt' => 'nom_usu'),
            
            array('db' => 'eml_enviado', 'dt' => 'eml_enviado')

        );



        switch ($option) {

            case '1':

                if ((isset($_SESSION['rol']) && $_SESSION['rol'] == 200)) {

                    $where = "id_est IN (1,8)";

                } 

                elseif ((isset($_SESSION['rol']) && $_SESSION['rol'] == 300)) {

                    $where = "id_est = 2";

                }

                echo json_encode(

                    SSP::complex($_POST, $conn, 'creditos_view1', 'id_sol', $columns, $where)

                );

                

                break;



            case '2':

                if ((isset($_SESSION['rol']) && $_SESSION['rol'] == 100)) {

                    $where = " rep_sac=" . $_SESSION['id'];

                } 

                else {

                    $where = " ase_com=" . $_SESSION['id'];

                }

                echo json_encode(

                    SSP::complex($_POST, $conn, 'creditos_view1', 'id_sol', $columns, $where)

                );

                break;

        }



        break;

    

    case '2':



        $columns = array(

            array('db' => 'id_sol', 'dt' => 'id_sol'),

            array('db' => 'nom_cli', 'dt' => 'nom_cli'),

            array('db' => 'nom_cont', 'dt' => 'nom_cont'),

            array('db' => 'fec_sol',  'dt' => 'fec_sol'),

            array('db' => 'nom_atc', 'dt' => 'nom_atc'),

            array('db' => 'id_est', 'dt' => 'id_est'),

            array('db' => 'nom_act', 'dt' => 'nom_act'),

            array('db' => 'nom_usu', 'dt' => 'nom_usu'),

            array('db' => 'eml_enviado', 'dt' => 'eml_enviado')

        );



      



        echo json_encode(

            SSP::simple( $_POST, $conn, 'creditos_view2', 'id_sol', $columns )

        );

        break;

 

}





 