<?php
include '../../conexion.php';
switch ($i) {
    case '1':
    $mail->Body ='
        <!DOCTYPE html
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
                            <img style="width:770px !important;" src="https://intranet.masterquimica.com/resources/img/Correocotización.png">
                        </div>
                        <p style="margin: 39px 49px 40px 71px !important;">
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
                                            <span style="font-weight:bold;">'.strtoupper($sac->nom_usu).'</span><br>
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
                                            <span style="font-weight:bold;">'.strtoupper($ace->nom_usu).'</span><br>
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
                            Le informamos que realizó el envio de la cotización N° '.($usu->id_coti).', al cliente <strong>'.($usu->nom_cli).' </strong> los datos del contacto son:
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
                                        <td width="80" align="center">'.$usu->nom_cont.'</td>
                                        <td align="center">'.$usu->tel_cont.'</td>
                                        <td align="center">'.$usu->eml_cont.'</td>
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
    ///Aprobado
    case '3':
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
                            <img style="width:770px !important;" src="https://intranet.masterquimica.com/resources/img/Correocotización.png">
                        </div>
                        <p style="margin:  39px 49px 40px 71px; !important">
                            Buen día, '.($usu->nom_cont).' <br><br>
                            La Cotización  <strong> N° '.($usu->id_coti).'</strong> a sido <strong>'.($usu->nom_ema).'</strong> por su parte; en el transcurso del día, nuestro
                            Asesor Comercial o Representante de Servicio se comunicara con usted para confirmar la  aprobación de la cotización.<br>
                            Cualquier inquietud adicional no dude en contactarse con nosotros. <br><br>
                        </p>
                    </div>
                    <div style="text-align: center">
                        <img style="width:770px !important;" src="https://intranet.masterquimica.com/resources/img/telefonos.png">
                    </div>
                </div>
            </div>
        </body>
    </html>';
    break;
    case '4':
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
                        <p style="margin: 39px 49px 40px 71px;color:black; font-family: Roboto;">
                            Buen día,  '.($usu->nom_usu).' <br><br>
                            Le informamos que la cotizacion N° '.($usu->id_coti).' ah sido <strong>'.($usu->nom_ema).' </strong> por: '.($usu->nom_cli).'.
                            Recuerde que puede visualizar la cotización por medio del siguiente enlace.<br>
                        </p>
                        
                            <div style="text-align: center;">
                            <a href="https://intranet.masterquimica.com/application/cotiAuto/index.php?id_coti='.($usu->id_coti).'&xont='.($usu->id_cont).'&asc='.($usu->ced_ase).'&ux='.($usu->id_usu).'&tip='.($usu->id_tip_cot).'"
                                target="_blank">
                                <img src="https://intranet.masterquimica.com/resources/img/cotizacion.png" style="width: 176px !important;">
                            </a>
                        </div>
                        <p style="margin:  39px 49px 40px 71px !important; color:black; font-family: Roboto;" align="center">
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
    case '5':
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
                            <img style="width:770px !important;" src="https://intranet.masterquimica.com/resources/img/Correocotización.png">
                        </div>
                        <p style="margin:  39px 49px 40px 71px;">
                            Buen día, '.($usu->nom_cont).' <br><br>
                            La Cotización  <strong> N° '.($usu->id_coti).'</strong> a sido <strong>'.($usu->nom_ema).'</strong> por su parte; en el transcurso del día, nuestro
                            Asesor Comercial o Representante de Servicio se comunicara con usted para saber el motivo del rechazo de la cotización.<br>
                            Cualquier inquietud adicional no dude en contactarse con nosotros. <br><br>
                        </p>
                    </div>
                    <div style="text-align: center">
                        <img style="width:770px !important;" src="https://intranet.masterquimica.com/resources/img/telefonos.png">
                    </div>
                </div>
            </div>
        </body>
    </html>';
    break;
    case '6':
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
                        <p style="margin: 39px 49px 40px 71px;color:black; font-family: Roboto;">
                        
                            Buen día,  '.($usu->nom_usu).' <br><br>
                            Le informamos que la cotizacion N° '.($usu->id_coti).' ah sido <strong>'.($usu->nom_ema).' </strong> por: '.($usu->nom_cli).'.
                            Recuerde que puede visualizar la cotización por medio del siguiente enlace.<br>
                        </p>
                        
                            <div style="text-align: center;">
                            <a href="https://intranet.masterquimica.com/application/cotiAuto/index.php?id_coti='.($usu->id_coti).'&xont='.($usu->id_cont).'&asc='.($usu->ced_ase).'&ux='.($usu->id_usu).'&tip='.($usu->id_tip_cot).'"
                                target="_blank">
                                <img src="https://intranet.masterquimica.com/resources/img/cotizacion.png" style="width: 176px !important;">
                            </a>
                        </div>
                        <p style="margin:  39px 49px 40px 71px; color:black; font-family: Roboto;" align="center">
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
    case '7':
    $mail->Body ='
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
                            <img style="width:770px !important;" src="https://intranet.masterquimica.com/resources/img/Correocotización.png">
                        </div>
                        <p style="margin: 39px 49px 40px 71px;">
                            Buen día, <br><br>
                            De acuerdo a su solicitud, le anexamos los datos de la propuesta de productos y/o servicios, los cuales puede visualizar haciendo clic en "Cotización".
                        </p>
                        <div style="text-align: center;">
                            <a href="https://intranet.masterquimica.com/application/cotiAuto/index.php?id_coti='.($usu->id_coti).'&xont='.($usu->id_cont).'&asc='.($usu->ced_ase).'&tip='.($usu->id_tip_cot).'"
                                target="_blank">
                                <img src="https://intranet.masterquimica.com/resources/img/cotizacion.png" style="width: 176px !important;">
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
                                            <span style="font-weight:bold;">'.strtoupper($sac->nom_usu).'</span><br>
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
                                            <span style="font-weight:bold;">'.strtoupper($ace->nom_usu).'</span><br>
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
        </body>
        </html>';
    break;
                  
    case '8':
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
                            Le informamos que realizó el envio de la cotización N° '.($usu->id_coti).', al cliente <strong>'.($usu->nom_cli).' </strong> los datos del contacto son:
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
                                        <td width="80" align="center">'.$usu->nom_cont.'</td>
                                        <td align="center">'.$usu->tel_cont.'</td>
                                        <td align="center">'.$usu->eml_cont.'</td>
                                    </tr>
                                </td>
                            </tbody>
                        </table>

                        <p style="margin: 39px 49px 40px 71px;">
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



    case '9':
    $mail->Body ='
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
                    <div>';
                    if($chat->usu_mq ==2){
                        $mail->Body .= '
                        <div style="text-align: center">
                            <img style="width:770px;" src="https://intranet.masterquimica.com/resources/img/Correocotización.png">
                        </div>';
                    }else{
                        $mail->Body .= '
                        <div style="text-align: center">
                            <img style="width:770px;" src="https://intranet.masterquimica.com/resources/img/CorreocotiSac.png">
                        </div>';
                    }
                    $mail->Body .= '
                                    <p style="margin: 39px 49px 40px 71px;">
                                        Buen día,  '.($chat->nom_cont).'<br><br>
                                            Le informamos que ha enviado el siguiente comentario de la cotización <strong> N° '.($chat->id_coti).'</strong>.<br><br>
                                            <i style="text-align: justify margin: 39px 49px 40px 71px;">'.($chat->comentario).'</i>
                                    </p>';
                        if($chat->usu_mq ==2){
                            $mail->Body .= ' <p style="margin: 39px 49px 40px 71px;">
                                                En el transcurso del día un Asesor o Representante se comunicará contigo.
                                                Podrá visualizar los comentarios haciendo clic en el icono del chat que se encuentra dentro de la cotización. 
                                            </p>
                                            <div style="text-align: center;" >
                                                <a href="https://intranet.masterquimica.com/application/cotiAuto/index.php?id_coti='.($usu->id_coti).'&xont='.($usu->id_cont).'&asc='.($usu->ced_ase).'&tip='.($usu->id_tip_cot).'"
                                                    target="_blank">
                                                    <img src="https://intranet.masterquimica.com/resources/img/cotizacion.png" style="width: 176px !important;">
                                                </a>
                                            </div>';

                        }else{
                            $mail->Body .= ' <p style="margin: 39px 49px 40px 71px;">
                                            Podrá visualizar los comentarios haciendo clic en el icono del chat que se encuentra dentro de la cotización. 
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
                                            </div>';
                        }
                        $mail->Body .= '
                    </div>
                </div>
            </div>
        </body>
        </html>';
    break;
    case '10':
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
                    <div>';
                    if($chat->usu_mq ==2){
                        $mail->Body .= '
                        <div style="text-align: center">
                            <img style="width:770px;" src="https://intranet.masterquimica.com/resources/img/Correocotización.png">
                        </div>';
                    }else{
                        $mail->Body .= '
                        <div style="text-align: center">
                            <img style="width:770px;" src="https://intranet.masterquimica.com/resources/img/CorreocotiSac.png">
                        </div>';
                    }
                    $mail->Body .= '
                        <p style="margin: 39px 49px 40px 71px;">
                            Buen día, <br><br>
                            El usuario '.($chat->nom_cont).' a dejado un comentario sobre la cotización <strong> N° '.($chat->id_coti).'</strong>.
                        </p>
                        <p style="margin: 39px 49px 40px 71px;">
                        Podrá visualizar los comentarios haciendo clic en el icono del chat que se encuentra dentro de la cotización. <br><br>
                        <i style="text-align: justify margin: 39px 49px 40px 71px;">'.($chat->comentario).'</i>
                        </p>';
                    if($chat->usu_mq ==2){
                        $mail->Body .= ' 
                                        <div style="text-align: center;">
                                            <a href="https://intranet.masterquimica.com/application/cotiAuto/index.php?id_coti='.($usu->id_coti).'&xont='.($usu->id_cont).'&asc='.($usu->ced_ase).'&tip='.($usu->id_tip_cot).'"
                                                target="_blank">
                                                <img src="https://intranet.masterquimica.com/resources/img/cotizacion.png" style="width: 176px !important;">
                                            </a>
                                        </div>';
                    }else{
                        $mail->Body .= '
                                        <div style="text-align: center;">
                                            <a href="https://intranet.masterquimica.com/application/cotiAuto/index.php?id_coti='.($usu->id_coti).'&xont='.($usu->id_cont).'&asc='.($usu->ced_ase).'&ux='.($usu->id_usu).'&tip='.($usu->id_tip_cot).'"
                                                target="_blank">
                                                <img src="https://intranet.masterquimica.com/resources/img/cotizacion.png" style="width: 176px  !important;">
                                            </a>
                                        </div>
                                        <p style="margin: 39px 133px 40px 149px;" align="center">
                                            Por favor ingrese al aplicativo para administrar la cotización .
                                        </p>
                                        <div style="color:black" align="center">
                                            <a href="https://intranet.masterquimica.com/">
                                             <img src="https://intranet.masterquimica.com/resources/img/LOGO.png" style="width: 50px  !important;">
                                            </a>
                                        </div>';
                    }
                    $mail->Body .= '
                    </div>
                </div>
            </div>
        </body>
        </html>';
    break;

    }?>