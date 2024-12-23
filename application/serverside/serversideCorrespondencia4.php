<?php

// VIEW

/* CREATE VIEW view_correspondencia_4 AS
SELECT corr.id_seg, corr.id_estSeg, corr.id_usu, us.nom_usu,
nom.nom_doc, corr.fech_ini, ar.nom_are, us1.nom_usu AS nom_per_encarga,
corr.per_encarga, es.nom_estS, corr.id_nom,
corr.id_prove, corr.fec_ven, cli.nom_cli, cli.id_cli,
corr.num_facR, corr.fech_cre 
FROM correspondencias AS corr
INNER JOIN mq_usu AS us
ON corr.id_usu = us.id_usu
INNER JOIN seg_nomdoc AS nom
ON corr.id_nom = nom.id_nom
INNER JOIN mq_are AS ar
ON corr.area_remit = ar.id_are
INNER JOIN seg_estado AS es
ON corr.id_estSeg = es.id_estSeg
INNER JOIN mq_reg AS reg
ON corr.id_reg = reg.id_reg
INNER JOIN mq_clientes AS cli
ON corr.id_prove = cli.id_cli
INNER JOIN mq_usu AS us1
ON corr.per_encarga = us1.id_usu
WHERE corr.id_seg != ''
GROUP BY corr.id_seg;*/


require( 'ssp.conexion.php' );
require( 'ssp.class.php' );

$table = 'view_correspondencia_4';
$primaryKey = 'id_seg';

$where = [];

$columns = array(
    array( 'db' => 'id_seg', 'dt' => 'id_seg' ),
    array( 'db' => 'id_estSeg', 'dt' => 'id_estSeg' ),
    array( 'db' => 'id_usu', 'dt' => 'id_usu' ),
    array( 'db' => 'nom_usu', 'dt' => 'nom_usu' ),
    array( 'db' => 'nom_doc', 'dt' => 'nom_doc' ),
    array( 'db' => 'fech_ini', 'dt' => 'fech_ini' ),
    array( 'db' => 'nom_are', 'dt' => 'nom_are' ),
    array( 'db' => 'nom_per_encarga', 'dt' => 'nom_per_encarga' ),
    array( 'db' => 'per_encarga', 'dt' => 'per_encarga' ),
    array( 'db' => 'nom_estS', 'dt' => 'nom_estS' ),
    array( 'db' => 'id_nom', 'dt' => 'id_nom' ),
    array( 'db' => 'id_prove', 'dt' => 'id_prove' ),
    array( 'db' => 'fec_ven', 'dt' => 'fec_ven' ),
    array( 'db' => 'nom_cli', 'dt' => 'nom_cli' ),
    array( 'db' => 'id_cli', 'dt' => 'id_cli' ),
    array( 'db' => 'num_facR', 'dt' => 'num_facR' ),
    array( 'db' => 'fech_cre', 'dt' => 'fech_cre' ),
);

if ($_POST['id_are'] != 5) {
    
    $where[] = 'id_usu = "'.$_POST['id_usu'].'"';
    $where[] = 'per_encarga = "'.$_POST['id_usu'].'"';    
    
    echo json_encode(
        SSP::complex($_POST, $conn, $table, $primaryKey, $columns, join('OR ', $where))
    );
} else {
    if($_POST['empleado'] != ''){;
        $where[] = 'per_encarga = "'.$_POST['empleado'].'"';
    }

    if($_POST['mes'] != ''){;
        $where[] = 'fech_ini LIKE "'.$_POST['mes'].'%"';
    }

    echo json_encode(
        SSP::complex($_POST, $conn, $table, $primaryKey, $columns, join('AND ', $where))
    );
}





