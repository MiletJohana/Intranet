<?php 
include '../../conexion.php';
include "../../resources/template/credentials.php";
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d H:i:s");
//echo var_dump($_POST);
$resp = [];

function usu_mq ($id, $conexion){
    $sql_usu = "SELECT nom_usu FROM mq_usu WHERE id_usu = ?;";
    $query_usu = $conexion -> prepare($sql_usu);
    $query_usu -> execute([$id]);
    $rowInfoUsu = $query_usu->fetch(PDO::FETCH_ASSOC);

    return $rowInfoUsu['nom_usu'];
}

if (isset($_POST['action'])) {
	switch ($_POST['action']) {
        case 'inv_create_sol':
            $sqlCreateSol = "INSERT INTO inv_solicitud(id_usu, est_sol, fec_sol, sol_elim)
                             VALUES (?, ?, ?, ?);";
            $queryCreateSol = $conexion->prepare($sqlCreateSol);
            $queryCreateSol -> execute([$_POST['id_usu'], 1, $fecha, 0,]);
            
            $sql_id_sol = "SELECT id_sol FROM inv_solicitud ORDER BY id_sol DESC LIMIT 1;";
            $query_id_sol = $conexion -> prepare($sql_id_sol);
            $query_id_sol -> execute();
            $rowInfoId = $query_id_sol->fetch(PDO::FETCH_ASSOC);
            if ($queryCreateSol != null && $query_id_sol != null) {
                $products = json_decode($_POST['products']);
                
                $req_aprob = 0;
                $sql_error = [];
                foreach ($products as $product) {
                    $sqlAprobacion = "SELECT req_aprob FROM inv_prod_x_are WHERE id_prod = ? AND id_are = ?;";
                    $queryAprobacion = $conexion->prepare($sqlAprobacion);
                    $queryAprobacion -> execute([$product->id_prod, $_POST['id_are']]);
                    $rowInfoAprobacion = $queryAprobacion->fetch(PDO::FETCH_ASSOC);
                    if($rowInfoAprobacion['req_aprob'] == 1){
                        $req_aprob++;
                    }
                    $sql_sol_x_prod = "INSERT INTO inv_sol_x_prod(id_sol, id_prod, cant_sol, entregado, aprob_prod) VALUES (?, ?, ?, ?, ?); ";
                    $query_sol_x_prod = $conexion -> prepare($sql_sol_x_prod);
                    $query_sol_x_prod -> execute([$rowInfoId['id_sol'], $product->id_prod, $product->cantidad, 0, $rowInfoAprobacion['req_aprob']]);
                    if($query_sol_x_prod == null){
                        $sql_error[] = printf("Errormessage: %s\n", $conexion->error);
                    }
                }
                if($req_aprob != 0){
                    $sqlUpdateEst = "UPDATE inv_solicitud SET est_sol = 2 WHERE id_sol = ?;";
                    $queryUpdateEst = $conexion->prepare($sqlUpdateEst);
                    $queryUpdateEst -> execute([$rowInfoId['id_sol']]);
                    if($queryUpdateEst == null){
                        $sql_error[] = printf("Errormessage: %s\n", $conexion->error);
                    }
                }
                if (count($sql_error) == 0) {
                    $sqlInvMov = "INSERT INTO inv_sol_x_mov(id_sol, id_usu, est_sol, fec_mov, obs_mov)
                                  VALUES (?, ?, ?, ?, ?);";
                    $queryInvMov = $conexion->prepare($sqlInvMov);
                    $queryInvMov -> execute([$rowInfoId['id_sol'], $_POST['id_usu'], (($req_aprob != 0) ? 2 : 1), $fecha, 'Solicitud creada exitosamente']);
                    $resp['num'] = 1;
                    $resp['text'] = 'Solicitud Creada Correctamente';
                    $id_sol = $rowInfoId['id_sol'];
                    include "email.php";
                } else {
                    $resp['num'] = 2;
                    $resp['text'] = $sql_error;
                }
            } else {
                $resp['num'] = 3;
                $resp['text'] = printf("Errormessage: %s\n", $conexion->error);
            }  
                                        
            break;
        case 'delete_sol_inv':
            $sqlDelete = "UPDATE inv_solicitud SET sol_elim = 1 WHERE id_sol = ?;";
            $queryDelete = $conexion->prepare($sqlDelete);
            $queryDelete -> execute([$_POST['id']]);
            
            if ($queryDelete != null) {
                $sqlInvMov = "INSERT INTO inv_sol_x_mov(id_sol, id_usu, est_sol, fec_mov, obs_mov)
                              VALUES (?, ?, ?, ?, ?);";
                $queryInvMov = $conexion->prepare($sqlInvMov);
                $queryInvMov -> execute([$_POST['id'], $sesion_id, 6, $fecha, 'Solicitud Eliminada Correctamente']);

                $resp['num'] = 1;
                $resp['text'] = "Solicitud #".$_POST['id']." Eliminada Correctamente";
            } else {
                $resp['num'] = 3;
                $resp['text'] = printf("Errormessage: %s\n", $conexion->error);
            }  
                                        
            break;
        case 'val_cant_prod':
            $sqlProdSol = "SELECT sol_prod.id_sol, sol_prod.id_prod, sol_prod.cant_sol, sol_prod.entregado, inv.cantidad, inv.id_inv, inv.id_reg, sol.id_usu FROM inv_sol_x_prod sol_prod 
                           INNER JOIN inv_inventario inv ON sol_prod.id_prod = inv.id_prod
                           INNER JOIN inv_solicitud sol ON sol_prod.id_sol = sol.id_sol
                           WHERE sol_prod.id_sol = ? AND sol_prod.aprob_prod != ? AND inv.id_reg = ? AND sol_prod.cant_sol != sol_prod.entregado;";
            $queryProdSol = $conexion->prepare($sqlProdSol);
            $queryProdSol -> execute([$_POST['id_sol'], 3, $sesion_reg]);
            $rowInfoProdSol = $queryProdSol->fetchAll(PDO::FETCH_ASSOC);

            $cant_prod = [];
            foreach ($rowInfoProdSol as $product) {
                $validation = [
                    'id_prod' => $product['id_prod'], 
                    'id_inv' => $product['id_inv'],
                    'cant_inv' => $product['cantidad'],
                    'id_reg' => $product['id_reg'],
                    'id_usu' => $product['id_usu'],
                    'cant_sol' => $product['cant_sol'],
                    'entregado' => $product['entregado']
                ];

                if($product['cant_sol'] <= $product['cantidad'] && $product['cantidad'] != 0){
                    $validation['cant_entregar'] = $product['cant_sol']-$product['entregado'];
                    $validation['resp'] = 0; 
                } else if($product['cantidad'] != 0) {
                    $validation['cant_entregar'] = $product['cantidad'];
                    $validation['resp'] = 1;
                } else {
                    $validation['cant_entregar'] = $product['cantidad'];
                    $validation['resp'] = 2;
                }
                array_push($cant_prod, $validation);
            }
            
            if (isset($cant_prod) && $queryProdSol != null) {
                $resp['num'] = 1;
                $resp['text'] = json_encode($cant_prod);
            } else {
                $resp['num'] = 3;
                $resp['text'] = printf("Errormessage: %s\n", $conexion->error);
            }  
                                        
            break;
        case 'entregar_sol':
            $entrega_parcial = 0;
            $sql_error = [];
            foreach (json_decode($_POST['products']) as $product) {
                $new_cant_inv = $product->cant_inv - $product->cant_entregar;
                $sqlUpdate = "UPDATE inv_sol_x_prod 
                              SET entregado = ?,
                                  fec_ent = ?,
                                  usu_ent = ?
                              WHERE id_sol = ? AND id_prod = ?;";
                $queryUpdate = $conexion->prepare($sqlUpdate);
                $queryUpdate -> execute([($product->cant_entregar+$product->entregado), $fecha, $sesion_id, $_POST['id_sol'], $product->id_prod]);
                $sqlUpdateInv = "UPDATE inv_inventario SET cantidad = ? WHERE id_inv = ?;";
                $queryUpdateInv = $conexion->prepare($sqlUpdateInv);
                $queryUpdateInv -> execute([$new_cant_inv, $product->id_inv]);

                $sqlMovInv = "INSERT INTO inv_mov_inventario(id_prod, 
                                                             id_reg, 
                                                             razon, 
                                                             razon_det,
                                                             cant_ant,
                                                             new_cant, 
                                                             fec_mov,
                                                             usu_mov)
                              VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                $queryMovInv = $conexion->prepare($sqlMovInv);
                $queryMovInv -> execute([$product->id_prod, $product->id_reg, 'Salida', 'Entregado a '.usu_mq($product->id_usu, $conexion), $product->cant_inv, $new_cant_inv, $fecha, $sesion_id]);
                if($queryUpdate == null || $queryUpdateInv == null || $queryMovInv == null){
                    $sql_error[] = printf("Errormessage: %s\n", $conexion->error);
                }
                if($product->resp == 1 || $product->resp == 2){
                    $entrega_parcial++;
                } 
            }  

            ($entrega_parcial == 0) ?  $est_sol = 3 : $est_sol = 4;

            $sqlUpdateEst = "UPDATE inv_solicitud SET est_sol = ? WHERE id_sol = ?;";
            $queryUpdateEst = $conexion->prepare($sqlUpdateEst);
            $queryUpdateEst -> execute([$est_sol, $_POST['id_sol']]);
            if($queryUpdateEst == null){
                $sql_error[] = printf("Errormessage: %s\n", $conexion->error);
            }
            if (count($sql_error) == 0){
                $sqlInvMov = "INSERT INTO inv_sol_x_mov(id_sol, id_usu, est_sol, fec_mov, obs_mov)
                              VALUES (?, ?, ?, ?, ?);";
                $queryInvMov = $conexion->prepare($sqlInvMov);
                $queryInvMov -> execute([$_POST['id_sol'], $sesion_id, $est_sol, $fecha, (($est_sol == 3) ? 'Solicitud Entregada en su totalidad' : "Solicitud Entregada Parcialmente")]);
                $resp['num'] = 1;
                $resp['text'] = 'Solicitud Entregada Correctamente';
                $id_sol = $_POST['id_sol'];
                include "email.php";
            } else {
                $resp['num'] = 3;
                $resp['text'] = json_encode($sql_error);
            } 
                                        
            break;

        case 'aprobar_prod':
            /* Área del solicitante */
            $sqlAre = "SELECT usu.id_are FROM mq_usu usu INNER JOIN inv_solicitud sol ON usu.id_usu = sol.id_usu WHERE sol.id_sol = ? ;";
            $queryAre = $conexion->prepare($sqlAre);
            $queryAre -> execute([$_POST['id_sol']]);
            $rowInfoAre = $queryAre->fetch(PDO::FETCH_ASSOC);

            $sql_error = [];
            $products = json_decode($_POST['products']);

            foreach($products as $product){
                /* Aprobación de producto por área */
                $sqlUpdateAprob = 'UPDATE inv_prod_x_are SET req_aprob = ? WHERE id_prod = ? AND id_are = ?;';
                $queryUpdateAprob = $conexion->prepare($sqlUpdateAprob);
                $queryUpdateAprob -> execute([2, $product->id_prod, $rowInfoAre['id_are']]);

                /* Aprobación de producto en la solicitud respectiva */
                $sqlSolProdAprob = 'UPDATE inv_sol_x_prod SET aprob_prod = ? WHERE id_sol = ? AND id_prod = ? ;';
                $querySolProdAprob = $conexion->prepare($sqlSolProdAprob);
                $querySolProdAprob -> execute([2, $_POST['id_sol'] ,$product->id_prod]);

                if($queryUpdateAprob == null ||$querySolProdAprob == null){
                    $sql_error[] = printf("Errormessage: %s\n", $conexion->error);
                }
            }

            /* Consulta para revisar si no faltaron productos por aprobar */
            $sqlProdNoAprob = "SELECT sol_prod.id_prod, sol_prod.aprob_prod FROM inv_sol_x_prod as sol_prod 
                               WHERE sol_prod.id_sol = ? AND sol_prod.aprob_prod = ?;";
            $queryProdNoAprob = $conexion->prepare($sqlProdNoAprob);
            $queryProdNoAprob -> execute([$_POST['id_sol'], 1]);
            $rowProdNoAprob = $queryProdNoAprob->fetchAll(PDO::FETCH_ASSOC);

            /* Si faltaron algunos productos por aprobar los va a rechazar */
            if (count($rowProdNoAprob) > 0) {
                foreach($rowProdNoAprob as $prod){
                    $sqlUpdateRechazar = 'UPDATE inv_sol_x_prod SET aprob_prod = ? WHERE id_sol = ? AND id_prod = ?;';
                    $queryUpdateRechazar = $conexion->prepare($sqlUpdateRechazar);
                    $queryUpdateRechazar -> execute([3, $_POST['id_sol'], $prod['id_prod']]);
    
                    if($queryUpdateRechazar == null){
                        $sql_error[] = printf("Errormessage: %s\n", $conexion->error);
                    }
                }
            }

            /* Actualización de estado de pendiente por aprobación a pendiente por entrega */
            $sqlUpdateEst = 'UPDATE inv_solicitud SET est_sol = ? WHERE id_sol = ?;';
            $queryUpdateEst = $conexion->prepare($sqlUpdateEst);
            $queryUpdateEst -> execute([1, $_POST['id_sol']]);

            if($queryUpdateEst == null){
                $sql_error[] = printf("Errormessage: %s\n", $conexion->error);
            }

            if (count($sql_error) == 0){
                $resp['num'] = 1;
                $resp['text'] = 'Productos seleccionados Aprobados Exitosamente';
            } else {
                $resp['num'] = 3;
                $resp['text'] = json_encode($sql_error);
            }

            break;

        case 'rechazar_sol':
            $sql_error = [];
            $products = json_decode($_POST['products']);
            $id_sol = null;

            foreach($products as $product){

                $id_sol = $product->id_sol;

                /* Rechazo de los productos seleccionados de acuerdo a la solicitud respectiva */
                $sqlRechazarProdSol = 'UPDATE inv_sol_x_prod SET aprob_prod = ?, fec_ent = ?, usu_ent = ? WHERE id_sol = ? AND id_prod = ? ;';
                $queryRechazarProdSol = $conexion->prepare($sqlRechazarProdSol);
                $queryRechazarProdSol -> execute([3, $fecha, $sesion_id, $product->id_sol, $product->id_prod]);

                if($queryRechazarProdSol == null){
                    $sql_error[] = printf("Errormessage: %s\n", $conexion->error);
                }

            }

            $sqlProdSol= "SELECT prod.id_prod, prod.aprob_prod, sol.est_sol FROM inv_sol_x_prod AS prod
                          INNER JOIN inv_solicitud AS sol ON prod.id_sol = sol.id_sol WHERE prod.id_sol = ? AND prod.aprob_prod != ? ;";
            $queryProdSol = $conexion->prepare($sqlProdSol);
            $queryProdSol -> execute([$id_sol, 3]);
            $rowProdSol = $queryProdSol->fetchAll(PDO::FETCH_ASSOC);

            if($queryProdSol->rowCount() == 0){
                $resp['text'] = "Solicitud #".$id_sol." Rechazada Correctamente";
                $mensaje = 'Solicitud Rechazada Correctamente';
                $est_sol = 5;
            } else {
                /* Filtramos para revisar si hay algun producto pendiente por aprobar */
                $prod_pendientes = array_filter($rowProdSol, function ($prod) {
                    return isset($prod['aprob_prod']) && $prod['aprob_prod'] == 1;
                });
                
                if (count($prod_pendientes) != 0) {
                    $est_sol = 2;
                } else {
                    $est_sol = 1;
                }
                $resp['text'] = 'Productos seleccionados rechazados correctamente';
                $mensaje = 'Productos Rechazados Exitosamente';
            }

            $sqlUpdEstSol = "UPDATE inv_solicitud SET est_sol = ? WHERE id_sol = ? ;";
            $queryUpdEstSol = $conexion->prepare($sqlUpdEstSol);
            $queryUpdEstSol -> execute([$est_sol, $id_sol]);
            
            if($queryUpdEstSol == null){
                $sql_error[] = printf("Errormessage: %s\n", $conexion->error);
            }

            if (count($sql_error) == 0) {
                $sqlInvMov = "INSERT INTO inv_sol_x_mov(id_sol, id_usu, est_sol, fec_mov, obs_mov)
                              VALUES (?, ?, ?, ?, ?);";
                $queryInvMov = $conexion->prepare($sqlInvMov);
                $queryInvMov -> execute([$id_sol, $sesion_id, $est_sol, $fecha, $mensaje]);

                $resp['num'] = 1;

                if($est_sol == 5){
                    include "email.php";
                }
            } else {
                $resp['num'] = 3;
                $resp['text'] = printf("Errormessage: %s\n", $conexion->error);
            }  
                                        
            break;
        
        case 'select_usu_mq':

            $sqlInfoUsuMQ = "SELECT id_usu, nom_usu FROM mq_usu WHERE usu_elim = ? AND id_are= ? ;";
            $queryInfoUsuMQ = $conexion->prepare($sqlInfoUsuMQ);
            $queryInfoUsuMQ -> execute([0, $_POST['id_are']]);
            $rowInfoUsuMQ = $queryInfoUsuMQ->fetchAll(PDO::FETCH_ASSOC);

            if ($queryInfoUsuMQ->rowCount() > 0) {
                $resp['text'] = '<option value=" ">Seleccionar Personal MQ...</option>';
                foreach ($rowInfoUsuMQ as $usuMQ){
                    $resp['text'] .= "<option value=" . $usuMQ['id_usu'] . ">" . ($usuMQ['nom_usu']) . "</option>";
                }

            }

            break;
	}
}
echo json_encode($resp); 