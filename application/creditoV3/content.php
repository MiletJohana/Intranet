<nav aria-label="breadcrumb">
  <ol class="breadcrumb mt-3 ms-3">
    <li class="breadcrumb-item"><a href="../home/">Inicio</a></li>
    <li class="breadcrumb-item">Ventas</li>
    <li class="breadcrumb-item active text-mq" aria-current="page">Crédito</li>
  </ol>
</nav>
<div class="col-12">
  <div class="py-3">
    <h3>Crédito</h3>
  </div>
  <button type="button" onclick="crearCrm();" class="btn btn-danger mt-2 mb-4" data-bs-toggle="modal" data-bs-target="#largeModal">
    Crear crédito
  </button>
</div>

<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';

  if ((isset($_SESSION['rol']) && $_SESSION['rol'] == 200) || (isset($_POST['rol']) && $_POST['rol'] == 200) || (isset($_SESSION['rol']) && $_SESSION['rol'] == 300) || (isset($_POST['rol']) && $_POST['rol'] == 300)) {
    $sql1 = "SELECT us.id_reg,sl.id_sol, cl.nom_cli, cont.nom_cont, sl.fec_sol, sl.ase_com,cl.id_cli, es.nom_est,sl.id_est, actsol.nom_act,cl.rep_sac, us.nom_usu,sl.fecha_crea,sl.nom_atc, sl.eml_enviado
    FROM mq_clientes cl , cre_solicitud sl, cre_estadosol es, mq_usu us, contactos cont,  credit_actSol actsol 
    WHERE cl.id_cli = sl.id_cli 
    AND sl.activ_solicitada = actsol.id_act
    AND sl.id_cont = cont.id_cont
    AND es.id_est = sl.id_est
    AND sl.id_usu = us.id_usu";
    if ((isset($_SESSION['rol']) && $_SESSION['rol'] == 200)) {
      $sql1 .= " AND sl.id_est IN (1,8)";
    } elseif ((isset($_SESSION['rol']) && $_SESSION['rol'] == 300)) {
      $sql1 .= " AND sl.id_est = 2";
    }
    $sql1 .= " GROUP BY sl.id_sol";
    $query = $conexion->query($sql1);
    //echo $sql1;
    include 'tabla.php';
    $sql1 = null;
    $query = null;
   
  }
  $sql1 = "SELECT sl.id_usu, us.id_reg, sl.id_sol, cl.nom_cli, sl.id_cont, cont.nom_cont, sl.fec_sol, sl.ase_com, sl.nom_atc, cl.id_cli, sl.fecha_crea, es.nom_est, sl.id_est, us.nom_usu, actsol.nom_act, sl.eml_enviado
	FROM mq_clientes AS cl 
    INNER JOIN cre_solicitud AS sl
	ON cl.id_cli = sl.id_cli 
   LEFT JOIN credit_actSol AS actsol
	ON sl.activ_solicitada = actsol.id_act
   LEFT JOIN contactos AS cont 
  ON cont.id_cont = sl.id_cont 
    INNER JOIN cre_estadosol AS es
	ON es.id_est =sl.id_est
    INNER JOIN mq_usu AS us
	ON sl.id_usu=us.id_usu";

  if (((isset($_SESSION['rol']) && $_SESSION['rol'] == 100) || (isset($_POST['rol']) && $_POST['rol'] == 100)) || ((isset($_SESSION['rol']) && $_SESSION['rol'] == 500) || (isset($_POST['rol']) && $_POST['rol'] == 500))) {
    if (isset($_POST['id']) && $_POST['id'] != '') {
      $sql1 .= " AND us.id_usu=" . $_POST['id'];
    } else {
      $sql1 .= " AND us.id_usu=" . $_SESSION['id'];
    }
  }


  if ((isset($_SESSION['rol']) && $_SESSION['rol'] == 100 || (isset($_SESSION['rol']) && $_SESSION['rol'] == 500))) {
    $sql1 .= " ORDER BY sl.id_est=1,sl.id_est=2,sl.id_est=4,sl.id_est=3 ASC";
  } elseif ((isset($_SESSION['rol']) && $_SESSION['rol'] == 200)) {
    if ((isset($_SESSION['rol']) && $_SESSION['rol'] == 200) || (isset($_POST['rol']) && $_POST['rol'] == 200)) {
      $sql1 .= " AND sl.id_est!=1 ORDER BY sl.id_est=4,sl.id_est=3, sl.id_est=2,sl.id_est=7,sl.id_est=8 ASC";
    } else {
      $sql1 .= " ORDER BY sl.id_est=4,sl.id_est=3,sl.id_est=2,sl.id_est=1 ASC";
    }
  } elseif ((isset($_SESSION['rol']) && $_SESSION['rol'] == 300)) {
    if ((isset($_SESSION['rol']) && $_SESSION['rol'] == 300) || (isset($_POST['rol']) && $_POST['rol'] == 300)) {
      $sql1 .= " AND sl.id_est!=2 ORDER BY sl.id_est=1,sl.id_est=4, sl.id_est=3,sl.id_est=7,sl.id_est=8 ASC";
    } else {
      $sql1 .= " ORDER BY sl.id_est=4,sl.id_est=3,sl.id_est=1,sl.id_est=2 ASC";
    }
  }

  $query = $conexion->query($sql1);
//echo $sql1;
?>



<!-- use masterqu_intranet;
create VIEW creditos_view2 
AS SELECT sl.id_usu, us.id_reg, sl.id_sol, cl.nom_cli, sl.id_cont, cont.nom_cont, sl.fec_sol, sl.ase_com, sl.nom_atc, cl.id_cli, sl.fecha_crea, es.nom_est, sl.id_est, us.nom_usu, actsol.nom_act, sl.eml_enviado
	FROM mq_clientes AS cl 
    INNER JOIN cre_solicitud AS sl
	ON cl.id_cli = sl.id_cli 
   LEFT JOIN credit_actSol AS actsol
	ON sl.activ_solicitada = actsol.id_act
   LEFT JOIN contactos AS cont 
  ON cont.id_cont = sl.id_cont 
    INNER JOIN cre_estadosol AS es
	ON es.id_est =sl.id_est
    INNER JOIN mq_usu AS us
	ON sl.id_usu=us.id_usu -->