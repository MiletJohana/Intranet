

<?php
include '../../conexion.php';
switch ($i) {
    case '1':
    $mail->Body ='
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    </head>

    <body style="color:black; font-family: Roboto; font-size: 1.3em;">
        <div style="margin-top: 3em;margin-bottom: 3em !important;margin-left: 7em !important ;margin-right: 7em !important;">
            <div>
                <div>
                    <div style="text-align: center">
                        <img style="width:284px !important;" src="https://intranet.masterquimica.com/resources/img/crm2.png">
                    </div>
                    <p style="margin: 39px 49px 40px 71px !important;">
                    Buen día, Estimado(a) '. ($com->nom_con) .',<br><br>
                    Agradecemos su tiempo recordandole que su necesidad es nuestra prioridad, a continuación relaciono el asunto de nuestro correo <br><br>
                    
                    </p>
                </div>
            </div>
        </div>
        <table style="font-size:15px;font-style:Arial;margin: 0px 0px 0px 169px;">
            <tr>';
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
            $mail->Body .= '
            </tr>
        </table>
    </html>';
    break;
      
    case '2':
    $mail->Body = '
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
                            <img style="width:770px !important;" src="https://intranet.masterquimica.com/resources/img/CorreocotiSac.png">
                        </div>
                        <p style="margin: 39px 49px 40px 71px;">
                            Buen día, '.($usu->nom_usu).' <br><br>
                            Le informamos que realizó el envio de la transaccion  N° '.($usu->id_coti).', al cliente <strong>'.($usu->nom_cli).' </strong> los datos del contacto son:
                        </p>
                        <table class="table table-bordered" align="center" style="font-size:16px;color:black;background:#DFDFDF;border-radius:9px;" width="700">
                            <thead style="color:white;background:#58585C">
                                <tr style="height:40px;">
                                        <th width="50">Nombre</th>
                                        <th width="50">Teléfono</th>
                                        <th width="50">Email</th>
                                </tr>
                            </thead>
                            <tbody>
                            <td> 
                                <tr align="center">
                                        <td width="80" align="center">'.utf8_encode($usu->nom_cont).'</td>
                                        <td align="center">'.utf8_encode($usu->tel_cont).'</td>
                                        <td align="center">'.utf8_encode($usu->eml_cont).'</td>
                                    </tr>
                                </td>
                            </tbody>
                        </table>

                        <p style="margin: 39px 49px 40px 71px !important;">
                        Adicional anexamos la propuesta de productos y/o servicios, los cuales puede visualizar haciendo clic en "Cotización".
                        </p>
                            <div style="text-align: center;">
                            <a href="https://intranet.masterquimica.com/application/cotiAuto/index.php?id_coti='.($usu->id_coti).'&xont='.($usu->id_cont).'&asc='.($usu->ced_ase).'&ux='.($usu->id_usu).'&tip='.($usu->id_tip_cot).'"
                                target="_blank">
                                <img src="https://intranet.masterquimica.com/resources/img/cotizacion.png" style="width: 176px !important;">
                            </a>
                        </div>
                        <p style="margin: 39px 133px 40px 149px;" align="center">
                            Por favor ingrese al aplicativo para administrar la cotización .
                        </p>
                        <div style="color:black" align="center">
                        <a href="https://intranet.masterquimica.com/">
                        <img src="https://intranet.masterquimica.com/resources/img/LOGO.png" style="width: 50px !important;">
                        </a>
                        </div>
                    </div>
                </div>
            </div>
        </body>
    </html>';
    break;
}

?>