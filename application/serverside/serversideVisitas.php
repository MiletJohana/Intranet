<?php
// VIEW
/* create VIEW visitas_view 
AS SELECT vis.id_vis, per.id_per, per.nom_per, per.emp_per, vis.fec_vis, vis.fec_sal, are.nom_are, vis.fot_vis, vis.doc_induccion
	FROM mq_pers AS per
	INNER JOIN mq_vis AS vis
	ON per.id_per = vis.id_per
	INNER JOIN mq_are AS are
	ON vis.id_are = are.id_are */
require( 'ssp.conexion.php' );
require( 'ssp.class.php' );
$mes = date("Y-m");
$table = 'visitas_view';
 
// Table's primary key
$primaryKey = 'fec_vis';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'id_vis', 'dt' => 'id_vis' ),
    array( 'db' => 'fec_vis', 'dt' => 'fec_vis' ),
    array( 'db' => 'id_per', 'dt' => 'id_per' ),
    array( 'db' => 'nom_per', 'dt' => 'nom_per' ),
    array( 'db' => 'emp_per', 'dt' => 'emp_per' ),
    array( 'db' => 'fec_sal', 'dt' => 'fec_sal' ),
    array( 'db' => 'nom_are', 'dt' => 'nom_are' ),
    array( 'db' => 'fot_vis', 'dt' => 'fot_vis' ),
    array( 'db' => 'doc_induccion', 'dt' => 'doc_induccion'),
);
 
echo json_encode(
    SSP::complex($_POST, $conn, $table, $primaryKey, $columns, null, 'fec_vis')
);
