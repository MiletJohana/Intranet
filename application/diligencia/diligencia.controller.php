<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d H:i:s");
if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'add':
            $sql = "INSERT INTO `mq_diligencias`(`num_dlg`,
                                                `dir_dlg`,
                                                `tel_dlg`,
                                                `con_dlg`,
                                                `hor_dlg`,
                                                `dia_dlg`,
                                                `obs_dlg`,
                                                `dil_des`,
                                                `est_dlg`,
                                                `efc_dlg`,
                                                `fec_cre`,
                                                `lst_upt`,
                                                `cos_dlg`,
                                                `id_cli`,
                                                `id_tip_dlg`,
                                                `id_reg`,
                                                `usu_upt`,
                                                `nom_res`,
                                                `fot_dlg`) 
                                                VALUES (NULL,
                                                    '" . $_POST['dir_client'] . "',
                                                    '" . $_POST['tel_client'] . "',
                                                    '" . $_POST['con_client'] . "',
                                                    '" . $_POST['hor_cli1'] .' A '. $_POST['hor_cli2'] . "',
                                                    '" . $_POST['dia_dlg'] . "',
                                                    '',
                                                    '" . $_POST['dil_descri'] . "',
                                                    '1',
                                                    NULL,
                                                    '$fecha',
                                                    '$fecha',
                                                    '',
                                                    '" . $_POST['id_client'] . "',
                                                    '" . $_POST['id_tip_dlg'] . "',
                                                    '" . $_POST['id_regclient'] . "',
                                                    '$sesion_id',
                                                    '$sesion_usu',
                                                    '')";
            $query = $conexion->query($sql);
            if (isset($_POST['id_tip_dlg']) && $_POST['id_tip_dlg'] == 5) {
                //CONSULTAR ID DE DILIGENCIA
                $sqlSelectDilg = "SELECT * FROM mq_diligencias ORDER BY num_dlg DESC LIMIT 1";
                $querySelectDilg = $conexion->query($sqlSelectDilg);
                $rSelectDilg = $querySelectDilg->fetch(PDO::FETCH_ASSOC);

                $sqlInsDes = "INSERT INTO ind_desc (
                    id_desc, 
                    val_desc, 
                    cuo_des, 
                    per_desc, 
                    conc_desc, 
                    id_tip_desc, 
                    otro_tip_desc, 
                    id_usu, 
                    id_usus, 
                    id_are, 
                    id_reg, 
                    id_estado, 
                    fec_sis) VALUES ( NULL,
                    6000, 1, 
                    'Mensual', 
                    'Diligencia #" . $rSelectDilg['num_dlg'] . "',
                    5,
                    NULL, 
                    '$sesion_id', 
                    '$sesion_id', 
                    '$sesion_are', 
                    '$sesion_reg', 
                    5, 
                    '$fecha')";
                $queryInsDes = $conexion->query($sqlInsDes);
                //CONSULTAR ULTIMO DESCUENTO
                $sqlSelectDesc = "SELECT * FROM ind_desc ORDER BY id_desc DESC LIMIT 1";
                $querySelectDesc = $conexion->query($sqlSelectDesc);
                $rSelectDesc = $querySelectDesc->fetch(PDO::FETCH_ASSOC);

                $sqlInsCuo = "INSERT INTO ind_des_cuo (id_desc, cuot_desc, fec_desc)
                             VALUES (" . $rSelectDesc['id_desc'] . ", " . $rSelectDesc['val_desc'] . ", '" . $fecha . "')";
                $queryInsCuo = $conexion->query($sqlInsCuo);

                for ($i = 0; $i < 2; $i++) {
                    $sqlInsSeg = "INSERT INTO ind_desc_x_seg (id_desc, 
                                                id_usu, 
                                                id_are, 
                                                fec_mod, 
                                                id_estado) 
                                                VALUES (
                                                " . $rSelectDesc['id_desc'] . ", 
                                                $sesion_id, 
                                                $sesion_are, 
                                                '$fecha', ";
                                                if ($i == 1) {
                                                    $sqlInsSeg .= "1)";
                                                } else {
                                                    $sqlInsSeg .= "5)";
                                                }
                    $queryInsSeg = $conexion->query($sqlInsSeg);
                }
            }
            if ($query != null) {
                echo "Diligencia creada correctamente.";
            } else {
                printf("Errormessage: %s\n", $conexion->error);
            }
            break;

        case 'update':
            $sql = "UPDATE `mq_diligencias` SET   id_cli  =   '" . $_POST['id_client'] . "',
                                        dir_dlg =   '" . $_POST['dir_client'] . "',
                                        tel_dlg =   '" . $_POST['tel_client'] . "',
                                        con_dlg =   '" . $_POST['con_client'] . "',
                                        hor_dlg =   '" . $_POST['hor_cli1'] .' A '. $_POST['hor_cli2'] . "',
			        					id_tip_dlg ='" . $_POST['id_tip_dlg'] . "',
			        					dia_dlg	=	'" . $_POST['dia_dlg'] . "',
			        					dil_des =	'" . $_POST['dil_descri'] . "',
			        					est_dlg =	'" . $_POST['est_dlg'] . "',
                                        obs_dlg=    '" . $_POST['obs_dlg'] . "',
                                        lst_upt=    '$fecha',
                                        usu_upt=    '$sesion_usu'
			        			  WHERE num_dlg	=	'" . $_POST['num_dlg'] . "'";
            $query = $conexion->query($sql);
            if ($query != null) {
                echo "Diligencia actualizada correctamente";
            } else {
                printf("Errormessage: %s\n", $conexion->error);
                echo $sql;
            }

            break;

        case 'delete':
            $sql = "DELETE FROM `mq_diligencias` WHERE num_dlg = \"$_POST[id]\"";
            $query = $conexion->query($sql);
            if ($query != null) {
                echo "Diligencia eliminada correctamente";
            } else {
                printf("Errormessage: %s\n", $conexion->error);
            }
        break;

        case 'updateClient':
            $sql = "UPDATE mq_clientes SET  tel_cli='" . $_POST['tel_client'] . "',
                                            hor_cli1='" . $_POST['hor_cli1'] . "',
                                            hor_cli2='" . $_POST['hor_cli2'] . "',
                                            dir_cli='" . $_POST['dir_client'] . "'
                                      WHERE id_cli='" . $_POST['id_client'] . "'";
            $query = $conexion->query($sql);
            if ($query != null) {
                echo "<div class='alert alert-success alert-dismissible fade show mt-4 d-flex align-items-center' role='alert'>
                        <i class='fa-solid fa-circle-check me-2 fa-xl'></i>
                        Cliente actualizado correctamente. 
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                      </div>";
            } else {
                printf("Errormessage: %s\n", $conexion->error);
            }
            break;
    }
} else {
    echo $sesion_usu;
}
