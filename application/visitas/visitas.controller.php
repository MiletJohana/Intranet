<?php
include "../../conexion.php";
include '../../resources/template/credentials.php';
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d H:i:s");
if (isset($_POST['action'])) {
	switch ($_POST['action']) {
		case 'add':
			$file = "../../documentos/visitas/encuesta/";

			$name_doc = null;
			$errores_doc = 0;
		
            if(is_dir($file)){
                opendir($file);
                if (!empty($_FILES['doc_induccion']['tmp_name'])) {
                    $type_doc = ['image/jpeg', 'application/pdf'];
                    if (in_array($_FILES['doc_induccion']['type'], $type_doc)) {
                        $max_size = 1 * 1024 * 1024;
                        if ($_FILES['doc_induccion']['size'] <= $max_size) {
                            $name_doc = uniqid() .'.'. pathinfo($_FILES['doc_induccion']['name'], PATHINFO_EXTENSION);
                            $destino = $file . $name_doc;
                            copy($_FILES['doc_induccion']['tmp_name'], $destino);
                              
                        } else {
                            $errores_doc = 2;
                        }
                    } else {
                        $errores_doc = 3;
                    }
                 
                }
                
            } else {
                $errores_doc = 4;
            }

			if ($errores_doc == 0){
				$imagen = $_POST["imagen"];

				$sql = "INSERT INTO mq_vis(id_usu,
											id_vis,
											fec_vis,
											fec_sal,
											fot_vis, 
											doc_induccion,
											id_are, 
											id_per) 
								VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
	
				$query = $conexion->prepare($sql);
				$query -> execute([$sesion_id, NULL, $fecha, 'Sin registrar', $imagen, $name_doc, $_POST['are_vis'], $_POST['id_per2']]);
				if ($query != null) {
				echo 1;
				} else {
				printf("Errormessage: %s\n", $conexion->error);
				}
			} else {
				echo $errores_doc;
			}
			  
			
			break;
		case 'update':
			$sql = "UPDATE mq_vis SET fec_sal=\"$fecha\" WHERE id_vis=\"$_POST[id]\"";
			$query = $conexion->query($sql);
			if ($query != null) {
				echo "Visita actualizada correctamente.";
			} else {
				printf("Errormessage: %s\n", $conexion->error);
			}
			break;
		case 'addVisit':

			$file = "../../documentos/visitas/encuesta/";
			
			$name_doc = null;
			$errores_doc = 0;
		
            if(is_dir($file)){
                opendir($file);
                if (!empty($_FILES['doc_induccion']['tmp_name'])) {
                    $type_doc = ['image/jpeg', 'application/pdf'];
                    if (in_array($_FILES['doc_induccion']['type'], $type_doc)) {
                        $max_size = 2 * 1024 * 1024;
                        if ($_FILES['doc_induccion']['size'] <= $max_size) {
                            $name_doc = uniqid() .'.'. pathinfo($_FILES['doc_induccion']['name'], PATHINFO_EXTENSION);
                            $destino = $file . $name_doc;
                            copy($_FILES['doc_induccion']['tmp_name'], $destino);
                        } else {
                            $errores_doc = 2;
                        }
                    } else {
                        $errores_doc = 3;
                    }
                 
                }
                
            } else {
                $errores_doc = 4;
            }

			if ($errores_doc == 0){
				$imagen = $_POST["imagen"];

				$sqlAddVis = "INSERT INTO mq_pers(id_per,
												  nom_per,
												  eps_per,
												  arl_per,
												  emp_per, 
												  con_per, 
												  tel_per, 
												  tel_con) 
							  VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
				
				$queryAddVis = $conexion->prepare($sqlAddVis);
                $queryAddVis -> execute([$_POST['id_per3'], $_POST['nom_per3'], $_POST['eps_per3'], $_POST['arl_per3'], $_POST['emp_per3'], $_POST['con_per3'], $_POST['tel_per3'], $_POST['tel_con3']]);

                $sql = "INSERT INTO mq_vis(id_usu,
										   id_vis,
										   fec_vis,
										   fec_sal,
										   fot_vis, 
										   doc_induccion,
										   id_are, 
										   id_per) 
		            	VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            
                $query = $conexion->prepare($sql);
                $query -> execute([$sesion_id, NULL, $fecha, 'Sin registrar', $imagen, $name_doc, $_POST['are_vis3'], $_POST['id_per3']]);
                            
				if ($query != null && $queryAddVis != null) {
                    echo 1;
                } else {
                    printf("Errormessage: %s\n", $conexion->error);
                }      
			} else {
				echo $errores_doc;
			}
			
			break;
		case 'updateVisit':
			$sql = "UPDATE mq_pers SET nom_per=\"$_POST[nom_per3]\",
        							 eps_per=\"$_POST[eps_per3]\",
        							 arl_per=\"$_POST[arl_per3]\",
        							 emp_per=\"$_POST[emp_per3]\",
        							 con_per=\"$_POST[con_per3]\",
        							 tel_per=\"$_POST[tel_per3]\",
        							 tel_con=\"$_POST[tel_con3]\"
        					   WHERE id_per=\"$_POST[id_per3]\"";
			$query = $conexion->query($sql);
			if ($query != null) {
				echo 'Visitante actualizado correctamente.';
			} else {
				echo 'Errormessage: %s\n,' .$conexion->error.'';
			}
		break;
	}
}
