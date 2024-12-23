<?php 

include '../../conexion.php';
include "../../resources/template/credentials.php";

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d H:i:s");

//echo var_dump($_POST);

$resp = [];

if (isset($_POST['action'])) {

	switch ($_POST['action']) {

		case 'new_cant_prod':
            $sql_info = "SELECT * FROM inv_inventario WHERE id_inv = ".$_POST['id'].";";
            $query_info = $conexion ->query($sql_info);
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
                $sqlUpdate .= " WHERE id_inv = ".$_POST['id'].";";

                $queryUpdate = $conexion->query($sqlUpdate);
                if ($queryUpdate != null) {
                    $resp['num'] = 1;
                    $resp['text'] = 'Cantidad Actualizada Correctamente';
                } else {
                    $resp['num'] = 3;
                    $resp['text'] = printf("Errormessage: %s\n", $conexion->error);
                }  
            } 
            
			break;


        case 'adm_inventario':
            $sql_info = "SELECT * FROM inv_inventario WHERE id_reg = ".$_POST['id_reg'].";";
            $query_info = $conexion ->query($sql_info);
            $rowInfo = $query_info->fetchAll(PDO::FETCH_ASSOC);

            if($query_info){
                $id_products = explode(',' , $_POST['id_products']);
                $inventario_prod = array_column($rowInfo, 'id_prod');

                $errores = [];

                /* Validar si hay productos por eliminar */
                $delete_product = array_diff($inventario_prod, $id_products);

                if(count($delete_product) > 0){
                    foreach ($delete_product as $id_prod) {
                        $sql_delete = "DELETE FROM inv_inventario WHERE id_prod = ".$id_prod." AND id_reg = ".$_POST['id_reg'].";";
                        $query_delete = $conexion ->query($sql_delete);

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
                        $sql_add .= "VALUES ('".$id_prod."', '".$_POST['id_reg']."', 0, '".$fecha."', '".$sesion_id."') ";
                        $query_add = $conexion ->query($sql_add);

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
               
            }
            else{
                $resp['num'] = 3;
                $resp['text'] = 'Error al encontrar la regional, contacte con el soporte';
            }
           

           /* $update_info = [];

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
                $sqlUpdate .= " WHERE id_inv = ".$_POST['id'].";";

                $queryUpdate = $conexion->query($sqlUpdate);
                if ($queryUpdate != null) {
                    $resp['num'] = 1;
                    $resp['text'] = 'Cantidad Actualizada Correctamente';
                } else {
                    $resp['num'] = 3;
                    $resp['text'] = printf("Errormessage: %s\n", $conexion->error);
                }  
            } */
            
			break;
	}

}

echo json_encode($resp); 