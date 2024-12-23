<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d H:i:s");
$hora = date("H:i:s");
if (isset($_POST['action'])) {
  switch ($_POST['action']) {
    case 'add':
      $sqlAntesDe = "SELECT id_cli FROM mq_clie where id_cli=" . $_POST['id_nit'];
      $queryAntesDe = $conexion->query($sqlAntesDe);
      if ($queryAntesDe->rowCount() > 0) {
        $sqlCli = "UPDATE mq_clie SET nom_cli= '" . $_POST['nom_clie'] . "',
                                        con_cli= '" . $_POST['nom_com'] . "',   
                                        dir_cli= '" . $_POST['dirEmp'] . "'";
        if (isset($_POST['celCli']) && $_POST['celCli'] != '') {
          $sqlCli .= " , tel_cli= '" . $_POST['celCli'] . "'";
        }
        if (isset($_POST['telcon']) && $_POST['telcon'] != '') {
          $sqlCli .= " , tel_cont= '" . $_POST['telcon'] . "'";
        }
        $sqlCli .= " , eml_cli='" . $_POST['correo'] . "',
                                        telefono_fijo= '" . $_POST['TelF'] . "',
                                          cargo_conta='" . $_POST['car'] . "',
                                    activ_solicitada='" . $_POST['Actsol'] . "',
                                              ase_com='" . $_POST['aseCom'] . "',
                                              tip_clie='" . $_POST['tipCli'] . "',
                                               rep_sac='" . $_POST['aseSac'] . "'
                                          WHERE id_cli=" . $_POST['id_nit'];
      } else {
        $sqlCli = "INSERT INTO `mq_clie`
                                  (`id_cli`,
                                  `tip_id`,
                                  `nom_cli`,
                                  `con_cli`,
                                  `dir_cli`";
        if (isset($_POST['celCli']) && $_POST['celCli'] != '') {
          $sqlCli .= " ,`tel_cli`";
        }
        if (isset($_POST['telcon']) && $_POST['telcon'] != '') {
          $sqlCli .= " ,  `tel_cont`";
        }
        $sqlCli .= ",`eml_cli`,
                                `telefono_fijo`,
                                `cargo_conta`,
                                `activ_solicitada`,
                                `id_reg`,
                                `ase_com`,
                                `fec_cre`";
        if (isset($_POST['aseSac']) && $_POST['aseSac'] != '') {
          $sqlCli .= ",`rep_sac`";
        }
        if (isset($_POST['tipCli']) && $_POST['tipCli'] != '') {
          $sqlCli .= ",`tip_clie`)";
        }
        $sqlCli .= " VALUES('" . $_POST['id_nit'] . "',
                                  'Nit',
                   '" . $_POST['nom_clie'] . "',
                   '" . $_POST['nom_com'] . "',
                               '" . $_POST['dirEmp'] . "'";
        if (isset($_POST['celCli']) && $_POST['celCli'] != '') {
          $sqlCli .= " , '" . $_POST['celCli'] . "'";
        }
        if (isset($_POST['telcon']) && $_POST['telcon'] != '') {
          $sqlCli .= " ,'" . $_POST['telcon'] . "'";
        }
        $sqlCli .= " , '" . $_POST['correo'] . "',
                               '" . $_POST['TelF'] . "',
                   '" . $_POST['car'] . "',
                               '" . $_POST['Actsol'] . "',
                               '$sesion_reg',
                   '" . $_POST['aseCom'] . "',
                               '$fecha'";
        if (isset($_POST['aseSac']) && $_POST['aseSac'] != '') {
          $sqlCli .= ",'" . $_POST['aseSac'] . "'";
        }
        if (isset($_POST['tipCli']) && $_POST['tipCli'] != '') {
          $sqlCli .= ",'" . $_POST['tipCli'] . "')";
        }
      }
      $queryCli = $conexion->query($sqlCli);

      $file = "../../documentos/credito/";
      opendir($file);
      if (!empty($_FILES['certCon']['tmp_name'])) {
        $certCon = $_FILES['certCon']['name'];
        $destino = $file . $certCon;
        copy($_FILES['certCon']['tmp_name'], $destino);
      }
      if (!empty($_FILES['copRu']['tmp_name'])) {
        $copRu = $_FILES['copRu']['name'];
        $destino1 = $file . $copRu;
        copy($_FILES['copRu']['tmp_name'], $destino1);
      }
      if (!empty($_FILES['copFin']['tmp_name'])) {
        $copFin = $_FILES['copFin']['name'];
        $destino2 = $file . $copFin;
        copy($_FILES['copFin']['tmp_name'], $destino2);
      }
      if (!empty($_FILES['refComer']['tmp_name'])) {
        $refComer = $_FILES['refComer']['name'];
        $destino3 = $file . $refComer;
        copy($_FILES['refComer']['tmp_name'], $destino3);
      }
      if (!empty($_FILES['refComer2']['tmp_name'])) {
        $refComer2 = $_FILES['refComer2']['name'];
        $destino4 = $file . $refComer2;
        copy($_FILES['refComer2']['tmp_name'], $destino4);
      }
      if (!empty($_FILES['refBan']['tmp_name'])) {
        $refBan = $_FILES['refBan']['name'];
        $destino5 = $file . $refBan;
        copy($_FILES['refBan']['tmp_name'], $destino5);
      }
      if (!empty($_FILES['form_cre']['tmp_name'])) {
        $formcre = $_FILES['form_cre']['name'];
        $destino6 = $file . $formcre;
        copy($_FILES['form_cre']['tmp_name'], $destino6);
      }


      $sqlSol = "INSERT INTO `cre_solicitud` 
                                               (`id_sol`,
                                                `nom_rep`,
                                                `fec_sol`";
      if (isset($_POST['ac_eco']) && $_POST['ac_eco'] != '') {
        $sqlSol .= ", `act_eco`";
      }
      if (isset($_POST['tie_mer']) && $_POST['tie_mer'] != '') {
        $sqlSol .= ",  `tiem_merc`";
      }
      $sqlSol .= ",  `num_emple`,
                                                `cupo_sol`";
      if (isset($_POST['ter_pag']) && $_POST['ter_pag'] != '') {
        $sqlSol .= ",  `term_pag`";
      }
      if (isset($_POST['di_pag']) && $_POST['di_pag'] != '') {
        $sqlSol .= ",   `dia_pag`";
      }
      $sqlSol .= ",    `reg_clie`,
                                                `cupoSugA`,
                                                `plaSugeA`,
                                                `jusPlaCup`";
      if (isset($_POST['reten']) && $_POST['reten'] != '') {
        $sqlSol .= " ,`retFuen`";
      }
      if (isset($_POST['tiem']) && $_POST['tiem'] != '') {
        $sqlSol .= " ,`tiem_rad`";
      }
      $sqlSol .= " ,`id_cli`,
                                                `id_est`,
                                                `segm_clie`,
                                                `congen_ase`,
                                                `ana_referen`";
      if (isset($_POST['aseCom']) && $_POST['aseCom'] != '') {
        $sqlSol .= ",`ase_com`";
      }
      if (isset($_POST['aseSac']) && $_POST['aseSac'] != '') {
        $sqlSol .= ", `rep_sac`";
      }
      if (isset($_POST['nomSac']) && $_POST['nomSac'] != '') {
        $sqlSol .= ", `nom_sac`";
      }
      if (isset($_POST['nomAse']) && $_POST['nomAse'] != '') {
        $sqlSol .= ", `nom_atc`";
      }
      if (!empty($_FILES['certCon']['tmp_name'])) {
        $sqlSol .= ",`doc_consGer`";
      }
      if (!empty($_FILES['copRu']['tmp_name'])) {
        $sqlSol .= ",`doc_rut`";
      }
      if (!empty($_FILES['copFin']['tmp_name'])) {
        $sqlSol .=  ",`doc_estFin`";
      }
      if (!empty($_FILES['refComer']['tmp_name'])) {
        $sqlSol .= ",`doc_refCom`";
      }
      if (!empty($_FILES['refComer2']['tmp_name'])) {
        $sqlSol .= ",`doc_refcom2`";
      }
      if (!empty($_FILES['refBan']['tmp_name'])) {
        $sqlSol .= ",`doc_refBanc`";
      }
      if (!empty($_FILES['form_cre']['tmp_name'])) {
        $sqlSol .= ",`doc_form`";
      }
      $sqlSol .= ",`id_usu`,
                                                 `fecha_crea`)
                                                  VALUES( NULL,
                                                  '" . $_POST['reple'] . "',
                                                  '" . $_POST['fech_sol'] . ' ' . $hora . "'";
      if (isset($_POST['ac_eco']) && $_POST['ac_eco'] != '') {
        $sqlSol .= ",'" . $_POST['ac_eco'] . "'";
      }
      if (isset($_POST['tie_mer']) && $_POST['tie_mer'] != '') {
        $sqlSol .= ",'" . $_POST['tie_mer'] . "'";
      }
      $sqlSol .= ",'" . $_POST['num_empl'] . "',
                                                  '" . $_POST['cupCreSol'] . "'";
      if (isset($_POST['ter_pag']) && $_POST['ter_pag'] != '') {
        $sqlSol .= ",'" . $_POST['ter_pag'] . "'";
      }
      if (isset($_POST['di_pag']) && $_POST['di_pag'] != '') {
        $sqlSol .= ",'" . $_POST['di_pag'] . "'";
      }
      $sqlSol .= ", '" . $_POST['regi'] . "', 
                                                  '" . $_POST['CupAtc'] . "', 
                                                  '" . $_POST['PlazAt'] . "',
                                     '" . $_POST['just'] . "'";
      if (isset($_POST['reten']) && $_POST['reten'] != '') {
        $sqlSol .= ",'" . $_POST['reten'] . "'";
      }
      if (isset($_POST['tiem']) && $_POST['tiem'] != '') {
        $sqlSol .= ",'" . $_POST['tiem'] . "'";
      }
      $sqlSol .= ", '" . $_POST['id_nit'] . "', 
                                                       '1',
                                                    '" . $_POST['segCl'] . "', 
                                                    '" . $_POST['conAt'] . "',
                                      '" . $_POST['ana_ref'] . "'";
      if (isset($_POST['aseCom']) && $_POST['aseCom'] != '') {
        $sqlSol .= ",'" . $_POST['aseCom'] . "'";
      }
      if (isset($_POST['aseSac']) && $_POST['aseSac'] != '') {
        $sqlSol .= ",'" . $_POST['aseSac'] . "'";
      }
      if (isset($_POST['nomSac']) && $_POST['nomSac'] != '') {
        $sqlSol .= ", '" . $_POST['nomSac'] . "'";
      }
      if (isset($_POST['nomAse']) && $_POST['nomAse'] != '') {
        $sqlSol .= ", '" . $_POST['nomAse'] . "'";
      }
      if (!empty($_FILES['certCon']['tmp_name'])) {
        $sqlSol .= ",'$certCon'";
      }
      if (!empty($_FILES['copRu']['tmp_name'])) {
        $sqlSol .= ",'$copRu'";
      }
      if (!empty($_FILES['copFin']['tmp_name'])) {
        $sqlSol .= ",'$copFin'";
      }
      if (!empty($_FILES['refComer']['tmp_name'])) {
        $sqlSol .= ",'$refComer'";
      }
      if (!empty($_FILES['refComer2']['tmp_name'])) {
        $sqlSol .= ",'$refComer2'";
      }
      if (!empty($_FILES['refBan']['tmp_name'])) {
        $sqlSol .= ",'$refBan'";
      }
      if (!empty($_FILES['form_cre']['tmp_name'])) {
        $sqlSol .= ",'$formcre'";
      }
      $sqlSol .= ",'" . $_SESSION['id'] . "',
                                                          '$fecha')";

      $querySol = $conexion->query($sqlSol);
      $sqlS = "SELECT id_sol FROM cre_solicitud ORDER BY id_sol DESC";
      $queryS = $conexion->query($sqlS);
      while ($r = $queryS->fetch(PDO::FETCH_OBJ)) {
        $sol = $r;
        break;
      }
      $sqlCon = "INSERT INTO `cre_contactos`
                                               (`id_cont`,
                                               `id_sol`,
                                               `id_cli`,
                                               `id_usu`,
                                               `enc_com`";
      if (isset($_POST['en_com1']) && $_POST['en_com1'] != '') {
        $sqlCon .= ", `enc_com2`";
      }
      $sqlCon .= ", `ema_com`";
      if (isset($_POST['ema_com1']) && $_POST['ema_com1'] != '') {
        $sqlCon .= ", `ema_com2`";
      }
      $sqlCon .= ",  `con_ocu`";
      if (isset($_POST['cont_ocu1']) && $_POST['cont_ocu1'] != '') {
        $sqlCon .= ", `con_ocu2`";
      }
      $sqlCon .= ", `ema_ocu`";
      if (isset($_POST['ema_ocu1']) && $_POST['ema_ocu1'] != '') {
        $sqlCon .= ", `ema_ocu2`";
      }
      $sqlCon .= ", `con_gen`";
      if (isset($_POST['cont_ser1']) && $_POST['cont_ser1'] != '') {
        $sqlCon .= ",  `con_gen2`";
      }
      $sqlCon .= ",  `ema_gen`";
      if (isset($_POST['ema_ser1']) && $_POST['ema_ser1'] != '') {
        $sqlCon .= ", `ema_gen2`";
      }
      $sqlCon .= ", `con_teso`";
      if (isset($_POST['cont_tes1']) && $_POST['cont_tes1'] != '') {
        $sqlCon .= ",  `con_teso2`";
      }
      $sqlCon .= ", `ema_tes`";
      if (isset($_POST['ema_tes1']) && $_POST['ema_tes1'] != '') {
        $sqlCon .= ", `ema_tes2`";
      }
      $sqlCon .= ", `con_cont`";
      if (isset($_POST['cont_cont1']) && $_POST['cont_cont1'] != '') {
        $sqlCon .= ", `con_cont2`";
      }
      if (isset($_POST['cont_cont1']) && $_POST['cont_cont1'] != '') {
        $sqlCon .= ", `ema_cont2`";
      }
      $sqlCon .= ", `ema_cont`)
                                               VALUES(
                                                NULL,
                                               $sol->id_sol,
                                          '" . $_POST['id_nit'] . "',
                                          '" . $_SESSION['id'] . "',
                                          '" . $_POST['en_com'] . "'";
      if (isset($_POST['en_com1']) && $_POST['en_com1'] != '') {
        $sqlCon .= ",'" . $_POST['en_com1'] . "'";
      }
      $sqlCon .= ",  '" . $_POST['ema_com'] . "'";
      if (isset($_POST['ema_com1']) && $_POST['ema_com1'] != '') {
        $sqlCon .= ",'" . $_POST['ema_com1'] . "'";
      }
      $sqlCon .= ",'" . $_POST['cont_ocu'] . "'";
      if (isset($_POST['cont_ocu1']) && $_POST['cont_ocu1'] != '') {
        $sqlCon .= ",'" . $_POST['cont_ocu1'] . "'";
      }
      $sqlCon .= ",'" . $_POST['ema_ocu'] . "'";
      if (isset($_POST['ema_ocu1']) && $_POST['ema_ocu1'] != '') {
        $sqlCon .= ",'" . $_POST['ema_ocu1'] . "'";
      }
      $sqlCon .= ", '" . $_POST['cont_ser'] . "'";
      if (isset($_POST['cont_ser1']) && $_POST['cont_ser1'] != '') {
        $sqlCon .= ",'" . $_POST['cont_ser1'] . "'";
      }
      $sqlCon .= ",'" . $_POST['ema_ser'] . "'";
      if (isset($_POST['ema_ser1']) && $_POST['ema_ser1'] != '') {
        $sqlCon .= ",'" . $_POST['ema_ser1'] . "'";
      }
      $sqlCon .= ", '" . $_POST['cont_tes'] . "'";
      if (isset($_POST['cont_tes1']) && $_POST['cont_tes1'] != '') {
        $sqlCon .= ", '" . $_POST['cont_tes1'] . "'";
      }
      $sqlCon .= ",  '" . $_POST['ema_tes'] . "'";
      if (isset($_POST['ema_tes1']) && $_POST['ema_tes1'] != '') {
        $sqlCon .= ", '" . $_POST['ema_tes1'] . "'";
      }
      $sqlCon .= ", '" . $_POST['cont_cont'] . "'";
      if (isset($_POST['cont_cont1']) && $_POST['cont_cont1'] != '') {
        $sqlCon .= ",'" . $_POST['cont_cont1'] . "'";
      }
      if (isset($_POST['cont_cont1']) && $_POST['cont_cont1'] != '') {
        $sqlCon .= ", '" . $_POST['ema_conta1'] . "'";
      }
      $sqlCon .= ", '" . $_POST['ema_conta'] . "')";

      $queryCon = $conexion->query($sqlCon);

      $sqlEnv = " INSERT INTO `cre_env_mercancia`
                                            (`id_mer`,
                                             `direcion_1`,
                                             `ciudad_1`,
                                             `telefono_1`,
                                             `horario_1`,
                                             `horario1_1`";
      if (isset($_POST['pun_u2']) && $_POST['pun_u2'] != '') {
        $sqlEnv .= "       ,`direcion_2`,
                                             `ciudad_2`,
                                             `telefono_2`,
                                             `horario_2`,
                                             `horario2_2`";
      }
      if (isset($_POST['pun_u3']) && $_POST['pun_u3'] != '') {
        $sqlEnv .= "      ,`direcion_3`,
                                             `ciudad_3`,
                                             `telefono_3`, 
                                             `horario_3`,
                                             `horario3_3`";
      }
      $sqlEnv .= " ,`id_cli`,`id_sol`) VALUES( NULL,
                                    '" . $_POST['pun_u1'] . "',
                                    '" . $_POST['ciu1'] . "',
                                    '" . $_POST['tel_fij1'] . "',
                                    '" . $_POST['hor_1'] . "',
                                    '" . $_POST['hor1_1'] . "'";
      if (isset($_POST['pun_u2']) && $_POST['pun_u2'] != '') {
        $sqlEnv .= "    ,'" . $_POST['pun_u2'] . "',
                                       '" . $_POST['ciu2'] . "',
                                       '" . $_POST['tel_fij2'] . "',
                                       '" . $_POST['hor_2'] . "',
                                       '" . $_POST['hor2_2'] . "'";
      }
      if (isset($_POST['pun_u3']) && $_POST['pun_u3'] != '') {
        $sqlEnv .= "     ,'" . $_POST['pun_u3'] . "',
                                        '" . $_POST['ciu3'] . "',
                                        '" . $_POST['tel_fij3'] . "',
                                        '" . $_POST['hor_3'] . "',
                                        '" . $_POST['hor3_3'] . "'";
      }
      $sqlEnv .= ",'" . $_POST['id_nit'] . "',
                                            $sol->id_sol)";
      $queryEnv = $conexion->query($sqlEnv);


      $sqlFac = " INSERT INTO  `cre_factura`
                                          (`id_factura`,
                                           `telfono_fac`,
                                           `direccion`,
                                           `ciudad`";
      if (isset($_POST['num_copias']) && $_POST['num_copias'] != '') {
        $sqlFac .= ", `num_copias`";
      }
      if (isset($_POST['cert_cal']) && $_POST['cert_cal'] != '') {
        $sqlFac .= ", `cer_calidad`";
      }
      if (isset($_POST['ex_comp']) && $_POST['ex_comp'] != '') {
        $sqlFac .= ", `ext_comp`";
      }
      if (isset($_POST['ex_rem']) && $_POST['ex_rem'] != '') {
        $sqlFac .= ",`ext_remis`";
      }
      $sqlFac .= ", `id_cli`,
                                             `id_sol`,
                                           `hor_fac`)
                                   VALUES ( NULL,
                                   '" . $_POST['telfi_fa'] . "',
                                   '" . $_POST['direFa'] . "',
                                   '" . $_POST['ciu_fac'] . "'";
      if (isset($_POST['num_copias']) && $_POST['num_copias'] != '') {
        $sqlFac .= ", '" . $_POST['num_copias'] . "'";
      }
      if (isset($_POST['cert_cal']) && $_POST['cert_cal'] != '') {
        $sqlFac .= ", '" . $_POST['cert_cal'] . "'";
      }
      if (isset($_POST['ex_comp']) && $_POST['ex_comp'] != '') {
        $sqlFac .= ", '" . $_POST['ex_comp'] . "'";
      }
      if (isset($_POST['ex_rem']) && $_POST['ex_rem'] != '') {
        $sqlFac .= ",'" . $_POST['ex_rem'] . "'";
      }
      $sqlFac .= ",'" . $_POST['id_nit'] . "',
                                      $sol->id_sol,
                                  '" . $_POST['hor_fac'] . "')";
      $queryFac = $conexion->query($sqlFac);

      $sqlSegui = "INSERT INTO  `cre_x_mov`
                                                (`id_sol`,
                                                `id_usu`,
                                                `id_est`,
                                                `fech_crm`)
                                      VALUES    ($sol->id_sol,
                                                 '" . $_SESSION['id'] . "',
                                                 '1',
                                                 '$fecha')";
      $querySegui = $conexion->query($sqlSegui);
      if ($queryFac != null && $queryEnv != null && $querySol != null && $queryCli != null && $queryCon != null && $querySegui != null) {
        echo "Solicitud Creada Correctamente.";
      } else {
        printf("Errormessage: %s\n", $conexion->error);
      }

     // include 'Email.php';
      break;

















      
    case 'update':
      $sqlEva = "INSERT INTO `cre_eva_clie`
                                   (`id_evaCl`,
                                    `ref_bancu`,
                                    `ref_bancd`,
                                    `ref_comeru`,
                                    `ref_comerd`,
                                    `super_socie`,
                                    `reg_emp`,
                                    `fech_ini`,
                                    `fech_fin`,
                                    `act_in`,
                                    `act_fin`,
                                    `pas_ini`,
                                    `pas_fin`,
                                    `activ_in`,
                                    `activ_fin`,
                                    `pasiv_in`,
                                    `pasiv_fin`,
                                    `capi_pag`,
                                    `ingop_in`,
                                    `ingop_fin`,
                                    `utope_in`,
                                    `utope_fin`,
                                    `utdesim_in`,
                                    `utdesim_fin`,
                                    `inv_ini`,
                                    `inv_fin`,
                                    `id_sol`,
                                    `id_cli`, 
                                    `fech_actua`) 
                               VALUES(NULL,
                               '" . $_POST['ref_ban'] . "',
                               '" . $_POST['ref_ban2'] . "',
                               '" . $_POST['ref_com'] . "',
                               '" . $_POST['ref_com2'] . "',
                               '" . $_POST['super_soc'] . "',
                               '" . $_POST['reg_emp'] . "',
                               '" . $_POST['ini_cier'] . "',
                               '" . $_POST['fin_cier'] . "',
                               '" . $_POST['ac_cor'] . "',
                               '" . $_POST['ac_cor1'] . "',
                               '" . $_POST['pas_cor'] . "',
                               '" . $_POST['pas_cor1'] . "',
                               '" . $_POST['activ'] . "',
                               '" . $_POST['activ1'] . "',
                               '" . $_POST['pasi'] . "',
                               '" . $_POST['pasi1'] . "',
                               '" . $_POST['cap_pa'] . "',
                               '" . $_POST['ing'] . "', 
                               '" . $_POST['ing1'] . "',
                               '" . $_POST['util'] . "',
                               '" . $_POST['utilun'] . "',
                               '" . $_POST['util_an'] . "',
                               '" . $_POST['util_an1'] . "',
                               '" . $_POST['inv'] . "',
                               '" . $_POST['inv1'] . "',
                               '" . $_POST['id_sol'] . "',
                               '" . $_POST['id_nit'] . "',
                                 '$fecha')";

      $queryEva = $conexion->query($sqlEva);

      $sqlSeg = "INSERT INTO  `cre_x_mov`
                                          (`id_sol`,
                                          `id_usu`,
                                          `id_est`,
                                          `fech_crm`)
                                VALUES    ('" . $_POST['id_sol'] . "',
                                            '" . $_SESSION['id'] . "',
                                            '2',
                                            '$fecha')";
      $querySeg = $conexion->query($sqlSeg);

      $sqlSol = "UPDATE cre_solicitud SET id_est='2'
                                       WHERE id_sol=" . $_POST['id_sol'];
      $querySol = $conexion->query($sqlSol);

      if ($queryEva != null && $querySeg != null) {
        // echo $sqlSeg;
        //echo $sqlEva;
        echo "<div align='center'>
                        <br>Solicitud Actualizada Correctamente.<br><br>
                     </div>";
      } else {
        printf("Errormessage: %s\n", $conexion->error);
      }
      include 'Email.php';
      break;

    case 'updateAprob':
      $sqlSegA = "INSERT INTO `cre_x_mov`
                            (`id_sol`,
                            `id_usu`,
                            `id_est`,
                            `fech_crm`)
                  VALUES   ('" . $_POST['id_sol'] . "',
                            '" . $_SESSION['id'] . "',
                            '3',
                            '$fecha')";
      $querySegA = $conexion->query($sqlSegA);

      $sqlAprob = "UPDATE cre_solicitud SET   cup_aut   = '" . $_POST['cred_aut'] . "',
                                              term_auto = '" . $_POST['termpa_aut'] . "',
                                              num_letra = '" . $_POST['numero_letras'] . "',
                                              ob_cupasig= '" . $_POST['obs_aprob'] . "'
                                        WHERE id_sol    ='" . $_POST['id_sol'] . "'";

      $queryAprob = $conexion->query($sqlAprob);

      $sqlSol = "UPDATE cre_solicitud SET id_est='3'
                                    WHERE id_sol=" . $_POST['id_sol'];
      $querySol = $conexion->query($sqlSol);
      if ($queryAprob != null && $querySegA != null) {
        echo "<div align='center'>
                    <br>Solicitud Actualizada Correctamente.<br><br>
                 </div>";
      } else {
        printf("Errormessage: %s\n", $conexion->error);
      }
      include 'Email.php';
      include 'pdf.php';
      break;

    case 'delete':
      $sqlDelfa = "DELETE FROM cre_factura WHERE id_sol=" . $_POST['id_sol'];
      $queryDelfa = $conexion->query($sqlDelfa);
      $sqlDeleva = "DELETE FROM cre_eva_clie WHERE id_sol=" . $_POST['id_sol'];
      $queryDeleva = $conexion->query($sqlDeleva);
      $sqlDel = "DELETE FROM cre_solicitud WHERE id_sol=" . $_POST['id_sol'];
      $queryDel = $conexion->query($sqlDel);


      if ($queryDeleva != null && $queryDelfa && $queryDel) {
        echo 'Solicitud eliminada correctamente.';
      } else {
        printf("Errormessage: %s\n", $conexion->error);
      }

      break;

    case 'rechazar':
      $sqlSegR = "INSERT INTO `cre_x_mov`
                              (`id_sol`,
                              `id_usu`,
                              `id_est`,
                              `fech_crm`)
                        VALUES('" . $_POST['id_sol'] . "',
                              '" . $_SESSION['id'] . "',
                              '4',
                              '$fecha')";
      $querySegR = $conexion->query($sqlSegR);

      $sqlRecha = "UPDATE cre_solicitud SET ob_cupasig= '" . $_POST['obs_aprob'] . "',
                                              cau_rec= '" . $_POST['caurec'] . "',
                                              id_est='4'
                                          WHERE id_sol='" . $_POST['id_sol'] . "'";
      $queryRecha = $conexion->query($sqlRecha);
      if ($queryRecha != null && $querySegR != null) {
        // ECHO $sqlRecha;
        echo "<div align='center'>
                    <br> Solicitud Rechazada Correctamente.<br><br>
                 </div>";
      } else {
        printf("Errormessage: %s\n", $conexion->error);
      }

      include 'Email.php';
      if ($_POST['caurec'] == "Monto minimo mensual de compra") {
      } else {
        include 'pdf.php';
      }
      break;

    case 'edicion':
      $sqlSegE = "INSERT INTO `cre_x_mov`
                              (`id_sol`,
                              `id_usu`,
                              `id_est`,
                              `fech_crm`)
                      VALUES('" . $_POST['id_sol'] . "',
                            '" . $_SESSION['id'] . "',
                            '7',
                            '$fecha')";
      $querySegE = $conexion->query($sqlSegE);

      $sqlEdi = "UPDATE cre_solicitud SET id_est='7',
                                      obser_perm='" . $_POST['obser_perm'] . "'
                                    WHERE id_sol='" . $_POST['id_sol'] . "'";
      $queryEdi = $conexion->query($sqlEdi);
      if ($queryEdi != null && $querySegE != null) {
        echo "<div align='center'>
                    <br> Permiso Habilitado Correctamente <br><br>
                 </div>";
      } else {

        printf("Errormessage: %s\n", $conexion->error);
      }
      include 'Email.php';
      break;

    case 'edicion2':
      $sqlSegE2 = "INSERT INTO `cre_x_mov`
                              (`id_sol`,
                              `id_usu`,
                              `id_est`,
                              `fech_crm`)
                      VALUES('" . $_POST['id_sol'] . "',
                            '" . $_SESSION['id'] . "',
                            '8',
                            '$fecha')";
      $querySegE2 = $conexion->query($sqlSegE2);

      $sqlEdi2 = "UPDATE cre_solicitud SET id_est='1',
                                         obser_perm='" . $_POST['obser_perm'] . "'
                                          WHERE id_sol='" . $_POST['id_sol'] . "'";
      $queryEdi2 = $conexion->query($sqlEdi2);
      if ($queryEdi2 != null && $querySegE2 != null) {
        echo "<div align='center'>
                    <br> Permiso Habilitado Correctamente <br><br>
                 </div>";
      } else {

        printf("Errormessage: %s\n", $conexion->error);
      }
      include 'Email.php';
      break;


    case 'actualizacionForm1':
      $sqlaCli = "UPDATE mq_clie SET   nom_cli= '" . $_POST['nom_clie'] . "',
                                       con_cli= '" . $_POST['nom_com'] . "',   
                                       dir_cli= '" . $_POST['dirEmp'] . "'";
      if (isset($_POST['celCli'])) {
        $sqlaCli .= ", tel_cli= '" . $_POST['celCli'] . "'";
      }
      if (isset($_POST['telcon'])) {
        $sqlaCli .= ", tel_cont= '" . $_POST['telcon'] . "'";
      }
      $sqlaCli .= ",  eml_cli='" . $_POST['correo'] . "',
                               telefono_fijo= '" . $_POST['TelF'] . "',
                                 cargo_conta='" . $_POST['car'] . "',
                            activ_solicitada='" . $_POST['Actsol'] . "',
                                     ase_com='" . $_POST['aseCom'] . "'";
      if (isset($_POST['tipCli']) && $_POST['tipCli'] != '') {
        $sqlaCli .= ", tip_clie='" . $_POST['tipCli'] . "'";
      }
      $sqlaCli .= " WHERE id_cli='" . $_POST['id_nit'] . "'";
      $queryaCli = $conexion->query($sqlaCli);


      $sqlBus = "SELECT * from cre_solicitud where id_sol=" . $_POST['id_sol'];
      $queryBus = $conexion->query($sqlBus);
      $r = $queryBus->fetch(PDO::FETCH_OBJ);
      $file = "../../documentos/credito/";
      opendir($file);

      if (!empty($_FILES['certCon']['tmp_name'])) {
        if (file_exists($file . $r["doc_consGer"])) {
          unlink($file . $r["doc_consGer"]);
        }
        $certCon = $_FILES['certCon']['name'];
        $destino = $file . $certCon;
        copy($_FILES['certCon']['tmp_name'], $destino);
      }
      if (!empty($_FILES['copRu']['tmp_name'])) {
        if (file_exists($file . $r["doc_rut"])) {
          unlink($file . $r["doc_rut"]);
        }
        $copRu = $_FILES['copRu']['name'];
        $destino1 = $file . $copRu;
        copy($_FILES['copRu']['tmp_name'], $destino1);
      }
      if (!empty($_FILES['copFin']['tmp_name'])) {
        if (file_exists($file . $r["doc_estFin"])) {
          unlink($file . $r["doc_estFin"]);
        }
        $copFin = $_FILES['copFin']['name'];
        $destino2 = $file . $copFin;
        copy($_FILES['copFin']['tmp_name'], $destino2);
      }
      if (!empty($_FILES['refComer']['tmp_name'])) {
        if (file_exists($file . $r["doc_refCom"])) {
          unlink($file . $r["doc_refCom"]);
        }
        $refComer = $_FILES['refComer']['name'];
        $destino3 = $file . $refComer;
        copy($_FILES['refComer']['tmp_name'], $destino3);
      }
      if (!empty($_FILES['refComer2']['tmp_name'])) {
        if (file_exists($file . $r["doc_refcom2"])) {
          unlink($file . $r["doc_refcom2"]);
        }
        $refComer2 = $_FILES['refComer2']['name'];
        $destino4 = $file . $refComer2;
        copy($_FILES['refComer2']['tmp_name'], $destino4);
      }
      if (!empty($_FILES['refBan']['tmp_name'])) {
        if (file_exists($file . $r["doc_refBanc"])) {
          unlink($file . $r["doc_refBanc"]);
        }
        $refBan = $_FILES['refBan']['name'];
        $destino5 = $file . $refBan;
        copy($_FILES['refBan']['tmp_name'], $destino5);
      }
      if (!empty($_FILES['form_cre']['tmp_name'])) {
        if (file_exists($file . $r["doc_form"])) {
          unlink($file . $r["doc_form"]);
        }
        $formcre = $_FILES['form_cre']['name'];
        $destino6 = $file . $formcre;
        copy($_FILES['form_cre']['tmp_name'], $destino6);
      }

      $sqlaSol = "UPDATE cre_solicitud SET  nom_rep= '" . $_POST['reple'] . "',
                                            fec_sol= '" . $_POST['fech_sol'] . '' . $hora . "'";
      if (isset($_POST['ac_eco']) && $_POST['ac_eco'] != '') {
        $sqlaSol .= ",act_eco= '" . $_POST['ac_eco'] . "'";
      }
      if (isset($_POST['tie_mer']) && $_POST['tie_mer'] != '') {
        $sqlaSol .= ",tiem_merc= '" . $_POST['tie_mer'] . "'";
      }
      $sqlaSol .= ",num_emple= '" . $_POST['num_empl'] . "',
                                             cupo_sol= '" . $_POST['cupCreSol'] . "'";
      if (isset($_POST['ter_pag']) && $_POST['ter_pag'] != '') {
        $sqlaSol .= ", term_pag= '" . $_POST['ter_pag'] . "'";
      }
      if (isset($_POST['di_pag']) && $_POST['di_pag'] != '') {
        $sqlaSol .= ", dia_pag= '" . $_POST['di_pag'] . "'";
      }
      $sqlaSol .= ", reg_clie= '" . $_POST['regi'] . "',
                                             cupoSugA= '" . $_POST['CupAtc'] . "',
                                             plaSugeA= '" . $_POST['PlazAt'] . "',
                                            jusPlaCup= '" . $_POST['just'] . "'";
      if (isset($_POST['reten']) && $_POST['reten'] != '') {
        $sqlaSol .= ", retFuen= '" . $_POST['reten'] . "'";
      }
      if (isset($_POST['tiem']) && $_POST['tiem'] != '') {
        $sqlaSol .= ",tiem_rad= '" . $_POST['tiem'] . "'";
      }
      $sqlaSol .= ",  id_cli= '" . $_POST['id_nit'] . "',
                                           segm_clie= '" . $_POST['segCl'] . "',
                                          congen_ase= '" . $_POST['conAt'] . "',
                                         ana_referen= '" . $_POST['ana_ref'] . "'";
      if (isset($_POST['aseCom']) && $_POST['aseCom'] != '') {
        $sqlaSol .= ", ase_com= '" . $_POST['aseCom'] . "'";
      }
      if (isset($_POST['aseSac']) && $_POST['aseSac'] != '') {
        $sqlaSol .= ", rep_sac= '" . $_POST['aseSac'] . "'";
      }
      if (isset($_POST['nomSac']) && $_POST['nomSac'] != '') {
        $sqlaSol .= ", nom_sac= '" . $_POST['nomSac'] . "'";
      }
      if (isset($_POST['nomAse']) && $_POST['nomAse'] != '') {
        $sqlaSol .= ", nom_atc= '" . $_POST['nomAse'] . "'";
      }
      if (!empty($_FILES['certCon']['tmp_name'])) {
        $sqlaSol .= ", doc_consGer= '$certCon'";
      }
      if (!empty($_FILES['copRu']['tmp_name'])) {
        $sqlaSol .= ", doc_rut= '$copRu'";
      }
      if (!empty($_FILES['copFin']['tmp_name'])) {
        $sqlaSol .= ", doc_estFin= '$copFin'";
      }
      if (!empty($_FILES['refComer']['tmp_name'])) {
        $sqlaSol .= ", doc_refCom= '$refComer'";
      }
      if (!empty($_FILES['refComer2']['tmp_name'])) {
        $sqlaSol .= ", doc_refcom2= '$refComer2'";
      }
      if (!empty($_FILES['refBan']['tmp_name'])) {
        $sqlaSol .= ", doc_refBanc= '$refBan'";
      }
      if (!empty($_FILES['form_cre']['tmp_name'])) {
        $sqlaSol .= ", doc_form= '$formcre'";
      }
      $sqlaSol .= ", id_est='1' 
                              WHERE id_sol='" . $_POST['id_sol'] . "'";
      $queryaSol = $conexion->query($sqlaSol);

      $sqlaCon = "UPDATE cre_contactos SET  id_sol= '" . $_POST['id_sol'] . "',
                                            id_cli= '" . $_POST['id_nit'] . "',
                                           enc_com= '" . $_POST['en_com'] . "'";
      if (isset($_POST['en_com1']) && $_POST['en_com1'] != '') {
        $sqlaCon .= ", enc_com2= '" . $_POST['en_com1'] . "'";
      }
      $sqlaCon .= " ,ema_com= '" . $_POST['ema_com'] . "'";
      if (isset($_POST['ema_com1']) && $_POST['ema_com1'] != '') {
        $sqlaCon .= ", ema_com2='" . $_POST['ema_com1'] . "'";
      }
      $sqlaCon .= " ,con_ocu ='" . $_POST['cont_ocu'] . "'";
      if (isset($_POST['cont_ocu1']) && $_POST['cont_ocu1'] != '') {
        $sqlaCon .= ", con_ocu2= '" . $_POST['cont_ocu1'] . "'";
      }
      $sqlaCon .= ", ema_ocu= '" . $_POST['ema_ocu'] . "'";
      if (isset($_POST['ema_ocu1']) && $_POST['ema_ocu1'] != '') {
        $sqlaCon .= ", ema_ocu2='" . $_POST['ema_ocu1'] . "'";
      }
      $sqlaCon .= ", con_gen= '" . $_POST['cont_ser'] . "'";
      if (isset($_POST['cont_ser1']) && $_POST['cont_ser1'] != '') {
        $sqlaCon .= ", con_gen2='" . $_POST['cont_ser1'] . "'";
      }
      $sqlaCon .= ",ema_gen='" . $_POST['ema_ser'] . "'";
      if (isset($_POST['ema_ser1']) && $_POST['ema_ser1'] != '') {
        $sqlaCon .= ", ema_gen2='" . $_POST['ema_ser1'] . "'";
      }
      $sqlaCon .= ", con_teso='" . $_POST['cont_tes'] . "'";
      if (isset($_POST['cont_tes1']) && $_POST['cont_tes1'] != '') {
        $sqlaCon .= ",con_teso2='" . $_POST['cont_tes1'] . "'";
      }
      $sqlaCon .= ",ema_tes='" . $_POST['ema_tes'] . "'";
      if (isset($_POST['ema_tes1']) && $_POST['ema_tes1'] != '') {
        $sqlaCon .= ", ema_tes2='" . $_POST['ema_tes1'] . "'";
      }
      $sqlaCon .= ", con_cont='" . $_POST['cont_cont'] . "'";
      if (isset($_POST['cont_cont1']) && $_POST['cont_cont1'] != '') {
        $sqlaCon .= ",con_cont2='" . $_POST['cont_cont1'] . "'";
      }
      if (isset($_POST['cont_cont1']) && $_POST['cont_cont1'] != '') {
        $sqlaCon .= ", ema_cont2='" . $_POST['ema_conta1'] . "'";
      }
      $sqlaCon .= ",ema_cont='" . $_POST['ema_conta'] . "'
                                    WHERE id_sol='" . $_POST['id_sol'] . "'";

      $queryaCon = $conexion->query($sqlaCon);

      $sqlaEnv = "UPDATE cre_env_mercancia SET direcion_1= '" . $_POST['pun_u1'] . "',
                                                 ciudad_1= '" . $_POST['ciu1'] . "',
                                               telefono_1= '" . $_POST['tel_fij1'] . "',
                                                horario_1= '" . $_POST['hor_1'] . "',
                                               horario1_1= '" . $_POST['hor1_1'] . "'";
      if (isset($_POST['pun_u2']) && $_POST['pun_u2'] != '') {
        $sqlaEnv .= " , direcion_2= '" . $_POST['pun_u2'] . "',                                    
                                                 ciudad_2= '" . $_POST['ciu2'] . "',
                                               telefono_2= '" . $_POST['tel_fij2'] . "',
                                                horario_2= '" . $_POST['hor_2'] . "',
                                               horario2_2= '" . $_POST['hor2_2'] . "',";
      } else {
        $sqlaEnv .= " ,  direcion_2=NULL,                                    
                                                     ciudad_2= NULL,
                                                   telefono_2= NULL,
                                                    horario_2= NULL,
                                                   horario2_2= NULL";
      }
      if (isset($_POST['pun_u3']) && $_POST['pun_u3'] != '') {
        $sqlaEnv .= ", direcion_3= '" . $_POST['pun_u3'] . "',
                                                   ciudad_3= '" . $_POST['ciu3'] . "',
                                                 telefono_3= '" . $_POST['tel_fij3'] . "',
                                                  horario_3= '" . $_POST['hor_3'] . "',
                                                 horario3_3= '" . $_POST['hor3_3'] . "'";
      } else {
        $sqlaEnv .= ", direcion_3= NULL,
                                                    ciudad_3= NULL,
                                                  telefono_3= NULL,
                                                   horario_3= NULL,
                                                  horario3_3=NULL";
      }
      $sqlaEnv .= " WHERE id_sol='" . $_POST['id_sol'] . "'";

      $queryaEnv = $conexion->query($sqlaEnv);

      $sqlaFac = " UPDATE cre_factura SET telfono_fac= '" . $_POST['telfi_fa'] . "',
                                                    direccion= '" . $_POST['direFa'] . "', 
                                                       ciudad= '" . $_POST['ciu_fac'] . "'";
      if (isset($_POST['num_copias']) && $_POST['num_copias'] != '') {
        $sqlaFac .= ", num_copias= '" . $_POST['num_copias'] . "'";
      }
      if (isset($_POST['cert_cal']) && $_POST['cert_cal'] != '') {
        $sqlaFac .= ", cer_calidad= '" . $_POST['cert_cal'] . "'";
      }
      if (isset($_POST['ex_comp']) && $_POST['ex_comp'] != '') {
        $sqlaFac .= ", ext_comp= '" . $_POST['ex_comp'] . "'";
      }
      if (isset($_POST['ex_rem']) && $_POST['ex_rem'] != '') {
        $sqlaFac .= ", ext_remis= '" . $_POST['ex_rem'] . "'";
      }
      $sqlaFac .= ", id_cli= '" . $_POST['id_nit'] . "',
                                                      hor_fac= '" . $_POST['hor_fac'] . "'
                                             WHERE id_sol='" . $_POST['id_sol'] . "'";

      $queryaFac = $conexion->query($sqlaFac);

      $sqlSegE2 = "INSERT INTO `cre_x_mov`
                              (`id_sol`,
                              `id_usu`,
                              `id_est`,
                              `fech_crm`)
                      VALUES('" . $_POST['id_sol'] . "',
                            '" . $_SESSION['id'] . "',
                            '1',
                            '$fecha')";
      $querySegE2 = $conexion->query($sqlSegE2);


      if ($queryaCli != null &&  $queryaSol != null && $queryaEnv != null &&  $queryaFac != null && $queryaCon != null && $querySegE2 != null) {
        echo "<div align='center'>
                            <br> Solicitud Actualizada Correctamente. <br><br>
                    </div>";
      } else {
        printf("Errormessage: %s\n", $sqlaFac . '<br>' . $sqlaEnv . '<br>' . $sqlaSol . '<br>' . $sqlaCli . '<br>' . $sqlaCon . '<br>' . $sqlSegE2);
      }
      include 'Email.php';
      break;

    case 'actualizacionForm2':
      $sqlaEva = "UPDATE cre_eva_clie SET   ref_bancu=  '" . $_POST['ref_ban'] . "',
                                                ref_bancd=  '" . $_POST['ref_ban2'] . "',
                                               ref_comeru=  '" . $_POST['ref_com'] . "',
                                               ref_comerd=  '" . $_POST['ref_com2'] . "',
                                              super_socie=  '" . $_POST['super_soc'] . "',
                                                  reg_emp=  '" . $_POST['reg_emp'] . "',
                                                 fech_ini=  '" . $_POST['ini_cier'] . "',
                                                 fech_fin=  '" . $_POST['fin_cier'] . "',
                                                   act_in=  '" . $_POST['ac_cor'] . "',
                                                  act_fin=  '" . $_POST['ac_cor1'] . "',
                                                  pas_ini=  '" . $_POST['pas_cor'] . "',
                                                  pas_fin=  '" . $_POST['pas_cor1'] . "',
                                                 activ_in=  '" . $_POST['activ'] . "',
                                                activ_fin=  '" . $_POST['activ1'] . "',
                                                 pasiv_in=  '" . $_POST['pasi'] . "',
                                                pasiv_fin=  '" . $_POST['pasi1'] . "',
                                                 capi_pag=  '" . $_POST['cap_pa'] . "',
                                                 ingop_in=  '" . $_POST['ing'] . "',
                                                ingop_fin=  '" . $_POST['ing1'] . "',
                                                 utope_in=  '" . $_POST['util'] . "',
                                                utope_fin=  '" . $_POST['utilun'] . "',
                                               utdesim_in=  '" . $_POST['util_an'] . "',
                                              utdesim_fin=  '" . $_POST['util_an1'] . "',
                                                  inv_ini=  '" . $_POST['inv'] . "',
                                                  inv_fin=  '" . $_POST['inv1'] . "'
                                       WHERE id_sol='" . $_POST['id_sol'] . "'";
      $queryaEva = $conexion->query($sqlaEva);
      $sqlSegE3 = "INSERT INTO `cre_x_mov`
                                    (`id_sol`,
                                    `id_usu`,
                                    `id_est`,
                                    `fech_crm`)
                        VALUES('" . $_POST['id_sol'] . "',
                              '" . $_SESSION['id'] . "',
                              '2',
                              '$fecha')";
      $querySegE2 = $conexion->query($sqlSegE2);

      $sqlEdi = "UPDATE cre_solicitud SET id_est='2'
                                          WHERE id_sol='" . $_POST['id_sol'] . "'";
      $sqlEdi = $conexion->query($sqlEdi);

      if ($sqlaEva != null) {
        echo "<div align='center'>
                                <br>Solicitud Actualizada Correctamente.<br><br>
                            </div>";
      } else {
        printf("Errormessage: %s\n");
      }
      include 'Email.php';
      break;
  }
}
