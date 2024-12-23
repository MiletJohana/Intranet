<?php

// create view errornomina_view as select er.*, nom.nom_pag, es.nom_estaErro FROM ind_estad_error es, ind_errores er left join ind_nompag nom on
//  er.id_pag=nom.id_pag where
//  er.id_estaErr=es.id_estaErr ORDER BY er.id_error ASC; 


// SQL server connection information

require( 'ssp.conexion.php' );

 

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *

 * If you just want to use the basic configuration for DataTables with PHP

 * server-side, there is no need to edit below this line.

 */

 

require( 'ssp.class.php' );



        $table = 'errornomina_view';

         

        // Table's primary key

        $primaryKey = 'id_error';

         

        // Array of database columns which should be read and sent back to DataTables.

        // The `db` parameter represents the column name in the database, while the `dt`

        // parameter represents the DataTables column identifier. In this case simple

        // indexes

        $columns = array(

            array( 'db' => 'id_error', 'dt' => 'id_error' ),

            array( 'db' => 'fech_sis', 'dt' => 'fech_sis' ),

            array( 'db' => 'fech_error', 'dt' => 'fech_error' ),

            array( 'db' => 'id_pag', 'dt' => 'id_pag' ),

            array( 'db' => 'col_error', 'dt' => 'col_error' ),

            array( 'db' => 'erro_obser', 'dt' => 'erro_obser' ),

            array( 'db' => 'error_per', 'dt' => 'error_per' ),

            array( 'db' => 'id_estaErr', 'dt' => 'id_estaErr' ),

            array( 'db' => 'mes_err', 'dt' => 'mes_err' ),

            array( 'db' => 'nom_pag', 'dt' => 'nom_pag' ),

            array( 'db' => 'nom_estaErro', 'dt' => 'nom_estaErro' ),

        );

        

        if(isset($_POST['fech_erro'])){

             $where= " fech_sis LIKE '".$_POST['fech_erro']."%'  ";

             echo json_encode(

                 SSP::complex($_POST, $conn, $table, $primaryKey, $columns, $where)

             );

          }else{

           echo json_encode(

                SSP::simple($_POST, $conn, $table, $primaryKey, $columns)

           );

          }

       



    

    