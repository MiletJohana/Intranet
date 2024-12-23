<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';
$fecha = date("Y-m-d H:i:s");
function validar($value)
{
    if ($value == '' || is_null($value)) {
        return 'NULL';
    } else {
        return $value;
    }
}
if (isset($_POST['actionCli'])) {
    switch ($_POST['actionCli']) {
        case 'addCliente':
            //MOVER ARCHIVO DE LOGO A DIRECTORIO
            $file = "../../documentos/clientes/logos/";
            opendir($file);
            if (!empty($_FILES['log_cli']['tmp_name'])) {
                $log_cli = $_FILES['log_cli']['name'];
                $destino = $file . $log_cli;
                copy($_FILES['log_cli']['tmp_name'], $destino);
            }
            //NUEVO CLIENTE
            $sqlAddCli = "INSERT INTO mq_clientes
                (nom_cli, 
                tip_doc, 
                num_doc, 
                id_tipo, 
                id_cat, 
                id_act, 
                tel_cli, 
                eml_cli, 
                web_cli, 
                zip_cli, 
                hor_cli1, 
                hor_cli2, 
                dir_cli, 
                id_ciu, 
                log_cli, 
                ase_com, 
                rep_sac, 
                id_usu, 
                act_eco)
                VALUES
                ('" . $_POST['nom_cli'] . "', 
                '" . $_POST['tip_doc'] . "', 
                '" . $_POST['num_doc'] . "', 
                " . validar($_POST['tip_cli']) . ", 
                " . validar($_POST['id_cat']) . ", 
                " . validar($_POST['id_act']) . ", 
                '" . $_POST['tel_cli'] . "', 
                '" . $_POST['eml_cli'] . "', 
                '" . $_POST['web_cli'] . "', 
                " . validar($_POST['zip_cli']) . ", 
                '" . $_POST['hor_cli1'] . "', 
                '" . $_POST['hor_cli2'] . "', 
                '" . $_POST['dir_cli'] . "', 
                " . validar($_POST['id_ciu']) . ", 
                '" . $log_cli . "',
                '" . $_POST['ase_com'] . "', 
                '" . $_POST['rep_sac'] . "', 
                '$sesion_id',
                '" . $_POST['id_act'] . "')";
            $queryAddCli = $conexion->query($sqlAddCli);
            //CONSULTA DE ULTIMO CLIENTE
            $sqlLast = "SELECT * FROM mq_clientes 
            ORDER BY id_cli DESC
            LIMIT 1";
            $queryLast = $conexion->query($sqlLast);
            $rL = $queryLast->fetch(PDO::FETCH_ASSOC);
            //NUEVO CONTACTO
            if ($queryAddCli != null) {
                $cont = 1;
                if (isset($_POST['nom_cont1']) && $_POST['nom_cont1'] != '') {
                    $cont = 2;
                } else if (isset($_POST['nom_cont2']) && $_POST['nom_cont2'] != '') {
                    $cont = 3;
                } else if (isset($_POST['nom_cont3']) && $_POST['nom_cont3'] != '') {
                    $cont = 4;
                } else if (isset($_POST['nom_cont4']) && $_POST['nom_cont4'] != '') {
                    $cont = 5;
                }
                for ($i = 0; $i < $cont; $i++) {
                    $sqlAddCont = "INSERT INTO contactos
                    (nom_cont, 
                    eml_cont, 
                    car_cont, 
                    tel_cont, 
                    id_cli)
                    VALUES
                    ('" . $_POST['nom_cont' . $i] . "', 
                    '" . $_POST['eml_cont' . $i] . "', 
                    '" . $_POST['car_cont' . $i] . "', 
                    " . validar($_POST['tel_cont' . $i]) . ","
                    . $rL['id_cli'] . ")";
                    $queryAddCont = $conexion->query($sqlAddCont);
                }
               
                echo $rL['id_cli'];

            } else{
                printf("Errormessage: %s\n", $conexion->error);
                echo $sqlAddCli;
                echo "<br>" . $sqlAddCont;
            }
        break;
        
        case 'updateCliente':
            $file = "../../documentos/clientes/logos/";
            opendir($file);
            if (!empty($_FILES['log_cli']['tmp_name'])) {
                $log_cli = $_FILES['log_cli']['name'];
                $destino = $file . $log_cli;
                copy($_FILES['log_cli']['tmp_name'], $destino);
            }
            //Editar cliente
            $sqlUpt = "UPDATE mq_clientes 
            SET nom_cli = '" . $_POST['nom_cli'] . "', 
            tip_doc = '" . $_POST['tip_doc'] . "', 
            num_doc = '" . $_POST['num_doc'] . "', 
            id_tipo = " . validar($_POST['tip_cli']) . ", 
            id_cat = " . validar($_POST['id_cat']) . ", 
            id_act = " . validar($_POST['id_act']) . ", 
            tel_cli = '" . $_POST['tel_cli'] . "', 
            eml_cli = '" . $_POST['eml_cli'] . "', 
            web_cli = '" . $_POST['web_cli'] . "', 
            zip_cli = " . validar($_POST['zip_cli']) . ", 
            hor_cli1 = '" . $_POST['hor_cli1'] . "', 
            hor_cli2 = '" . $_POST['hor_cli2'] . "', 
            dir_cli = '" . $_POST['dir_cli'] . "', 
            id_ciu = " . validar($_POST['id_ciu']) . ", 
            log_cli = '$log_cli',
            ase_com = '" . $_POST['ase_com'] . "',
            rep_sac = '" . $_POST['rep_sac'] . "',
            act_eco = '" . $_POST['id_act'] . "'
            WHERE id_cli = " . $_POST['id_cli'];
            $queryUpt = $conexion->query($sqlUpt);

            if ($queryUpt != null) {
                echo "Cliente actualizado correctamente";
            } else {
                printf("Errormessage: %s\n", $conexion->error);
                echo $sqlUpt;
            }
        break;

        
    }
}
