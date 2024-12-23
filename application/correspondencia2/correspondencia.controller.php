<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d H:i:s");
$hora = date("H:i:s");
$hora = date("H:i:s");
//echo $_POST['action'];
function validar($value)
{
	if ($value == '' || is_null($value)) {
		return 'NULL';
	} else {
		return $value;
	}
}
if (isset($_POST['action'])) {
	switch ($_POST['action']) {
		case 'add':
			$file = "../../documentos/correspondencia/docum/";
			opendir($file);
			if (!empty($_FILES['fac_regi']['tmp_name'])) {
				$fac_regi = $_FILES['fac_regi']['name'];
				$destino = $file . $fac_regi;
				copy($_FILES['fac_regi']['tmp_name'], $destino);
			}
			
				//Si es los otros tipos de correspondencia:
				$sqlCorrIng = "INSERT INTO correspondencias
                                        (fech_cre,
                                        fech_ini,
                                        id_nom, 
										fec_ven, 
										conse_fac,
										num_facR, 
										id_bodeg, 
										my_process, 
										area_remit,
                                        id_usu,
                                        id_reg,
                                        id_rol,
                                        per_encarga,
                                        id_prove, 
                                        id_estSeg, 
										valor_tota, 
										concept_justifi, 
										sub_tota, 
										iva, 
										sop_factura) VALUES ('$fecha',
                                        '" . $_POST['fec_rec'] . "',  
                                        '" . $_POST['nom_fac'] . "',
										'" . validar($_POST['fec_ven']) . "',
										'" . validar($_POST['consec_fact']) . "',
										'" . validar($_POST['num_faR']) . "',
										'" . validar($_POST['num_bog']) . "',
										'" . validar($_POST['my_pro']) . "',
										'" . $_POST['area_n'] . "',
                                        '" . $_SESSION['id'] . "',
                                        '" . $_SESSION['reg'] . "',
                                        '" . $_SESSION['rol'] . "',
                                        '" . $_POST['per_enc'] . "',
                                        '" . $_POST['id_cli'] . "',
                                        '1',
										'" . validar($_POST['val']) . "',
										'" . validar($_POST['justi']) . "',
										'" . validar($_POST['subto']) . "',
										'" . validar($_POST['iva']) . "',
										'" . validar($fac_regi) . "')";

				$queryCorrIng = $conexion->query($sqlCorrIng);
				//Se consulta anterior correspondencia
				$sqlSeg = "SELECT * FROM correspondencias ORDER BY id_seg DESC ";
				$querySeg = $conexion->query($sqlSeg);
				$r = $querySeg-> fetch(PDO::FETCH_ASSOC);
				//Se inserta el seguimiento
				$sqlMov = "INSERT INTO seg_ingre_x_movi
                                       (id_seg,
                                        id_usu,
                                        id_estSeg,
                                        fech_cre,
                                        fecha_hora, 
                                        id_are,
                                        per_encarga,
                                        id_reg, 
                                        id_nom,
                                        id_prove)
                                        VALUES 
                                        ('" . $r['id_seg'] . "',
                                         '" . $_SESSION['id'] . "',
                                         '1',
                                         '$fecha',
                                         '" . $_POST['fec_rec'] . "',
                                         '" . $_POST['area_n'] . "',
                                         '" . $_POST['per_enc'] . "',
                                         '" . $_SESSION['reg'] . "',
                                         '" . $_POST['nom_fac'] . "',
                                         '" . $_POST['id_cli'] . "')";
				$queryMov = $conexion->query($sqlMov);
				if ($queryCorrIng != null && $queryMov != null) {
					echo "Correspondencia creada correctamente";
				} else {
					echo $sqlCorrIng . "<br>";
					echo $sqlMov;
					//echo $sqlTab;
					//echo  $sqlInPro;
					printf("Errormessage: %s\n", $conexion->error);
				}

				include 'email2.php';
			
			break;

		case 'password':
			$sqlPass = "SELECT con_usu FROM mq_usu WHERE id_usu=" . $_SESSION['id'];
			$queryPass = $conexion->query($sqlPass);
			$r = $queryPass-> fetch(PDO::FETCH_ASSOC);
			if (password_verify($_POST["val_con"], $r["con_usu"])) {
				echo 1;
			} else {
				echo 2;
			}
			break;

		case 'provedo':
			$sqlPro = "SELECT id_prove FROM mq_prove WHERE id_prove=" . $_POST['id_prove'];
			$queryPro = $conexion->query($sqlPro);
			if ($queryPro->rowCount() > 0) {
				echo 1;
			} else {
				echo 2;
			}
			break;
		case 'usuario':
			$sqlUsua = "SELECT nom_usu, id_usu FROM mq_usu WHERE id_usu!=" . $_SESSION['id'];
			$sqlUsua .= " AND id_are=" . $_POST['value'];
			$queryUsua = $conexion->query($sqlUsua);
			if ($queryUsua->rowCount() > 0) {
				echo '<option>Seleccionar</option>';
				while ($r = $queryUsua-> fetch(PDO::FETCH_ASSOC)) {
					echo "<option value=" . $r['id_usu'] . ">" . $r['nom_usu'] . "</option>";
				}
			}
			break;

		case 'updateRemit':
			$sqlIngmov = "INSERT INTO seg_ingre_x_movi
                                (id_seg,
                                id_usu,
                                id_estSeg,
                                fech_cre,
                                fecha_hora, 
                                id_are,
                                per_encarga,
                                id_reg,
                                id_nom,
                                id_prove)
                                VALUES 
                                ( '" . $_POST['id_seg'] . "',
                                        '" . $_SESSION['id'] . "',
                                        '2',
                                        '$fecha',
                                        '" . $_POST['fec_rec'] . "',
                                        '" . $_POST['area_n'] . "',
                                        '" . $_POST['per_enc'] . "',
                                        '" . $_SESSION['reg'] . "',
                                        '" . $_POST['id_nom'] . "',
                                        '" . $_POST['id_prove'] . "')";
			$queryIngmov = $conexion->query($sqlIngmov);

			$sqlEding = "UPDATE correspondencias SET id_estSeg= '2',
                                        area_remit='" . $_POST['area_n'] . "',
                                        per_encarga='" . $_POST['per_enc'] . "'
                                WHERE id_seg= '" . $_POST['id_seg'] . "'";
			$queryEding = $conexion->query($sqlEding);

			if ($queryIngmov != null && $queryEding != null) {
				echo "Remitido correctamente";
			} else {
				printf("Errormessage: %s\n", $conexion->error);
			}
			include 'email2.php';
			break;

		case 'updateConta':
			$sqlInre = "INSERT INTO seg_ingre_x_movi
                                       (id_seg,
                                        id_usu,
                                        id_estSeg,
                                        fech_cre,
                                        fecha_hora, 
                                        id_are,
                                        per_encarga,
                                        id_reg,
                                        id_nom,
                                        id_prove)
                                        VALUES 
                                        ( '" . $_POST['id_seg'] . "',
                                         '" . $_SESSION['id'] . "',
                                         '4',
                                         '$fecha',
                                         '$fecha',
                                         '" . $_SESSION['are'] . "',
                                         '" . $_SESSION['id'] . "',
                                         '" . $_SESSION['reg'] . "',
                                         '" . $_POST['id_nom'] . "',
                                         '" . $_POST['id_prove'] . "')";

			$queryInre = $conexion->query($sqlInre);

			$sqlEdreci = "UPDATE correspondencias SET id_estSeg= '4'
                                        WHERE id_seg= '" . $_POST['id_seg'] . "'";
			$queryEdreci = $conexion->query($sqlEdreci);

			if ($queryInre != null && $queryEdreci != null) {
				echo "Solicitud actualizada correctamente";
			} else {

				printf("Errormessage: %s\n", $conexion->error);
			}
			//  include 'email2.php';
			break;

		case 'updateForm':
			$file = "../../documentos/correspondencia/docum/";
			opendir($file);
			$sqlFac = "SELECT sop_factura FROM correspondencias WHERE id_seg=" . $_POST['id_seg'];
			$queryFac = $conexion->query($sqlFac);
			$r = $queryFac-> fetch(PDO::FETCH_ASSOC);
			if (!empty($_FILES['fac_regi']['tmp_name'])) {
				if (file_exists($file . $r["sop_factura"])) {
					unlink($file . $r["sop_factura"]);
				}
				$fac_regi = $_FILES['fac_regi']['name'];
				$destino = $file . $fac_regi;
				copy($_FILES['fac_regi']['tmp_name'], $destino);
			}
			$sqlUpIng = "UPDATE correspondencias SET fech_ini= '" . $_POST['fec_rec'] . "', 
                                             id_nom='" . $_POST['nom_fac'] . "'";
			if (isset($_POST['fec_ven']) && $_POST['fec_ven'] != '') {
				$sqlUpIng .= ", fec_ven= '" . $_POST['fec_ven'] . "'";
			}
			if (isset($_POST['consec_fact']) && $_POST['consec_fact'] != '') {
				$sqlUpIng .= ", conse_fac='" . $_POST['consec_fact'] . "'";
			}
			if (isset($_POST['num_faR']) && $_POST['num_faR'] != '') {
				$sqlUpIng .= ", num_facR='" . $_POST['num_faR'] . "'";
			}
			if (isset($_POST['num_bog'])) {
				$sqlUpIng .= ",id_bodeg= '" . $_POST['num_bog'] . "'";
			}
			if (isset($_POST['my_pro'])) {
				$sqlUpIng .= ", my_process= '" . $_POST['my_pro'] . "'";
			}
			$sqlUpIng .= ", area_remit= '" . $_POST['area_n'] . "',
                                             id_usu= '" . $_SESSION['id'] . "',
                                             id_reg= '" . $_SESSION['reg'] . "',
                                             id_rol= '" . $_SESSION['rol'] . "',
                                        per_encarga= '" . $_POST['per_enc'] . "'";
                                      
			if (isset($_POST['justi'])) {
				$sqlUpIng .= ",concept_justifi='" . $_POST['justi'] . "'";
			}
			if (isset($_POST['subto'])) {
				$sqlUpIng .= ", sub_tota= '" . $_POST['subto'] . "'";
			}
			if (isset($_POST['iva'])) {
				$sqlUpIng .= ", iva= '" . $_POST['iva'] . "'";
			}
			if (!empty($_FILES['fac_regi']['tmp_name'])) {
				$sqlUpIng .= ",sop_factura='$fac_regi'";
			}
			if (isset($_POST['id_cli'])) {
				$sqlUpIng .= ", id_prove= '" . $_POST['id_cli'] . "'";
			}
			$sqlUpIng .= " WHERE id_seg=" . $_POST['id_seg'];

			$queryUpIng = $conexion->query($sqlUpIng);
			
			if ($queryUpIng != null) {
				echo "Correspondencia actualizada correctamente";
			} else {
				echo $sqlTab;
				echo  $sqlUpIng;

				// printf("Errormessage: %s\n", $conexion->error);
			}
			//   include 'email2.php';
			break;
		case 'eliminar':
			$sqlElim1 = "DELETE FROM correspondencias WHERE id_seg=" . $_POST['id_seg'];
			$queryElim1 = $conexion->query($sqlElim1);
			$sqlElim2 = "DELETE FROM seg_ingre_x_movi WHERE id_seg=" . $_POST['id_seg'];
			$queryElim2 = $conexion->query($sqlElim2);
			if ($queryElim2 != null && $queryElim1 != null) {
				echo "Correspondencia Eliminada Correctamente";
			} else {
				echo $sqlTab;
				echo  $sqlUpIng;

				// printf("Errormessage: %s\n", $conexion->error);
			}
			break;
		case 'aceptado':
			$sqlAcept = "INSERT INTO seg_ingre_x_movi
                                (id_seg,
                                id_usu,
                                id_estSeg,
                                fech_cre,
                                fecha_hora, 
                                id_are,
                                per_encarga,
                                id_reg,
                                id_nom,
                                id_prove)
                                VALUES 
                                ( '" . $_POST['id_seg'] . "',
                                '" . $_SESSION['id'] . "',
                                '3',
                                '$fecha',
                                '$fecha',
                                '" . $_SESSION['are'] . "',
                                '" . $_SESSION['id'] . "',
                                '" . $_SESSION['reg'] . "',
                                '" . $_POST['nom_fac'] . "',
                                '" . $_POST['id_provedor'] . "')";
			$queryAcept = $conexion->query($sqlAcept);

			$sqlUpdseguim = "UPDATE correspondencias SET seg_rec = '1'
                                          WHERE id_seg= '" . $_POST['id_seg'] . "'";
			$queryUpdseguim = $conexion->query($sqlUpdseguim);

			if ($queryAcept != null && $queryUpdseguim != null) {
				echo 1;
			} else {
				printf("Errormessage: %s\n", $conexion->error);
			}
			break;

		case 'finalizado':
			$sqlFina = "INSERT INTO seg_ingre_x_movi
                                (id_seg,
                                id_usu,
                                id_estSeg,
                                fech_cre,
                                fecha_hora, 
                                id_are,
                                per_encarga,
                                id_reg,
                                id_nom,
                                id_prove)
                                VALUES 
                                ( '" . $_POST['id_seg'] . "',
                                '" . $_SESSION['id'] . "',
                                '6',
                                '$fecha',
                                '$fecha',
                                '" . $_SESSION['are'] . "',
                                '" . $_SESSION['id'] . "',
                                '" . $_SESSION['reg'] . "',
                                '" . $_POST['nom_fac'] . "',
                                '" . $_POST['id_provedor'] . "')";

			$queryFina = $conexion->query($sqlFina);
			if ($queryFina != null) {
				echo 1;
			} else {
				printf("Errormessage: %s\n", $conexion->error);
			}
			break;

		case 'addProv':
			$sqlAddCli = "INSERT INTO mq_clientes
                (nom_cli, 
                tip_doc, 
                num_doc, 
                tel_cli, 
                eml_cli, 
                dir_cli, 
                id_ciu
                id_usu)
                VALUES
                ('" . $_POST['nom_cli'] . "', 
                '" . $_POST['tip_doc'] . "', 
                '" . $_POST['num_doc'] . "', 
                '" . $_POST['tel_cli'] . "', 
                '" . $_POST['eml_cli'] . "', 
                '" . $_POST['dir_cli'] . "', 
                " . validar($_POST['id_ciu']) . "
                '$sesion_id')";
			$queryAddCli = $conexion->query($sqlAddCli);
			if ($queryAddCli != null) {
				echo 1;
			} else {
				echo 0;
			}
			break;

		case 'addCaj':
			$file = "../../documentos/correspondencia/docum/";
			opendir($file);
			for ($i = 0; $i < 130; $i++) {
				if (isset($_FILES['doc_caj']['tmp_name'][$i])) {
					if (!empty($_FILES['doc_caj']['tmp_name'][$i])) {
						$dos = $_FILES['doc_caj']['name'][$i];
						$destino = $file . $dos;
						copy($_FILES['doc_caj']['tmp_name'][$i], $destino);
					}
				}
			}
			echo 1;
			break;

		case 'cargMasiv':
			$fecha = date("y.m.d");
			$fecha2 = date("Y-m-d H:i:s");
			$file = "../../documentos/correspondencia/masivo/";
			opendir($file);
			$excel = $fecha . "-" . $_FILES['facsEx']['name'];
			copy($_FILES['facsEx']['tmp_name'], $file . $excel);
			$row = 1;
			$content = '1';
			$fp = fopen("$file$excel", "r");
			$content .= '<div class="">
                        <div class="table-responsive" style="height: 400px; overflow-y: scroll;">
                        <br>
                        <table class="table table-bordered " id="datatable" style="font-size: 80%;">
                        <thead>
                                <tr>
                                <th># Factura en MyProcess</th>
                                <th>Id Proveedor</th>
                                <th>Nombre del Proveeedor</th>
                                <th>N° Factura</th>
                                <th>Estado</th>
                                </tr>
                        </thead>
                        <tbody>';
			while ($data = fgetcsv($fp, 5000, ';')) {
				if ($row != 1) {
					$sqlPrue = "SELECT * FROM correspondencias WHERE num_facR='" . $data[5] . "'";
					$queryPrue = $conexion->query($sqlPrue);
					//echo $sqlPrue;
					if ($queryPrue->rowCount() > 0) {
						$content .= '<tr>
                                <td>' . $data[0] . $data[1] . '</td>
                                <td>' . $data[3] . '</td>
                                <td>' . $data[4] . '</td>
                                <td>' . $data[5] . '</td>
                                <td class="alert alert-danger">Ya existente!</td>
                                </tr>';
					} else {
						$sqldig = "SELECT dig_ver FROM  mq_prove WHERE id_prove=" . $data[3];
						$querydig = $conexion->query($sqldig);

						if ($querydig->rowCount() > 0) {
						} else {
							$sql_Pr = "INSERT INTO mq_prove (id_prove,
                                                nom_pro)
                                                VALUES(
                                                '$data[3]',
                                                '$data[4]')";
							$query_Pr = $conexion->query($sql_Pr);
							$sqldig = "SELECT dig_ver FROM  mq_prove WHERE id_prove=" . $data[3];
							$querydig = $conexion->query($sqldig);
						}
						$rdig = $querydig-> fetch(PDO::FETCH_ASSOC);
						$nombre = $data[4];
						$sqlIngresoEx = "INSERT INTO correspondencias (id_seg,
                                                                fech_cre,
                                                                fech_ini,
                                                                id_nom,
                                                                my_process,
                                                                id_usu,
                                                                id_reg,
                                                                num_facR,
                                                                id_rol,
                                                                conse_fac,
                                                                area_remit,
                                                                nom_pro,
                                                                sub_tota,
                                                                iva,
                                                                id_estSeg,
                                                                id_prove,
                                                                per_encarga,
                                                                dig_ver,
                                                                concept_justifi)
                                                                VALUES(
                                                                NULL,
                                                                '$fecha2',
                                                                '$data[2]',
                                                                '" . $_POST['nom_fac'] . "',
                                                                'Si',
                                                                '" . $_SESSION['id'] . "',
                                                                '" . $_SESSION['reg'] . "',
                                                                '" . $data[5] . "',
                                                                '" . $_SESSION['rol'] . "',
                                                                '$data[0]$data[1]',
                                                                '" . $_POST['area_n'] . "',
                                                                '$nombre',
                                                                '$data[6]',
                                                                '$data[7]',
                                                                '1',
                                                                '$data[3]',
                                                                '" . $_POST['per_enc'] . "',
                                                                '" . $rdig['dig_ver'] . "',
                                                                '" . $_POST['justi'] . "')";

						$queryIngresoEx = $conexion->query($sqlIngresoEx);

						$sqlSegbus = "SELECT * FROM correspondencias ORDER BY id_seg DESC ";
						$querySegbus = $conexion->query($sqlSegbus);
						$rB = $querySegbus-> fetch(PDO::FETCH_ASSOC);

						$sqlSegimEx = "INSERT INTO seg_ingre_x_movi (id_seg,
                                                                id_usu,
                                                                id_estSeg,
                                                                fech_cre,
                                                                fecha_hora,
                                                                id_are,
                                                                per_encarga,
                                                                id_reg,
                                                                id_nom,
                                                                id_prove)
                                                                VALUES (
                                                                '" . $rB['id_seg'] . "',
                                                                '" . $_SESSION['id'] . "',
                                                                '1',
                                                                '$fecha2',
                                                                '$data[2]',
                                                                '" . $_POST['area_n'] . "',
                                                                '" . $_POST['per_enc'] . "',
                                                                '" . $_SESSION['reg'] . "',
                                                                '" . $_POST['nom_fac'] . "',
                                                                '$data[3]')";
						$querySegimEx = $conexion->query($sqlSegimEx);
					}
					if (isset($queryIngresoEx) && $queryIngresoEx != null) {
						$content .= '<tr>
                                <td>' . $data[0] . $data[1] . '</td>
                                <td>' . $data[3] . '</td>
                                <td>' . $data[4] . '</td>
                                <td>' . $data[5] . '</td>
                                <td class="alert alert-success alert-dismissible fade show mt-4 d-flex align-items-center">Cargado</td>
                                        </tr>';
					} else {
					}
				}
				$row++;
			}
			$content .= '</body>
                           </table>
                           </div>
                           </div>';
			//$content=substr($content, 1);
			echo $content;
			/* if (isset($queryIngresoEx) && $queryIngresoEx != null) {
                                include 'email2.php';
                        }*/
			break;
	}
}
