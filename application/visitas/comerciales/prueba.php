<!DOCTYPE html
            PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">

        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
        </head>

        <body style="color:black; font-family: Roboto; font-size: 1.3em;">
            <div style="margin-top: 3em;margin-bottom: 3em;margin-left: 7em;margin-right: 7em;">
                <div>
                    <div>
                        <div style="text-align: center">
                            <img style="width:770px;" src="https://intranet.masterquimica.com/resources/img/Correocotización.png">
                        </div>
                        <p style="margin: 39px 49px 40px 71px;">
                            Buen día,  '.($usu->nom_cont).'<br><br>
                            De acuerdo a su solicitud, le anexamos los datos de la propuesta de productos y/o servicios, los cuales puede visualizar haciendo clic en "Cotización".
                        </p>
                        <div style="text-align: center;">
                            <a href="https://intranet.masterquimica.com/application/cotiAuto/index.php?id_coti='.($usu->id_coti).'&xont='.($usu->id_cont).'&asc='.($usu->ced_ase).'&tip='.($usu->id_tip_cot).'"
                                target="_blank">
                                <img src="https://intranet.masterquimica.com/resources/img/cotizacion.png" style="width: 176px;">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <table style="font-size:15px;font-style:Arial;margin: 0px 0px 0px 169px;">
                <tr>';
                if ($usu->ced_sac !=""){
                    $mail->Body .= '<td width="40%" style="background-color:transparent;">
                                        <p>
                                            <span style="font-weight:bold;">'.strtoupper(utf8_encode($sac->nom_usu)).'</span><br>
                                            '.strtoupper($sac->nom_car).' <br>
                                            PBX: 231 6377 ext. '.($sac->ext_usu) .'<br>
                                            <a href=" '.($sac->eml_usu).'">
                                                '.($sac->eml_usu).'
                                            </a>
                                        </p>
                                    </td>
                                    <td></td>';
                }
                if($usu->ced_ase !=""){
                    $mail->Body .= '
                                    <td width="40%" style="background-color:transparent;">
                                        <p>
                                            <span style="font-weight:bold;">'.strtoupper(utf8_encode($ace->nom_usu)).'</span><br>
                                            '.strtoupper($ace->nom_car).' <br>
                                            PBX: 231 6377 ext. '.($ace->ext_usu).'<br>
                                            <a href=" '.($ace->eml_usu).'">
                                                '.($ace->eml_usu).'
                                            </a>
                                        </p>
                                    </td>';
                }
                $mail->Body .= '
                </tr>
            </table>
        </html>';