<?php

$action = $_POST['action'];
switch ($action) {
	case 'controlCoti':
		$id = $_POST['id_usu2'];
		$anio = substr($_POST['mesR'], 0, 4);
		$month = substr($_POST['mesR'], 5, 6);
		$mes2 = substr($_POST['mesR2'], 5, 6);
		$sql = "SELECT COUNT(id_coti),est_cot , monthname(fec_coti), month(fec_coti),grup_car
			FROM cot_cotizaciones cot, mq_usu us
 			WHERE cot.id_usu=us.id_usu
			GROUP by est_cot,month(fec_coti)
			order by month(fec_coti)";

		if ($id == '100') {
			$sql .= " AND grup_car IN(18) us.id_are = 7";
		} elseif ($id == '200') {
			$sql .= " AND grup_car IN(19)";
		} elseif ($id == '300') {
			$sql .= " AND grup_car IN(20)";
		} else {
			$sql .= " AND cot.id_usu=$id";
		}

		function total($conexion, $id, $month, $anio){
			$sql = "SELECT SUM(cost_cot) as total, grup_car
					FROM cot_cotizaciones AS cot
					INNER JOIN mq_usu AS us
					ON cot.id_usu = us.id_usu
					INNER JOIN mq_clientes AS cli
					ON cot.id_cli = cli.id_cli
					INNER JOIN cot_tip_cotizacion AS tip
					ON cot.id_tip_cot = tip.id_tip_cot
					INNER JOIN contactos AS cont
					ON cot.id_cont = cont.id_cont
					WHERE cot.id_coti IS NOT NULL";
					if ($id == '100') {
						$sql .= " AND grup_car IN(18) ";
					} elseif ($id == '200') {
						$sql .= " AND grup_car IN(19)";
					} elseif ($id == '300') {
						$sql .= " AND grup_car IN(20)";
					} else {
						$sql .= " AND cot.id_usu=$id";
					}
			$sql .= " AND MONTH(fec_coti)=$month and year(fec_coti)=$anio";
			$query = $conexion->query($sql);
			$r = $query-> fetch(PDO::FETCH_ASSOC);
			if ($r["total"] == 0) {
				return 0;
			} else {
				return $r["total"];
			}
        }

		function totalApr($conexion, $id, $month, $anio)
		{

		$sql = "SELECT SUM(cost_cot) as total, grup_car
		FROM cot_cotizaciones AS cot
		 INNER JOIN mq_usu AS us
		 ON cot.id_usu = us.id_usu
		 INNER JOIN mq_clientes AS cli
		 ON cot.id_cli = cli.id_cli
		 INNER JOIN cot_tip_cotizacion AS tip
		 ON cot.id_tip_cot = tip.id_tip_cot
		 INNER JOIN contactos AS cont
		 ON cot.id_cont = cont.id_cont
		 WHERE cot.id_coti IS NOT NULL
		  AND est_cot='2'";
		 if ($id == '100') {
			 $sql .= " AND grup_car IN(18)";
		 } elseif ($id == '200') {
			 $sql .= " AND grup_car IN(19)";
		 } elseif ($id == '300') {
			 $sql .= " AND grup_car IN(20)";
		 } else {
			 $sql .= " AND cot.id_usu=$id";
		 }
		$sql .= " AND MONTH(fec_coti)=$month and year(fec_coti)=$anio";
		$query = $conexion->query($sql);
		$r = $query-> fetch(PDO::FETCH_ASSOC);
		//echo ($sql);
		if ($r["total"] == 0) {
			return 0;
		} else {
			return $r["total"];
		}
		}

		function cotXMes($conexion, $id, $month, $anio)
		{
				$sql = "SELECT count(cost_cot) as total, grup_car
						   FROM cot_cotizaciones AS cot
						INNER JOIN mq_usu AS us
						ON cot.id_usu = us.id_usu
						INNER JOIN mq_clientes AS cli
						ON cot.id_cli = cli.id_cli
						INNER JOIN cot_tip_cotizacion AS tip
						ON cot.id_tip_cot = tip.id_tip_cot
						INNER JOIN contactos AS cont
						ON cot.id_cont = cont.id_cont
						WHERE cot.id_coti IS NOT NULL";
				if ($id == '100') {
					$sql .= " AND grup_car IN(18)";
				} elseif ($id == '200') {
					$sql .= " AND grup_car IN(19)";
				} elseif ($id == '300') {
					$sql .= " AND grup_car IN(20)";
				} else {
					$sql .= " AND cot.id_usu=$id";
				}
				$sql .= " AND MONTH(fec_coti)=$month and year(fec_coti)=$anio";
				$query = $conexion->query($sql);
				$r = $query-> fetch(PDO::FETCH_ASSOC);
				if ($r["total"] == 0) {
					return 0;
				} else {
					return $r["total"];
				}
			}

		function estXMes($conexion, $id, $month, $est, $anio)
		{

			$sql = "SELECT count(est_cot) as total, grup_car
					FROM cot_cotizaciones AS cot
					INNER JOIN mq_usu AS us
					ON cot.id_usu = us.id_usu
					INNER JOIN mq_clientes AS cli
					ON cot.id_cli = cli.id_cli
					INNER JOIN cot_tip_cotizacion AS tip
					ON cot.id_tip_cot = tip.id_tip_cot
					INNER JOIN contactos AS cont
					ON cot.id_cont = cont.id_cont
					WHERE cot.id_coti IS NOT NULL";
					if ($id == '100') {
						$sql .= " AND grup_car IN(18) us.id_are = 7";
					} elseif ($id == '200') {
						$sql .= " AND grup_car IN(19)";
					} elseif ($id == '300') {
						$sql .= " AND grup_car IN(20)";
					} else {
						$sql .= " AND cot.id_usu=$id";
					}
			$sql .= " AND est_cot=$est AND MONTH(fec_coti)=$month and year(fec_coti)=$anio";

			$query = $conexion->query($sql);
			$r = $query-> fetch(PDO::FETCH_ASSOC);
			if ($r["total"] == 0) {
				return 0;
			} else {
				return $r["total"];
			}
		}
		function solXMes($conexion, $id, $month, $sol, $anio)
		{

			$sql = "SELECT count(sol_cot) as total, grup_car
					FROM cot_cotizaciones AS cot
					INNER JOIN mq_usu AS us
					ON cot.id_usu = us.id_usu
					INNER JOIN mq_clientes AS cli
					ON cot.id_cli = cli.id_cli
					INNER JOIN cot_tip_cotizacion AS tip
					ON cot.id_tip_cot = tip.id_tip_cot
					INNER JOIN contactos AS cont
					ON cot.id_cont = cont.id_cont
					WHERE cot.id_coti IS NOT NULL";
					if ($id == '100') {
						$sql .= " AND grup_car IN(18) ";
					} elseif ($id == '200') {
						$sql .= " AND grup_car IN(19)";
					} elseif ($id == '300') {
						$sql .= " AND grup_car IN(20)";
					} else {
						$sql .= " AND cot.id_usu=$id";
					}
			$sql .= " AND sol_cot=$sol AND MONTH(fec_coti)=$month and year(fec_coti)=$anio";
			$query = $conexion->query($sql);
			$r = $query-> fetch(PDO::FETCH_ASSOC);
			if ($r["total"] == 0) {
				return 0;
			} else {
				return $r["total"];
			}
		}

		function porcentaje($numero1, $numero2)
		{
			if ($numero2 == 0) {
				return 0;
			} else {
				return number_format($numero1 * 100 / $numero2);
			}
		}


		function cumpMes($conexion, $id, $month, $anio)
		{
			$sql = "SELECT count(id_coti) as total, grup_car
					FROM cot_cotizaciones AS cot
					INNER JOIN mq_usu AS us
					ON cot.id_usu = us.id_usu
					INNER JOIN mq_clientes AS cli
					ON cot.id_cli = cli.id_cli
					INNER JOIN cot_tip_cotizacion AS tip
					ON cot.id_tip_cot = tip.id_tip_cot
					INNER JOIN contactos AS cont
					ON cot.id_cont = cont.id_cont
					WHERE cot.id_coti IS NOT NULL";
					if ($id == '100') {
						$sql .= " AND grup_car IN(18) ";
					} elseif ($id == '200') {
						$sql .= " AND grup_car IN(19)";
					} elseif ($id == '300') {
						$sql .= " AND grup_car IN(20)";
					} else {
						$sql .= " AND cot.id_usu=$id";
					}
			$sql .= " AND DATEDIFF(fec_coti,env_cot)=0 AND MONTH(fec_coti)=$month and year(fec_coti)=$anio";
			$query = $conexion->query($sql);
			$r = $query-> fetch(PDO::FETCH_ASSOC);
			if ($r["total"] == 0) {
				return 0;
			} else {
				return $r["total"];
			}
		}

		function llamMes($conexion, $id, $month, $anio)
		{
			$sql = "SELECT sum(llam_cot) as total, grup_car
					FROM cot_cotizaciones AS cot
					INNER JOIN mq_usu AS us
					ON cot.id_usu = us.id_usu
					INNER JOIN mq_clientes AS cli
					ON cot.id_cli = cli.id_cli
					INNER JOIN cot_tip_cotizacion AS tip
					ON cot.id_tip_cot = tip.id_tip_cot
					INNER JOIN contactos AS cont
					ON cot.id_cont = cont.id_cont
					WHERE cot.id_coti IS NOT NULL";
					if ($id == '100') {
						$sql .= " AND grup_car IN(18) ";
					} elseif ($id == '200') {
						$sql .= " AND grup_car IN(19)";
					} elseif ($id == '300') {
						$sql .= " AND grup_car IN(20)";
					} else {
						$sql .= " AND cot.id_usu=$id";
					}
			$sql .= " AND MONTH(fec_coti)=$month and year(fec_coti)=$anio";
			$query = $conexion->query($sql);
			$r = $query-> fetch(PDO::FETCH_ASSOC);
			if ($r["total"] == 0) {
				return 0;
			} else {
				return $r["total"];
			}
		}

		$mes = 12;
		$query = $conexion->query($sql);

		break;

	case 'reporteCoti':
		$sql1 = "SELECT *, Date(fec_coti) as fecha_dl, DAY(fec_coti) as fec_sol, DAY(env_cot) as env_cot, nom_cns
			                FROM cot_cotizaciones cot, mq_usu us, mq_clientes cli, cot_tip_cotizacion tip, contactos cont
			                WHERE cot.id_usu=us.id_usu
			                AND cot.id_cli=cli.id_cli
			                AND cli.id_cli=cont.id_cli
			                AND cot.id_cont=cont.id_cont
			                AND cot.id_tip_cot=tip.id_tip_cot";
		if (isset($_POST["id_usu"])) {
			if ($_POST["id_usu"] == "100" || $_POST["id_usu"] == "200" || $_POST["id_usu"] == "300") {
				$sql1 .= " AND cot.fec_coti LIKE '" . $_POST['mes'] . "%'";
				if ($_POST["id_usu"] == "100") {
					$sql1 .= " AND grup_car IN(18) AND us.id_are = 7  ";
				} elseif ($_POST["id_usu"] == "200") {
					$sql1 .= " AND grup_car IN(19)";
				} else {
					$sql1 .= " AND grup_car IN(20)";
				}
			} else {
				$sql1 .= " AND cot.id_usu=\"$_POST[id_usu]\" 
			                AND cot.fec_coti LIKE '" . $_POST['mes'] . "%'";
			}
		} else {
			$sql1 .= " AND cot.id_usu=$id 
			            AND cot.fec_coti LIKE '$mes%'";
		}
		if (isset($_POST["est_cot"]) && $_POST["est_cot"] != "") {
			$sql1 .= " AND cot.est_cot=\"$_POST[est_cot]\" ";
		}

		$query = $conexion->query($sql1);
	
		if ($_POST["id_usu"] != "100") {
			$sql2 = "SELECT * FROM mq_usu us WHERE id_usu=\"$_POST[id_usu]\"";
			$query2 = $conexion->query($sql2);
			$r2 = $query2-> fetch(PDO::FETCH_ASSOC);
		}

// conteo 
		$sqlcount="SELECT COUNT(id_coti) as conteo
		FROM  cot_cotizaciones cot, mq_usu us, mq_clientes cli, cot_tip_cotizacion tip, contactos cont
		WHERE cot.id_usu=us.id_usu
		AND cot.id_cli=cli.id_cli
		AND cli.id_cli=cont.id_cli
		AND cot.id_cont=cont.id_cont
		AND cot.id_tip_cot=tip.id_tip_cot";
		if (isset($_POST["id_usu"])) {
			if ($_POST["id_usu"] == "100" || $_POST["id_usu"] == "200" || $_POST["id_usu"] == "300") {
				$sqlcount .= " AND cot.fec_coti LIKE '" . $_POST['mes'] . "%'";
				if ($_POST["id_usu"] == "100") {
					$sqlcount .= " AND grup_car IN(18) AND us.id_are = 7  ";
				} elseif ($_POST["id_usu"] == "200") {
					$sqlcount .= " AND grup_car IN(19)";
				} else {
					$sqlcount .= " AND grup_car IN(20)";
				}
			} else {
				$sqlcount .= " AND cot.id_usu=\"$_POST[id_usu]\" 
							   AND cot.fec_coti LIKE '" . $_POST['mes'] . "%'";
			}
		} else {
			$sqlcount .= " AND cot.id_usu=$id 
			            AND cot.fec_coti LIKE '$mes%'";
		}
		$querycount=$conexion->query($sqlcount);
		$rC=$querycount-> fetch(PDO::FETCH_ASSOC);
		$conteoM= $rC['conteo'];
//FILAS DESPUES DEL CICLO 
		//Columna inicial 
		$columnaIn= $conteoM + 11;
		//Columna Total
		$columEn= $conteoM + 8;
		$columnatot= $conteoM + 9;
		// Columna email
		$colum1= $columnaIn + 1;
		// Columna Telefono 
		$colum2= $colum1 + 1;
		// En espera
		$colum3= $colum2 + 1;
		//total y perdido
		$colum4= $colum3 + 1;
		//Cumplimiento de entregas
		$colum5 = $colum4 + 3;
		$colum6 = $colum5 + 1;
		$colum7 = $colum6 + 1;
		// Total de llamadas 
		$colum8 = $colum7 + 2;
///CONSULTA DE CONTEO DE ESTADOS
// PENDIENTE 
		$sqlPen="SELECT COUNT(id_coti) as pendiente
		FROM cot_cotizaciones cot, mq_usu us, mq_clientes cli, cot_tip_cotizacion tip, contactos cont
		WHERE cot.id_usu=us.id_usu
		AND cot.id_cli=cli.id_cli
		AND cli.id_cli=cont.id_cli
		AND cot.id_cont=cont.id_cont
		AND cot.id_tip_cot=tip.id_tip_cot
		AND cot.est_cot = '1'";
		if (isset($_POST["id_usu"])) {
			if ($_POST["id_usu"] == "100" || $_POST["id_usu"] == "200" || $_POST["id_usu"] == "300") {
				$sqlPen .= " AND cot.fec_coti LIKE '" . $_POST['mes'] . "%'";
				if ($_POST["id_usu"] == "100") {
					$sqlPen .= " AND grup_car IN(18) AND us.id_are = 7  ";
				} elseif ($_POST["id_usu"] == "200") {
					$sqlPen .= " AND grup_car IN(19)";
				} else {
					$sqlPen .= " AND grup_car IN(20)";
				}
			} else {
				$sqlPen .= "AND	cot.id_usu=\"$_POST[id_usu]\" 
							AND cot.fec_coti LIKE '" . $_POST['mes'] . "%'";
			}
		} else {
			$sqlPen .= "AND cot.id_usu=$id 
						AND cot.fec_coti LIKE '$mes%'";
		}
		$queryPen=$conexion->query($sqlPen);
		$rP=$queryPen-> fetch(PDO::FETCH_ASSOC);
		$pend= $rP['pendiente'];
//APROBADO Y SUMA DE LOS PRECIOS DE LA COTIZACION 
		$sqlAp="SELECT COUNT(id_coti) as aprobado, SUM(cost_cot) AS TOT
		FROM cot_cotizaciones cot, mq_usu us, mq_clientes cli, cot_tip_cotizacion tip, contactos cont
		WHERE cot.id_usu=us.id_usu
		AND cot.id_cli=cli.id_cli
		AND cli.id_cli=cont.id_cli
		AND cot.id_cont=cont.id_cont
		AND cot.id_tip_cot=tip.id_tip_cot
		AND cot.est_cot = '2'";
		if (isset($_POST["id_usu"])) {
			if ($_POST["id_usu"] == "100" || $_POST["id_usu"] == "200" || $_POST["id_usu"] == "300") {
				$sqlAp .= " AND cot.fec_coti LIKE '" . $_POST['mes'] . "%'";
				if ($_POST["id_usu"] == "100") {
					$sqlAp .= " AND grup_car IN(18) AND us.id_are = 7  ";
				} elseif ($_POST["id_usu"] == "200") {
					$sqlAp .= " AND grup_car IN(19)";
				} else {
					$sqlAp .= " AND grup_car IN(20)";
				}
			} else {
				$sqlAp .= " AND	cot.id_usu=\"$_POST[id_usu]\" 
							AND cot.fec_coti LIKE '" . $_POST['mes'] . "%'";
			}
		} else {
			$sqlAp .= " AND cot.id_usu=$id 
						AND cot.fec_coti LIKE '$mes%'";
		}
		$queryAp=$conexion->query($sqlAp);
		$rA=$queryAp-> fetch(PDO::FETCH_ASSOC);
		$aprob= $rA['aprobado'];
		$total= $rA['TOT'];
//RECHAZADO
		$sqlRe="SELECT COUNT(id_coti) as rechazado
		FROM cot_cotizaciones cot, mq_usu us, mq_clientes cli, cot_tip_cotizacion tip, contactos cont
		WHERE cot.id_usu=us.id_usu
		AND cot.id_cli=cli.id_cli
		AND cli.id_cli=cont.id_cli
		AND cot.id_cont=cont.id_cont
		AND cot.id_tip_cot=tip.id_tip_cot
		AND cot.est_cot = '3'";
		if (isset($_POST["id_usu"])) {
			if ($_POST["id_usu"] == "100" || $_POST["id_usu"] == "200" || $_POST["id_usu"] == "300") {
				$sqlRe .= " AND cot.fec_coti LIKE '" . $_POST['mes'] . "%'";
				if ($_POST["id_usu"] == "100") {
					$sqlRe .= " AND grup_car IN(18) AND us.id_are = 7  ";
				} elseif ($_POST["id_usu"] == "200") {
					$sqlRe .= " AND grup_car IN(19)";
				} else {
					$sqlRe .= " AND grup_car IN(20)";
				}
			} else {
				$sqlRe .= " AND	cot.id_usu=\"$_POST[id_usu]\" 
							AND cot.fec_coti LIKE '" . $_POST['mes'] . "%'";
			}
		} else {
			$sqlRe .= " AND cot.id_usu=$id 
						AND cot.fec_coti LIKE '$mes%'";
		}
		$queryRe=$conexion->query($sqlRe);
		$rR=$queryRe-> fetch(PDO::FETCH_ASSOC);
		$rech= $rR['rechazado'];
// Actualizacion de precios 
		$sqlActu="SELECT COUNT(id_coti) as actualizado
		FROM cot_cotizaciones cot, mq_usu us, mq_clientes cli, cot_tip_cotizacion tip, contactos cont
		WHERE cot.id_usu=us.id_usu
		AND cot.id_cli=cli.id_cli
		AND cli.id_cli=cont.id_cli
		AND cot.id_cont=cont.id_cont
		AND cot.id_tip_cot=tip.id_tip_cot
		AND cot.est_cot = '4'";
		if (isset($_POST["id_usu"])) {
			if ($_POST["id_usu"] == "100" || $_POST["id_usu"] == "200" || $_POST["id_usu"] == "300") {
				$sqlActu .= " AND cot.fec_coti LIKE '" . $_POST['mes'] . "%'";
				if ($_POST["id_usu"] == "100") {
					$sqlActu .= " AND grup_car IN(18) AND us.id_are = 7  ";
				} elseif ($_POST["id_usu"] == "200") {
					$sqlActu .= " AND grup_car IN(19)";
				} else {
					$sqlActu .= " AND grup_car IN(20)";
				}
			} else {
				$sqlActu .= " AND	cot.id_usu=\"$_POST[id_usu]\" 
							AND cot.fec_coti LIKE '" . $_POST['mes'] . "%'";
			}
		} else {
			$sqlActu .= " AND cot.id_usu=$id 
						AND cot.fec_coti LIKE '$mes%'";
		}
		$queryActu=$conexion->query($sqlActu);
		$rAct=$queryActu-> fetch(PDO::FETCH_ASSOC);
		$actua= $rAct['actualizado'];

// CONTEO A LO QUE SOLICITA 
// EMAIL
		$sqlEma="SELECT COUNT(id_coti) as email
		FROM cot_cotizaciones cot, mq_usu us, mq_clientes cli, cot_tip_cotizacion tip, contactos cont
		WHERE cot.id_usu=us.id_usu
		AND cot.id_cli=cli.id_cli
		AND cli.id_cli=cont.id_cli
		AND cot.id_cont=cont.id_cont
		AND cot.id_tip_cot=tip.id_tip_cot
		AND cot.sol_cot = '2'";
		if (isset($_POST["id_usu"])) {
			if ($_POST["id_usu"] == "100" || $_POST["id_usu"] == "200" || $_POST["id_usu"] == "300") {
				$sqlEma .= " AND cot.fec_coti LIKE '" . $_POST['mes'] . "%'";
				if ($_POST["id_usu"] == "100") {
					$sqlEma .= " AND grup_car IN(18) ";
				} elseif ($_POST["id_usu"] == "200") {
					$sqlEma .= " AND grup_car IN(19)";
				} else {
					$sqlEma .= " AND grup_car IN(20)";
				}
			} else {
				$sqlEma .= " AND cot.id_usu=\"$_POST[id_usu]\" 
							AND cot.fec_coti LIKE '" . $_POST['mes'] . "%'";
			}
		} else {
			$sqlEma .= " AND cot.id_usu=$id 
						AND cot.fec_coti LIKE '$mes%'";
		}
		$queryEma=$conexion->query($sqlEma);
		$rE=$queryEma-> fetch(PDO::FETCH_ASSOC);
		$email= $rE['email'];


//TELEFONO 
		$sqlTel="SELECT COUNT(id_coti) as tel
		FROM cot_cotizaciones cot, mq_usu us, mq_clientes cli, cot_tip_cotizacion tip, contactos cont
		WHERE cot.id_usu=us.id_usu
		AND cot.id_cli=cli.id_cli
		AND cli.id_cli=cont.id_cli
		AND cot.id_cont=cont.id_cont
		AND cot.id_tip_cot=tip.id_tip_cot
		AND cot.sol_cot = '1'";
		if (isset($_POST["id_usu"])) {
			if ($_POST["id_usu"] == "100" || $_POST["id_usu"] == "200" || $_POST["id_usu"] == "300") {
				$sqlTel.= " AND cot.fec_coti LIKE '" . $_POST['mes'] . "%'";
				if ($_POST["id_usu"] == "100") {
					$sqlTel.= " AND grup_car IN(18)";
				} elseif ($_POST["id_usu"] == "200") {
					$sqlTel .= " AND grup_car IN(19)";
				} else {
					$sqlTel .= " AND grup_car IN(20)";
				}
			} else {
				$sqlTel.= " AND cot.id_usu=\"$_POST[id_usu]\" 
							AND cot.fec_coti LIKE '" . $_POST['mes'] . "%'";
			}
		} else {
			$sqlTel .= " AND cot.id_usu=$id 
						AND cot.fec_coti LIKE '$mes%'";
		}
		$queryTel=$conexion->query($sqlTel);
		$rT=$queryTel-> fetch(PDO::FETCH_ASSOC);
		$Tel= $rT['tel'];

//EN ESPERA
		$sqlHold="SELECT COUNT(id_coti) as espera
		FROM cot_cotizaciones cot, mq_usu us, mq_clientes cli, cot_tip_cotizacion tip, contactos cont
		WHERE cot.id_usu=us.id_usu
		AND cot.id_cli=cli.id_cli
		AND cli.id_cli=cont.id_cli
		AND cot.id_cont=cont.id_cont
		AND cot.id_tip_cot=tip.id_tip_cot
		AND cot.sol_cot = '4'";
		if (isset($_POST["id_usu"])) {
			if ($_POST["id_usu"] == "100" || $_POST["id_usu"] == "200" || $_POST["id_usu"] == "300") {
				$sqlHold .= " AND cot.fec_coti LIKE '" . $_POST['mes'] . "%'";
				if ($_POST["id_usu"] == "100") {
					$sqlHold .= " AND grup_car IN(18)";
				} elseif ($_POST["id_usu"] == "200") {
					$sqlHold .= " AND grup_car IN(19)";
				} else {
					$sqlHold .= " AND grup_car IN(20)";
				}
			} else {
				$sqlHold .= " AND cot.id_usu=\"$_POST[id_usu]\" 
							AND cot.fec_coti LIKE '" . $_POST['mes'] . "%'";
			}
		} else {
			$sqlHold .= " AND cot.id_usu=$id 
						AND cot.fec_coti LIKE '$mes%'";
		}
		$queryHold=$conexion->query($sqlHold);
		$rH=$queryHold-> fetch(PDO::FETCH_ASSOC);
		$Hol= $rH['espera'];
// Conteo de las cotizaciones enviadas un dia habil 
		$sqldia1="SELECT COUNT(id_coti) as dia1
		FROM cot_cotizaciones cot, mq_usu us, mq_clientes cli, cot_tip_cotizacion tip, contactos cont
		WHERE cot.id_usu=us.id_usu
		AND cot.id_cli=cli.id_cli
		AND cli.id_cli=cont.id_cli
		AND cot.id_cont=cont.id_cont
		AND cot.id_tip_cot=tip.id_tip_cot
		AND cot.dif_diasEn = '1'";
		if (isset($_POST["id_usu"])) {
			if ($_POST["id_usu"] == "100" || $_POST["id_usu"] == "200" || $_POST["id_usu"] == "300") {
				$sqldia1 .= " AND cot.fec_coti LIKE '" . $_POST['mes'] . "%'";
				if ($_POST["id_usu"] == "100") {
					$sqldia1 .= " AND grup_car IN(18)";
				} elseif ($_POST["id_usu"] == "200") {
					$sqldia1 .= " AND grup_car IN(19)";
				} else {
					$sqldia1 .= " AND grup_car IN(20)";
				}
			} else {
				$sqldia1 .= " AND cot.id_usu=\"$_POST[id_usu]\" 
							AND cot.fec_coti LIKE '" . $_POST['mes'] . "%'";
			}
		} else {
			$sqldia1 .= " AND cot.id_usu=$id 
						AND cot.fec_coti LIKE '$mes%'";
		}
		$querydia1=$conexion->query($sqldia1);
		$rD1=$querydia1-> fetch(PDO::FETCH_ASSOC);
		$dia1= $rD1['dia1'];
// Conteo de las cotizaciones enviadaas despues de un dia  
		$sqldiam="SELECT COUNT(id_coti) as diam
		FROM cot_cotizaciones cot, mq_usu us, mq_clientes cli, cot_tip_cotizacion tip, contactos cont
		WHERE cot.id_usu=us.id_usu
		AND cot.id_cli=cli.id_cli
		AND cli.id_cli=cont.id_cli
		AND cot.id_cont=cont.id_cont
		AND cot.id_tip_cot=tip.id_tip_cot
		AND cot.dif_diasEn != '1'";
		if (isset($_POST["id_usu"])) {
			if ($_POST["id_usu"] == "100" || $_POST["id_usu"] == "200" || $_POST["id_usu"] == "300") {
				$sqldiam .= " AND cot.fec_coti LIKE '" . $_POST['mes'] . "%'";
				if ($_POST["id_usu"] == "100") {
					$sqldiam .= " AND grup_car IN(18)";
				} elseif ($_POST["id_usu"] == "200") {
					$sqldiam .= " AND grup_car IN(19)";
				} else {
					$sqldiam .= " AND grup_car IN(20)";
				}
			} else {
				$sqldiam .= " AND cot.id_usu=\"$_POST[id_usu]\" 
							AND cot.fec_coti LIKE '" . $_POST['mes'] . "%'";
			}
		} else {
			$sqldiam .= " AND cot.id_usu=$id 
						AND cot.fec_coti LIKE '$mes%'";
		}
		$querydiam=$conexion->query($sqldiam);
		$rm=$querydiam-> fetch(PDO::FETCH_ASSOC);
		$diam= $rm['diam'];
// conteo de las llamadas 
	$sqlllam="SELECT SUM(llam_cot) as llam
		FROM cot_cotizaciones cot, mq_usu us, mq_clientes cli, cot_tip_cotizacion tip, contactos cont
		WHERE cot.id_usu=us.id_usu
		AND cot.id_cli=cli.id_cli
		AND cli.id_cli=cont.id_cli
		AND cot.id_cont=cont.id_cont
		AND cot.id_tip_cot=tip.id_tip_cot ";
		if (isset($_POST["id_usu"])) {
			if ($_POST["id_usu"] == "100" || $_POST["id_usu"] == "200" || $_POST["id_usu"] == "300") {
				$sqlllam .= " AND cot.fec_coti LIKE '" . $_POST['mes'] . "%'";
				if ($_POST["id_usu"] == "100") {
					$sqlllam .= " AND grup_car IN(18)";
				} elseif ($_POST["id_usu"] == "200") {
					$sqlllam .= " AND grup_car IN(19)";
				} else {
					$sqlllam .= " AND grup_car IN(20)";
				}
			} else {
				$sqlllam .= " AND cot.id_usu=\"$_POST[id_usu]\" 
							AND cot.fec_coti LIKE '" . $_POST['mes'] . "%'";
			}
		} else {
			$sqlllam .= " AND cot.id_usu=$id 
						AND cot.fec_coti LIKE '$mes%'";
		}
		$queryllam=$conexion->query($sqlllam);
		$rlla=$queryllam-> fetch(PDO::FETCH_ASSOC);
		$llam= $rlla['llam'];
	break;

//////Anual
	case 'anual':
		$mesA = $_POST['mes'];
		$mesAn = substr($mesA, 0, 4);
		$sql1 = "SELECT *, Date(fec_coti) as fecha_dl, DAY(fec_coti) as fec_sol, DAY(env_cot) as env_cot, nom_cns
		FROM cot_cotizaciones cot, mq_usu us, mq_clientes cli, cot_tip_cotizacion tip, contactos cont
		WHERE cot.id_usu=us.id_usu
		AND cot.id_cli=cli.id_cli
		AND cli.id_cli=cont.id_cli
		AND cot.id_cont=cont.id_cont
		AND cot.id_tip_cot=tip.id_tip_cot";
		if (isset($_POST["id_usu"])) {
			if ($_POST["id_usu"] == "100" || $_POST["id_usu"] == "200" || $_POST["id_usu"] == "300") {
				$sql1 .= " AND cot.fec_coti LIKE '" . $mesAn . "-" . $an . "%'";
				if ($_POST["id_usu"] == "100") {
					$sql1 .= " AND grup_car IN(18)";
				} elseif ($_POST["id_usu"] == "200") {
					$sql1 .= " AND grup_car IN(19)";
				} else {
					$sql1 .= " AND grup_car IN(20)";
				}
			} else {
				$sql1 .= " AND cot.id_usu=\"$_POST[id_usu]\" 
			                AND cot.fec_coti LIKE '" . $mesAn . "-" . $an . "%'";
			}
		} else {
			$sql1 .= " AND cot.id_usu=$id 
			            AND cot.fec_coti LIKE '$mes%'";
		}
		if (isset($_POST["est_cot"]) && $_POST["est_cot"] != "") {
			$sql1 .= " AND cot.est_cot=\"$_POST[est_cot]\" ";
		}

		$query = $conexion->query($sql1);
		if ($_POST["id_usu"] != "100") {
			$sql2 = "SELECT * FROM mq_usu us WHERE id_usu=\"$_POST[id_usu]\"";
			$query2 = $conexion->query($sql2);
			$r2 = $query2-> fetch(PDO::FETCH_ASSOC);
		}


		$sqlcount="SELECT COUNT(id_coti) as conteo
		FROM  cot_cotizaciones cot, mq_usu us, mq_clientes cli, cot_tip_cotizacion tip, contactos cont
		WHERE cot.id_usu=us.id_usu
		AND cot.id_cli=cli.id_cli
		AND cli.id_cli=cont.id_cli
		AND cot.id_cont=cont.id_cont
		AND cot.id_tip_cot=tip.id_tip_cot";
		if (isset($_POST["id_usu"])) {
			if ($_POST["id_usu"] == "100" || $_POST["id_usu"] == "200" || $_POST["id_usu"] == "300") {
				$sqlcount .= " AND cot.fec_coti LIKE '" . $mesAn . "-" . $an . "%'";
				if ($_POST["id_usu"] == "100") {
					$sqlcount .= " AND grup_car IN(18)";
				} elseif ($_POST["id_usu"] == "200") {
					$sqlcount .= " AND grup_car IN(19)";
				} else {
					$sqlcount .= " AND grup_car IN(20)";
				}
			} else {
				$sqlcount .= " AND cot.id_usu=\"$_POST[id_usu]\" 
			                AND cot.fec_coti LIKE '" . $mesAn . "-" . $an . "%'";
			}
		} else {
			$sqlcount .= " AND cot.id_usu=$id 
			            AND cot.fec_coti LIKE '$mes%'";
		}
		$querycount=$conexion->query($sqlcount);
		$rC=$querycount-> fetch(PDO::FETCH_ASSOC);
		$conteoM= $rC['conteo'];
//FILAS DESPUES DEL CICLO 
		//Columna inicial 
		$columnaIn= $conteoM + 11;
		//Columna Total
		$columEn= $conteoM + 8;
		$columnatot= $conteoM + 9;
		// Columna email
		$colum1= $columnaIn + 1;
		// Columna Telefono 
		$colum2= $colum1 + 1;
		// En espera
		$colum3= $colum2 + 1;
		//total y perdido
		$colum4= $colum3 + 1;
		//Cumplimiento de entregas
		$colum5 = $colum4 + 3;
		$colum6 = $colum5 + 1;
		$colum7 = $colum6 + 1;
		// Total de llamadas 
		$colum8 = $colum7 + 2;
///CONSULTA DE CONTEO DE ESTADOS
// PENDIENTE
		$sqlPen="SELECT COUNT(id_coti) as pendiente
		FROM cot_cotizaciones cot, mq_usu us, mq_clientes cli, cot_tip_cotizacion tip, contactos cont
		WHERE cot.id_usu=us.id_usu
		AND cot.id_cli=cli.id_cli
		AND cli.id_cli=cont.id_cli
		AND cot.id_cont=cont.id_cont
		AND cot.id_tip_cot=tip.id_tip_cot
		AND cot.est_cot = '1'";
		if (isset($_POST["id_usu"])) {
			if ($_POST["id_usu"] == "100" || $_POST["id_usu"] == "200" || $_POST["id_usu"] == "300") {
				$sqlPen .= " AND cot.fec_coti LIKE '" . $mesAn . "-" . $an . "%'";
				if ($_POST["id_usu"] == "100") {
					$sqlPen .= " AND grup_car IN(18)";
				} elseif ($_POST["id_usu"] == "200") {
					$sqlPen .= " AND grup_car IN(19)";
				} else {
					$sqlPen .= " AND grup_car IN(20)";
				}
			} else {
				$sqlPen .= " AND cot.id_usu=\"$_POST[id_usu]\" 
							AND cot.fec_coti LIKE '" . $mesAn . "-" . $an . "%'";
			}
		} else {
			$sqlPen .= " AND cot.id_usu=$id 
						AND cot.fec_coti LIKE '$mes%'";
		}
		$queryPen=$conexion->query($sqlPen);
		$rP=$queryPen-> fetch(PDO::FETCH_ASSOC);
		$pend= $rP['pendiente'];
//APROBADO 
		$sqlAp="SELECT COUNT(id_coti) as aprobado, SUM(cost_cot) AS TOT
		FROM cot_cotizaciones cot, mq_usu us, mq_clientes cli, cot_tip_cotizacion tip, contactos cont
		WHERE cot.id_usu=us.id_usu
		AND cot.id_cli=cli.id_cli
		AND cli.id_cli=cont.id_cli
		AND cot.id_cont=cont.id_cont
		AND cot.id_tip_cot=tip.id_tip_cot
		AND cot.est_cot = '2'";
		if (isset($_POST["id_usu"])) {
			if ($_POST["id_usu"] == "100" || $_POST["id_usu"] == "200" || $_POST["id_usu"] == "300") {
				$sqlAp .= " AND cot.fec_coti LIKE '" . $mesAn . "-" . $an . "%'";
				if ($_POST["id_usu"] == "100") {
					$sqlAp .= " AND grup_car IN(18)";
				} elseif ($_POST["id_usu"] == "200") {
					$sqlAp .= " AND grup_car IN(19)";
				} else {
					$sqlAp .= " AND grup_car IN(20)";
				}
			} else {
				$sqlAp .= " AND cot.id_usu=\"$_POST[id_usu]\" 
			                AND cot.fec_coti LIKE '" . $mesAn . "-" . $an . "%'";
			}
		} else {
			$sqlAp .= " AND cot.id_usu=$id 
			            AND cot.fec_coti LIKE '$mes%'";
		}
		$queryAp=$conexion->query($sqlAp);
		$rA=$queryAp-> fetch(PDO::FETCH_ASSOC);
		$aprob= $rA['aprobado'];
		$total= $rA['TOT'];
//RECHAZADO
		$sqlRe="SELECT COUNT(id_coti) as rechazado
		FROM cot_cotizaciones cot, mq_usu us, mq_clientes cli, cot_tip_cotizacion tip, contactos cont
		WHERE cot.id_usu=us.id_usu
		AND cot.id_cli=cli.id_cli
		AND cli.id_cli=cont.id_cli
		AND cot.id_cont=cont.id_cont
		AND cot.id_tip_cot=tip.id_tip_cot
		AND cot.est_cot = '3'";
		if (isset($_POST["id_usu"])) {
			if ($_POST["id_usu"] == "100" || $_POST["id_usu"] == "200" || $_POST["id_usu"] == "300") {
				$sqlRe .= " AND cot.fec_coti LIKE '" . $mesAn . "-" . $an . "%'";
				if ($_POST["id_usu"] == "100") {
					$sqlRe .= " AND grup_car IN(18)";
				} elseif ($_POST["id_usu"] == "200") {
					$sqlRe .= " AND grup_car IN(19)";
				} else {
					$sqlRe .= " AND grup_car IN(20)";
				}
			} else {
				$sqlRe .= " AND cot.id_usu=\"$_POST[id_usu]\" 
			                AND cot.fec_coti LIKE '" . $mesAn . "-" . $an . "%'";
			}
		} else {
			$sqlRe .= " AND cot.id_usu=$id 
			            AND cot.fec_coti LIKE '$mes%'";
		}
		$queryRe=$conexion->query($sqlRe);
		$rR=$queryRe-> fetch(PDO::FETCH_ASSOC);
		$rech= $rR['rechazado'];
// Actualizacion de precios 
		$sqlActu="SELECT COUNT(id_coti) as actualizado
		FROM cot_cotizaciones cot, mq_usu us, mq_clientes cli, cot_tip_cotizacion tip, contactos cont
		WHERE cot.id_usu=us.id_usu
		AND cot.id_cli=cli.id_cli
		AND cli.id_cli=cont.id_cli
		AND cot.id_cont=cont.id_cont
		AND cot.id_tip_cot=tip.id_tip_cot
		AND cot.est_cot = '4'";
		if (isset($_POST["id_usu"])) {
			if ($_POST["id_usu"] == "100" || $_POST["id_usu"] == "200" || $_POST["id_usu"] == "300") {
				$sqlActu .= " AND cot.fec_coti LIKE '" . $mesAn . "-" . $an . "%'";
				if ($_POST["id_usu"] == "100") {
					$sqlActu .= " AND grup_car IN(18)";
				} elseif ($_POST["id_usu"] == "200") {
					$sqlActu .= " AND grup_car IN(19)";
				} else {
					$sqlActu .= " AND grup_car IN(20)";
				}
			} else {
				$sqlActu .= " AND cot.id_usu=\"$_POST[id_usu]\" 
			                AND cot.fec_coti LIKE '" . $mesAn . "-" . $an . "%'";
			}
		} else {
			$sqlActu .= " AND cot.id_usu=$id 
			            AND cot.fec_coti LIKE '$mes%'";
		}
		$queryActu=$conexion->query($sqlActu);
		$rAct=$queryActu-> fetch(PDO::FETCH_ASSOC);
		$actua= $rAct['actualizado'];

// CONTEO A LO QUE SOLICITA 
// EMAIL
		$sqlEma="SELECT COUNT(id_coti) as email
		FROM cot_cotizaciones cot, mq_usu us, mq_clientes cli, cot_tip_cotizacion tip, contactos cont
		WHERE cot.id_usu=us.id_usu
		AND cot.id_cli=cli.id_cli
		AND cli.id_cli=cont.id_cli
		AND cot.id_cont=cont.id_cont
		AND cot.id_tip_cot=tip.id_tip_cot
		AND cot.sol_cot = '2'";
		if (isset($_POST["id_usu"])) {
			if ($_POST["id_usu"] == "100" || $_POST["id_usu"] == "200" || $_POST["id_usu"] == "300") {
				$sqlEma .= " AND cot.fec_coti LIKE '" . $mesAn . "-" . $an . "%'";
				if ($_POST["id_usu"] == "100") {
					$sqlEma .= " AND grup_car IN(18)";
				} elseif ($_POST["id_usu"] == "200") {
					$sqlEma .= " AND grup_car IN(19)";
				} else {
					$sqlEma .= " AND grup_car IN(20)";
				}
			} else {
				$sqlEma .= " AND cot.id_usu=\"$_POST[id_usu]\" 
			                AND cot.fec_coti LIKE '" . $mesAn . "-" . $an . "%'";
			}
		} else {
			$sqlEma .= " AND cot.id_usu=$id 
			            AND cot.fec_coti LIKE '$mes%'";
		}
		$queryEma=$conexion->query($sqlEma);
		$rE=$queryEma-> fetch(PDO::FETCH_ASSOC);
		$email= $rE['email'];


//TELEFONO 
		$sqlTel="SELECT COUNT(id_coti) as tel
		FROM cot_cotizaciones cot, mq_usu us, mq_clientes cli, cot_tip_cotizacion tip, contactos cont
		WHERE cot.id_usu=us.id_usu
		AND cot.id_cli=cli.id_cli
		AND cli.id_cli=cont.id_cli
		AND cot.id_cont=cont.id_cont
		AND cot.id_tip_cot=tip.id_tip_cot
		AND cot.sol_cot = '1'";
		if (isset($_POST["id_usu"])) {
			if ($_POST["id_usu"] == "100" || $_POST["id_usu"] == "200" || $_POST["id_usu"] == "300") {
				$sqlTel .= " AND cot.fec_coti LIKE '" . $mesAn . "-" . $an . "%'";
				if ($_POST["id_usu"] == "100") {
					$sqlTel .= " AND grup_car IN(18)";
				} elseif ($_POST["id_usu"] == "200") {
					$sqlTel .= " AND grup_car IN(19)";
				} else {
					$sqlTel .= " AND grup_car IN(20)";
				}
			} else {
				$sqlTel .= " AND cot.id_usu=\"$_POST[id_usu]\" 
			                AND cot.fec_coti LIKE '" . $mesAn . "-" . $an . "%'";
			}
		} else {
			$sqlTel .= " AND cot.id_usu=$id 
			            AND cot.fec_coti LIKE '$mes%'";
		}
		$queryTel=$conexion->query($sqlTel);
		$rT=$queryTel-> fetch(PDO::FETCH_ASSOC);
		$Tel= $rT['tel'];

//EN ESPERA
		$sqlHold="SELECT COUNT(id_coti) as espera
		FROM cot_cotizaciones cot, mq_usu us, mq_clientes cli, cot_tip_cotizacion tip, contactos cont
		WHERE cot.id_usu=us.id_usu
		AND cot.id_cli=cli.id_cli
		AND cli.id_cli=cont.id_cli
		AND cot.id_cont=cont.id_cont
		AND cot.id_tip_cot=tip.id_tip_cot
		AND cot.sol_cot = '4'";
		if (isset($_POST["id_usu"])) {
			if ($_POST["id_usu"] == "100" || $_POST["id_usu"] == "200" || $_POST["id_usu"] == "300") {
				$sqlHold .= " AND cot.fec_coti LIKE '" . $mesAn . "-" . $an . "%'";
				if ($_POST["id_usu"] == "100") {
					$sqlHold .= " AND grup_car IN(18)";
				} elseif ($_POST["id_usu"] == "200") {
					$sqlHold .= " AND grup_car IN(19)";
				} else {
					$sqlHold .= " AND grup_car IN(20)";
				}
			} else {
				$sqlHold .= " AND cot.id_usu=\"$_POST[id_usu]\" 
			                AND cot.fec_coti LIKE '" . $mesAn . "-" . $an . "%'";
			}
		} else {
			$sqlHold .= " AND cot.id_usu=$id 
			            AND cot.fec_coti LIKE '$mes%'";
		}
		$queryHold=$conexion->query($sqlHold);
		$rH=$queryHold-> fetch(PDO::FETCH_ASSOC);
		$Hol= $rH['espera'];
// Conteo de las cotizaciones enviadas un dia habil 
		$sqldia1="SELECT COUNT(id_coti) as dia1
		FROM cot_cotizaciones cot, mq_usu us, mq_clientes cli, cot_tip_cotizacion tip, contactos cont
		WHERE cot.id_usu=us.id_usu
		AND cot.id_cli=cli.id_cli
		AND cli.id_cli=cont.id_cli
		AND cot.id_cont=cont.id_cont
		AND cot.id_tip_cot=tip.id_tip_cot
		AND cot.dif_diasEn = '1'";
		if (isset($_POST["id_usu"])) {
			if ($_POST["id_usu"] == "100" || $_POST["id_usu"] == "200" || $_POST["id_usu"] == "300") {
				$sqldia1 .= " AND cot.fec_coti LIKE '" . $mesAn . "-" . $an . "%'";
				if ($_POST["id_usu"] == "100") {
					$sqldia1 .= " AND grup_car IN(18)";
				} elseif ($_POST["id_usu"] == "200") {
					$sqldia1 .= " AND grup_car IN(19)";
				} else {
					$sqldia1 .= " AND grup_car IN(20)";
				}
			} else {
				$sqldia1 .= " AND cot.id_usu=\"$_POST[id_usu]\" 
			                AND cot.fec_coti LIKE '" . $mesAn . "-" . $an . "%'";
			}
		} else {
			$sqldia1 .= " AND cot.id_usu=$id 
			            AND cot.fec_coti LIKE '$mes%'";
		}
		$querydia1=$conexion->query($sqldia1);
		$rD1=$querydia1-> fetch(PDO::FETCH_ASSOC);
		$dia1= $rD1['dia1'];
// Conteo de las cotizaciones enviadaas despues de un dia  
		$sqldiam="SELECT COUNT(id_coti) as diam
		FROM cot_cotizaciones cot, mq_usu us, mq_clientes cli, cot_tip_cotizacion tip, contactos cont
		WHERE cot.id_usu=us.id_usu
		AND cot.id_cli=cli.id_cli
		AND cli.id_cli=cont.id_cli
		AND cot.id_cont=cont.id_cont
		AND cot.id_tip_cot=tip.id_tip_cot
		AND cot.dif_diasEn != '1'";
		if (isset($_POST["id_usu"])) {
			if ($_POST["id_usu"] == "100" || $_POST["id_usu"] == "200" || $_POST["id_usu"] == "300") {
				$sqldiam .= " AND cot.fec_coti LIKE '" . $mesAn . "-" . $an . "%'";
				if ($_POST["id_usu"] == "100") {
					$sqldiam .= " AND grup_car IN(18)";
				} elseif ($_POST["id_usu"] == "200") {
					$sqldiam .= " AND grup_car IN(19)";
				} else {
					$sqldiam .= " AND grup_car IN(20)";
				}
			} else {
				$sqldiam .= " AND cot.id_usu=\"$_POST[id_usu]\" 
							AND cot.fec_coti LIKE '" . $mesAn . "-" . $an . "%'";
			}
		} else {
			$sqldiam .= " AND cot.id_usu=$id 
						AND cot.fec_coti LIKE '$mes%'";
		}
		$querydiam=$conexion->query($sqldiam);
		$rm=$querydiam-> fetch(PDO::FETCH_ASSOC);
		$diam= $rm['diam'];
//CONTEO DE LAS LLAMADAS
		$sqlllam="SELECT COUNT(id_coti) as llam
		FROM cot_cotizaciones cot, mq_usu us, mq_clientes cli, cot_tip_cotizacion tip, contactos cont
		WHERE cot.id_usu=us.id_usu
		AND cot.id_cli=cli.id_cli
		AND cli.id_cli=cont.id_cli
		AND cot.id_cont=cont.id_cont
		AND cot.id_tip_cot=tip.id_tip_cot
		AND cot.llam_cot IS NOT NULL ";
		if (isset($_POST["id_usu"])) {
			if ($_POST["id_usu"] == "100" || $_POST["id_usu"] == "200" || $_POST["id_usu"] == "300") {
				$sqlllam .= " AND cot.fec_coti LIKE '" . $mesAn . "-" . $an . "%'";
				if ($_POST["id_usu"] == "100") {
					$sqlllam .= " AND grup_car IN(18)";
				} elseif ($_POST["id_usu"] == "200") {
					$sqlllam .= " AND grup_car IN(19)";
				} else {
					$sqlllam .= " AND grup_car IN(20)";
				}
			} else {
				$sqlllam .= " AND cot.id_usu=\"$_POST[id_usu]\" 
							AND cot.fec_coti LIKE '" . $mesAn . "-" . $an . "%'";
			}
		} else {
			$sqlllam .= " AND cot.id_usu=$id 
						AND cot.fec_coti LIKE '$mes%'";
		}
		$queryllam=$conexion->query($sqlllam);
		$rlla=$queryllam-> fetch(PDO::FETCH_ASSOC);
		$llam= $rlla['llam'];
		break;
}
