<?php
if (isset($_POST['id_usu'])) {
	include "../../conexion.php";
	include '../../resources/template/credentials.php';
} elseif (isset($_GET['id_usu'])) {
	include "../../conexion.php";
	include '../../resources/template/credentials.php';
}
switch ($action) {
	case 'Index':
		$mes2 = date("Y-m", strtotime($mes));
		$sqlest = "SELECT COUNT(est_cot) as 'cantidad', nom_est as estado, SUM(cost_cot) as total, grup_car
		FROM `cot_cotizaciones` cot, `cot_estados_cot` est,`mq_usu` us 
		WHERE  cot.est_cot= est.id_est
		AND cot.id_usu=us.id_usu
		AND cot.fec_coti LIKE '$mes%'";
		if ($id == '100') {
			$sqlest .= " AND grup_car IN(18) AND us.id_are = 7";
		} elseif ($id == '200') {
			$sqlest .= " AND grup_car IN(19) ";
		} elseif ($id == '300') {
			$sqlest .= " AND id_car IN(20) ";
		} else {
			$sqlest .= " AND cot.id_usu=" . $_SESSION['id'];
		}
		$sqlest .= " GROUP BY est_cot";
		$queryest = $conexion->query($sqlest);
// Aprobado 
		$sqlprec = "SELECT SUM(cost_cot)  as 'total' FROM `cot_cotizaciones` WHERE fec_coti LIKE '$mes%' AND est_cot=2";
		if ($id == '100') {
			$sqlprec .= " AND grup_car IN(18) AND us.id_are = 7 ";
		} elseif ($id == '200') {
			$sqlprec .= " AND grup_car IN(19) ";
		} elseif ($id == '300') {
			$sqlprec .= " AND id_car IN(20) ";
		} else {
			$sqlprec .= " AND cot_cotizaciones.id_usu=" . $_SESSION['id'];
		}
		$queryprec = $conexion->query($sqlprec);
///TOTAL

		$sqlprecTot = "SELECT SUM(cost_cot) as 'totCot',grup_car FROM `cot_cotizaciones`,`mq_usu` WHERE cot_cotizaciones.id_usu=mq_usu.id_usu AND fec_coti LIKE '$mes%'";
		if ($id == '100') {
			$sqlprecTot .= " AND grup_car IN(18) AND us.id_are = 7";
		} elseif ($id == '200') {
			$sqlprecTot .= " AND grup_car IN(19) ";
		} elseif ($id == '300') {
			$sqlprecTot .= " AND grup_car IN(20) " ;
		} else {
			$sqlprecTot .= " AND cot_cotizaciones.id_usu=" . $_SESSION['id'];
		}
		$queryprecTot = $conexion->query($sqlprecTot);
		$precTot = $queryprecTot-> fetch(PDO::FETCH_ASSOC);
		/*if ($_SESSION['id'] ==1032472569){
			echo $sqlest; 
			echo '---------------- ';
			ECHO $sqlprecTot;
			echo '---------------- ';
			echo $sqlprec;
		}*/
		break;

	case 'POST':
		$mes2 = date("Y-m", strtotime($_POST['mes2']));
		$sqlest = "SELECT COUNT(cot.est_cot) as 'cantidad',est.nom_est as 'estado', SUM(cot.cost_cot) as 'total'";
		if ($_POST["id_usu"] == "100" || $_POST["id_usu"] == "200" || $_POST["id_usu"] == "300") {
			$sqlest .= ",grup_car FROM `cot_cotizaciones` cot, `cot_estados_cot` est, `mq_usu` us
				WHERE  cot.est_cot= est.id_est
				AND cot.id_usu=us.id_usu";
			if ($_POST["id_usu"] == '100') {
				$sqlest .= " AND grup_car IN(18) AND us.id_are = 7";
			} elseif ($_POST["id_usu"] == '200') {
				$sqlest .= " AND grup_car IN(19) ";
			} elseif ($_POST["id_usu"] == '300') {
				$sqlest .= " AND grup_car IN(20) ";
				#AND cotizadores.id_car in (3,14,15) AND cotizadores.ced_cotz!= 101444545";
			}
			$sqlest .= " AND cot.fec_coti LIKE '" . $_POST['mes'] . "%'";
		} else {
			$sqlest .= " FROM cot_cotizaciones AS cot 
						INNER JOIN cot_estados_cot AS est ON cot.est_cot= est.id_est  
						INNER JOIN contactos AS cont ON cot.id_cont = cont.id_cont 
						WHERE cot.id_coti IS NOT NULL 
						AND cot.id_usu='" . $_POST['id_usu'] . "'
						AND cot.fec_coti LIKE '" . $_POST['mes'] . "%'";
		}
		if ($_POST["est_cot"] != "") {
			$sqlest .= " AND est.id_est='" . $_POST['est_cot'] . "'";
		}
		$sqlest .= " GROUP BY est_cot";
		$queryest = $conexion->query($sqlest);

		if ($_POST["id_usu"] == "100" || $_POST["id_usu"] == "200" || $_POST["id_usu"] == "300") {
			$sqlprec = "SELECT SUM(cost_cot)  as 'total', SUM(cost_cot) as 'totCot',grup_car FROM cot_cotizaciones AS cot 
										INNER JOIN cot_estados_cot AS est ON cot.est_cot= est.id_est  
										INNER JOIN contactos AS cont ON cot.id_cont = cont.id_cont 
										INNER JOIN mq_usu AS us ON cot.id_usu=us.id_usu
										WHERE cot.id_usu=us.id_usu
										AND cot.fec_coti LIKE '" . $_POST['mes'] . "%'
										AND cot.est_cot=2 ";

			if ($_POST["id_usu"] == '100') {
				$sqlprec .= " AND grup_car IN(18) AND us.id_are = 7";
			} elseif ($_POST["id_usu"] == '200') {
				$sqlprec .= " AND grup_car IN(19) ";
			} elseif ($_POST["id_usu"] == '300') {
				$sqlprec .= " AND grup_car IN(20) ";
			}
			$queryprec = $conexion->query($sqlprec);

			$sqlprecTot = "SELECT SUM(cost_cot) as 'totCot', grup_car FROM cot_cotizaciones AS cot 
										INNER JOIN cot_estados_cot AS est ON cot.est_cot= est.id_est  
										INNER JOIN contactos AS cont ON cot.id_cont = cont.id_cont 
										INNER JOIN mq_usu AS us ON cot.id_usu=us.id_usu
										AND cot.fec_coti LIKE '" . $_POST['mes'] . "%'";
			if ($_POST["id_usu"] == '100') {
				$sqlprecTot .= " AND grup_car IN(18) AND us.id_are = 7";
			} elseif ($_POST["id_usu"] == '200') {
				$sqlprecTot .= " AND grup_car IN(19) ";
			} elseif ($_POST["id_usu"] == '300') {
				$sqlprecTot .= " AND grup_car IN(20) ";
			}
			$queryprecTot = $conexion->query($sqlprecTot);
			$precTot = $queryprecTot-> fetch(PDO::FETCH_ASSOC);
		} else {
			$sqlprec = "SELECT SUM(cost_cot)  as 'total', SUM(cost_cot) as 'totCot'  
			FROM cot_cotizaciones AS cot 
			INNER JOIN cot_estados_cot AS est ON cot.est_cot= est.id_est  
			INNER JOIN contactos AS cont ON cot.id_cont = cont.id_cont 
			INNER JOIN mq_usu AS us ON cot.id_usu=us.id_usu
			WHERE cot.id_coti IS NOT NULL 
			AND cot.id_usu='" . $_POST['id_usu'] . "' 
			AND cot.est_cot=2 
			AND cot.fec_coti LIKE '" . $_POST['mes'] . "%'";
			$queryprec = $conexion->query($sqlprec);

			$sqlprecTot = "SELECT SUM(cost_cot) as 'totCot' 
			FROM cot_cotizaciones AS cot 
			INNER JOIN cot_estados_cot AS est ON cot.est_cot= est.id_est  
			INNER JOIN contactos AS cont ON cot.id_cont = cont.id_cont 
			INNER JOIN mq_usu AS us ON cot.id_usu=us.id_usu
			WHERE cot.id_coti IS NOT NULL 
			AND cot.id_usu='" . $_POST['id_usu'] . "' 
			AND cot.fec_coti LIKE '" . $_POST['mes'] . "%'";
			$queryprecTot = $conexion->query($sqlprecTot);
			$precTot = $queryprecTot-> fetch(PDO::FETCH_ASSOC);
		}
		
	/*echo 'POST';
		echo $sqlest;
		echo '---------';
		echo $sqlprec;
		echo '---------';
		echo $sqlprecTot;
		*/
		break;



	case 'GET':
		$mes2 = date("Y-m", strtotime($_GET['mes2']));
		$id = $_SESSION['id'];
		if ($id != $_GET["id"]) {
			$sql1 .= " AND cot.fec_coti LIKE '" . $_POST['mes'] . "%'";
			if ($_GET['id'] == "100") {
				$sql1 .= ' AND grup_car IN(18)';
			} elseif ($_GET['id'] == '200') {
				$sql1 .= ' AND grup_car IN(19)';
			} elseif ($_GET['id'] == '300') {
				$sql1 .= ' AND grup_car IN(20)';
			} else {
				$sql1 .= " AND cot.id_usu=\"$_GET[id]\"";
			}
		} else {
			$sql1 .= " AND cot.id_usu='" . $_SESSION['id'] . "' 
						AND cot.fec_coti LIKE '" . $_POST['mes'] . "%'";
		}
		if (isset($_GET["est"])) {
			$sql1 .= " AND cot.est_cot=\"$_GET[est]\" ";
		} elseif (isset($_GET["sol"])) {
			$sql1 .= " AND cot.sol_cot=\"$_GET[sol]\" ";
		}
		if (isset($_GET["id"])) {
			$sqlest = "SELECT COUNT(est_cot) as 'cantidad', nom_est as estado, SUM(cost_cot) as total,grup_car";
			$sqlest .= " FROM `cot_cotizaciones` cot, `cot_estados_cot` est, `mq_usu` as us
					WHERE  cot.est_cot= est.id_est
					AND cot.id_usu=us.id_usu
					AND cot.fec_coti LIKE '" . $_POST['mes'] . "%'";
			if (isset($_GET["est"]) && $_GET["est"] != "") {
				$sqlest .= " AND est.id_est='" . $_GET['est'] . "'";
			}
			if ($_GET['id'] == '100') {
				$sqlest .= ' AND grup_car IN(18) AND us.id_are = 7';
			} elseif ($_GET['id'] == '200') {
				$sqlest .= ' AND grup_car IN(19)';
			} elseif ($_GET['id'] == '300') {
				$sqlest .= ' AND grup_car IN(20)';
			} else {
				$sqlest .= " AND cot.id_usu='" . $_GET['id'] . "'";
			}
			$sqlest .= " GROUP BY est_cot";
			$queryest = $conexion->query($sqlest);

			$sqlprec = "SELECT SUM(prec_cot)  as 'total', SUM(cost_cot) as 'totCot',grup_car FROM `cot_cotizaciones` cot,`mq_usu` us WHERE cot.id_usu=us.id_usu AND est_cot=2 AND fec_coti LIKE '" . $_POST['mes'] . "%'";
			if ($_GET['id'] == '100') {
				$sqlprec .= ' AND grup_car IN(18)';
			} elseif ($_GET['id'] == '200') {
				$sqlprec .= ' AND grup_car IN(19)';
			} elseif ($_GET['id'] == '300') {
				$sqlprec .= ' AND grup_car IN(20)';
			} else {
				$sqlprec .= " AND cot.id_usu='" . $_GET['id'] . "'";
			}
			$queryprec = $conexion->query($sqlprec);

			$sqlprecTot = "SELECT SUM(cost_cot) as 'totCot',grup_car FROM `cot_cotizaciones` cot,`mq_usu` us WHERE cot.id_usu=us.id_usu AND fec_coti LIKE '" . $_POST['mes'] . "%'";
			if ($_GET['id'] == '100') {
				$sqlprecTot .= ' AND grup_car IN(18)';
			} elseif ($_GET['id'] == '200') {
				$sqlprecTot .= ' AND grup_car IN(19)';
			} elseif ($_GET['id'] == '300') {
				$sqlprecTot .= ' AND grup_car IN(20)';
			} else {
				$sqlprecTot .= " AND cot.id_usu='" . $_GET['id'] . "'";
			}
			$queryprecTot = $conexion->query($sqlprecTot);
			$precTot = $queryprecTot-> fetch(PDO::FETCH_ASSOC);
		}
		break;
}