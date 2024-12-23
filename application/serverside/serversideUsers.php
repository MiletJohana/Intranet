<?php

require( 'ssp.conexion.php' );
require( 'ssp.class.php' );

//Información
$table = 'users_view';
$primaryKey = 'id_usu';

if( isset($_POST['num_perfil']) ){
    $num_perfil = $_POST['num_perfil'];
}
 
$columns = array(
    array( 'db' => 'id_usu', 'dt' => 'id_usu' ),
    array( 'db' => 'nom_usu',  'dt' => 'nom_usu' ),
    array( 'db' => 'usuario',   'dt' => 'usuario' ),
    array( 'db' => 'fec_crea',     'dt' => 'fec_crea' ),
    array( 'db' => 'usu_upt',     'dt' => 'usu_upt' ),
    array( 'db' => 'eml_usu',     'dt' => 'eml_usu' ),
    array( 'db' => 'nom_are',     'dt' => 'nom_are' ),
    array( 'db' => 'nom_reg',     'dt' => 'nom_reg' ),
);

if(isset($_POST['num_perfil'])){
    $where = "usu_elim !=1 AND num_perfil ='$num_perfil'";
    echo json_encode(
        SSP::complex ( $_POST, $conn, $table, $primaryKey, $columns, $where )
    );
} else{
    echo json_encode(
        SSP::complex ( $_POST, $conn, $table, $primaryKey, $columns, "usu_elim !=1" )
    );
}
 
