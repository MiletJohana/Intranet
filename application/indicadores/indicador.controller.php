<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d H:i:s");
$hora = date("H:i:s");
if (isset($_GET["id_usu"])) {
    require_once '../../resources/utils/phppdf/vendor/autoload.php';
    $us = $_GET["id_usu"];
    $id_carg = $_GET["id_carg"];
    $usu_elim = $_GET["usu_elim"];

    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'format' => 'A4', '', '', '2', '2', '2', '2'
    ]);
    $mpdf->allow_charset_conversion = true;
    $mpdf->charset_in = 'UTF-8';
    $mpdf->setAutoTopMargin = 'stretch';
    $mpdf->setAutoBottomMargin = 'stretch';
    $mpdf->SetHTMLHeader('
    <table align="center">
        <tr>
            <td width="100%"><img src="../../resources/img/documentos/logo sin bureo.jpg" width="100%"></td>
        </tr>
    </table>', 'O');
    $mpdf->SetHTMLFooter(' 

      <div class="notice "align="center">
         <img src="../../resources/img/documentos/imagen2.jpg" width="100%" >
      </div>

   ', 'O');

    if ($usu_elim == 1) {
        include "../certificados/pdf_usu.php";
    } elseif ($usu_elim == 0) {
        include "../certificados/pdf_usu.php";
    }

    $mpdf->WriteHTML($html);
    $mpdf->Output("certificacion.pdf", 'I');
}

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'addPer':
            include 'fechFestivos.php';
            $sqlcarg = "SELECT * FROM ind_cargos WHERE id_carg = " . $_POST['car_per'];
            $querycarg = $conexion->query($sqlcarg);
            $rC = $querycarg->fetch(PDO::FETCH_ASSOC);
            $diasTab = $rC['tot_car'];
            $dias = $_POST['fech_crea'];
            for ($i = 0; $i < 60; $i++) {
                $c = 50;
                $c2 = $diasTab + 1;
            }
            for ($a = 1; $a < $c; $a++) {
                $fechaini = "$dias";
                $arrayDates = getDateHoliday($year);
                $mas = strtotime("$dias" . '+' . $a . ' days');
                $fechafin = date("Y-m-d", $mas);
                getDiasHabiles($fechaini, $fechafin, $arrayDates);
                $hab = getDiasHabiles($fechaini, $fechafin, $arrayDates);
                if (count($hab) == $c2) {
                    $hab1 = $hab[$diasTab];
                    break;
                }
            }

            $sqlIngres = "INSERT INTO `ind_solcarg`
            (`id_solC`,
            `sal_sol`,
            `var_sal`,
            `rod_sal`,
            `area_sol`,
            `carg_sol`,
            `cont_sol`,
            `fecha_sol`,
            `fesi_sol`,
            `per_sol`,
            `id_estaSol`,
            `id_usu`";
            if (isset($_POST['observ']) && $_POST['observ'] != '') {
                $sqlIngres .= ",`obs_sol`";
            }
            if (isset($_POST['observ_nuev']) && $_POST['observ_nuev'] != '') {
                $sqlIngres .= ",`concep_sol`";
            }
            $sqlIngres .= ",  `car_sol`,
                             `fec_estip`)";
            $sqlIngres .= " VALUES(
            NULL,
            '" . $_POST['sala'] . "',
            '" . $_POST['var_sal'] . "',
            '" . $_POST['rod_sal'] . "',
            '" . $_POST['are_carg'] . "',
            '" . $_POST['car_per'] . "',
            '" . $_POST['tip'] . "',
            '" . $_POST['fech_crea'] . "',
                '$fecha',
            '" . $_POST['can_per'] . "',
            '1',
            '" . $_SESSION['id'] . "'";
            if (isset($_POST['observ']) && $_POST['observ'] != '') {
                $sqlIngres .= ",'" . $_POST['observ'] . "'";
            }
            if (isset($_POST['observ_nuev']) && $_POST['observ_nuev'] != '') {
                $sqlIngres .= ", '" . $_POST['observ_nuev'] . "'";
            }
            if (strlen($_POST['car_per']) >= 4) {
                $sqlIngres .= ",'1'";
            } else {
                $sqlIngres .= ",'NULL'";
            }
            $sqlIngres .= ", '$hab1'  )";
            $queryIngres = $conexion->query($sqlIngres);

            if ($queryIngres != null) {
                //echo $sqlIngres;
                echo   "Solicitud Creada Correctamente";
            } else {
                echo $sqlIngres;
                //  printf("Errormessage: %s\n", $conexion->error);
            }
            break;

        case 'addCargo':
            $sqlUltimoCargo = "SELECT id_carg FROM ind_cargos ORDER BY id_carg DESC LIMIT 1;";
            $queryUltimoCargo = $conexion->query($sqlUltimoCargo);
            $rUltimoCargo = $queryUltimoCargo->fetch(PDO::FETCH_ASSOC);
            $id_cargo = (int) $rUltimoCargo['id_carg'];

            $sqlAddCargo = "INSERT INTO ind_cargos (id_carg,
                                                    nom_carg,
                                                    descr_car,
                                                    id_are)
                            VALUES ('".($id_cargo+1)."',
                                    '" . $_POST['car_per1'] . "',
                                    '" . $_POST['observ_cargo'] . "',
                                    '" . $_POST['are_carg1'] . "')";

            $queryAddCargo = $conexion->query($sqlAddCargo);

            $sqlCargo1 = "INSERT INTO ind_carg_x_are (id_carg,
                                                        id_are)
                            VALUES ('".($id_cargo+1)."',
                                    '" . $_POST['are_carg1'] . "')";

            $queryCargo1 = $conexion->query($sqlCargo1);
    
            if ($queryAddCargo != null && $queryCargo1 != null) {
                //echo $sqlIngres;
                echo 3;
            } else {
                echo $sqlAddCargo .','. $sqlCargo1;
                //  printf("Errormessage: %s\n", $conexion->error);
            }
            break;

        case 'certif':
            $sqlB = "SELECT * FROM mq_usu WHERE id_usu='" . $_SESSION['id'] . "'";
            $queryB = $conexion->query($sqlB);
            $rB = $queryB->fetch(PDO::FETCH_ASSOC);

            $sqlCero = "UPDATE mq_usu SET cer_salario='NULL',
                                        cer_varia='NULL',
                                        cer_rodam= 'NULL',
                                        cer_sinsal='NULL',
                                        destino_cert= 'NULL'
                                        WHERE id_usu = '" . $_POST['id_usu'] . "'";
            $queryCero = $conexion->query($sqlCero);

            $ruta = "../indicadores/indicador.controller.php?id_usu=" . $_SESSION['id'] . "&id_carg=" . $rB['id_carg'] . "&usu_elim=" . $rB['usu_elim'];

            $sqlCet1 = "INSERT INTO 
                ind_cert_x_usu
                (id_usu,
                lugar_remi,
                id_carg, 
                ruta_pdf,
                fec_creacion,
                cer_salario,
                cer_varia, ";
            if (isset($_POST['prom_var']) && $_POST['prom_var'] != '') {
                $sqlCet1 .= " prom_varia,";
            }
            $sqlCet1 .=
                "cer_rodam,
                cer_sinsal)
                VALUES
                ('" . $rB['id_usu'] . "',
                '" . $_POST['des_cert'] . "',
                '" . $rB['id_carg'] . "',
                '$ruta',
                '$fecha',
                '" . $_POST['salario'] . "',
                '" . $_POST['variable'] . "'";
            if (isset($_POST['prom_var']) && $_POST['prom_var'] != '') {
                $sqlCet1 .= ", '" . $_POST['prom_var'] . "'";
            }
            $sqlCet1 .=
                ",'" . $_POST['rodamiento'] . "',
                '" . $_POST['nosalario'] . "')";
            $queryCet1 = $conexion->query($sqlCet1);

            $sqlCert = "UPDATE mq_usu SET   cer_salario='" . $_POST['salario'] . "',
                                            cer_varia='" . $_POST['variable'] . "',
                                            cer_rodam= '" . $_POST['rodamiento'] . "',
                                            cer_sinsal='" . $_POST['nosalario'] . "',
                                            destino_cert= '" . $_POST['des_cert'] . "',
                                            prom_varia='" . $_POST['prom_var'] . "',
                                            url_cert='$ruta'
                                        WHERE id_usu = '" . $_SESSION['id'] . "'";
            $querCert = $conexion->query($sqlCert);

            if ($querCert != null && $queryCet1 != null && $queryCero != null) {
                echo $ruta;
                // echo $sqlCert;
                //echo $sqlCet1;
                //echo $sqlCero;
            } else {
                echo $sqlCert;
                echo $sqlCet1;
                printf("Errormessage: %s\n", $conexion->error);
            }
            break;
        case 'certif2':
            $sqlB = "SELECT * FROM mq_usu WHERE id_usu='" . $_POST['id_usu'] . "'";
            $queryB = $conexion->query($sqlB);
            $rB1 = $queryB->fetch(PDO::FETCH_ASSOC);
            $sqlCero = "UPDATE mq_usu SET cer_salario='NULL',
                                        cer_varia='NULL',
                                        cer_rodam= 'NULL',
                                        cer_sinsal='NULL',
                                        destino_cert= 'NULL'
                                        WHERE id_usu = '" . $_POST['id_usu'] . "'";
            $queryCero = $conexion->query($sqlCero);

            $ruta = "../indicadores/indicador.controller.php?id_usu=" . $_POST['id_usu'] . "&id_carg=" . $rB1['id_carg'] . "&usu_elim=" . $rB1['usu_elim'];

            $sqlCe1 = "INSERT INTO 
                ind_cert_x_usu
                (id_usu,
                lugar_remi,
                id_carg, 
                ruta_pdf,
                fec_creacion,
                cer_salario,
                cer_varia,";
            if (isset($_POST['prom_var']) && $_POST['prom_var'] != '') {
                $sqlCe1 .= " prom_varia,";
            }
            $sqlCe1 .=
                "cer_rodam,
                cer_sinsal)
                VALUES
                ('" . $rB1['id_usu'] . "',
                '" . $_POST['des_cert'] . "',
                '" . $rB1['id_carg'] . "',
                '$ruta',
                '$fecha',
                '" . $_POST['salario'] . "',
                '" . $_POST['variable'] . "'";
            if (isset($_POST['prom_var']) && $_POST['prom_var'] != '') {
                $sqlCe1 .= ", '" . $_POST['prom_var'] . "'";
            }
            $sqlCe1 .=
                ",'" . $_POST['rodamiento'] . "',
                '" . $_POST['nosalario'] . "')";
            $queryCe1 = $conexion->query($sqlCe1);

            $sqlCert = "UPDATE mq_usu SET cer_salario='" . $_POST['salario'] . "',
                                        cer_varia='" . $_POST['variable'] . "',
                                        cer_rodam= '" . $_POST['rodamiento'] . "',
                                        cer_sinsal='" . $_POST['nosalario'] . "',
                                        destino_cert= '" . $_POST['des_cert'] . "',
                                        prom_varia='" . $_POST['prom_var'] . "',
                                        url_cert='$ruta'
                                        WHERE id_usu = '" . $_POST['id_usu'] . "'";
            $querCert = $conexion->query($sqlCert);

            if ($querCert != null && $queryCe1 != null) {
                echo $ruta;
                //echo $sqlCert;
                //echo $sqlCe1;
            } else {
                echo $sqlCert;
                echo $sqlCe1;
                printf("Errormessage: %s\n", $conexion->error);
            }
            break;
        case 'certif3':

            $sqlBus = "SELECT * FROM mq_usu WHERE id_usu='" . $_POST['id_usu'] . "'";
            $queryBus = $conexion->query($sqlBus);
            $rB3 = $queryBus->fetch(PDO::FETCH_ASSOC);
            $ruta = "../indicadores/indicador.controller.php?id_usu=" . $_POST['id_usu'] . "&id_carg=" . $rB3['id_carg'] . "&usu_elim=" . $rB3['usu_elim'];

            $sqlCe3 = "INSERT INTO 
                ind_cert_x_usu
                (id_usu,
                lugar_remi,
                id_carg, 
                ruta_pdf,
                fec_creacion,
                cer_salario,
                cer_varia,";
            if (isset($_POST['prom_var']) && $_POST['prom_var'] != '') {
                $sqlCe3 .= " prom_varia,";
            }
            $sqlCe3 .=
                "cer_rodam,
                cer_sinsal)
                VALUES
                ('" . $_POST['id_usu'] . "',
                'NULL',
                '" . $rB3['id_carg'] . "',
                '$ruta',
                '$fecha',
                'NULL',
                'NULL',";
            if (isset($_POST['prom_var']) && $_POST['prom_var'] != '') {
                $sqlCe3 .= ",'NULL'";
            }
            $sqlCe3 .= "
                '0',
                '0')";
            $queryCe3 = $conexion->query($sqlCe3);

            $sqlCert2 = "UPDATE mq_usu SET url_cert='$ruta'
                                       WHERE id_usu = '" . $_POST['id_usu'] . "'";
            $querCert2 = $conexion->query($sqlCert2);

            if ($querCert2 != null && $queryCe3 != null) {
                echo $ruta;
                //echo $sqlCert;
                //echo $sqlCe1;
            } else {
                //  echo $sqlBus;
                //echo $sqlCert;
                //echo $sqlCe1;
                printf("Errormessage: %s\n", $conexion->error);
            }
            break;

        case 'aceptado':
            $sqlAcept = "UPDATE ind_solcarg SET id_estaSol='2'
                                WHERE id_solC='" . $_POST['id_solC'] . "'";
            $queryAcept = $conexion->query($sqlAcept);
            if ($queryAcept != null) {
                echo 1;
            } else {
                printf("Errormessage: %s\n", $conexion->error);
            }
            break;

        case 'aceptado2':
            include 'fechFestivos.php';
            $sqlRet = " SELECT fech_ref FROM ind_infoli WHERE id_liqui='" . $_POST['id_liqui'] . "'";
            $queryRet = $conexion->query($sqlRet);
            $rR = $queryRet->fetch(PDO::FETCH_ASSOC);
            $fech_ini = $rR['fech_ref'];
            $fech_fin = $fecha;
            $arrayDates = getDateHoliday($year);
            $habil = getDiasHabiles($fech_ini, $fech_fin, $arrayDates);
            $habilC = count($habil);
            //print_r($habilC);
            $pagos = NULL;
            if (count($habil) == 0) {
                $fech_fin = $rR['fech_ref'];
                $fech_ini = $fecha;
                $habil = getDiasHabiles($fech_ini, $fech_fin, $arrayDates);
                $habil2 = count($habil) + 1;
                $pagos = 1;
            } else if (count($habil) == 1) {
                $fech_fin = $rR['fech_ref'];
                $fech_ini = $fecha;
                $habil = getDiasHabiles($fech_ini, $fech_fin, $arrayDates);
                $habil2 = count($habil);
                $pagos = 1;
            }
            if ($pagos != 1) {
                $habil3 = '-' . $habilC + 1;
                $sqlEntr = "UPDATE ind_infoli SET fech_pag   ='$fecha',
                                                    dias_habiles='$habil3'
                                                    WHERE id_liqui='" . $_POST['id_liqui'] . "'";
                $queryEntr = $conexion->query($sqlEntr);
            } else {
                $sqlEntr = "UPDATE ind_infoli SET fech_pag   ='$fecha',
                                                        dias_habiles='$habil2'
                                                WHERE id_liqui='" . $_POST['id_liqui'] . "'";
                $queryEntr = $conexion->query($sqlEntr);
            }
            if ($queryEntr != null) {
                echo 1;
            } else {
                echo $sqlEntr;
                printf("Errormessage: %s\n", $conexion->error);
            }

            break;
        case 'aceptadoFech':
            include 'fechFestivos.php';
            $sql_Fech = "SELECT fech_pag,fech_ref  FROM ind_fechas WHERE id_relPag='" . $_POST['id_relPag'] . "'";
            $query_Fech = $conexion->query($sql_Fech);
            $rF = $query_Fech->fetch(PDO::FETCH_ASSOC);
            $fech_ini = $rF['fech_ref'];
            $fech_fin = $fecha;
            $arrayDates = getDateHoliday($year);
            $habil = getDiasHabiles($fech_ini, $fech_fin, $arrayDates);
            $habilC = count($habil);
            $pagos = NULL;
            if (count($habil) == 0) {
                $fech_fin = $rF['fech_ref'];
                $fech_ini = $fecha;
                $habil = getDiasHabiles($fech_ini, $fech_fin, $arrayDates);
                $habil2 = count($habil) + 1;
                $pagos = 1;
            } else if (count($habil) == 1) {
                $fech_fin = $rF['fech_ref'];
                $fech_ini = $fecha;
                $habil = getDiasHabiles($fech_ini, $fech_fin, $arrayDates);
                $habil2 = count($habil);
                $pagos = 1;
            }
            if ($pagos != 1) {
                $habil3 = '-' . $habilC + 1;
                $sqlPagado = "UPDATE ind_fechas SET fec_ent='$fecha',
                                            dias_indicador='$habil3'
                                            WHERE id_relPag='" . $_POST['id_relPag'] . "'";
                $queryPagado = $conexion->query($sqlPagado);
            } else {
                $sqlPagado = "UPDATE ind_fechas SET fec_ent='$fecha',
                                        dias_indicador='$habil2'
                                        WHERE id_relPag='" . $_POST['id_relPag'] . "'";
                $queryPagado = $conexion->query($sqlPagado);
            }
            if ($queryPagado != null) {
                echo 1;
            } else {
                // echo $sqlPagado;
                printf("Errormessage: %s\n", $conexion->error);
            }
            break;
        case 'procesos':
            if ($_POST['param'] == 1) {
                $sqlPro = "UPDATE ind_select_per SET pro_entre ='Si' WHERE id_sel= " . $_POST['id'];
                $queryPro = $conexion->query($sqlPro);
            } elseif ($_POST['param'] == 2) {
                $sqlPro = "UPDATE ind_select_per SET pro_prue ='Si' WHERE id_sel= " . $_POST['id'];
                $queryPro = $conexion->query($sqlPro);
            } elseif ($_POST['param'] == 3) {
                $sqlPro = "UPDATE ind_select_per SET pro_ana ='Si' WHERE id_sel= " . $_POST['id'];
                $queryPro = $conexion->query($sqlPro);
            } elseif ($_POST['param'] == 4) {
                $sqlPro = "UPDATE ind_select_per SET pro_poli ='Si' WHERE id_sel= " . $_POST['id'];
                $queryPro = $conexion->query($sqlPro);
            } elseif ($_POST['param'] == 5) {
                $sqlPro = "UPDATE ind_select_per SET pro_visi ='Si' WHERE id_sel= " . $_POST['id'];
                $queryPro = $conexion->query($sqlPro);
            }
            break;
            
        case 'updatePer':
            $sqlUpdate = "UPDATE ind_solcarg 
                            SET   sal_sol   =  '" . $_POST['sala'] . "',
                                    var_sal   =  '" . $_POST['var_sal'] . "',
                                    rod_sal   =  '" . $_POST['rod_sal'] . "',
                                    area_sol  =  '" . $_POST['are_carg'] . "',
                                    carg_sol  =  '" . $_POST['car_per'] . "',
                                    cont_sol  =  '" . $_POST['tip'] . "',
                                    fecha_sol =  '" . $_POST['fech_crea'] . "',
                                    per_sol   =  '" . $_POST['can_per'] . "'";
            if (isset($_POST['observ'])) {
                $sqlUpdate .= ", obs_sol  = '" . $_POST['observ'] . "'";
            }
            if (isset($_POST['observ_nuev'])) {
                $sqlUpdate .= ", concep_sol  = '" . $_POST['observ_nuev'] . "'";
            }
            $sqlUpdate .= " WHERE id_solC='" . $_POST['id_solC'] . "'";

            $queryUpdate = $conexion->query($sqlUpdate);

            if ($queryUpdate != null) {

                echo "Solicitud Actualizada Correctamente.";
            } else {
                printf("Errormessage: %s\n", $sqlUpdate . '<br>');
            }
            break;

        case 'rechazarPer':
            $sql = "UPDATE ind_solcarg SET  id_estaSol='4',
                                                obs_rec='" . $_POST['observ'] . "' 
                                            WHERE id_solC='" . $_POST['id_solC'] . "'";
            $query = $conexion->query($sql);

            if ($query != null) {

                echo "Solicitud Rechazada Correctamente.";
            } else {
                //printf("Errormessage: %s\n", $sqlUpdate.'<br>');
            }
            break;
        case 'rechPer':
            $sqlCar1 = "UPDATE ind_select_per SET  id_estaSol='4',
                                                   obs_rech='" . $_POST['obser_rech'] . "' 
                                            WHERE  id_sel='" . $_POST['id_sel'] . "'";
            $queryCar1 = $conexion->query($sqlCar);

            if ($queryCar1 != null) {

                echo "Solicitud Rechazada Correctamente.";
            } else {
                //printf("Errormessage: %s\n", $sqlUpdate.'<br>');
            }

            break;

        case 'addSelect':
            $sqlBus = "SELECT * FROM ind_solcarg 
            WHERE id_estaSol != 5
            AND carg_sol=" . $_POST['id_solC'];

            $queryBus = $conexion->query($sqlBus);
            //echo $sqlBus;
            $rB = $queryBus->fetch(PDO::FETCH_ASSOC);
            $sql = "INSERT INTO ind_select_per (id_sel,
                id_solC,
                id_per,
                nom_per,
                id_usu,
                cel_per,
                ema_ent,
                fec_ent,
                id_estaSol,
                fec_cre,
                hor_ent,
                req_sol)
                VALUES (NULL,
                '" . $rB['id_solC'] . "',
                '" . $_POST['id_per'] . "',
                '" . $_POST['nom_per'] . "',
                '" . $_SESSION['id'] . "',
                '" . $_POST['cel_per'] . "',
                '" . $_POST['ema_ent'] . "',
                '" . $_POST['fec_ent'] . "',
                '2',
                '$fecha',
                '" . $_POST['hor_ent'] . "',
                '0'";
            $sql .=  ")";

            $query = $conexion->query($sql);
            if ($query != null) {
                //echo $sql;
                echo   "Agregada Correctamente";
            } else {
                echo 'No se ha podido agregar. Contacta con el administrador' . $sql;
            }

            include 'EmaEntre.php';
            break;

        case 'addUsu':
            $fecFirm = strtotime($_POST['fec_firm']);
            if (date("m", $fecFirm) > 6) {
                $mes = date("m", $fecFirm);
                $anio = date("Y", $fecFirm);
                for ($i = 0; $i < date("m", $fecFirm); $i++) {
                    if ($mes == ($i + 6)) {
                        $mes = $i;
                        $anio = $anio + 1;
                    }
                }
                if ($mes < 10) {
                    $mes = "0" . $mes;
                }
                $fecInd = $anio . "-" . $mes . "-" . date("d", $fecFirm);
            } else {
                $fecInd = date("Y", $fecFirm) . "-" . (date("m", $fecFirm) + 6) . "-" . date("d", $fecFirm);
            }
            $sqlUsu = "INSERT INTO mq_usu 
                (id_usu, 
                nom_usu, 
                usuario, 
                fec_crea, 
                fec_firm, 
                fec_ind,
                usu_upt,
                id_are,
                id_reg,
                id_carg,
                tip_contrato,
                sala_base,
                sala_varia,
                sal_roda) 
                VALUE (" . $_POST['id_usu'] . ", 
                '" . $_POST['nom_usu'] . "', 
                '" . $_POST['sug'] . "', 
                '$fecha', 
                '" . $_POST['fec_firm'] . "',
                '" . $fecInd . "',
                '" . $_SESSION['usu'] . "', 
                '" . $_POST['id_are'] . "', 
                '" . $_POST['id_reg'] . "',
                '" . $_POST['carg_usu'] . "',
                '" . $_POST['tip_con'] . "',
                '" . $_POST['sal_ba'] . "',
                '" . $_POST['sal_var'] . "',
                '" . $_POST['sal_rod'] . "')";
            $queryUsu = $conexion->query($sqlUsu);
            if ($queryUsu != null) {
                // echo $sqlUsu;
                echo   "Agregada Correctamente";
            } else {
                echo 'No se ha podido agregar. Contacta con el administrador <br> SQL: ' . $sqlUsu;
            }
            break;

        case 'updateSelect':
            $sql = "UPDATE ind_select_per SET ";
            $ids = explode(',', $_POST['id_solC']);
            $sql .= "id_per  ='" . $_POST['id_per'] . "',
                nom_per ='" . $_POST['nom_per'] . "',
                cel_per ='" . $_POST['cel_per'] . "',
                fec_ent ='" . $_POST['fec_ent'] . "',
                req_sol='0',
                hor_ent='" . $_POST['hor_ent'] . "'
                WHERE id_sel  ='" . $_POST['id_sel'] . "'";
            $query = $conexion->query($sql);
            if ($query != null) {
                echo   "Actualizada Correctamente";
            } else {
                echo 'No se ha podido agregar. Contacta con el administrador <br> SQL: ' . $sql;
            }
            break;


        case 'cargo':
            $sqlCar = "SELECT ind.id_are, ind.id_carg, car.nom_carg 
                    FROM ind_carg_x_are ind , ind_cargos car
                    WHERE ind.id_carg=car.id_carg
                    AND ind.id_are=" . $_POST['value'];
            $queryCar = $conexion->query($sqlCar);
            //echo $sqlCar;
            if ($queryCar->rowCount() > 0) {
                echo '<option>Seleccionar</option>';
                while ($r = $queryCar->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value=" . $r['id_carg'] . ">" . $r['nom_carg'] . "</option>";
                }
            } else {
                echo '<option>No hay resultados</option>';
            }
            break;

        case 'updateEst':
            $sql = "UPDATE ind_select_per SET   id_estaSol='" . $_POST['value'] . "',
                                                    fec_req ='$fecha'
                                            WHERE id_sel=" . $_POST['edit'];
            $query = $conexion->query($sql);
            $sqlSol = "SELECT * FROM ind_solcarg ind,ind_select_per per WHERE ind.id_solC=per.id_solC AND id_sel=" . $_POST['edit'];
            $querySol = $conexion->query($sqlSol);
            $rSol = $querySol->fetch(PDO::FETCH_ASSOC);
            if ($rSol['id_estaSol'] == '3' && $_POST['value'] == '3') {
                $sqlMod = "UPDATE ind_solcarg SET id_estaSol='5',
                                                        fec_fin='$fecha'
                                                WHERE id_solC=" . $rSol['id_solC'];
                $queryMod = $conexion->query($sqlMod);
            }
            if ($query != null) {
                echo 1;
            } else {
                echo $sql;
            }
            break;

        case 'obsPer':
            $sql = "UPDATE ind_select_per SET ";
            if ($_SESSION['are'] == 9 || $_SESSION['lid'] == 1) {
                $sql .= " obs_th='" . $_POST['value'] . "'";
            } elseif ($_SESSION['lid'] == 1 || $_SESSION['lid'] == 2) {
                $sql .= " obs_lid='" . $_POST['value'] . "'";
            } elseif ($_SESSION['lid'] == 1 || $_SESSION['lid'] == 4) {
                $sql .= " obs_ger='" . $_POST['value'] . "'";
            }
            $sql .= " WHERE id_sel=" . $_POST['edit'];
            $query = $conexion->query($sql);
            if ($query != null) {
                echo 1;
            } else {
                echo $sql;
            }
            break;

        case 'requerimiento':
            if ($_POST['resp'] == 1) {
                $sql = "SELECT * FROM ind_carg_x_are ind , ind_cargos car, mq_are ar
                                    WHERE ind.id_carg=car.id_carg 
                                    AND ind.id_are=ar.id_are
                                    order by nom_carg";
                $query = $conexion->query($sql);
            } elseif ($_POST['resp'] == 2) {
                $sql = "SELECT * FROM ind_solcarg sol, mq_are ar
                                    WHERE sol.area_sol=ar.id_are
                                    AND id_estaSol IN (1,2)
                                    ORDER BY nom_are";
                $query = $conexion->query($sql);
            }
            if ($query != null) {
                echo '<option value="">Seleccionar </option>';
                if ($_POST['resp'] == 1) {
                    while ($r = $query->fetch(PDO::FETCH_ASSOC)) {
                        echo '<option value="' . $r['id_carg'] . ',' . $r['id_are'] . '">' . $r['nom_carg'] . ' (' . $r['nom_are'] . ') </option>';
                    }
                } elseif ($_POST['resp'] == 2) {
                    while ($r = $query->fetch(PDO::FETCH_ASSOC)) {
                        $sqlCar = "SELECT nom_carg FROM ind_cargos WHERE id_carg=" . $r['carg_sol'];
                        $queryCar = $conexion->query($sqlCar);
                        $queryCar2 = $conexion->query($sqlCar);
                        $q = 0;
                        if ($queryCar->rowCount() > 0) {
                            $rCar = $queryCar->fetch(PDO::FETCH_ASSOC);
                            $q = 1;
                        }

                        echo '<option value="' . $r['id_solC'] . '">';
                        if ($q > 0) {
                            echo $rCar['nom_carg'];
                        } else {
                            echo $r['carg_sol'];
                        }
                        echo ' (' . $r['nom_are'] . ') </option>';
                    }
                }
            } else {
                echo $sql;
            }
            break;

        case 'updateUsu':
            $sql = "UPDATE mq_usu SET nom_usu='" . $_POST['nom_usu'] . "',
                                        id_reg ='" . $_POST['id_reg'] . "',
                                        id_are ='" . $_POST['id_are'] . "',
                                        fec_crea='$fecha'
                                WHERE   id_usu ='" . $_POST['id_usu'] . "'";
            $query = $conexion->query($sql);
            if ($query != null) {
                echo   "Creado Correctamente.";
            } else {
                echo 'No se ha podido crear. Contacta con el administrador';
            }
            break;

        case 'unique':
            echo 1;
            break;

        case 'pagos':
            include 'fechFestivos.php';
            $fech = $_POST["fech"];
            for ($i = 0; $i < count($fech); $i++) {
                if ($_POST['param'] == 1) {
                    $b = 5;
                    $b2 = 2;
                } elseif ($_POST['param'] == 2) {
                    $b = 5;
                    $b2 = 2;
                } elseif ($_POST['param'] == 3) {
                    $b = 10;
                    $b2 = 5;
                } elseif ($_POST['param'] == 4) {
                    $b = 20;
                    $b2 = 11;
                } elseif ($_POST['param'] == 5) {
                    $b = 10;
                    $b2 = 6;
                }
                for ($a = 1; $a < $b; $a++) {
                    $fechafin = "$fech[$i]";
                    $arrayDates = getDateHoliday($year);
                    $menos = strtotime("$fech[$i]" . '-' . $a . ' days');
                    $fechaini = date("Y-m-d", $menos);
                    getDiasHabiles($fechaini, $fechafin, $arrayDates);
                    $habil = getDiasHabiles($fechaini, $fechafin, $arrayDates);
                    // print_r($habil);
                    if (count($habil) == $b2) {
                        $habil1 = $habil[0];
                        break;
                    }
                }
                $id_rel = substr($fech[$i], 0, 7);
                $id = substr($fech[$i], 0, 4) . substr($fech[$i], 5, 2) . $_POST['param'];
                $sqlDelpa = 'DELETE FROM  ind_fechas WHERE fech_pag LIKE "%' . $id_rel . '%" AND id_pag="' . $_POST['param'] . '"';
                $queryDelpa = $conexion->query($sqlDelpa);

                $sqlFech = "INSERT INTO ind_fechas
                                                (`id_relPag`,
                                                `id_pag`,
                                                `fech_pag`,
                                                `fech_ref`)
                                                VALUES
                                                ($id,
                                                '" . $_POST['param'] . "',
                                                '$fech[$i]',
                                                '$habil1')";
                $queryFech = $conexion->query($sqlFech);
            }
            if ($queryFech != null) {
                echo "Pagos Creados Correctamente.";
                //echo $sqlFech;
            } else {
                printf("Errormessage: %s\n");
            }
            break;

        case 'usuario':
            $sqlUsua = "SELECT nom_usu, id_usu FROM mq_usu WHERE id_usu!='" . $_SESSION['id'] . "' AND id_are=" . $_POST['value'];
            $queryUsua = $conexion->query($sqlUsua);
            if ($queryUsua->rowCount() > 0) {
                echo '<option>Seleccionar</option>';
                while ($r = $queryUsua->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value=" . $r['id_usu'] . ">" . $r['nom_usu'] . "</option>";
                }
            }
            break;

        case 'liquidacion':
            include 'fechFestivos.php';
            $fech = $_POST["fecha_sol"];
            $c = 10;
            $c2 = 5;
            for ($a = 1; $a < $c; $a++) {
                $fechaini = $fech;
                $arrayDates = getDateHoliday($year);
                $menos = strtotime($fech . "+" . $a . " days");
                $fechafin = date("Y-m-d", $menos);
                getDiasHabiles($fechaini, $fechafin, $arrayDates);
                $habil = getDiasHabiles($fechaini, $fechafin, $arrayDates);
                if (count($habil) == $c2) {
                    $habil2 = $habil[4];
                }
            }
            $sqlLiq = "INSERT INTO ind_infoli
                                        (`id_liqui`,
                                         `id_are`,
                                         `id_usu`,
                                         `id_liquiInf`,
                                         `fec_ret`,
                                         `obs_info`, 
                                         `fech_ref`,
                                         `fech_sis`)
                                         VALUES
                                         (NULL,
                                         '" . $_POST['are_liq'] . "',
                                         '" . $_POST['usu_liq'] . "',
                                         '" . $_POST['mov_liq'] . "',
                                         '" . $_POST['fecha_sol'] . "',
                                         '" . $_POST['obse_inf'] . "',
                                          '$habil2',
                                          '$fecha')";
            $queryLiq = $conexion->query($sqlLiq);

            $sqlUsuL = "UPDATE mq_usu SET usu_elim ='1',
                                              tip_ret  ='" . $_POST['mov_liq'] . "',
                                              fec_ret  ='" . $_POST['fecha_sol'] . "'
                                         WHERE id_usu  ='" . $_POST['usu_liq'] . "'";
            $queryUsuL = $conexion->query($sqlUsuL);

            if ($queryLiq != null) {
                echo "Liquidacion Creada Correctamente.";
                // echo $sqlLiq;
                // echo $sqlUsuL;
            } else {
                printf("Errormessage: %s\n");
            }
            break;

        case 'updateLiq':
            $sqlUpLi = "SELECT * FROM ind_infoli WHERE id_liqui=" . $_POST['id_liqui'];
            $queryUpLi = $conexion->query($sqlUpLi);

            include 'fechFestivos.php';
            $fech = $_POST["fecha_sol"];
            $c = 10;
            $c2 = 6;
            for ($a = 1; $a < $c; $a++) {
                $fechaini = $fech;
                $arrayDates = getDateHoliday($year);
                $menos = strtotime($fech . "+" . $a . " days");
                $fechafin = date("Y-m-d", $menos);
                getDiasHabiles($fechaini, $fechafin, $arrayDates);
                $habil = getDiasHabiles($fechaini, $fechafin, $arrayDates);

                if (count($habil) == $c2) {
                    $habil2 = $habil[5];
                    echo $habil2;
                }
            }
            $sqlUpdLiq = " UPDATE ind_infoli SET id_are =  '" . $_POST['are_liq'] . "',
                                              id_usu =  '" . $_POST['usu_liq'] . "',
                                         id_liquiInf =  '" . $_POST['mov_liq'] . "',
                                             fec_ret =  '" . $_POST['fecha_sol'] . "',
                                            obs_info =  '" . $_POST['obse_inf'] . "',
                                            fech_ref =  '$habil2'
                                      WHERE id_liqui =  '" . $_POST['id_liqui'] . "'";
            $queryUpdLiq = $conexion->query($sqlUpdLiq);

            $sqlUsuu = "UPDATE mq_usu SET usu_elim ='1',
                                              tip_ret  ='" . $_POST['mov_liq'] . "',
                                              fec_ret  ='" . $_POST['fecha_sol'] . "'
                                         WHERE id_usu  ='" . $_POST['usu_liq'] . "'";
            $queryUsuu = $conexion->query($sqlUsuu);

            if ($queryUpdLiq != null) {
                echo "Liquidacion Actualizada Correctamente.";
            } else {
                printf("Errormessage: %s\n");
            }
            break;

        case 'errNom':
            setlocale(LC_TIME, 'spanish');
            $fechaErr = $_POST["fec_err"];
            $mes = substr($fechaErr, 5, 2);
            $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
            $meseT = $meses[$mes - 1];
            $sqlError = "INSERT INTO `ind_errores`
                                   (`id_error`,
                                    `fech_sis`,
                                    `fech_error`,
                                    `id_pag`,
                                    `col_error`,
                                    `erro_obser`,
                                    `error_per`,
                                    `id_estaErr`,
                                    `mes_err`)
                                    VALUES(
                                    NULL,
                                    '$fecha',
                                    '" . $_POST['fec_err'] . "',
                                    '" . $_POST['nom_var'] . "',
                                    '" . $_POST['cola_erro'] . "',
                                    '" . $_POST['obs_err'] . "',
                                    '" . $_POST['ses'] . "',
                                    '" . $_POST['est_err'] . "',
                                    '$meseT')";
            $queryError = $conexion->query($sqlError);
            if ($queryError != null) {
                //echo $sqlError;
                echo   "Solicitud Creada Correctamente";
            } else {
                echo $sqlError;
                printf("Errormessage: %s\n", $conexion->error);
            }
            break;

        case 'updaError':
            setlocale(LC_TIME, 'spanish');
            $fechaErr = $_POST["fec_err"];
            $mes = substr($fechaErr, 5, 2);
            $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
            $meseT = $meses[$mes - 1];
            $sqlupError = " UPDATE ind_errores SET fech_error = '" . $_POST['fec_err'] . "',
                                                   id_pag     = '" . $_POST['nom_var'] . "',
                                                   col_error  = '" . $_POST['cola_erro'] . "',
                                                   erro_obser = '" . $_POST['obs_err'] . "',
                                                   error_per  = '" . $_POST['ses'] . "',
                                                   id_estaErr = '" . $_POST['est_err'] . "',
                                                   mes_err    = '$meseT'
                                                WHERE id_error  = '" . $_POST['id_error'] . "'";
            $queryupError = $conexion->query($sqlupError);
            if ($queryupError != null) {
                //echo $sqlupError;
                echo   "Solicitud Actualizada Correctamente";
            } else {
                echo $sqlupError;
                printf("Errormessage: %s\n", $conexion->error);
            }
            break;
            //Trabajo de YAN

        case 'insAct':
            setlocale(LC_TIME, 'spanish');
            $fechaCap = $_POST['fec_act'];
            $mes = substr($fechaCap, 5, 2);
            $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
            $mesesT = $meses[$mes - 1];
            $sqlInsAct = "INSERT INTO ind_act(  id_act,
                                                fec_act, 
                                                nom_act, 
                                                cum_act,
                                                fec_cum,
                                                fec_sis,
                                                mes_act,
                                                id_usu) 
                                                VALUES (
                                                NULL,
                                                '" . $_POST['fec_act'] . "',
                                                '" . $_POST['nom_act'] . "',
                                                'No',
                                                NULL,
                                                '$fecha',
                                                '$mesesT',
                                                '" . $_SESSION['id'] . "')";
            $queryInsAct = $conexion->query($sqlInsAct);

            if ($queryInsAct != null) {
                //echo $sqlInsAct;
                echo "Solicitud Creada Correctamente";
            } else {
                echo $sqlInsAct;
                printf("Errormessage: %s\n", $conexion->error);
            }
            break;

        case 'editAct':
            $sqltraer = "SELECT * FROM ind_act where id_act = ".$_POST['id_act'];
            $querytraer = $conexion->query($sqltraer);
            $r = $querytraer->fetch(PDO::FETCH_OBJ);

            $fechaCap = $_POST['fec_act'];
            $mes = substr($fechaCap, 5, 2);
            $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
            $mesesT = $meses[$mes - 1];

            $sqlAct = "UPDATE ind_act SET    mes_act = '$mesesT'";
            if($r->fec_act !=  $_POST['fec_act'] ){
                $sqlAct .= ", fec_act= '". $_POST['fec_act'] ."'";
            }
            if( $r->nom_act  != $_POST['nom_act']){
                $sqlAct .= ", nom_act = '". $_POST['nom_act'] ."'";
            }
            $sqlAct .=" WHERE id_act= '". $_POST['id_act'] ."' ";

            $queryInsAct = $conexion->query($sqlAct);
            if ($sqlAct != null) {
                echo $sqlInsAct;
                echo "Solicitud Actualizada Correctamente";
            } else {
                echo $sqlInsAct;
                printf("Errormessage: %s\n", $conexion->error);
            }
            break;

        case 'insCap':
            $sqlInsCap = "INSERT INTO ind_cap 
            (id_cap,
             lug_cap,
             id_tipcap,
             otro_tip,
             obj_cap,
             tem_cap,
             resp_cap,
             id_are,
             fec_cap,
             eva_cap,
             prd_cap,
             real_cap,
             fec_real,
             id_usu,
             fec_sis) 
            VALUES (NULL,
             '" . $_POST['lug_cap'] . "',
             '" . $_POST['id_tipcap'] . "',
             '" . $_POST['otro_tip'] . "',
             '" . $_POST['obj_cap'] . "',
             '" . $_POST['tem_cap'] . "',
             '" . $_POST['resp_cap'] . "',
             '" . $_POST['id_are'] . "',
             '" . $_POST['fec_cap'] . "',
             '" . $_POST['eva_cap'] . "',
             '" . $_POST['prd_cap'] . "',
   
             '" . $_POST['real_cap'] . "', ";
            if (isset($_POST['real_cap']) && $_POST['real_cap'] == 'Si') {
                $sqlInsCap .= "'$fecha', ";
            } else {
                $sqlInsCap .= "NULL, ";
            }
            $sqlInsCap .= "'" . $_SESSION['id'] . "',
             '$fecha')";
            $queryInsCap = $conexion->query($sqlInsCap);

            if ($queryInsCap != null) {
                //echo $sqlInsAct;
                echo "Solicitud Creada Correctamente";
            } else {
                echo $sqlInsCap;
                printf("Errormessage: %s\n", $conexion->error);
            }
            break;

        case 'editCap':
            $sqlCap = "UPDATE ind_cap 
            SET lug_cap = '" . $_POST['lug_cap'] . "',
            id_tipcap = '" . $_POST['id_tipcap'] . "',
            otro_tip = '" . $_POST['otro_tip'] . "',
            obj_cap = '" . $_POST['obj_cap'] . "',
            tem_cap = '" . $_POST['tem_cap'] . "',
            resp_cap = '" . $_POST['resp_cap'] . "',
            id_are = '" . $_POST['id_are'] . "',
            fec_cap = '" . $_POST['fec_cap'] . "',
            eva_cap = '" . $_POST['eva_cap'] . "',
            prd_cap = '" . $_POST['prd_cap'] . "',";
            if (isset($_POST['real_cap']) && $_POST['real_cap'] == 'Si') {
                $sqlCap .= " real_cap = '" . $_POST['real_cap'] . "', 
                fec_real = '$fecha',";
            } else {
                $sqlCap .= " real_cap = '" . $_POST['real_cap'] . "', 
                fec_real = NULL, ";
            }
            $sqlCap .= " real_cap = '" . $_POST['real_cap'] . "' 
            WHERE id_cap =  '" . $_POST['id_cap'] . "'";
            $queryInsCap = $conexion->query($sqlCap);

            if ($queryInsCap != null) {
                echo "Solicitud Actualizada Correctamente";
            } else {
                echo $sqlCap;
                printf("Errormessage: %s\n", $conexion->error);
            }
            break;

        case 'insDesc':
            if ($sesion_reg != 1) {
                $_POST['id_usus'] = $_SESSION['id'];
            }
            // echo "idusus: " . $_POST['id_usus'];
            //Consultar usuario
            $sqlUsu = "SELECT * FROM mq_usu WHERE id_usu = " . $_POST['id_usus'];
            $queryUsu = $conexion->query($sqlUsu);
            $rSelectUsu = $queryUsu->fetch(PDO::FETCH_ASSOC);
            //Insertar descuento
            $sqlInsDes = "INSERT INTO ind_desc 
            (id_desc, 
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
            fec_sis, 
            fact_desc) 
            VALUES (
            NULL,
            " . $_POST['val_desc'] . ",
            " . $_POST['cant'] . ",
            'Mensual', 
            '" . $_POST['conc_desc'] . "',";
            if ($_SESSION['cargo'] == 550 || $_SESSION['cargo'] == 124 || $_SESSION['cargo'] == 17004) {
                $sqlInsDes .= "2 ,";
            } else {
                $sqlInsDes .= $_POST['id_tip_desc'] . ",";
            }
            if ($_POST['id_tip_desc'] == 4) {
                $sqlInsDes .= "'" . $_POST['otro_tip'] . "',";
            } else {
                $sqlInsDes .= "NULL,";
            }
            $sqlInsDes .= "'" . $_SESSION['id'] . "', 
            '" . $_POST['id_usus'] . "', 
            '" . $rSelectUsu['id_are'] . "',
            '" . $rSelectUsu['id_reg'] . "',";
            if ($_POST['id_tip_desc'] == 1 || $rSelectUsu['id_reg'] != 1) {
                $sqlInsDes .= " 2, ";
            } else {
                $sqlInsDes .= " 5, ";
            }
            $sqlInsDes .= "'$fecha', 
                          '" . $_POST['fact_desc'] . "')";
            $queryInsDes = $conexion->query($sqlInsDes);
            //echo $sqlInsDes;
            //Consulta ultimo descuento
            $sqlSelectDesc = "SELECT * FROM ind_desc ORDER BY id_desc DESC LIMIT 1";
            $querySelectDesc = $conexion->query($sqlSelectDesc);
            $rSelectDesc = $querySelectDesc->fetch(PDO::FETCH_ASSOC);
            //Insertar cuotas
            $cuotas = $_POST['cuotas'];
            $fechas = $_POST['fechas'];
            for ($i = 0; $i < sizeof($cuotas); $i++) {
                $sqlInsCuo = "INSERT INTO ind_des_cuo (id_desc, cuot_desc, fec_desc)
                VALUES (" . $rSelectDesc['id_desc'] . ", " . $cuotas[$i] . ", '" . $fechas[$i] . "')";
                $queryInsCuo = $conexion->query($sqlInsCuo);
            }
            //Insertar seguimiento como "Nueva"
            $sqlInsSeg = "INSERT INTO ind_desc_x_seg 
            (id_desc, 
            id_usu, 
            id_are,
            fec_mod,
            id_estado) 
            VALUES (
            " . $rSelectDesc['id_desc'] . ",
            $sesion_id,
            $sesion_are,
            '$fecha',1)";
            $queryInsSeg = $conexion->query($sqlInsSeg);
            //Insertar seguimiento
            $sqlInsSeg = "INSERT INTO ind_desc_x_seg 
            (id_desc, 
            id_usu, 
            id_are,
            fec_mod,
            id_estado) 
            VALUES (
            " . $rSelectDesc['id_desc'] . ",
            $sesion_id,
            $sesion_are,
            '$fecha',
            " . $rSelectDesc['id_estado'] . ")";
            $queryInsSeg = $conexion->query($sqlInsSeg);
            //Validación final
            if ($queryInsDes != null) {
                echo "Solicitud Creada Correctamente";

            } else {
                echo $sqlInsDes;
                printf(" Errormessage: %s\n", $conexion->error);
            }
            include 'Email.php';

            break;

        case 'editDesc':
            //Actualizar en descuento
            //UPDATE `ind_desc` SET `conc_desc` = 'Cositas' WHERE `ind_desc`.`id_desc` = 1;
            $sqlEditDesc = "UPDATE ind_desc 
            SET val_desc = " . $_POST['val_desc'] . ",
            cuo_des = " . $_POST['cant'] . ",
            conc_desc = '" . $_POST['conc_desc'] . "',";
            if ($_SESSION['cargo'] == 550 || $_SESSION['cargo'] == 124 || $_SESSION['cargo'] == 17004) {
                $sqlEditDesc .= "id_tip_desc = '2',";
            } else {
                $sqlEditDesc .= "id_tip_desc = '" . $_POST['id_tip_desc'] . "',";
            }
            if ($_POST['id_tip_desc'] == 4) {
                $sqlEditDesc .= "otro_tip_desc = '" . $_POST['otro_tip'] . "',";
            } else {
                $sqlEditDesc .= "otro_tip_desc = NULL, ";
            }
            $sqlEditDesc .= "id_usus = " . $_POST['id_usus'] . ",
                            fact_desc= '" . $_POST['fact_desc'] . "',
                            id_are = " . $_POST['id_are'] . " 
                            WHERE id_desc = " . $_POST['id_desc'];
            $queryEditDes = $conexion->query($sqlEditDesc);
            //Consulta de descuento
            $sqlSelectDes = "SELECT * FROM ind_desc WHERE id_desc = " . $_POST['id_desc'];
            $querySelectDes = $conexion->query($sqlSelectDes);
            $rSelectDes = $querySelectDes->fetch(PDO::FETCH_ASSOC);
            //Eliminar cuotas
            $sqlDelCuo = "DELETE FROM ind_des_cuo WHERE id_desc = " . $_POST['id_desc'];
            $queryDelCuo = $conexion->query($sqlDelCuo);
            //Insertar en cuotas
            $cuotas = $_POST['cuotas'];
            $fechas = $_POST['fechas'];
            for ($i = 0; $i < sizeof($cuotas); $i++) {
                $sqlInsCuo = "INSERT INTO ind_des_cuo (id_desc, cuot_desc, fec_desc)
                VALUES (" . $rSelectDes['id_desc'] . ", " . $cuotas[$i] . ", '" . $fechas[$i] . "')";
                $queryInsCuo = $conexion->query($sqlInsCuo);
            }
            //Insertar en seguimiento
            $sqlInsSeg = "INSERT INTO ind_desc_x_seg 
            (id_desc, 
            id_usu, 
            id_are,
            fec_mod,
            id_estado) 
            VALUES (
            " . $rSelectDes['id_desc'] . ",
            $sesion_id,
            $sesion_are,
            '$fecha',
            " . $rSelectDes['id_estado'] . ")";
            $queryInsSeg = $conexion->query($sqlInsSeg);
            //Errores
            if ($queryEditDes != null) {
                //echo $sqlEditDesc;
                echo "Solicitud Editada Correctamente";
            } else {
                echo $sqlEditDesc;
                printf("Errormessage: %s\n", $conexion->error);
            }
            include 'Email.php';
            break;

        case 'usuarios':
            if ($_POST['param'] == 1) {
                $sqlUsua = "SELECT nom_usu, id_usu FROM mq_usu WHERE id_are=" . $_POST['value'] . " AND usu_elim = 0";
                $queryUsua = $conexion->query($sqlUsua);
                if ($queryUsua->rowCount() > 0) {
                    echo '<option>Seleccionar</option>';
                    while ($r = $queryUsua->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value=" . $r['id_usu'] . ">" . $r['nom_usu'] . "</option>";
                    }
                }
            } elseif ($_POST['param'] == 2) {
                $sqlPass = "SELECT con_usu FROM mq_usu WHERE id_usu = " . $_POST['value'];
                $queryPass = $conexion->query($sqlPass);
                $r = $queryPass->fetch(PDO::FETCH_ASSOC);
                if (password_verify($_POST["pass"], $r['con_usu'])) {
                    echo 1;
                } else {
                    echo 2;
                }
            }
            break;


        case 'password':
            $sqlPass = "SELECT * FROM mq_usu WHERE id_usu=" . $_POST['usu'];
            $queryPass = $conexion->query($sqlPass);
            $r = $queryPass->fetch(PDO::FETCH_ASSOC);
            if (password_verify($_POST["pass"], $r['con_usu'])) {
                echo 1;
            } else {
                echo 2;
            }
            break;

        case 'cumplir':
            $sqlCheck = "UPDATE ind_act SET cum_act = 'Si', fec_cum = '$fecha' WHERE id_act = " . $_POST['id'];
            $queryCheck = $conexion->query($sqlCheck);
            //echo $sqlCheck;
            if ($queryCheck != null) {
                echo 1;
            } else {
                printf("Errormessage: %s\n");
            }
            break;
        case 'cambiarEs':
            //Editar estado
            $sqlEditApr = "UPDATE ind_desc 
            SET id_estado = " . $_POST['est'] . "
            WHERE id_desc = " . $_POST['id'];
            $queryEditApr = $conexion->query($sqlEditApr);
            //Insertar Seguimiento
            $sqlInsSeg = "INSERT INTO ind_desc_x_seg 
            (id_desc, 
            id_usu, 
            id_are,
            fec_mod,
            id_estado) 
            VALUES (
            " . $_POST['id'] . ",
            $sesion_id,
            $sesion_are,
            '$fecha',
            " . $_POST['est'] . ")";
            $queryInsSeg = $conexion->query($sqlInsSeg);

            include 'Email.php';

            break;
        case 'insClima': 
            $sqlInsClim = "INSERT INTO ind_clim 
            (id_clim, 
            clima, 
            fec_clim,
            fec_sis) 
            VALUES (
            NULL,
            " . $_POST['clima'] . ",
            '" . $_POST['fec_clim'] . "',
            '$fecha')";
            $queryInsClim = $conexion->query($sqlInsClim);
            if ($queryInsClim != null) {
                //echo $sqlInsClim;
                echo "Solicitud Creada Correctamente";
            } else {
                // echo $sqlInsClim;
                printf("Errormessage: %s\n", $conexion->error);
            }
            break;
        case 'updateCert':
            $sqlUpcert="UPDATE mq_usu 
                  SET    tip_contrato =  '" . $_POST['tip_cont'] . "',
                         fec_firm     =  '" . $_POST['fech_cont'] . "',
                         id_carg      =  '" . $_POST['tip_carg'] . "',
                         sala_base    =  '" . $_POST['sal_base'] . "',
                         sala_varia   =  '" . $_POST['sal_vari'] . "',
                         sal_roda     =  '" . $_POST['sal_roda'] . "'
                  WHERE  id_usu = '" . $_POST['id_usu'] . "'";
            $queryUpcert=$conexion->query($sqlUpcert);
            
            if ($queryUpcert != null){
                echo "Usuario Actualizado Correctamente";
            } else {
                printf("Errormessage: %s\n", $conexion->error);
            }
    }
}
