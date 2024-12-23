<?php

// VIEW

/* create VIEW diligencias_view 
AS SELECT dl.num_dlg, cl.nom_cli, dl.con_dlg, dl.dia_dlg, dl.dir_dlg, tp.nom_tip_dlg, dl.dil_des, dl.tel_dlg, es.nom_est_dlg,dl.est_dlg,cl.id_cli, reg.id_reg, reg.nom_reg ,dl.nom_res 
	    FROM mq_diligencias dl,mq_clientes cl ,tip_dlg tp, mq_est_dlg es, mq_reg reg
	    WHERE dl.id_cli = cl.id_cli 
	    AND dl.id_tip_dlg = tp.id_tip_dlg
	    AND dl.est_dlg = es.id_est_dlg
	    AND dl.id_reg = reg.id_reg */
 

include '../../resources/template/credentials.php';

require( 'ssp.conexion.php' );

require( 'ssp.class.php' );





$table = 'diligencias_view';

$primaryKey = 'num_dlg';

if( isset($_POST['est_dlg']) ){

    $estado = $_POST['est_dlg'];

}

if( isset($_POST['dia_dlg']) ){

    $dia_dlg = $_POST['dia_dlg'];

}



$d = strtotime("-30 days");

$d2 = strtotime("-1 days");

$d3 = strtotime("-3 days");

$hoy = date("Y-m-d");

$fecha = date("Y-m-d", $d);

$fechamt = date("Y-m-d", $d3);

$fechat = date("Y-m-d", $d2);





$columns = array(

    array( 'db' => 'num_dlg', 'dt' => 'num_dlg' ),

    array( 'db' => 'nom_cli', 'dt' => 'nom_cli' ),

    array( 'db' => 'dia_dlg', 'dt' => 'dia_dlg' ),

    array( 'db' => 'dir_dlg', 'dt' => 'dir_dlg' ),

    array( 'db' => 'nom_tip_dlg', 'dt' => 'nom_tip_dlg' ),

    array( 'db' => 'dil_des', 'dt' => 'dil_des' ),

    array( 'db' => 'est_dlg', 'dt' => 'est_dlg' ),

    array( 'db' => 'nom_est_dlg', 'dt' => 'nom_est_dlg' ),

    array( 'db' => 'nom_reg', 'dt' => 'nom_reg' ),

    array( 'db' => 'nom_res', 'dt' => 'nom_res' )

);



if(isset($_POST['est_dlg'])){

    $where = "nom_est_dlg ='$estado'";

    $where .= " AND id_reg =" . $_POST['reg'];

    echo json_encode(

        SSP::complex($_POST, $conn, $table, $primaryKey, $columns, $where) 

    );

} else if(isset($_POST['dia_dlg'])){

    if ($dia_dlg == $hoy) {

        $where = "dia_dlg LIKE '" . $_POST['dia_dlg'] . "' AND est_dlg IN('1','3')";

    } elseif ($dia_dlg == $fechat) {

        $where = "dia_dlg BETWEEN '$fechamt' AND '" . $_POST['dia_dlg'] . "' AND est_dlg IN('1','3')";

    } else {

        $where = "dia_dlg < '" . $_POST['dia_dlg'] . "' AND est_dlg IN('1','3')";

    }

    $where .= " AND id_reg =" . $_POST['reg'];

    echo json_encode(

        SSP::complex($_POST, $conn, $table, $primaryKey, $columns, $where) 

    );

} else {

    echo json_encode(

        SSP::complex($_POST, $conn, $table, $primaryKey, $columns, "id_reg=$sesion_reg") 

    );

}







