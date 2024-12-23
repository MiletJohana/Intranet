<?php
require_once('ssp.class.php');

include "ssp.conexion.php";

$columns = array(
    array('db' => 'cod_pro', 'dt' => 'cod_pro'),
    array('db' => 'cod_ref', 'dt' => 'cod_ref'),
    array('db' => 'img_pro',  'dt' => 'img_pro'),
    array('db' => 'nom_pro', 'dt' => 'nom_pro'),
    array('db' => 'cod_pro',  'dt' => 'cod_pro'),
    array('db' => 'und_emp', 'dt' => 'und_emp'),
    array('db' => 'can_emp', 'dt' => 'can_emp')
);

echo json_encode(
    SSP::simple($_POST, $conn, "productos_view", 'cod_pro', $columns)
)


/*use masterqu_intranet;
SELECT pro.cod_pro, pro.cod_ref, pro.nom_pro, pro.img_pro, pro.und_emp, pro.can_emp, precio.id_pre, precio.pre_pro 
FROM cot_productos AS pro
INNER JOIN cot_precios AS precio 
ON pro.cod_pro = precio.cod_pro
WHERE precio.nit_cli IS NULL;
create VIEW productos_view 
AS SELECT pro.cod_pro, pro.cod_ref, pro.nom_pro, pro.img_pro, pro.und_emp, pro.can_emp
FROM cot_productos AS pro;
SET SQL_SAFE_UPDATES = 0; */
?>
