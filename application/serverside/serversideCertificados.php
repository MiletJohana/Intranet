<?php

// VIEW
/* create VIEW certificados_view 
AS SELECT cer.id_cert,us.id_usu, cer.id_carg, us.nom_usu,cer.fec_creacion, cer.cer_salario, cer.cer_varia, cer.cer_rodam, cer.cer_sinsal, cer.lugar_remi
FROM ind_cert_x_usu cer, mq_usu us, ind_cargos car 
WHERE cer.id_carg =car.id_carg 
AND cer.id_usu =us.id_usu */

require( 'ssp.conexion.php' );

include '../../resources/template/credentials.php';


 

require( 'ssp.class.php' );



$id_usu = $_SESSION['id'];

$table = 'certificados_view';

 

// Table's primary key

$primaryKey = 'id_cert';

 

// Array of database columns which should be read and sent back to DataTables.

// The `db` parameter represents the column name in the database, while the `dt`

// parameter represents the DataTables column identifier. In this case simple

// indexes

$columns = array(

    array( 'db' => 'id_cert', 'dt' => 'id_cert' ),

    array( 'db' => 'fec_creacion', 'dt' => 'fec_creacion' ),

    array( 'db' => 'lugar_remi', 'dt' => 'lugar_remi' ),

    array( 'db' => 'cer_salario', 'dt' => 'cer_salario' ),

    array( 'db' => 'cer_varia', 'dt' => 'cer_varia' ),

    array( 'db' => 'cer_rodam', 'dt' => 'cer_rodam' ),

    array( 'db' => 'cer_sinsal', 'dt' => 'cer_sinsal' ),

);



 



 

echo json_encode(

    SSP::complex($_POST, $conn, $table, $primaryKey, $columns, 'id_usu =' .$id_usu)

);

