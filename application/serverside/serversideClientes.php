<?php

// create view clientes_view 
// AS SELECT a.id_cli, a.tip_doc, a.num_doc, a.nom_cli, a.tel_cli, a.eml_cli, a.dir_cli, a.web_cli, a.id_tipo, a.fec_crea, a.id_ciu, b.nom_usu , c.nom_usu AS nom_ase, d.nom_usu AS nom_sac from mq_clientes a 
// LEFT JOIN mq_usu b ON a.id_usu = b.id_usu
// LEFT JOIN mq_usu c ON a.ase_com = c.id_usu
// LEFT JOIN mq_usu d ON a.rep_sac = d.id_usu
// group by a.id_cli;

require_once('ssp.class.php');

include "ssp.conexion.php";

$columns = array(
    array('db' => 'id_cli', 'dt' => 'id_cli'),
    array('db' => 'tip_doc', 'dt' => 'tip_doc'),
    array('db' => 'num_doc', 'dt' => 'num_doc'),
    array('db' => 'nom_cli', 'dt' => 'nom_cli'),
    array('db' => 'tel_cli',  'dt' => 'tel_cli'),
    array('db' => 'eml_cli', 'dt' => 'eml_cli'),
    array('db' => 'dir_cli', 'dt' => 'dir_cli'),
    array('db' => 'web_cli', 'dt' => 'web_cli'),
    array('db' => 'nom_ase', 'dt' => 'nom_ase'),
    array('db' => 'nom_sac', 'dt' => 'nom_sac')
);

if(isset($_POST['tip_cli'])){
    $where .= " id_tipo = "  . $_POST['tip_cli'];
    echo json_encode(
        SSP::complex($_POST, $conn, "clientes_view", 'id_cli', $columns, $where)
    );
}
else if(isset($_POST['fec_crea'])){
    $where .= " fec_crea LIKE '".$_POST['fec_crea']."%'  ";
    echo json_encode(
        SSP::complex($_POST, $conn, "clientes_view", 'id_cli', $columns, $where)
    );
}
else if(isset($_POST['nit_cc'])){
    $where .= " tip_doc ='" . $_POST['nit_cc'] . "'";
    echo json_encode(
        SSP::complex($_POST, $conn, "clientes_view", 'id_cli', $columns, $where)
    );
}
else if(isset($_POST['id_ciu'])){
    $where .= " id_ciu =" . $_POST['id_ciu'];
    echo json_encode(
        SSP::complex($_POST, $conn, "clientes_view", 'id_cli', $columns, $where)
    );
}
else{
    echo json_encode(
        SSP::simple($_POST, $conn, "clientes_view", 'id_cli', $columns)
    );
}

?>