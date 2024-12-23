<?php
require_once('ssp.class.php');

include "ssp.conexion.php";
include '../../resources/template/credentials.php';

$numTable = $_POST['numTable'];
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
    array('db' => 'nom_estPer', 'dt' => 'nom_estPer')
);

switch ($numTable) {
    case '1':
        if ( $id_usu != '') { 
            echo json_encode(
                SSP::complex($_POST, $conn, 'permisos_view', 'id_usu', $columns, 'id_usu =' .$id_usu)
            );
        } 
        break;

    case '2':
        echo json_encode(
            SSP::simple( $_POST, $conn, 'permisos_view', 'id_usu', $columns )
        );
        break;
}


 