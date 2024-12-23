<nav aria-label="breadcrumb">
  <ol class="breadcrumb mb-0 ">
    <li class="breadcrumb-item"><a href="../home/">Inicio</a></li>
    <li class="breadcrumb-item">Ventas</li>
    <li class="breadcrumb-item active" aria-current="page">Crédito</li>
  </ol>
</nav>
<div class="col-md-12">
  <div class="py-3">
    <h3>Crédito</h3>
  </div>
  <button type="button" onclick="newSolici(1,'CSolicitud De Crédito', '../creditoV2/tabsForm.php');" class="btn btn-danger my-3" data-bs-toggle="modal" data-bs-target="#largeModal">
    Crear crédito
  </button>
</div>

<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';

if (isset($_POST["buscar"])) {
  $buscar = $_POST["buscar"];
  $sql1 = "SELECT us.id_reg,sl.id_sol, cl.nom_cli,cl.con_cli, sl.fec_sol, sl.ase_com,cl.id_cli, es.nom_est,sl.id_est, cl.activ_solicitada,cl.rep_sac, activ_solicitada, us.nom_usu,sl.fecha_crea,sl.nom_atc
		FROM mq_clie cl , cre_solicitud sl, cre_estadosol es, mq_usu us
		WHERE cl.id_cli = sl.id_cli 
		AND es.id_est =sl.id_est
		AND( 
			id_sol    like '%$buscar%' OR 
			sl.id_cli like '%$buscar%' OR 
			nom_cli   like '%$buscar%' OR 
			ase_com   like '%$buscar%' OR 
			rep_sac   like '%$buscar%' OR 
   	activ_solicitada  like '%$buscar%')
		GROUP BY sl.id_sol";
  $query = $conexion->query($sql1);
  include 'tabla.php';
} else {
  if ((isset($_SESSION['rol']) && $_SESSION['rol'] == 200) || (isset($_POST['rol']) && $_POST['rol'] == 200) || (isset($_SESSION['rol']) && $_SESSION['rol'] == 300) || (isset($_POST['rol']) && $_POST['rol'] == 300)) {
    $sql1 = "SELECT us.id_reg,sl.id_sol, cl.nom_cli,cl.con_cli, sl.fec_sol, sl.ase_com,cl.id_cli, es.nom_est,sl.id_est, cl.activ_solicitada,cl.rep_sac, us.nom_usu,sl.fecha_crea,sl.nom_atc
				FROM mq_clie cl , cre_solicitud sl, cre_estadosol es, mq_usu us
				WHERE cl.id_cli= sl.id_cli 
				AND es.id_est=sl.id_est
				AND sl.id_usu=us.id_usu";
    if ((isset($_SESSION['rol']) && $_SESSION['rol'] == 200)) {
      $sql1 .= " AND sl.id_est=1";
    } elseif ((isset($_SESSION['rol']) && $_SESSION['rol'] == 300)) {
      $sql1 .= " AND sl.id_est=2";
    }
    $sql1 .= " GROUP BY sl.id_sol";
    $query = $conexion->query($sql1);
    include 'tabla.php';
    $sql1 = null;
    $query = null;
  }
  $sql1 = "SELECT sl.id_usu, us.id_reg, sl.id_sol, cl.nom_cli, cl.con_cli, sl.fec_sol, sl.ase_com, sl.nom_atc, cl.id_cli, sl.fecha_crea, es.nom_est, sl.id_est, cl.activ_solicitada, us.nom_usu
	FROM mq_clie AS cl 
    INNER JOIN cre_solicitud AS sl
	ON cl.id_cli = sl.id_cli 
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
}
//echo $sql1;
?>