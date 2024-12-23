<?php 
include '../../conexion.php';
include "../../resources/template/credentials.php";
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d H:i:s");
//echo var_dump($_POST);
$resp = [];
if (isset($_POST['action'])) {
	switch ($_POST['action']) {
		case 'add_prod':
            $file = "../../documentos/inventarios/productos/";
            if(is_dir($file)){
                opendir($file);
                if (!empty($_FILES['img_prod']['tmp_name'])) {
                    $type_img = ['image/jpeg', 'image/png'];
                    if (in_array($_FILES['img_prod']['type'], $type_img)) {
                        $max_size = 1 * 1024 * 1024;
                        if ($_FILES['img_prod']['size'] <= $max_size) {
                            $name_img = uniqid() .'.'. pathinfo($_FILES['img_prod']['name'], PATHINFO_EXTENSION);
                            $destino = $file . $name_img;
                            copy($_FILES['img_prod']['tmp_name'], $destino);
                            $sql = "INSERT INTO inv_product(nom_prod, 
                                                            desc_prod, 
                                                            img_prod, 
                                                            req_aprob,
                                                            fec_crea, 
                                                            usu_crea)
                                    VALUES (?, ?, ?, ?, ?, ?)";
            
                            $query = $conexion->prepare($sql);
                            $query -> execute([$_POST['nom_prod'], $_POST['desc_prod'], $name_img, (($_POST['req_aprob'] == 'on') ? "1" : "0"), $fecha, $sesion_id]);
                            if ($query != null) {
                                $resp['num'] = 1;
                                $resp['text'] = 'Producto Agregado Correctamente';
                            } else {
                                $resp['num'] = 3;
                                $resp['text'] = printf("Errormessage: %s\n", $conexion->error);
                            }  
                                    
                                 
                        } else {
                            $resp['num'] = 2;
                            $resp['text'] = 'El tamaño de la imagen debe ser de 1 MB';
                        }
                    } else {
                        $resp['num'] = 2;
                        $resp['text'] = 'El tipo de la imagen tiene que ser JPEG o PNG';
                    }
                 
                }
                
            } else {
                $resp['num'] = 3;
                $resp['text'] = 'Error al subir la imagen';
            }
          
            
			break;
		case 'update_prod':
            $sql_info = "SELECT * FROM inv_product WHERE id_prod = ?;";
            $query_info = $conexion ->prepare($sql_info);
            $query_info -> execute([$_POST['id_prod']]);
            $rowInfo = $query_info->fetch(PDO::FETCH_ASSOC);
            $update_info = [];
            $campos = [
                'nom_prod' => $_POST['nom_prod'],
                'desc_prod' => $_POST['desc_prod'],
                'req_aprob' => ((!empty($_POST['req_aprob']) && $_POST['req_aprob'] == 'on') ? "1" : "0")
            ];
            foreach ($campos as $key => $value) {
                if($rowInfo[$key] != $value){
                    $update_info[] = "$key = '$value'";
                }
            }
           
            if (!empty($_FILES['img_prod']['tmp_name'])) {
                $file = "../../documentos/inventarios/productos/";
                if(is_dir($file)){
                    opendir($file);
                    $type_img = ['image/jpeg', 'image/png'];
                    if (in_array($_FILES['img_prod']['type'], $type_img)) {
                        $max_size = 1 * 1024 * 1024;
                        if ($_FILES['img_prod']['size'] <= $max_size) {
                            $name_img = uniqid() .'.'. pathinfo($_FILES['img_prod']['name'], PATHINFO_EXTENSION);
                            $destino = $file . $name_img;
                            copy($_FILES['img_prod']['tmp_name'], $destino);
                            array_push($update_info, "img_prod = '$name_img'");
                            if(file_exists($file.$rowInfo['img_prod'])){
                                unlink($file.$rowInfo['img_prod']);
                            }
                        } else {
                            $resp['num'] = 2;
                            $resp['text'] = 'El tamaño de la imagen debe ser de 1 MB';
                        }
                    } else {
                        $resp['num'] = 2;
                        $resp['text'] = 'El tipo de la imagen tiene que ser JPEG o PNG';
                    }
                 
                } else {
                    $resp['num'] = 3;
                    $resp['text'] = 'Error al subir la imagen';
                }
                
            } 
            if(count($update_info) > 0){
                $sqlUpdate = "UPDATE inv_product SET ";
                $sqlUpdate .= join(', ' , $update_info);
                $sqlUpdate .= " WHERE id_prod = ?;";
                $queryUpdate = $conexion->prepare($sqlUpdate);
                $queryUpdate -> execute([$_POST['id_prod']]);

                if($campos['req_aprob'] != $rowInfo['req_aprob']){
                    $sqlUpdateReqAprob = "UPDATE inv_prod_x_are SET req_aprob = ? WHERE id_prod = ? AND req_aprob != ?";
                    $queryReqAprob = $conexion->prepare($sqlUpdateReqAprob);
                    $queryReqAprob -> execute([$campos['req_aprob'], $_POST['id_prod'], 2]);
                }

                if ($queryUpdate != null) {
                    $resp['num'] = 1;
                    $resp['text'] = 'Producto Actualizado Correctamente';
                } else {
                    $resp['num'] = 3;
                    $resp['text'] = printf("Errormessage: %s\n", $conexion->error);
                }  
            } else {
                $resp['num'] = 3;
                $resp['text'] = 'No se ha detectado ningun cambio';
            }
            
			break;
        
        case 'delete_prod':
            $sqlDelete = "UPDATE inv_product SET prod_elim = ? WHERE id_prod = ?;";
            $queryDelete = $conexion->prepare($sqlDelete);
            $queryDelete -> execute([1, $_POST['id']]);
            
            if ($queryDelete != null) {
                $resp['num'] = 1;
                $resp['text'] = "Producto Eliminado Correctamente";
            } else {
                $resp['num'] = 3;
                $resp['text'] = printf("Errormessage: %s\n", $conexion->error);
            }  
            
			break;
            
        case 'add_are':
            $sql = "INSERT INTO mq_are(nom_are) VALUES (?)";
    
            $query = $conexion->prepare($sql);
            $query -> execute([$_POST['nom_are']]);
            if ($query != null) {
                $resp['num'] = 1;
                $resp['text'] = 'Área Agregada Correctamente';
            } else {
                $resp['num'] = 3;
                $resp['text'] = printf("Errormessage: %s\n", $conexion->error);
            }  
                                        
            break;
        
        case 'update_are':
            $sql_info = "SELECT * FROM mq_are WHERE id_are = ?;";
            $query_info = $conexion ->prepare($sql_info);
            $query_info -> execute([$_POST['id_are']]);
            $rowInfo = $query_info->fetch(PDO::FETCH_ASSOC);
            $update_info = [];
            $campos = [
                'nom_are' => $_POST['nom_are']
            ];
            foreach ($campos as $key => $value) {
                if($rowInfo[$key] != $value){
                    $update_info[] = "$key = '$value'";
                }
            }
            if(count($update_info) > 0){
                $sqlUpdate = "UPDATE mq_are SET ";
                $sqlUpdate .= join(', ' , $update_info);
                $sqlUpdate .= " WHERE id_are = ?;";
                $queryUpdate = $conexion->prepare($sqlUpdate);
                $queryUpdate -> execute([$_POST['id_are']]);
                if ($queryUpdate != null) {
                    $resp['num'] = 1;
                    $resp['text'] = 'Área Actualizada Correctamente';
                } else {
                    $resp['num'] = 3;
                    $resp['text'] = printf("Errormessage: %s\n", $conexion->error);
                }  
            } else {
                $resp['num'] = 3;
                $resp['text'] = 'No se ha detectado ningun cambio';
            }
                                            
            break;
            
        case 'delete_are':
            $sqlDelete = "DELETE FROM mq_are WHERE id_are = ?;";
    
            $queryDelete = $conexion->prepare($sqlDelete);
            $queryDelete -> execute([$_POST['id']]);
                
            if ($queryDelete != null) {
                $resp['num'] = 1;
                $resp['text'] = "Área Eliminada Correctamente";
            } else {
                $resp['num'] = 3;
                $resp['text'] = printf("Errormessage: %s\n", $conexion->error);
            }  
                
            break;
        
        case 'change_cant_max_prod':
            $sqlUpdate = "UPDATE inv_prod_x_are SET can_max = ? WHERE id = ?;";
            
            $queryUpdate = $conexion->prepare($sqlUpdate);
            $queryUpdate -> execute([$_POST['cant_max'], $_POST['id']]);
                        
            if ($queryUpdate != null) {
                $resp['num'] = 1;
                $resp['text'] = "Cantidad Máxima Actualizada Correctamente";
            } else {
                $resp['num'] = 3;
                $resp['text'] = printf("Errormessage: %s\n", $conexion->error);
            }  
                        
            break;
        case 'delete_prod_x_are':
            $sqlDelete = "DELETE FROM inv_prod_x_are WHERE id = ?;";
        
            $queryDelete = $conexion->prepare($sqlDelete);
            $queryDelete -> execute([$_POST['id']]);
                    
            if ($queryDelete != null) {
                $resp['num'] = 1;
                $resp['text'] = "Producto ha sido removido del área correctamente";
            } else {
                $resp['num'] = 3;
                $resp['text'] = printf("Errormessage: %s\n", $conexion->error);
            }  
                    
            break;
        case 'new_cant_prod':
            $sql_info = "SELECT * FROM inv_inventario WHERE id_inv = ?;";
            $query_info = $conexion ->prepare($sql_info);
            $query_info -> execute([$_POST['id']]);
            $rowInfo = $query_info->fetch(PDO::FETCH_ASSOC);
            $update_info = [];
            $campos = [
                'cantidad' => $_POST['cantidad'],
            ];
            foreach ($campos as $key => $value) {
                if($rowInfo[$key] != $value){
                    $update_info[] = "$key = ".($rowInfo[$key]+$value);
                }
            }
        
            if(count($update_info) > 0){
                $sqlUpdate = "UPDATE inv_inventario SET ";
                $sqlUpdate .= join(', ' , $update_info);
                $sqlUpdate .= " WHERE id_inv = ?;";
                $queryUpdate = $conexion->prepare($sqlUpdate);
                $queryUpdate -> execute([$_POST['id']]);
                if ($queryUpdate != null) {
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
                    $queryMovInv -> execute([$rowInfo['id_prod'], $rowInfo['id_reg'], 'Ingreso', 'Ajuste de Inventario', $rowInfo['cantidad'], $_POST['cantidad'], $fecha, $sesion_id]);
                    $resp['num'] = 1;
                    $resp['text'] = 'Cantidad Actualizada Correctamente';
                } else {
                    $resp['num'] = 3;
                    $resp['text'] = printf("Errormessage: %s\n", $conexion->error);
                }  
            } 
            
			break;
        case 'adm_inventario':
            $sql_info = "SELECT * FROM inv_inventario WHERE id_reg = ?;";
            $query_info = $conexion ->prepare($sql_info);
            $query_info -> execute([$_POST['id_reg']]);
            $rowInfo = $query_info->fetchAll(PDO::FETCH_ASSOC);
            if($query_info){
                if(!empty($_POST['id_products'])){
                    $id_products = explode(',' , $_POST['id_products']);
                    $inventario_prod = array_column($rowInfo, 'id_prod');
    
                    $errores = [];
    
                    /* Validar si hay productos por eliminar */
                    $delete_product = array_diff($inventario_prod, $id_products);
    
                    if(count($delete_product) > 0){
                        foreach ($delete_product as $id_prod) {
                            $sql_delete = "DELETE FROM inv_inventario WHERE id_prod = ? AND id_reg = ?;";
                            $query_delete = $conexion ->prepare($sql_delete);
                            $query_delete -> execute([$id_prod, $_POST['id_reg']]);
    
                            if(!$query_delete){
                                $errores[] = 'delete'.$id_prod;
                            }
                        }
                    }
    
                    /* Obtener id de los productos que hacen falta por agregar */
                    $new_product = array_diff($id_products, $inventario_prod);
    
                    if(count($new_product) > 0){
                        foreach ($new_product as $id_prod) {
                            $sql_add = "INSERT INTO inv_inventario (id_prod, id_reg, cantidad, fec_asig, usu_asig) ";
                            $sql_add .= "VALUES (?, ?, ?, ?, ?) ";
                            $query_add = $conexion ->prepare($sql_add);
                            $query_add -> execute([$id_prod, $_POST['id_reg'], 0, $fecha, $sesion_id]);
    
                            if(!$query_add){
                                $errores[] = 'add'.$id_prod;
                            }
                        }
                    }
    
                    if(count($errores) == 0){
                        $resp['num'] = 1;
                        $resp['text'] = 'Productos Asignados Correctamente';
                    } else {
                        $resp['num'] = 3;
                        $resp['text'] = 'Error al asignar los Productos, Intente nuevamente';
                    }
                } else {
                    $sql_delete = "DELETE FROM inv_inventario WHERE id_reg = ?;";
                    $query_delete = $conexion ->prepare($sql_delete);
                    $query_delete -> execute([$_POST['id_reg']]);
                    if($query_delete){
                        $resp['num'] = 1;
                        $resp['text'] = 'Productos Eliminados Correctamente';
                    } else {
                        $resp['num'] = 3;
                        $resp['text'] = 'Error al eliminar los Productos, Intente nuevamente';
                    }
                }
               
               
            }
            else{
                $resp['num'] = 3;
                $resp['text'] = 'Error al encontrar la regional, contacte con el soporte';
            }
           
            
			break;
            
        case 'add_prod_x_are':
            $products = json_decode($_POST['products']);
            $sql_error = [];
            foreach ($products as $product) {
                $sql_add = "INSERT INTO inv_prod_x_are (id_prod, id_are, can_max, req_aprob) ";
                $sql_add .= "VALUES (?, ?, ?, ?) ";
                $query_add = $conexion ->prepare($sql_add);
                $query_add -> execute([$product->id_prod, $_POST['id_area'], $product -> can_max, $product -> req_aprob]);
                if($query_add == null){
                    $sql_error[] = printf("Errormessage: %s\n", $conexion->error);
                }
            }
            if (count($sql_error) == 0) {
                $resp['num'] = 1;
                $resp['text'] = 'Productos registrados correctamente';
            } else {
                $resp['num'] = 2;
                $resp['text'] = $sql_error;
            }
            
            break;

        case 'change_info_admin':
 
            $sql_upd_info = "UPDATE inv_config SET valor = ? WHERE id = ? ;";
            $sql_upd_info .= "UPDATE inv_config SET valor = ? WHERE id = ? ;";
            $query_upd_info = $conexion ->prepare($sql_upd_info);
            $query_upd_info -> execute([$_POST['name'], 1, $_POST['email'], 2]);
            
            if ($query_upd_info) {
                $resp['num'] = 1;
                $resp['text'] = 'Correo Actualizado Exitosamente';
            } else {
                $resp['num'] = 2;
                $resp['text'] = printf("Errormessage: %s\n", $conexion->error);
            }
            
            break;
	}
}
echo json_encode($resp); 