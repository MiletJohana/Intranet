<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d H:i:s");
$hora = date("H:i:s");
if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'addMano':
            $sqlDel=" TRUNCATE TABLE cot_tap_mano";
            $queryDel=$conexion->query($sqlDel);
                  
            $sqlMan=" INSERT INTO cot_tap_mano
                               (sal_bas,
                                sub_tran, 
                                fac_pres, 
                                tot_sal,
                                hor_dia, 
                                hor_mes,
                                cost_hora, 
                                fech_mod, 
                                id_usu)
                        VALUES( '" . $_POST['sal_bas'] . "',
                                '" . $_POST['sub_tran'] . "',
                                '" . $_POST['fac_pres'] . "',
                                '" . $_POST['tot_sal'] . "',
                                '" . $_POST['hor_dia'] . "',
                                '" . $_POST['hor_mes'] . "',
                                '" . $_POST['cos_hor'] . "',
                                '$fecha',
                                '" . $_SESSION['id'] . "')";
            $queryMan=$conexion->query($sqlMan);
            if ($queryMan != null ) {
                //echo $sqlMan;
                echo "Solicitud Actualizada Correctamente.";
            } else {
                printf("Errormessage: %s\n",$sqlMan);
            }
        break;
        case 'tapSimple':
            $sqlDelsim="TRUNCATE TABLE cot_tap_sencillo";
            $queryDelsim=$conexion->query($sqlDelsim);
            $sqlSim=" INSERT INTO cot_tap_sencillo
                                  (dis_tap_min,
                                   dis_tap_hor,
                                   cal_tap_min,
                                   cal_tap_hor,
                                   peg_tap_min,
                                   peg_tap_hor,
                                   cort_tap_min,
                                   cort_tap_hor,
                                   cort_base_min,
                                   cort_base_hor,
                                   cort_logo_min,
                                   cort_logo_hor,
                                   uni_logo_min,
                                   uni_logo_hor,
                                   esc_tap_min,
                                   esc_tap_hor,
                                   perf_tap_min,
                                   perf_tap_hor,
                                   rell_tap_min,
                                   rell_tap_hor,
                                   tot_tapsen,
                                   fech_mods,
                                   id_usu)
                            VALUES( '" . $_POST['di_min'] . "',
                                    '" . $_POST['di_horas'] . "',
                                    '" . $_POST['cal_min'] . "',
                                    '" . $_POST['cal_horas'] . "',
                                    '" . $_POST['peg_min'] . "',
                                    '" . $_POST['peg_horas'] . "',
                                    '" . $_POST['cort_min'] . "',
                                    '" . $_POST['cort_horas'] . "',
                                    '" . $_POST['base_min'] . "',
                                    '" . $_POST['base_Horas'] . "',
                                    '" . $_POST['log_min'] . "',
                                    '" . $_POST['log_Horas'] . "',
                                    '" . $_POST['unio_min'] . "',
                                    '" . $_POST['unio_Horas'] . "',
                                    '" . $_POST['escu_min'] . "',
                                    '" . $_POST['escu_Horas'] . "',
                                    '" . $_POST['perfi_min'] . "',
                                    '" . $_POST['perfi_Horas'] . "',
                                    '" . $_POST['rell_min'] . "',
                                    '" . $_POST['rell_Horas'] . "',
                                    '" . $_POST['tot_Horas'] . "',
                                    '$fecha',
                                    '" . $_SESSION['id'] . "')";
            $querySim=$conexion->query($sqlSim);
            if ($querySim != null ) {
                echo '<br><div class="alert alert-success col-md-12" align="center">
                           <a href="#" class="close" data-bs-dismiss="alert" aria-label="close">&times;</a>
                           <b>¡Se ha agregado los datos de tapete sencillo!</b>.<br>
                        </div>';
                       // echo $sqlSim;
                        
            } else {
                echo '<br><div class="alert alert-danger col-md-12" align="center">
                            <a href="#" class="close" data-bs-dismiss="alert" aria-label="close">&times;</a>
                            <b>¡No se ha podido agregar!</b> Contacta con el administrador.
                        </div>';
                        //echo $sqlSim;
            }          
        break;
        case 'tapComple':
            $sqlDelcom="TRUNCATE TABLE cot_tap_complejo";
            $queryDelcom=$conexion->query($sqlDelcom);
            $sqlCom=" INSERT INTO cot_tap_complejo
                                  (dis_tapCom_min,
                                   dis_tapCom_hor,
                                   cal_tapCom_min,
                                   cal_tapCom_hor,
                                   peg_tapCom_min,
                                   peg_tapCom_hor,
                                   cort_tapCom_min,
                                   cort_tapCom_hor,
                                   cort_baseCom_min,
                                   cort_baseCom_hor,
                                   cort_logoCom_min,
                                   cort_logoCom_hor,
                                   uni_logoCom_min,
                                   uni_logoCom_hor,
                                   esc_tapCom_min,
                                   esc_tapCom_hor,
                                   perf_tapCom_min,
                                   perf_tapCom_hor,
                                   rell_tapCom_min,
                                   rell_tapCom_hor,
                                   tot_tapCom,
                                   fech_mods,
                                   id_usu)
                            VALUES('" . $_POST['di_min2'] . "',
                                   '" . $_POST['di_horas2'] . "',
                                   '" . $_POST['cal_min2'] . "',
                                   '" . $_POST['cal_horas2'] . "',
                                   '" . $_POST['peg_min2'] . "',
                                   '" . $_POST['peg_horas2'] . "',
                                   '" . $_POST['cort_min2'] . "',
                                   '" . $_POST['cort_horas2'] . "',
                                   '" . $_POST['base_min2'] . "',
                                   '" . $_POST['base_Horas2'] . "',
                                   '" . $_POST['log_min2'] . "',
                                   '" . $_POST['log_Horas2'] . "',
                                   '" . $_POST['unio_min2'] . "',
                                   '" . $_POST['unio_Horas2'] . "',
                                   '" . $_POST['escu_min2'] . "',
                                   '" . $_POST['escu_Horas2'] . "',
                                   '" . $_POST['perfi_min2'] . "',
                                   '" . $_POST['perfi_Horas2'] . "',
                                   '" . $_POST['rell_min2'] . "',
                                   '" . $_POST['rell_Horas2'] . "',
                                   '" . $_POST['tot_Horas2'] . "',
                                   '$fecha',
                                    '" . $_SESSION['id'] . "')";
            $queryCom=$conexion->query($sqlCom);
            if ($queryCom != null ) {
                echo '<br><div class="alert alert-success col-md-12" align="center">
                           <a href="#" class="close" data-bs-dismiss="alert" aria-label="close">&times;</a>
                           <b>¡Se ha agregado los datos de tapete complejo !</b>.<br>
                        </div>';
                       // echo $sqlCom;
                        
            } else {
                echo '<br><div class="alert alert-danger col-md-12" align="center">
                            <a href="#" class="close" data-bs-dismiss="alert" aria-label="close">&times;</a>
                            <b>¡No se ha podido agregar!</b> Contacta con el administrador.
                        </div>';
                       echo $sqlCom;
            } 

        break;
        case 'tapSinlogo': 
            $sqlDelog="TRUNCATE TABLE cot_tap_sinlogo";
            $queyDelog=$conexion->query($sqlDelog);
            $sqlog="INSERT INTO cot_tap_sinlogo
                                (dis_tapSin_min,
                                 dis_tapSin_hor,
                                 cal_tapSin_min,
                                 cal_tapSin_hor,
                                 peg_tapSin_min,
                                 peg_tapSin_hor,
                                 cort_tapSin_min,
                                 cort_tapSin_hor,
                                 cort_baseSin_min,
                                 cort_baseSin_hor,
                                 cort_logoSin_min,
                                 cort_logoSin_hor,
                                 uni_logoSin_min,
                                 uni_logoSin_hor,
                                 esc_tapSin_min,
                                 esc_tapSin_hor,
                                 perf_tapSin_min,
                                 perf_tapSin_hor,
                                 rell_tapSin_min,
                                 rell_tapSin_hor,
                                 tot_tapSin,
                                 fech_mod,
                                 id_usu)
                        VALUES ('" . $_POST['di_min3'] . "',
                                '" . $_POST['di_horas3'] . "',
                                '" . $_POST['cal_min3'] . "',
                                '" . $_POST['cal_horas3'] . "',
                                '" . $_POST['peg_min3'] . "',
                                '" . $_POST['peg_horas3'] . "',
                                '" . $_POST['cort_min3'] . "',
                                '" . $_POST['cort_horas3'] . "',
                                '" . $_POST['base_min3'] . "',
                                '" . $_POST['base_Horas3'] . "',
                                '" . $_POST['log_min3'] . "',
                                '" . $_POST['log_Horas3'] . "',
                                '" . $_POST['unio_min3'] . "',
                                '" . $_POST['unio_Horas3'] . "',
                                '" . $_POST['escu_min3'] . "',
                                '" . $_POST['escu_Horas3'] . "',
                                '" . $_POST['perfi_min3'] . "',
                                '" . $_POST['perfi_Horas3'] . "',
                                '" . $_POST['rell_min3'] . "',
                                '" . $_POST['rell_Horas3'] . "',
                                '" . $_POST['tot_Horas3'] . "',
                                '$fecha',
                                '" . $_SESSION['id'] . "')";
            $querylog=$conexion->query($sqlog);
            if ($querylog != null ) {
                echo '<br><div class="alert alert-success col-md-12" align="center">
                           <a href="#" class="close" data-bs-dismiss="alert" aria-label="close">&times;</a>
                           <b>¡Se ha agregado los datos de tapete sin logo !</b>.<br>
                        </div>';
                       // echo $sqlCom;
            } else {
                echo '<br><div class="alert alert-danger col-md-12" align="center">
                            <a href="#" class="close" data-bs-dismiss="alert" aria-label="close">&times;</a>
                            <b>¡No se ha podido agregar!</b> Contacta con el administrador.
                        </div>';
                       echo $sqlCom;
            }
        break;
        case 'costos': 
            $sqlDelcost="TRUNCATE TABLE cot_tap_costos";
            $queryDelcost=$conexion->query($sqlDelcost);
            $sqlCost="INSERT INTO  cot_tap_costos
                                   (perm_cl,
                                    perm_ml,
                                    perm_m,
                                    perg_cl,
                                    perg_ml,
                                    perg_m,
                                    nomtre_cl,
                                    nomtre_ml,
                                    nomtre_m,
                                    nomil_cl,
                                    nomil_ml,
                                    nomil_m,
                                    korl_cl,
                                    korl_ml,
                                    korl_m,
                                    korp_cl,
                                    korp_ml	,
                                    korp_m,
                                    bost_cl,
                                    bost_ml,
                                    bost_m,
                                    aqua_cl,
                                    aqua_ml	,
                                    aqua_m,
                                    nomsinb_cl,
                                    nomsinb_ml,
                                    nomsinb_m,
                                    val_pegan,
                                    val_pegxtap,
                                    papel_bond, 
                                    fech_mod,
                                    id_usu)
                            VALUES( '" . $_POST['cl_medi'] . "',
                                    '" . $_POST['ml_medi'] . "',
                                    '" . $_POST['m2_medi'] . "',
                                    '" . $_POST['cl_gru'] . "',
                                    '" . $_POST['ml_gru'] . "',
                                    '" . $_POST['m2_gru'] . "',
                                    '" . $_POST['cl_t3'] . "',
                                    '" . $_POST['ml_t3'] . "',
                                    '" . $_POST['m2_t3'] . "',
                                    '" . $_POST['cl_t1'] . "',
                                    '" . $_POST['ml_t1'] . "',
                                    '" . $_POST['m2_t1'] . "',
                                    '" . $_POST['cl_tkor'] . "',
                                    '" . $_POST['ml_tkor'] . "',
                                    '" . $_POST['m2_tkor'] . "',
                                    '" . $_POST['cl_tliv'] . "',
                                    '" . $_POST['ml_tliv'] . "',
                                    '" . $_POST['m2_tliv'] . "',
                                    '" . $_POST['cl_boston'] . "',
                                    '" . $_POST['ml_boston'] . "',
                                    '" . $_POST['m2_boston'] . "',
                                    '" . $_POST['cl_aqua'] . "',
                                    '" . $_POST['ml_aqua'] . "',
                                    '" . $_POST['m2_aqua'] . "',
                                    '" . $_POST['cl_nsb'] . "',
                                    '" . $_POST['ml_nsb'] . "',
                                    '" . $_POST['m2_nsb'] . "',
                                    '" . $_POST['val_peg'] . "',
                                    '" . $_POST['val_tapete'] . "',
                                    '" . $_POST['val_bond'] . "',
                                    '$fecha',
                                    '" . $_SESSION['id'] . "')";
            $queryCost=$conexion->query($sqlCost);

            $sqlDeldepre="TRUNCATE TABLE cot_tap_depre";
            $queryDeldepre=$conexion->query($sqlDeldepre);
            $sqlDepre="INSERT INTO  cot_tap_depre
                                    (vr_depre,
                                     vr_xdepre,
                                     dep_mes,
                                     dep_hora,
                                     fecha_mod,
                                     id_usu)
                             VALUES ('" . $_POST['vr_depre'] . "',
                                     '" . $_POST['vr_xdepre'] . "',
                                     '" . $_POST['dep_mes'] . "',
                                     '" . $_POST['dep_hora'] . "',
                                     '$fecha',
                                     '" . $_SESSION['id'] . "')";
            $queryDepre=$conexion->query($sqlDepre);
            
            $sqlDelserv="TRUNCATE TABLE cot_tap_serpublicos";
            $queryDelserv=$conexion->query($sqlDelserv);
            $sqlServ="INSERT INTO cot_tap_serpublicos
                                  (ener_mes,
                                   ener_hora,
                                   cons_mes,
                                   cons_hora,
                                   siat_mes,
                                   siat_hora,
                                   fech_mod,
                                   id_usu)
                           VALUES('" . $_POST['cos_mes'] . "',
                                  '" . $_POST['cos_hor'] . "',
                                  '" . $_POST['plan_mes'] . "',
                                  '" . $_POST['plan_hor'] . "',
                                  '" . $_POST['siat_mes'] . "',
                                  '" . $_POST['siat_hor'] . "',
                                  '$fecha',
                                  '" . $_SESSION['id'] . "')";
            $queryServ=$conexion->query($sqlServ);
        
            if ($queryCost != null && $queryDepre != null && $queryServ != null) {
                echo "Solicitud Actualizada Correctamente.";
               // ECHO $sqlServ;
               // echo $sqlDepre;
               // echo $sqlCost;
                
            } else {
                printf("Errormessage: %s\n");
                ECHO $sqlServ;
                echo $sqlDepre;
                echo $sqlCost;
                
            }
        break;
        case 'manotap':
            $sqlmano="SELECT * FROM cot_tap_mano";
            $querymano=$conexion->query($sqlmano);
            $rm=$querymano->fetch_array();

            $sqlsen="SELECT * FROM cot_tap_sencillo";
            $querysen=$conexion->query($sqlsen);
            $rs=$querysen->fetch_array();

            $sqlcom="SELECT * FROM cot_tap_complejo";
            $querycom=$conexion->query($sqlcom);
            $rc=$querycom->fetch_array();

            $sqlLog="SELECT* FROM cot_tap_sinlogo ";
            $queryLog=$conexion->query($sqlLog);
            $rl=$queryLog->fetch_array();

            $mano=$rm['cost_hora'];
            $sen=$rs['tot_tapsen'];
            $com=$rc['tot_tapCom'];
            $log=$rl['tot_tapSin'];

            $tap_sen= round($mano * $sen);
            $tap_com= round($mano * $com);
            $tap_log= round($mano * $log);

            $sqlDemanotap="TRUNCATE TABLE cot_tap_man_x_tap";
            $queryDemanotap=$conexion->query($sqlDemanotap);
            $sqlmaTap="INSERT INTO cot_tap_man_x_tap
                                    (man_tapsen,
                                     man_tapcom,
                                     man_taplog)
                              VALUES('$tap_sen',
                                     '$tap_com',
                                     '$tap_log')";
            $querymaTap=$conexion->query($sqlmaTap);
            if ($querymaTap != null ) {
                echo '<br><div class="alert alert-success col-md-12" align="center">
                           <a href="#" class="close" data-bs-dismiss="alert" aria-label="close">&times;</a>
                           <b>¡Se ha agregado los datos de Mano de Obra (Costo Tapete) !</b>.<br>
                        </div>';
                       // echo $sqlmaTap;
            } else {
                echo '<br><div class="alert alert-danger col-md-12" align="center">
                            <a href="#" class="close" data-bs-dismiss="alert" aria-label="close">&times;</a>
                            <b>¡No se ha podido agregar!</b> Contacta con el administrador.
                        </div>';
                       echo $sqlmaTap;
            }
        break;
    }
}
?>