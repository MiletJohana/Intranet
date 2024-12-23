<?php

// use masterqu_intranet;
//  create view liquidacion_view as SELECT us.nom_usu, li.nom_liqui, ar.nom_are, inf.* 
// FROM  ind_infoli inf inner join mq_usu us on inf.id_usu=us.id_usu inner join ind_liqui li on inf.id_liquiInf=li.id_liquiInf
// inner join mq_are ar on inf.id_are=ar.id_are ORDER BY id_liqui ASC ;


// SQL server connection information

require( 'ssp.conexion.php' );

include '../../resources/template/credentials.php';

 

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *

 * If you just want to use the basic configuration for DataTables with PHP

 * server-side, there is no need to edit below this line.

 */

 

require( 'ssp.class.php' );



        $id_usu = $_SESSION['id'];

        $table = 'liquidacion_view';

         

        // Table's primary key

        $primaryKey = 'id_liqui';

         

        // Array of database columns which should be read and sent back to DataTables.

        // The `db` parameter represents the column name in the database, while the `dt`

        // parameter represents the DataTables column identifier. In this case simple

        // indexes

        $columns = array(

            array( 'db' => 'id_liqui', 'dt' => 'id_liqui' ),

            array( 'db' => 'nom_usu', 'dt' => 'nom_usu' ),

            array( 'db' => 'nom_are', 'dt' => 'nom_are' ),

            array( 'db' => 'nom_liqui', 'dt' => 'nom_liqui' ),

            array( 'db' => 'fec_ret', 'dt' => 'fec_ret' ),

            array( 'db' => 'fech_ref', 'dt' => 'fech_ref' ),

            array( 'db' => 'fech_pag', 'dt' => 'fech_pag' ),

            array( 'db' => 'dias_habiles', 'dt' => 'dias_habiles' ),

        );

        

         if(isset($_POST['fech_liqui'])){

            $where= " fech_sis LIKE '".$_POST['fech_liqui']."%'  ";

            echo json_encode(

                SSP::complex($_POST, $conn, $table, $primaryKey, $columns, $where)

            );

         }else{

            echo json_encode(

                SSP::simple($_POST, $conn, $table, $primaryKey, $columns)

            );

         }

       



    

    