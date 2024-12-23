<?php 

function usus($id, $conexion)
{
    $sqlUsu = "SELECT * FROM mq_usu WHERE id_usu = " . $id;
    $queryUsu = $conexion->query($sqlUsu);
    $arr = $queryUsu->fetch(PDO::FETCH_ASSOC);
    return $arr['nom_usu'];
}

function esta($id, $conexion)
{
    $sqlSelEst = "SELECT * FROM ind_desc_esta WHERE id_estado = " . $id;
    $querySelEst = $conexion->query($sqlSelEst);
    $rSelEst = $querySelEst->fetch(PDO::FETCH_ASSOC);
    return $rSelEst['nom_est'];
}
function tip($id, $conexion)
{
    $sqlSelTip = "SELECT * FROM ind_desc_tip WHERE id_tip_desc = " . $id;
    $querySelTip = $conexion->query($sqlSelTip);
    $rSelTip = $querySelTip->fetch(PDO::FETCH_ASSOC);
    return $rSelTip['tip_desc'];
}
function reg($id, $conexion)
{
    $sqlSelReg = "SELECT * FROM mq_reg WHERE id_reg = " . $id;
    $querySelReg = $conexion->query($sqlSelReg);
    $rSelReg = $querySelReg->fetch(PDO::FETCH_ASSOC);
    return $rSelReg['nom_reg'];
}

$sqlDescAp = "SELECT * FROM ind_desc";
$queryDescAp = $conexion->query($sqlDescAp);